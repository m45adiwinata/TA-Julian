<?php

namespace App\Http\Controllers;

use App\Pembelian;
use App\Suplier;
use App\Barang;
use App\BarangPembelian;
use App\Status;
use App\StokBarang;
use App\Lokasi;
use App\SubLokasi;
use Session;
use Auth;
use Illuminate\Http\Request;
use PDF;
use DateTime;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Makassar');
        if(!Auth::check()) {
            return redirect('/login');
        }
        if ($request->query('per_page')) {
            $data['pembelians'] = Pembelian::paginate($request->query('per_page'));
            setcookie("per_page", $request->query('per_page'));
            $data['per_page'] = $request->query('per_page');
        }
        else if (count($_COOKIE) <= 4) {
            setcookie("per_page", 10);
            $data['pembelians'] = Pembelian::paginate(10);
            $data['per_page'] = 10;
        }
        else {
            $data['pembelians'] = Pembelian::paginate($_COOKIE['per_page']);
            $data['per_page'] = $_COOKIE['per_page'];
        }
        $data['pembelians2'] = $data['pembelians']->items();
        foreach ($data['pembelians2'] as $key => $pembelian) {
            $pembelian->status = Status::find($pembelian->status_id)->nama;
            $pembelian->barangs = $pembelian->barangPembelian()->get();
            foreach ($pembelian->barangs as $key => $barang) {
                $temp = $barang->barang()->first();
                $barang->nama = $temp->nama;
                $barang->harga = $temp->harga;
                $barang->qty = $barang->harga_beli / $temp->harga;
            }
        }
        $data['statuses'] = Status::get();
        $data['page'] = 'data_pembelian';
        $data['title'] = 'Pembelian';
        $data['sub_title'] = 'Data';
        $data['sub_link'] = '/pembelian';

        return view('pembelian.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        date_default_timezone_set('Asia/Makassar');
        $pembelians = Pembelian::get();
        if (count($pembelians) == 0) {
            $data['new_id'] = 1;
        }
        else {
            $data['new_id'] = end($pembelians)[0]->id+1;
        }
        $data['supliers'] = Suplier::get();
        $data['barangs'] = Barang::where('satuan_id', 1)->orWhere('satuan_id', 2)->get();
        $data['lokasis'] = Lokasi::get();
        $data['sub_lokasis'] = SubLokasi::get();
        $data['page'] = 'buat_pembelian';
        $data['title'] = 'Pembelian';
        $data['sub_title'] = 'Buat';
        $data['sub_link'] = '/pembelian/create';

        return view('pembelian.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Makassar');
        $this->validate($request, [
            'suplier' => 'required',
        ]);
        foreach ($request->qty as $key => $value) {
            if($value < 1) {
                return redirect('pembelian/create')->with('danger', 'Kuantitas harus lebih dari atau sama dengan 1.');
            }
        }
        $dt = new DateTime;
        $data = new Pembelian;
        $data->suplier_id = $request->suplier;
        $data->status_id = 1;
        $data->diskon = $request->diskon;
        $data->type_diskon_id = $request->type_diskon;
        $data->created_at = $dt->format($request->date." ".$request->time.":00");
        $data->save();
        foreach ($request->barang as $key => $barang_id) {
            $barang = new BarangPembelian;
            $barang->barang_id = $barang_id;
            $barang->harga_beli = $request->qty[$key] * Barang::find($barang_id)->harga;
            $barang->lokasi_id = $request->lokasi[$key];
            $barang->sub_lokasi_id = $request->sub_lokasi[$key];
            $data->barangPembelian()->save($barang);
        }
        
        return redirect('pembelian');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelian $pembelian)
    {
        date_default_timezone_set('Asia/Makassar');
        $data['pembelian'] = $pembelian;
        $data['supliers'] = Suplier::get();
        $data['barangs'] = Barang::get();
        $data['lokasis'] = Lokasi::get();
        $data['sub_lokasis'] = SubLokasi::get();
        $data['total_cost'] = 0;
        foreach ($pembelian->barangPembelian()->get() as $key => $bp) {
            $data['total_cost'] += $bp->harga_beli;
        }
        $data['page'] = 'data_pembelian';
        $data['title'] = 'Pembelian';
        $data['sub_title'] = 'Data';
        $data['sub_link'] = '/pembelian';
        
        // dd($data);
        return view('pembelian.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        date_default_timezone_set('Asia/Makassar');
        foreach ($request->qty as $key => $value) {
            if($value < 1) {
                return redirect('pembelian/create')->with('danger', 'Kuantitas harus lebih dari atau sama dengan 1.');
            }
        }
        // dd($request->time);
        $dt = new DateTime;
        $pembelian->barangPembelian()->delete();
        $pembelian->suplier_id = $request->suplier;
        $pembelian->status_id = 1;
        $pembelian->diskon = $request->diskon;
        $pembelian->type_diskon_id = $request->type_diskon;
        $pembelian->created_at = $dt->format($request->date." ".$request->time.":00");
        $pembelian->save();
        foreach ($request->barang as $key => $barang_id) {
            $barang = new BarangPembelian;
            $barang->barang_id = $barang_id;
            $barang->harga_beli = $request->qty[$key] * Barang::find($barang_id)->harga;
            $barang->lokasi_id = $request->lokasi[$key];
            $barang->sub_lokasi_id = $request->sub_lokasi[$key];
            $pembelian->barangPembelian()->save($barang);
        }

        return redirect('pembelian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }

    public function getSuplierDetail($id)
    {
        $suplier = Suplier::find($id);
        return $suplier;
    }

    public function getBarangDetail($id)
    {
        $barang = Barang::find($id);
        return $barang;
    }

    public function setStatus($id, $status)
    {
        $pembelian = Pembelian::find($id);
        if ($pembelian->status_id == 2) {
            foreach ($pembelian->barangPembelian()->get() as $key => $beli) {
                $barang = $beli->barang()->first();
                $harga_unit = $barang->harga;
                $jumlah = $beli->harga_beli / $harga_unit;
                $stok = StokBarang::firstOrNew(['barang_id' => $barang->id, 'lokasi_id' => $beli->lokasi_id, 'sub_lokasi_id' => $beli->sub_lokasi_id]);
                $stok->lokasi_id = $beli->lokasi_id;
                $stok->sub_lokasi_id = $beli->sub_lokasi_id;
                $stok->ketersediaan -= $jumlah;
                $barang->stok()->save($stok);
            }
        }
        if ($status == 2) {
            foreach ($pembelian->barangPembelian()->get() as $key => $beli) {
                $barang = $beli->barang()->first();
                $harga_unit = $barang->harga;
                $jumlah = $beli->harga_beli / $harga_unit;
                $stok = StokBarang::firstOrNew(['barang_id' => $barang->id, 'lokasi_id' => $beli->lokasi_id, 'sub_lokasi_id' => $beli->sub_lokasi_id]);
                $stok->lokasi_id = $beli->lokasi_id;
                $stok->sub_lokasi_id = $beli->sub_lokasi_id;
                $stok->ketersediaan += $jumlah;
                $barang->stok()->save($stok);
            }
        }
        $pembelian->status_id = $status;
        $pembelian->save();
        
        return "success";
    }

    public function getKapasitasSubLokasi($id)
    {
        $sub_lokasi = SubLokasi::find($id);
        $kapasitas_terpakai = 0;
        foreach ($sub_lokasi->stok()->get() as $key => $stok) {
            $kapasitas_terpakai += $stok->ketersediaan;
        }
        $sisa = $sub_lokasi->kapasitas - $kapasitas_terpakai;
        $data = [
            'sub_lokasi' => $sub_lokasi,
            'sisa' => $sisa
        ];

        return $data;
    }

    public function getNota($id)
    {
        $pembelian = Pembelian::find($id);
        $bulan = ['','Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $pembelian->tanggal_str = date('j', strtotime($pembelian->created_at)).' '.$bulan[date('n', strtotime($pembelian->created_at))].' '.date('Y', strtotime($pembelian->created_at));
        $data['pembelian'] = $pembelian;

        $pdf = PDF::loadView('pembelian.nota', $data);
        return $pdf->stream();
    }
}

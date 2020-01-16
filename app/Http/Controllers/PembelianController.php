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
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pembelians'] = Pembelian::get();
        foreach ($data['pembelians'] as $key => $pembelian) {
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

        return view('pembelian.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request, [
            'suplier' => 'required',
        ]);
        foreach ($request->qty as $key => $value) {
            if($value < 1) {
                return redirect('pembelian/create')->with('danger', 'Kuantitas harus lebih dari atau sama dengan 1.');
            }
        }
        $data = new Pembelian;
        $data->suplier_id = $request->suplier;
        $data->status_id = 1;
        $data->diskon = $request->diskon;
        $data->type_diskon_id = $request->type_diskon;
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
        $data['pembelian'] = $pembelian;
        $data['supliers'] = Suplier::get();
        $data['barangs'] = Barang::get();
        $data['lokasis'] = Lokasi::get();
        $data['sub_lokasis'] = SubLokasi::get();
        $data['total_cost'] = 0;
        foreach ($pembelian->barangPembelian()->get() as $key => $bp) {
            $data['total_cost'] += $bp->harga_beli;
        }
        
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
        //
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
        $pembelian->status_id = $status;
        $pembelian->save();
        if ($status == 2) {
            foreach ($pembelian->barangPembelian()->get() as $key => $beli) {
                $harga_unit = $beli->barang()->first()->harga;
                for ($i=0; $i < $beli->harga_beli/$harga_unit; $i++) { 
                    $stok = new StokBarang;
                    $stok->barang_id = $beli->barang_id;
                    $stok->lokasi_id  = $beli->lokasi_id;
                    $stok->sub_lokasi_id = $beli->sub_lokasi_id;
                    $stok->save();
                }
            }
        } else {
            foreach ($pembelian->barangPembelian()->get() as $key => $beli) {
                $barang = $beli->barang()->first();
                $harga_unit = $barang->harga;
                if (count($barang->stok()->get()) > 0) {
                    for ($i=0; $i < $beli->harga_beli/$harga_unit; $i++) { 
                        $barang->stok()->get()[0]->delete();
                    }
                }
            }
        }
        
        return "success";
    }
}

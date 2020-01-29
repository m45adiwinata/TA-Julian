<?php

namespace App\Http\Controllers;

use App\Penjualan;
use App\Pelanggan;
use App\Sales;
use App\Barang;
use App\BarangPenjualan;
use App\Status;
use App\SubLokasi;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['penjualans'] = Penjualan::get();
        foreach ($data['penjualans'] as $key => $penjualan) {
            $penjualan->barangs = $penjualan->barangPenjualan()->get();
            foreach ($penjualan->barangs as $key => $barang) {
                $temp = $barang->barang()->first();
                $barang->nama = $temp->nama;
                $barang->harga = $temp->harga_jual;
                $barang->qty = $barang->harga_jual / $temp->harga_jual;
            }
        }
        $data['statuses'] = Status::get();
        $data['page'] = 'data_penjualan';
        $data['title'] = 'Penjualan';
        $data['sub_title'] = 'Data';
        $data['sub_link'] = '/penjualan';

        return view('penjualan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = 'buat_penjualan';
        $penjualans = Penjualan::get();
        if (count(Penjualan::get()) == 0) {
            $data['new_id'] = 1;
        } else {
            $data['new_id'] = end($penjualans)[0]->id + 1;
        }
        $data['pelanggans'] = Pelanggan::get();
        $data['saleses'] = Sales::get();
        $data['barangs'] = Barang::get();
        $data['title'] = 'Penjualan';
        $data['sub_title'] = 'Buat';
        $data['sub_link'] = '/penjualan/create';
        
        return view('penjualan.create', $data);
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
            'pelanggan_id' => 'required',
            'sales_id' => 'required'
        ]);
        // dd($request);
        $data = new Penjualan;
        $data->pelanggan_id = $request->pelanggan_id;
        $data->sales_id = $request->sales_id;
        $data->diskon = $request->diskon;
        $data->type_diskon = $request->type_diskon;
        $data->save();
        foreach ($request->barang as $key => $barang_id) {
            $barang = new BarangPenjualan;
            $barang->barang_id = $barang_id;
            $barang->harga_jual = $request->qty[$key] * Barang::find($barang_id)->harga_jual;
            $barang->status_id = 1;
            $data->barangPenjualan()->save($barang);
        }

        return redirect('penjualan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        $data['penjualan'] = $penjualan;
        $data['pelanggans'] = Pelanggan::get();
        $data['saleses'] = Sales::get();
        $data['barangs'] = Barang::get();
        $data['total_cost'] = 0;
        foreach ($penjualan->barangPenjualan()->get() as $key => $jual) {
            $data['total_cost'] += $jual->harga_jual;
        }
        $data['page'] = 'data_penjualan';
        $data['title'] = 'Penjualan';
        $data['sub_title'] = 'Data';
        $data['sub_link'] = '/penjualan';
        
        // dd($data);
        return view('penjualan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        foreach ($penjualan->barangPenjualan()->get() as $key => $jual) {
            if ($jual->status_id == 2) {
                $barang = $jual->barang()->first();
                $stoks = $barang->stok()->get();
                $jumlah_barang = $jual->harga_jual / $barang->harga_jual;
                if ($barang->satuan_id == 1) {
                    #barang kembali dengan aturan kapasitas sub lokasi
                    foreach ($stoks as $key => $stok) {
                        $sub_lokasi = $stok->subLokasi()->first();
                        $sisa_kapasitas = $sub_lokasi->kapasitas;
                        foreach ($sub_lokasi->stok()->where('satuan_id', 1)->get() as $key => $value) {
                            $sisa_kapasitas -= $value->ketersediaan;
                        }
                        if ($sisa_kapasitas >= $jumlah_barang) {
                            $stok->ketersediaan += $jumlah_barang;
                            $stok->save();
                            break;
                        } else {
                            $jml_kembali = $jumlah_barang - $sisa_kapasitas;
                            $stok->ketersediaan += $jml_kembali;
                            $stok->save();
                            $jumlah_barang -= $jml_kembali;
                        }
                    }
                } else {
                    #barang kembali ke stoks indeks pertama tanpa aturan kapasitas sub lokasi
                    $stoks[0]->ketersediaan += $jumlah_barang;
                    $stoks[0]->save();
                }
            }
        }
        $penjualan->barangPenjualan()->delete();
        $penjualan->pelanggan_id = $request->pelanggan_id;
        $penjualan->sales_id = $request->sales_id;
        $penjualan->diskon = $request->diskon;
        $penjualan->type_diskon = $request->type_diskon;
        $penjualan->created_at = $request->created_at;
        $penjualan->save();
        foreach ($request->barang as $key => $barang_id) {
            $barang = new BarangPenjualan;
            $barang->barang_id = $barang_id;
            $barang->harga_jual = $request->qty[$key] * Barang::find($barang_id)->harga_jual;
            $barang->status_id = 1;
            $penjualan->barangPenjualan()->save($barang);
        }

        return redirect('penjualan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }

    public function getPelangganDetail($id)
    {
        $pelanggan = Pelanggan::find($id);
        return $pelanggan;
    }

    public function getSalesDetail($id)
    {
        $sales = Sales::find($id);
        return $sales;
    }

    public function setStatusBarangPenjualan($id, $barang_id, $value)
    {
        $penjualan = Penjualan::find($id);
        $bp = $penjualan->barangPenjualan()->where('barang_id', $barang_id)->first();
        $barang = $bp->barang()->first();
        $jumlah = $bp->harga_jual / $barang->harga_jual;
        if ($value == 2) {
            foreach ($barang->stok()->get() as $key => $stok) {
                if ($stok->ketersediaan >= $jumlah) {
                    $stok->ketersediaan -= $jumlah;
                    $stok->save();
                    break;
                } else {
                    $sisa_jumlah = $jumlah - $stok->ketersediaan;
                    $jumlah -= $sisa_jumlah;
                    $stok->ketersediaan -= $sisa_jumlah;
                    $stok->save();
                }
            }
        }
        if ($jumlah > 0) {
            if ($barang->satuan_id == 3) {
                $stok_barang = $barang->stok()->first();
                $parent_barang = $barang->parent()->first();
                $jml_dibutuhkan = ceil($jumlah / $parent_barang->jumlah_unit);
                $stok_parent = $parent_barang->stok()->where('ketersediaan', '>=', $jml_dibutuhkan)->first();
                if ($stok_parent) {
                    $stok_parent->ketersediaan -= $jml_dibutuhkan;
                    $stok_parent->save();
                    $stok_barang->ketersediaan += $parent_barang->jumlah_unit * $jml_dibutuhkan;
                    $stok_barang->save();
                }
                $bp->status_id = $value;
                $bp->save();
            } else {
                return "gagal, tidak ada stok";
            }
        }
    }
}

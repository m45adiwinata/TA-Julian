<?php

namespace App\Http\Controllers;

use App\Penjualan;
use App\Pelanggan;
use App\Sales;
use App\Barang;
use App\BarangPenjualan;
use App\Status;
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
        $penjualan->pelanggan_id = $request->pelanggan_id;
        $penjualan->sales_id = $request->sales_id;
        $penjualan->diskon = $request->diskon;
        $penjualan->type_diskon = $request->type_diskon;
        $penjualan->created_at = $request->created_at;
        $penjualan->save();
        if (count($request->barang) == count($penjualan->barangPenjualan()->get())) {
            $r_barang = $request->barang;
            foreach ($penjualan->barangPenjualan()->get() as $key => $jual) {
                $jual->barang_id = $r_barang[$key];
                $jual->harga_jual = $request->qty[$key] * Barang::find($r_barang[$key])->harga_jual;
                $jual->status_id = 1;
                $jual->save();
            }
        } else {
            $r_barang = $request->barang;
            if (count($r_barang) > count($penjualan->barangPenjualan()->get())) {
                foreach ($penjualan->barangPenjualan()->get() as $key => $jual) {
                    $jual->barang_id = $r_barang[$key];
                    $jual->harga_jual = $request->qty[$key] * Barang::find($r_barang[$key])->harga_jual;
                    $jual->status_id = 1;
                    $jual->save();
                }
                while ($key < count($r_barang)) {
                    $barang = new BarangPenjualan;
                    $barang->barang_id = $r_barang[$key];
                    $barang->harga_jual = $request->qty[$key] * Barang::find($r_barang[$key])->harga_jual;
                    $barang->status_id = 1;
                    $penjualan->barangPenjualan()->save($barang);
                    $key++;
                }
            } else {
                $barang_penjualan = $penjualan->barangPenjualan()->get();
                foreach ($r_barang as $key => $req) {
                    $barang_penjualan[$key]->barang_id = $req;
                    $barang_penjualan[$key]->harga_jual = $request->qty[$key] * Barang::find($r_barang[$key])->harga_jual;
                    $barang_penjualan[$key]->status_id = 1;
                    $barang_penjualan[$key]->save();
                }
                while ($key < count($barang_penjualan)) {
                    $barang_penjualan[$key]->delete();
                    $key++;
                }
            }
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
        $barang = $penjualan->barangPenjualan()->where('barang_id', $barang_id)->first();
        $barang->status_id = $value;
        $barang->save();
    }
}

<?php

namespace App\Http\Controllers;

use App\Penjualan;
use App\Pelanggan;
use App\Sales;
use App\Barang;
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
        $data['page'] = 'data_penjualan';

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
        if (count(Penjualan::get()) == 0) {
            $data['new_id'] = 1;
        } else {
            $data['new_id'] = end(Penjualan::get())[0]->id + 1;
        }
        $data['pelanggans'] = Pelanggan::get();
        $data['saleses'] = Sales::get();
        $data['barangs'] = Barang::get();
        
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
        //
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
        //
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
}

<?php

namespace App\Http\Controllers;

use App\StokBarang;
use App\Barang;
use App\Lokasi;
use App\SubLokasi;
use Illuminate\Http\Request;

class StokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = 'stok';
        $data['title'] = 'Stok';
        $data['sub_title'] = 'Data';
        $data['sub_link'] = '/stok-barang';

        return view('stok.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['barangs'] = Barang::get();
        $data['lokasis'] = Lokasi::get();
        $data['sub_lokasis'] = SubLokasi::get();
        return view('stok.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = StokBarang::firstOrNew(['barang_id' => $request->barang_id, 'lokasi_id' => $request->lokasi_id, 'sub_lokasi_id' => $request->sub_lokasi_id]);
        $data->barang_id = $request->barang_id;
        $data->lokasi_id = $request->lokasi_id;
        $data->sub_lokasi_id = $request->sub_lokasi_id;
        $data->ketersediaan += $request->jumlah;
        $data->save();

        return redirect('stok-barang/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function show(StokBarang $stokBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(StokBarang $stokBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StokBarang $stokBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(StokBarang $stokBarang)
    {
        //
    }
}

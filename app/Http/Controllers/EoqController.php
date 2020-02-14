<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\Barang;

class EoqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = 'eoq';
        $data['title'] = 'EOQ';
        $data['sub_title'] = 'kalkulasi';
        $data['sub_link'] = 'eoq';
        return view('eoq.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getData($tanggal1, $tanggal2)
    {
        $data = Penjualan::whereBetween('created_at', [date($tanggal1), date($tanggal2)])->get();
        $totalunits = Barang::get();
        foreach ($totalunits as $key => $total) {
            $total->unit_terjual = 0;
        }
        foreach ($data as $key => $value) {
            foreach ($value->barangPenjualan()->get() as $key => $bp) {
                $jml = $bp->harga_jual / $bp->barang()->first()->harga_jual;
                foreach ($totalunits as $key => $total) {
                    if ($bp->barang_id == $total->id) {
                        $total->unit_terjual += $jml;
                        break;
                    }
                }
            }
        }
        foreach ($totalunits as $key => $total) {
            if ($total->unit_terjual > 0) {
                $total->eoq = sqrt(2 * $total->unit_terjual * ($total->harga_jual / 10) / ($total->harga_jual * 15/100));
            }
            else {
                $total->eoq = 0;
            }
        }

        return $totalunits;
    }
}


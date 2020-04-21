<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\Status;
use Auth;

class HistPenjualanController extends Controller
{
    public function index()
    {
        if(!Auth::check()) {
            return redirect('/login');
        }
        $data['penjualans'] = Penjualan::orderBy('created_at', 'desc')->get();
        foreach ($data['penjualans'] as $key => $penjualan) {
            $penjualan->barangs = $penjualan->barangPenjualan()->get();
            foreach ($penjualan->barangs as $key => $barang) {
                $temp = $barang->barang()->first();
                $barang->nama = $temp->nama;
                $barang->harga = $temp->harga_jual;
                $barang->qty = $barang->harga_jual / $temp->harga_jual;
            }
        }
        $total = 0;
        $data['penjualans2'] = Penjualan::get();
        foreach ($data['penjualans2'] as $key => $p) {
            foreach ($p->barangPenjualan()->get() as $key => $bp) {
                if ($bp->status_id == 2) {
                    $total += $bp->harga_jual;
                }
            }
        }
        $data['total'] = $total;
        $data['statuses'] = Status::get();
        $data['page'] = 'history_penjualan';
        $data['title'] = 'penjualan';
        $data['sub_title'] = 'History';
        $data['sub_link'] = '/history-penjualan';

        return view('h_penjualan', $data);
    }
    public function getData($tgl1, $tgl2)
    {
        $data['penjualans'] = Penjualan::whereBetween('created_at', [$tgl1, $tgl2])->orderBy('created_at', 'desc')->get();
        $total = 0;
        foreach ($data['penjualans'] as $key => $p) {
            $p->temp = 0;
            $p->barangs = $p->barangPenjualan()->get();
            $p->tanggal = date('d-m-Y', strtotime($p->created_at));
            $p->tanggal2 = date('d-m-Y', strtotime($p->created_at));
            $p->nama_pelanggan = $p->pelanggan()->first()->nama;
            $p->nama_sales = $p->sales()->first()->nama;
            foreach ($p->barangs as $key => $bp) {
                $temp = $bp->barang()->first();
                $bp->nama = $temp->nama;
                $bp->harga = $temp->harga_jual;
                $bp->qty = $bp->harga_jual / $temp->harga_jual;
                if ($bp->status_id == 2) {
                    if ($p->type_diskon == 0) {
                        $diskon = $p->diskon;
                    } else {
                        $diskon = $bp->harga_jual * $p->diskon / 100;
                    }
                    $p->temp += $bp->harga_jual - $diskon;
                    $total += $p->temp;
                }
            }
        }
        $data['penjualans2'] = Penjualan::whereBetween('created_at', [$tgl1, $tgl2])->get();
        $data['total'] = number_format($total, 2, ',', '.');

        return $data;
    }

    public function getPenjualan($id)
    {
        $data = Penjualan::find($id);
        $data->barangs = $data->barangPenjualan()->get();
        foreach ($data->barangs as $key => $bp) {
            $bp->nama = $bp->barang()->first()->nama;
            $bp->qty = intval($bp->harga_jual / $bp->barang()->first()->harga_jual);
            $bp->harga = $bp->barang()->first()->harga_jual;
            $bp->barang_id = $bp->barang()->first()->id;
        }

        return $data;
    }
}

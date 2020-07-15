<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Suplier;
use App\Barang;
use App\BarangPembelian;
use App\Status;
use App\StokBarang;
use App\Lokasi;
use App\SubLokasi;

class HistPembelianController extends Controller
{
    public function index()
    {
        $data['pembelians'] = Pembelian::where('status_id', 2)->orderBy('created_at')->get();
    	$data['pembelians2'] = Pembelian::orderBy('created_at', 'desc')->get();
    	$total = 0;
        foreach ($data['pembelians'] as $key => $pembelian) {
            $pembelian->status = Status::find($pembelian->status_id)->nama;
            $pembelian->barangs = $pembelian->barangPembelian()->get();
            $temptotal = 0;
            foreach ($pembelian->barangs as $key => $barang) {
                $temp = $barang->barang()->first();
                $barang->nama = $temp->nama;
                $barang->harga = $temp->harga;
                $barang->qty = $barang->harga_beli / $temp->harga;
                $temptotal += $barang->harga_beli;
            }
            if ($pembelian->type_diskon_id == 1) {
            	$diskon = $temptotal * $diskon / 100;
            } else {
            	$temptotal -= $pembelian->diskon;
            }
            $total += $temptotal;
        }
        foreach ($data['pembelians2'] as $key => $pembelian) {
            $pembelian->status = Status::find($pembelian->status_id)->nama;
            $pembelian->barangs = $pembelian->barangPembelian()->get();
            $temptotal = 0;
            foreach ($pembelian->barangs as $key => $barang) {
                $temp = $barang->barang()->first();
                $barang->nama = $temp->nama;
                $barang->harga = $temp->harga;
                $barang->qty = $barang->harga_beli / $temp->harga;
                $temptotal += $barang->harga_beli;
            }
            if ($pembelian->type_diskon_id == 1) {
            	$diskon = $temptotal * $diskon / 100;
            } else {
            	$temptotal -= $pembelian->diskon;
            }
            $total += $temptotal;
        }
        $data['total'] = $total;
        $data['statuses'] = Status::get();
        $data['page'] = 'history_pembelian';
        $data['title'] = 'Pembelian';
        $data['sub_title'] = 'History';
        $data['sub_link'] = '/history-pembelian';

        return view('h_pembelian', $data);
    }

    public function getData($tgl1, $tgl2)
    {
        $tgl2 = date('Y-m-d', strtotime('+1 day', strtotime($tgl2)));
        $data['pembelians'] = Pembelian::where('status_id', 2)->whereBetween('created_at', [$tgl1, $tgl2])->orderBy('created_at')->get();
        $total = 0;
        foreach ($data['pembelians'] as $key => $pembelian) {
            $pembelian->status = Status::find($pembelian->status_id)->nama;
            $pembelian->barangs = $pembelian->barangPembelian()->get();
            $pembelian->tanggal = date('d/m/Y', strtotime($pembelian->created_at));
            $pembelian->tanggal2 = date('d-m-Y', strtotime($pembelian->created_at));
            $pembelian->suplier = $pembelian->suplier()->first()->nama;
            if($pembelian->type_diskon_id == 0) {
                if($pembelian->diskon) {
                    $pembelian->diskon_js = "Rp ".$pembelian->diskon;
                }
                else {
                    $pembelian->diskon_js = "Rp 0";
                }
            }
            else {
                $pembelian->diskon_js = $pembelian->diskon."%";
            }
            $pembelian->temp = 0;
            foreach ($pembelian->barangs as $key => $barang) {
                $temp = $barang->barang()->first();
                $barang->nama = $temp->nama;
                $barang->harga = $temp->harga;
                $barang->qty = $barang->harga_beli / $temp->harga;
                $pembelian->temp += $barang->harga_beli;
            }
            if ($pembelian->type_diskon_id == 1) {
            	$diskon = $pembelian->temp * $diskon / 100;
            	$pembelian->temp -= $diskon;
            } else {
            	$pembelian->temp -= $pembelian->diskon;
            }
            $total += $pembelian->temp;
        }
        $data['total'] = number_format($total, 2, ',', '.');
        $data['pembelians2'] = Pembelian::whereBetween('created_at', [$tgl1, $tgl2])->orderBy('created_at', 'desc')->get();
        foreach ($data['pembelians2'] as $key => $pembelian) {
            $pembelian->status = Status::find($pembelian->status_id)->nama;
            $pembelian->barangs = $pembelian->barangPembelian()->get();
            $pembelian->tanggal = date('d/m/Y', strtotime($pembelian->created_at));
            $pembelian->tanggal2 = date('d-m-Y', strtotime($pembelian->created_at));
            $pembelian->suplier = $pembelian->suplier()->first()->nama;
            if($pembelian->type_diskon_id == 0) {
                if($pembelian->diskon) {
                    $pembelian->diskon_js = "Rp ".$pembelian->diskon;
                }
                else {
                    $pembelian->diskon_js = "Rp 0";
                }
            }
            else {
                $pembelian->diskon_js = $pembelian->diskon."%";
            }
            $pembelian->temp = 0;
            foreach ($pembelian->barangs as $key => $barang) {
                $temp = $barang->barang()->first();
                $barang->nama = $temp->nama;
                $barang->harga = $temp->harga;
                $barang->qty = $barang->harga_beli / $temp->harga;
                $pembelian->temp += $barang->harga_beli;
            }
            if ($pembelian->type_diskon_id == 1) {
            	$diskon = $pembelian->temp * $diskon / 100;
            	$pembelian->temp -= $diskon;
            } else {
            	$pembelian->temp -= $pembelian->diskon;
            }
        }

        return $data;
    }
}

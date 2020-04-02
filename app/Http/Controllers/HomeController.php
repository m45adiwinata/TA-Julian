<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Penjualan;
use App\Pembelian;
use App\Sales;
use App\Pelanggan;
use DatePeriod;
use DateTime;
use DateInterval;

class HomeController extends Controller
{
    public function index()
    {
        if(!Auth::check()) {
            return redirect('/login');
        }
        $data['page'] = 'home';
        $data['title'] = 'Dashboard';
        $data['sub_title'] = 'Home';
        $data['sub_link'] = '/';
        $labels = array();
        $jml_penjualan = array();
        for ($i=9; $i < 18; $i++) { 
            $temp = $i;
            $temp2 = $i+1;
            if($temp < 10 && $temp2 < 10) {
                $temp = '0'.$temp;
                $temp2 = '0'.$temp2;
            }
            $total = 0;
            foreach (Penjualan::whereDate('created_at', date('Y-m-d'))->whereTime('created_at', '>=', $temp.':00:00')->whereTime('created_at', '<', $temp2.':00:00')->get() as $key => $value) {
                $bps = $value->barangPenjualan()->where('status_id', 2)->get();
                foreach ($bps as $key => $bp) {
                    $total += $bp->harga_jual;
                }
            }
            array_push($jml_penjualan, intval($total));
        }
        $jml_pembelian = array();
        for ($i=9; $i < 18; $i++) { 
            $temp = $i;
            $temp2 = $i+1;
            if($temp < 10 && $temp2 < 10) {
                $temp = '0'.$temp;
                $temp2 = '0'.$temp2;
            }
            $total = 0;
            foreach (Pembelian::whereDate('created_at', date('Y-m-d'))->whereTime('created_at', '>=', $temp.':00:00')->whereTime('created_at', '<', $temp2.':00:00')->where('status_id', 2)->get() as $key => $value) {
                $bps = $value->barangPembelian()->get();
                foreach ($bps as $key => $bp) {
                    $total += $bp->harga_beli;
                }
            }
            array_push($jml_pembelian, intval($total));
            array_push($labels, "Jam:".$i);
        }
        $data['jml_penjualan'] = $jml_penjualan;
        $data['jml_pembelian'] = $jml_pembelian;
        $data['labels'] = $labels;
        $sales = Sales::get();
        $pelanggans = Pelanggan::get();
        foreach (Penjualan::get() as $key => $p) {
            $total = 0;
            foreach ($p->barangPenjualan()->get() as $key => $bp) {
                $total += $bp->harga_jual;
            }
            foreach ($sales as $key => $s) {
                if ($p->sales_id == $s->id) {
                    $s->jml_penjualan +=intval($total);
                }
            }
            foreach ($pelanggans as $key => $pelanggan) {
                if ($pelanggan->id == $p->pelanggan_id) {
                    $pelanggan->total_beli += intval($total);
                }
            }
        }
        $pelanggans = usort($pelanggans, function($a, $b) {
            return strcmp($a->total_beli, $b->total_beli);
        });
        dd($pelanggans[0]);
        $data['sales'] = $sales;

        return view('home', $data);
    }

    public function getPenjualanPembelian1Hari($date) {
        $labels = array();
        $jml_penjualan = array();
        for ($i=9; $i < 18; $i++) { 
            $temp = $i;
            $temp2 = $i+1;
            if($temp < 10 && $temp2 < 10) {
                $temp = '0'.$temp;
                $temp2 = '0'.$temp2;
            }
            $total = 0;
            foreach (Penjualan::whereDate('created_at', date('Y-m-d', strtotime($date)))->whereTime('created_at', '>=', $temp.':00:00')->whereTime('created_at', '<', $temp2.':00:00')->get() as $key => $value) {
                $bps = $value->barangPenjualan()->where('status_id', 2)->get();
                foreach ($bps as $key => $bp) {
                    $total += $bp->harga_jual;
                }
            }
            array_push($jml_penjualan, intval($total));
        }
        $jml_pembelian = array();
        for ($i=9; $i < 18; $i++) { 
            $temp = $i;
            $temp2 = $i+1;
            if($temp < 10 && $temp2 < 10) {
                $temp = '0'.$temp;
                $temp2 = '0'.$temp2;
            }
            $total = 0;
            foreach (Pembelian::whereDate('created_at', date('Y-m-d', strtotime($date)))->whereTime('created_at', '>=', $temp.':00:00')->whereTime('created_at', '<', $temp2.':00:00')->where('status_id', 2)->get() as $key => $value) {
                $bps = $value->barangPembelian()->get();
                foreach ($bps as $key => $bp) {
                    $total += $bp->harga_beli;
                }
            }
            array_push($jml_pembelian, intval($total));
            array_push($labels, "Jam:".$i);
        }
        $data['jml_penjualan'] = $jml_penjualan;
        $data['jml_pembelian'] = $jml_pembelian;
        $data['labels'] = $labels;

        return $data;
    }

    public function getPenjualanPembelianNHari($start, $end)
    {
        $period = new DatePeriod(
            new DateTime($start),
            new DateInterval('P1D'),
            new DateTime($end)
        );
        $labels = array();
        $jml_penjualan = array();
        foreach($period as $p) { 
            $total = 0;
            foreach (Penjualan::whereDate('created_at', $p)->get() as $key => $value) {
                $bps = $value->barangPenjualan()->where('status_id', 2)->get();
                foreach ($bps as $key => $bp) {
                    $total += $bp->harga_jual;
                }
            }
            array_push($jml_penjualan, intval($total));
        }
        $jml_pembelian = array();
        foreach($period as $p) { 
            $total = 0;
            foreach (Pembelian::whereDate('created_at', $p)->get() as $key => $value) {
                $bps = $value->barangPembelian()->get();
                foreach ($bps as $key => $bp) {
                    $total += $bp->harga_beli;
                }
            }
            array_push($jml_pembelian, intval($total));
            array_push($labels, $p->format('Y-m-d'));
        }
        $data['jml_penjualan'] = $jml_penjualan;
        $data['jml_pembelian'] = $jml_pembelian;
        $data['labels'] = $labels;

        return $data;
    }

    public function getPenjualanPembelianLifetime()
    {
        $temp = Pembelian::first()->created_at;
        $temp2 = Penjualan::first()->created_at;
        $temp < $temp2 ? $start = date('Y-m-d', strtotime($temp)) : $start = date('Y-m-d', strtotime($temp2));
        $temp = Pembelian::orderBy('created_at', 'desc')->first()->created_at;
        $temp2 = Penjualan::orderBy('created_at', 'desc')->first()->created_at;
        $temp > $temp2 ? $end = date('Y-m-d', strtotime($temp)) : $end = date('Y-m-d', strtotime($temp2));
        $period = new DatePeriod(
            new DateTime($start),
            new DateInterval('P1D'),
            new DateTime($end)
        );
        $labels = array();
        $jml_penjualan = array();
        foreach($period as $p) { 
            $total = 0;
            foreach (Penjualan::whereDate('created_at', $p)->get() as $key => $value) {
                $bps = $value->barangPenjualan()->where('status_id', 2)->get();
                foreach ($bps as $key => $bp) {
                    $total += $bp->harga_jual;
                }
            }
            array_push($jml_penjualan, intval($total));
        }
        $jml_pembelian = array();
        foreach($period as $p) { 
            $total = 0;
            foreach (Pembelian::whereDate('created_at', $p)->get() as $key => $value) {
                $bps = $value->barangPembelian()->get();
                foreach ($bps as $key => $bp) {
                    $total += $bp->harga_beli;
                }
            }
            array_push($jml_pembelian, intval($total));
            array_push($labels, $p->format('Y-m-d'));
        }
        $data['jml_penjualan'] = $jml_penjualan;
        $data['jml_pembelian'] = $jml_pembelian;
        $data['labels'] = $labels;

        return $data;
    }
}

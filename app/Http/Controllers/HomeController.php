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
        foreach ($sales as $key => $s) {
            $s->total_jual = 0;
            foreach ($s->penjualan()->get() as $key => $p) {
                $total = 0;
                foreach ($p->barangPenjualan()->get() as $key => $bp) {
                    $total += $bp->harga_jual;
                }
                if ($p->type_diskon == 0) {
                    $diskon = $p->diskon;
                } else {
                    $diskon = $total * $p->diskon / 100;
                }
                $total -= $diskon;
                $s->total_jual += $total;
            }
        }
        // for ($i=0; $i < count($sales); $i++) { 
        //     for ($j=$i+1; $j < count($sales); $j++) { 
        //         if ($sales[$j]->total_jual > $sales[$i]->total_jual) {
        //             $temp = $sales[$i];
        //             $sales[$i] = $sales[$j];
        //             $sales[$j] = $temp;
        //         }
        //     }
        // }
        $pelanggans = Pelanggan::get();
        foreach ($pelanggans as $key => $pelanggan) {
            $pelanggan->total_beli = 0;
            foreach ($pelanggan->penjualan()->get() as $key => $penjualan) {
                foreach ($penjualan->barangPenjualan()->get() as $key => $bp) {
                    $pelanggan->total_beli += $bp->harga_jual;
                }
            }
        }
        for ($i=0; $i < count($pelanggans); $i++) { 
            for ($j=$i+1; $j < count($pelanggans); $j++) { 
                if($pelanggans[$j]->total_beli > $pelanggans[$i]->total_beli) {
                    $temp = $pelanggans[$i];
                    $pelanggans[$i] = $pelanggans[$j];
                    $pelanggans[$j] = $temp;
                }
            }
        }
        $pelanggans = $pelanggans->take(10);
        foreach ($pelanggans as $key => $pelanggan) {
            $total_belanja_perhari = array();
            $labels = array();
            $period = new DatePeriod(
                new DateTime($pelanggan->penjualan()->first()->created_at),
                new DateInterval('P1D'),
                new DateTime($pelanggan->penjualan()->orderBy('created_at', 'desc')->first()->created_at)
            );
            foreach ($period as $key => $p) {
                $total = 0;
                foreach ($pelanggan->penjualan()->whereDate('created_at', $p)->get() as $key => $penjualan) {
                    foreach ($penjualan->barangPenjualan()->get() as $key => $bp) {
                        $total += intval($bp->harga_jual);
                    }
                }
                array_push($total_belanja_perhari, $total);
                array_push($labels, $p->format('Y-m-d'));
            }
            $pelanggan->total_belanja_perhari = $total_belanja_perhari;
            $pelanggan->label_perhari = $labels;
        }
        $data['sales'] = $sales;
        $data['pelanggans'] = $pelanggans;

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

    public function getPenjualanSalesNHari($start, $end)
    {
        $sales = Sales::get();
        foreach ($sales as $key => $s) {
            $sales->total_jual = 0;
            foreach ($s->penjualan()->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get() as $key => $p) {
                $total = 0;
                foreach ($p->barangPenjualan()->get() as $key => $bp) {
                    $total += $bp->harga_jual;
                }
                if ($p->type_diskon == 0) {
                    $diskon = $p->diskon;
                } else {
                    $diskon = $total * $p->diskon / 100;
                }
                $total -= $diskon;
                $s->total_jual += $total;
            }
        }
        
        return $sales;
    }

    public function getRankPelangganNHari($start, $end)
    {
        $end = DateTime::createFromFormat('Y-m-d', $end)->modify('+1 days')->format('Y-m-d');
        $period = new DatePeriod(
            new DateTime($start),
            new DateInterval('P1D'),
            new DateTime($end)
        );
        $pelanggans = Pelanggan::get();
        foreach ($pelanggans as $key => $pl) {
            $pl->total_beli = 0;
            foreach ($pl->penjualan()->whereDate('created_at', '>=', $start)->whereDate('created_at', '<', $end)->get() as $key => $p) {
                $total = 0;
                foreach ($p->barangPenjualan()->get() as $key => $bp) {
                    $temp = $bp->harga_jual;
                    if ($p->type_diskon == 0) {
                        $temp -= $p->diskon;
                    } else {
                        $temp -= $p->diskon * $temp / 100;
                    }
                    $total += $temp;
                }
                $pl->total_beli += $total;
            }
        }
        for ($i=0; $i < count($pelanggans); $i++) { 
            for ($j=$i+1; $j < count($pelanggans); $j++) { 
                if ($pelanggans[$j]->total_beli > $pelanggans[$i]->total_beli) {
                    $temp = $pelanggans[$i];
                    $pelanggans[$i] = $pelanggans[$j];
                    $pelanggans[$j] = $temp;
                }
            }
        }
        $pelanggans = $pelanggans->take(10);
        foreach ($pelanggans as $key => $pl) {
            $pl->total_beli_str = number_format($pl->total_beli, 2, ',', '.');
        }
        foreach ($pelanggans as $key => $pelanggan) {
            $total_belanja_perhari = array();
            $labels = array();
            foreach ($period as $key => $p) {
                $total = 0;
                foreach ($pelanggan->penjualan()->whereDate('created_at', $p)->get() as $key => $penjualan) {
                    foreach ($penjualan->barangPenjualan()->get() as $key => $bp) {
                        $total += intval($bp->harga_jual);
                    }
                }
                array_push($total_belanja_perhari, $total);
                array_push($labels, $p->format('Y-m-d'));
            }
            $pelanggan->total_belanja_perhari = $total_belanja_perhari;
            $pelanggan->label_perhari = $labels;
        }
        
        return $pelanggans;
    }
}

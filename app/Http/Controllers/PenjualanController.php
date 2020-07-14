<?php

namespace App\Http\Controllers;

use App\Penjualan;
use App\Pelanggan;
use App\Sales;
use App\Barang;
use App\BarangPenjualan;
use App\Status;
use App\SubLokasi;
use App\BarangTerpecah;
use Auth;
use Illuminate\Http\Request;
use PDF;
use DateTime;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Makassar');
        if(!Auth::check()) {
            return redirect('/login');
        }
        // setcookie("per_page", "", time() - 3600);
        // dd($_COOKIE);
        if ($request->query('per_page')) {
            $data['penjualans'] = Penjualan::paginate($request->query('per_page'));
            setcookie("per_page", $request->query('per_page'));
            $data['per_page'] = $request->query('per_page');
        }
        else if (count($_COOKIE) <= 4) {
            setcookie("per_page", 10);
            $data['penjualans'] = Penjualan::paginate(10);
            $data['per_page'] = 10;
        }
        else {
            $data['penjualans'] = Penjualan::paginate($_COOKIE['per_page']);
            $data['per_page'] = $_COOKIE['per_page'];
        }
        $data['penjualans2'] = $data['penjualans']->items();
        foreach ($data['penjualans2'] as $key => $penjualan) {
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
        $data['l_page'] = intval(count(Penjualan::get()) / 10) + 1;

        return view('penjualan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        date_default_timezone_set('Asia/Makassar');
        if(!Auth::check()) {
            return redirect('/login');
        }
        $data['page'] = 'buat_penjualan';
        $penjualans = Penjualan::get();
        if (count(Penjualan::get()) == 0) {
            $data['new_id'] = 1;
        } else {
            $data['new_id'] = Penjualan::orderBy('created_at', 'desc')->first()->id + 1;
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
            'sales_id' => 'required',
            'date' => 'required',
            'time' => 'required'
        ]);
        date_default_timezone_set('Asia/Makassar');
        $dt = new DateTime;
        // dd($request);
        // echo(date('Y-m-d H:i:s')."<br>");
        // echo($dt->format($request->created_at." ".date('H:i:s')));
        // dd($dt->format($request->created_at." ".date('H:i:s')));
        $data = new Penjualan;
        // $data->created_at = $dt->format($request->created_at." ".date('H:i:s'));
        $data->created_at = $dt->format($request->date." ".$request->time.":00");
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
        date_default_timezone_set('Asia/Makassar');
        if(!Auth::check()) {
            return redirect('/login');
        }
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
        date_default_timezone_set('Asia/Makassar');
        foreach ($penjualan->barangPenjualan()->get() as $key => $jual) {
            if ($jual->status_id == 2) {
                $barang = $jual->barang()->first();
                $stoks = $barang->stok()->get();
                $jumlah_barang = $jual->harga_jual / $barang->harga_jual;
                if ($barang->satuan_id == 1) {
                    #barang kembali dengan aturan kapasitas sub lokasi
                    foreach ($stoks as $key => $stok) {
                        $sub_lokasi = $stok->subLokasi()->first();
                        $sisa_kapasitas = $sub_lokasi->kapasitas - $stok->ketersediaan;
                        // foreach ($sub_lokasi->stok()->where('satuan_id', 1)->get() as $key => $value) {
                        //     $sisa_kapasitas -= $value->ketersediaan;
                        // }
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
        $dt = new DateTime;
        $penjualan->barangPenjualan()->delete();
        $penjualan->pelanggan_id = $request->pelanggan_id;
        $penjualan->sales_id = $request->sales_id;
        $penjualan->diskon = $request->diskon;
        $penjualan->type_diskon = $request->type_diskon;
        $penjualan->created_at = $dt->format($request->date." ".$request->time.":00");
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

    public function getNota($id)
    {
        $penjualan = Penjualan::find($id);
        $bulan = ['','Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $penjualan->tanggal_str = date('j', strtotime($penjualan->created_at)).' '.$bulan[date('n', strtotime($penjualan->created_at))].' '.date('Y', strtotime($penjualan->created_at));
        $data['penjualan'] = $penjualan;

        $pdf = PDF::loadView('penjualan.nota', $data);
        return $pdf->stream();
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

    public function lihatBarang($id)
    {
        $barangs = Penjualan::find($id)->barangPenjualan()->get();
        $datas = [];
        foreach($barangs as $barang) {
            array_push($datas, array(
                "barang_id" => $barang->barang_id,
                "nama" => $barang->barang()->first()->nama,
                "qty" => $barang->harga_jual / $barang->barang()->first()->harga_jual,
                "harga" => $barang->barang()->first()->harga_jual,
                "harga_jual" => $barang->harga_jual
            ));
        }
        return $datas;
    }

    public function setStatusBarangPenjualan($id, $barang_id, $value)
    {
        $penjualan = Penjualan::find($id);
        $bp = $penjualan->barangPenjualan()->where('barang_id', $barang_id)->first();
        $barang = $bp->barang()->first();
        if ($value == 2) {
            if ($bp->status_id != 2) {
                $jumlah = intval($bp->harga_jual / $barang->harga_jual);
                $jml_tersedia = 0;
                foreach ($barang->stok()->get() as $key => $stok) {
                    $jml_tersedia += $stok->ketersediaan;
                }
                if ($barang->satuan_id == 3) {
                    $stok_barang = $barang->stok()->first();
                    $parent_barang = $barang->parent()->first();
                    foreach ($parent_barang->stok()->get() as $key => $stok_parent) {
                        $jml_tersedia += $parent_barang->jumlah_unit * $stok_parent->ketersediaan;
                    }
                }
                if ($jml_tersedia >= $jumlah) {
                    foreach ($barang->stok()->get() as $key => $stok) {
                        if ($stok->ketersediaan >= $jumlah) {
                            $stok->ketersediaan -= $jumlah;
                            $stok->save();
                            $jumlah = 0;
                            break;
                        } else {
                            $jumlah -= $stok->ketersediaan;
                            $stok->ketersediaan = 0;
                            $stok->save();
                        }
                    }
                    if ($jumlah > 0) {
                        if ($barang->satuan_id == 3) {
                            $stok_barang = $barang->stok()->first();
                            $parent_barang = $barang->parent()->first();
                            $jml_dibutuhkan = ceil($jumlah / $parent_barang->jumlah_unit);
                            $bt = new BarangTerpecah;
                            $bt->penjualan_id = $id;
                            $bt->barang_id = $barang_id;
                            $bt->jml_terpecah = $jml_dibutuhkan;
                            $bt->save();
                            foreach ($parent_barang->stok()->get() as $key => $stok_parent) {
                                if ($stok_parent->ketersediaan >= $jml_dibutuhkan) {
                                    $stok_parent->ketersediaan -= $jml_dibutuhkan;
                                    $stok_parent->save();
                                    $stok_barang->ketersediaan += $parent_barang->jumlah_unit * $jml_dibutuhkan - $jumlah;
                                    $stok_barang->save();
                                    $jml_dibutuhkan = 0;
                                    break;
                                }
                                else {
                                    $jml_dibutuhkan -= $stok_parent->ketersediaan;
                                    $stok_parent->ketersediaan = 0;
                                    $stok_parent->save();
                                    $stok_barang->ketersediaan += $parent_barang->jumlah_unit * $stok_parent->ketersediaan;
                                    $stok_barang->save();
                                }
                            }
                        }
                    }
                    $bp->status_id = $value;
                    $bp->save();
                    return 1;
                } else {
                    return "gagal, tidak ada stok";
                }
            }
            else {
                return 1;
            }
        }
        else {
            if ($bp->status_id == 2) {
                $jml_kembali = $bp->harga_jual / $barang->harga_jual;
                if ($barang->satuan_id == 1) {
                    foreach ($barang->stok()->get() as $key => $stok) {
                        $sub_lokasi = $stok->subLokasi()->first();
                        $sisa_kapasitas = $sub_lokasi->kapasitas;
                        foreach ($sub_lokasi->stok()->get() as $key => $val) {
                            if ($val->barang()->first()->satuan_id == 1) {
                                $sisa_kapasitas -= $val->ketersediaan;
                            }
                        }
                        if ($sisa_kapasitas >= $jml_kembali) {
                            break;
                        }
                    }
                } else {
                    $stok = $barang->stok()->first();
                }
                $stok->ketersediaan += $jml_kembali;
                $stok->save();
            }
            $bp->status_id = $value;
            $bp->save();
            return 1;
        }
    }
}

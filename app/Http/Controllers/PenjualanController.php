<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Repositories\PemesananRepository;
use App\Repositories\PupukRepository;

class PenjualanController extends Controller
{
    public function __construct()
    {
        $this->pemesananRepository = new PemesananRepository;
        $this->pupukRepository = new PupukRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanan = $this->pemesananRepository::all();
        return view('penjualan.index',compact('pemesanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pupuk = $this->pupukRepository::all();
        return view('penjualan.tambah', compact('pupuk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        foreach ($input['jumlah'] as $key => $value) {
          $this->pemesananRepository->create($input);
        }
        $msg = "Saya hendak membeli : ";
        foreach ($input['jumlah'] as $key => $value) {
          $pupuk = $this->pupukRepository->find($input['id_pupuk']);
          $msg .= '#enter# *'.$pupuk->nama.'* sebanyak '.$input['jumlah'][$key].'#enter# ';
        }
        $msg .= 'Alamat Pengiriman: '.$input['alamat'];
        $msg = urlencode($msg);
        $msg = str_replace("%23enter%23","%0A", $msg);
        if(Auth::user()->level == 'admin'){
          return redirect()->route('penjualan.index')->with('success', 'Pesanan berhasil ditambahkan');
        }else{
          Session::flash('success', 'Pesanan berhasil ditambahkan');
          return redirect()->route('pesanan.index')->with('msg', $msg);
        }
    }

    public function setstatus($id, $status){
        $pesanan = $this->pemesananRepository->find($id);
        if( $status == "belumbayar"){
            $status = 'belum bayar';
        }
        $this->pemesananRepository->update(['status' => $status], $id);
        return redirect()->route('penjualan.index')->with('success', 'Status pesanan berhasil diperbarui');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( $this->pemesananRepository->delete($id) != 0 ){
            return redirect()->route('pupuk.index')->with('success', 'Pesanan berhasil dihapus');
        }
        return redirect()->route('pupuk.index')->with('error', 'Gagal menghapus pesanan/ pesanan tidak ditemukan.');        
    }
}

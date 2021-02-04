<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PemesananRepository;
use App\Repositories\PupukRepository;

class PesananController extends Controller
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
        $pemesanan = $this->pemesananRepository->getPesananUser('lunas', '!=');
        return view('pesanan.index',compact('pemesanan'));
    }
    public function riwayatPesan()
    {
        $pemesanan = $this->pemesananRepository->getPesananUser('lunas');
        return view('pesanan.riwayatpesan',compact('pemesanan'));
    }
}

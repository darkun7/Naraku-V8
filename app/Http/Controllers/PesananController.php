<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PemesananRepository;
use App\Repositories\SettingRepository;

class PesananController extends Controller
{
    public function __construct()
    {
        $this->settingRepository = new SettingRepository;
        $this->pemesananRepository = new PemesananRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $web = $this->settingRepository->find(1);
        $pemesanan = $this->pemesananRepository->getPesananUser('lunas', '!=');
        return view('pesanan.index',compact('pemesanan', 'web'));
    }
    public function riwayatPesan()
    {
        $web = $this->settingRepository->find(1);
        $pemesanan = $this->pemesananRepository->getPesananUser('lunas');
        return view('pesanan.riwayatpesan',compact('pemesanan', 'web'));
    }
}

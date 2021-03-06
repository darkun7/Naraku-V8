<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PemesananRepository;
use App\Repositories\PupukRepository;
use Carbon\Carbon;

class HomeController extends Controller
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
        $pemesanan = $this->pemesananRepository->all();
        // $pesanan_selesai = $this->pemesananRepository::where('status', '=', 'selesai')->whereDate('created_at', '>', Carbon::today()->subDays(30)->toDateString())->get();
        $allpemesanan = count($pemesanan);
        $finishpesanan = 0;
        return view('dasbor.index', compact('pemesanan', 'allpemesanan', 'finishpesanan'));
    }

    public function tentang()
    {
        $web = \App\Models\Setting::findOrFail(0);
        return view('front.tentang',compact('web'));
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
}

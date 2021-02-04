<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SettingRepository;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->settingRepository = new SettingRepository;
    }
    
    public function website()
    {
        $web = $this->settingRepository->find(1);
        return view('setting.website',compact('web'));
    }

    public function jumbotron()
    {
        $web = $this->settingRepository->find(1);
        return view('setting.jumbotron',compact('web'));
    }

    public function kontak()
    {
        $web = $this->settingRepository->find(1);
        return view('setting.kontak',compact('web'));
    }

    public function maps()
    {
        $web = $this->settingRepository->find(1);
        return view('setting.maps',compact('web'));
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
        $web = $this->settingRepository->find(1);
        $web->update($input);
        return redirect()->route('home')->with('success', 'Pengaturan website berhasil disimpan');
    }
}

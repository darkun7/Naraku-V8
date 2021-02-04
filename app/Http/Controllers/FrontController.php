<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SettingRepository;
use App\Repositories\PupukRepository;

class FrontController extends Controller
{
    public function __construct()
    {
        $this->settingRepository = new SettingRepository;
        $this->pupukRepository = new PupukRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function landing()
    {

        $web = $this->settingRepository->find(1);
        $pupuk = $this->pupukRepository->all();
        return view('front.home', compact('web', 'pupuk'));
        // return view('front.home',compact('web', 'pupuk'));
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
}

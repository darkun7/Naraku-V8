<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PenggunaRepository;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->penggunaRepository = new PenggunaRepository;
        // $this->pupukRepository = new PupukRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->penggunaRepository->authUser();
        return view('profil.index',compact('user'));
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $user = $this->penggunaRepository->authUser();
        $oldpass = $input['old_password'];
        if(Hash::check($oldpass, $user->password)){
          unset( $input['old_password'] );
          if(isset($input['password'])){
            $input['password'] = Hash::make($input['password']);
          }
          $user->update($input);
          return redirect()->route('profil')->with('success', 'Profil berhasil disimpan');
        }else{
          return redirect()->route('profil')->with('error', 'Kata Sandi konfirmasi tidak sesuai');
        }
    }

}

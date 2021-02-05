<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PupukRepository;
use App\Repositories\KomposisiRepository;
use App\Repositories\BahanRepository;

class PupukController extends Controller
{
    public function __construct()
    {
        $this->pupukRepository = new PupukRepository;
        $this->komposisiRepository = new KomposisiRepository;
        $this->bahanRepository = new BahanRepository;
    }
    public function index()
    {
        $pupuk = $this->pupukRepository->all();
        return view('pupuk.index', compact('pupuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bahan = $this->bahanRepository->all();
        return view('pupuk.tambah', compact('bahan'));
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
        $input['id_bahan'] = array_unique($input['id_bahan']);
        if(count($input['id_bahan']) != count($input['rasio'])){
            return redirect()->route('pupuk.index')->with('error', 'Terdapat duplikat komposisi');
        }
        // dd($request);
          // return redirect()->route('bahan.create')->with('error', 'Harap melengkapi form isian');
          if ($request->hasFile('gambar')) {
              $uploadFile = $request->file('gambar');
              $destinationPath = 'uploads/pupuk/';// upload path
              $fileName = date('YmdHis'). '-' . Str::random(25) . "_pupuk.".$uploadFile->getClientOriginalExtension();
              $uploadFile->move($destinationPath, $fileName);
              $fileName = $destinationPath.$fileName;
          }else{
              $fileName = 'assets/images/tumbnail_pupuk.png';
          }
          $input['gambar'] = $fileName;

          $pupuk = $this->pupukRepository->create($input);

          foreach ($input['rasio'] as $key => $value) {
            $this->komposisiRepository->create([
              'id_pupuk' => $pupuk->id,
              'id_bahan' => $input['id_bahan'][$key],
              'rasio' => $input['rasio'][$key]
            ]);
          }
          return redirect()->route('pupuk.index')->with('success', 'Pupuk berhasil ditambahkan');          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pupuk = $this->pupukRepository->find($id);
        $bahan = $this->bahanRepository->all();
        return view('pupuk.show', compact('bahan', 'pupuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pupuk = $this->pupukRepository->find($id);
        $bahan = $this->bahanRepository->all();
        return view('pupuk.edit', compact('bahan', 'pupuk'));
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
        $input = $request->all();
        $input['id_bahan'] = array_unique($input['id_bahan']);
        if(count($input['id_bahan']) != count($input['rasio'])){
            return redirect()->route('pupuk.index')->with('error', 'Terdapat duplikat komposisi');
        }
        $pupuk = $this->pupukRepository->find($id);
        $fileName = $pupuk->gambar;
        if ($request->hasFile('gambar')) {
            $uploadFile = $request->file('gambar');
            $destinationPath = 'uploads/pupuk/';// upload path
            $fileName = date('YmdHis'). '-' . Str::random(25) . "_pupuk.".$uploadFile->getClientOriginalExtension();
            $uploadFile->move($destinationPath, $fileName);
            $fileName = $destinationPath.$fileName;
        }

        $this->pupukRepository->update([
          'nama'      => $input['nama'],
          'deskripsi' => $input['deskripsi'],
          'jumlah'    => $input['jumlah'],
          'harga'     => $input['harga'],
          'gambar'    => $fileName
        ],$id);

        foreach ($input['rasio'] as $key => $value) {
          $komposisi = $this->komposisiRepository->update([
            'id_pupuk' => $id,
            'id_bahan' => $input['id_bahan'][$key],
            'rasio' => $input['rasio'][$key]
          ],$input['id'][$key]);
        }

        return redirect()->route('pupuk.index')->with('success', 'Pupuk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
       if($this->pupukRepository->delete($id) == 0){
           redirect()->route('pupuk.index')->with('error', 'Gagal menghapus pupuk/ pupuk tidak ditemukan.');
       }
       return redirect()->route('pupuk.index')->with('success', 'Pupuk berhasil dihapus');
     }
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function arsip()
     {
         $pupuk = $this->pupukRepository->arsip();
         return view('pupuk.arsip', compact('pupuk'));
     }
     public function revert($id)
     {
       $pupuk = $this->pupukRepository->find($id);
       if($pupuk->get()->isEmpty()){
           redirect()->route('pupuk.index')->with('error', 'Gagal mengembalikan pupuk/ arsip pupuk tidak ditemukan.');
       }
       $this->pupukRepository->update([
         'deleted_at'    => null
       ],$id);
       return redirect()->route('pupuk.arsip')->with('success', 'Pupuk berhasil dikembalikan ke daftar produk');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}

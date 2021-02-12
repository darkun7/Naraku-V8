<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use App\Repositories\PupukRepository;
use App\Repositories\KomposisiRepository;
use App\Repositories\BahanRepository;
use App\Http\Requests\PupukRequest;

class PupukController extends Controller
{
    public function __construct()
    {
        $this->pupukRepository = new PupukRepository;
        $this->komposisiRepository = new KomposisiRepository;
        $this->bahanRepository = new BahanRepository;
        $this->storageHelper = new StorageHelper;
    }

    public function index()
    {
        $pupuk = $this->pupukRepository->all();
        return view('pupuk.index', compact('pupuk'));
    }

    public function create()
    {
        $bahan = $this->bahanRepository->all();
        return view('pupuk.tambah', compact('bahan'));
    }

    public function store(PupukRequest $request)
    {
      $input = $request->all();
      $input['id_bahan'] = array_unique($input['id_bahan']);
      if(count($input['id_bahan']) != count($input['rasio'])){
          return redirect()->route('pupuk.index')->with('error', 'Terdapat duplikat komposisi');
      }
      $input['gambar'] = $this->storageHelper->uploadGambar($request, "pupuk");
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

    public function show($id)
    {
        $pupuk = $this->pupukRepository->find($id);
        $bahan = $this->bahanRepository->all();
        return view('pupuk.show', compact('bahan', 'pupuk'));
    }

    public function edit($id)
    {
        $pupuk = $this->pupukRepository->find($id);
        $bahan = $this->bahanRepository->all();
        return view('pupuk.edit', compact('bahan', 'pupuk'));
    }

    public function update(PupukRequest $request, $id)
    {
      
        $input = $request->all();
        $input['id_bahan'] = array_unique($input['id_bahan']);
        if(count($input['id_bahan']) != count($input['rasio'])){
            return redirect()->route('pupuk.index')->with('error', 'Terdapat duplikat komposisi');
        }
        $gambar = $this->storageHelper->uploadGambar($request, "pupuk");
        
        $this->pupukRepository->update([
          'nama'      => $input['nama'],
          'deskripsi' => $input['deskripsi'],
          'jumlah'    => $input['jumlah'],
          'harga'     => $input['harga'],
          'gambar'    => $gambar
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

     public function destroy($id)
     {
       if($this->pupukRepository->delete($id) == 0){
           redirect()->route('pupuk.index')->with('error', 'Gagal menghapus pupuk/ pupuk tidak ditemukan.');
       }
       return redirect()->route('pupuk.index')->with('success', 'Pupuk berhasil dihapus');
     }

     public function arsip()
     {
         $pupuk = $this->pupukRepository->arsip();
         return view('pupuk.arsip', compact('pupuk'));
     }
     public function revert($id)
     {
          $pupuk = $this->pupukRepository->find($id);

          $this->pupukRepository->update([
            'deleted_at'    => null
          ],$id);
          return redirect()->route('pupuk.arsip')->with('success', 'Pupuk berhasil dikembalikan ke daftar produk');

    }

}

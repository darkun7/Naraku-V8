<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BahanRepository;
use App\Http\Requests\BahanRequest;

class BahanController extends Controller
{
    private $bahanRepository;

    public function __construct()
    {
        $this->bahanRepository = new BahanRepository;
    }

    public function index()
    {
        $bahan = $this->bahanRepository->all();
        return view('bahan.index', compact('bahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bahan = $this->bahanRepository->all();
        return view('bahan.tambah', compact('bahan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BahanRequest $request)
    {
        $input = $request->all();
        if(!isset($input['bahan'])){
          return redirect()->route('bahan.create')->with('error', 'Harap melengkapi form isian');
        }
        if( isset($input['bahan']) && $input['bahan']=="bahan-baru" ){
            $this->bahanRepository->create($input);
          $state = 'ditambahkan';
        }else{
            //mengambil jumlah
            $bahan = $this->bahanRepository->find($input['bahan']);
            $total = $bahan['jumlah'] + $request['jumlah'];

            //mengganti jumlah di request
            $request->merge(['jumlah' => $total]);
            
            $data = $request->only([
                'jumlah',
                'satuan',
                'bahan'
            ]);
            $this->bahanRepository->update($data, $data['bahan']);
          $state = 'diperbarui';
        }
        return redirect()->route('bahan.index')->with('success', 'Bahan berhasil '.$state);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bahans = $this->bahanRepository->all();
        $bahan = $this->bahanRepository->find($id);
        return view('bahan.edit', compact('bahans', 'bahan'));
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
        $bahan = $this->bahanRepository->update($input, $id);
        return redirect()->route('bahan.index')->with('success', 'Bahan baku berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->bahanRepository->delete($id) == 0){
            redirect()->route('bahan.index')->with('error', 'Gagal menghapus bahan/ bahan tidak ditemukan.');
        }
        return redirect()->route('bahan.index')->with('success', 'Bahan berhasil dihapus');
    }
}

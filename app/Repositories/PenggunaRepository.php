<?php

namespace App\Repositories;

use App\Models\Pengguna;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class PenggunaRepository
{

    /**
     * get all data
     *
     * @return Collection
     */
    public function auth_user()
    {
        $id =  Auth::user()->id;
        $user = Pengguna::where('id', $id)->first();
        return $user;
    }
    public function all()
    {
        return Pengguna::all();
    }

    /**
     * store data to db
     *
     * @param array $data
     * @return Pengguna
     */
    public function create(array $data)
    {
        return Pengguna::create($data);
    }

    /**
     * find data by id
     *
     * @param int $id
     * @return Pengguna
     */
    public function find(int $id)
    {
        return Pengguna::find($id);
    }

    /**
     * update data by id
     *
     * @param array $data
     * @param int $id
     * @return Pengguna
     */
    public function update(array $data, int $id)
    {
        $pengguna = Pengguna::find($id);
        if ($pengguna) {
            $pengguna->update($data);
            return $pengguna;
        }
        return 0;
    }

    /**
     * delete data by id
     *
     * @param int $id
     * @return Pengguna
     */
    public function delete(int $id)
    {
        $pengguna = Pengguna::find($id);
        if ($pengguna) {
            return $pengguna->delete();
        }
        return 0;
    }
}
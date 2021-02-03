<?php

namespace App\Repositories;

use App\Models\Pemesanan;
use Illuminate\Support\Collection;

class PemesananRepository
{

    /**
     * get all data
     *
     * @return Collection
     */
    public function all()
    {
        return Pemesanan::all();
    }

    /**
     * store data to db
     *
     * @param array $data
     * @return Pemesanan
     */
    public function create(array $data)
    {
        return Pemesanan::create($data);
    }

    /**
     * find data by id
     *
     * @param int $id
     * @return Pemesanan
     */
    public function find(int $id)
    {
        return Pemesanan::find($id);
    }

    /**
     * update data by id
     *
     * @param array $data
     * @param int $id
     * @return Pemesanan
     */
    public function update(array $data, int $id)
    {
        $pemesanan = Pemesanan::find($id);
        if ($pemesanan) {
            $pemesanan->update($data);
            return $pemesanan;
        }
        return 0;
    }

    /**
     * delete data by id
     *
     * @param int $id
     * @return Pemesanan
     */
    public function delete(int $id)
    {
        $pemesanan = Pemesanan::find($id);
        if ($pemesanan) {
            return $pemesanan->delete();
        }
        return 0;
    }
}
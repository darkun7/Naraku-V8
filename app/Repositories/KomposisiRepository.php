<?php

namespace App\Repositories;

use App\Models\Komposisi;
use Illuminate\Support\Collection;

class KomposisiRepository
{

    /**
     * get all data
     *
     * @return Collection
     */
    public function all()
    {
        return Komposisi::all();
    }

    /**
     * store data to db
     *
     * @param array $data
     * @return Komposisi
     */
    public function create(array $data)
    {
        return Komposisi::create($data);
    }

    /**
     * find data by id
     *
     * @param int $id
     * @return Komposisi
     */
    public function find(int $id)
    {
        return Komposisi::find($id);
    }

    /**
     * update data by id
     *
     * @param array $data
     * @param int $id
     * @return Komposisi
     */
    public function update(array $data, int $id)
    {
        $komposisi = Komposisi::find($id);
        if ($komposisi) {
            $komposisi->update($data);
            return $komposisi;
        }
        return 0;
    }

    /**
     * delete data by id
     *
     * @param int $id
     * @return Komposisi
     */
    public function delete(int $id)
    {
        $komposisi = Komposisi::find($id);
        if ($komposisi) {
            return $komposisi->delete();
        }
        return 0;
    }
}
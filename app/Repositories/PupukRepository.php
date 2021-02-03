<?php

namespace App\Repositories;

use App\Models\Pupuk;
use Illuminate\Support\Collection;

class PupukRepository
{

    /**
     * get all data
     *
     * @return Collection
     */
    public function all()
    {
        return Pupuk::all();
    }

    /**
     * store data to db
     *
     * @param array $data
     * @return Pupuk
     */
    public function create(array $data)
    {
        return Pupuk::create($data);
    }

    /**
     * find data by id
     *
     * @param int $id
     * @return Pupuk
     */
    public function find(int $id)
    {
        return Pupuk::find($id);
    }

    /**
     * update data by id
     *
     * @param array $data
     * @param int $id
     * @return Pupuk
     */
    public function update(array $data, int $id)
    {
        $pupuk = Pupuk::find($id);
        if ($pupuk) {
            $pupuk->update($data);
            return $pupuk;
        }
        return 0;
    }

    /**
     * delete data by id
     *
     * @param int $id
     * @return Pupuk
     */
    public function delete(int $id)
    {
        $pupuk = Pupuk::find($id);
        if ($pupuk) {
            return $pupuk->delete();
        }
        return 0;
    }
}
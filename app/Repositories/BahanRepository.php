<?php

namespace App\Repositories;

use App\Models\Bahan;
use Illuminate\Support\Collection;

class BahanRepository
{

    /**
     * get all data
     *
     * @return Collection
     */
    public function all()
    {
        return Bahan::all();
    }

    /**
     * store data to db
     *
     * @param array $data
     * @return Bahan
     */
    public function create(array $data)
    {
        return Bahan::create($data);
    }

    /**
     * find data by id
     *
     * @param int $id
     * @return Bahan
     */
    public function find(int $id)
    {
        return Bahan::find($id);
    }

    /**
     * update data by id
     *
     * @param array $data
     * @param int $id
     * @return Bahan
     */
    public function update(array $data, int $id)
    {
        $bahan = Bahan::find($id);
        if ($bahan) {
            $bahan->update($data);
            return $bahan;
        }
        return 0;
    }

    /**
     * delete data by id
     *
     * @param int $id
     * @return Bahan
     */
    public function delete(int $id)
    {
        $bahan = Bahan::find($id);
        if ($bahan) {
            return $bahan->delete();
        }
        return 0;
    }
}
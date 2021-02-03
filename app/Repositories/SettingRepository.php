<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Collection;

class SettingRepository
{

    /**
     * get all data
     *
     * @return Collection
     */
    public function all()
    {
        return Setting::all();
    }

    /**
     * store data to db
     *
     * @param array $data
     * @return Setting
     */
    public function create(array $data)
    {
        return Setting::create($data);
    }

    /**
     * find data by id
     *
     * @param int $id
     * @return Setting
     */
    public function find(int $id)
    {
        return Setting::find($id);
    }

    /**
     * update data by id
     *
     * @param array $data
     * @param int $id
     * @return Setting
     */
    public function update(array $data, int $id)
    {
        $setting = Setting::find($id);
        if ($setting) {
            $setting->update($data);
            return $setting;
        }
        return 0;
    }

    /**
     * delete data by id
     *
     * @param int $id
     * @return Setting
     */
    public function delete(int $id)
    {
        $setting = Setting::find($id);
        if ($setting) {
            return $setting->delete();
        }
        return 0;
    }
}
<?php

namespace App\Repositories;

use App\Models\ColdRoomTemperature;

class ColdRoomTemperatureRepository
{
    public function getAll()
    {
        return ColdRoomTemperature::all();
    }

    public function findById($id)
    {
        return ColdRoomTemperature::findOrFail($id);
    }

    public function create(array $data)
    {
        $data['recorded_at'] = now();

        return ColdRoomTemperature::create($data);
    }

    public function update(ColdRoomTemperature $temperature, array $data)
    {
        $temperature->update($data);
        return $temperature;
    }

    public function delete(ColdRoomTemperature $temperature)
    {
        return $temperature->delete();
    }
}

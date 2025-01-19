<?php

namespace App\Repositories;

use App\Models\FermenterTemperature;

class FermenterTemperatureRepository
{
    public function getAll()
    {
        return FermenterTemperature::all();
    }

    public function findById($id)
    {
        return FermenterTemperature::findOrFail($id);
    }

    public function create(array $data)
    {
        return FermenterTemperature::create($data);
    }

    public function update($id, array $data)
    {
        $temperature = $this->findById($id);
        $temperature->update($data);

        return $temperature;
    }

    public function delete($id)
    {
        $temperature = $this->findById($id);
        $temperature->delete();

        return true;
    }
}
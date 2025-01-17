<?php

namespace App\Repositories;

use App\Models\Brewery;

class BreweryRepository
{
    public function getAll()
    {
        return Brewery::all();
    }

    public function findById($id)
    {
        return Brewery::findOrFail($id);
    }

    public function create(array $data)
    {
        return Brewery::create($data);
    }

    public function update(Brewery $brewery, array $data)
    {
        $brewery->update($data);
        return $brewery;
    }

    public function delete(Brewery $brewery)
    {
        return $brewery->delete();
    }
}

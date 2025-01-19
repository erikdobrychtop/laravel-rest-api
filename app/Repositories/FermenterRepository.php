<?php

namespace App\Repositories;

use App\Models\Fermenter;

class FermenterRepository
{
    public function getAll()
    {
        return Fermenter::all();
    }

    public function findById($id)
    {
        return Fermenter::findOrFail($id);
    }

    public function create(array $data)
    {
        $data['recorded_at'] = now();
        return Fermenter::create($data);
    }

    public function update($id, array $data)
    {
        $fermenter = $this->findById($id);
        $fermenter->update($data);

        return $fermenter;
    }

    public function delete($id)
    {
        $fermenter = $this->findById($id);
        $fermenter->delete();

        return true;
    }
}
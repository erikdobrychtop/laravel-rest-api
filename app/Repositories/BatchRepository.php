<?php

namespace App\Repositories;

use App\Models\Batch;

class BatchRepository
{
    public function getAll()
    {
        return Batch::all();
    }

    public function findById($id)
    {
        return Batch::find($id);
    }

    public function create(array $data)
    {
        return Batch::create($data);
    }

    public function update($id, array $data)
    {
        $batch = Batch::find($id);
        if ($batch) {
            $batch->update($data);
        }
        return $batch;
    }

    public function delete($id)
    {
        return Batch::destroy($id);
    }
}
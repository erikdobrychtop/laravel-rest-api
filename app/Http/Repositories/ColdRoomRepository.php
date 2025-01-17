<?php

namespace App\Repositories;

use App\Models\ColdRoom;

class ColdRoomRepository
{
    public function getAll()
    {
        return ColdRoom::all();
    }

    public function findById($id)
    {
        return ColdRoom::findOrFail($id);
    }

    public function create(array $data)
    {
        return ColdRoom::create($data);
    }

    public function update(ColdRoom $coldRoom, array $data)
    {
        $coldRoom->update($data);
        return $coldRoom;
    }

    public function delete(ColdRoom $coldRoom)
    {
        return $coldRoom->delete();
    }
}

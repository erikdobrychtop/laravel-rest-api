<?php

namespace App\Services;

use App\Repositories\ColdRoomRepository;

class ColdRoomService
{
    protected $coldRoomRepository;

    public function __construct(ColdRoomRepository $coldRoomRepository)
    {
        $this->coldRoomRepository = $coldRoomRepository;
    }

    public function getAll()
    {
        return $this->coldRoomRepository->getAll();
    }

    public function findById($id)
    {
        return $this->coldRoomRepository->findById($id);
    }

    public function create(array $data)
    {
        return $this->coldRoomRepository->create($data);
    }

    public function update($id, array $data)
    {
        $coldRoom = $this->coldRoomRepository->findById($id);
        return $this->coldRoomRepository->update($coldRoom, $data);
    }

    public function delete($id)
    {
        $coldRoom = $this->coldRoomRepository->findById($id);
        return $this->coldRoomRepository->delete($coldRoom);
    }
}

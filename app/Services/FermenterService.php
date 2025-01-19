<?php

namespace App\Services;

use App\Repositories\FermenterRepository;

class FermenterService
{
    protected $fermenterRepository;

    public function __construct(FermenterRepository $fermenterRepository)
    {
        $this->fermenterRepository = $fermenterRepository;
    }

    public function getAll()
    {
        return $this->fermenterRepository->getAll();
    }

    public function findById($id)
    {
        return $this->fermenterRepository->findById($id);
    }

    public function create(array $data)
    {
        return $this->fermenterRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->fermenterRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->fermenterRepository->delete($id);
    }
}
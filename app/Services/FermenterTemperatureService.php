<?php

namespace App\Services;

use App\Repositories\FermenterTemperatureRepository;

class FermenterTemperatureService
{
    protected $fermenterTemperatureRepository;

    public function __construct(FermenterTemperatureRepository $fermenterTemperatureRepository)
    {
        $this->fermenterTemperatureRepository = $fermenterTemperatureRepository;
    }

    public function getAll()
    {
        return $this->fermenterTemperatureRepository->getAll();
    }

    public function findById($id)
    {
        return $this->fermenterTemperatureRepository->findById($id);
    }

    public function create(array $data)
    {
        return $this->fermenterTemperatureRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->fermenterTemperatureRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->fermenterTemperatureRepository->delete($id);
    }
}
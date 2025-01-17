<?php

namespace App\Services;

use App\Repositories\ColdRoomTemperatureRepository;

class ColdRoomTemperatureService
{
    protected $temperatureRepository;

    public function __construct(ColdRoomTemperatureRepository $temperatureRepository)
    {
        $this->temperatureRepository = $temperatureRepository;
    }

    public function getAll()
    {
        return $this->temperatureRepository->getAll();
    }

    public function findById($id)
    {
        return $this->temperatureRepository->findById($id);
    }

    public function create(array $data)
    {
        return $this->temperatureRepository->create($data);
    }

    public function update($id, array $data)
    {
        $temperature = $this->temperatureRepository->findById($id);
        return $this->temperatureRepository->update($temperature, $data);
    }

    public function delete($id)
    {
        $temperature = $this->temperatureRepository->findById($id);
        return $this->temperatureRepository->delete($temperature);
    }
}

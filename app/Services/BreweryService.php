<?php

namespace App\Services;

use App\Repositories\BreweryRepository;

class BreweryService
{
    protected $breweryRepository;

    public function __construct(BreweryRepository $breweryRepository)
    {
        $this->breweryRepository = $breweryRepository;
    }

    public function getAll()
    {
        return $this->breweryRepository->getAll();
    }

    public function findById($id)
    {
        return $this->breweryRepository->findById($id);
    }

    public function create(array $data)
    {
        return $this->breweryRepository->create($data);
    }

    public function update($id, array $data)
    {
        $brewery = $this->breweryRepository->findById($id);
        return $this->breweryRepository->update($brewery, $data);
    }

    public function delete($id)
    {
        $brewery = $this->breweryRepository->findById($id);
        return $this->breweryRepository->delete($brewery);
    }
}

<?php

namespace App\Repositories;

use App\Models\TravelOrder;

class TravelOrderRepository
{
    public function create(array $data)
    {
        return TravelOrder::create($data);
    }

    public function find($id)
    {
        return TravelOrder::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $travelOrder = $this->find($id);
        $travelOrder->update($data);
        return $travelOrder->refresh();
    }

    public function getByUser($userId, array $filters)
    {
        $query = TravelOrder::where('user_id', $userId);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('departure_date', [$filters['start_date'], $filters['end_date']]);
        }
        if (!empty($filters['destination'])) {
            $query->where('destination', $filters['destination']);
        }

        return $query->get();
    }
}
<?php

namespace App\Services;

use App\Repositories\TravelOrderRepository;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TravelOrderStatusUpdated;
use Illuminate\Http\Exceptions\HttpResponseException;

class TravelOrderService
{
    protected $repository;

    public function __construct(TravelOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($userId, array $data)
    {
        $data['user_id'] = $userId;
        $data['status'] = 'requested';
        return $this->repository->create($data);
    }

    public function updateStatus($id, $status, $currentUserId)
    {
        $travelOrder = $this->repository->find($id);
        if ($travelOrder->user_id === $currentUserId) {
            throw new HttpResponseException(response()->json(['error' => 'You cannot update your own request status'], 403));
        }

        $travelOrder = $this->repository->update($id, ['status' => $status]);
        Notification::send($travelOrder->user, new TravelOrderStatusUpdated($travelOrder));
        return $travelOrder;
    }

    public function find($id, $userId)
    {
        $travelOrder = $this->repository->find($id);
        if ($travelOrder->user_id !== $userId) {
            throw new HttpResponseException(response()->json(['error' => 'Unauthorized'], 403));
        }
        return $travelOrder;
    }

    public function list($userId, array $filters)
    {
        return $this->repository->getByUser($userId, $filters);
    }

    public function cancel($id, $userId)
    {
        $travelOrder = $this->repository->find($id);
        if ($travelOrder->user_id !== $userId) {
            throw new HttpResponseException(response()->json(['error' => 'Unauthorized'], 403));
        }
        if ($travelOrder->status !== 'approved') {
            throw new HttpResponseException(response()->json(['error' => 'Cannot cancel a non-approved order'], 400));
        }

        $travelOrder = $this->repository->update($id, ['status' => 'canceled']);
        Notification::send($travelOrder->user, new TravelOrderStatusUpdated($travelOrder));
    }
}
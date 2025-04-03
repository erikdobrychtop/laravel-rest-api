<?php

namespace App\Http\Controllers;

use App\Services\TravelOrderService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class TravelOrderController extends Controller
{
    protected $service;

    public function __construct(TravelOrderService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'requester_name' => 'required|string|max:255',
                'destination' => 'required|string|max:255',
                'departure_date' => 'required|date|after:today',
                'return_date' => 'required|date|after:departure_date',
            ]);

            $travelOrder = $this->service->create(
                auth()->id(),
                $request->only(['requester_name', 'destination', 'departure_date', 'return_date'])
            );

            return response()->json([
                'message' => 'Travel order created successfully.',
                'data' => $travelOrder
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'details' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to create travel order.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate(['status' => 'required|in:approved,canceled']);

            $travelOrder = $this->service->updateStatus($id, $request->status, auth()->id());

            return response()->json([
                'message' => 'Travel order status updated successfully.',
                'data' => $travelOrder
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'details' => $e->errors()
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Travel order not found.'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to update travel order status.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $travelOrder = $this->service->find($id, auth()->id());

            return response()->json([
                'message' => 'Travel order retrieved successfully.',
                'data' => $travelOrder
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Travel order not found.'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve travel order.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function index(Request $request)
    {
        try {
            $filters = $request->only(['status', 'start_date', 'end_date', 'destination']);
            $travelOrders = $this->service->list(auth()->id(), $filters);

            return response()->json([
                'message' => 'Travel orders retrieved successfully.',
                'data' => $travelOrders
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve travel orders.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function cancel($id)
    {
        try {
            $this->service->cancel($id, auth()->id());

            return response()->json([
                'message' => 'Travel order canceled successfully.'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Travel order not found.'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to cancel travel order.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Services\BatchDensityService;
use Illuminate\Http\Request;

class BatchDensityController extends Controller
{
    protected $batchDensityService;

    public function __construct(BatchDensityService $service)
    {
        $this->batchDensityService = $service;
    }

    public function index($batchId)
    {
        return response()->json($this->batchDensityService->getByBatchId($batchId));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return response()->json($this->batchDensityService->create($data), 201);
    }

    public function destroy($id)
    {
        $this->batchDensityService->delete($id);
        return response()->json(['message' => 'Density record deleted successfully']);
    }
}
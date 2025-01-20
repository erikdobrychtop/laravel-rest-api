<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Services\BatchDensityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BatchDensityController extends Controller
{
    protected $batchDensityService;

    public function __construct(BatchDensityService $service)
    {
        $this->batchDensityService = $service;
    }

    public function index($batchId)
    {
        try {
            $densities = $this->batchDensityService->getByBatchId($batchId);
            return response()->json($densities);
        } catch (\Exception $e) {
            Log::error('Error fetching densities: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to fetch densities'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $density = $this->batchDensityService->create($data);
            return response()->json($density, 201);
        } catch (\Exception $e) {
            Log::error('Error storing density: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to store density'], 500);
        }
    }

    public function destroy(Batch $batchId, $id)
    {
        try {
            $this->batchDensityService->delete($batchId, $id);

            return response()->json(['message' => 'Density record deleted successfully']);
        } catch (\Exception $e) {
            // Loga o erro com detalhes adicionais
            Log::error('Error deleting density: ', [
                'batch_id' => $batchId->id,
                'density_id' => $id,
                'error_message' => $e->getMessage()
            ]);

            // Retorna uma mensagem de erro personalizada, se possível
            $statusCode = $e->getCode() === 404 ? 404 : 500;
            $errorMessage = $e->getCode() === 404
                ? $e->getMessage()
                : 'An unexpected error occurred while trying to delete the density record.';

            return response()->json(['message' => $errorMessage], $statusCode);
        }
    }

}
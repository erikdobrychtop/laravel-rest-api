<?php

namespace App\Http\Controllers;

use App\Services\BatchService;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    protected $batchService;

    public function __construct(BatchService $batchService)
    {
        $this->batchService = $batchService;
    }

    public function index()
    {
        return response()->json($this->batchService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->batchService->findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return response()->json($this->batchService->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        return response()->json($this->batchService->update($id, $data));
    }

    public function destroy($id)
    {
        $this->batchService->delete($id);
        return response()->json(['message' => 'Batch deleted successfully']);
    }
}
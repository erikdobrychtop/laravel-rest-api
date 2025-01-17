<?php

namespace App\Http\Controllers;

use App\Services\BreweryService;
use Illuminate\Http\Request;

class BreweryController extends Controller
{
    protected $breweryService;

    public function __construct(BreweryService $breweryService)
    {
        $this->breweryService = $breweryService;
    }

    public function index()
    {
        return response()->json($this->breweryService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->breweryService->findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'corporate_name' => 'required|string',
            'trade_name' => 'required|string',
            'cnpj' => 'required|string|unique:breweries,cnpj',
            'street' => 'required|string',
            'neighborhood' => 'required|string',
            'number' => 'required|string',
            'zip_code' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string|max:2',
        ]);

        return response()->json($this->breweryService->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'corporate_name' => 'string',
            'trade_name' => 'string',
            'cnpj' => 'string|unique:breweries,cnpj,' . $id,
            'street' => 'string',
            'neighborhood' => 'string',
            'number' => 'string',
            'zip_code' => 'string',
            'city' => 'string',
            'state' => 'string|max:2',
        ]);

        return response()->json($this->breweryService->update($id, $data));
    }

    public function destroy($id)
    {
        $this->breweryService->delete($id);
        return response()->json(['message' => 'Brewery deleted successfully']);
    }
}
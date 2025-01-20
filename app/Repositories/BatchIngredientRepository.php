<?php

namespace App\Repositories;

use App\Models\BatchIngredient;

class BatchIngredientRepository
{
    public function getByBatchId($batchId)
    {
        return BatchIngredient::where('batch_id', $batchId)->get();
    }

    public function create(array $data)
    {
        return BatchIngredient::create($data);
    }

    public function update($id, array $data)
    {
        $ingredient = BatchIngredient::find($id);
        if ($ingredient) {
            $ingredient->update($data);
        }
        return $ingredient;
    }

    public function delete($id)
    {
        return BatchIngredient::destroy($id);
    }
}
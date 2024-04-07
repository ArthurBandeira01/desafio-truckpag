<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductImportHistoryRepositoryInterface;
use App\Models\ProductImportHistory;

class ProductImportHistoryRepository implements ProductImportHistoryRepositoryInterface
{

    protected $entity;

    public function __construct(ProductImportHistory $ProductImportHistory)
    {
        $this->entity = $ProductImportHistory;
    }

    public function getAllProductsImportHistory()
    {
        return $this->entity->paginate();
    }

    public function getProductImportHistoryById($id): object
    {
        return $this->entity->where('id', $id)->first();
    }

    public function createProductImportHistory(array $ProductImportHistory): object
    {
        return $this->entity->create($ProductImportHistory);
    }

    public function updateProductImportHistory($ProductImportHistory, $productImportHistory)
    {
        return $ProductImportHistory->update($productImportHistory);
    }

    public function destroyProductImportHistory($productImportHistory)
    {
        return $productImportHistory->delete();
    }
}

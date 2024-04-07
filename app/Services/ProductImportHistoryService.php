<?php

namespace App\Services;

use App\Repositories\Contracts\ProductImportHistoryRepositoryInterface;
use Illuminate\Support\Str;

class ProductImportHistoryService
{
    protected $productsImportHistoryRepository;

    public function __construct(ProductImportHistoryRepositoryInterface $productImportHistoryRepository)
    {
        $this->productsImportHistoryRepository = $productImportHistoryRepository;
    }

    public function getAllProductsImportHistory()
    {
        return $this->productsImportHistoryRepository->getAllProductsImportHistory();
    }

    public function getProductImportHistoryById(int $id)
    {
        return $this->productsImportHistoryRepository->getProductImportHistoryById($id);
    }

    public function makeProductImportHistory(array $productImportHistory)
    {
        return $this->productsImportHistoryRepository->createProductImportHistory($productImportHistory);
    }

    public function updateProductImportHistory(int $id, array $productImportHistory)
    {
        $productsImportHistory = $this->productsImportHistoryRepository->getProductImportHistoryById($id);

        if (!$productsImportHistory) {
            return response()->json(['message' => 'ProductImportHistory not found.'], 404);
        }

        $this->productsImportHistoryRepository
            ->updateProductImportHistory($productsImportHistory, $productImportHistory);

        return response()->json(['message' => 'Product import history updated.'], 200);
    }

    public function destroyProduct(int $id)
    {
        $productsImportHistory = $this->productsImportHistoryRepository->getProductImportHistoryById($id);

        if (!$productsImportHistory) {
            return response()->json(['message' => 'Product import history not found.'], 404);
        }

        $this->productsImportHistoryRepository->destroyProductImportHistory($productsImportHistory);

        return response()->json(['message' => 'Product import history deleted.'], 200);
    }
}

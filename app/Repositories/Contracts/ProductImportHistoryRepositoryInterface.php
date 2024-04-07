<?php

namespace App\Repositories\Contracts;

interface ProductImportHistoryRepositoryInterface
{
    public function getAllProductsImportHistory();
    public function getProductImportHistoryById($id);
    public function createProductImportHistory(array $product);
    public function updateProductImportHistory(int $id, array $product);
    public function destroyProductImportHistory(int $id);
}

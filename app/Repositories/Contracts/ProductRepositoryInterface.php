<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductById($id);
    public function createProduct(array $product);
    public function updateProduct(int $id, array $product);
    public function destroyProduct(int $id);
}

<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    protected $entity;

    public function __construct(Product $Product)
    {
        $this->entity = $Product;
    }

    public function getAllProducts()
    {
        return $this->entity->paginate();
    }

    public function getProductById($id)
    {
        return $this->entity->where('code', $id)->first();
    }

    public function createProduct(array $Product): object
    {
        return $this->entity->create($Product);
    }

    public function updateProduct($Product, $product)
    {
        return $Product->update($product);
    }

    public function destroyProduct($product)
    {
        return $product->delete();
    }
}

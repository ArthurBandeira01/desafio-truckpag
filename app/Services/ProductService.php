<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Str;

class ProductService
{
    protected $productsRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productsRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productsRepository->getAllProducts();
    }

    public function getProductById(int $id)
    {
        return $this->productsRepository->getProductById($id);
    }

    public function makeProduct(array $product)
    {
        return $this->productsRepository->createProduct($product);
    }

    public function updateProduct(int $id, array $product)
    {
        $products = $this->productsRepository->getProductById($id);

        if (!$products) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $this->productsRepository->updateProduct($products, $product);

        return response()->json(['message' => 'Product updated.'], 200);
    }

    public function destroyProduct(int $id)
    {
        $products = $this->productsRepository->getProductById($id);

        if (!$products) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $this->productsRepository->destroyProduct($products);

        return response()->json(['message' => 'Product deleted.'], 200);
    }
}

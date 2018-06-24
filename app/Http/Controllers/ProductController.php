<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use App\Http\StrategyContext;
use App\Http\ProductSimpleFactory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $productRepo = new ProductRepository();
        $products = $productRepo->getAll();

        return response()->json($products, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $amount
     * @param  ?int $operator
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexWhere(Request $request, int $amount, int $operator = 0): JsonResponse
    {
        $productRepo = new ProductRepository();
        $products = [];
        
        $strategyContext = new StrategyContext($operator);
        $products = $strategyContext->getFilteredProducts($amount);

        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'bail|required|alpha_dash|unique:products|max:255',
            'amount' => 'required|integer|min:0',
        ]);

        $factory = new ProductSimpleFactory();
        $product = $factory->createProduct();

        $product->setName($request->name);
        $product->setAmount($request->amount);

        $product->save();

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $productRepo = new ProductRepository();

        return response()->json($productRepo->getById($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'name' => 'bail|required|alpha_dash|unique:products|max:255',
            'amount' => 'required|integer|min:0',
        ]);

        $productRepo = new ProductRepository();
        $product = $productRepo->getById($id);
        $product->update($request->only(['name', 'amount']));

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $productRepo = new ProductRepository();
        $product = $productRepo->getById($id);
        $product->delete();

        return response()->json(null, 204);
    }
}

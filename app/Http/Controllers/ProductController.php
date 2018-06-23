<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productRepo = new ProductRepository();
        $products = $productRepo->getAll();

        return ProductResource::collection($products);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexWhere(Request $request, int $amount, int $operator = 0)
    {
        $productRepo = new ProductRepository();
        $products = [];
        
        switch ($operator)
        {
            case -1:
                $products = $productRepo->getLessThan($amount);
                break;
            case 1:
                $products = $productRepo->getMoreThan($amount);
                break;
            default:
                $products = $productRepo->getJust($amount);
                break;
        }

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|alpha_dash|unique:products|max:255',
            'amount' => 'required|integer|min:0',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'amount' => $request->amount,
        ]);
    
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $productRepo = new ProductRepository();

        return new ProductResource($productRepo->getById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'bail|required|alpha_dash|unique:products|max:255',
            'amount' => 'required|integer|min:0',
        ]);

        $productRepo = new ProductRepository();
        $product = $productRepo->getById($id);
        $product->update($request->only(['name', 'amount']));

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $productRepo = new ProductRepository();
        $product = $productRepo->getById($id);
        $product->delete();

        return response()->json(null, 204);
    }
}

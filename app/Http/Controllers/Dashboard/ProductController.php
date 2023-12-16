<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Repository\product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $products;

    public function __construct(ProductRepositoryInterface $products)
    {
        $this->products=$products;
    }

    public function index()
    {
       return $this->products->index();
    }


    public function create()
    {
        return $this->products->create();
    }


    public function store(StoreProductRequest $request)
    {
        return $this->products->store($request);

    }


    public function show(Product $product)
    {
        //
    }


    public function edit($id)
    {
       return $this->products->edit($id);
    }


    public function update(StoreProductRequest $request)
    {
        return $this->products->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->products->destroy($request);
    }
}

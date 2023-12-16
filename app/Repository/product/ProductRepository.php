<?php

namespace App\Repository\product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductRepository implements ProductRepositoryInterface
{
    public function index()
    {
        try {
            $products=Product::all();
            $categories= Category::all()->count();

            return view('Admin.product.index',compact('products','categories'));

        }catch (QueryException $queryException) {
            Log::error('Database query failed: ' . $queryException->getMessage());
        }
    }

    public function create()
    {
        try {
            $categories = Category::select('name','id')->get();

            return view('Admin.product.create',compact('categories'));

        }catch (QueryException $queryException) {
            Log::error('Database query failed: ' . $queryException->getMessage());
        }
    }

    public function store($request)
    {

        try {
            $storeProduct =new Product();
            $storeProduct->name = $request->name;
            $storeProduct->code = $request->code;
            $storeProduct->price = $request->price;
            $storeProduct->category_id = $request->category;
            $storeProduct->save();
            return redirect()->route('product.index');

        }catch (QueryException $queryException) {
            Log::error('Database query failed: ' . $queryException->getMessage());
        }


    }

    public function edit($id)
    {
        try {
            $categories = Category::select('name','id')->get();
            $product = Product::find($id);

            return view('Admin.product.edit',compact('product','categories'));

        }catch (QueryException $queryException) {
            Log::error('Database query failed: ' . $queryException->getMessage());
        }
    }

    public function update(Request $request)
    {

//        return $request;

//        try {

            $updateProduct =Product::find($request->id);
            $updateProduct->name = $request->name;
            $updateProduct->price = $request->price;
            $updateProduct->category_id = $request->category_id;
            $updateProduct->save();

        return redirect()->route('product.index');



//            return redirect(route('product.index'));


//        }catch (QueryException $queryException) {
//            Log::error('Database query failed: ' . $queryException->getMessage());
//        }
    }

    public function destroy($request)
    {
        try {

            $deleteProduct=Product::find($request->id);


            $deleteProduct->delete();
            return redirect(route('product.index'));

        }catch (QueryException $queryException) {
            Log::error('Database query failed: ' . $queryException->getMessage());
        }
    }

}

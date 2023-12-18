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

        $image=$request->image;
        if ($image){

            $imageName=time().'.'.$image->getClientOriginalExtension();
            $image->move('products',$imageName);
        }else{

            $imageName='default.JPG';
        }

        try {
            $storeProduct =new Product();
            $storeProduct->name = $request->name;
            $storeProduct->code = $request->code;
            $storeProduct->price = $request->price;
            $storeProduct->quantity=$request->quantity;
            $storeProduct->image = $imageName;
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

        $image=$request->image;
        if ($image){

            $imageName=time().'.'.$image->getClientOriginalExtension();
            $image->move('products',$imageName);
        }else{

            $imageName='default.JPG';
        }

//        try {

            $updateProduct =Product::find($request->id);
            $updateProduct->name = $request->name;
            $updateProduct->price = $request->price;
            $updateProduct->image = $imageName;
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
            $imagePath = public_path('products/' . $deleteProduct->image);
            unlink($imagePath);


            $deleteProduct->delete();
            return redirect(route('product.index'));

        }catch (QueryException $queryException) {
            Log::error('Database query failed: ' . $queryException->getMessage());
        }
    }

}

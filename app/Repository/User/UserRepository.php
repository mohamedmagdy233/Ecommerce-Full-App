<?php

namespace App\Repository\User;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface
{
    public function index()
    {
        try{
        $categories=Category::all();
        $products=Product::all();
        return view('User.User',compact('categories','products'));

    }catch (QueryException $queryException) {
            Log::error('Database query failed: ' . $queryException->getMessage());
        }
    }

    public function show($id)
    {

        try {

            $products=Product::where('category_id',$id)->get();
            return view('User.show-products',compact('products'));



        }catch (QueryException $queryException) {
            Log::error('Database query failed: ' . $queryException->getMessage());
    }
       }

}

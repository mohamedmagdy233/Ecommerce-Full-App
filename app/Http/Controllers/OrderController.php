<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)


    {




       $getProduct=Product::find($request->id);
       $getCategory=Category::find($request->id);


        $image=$getProduct->image;
//        if ($image !='default.JPG'){
//
//
//            $image->move('orders',$image);
//        }else{
//
//            $imageName='default.JPG';
//        }

       $discount=$getCategory->discount;
       if($discount > 0){

           $price=(($getProduct->price)*((100 -$getCategory->discount)/ 100))*$request->quantity;
       }else{

           $price =$getProduct->price;

       }

       $order=new Order();
       $order->name= $getProduct->name;
       $order->price= $price;
       $order->image= $image;
       $order->code= $getProduct->code;
       $order->payment= 'pending';

       $order->category= $getCategory->name;
       $order->quantity= $request->quantity;
       $order->save();

        $getProduct->quantity=$getProduct->quantity -$request->quantity;
        $getProduct->save();



       return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}

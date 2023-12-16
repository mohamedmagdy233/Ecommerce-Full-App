<?php

namespace App\Repository\product;

use App\Models\Product;
use Illuminate\Http\Request;


interface ProductRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update(Request $request);
    public function destroy($request);

}

<?php

namespace App\Repository\category;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use function public_path;
use function redirect;
use function view;

class CategoryRepository implements CategoryRepositoryInterface

{
  public function index()
  {
      try {
          $categories = Category::all();
          return view('Admin.category.index',compact('categories'));

      }catch (QueryException $queryException) {
          Log::error('Database query failed: ' . $queryException->getMessage());
      }
  }

  public function create()
  {

      try {
          return view('Admin.category.create');

      }catch (QueryException $queryException) {
          Log::error('Database query failed: ' . $queryException->getMessage());
      }
  }
  public function store($request)
  {
      $image=$request->image;
      if ($image){

          $imageName=time().'.'.$image->getClientOriginalExtension();
          $image->move('categoriesImage',$imageName);
      }else{

          $imageName='default.JPG';
      }

      try {
          $AddCategory=new  Category();
          $AddCategory->name=$request->name;
          $AddCategory->discount=$request->discount;
          $AddCategory->description=$request->description;
          $AddCategory->image=$imageName;
          $AddCategory->save();

          $request->session()->flash('status', 'Your message here');

          return redirect(route('category.index'));


      }catch (QueryException $queryException) {
          Log::error('Database query failed: ' . $queryException->getMessage());
      }

  }

  public function edit($id)
  {
     try {

         $category=Category::find($id);
         return view('Admin.category.edit',compact('category'));


  }catch (QueryException $queryException) {
      Log::error('Database query failed: ' . $queryException->getMessage());
  }
  }

  public function update($request)
  {
      $image=$request->image;
      if ($image){

          $imageName=time().'.'.$image->getClientOriginalExtension();
          $image->move('categoriesImage',$imageName);
      }else{

          $imageName='default.JPG';
      }
      try {
          $updateCategory=Category::find($request->id);
          $updateCategory->name=$request->name;
          $updateCategory->discount=$request->discount;
          $updateCategory->description=$request->description;
          $updateCategory->image=$imageName;
          $updateCategory->save();

          $request->session()->flash('status', 'Your message here');

          return redirect(route('category.index'));




      }catch (QueryException $queryException) {
          Log::error('Database query failed: ' . $queryException->getMessage());
      }
  }
  public function destroy($id)
  {


      try {

          $deleteCategory=Category::find($id);

           $imagePath = public_path('categoriesImage/' . $deleteCategory->image);
           unlink($imagePath);

          $deleteCategory->delete();
          return redirect(route('category.index'));

      }catch (QueryException $queryException) {
          Log::error('Database query failed: ' . $queryException->getMessage());
      }
  }
}

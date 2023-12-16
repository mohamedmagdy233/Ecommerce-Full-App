<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.Layout.head')
</head>
<body>
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container-scroller">
    @include('Admin.Layout.sider')
    <div class="container-fluid page-body-wrapper">
        @include('Admin.Layout.navbar')
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="card-body">
                    @if($categories > 0)
                    <a href="{{route('product.create')}}"  class="btn btn-light">Add product</a>
                    @else
                        <div class="alert alert-warning" role="alert">
                            <p class="mb-0"><strong>Note:</strong> You must add a category first.</p>
                        </div>

                    @endif

                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th>code</th>
                                <th> name </th>
                                <th> price </th>
                                <th> price after discount</th>
                                <th> category </th>
                                <th> actions </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;
                            $i++;
                            ?>
                 @foreach($products as $product)

                     <?php

                         $num1 =$product->price;
                         $num2= $product->category->discount/100;
                         $num3 = $num1 * $num2;




                     ?>

                            <tr>
                                <td>{{$i}}</td>
                                <td> {{$product->code}} </td>
                                <td> {{$product->name}} </td>
                                <td> {{number_format($product->price)}} EG </td>
                                <td> {{number_format($num3)}} EG </td>
                                <td> {{$product->category->name}} </td>

                                <td>
                                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary">Edit</a>
{{--                                    <a href="{{route('category.destroy',$category->id)}}" class="btn btn-danger">X</a>--}}
                                    <a  class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">X</a>
                                </td>


                            </tr>
                     @include('Admin.product.delete')
                 @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@include('Admin.Layout.js')
</body>
</html>

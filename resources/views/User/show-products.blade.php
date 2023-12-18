<!DOCTYPE html>
<html lang="en">
<head>
    @include('User.Layout.head')
</head>
<body>

<div class="hero_area">
    @include('User.Layout.header')
    @include('User.Layout.slider')
</div>


@include('User.Layout.why')
@include('User.Layout.arrival')
<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">
            @foreach($products as $product)
                @if($product->quantity > 0)


                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">

                        <div class="option_container">
                            <div class="options">
                                <form action="{{route('order.store',$product->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}">
                               <div> <input type="number"  class="option1 rounded" name="quantity" min="1" required placeholder="Quantity"> </div><br>

                                <div> <input type="submit"  value="  Add to Cart " class="option2 rounded"> </div>
                                </form>


                            </div>
                        </div>
                        <div class="img-box">
                            <img src="{{asset('products/'.$product->image)}}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{$product->name}}

                            </h5>

                            <?php

                            $num1 =$product->price;
                            $num2= ( 100 -$product->category->discount)/100;
                            $num3 = $num1 * $num2;




                            ?>
                            <h6>
                              <del style="color: red;">{{$product->price }}EG</del>&nbsp;
                                {{$num3 }}EG

                            </h6>
                        </div>

                    </div>
                </div>

                @else
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box">

                            <div class="option_container">
                                <div class="options">
                                    <p class="mb-0"><strong>Sorry:</strong> The quantity has run out. Please wait for the next batch soon..</p>


                                </div>
                            </div>
                            <div class="img-box">
                                <img src="{{asset('products/'.$product->image)}}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    {{$product->name}}

                                </h5>

                                <?php

                                $num1 =$product->price;
                                $num2= ( 100 -$product->category->discount)/100;
                                $num3 = $num1 * $num2;




                                ?>
                                <h6>
                                    <del style="color: red;">{{$product->price }}EG</del>&nbsp;
                                    {{$num3 }}EG

                                </h6>
                            </div>

                        </div>
                    </div>

                @endif

            @endforeach



        </div>
        <div class="btn-box">
            <a href="">
                View All products
            </a>
        </div>
    </div>
    </div>
</section>


@include('User.Layout.subscribe')
@include('User.Layout.client')
@include('User.Layout.footer')
@include('User.Layout.by')

@include('User.Layout.js')

</body>
</html>

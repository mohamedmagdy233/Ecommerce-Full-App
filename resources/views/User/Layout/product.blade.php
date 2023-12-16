<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">
            @foreach($categories as $category)

            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">

                    <div class="option_container">
                        <div class="options">
                            <a href="{{ url('user/show', $category->id) }}" class="option2">
                                show products
                            </a>

                        </div>
                    </div>
                    <div class="img-box">
                        <img src="{{asset('categoriesImage/'.$category->image)}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{$category->name}}
                        </h5>
                        <h6>
                           {{$category->discount}} EG

                        </h6>
                    </div>

                </div>
            </div>
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

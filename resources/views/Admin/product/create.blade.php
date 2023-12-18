<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.Layout.head')
</head>
<body>
<div class="container-scroller">
    @include('Admin.Layout.sider')
    <div class="container-fluid page-body-wrapper">
        @include('Admin.Layout.navbar')
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="card-body">
                    <h4 class="card-title">Add product Form</h4>

                    <form  action="{{route('product.store')}}" class="forms-sample" method="POST"  enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label for="code">code</label>
                            <input type="text" class="form-control" name="code" id="code" value="#{{ rand(1000, 9999) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="product name">
                        </div>


                        <div class="form-group">
                            <label for="price">price</label>
                            <input type="text" class="form-control" name="price" id="price" >
                        </div>

                        <div class="form-group">
                            <label for="quantity">quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" >
                        </div>

                        <div class="form-group">
                            <label for="image">image</label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div>


                        <div class="form-group">
                            <label for="category">category</label>
                            <select class="form-control" name="category" id="category">
                                <option disabled selected>choose</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-dark">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
@include('Admin.Layout.js')
</body>
</html>

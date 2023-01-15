@extends('master')

@section('body')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h2 class="text-center">Ajax Crud</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Products</h2>
                        </div>
                        <div class="card-body">
                            <span class="text-center text-success">{{Session::has('success') ? Session::get('success') : ''}}</span>
                            <span class="text-center text-danger">{{Session::has('error') ? Session::get('error') : ''}}</span>
                            <table class="table table-striped ">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($products as $product)
                                  <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}} Tk</td>
                                    <td><img src="{{asset('upload/product_images/'.$product->image)}}" alt="" width="50"></td>
                                    <td>{{$product->status == 1 ? 'published' : 'unpublished'}}</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="" class="btn btn-sm btn-danger">Delete</a>
                                    </td>

                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4" id="addNew">Add New Product</span>
                            <span class="h4" id="updateProduct">Update Existing Product</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('store')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="from-group mb-2">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>

                                <div class="from-group mb-2">
                                    <label for="">Price</label>
                                    <input type="number" name="price" class="form-control">
                                </div>

                                <div class="from-group mb-2">
                                    <label for="">Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>

                                <div class="from-group mb-2">
                                    <label for="">Status</label>
                                    <label for="published"><input id="published" type="radio" name="status" value="1" checked>Published</label>
                                    <label for="unpublished"><input id="unpublished" type="radio" name="status" value="0">Unpublished</label>
                                </div>

                                <input id="create" type="submit" class="btn btn-primary" value="Create">
                                <input id="update" type="submit" class="btn btn-primary" value="Update">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
<script>
    //variable
    var addNew = document.getElementById('addNew');
    var updateProduct = document.getElementById('updateProduct');
    var create = document.getElementById('create');
    var update = document.getElementById('update');




    update.style.display = 'none';
    updateProduct.style.display = 'none';
    create.style.display = 'inline-block';
    addNew.style.display = 'inline-block';


</script>

@endpush

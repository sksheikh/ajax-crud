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
                            {{-- <span class="text-center text-{{ Session::get('alert-type') ?? Session::get('alert-type') }}">{{Session::has('alert-type') ? Session::get('message') : ''}}</span> --}}

                            @if (Session::has('alert-type'))
                            <div class="alert alert-{{ Session::get('alert-type') ?? Session::get('alert-type') }} alert-dismissible fade show" role="alert">
                                <strong>{{ Session::get('alert-type') }}!</strong> {{Session::has('alert-type') ? Session::get('message') : ''}}
                            </div>
                            @endif

                            <table id="table" class="table table-striped ">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>

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
                           <form action="" method="POST" enctype="multipart/form-data">
                            {{-- @csrf
                            @method('put') --}}
                            <div class="from-group mb-2">
                                <label for="">Name</label>
                                <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="from-group mb-2">
                                <label for="">Price</label>
                                <input type="number" name="price" id="price" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input id="id" type="number" hidden>
                            <input  id="create" type="submit" class="btn btn-primary"  value="Create">
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

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    function getData(){
        $.ajax(
        {
            type: 'get',
            datatype : 'JSON',
            url: '/products/create',
            success : function(response)
            {
                // console.log(response);
                var data = '';
                $.each(response, function(key,value )
                {
                    data = data + '<tr>';
                    data = data + '<td>' + ++key + '</td>';
                    data = data + '<td>' + value.name + '</td>';
                    data = data + '<td>' + value.price + '</td>';
                    data = data + '<td>' + '<button href="" class="btn btn-sm btn-primary" onclick="editBtn('+value.id+')">Edit</button>' + " ";
                    data = data + '<button href="" class="btn btn-sm btn-danger" onclick="deleteBtn('+value.id+')">Delete</button>' + '</td>';
                    data = data + '</tr>';
                });
                $('tbody').html(data);
            }
        });
    }

    getData();

    //_Clear Data_//
    function clearData(){
        var name = $('#name').val('');
        var price = $('#price').val('');
    }

    //_Store Data_//
    $('#create').click(function (e){
        e.preventDefault();
        var name = $('#name').val();
        var price = $('#price').val();
        console.log(name);
        console.log(price);
        $.ajax({
            method : 'post',
            datatype: 'JSON',
            url: '/products/store',
            data: {name : name, price : price},
            success:function(response){
                getData();
                clearData();
                console.log(response);
            },
            error:function(response){
                console.log('Create fail');
            }


        });
    });


    //_Edit Data_//
        function editBtn(id){
            update.style.display = 'inline-block';
            updateProduct.style.display = 'inline-block';
            create.style.display = 'none';
            addNew.style.display = 'none';
            // alert(id);
            $.ajax({
            method : 'get',
            datatype: 'JSON',
            url: '/products/edit/'+id,
            // data: {name : name, price : price},
            success:function(response){
                getData();
                var name = $('#name').val(response.name);
                var price = $('#price').val(response.price);
                var id = $('#id').val(response.id)
                console.log(response);
            },
            error:function(response){
                console.log('Create fail');
            }
            });
        };


    //_Update Data_//
    $('#update').click(function (e){
        e.preventDefault();
        var name = $('#name').val();
        var price = $('#price').val();
        var id = $('#id').val();
        console.log(name);
        console.log(price);
        $.ajax({
            method : 'post',
            datatype: 'JSON',
            url: '/products/update/'+id,
            data: {name: name, price : price},
            success:function(response){
                update.style.display = 'none';
                updateProduct.style.display = 'none';
                create.style.display = 'inline-block';
                addNew.style.display = 'inline-block';
                getData();
                clearData();

                console.log(response);
            },
            error:function(response){
                console.log('Create fail');
            }


        });
    });


      //_Edit Data_//
      function deleteBtn(id){
            // alert(id);
            $.ajax({
            method : 'get',
            datatype: 'JSON',
            url: '/products/delete/'+id,
            // data: {name : name, price : price},
            success:function(response){
                getData();
                // var name = $('#name').val(response.name);
                // var price = $('#price').val(response.price);
                // var id = $('#id').val(response.id)
                console.log(response);
            },
            error:function(response){
                console.log('Create fail');
            }
            });
        };



</script>

@endpush

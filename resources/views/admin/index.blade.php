@extends('layouts.admin.header')
@section('conten')
<div class="table-responsive">
    <h2>Product</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $products)
                <tr>
                    <td>{{$products->id_product}}</td>
                    <td>{{$products->name}}</td>
                    <td>
                        <img src="{{asset('admin/images/'.$products->image)}}" alt="" style="width:100px">
                    </td>
                    {{-- <td>{{$products->category->name}}</td> --}}
                    <td>{{$products->category->name}}</td>
                    <td>{{$products->description}}</td>
                    <td>{{$products->price}}</td>
                    <td>
                        <a href="{{url('/admin/product/edit/'.$products->id_product)}}" class="btn btn-success">Edit</a>
                        <a href="{{url('/admin/product/delete/'.$products->id_product)}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
    
            </tbody>
        </table>

    </div>
</div>
@endsection
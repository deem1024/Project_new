@extends('layouts.admin.header')
@section('conten')
<div class="table-responsive">
    <h2>Create New Product</h2>
    <form action="{{route('product.c')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Product Name">
            <div class="row mt-3">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>      
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description">
            <div class="row mt-3">
            @error('description')
            <span class="text-danger">{{$message}}</span>
            @enderror
            </div>      
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control"  name="image" id="image" required>
            <div class="row mt-3">
            @error('image')
            <span class="text-danger">{{$message}}</span>
            @enderror
            </div>      
        </div>

        <div class="form-group">
            <label for="type">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price" required>
            <div class="row mt-3">
            @error('price')
            <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="type">Category</label>
            <div class="col-sm-6">
                <!-- select -->
                <div class="form-group">
                  <select class="form-control" name="category_id">
                      @foreach ($categories as $category)
                      <option value="{{$category->category_id}}">{{$category->name}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
        </div>

        <button type="submit" name="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
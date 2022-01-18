@extends('layouts.admin.header')
@section('conten')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="table-responsive">
    <h2>Edit Products</h2>
    <form action="{{url('/admin/product/Update/'.$editproduct->id_product)}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$editproduct->name}}">
            <div class="row mt-3">
            @error('name')
            <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" value="{{$editproduct->description}}">
            <div class="row mt-3">
            @error('description')
            <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control"  name="image" id="image" >
        </div>
        <!--แสดงรูปภาพ-->
        <div class="mt-4">
        <img id="showImages" src="{{asset('admin/images/'.$editproduct->image)}}" width="80px" alt="">
        </div>
            <div class="row mt-3">
            @error('image')
            <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="type">Price</label>
            <input type="text" class="form-control" name="price" id="price" value="{{$editproduct->price}}">
            <div class="row mt-3">
            @error('price')
            <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
        </div>

        <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category">
                        <option selected="selected" value="{{$editproduct->category_id}}">{{$editproduct->category->name}}</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->category_id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                      </div>
            
        </div>

        <button type="submit" name="submit" class="btn btn-success">Update</button>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImages').attr('src',e.target.result)
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    });
</script>
@endsection

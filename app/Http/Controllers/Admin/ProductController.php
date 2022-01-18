<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use File;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index')->with('categories',Category::all());
    }

    public function create(Request $request){
        $validatedData = $request->validate(
            [
            'name'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'price'=>'required|numeric',
            'image'=>'mimes:jpeg,jpg,png,gif',
        ],
        [
            'name.required' => 'กรุณาป้อนชื่อสินค้า',
            'description.required' => 'กรุณาป้อนรายละเอียดสินค้า',
            'category_id.required' => 'กรุณาป้อนประเภทสินค้า',
            'price.required' => 'กรุณาป้อนราคาสินค้า',
            'price.numeric' => 'ป้อนได้เฉพาะตัวเลขเท่านั้น',
            'image.mimes' => 'กรุณาใส่รูปสินค้าเป็นนามสกุล jpeg,jpg,png,gif เท่านั้น',
            'image.file' => 'กรุณาใส่รูปสินค้า',
        ]
    );

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        if($request->hasFile('image')){
            $filename = Str::random(10).'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path().'/admin/images/',$filename);
            Image::make(public_path().'/admin/images/'.$filename);
            $product->image = $filename;

        }else{
            $product->image = 'NOPIC.jpg';
        }

        $product->save();
        return redirect()->route('index');
    }

    public function edit($id){
        $editproduct = Product::find($id);
        return view('admin.product.edit',compact('editproduct'))
        ->with('categories',category::all());
    }

    public function update(Request $request, $id){
            $validatedData = $request->validate(
                [
                'name'=>'required',
                'description'=>'required',
                'category'=>'required',
                'price'=>'required|numeric',
                'image'=>'mimes:jpeg,jpg,png,gif',
            ],
           [
                'name.required' => 'กรุณาป้อนชื่อสินค้า',
                'description.required' => 'กรุณาป้อนรายละเอียดสินค้า',
                'category.required' => 'กรุณาป้อนประเภทสินค้า',
                'price.required' => 'กรุณาป้อนราคาสินค้า',
                'price.numeric' => 'ป้อนได้เฉพาะตัวเลขเท่านั้น',
                'image.mimes' => 'กรุณาใส่รูปสินค้าเป็นนามสกุล jpeg,jpg,png,gif เท่านั้น',
                'image.file' => 'กรุณาใส่รูปสินค้า',
            ]
        );

        if($request->hasFile('image')) {
            $product = Product::find($id);
            if($product->image != 'NOPIC.jpg'){
                File::delete(public_path().'/admin/images/'.$product->image);
            }
            $filename = Str::random(10).'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path().'/admin/images/',$filename);
            Image::make(public_path().'/admin/images/'.$filename);
            $product->image = $filename;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category;
     
        }else{
            $product = Product::find($id);

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category;
        }
        $product->save();
        return redirect()->route('index');
    }

    public function delete($id){
        $delete = Product::find($id);
        if($delete->image != 'NOPIC.jpg'){
            File::delete(public_path().'/admin/images/'.$delete->image);
    }
    $delete->delete();
    return redirect()->route('index');
    }
}

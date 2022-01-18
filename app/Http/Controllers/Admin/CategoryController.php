<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return view('admin.category.index',compact('category'));
    }

    public function create(Request $request){
        //dd($request);
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ],
    [
        'name.required' => 'กรุณาป้อนข้อมูลประเภทสินค้าก่อน',
        'name.unique' => 'มีชื่อประเภทสินค้านี้อยู่ในฐานข้อมูลเเล้ว',
        'name.max' => 'กรอกข้อมูลได้สูงสุด 255 ตัวอักษร'
    ]);
    
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return redirect('/admin/category/index');
    }

    public function edit($category_id){
        $category = Category::find($category_id);
       // dd($category);
       return view('admin.category.edit',compact('category'));
    }
    public function update(Request $request,$category_id){
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ],
    [
        'name.required' => 'กรุณาป้อนข้อมูลประเภทสินค้าก่อน',
        'name.unique' => 'มีชื่อประเภทสินค้านี้อยู่ในฐานข้อมูลเเล้ว',
        'name.max' => 'กรอกข้อมูลได้สูงสุด 255 ตัวอักษร'
    ]);
    $category = Category::find($category_id);
    $category->name = $request->name;
    $category->save();
    return redirect('/admin/category/index');
    }

    public function delete($category_id){
        Category::destroy($category_id);
        return redirect('/admin/category/index');
    }

}

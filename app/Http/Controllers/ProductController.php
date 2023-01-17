<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return view('product.index');
    }

    public function create()
    {
        $products = Product::latest()->get();
        return response()->json($products);
    }

    public function store(Request $request){


        // if($request->hasFile('image'))
        // {
        //     $file = $request->image;
        //     $fileName = 'PRODUCT_'.date('YmdHi'). '.' . $file->getClientOriginalName();
        //     $fileDirectory = public_path('upload/product_images');
        //     $file->move($fileDirectory,$fileName);
        //     $fileUrl = $fileDirectory.$fileName;

        // }
        // dd($fileName);

        $product = Product::create([
            'name'=>$request->name,
            'price'=>$request->price
        ]);

        return response()->json($product);


    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request,$id)
    {
        $product = Product::findOrFail($id)->update([
            'name' =>$request->name,
            'price'=>$request->price
        ]);

    }

    public function delete($id){
        $product = Product::findOrFail($id)->delete();
    }
}

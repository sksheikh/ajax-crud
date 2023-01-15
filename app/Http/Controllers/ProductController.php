<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return View('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->hasFile('image'));
        // if($request->hasFile('image'))
        // {
        //     $file = $request->file('image');
        //     $fileName = 'PRODUCT_'.date('YmdHi'). '.' . $file->getClientOriginalName();
        //     $fileDirectory = 'upload/product_images/';
        //     $file->move($fileDirectory,$fileName);
        //     Product::create([
        //         'image'=> 'ghhgh',
        //     ]);

        // }
        // // dd($fileName);

        // Product::create([
        //     'name'=>$request->name,
        //     'price'=>$request->price,
        //     // 'image'=> $fileName,
        //     'status'=>$request->status
        // ]);

        // return redirect()
        //     ->back()
        //     ->with('success','Created Produt Successfully');

        try {
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $fileName = 'PRODUCT_'.date('YmdHi'). '.' . $file->getClientOriginalName();
                $fileDirectory = public_path('upload/product_images');
                $file->move($fileDirectory,$fileName);

            }
            // dd($fileName);

            Product::create([
                'name'=>$request->name,
                'price'=>$request->price,
                'image'=> $fileName,
                'status'=>$request->status
            ]);

            return redirect()
                ->back()
                ->with('success','Created Produt Successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()
            ->back()
            ->with('error','Create Product Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

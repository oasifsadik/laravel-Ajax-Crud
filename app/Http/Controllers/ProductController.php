<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('index',compact('products'));
    }

    public function add(Request $request)
    {
        $request->validate
        (
            [
                'name'=>'required|unique:products',
                'price'=>'required',
            ],
            [
                'name.require' => 'name is require',
                'name.unique' => 'Product is exists',
                'price.require' => 'price is require'

            ]

        );
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return response()->json([
            'status' =>'success',
        ]);
    }
    public function update(Request $request)
    {
        $request->validate
        (
            [
                'up_name'=>'required|unique:products,name,'.$request->up_id,
                'up_price'=>'required',
            ],
            [
                'up_name.require' => 'name is require',
                'up_price.unique' => 'Product is exists',
                'up_price.require' => 'price is require'

            ]

        );
        Product::where('id',$request->up_id)->update([
            'name' => $request->up_name,
            'price' => $request->up_price,
        ]);
        return response()->json([
            'status' =>'success',
        ]);
    }
    public function delete(Request $request){
        Product::find($request->product_id)->delete();
        return response()->json([
            'status' =>'success',
        ]);
    }
    public function pagination(){
        $products = Product::latest()->paginate(5);
        return view('pagination_product',compact('products'))->render();
    }
    public function search(Request $request){
        $products = Product::where('name','like','%'.$request->search_string.'%')
        ->orwhere('price','like','%'.$request->search_string.'%')
        ->orderBy('id','desc')
        ->paginate(5);

        if ($products->count() >= 1) {
            return view('pagination_product',compact('products'))->render();
        }
        else {
            return response()->json([
                'status' => 'product not found'
            ]);
        }
    }

}

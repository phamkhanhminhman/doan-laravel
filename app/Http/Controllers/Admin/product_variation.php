<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Alert;

class product_variation extends Controller
{
    public function index() //BY PHƯƠNG
    {
        $data_product  = DB::table('product_variation')
                                 ->select('*')
                                 ->orderBy('productID','desc')
                                 ->get();

        return view('admin/product_variation/product_variation',compact("data_product"));
    }

    public function edit($id)
    {
        $data_product = DB::table('product_variation')
                         ->select('*')->where('productVariationID',$id)
                         ->get();

        return view('admin/product_variation/product_variation_edit',compact('data_product'));
    }

    public function update(Request $request)
    {
    	$productVariationID   = $request->productVariationID;
        $productName = $request->productName;
        $productCost = $request->productCost;

      	$updated = DB::table('product_variation')->where('productVariationID', $productVariationID)->update(
                    [      
                        'productCost' => $productCost,
                    ]);


        $history = "Sửa sản phẩm tên là $productName và mã là $productVariationID";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name'=>$history, 'user' =>$user]);   
        if ($updated) {
          alert('Product Updated','Successfully', 'success');
        } else {
          alert('Product Updated','Nothing', 'success');
        }

        return redirect('/admin/product-variation');
    }
}

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
        $data_product        =DB::table('product_variation')
                                 ->select('*')
                                 ->get();

        return view('admin/product_variation/product_variation',compact("data_product"));
    }
}

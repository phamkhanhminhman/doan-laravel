<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class import_controller extends Controller
{
    
    public function index()
    {
    	
    	return view('admin/import/import');
    }

    public function add()
    {
    	return view('admin/import/import_add');
    }
}

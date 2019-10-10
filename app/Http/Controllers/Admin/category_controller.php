<?php
 /*
    *   Created by  :   pkmm - 15/1/2019 
    *   Description :   category crud
*/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class category_controller extends Controller
{
    public function index(Request $request)
    {   
        $value = $request->session()->get('name');
    	if ($value)
        {
            $data_category=DB::table('category')
                        ->select('*')
                        ->get();
            return view('admin/category/category',compact('data_category'));
        }
        else
        {
            return view('admin/login');
        }
    }
    public function get_data_api()
    {
        $data_category=DB::table('category')
                        ->select('*')
                        ->get();
        $data_category=json_encode($data_category);
        echo $data_category;
    }
    public function add()
    {
    	return view('admin/category/category_add');
    }
    public function edit($id)
    {
        $data_category=DB::table('category')
                        ->select('*')
                        ->where('categoryID',$id)
                        ->get();
    	return view('admin/category/category_edit',compact('data_category'));
    }
    public function insert(Request $request)
    {
        $id 			  =$request->input('categoryID');
        $name 			  =$request->input('categoryName');
        $note  			  =$request->input('categoryNote');
        $file             =$request->file('IMG');
        $anh              ="upload/".$file->getClientOriginalName();
        $typeImage        =$file->getClientOriginalExtension();
        $file->move('./upload/',$file->getClientOriginalName()); 
        $category = DB::table('category')->select('categoryID')->where('categoryID',$id)->get();
        if (count($category) == 0 )
        {
            DB::table('category')->insert(
                    [      
                            'categoryID'           =>$id,
                            'categoryName'         =>$name,
                            'categoryNote'         =>$note,
                            'IMG'                  =>$anh,
                            
                    ]);       
            $history = "Thêm 1 ngành hàng mới $name";
            $user = $request->session()->get('name');
            DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
            alert('Category Inserted','Successfully', 'success');
            return redirect('/admin/category/');
        }
        else
        {
            alert('Category Insert Failed','ID Duplocated', 'error');
            return redirect('/admin/category/');
        }
           
    }
    public function update(Request $request)
    {
        $id 			  =$request->input('categoryID');
        $name 			  =$request->input('categoryName');
        $note  			  =$request->input('categoryNote');
        $anhcu  		  =$request->input('anhcu');
        $file             =$request->file('IMG');
        if(empty($file)){
            $anh        =$anhcu;
        } else{
            $anh          ="upload/".$file->getClientOriginalName();
            $typeImage    = $file->getClientOriginalExtension();
            $file->move('./upload/',$file->getClientOriginalName()); 
        }
        $updated = DB::table('category')->where('categoryID',$id)->update(
                    [      
                            'categoryName'         =>$name,
                            'categoryNote'         =>$note,
                            'IMG'                  =>$anh,          
                    ]);
        $history = "Sửa ngành hàng $name";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
        if ($updated) {
          alert('Category Updated','Successfully', 'success');
        } else {
          alert('Category Updated','Nothing', 'success');
        }
        return redirect('/admin/category/');   
    }
    public function delete($id, Request $request)
    {
        $delete = DB::table('category')->where('categoryID',$id)->delete(); 
        $history = "Xóa ngành hàng $id";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
        if ($delete) {
          alert('Category Deleted','Successfully', 'success');
        } else {
          alert('Category Deleted','Nothing', 'success');
        }
        return redirect('/admin/category/');   
    }
}

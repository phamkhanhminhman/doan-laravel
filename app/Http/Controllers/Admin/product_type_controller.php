<?php
 /*
    *   Created by  :   nqp - 15/1/2019 
    *   Description :   product-type crud
    *   FIX         :   PKMM -17/1/2019
    *   Description :   data select box
    
*/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class product_type_controller extends Controller
{    
    public function index()
    {
    	$data_product_type=DB::table('producttype')
                                ->select('*')
                                ->get();
    	return view('admin/product_type/product_type',compact('data_product_type'));
    }

    public function add()
    {
        $data_categoryID=DB::table('category')
                                ->select('*')
                                ->get();
    	return view('admin/product_type/product_type_add',compact('data_categoryID'));
    }
    public function edit($id)
    {
        $data_product_type=DB::table('producttype')
                        ->select('*')
                        ->where('product_typeID',$id)
                        ->get();
        $data_category=DB::table('category')
                         ->select('*')
                         ->get();
    	return view('admin/product_type/product_type_edit',compact('data_product_type','data_category'));
    }
    public function insert(Request $request)
    {
        $product_typeID 			  =$request->input('product_typeID');
        $product_typeName 			  =$request->input('product_typeName');
        $categoryID  			      =$request->input('categoryID');
        $product_typeCost  			  =$request->input('product_typeCost');
        $product_typeSell  			  =$request->input('product_typeSell');
        $product_typeNote  			  =$request->input('product_typeNote');
        $file                         =$request->file('product_typeIMG');
        $product_typeStock            =0;
        $product_typeIMG              ="upload/".$file->getClientOriginalName();
        $typeImage                    =$file->getClientOriginalExtension();
        $file->move('./upload/',$file->getClientOriginalName()); 
        DB::table('producttype')->insert(
                    [      
                            'product_typeID'           =>$product_typeID,
                            'product_typeName'         =>$product_typeName,
                            'categoryID'               =>$categoryID,
                            'product_typeCost'         =>$product_typeCost,
                            'product_typeSell'         =>$product_typeSell,
                            'product_typeNote'         =>$product_typeNote,
                            'product_typeIMG'          =>$product_typeIMG,
                            'product_typeStock'        =>$product_typeStock
                            
                    ]);    
        $history = "Thêm 1 loại sản phẩm mới tên là $product_typeName";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name'=>$history, 'user' =>$user]);   
        return redirect('/admin/product-type');   
    }
    public function update(Request $request)
    {
        $product_typeID 			  =$request->input('product_typeID');
        $product_typeName 			  =$request->input('product_typeName');
        $categoryID  			      =$request->input('categoryID');
        $product_typeCost  			  =$request->input('product_typeCost');
        $product_typeSell  			  =$request->input('product_typeSell');
        $product_typeNote  			  =$request->input('product_typeNote');
        $file                         =$request->file('IMG');
        $product_typeStock            =0; 
        $anhcu  		              =$request->input('anhcu');
        if(empty($file)){
            $product_typeIMG          =$anhcu;
        } else{
            $product_typeIMG          ="upload/".$file->getClientOriginalName();
            $typeImage                =$file->getClientOriginalExtension();
            $file->move('./upload/',$file->getClientOriginalName()); 
        }
        $updated = DB::table('producttype')->where('product_typeID',$product_typeID)->update(
                    [      
                        'product_typeID'               =>$product_typeID,
                        'product_typeName'             =>$product_typeName,
                        'categoryID'                   =>$categoryID,
                        'product_typeCost'             =>$product_typeCost,
                        'product_typeSell'             =>$product_typeSell,
                        'product_typeNote'             =>$product_typeNote,
                        'product_typeIMG'              =>$product_typeIMG,
                        'product_typeStock'            =>$product_typeStock  
                    ]);
        $history = "Sửa loại sản phẩm tên là $product_typeName";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name'=>$history, 'user' =>$user]);   
        if ($updated) {
          alert('Product Type Updated','Successfully', 'success');
        } else {
          alert('Product Type Updated','Nothing', 'success');
        }
        return redirect('/admin/product-type');   
    }
    public function delete($id, Request $request)
    {  
        $delete = DB::table('producttype')->where('product_typeID',$id)->delete(); 
        if ($delete) {
          alert('Product Type Deleted','Successfully', 'success');
        } else {
          alert('Product Type Deleted','Nothing', 'success');
        }
        $history = "Xóa loại sản phẩm tên là $id";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name'=>$history, 'user' =>$user]); 
        return redirect('/admin/product-type');   
    }


}

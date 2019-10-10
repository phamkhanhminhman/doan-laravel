<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class customer_controller extends Controller
{
	public function index()
	{
		$customer = DB::table('customer')->select('*')->get();
		return view('admin/customer/customer',compact('customer'));
	}
	public function table()
	{
		$customer = DB::table('customer')->select('*')->get();
		return view('admin/customer/customer_table',compact('customer'));
	}
	public function profile($id)
	{
	    $profile   		= DB::table('customer')
	    					->select('*')
	    					->where('customerID',$id)
	    					->get();

	    $order_profile  = DB::table('order_tb')
	    					->select('*')
	    					->join('customer','order_tb.customerID', '=', 'customer.customerID')
	    					->where('customer.customerID',$id)
	    					->get();
	    return view('admin/customer/profile',compact('profile','order_profile'));
	}
	public function edit($id)
	{
		$customer = DB::table('customer')
							->select('*')
							->where('customerID',$id)
							->get();
		return view('admin/customer/customer_edit',compact('customer'));
	}
	public function update(Request $request)
	{
		$customerID = $request->customerID;
		$customerName = $request->customerName;
		$customerGender = $request->customerGender;
		$customerTel = $request->customerTel;
		$customerMail = $request->customerMail;
		$customerNote = $request->customerNote;

		$updated = DB::table('customer')
							->where('customerID', $customerID)
							->update([
								'customerName'=>$customerName,
								'customerGender'=>$customerGender,
								'customerTel'=>$customerTel,
								'customerMail'=>$customerMail,
								'customerNote'=>$customerNote,
							]);
		$history = "Sửa tên khách hàng là $customerName";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name'=>$history, 'user' =>$user]);   
        if ($updated) {
          alert('Customer Updated','Successfully', 'success');
        } else {
          alert('Customer Updated','Nothing', 'success');
        }
        return redirect('/admin/customer');  
	}
	public function delete($id, Request $request)
	{
	  $delete = DB::table('customer')->where('customerID', $id)->delete();
      $history = "Xóa khách hàng có id : $id";
      $user = $request->session()->get('name');
      DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
      if ($delete) {
        alert('Customer Deleted','Successfully', 'success');
      } else {
        alert('Customer Deleted','Nothing', 'success');
      }   
      return redirect('/admin/customer');

	}

}


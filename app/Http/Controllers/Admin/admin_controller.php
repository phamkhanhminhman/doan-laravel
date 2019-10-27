<?php
/*
    *   Updated by  :   pkmm - 26/2/2019 - viet ham index,list sp bán chạy
    *   Updated by  :   pkmm - 3/4/2019 - show các chỉ số doanh thu ra phần dashboard, cập nhật history...
    *   Updated by  :   pkmm - 17/4/2019 - table history, update edit staff...............
    *   Description :   login,logout
*/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Alert;

class admin_controller extends Controller
{
	public function index()
	{
        $this->update_report_thang();
		$product  =   DB::table('producttype')
                                ->select('*')
                                ->orderBy('amount_sell','desc')
                                ->limit(5)
                                ->get();
        $history  =   DB::table('history')
        						->select('*')
        						->orderBy('id','desc')
        						->limit(6)
        						->get();
        $amount_product   =   DB::table('product')
                                ->select('*')
                                ->where('productStatus','Instock')
                                ->get();
        $don_chua_hoan_thanh = DB::table('order_tb')
        						->select('*')
        						->where('orderStatus','Shipping')
        						->orWhere('orderStatus','Returning')
        						->orWhere('orderStatus','ReturnOK')
        						->orWhere('orderStatus','Received')
        						->orWhere('orderStatus','Complain')
        						->get();
        $tonkho = count($amount_product);
        $don_chua_hoan_thanh = count($don_chua_hoan_thanh);
        $amount_sell = 0;
        

        $month    = date("m");
        $report_thang_hientai   = DB::table('report_thang')->select('*')->where('report_thang_id',$month)->get();
        $report_thang_truoc     = DB::table('report_thang')->select('*')->where('report_thang_id',$month-1)->get();

        foreach ($report_thang_hientai as $k) 
        {
        	$doanhthu_hientai = $k->doanhthu;
        	$loinhuan_hientai = $k->loinhuan;
        	$tongvon_hientai = $k->tongvon;
        	$tongsodonhang_hientai= $k->tongsodonhang;
            $bombhang = $k->tongsobombhang;
            $complain = $k->tongsokhieunai;
        } 
        foreach ($report_thang_truoc as $key) 
        {
        	$doanhthu_truoc = $key->doanhthu;
        	$loinhuan_truoc = $key->loinhuan;
        	$tongvon_truoc = $key->tongvon;
        	$tongsodonhang_truoc = $key->tongsodonhang;
            $bombhang_truoc = $key->tongsobombhang;
            $complain_truoc = $key->tongsokhieunai;
        }
        if ($doanhthu_truoc == 0)
        {
            $doanhthu_up = 0;
            $loinhuan_up = 0;
            $tongvon_up = 0;
            $tongsodonhang_up = 0;
            $bombhang_up = 0;
            $complain_up = 0;
        }
        else {
            $doanhthu_up = ($doanhthu_hientai/$doanhthu_truoc)*100 - 100;
            $loinhuan_up = ($loinhuan_hientai/$loinhuan_truoc)*100 - 100;
			// $tongvon_up = ($tongvon_hientai/$tongvon_truoc)*100 - 100;
			$tongvon_up = 500;
            $tongsodonhang_up = ($tongsodonhang_hientai/$tongsodonhang_truoc)*100 - 100;
        }


        return view('admin/admin',compact('product','history','report_thang_hientai','doanhthu_up','loinhuan_up','tongvon_up','tongsodonhang_up','tonkho','don_chua_hoan_thanh','complain'));
	}
	public function signup()
	{
		return view('admin/signup');
	}
	public function dangky(Request $request)
	{
		$user = $request->user;
		$pass = $request->pass;
		$name = $request->name;
		$age  = $request->age;
		$tel  = $request->tel;
		$address = $request->address;
		$role = $request->role;
		$pass = md5($pass);
		DB::table('admin')->insert(
                    [      
                            'user_name'           =>$user,          
                            'user_password'       =>$pass,   
                            'name'=>$name,
                            'age'=>$age,
                            'tel'=>$tel,
                            'address'=>$address,
                            'role'=> $role,
                    ]);       
		return redirect('admin/staff');
	}
	public function login()
	{
		return view('admin/login');
	}
	public function check_login(Request $request)
	{
		$user = $request->user;
		$pass = $request->pass; 
		$pass = md5($pass);
		$request->session()->put('name', $user);
		$db   = DB::table('admin')
						->select('*')
						->get();
		$db   = DB::table('admin')
						->where([['user_name', $user],['user_password', $pass]])
						->get();

	    $d    = count($db);

		if($d==1)
		{	
			foreach ($db as $key) 
			{
				$role = $key->role;
			}
			$request->session()->put('role', $role);
			$history = "Login thành công";
			$user = $request->session()->get('name');
    	    DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
            alert('Login Successfully','Welcome', 'success');
            // toast('Login Successfully', 'Welcome', $position = 'bottom-right');
			return redirect('/admin');
		}
		else 
		{
			alert('Wrong ID or Password','Failed', 'error');
			return redirect('/');
		}
	}
	public function logout(Request $request)
	{
		$history = "Logout thành công";
		$user = $request->session()->get('name');
	    DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
        $forget = $request->session()->forget('name');
        alert('Logout Successfully','See you later', 'success');
        return redirect('/');
    }
    public function history()
    {
    	$history = DB::table('history')->select('*')->get();
    	return view('admin/history', compact('history'));
    }
    public function staff()
    {
    	$staff  = DB::table('admin')->select('*')->get();
    	return view('admin/staff/staff', compact('staff'));
    }
    public function edit($id)
    {
    	$staff = DB::table('admin')->select('*')->where('id',$id)->get();
    	return view('admin/staff/staff_edit', compact('staff'));
    }
    public function update(Request $request)
    {   
    	$id = $request->id;
        $name = $request->name;
        $age = $request->age;
        $address = $request->address;
        $tel = $request->tel;
        $updated = DB::table('admin')
        					->select('*')
        					->where('id', $id)
        					->update(
        						[
        							'name'=>$name, 
        							'age'=>$age,
        							'address'=>$address,
        							'tel'=>$tel,
        						]);

        $history = "Sửa thông tin nhân viên: $name";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
        if ($updated) {
          alert('Staff Updated','Successfully', 'success');
        } else {
          alert('Staff Updated','Nothing', 'success');
        }   
        return redirect('/admin/staff');
    }
    public function delete($id, Request $request)
    {
    	$delete = DB::table('admin')->select('*')->where('id',$id)->delete();
    	$history = "Xóa nhân viên: $id";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
        if ($delete) {
          alert('Staff Deleted','Successfully', 'success');
        } else {
           alert('Staff Deleted','Nothing', 'success');
        }   
        return redirect('/admin/staff');
    }

    public function update_report_thang()
    {
        $month = date('m');
        $year = date('Y');

        $order = DB::table('order_tb')
                    ->whereYear('orderDate',$year)
                    ->whereMonth('orderDate', $month)
                    ->get();

        $doanhthu = 0;
        $loinhuan = 0;
        $tongvon = 0;
        $tienhangdaban = 0;
        $tongsobomhang = 0;
        $tiendongbang = 0;
        $tongsodonchuahoanthanh = 0;

        foreach ($order as $k) {
            if ($k->orderStatus != 13 || $k->orderStatus != 22) {
                $doanhthu = $doanhthu + $k->orderSell;
                $tongvon = $tongvon + $k->orderCost;
                $tienhangdaban = $tienhangdaban + $k->orderCost;
            }

            if ( $k->orderStatus != 8 && $k->orderStatus != 13 ) {
                $tiendongbang = $tiendongbang + $k->orderSell;
                $tongsodonchuahoanthanh++;
            }

            if ($k->orderStatus == 13) {
                $tongsobomhang++;
            }
        } 



        $loinhuan = $doanhthu - $tongvon;
        $tongsodonhang = count($order);

        $expense = DB::table('expense')
                    ->whereMonth('updated', $month)
                    ->whereYear('updated', $year)
                    ->select('*')
                    ->get();

        $expense_sum = 0;
        foreach ($expense as $k) {
            $expense_sum = $expense_sum + $k->expense_cost;
        }

        DB::table('report_thang')
                ->where('report_thang_id' , $month)
                ->where('report_nam_id' , $year)
                ->update([
                    'doanhthu' => $doanhthu,
                    'loinhuan' => $loinhuan,
                    'tongvon' => $tongvon,
                    'tienhangdaban' => $tienhangdaban,
                    'tongsodonhang' => $tongsodonhang,
                    'tongsobombhang' => $tongsobomhang,
                    'tiendongbang' => $tiendongbang,
                    'tongsodonchuahoanthanh' => $tongsodonchuahoanthanh,
                    'chiphi' => $expense_sum
                ]);

        // var_dump($doanhthu);
        // var_dump($loinhuan);
        // var_dump($tongsodonhang);
        // var_dump($tongsobomhang);
        // var_dump($tiendongbang);
    }
}


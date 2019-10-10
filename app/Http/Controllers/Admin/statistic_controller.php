<?php
 /*
    *   Created by  :   pkmm - 2/3/2019 
    *   Description :   thống kê
*/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class statistic_controller extends Controller
{
	public function index()
	{
		// $stt=336;
		// for ($i=1; $i <=31 ; $i++) 
		// { 
		// 	$a=DB::table('report_ngay')
		// 	->select('*')
		// 	->where('report_thang_id',12)
		// 	->where('stt',$stt)
		// 	->update(['report_ngay_id'=>$i]);
		// 	$stt=$stt+1;
		// }
		$statistic = DB::table('report_ngay')->select('*')->get(); 
		return view('admin/statistic/statistic',compact('statistic'));
	}
	public function month()
	{
		
		$statistic = DB::table('report_thang')->select('*')->get(); 
		return view('admin/statistic/statistic_month',compact('statistic'));
	}
	public function chart_month()
	{
		$chart     = DB::table('report_thang')->select('*')->get();
		$data      = array();
		foreach ($chart as $row) 
		{
			$data[]=$row;
		}
		$data=json_encode($data);
		echo $data;
	}
	public function month_order($month)
	{	
		//$order = DB::table('order_tb')->select('*')->get();
		$order = DB::table('order_tb')->join('customer','order_tb.customerID', '=', 'customer.customerID')
						->join('devvn_tinhthanhpho','order_tb.orderAddress','=','devvn_tinhthanhpho.matp')
						->select('*')
						->whereMonth('orderCreate',$month)
						->get(); 
	    $report_thang_hientai   = DB::table('report_thang')->select('*')->where('report_thang_id',$month)->get();
        $report_thang_truoc     = DB::table('report_thang')->select('*')->where('report_thang_id',$month-1)->get();
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
       	$complain = DB::table('order_tb')
        						->select('*')
        						->where('orderStatus','Complain')
        						->get();
        $complain = count($complain);
        $tonkho = count($amount_product);
        $don_chua_hoan_thanh = count($don_chua_hoan_thanh);
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
            $tongvon_up = ($tongvon_hientai/$tongvon_truoc)*100 - 100;
            $tongsodonhang_up = ($tongsodonhang_hientai/$tongsodonhang_truoc)*100 - 100;
        }

		return view('/admin/statistic/statistic_month_order',compact('order','report_thang_hientai','doanhthu_up','loinhuan_up','tongvon_up','tongsodonhang_up','complain','tonkho','don_chua_hoan_thanh'));
	}
}

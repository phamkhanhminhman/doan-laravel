<?php
/*
    *   Created by  :   pkmm - 5/3/2019 
    *   Updated by  :   pkmm - 4/4/2019 - viết lại hàm update_report, edit update chi phí....
    *   Updated by  :   pkmm - 11/4/2019  - viết thêm hàm delete
    *   Description :   Update bảng report sau khi add chi phí
*/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class expense_controller extends Controller
{
	public function index()
	{
		$expense = DB::table('expense')->select('*')->get();
		return view('admin/expense/expense',compact('expense'));
	}
	public function update_report() // gọi ra để cập nhật lại table report_tháng khi crud,
	{
      // $get_ngay      =     DB::table('expense')->select('*')->limit(1)->orderBy('id','desc')->get();
      // foreach ($get_ngay as $p) 
      // {
      //   $ngaythang   =     $p->created;
      //   $ngayht      =     date('d',strtotime("$ngaythang"));
      //   $thanght     =     date('m',strtotime("$ngaythang"));
      //   $cost 	     =     $p->expense_cost;
      // }
      // // START UPDATE REPORT NGAY KHI CLICK DA NHAN TIEN-------------------------------------------------------------------------------
      // $stat_day     =     DB::table('report_ngay')
      //                               ->select('*')
      //                               ->where('report_ngay_id',$ngayht)
      //                               ->where('report_thang_id',$thanght)
      //                               ->get();
      // foreach ($stat_day as $pp) 
      // {
      //   $loinhuan    =    $pp->loinhuan;
      //   $chiphi      =    $pp->chiphi;
      // } 
      //   $update_stat =    DB::table('report_ngay')->select('*')
      //                             ->where('report_ngay_id',$ngayht)
      //                             ->where('report_thang_id',$thanght)
      //                             ->update(
      //                                 [
      //                                   'loinhuan'     =>$loinhuan-$cost,   
      //                                   'chiphi'       =>$chiphi+$cost                          
      //                                 ]);    
      //   // START UPDATE REPORT THANG KHI CLICK DA NHAN TIEN----------------------------------------------------------------------------
      // for ($i=1; $i <=12 ; $i++) 
      // { 
      //   $stat_month    =    DB::table('report_ngay')->select('*')             
      //                              ->where('report_thang_id',$i)
      //                              ->get();     
      //     $doanhthu_month =   0;
      //     $loinhuan_month =   0;
      //     $tongvon_month  =   0;
      //     $donhang_month  =   0;
      //     $bombhang_month =   0;
      //     $khieunai_month =   0;
      //   foreach ($stat_month as $s) 
      //   {
      //     $doanhthu_day   = $s->doanhthu;
      //     $loinhuan_day   = $s->loinhuan;
      //     $tongvon_day    = $s->tongvon;
      //     $donhang_day    = $s->tongsodonhang;
      //     $doanhthu_month = $doanhthu_month+$doanhthu_day;         
      //     $loinhuan_month = $loinhuan_month+$loinhuan_day; 
      //     $tongvon_month  = $tongvon_month  +$tongvon_day;
      //     $donhang_month  = $donhang_month  +$donhang_day;

      //   }
      //   $up_stat_month =    DB::table('report_thang')
      //                                ->select('*')
      //                                ->where('report_thang_id',$i)
      //                                ->update(
      //                                   [
      //                                     'doanhthu'=>$doanhthu_month,
      //                                     'loinhuan'=>$loinhuan_month,
      //                                     'tongvon'=>$tongvon_month,
      //                                     'tongsodonhang'=>$donhang_month,

      //                                   ]);

      // }
      // // END UPDATE REPORT NGAY KHI CLICK DA NHAN TIEN---------------------------------------------------------------------------------
        $month = date('m');
        $expense_month = DB::table('expense')->select('*')->whereMonth('created',$month)->get();
        $chiphi = 0;
        foreach ($expense_month as $p) 
        {
          $chiphi = $chiphi + $p->expense_cost;
        }
        $stat_month = DB::table('report_thang')->select('*')->where('report_thang_id', $month)->get();
        foreach ($stat_month as $k) 
        {
          $loinhuan = $k->loinhuan;
          $doanhthu = $k->doanhthu;
          $tongvon  = $k->tongvon;
        }
        DB::table('report_thang')->select('*')->where('report_thang_id', $month)->update(['loinhuan'=>$doanhthu-$tongvon-$chiphi]);
    }
    public function insert(Request $request)
    {
        $name = $request->expense_name;
        $cost = $request->expense_cost;

        $inserted =DB::table('expense')->insert(
                    [      
                        'expense_name'         =>$name,
                        'expense_cost'         =>$cost,
                    ]);       
        $this->update_report();
        $history = "Thêm 1 loại chi phí mới: $name";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
        if ($inserted) {
          alert('Expense inserted','Successfully', 'success');
        } else {
          alert('Error','Nothing', 'error');
        }   
        return redirect('/admin/expense/'); 
    }
    public function edit($id)
    {
        $data_expense = DB::table('expense')->select('*')->where('id',$id)->get();
        return view('admin/expense/expense_edit', compact('data_expense'));
    }
    public function update(Request $request)
    {   
        $expense_id   = $request->expense_id;
        $expense_name = $request->expense_name;
        $expense_cost = $request->expense_cost;
        $updated = DB::table('expense')->select('*')->where('id', $expense_id)->update(['expense_name'=>$expense_name, 'expense_cost'=>$expense_cost]);
        $this->update_report();
        $history = "Sửa loại chi phí: $expense_name";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
        if ($updated) {
          alert('Expense Updated','Successfully', 'success');
        } else {
          alert('Expense Updated','Nothing', 'success');
        }   
        return redirect('/admin/expense');
    }
    public function delete($id, Request $request)
    {

      $delete = DB::table('expense')->where('id', $id)->delete();
      $this->update_report();
      $history = "Xóa loại chi phí: $id";
      $user = $request->session()->get('name');
      DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
      if ($delete) {
        alert('Expense Deleted','Successfully', 'success');
      } else {
        alert('Expense Deleted','Nothing', 'success');
      }   
      return redirect('/admin/expense');

    }
}


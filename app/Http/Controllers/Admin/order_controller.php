<?php
/*
 *   Created by  :   pkmm - 25/1/2019
 *   Updated by  :   pkmm - 27/1/2019
 *   Updated by  :   pkmm - 27/1/2019 - insert order,customer
 *   Updated by  :   pkmm - 21/2/2019 - api return img, list data order by api
 *   Updated by  :   pkmm - 26/2/2019 - api COUNT số lượng loại đơn hàng, select đơn vị vận chuyển,change status product
 *   Updated by  :   pkmm - 2/3/2019  - cập nhật doanh thu vào bảng report
 *   Updated by  :   pkmm - 4/4/2019  - Sửa lại thuật toán cách cập nhật report,
 *   Updated by  :   pkmm - 6/4/2019  - Viết thêm hàm cho ReturnOK
 *   Description :   Search tinh tien auto, fetch order detail
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class order_controller extends Controller
{

    public function order_api_all(Request $request) //api return ve danh sach order------------------------------------------------------------------
    {
        $pageIndex= $request->page;
        $pageLimit= $request->limit;
        //dd($pageLimit);
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerTel', '=', 'customer.customerTel')
            ->select('*')
            ->orderBy('orderDate', 'desc')
            ->get()
            ->toArray();
        
        $array_start=$pageIndex*10-10;
        $array_length=$pageLimit;   
        $array_slice=array_slice($data_order,$array_start,$array_length);

        $data_order = json_encode($array_slice); // convert to JSON 
        echo $data_order;
    }

    public function order_api_allv2() //api return ve sp trong 1 don------------------------------------------------------------------
    {
        // $test = DB::table('order_tb_product')->leftjoin('product', 'order_tb_product.productID', '=', 'product.productID')
        //     ->select('*')
        //     ->get();
        // -------------------------------------------------------------------------------------------------------------------------------

        $test = DB::table('order_tb_product')->leftjoin('product_variation', 'order_tb_product.variantSKU', '=', 'product_variation.productVariationID')
            ->select('*')
            ->get();
        $test = json_encode($test);
        echo $test;
    }

    public function count_order_all() //ĐẾM TẤT CẢ SỐ LƯỢNG ĐƠN------------------------------------------------------------------------

    {
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->get();
        $tongsodonhang = count($data_order);
        $tongsodonhang = json_encode($tongsodonhang);
        echo $tongsodonhang;
    }


    public function order_api_dhvc() //api return ve don co orderStatus="Shipping,Received"-----------------------------------------------------
    {
        
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerTel', '=', 'customer.customerTel')
        ->select('*')
        ->where('orderStatus',6)
        ->orderBy('orderDate', 'desc')
        ->get();

        $data_order = json_encode($data_order);
        echo $data_order;
    }

    public function count_order_ship_and_received() //ĐẾM SỐ LƯỢNG ĐƠN STATUS=SHIPPINNG,RECEIVED--------------------------------------------

    {
        $shipping = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 6)
            ->get();
        $shipping = count($shipping);
        $shipping = json_encode($shipping);
        echo $shipping;
    }

    public function api_selected_channel(Request $request)
    {
        $channel = $request->xyz;
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->orderBy('orderDate', 'desc')
            ->where('orderChannel', $channel)
            ->get();
        $data_order = json_encode($data_order);
        echo $data_order;
    }










    


    
    public function index() //thay bang cach get api

    {
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->get();
        $test = DB::table('order_tb_product')->leftjoin('product', 'order_tb_product.productID', '=', 'product.productID')
            ->select('*')
            ->get();
        return view('admin/order/order', compact('data_order', 'test'));
    }
    
    
    public function count_order_shipping() //ĐẾM SỐ LƯỢNG ĐƠN STATUS=SHIPPINNG---------------------------------------------------------

    {
        $shipping = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Shipping')
            ->get();
        $shipping = count($shipping);
        $shipping = json_encode($shipping);
        echo $shipping;
    }
    public function count_order_received() //ĐẾM SỐ LƯỢNG ĐƠN STATUS=RECEIVED----------------------------------------------------------

    {
        $received = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Received')
            ->get();
        $received = count($received);
        $received = json_encode($received);
        echo $received;
    }
    public function count_order_done_and_returnok() //ĐẾM SỐ LƯỢNG ĐƠN STATUS=DONE,RETURNOK-------------------------------------------

    {
        $done = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Done')
            ->orWhere('orderStatus', 'ReturnOK')
            ->get();
        $done = count($done);
        $done = json_encode($done);
        echo $done;
    }
    public function count_order_done() //ĐẾM SỐ LƯỢNG ĐƠN STATUS=DONE------------------------------------------------------------------

    {
        $done = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Done')
            ->get();
        $done = count($done);
        $done = json_encode($done);
        echo $done;
    }
    public function count_order_returnok() //ĐẾM SỐ LƯỢNG ĐƠN STATUS=RETURNOK------------------------------------------------------------------

    {
        $returnok = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'ReturnOK')
            ->get();
        $returnok = count($returnok);
        $returnok = json_encode($returnok);
        echo $returnok;
    }
    public function count_order_returning_and_complain()
    {
        $returning = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Returning')
            ->orWhere('orderStatus', 'Complain')
            ->get();
        $returning = count($returning);
        $returning = json_encode($returning);
        echo $returning;
    }
    public function count_order_returning()
    {
        $returning = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Returning')
            ->get();
        $returning = count($returning);
        $returning = json_encode($returning);
        echo $returning;
    }
    public function count_order_complain()
    {
        $complain = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Complain')
            ->get();
        $complain = count($complain);
        $complain = json_encode($complain);
        echo $complain;
    }
    
    
    
    public function order_api_shipping() //api return ve don co orderStatus="Shipping"-----------------------------------------------------

    {
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerTel', '=', 'customer.customerTel')
        ->select('*')
        ->where('orderStatus',6)
        ->orderBy('orderDate', 'desc')
        ->get();

        // $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
        //     ->join('devvn_tinhthanhpho', 'order_tb.orderAddress', '=', 'devvn_tinhthanhpho.matp')
        //     ->select('*')
        //     ->where('orderStatus', 'LIKE', 'Shipping')
        //     ->orderBy('orderCreate', 'desc')
        //     ->get();
        $data_order = json_encode($data_order);
        echo $data_order;
    }
    public function order_api_dnh() //api return ve don co orderStatus="Received"------------------------------------------------------

    {
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->join('devvn_tinhthanhpho', 'order_tb.orderAddress', '=', 'devvn_tinhthanhpho.matp')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Received')
            ->orderBy('orderCreate', 'desc')
            ->get();
        $data_order = json_encode($data_order);
        echo $data_order;
    }
    public function order_api_dhht() //api return ve don co orderStatus="Done","ReturnOK"-----------------------------------------------

    {
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->join('devvn_tinhthanhpho', 'order_tb.orderAddress', '=', 'devvn_tinhthanhpho.matp')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Done')
            ->orWhere('orderStatus', 'ReturnOK')
            ->orderBy('orderCreate', 'desc')
            ->get();
        $data_order = json_encode($data_order);
        echo $data_order;
    }
    public function order_api_dnt() //api return ve don co orderStatus="Done"-----------------------------------------------

    {
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->join('devvn_tinhthanhpho', 'order_tb.orderAddress', '=', 'devvn_tinhthanhpho.matp')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Done')
            ->orderBy('orderCreate', 'desc')
            ->get();
        $data_order = json_encode($data_order);
        echo $data_order;
    }
    public function order_api_dnl() //api return ve don co orderStatus="ReturnOK"-----------------------------------------------

    {
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->join('devvn_tinhthanhpho', 'order_tb.orderAddress', '=', 'devvn_tinhthanhpho.matp')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'ReturnOK')
            ->orderBy('orderCreate', 'desc')
            ->get();
        $data_order = json_encode($data_order);
        echo $data_order;
    }
    public function order_api_dhsc() //api return ve don co orderStatus="Returning, Complain"----------------------------------------------------------

    {
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->join('devvn_tinhthanhpho', 'order_tb.orderAddress', '=', 'devvn_tinhthanhpho.matp')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Returning')
            ->orWhere('orderStatus', 'LIKE', 'Complain')
            ->orderBy('orderCreate', 'desc')
            ->get();
        $data_order = json_encode($data_order);
        echo $data_order;
    }
    public function order_api_ch() //api return ve don co orderStatus="Returning"----------------------------------------------------------

    {
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->join('devvn_tinhthanhpho', 'order_tb.orderAddress', '=', 'devvn_tinhthanhpho.matp')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Returning')
            ->orderBy('orderCreate', 'desc')
            ->get();
        $data_order = json_encode($data_order);
        echo $data_order;
    }
    public function order_api_kn() //api return ve don co orderStatus="Complain"----------------------------------------------------------

    {
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->join('devvn_tinhthanhpho', 'order_tb.orderAddress', '=', 'devvn_tinhthanhpho.matp')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Complain')
            ->orderBy('orderCreate', 'desc')
            ->get();
        $data_order = json_encode($data_order);
        echo $data_order;
    }

    public function order_detail(Request $request)
    {
        $query = $request->get('orderID');
        $data_test = DB::table('order_tb_product')->select('*')->where('orderID', $query)->get();
        $data_test = json_encode($data_test);
        return $data_test;
    }











































    public function update_report()
    {
        $month = date('m');
        $stat_month = DB::table('order_tb')->select('orderCost', 'orderSell', 'orderCreate')->whereMonth('orderCreate', $month)->where('orderStatus', 'Done')->get(); // tinh don status = done
        $bombhang = DB::table('order_tb')->select('orderCost', 'orderSell', 'orderCreate')->whereMonth('orderCreate', $month)->where('orderStatus', 'Returning')->get(); // tinh don status = done
        $complain = DB::table('order_tb')->select('orderCost', 'orderSell', 'orderCreate')->whereMonth('orderCreate', $month)->where('orderStatus', 'Complain')->get(); // tinh don status = done
        $doanhthu = 0;
        $loinhuan = 0;
        $tongvon = 0;
        foreach ($stat_month as $p) {
            $doanhthu = $doanhthu + $p->orderSell;
            $tongvon = $tongvon + $p->orderCost;
            $loinhuan = $doanhthu - $tongvon;
        }
        $tongsodonhang = count($stat_month);
        $bombhang = count($bombhang);
        $complain = count($complain);
        DB::table('report_thang')->select('*')->where('report_thang_id', $month)
            ->update(
                [
                    'doanhthu' => $doanhthu,
                    'loinhuan' => $loinhuan,
                    'tongvon' => $tongvon,
                    'tongsodonhang' => $tongsodonhang,
                    'tongsobombhang' => $bombhang,
                    'tongsokhieunai' => $complain,
                ]);
    }




































































































































    public function order_api_changeStatus(Request $request) //api chuyển trang thái orderStatus thành Received-------------------------

    {
        $query = $request->input('dnh');
        $d1 = DB::table('order_tb')->select('*')
            ->where('orderID', 'LIKE', "$query")
            ->update(['orderStatus' => 'Received', 'orderStatus_vi' => 'Đã nhận']);

        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Shipping')
            ->orderBy('orderCreate', 'desc')
            ->get();
        $history = "Cập nhật đơn hàng sang trạng thái ĐÃ NHẬN HÀNG có mã là $query";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name' => $history, 'user' => $user]);
        $this->update_report();
        $data_order = json_encode($data_order);

        echo $data_order;
    }

    public function order_api_changeStatusv2(Request $request) //api chuyển orderStatus thành Done, CẬP NHẬT BẢNG REPORT------------------

    {
        $query = $request->input('dnh');
        $update_order = DB::table('order_tb')->select('*')
            ->where('orderID', 'LIKE', "$query")
            ->update(['orderStatus' => 'Done', 'orderStatus_vi' => 'Đã nhận tiền']);

        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Received')
            ->orderBy('orderCreate', 'desc')
            ->get();
        $history = "Cập nhật đơn hàng sang trạng thái ĐÃ NHẬN TIỀN có mã là $query";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name' => $history, 'user' => $user]);
        //  $get_ngay      =     DB::table('order_tb')->select('*')->where('orderID', 'LIKE', "$query")->get();

        //  foreach ($get_ngay as $p)
        //  {
        //    $ngaythang   =     $p->orderCreate;
        //    $ngayht      =     date('d',strtotime("$ngaythang"));
        //    $thanght     =     date('m',strtotime("$ngaythang"));
        //    $orderCost   =     $p->orderCost;
        //    $orderSell   =     $p->orderSell;
        //  }
        //  // START UPDATE REPORT NGAY KHI CLICK DA NHAN TIEN-------------------------------------------------------------------------------
        //  $stat_day     =     DB::table('report_ngay')
        //                                ->select('*')
        //                                ->where('report_ngay_id',$ngayht)
        //                                ->where('report_thang_id',$thanght)
        //                                ->get();
        //  foreach ($stat_day as $pp)
        //  {
        //    $doanhthu    =    $pp->doanhthu;
        //    $loinhuan    =    $pp->loinhuan;
        //    $tongvon     =    $pp->tongvon;
        //    $donhang     =    $pp->tongsodonhang;
        //    $bombhang    =    $pp->tongsobombhang;
        //    $khieunai    =    $pp->tongsokhieunai;
        //  }
        //    $update_stat =    DB::table('report_ngay')->select('*')
        //                              ->where('report_ngay_id',$ngayht)
        //                              ->where('report_thang_id',$thanght)
        //                              ->update(
        //                                  [
        //                                    'doanhthu'     =>$orderSell+$doanhthu,
        //                                    'loinhuan'     =>$loinhuan+$orderSell-$orderCost,
        //                                    'tongvon'      =>$tongvon+$orderCost,
        //                                    'tongsodonhang'=>$donhang+1,

        //                                  ]);
        //  // END UPDATE REPORT NGAY KHI CLICK DA NHAN TIEN------------------------------------------------------------------------------

        //  // START UPDATE REPORT THANG KHI CLICK DA NHAN TIEN----------------------------------------------------------------------------
        //  for ($i=1; $i <=12 ; $i++)
        //  {
        //    $stat_month    =    DB::table('report_ngay')->select('*')
        //                               ->where('report_thang_id',$i)
        //                               ->get();
        //      $doanhthu_month =   0;
        //      $loinhuan_month =   0;
        //      $tongvon_month  =   0;
        //      $donhang_month  =   0;
        //      $bombhang_month =   0;
        //      $khieunai_month =   0;
        //    foreach ($stat_month as $s)
        //    {
        //      $doanhthu_day   = $s->doanhthu;
        //      $loinhuan_day   = $s->loinhuan;
        //      $tongvon_day    = $s->tongvon;
        //      $donhang_day    = $s->tongsodonhang;
        //      $doanhthu_month = $doanhthu_month+$doanhthu_day;
        //      $loinhuan_month = $loinhuan_month+$loinhuan_day;
        //      $tongvon_month  = $tongvon_month  +$tongvon_day;
        //      $donhang_month  = $donhang_month  +$donhang_day;

        //    }
        //    $up_stat_month =    DB::table('report_thang')
        //                                 ->select('*')
        //                                 ->where('report_thang_id',$i)
        //                                 ->update(
        //                                    [
        //                                      'doanhthu'=>$doanhthu_month,
        //                                      'loinhuan'=>$loinhuan_month,
        //                                      'tongvon'=>$tongvon_month,
        //                                      'tongsodonhang'=>$donhang_month,

        //                                    ]);
        //  }
        //  // END UPDATE REPORT NGAY KHI CLICK DA NHAN TIEN---------------------------------------------------------------------------------

        // $data_order    =     json_encode($data_order);
        // echo $data_order;

        // START UPDATE REPORT THANG KHI CLICK DA NHAN TIEN----------------------------------------------------------------------------
        $this->update_report();
        // END UPDATE REPORT THANG KHI CLICK DA NHAN TIEN----------------------------------------------------------------------------
        $data_order = json_encode($data_order);
        echo $data_order;
    }
    public function order_api_changeStatusv3(Request $request) //api chuyển trang thái orderStatus thành Return-----------------

    {
        $query = $request->input('dnh');
        $d1 = DB::table('order_tb')->select('*')
            ->where('orderID', 'LIKE', "$query")
            ->update(['orderStatus' => 'Returning', 'orderStatus_vi' => 'Chuyển hoàn']);

        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Received')
            ->orderBy('orderCreate', 'desc')
            ->get();
        $history = "Cập nhật đơn hàng sang trạng thái CHUYỂN HOÀN có mã là $query";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name' => $history, 'user' => $user]);
        $this->update_report();
        $data_order = json_encode($data_order);
        echo $data_order;
    }
    public function order_api_changeStatusv4(Request $request) //api chuyển trang thái orderStatus thành COMPLAIN-----------------

    {
        $query = $request->input('dnh');
        $d1 = DB::table('order_tb')->select('*')
            ->where('orderID', 'LIKE', "$query")
            ->update(['orderStatus' => 'Complain', 'orderStatus_vi' => 'Khiếu nại']);

        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'Complain')
            ->orderBy('orderCreate', 'desc')
            ->get();
        $history = "Cập nhật đơn hàng sang trạng thái KHIẾU NẠI có mã là $query";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name' => $history, 'user' => $user]);
        $this->update_report();
        $data_order = json_encode($data_order);
        echo $data_order;
    }
    public function order_api_changeStatusv5(Request $request) //api chuyển trang thái orderStatus thành RETURNOK-----------------

    {
        $query = $request->input('dnh');
        $d1 = DB::table('order_tb')->select('*')
            ->where('orderID', 'LIKE', "$query")
            ->update(['orderStatus' => 'ReturnOK', 'orderStatus_vi' => 'Đã nhận lại']);

        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->select('*')
            ->where('orderStatus', 'LIKE', 'ReturnOK')
            ->orderBy('orderCreate', 'desc')
            ->get();
        $update_product = DB::table('order_tb')
            ->select('*')
            ->join('order_tb_product', 'order_tb.orderID', '=', 'order_tb_product.orderID')
            ->join('product', 'order_tb_product.productID', '=', 'product.productID')
            ->where('order_tb.orderID', $query)
            ->update([
                'product.productStatus' => 'Instock',
            ]);
        $history = "Cập nhật đơn hàng sang trạng thái ĐÃ NHẬN LẠI có mã là $query";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name' => $history, 'user' => $user]);
        $this->update_report();
        $data_order = json_encode($data_order);
        echo $data_order;
    }
    public function order_api_edit(Request $request)
    {
        $orderID = $request->input('orderID');
        $orderShipID = $request->input('orderShipID');
        $orderShip = $request->input('orderShip');
        $customerID = $request->input('customerID');
        $order_data = DB::table('order_tb')
            ->select('*')
            ->where('customerID', $customerID)
            ->get();
        foreach ($order_data as $key) {
            $orderID_old = $key->orderID;
        }
        $updated = DB::table('order_tb')
            ->select('*')
            ->where('customerID', $customerID)
            ->join('order_tb_product', 'order_tb.orderID', '=', 'order_tb_product.orderID')
            ->update([
                'order_tb.orderID' => $orderID,
                'order_tb_product.orderID' => $orderID,
                'orderShipID' => $orderShipID,
                'orderShip' => $orderShip,
            ]);
    }
    public function api_selected_orderShip(Request $request) //SELECT ĐƠN VỊ VẬN CHUYỂN TRẢ VỀ ĐƠN HÀNG---------------------------------

    {
        $orderShip = $request->xyz;
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->join('devvn_tinhthanhpho', 'order_tb.orderAddress', '=', 'devvn_tinhthanhpho.matp')
            ->select('*')
            ->where('orderShip', 'LIKE', $orderShip)
            ->get();
        $data_order = json_encode($data_order);
        echo $data_order;
    }
    public function api_selected_orderStatus(Request $request) //SELECT TRẠNG THÁI ĐƠN HÀNG TRẢ VỀ ĐƠN HÀNG---------------------------------

    {
        $order_status = $request->xyz;
        $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
            ->join('devvn_tinhthanhpho', 'order_tb.orderAddress', '=', 'devvn_tinhthanhpho.matp')
            ->select('*')
            ->where('orderStatus', 'LIKE', $order_status)
            ->get();
        $data_order = json_encode($data_order);
        echo $data_order;
    }

    


    public function add()
    {
        $data_tinhthanh = DB::table('devvn_tinhthanhpho')
            ->select('*')
            ->get();
        $data_product = DB::table('product')
            ->select('*')
            ->get();
        $customer = DB::table('customer')
            ->select('*')
            ->orderBy('customerID', 'desc')
            ->limit(1)
            ->get();
        return view('admin/order/order_add_angular2', compact('data_tinhthanh', 'data_product', 'customer'));
    }
    public function get_api_quanhuyen(Request $request) //API GET DATA QUAN HUYEN THEO TINH THANH--------------------------------------

    {
        $query = $request->input('bbb');
        $data = DB::table('devvn_quanhuyen')
            ->select('*')
            ->where('matp', 'LIKE', "%{$query}%")
            ->get();
        $data = json_encode($data);
        echo $data;
    }
    public function get_api_product(Request $request)
    {
        $query = $request->input('ccc');
        $data = DB::table('product')->select('*')
            ->where('productID', 'LIKE', "%{$query}%")
            ->get();
        $data = json_encode($data);
        echo $data;
    }
    public function insert_order(Request $request) //HAM INSERT MULTIPLE DATA ORDER-----------------------------------------------------

    {
        $user = $request->session()->get('name');
        $customerName = $request->customerName;
        $customer = DB::table('customer')
            ->select('customerID')
            ->orderBy('customerID', 'desc')
            ->limit(1)
            ->get();
        foreach ($customer as $row) {
            $customerID = $row->customerID + 1; //GET RA GIA TRI CUOI ROI +1 DE INSERT DO BANG ORDER
        }
        $customerGender = $request->customerGender;
        $customerProvince = $request->customerProvince;
        $customerDistrict = $request->customerDistrict;
        $customerAddress = "$customerDistrict " . $request->customerAddress;
        $customerTel = $request->customerTel;
        $customerMail = $request->customerMail;
        $orderID = $request->orderID;
        //  $orderLink         = "https://ban.sendo.vn/shop#salesorder/detail/12345678/".$orderID;
        $orderShipLink = $request->orderShipLink;
        $orderShipID = $request->orderShipLink;
        $orderShip = $request->orderShip;
        $orderChannel = $request->orderChannel;
        if ($orderChannel == "Sendo") {
            $orderLink = "https://ban.sendo.vn/shop#salesorder/detail/12345678/" . $orderID;
        } elseif ($orderChannel == "Shopee") {
            $orderLink = "https://banhang.shopee.vn/portal/sale";
        }
        if ($orderShip == "GHN") {
            $orderShipLink = "https://track.ghn.vn/order/tracking?code=" . $orderShipLink;
        } elseif ($orderShip == "Viettel") {
            $orderShipLink = "https://www.viettelpost.com.vn/Tracking?KEY=" . $orderShipLink;
        } elseif ($orderShip == "VNPost") {
            $orderShipLink = "http://www.vnpost.vn/vi-vn/dinh-vi/buu-pham?key=" . $orderShipLink;
        } elseif ($orderShip == "NJV") {
            $orderShipLink = "https://www.ninjavan.co/vn-vn/?tracking_id=" . $orderShipLink;
        }
        //TUY THEO NHA VAN CHUYEN DE INSERT LINK TRACKING
        $orderNote = $request->orderNote;

        DB::table('customer')->insert(
            [
                'customerName' => $customerName,
                'customerGender' => $customerGender,
                'customerProvince' => $customerProvince,
                'customerAddress' => $customerAddress,
                'customerTel' => $customerTel,
                'customerMail' => $customerMail,
            ]);
        // CHECK DUPLICATED ORDER_ID
        $check_orderID = DB::table('order_tb')->select('orderID')->where('orderID', $orderID)->get();
        if (count($check_orderID) == 1) {
            alert('Order Insert Failed', 'Duplicated', 'error');
            return redirect()->back()->with('success', 'data insert successfully');
        } else {
            DB::table('order_tb')->insert(
                [
                    'orderID' => $orderID,
                    'orderLink' => $orderLink,
                    'orderShip' => $orderShip,
                    'orderShipID' => $orderShipID,
                    'orderShipLink' => $orderShipLink,
                    'orderAddress' => $customerProvince,
                    'orderStatus' => 'Shipping',
                    'orderStatus_vi' => 'Đang vận chuyển',
                    'orderNote' => $orderNote,
                    'customerID' => $customerID,
                    'orderCost' => $request->tongnhap,
                    'orderSell' => $request->tongban,
                    'orderChannel' => $orderChannel,
                    'user' => $user,
                ]);
            foreach ($request->countryname as $item => $v) //insert sp đã chọn của đơn vào order_tb_product
            {
                $data2 = array
                    (
                    'productID' => $request->productID[$item],
                    'orderID' => $orderID,
                    'productCost' => $request->productCost[$item],
                    'product_Sell' => $request->productSell[$item],
                );
                DB::table('order_tb_product')->insert($data2);
                alert('Order Inserted', 'Successfully', 'success');
            }
        }

        //UPDATE STATUS PRODUCT = DONE KHI TẠO ĐƠN MỚI THÀNH CÔNG
        DB::table('order_tb_product')->join('product', 'order_tb_product.productID', '=', 'product.productID')
            ->update(['product.productStatus' => 'Done']);

        $history = "Tạo 1 đơn hàng mới từ $orderChannel có mã là $orderID";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name' => $history, 'user' => $user]);
        return redirect()->back()->with('success', 'data insert successfully');
    }
    public function searchResponse(Request $request) //HAM TRA VE KET QUA AUTO SEARCH PHẦN TẠO ĐƠN HÀNG---------------------------------

    {
        $query = $request->get('term', '');
        $countries = \DB::table('product');
        if ($request->type == 'countryname') {
            $countries->where('productName', 'LIKE', '%' . $query . '%')->where('productStatus', '<>', 'Done');
        }
        $countries = $countries->get();
        $data = array();
        foreach ($countries as $country) {
            $data[] = array('name' => $country->productName,
                'cost' => $country->productCost,
                'sell' => $country->productSell,
                'pid' => $country->productID,
                'img' => $country->productImage,
            );
        }
        if (count($data)) {
            return $data;
        } else {
            return ['name' => ''];
        }

    }
    public function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('producttype')->select('*')
                ->where('product_typeName', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu form-control" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '
               <li id="typeID"><a href="#"  class="form-control">' . $row->product_typeName . '</a></li>
               ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function fetch_gia(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('producttype')
                ->select('*')
                ->where('product_typeName', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu form-control" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '
                   <li><a href="#" class="form-control">' . $row->product_typeCost . '</a></li>
                   ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function order_all_old()
    {
        // $data_order    =     DB::table('order_tb')->join('customer','order_tb.customerTel', '=', 'customer.customerTel')
        //                                          ->join('devvn_tinhthanhpho','order_tb.orderAddress','=','devvn_tinhthanhpho.matp')
        //                               ->select('*')
        //                               ->orderBy('orderDate','desc')
        //                               ->get();
        // $data_order    =     json_encode($data_order);
        // dd($data_order);

        // $data_order    =     DB::table('order_tb')
        //                               ->select('*')
        //                               ->orderBy('orderDate','desc')
        //                               ->get();
        // $data_order    =     json_encode($data_order);
        // echo $data_order;  //PHUONG
    }

    public function order_dhvc_old()
    {
        // $data_order = DB::table('order_tb')->join('customer', 'order_tb.customerID', '=', 'customer.customerID')
        //     ->join('devvn_tinhthanhpho', 'order_tb.orderAddress', '=', 'devvn_tinhthanhpho.matp')
        //     ->select('*')
        //     ->where('orderStatus', 'LIKE', 'Shipping')
        //     ->orWhere('orderStatus', 'Received')
        //     ->orderBy('orderCreate', 'desc')
        //     ->get();
    }
}

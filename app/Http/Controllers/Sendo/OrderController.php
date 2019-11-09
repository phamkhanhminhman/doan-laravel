<?php
/*
 *   Created by  :   NQP - 14/09/2019
 *   Description :   OrderController for Sendo
 */
namespace App\Http\Controllers\Sendo;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Handle\SendoHandler;
use Illuminate\Support\Facades\DB;
use Alert;


class OrderController extends Controller
{
    private $sendo;

    const ORDER_LINK_SENDO = "https://ban.sendo.vn/shop#salesorder/detail/123456/";

    public function __construct(SendoHandler $sendo)
    {
        $this->sendo = $sendo;
    }

    /**
     * Convert OrderStatus to Text
     */
    public function parseOrderStatus($orderStatus)
    {
        switch ($orderStatus) {

            case 2:$orderStatusDes = "Mới";
            break;
            case 3:$orderStatusDes = "Đang Xử Lý";
            break;
            case 6:$orderStatusDes = "Đang Vận Chuyển";
            break;
            case 7:$orderStatusDes = "Đã Giao Hàng";
            break;
            case 8:$orderStatusDes = "Đã Hoàn Tất";
            break;
            case 10:$orderStatusDes = "Đóng";
            break;
            case 11:$orderStatusDes = "Yêu Cầu Hoãn";
            break;
            case 12:$orderStatusDes = "Đang Hoãn";
            break;
            case 13:$orderStatusDes = "Hủy";
            break;
            case 14:$orderStatusDes = "Yêu Cầu Tách";
            break;
            case 15:$orderStatusDes = "Chờ Tách";
            break;
            case 19:$orderStatusDes = "Chờ Gộp";
            break;
            case 23:$orderStatusDes = "Chờ Sendo Xử Lý";
            break;
            case 21:$orderStatusDes = "Đang Đổi Trả";
            break;
            case 22:$orderStatusDes = "Đổi Trả Thành Công";
            break;
            default:$orderStatusDes = "Not Responding";
            break;
        }
        return $orderStatusDes;
    }

    /**
     * Lấy dữ liệu đơn hàng mới add vào db
     */
    public function addNewOrder()
    {
        $shopList = DB::table('shop')->get();
        foreach ($shopList as $k) {
            $shopID   = $k->shopID;
            $shopName = $k->shopName;
             // $orderStatus = 2; // 2 = new order
        for ($i=0; $i < 1 ; $i++) { 
            if ($i === 0) {
                $orderStatus = 2;
            }

            if ($i === 1) {
                $orderStatus = 3;
            }

            if ($i === 2) {
                $orderStatus = 6;
            }

            $response = $this->sendo->getOrderList($orderStatus, $shopID); //call API GET ORDER LIST - SENDO

            $orderLinkSendo = self::ORDER_LINK_SENDO;

            if (count($response->result->data) > 0) {
                $countNewOrder = 0;
                // thêm đơn hàng mới vào DB
                foreach ($response->result->data as $key => $p) {
                    $orderNumber = $p->salesOrder->orderNumber;
                    $orderStatus = $p->salesOrder->orderStatus;
                    $orderStatusDes = $this->parseOrderStatus($orderStatus);
                    $customerID = 180; // sau này xóa
                    $customerTel=$p->salesOrder->shippingContactPhone;
                    $customerName=$p->salesOrder->receiverName;
                    $customerAddress=$p->salesOrder->receiverFullAddress;
                    $orderAddress = 01;
                    $orderDate = $p->salesOrder->orderDate;
                    $orderChannel = "Sen Đỏ";
                    $shipToRegionId= $p->salesOrder->shipToRegionId;
                    
                    //convert RegionId -> RegionName
                    $region = DB::table('city')->where('cityId', $shipToRegionId)->select('cityName')->first();
                    $shipToRegionName = $region->cityName;

                    // thêm order mới
                    $duplicateOrder = DB::table('order_tb')->where('orderID', $orderNumber)->get();
                    if (count($duplicateOrder) === 0) {

                        $countNewOrder++;

                        DB::table('order_tb')->insert(['orderID' => $orderNumber,
                            'orderLink' => $orderLinkSendo . $orderNumber,
                            'orderStatus' => $orderStatus,
                            'orderStatusDes' => $orderStatusDes,
                            'customerID' => $customerID,
                            'customerTel'=>$customerTel,
                            'orderAddress' => $orderAddress,
                            'orderDate' => $orderDate,
                            'orderChannel'=> $orderChannel,
                            'shipToRegionID'=> $shipToRegionId, 
                            'shipToRegionName'=> $shipToRegionName,
                            'orderShopID'=>$shopID,
                            'orderShopName'=>$shopName,
                        ]);
                    }
                    // thêm khách hàng của order vào DB
                    $duplicateCustomer = DB::table('customer')->where('customerTel', $customerTel)->get();
                    if (count($duplicateCustomer) === 0) {
                        DB::table('customer')->insert(['customerTel' => $customerTel,
                            'customerName' => $customerName,
                            'customerAddress' => $customerAddress,
                            
                        ]);
                    }
                    //Cập nhật thêm thông tin từ response API Order Detail, vào bảng order_tb 
                    $this->updateOrder($orderNumber,$shopID);
                    
                }
                // return $countNewOrder;
            } else {
                // return $countNewOrder;
            } 
        }
        }

       

    }
    /**
     * Update dữ liệu cho đơn hàng cũ, trừ những đơn đã hoàn thành ( orderStatus # 8 )
     * @Params: OrderNumber
     */
    public function updateOrderExceptDone() //cái ni là đơn đã full thông tin rồi chỉ update lại cái status
    {
        $month = date('m');
        // lấy mã đơn hàng cũ từ DB
        $arrayOrderNumber = DB::table('order_tb')
        ->where('orderStatus', '<>', 8)
            ->where('orderStatus', '<>', 'Done') // sau này bỏ ( dữ liệu giả)
            ->where('orderStatus', '<>', 'ReturnOK') // sau này bỏ ( dữ liệu giả)
            ->where('orderChannel', '=', 'Sen Đỏ')
            ->whereMonth('orderDate', $month)
            ->select('orderID')
            ->get();
        // nếu có đơn thì mới chạy hàm updateOrder
            if (count($arrayOrderNumber) > 0) {
                foreach ($arrayOrderNumber as $key => $p) {
                    $this->updateOrder($p->orderID);
                }
            }

            return count($arrayOrderNumber);
        }

    /**
     * Update dữ liệu cho đơn hàng khi click event cập nhật đơn hàng
     * @Params: OrderNumber
     */
    public function updateOrder($orderNumber,$shopID)
    {  
        $response = $this->sendo->getOrderDetail($orderNumber,$shopID); //call API ORDER DETAIL - SENDO
        $p = $response->result->salesOrder;
        $orderStatus = $p->orderStatus;                          // mã trạng thái của orderstatus
        $orderStatusDes = $this->parseOrderStatus($orderStatus); // đổi orderstatus sang text
        $carrierName = $p->carrierName;                          // đơn vị vận chuyển
        $ordershipID = $p->trackingNumber;                       // mã vân chuyển
        $ordershipLink = $p->trackingLink;                       // Link vận chuyển
        $orderSell = $p->totalAmount;                            //Tổng số tiền nhận được
        // kiểm tra mã đơn nếu tồn tại đúng 1c thì sẽ update đơn hàng đó
        $duplicateOrder = DB::table('order_tb')->where('orderID', $orderNumber)->get();
        if (count($duplicateOrder) === 1) {
            DB::table('order_tb')->where('orderID', $orderNumber)
            ->update([
                'orderStatus' => $orderStatus,
                'orderStatusDes' => $orderStatusDes,
                'CarrierName' => $carrierName,
                'ordershipID' => $ordershipID,
                'ordershipLink' => $ordershipLink,
                'orderSell' => $orderSell,
            ]);

            $this->getProductFromOrder($response, $orderNumber); //Insert list product each order
        }
    }

    /**
     * GET PRODUCT LIST FROM EACH ORDER - INSERT DB
     * @param $response - Order detail
     * @param $orderNumber
     */
    public function getProductFromOrder($response, $orderNumber)
    {
        if (count($response->result->salesOrderDetails) > 0) {
            $productsList = $response->result->salesOrderDetails;
            $orderCost = 0;
            foreach ($productsList as $key => $p) {
                $productID = $p->productVariantId;
                $productSKU= $p->storeSku;
                $productSell = $p->subTotal; // productsell có r mà ở đâu, rồi lại
                $quantity = $p->quantity;
                // trùng order và trùng productid thì mới pass chứ ko là mỗi order chỉ có 1 product
                $duplicateOrder = DB::table('order_tb_product')
                ->where('orderID', $orderNumber)
                ->where('variantSKU', $productSKU)  
                ->get();

                if (count($duplicateOrder) === 0) {
                    DB::table('order_tb_product')->insert(
                        [                           
                            'orderID' => $orderNumber,
                            'productID' => $productID,
                            'variantSKU'=>$productSKU,
                            'productCost' => 0,
                            'product_Sell' => $productSell,
                            'Amount' => $quantity,
                        ]);

                    $product_variation = DB::table('product_variation')
                        ->where('productVariationID', $productSKU)
                        ->first();
                    if ($product_variation !== null) {
                        $cost = intval($product_variation->productCost) * intval($quantity); 
                        $orderCost = $orderCost + $cost;
                    } else {
                        echo 'co 1 sp trong order ko co trong db';
                    }
                    
                } 
            }
            if (count($duplicateOrder) === 0) {
                DB::table('order_tb')->where('orderID', $orderNumber)->update(['orderCost' => $orderCost]);
            }
            
        } else {
            echo 'loi ';
        }

    } 

    public function getRegionsSendo()
    {
        $this->sendo->getRegionsSendo();
    }

    public function confirmOrderSendo($orderID)
    {
        $this->sendo->confirmOrderSendo($orderID);
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
        $tongsobomhang = 0;
        $tiendongbang = 0;
        $tongsodonchuahoanthanh = 0;

        foreach ($order as $k) {
            if ($k->orderStatus != 13 || $k->orderStatus != 22) {
                $doanhthu = $doanhthu + $k->orderSell;
                $tongvon = $tongvon + $k->orderCost;
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

        DB::table('report_thang')
        ->where('report_thang_id' , $month)
        ->where('report_nam_id' , $year)
        ->update([
            'doanhthu' => $doanhthu,
            'loinhuan' => $loinhuan,
            'tongvon' => $tongvon,
            'tongsodonhang' => $tongsodonhang,
            'tongsobombhang' => $tongsobomhang,
            'tiendongbang' => $tiendongbang,
            'tongsodonchuahoanthanh' => $tongsodonchuahoanthanh
        ]);

        // var_dump($doanhthu);
        // var_dump($loinhuan);
        // var_dump($tongsodonhang);
        // var_dump($tongsobomhang);
        // var_dump($tiendongbang);
    }

    public function update_report_ngay()
    {
        $day = date('d');
        $month = date('m');
        $year = date('Y');

        //Update từ ngày hiện tại đến từng ngày trở về trước
        for ($i= intval($day); $i >=1 ; $i--) {
            $order = DB::table('order_tb')
            ->whereYear('orderDate',$year)
            ->whereMonth('orderDate', $month)
            ->whereDay('orderDate', $i)
            ->get();

            $doanhthu = 0;
            $loinhuan = 0;
            $tongvon = 0;
            $tongsobomhang = 0;
            $tiendongbang = 0;
            $tongsodonchuahoanthanh = 0;

            foreach ($order as $k) {
                if ($k->orderStatus != 13 || $k->orderStatus != 22) {
                    $doanhthu = $doanhthu + $k->orderSell;
                    $tongvon = $tongvon + $k->orderCost;
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

            $checkExistDate = DB::table('report_ngay')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->whereDay('date', $day)
            ->get();

            if (count($checkExistDate) !== 0) {
                DB::table('report_ngay')
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->whereDay('date', $day)
                ->update([
                    'doanhthu' => $doanhthu,
                    'loinhuan' => $loinhuan,
                    'tongvon' => $tongvon,
                    'tongsodonhang' => $tongsodonhang,
                    'tongsobombhang' => $tongsobomhang,
                    'tiendongbang' => $tiendongbang,
                    'tongsodonchuahoanthanh' => $tongsodonchuahoanthanh
                ]);

            } else {
                DB::table('report_ngay')
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->whereDay('date', $day)
                ->insert([
                    'doanhthu' => $doanhthu,
                    'loinhuan' => $loinhuan,
                    'tongvon' => $tongvon,
                    'tongsodonhang' => $tongsodonhang,
                    'tongsobombhang' => $tongsobomhang,
                    'tiendongbang' => $tiendongbang,
                    'tongsodonchuahoanthanh' => $tongsodonchuahoanthanh

                ]);
            } 
        }
    }
}

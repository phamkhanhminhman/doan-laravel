<?php
/*
 *   Created by  :   NQP - 15/09/2019
 *   Description :   ProductController for Sendo
 */
namespace App\Http\Controllers\Shopee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Entities\ProductList;
use App\Http\Controllers\Handle\ShopeeHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;

class OrderController extends Controller
{
    private $shopee;

    

    public function __construct(ShopeeHandler $shopee)
    {
        $this->shopee = $shopee;
    }

    public function parseOrderStatus($orderStatusDes)
    {
        switch ($orderStatusDes) {

            case "READY_TO_SHIP" : $orderStatus = 2;
                break;
            case "SHIPPED" : $orderStatus = 6;
                break;
            case "TO_CONFIRM_RECEIVE" : $orderStatus = 7;
                break;
            case "COMPLETED":$orderStatus = 8;
                break;
            case "TO_RETURN":$orderStatus = 22;
                break;
            case "CANCELLED":$orderStatus = 13;
                break;

            default: $orderStatus = 0;
                break;
        }
        return $orderStatus;
    }

    public function getOrderList()
    {
        $response = $this->shopee->getOrderList();

        dd($response->data['orders']);
    }

    public function getOrderDetail()
    {
        $response = $this->shopee->getOrderDetail('19101001280VG75');

        dd($response->data['orders'][0]);
    }

    public function getEscrowDetails()
    {
        $response = $this->shopee->getEscrowDetails('19092422350NWTP');

        dd($response);
    }


    /**
     * Add New Order
     */
    public function addNewOrder()
    {
        $orderStatus = "ALL";
        $responseOrderList = $this->shopee->getOrderList();

        $orders = $responseOrderList->data['orders'];

        $countNewOrder = 0;
        foreach ($orders as $order) {
            $orderNumber = $order['ordersn'];

            $responseOrderDetail = $this->shopee->getOrderDetail($orderNumber);
            $orderDetail = $responseOrderDetail->data['orders'][0];
            $orderStatusDes = $orderDetail['order_status'];
            $orderStatus = $this->parseOrderStatus($orderStatusDes);
            $customerID = 180; // sau này xóa
            $customerTel= $orderDetail['recipient_address']['phone'];
            $customerName= $orderDetail['recipient_address']['name'];
            $customerAddress= $orderDetail['recipient_address']['full_address'];
            $orderAddress = 01;
            $orderDate = $orderDetail['create_time'];
            $orderDate = gmdate("Y-m-d H:i:s", $orderDate);
            $orderChannel = "Shopee";
            $carrierName = $orderDetail['shipping_carrier'];
            $orderShipID = $orderDetail['tracking_no'];
            $orderShipLink = 'linkcarrier'; 
            $orderSell = $orderDetail['total_amount'] - $orderDetail['estimated_shipping_fee'];
            $orderReceive = $orderDetail['escrow_amount'];



            $shipToRegionId= 1;
            $shipToRegionName = $orderDetail['recipient_address']['state'];

            $duplicateOrder = DB::table('order_tb')->where('orderID', $orderNumber)->get();

            //Check not duplicate orderID -> insert
            if (count($duplicateOrder) === 0) {

                $countNewOrder++;

                DB::table('order_tb')->insert([
                    'orderID' => $orderNumber,
                    'orderLink' => 'linkshopee',
                    'orderStatus' => $orderStatus,
                    'orderStatusDes' => $orderStatusDes,
                    'customerID' => $customerID,
                    'customerTel'=> $customerTel,
                    'orderAddress' => $orderAddress,
                    'orderDate' => $orderDate,
                    'orderChannel'=> $orderChannel,
                    'shipToRegionID'=> $shipToRegionId, 
                    'shipToRegionName'=> $shipToRegionName,
                    'CarrierName' => $carrierName,
                    'ordershipID' => $orderShipID,
                    'ordershipLink' => $orderShipLink,
                    'orderSell' => $orderSell,
                ]);

                $productItems = $orderDetail['items'];
           
                foreach ($productItems as $items) {
                    $productID = $items['item_id'];
                    $productSKU = $items['item_sku']. '-' .$items['variation_sku'];
                    $quantity = $items['variation_quantity_purchased'];
                    
                    DB::table('order_tb_product')->insert([
                        'orderID' => $orderNumber,
                        'productID' => $items['item_id'],
                        'variantSKU' => $productSKU,                            //save variant SKU = SKU LỚN + SKU NHỎ
                        'Amount' => $items['variation_quantity_purchased'],
                        'product_Sell' => $items['variation_original_price'],
                        'producttypeID' => 'Shopee',
                    ]);
                }
            }
            
            $duplicateCustomer = DB::table('customer')->where('customerTel', $customerTel)->get();

            if (count($duplicateCustomer) === 0) {
                DB::table('customer')->insert(['customerTel' => $customerTel,
                    'customerName' => $customerName,
                    'customerAddress' => $customerAddress,
                    
                ]);
            }            
        }

        // alert('Có ' + $countNewOrder + ' đơn hàng mới từ SHOPEE', 'Successfully', 'success');
        return 1;
    }

    public function updateOrderExceptDone()
    {
        $arrayOrderNumber = DB::table('order_tb')
            ->where('orderStatus', '<>', 8)
            ->where('orderChannel', '=', 'Shopee')
            ->select('orderID')
            ->get();

        // nếu có đơn thì mới chạy hàm updateOrder
        if (count($arrayOrderNumber) > 0) {
            foreach ($arrayOrderNumber as $key => $p) {
                $this->updateOrder($p->orderID);
            }
        }
        
        // alert('Đã cập nhật ' . count($arrayOrderNumber) . ' đơn hàng','Successfully', 'success');
        return redirect('admin/order/');
    }

    public function updateOrder($orderNumber)
    {  
        $response = $this->shopee->getOrderDetail($orderNumber); //call API ORDER DETAIL - SHOPEE
        $orderDetail = $responseOrderDetail->data['orders'][0];
        $orderStatusDes = $orderDetail['order_status'];
        $orderStatus = $this->parseOrderStatus($orderStatusDes);

        DB::table('order_tb')->where('orderID', $orderNumber)
            ->update([
                'orderStatus' => $orderStatus,
                'orderStatusDes' => $orderStatusDes
            ]);
    }
}

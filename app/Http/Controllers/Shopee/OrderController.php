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

class OrderController extends Controller
{
    private $shopee;

    

    public function __construct(ShopeeHandler $shopee)
    {
        $this->shopee = $shopee;
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

        foreach ($orders as $order) {
            $orderNumber = $order['ordersn'];

            $responseOrderDetail = $this->shopee->getOrderDetail($orderNumber);
            $orderDetail = $responseOrderDetail->data['orders'][0];
            $orderStatusDes = $orderDetail['order_status'];
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
                DB::table('order_tb')->insert([
                    'orderID' => $orderNumber,
                    'orderLink' => 'linkshopee',
                    'orderStatus' => 6,
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
                        'variantSKU' => $productSKU,
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
    }
}

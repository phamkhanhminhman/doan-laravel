<?php

namespace App\Http\Controllers\Handle;

use GuzzleHttp\Client;

class ShopeeHandler
{

    /**
     * constructor.
     */
    public function __construct()
    { }

    /**
     * authetication for API
     */
    public function authorizationShopee()
    {
        $client = new \Shopee\Client([
            'secret' => '60d28b4911da744f7c83f2211141c131dc4e17559a0274a8f202fdd6be472606',
            'partner_id' => 843626,
            'shopid' => 12026480,
        ]);

        return $client;
    }

    /**
     * GET Product List
     */
    public function getProductList()
    {
        $client = $this->authorizationShopee();
        $items = $client->item->getItemsList(
            array(
                'pagination_offset' => 1,
                'pagination_entries_per_page' => 100
            )
        );
        return $items;
    }

    /**
     * GET Product Detail
     */
    public function getProductDetail($productID)
    {
        $client = $this->authorizationShopee();
        $items = $client->item->getItemDetail(array('item_id' => intval($productID)));

        return $items;
    }

    /**
     * GET Order List
     */
    public function getOrderList()
    {
        $client = $this->authorizationShopee();
        // $items = $client->order->getOrdersList(array('pagination_entries_per_page' => 1);

        $items = $client->order->getOrdersByStatus(array(
            'order_status' => 'ALL',
            'pagination_entries_per_page' => 100,
            'pagination_offset' => 0

        ));
        // dd($items);
        return $items;
    }

    /**
     * GET Order Detail
     */
    public function getOrderDetail($orderNumber)
    {
        $client = $this->authorizationShopee();

        $items = $client->order->getOrderDetails(array('ordersn_list' => array($orderNumber),));

        return $items;
    }

    public function getEscrowDetails($orderNumber)
    {
        $client = $this->authorizationShopee();

        $items = $client->order->getEscrowDetails(array('ordersn' => $orderNumber));

        return $items;
    }
}

<?php

namespace App\Http\Controllers\Handle;

use GuzzleHttp\Client;

class SendoHandler
{
    const URL_SENDO = 'https://sapi.sendo.vn';

    /**
     * constructor.
     */
    public function __construct()
    {}

    /**
     * authetication for API
     */
    public function getSendoToken($shopID)
    {
        if ($shopID == null) {
            $shopID ='15a3d1d631f043e49be97eb53ed4a367';
        }
        $username = $shopID;
        $password = '9397f820941f37f2d28383cc419ea34632022b54';

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://sapi.sendo.vn/shop/authentication",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_FOLLOWLOCATION => false,
        //     CURLOPT_POSTFIELDS => "grant_type=password&username=" . $username . "&password=" . $password,
        //     CURLOPT_HTTPHEADER => array(
        //         "Accept: */*",
        //         "Accept-Encoding: gzip, deflate",
        //         "Cache-Control: no-cache",
        //         "Connection: keep-alive",
        //         "Content-Length: 111",
        //         "Content-Type: application/x-www-form-urlencoded",
        //         "Host: sapi.sendo.vn",
        //         "Postman-Token: 6ede73a1-2dc0-4d5c-ba02-7725d1472c87,9c0c0007-a54e-40e0-84be-752637b80446",
        //         "User-Agent: PostmanRuntime/7.16.3",
        //         "cache-control: no-cache",
        //     ),
        // ));

        $client = new \GuzzleHttp\Client([
            'verify' => false,
            'base_uri' => self::URL_SENDO,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',              
            ],
        ]);

        $response = $client->request('POST', 'https://sapi.sendo.vn/shop/authentication', [
            'form_params' => [
                'username' => $username,
                'password' => $password,
                'grant_type' => 'password'
            ]
        ]);

        $res = json_decode($response->getBody()->getContents());
        return $res->access_token;
    }

    /**
     * API trả về danh sách đơn hàng từ Sen Đỏ
     */
    public function getOrderList($orderStatus = null,$shopID)
    {
        try {
            $token = $this->getSendoToken($shopID);
            $currentDay = date('Y-m-d');
            //$fromDate = '2019-09-17'; // currentday-fromdate = 3 ngày
            $fromDate =  date('Y-m-d',strtotime("-3 days"));
            $offSet = 1;
            $limit = 50;

            $client = new \GuzzleHttp\Client([
                'verify' => false,
                'base_uri' => self::URL_SENDO,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'authorization' => 'bearer ' . $token,
                ],
            ]);

            $url = '/shop/salesOrder/bylastDate?fromDate=' . $fromDate . '&toDate=' . $currentDay .
            '&offset=' . $offSet . '&limit=' . $limit . '&orderStatus=' . $orderStatus;

            if ($orderStatus === null) {
                $url = '/shop/salesOrder/bylastDate?fromDate=' . $fromDate . '&toDate=' . $currentDay .
                '&offset=' . $offSet . '&limit=' . $limit;
            }
    
            $request = $client->get($url);
            $response = json_decode($request->getBody()->getContents());

            return $response;

        } catch (\Exception $e) {
            echo $e;
        }

    }

    /**
     * API trả về thông tin chi tiết đơn hàng từ Sen Đỏ
     * @param $orderNumber
     */
    public function getOrderDetail($orderNumber,$shopID)
    {
        $token = $this->getSendoToken($shopID);
        $client = new \GuzzleHttp\Client([
            'verify' => false,
            'base_uri' => self::URL_SENDO,
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'bearer ' . $token,
            ],
        ]);

        $url = '/shop/salesorder?orderNumber=' . $orderNumber;
        $request = $client->get($url);
        $response = json_decode($request->getBody()->getContents());
        return $response;
    }
    /**
     * API trả về danh sách sản phẩm từ Sen Đỏ
     */
    public function getProductList($index)
    {
        $token = $this->getSendoToken();

        $currentDay = date('Y-m-d');
        //dd($currentDay);
        $fromDate = '2018-01-01'; // currentday-fromdate = 3 ngày
        $pageIndex = $index;
        $limit = 10;
        $client = new \GuzzleHttp\Client([
            'verify' => false,
            'base_uri' => self::URL_SENDO,
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'bearer ' . $token,
            ],
        ]);
        $url = '/shop/v2/product/search?limit=' . $limit . '&pageIndex=' . $pageIndex . '&dateFrom=' . $fromDate . '&dateTo=' . $currentDay;
        $request = $client->get($url);
        $response = json_decode($request->getBody()->getContents());

        //dd($response);
        return $response;
    }

    /**
     * API GET DETAIL PRODUCT
     * @param $productID
     */
    public function getProductDetail($productID)
    {
        $token = $this->getSendoToken();
        $client = new \GuzzleHttp\Client([
            'verify' => false,
            'base_uri' => self::URL_SENDO,
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'bearer ' . $token,
            ],
        ]);

        $url = '/shop/v2/product/' . $productID;
        $request = $client->get($url);
        $response = json_decode($request->getBody()->getContents());
        return $response;
    }

    public function getRegionsSendo()
    {
        $date = date('Y-m-d',strtotime("-3 days"));

        dd($date);
        $client = new \GuzzleHttp\Client([
            'verify' => false,
            'base_uri' => 'https://checkout.sendo.vn',
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        $url = 'api/checkout/regions';
        $request = $client->get($url);
        $response = json_decode($request->getBody()->getContents());
        dd($response);
        return $response;
    }

    /**
     * API UPDATE PRODUCT
     * @param $body - format response api detail product
     */
    public function updateProduct($body) 
    {   
        $token = $this->getSendoToken();
        $client = new \GuzzleHttp\Client([
            'verify' => false,
            'base_uri' => self::URL_SENDO,
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'bearer ' . $token,
            ],
        ]);

        $url = '/shop/v2/product/';

        $request = $client->post($url, [
            'body' => json_encode($body)
        ]);

        $response = json_decode($request->getBody()->getContents());
        return $response;
    }

    /**
     * API CONFIRM ORDER
     * @param $orderID
     */
    public function confirmOrderSendo($orderID, $orderShopID)
    {
        $token = $this->getSendoToken($orderShopID);
        $client = new \GuzzleHttp\Client([
            'verify' => false,
            'base_uri' => self::URL_SENDO,
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'bearer ' . $token,
            ],
        ]);
        $url = '/shop/salesOrder/confirmorder?ordernumber='.$orderID;
        
        $request = $client->post($url);

        $response = json_decode($request->getBody()->getContents());
        return $response;
    }
}

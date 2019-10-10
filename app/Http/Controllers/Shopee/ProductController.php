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

class ProductController extends Controller
{
    private $shopee;

   

    public function __construct(ShopeeHandler $shopee)
    {
        $this->shopee = $shopee;
    }

    /**
     *
     */
    
    public function getProductList()
    {
        $response = $this->shopee->getProductList();
        $products = $response->data['items'];
        // dd($products);
        foreach ($products as $product) {
            $productID = $product['item_id'];
            
            $responseProductDetail = $this->shopee->getProductDetail($productID);

            $productDetail = $responseProductDetail->data['item'];
            
            DB::table('product')->where('productSKU', $product['item_sku'])->update([
                    'productShopeeID' => $productDetail['item_id'],
                    'productPriceShopee' => $productDetail['original_price'],
                    'promotionPriceShopee' => $productDetail['price'],
            ]);

            if (count($productDetail['variations'])) {
                foreach ($productDetail['variations'] as $variations) {
                    $productVariationID = $productDetail['item_sku']. '-' . $variations['variation_sku'];

                    DB::table('product_variation')
                        ->where('productVariationID', $productVariationID)
                        ->update([
                            'productShopeeID' => $productDetail['item_id'],
                            'productPriceShopee' => $variations['original_price'],
                            'promotionPriceShopee' => $variations['price'],
                        ]);
                }
            } else {
                var_dump('[variations]');
            }
        }
        dd('update product shopee');
    }

    public function getProductDetail()
    {
        $response = $this->shopee->getProductDetail(1431062579);

        dd($response);
    }

}

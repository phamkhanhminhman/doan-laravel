<?php
/*
 *   Created by  :   NQP - 15/09/2019
 *   Description :   ProductController for Sendo
 */

namespace App\Http\Controllers\Sendo;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Entities\ProductList;
use App\Http\Controllers\Handle\SendoHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;

class ProductController extends Controller
{
    private $sendo;

    // const ORDER_LINK_SENDO = "https://ban.sendo.vn/shop#salesorder/detail/123456/";

    public function __construct(SendoHandler $sendo)
    {
        $this->sendo = $sendo;
    }

    /**
     *
     */
    public function getProductList() //cái ni là hàm add Product này có 10 sp thôi à ời chỉnh đoạn mô lấy hết quên r

    {
        $response = $this->sendo->getProductList();
        $response = $response->result->data;
        //dd($response);
        $a = new ProductList($response[0]);

        return $a;
    }

    /**
     * Insert new Product
     * @param $listProducts - array response from SENDO API
     */
    public function insertProducts($listProducts)
    {
        foreach ($listProducts as $item) {
            $product = new ProductList($item);
            $productID = $product->productID;
            $categoryName = $product->categoryName;
            $productImage = $product->productImage;
            $productLink = $product->productLink;
            $productName = $product->productName;
            $productPrice = $product->productPrice;
            $productStatus = $product->productStatus;
            $productStatusName = $product->productStatusName;
            $promotionPrice = $product->promotionPrice;
            $stockQuantity = $product->stockQuantity;
            $productSKU = $product->productSKU;
            $weight = $product->weight;
            $urlPath = $product->urlPath;
            $finalPriceMin = $product->finalPriceMin;
            $finalPriceMax = $product->finalPriceMax;
            $productCost = 0;

            $this->insertProductVariation($product);

            $duplicateProduct = DB::table('product')->where('productID', $productID)->get();
            if (count($duplicateProduct) === 0) {
                DB::table('product')->insert([
                    'productID' => $productID,
                    'categoryName' => $categoryName,
                    'productImage' => $productImage,
                    'productLink' => $productLink,
                    'productName' => $productName,
                    'productPrice' => $productPrice,
                    'productStatus' => $productStatus,
                    'productStatusName' => $productStatusName,
                    'promotionPrice' => $promotionPrice,
                    'productSell' => $promotionPrice,
                    'stockQuantity' => $stockQuantity,
                    'productSKU' => $productSKU,
                    'weight' => $weight,
                    'urlPath' => $urlPath,
                    'finalPriceMin' => $finalPriceMin,
                    'finalPriceMax' => $finalPriceMax,
                    'productCost' => $productCost,
                ]);
            } else {
                DB::table('product')->where('productID', $productID)->update([
                    'categoryName' => $categoryName,
                    'productName' => $productName,
                    'productPrice' => $productPrice,
                    'productStatus' => $productStatus,
                    'productStatusName' => $productStatusName,
                    'promotionPrice' => $promotionPrice,
                    'productSell' => $promotionPrice,
                    'stockQuantity' => $stockQuantity,
                    'productSKU' => $productSKU,
                    'weight' => $weight,
                    'urlPath' => $urlPath,
                    'finalPriceMin' => $finalPriceMin,
                    'finalPriceMax' => $finalPriceMax,
                ]);
            }
        }
    }

    /**
     * Lấy dữ liệu sản phẩm mới add vào db
     *
     */
    public function updateAllProduct()
    {
        // lấy product của page 1 
        $response = $this->sendo->getProductList(1);
        $listProducts = $response->result->data;
        $this->insertProducts($listProducts);

        $totalRecords = $response->result->totalRecords;
        $totalPages = (int) ($totalRecords / 10) + 1;
        // lấy product của các page tiếp
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i >= 2) {
                $response = $this->sendo->getProductList($i);
                $listProducts = $response->result->data;
                $this->insertProducts($listProducts);
            }
        }

        alert('Product Updated', 'Successfully', 'success');
        return redirect('admin/product/');
    }


    /**
     * UPDATE PRDUCT NAME
     */
    public function updateProduct(Request $request)
    {
        $orderNumber = $request->orderNumber;

        $arrOrderNumber = explode(',', $orderNumber);

        $arrProductID = DB::table('product')->select('productID')->orderBy('productID', 'desc')->where('productID', '12171068')->get();

        foreach ($arrProductID as $orderNumber) {
            $response = $this->sendo->getProductDetail($orderNumber->productID);
            $body = $response->result;
            $name = $body->name;

            $processName = explode(' ', $name);

            $productName = '';
            $index = 0;

            for ($i = 1; $i < count($processName); $i++) {
                if ($processName[0] === $processName[$i]) {
                    $index = $i;
                    break;
                }
            }
            if ($index !== 0) {
                for ($i = 0; $i < $index; $i++) {
                    if ($i === 0) {
                        $productName = $processName[$i];
                    } else {
                        $productName = $productName . ' ' . $processName[$i];
                    }
                }
            } else {
                $productName = $body->name . ' ' . $body->name;
            }

            $body->name = $productName;
            
            $this->sendo->updateProduct($body);
        }
        echo 1;
    }


    /**
     *
     */
    public function getProductDetail()
    {
        $response = $this->sendo->getProductDetail(21700260);
        dd($response);
    }

    /**
     * Insert Product Variation
     * @param $product - response API product list 
     */
    public function insertProductVariation($product)
    {
        $productID = $product->productID;
        $categoryName = $product->categoryName;
        $productImage = $product->productImage;
        $productLink = $product->productLink;
        $productName = $product->productName;
        $productPrice = $product->productPrice;
        $productStatus = $product->productStatus;
        $productStatusName = $product->productStatusName;
        $promotionPrice = $product->promotionPrice;
        $stockQuantity = $product->stockQuantity;
        $productSKU = $product->productSKU;
        $weight = $product->weight;
        $urlPath = $product->urlPath;
        $finalPriceMin = $product->finalPriceMin;
        $finalPriceMax = $product->finalPriceMax;
        $productCost = 0;

        //get product detail
        $responseProductDetail = $this->sendo->getProductDetail($productID);

        $productVariants = $responseProductDetail->result->variants;

        //nếu sp ko có variation, thì set variation = thông số của sp đó
        if (count($productVariants) === 0) {
            $productVariationID = $productSKU;
            $price = $productPrice;
            $quantity = $stockQuantity;

            $duplicateProduct = DB::table('product_variation')->where('productVariationID', $productVariationID)->get();
            if (count($duplicateProduct) === 0) {
                $this->insertProductVariationDB($productVariationID, $price, $quantity, $product);
            } else {

                $this->updateProductVariationDB($productVariationID, $price, $quantity, $product);
            }
        } else {
            foreach ($productVariants as $variant) {
                $productVariationID = $productSKU . '-' . $variant->skuUser;
                $price = $variant->finalPrice;
                $quantity = $variant->qty;

                $duplicateProduct = DB::table('product_variation')->where('productVariationID', $productVariationID)->get();
                if (count($duplicateProduct) === 0) {
                    $this->insertProductVariationDB($productVariationID, $price, $quantity, $product);
                } else {

                    $this->updateProductVariationDB($productVariationID, $price, $quantity, $product);
                }
            }
        }
    }

    /**
     * Insert TABLE PRODUCT_VARIATION
     * @param $productVariationID - productSKU + variationSKU
     * @param $price - variation Price
     * @param $quantity - variation quantity
     * @param $product - response API product list 
     */
    public function insertProductVariationDB($productVariationID, $price, $quantity, $product)
    {
        DB::table('product_variation')->insert([
            'productVariationID' => $productVariationID,
            'productID' => $product->productID,
            'categoryName' => $product->categoryName,
            'productImage' => $product->productImage,
            'productLink' => $product->productLink,
            'productName' => $product->productName,
            'productPrice' => $price,
            'productStatus' => $product->productStatus,
            'productStatusName' => $product->productStatusName,
            'promotionPrice' => $product->promotionPrice,
            'productSell' => $product->promotionPrice,
            'stockQuantity' => $quantity,
            'productSKU' => $productVariationID,
            'weight' => $product->weight,
            'urlPath' => $product->urlPath,
            'finalPriceMin' => $product->finalPriceMin,
            'finalPriceMax' => $product->finalPriceMax,
            'productCost' => 0,
        ]);
    }

    /**
     * Update TABLE PRODUCT_VARIATION
     * @param $productVariationID - productSKU + variationSKU
     * @param $price - variation Price
     * @param $quantity - variation quantity
     * @param $product - response API product list
     */
    public function updateProductVariationDB($productVariationID, $price, $quantity, $product)
    {
        DB::table('product_variation')->where('productVariationID', $productVariationID)->update([
            'productID' => $product->productID,
            'categoryName' => $product->categoryName,
            'productName' => $product->productName,
            'productPrice' => $price,
            'productStatus' => $product->productStatus,
            'productStatusName' => $product->productStatusName,
            'promotionPrice' => $product->promotionPrice,
            'productSell' => $product->promotionPrice,
            'stockQuantity' => $quantity,
            'productSKU' => $productVariationID,
            'weight' => $product->weight,
            'urlPath' => $product->urlPath,
            'finalPriceMin' => $product->finalPriceMin,
            'finalPriceMax' => $product->finalPriceMax,
        ]);
    }
}

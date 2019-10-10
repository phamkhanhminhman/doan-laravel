<?php

namespace App\Http\Controllers\Entities;


class ProductList 
{

    
   
    // const ORDER_LINK_SENDO = "https://ban.sendo.vn/shop#salesorder/detail/123456/";

    public function __construct($ProductList)
    {
        $this->productID = $ProductList->id;
        $this->categoryName = $ProductList->categoryName;
        $this->productImage = $ProductList->productImage;
        $this->productLink  = $ProductList->productLink;
        $this->productName  = $ProductList->productName;
        $this->productPrice = $ProductList->productPrice;
        $this->productStatus = $ProductList->productStatus;
        $this->productStatusName  = $ProductList->productStatusName;
        $this->promotionPrice  = $ProductList->promotionPrice;
        $this->stockQuantity = $ProductList->stockQuantity;
        $this->productSKU = $ProductList->productSKU;
        $this->weight  = $ProductList->weight;
        $this->urlPath  = $ProductList->urlPath;
        $this->finalPriceMin  = $ProductList->finalPriceMin;
        $this->finalPriceMax  = $ProductList->finalPriceMax; 
        
    }
    
}

?>
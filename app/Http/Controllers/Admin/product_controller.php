<?php
/*
    *   Created by  :   pkmm - 20/1/2019 
    *   Updated by  :   pkmm - 21/2/2019 - viet ham searchRespone, thêm nhiều sp 1 lần
    *   Updated by  :   pkmm - 26/2/2019 - viet ham best_selling, đếm số sp theo từng loại
    *   Description :   PRODUCT crud, GET API type cost sell
*/

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Handle\SendoHandler;
use Alert;

class product_controller extends Controller
{
    public function __construct(SendoHandler $sendo)
    {
        $this->sendo = $sendo;
    }
    // public function index() //BY MẪN
    // {
    // 	$data_product        =DB::table('producttype')
    //                              ->select('*')->join('product', 'producttype.product_typeID', '=', 'product.product_typeID')
    //                              ->get();
    // 	return view('admin/product/product',compact("data_product"));
    // }

    public function index() //BY PHƯƠNG
    {
        $data_product        = DB::table('product')
            ->select('*')
            ->get();
        return view('admin/product/product', compact("data_product"));
    }

    public function instock()
    {
        $data_product        = DB::table('producttype')
            ->select('*')->join('product', 'producttype.product_typeID', '=', 'product.product_typeID')
            ->where('product.productStatus', 'Instock')
            ->get();
        return view('admin/product/product', compact("data_product"));
    }
    public function done()
    {
        $data_product        = DB::table('producttype')
            ->select('*')->join('product', 'producttype.product_typeID', '=', 'product.product_typeID')
            ->where('product.productStatus', 'Done')
            ->get();
        return view('admin/product/product', compact("data_product"));
    }
    public function add()
    {
        $data_product      = DB::table('product')
            ->select('productID')
            ->orderBy('productID', 'desc')
            ->limit(1)
            ->get();
        return view('admin/product/product_add', compact('data_product'));
    }
    public function get_cost(Request $request)
    {
        // if($request->get('query'))
        // {
        //  $query = $request->get('query');
        //  $data = DB::table('producttype')->select('*')
        //  ->where('product_typeName', 'LIKE', "%{$query}%")
        //  ->get();
        //  }
        $query = $request->input('aaa');
        $data = DB::table('producttype')->select('*')
            ->where('product_typeName', 'LIKE', "%{$query}%")
            ->get();
        $data = json_encode($data);
        echo $data;
    }
    public function insert(Request $request)
    {
        // $productID                =$request->productID;
        for ($i = 0; $i < $request->amount; $i++) {
            $product_typeID           = $request->input('product_typeID');

            $productName              = $request->input('product_typeName');
            $productCost              = $request->input('productCost');
            $productSell              = $request->input('productSell');
            $productNote              = $request->input('productNote');
            $productImage             = $request->file('productImage');
            $img = DB::table('producttype')->select('product_typeIMG')->where('product_typeID', $product_typeID)->get();
            foreach ($img as $row) {
                $img = $row->product_typeIMG;
            }
            DB::table('product')->insert(
                [
                    //   'productID'                =>$productID,   
                    'product_typeID'           => $product_typeID,
                    'productName'              => $productName,
                    'productCost'              => $productCost,
                    'productSell'              => $productSell,
                    'productStatus'            => 'Instock',
                    'productImage'             => $img,
                    'productNote'              => $productNote,
                ]
            );
        }
        $history = "Thêm các sản phẩm mới thuộc loại sp $productName với số lượng là $request->amount";
        $user = $request->session()->get('name');
        DB::table('history')->insert(['name' => $history, 'user' => $user]);
        return redirect('admin/product/');
    }
    public function searchResponse(Request $request) //HAM TRA VE KET QUA AUTO SEARCH ORDER
    {
        $query = $request->get('term', '');
        $countries = DB::table('producttype');
        if ($request->type == 'countryname') {
            $countries->where('product_typeName', 'LIKE', '%' . $query . '%');
        }
        $countries = $countries->get();
        $data = array();
        foreach ($countries as $country) {
            $data[] = array(
                'name' => $country->product_typeName,
                'cost' => $country->product_typeCost,
                'sell' => $country->product_typeSell,
                'pid' => $country->product_typeID,
                'img' => $country->product_typeIMG
            );
        }
        if (count($data))
            return $data;
        else
            return ['name' => ''];
    }
    public function edit($id)
    {
        $data_product = DB::table('product')
            ->select('*')->where('productID', $id)
            ->get();
        return view('admin/product/product_edit', compact('data_product'));
    }

    public function variation($sku)
    {
        // $test = DB::table('product')->where('productSKU', $sku)->first();
        $data_product = DB::table('product_variation')
            ->where('productSKU', 'LIKE', '%' . $sku . '-' . '%')
            ->get();
        return view('admin/product_variation/product_variation', compact('data_product'));
    }

    public function updateProductSendo($productID, $productName)
    {
        $response = $this->sendo->getProductDetail($productID);
        // dd($response);

        $response->result->name = $productName;

        $dataReturn = $this->sendo->updateProduct($response->result);

        if ($dataReturn->result->status === true) {
            return true;
        } else {
            return $dataReturn;
        }
    }
    public function update(Request $request)
    {
        $productID   = $request->productID;
        $productName = $request->productName;
        $productCost = $request->productCost;
        $productSell = $request->productSell;
        $productNote = $request->productNote;
        // $file        = $request->file('IMG');
        // $anhcu       = $request->input('anhcu');
        // if(empty($file)){
        //     $productIMG =$anhcu;
        // } else{
        //     $productIMG ="upload/".$file->getClientOriginalName();
        //     $typeImage  =$file->getClientOriginalExtension();
        //     $file->move('./upload/',$file->getClientOriginalName()); 
        // }
        $check = $this->updateProductSendo($productID, $productName);
        if ($check === true) {
            $updated = DB::table('product')->where('productID', $productID)->update(
                [
                    'productName'             => $productName,
                    'productCost'             => $productCost,
                    'productSell'             => $productSell,
                    'productNote'             => $productNote,
                    // 'productImage'            =>$productIMG,
                ]
            );
            $history = "Sửa sản phẩm tên là $productName và mã là $productID";
            $user = $request->session()->get('name');
            DB::table('history')->insert(['name' => $history, 'user' => $user]);

            if ($updated) {
                alert('Product Updated', 'Successfully', 'success');
                return redirect('/admin/product');
            } else {
                alert('Product Updated Failed', 'Update database failed', 'success');
                return redirect('/admin/product');
            }
        }
        // dd($check->result->status);
        if ($check->result->status == false) {
            alert('Product Updated Failed', $check->result->message, 'error');
            return redirect("/admin/product-edit/$productID");
        }
    }
    public function delete($id)
    {
        // $delete = DB::table('product')->where('productID', $id)->delete();
        // if ($delete) {
        //     alert('Product Deleted', 'Successfully', 'success');
        // } else {
        //     alert('Product Deleted', 'Nothing', 'success');
        // }
        // $history = "Xóa sản phẩm tên là $productName";
        // $user = $request->session()->get('name');
        // DB::table('history')->insert(['name' => $history, 'user' => $user]);
        // return redirect('/admin/product');
    }
    public function best_selling() //ĐẾM SỐ LƯỢNG CỦA MỖI LOẠI SP TỒN KHO và NHỮNG SP ĐÃ DONE khi F5
    {
        $type = DB::table('producttype')->select('product_typeID')->get();
        // dd($type);
        foreach ($type as $p) {
            $type = $p->product_typeID;
            $instock = DB::table('product')
                ->select('*')
                ->where('product_typeID', $type)
                ->where('productStatus', 'Instock')
                ->get();
            $instock = count($instock);
            $amount = DB::table('producttype')->where('product_typeID', $type)->update(['amount' => $instock]);

            $sell = DB::table('product')
                ->select('productID')
                ->where('product_typeID', $type)
                ->where('productStatus', 'Done')
                ->get();
            $sell = count($sell);
            $amount_sell = DB::table('producttype')->where('product_typeID', $type)->update(['amount_sell' => $sell]);
            // echo $best;
        }
    }
}

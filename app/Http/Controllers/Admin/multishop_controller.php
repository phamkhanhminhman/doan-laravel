<?php
 /*
    *   Created by  :   pkmm - 15/1/2019 
    *   Description :   category crud
*/
 namespace App\Http\Controllers\Admin;

 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 use Illuminate\Support\Facades\DB;
 use App\Http\Controllers\Handle\SendoHandler;

 class multishop_controller extends Controller
 {

 	private $sendo;

 	public function __construct(SendoHandler $sendo)
 	{
 		$this->sendo = $sendo;
 	}

 	public function index()
 	{   
 		$multishop  =   DB::table('shop')->select('*')->get();
                        // dd($multishop);                            
 		return view('admin/multishop/multishop',compact('multishop'));
 	}

 	public function addNewShop()
 	{
 		return view('admin/multishop/multishop_add');
 	}

 	public function insertNewShop(Request $request)
 	{
   		$clientID 			  =$request->input('clientID'); // doi voi sendo la shopID
   		$secretID 			  =$request->input('secretID');
   		$partnerID  		  =$request->input('partnerID');
   		$shopName             =$request->input('shopName');
   		$shopChannel          =$request->input('shopChannel');
   		$code 				  =$request->input('code');

   		$shopClient = DB::table('shop')->select('*')->where('shopID',$clientID)->get();
   		$shopSecret = DB::table('shop')->select('*')->where('secretID',$secretID)->get();
   		$shopPartner = DB::table('shop')->select('*')->where('partnerID',$partnerID)->get();

   		if (count($shopClient) == 0 && count($shopSecret) == 0 && count($shopPartner) ==0)
   		{	
   			if ($code === "SD") {
   				$testConnection = $this->testConnectionSendo($clientID);
   			} else {
   				$testConnection = $this->testConnectionShopee($secretID, $partnerID, $clientID);
   			}
   			
   			if ($testConnection === true) {
   				DB::table('shop')->insert(
   				[      
   					'shopID'           =>$clientID,
   					'secretID'         =>$secretID,
   					'partnerID'        =>$partnerID,
   					'shopName'         =>$shopName,
   					'shopChannel'      =>$shopChannel,
   					'code'			   =>$code

   				]);       
	   			$history = "Thêm 1 shop mới $shopName";
	   			$user = $request->session()->get('name');
	   			DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
	   			alert('Multishop Inserted','Successfully', 'success');
	   			// return redirect('/admin/multishop');
   			} else {
   				alert('Multishop Inserted Failed','Wrong input Client ID', 'err');
   			}
   		}
   		else
   		{
   			alert('Multishop Insert Failed','ID Duplicated', 'error');
   			// return redirect('/admin/multishop/');
   		}
   		return view('admin/multishop/multishop');
   	}

   	public function edit($id)
   	{
    	// $a=$request->input('clientID');
   		$multishop  =   DB::table('shop')
   		->where('shopID',$id)
   		->select('*')
   		->get();
                        // dd($multishop);

   		return view('admin/multishop/multishop_edit',compact('multishop'));
   	}

   	public function update(Request $request)
   	{
    	$clientID 			  =$request->input('clientID'); // doi voi sendo la shopID
    	$secretID 			  =$request->input('secretID');
    	$partnerID  		  =$request->input('partnerID');
    	$shopName             =$request->input('shopName');
    	$shopChannel          =$request->input('shopChannel');
    	$updated = DB::table('shop')
    	->where('shopID', $clientID)
    	->update([
    		'shopID'=>$clientID,
    		'secretID'=>$secretID,
    		'partnerID'=>$partnerID,
    		'shopName'=>$shopName,
    		'shopChannel'=>$shopChannel,
    	]);  
							//dd($updated);
    	$history = "Cập nhật 1 shop $shopName";
    	$user = $request->session()->get('name');
    	DB::table('history')->insert(['name'=>$history, 'user' =>$user]);
    	if ($updated) {
    		alert('Shop Updated','Successfully', 'success');
    	} else {
    		alert('Shop Updated','Nothing', 'success');
    	}

    	return redirect('/admin/multishop/');
    }

    public function testConnectionSendo($clientID)
    {
    	$username = $clientID;
    	$password = '9397f820941f37f2d28383cc419ea34632022b54';
    	$curl = curl_init();

    	curl_setopt_array($curl, array(
    		CURLOPT_URL => "https://sapi.sendo.vn/shop/authentication",
    		CURLOPT_RETURNTRANSFER => true,
    		CURLOPT_ENCODING => "",
    		CURLOPT_MAXREDIRS => 10,
    		CURLOPT_TIMEOUT => 30,
    		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    		CURLOPT_CUSTOMREQUEST => "POST",
    		CURLOPT_FOLLOWLOCATION => false,
    		CURLOPT_POSTFIELDS => "grant_type=password&username=" . $username . "&password=" . $password,
    		CURLOPT_HTTPHEADER => array(
    			"Accept: */*",
    			"Accept-Encoding: gzip, deflate",
    			"Cache-Control: no-cache",
    			"Connection: keep-alive",
    			"Content-Length: 111",
    			"Content-Type: application/x-www-form-urlencoded",
    			"Host: sapi.sendo.vn",
    			"Postman-Token: 6ede73a1-2dc0-4d5c-ba02-7725d1472c87,9c0c0007-a54e-40e0-84be-752637b80446",
    			"User-Agent: PostmanRuntime/7.16.3",
    			"cache-control: no-cache",
    		),
    	));
    	$response = curl_exec($curl);
    	$err = curl_error($curl);
    	curl_close($curl);

    	if ($err) {
    		return false;
    	} else {
    		return true;
    	}
    }

    public function testConnectionShopee($secretID, $partnerID, $shopID) 
    {
    	$client = new \Shopee\Client([
            'secret' => $secretID,
            'partner_id' => $partnerID,
            'shopid' => $shopID,
        ]);
    	$items = $client->item->getItemsList(
            array(
                'pagination_offset' => 1,
                'pagination_entries_per_page' => 1
            )
        );
        if (array_key_exists('msg', $items->data)) {
        	return false;
        } else {
        	return true;
        }
    }
}

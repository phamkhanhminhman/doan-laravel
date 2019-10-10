<?php
/*
 *   Created by  :   pkmm - 15/1/2019
 *   Description :   category crud
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use App\Http\Controllers\Handle\SendoHandler;

class test_controller extends Controller
{	
	// public function test1() 
	// {
	// 	$request = new Request('GET', 'http://httpbin.org/get');

	// 	$headers = ['X-Foo' => 'Bar'];
	// 	$body = 'hello!';
	// 	$request = new Request('PUT', 'http://httpbin.org/put', $headers, $body);
	// }


	private $sendo;

	public function __construct(SendoHandler $sendo)
    {
		$this->sendo=$sendo;
	 }

	
	public function testSendo(){
		//return $this->sendo->test();
		return $this->sendo->getSendoToken();
	}
}

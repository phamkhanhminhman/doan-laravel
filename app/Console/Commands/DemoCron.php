<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Handle\SendoHandler;
use DB;
use Mail;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';
     private $sendo;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SendoHandler $sendo)
    {
        parent::__construct();
        $this->sendo = $sendo;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $arrProductID = DB::table('product')->select('productID')->orderBy('productID','desc')->get();
       
        foreach ($arrProductID as $orderNumber) {
            $response = $this->sendo->getProductDetail($orderNumber->productID);

            $body = $response->result;
            $name = $body->name;

            $processName = explode(' ', $name);

            $productName = '';
            $index = 0;
            
            for ($i=1; $i < count($processName) ; $i++) { 
                if ($processName[0] === $processName[$i]) {
                    $index = $i;
                    break;
                }
            }
            if ($index !== 0) {
               for ($i=0; $i < $index ; $i++) {
                    if ($i === 0 ) {
                        $productName = $processName[$i];
                    } else {
                        $productName = $productName . ' ' . $processName[$i];
                    }       
                } 
            } else {
                $productName = $body->name . ' ' . $body->name;
            }

            $body->name = $productName;

            $res = $this->sendo->updateProduct($body);

            if ($res->result->status === false) {
                Mail::send('mailfb', array('email' => $orderNumber->productID,'name'=> $name, 'content' => $res->result->message), function($message){
                    $message->to('nqputcung97@gmail.com', 'ADMIN')->subject('Notification Failed Update Product Name!!!!!!');
                 });
            }
        }
        echo 1;
    }
}

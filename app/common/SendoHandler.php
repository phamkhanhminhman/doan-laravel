<?php

namespace App\common;


use \stdClass;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Config;

use DB;

class SendoHandler
{
    const URL = 'constants.gateway_api';


    /**
     * constructor.
     */
    public function __construct()
    { }

    /**
     * @param $body
     * @return string $security hash
     */
   public function test(){
       return 1;
   }
}

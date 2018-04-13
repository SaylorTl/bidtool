<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Services;


use App\Support\Ppdai\Api;
use App\Support\Ppdai\Config;
use App\Support\Ppdai\Request;
use GuzzleHttp\Client;

class PpdaiService
{

    private  $instance;

    public function __construct()
    {
        $config = new Config();
        $request = new Request(new Client(),$config);
        $this->instance =   new Api($config,$request);
    }
    
    public function getLoanList($date, $page){
        return $this->instance->getLoanList($date,$page);
    }
}
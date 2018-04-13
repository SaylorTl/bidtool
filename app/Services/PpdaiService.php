<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Services;


use App\Support\Ppdai\Api;
use App\Support\Ppdai\Config;
use App\Support\Ppdai\Request;
use App\Support\Ppdai\Response\Loan;
use App\Support\Ppdai\Response\LoanDetail;
use GuzzleHttp\Client;

class PpdaiService
{

    private  $instance;

    CONST QUEUE_PPDAI_PID = 'QUEUE_PPDAI_BID';
    CONST QUEUE_PPDAI_LOAN = 'QUEUE_PPDAI_LOAN';

    public function __construct()
    {
        $config = new Config();
        $request = new Request(new Client(),$config);
        $this->instance =   new Api($config,$request);
    }
    
    public function getLoanList($date, $page){
        $response = $this->instance->getLoanList($date,$page);
        if($response['Result'] != 1) return false;
        return Loan::createList($response['LoanInfos']);
    }

    public function getLoanDetail($listingIds){
        $response = $this->instance->getLoanDetail($listingIds);
        if($response['Result'] != 1) return false;
        return LoanDetail::createList($response['LoanInfos']);
    }
}
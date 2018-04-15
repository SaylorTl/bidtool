<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Services;


use App\Support\Ppdai\Api;
use App\Support\Ppdai\Config;
use App\Support\Ppdai\Request;
use App\Support\Ppdai\RequestMeta\LoanList;
use App\Support\Ppdai\ResponseMeta\Bid;
use App\Support\Ppdai\ResponseMeta\Loan;
use App\Support\Ppdai\ResponseMeta\LoanDetail;
use App\Support\Ppdai\RequestMeta\Bid as RequestBid;
use GuzzleHttp\Client;

class PpdaiService
{

    private  $instance;

    CONST QUEUE_PPDAI_BID = 'QUEUE_PPDAI_BID';
    CONST QUEUE_PPDAI_LOAN = 'QUEUE_PPDAI_LOAN';

    public function __construct()
    {
        $config = new Config();
        $request = new Request(new Client(),$config);
        $this->instance =   new Api($config,$request);
    }
    
    public function getLoanList(LoanList $param){
        $response = $this->instance->getLoanList($param);
        if($response['Result'] != 1) return false;
        return Loan::createList($response['LoanInfos']);
    }

    public function getLoanDetail($listingIds){
        $response = $this->instance->getLoanDetail($listingIds);
        if($response['Result'] != 1) return false;
        return LoanDetail::createList($response['LoanInfos']);
    }

    public function bid(RequestBid $bidMeta){
        $response = $this->instance->bid($bidMeta);
        if($response['Result'] != 1) return false;
        return Bid::create($response);
    }
}
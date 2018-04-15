<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai;


use App\Support\Ppdai\RequestMeta\Bid;
use App\Support\Ppdai\RequestMeta\LoanList;
use App\Support\Ppdai\RequestMeta\LoanDetail;

class Api
{
    private $endpoint = [
        'base' => 'https://openapi.ppdai.com/',
        'loanList' => 'https://openapi.ppdai.com/invest/LLoanInfoService/LoanList',
        'loanDetail' => 'https://openapi.ppdai.com/invest/LLoanInfoService/BatchListingInfos',
        'bid' => 'https://openapi.ppdai.com/invest/BidService/Bidding',
    ];

    private $_config;
    private $client;

    public function __construct(Config $config, Request $client) {
        $this->_config = $config;
        $this->client = $client;
    }

    /**
     * @param $param LoanList
     * @return array| boolean
     */
    public function getLoanList(LoanList $param){
        return $this->client->send($this->endpoint['loanList'],$param);
    }

    public function getLoanDetail(LoanDetail $param){
        return $this->client->send($this->endpoint['loanDetail'],$param);
    }

    public function bid(Bid $param){
        return $this->client->send($this->endpoint['bid'],$param);
    }



}
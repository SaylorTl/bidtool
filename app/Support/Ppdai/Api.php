<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai;


use App\Support\Ppdai\RequestMeta\LoanList;
use App\Support\Ppdai\RequestMeta\LoanDetail;

class Api
{
    private $endpoint = [
        'base' => 'https://openapi.ppdai.com/',
        'loanList' => 'https://openapi.ppdai.com/invest/LLoanInfoService/LoanList',
        'loanDetail' => 'https://openapi.ppdai.com/invest/LLoanInfoService/BatchListingInfos',
    ];

    private $_config;
    private $client;

    public function __construct(Config $config, Request $client) {
        $this->_config = $config;
        $this->client = $client;
    }

    /**
     * @param $date
     * @param int $page
     * @return array| boolean
     */
    public function getLoanList($date, $page = 1){
        $param = new LoanList($date,$page);
        return $this->client->send($this->endpoint['loanList'],$param);
    }

    public function getLoanDetail($ListingIds){
        $param = new LoanDetail($ListingIds);
        return $this->client->send($this->endpoint['loanList'],$param);
    }



}
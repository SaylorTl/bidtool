<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai;


use App\Support\Ppdai\RequestMeta\LoanList;

class Api
{
    private $endpoint = [
        'base' => 'https://openapi.ppdai.com/',
        'loanList' => 'https://openapi.ppdai.com/invest/LLoanInfoService/LoanList',
    ];

    private $_config;
    private $client;

    public function __construct(Config $config, Request $client) {
        $this->_config = $config;
        $this->client = $client;
    }

    public function getLoanList($date, $page = 1){
        $param = new LoanList($date,$page);
        return $this->client->send($this->endpoint['loanList'],$param);
    }



}
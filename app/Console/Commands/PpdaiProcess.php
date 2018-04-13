<?php

namespace App\Console\Commands;

use App\Services\PpdaiService;
use Illuminate\Console\Command;
use Predis;
use App\libraries\OpenapiClient as OpenapiClient;
use App\Jobs\GetLoanInfo;
use App\Jobs\DoBid;


class PpdaiProcess extends Command
{

    protected $signature = 'ppdai:process {page}';

    protected $description = 'A single process to get one page of loan';

    private $cache;
    private $client;

    public function __construct()
    {
        parent::__construct();
        $this->client = new OpenapiClient();
        $this->cache  = new Predis\Client();
    }

    public function handle(PpdaiService $service)
    {
        //定时清理缓存
        $nowRecodeTime = time();
        $lastRecodeTime = $this->cache->get("lastRecodeTime") ;
        if($nowRecodeTime - $lastRecodeTime >3600){
            $this->cache->set("lastRecodeTime",$nowRecodeTime);
        }
        $date = date("Y-m-d H:i:s",time()-3600);
        $result = $service->getLoanList($date,$this->argument('page'));
        if(!$result){
            pp_log("查询失败：".$result['ResultMessage']);
            return false;
        }
        if($result['Result'] !== 1){
            pp_log("查询失败：".$result['ResultMessage']);
            return false;
        }
        $aviLoan = array();
        if(empty($result['LoanInfos'])){
            return false;
        }
        foreach($result['LoanInfos'] as $key=>$value){
            if($value['Rate']<12|| $value['Months']>12){
                continue;
            }
            if($this->cache->get("ppid".$value['ListingId'])){
                continue;
            }
            if($value['CreditCode'] == 'AA'){
                pp_log(" ".$value['CreditCode']."快捷投标开始投标",$value['ListingId']);
                $this->dispatch((new DoBid($value))->onQueue('dobid'));
                continue;
            }

            $aviLoan[]=$value['ListingId'];
        }
        if(!$aviLoan){
            pp_log("筛选出符合条件标的为空",00);
            return false;
        }
        $temp = array();
        foreach($aviLoan as $k=>$v){
            $temp[]=$v;
            if(($k % 9==0 && $k>=0) || (count($aviLoan)< 9 && $k==count($aviLoan)-1) ){
                $this->dispatch((new GetLoanInfo($temp))->onQueue('loaninfo'));
            }
        }
    }

}

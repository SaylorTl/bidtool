<?php

namespace App\Console\Commands;

use App\Jobs\GetPpdaiLoanDetail;
use App\Services\PpdaiService;
use App\Support\Ppdai\Response\Loan;
use Illuminate\Console\Command;
use Predis;
use App\libraries\OpenapiClient as OpenapiClient;
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
        $aviLoan = [];
        $date = date("Y-m-d H:i:s",time()-3600);
        $loanList = $service->getLoanList($date,$this->argument('page'));
        /** @var $loan Loan*/
        foreach($loanList as $loan){
            if($loan->rate <12 || $loan->months > 12){
                continue;
            }
            if($this->cache->get("ppid".$loan->listingId)){
                continue;
            }
            if($loan->creditCode == 'AA'){
                $this->dispatch((new DoBid($loan))->onQueue('dobid'));
                continue;
            }
            $aviLoan[]=$loan->listingId;
        }
        $temp = array();
        foreach($aviLoan as $k=>$v){
            $temp[]=$v;
            if(($k % 9==0 && $k>=0) || (count($aviLoan)< 9 && $k==count($aviLoan)-1) ){
                $this->dispatch((new GetPpdaiLoanDetail($temp))->onQueue('loaninfo'));
            }
        }
    }

}

<?php

namespace App\Console\Commands;

use App\Jobs\GetPpdaiLoan;
use App\Jobs\GetPpdaiLoanDetail;
use App\Jobs\PpdaiBid;
use App\Services\PpdaiService;
use App\Support\Ppdai\RequestMeta\Bid;
use App\Support\Ppdai\RequestMeta\LoanDetail;
use App\Support\Ppdai\RequestMeta\LoanList;
use App\Support\Ppdai\ResponseMeta\Loan;
use Illuminate\Console\Command;

class PpdaiProcess extends Command
{

    protected $signature = 'ppdai:process {page}';

    protected $description = 'A single process to get one page of loan';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(PpdaiService $service)
    {
        $aviLoan = [];
        $date = date("Y-m-d H:i:s",time()-3600);
        $loanListMeta = new LoanList($date,$this->argument('page'));
        $loanList = $service->getLoanList($loanListMeta);
        /** @var $loan Loan*/
        foreach($loanList as $loan){
            var_dump($loan);
            if($loan->rate < 12 || $loan->months > 12){
                continue;
            }
            if($loan->creditCode == 'AA'){
                $bidMeta = new Bid($loan->listingId,50,true);
                $this->dispatch((new PpdaiBid($bidMeta))->onQueue(PpdaiService::QUEUE_PPDAI_BID));
                continue;
            }
            $aviLoan[] = $loan->listingId;
        }
        $temp = array();
        foreach($aviLoan as $k=>$v){
            $temp[]=$v;
            if(($k % 9==0 && $k>=0) || (count($aviLoan)< 9 && $k==count($aviLoan)-1) ){
                $loanMeta = new LoanDetail($temp);
                GetPpdaiLoan::dispatch($loanMeta)->onQueue(PpdaiService::QUEUE_PPDAI_LOAN);
            }
        }
    }

}

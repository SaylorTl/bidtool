<?php

namespace App\Jobs;

use App\Services\PpdaiService;
use App\Support\Ppdai\RequestMeta\Bid;
use App\Support\Ppdai\RequestMeta\LoanDetail;
use App\Validates\Ppdai;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class GetPpdaiLoan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $detail;

    public function __construct(LoanDetail $detail)
    {
        $this->detail = $detail;
    }


    public function handle(PpdaiService $service)
    {
        $bidList =  $service->getLoanDetail($this->detail);
        $rules = [
            "phone_validate",
            "month_too_long",
        ];
        /**@var $loan \App\Support\Ppdai\ResponseMeta\LoanDetail*/
        foreach($bidList as $loan){
            $ok = Ppdai::validate($rules,$loan);
            if(!$ok) continue;
            $bidMeta = new Bid($loan->listingId,50,true);
            PpdaiBid::dispatch($bidMeta)->onQueue(PpdaiService::QUEUE_PPDAI_BID);
        }
    }

}

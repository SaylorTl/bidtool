<?php

namespace App\Jobs;

use App\Services\PpdaiService;
use App\Support\Ppdai\Response\LoanDetail;
use App\Validates\Ppdai;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class GetPpdaiLoanDetail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $aviList;

    public function __construct($aviLoan)
    {
        $this->aviList = $aviLoan;
    }


    public function handle(PpdaiService $service)
    {
        $bidList =  $service->getLoanDetail($this->aviList);
        $rules = [
            "phone_validate",
            "month_too_long",
        ];
        /**@var $loan LoanDetail*/
        foreach($bidList as $loan){
            $ok = Ppdai::validate($rules,$loan);
            if(!$ok) continue;
            (new DoBid($loan))->dispatch($loan)->onQueue("dobid");
        }
    }

}

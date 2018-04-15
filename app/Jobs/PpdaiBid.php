<?php

namespace App\Jobs;

use App\Services\PpdaiService;
use App\Support\Ppdai\RequestMeta\Bid;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PpdaiBid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $bidMeta;
    public function __construct(Bid $bidMata)
    {
        $this->bidMeta = $bidMata;
    }
    
    public function handle(PpdaiService $service)
    {
        $service->bid($this->bidMeta);
    }
}

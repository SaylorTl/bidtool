<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\libraries\OpenapiClient as OpenapiClient;
use Predis;


class PpdaiBid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $listingId;
    public function __construct($listingId)
    {
        $this->listingId = $listingId;
    }
    
    public function handle()
    {
        $url = "https://openapi.ppdai.com/invest/BidService/Bidding";
        $request = '{"ListingId": '.$this->listingId.',"Amount": 50,"UseCoupon":"true"}';
        $result = json_decode($this->client->send($url, $request,config('app.accessToken'),5),true);
    }
}

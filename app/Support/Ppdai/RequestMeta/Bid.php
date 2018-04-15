<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai\RequestMeta;

use App\Support\Ppdai\Contract\RequestMetaContract;


class Bid implements RequestMetaContract
{
    private $listingId;
    private $amount;
    private $useCoupon;

    public function __construct($listingId,$amount,$useCoupon = true)
    {
        $this->listingId = $listingId;
        $this->amount = $amount;
        $this->useCoupon = $useCoupon;
    }

    public function toJson(){
        return json_encode([
            'ListingId'=>$this->listingId,
            'Amount'=>$this->amount,
            'UseCoupon'=>$this->useCoupon,
        ]);
    }

}
<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai\RequestMeta;

use App\Support\Ppdai\Contract\RequestMetaContract;


class LoanDetail implements RequestMetaContract
{
    private $listingIds;

    public function __construct($listingIds)
    {
        $this->listingIds = $listingIds;
    }

    public function toJson(){
        return json_encode([
            'ListingIds'=>$this->listingIds,
        ]);
    }

}
<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai\RequestMeta;

use App\Support\Ppdai\Contract\RequestMetaContract;


class LoanList implements RequestMetaContract
{
    private $pageIndex =1;
    private $startDateTime;

    public function __construct($StartDateTime,$pageIndex = 1)
    {
        $this->pageIndex = $pageIndex;
        $this->startDateTime = $StartDateTime;
    }

    public function toJson(){
        return json_encode([
            'PageIndex'=>$this->pageIndex,
            'StartDateTime'=>$this->startDateTime
        ]);
    }

}
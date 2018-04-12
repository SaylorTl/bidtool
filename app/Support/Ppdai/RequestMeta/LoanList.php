<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai\RequestMeta;

use App\Support\Ppdai\Contract\RequestMetaContract;


class LoanList implements RequestMetaContract
{
    private $PageIndex =1;
    private $StartDateTime;

    public function __construct($StartDateTime,$pageIndex = 1)
    {
        $this->PageIndex = $pageIndex;
        $this->StartDateTime = $StartDateTime;
    }

    public function set($key,$value){
        $this->$key = $value;
    }

    public function toJson(){
        return json_encode([
            'PageIndex'=>$this->PageIndex,
            'StartDateTime'=>$this->StartDateTime
        ]);
    }

}
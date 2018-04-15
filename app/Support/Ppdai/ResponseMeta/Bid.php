<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai\ResponseMeta;




class Bid
{
    public $result;
    public $resultMessage;
    public $listingId;
    public $amount;
    public $participationAmount;
    public $couponAmount;
    public $couponStatus;


    public static function createList(array $dataList){
        $instanceList = array();
        foreach ($dataList as $item){
            $instanceList[] = self::create($item);
        }
        return collect($instanceList);
    }

    public static function create(array $data){
        $instance = new self();
        $instance->result = $data['Result'];
        $instance->resultMessage = $data['ResultMessage'];
        $instance->listingId = $data['ListingId'];
        $instance->amount = $data['Amount'];
        $instance->participationAmount = $data['ParticipationAmount'];
        $instance->couponAmount = $data['CouponAmount'];
        $instance->couponStatus = $data['CouponStatus'];

        return $instance;
    }

}
<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai\Response;




class Loan
{
    public $listingId;
    public $title;
    public $creditCode;
    public $amount;
    public $rate;
    public $months;
    public $payWay;
    public $remainFunding;

    public static function createList(array $dataList){
        $instanceList = array();
        foreach ($dataList as $item){
            $instanceList[] = self::create($item);
        }
        return collect($instanceList);
    }

    public static function create(array $data){
        $instance = new self();
        $instance->listingId = $data['ListingId'];
        $instance->title = $data['Title'];
        $instance->creditCode = $data['CreditCode'];
        $instance->amount = $data['Amount'];
        $instance->rate = $data['Rate'];
        $instance->months = $data['Months'];
        $instance->payWay = $data['PayWay'];
        $instance->remainFunding = $data['Remainfunding'];
        return $instance;
    }

}
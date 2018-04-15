<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Validates;


use App\Support\Ppdai\ResponseMeta\LoanDetail;

class Ppdai
{
    public static function validate(array $rules,LoanDetail $loan){
        foreach ($rules as $rule){
            $method = "run_{$rule}";
            //todo 这里的rule 是可以使用参数的，比如月份 12 
            if(!self::$method($loan))  return false;
        }
        return true;
    }

    public static function rule_phone_validate(LoanDetail $loan){
        if($loan->phoneValidate == 0) return false;
        return true;
    }

    public static function rule_month_too_long(LoanDetail $loan){
        if($loan->months >12) return false;
        return true;
    }

}
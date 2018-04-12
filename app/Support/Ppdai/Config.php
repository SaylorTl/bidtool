<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai;
use Exception;

class Config
{
    private $data;

    public function __construct() {
        $this->data = Config::get('ppdai');
    }

    public function __call($func, $args){
        if (!array_key_exists($func, $this->data)) {
            throw new Exception(__METHOD__."No such field:{$func}");
        }
        return $this->data[$func];
    }

    public function toArray() {
        return $this->data;
    }
}
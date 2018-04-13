<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai;
use Illuminate\Support\Facades\Config as LaravelConfig;
use Exception;

class Config
{
    private $data;

    public function __construct(array $data = []) {
        $this->data = !empty($data) ? $data : LaravelConfig::get('ppdai');
    }

    public function __get($key){
        if (!array_key_exists($key, $this->data)) {
            throw new Exception(__METHOD__." No such field:{$key}");
        }
        return $this->data[$key];
    }

    public function toArray() {
        return $this->data;
    }
}
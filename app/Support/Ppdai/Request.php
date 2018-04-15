<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai;

use GuzzleHttp\Client;
use App\Support\Ppdai\Contract\RequestMetaContract;

class Request
{
    private $client;
    private $_config;

    public function __construct(Client $client, Config $_config)
    {
        $this->client = $client;
        $this->_config = $_config;
    }

    public function send($url,RequestMetaContract $param){
        $timestamp = gmdate ( "Y-m-d H:i:s", time ());
        try{
            $response = $this->client->request('POST', $url, [
                'headers' => [
                    'Content-Type'              =>'application/json;charset=UTF-8',
                    'X-PPD-TIMESTAMP'           => $timestamp,
                    'X-PPD-TIMESTAMP-SIGN'      => Sign::sign($this->_config->appid. $timestamp),
                    'X-PPD-APPID'               => $this->_config->appid,
                    'X-PPD-SIGN'                => Sign::sign(Sign::sortToSign($param->toJson())),
                    'X-PPD-ACCESSTOKEN'         => $this->_config->accessToken
                ],
                'body'=>$param->toJson()
            ]);
        }catch (\GuzzleHttp\Exception\GuzzleException $e){
            // todo 这里的异常需要记录到日志中呢
            return json_encode(['msg'=>$e->getMessage()]);
        }

        return json_decode($response->getBody(),true);
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: yingouqlj
 * Date: 17/1/13
 * Time: 下午5:15
 */

namespace extend\weapp\api;


class AccessToken extends BaseApi
{
    const API = 'https://api.weixin.qq.com/cgi-bin/token';
    protected $grant_type = 'client_credential';

    public $accessToken;
    public $expiresIn;

    public function getToken()
    {
        $params = [
            'grant_type' => $this->grant_type,
            'appid' => $this->appId,
            'secret' => $this->secret,
        ];
        $token = $this->get($params);
        return $token;
    }

}
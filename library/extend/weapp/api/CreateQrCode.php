<?php
/**
 * Created by PhpStorm.
 * User: yingouqlj
 * Date: 17/1/13
 * Time: 下午5:15
 */

namespace extend\weapp\api;

class CreateQrCode extends BaseApi
{
    const API = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit';
    const NEED_ACCESS_TOKEN = true;
    protected $grant_type = 'client_credential';
    const CURL_RAW = true;

    public $expires_in;

    /**
     * @param $path
     * @param $width
     * @return resource
     */
    public function create($path, $scene, $width = 480)
    {
        $params = [
            'page' => $path,
            'width' => $width,
            'scene' => $scene
        ];
        return $this->query(self::API . '?access_token=' . $this->accessToken, $params, 'post');

    }


}
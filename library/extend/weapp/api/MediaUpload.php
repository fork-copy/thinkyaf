<?php
/**
 * Created by PhpStorm.
 * User: yingouqlj
 * Date: 17/1/13
 * Time: 下午5:15
 */

namespace extend\weapp\api;


class MediaUpload extends BaseApi
{
    const API = 'https://api.weixin.qq.com/cgi-bin/media/upload';
    const NEED_ACCESS_TOKEN = true;


    public function uploadByForm($form)
    {
        $params = [
            'access_token' => $this->accessToken,
            'type' => '',
        ];
// todo:Form
    }


}
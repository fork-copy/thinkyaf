<?php
/**
 * Created by PhpStorm.
 * User: yingouqlj
 * Date: 17/1/13
 * Time: 下午5:15
 */

namespace extend\weapp\api;


class MessageCustomSend extends BaseApi
{
    const API = 'https://api.weixin.qq.com/cgi-bin/message/custom/send';
    const NEED_ACCESS_TOKEN = true;
    const SEND_CUSTOMER_MESSAGE_MSG_TYPE_TEXT = 'text';
    const SEND_CUSTOMER_MESSAGE_MSG_TYPE_IMAGE = 'image';
    protected $toUser;
    protected $msgType;
    protected $text;
    protected $image;


    public function sendTo($openId)
    {
        $this->toUser = $openId;
        return $this;
    }

    public function text($content)
    {
        $this->msgType = self::SEND_CUSTOMER_MESSAGE_MSG_TYPE_TEXT;
        $this->text = (object)['content' => $content];
        return $this->send();
    }

    public function image($mediaId)
    {

        $this->msgType = self::SEND_CUSTOMER_MESSAGE_MSG_TYPE_IMAGE;
        $this->image = (object)['media_id' => $mediaId];
        return $this->send();
    }

    protected function send()
    {
        if (!$this->toUser) {
            throw new \Exception('no openid');
        }
        if (!in_array($this->msgType, [self::SEND_CUSTOMER_MESSAGE_MSG_TYPE_TEXT, self::SEND_CUSTOMER_MESSAGE_MSG_TYPE_IMAGE])) {
            throw new \Exception('wrong msgType');
        }

        $params = [
            'touser' => $this->toUser,
            'msgtype' => $this->msgType,
        ];
        switch ($this->msgType) {
            case self::SEND_CUSTOMER_MESSAGE_MSG_TYPE_TEXT:
                $params['text'] = $this->text;
                break;
            case self::SEND_CUSTOMER_MESSAGE_MSG_TYPE_IMAGE:
                $params['image'] = $this->image;
                break;
        }
        return $this->post($params,['access_token'=>$this->accessToken]);
    }

}
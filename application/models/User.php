<?php
/**
 * 用户模型
 * Date: 2018\2\20 0020 13:00
 */

class UserModel extends Model
{

    public function listsShow()
    {
        $result = $this->limit(10)->select();
        dump($result);
    }
}
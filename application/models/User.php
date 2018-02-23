<?php
/**
 * 用户模型
 *
 * 写法请参考 ThinkPHP 5.1的数据模型
 */

class UserModel extends Model
{
    public function getUserInfo($uid)
    {

        return $this->where('uid',$uid)->find();
    }

}
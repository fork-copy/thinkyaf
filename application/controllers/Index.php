<?php
/**
 * RestFull Api接口专用
 * Date: 2018\2\23 0020 14:15
 */

class IndexController extends Rest
{

    /**
     * GET /Index/test?data=''
     * GET请求测试
     *
     * success() 和 fail() 快速返回示例
     */
    public function GET_testAction()
    {
        if (Input::get('data', $uid, 'int', 1)) {//get参数中含data
            //数据库操作
            $userinfo = \think\Db::name('user')->where('uid', $uid)->field('uid,username')->find();
            $this->success($userinfo);
        } else {//未输入data参数
            //fail快速返回出错信息
            $this->fail('please send request data with field name "data"');
        }
    }

    /**
     * POST /Index/test
     * POST请求测试
     *
     * response()函数自定义状态
     */
    public function POST_testAction()
    {
        if (Input::post('data', $data)) {
            // response() 指定状态为1 等同于success
            $this->response(1, $data);
        } else {
            //错误码为0，并指定http 状态码为400
            $this->response(0, 'please POST data with field name "data"', 400);
        }
    }
}
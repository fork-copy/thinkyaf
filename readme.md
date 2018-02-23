由于个人的项目需要，而对国产框架thinkphp又情有独钟，利用yaf的高性能，整合了一些网上的轮子和API接口需要的组件，致力于提高生产环境下的运行性能和开发环境下的开发效率。
核心库高效封装常用库和操作,兼容php5.6及以上，在PHP7.1上性能爆发，不知所命何名甚好，暂叫 thinkyaf 。

使用前，请按照yaf扩展;

以下常用工具库如下，有好的轻量级的欢迎大家推荐

# 数据库 - Orm

适用于PHP5.6+ 的，最佳平台PHP 7.1：
- 基于ThinkPHP5.1的ORM独立封装，PDO底层
- 支持Mysql、Pgsql、Sqlite、SqlServer、Oracle和Mongodb
- 支持Db类和查询构造器
- 支持事务
- 支持模型和关联


Db类用法：
~~~php
use think\Db;

// 进行CURD操作
Db::table('user')
	->data(['name'=>'thinkphp','email'=>'thinkphp@qq.com'])
	->insert();	
Db::table('user')->find();
Db::table('user')
	->where('id','>',10)
	->order('id','desc')
	->limit(10)
	->select();
Db::table('user')
	->where('id',10)
	->update(['name'=>'test']);	
Db::table('user')
	->where('id',10)
	->delete();
~~~

定义模型：
~~~php
class UserModel extends Model
{
    public function getUserInfo($uid)
    {

        return $this->where('uid',$uid)->find();
    }

}
~~~

代码调用：

~~~php
$user = new UserModel();
$user->getUserInfo($uid);
~~~

更多操作参考TP5.1的完全开发手册[数据库](https://www.kancloud.cn/manual/thinkphp5_1/353998)章节


# 缓存 - Cache

用于PHP缓存管理（PHP>5.6+）

 - 驱动方式（支持file/memcache/redis/xcache/wincache/sqlite）
 
 使用File作为缓存驱动时，请设置 runtime目录为 777 可读可写权限
 
 ~~~php
 
 // 设置缓存
 use \think\Cache;
 
 Cache::set('val','value',600);
 // 判断缓存是否设置
 Cache::has('val');
 // 获取缓存
 Cache::get('val');
 // 删除缓存
 Cache::rm('val');
 // 清除缓存
 Cache::clear();
 // 读取并删除缓存
 Cache::pull('val');
 // 不存在则写入
 Cache::remember('val','value');
 
 
 // 对于数值类型的缓存数据可以使用
 // 缓存增+1
 Cache::inc('val');
 // 缓存增+5
 Cache::inc('val',5);
 // 缓存减1
 Cache::dec('val');
 // 缓存减5
 Cache::dec('val',5);

~~~

# 数据验证 - validate


## 用法
~~~php
use think\Validate;

$validate = Validate::make([
    'name'  => 'require|max:25',
    'email' => 'email'
]);

$data = [
    'name'  => 'thinkphp',
    'email' => 'thinkphp@qq.com'
];

if (!$validate->check($data)) {
    var_dump($validate->getError());
}
~~~

支持创建验证器进行数据验证
~~~php
<?php

class UserValidate extends Validate
{
    protected $rule =   [
        'name'  => 'require|max:25',
        'age'   => 'number|between:1,120',
        'email' => 'email',    
    ];
    
    protected $message  =   [
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过25个字符',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-120之间',
        'email'        => '邮箱格式错误',    
    ];
    
}
~~~

验证器调用代码如下：
~~~php
$data = [
    'name'  => 'thinkphp',
    'email' => 'thinkphp@qq.com',
];

$validate = new UserValidate();

if (!$validate->check($data)) {
    var_dump($validate->getError());
}
~~~

更多用法可以参考5.1完全开发手册的[验证](https://www.kancloud.cn/manual/thinkphp5_1/354101)章节


# 输入过滤库 - input


* 返回true(输入存在且有效)或者false,
* 输入结果存在$export中
* $filter为参数格式验证或者过滤方法支持：正则表达式，系统函数，php的filter_var常量,自定义的验证过滤函数
```php
Input::post($name, &$export, $filter = null, $default = null)
Input::get($name, &$export, $filter = null, $default = null)
Input::put($name, &$export, $filter = null, $default = null)
Input::I($name, &$export, $filter = null, $default = null)

其中I包含以上三种方式支持cookie和env，$name未指定方法时读取$_RESUQET

```

# 快速随机数生成器  - Random
```php
Random::n($n = 4)  #生成随机number[0-9]
Random::w($n = 8)  #随机word[0-9|a-Z]
Random::c($n=10)   #生成随机char[a-Z]
Random::code($n=6) #随机验证码验证码,去除0，1等不易辨识字符
```

# 非对称加密库 - Rsa 
可用户RPC接口的安全性，和数据传输非对称加密，默认配置 res.lifetime 为30天有效私钥缓存
```php
Rsa::pubKey()   #获取公钥
Rsa::encode($s) #加密
Rsa::decode($s) #解密
```

# api支持 - restfull 
REST控制器核心基类

* 自动把GET,POST,PUT,DELETE 映射到 对应的Action 如getdetail 映射到GET_detailAction()
* 自动绑定参数id
* 自动输出xml或者json格式数据

代码演示:
```php
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
    
```

`protected $response ` 响应的数据

`protected response(status,info)` 快速设置响应方法


# Session
Session操作管理
支持数组
```php
Session::set($name, $data) #设置
Session::get($name)        #读取
Session::del($name)        #删除
Session::flush()           #清空
```
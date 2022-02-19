# think-request

## 安装
```bash
composer require reaway/think-request
```

## 用法
```php
use Think\Component\Request\Facade\Request;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Request::has('id','get');
Request::has('name','post');
Request::param('name');
Request::get('name'); // 返回值为null

// 判断变量是否定义
input('?get.id');
input('?post.name');

// 获取PARAM参数
input('param.name'); // 获取单个参数
input('param.'); // 获取全部参数
// 下面是等效的
input('name'); 
input('');

// 获取GET参数
// 获取单个变量
input('get.id');
// 使用过滤方法获取 默认为空字符串
input('get.name');
// 获取全部变量
input('get.');

// 使用过滤方法
input('get.name','','htmlspecialchars'); // 获取get变量 并用htmlspecialchars函数过滤
input('username','','strip_tags'); // 获取param变量 并用strip_tags函数过滤
input('post.name','','org\Filter::safeHtml'); // 获取post变量 并用org\Filter类的safeHtml方法过滤

// 使用变量修饰符
input('get.id/d');
input('post.name/s');
input('post.ids/a');
```

## 文档

详细参考 [请求](https://www.kancloud.cn/manual/thinkphp6_0/1037519)
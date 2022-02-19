# think-request

## 安装
```bash
composer require reaway/think-request
```

## 用法
```php
use Think\Component\Request\Facade\Request;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

var_dump(Request::server());
var_dump(Request::param());
```

## 文档

详细参考 [请求](https://www.kancloud.cn/manual/thinkphp6_0/1037519)
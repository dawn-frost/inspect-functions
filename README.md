## PHP 纯 API 后端中用于验证的一些常规函数

- 环境要求：php 4.6 版本及以上
- composer 安装

```php
  composer require dawn-frost/dawn-inspect
```

## src 文件夹下面文件功能说明

- Validator 类
  - 业务使用函数，比如验证手机号、整型数字等
- Checker 类
  - 系统使用函数，比如 xss 字符串验证

## 使用示例

### 用户授权

```php
require_once './vendor/autoload.php'; // 一般框架自动引入

use DawnFrost\Inspect\Validator;

$result = Validator::isMobile('xxxxxxxx');

var_dump($result);
```

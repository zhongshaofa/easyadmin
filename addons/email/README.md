# 使用教程

> 此插件为EasyAdmin官方邮件发送插件, 下方是简单的使用教程

### 使用示例

```php
    /**
     * 发送单邮箱
     */
    public function sendOneEmail()
    {
        $parames = [
            'toemail' => 'chung@99php.cn',
            'title'   => '测试邮箱标题',
            'info'    => '测试邮箱的主体信息',
        ];
        $result = addon('email', 'send', $parames);
        dump($result);
    }

    /**
     * 发送多邮箱
     */
    public function sendMoreEmail()
    {
        $parames = [
            'toemail' => [
                'chung1@99php.cn',
                'chung2@99php.cn',
                'chung2@99php.cn',
            ],
            'title'   => '测试邮箱标题',
            'info'    => '测试邮箱的主体信息',
        ];
        $result = addon('email', 'send', $parames);
        dump($result);
    }
```




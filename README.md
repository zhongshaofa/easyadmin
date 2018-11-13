99Blog社区博客系统
===============
> 框架主要使用thinkphp5.1 + layui + jquery。后台基于99Admin进行开发，具备auth权限认证管理功能。

## 演示站点
> 博客地址：[99PHP社区](https://blog.99php.cn)，后台地址：[99Admin后台管理](https://demo.99php.cn/admindemo.php)（账号：99blog，密码：99blog。备注：只有查看信息的权限）

## 系统环境及安装
 + git clone https://gitee.com/zhongshaofa/99Blog.git，或者直接下载安装包
 + 环境推荐PHP7.0版本以上 + Apache（Nginx也可以）
 + 网站入口请部署至public文件夹下（即 99Blog/public 目录下）
 + 运行安装目录，运行 http://域名/install（例如：https://blog.99php.cn/install） 即可进行根据提示进行安装
 + 安装会进行后台路径和管理员的初始化（后台路径不建议设置为admin，容易被人发现后台入口）
 + 安装后会在config/lock文件夹下生成install.lock文件的安装锁（如果需要重新安装，请删除该文件夹即可）

## 配置系统
+ 配置QQ快捷登录。修改config/qq.php文件，配置对应的appid、appkey、callback。callback为应用回调地址，要指定至blog/oauth/callback路径下，例如：https://www.99php.cn/blog/oauth/callback
+ 配置七牛云上传，减轻服务器资源访问压力。
修改config/qiniu.php文件，配置对应的AccessKey、SecretKey、Bucket、url，另外还在修改数据库中system_config，name为FileType的value的值为2 (文件保存方法 1：本地，2：七牛云)。

## 常见问题
> 系统菜单栏显示不正常，请手动刷新系统缓存。

## 疑问解答
> 有问题请加[QQ群：763822524](https://jq.qq.com/?_wv=1027&k=5IHJawE)，或者请前往[99PHP社区](https://blog.99php.cn)进行提问。

## 备注说明
> 操作说明文档和开发文档，后续觉得有必要再编写文档。
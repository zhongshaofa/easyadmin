99Blog社区博客系统
===============
> 框架主要使用thinkphp5.1 + layui + jquery。后台基于99Admin进行开发，具备auth权限认证管理功能。
> 项目会不定时进行更新，建议star和fork一份，另外有问题请加QQ群：[763822524](https://jq.qq.com/?_wv=1027&k=5IHJawE)。

## 演示站点
![Image text](https://files.gitee.com/group1/M00/08/5C/PaAvDF0av7uANv5KAAHZRSmmizI425.jpg)
> 博客地址：[99PHP社区](https://blog.99php.cn)，后台地址：[99Admin后台管理](http://demo.99php.cn/admindemo.php)（账号：99blog，密码：99blog。备注：只有查看信息的权限）

## 系统环境及安装
 + git clone https://gitee.com/zhongshaofa/99Blog.git，或者直接下载安装包
 + 环境推荐PHP7.0版本以上 + Apache（Nginx也可以）
 + 网站入口请部署至public文件夹下（即 99Blog/public 目录下）
 + 运行安装目录，运行 http://域名/install（例如：https://blog.99php.cn/install） 即可进行根据提示进行安装
 + 安装会进行后台路径和管理员的初始化（后台路径不建议设置为admin，容易被人发现后台入口）
 + 安装后会在config/lock文件夹下生成install.lock文件的安装锁（如果需要重新安装，请删除该文件夹即可）
 
## Apache和Nginx配置
* Apache环境下请修改99blog\public\.htaccess文件的url重写规则
 ```
<IfModule mod_rewrite.c>
Options +FollowSymlinks -Multiviews
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php?s=$1 [QSA,PT,L]
</IfModule>
 ```
 * Nginx环境配置请参考下方进行修改
  ```
server {
    listen       80;
    server_name  blog.com;
    root   /var/www/html/99Blog/public;
    index      index index.php index.html index.htm default.php default.htm default.html;

    access_log  /var/log/nginx/nginx.blog.access.log  main;
    error_log  /var/log/nginx/nginx.blog.error.log  warn;
 
    location / {
	 if (!-e $request_filename){
		rewrite  ^(.*)$  /index.php?s=$1  last;   break;
	 }
    }
    location ~ [^/]\.php(/|$){
	try_files $uri =404;
        fastcgi_pass  php72:9000;
        fastcgi_index index.php;
	fastcgi_param  SCRIPT_FILENAME    $document_root$fastcgi_script_name;
	fastcgi_param  QUERY_STRING       $query_string;
	fastcgi_param  REQUEST_METHOD     $request_method;
	fastcgi_param  CONTENT_TYPE       $content_type;
	fastcgi_param  CONTENT_LENGTH     $content_length;
	fastcgi_param  SCRIPT_NAME        $fastcgi_script_name;
	fastcgi_param  REQUEST_URI        $request_uri;
	fastcgi_param  DOCUMENT_URI       $document_uri;
	fastcgi_param  DOCUMENT_ROOT      $document_root;
	fastcgi_param  SERVER_PROTOCOL    $server_protocol;
	fastcgi_param  HTTPS              $https if_not_empty;
	fastcgi_param  GATEWAY_INTERFACE  CGI/1.1;
	fastcgi_param  SERVER_SOFTWARE    nginx/$nginx_version;
	fastcgi_param  REMOTE_ADDR        $remote_addr;
	fastcgi_param  REMOTE_PORT        $remote_port;
	fastcgi_param  SERVER_ADDR        $server_addr;
	fastcgi_param  SERVER_PORT        $server_port;
	fastcgi_param  SERVER_NAME        $server_name;
	fastcgi_param  REDIRECT_STATUS    200;
	set $real_script_name $fastcgi_script_name;
	if ($fastcgi_script_name ~ "^(.+?\.php)(/.+)$") {
			set $real_script_name $1;
			set $path_info $2;
	 }
	fastcgi_param SCRIPT_FILENAME $document_root$real_script_name;
	fastcgi_param SCRIPT_NAME $real_script_name;
	fastcgi_param PATH_INFO $path_info;
    }
}
  ```

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
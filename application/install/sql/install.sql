/*
Navicat MySQL Data Transfer

Source Server         : data.99php.cn
Source Server Version : 50719
Source Host           : data.99php.cn:3306
Source Database       : test_99php_cn

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-10-08 14:44:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_article
-- ----------------------------
DROP TABLE IF EXISTS `blog_article`;
CREATE TABLE `blog_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT '文章类型',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '博客用户',
  `title` varchar(100) NOT NULL COMMENT '文章标题',
  `cover_img` varchar(255) DEFAULT NULL COMMENT '文章封面',
  `describe` varchar(255) DEFAULT NULL COMMENT '文章描述',
  `content` mediumtext NOT NULL COMMENT '文章内容',
  `recommend` int(10) DEFAULT '0' COMMENT '推荐级别',
  `praise` int(11) DEFAULT '0' COMMENT '点赞量',
  `clicks` int(10) DEFAULT '0' COMMENT '点击量',
  `sort` int(10) DEFAULT '0' COMMENT '排序',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `is_open` tinyint(1) DEFAULT '1' COMMENT '是否公开 (0：否，1：是）',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` int(10) DEFAULT '0' COMMENT '创建人',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `update_by` int(10) DEFAULT NULL COMMENT '更新人',
  PRIMARY KEY (`id`),
  KEY `index_blog_article_title` (`title`) USING BTREE,
  KEY `index_blog_article_sort` (`sort`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='博客文章表';

-- ----------------------------
-- Records of blog_article
-- ----------------------------
INSERT INTO `blog_article` VALUES ('1', '2', '1', 'python实现从ftp服务器下载文件的方法1', '/static/uploads/20180903/bf7a25a3170d9147afd5c6025b5f5d77.jpg', '这篇文章主要介绍了python实现从ftp服务器下载文件的方法,涉及Python操作FTP的相关技巧,非常具有实用价值,需要的朋友可以参考下', '<p>之前服务器放在电信机房， 联通用户访问速度很不稳定，经常出现访问速度慢的问题，换到阿里云解决了之前的问题。很多人都问我的博客选得什么空间，一年的费用得多少钱，今天我列个表出来，供大家参考。</p><p>&nbsp;<img src=\"/static/temp/blog/at1.png\" alt=\"个人博客阿里云空间选择\" width=\"700\" height=\"886\"></p><p>对于访问量不大，小型网站带宽可以选择1M的，每个月<span class=\"cny\" style=\"margin: 0px 1px; padding: 0px; border: 0px; font-family: Arial; line-height: 20px; font-size: 20px; vertical-align: baseline; color: rgb(255, 102, 0); white-space: nowrap;\">¥</span><span class=\"money\" style=\"margin: 0px; padding: 0px; border: 0px; font-family: 微软雅黑, \'Microsoft Yahei\', \'Hiragino Sans GB\', tahoma, arial, 宋体; line-height: 20px; font-size: 20px; vertical-align: baseline; color: rgb(255, 102, 0); white-space: nowrap;\">56.80</span>一年也就568块钱，每天投入也就不到2块钱。</p><p><img src=\"/static/temp/blog/at2.png\" alt=\"个人博客阿里云空间选择\"></p><p><strong>1、为什么选Linux？</strong></p><p>程序用PHP，速度快，配置低（windows必选1G的内存Linux选512MB能同样达到要求）。Linux的系统安全性非常高。Linux服务器的维护与扩展到性价比和性能都高于Windows。</p><p>1) 最流行的服务器端操作系统，强大的安全性和稳定性</p><p>2) 免费且开源，轻松建立和编译源代码</p><p>3) 通过SSH方式远程访问您的云服务器</p><p>4) 一般用于高性能web等服务器应用，支持常见的PHP/Python等编程语言，支持MySQL等数据库（需自行安装)</p><p><strong>2、操作系统为什么选CentOS 安全加固版（推荐）？</strong></p><p>在原 CentOS镜像的基础上，系统进一步安全加固，安装了阿里云独有的入侵防御系统，系统中会出现aegis进程，该系统增加了实时后门，Webshell检测，更加智能的暴力破解防御和多种入侵行为监控，让服务器更加安全可靠。</p><p><a href=\"http://www.aliyun.com/product/ecs\" target=\"_blank\"><strong><span style=\"color: rgb(0, 0, 255);\">前往阿里云官网购买&gt;&gt;</span></strong></a></p><p>&nbsp;</p><p align=\"center\" class=\"pageLink\"></p><p><br></p>', '25', '0', '10', '11', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('2', '4', '1', 'centos 6.5 nginx安装及配置', '/static/temp/blog/art.jpg', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '66', '0', '74', '0', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('3', '5', '1', 'python中as用法实例分析', '/static/temp/blog/art.jpg', '这篇文章主要介绍了python中as用法,实例分析了as的功能及相关使用技巧,非常具有实用价值,需要的朋友可以参考下', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '0', '0', '104', '21', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('4', '6', '1', ' mysql性能的检查和优化方法', '/static/temp/blog/art.jpg', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '19', '0', '0', '0', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('5', '1', '1', '个人博客应该选择什么样的域名和域名后缀', '/static/temp/blog/art.jpg', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '0', '0', '70', '26', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('6', '2', '1', '我们需要了解的是php中的有关错误的配置有哪些？PHP的错误机', '/static/temp/blog/art.jpg', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '0', '0', '23', '0', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('7', '1', '1', '个人博客应该选择什么样的域名和域名后缀', '/static/temp/blog/art.jpg', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '26', '0', '23', '14', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('8', '4', '4', 'centos 6.5 nginx安装及配置', '/static/temp/blog/art.jpg', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '0', '0', '3', '0', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('9', '1', '1', '作为 PHP 开发者请务必了解 Composer', '/static/temp/blog/art.jpg', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '0', '0', '12', '28', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('10', '1', '1', '恕我直言，杂而不精的语言会被淘汰的很快', '/static/temp/blog/art.jpg', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '17', '0', '0', '0', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('11', '1', '4', '个人博客应该选择什么样的域名和域名后缀', '/static/temp/blog/art.jpg', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '0', '0', '54', '15', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('12', '2', '1', 'PHP基础之表达式', '/static/temp/blog/art.jpg', '表达式是 PHP 最重要的基石。在 PHP 中，几乎所写的任何东西都是一个表达式。简单但却最精确的定义一个表达式的方式就是“任何有值的东西”。', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '14', '0', '14', '0', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('13', '1', '1', '个人博客应该选择什么样的域名和域名后缀', '/static/temp/blog/art.jpg', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '0', '0', '7', '19', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('14', '1', '6', '每个程序员都应该知道的 15 个最佳 PHP 库', '/static/temp/blog/art.jpg', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '19', '0', '80', '1', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('15', '1', '1', ' 手把手编写自己的 PHP MVC 框架实例教程', '/static/temp/blog/art.jpg', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '不论搭建什么样的网站，选择一个好的域名都是很有必要的，选择一个好的域名对网站的意义也是不言而喻的。每一个网站都有之对应的域名，就像人的名字一样。每个人都想自己有个好听的名字，网站也是一样。一个网站可以有多个域名，但是一个域名只能对应', '0', '0', '12', '0', null, '0', '1', '0', '2018-08-10 16:59:53', '0', null, null);
INSERT INTO `blog_article` VALUES ('16', '2', '1', 'Beyond Compare 4提示已经过了30天试用期', '/static/uploads/20180903/91a0feedbff72a3e1f5a31413218b55e.jpg', '打开Beyond Compare 4，提示已经超出30天试用期限制，解决方法：', '<h3><span style=\"font-weight: bold;\">打开Beyond Compare 4，提示已经超出30天试用期限制，解决方法：</span></h3><blockquote>1.修改C:\\Program Files\\Beyond Compare 4\\BCUnrar.dll ,这个文件重命名或者直接删除，则会新增30天试用期，再次打开提示还有28天试用期。<br>2.一劳永逸，修改注册表<br>1)在搜索栏中输入 regedit&nbsp; &nbsp;，打开注册表<br>2) 删除项目：计算机\\HKEY_CURRENT_USER\\Software\\Scooter Software\\Beyond Compare 4\\CacheId</blockquote><p><br></p>', '0', '0', '4', '0', null, '0', '1', '0', '2018-08-15 15:18:08', '0', null, null);
INSERT INTO `blog_article` VALUES ('17', '2', '1', '测试标签', '/static/uploads/20180827/8e24abf89c001817deab3e611a142f20.jpg', '535', '<p>53353</p>', '0', '0', '4', '0', null, '0', '1', '0', '2018-08-27 14:13:52', '0', null, null);
INSERT INTO `blog_article` VALUES ('18', '2', '1', '测试', '/static/uploads/20180827/9c34d4119e59bb433ade6c71fb5cbb2a.jpg', '5353', '<p>5353</p>', '0', '0', '1', '0', null, '0', '1', '0', '2018-08-27 14:14:28', '0', null, null);
INSERT INTO `blog_article` VALUES ('19', '2', '1', '测试发布文章', '/static/uploads/20180827/c4cc44e60248a662647cd5b6d2c1afb0.jpg', '563', '<p>6363</p>', '0', '0', '0', '0', null, '0', '1', '1', '2018-08-27 18:24:12', '0', null, null);
INSERT INTO `blog_article` VALUES ('20', '2', '1', '测试发布文章', '/static/uploads/20180827/c4cc44e60248a662647cd5b6d2c1afb0.jpg', '563', '<p>6363</p>', '0', '0', '1', '0', null, '0', '1', '1', '2018-08-27 18:24:50', '0', null, null);
INSERT INTO `blog_article` VALUES ('21', '2', '6', '测试发布文章', '/static/uploads/20180827/c4cc44e60248a662647cd5b6d2c1afb0.jpg', '563', '<p>6363</p>', '0', '0', '2', '0', null, '0', '1', '0', '2018-08-27 18:25:15', '0', null, null);
INSERT INTO `blog_article` VALUES ('22', '2', '1', 'ceshi ', '/static/uploads/20180827/f72d2cfa1cea88165cd4388929972a9e.jpg', '644', '<p>64646</p>', '0', '0', '0', '0', null, '0', '1', '1', '2018-08-27 18:29:18', '0', null, null);
INSERT INTO `blog_article` VALUES ('23', '2', '1', 'ceshi ', '/static/uploads/20180827/f72d2cfa1cea88165cd4388929972a9e.jpg', '644', '<p>64646</p>', '0', '0', '0', '0', null, '0', '1', '1', '2018-08-27 18:29:55', '0', null, null);
INSERT INTO `blog_article` VALUES ('24', '2', '1', 'ceshi ', '/static/uploads/20180827/f72d2cfa1cea88165cd4388929972a9e.jpg', '644', '<p>64646</p>', '0', '0', '1', '0', null, '0', '1', '1', '2018-08-27 18:30:35', '0', null, null);
INSERT INTO `blog_article` VALUES ('25', '2', '1', 'ceshi 标签', '/static/uploads/20180906/c832af485f7a8f7814dc46486911eeec.png', '644', '<p>64646757</p><p><br></p>', '0', '0', '67', '0', null, '0', '1', '1', '2018-08-27 18:32:47', '0', null, null);
INSERT INTO `blog_article` VALUES ('26', '2', '1', 'python实现从ftp服务器下载文件的方法', '/static/temp/blog/art.jpg', '这篇文章主要介绍了python实现从ftp服务器下载文件的方法,涉及Python操作FTP的相关技巧,非常具有实用价值,需要的朋友可以参考下', '<p>之前服务器放在电信机房， 联通用户访问速度很不稳定，经常出现访问速度慢的问题，换到阿里云解决了之前的问题。很多人都问我的博客选得什么空间，一年的费用得多少钱，今天我列个表出来，供大家参考。</p><p>&nbsp;<img src=\"/static/temp/blog/at1.png\" alt=\"个人博客阿里云空间选择\" width=\"700\" height=\"886\"></p><p>对于访问量不大，小型网站带宽可以选择1M的，每个月<span class=\"cny\" style=\"margin: 0px 1px; padding: 0px; border: 0px; font-family: Arial; line-height: 20px; font-size: 20px; vertical-align: baseline; color: rgb(255, 102, 0); white-space: nowrap;\">¥</span><span class=\"money\" style=\"margin: 0px; padding: 0px; border: 0px; font-family: 微软雅黑, \'Microsoft Yahei\', \'Hiragino Sans GB\', tahoma, arial, 宋体; line-height: 20px; font-size: 20px; vertical-align: baseline; color: rgb(255, 102, 0); white-space: nowrap;\">56.80</span>一年也就568块钱，每天投入也就不到2块钱。</p><p><img src=\"/static/temp/blog/at2.png\" alt=\"个人博客阿里云空间选择\"></p><p><strong>1、为什么选Linux？</strong></p><p>程序用PHP，速度快，配置低（windows必选1G的内存Linux选512MB能同样达到要求）。Linux的系统安全性非常高。Linux服务器的维护与扩展到性价比和性能都高于Windows。</p><p>1) 最流行的服务器端操作系统，强大的安全性和稳定性</p><p>2) 免费且开源，轻松建立和编译源代码</p><p>3) 通过SSH方式远程访问您的云服务器</p><p>4) 一般用于高性能web等服务器应用，支持常见的PHP/Python等编程语言，支持MySQL等数据库（需自行安装)</p><p><strong>2、操作系统为什么选CentOS 安全加固版（推荐）？</strong></p><p>在原 CentOS镜像的基础上，系统进一步安全加固，安装了阿里云独有的入侵防御系统，系统中会出现aegis进程，该系统增加了实时后门，Webshell检测，更加智能的暴力破解防御和多种入侵行为监控，让服务器更加安全可靠。</p><p><a href=\"http://www.aliyun.com/product/ecs\" target=\"_blank\"><strong><span style=\"color: rgb(0, 0, 255);\">前往阿里云官网购买&gt;&gt;</span></strong></a></p><p>&nbsp;</p><p align=\"center\" class=\"pageLink\"></p><p><br></p>', '0', '0', '28', '0', null, '0', '1', '0', '2018-09-03 15:01:03', '0', null, null);
INSERT INTO `blog_article` VALUES ('27', '2', '1', '测试修改', '/static/uploads/20180906/812e907a058546ba3a836df7f839d816.png', '4234', '<p>525252<img src=\"/static/uploads/20180906/d1db6f9edb78b89fa40956532c9c4b6c.png\" style=\"max-width: 100%;\"></p>', '0', '0', '14', '0', null, '0', '1', '1', '2018-09-06 03:05:51', '0', null, null);
INSERT INTO `blog_article` VALUES ('28', '2', '6', '测试使用七牛云上传', 'https://static.99php.cn/aca8b0fdd4d6156e410772a275ddda83.jpg', '', '<p>测试使用七牛云上传<img src=\"https://static.99php.cn/da16343d35d41c7f9f9a6c3edc5cb519.png\" style=\"max-width: 100%;\"></p>', '0', '0', '15', '0', null, '0', '1', '0', '2018-09-20 03:27:23', '0', null, null);

-- ----------------------------
-- Table structure for blog_article_tag
-- ----------------------------
DROP TABLE IF EXISTS `blog_article_tag`;
CREATE TABLE `blog_article_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL COMMENT '文章编号',
  `tag_id` int(11) NOT NULL COMMENT '标签编号',
  PRIMARY KEY (`id`),
  KEY `index_blog_article_tag_article_id` (`article_id`) USING BTREE,
  KEY `index_blog_article_tag_tag_id` (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='文章标签关联表';

-- ----------------------------
-- Records of blog_article_tag
-- ----------------------------
INSERT INTO `blog_article_tag` VALUES ('7', '26', '1');
INSERT INTO `blog_article_tag` VALUES ('8', '26', '2');
INSERT INTO `blog_article_tag` VALUES ('9', '26', '3');
INSERT INTO `blog_article_tag` VALUES ('10', '26', '4');
INSERT INTO `blog_article_tag` VALUES ('24', '1', '1');
INSERT INTO `blog_article_tag` VALUES ('25', '1', '2');
INSERT INTO `blog_article_tag` VALUES ('26', '1', '3');
INSERT INTO `blog_article_tag` VALUES ('27', '1', '4');
INSERT INTO `blog_article_tag` VALUES ('28', '16', '15');
INSERT INTO `blog_article_tag` VALUES ('29', '25', '4');
INSERT INTO `blog_article_tag` VALUES ('30', '25', '13');
INSERT INTO `blog_article_tag` VALUES ('31', '27', '4');
INSERT INTO `blog_article_tag` VALUES ('32', '28', '16');
INSERT INTO `blog_article_tag` VALUES ('33', '28', '4');
INSERT INTO `blog_article_tag` VALUES ('34', '28', '17');

-- ----------------------------
-- Table structure for blog_category
-- ----------------------------
DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '栏目标题',
  `image` varchar(20) DEFAULT NULL COMMENT '栏目图片',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态(0：正常，1：禁用)',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` int(10) DEFAULT '0' COMMENT '创建人',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `update_by` int(10) DEFAULT NULL COMMENT '更新人',
  PRIMARY KEY (`id`),
  KEY `index_blog_nav_title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='博客文章栏目表';

-- ----------------------------
-- Records of blog_category
-- ----------------------------
INSERT INTO `blog_category` VALUES ('1', '技术杂谈', null, null, '4', '0', '2018-08-10 16:58:32', '0', null, null);
INSERT INTO `blog_category` VALUES ('2', 'PHP开发', null, null, '5', '0', '2018-08-10 16:58:43', '0', null, null);
INSERT INTO `blog_category` VALUES ('3', 'JAVA开发', null, null, '0', '0', '2018-08-10 16:58:49', '0', null, null);
INSERT INTO `blog_category` VALUES ('4', 'Linux运维', null, null, '0', '0', '2018-08-10 16:58:56', '0', null, null);
INSERT INTO `blog_category` VALUES ('5', 'Python开发', null, null, '0', '0', '2018-08-11 01:42:41', '0', null, null);
INSERT INTO `blog_category` VALUES ('6', 'Mysql数据库', null, null, '0', '0', '2018-08-11 01:43:09', '0', null, null);

-- ----------------------------
-- Table structure for blog_comment
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(10) NOT NULL COMMENT '文章编号',
  `member_id` int(11) NOT NULL COMMENT '会员标号',
  `content` varchar(1000) NOT NULL COMMENT '评论内容',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注信息',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `index_blog_comment_article_id` (`article_id`) USING BTREE,
  KEY `index_blog_comment_member_id` (`member_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='文章评论表';

-- ----------------------------
-- Records of blog_comment
-- ----------------------------
INSERT INTO `blog_comment` VALUES ('2', '2', '1', '确定没有写错？', null, '0', '0', '2018-08-10 22:44:26');
INSERT INTO `blog_comment` VALUES ('3', '1', '1', '排版真好看', null, '0', '0', '2018-08-10 22:44:55');
INSERT INTO `blog_comment` VALUES ('58', '3', '1', '<p>测试评论</p>', null, '0', '0', '2018-08-12 14:11:09');
INSERT INTO `blog_comment` VALUES ('61', '3', '1', '<pre><code>/**<br>     * 添加评论<br>     * @param $insert<br>     * @return \\think\\response\\Json<br>     * @throws \\think\\exception\\PDOException<br>     */<br>    public function add($insert) {<br>        //使用事物保存数据<br>        $this-&gt;startTrans();<br>        $save = $this-&gt;save($insert);<br>        if (!$save) {<br>            $this-&gt;rollback();<br>            return __error(\'数据有误，请稍后再试！\');<br>        }<br>        $this-&gt;commit();<br>        return __success(\'添加成功！\');<br>    }</code></pre><p><br></p>', null, '1', '0', '2018-08-12 14:21:58');
INSERT INTO `blog_comment` VALUES ('62', '3', '1', '<div><img alt=\"火箭勇士交锋成新赛季焦点\" src=\"http://n.sinaimg.cn/sports/transform/270/w650h420/20180812/OtDD-hhqtawx2920397.jpg\">火箭勇士交锋成新赛季焦点</div><p>　　吐槽不停，欢乐不止，新浪NBA神吐槽栏目继续登场！</p>', null, '1', '0', '2018-08-12 14:25:08');
INSERT INTO `blog_comment` VALUES ('63', '3', '1', '<p><span style=\"color: rgb(249, 150, 59);\"><a target=\"_blank\" href=\"https://weibo.com/2127735164\">你是我唯一想要的了解nice</a>：届时，谁赢了谁就是下一任美国队长盾牌的拥有者&nbsp;</span>&nbsp;<br></p>', null, '0', '0', '2018-08-12 14:27:48');
INSERT INTO `blog_comment` VALUES ('64', '4', '1', '<p>其实优化数据库是有很多小技巧的</p>', null, '0', '0', '2018-08-12 14:30:39');
INSERT INTO `blog_comment` VALUES ('65', '5', '1', '<p><img src=\"http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/50/pcmoren_huaixiao_org.png\" alt=\"[坏笑]\" data-w-e=\"1\">你好<br></p>', null, '0', '0', '2018-08-12 21:32:30');
INSERT INTO `blog_comment` VALUES ('66', '25', '1', '<p>没什么事</p>', null, '0', '0', '2018-09-06 02:56:50');
INSERT INTO `blog_comment` VALUES ('67', '25', '1', '<p>哈哈</p>', null, '0', '0', '2018-09-06 02:59:26');
INSERT INTO `blog_comment` VALUES ('68', '25', '1', '<p>就是想测试一下而已<img src=\"http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/3c/pcmoren_wu_org.png\" alt=\"[污]\" data-w-e=\"1\"></p>', null, '0', '0', '2018-09-06 03:00:26');
INSERT INTO `blog_comment` VALUES ('69', '27', '1', '<p>54235</p>', null, '0', '0', '2018-09-19 01:48:07');
INSERT INTO `blog_comment` VALUES ('70', '27', '1', '<p>435</p>', null, '0', '0', '2018-09-19 01:48:17');

-- ----------------------------
-- Table structure for blog_config
-- ----------------------------
DROP TABLE IF EXISTS `blog_config`;
CREATE TABLE `blog_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '变量名',
  `group` varchar(30) NOT NULL DEFAULT '' COMMENT '分组',
  `type` varchar(30) NOT NULL DEFAULT 'string' COMMENT '类型:string,text,int,bool,array,datetime,date,file',
  `value` text NOT NULL COMMENT '变量值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注信息',
  `sort` int(10) DEFAULT '0',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` bigint(20) DEFAULT '0' COMMENT '创建人',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `update_by` bigint(20) DEFAULT NULL COMMENT '更新人',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `group` (`group`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='博客配置';

-- ----------------------------
-- Records of blog_config
-- ----------------------------
INSERT INTO `blog_config` VALUES ('1', 'LoginDuration', 'blog', 'time', '3600', '博客登录有效时长', '0', '2018-07-17 17:27:27', '0', '2018-07-17 22:10:33', null);
INSERT INTO `blog_config` VALUES ('36', 'ScanFollow', 'blog', 'string', '/static/temp/blog/gg.jpg', '扫我关注', '0', '2018-08-29 12:58:10', '0', null, null);

-- ----------------------------
-- Table structure for blog_follow
-- ----------------------------
DROP TABLE IF EXISTS `blog_follow`;
CREATE TABLE `blog_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_pid` int(11) DEFAULT NULL COMMENT '被关注人',
  `member_id` int(11) DEFAULT NULL COMMENT '关注人',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态(0：已关注，1：取消关注）',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT '是否删除',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of blog_follow
-- ----------------------------

-- ----------------------------
-- Table structure for blog_login_record
-- ----------------------------
DROP TABLE IF EXISTS `blog_login_record`;
CREATE TABLE `blog_login_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT '1' COMMENT '登录类型（0：退出，1：登录）',
  `member_id` int(11) DEFAULT NULL COMMENT '会员ID',
  `ip` varchar(255) DEFAULT NULL COMMENT '登录IP地址',
  `country` varchar(50) DEFAULT NULL COMMENT '国家',
  `region` varchar(50) DEFAULT NULL COMMENT '省份',
  `city` varchar(50) DEFAULT NULL COMMENT '城市',
  `isp` varchar(50) DEFAULT NULL COMMENT '网络类型',
  `location` varchar(100) DEFAULT NULL COMMENT '地址',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注信息',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='博客会员登录记录';

-- ----------------------------
-- Records of blog_login_record
-- ----------------------------
INSERT INTO `blog_login_record` VALUES ('28', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-03 16:10:25');
INSERT INTO `blog_login_record` VALUES ('68', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-03 17:15:42');
INSERT INTO `blog_login_record` VALUES ('69', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-03 17:17:32');
INSERT INTO `blog_login_record` VALUES ('70', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-03 17:17:42');
INSERT INTO `blog_login_record` VALUES ('71', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-03 17:18:37');
INSERT INTO `blog_login_record` VALUES ('72', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-03 17:18:46');
INSERT INTO `blog_login_record` VALUES ('73', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-03 17:19:42');
INSERT INTO `blog_login_record` VALUES ('74', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-03 17:20:02');
INSERT INTO `blog_login_record` VALUES ('75', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-03 17:32:01');
INSERT INTO `blog_login_record` VALUES ('78', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-03 17:51:57');
INSERT INTO `blog_login_record` VALUES ('79', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-04 10:22:25');
INSERT INTO `blog_login_record` VALUES ('80', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-04 10:22:49');
INSERT INTO `blog_login_record` VALUES ('81', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-04 10:37:33');
INSERT INTO `blog_login_record` VALUES ('82', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-04 12:25:43');
INSERT INTO `blog_login_record` VALUES ('83', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-04 14:39:35');
INSERT INTO `blog_login_record` VALUES ('84', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-04 16:07:51');
INSERT INTO `blog_login_record` VALUES ('85', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-04 16:08:00');
INSERT INTO `blog_login_record` VALUES ('86', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-04 17:49:20');
INSERT INTO `blog_login_record` VALUES ('87', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-04 18:47:15');
INSERT INTO `blog_login_record` VALUES ('88', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-04 18:51:27');
INSERT INTO `blog_login_record` VALUES ('89', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-04 18:51:32');
INSERT INTO `blog_login_record` VALUES ('90', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-04 18:51:48');
INSERT INTO `blog_login_record` VALUES ('91', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-04 18:51:54');
INSERT INTO `blog_login_record` VALUES ('92', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-04 18:52:27');
INSERT INTO `blog_login_record` VALUES ('93', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-04 18:52:34');
INSERT INTO `blog_login_record` VALUES ('94', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-04 18:53:40');
INSERT INTO `blog_login_record` VALUES ('95', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-05 10:10:36');
INSERT INTO `blog_login_record` VALUES ('96', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 10:10:42');
INSERT INTO `blog_login_record` VALUES ('97', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 10:32:20');
INSERT INTO `blog_login_record` VALUES ('98', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 11:18:27');
INSERT INTO `blog_login_record` VALUES ('99', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 11:19:25');
INSERT INTO `blog_login_record` VALUES ('100', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 11:42:50');
INSERT INTO `blog_login_record` VALUES ('101', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 11:47:39');
INSERT INTO `blog_login_record` VALUES ('102', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 11:47:46');
INSERT INTO `blog_login_record` VALUES ('103', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 11:50:56');
INSERT INTO `blog_login_record` VALUES ('104', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 11:51:03');
INSERT INTO `blog_login_record` VALUES ('105', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 11:51:22');
INSERT INTO `blog_login_record` VALUES ('106', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 11:51:31');
INSERT INTO `blog_login_record` VALUES ('107', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 11:51:44');
INSERT INTO `blog_login_record` VALUES ('108', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 12:17:02');
INSERT INTO `blog_login_record` VALUES ('109', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 12:17:19');
INSERT INTO `blog_login_record` VALUES ('110', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 12:22:44');
INSERT INTO `blog_login_record` VALUES ('111', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 12:22:57');
INSERT INTO `blog_login_record` VALUES ('112', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 12:24:17');
INSERT INTO `blog_login_record` VALUES ('113', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 12:24:32');
INSERT INTO `blog_login_record` VALUES ('114', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 12:25:34');
INSERT INTO `blog_login_record` VALUES ('115', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 12:25:46');
INSERT INTO `blog_login_record` VALUES ('116', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 12:27:05');
INSERT INTO `blog_login_record` VALUES ('117', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 12:27:22');
INSERT INTO `blog_login_record` VALUES ('118', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 12:27:32');
INSERT INTO `blog_login_record` VALUES ('119', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 12:28:09');
INSERT INTO `blog_login_record` VALUES ('120', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 12:30:38');
INSERT INTO `blog_login_record` VALUES ('121', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 12:31:00');
INSERT INTO `blog_login_record` VALUES ('122', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 12:33:05');
INSERT INTO `blog_login_record` VALUES ('123', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 12:33:20');
INSERT INTO `blog_login_record` VALUES ('124', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 12:33:54');
INSERT INTO `blog_login_record` VALUES ('125', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 12:34:08');
INSERT INTO `blog_login_record` VALUES ('126', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 12:46:24');
INSERT INTO `blog_login_record` VALUES ('127', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 12:46:44');
INSERT INTO `blog_login_record` VALUES ('128', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 12:48:14');
INSERT INTO `blog_login_record` VALUES ('129', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 12:48:33');
INSERT INTO `blog_login_record` VALUES ('130', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 12:49:06');
INSERT INTO `blog_login_record` VALUES ('131', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-05 14:25:44');
INSERT INTO `blog_login_record` VALUES ('132', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 14:26:47');
INSERT INTO `blog_login_record` VALUES ('133', '1', '2', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 23:24:29');
INSERT INTO `blog_login_record` VALUES ('134', '0', '2', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-05 23:24:39');
INSERT INTO `blog_login_record` VALUES ('135', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-05 23:24:49');
INSERT INTO `blog_login_record` VALUES ('136', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-06 00:26:08');
INSERT INTO `blog_login_record` VALUES ('137', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 00:26:17');
INSERT INTO `blog_login_record` VALUES ('138', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 01:02:37');
INSERT INTO `blog_login_record` VALUES ('139', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 01:05:15');
INSERT INTO `blog_login_record` VALUES ('140', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 01:05:25');
INSERT INTO `blog_login_record` VALUES ('141', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 01:05:49');
INSERT INTO `blog_login_record` VALUES ('142', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 01:05:59');
INSERT INTO `blog_login_record` VALUES ('143', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:20:42');
INSERT INTO `blog_login_record` VALUES ('144', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:20:59');
INSERT INTO `blog_login_record` VALUES ('145', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:21:10');
INSERT INTO `blog_login_record` VALUES ('146', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:22:08');
INSERT INTO `blog_login_record` VALUES ('147', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:22:20');
INSERT INTO `blog_login_record` VALUES ('148', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:25:05');
INSERT INTO `blog_login_record` VALUES ('149', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:25:21');
INSERT INTO `blog_login_record` VALUES ('150', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:25:53');
INSERT INTO `blog_login_record` VALUES ('151', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:26:06');
INSERT INTO `blog_login_record` VALUES ('152', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:26:49');
INSERT INTO `blog_login_record` VALUES ('153', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:27:00');
INSERT INTO `blog_login_record` VALUES ('154', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:27:16');
INSERT INTO `blog_login_record` VALUES ('155', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:27:47');
INSERT INTO `blog_login_record` VALUES ('156', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:28:58');
INSERT INTO `blog_login_record` VALUES ('158', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:37:44');
INSERT INTO `blog_login_record` VALUES ('159', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:38:19');
INSERT INTO `blog_login_record` VALUES ('160', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:38:33');
INSERT INTO `blog_login_record` VALUES ('161', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:38:50');
INSERT INTO `blog_login_record` VALUES ('162', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:39:03');
INSERT INTO `blog_login_record` VALUES ('163', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:40:04');
INSERT INTO `blog_login_record` VALUES ('164', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:40:39');
INSERT INTO `blog_login_record` VALUES ('165', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:41:09');
INSERT INTO `blog_login_record` VALUES ('166', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:41:35');
INSERT INTO `blog_login_record` VALUES ('167', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:44:19');
INSERT INTO `blog_login_record` VALUES ('168', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:44:52');
INSERT INTO `blog_login_record` VALUES ('169', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:45:06');
INSERT INTO `blog_login_record` VALUES ('170', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:45:17');
INSERT INTO `blog_login_record` VALUES ('171', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:45:46');
INSERT INTO `blog_login_record` VALUES ('172', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:46:05');
INSERT INTO `blog_login_record` VALUES ('173', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-06 02:46:12');
INSERT INTO `blog_login_record` VALUES ('174', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-06 02:55:37');
INSERT INTO `blog_login_record` VALUES ('175', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-18 16:25:08');
INSERT INTO `blog_login_record` VALUES ('176', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-18 18:18:47');
INSERT INTO `blog_login_record` VALUES ('177', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-19 01:36:00');
INSERT INTO `blog_login_record` VALUES ('178', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-19 01:36:20');
INSERT INTO `blog_login_record` VALUES ('179', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-19 01:39:18');
INSERT INTO `blog_login_record` VALUES ('180', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-19 01:40:47');
INSERT INTO `blog_login_record` VALUES ('182', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-19 01:47:54');
INSERT INTO `blog_login_record` VALUES ('183', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-19 10:21:28');
INSERT INTO `blog_login_record` VALUES ('184', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-19 11:46:41');
INSERT INTO `blog_login_record` VALUES ('185', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-19 15:30:08');
INSERT INTO `blog_login_record` VALUES ('186', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-20 03:26:17');
INSERT INTO `blog_login_record` VALUES ('187', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-20 14:03:55');
INSERT INTO `blog_login_record` VALUES ('188', '1', '6', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-20 14:47:10');
INSERT INTO `blog_login_record` VALUES ('189', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出博客系统！', '2018-09-20 23:08:17');
INSERT INTO `blog_login_record` VALUES ('190', '0', '6', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-21 08:59:25');
INSERT INTO `blog_login_record` VALUES ('192', '1', '6', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-21 09:02:14');
INSERT INTO `blog_login_record` VALUES ('193', '0', '6', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-21 10:11:23');
INSERT INTO `blog_login_record` VALUES ('194', '1', '6', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-21 10:11:59');
INSERT INTO `blog_login_record` VALUES ('195', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-21 10:14:00');
INSERT INTO `blog_login_record` VALUES ('196', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出博客系统！', '2018-09-21 10:14:08');
INSERT INTO `blog_login_record` VALUES ('197', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-21 10:32:32');
INSERT INTO `blog_login_record` VALUES ('198', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-21 10:41:48');
INSERT INTO `blog_login_record` VALUES ('199', '1', '6', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-22 14:59:14');
INSERT INTO `blog_login_record` VALUES ('200', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-22 15:29:42');
INSERT INTO `blog_login_record` VALUES ('201', '1', '6', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-22 15:58:24');
INSERT INTO `blog_login_record` VALUES ('202', '1', '6', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-22 17:15:46');
INSERT INTO `blog_login_record` VALUES ('203', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-27 02:13:52');
INSERT INTO `blog_login_record` VALUES ('204', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账户登录】正在进入博客系统！', '2018-09-27 16:57:39');

-- ----------------------------
-- Table structure for blog_member
-- ----------------------------
DROP TABLE IF EXISTS `blog_member`;
CREATE TABLE `blog_member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) DEFAULT '' COMMENT '用户的标识，对当前网站唯一',
  `nickname` varchar(255) DEFAULT NULL COMMENT '别称',
  `username` varchar(20) DEFAULT NULL COMMENT '用户名',
  `password` varchar(40) DEFAULT NULL COMMENT '密码',
  `head_img` varchar(100) DEFAULT '/static/image/blog/face_default.jpg' COMMENT '用户头像',
  `phone` varchar(15) DEFAULT NULL COMMENT '手机号',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `job` varchar(20) DEFAULT NULL COMMENT '职位',
  `sex` tinyint(1) DEFAULT '0' COMMENT '性别（0：男，1：女）',
  `year` int(20) DEFAULT NULL COMMENT '出生年份',
  `sign` varchar(255) DEFAULT NULL COMMENT '个性签名',
  `province` varchar(100) DEFAULT '' COMMENT '所在省份',
  `city` varchar(100) DEFAULT '' COMMENT '所在城市',
  `location` varchar(255) DEFAULT NULL COMMENT '工作位置',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注信息',
  `source` tinyint(1) DEFAULT '0' COMMENT '注册来源',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT '是否有删除',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` int(10) DEFAULT '0' COMMENT '创建人',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `update_by` int(10) DEFAULT NULL COMMENT '更新人',
  PRIMARY KEY (`id`),
  KEY `index_blog_member_nickname` (`nickname`) USING BTREE,
  KEY `index_blog_member_username` (`username`) USING BTREE,
  KEY `index_blog_member_phone` (`phone`),
  KEY `index_blog_member_email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='博客用户表';

-- ----------------------------
-- Records of blog_member
-- ----------------------------
INSERT INTO `blog_member` VALUES ('1', '', '钟绍发', 'zhongshaofa', 'ed696eb5bba1f7460585cc6975e6cf9bf24903dd', '/static/image/blog/face3.jpg', null, 'chung@99php.cn', 'PHP程序员', '0', null, null, '', '', '广东 . 广州', null, '0', '0', '0', '2018-08-10 16:57:30', '0', null, null);
INSERT INTO `blog_member` VALUES ('2', '', null, 'ceshi', 'ed696eb5bba1f7460585cc6975e6cf9bf24903dd', '/static/image/blog/face_default.jpg', null, null, null, '0', null, null, '', '', null, null, '0', '0', '1', '2018-08-13 10:09:57', '0', null, null);
INSERT INTO `blog_member` VALUES ('3', '', '测试钟绍发', 'test', 'ed696eb5bba1f7460585cc6975e6cf9bf24903dd', '/static/image/blog/face_default.jpg', null, '2286732552@qq.com', null, '0', null, null, '', '', null, null, '0', '0', '1', '2018-08-13 12:52:53', '0', null, null);
INSERT INTO `blog_member` VALUES ('4', '', 'Mr.Chung', 'test_zhong', 'ed696eb5bba1f7460585cc6975e6cf9bf24903dd', '/static/image/blog/face_default.jpg', '15521045862', '2@qq.com', null, '0', null, null, '', '', null, '', '0', '1', '0', '2018-08-13 12:57:20', '0', null, null);
INSERT INTO `blog_member` VALUES ('5', '', 'chung', 'zhongsf', 'ed696eb5bba1f7460585cc6975e6cf9bf24903dd', '/static/image/blog/face_default.jpg', null, '22@qq.com', null, '0', null, null, '', '', null, null, '0', '0', '0', '2018-09-06 01:17:50', '0', null, null);
INSERT INTO `blog_member` VALUES ('6', '', '华仔', 'hsenap', 'ed696eb5bba1f7460585cc6975e6cf9bf24903dd', '/static/image/blog/face_default.jpg', '13256748446', '2587203630@qq.com', null, '0', null, null, '', '', null, null, '0', '0', '0', '2018-09-20 14:46:23', '0', null, null);

-- ----------------------------
-- Table structure for blog_member_follow
-- ----------------------------
DROP TABLE IF EXISTS `blog_member_follow`;
CREATE TABLE `blog_member_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL COMMENT '会员编号',
  `follow_num` int(11) DEFAULT '0' COMMENT '关注数量',
  `fans_num` int(11) DEFAULT '0' COMMENT '粉丝数量',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of blog_member_follow
-- ----------------------------
INSERT INTO `blog_member_follow` VALUES ('1', '1', '0', '0', '2018-09-03 10:27:44', null);
INSERT INTO `blog_member_follow` VALUES ('2', '2', '0', '0', '2018-09-05 23:24:35', null);
INSERT INTO `blog_member_follow` VALUES ('3', '6', '0', '0', '2018-09-20 14:47:19', null);

-- ----------------------------
-- Table structure for blog_msg_record
-- ----------------------------
DROP TABLE IF EXISTS `blog_msg_record`;
CREATE TABLE `blog_msg_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT '0' COMMENT '信息类型(0：验证码）',
  `send_type` tinyint(1) DEFAULT '1' COMMENT '联系方式类型（0：手机号，1：邮箱）',
  `send` varchar(30) DEFAULT NULL COMMENT '联系方式',
  `message` varchar(255) NOT NULL COMMENT '信息内容',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `index_blog_msg_record_send` (`send`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='短信发送记录表';

-- ----------------------------
-- Records of blog_msg_record
-- ----------------------------
INSERT INTO `blog_msg_record` VALUES ('1', '0', '1', '2286732552@qq.com', '您的短信验证码是456159，5分钟内有效', null, '2018-08-15 10:56:13');
INSERT INTO `blog_msg_record` VALUES ('2', '0', '0', '15521045862', '您正在申请手机注册，验证码为：748797，5分钟内有效！', null, '2018-09-04 17:35:30');
INSERT INTO `blog_msg_record` VALUES ('3', '0', '2', 'chung@99php.cn', '您正在申请手机注册，验证码为：475869，5分钟内有效！', null, '2018-09-04 17:54:33');
INSERT INTO `blog_msg_record` VALUES ('4', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：912796，5分钟内有效！', null, '2018-09-04 17:56:17');
INSERT INTO `blog_msg_record` VALUES ('5', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：192422，5分钟内有效！', null, '2018-09-04 18:22:14');
INSERT INTO `blog_msg_record` VALUES ('6', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：800131，5分钟内有效！', null, '2018-09-04 18:22:20');
INSERT INTO `blog_msg_record` VALUES ('7', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：389874，5分钟内有效！', null, '2018-09-04 18:23:53');
INSERT INTO `blog_msg_record` VALUES ('8', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：661648，5分钟内有效！', null, '2018-09-04 18:23:59');
INSERT INTO `blog_msg_record` VALUES ('9', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：461587，5分钟内有效！', null, '2018-09-04 18:25:34');
INSERT INTO `blog_msg_record` VALUES ('10', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：748620，5分钟内有效！', null, '2018-09-05 23:41:17');
INSERT INTO `blog_msg_record` VALUES ('11', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：471766，5分钟内有效！', null, '2018-09-05 23:42:33');
INSERT INTO `blog_msg_record` VALUES ('12', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：219664，5分钟内有效！', null, '2018-09-05 23:55:27');
INSERT INTO `blog_msg_record` VALUES ('13', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：890745，5分钟内有效！', null, '2018-09-05 23:56:29');
INSERT INTO `blog_msg_record` VALUES ('14', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：536973，5分钟内有效！', null, '2018-09-06 00:20:12');
INSERT INTO `blog_msg_record` VALUES ('15', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：996105，5分钟内有效！', null, '2018-09-06 00:30:09');
INSERT INTO `blog_msg_record` VALUES ('16', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：925175，5分钟内有效！', null, '2018-09-06 00:31:14');
INSERT INTO `blog_msg_record` VALUES ('17', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：664020，5分钟内有效！', null, '2018-09-06 00:36:51');
INSERT INTO `blog_msg_record` VALUES ('18', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：665150，5分钟内有效！', null, '2018-09-06 00:51:08');
INSERT INTO `blog_msg_record` VALUES ('19', '0', '1', 'chung@99php.cn', '您正在申请手机注册，验证码为：668794，5分钟内有效！', null, '2018-09-06 02:42:50');

-- ----------------------------
-- Table structure for blog_notice
-- ----------------------------
DROP TABLE IF EXISTS `blog_notice`;
CREATE TABLE `blog_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `content` varchar(255) DEFAULT NULL COMMENT '内容',
  `href` varchar(100) DEFAULT NULL COMMENT '链接',
  `target` varchar(10) DEFAULT '_blank' COMMENT '弹出方式',
  `sort` int(10) DEFAULT '0' COMMENT '排序',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` int(10) DEFAULT '0' COMMENT '创建人',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `update_by` int(10) DEFAULT NULL COMMENT '更新人',
  PRIMARY KEY (`id`),
  KEY `index_blog_notice_title` (`title`) USING BTREE,
  KEY `idex_blog_notice_sort` (`sort`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='博客公告表';

-- ----------------------------
-- Records of blog_notice
-- ----------------------------
INSERT INTO `blog_notice` VALUES ('1', '本站内容仅供学习和参阅，不做任何商业用途！', null, null, '_blank', '0', null, '0', '2018-08-10 21:25:23', '0', null, null);
INSERT INTO `blog_notice` VALUES ('2', ' 久久PHP博客测试版上线，欢迎访问！', null, null, '_blank', '0', null, '0', '2018-08-10 21:25:44', '0', null, null);
INSERT INTO `blog_notice` VALUES ('3', ' \r\nLao博客测试版上线，欢迎访问\r\n内容如有侵犯，请立即联系管理员删除！', null, null, '_blank', '0', null, '0', '2018-08-10 21:26:31', '0', null, null);

-- ----------------------------
-- Table structure for blog_search
-- ----------------------------
DROP TABLE IF EXISTS `blog_search`;
CREATE TABLE `blog_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(255) DEFAULT NULL COMMENT '搜索关键词',
  `total` int(11) DEFAULT '0' COMMENT '搜索总次数',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='搜索统计表';

-- ----------------------------
-- Records of blog_search
-- ----------------------------
INSERT INTO `blog_search` VALUES ('14', 'git', '2', '2018-08-30 13:36:53', '2018-08-30 13:29:53');
INSERT INTO `blog_search` VALUES ('15', 'php', '5', '2018-08-30 13:43:33', '2018-08-30 13:38:35');
INSERT INTO `blog_search` VALUES ('16', 'css', '2', '2018-08-30 13:37:40', '2018-08-30 13:39:11');
INSERT INTO `blog_search` VALUES ('17', 'mysql', '1', null, '2018-08-30 13:39:20');
INSERT INTO `blog_search` VALUES ('18', '索引', '1', null, '2018-08-30 13:39:27');
INSERT INTO `blog_search` VALUES ('19', '索引用法', '2', '2018-08-30 13:43:11', '2018-08-30 13:39:35');
INSERT INTO `blog_search` VALUES ('20', 'sdsd', '1', null, '2018-09-21 00:01:07');

-- ----------------------------
-- Table structure for blog_search_record
-- ----------------------------
DROP TABLE IF EXISTS `blog_search_record`;
CREATE TABLE `blog_search_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT '0' COMMENT '搜索类型（0：未知，1：标题，2：标签）',
  `word` varchar(255) DEFAULT NULL COMMENT '搜索关键词',
  `member_id` int(11) DEFAULT '0' COMMENT '登录会员编号（0：游客）',
  `ip` varchar(255) DEFAULT '' COMMENT 'ip地址',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注信息',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='搜索记录表';

-- ----------------------------
-- Records of blog_search_record
-- ----------------------------
INSERT INTO `blog_search_record` VALUES ('3', '1', 'php', '0', '127.0.0.1', null, '2018-08-30 12:55:44');
INSERT INTO `blog_search_record` VALUES ('4', '2', 'php', '1', '127.0.0.1', null, '2018-08-30 12:56:42');
INSERT INTO `blog_search_record` VALUES ('5', '2', 'php', '0', '127.0.0.1', '正在搜索标签！', '2018-08-30 12:59:08');
INSERT INTO `blog_search_record` VALUES ('6', '2', 'php', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 12:59:43');
INSERT INTO `blog_search_record` VALUES ('7', '2', 'mysql', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:00:05');
INSERT INTO `blog_search_record` VALUES ('8', '2', 'redis', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:01:04');
INSERT INTO `blog_search_record` VALUES ('9', '1', 'redis', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:01:10');
INSERT INTO `blog_search_record` VALUES ('10', '1', 'css', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:01:36');
INSERT INTO `blog_search_record` VALUES ('11', '1', 'php', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:01:40');
INSERT INTO `blog_search_record` VALUES ('12', '1', 'html', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:01:43');
INSERT INTO `blog_search_record` VALUES ('13', '1', 'git', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:01:47');
INSERT INTO `blog_search_record` VALUES ('14', '1', 'git', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:29:54');
INSERT INTO `blog_search_record` VALUES ('15', '1', 'git', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:38:27');
INSERT INTO `blog_search_record` VALUES ('16', '1', 'php', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:38:35');
INSERT INTO `blog_search_record` VALUES ('17', '1', 'php', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:39:04');
INSERT INTO `blog_search_record` VALUES ('18', '1', 'css', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:39:11');
INSERT INTO `blog_search_record` VALUES ('19', '2', 'css', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:39:13');
INSERT INTO `blog_search_record` VALUES ('20', '2', 'mysql', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:39:20');
INSERT INTO `blog_search_record` VALUES ('21', '2', '索引', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:39:27');
INSERT INTO `blog_search_record` VALUES ('22', '2', '索引用法', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:39:36');
INSERT INTO `blog_search_record` VALUES ('23', '2', '索引用法', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:44:45');
INSERT INTO `blog_search_record` VALUES ('24', '2', 'php', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:44:58');
INSERT INTO `blog_search_record` VALUES ('25', '2', 'php', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:45:01');
INSERT INTO `blog_search_record` VALUES ('26', '1', 'php', '0', '127.0.0.1', '正在搜索文章！', '2018-08-30 13:45:07');
INSERT INTO `blog_search_record` VALUES ('27', '0', 'sdsd', '0', '127.0.0.1', '正在搜索文章！', '2018-09-21 00:01:07');

-- ----------------------------
-- Table structure for blog_slider
-- ----------------------------
DROP TABLE IF EXISTS `blog_slider`;
CREATE TABLE `blog_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL COMMENT '标题',
  `image` varchar(100) NOT NULL COMMENT '轮播图片',
  `href` varchar(100) DEFAULT NULL COMMENT '轮播图片链接',
  `target` varchar(10) DEFAULT '_blank' COMMENT '弹出方式',
  `sort` int(10) DEFAULT '0' COMMENT '排序',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` int(10) DEFAULT '0' COMMENT '创建人',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `update_by` int(10) DEFAULT NULL COMMENT '更新人',
  PRIMARY KEY (`id`),
  KEY `index_blog_slider_title` (`title`) USING BTREE,
  KEY `index_blog_slider_sort` (`sort`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='博客轮播图';

-- ----------------------------
-- Records of blog_slider
-- ----------------------------
INSERT INTO `blog_slider` VALUES ('1', '轮播图1', '/static/image/blog/temp/banner1.jpg', 'https://www.baidu.com', '_blank', null, null, '0', '2018-08-10 16:17:20', null, null, null);
INSERT INTO `blog_slider` VALUES ('2', '轮播图2', '/static/image/blog/temp/banner8.png', 'https://www.99php.cn', '_blank', null, null, '0', '2018-08-10 16:17:42', null, null, null);
INSERT INTO `blog_slider` VALUES ('3', '轮播图3', '/static/image/blog/temp/banner1.jpg', null, '_blank', '0', null, '0', '2018-08-10 16:53:18', '0', null, null);

-- ----------------------------
-- Table structure for blog_tag
-- ----------------------------
DROP TABLE IF EXISTS `blog_tag`;
CREATE TABLE `blog_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_title` varchar(20) NOT NULL COMMENT '标签标题',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` int(10) DEFAULT '0' COMMENT '创建人',
  PRIMARY KEY (`id`),
  KEY `index_blog_tag_title` (`tag_title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='博客标签表';

-- ----------------------------
-- Records of blog_tag
-- ----------------------------
INSERT INTO `blog_tag` VALUES ('1', '个人博客', null, '0', '2018-08-11 02:52:18', '0');
INSERT INTO `blog_tag` VALUES ('2', '阿里云', null, '0', '2018-08-11 02:52:31', '0');
INSERT INTO `blog_tag` VALUES ('3', '空间', null, '0', '2018-08-11 02:52:36', '0');
INSERT INTO `blog_tag` VALUES ('4', 'PHP', null, '0', '2018-08-11 03:09:16', '0');
INSERT INTO `blog_tag` VALUES ('13', '金牌', null, '0', '2018-08-27 18:32:47', '0');
INSERT INTO `blog_tag` VALUES ('15', 'Compare4', null, '0', '2018-09-03 15:23:04', '0');
INSERT INTO `blog_tag` VALUES ('16', '七牛云', null, '0', '2018-09-20 03:27:23', '0');
INSERT INTO `blog_tag` VALUES ('17', '图片上传', null, '0', '2018-09-20 03:27:23', '0');

-- ----------------------------
-- Table structure for blog_website_link
-- ----------------------------
DROP TABLE IF EXISTS `blog_website_link`;
CREATE TABLE `blog_website_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website_name` varchar(255) DEFAULT NULL COMMENT '站点名称',
  `website_logo` varchar(500) DEFAULT NULL COMMENT '网站LOGO',
  `href` varchar(500) DEFAULT '#' COMMENT '链接地址',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `sort` int(255) DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='站点友链';

-- ----------------------------
-- Records of blog_website_link
-- ----------------------------
INSERT INTO `blog_website_link` VALUES ('1', '百度一下', null, 'https://www.baidu.com', null, null, '0', '2018-08-29 12:30:32');
INSERT INTO `blog_website_link` VALUES ('2', 'hao123', null, 'https://www.hao123.com', null, null, '0', '2018-08-29 12:31:44');

-- ----------------------------
-- Table structure for download_config
-- ----------------------------
DROP TABLE IF EXISTS `download_config`;
CREATE TABLE `download_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='下载信息配置表';

-- ----------------------------
-- Records of download_config
-- ----------------------------
INSERT INTO `download_config` VALUES ('1', 'DownloadUrl', 'https://static.99php.cn/99Admin_V1.0.3.zip', '下载地址', '2018-08-04 19:32:17', '0');
INSERT INTO `download_config` VALUES ('2', 'GitHub', 'https://github.com/zhongshaofa/99Admin', 'GitHub地址', '2018-08-04 19:33:48', '0');
INSERT INTO `download_config` VALUES ('3', 'Gitee', 'https://gitee.com/zhongshaofa/99Admin', '码云地址', '2018-08-04 19:34:40', '0');
INSERT INTO `download_config` VALUES ('4', 'QQUrl', 'https://jq.qq.com/?_wv=1027&k=5IHJawE', 'QQ群链接', '2018-08-04 19:35:04', '0');
INSERT INTO `download_config` VALUES ('5', 'Version', 'V1.0.3', '版本信息', '2018-08-04 19:36:41', '0');
INSERT INTO `download_config` VALUES ('6', 'WelcomeWord', '99Admin权限控制系统', '欢迎词', '2018-08-04 20:04:01', '0');
INSERT INTO `download_config` VALUES ('7', 'Introduce', '关键词：ThinkPHP5.1、layui、layuicms。', null, '2018-08-04 20:13:17', '0');
INSERT INTO `download_config` VALUES ('8', 'Describe1', '此项目旨在学习后台权限控制的实现，项目更适合初学者来进行学习。项目还是并不是特别完善，只实现基本的权限控制！', null, '2018-08-04 20:36:32', '0');
INSERT INTO `download_config` VALUES ('9', 'Describe2', '项目还在持续完善中，尽请期待！项目中有使用或者借鉴优秀开源代码，感谢ThinkPHP团队、Layui团队、Layuicms作者、thinkadmin作者、layui-xtree作者！', null, '2018-08-04 20:36:36', '0');

-- ----------------------------
-- Table structure for download_record
-- ----------------------------
DROP TABLE IF EXISTS `download_record`;
CREATE TABLE `download_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL COMMENT 'ip地址',
  `country` varchar(50) DEFAULT NULL COMMENT '国家',
  `region` varchar(50) DEFAULT NULL COMMENT '省份',
  `city` varchar(50) DEFAULT NULL COMMENT '城市',
  `isp` varchar(50) DEFAULT NULL COMMENT '网络服务商',
  `location` varchar(100) DEFAULT NULL COMMENT '地理位置',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='下载记录表';

-- ----------------------------
-- Records of download_record
-- ----------------------------
INSERT INTO `download_record` VALUES ('1', '::1', null, null, null, null, null, '下载程序', '2018-08-04 19:55:48');
INSERT INTO `download_record` VALUES ('2', '::1', null, null, null, null, null, '下载程序', '2018-08-04 19:56:03');
INSERT INTO `download_record` VALUES ('3', '::1', null, null, null, null, null, '下载程序', '2018-08-04 20:38:14');
INSERT INTO `download_record` VALUES ('4', '113.66.245.61', null, null, null, null, null, '下载程序', '2018-08-04 20:49:51');
INSERT INTO `download_record` VALUES ('5', '::1', null, null, null, null, null, '下载程序', '2018-08-06 10:29:30');
INSERT INTO `download_record` VALUES ('6', '61.140.234.134', null, null, null, null, null, '下载程序', '2018-08-06 10:40:16');
INSERT INTO `download_record` VALUES ('7', '61.140.234.134', null, null, null, null, null, '下载程序', '2018-08-06 10:43:53');
INSERT INTO `download_record` VALUES ('8', '112.96.66.30', '中国', '广东', '佛山', '联通', '中国广东佛山联通', '下载程序', '2018-08-06 11:35:04');
INSERT INTO `download_record` VALUES ('9', '61.140.234.134', '中国', '广东', '广州', '电信', '中国广东广州电信', '下载程序', '2018-08-06 14:23:08');
INSERT INTO `download_record` VALUES ('10', '60.208.127.50', '中国', '山东', '济南', '联通', '中国山东济南联通', '下载程序', '2018-08-06 17:46:56');
INSERT INTO `download_record` VALUES ('11', '60.27.30.7', '中国', '天津', '天津', '联通', '中国天津天津联通', '下载程序', '2018-08-06 17:47:08');
INSERT INTO `download_record` VALUES ('12', '113.74.6.129', '中国', '广东', '珠海', '电信', '中国广东珠海电信', '下载程序', '2018-08-06 17:47:59');
INSERT INTO `download_record` VALUES ('13', '58.62.205.97', '中国', '广东', '广州', '电信', '中国广东广州电信', '下载程序', '2018-08-06 17:48:17');
INSERT INTO `download_record` VALUES ('14', '117.136.67.187', '中国', '江苏', '苏州', '移动', '中国江苏苏州移动', '下载程序', '2018-08-06 17:49:13');
INSERT INTO `download_record` VALUES ('15', '113.250.230.31', '中国', '重庆', '重庆', '电信', '中国重庆重庆电信', '下载程序', '2018-08-06 17:50:00');
INSERT INTO `download_record` VALUES ('16', '106.8.90.25', '中国', '河北', '廊坊', '电信', '中国河北廊坊电信', '下载程序', '2018-08-06 17:50:02');
INSERT INTO `download_record` VALUES ('17', '36.157.209.99', '中国', '湖南', '长沙', '移动', '中国湖南长沙移动', '下载程序', '2018-08-06 17:50:35');
INSERT INTO `download_record` VALUES ('18', '59.41.245.169', '中国', '广东', '广州', '电信', '中国广东广州电信', '下载程序', '2018-08-06 17:52:21');
INSERT INTO `download_record` VALUES ('19', '58.45.213.147', '中国', '湖南', '湘潭', '电信', '中国湖南湘潭电信', '下载程序', '2018-08-06 17:52:40');
INSERT INTO `download_record` VALUES ('20', '222.209.9.47', '中国', '四川', '成都', '电信', '中国四川成都电信', '下载程序', '2018-08-06 17:52:51');
INSERT INTO `download_record` VALUES ('21', '110.87.0.78', '中国', '福建', '厦门', '电信', '中国福建厦门电信', '下载程序', '2018-08-06 17:53:16');
INSERT INTO `download_record` VALUES ('22', '118.114.166.13', '中国', '四川', '成都', '电信', '中国四川成都电信', '下载程序', '2018-08-06 17:54:12');
INSERT INTO `download_record` VALUES ('23', '121.28.95.29', '中国', '河北', '石家庄', '联通', '中国河北石家庄联通', '下载程序', '2018-08-06 17:57:30');
INSERT INTO `download_record` VALUES ('24', '113.80.99.89', '中国', '广东', '东莞', '电信', '中国广东东莞电信', '下载程序', '2018-08-06 18:15:44');
INSERT INTO `download_record` VALUES ('25', '27.157.196.113', '中国', '福建', '南平', '电信', '中国福建南平电信', '下载程序', '2018-08-06 18:23:10');
INSERT INTO `download_record` VALUES ('26', '123.53.188.186', '中国', '河南', '洛阳', '电信', '中国河南洛阳电信', '下载程序', '2018-08-06 18:41:09');
INSERT INTO `download_record` VALUES ('27', '113.66.246.121', '中国', '广东', '广州', '电信', '中国广东广州电信', '下载程序', '2018-08-06 20:07:36');
INSERT INTO `download_record` VALUES ('28', '163.177.90.152', '中国', '广东', '深圳', '联通', '中国广东深圳联通', '下载程序', '2018-08-06 22:55:46');
INSERT INTO `download_record` VALUES ('29', '118.116.14.175', '中国', '四川', '成都', '电信', '中国四川成都电信', '下载程序', '2018-08-07 10:36:29');
INSERT INTO `download_record` VALUES ('30', '1.86.242.106', '中国', '陕西', '西安', '电信', '中国陕西西安电信', '下载程序', '2018-08-07 13:48:18');
INSERT INTO `download_record` VALUES ('31', '119.130.215.254', '中国', '广东', '广州', '电信', '中国广东广州电信', '下载程序', '2018-08-09 15:55:04');

-- ----------------------------
-- Table structure for email_template
-- ----------------------------
DROP TABLE IF EXISTS `email_template`;
CREATE TABLE `email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT '0' COMMENT '类型 (1：注册，2：找回密码）',
  `name` varchar(255) DEFAULT NULL COMMENT '模板名称',
  `value` varchar(255) DEFAULT NULL COMMENT '模板内容',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='短信模板';

-- ----------------------------
-- Records of email_template
-- ----------------------------
INSERT INTO `email_template` VALUES ('2', '1', '注册验证码', '您正在申请手机注册，验证码为：${code}，5分钟内有效！', null, '2018-09-04 17:39:28');

-- ----------------------------
-- Table structure for sms_template
-- ----------------------------
DROP TABLE IF EXISTS `sms_template`;
CREATE TABLE `sms_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT '0' COMMENT '类型 (1：注册，2：找回密码）',
  `name` varchar(255) DEFAULT NULL COMMENT '模板名称',
  `value` varchar(255) DEFAULT NULL COMMENT '模板内容',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='短信模板';

-- ----------------------------
-- Records of sms_template
-- ----------------------------
INSERT INTO `sms_template` VALUES ('1', '1', 'SMS_134075338', '您正在申请手机注册，验证码为：${code}，5分钟内有效！', null, '2018-09-01 00:18:10');
INSERT INTO `sms_template` VALUES ('2', '2', null, '您正在申请手机注册，验证码为：${code}，5分钟内有效！', null, '2018-09-04 17:39:28');

-- ----------------------------
-- Table structure for system_auth
-- ----------------------------
DROP TABLE IF EXISTS `system_auth`;
CREATE TABLE `system_auth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '权限名称',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1:禁用,2:启用)',
  `sort` smallint(6) unsigned DEFAULT '0' COMMENT '排序权重',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `create_by` bigint(11) unsigned DEFAULT '0' COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_system_auth_title` (`title`) USING BTREE,
  KEY `index_system_auth_status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统权限表';

-- ----------------------------
-- Records of system_auth
-- ----------------------------
INSERT INTO `system_auth` VALUES ('1', '管理员', '1', '3', '测试管理员', '0', '2018-03-17 15:59:46', '2018-08-07 10:26:57', null);
INSERT INTO `system_auth` VALUES ('4', '超级管理员', '0', '1', '不受权限控制', '0', '2018-01-23 13:28:14', null, null);
INSERT INTO `system_auth` VALUES ('6', '测试权限', '1', '0', '4242543', '0', '2018-09-22 18:15:31', null, null);

-- ----------------------------
-- Table structure for system_auth_node
-- ----------------------------
DROP TABLE IF EXISTS `system_auth_node`;
CREATE TABLE `system_auth_node` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth` bigint(20) unsigned DEFAULT NULL COMMENT '角色ID',
  `node` varchar(200) DEFAULT NULL COMMENT '节点路径',
  PRIMARY KEY (`id`),
  KEY `index_system_auth_auth` (`auth`) USING BTREE,
  KEY `index_system_auth_node` (`node`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='角色与节点关系表';

-- ----------------------------
-- Records of system_auth_node
-- ----------------------------
INSERT INTO `system_auth_node` VALUES ('202', '4', '1042');
INSERT INTO `system_auth_node` VALUES ('203', '4', '1046');
INSERT INTO `system_auth_node` VALUES ('204', '4', '1044');
INSERT INTO `system_auth_node` VALUES ('205', '4', '1043');
INSERT INTO `system_auth_node` VALUES ('206', '4', '1041');
INSERT INTO `system_auth_node` VALUES ('207', '4', '1045');
INSERT INTO `system_auth_node` VALUES ('208', '4', '1048');
INSERT INTO `system_auth_node` VALUES ('209', '4', '1054');
INSERT INTO `system_auth_node` VALUES ('210', '4', '1056');
INSERT INTO `system_auth_node` VALUES ('211', '4', '1055');
INSERT INTO `system_auth_node` VALUES ('212', '4', '1053');
INSERT INTO `system_auth_node` VALUES ('213', '4', '1057');
INSERT INTO `system_auth_node` VALUES ('214', '4', '1059');
INSERT INTO `system_auth_node` VALUES ('215', '4', '1063');
INSERT INTO `system_auth_node` VALUES ('216', '4', '1109');
INSERT INTO `system_auth_node` VALUES ('217', '4', '1065');
INSERT INTO `system_auth_node` VALUES ('218', '4', '1066');
INSERT INTO `system_auth_node` VALUES ('219', '4', '1071');
INSERT INTO `system_auth_node` VALUES ('220', '4', '1073');
INSERT INTO `system_auth_node` VALUES ('221', '4', '1072');
INSERT INTO `system_auth_node` VALUES ('222', '4', '1074');
INSERT INTO `system_auth_node` VALUES ('223', '4', '1070');
INSERT INTO `system_auth_node` VALUES ('224', '4', '1075');
INSERT INTO `system_auth_node` VALUES ('225', '4', '1114');
INSERT INTO `system_auth_node` VALUES ('283', '1', '1042');
INSERT INTO `system_auth_node` VALUES ('284', '1', '1046');
INSERT INTO `system_auth_node` VALUES ('285', '1', '1043');
INSERT INTO `system_auth_node` VALUES ('286', '1', '1041');
INSERT INTO `system_auth_node` VALUES ('287', '1', '1045');
INSERT INTO `system_auth_node` VALUES ('288', '1', '1054');
INSERT INTO `system_auth_node` VALUES ('289', '1', '1056');
INSERT INTO `system_auth_node` VALUES ('290', '1', '1055');
INSERT INTO `system_auth_node` VALUES ('291', '1', '1053');
INSERT INTO `system_auth_node` VALUES ('292', '1', '1057');
INSERT INTO `system_auth_node` VALUES ('293', '1', '1059');
INSERT INTO `system_auth_node` VALUES ('294', '1', '1063');
INSERT INTO `system_auth_node` VALUES ('295', '1', '1109');
INSERT INTO `system_auth_node` VALUES ('296', '1', '1065');
INSERT INTO `system_auth_node` VALUES ('297', '1', '1066');
INSERT INTO `system_auth_node` VALUES ('298', '1', '1071');
INSERT INTO `system_auth_node` VALUES ('299', '1', '1073');
INSERT INTO `system_auth_node` VALUES ('300', '1', '1072');
INSERT INTO `system_auth_node` VALUES ('301', '1', '1074');
INSERT INTO `system_auth_node` VALUES ('302', '1', '1070');
INSERT INTO `system_auth_node` VALUES ('303', '1', '1075');
INSERT INTO `system_auth_node` VALUES ('304', '1', '1114');
INSERT INTO `system_auth_node` VALUES ('305', '1', '1209');
INSERT INTO `system_auth_node` VALUES ('306', '1', '1211');
INSERT INTO `system_auth_node` VALUES ('307', '1', '1212');
INSERT INTO `system_auth_node` VALUES ('308', '1', '1204');
INSERT INTO `system_auth_node` VALUES ('309', '1', '1205');
INSERT INTO `system_auth_node` VALUES ('310', '1', '1213');
INSERT INTO `system_auth_node` VALUES ('311', '1', '1214');
INSERT INTO `system_auth_node` VALUES ('312', '1', '1208');
INSERT INTO `system_auth_node` VALUES ('313', '1', '1207');
INSERT INTO `system_auth_node` VALUES ('314', '1', '1206');
INSERT INTO `system_auth_node` VALUES ('315', '1', '1210');
INSERT INTO `system_auth_node` VALUES ('316', '6', '1048');
INSERT INTO `system_auth_node` VALUES ('317', '6', '1134');
INSERT INTO `system_auth_node` VALUES ('318', '6', '1136');
INSERT INTO `system_auth_node` VALUES ('319', '6', '1135');
INSERT INTO `system_auth_node` VALUES ('320', '6', '1133');
INSERT INTO `system_auth_node` VALUES ('321', '6', '1137');
INSERT INTO `system_auth_node` VALUES ('322', '6', '1264');
INSERT INTO `system_auth_node` VALUES ('323', '6', '1266');
INSERT INTO `system_auth_node` VALUES ('324', '6', '1267');

-- ----------------------------
-- Table structure for system_config
-- ----------------------------
DROP TABLE IF EXISTS `system_config`;
CREATE TABLE `system_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '变量名',
  `group` varchar(30) NOT NULL DEFAULT '' COMMENT '分组',
  `type` varchar(30) NOT NULL DEFAULT '' COMMENT '类型:string,text,int,bool,array,datetime,date,file',
  `value` text NOT NULL COMMENT '变量值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注信息',
  `sort` int(10) DEFAULT '0',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` bigint(20) DEFAULT '0' COMMENT '创建人',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `update_by` bigint(20) DEFAULT NULL COMMENT '更新人',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统配置';

-- ----------------------------
-- Records of system_config
-- ----------------------------
INSERT INTO `system_config` VALUES ('1', 'ManageName', 'basic', 'string', '久久PHP管理系统', '后台名称', '0', '2018-07-17 17:27:27', '0', '2018-07-17 22:10:33', null);
INSERT INTO `system_config` VALUES ('2', 'Beian', 'basic', 'string', '粤ICP备18074801号-1', '备案号', '4', '2018-07-17 17:27:27', '0', '2018-07-17 22:10:39', null);
INSERT INTO `system_config` VALUES ('18', 'FooterName', 'basic', 'string', 'Copyright © 2018-2019 九九PHP社区', '底部网站标识', '5', '2018-07-17 17:27:27', '0', '2018-07-17 18:40:16', null);
INSERT INTO `system_config` VALUES ('19', 'BeianUrl', 'basic', 'string', 'http://www.miitbeian.gov.cn', '备案查询链接', '2', '2018-07-17 17:30:39', '0', '2018-07-17 17:31:22', null);
INSERT INTO `system_config` VALUES ('20', 'HomeUrl', 'basic', 'string', 'https://www.99php.cn', '网站首页', '0', '2018-07-17 18:45:59', '0', '2018-07-17 18:46:12', null);
INSERT INTO `system_config` VALUES ('21', 'VercodeType', 'basic', 'tinyint', '0', '验证码登录开关（0：不开启，1：开启）', '3', '2018-07-17 21:52:00', '0', '2018-07-18 02:38:10', null);
INSERT INTO `system_config` VALUES ('32', 'Describe', 'basic', 'string', 'RBAC后台权限控制系统', '网站描述', '9', '2018-07-30 23:01:34', '0', null, null);
INSERT INTO `system_config` VALUES ('33', 'Author', 'basic', 'string', 'Mr.Chung', '作者', '15', '2018-07-30 23:02:41', '0', null, null);
INSERT INTO `system_config` VALUES ('34', 'Email', 'basic', 'string', 'chung@99php.cn', '联系邮箱', '8', '2018-07-30 23:03:15', '0', null, null);
INSERT INTO `system_config` VALUES ('35', 'BlogFooterName', 'basic', 'string', 'Copyright © 2018-2019 九九PHP社区1', '博客底部', '0', '2018-08-13 00:32:50', '0', null, null);
INSERT INTO `system_config` VALUES ('36', 'MailHost', 'mail', 'string', 'smtp.163.com', '发送方的SMTP服务器地址', '0', '2018-08-31 15:39:04', '0', null, null);
INSERT INTO `system_config` VALUES ('37', 'MailUsername', 'mail', 'string', 'www99php@163.com', '发送方的QQ邮箱用户名', '0', '2018-08-31 15:39:43', '0', null, null);
INSERT INTO `system_config` VALUES ('38', 'MailPassword', 'mail', 'string', 'a28cd1bedd7473f4', '第三方授权登录码', '0', '2018-08-31 15:39:53', '0', null, null);
INSERT INTO `system_config` VALUES ('39', 'MailNickname', 'mail', 'string', '久久PHP社区', '设置发件人昵称', '0', '2018-08-31 15:40:44', '0', null, null);
INSERT INTO `system_config` VALUES ('40', 'MailReplyTo', 'mail', 'string', 'www99php@163.com', '回复邮件地址', '0', '2018-08-31 15:41:03', '0', null, null);
INSERT INTO `system_config` VALUES ('41', 'AccessKeyId', 'sms', 'string', 'LTAI9tTEE7iW0z0V', '阿里大于公钥', '0', '2018-08-31 23:58:34', '0', null, null);
INSERT INTO `system_config` VALUES ('42', 'AccessKeySecret', 'sms', 'string', 'sZvnrxZquGcBQhPk5zdavLQCGAkosB', '阿里大鱼私钥', '0', '2018-08-31 23:58:45', '0', null, null);
INSERT INTO `system_config` VALUES ('43', 'SignName', 'sms', 'string', '久久PHP', '短信注册模板', '0', '2018-09-01 00:08:55', '0', null, null);
INSERT INTO `system_config` VALUES ('44', 'CodeTime', 'code', 'int', '60', '验证码发送间隔时间', '0', '2018-09-04 18:03:52', '0', null, null);
INSERT INTO `system_config` VALUES ('45', 'CodeDieTime', 'code', 'int', '300', '验证码有效期', '0', '2018-09-04 18:17:26', '0', null, null);
INSERT INTO `system_config` VALUES ('46', 'FileType', 'file', 'int', '2', '文件保存方法（1：本地，2：七牛云）', '0', '2018-09-17 11:44:12', '0', null, null);
INSERT INTO `system_config` VALUES ('47', 'FileKey', 'file', 'string', '690c7175d2b4439646b437b8b48f92fb147eccf0', '文件路径加密秘钥（www.99php.cn）', '0', '2018-09-17 16:51:29', '0', null, null);
INSERT INTO `system_config` VALUES ('48', 'LoginDuration', 'basic', 'int', '3600', '后台登录有效时间', '0', '2018-09-30 01:02:53', '0', null, null);
INSERT INTO `system_config` VALUES ('49', 'AdminModuleName', 'basic', 'int', 'chung', '后台登录模块名', '0', '2018-10-01 01:22:05', '0', null, null);
INSERT INTO `system_config` VALUES ('50', 'CleanCachePassword', 'basic', 'string', 'chung951222', '刷新缓存的密码', '0', '2018-10-01 01:42:16', '0', null, null);

-- ----------------------------
-- Table structure for system_login_record
-- ----------------------------
DROP TABLE IF EXISTS `system_login_record`;
CREATE TABLE `system_login_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT '1' COMMENT '登录类型（0：退出，1：登录）',
  `user_id` int(11) DEFAULT NULL COMMENT '系统用户ID（0：账户不存在）',
  `ip` varchar(255) DEFAULT NULL COMMENT '登录IP地址',
  `country` varchar(50) DEFAULT NULL COMMENT '国家',
  `region` varchar(50) DEFAULT NULL COMMENT '省份',
  `city` varchar(50) DEFAULT NULL COMMENT '城市',
  `isp` varchar(50) DEFAULT NULL COMMENT '网络类型',
  `location` varchar(100) DEFAULT NULL COMMENT '地址',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注信息',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态（0：失败，1：成功）',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=342 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='博客会员登录记录';

-- ----------------------------
-- Records of system_login_record
-- ----------------------------
INSERT INTO `system_login_record` VALUES ('214', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】密码不正确，请重新输入！', '0', '2018-09-30 01:48:54');
INSERT INTO `system_login_record` VALUES ('215', '1', '0', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】账户不存在，请重新输入！', '0', '2018-09-30 01:48:59');
INSERT INTO `system_login_record` VALUES ('216', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 01:49:08');
INSERT INTO `system_login_record` VALUES ('217', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 01:49:45');
INSERT INTO `system_login_record` VALUES ('218', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 01:53:01');
INSERT INTO `system_login_record` VALUES ('219', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:23');
INSERT INTO `system_login_record` VALUES ('220', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:25');
INSERT INTO `system_login_record` VALUES ('221', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:28');
INSERT INTO `system_login_record` VALUES ('222', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:30');
INSERT INTO `system_login_record` VALUES ('223', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:32');
INSERT INTO `system_login_record` VALUES ('224', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:35');
INSERT INTO `system_login_record` VALUES ('225', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:37');
INSERT INTO `system_login_record` VALUES ('226', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:39');
INSERT INTO `system_login_record` VALUES ('227', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:42');
INSERT INTO `system_login_record` VALUES ('228', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:44');
INSERT INTO `system_login_record` VALUES ('229', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:46');
INSERT INTO `system_login_record` VALUES ('230', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:48');
INSERT INTO `system_login_record` VALUES ('231', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:51');
INSERT INTO `system_login_record` VALUES ('232', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:53');
INSERT INTO `system_login_record` VALUES ('233', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:55');
INSERT INTO `system_login_record` VALUES ('234', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:56:58');
INSERT INTO `system_login_record` VALUES ('235', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:00');
INSERT INTO `system_login_record` VALUES ('236', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:02');
INSERT INTO `system_login_record` VALUES ('237', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:05');
INSERT INTO `system_login_record` VALUES ('238', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:07');
INSERT INTO `system_login_record` VALUES ('239', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:09');
INSERT INTO `system_login_record` VALUES ('240', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:12');
INSERT INTO `system_login_record` VALUES ('241', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:14');
INSERT INTO `system_login_record` VALUES ('242', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:16');
INSERT INTO `system_login_record` VALUES ('243', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:19');
INSERT INTO `system_login_record` VALUES ('244', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:21');
INSERT INTO `system_login_record` VALUES ('245', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:23');
INSERT INTO `system_login_record` VALUES ('246', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:26');
INSERT INTO `system_login_record` VALUES ('247', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:28');
INSERT INTO `system_login_record` VALUES ('248', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:30');
INSERT INTO `system_login_record` VALUES ('249', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:33');
INSERT INTO `system_login_record` VALUES ('250', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:35');
INSERT INTO `system_login_record` VALUES ('251', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:37');
INSERT INTO `system_login_record` VALUES ('252', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:38');
INSERT INTO `system_login_record` VALUES ('253', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:41');
INSERT INTO `system_login_record` VALUES ('254', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:43');
INSERT INTO `system_login_record` VALUES ('255', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:45');
INSERT INTO `system_login_record` VALUES ('256', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:48');
INSERT INTO `system_login_record` VALUES ('257', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:50');
INSERT INTO `system_login_record` VALUES ('258', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:52');
INSERT INTO `system_login_record` VALUES ('259', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:55');
INSERT INTO `system_login_record` VALUES ('260', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:57');
INSERT INTO `system_login_record` VALUES ('261', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:57:59');
INSERT INTO `system_login_record` VALUES ('262', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:02');
INSERT INTO `system_login_record` VALUES ('263', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:02');
INSERT INTO `system_login_record` VALUES ('264', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:03');
INSERT INTO `system_login_record` VALUES ('265', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:03');
INSERT INTO `system_login_record` VALUES ('266', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:04');
INSERT INTO `system_login_record` VALUES ('267', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:05');
INSERT INTO `system_login_record` VALUES ('268', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:05');
INSERT INTO `system_login_record` VALUES ('269', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:05');
INSERT INTO `system_login_record` VALUES ('270', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:05');
INSERT INTO `system_login_record` VALUES ('271', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 01:58:13');
INSERT INTO `system_login_record` VALUES ('272', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:16');
INSERT INTO `system_login_record` VALUES ('273', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:16');
INSERT INTO `system_login_record` VALUES ('274', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:16');
INSERT INTO `system_login_record` VALUES ('275', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:24');
INSERT INTO `system_login_record` VALUES ('276', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:24');
INSERT INTO `system_login_record` VALUES ('277', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:24');
INSERT INTO `system_login_record` VALUES ('278', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:28');
INSERT INTO `system_login_record` VALUES ('279', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:29');
INSERT INTO `system_login_record` VALUES ('280', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:30');
INSERT INTO `system_login_record` VALUES ('281', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:58:30');
INSERT INTO `system_login_record` VALUES ('282', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:59:15');
INSERT INTO `system_login_record` VALUES ('283', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:59:15');
INSERT INTO `system_login_record` VALUES ('284', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:59:16');
INSERT INTO `system_login_record` VALUES ('285', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:59:17');
INSERT INTO `system_login_record` VALUES ('286', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:59:17');
INSERT INTO `system_login_record` VALUES ('287', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:59:17');
INSERT INTO `system_login_record` VALUES ('288', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:59:18');
INSERT INTO `system_login_record` VALUES ('289', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:59:18');
INSERT INTO `system_login_record` VALUES ('290', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 01:59:18');
INSERT INTO `system_login_record` VALUES ('291', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 02:58:22');
INSERT INTO `system_login_record` VALUES ('292', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 02:58:29');
INSERT INTO `system_login_record` VALUES ('293', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 03:00:50');
INSERT INTO `system_login_record` VALUES ('294', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 03:02:36');
INSERT INTO `system_login_record` VALUES ('295', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 03:02:44');
INSERT INTO `system_login_record` VALUES ('296', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 03:03:59');
INSERT INTO `system_login_record` VALUES ('297', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 03:04:17');
INSERT INTO `system_login_record` VALUES ('298', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 03:04:22');
INSERT INTO `system_login_record` VALUES ('299', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 03:06:40');
INSERT INTO `system_login_record` VALUES ('300', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 03:06:44');
INSERT INTO `system_login_record` VALUES ('301', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 03:07:02');
INSERT INTO `system_login_record` VALUES ('302', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 03:07:20');
INSERT INTO `system_login_record` VALUES ('303', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】密码不正确，请重新输入！', '0', '2018-09-30 11:16:30');
INSERT INTO `system_login_record` VALUES ('304', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 11:16:38');
INSERT INTO `system_login_record` VALUES ('305', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 11:18:50');
INSERT INTO `system_login_record` VALUES ('306', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 11:19:11');
INSERT INTO `system_login_record` VALUES ('307', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 11:22:33');
INSERT INTO `system_login_record` VALUES ('308', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 11:29:30');
INSERT INTO `system_login_record` VALUES ('309', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 13:55:51');
INSERT INTO `system_login_record` VALUES ('310', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 13:55:56');
INSERT INTO `system_login_record` VALUES ('311', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 14:03:14');
INSERT INTO `system_login_record` VALUES ('312', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 14:03:18');
INSERT INTO `system_login_record` VALUES ('313', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 14:04:47');
INSERT INTO `system_login_record` VALUES ('314', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 14:04:58');
INSERT INTO `system_login_record` VALUES ('315', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-09-30 16:40:27');
INSERT INTO `system_login_record` VALUES ('316', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 16:40:31');
INSERT INTO `system_login_record` VALUES ('317', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 17:05:26');
INSERT INTO `system_login_record` VALUES ('318', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 17:09:53');
INSERT INTO `system_login_record` VALUES ('319', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 17:13:08');
INSERT INTO `system_login_record` VALUES ('320', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 17:15:18');
INSERT INTO `system_login_record` VALUES ('321', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 17:15:27');
INSERT INTO `system_login_record` VALUES ('322', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 17:16:22');
INSERT INTO `system_login_record` VALUES ('323', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 17:17:05');
INSERT INTO `system_login_record` VALUES ('324', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 17:53:14');
INSERT INTO `system_login_record` VALUES ('325', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 17:53:17');
INSERT INTO `system_login_record` VALUES ('326', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-09-30 18:05:56');
INSERT INTO `system_login_record` VALUES ('327', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 18:06:00');
INSERT INTO `system_login_record` VALUES ('328', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-09-30 18:16:18');
INSERT INTO `system_login_record` VALUES ('329', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-10-01 00:58:12');
INSERT INTO `system_login_record` VALUES ('330', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-10-01 01:03:45');
INSERT INTO `system_login_record` VALUES ('331', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-10-01 01:07:02');
INSERT INTO `system_login_record` VALUES ('332', '0', null, '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-10-01 01:07:44');
INSERT INTO `system_login_record` VALUES ('333', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-10-01 01:07:48');
INSERT INTO `system_login_record` VALUES ('334', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-10-01 01:13:49');
INSERT INTO `system_login_record` VALUES ('335', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-10-01 13:32:49');
INSERT INTO `system_login_record` VALUES ('336', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-10-08 10:11:16');
INSERT INTO `system_login_record` VALUES ('337', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-10-08 10:11:53');
INSERT INTO `system_login_record` VALUES ('338', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-10-08 10:11:58');
INSERT INTO `system_login_record` VALUES ('339', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【登录过期】正在退出后台系统！', '1', '2018-10-08 14:21:13');
INSERT INTO `system_login_record` VALUES ('340', '1', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【账号登录】登录成功，正在进入系统！', '1', '2018-10-08 14:21:29');
INSERT INTO `system_login_record` VALUES ('341', '0', '1', '127.0.0.1', 'XX', 'XX', '内网IP', '内网IP', 'XXXX内网IP内网IP', '【主动退出】正在退出后台系统！', '1', '2018-10-08 14:35:55');

-- ----------------------------
-- Table structure for system_menu
-- ----------------------------
DROP TABLE IF EXISTS `system_menu`;
CREATE TABLE `system_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `spread` tinyint(1) DEFAULT '0',
  `node` varchar(200) NOT NULL DEFAULT '' COMMENT '节点代码',
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `href` varchar(400) NOT NULL DEFAULT '' COMMENT '链接',
  `params` varchar(500) DEFAULT '' COMMENT '链接参数',
  `target` varchar(20) NOT NULL DEFAULT '_self' COMMENT '链接打开方式',
  `sort` float(11,2) DEFAULT '0.00' COMMENT '菜单排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `remark` varchar(255) DEFAULT NULL,
  `create_by` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_system_menu_node` (`node`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统菜单表';

-- ----------------------------
-- Records of system_menu
-- ----------------------------
INSERT INTO `system_menu` VALUES ('1', '0', '后台首页', '0', '', '&#xe68e;', 'admin/index/welcome', '', '_self', '0.00', '1', '', '0', '2018-07-21 13:28:32', null, null);
INSERT INTO `system_menu` VALUES ('140', '0', '内容管理', '0', '', '&#xe63c;', '#', '', '_self', '8.00', '0', '', '0', '2018-07-17 03:09:09', null, null);
INSERT INTO `system_menu` VALUES ('141', '0', '用户中心', '0', '', '&#xe770;', '#', '', '_self', '10.00', '0', '', '0', '2018-07-17 03:09:16', null, null);
INSERT INTO `system_menu` VALUES ('142', '0', '系统设置', '0', '', '&#xe620;', '#', '', '_self', '3.00', '1', null, '0', '2018-07-17 03:09:41', null, null);
INSERT INTO `system_menu` VALUES ('143', '0', '使用文档', '0', '', '&#xe705;', '#', '', '_self', '6.00', '0', null, '0', '2018-07-17 03:09:49', null, null);
INSERT INTO `system_menu` VALUES ('144', '140', '文章列表', '0', '', '&#xe705;', 'static/layuicms/page/news/newsList.html', '', '_self', '0.00', '0', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('147', '140', '图片管理', '0', '', '&#xe634;', 'static/layuicms/page/img/images.html', '', '_self', '0.00', '0', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('148', '140', '其他页面', '0', '', '&#xe630;', 'static/layuicms/', '', '_self', '1.00', '0', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('149', '148', '404页面', '0', '', '&#x1006;', 'static/layuicms/page/404.html', '', '_self', '0.00', '0', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('150', '148', '登录', '0', '', '&#xe609;', 'static/layuicms/page/login/login.html', '', '_blank', '0.00', '0', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('151', '141', '用户中心', '0', '', '&#xe612;', 'static/layuicms/page/user/userList.html', '', '_self', '0.00', '0', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('152', '141', '会员等级', '0', '', 'icon-vip', 'static/layuicms/page/user/userGrade.html', '', '_self', '0.00', '0', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('153', '142', '系统基本参数', '0', '', '&#xe631', 'static/layuicms/page/systemSetting/basicParameter.html', '', '_self', '4.00', '0', null, '0', '2018-07-17 10:45:53', null, null);
INSERT INTO `system_menu` VALUES ('154', '142', '系统日志', '0', '', 'icon-log', 'static/layuicms/page/systemSetting/logs.html', '', '_self', '3.00', '0', null, '0', '2018-07-17 10:46:59', null, null);
INSERT INTO `system_menu` VALUES ('155', '142', '友情链接', '0', '', '&#xe64c;', 'static/layuicms/page/systemSetting/linkList.html', '', '_self', '3.00', '0', null, '0', '2018-07-17 10:47:13', null, null);
INSERT INTO `system_menu` VALUES ('156', '142', '图标管理', '0', '', '&#xe857;', 'static/layuicms/page/systemSetting/icons.html', '', '_self', '6.00', '0', null, '0', '2018-07-17 10:47:34', null, null);
INSERT INTO `system_menu` VALUES ('157', '143', '三级联动模块', '0', '', 'icon-mokuai', 'static/layuicms/page/doc/addressDoc.html', '', '_self', '0.00', '0', null, '0', '2018-07-17 10:48:02', null, null);
INSERT INTO `system_menu` VALUES ('158', '143', 'bodyTab模块', '0', '', 'icon-mokuai', 'static/layuicms/page/doc/bodyTabDoc.html', '', '_self', '0.00', '0', null, '0', '2018-07-17 10:48:19', null, null);
INSERT INTO `system_menu` VALUES ('159', '143', '三级菜单', '0', '', 'icon-mokuai', 'static/layuicms/page/doc/navDoc.html', '', '_self', '0.00', '0', null, '0', '2018-07-17 10:48:39', null, null);
INSERT INTO `system_menu` VALUES ('163', '167', '管理员列表', '0', '', 'icon-icon10', 'admin/user/index', '', '_self', '1.00', '1', '', '0', '2018-07-18 01:15:16', null, null);
INSERT INTO `system_menu` VALUES ('164', '167', '菜单配置', '0', '', '&#xe620;', 'admin/menu/index', '', '_self', '1.00', '1', '', '0', '2018-07-19 02:05:48', null, null);
INSERT INTO `system_menu` VALUES ('165', '169', '刷新缓存', '0', '', '&#xe9aa;', 'admin/system/refresh', '', '_self', '5.00', '1', '', '0', '2018-07-19 10:11:27', null, null);
INSERT INTO `system_menu` VALUES ('166', '168', '系统节点', '0', '', '&#xe631;', 'admin/node/index', '', '_self', '5.00', '1', '', '0', '2018-07-23 00:44:49', null, null);
INSERT INTO `system_menu` VALUES ('167', '142', '系统管理', '0', '', '&#xe716;', '#', '', '_self', '0.00', '1', '', '0', '2018-07-23 01:23:11', null, null);
INSERT INTO `system_menu` VALUES ('168', '142', '权限管理', '0', '', '&#xe857;', '#', '', '_self', '2.00', '1', '', '0', '2018-07-23 01:23:27', null, null);
INSERT INTO `system_menu` VALUES ('169', '142', '系统刷新', '0', '', '&#xe639;', '#', '', '_self', '3.00', '1', '', '0', '2018-07-23 01:26:30', null, null);
INSERT INTO `system_menu` VALUES ('171', '168', '角色权限', '0', '', '&#xe606;', 'admin/auth/index', '', '_self', '0.00', '1', '', '0', '2018-07-23 15:37:53', null, null);
INSERT INTO `system_menu` VALUES ('172', '169', '刷新节点', '0', '', '&#xe666;', 'admin/system/refresh_node', '', '_self', '1.00', '1', '', '0', '2018-07-25 22:06:45', null, null);
INSERT INTO `system_menu` VALUES ('173', '169', '清除节点', '0', '', '&#xe639;', 'admin/system/clear_node', '', '_self', '0.00', '1', '', '0', '2018-07-26 15:27:24', null, null);
INSERT INTO `system_menu` VALUES ('175', '167', '系统配置', '0', '', '&#xe663;', 'admin/config/index', '', '_self', '5.00', '1', '', '0', '2018-07-31 00:11:14', '2018-08-01 11:28:42', null);
INSERT INTO `system_menu` VALUES ('178', '0', '博客管理', '0', '', '&#xe60a;', '#', '', '_self', '2.00', '1', '', '0', '2018-09-20 02:00:30', null, null);
INSERT INTO `system_menu` VALUES ('179', '178', '文章管理', '0', '', '&#xe62a;', '#', '', '_self', '4.00', '1', '', '0', '2018-09-20 02:01:44', null, null);
INSERT INTO `system_menu` VALUES ('180', '179', '文章列表', '0', '', '&#xe637;', 'admin/blog.article/index', '', '_self', '0.00', '1', '', '0', '2018-09-20 02:03:17', null, null);
INSERT INTO `system_menu` VALUES ('185', '178', '会员管理', '0', '', '&#xe66f;', '#', '', '_self', '3.00', '1', '', '0', '2018-09-21 01:12:26', null, null);
INSERT INTO `system_menu` VALUES ('186', '185', '会员列表', '0', '', '&#xe770;', 'admin/blog.member/index', '', '_self', '0.00', '1', '', '0', '2018-09-21 01:13:19', null, null);
INSERT INTO `system_menu` VALUES ('187', '179', '标签管理', '0', '', '&#xe6b2;', 'admin/blog.tag/index', '', '_self', '0.00', '1', '', '0', '2018-09-21 01:14:43', null, null);
INSERT INTO `system_menu` VALUES ('188', '179', '推荐阅读', '0', '', '&#xe756;', '#', '', '_self', '0.00', '0', '', '0', '2018-09-21 01:16:00', null, null);
INSERT INTO `system_menu` VALUES ('189', '178', '轮播图管理', '0', '', '&#xe64a;', '#', '', '_self', '5.00', '0', '', '0', '2018-09-21 01:17:25', null, null);
INSERT INTO `system_menu` VALUES ('190', '189', '轮播图配置', '0', '', '&#xe66a;', '#', '', '_self', '2.00', '1', '', '0', '2018-09-21 01:17:44', null, null);
INSERT INTO `system_menu` VALUES ('191', '179', '点击排行', '0', '', '&#xe64f;', '#', '', '_self', '3.00', '0', '', '0', '2018-09-21 01:19:05', null, null);
INSERT INTO `system_menu` VALUES ('210', '185', '登录记录', '0', '', '&#xe665;', 'admin/blog.login_record/index', '', '_self', '2.00', '1', '', '0', '2018-09-26 17:33:29', null, null);
INSERT INTO `system_menu` VALUES ('211', '179', '文章分类', '0', '', '&#xe664;', 'blog.category/index', '', '_self', '0.00', '1', '', '0', '2018-09-27 01:34:06', null, null);

-- ----------------------------
-- Table structure for system_node
-- ----------------------------
DROP TABLE IF EXISTS `system_node`;
CREATE TABLE `system_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `node` varchar(100) DEFAULT NULL COMMENT '节点代码',
  `title` varchar(500) DEFAULT NULL COMMENT '节点标题',
  `type` tinyint(1) DEFAULT '3' COMMENT '节点类型（1：模块，2：控制器，3：节点）',
  `is_auth` tinyint(1) unsigned DEFAULT '1' COMMENT '是否启动RBAC权限控制',
  `is_auto` tinyint(1) DEFAULT '0' COMMENT '是否为系统自动刷新（0：是，1：手动添加）',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` bigint(20) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_system_node_node` (`node`)
) ENGINE=InnoDB AUTO_INCREMENT=1490 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统节点表';

-- ----------------------------
-- Records of system_node
-- ----------------------------
INSERT INTO `system_node` VALUES ('1383', 'admin', null, '1', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1384', 'admin/auth', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1385', 'admin/auth/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1386', 'admin/auth/add', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1387', 'admin/auth/edit', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1388', 'admin/auth/del', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1389', 'admin/auth/status', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1390', 'admin/auth/authorize', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1391', 'admin/auth/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1392', 'admin/auth/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1393', 'admin/config', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1394', 'admin/config/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1395', 'admin/config/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1396', 'admin/config/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1397', 'admin/icon', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1398', 'admin/icon/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1399', 'admin/icon/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1400', 'admin/icon/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1401', 'admin/index', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1402', 'admin/index/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1403', 'admin/index/welcome', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1404', 'admin/index/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1405', 'admin/index/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1406', 'admin/login', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1407', 'admin/login/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1408', 'admin/login/change', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1409', 'admin/login/out', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1410', 'admin/menu', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1411', 'admin/menu/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1412', 'admin/menu/add', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1413', 'admin/menu/edit', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1414', 'admin/menu/del', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1415', 'admin/menu/status', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1416', 'admin/menu/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1417', 'admin/menu/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1418', 'admin/node', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1419', 'admin/node/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1420', 'admin/node/status', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1421', 'admin/node/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1422', 'admin/node/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1423', 'admin/system', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1424', 'admin/system/refresh', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1425', 'admin/system/refresh_node', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1426', 'admin/system/clear_node', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1427', 'admin/system/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1428', 'admin/system/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1429', 'admin/test', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1430', 'admin/test/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1431', 'admin/test/test', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1432', 'admin/test/url', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1433', 'admin/test/curl', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1434', 'admin/test/add', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1435', 'admin/user', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1436', 'admin/user/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1437', 'admin/user/add', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1438', 'admin/user/edit', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1439', 'admin/user/del', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1440', 'admin/user/edit_password', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1441', 'admin/user/status', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1442', 'admin/user/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1443', 'admin/user/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1444', 'admin/api.menu', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1445', 'admin/api.menu/get_menu', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1446', 'admin/api.menu/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1447', 'admin/api.menu/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1448', 'admin/api.node', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1449', 'admin/api.node/get_node_tree', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1450', 'admin/api.node/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1451', 'admin/api.node/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1452', 'admin/api.upload', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1453', 'admin/api.upload/image', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1454', 'admin/api.upload/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1455', 'admin/api.upload/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1456', 'admin/blog.article', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1457', 'admin/blog.article/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1458', 'admin/blog.article/add', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1459', 'admin/blog.article/edit', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1460', 'admin/blog.article/del', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1461', 'admin/blog.article/status', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1462', 'admin/blog.article/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1463', 'admin/blog.article/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1464', 'admin/blog.category', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1465', 'admin/blog.category/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1466', 'admin/blog.category/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1467', 'admin/blog.category/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1468', 'admin/blog.login_record', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1469', 'admin/blog.login_record/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1470', 'admin/blog.login_record/del', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1471', 'admin/blog.login_record/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1472', 'admin/blog.login_record/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1473', 'admin/blog.member', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1474', 'admin/blog.member/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1475', 'admin/blog.member/add', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1476', 'admin/blog.member/edit', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1477', 'admin/blog.member/edit_password', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1478', 'admin/blog.member/del', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1479', 'admin/blog.member/status', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1480', 'admin/blog.member/detail', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1481', 'admin/blog.member/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1482', 'admin/blog.member/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1483', 'admin/blog.tag', null, '2', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1484', 'admin/blog.tag/index', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1485', 'admin/blog.tag/add', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1486', 'admin/blog.tag/edit', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1487', 'admin/blog.tag/del', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1488', 'admin/blog.tag/check_login', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);
INSERT INTO `system_node` VALUES ('1489', 'admin/blog.tag/check_auth', null, '3', '1', '0', '2018-10-08 10:13:54', null, null, null);

-- ----------------------------
-- Table structure for system_node_copy
-- ----------------------------
DROP TABLE IF EXISTS `system_node_copy`;
CREATE TABLE `system_node_copy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `node` varchar(100) DEFAULT NULL COMMENT '节点代码',
  `title` varchar(500) DEFAULT NULL COMMENT '节点标题',
  `type` tinyint(1) DEFAULT '3' COMMENT '节点类型（1：模块，2：控制器，3：节点）',
  `is_auth` tinyint(1) unsigned DEFAULT '1' COMMENT '是否启动RBAC权限控制',
  `is_auto` tinyint(1) DEFAULT '0' COMMENT '是否为系统自动刷新（0：是，1：手动添加）',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` bigint(20) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_system_node_node` (`node`)
) ENGINE=InnoDB AUTO_INCREMENT=1383 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统节点表';

-- ----------------------------
-- Records of system_node_copy
-- ----------------------------
INSERT INTO `system_node_copy` VALUES ('1037', 'admin', '后台模块管理', '1', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1040', 'admin/auth', '角色管理', '2', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1041', 'admin/auth/index', '角色列表', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1042', 'admin/auth/add', '添加角色', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1043', 'admin/auth/edit', '编辑角色', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1044', 'admin/auth/del', '删除角色', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1045', 'admin/auth/status', '更改角色状态', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1046', 'admin/auth/authorize', '角色授权', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1047', 'admin/icon', '系统图标管理', '2', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1048', 'admin/icon/index', '图标列表', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1049', 'admin/index', '系统后台首页（不要开启）', '2', '0', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1050', 'admin/index/index', '后台首页（不要开启）', '3', '0', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1051', 'admin/index/welcome', '后台欢迎页面（不要开启）', '3', '0', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1052', 'admin/menu', '系统菜单管理', '2', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1053', 'admin/menu/index', '菜单列表', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1054', 'admin/menu/add', '添加菜单', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1055', 'admin/menu/edit', '编辑菜单', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1056', 'admin/menu/del', '删除菜单', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1057', 'admin/menu/status', '更改菜单状态', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1058', 'admin/node', '节点管理', '2', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1059', 'admin/node/index', '节点列表', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1063', 'admin/node/status', '更改节点状态', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1064', 'admin/system', '系统管理', '2', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1065', 'admin/system/refresh', '刷新缓存', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1066', 'admin/system/refresh_node', '刷新节点', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1069', 'admin/user', '系统管理员管理', '2', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1070', 'admin/user/index', '管理员列表', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1071', 'admin/user/add', '添加管理员', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1072', 'admin/user/edit', '编辑管理员', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1073', 'admin/user/del', '删除管理员', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1074', 'admin/user/edit_password', '修改管理员密码', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1075', 'admin/user/status', '更改管理员状态', '3', '1', null, '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1081', 'index', '前台管理', '1', '0', null, '2018-07-26 10:52:22', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1082', 'index/index', '网站首页', '2', '0', null, '2018-07-26 10:52:22', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1083', 'index/index/index', null, '3', '0', null, '2018-07-26 10:52:22', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1084', 'common', '公共模块', '1', '0', null, '2018-07-26 13:03:04', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1085', 'common/admin_controller', null, '2', '0', null, '2018-07-26 13:03:04', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1109', 'admin/system/clear_node', '清除节点', '3', '1', null, '2018-07-26 15:29:55', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1113', 'admin/config', '系统配置管理', '2', '1', null, '2018-07-31 01:00:16', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1114', 'admin/config/index', '系统配置列表', '3', '1', null, '2018-07-31 01:00:16', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1115', 'admin/test', '424', '2', '0', null, '2018-08-06 22:27:17', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1116', 'admin/test/index', null, '3', '0', null, '2018-08-06 22:27:17', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1117', 'admin/test/url', null, '3', '0', null, '2018-09-12 15:50:23', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1118', 'admin/test/curl', null, '3', '0', null, '2018-09-12 15:50:23', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1119', 'admin/test/test', null, '3', '0', null, '2018-09-12 15:50:23', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1120', 'admin/test/add', null, '3', '0', null, '2018-09-12 15:50:24', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1122', 'install/index', null, '2', '0', null, '2018-09-12 15:50:47', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1123', 'install/index/index', null, '3', '0', null, '2018-09-12 15:50:47', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1124', 'admin/login', null, '2', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1125', 'admin/login/index', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1126', 'admin/login/change', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1127', 'admin/login/out', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1138', 'blog', null, '1', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1139', 'blog/article', null, '2', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1140', 'blog/article/index', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1141', 'blog/article/add', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1142', 'blog/article/details', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1143', 'blog/article/add_comment', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1144', 'blog/article/check_login', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1145', 'blog/article/check_login_over', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1146', 'blog/article/ini_qiniu', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1147', 'blog/article/login_record', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1148', 'blog/index', null, '2', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1149', 'blog/index/index', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1150', 'blog/index/check_login', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1151', 'blog/index/check_login_over', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1152', 'blog/index/ini_qiniu', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1153', 'blog/index/login_record', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1154', 'blog/login', null, '2', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1155', 'blog/login/index', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1156', 'blog/login/register', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1157', 'blog/login/change', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1158', 'blog/login/out', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1159', 'blog/login/check_login', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1160', 'blog/login/check_login_over', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1161', 'blog/login/ini_qiniu', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1162', 'blog/login/login_record', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1163', 'blog/member', null, '2', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1164', 'blog/member/index', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1165', 'blog/member/article', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1166', 'blog/member/comment', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1167', 'blog/member/comment_other', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1168', 'blog/member/follow', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1169', 'blog/member/fans', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1170', 'blog/member/article_del', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1171', 'blog/member/article_edit', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1172', 'blog/member/comment_del', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1173', 'blog/member/check_login', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1174', 'blog/member/check_login_over', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1175', 'blog/member/ini_qiniu', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1176', 'blog/member/login_record', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1177', 'blog/oauth', null, '2', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1178', 'blog/oauth/index', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1179', 'blog/oauth/callback', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1180', 'blog/oauth/check_login', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1181', 'blog/oauth/check_login_over', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1182', 'blog/oauth/ini_qiniu', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1183', 'blog/oauth/login_record', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1184', 'blog/search', null, '2', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1185', 'blog/search/index', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1186', 'blog/search/check_login', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1187', 'blog/search/check_login_over', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1188', 'blog/search/ini_qiniu', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1189', 'blog/search/login_record', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1190', 'blog/setting', null, '2', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1191', 'blog/setting/index', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1192', 'blog/setting/info', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1193', 'blog/setting/login_log', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1194', 'blog/setting/form_info', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1195', 'blog/setting/form_username', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1196', 'blog/setting/form_email', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1197', 'blog/setting/form_phone', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1198', 'blog/setting/form_password', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1199', 'blog/setting/check_login', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1200', 'blog/setting/check_login_over', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1201', 'blog/setting/ini_qiniu', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1202', 'blog/setting/login_record', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1203', 'blog/test', null, '2', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1204', 'blog/test/email', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1205', 'blog/test/index', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1206', 'blog/test/send', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1207', 'blog/test/rank', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1208', 'blog/test/model', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1209', 'blog/test/ceshi', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1210', 'blog/test/upload', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1211', 'blog/test/check_login', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1212', 'blog/test/check_login_over', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1213', 'blog/test/ini_qiniu', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1214', 'blog/test/login_record', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1215', 'blog/upload', null, '2', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1216', 'blog/upload/index', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1217', 'blog/upload/check_login', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1218', 'blog/upload/check_login_over', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1219', 'blog/upload/ini_qiniu', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1220', 'blog/upload/login_record', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1233', 'common/blog_controller', null, '2', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1239', 'index/index/download', null, '3', '1', '0', '2018-09-19 18:21:57', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1243', 'install', null, '1', '1', '0', '2018-09-19 18:22:45', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1244', 'download', null, '1', '1', '0', '2018-09-20 00:41:59', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1246', 'common/blog_controller/check_login', null, '3', '1', '0', '2018-09-20 00:50:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1247', 'common/blog_controller/check_login_over', null, '3', '1', '0', '2018-09-20 00:50:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1248', 'common/blog_controller/ini_qiniu', null, '3', '1', '0', '2018-09-20 00:50:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1249', 'common/blog_controller/login_record', null, '3', '1', '0', '2018-09-20 00:50:09', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1279', 'admin/auth/check_login', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1280', 'admin/auth/check_auth', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1281', 'admin/config/check_login', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1282', 'admin/config/check_auth', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1283', 'admin/icon/check_login', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1284', 'admin/icon/check_auth', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1285', 'admin/index/check_login', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1286', 'admin/index/check_auth', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1287', 'admin/menu/check_login', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1288', 'admin/menu/check_auth', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1289', 'admin/node/check_login', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1290', 'admin/node/check_auth', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1291', 'admin/system/check_login', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1292', 'admin/system/check_auth', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1293', 'admin/user/check_login', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1294', 'admin/user/check_auth', null, '3', '1', '0', '2018-09-30 17:41:25', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1337', 'admin/api.menu', null, '2', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1338', 'admin/api.menu/get_menu', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1339', 'admin/api.menu/check_login', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1340', 'admin/api.menu/check_auth', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1341', 'admin/api.node', null, '2', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1342', 'admin/api.node/get_node_tree', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1343', 'admin/api.node/check_login', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1344', 'admin/api.node/check_auth', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1345', 'admin/api.upload', null, '2', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1346', 'admin/api.upload/image', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1347', 'admin/api.upload/check_login', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1348', 'admin/api.upload/check_auth', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1349', 'admin/blog.article', null, '2', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1350', 'admin/blog.article/index', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1351', 'admin/blog.article/add', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1352', 'admin/blog.article/edit', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1353', 'admin/blog.article/del', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1354', 'admin/blog.article/status', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1355', 'admin/blog.article/check_login', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1356', 'admin/blog.article/check_auth', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1357', 'admin/blog.category', null, '2', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1358', 'admin/blog.category/index', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1359', 'admin/blog.category/check_login', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1360', 'admin/blog.category/check_auth', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1361', 'admin/blog.login_record', null, '2', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1362', 'admin/blog.login_record/index', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1363', 'admin/blog.login_record/del', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1364', 'admin/blog.login_record/check_login', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1365', 'admin/blog.login_record/check_auth', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1366', 'admin/blog.member', null, '2', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1367', 'admin/blog.member/index', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1368', 'admin/blog.member/add', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1369', 'admin/blog.member/edit', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1370', 'admin/blog.member/edit_password', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1371', 'admin/blog.member/del', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1372', 'admin/blog.member/status', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1373', 'admin/blog.member/detail', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1374', 'admin/blog.member/check_login', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1375', 'admin/blog.member/check_auth', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1376', 'admin/blog.tag', null, '2', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1377', 'admin/blog.tag/index', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1378', 'admin/blog.tag/add', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1379', 'admin/blog.tag/edit', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1380', 'admin/blog.tag/del', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1381', 'admin/blog.tag/check_login', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);
INSERT INTO `system_node_copy` VALUES ('1382', 'admin/blog.tag/check_auth', null, '3', '1', '0', '2018-10-01 13:54:12', null, null, null);

-- ----------------------------
-- Table structure for system_user
-- ----------------------------
DROP TABLE IF EXISTS `system_user`;
CREATE TABLE `system_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth_id` varchar(255) DEFAULT NULL COMMENT '角色权限ID',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户登录名',
  `password` char(40) NOT NULL DEFAULT '' COMMENT '用户登录密码',
  `qq` varchar(16) DEFAULT NULL COMMENT '联系QQ',
  `mail` varchar(32) DEFAULT NULL COMMENT '联系邮箱',
  `phone` varchar(16) DEFAULT NULL COMMENT '联系手机号',
  `remark` varchar(255) DEFAULT '' COMMENT '备注说明',
  `login_num` bigint(20) unsigned DEFAULT '0' COMMENT '登录次数',
  `login_at` datetime DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用,)',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT '删除状态(1:删除,0:未删)',
  `create_by` bigint(20) unsigned DEFAULT '0' COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_by` bigint(20) DEFAULT NULL COMMENT '更新人',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_system_user_username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10015 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统用户表';
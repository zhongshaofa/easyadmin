/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test_blog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-01-02 18:27:35
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='博客配置';

-- ----------------------------
-- Records of blog_config
-- ----------------------------
INSERT INTO `blog_config` VALUES ('1', 'LoginDuration', 'blog', 'time', '3600', '博客登录有效时长', '0', '2018-07-17 17:27:27', '0', '2018-07-17 22:10:33', null);
INSERT INTO `blog_config` VALUES ('36', 'ScanFollow', 'blog', 'string', '/static/temp/blog/gg.jpg', '扫我关注', '0', '2018-08-29 12:58:10', '0', null, null);
INSERT INTO `blog_config` VALUES ('37', 'SiteName', 'blog', 'string', '99PHP社区 - 国内专业IT技术社区', '站点名称', '0', '2019-01-02 17:11:57', '0', null, null);
INSERT INTO `blog_config` VALUES ('38', 'SiteKeywords', 'blog', 'string', '开发者,99PHP,程序媛,极客,编程,代码,开源,IT网站,Developer,Programmer,Coder,Geek,技术社区', '站点关键词', '0', '2019-01-02 17:13:09', '0', null, null);
INSERT INTO `blog_config` VALUES ('39', 'SiteDescription', 'blog', 'string', '99PHP社区是一个面向开发者的知识分享社区。自创建以来，99PHP社区一直致力并专注于为开发者打造一个纯净的技术交流社区，推动并帮助开发者通过互联网分享知识，从而让更多开发者从中受益。99PHP社区的使命是帮助开发者用代码改变世界。', '站点描述', '0', '2019-01-02 17:13:25', '0', null, null);
INSERT INTO `blog_config` VALUES ('40', 'SiteUsername', 'blog', 'string', 'Mr.Chung1', '站长姓名', '0', '2019-01-02 17:38:39', '0', null, null);
INSERT INTO `blog_config` VALUES ('41', 'SiteJob', 'blog', 'string', 'PHP程序员1', '站长职业', '0', '2019-01-02 17:38:49', '0', null, null);
INSERT INTO `blog_config` VALUES ('42', 'SiteEmail', 'blog', 'string', 'chung@99php.cn1', '站长邮箱', '0', '2019-01-02 17:39:00', '0', null, null);
INSERT INTO `blog_config` VALUES ('43', 'SiteLocation', 'blog', 'string', '广州 天河', '工作地址', '0', '2019-01-02 17:39:20', '0', null, null);

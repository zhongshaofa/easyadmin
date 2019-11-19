/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : easyadmin

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2019-11-14 14:21:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ea_system_admin
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_admin`;
CREATE TABLE `ea_system_admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth_ids` varchar(255) DEFAULT NULL COMMENT '角色权限ID',
  `head_img` varchar(255) DEFAULT NULL COMMENT '头像',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户登录名',
  `password` char(40) NOT NULL DEFAULT '' COMMENT '用户登录密码',
  `phone` varchar(16) DEFAULT NULL COMMENT '联系手机号',
  `remark` varchar(255) DEFAULT '' COMMENT '备注说明',
  `login_num` bigint(20) unsigned DEFAULT '0' COMMENT '登录次数',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用,)',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统用户表';

-- ----------------------------
-- Records of ea_system_admin
-- ----------------------------
INSERT INTO `ea_system_admin` VALUES ('1', '', 'http://easyadmin.oss-cn-shenzhen.aliyuncs.com/upload/20191113/ff793ced447febfa9ea2d86f9f88fa8e.jpg', 'admin', 'ed696eb5bba1f7460585cc6975e6cf9bf24903dd', 'admin', 'admin', '0', '1', null, '1573639593', null);
INSERT INTO `ea_system_admin` VALUES ('5', '6', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/2c412adf1b30c8be3a913e603c7b6e4a.jpg', 'guest', 'ed696eb5bba1f7460585cc6975e6cf9bf24903dd', 'guest', 'guest', '0', '1', '1573436175', '1573639684', null);

-- ----------------------------
-- Table structure for ea_system_auth
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_auth`;
CREATE TABLE `ea_system_auth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '权限名称',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1:禁用,2:启用)',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统权限表';

-- ----------------------------
-- Records of ea_system_auth
-- ----------------------------
INSERT INTO `ea_system_auth` VALUES ('1', '管理员', '1', '测试管理员', null, null, null);
INSERT INTO `ea_system_auth` VALUES ('6', '游客权限', '1', '', null, '1573436411', null);

-- ----------------------------
-- Table structure for ea_system_auth_node
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_auth_node`;
CREATE TABLE `ea_system_auth_node` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth_id` bigint(20) unsigned DEFAULT NULL COMMENT '角色ID',
  `node_id` bigint(20) DEFAULT NULL COMMENT '节点ID',
  PRIMARY KEY (`id`),
  KEY `index_system_auth_auth` (`auth_id`) USING BTREE,
  KEY `index_system_auth_node` (`node_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='角色与节点关系表';

-- ----------------------------
-- Records of ea_system_auth_node
-- ----------------------------
INSERT INTO `ea_system_auth_node` VALUES ('54', '6', '1');
INSERT INTO `ea_system_auth_node` VALUES ('55', '6', '2');
INSERT INTO `ea_system_auth_node` VALUES ('56', '6', '3');
INSERT INTO `ea_system_auth_node` VALUES ('57', '6', '7');
INSERT INTO `ea_system_auth_node` VALUES ('58', '6', '8');
INSERT INTO `ea_system_auth_node` VALUES ('59', '6', '21');
INSERT INTO `ea_system_auth_node` VALUES ('60', '6', '22');
INSERT INTO `ea_system_auth_node` VALUES ('61', '6', '27');
INSERT INTO `ea_system_auth_node` VALUES ('62', '6', '28');

-- ----------------------------
-- Table structure for ea_system_config
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_config`;
CREATE TABLE `ea_system_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '变量名',
  `group` varchar(30) NOT NULL DEFAULT '' COMMENT '分组',
  `value` text COMMENT '变量值',
  `remark` varchar(100) DEFAULT '' COMMENT '备注信息',
  `sort` int(10) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `group` (`group`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统配置表';

-- ----------------------------
-- Records of ea_system_config
-- ----------------------------
INSERT INTO `ea_system_config` VALUES ('41', 'alisms_access_key_id', 'sms', 'LTAIdshu9dA2THSk', '阿里大于公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('42', 'alisms_access_key_secret', 'sms', '2c9PReYKkebWpglXSqKqFwRmTInaIm', '阿里大鱼私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('55', 'upload_type', 'upload', 'txcos', '当前上传方式 （local,alioss,qnoss,txoss）', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('56', 'upload_allow_ext', 'upload', 'doc,gif,ico,icon,jpg,mp3,mp4,p12,pem,png,rar,jpeg', '允许上传的文件类型', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('57', 'upload_allow_size', 'upload', '1024000', '允许上传的大小', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('58', 'upload_allow_mime', 'upload', 'image/gif,image/jpeg,video/x-msvideo,text/plain,image/png', '允许上传的文件mime', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('59', 'upload_allow_type', 'upload', 'local,alioss,qnoss,txcos', '可用的上传文件方式', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('60', 'alioss_access_key_id', 'upload', '填你的', '阿里云oss公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('61', 'alioss_access_key_secret', 'upload', '填你的', '阿里云oss私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('62', 'alioss_endpoint', 'upload', '填你的', '阿里云oss数据中心', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('63', 'alioss_bucket', 'upload', '填你的', '阿里云oss空间名称', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('64', 'alioss_domain', 'upload', '填你的', '阿里云oss访问域名', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('65', 'logo_title', 'site', 'EasyAdmin', 'LOGO标题', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('66', 'logo_image', 'site', '/favicon.ico', 'logo图片', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('68', 'site_name', 'site', 'EasyAdmin后台系统', '站点名称', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('69', 'site_ico', 'site', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/7d32671f4c1d1b01b0b28f45205763f9.ico', '浏览器图标', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('70', 'site_copyright', 'site', '©版权所有 2014-2018 叁贰柒工作室66', '版权信息', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('71', 'site_beian', 'site', '粤ICP备16006642号-2', '备案信息', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('72', 'site_version', 'site', 'beta 0.0.1', '版本信息', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('75', 'sms_type', 'sms', 'alisms', '短信类型', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('76', 'miniapp_appid', 'wechat', null, '小程序公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('77', 'miniapp_appsecret', 'wechat', null, '小程序私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('78', 'web_appid', 'wechat', null, '公众号公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('79', 'web_appsecret', 'wechat', null, '公众号私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('80', 'txcos_secret_id', 'upload', '填你的', '腾讯云cos密钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('81', 'txcos_secret_key', 'upload', '填你的', '腾讯云cos私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('82', 'txcos_region', 'upload', '填你的', '存储桶地域', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('83', 'tecos_bucket', 'upload', '填你的', '存储桶名称', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('84', 'qnoss_access_key', 'upload', '填你的', '访问密钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('85', 'qnoss_secret_key', 'upload', '填你的', '安全密钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('86', 'qnoss_bucket', 'upload', '填你的', '存储空间', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('87', 'qnoss_domain', 'upload', '填你的', '访问域名', '0', null, null);

-- ----------------------------
-- Table structure for ea_system_log_201911
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_log_201911`;
CREATE TABLE `ea_system_log_201911` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` int(10) unsigned DEFAULT '0' COMMENT '管理员ID',
  `url` varchar(1500) NOT NULL DEFAULT '' COMMENT '操作页面',
  `method` varchar(50) NOT NULL COMMENT '请求方法',
  `title` varchar(100) DEFAULT '' COMMENT '日志标题',
  `content` text NOT NULL COMMENT '内容',
  `ip` varchar(50) NOT NULL DEFAULT '' COMMENT 'IP',
  `useragent` varchar(255) DEFAULT '' COMMENT 'User-Agent',
  `create_time` int(10) DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `method` (`method`)
) ENGINE=InnoDB AUTO_INCREMENT=994 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='后台操作日志表 - 201911';

-- ----------------------------
-- Records of ea_system_log_201911
-- ----------------------------
INSERT INTO `ea_system_log_201911` VALUES ('833', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573639668');
INSERT INTO `ea_system_log_201911` VALUES ('834', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573639673');
INSERT INTO `ea_system_log_201911` VALUES ('835', '1', '/admintest/system.admin/password?id=5', 'post', '', '{\"id\":\"5\",\"username\":\"guest\",\"password\":\"123456\",\"password_again\":\"123456\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573639684');
INSERT INTO `ea_system_log_201911` VALUES ('836', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573639687');
INSERT INTO `ea_system_log_201911` VALUES ('837', '1', '/admintest/login/out', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573639698');
INSERT INTO `ea_system_log_201911` VALUES ('838', null, '/admintest/login/index', 'post', '', '{\"username\":\"guest\",\"password\":\"123456\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573639704');
INSERT INTO `ea_system_log_201911` VALUES ('839', '5', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573639707');
INSERT INTO `ea_system_log_201911` VALUES ('840', '5', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573639713');
INSERT INTO `ea_system_log_201911` VALUES ('841', '5', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573639714');
INSERT INTO `ea_system_log_201911` VALUES ('842', '5', '/admintest/index/editPassword.html', 'post', '', '{\"username\":\"guest\",\"password\":\"123456\",\"password_again\":\"123456\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573639726');
INSERT INTO `ea_system_log_201911` VALUES ('843', '5', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573639748');
INSERT INTO `ea_system_log_201911` VALUES ('844', null, '/admintest/login/index.html', 'post', '', '{\"username\":\"admin\",\"password\":\"123456\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573694928');
INSERT INTO `ea_system_log_201911` VALUES ('845', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573694931');
INSERT INTO `ea_system_log_201911` VALUES ('846', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573694938');
INSERT INTO `ea_system_log_201911` VALUES ('847', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573694941');
INSERT INTO `ea_system_log_201911` VALUES ('848', '1', '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573694943');
INSERT INTO `ea_system_log_201911` VALUES ('849', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573694948');
INSERT INTO `ea_system_log_201911` VALUES ('850', '1', '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573694949');
INSERT INTO `ea_system_log_201911` VALUES ('851', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573694949');
INSERT INTO `ea_system_log_201911` VALUES ('852', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573694951');
INSERT INTO `ea_system_log_201911` VALUES ('853', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573694955');
INSERT INTO `ea_system_log_201911` VALUES ('854', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573694957');
INSERT INTO `ea_system_log_201911` VALUES ('855', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573694981');
INSERT INTO `ea_system_log_201911` VALUES ('856', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573694987');
INSERT INTO `ea_system_log_201911` VALUES ('857', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573694989');
INSERT INTO `ea_system_log_201911` VALUES ('858', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573696502');
INSERT INTO `ea_system_log_201911` VALUES ('859', '1', '/admintest/system.config/save', 'post', '', '{\"upload_type\":\"qnoss\",\"upload_allow_ext\":\"doc,gif,ico,icon,jpg,mp3,mp4,p12,pem,png,rar,jpeg\",\"upload_allow_size\":\"1024000\",\"qnoss_access_key\":\"v-lV3tXev7yyHWD1jRc6_8rFOhFYGQvvjsAQxdrB\",\"qnoss_secret_key\":\"XOhYRR9JNqxsWVEO-mHWB4193vSwJeQADuORaXzr\",\"qnoss_bucket\":\"easyadmin\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573696508');
INSERT INTO `ea_system_log_201911` VALUES ('860', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573696522');
INSERT INTO `ea_system_log_201911` VALUES ('861', '1', '/admintest/ajax/upload', 'post', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573696529');
INSERT INTO `ea_system_log_201911` VALUES ('862', '1', '/admintest/ajax/upload', 'post', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573696536');
INSERT INTO `ea_system_log_201911` VALUES ('863', '1', '/admintest/ajax/upload', 'post', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573696546');
INSERT INTO `ea_system_log_201911` VALUES ('864', '1', '/admintest/ajax/upload', 'post', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573696724');
INSERT INTO `ea_system_log_201911` VALUES ('865', '1', '/admintest/ajax/upload', 'post', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573696997');
INSERT INTO `ea_system_log_201911` VALUES ('866', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697039');
INSERT INTO `ea_system_log_201911` VALUES ('867', '1', '/admintest/system.config/save', 'post', '', '{\"upload_type\":\"txcos\",\"upload_allow_ext\":\"doc,gif,ico,icon,jpg,mp3,mp4,p12,pem,png,rar,jpeg\",\"upload_allow_size\":\"1024000\",\"txcos_secret_id\":\"AKIDta6OQCbALQGrCI6ngKwQffR3VhicPn36\",\"txcos_secret_key\":\"VllEWYKtClAbpqfFdTqysXxGQM6rSpxq\",\"txcos_region\":\"ap-guangzhou\",\"tecos_bucket\":\"easyadmin-1251997243\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697230');
INSERT INTO `ea_system_log_201911` VALUES ('868', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697334');
INSERT INTO `ea_system_log_201911` VALUES ('869', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697353');
INSERT INTO `ea_system_log_201911` VALUES ('870', '1', '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697422');
INSERT INTO `ea_system_log_201911` VALUES ('871', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697425');
INSERT INTO `ea_system_log_201911` VALUES ('872', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697425');
INSERT INTO `ea_system_log_201911` VALUES ('873', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697572');
INSERT INTO `ea_system_log_201911` VALUES ('874', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697573');
INSERT INTO `ea_system_log_201911` VALUES ('875', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697588');
INSERT INTO `ea_system_log_201911` VALUES ('876', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697596');
INSERT INTO `ea_system_log_201911` VALUES ('877', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697616');
INSERT INTO `ea_system_log_201911` VALUES ('878', '1', '/admintest/system.uploadfile/index?page=1&limit=15&filter=%7B%22upload_type%22%3A%22local%22%7D&op=%7B%22upload_type%22%3A%22%3D%22%7D', 'get', '', '{\"page\":\"1\",\"limit\":\"15\",\"filter\":\"{\\\"upload_type\\\":\\\"local\\\"}\",\"op\":\"{\\\"upload_type\\\":\\\"=\\\"}\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697620');
INSERT INTO `ea_system_log_201911` VALUES ('879', '1', '/admintest/system.uploadfile/index?page=1&limit=15&filter=%7B%22upload_type%22%3A%22alioss%22%7D&op=%7B%22upload_type%22%3A%22%3D%22%7D', 'get', '', '{\"page\":\"1\",\"limit\":\"15\",\"filter\":\"{\\\"upload_type\\\":\\\"alioss\\\"}\",\"op\":\"{\\\"upload_type\\\":\\\"=\\\"}\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697622');
INSERT INTO `ea_system_log_201911` VALUES ('880', '1', '/admintest/system.uploadfile/index?page=1&limit=15&filter=%7B%22upload_type%22%3A%22qnoss%22%7D&op=%7B%22upload_type%22%3A%22%3D%22%7D', 'get', '', '{\"page\":\"1\",\"limit\":\"15\",\"filter\":\"{\\\"upload_type\\\":\\\"qnoss\\\"}\",\"op\":\"{\\\"upload_type\\\":\\\"=\\\"}\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697626');
INSERT INTO `ea_system_log_201911` VALUES ('881', '1', '/admintest/system.uploadfile/index?page=1&limit=15&filter=%7B%22upload_type%22%3A%22%2Ctxcos%22%7D&op=%7B%22upload_type%22%3A%22%3D%22%7D', 'get', '', '{\"page\":\"1\",\"limit\":\"15\",\"filter\":\"{\\\"upload_type\\\":\\\",txcos\\\"}\",\"op\":\"{\\\"upload_type\\\":\\\"=\\\"}\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697629');
INSERT INTO `ea_system_log_201911` VALUES ('882', '1', '/admintest/system.uploadfile/index?page=1&limit=15&filter=%7B%22upload_type%22%3A%22qnoss%22%7D&op=%7B%22upload_type%22%3A%22%3D%22%7D', 'get', '', '{\"page\":\"1\",\"limit\":\"15\",\"filter\":\"{\\\"upload_type\\\":\\\"qnoss\\\"}\",\"op\":\"{\\\"upload_type\\\":\\\"=\\\"}\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697632');
INSERT INTO `ea_system_log_201911` VALUES ('883', '1', '/admintest/system.uploadfile/index?page=1&limit=15&filter=%7B%7D&op=%7B%7D', 'get', '', '{\"page\":\"1\",\"limit\":\"15\",\"filter\":\"{}\",\"op\":\"{}\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697635');
INSERT INTO `ea_system_log_201911` VALUES ('884', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573697927');
INSERT INTO `ea_system_log_201911` VALUES ('885', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573698108');
INSERT INTO `ea_system_log_201911` VALUES ('886', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573698539');
INSERT INTO `ea_system_log_201911` VALUES ('887', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699312');
INSERT INTO `ea_system_log_201911` VALUES ('888', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699320');
INSERT INTO `ea_system_log_201911` VALUES ('889', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699323');
INSERT INTO `ea_system_log_201911` VALUES ('890', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699326');
INSERT INTO `ea_system_log_201911` VALUES ('891', '1', '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699326');
INSERT INTO `ea_system_log_201911` VALUES ('892', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699328');
INSERT INTO `ea_system_log_201911` VALUES ('893', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699329');
INSERT INTO `ea_system_log_201911` VALUES ('894', '1', '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699338');
INSERT INTO `ea_system_log_201911` VALUES ('895', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699338');
INSERT INTO `ea_system_log_201911` VALUES ('896', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699536');
INSERT INTO `ea_system_log_201911` VALUES ('897', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699537');
INSERT INTO `ea_system_log_201911` VALUES ('898', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699538');
INSERT INTO `ea_system_log_201911` VALUES ('899', '1', '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699540');
INSERT INTO `ea_system_log_201911` VALUES ('900', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699540');
INSERT INTO `ea_system_log_201911` VALUES ('901', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699541');
INSERT INTO `ea_system_log_201911` VALUES ('902', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699545');
INSERT INTO `ea_system_log_201911` VALUES ('903', '1', '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699547');
INSERT INTO `ea_system_log_201911` VALUES ('904', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699590');
INSERT INTO `ea_system_log_201911` VALUES ('905', '1', '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699592');
INSERT INTO `ea_system_log_201911` VALUES ('906', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699594');
INSERT INTO `ea_system_log_201911` VALUES ('907', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699596');
INSERT INTO `ea_system_log_201911` VALUES ('908', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699597');
INSERT INTO `ea_system_log_201911` VALUES ('909', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699598');
INSERT INTO `ea_system_log_201911` VALUES ('910', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699599');
INSERT INTO `ea_system_log_201911` VALUES ('911', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699600');
INSERT INTO `ea_system_log_201911` VALUES ('912', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699601');
INSERT INTO `ea_system_log_201911` VALUES ('913', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699601');
INSERT INTO `ea_system_log_201911` VALUES ('914', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699613');
INSERT INTO `ea_system_log_201911` VALUES ('915', '1', '/admintest/system.config/save', 'post', '', '{\"upload_type\":\"txcos\",\"upload_allow_ext\":\"doc,gif,ico,icon,jpg,mp3,mp4,p12,pem,png,rar,jpeg\",\"upload_allow_size\":\"1024000\",\"txcos_secret_id\":\"AKIDta6OQCbALQGrCI6ngKwQffR3VhicPn36\",\"txcos_secret_key\":\"VllEWYKtClAbpqfFdTqysXxGQM6rSpxq\",\"txcos_region\":\"ap-guangzhou\",\"tecos_bucket\":\"easyadmin-1251997243\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699640');
INSERT INTO `ea_system_log_201911` VALUES ('916', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699682');
INSERT INTO `ea_system_log_201911` VALUES ('917', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699767');
INSERT INTO `ea_system_log_201911` VALUES ('918', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699770');
INSERT INTO `ea_system_log_201911` VALUES ('919', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699792');
INSERT INTO `ea_system_log_201911` VALUES ('920', '1', '/admintest/system.menu/edit?id=234', 'post', '', '{\"id\":\"234\",\"pid\":\"228\",\"title\":\"菜单管理\",\"href\":\"system.menu\\/index\",\"icon\":\"fa fa-tree\",\"target\":\"_self\",\"sort\":\"0\",\"remark\":\"\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699806');
INSERT INTO `ea_system_log_201911` VALUES ('921', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699809');
INSERT INTO `ea_system_log_201911` VALUES ('922', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699813');
INSERT INTO `ea_system_log_201911` VALUES ('923', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699814');
INSERT INTO `ea_system_log_201911` VALUES ('924', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699815');
INSERT INTO `ea_system_log_201911` VALUES ('925', '1', '/admintest/ajax/clearCache.html', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699816');
INSERT INTO `ea_system_log_201911` VALUES ('926', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699817');
INSERT INTO `ea_system_log_201911` VALUES ('927', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699818');
INSERT INTO `ea_system_log_201911` VALUES ('928', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699868');
INSERT INTO `ea_system_log_201911` VALUES ('929', '1', '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699870');
INSERT INTO `ea_system_log_201911` VALUES ('930', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573699871');
INSERT INTO `ea_system_log_201911` VALUES ('931', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573709881');
INSERT INTO `ea_system_log_201911` VALUES ('932', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573709884');
INSERT INTO `ea_system_log_201911` VALUES ('933', '1', '/admintest/system.menu/getMenuTips?t=1573710211216&keywords=sy', 'get', '', '{\"t\":\"1573710211216\",\"keywords\":\"sy\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710211');
INSERT INTO `ea_system_log_201911` VALUES ('934', '1', '/admintest/system.menu/getMenuTips?t=1573710211800&keywords=sy', 'get', '', '{\"t\":\"1573710211800\",\"keywords\":\"sy\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710212');
INSERT INTO `ea_system_log_201911` VALUES ('935', '1', '/admintest/system.menu/getMenuTips?t=1573710221334&keywords=s', 'get', '', '{\"t\":\"1573710221334\",\"keywords\":\"s\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710221');
INSERT INTO `ea_system_log_201911` VALUES ('936', '1', '/admintest/system.menu/getMenuTips?t=1573710224372&keywords=sfsf', 'get', '', '{\"t\":\"1573710224372\",\"keywords\":\"sfsf\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710224');
INSERT INTO `ea_system_log_201911` VALUES ('937', '1', '/admintest/system.menu/getMenuTips?t=1573710273012&keywords=sfsf646', 'get', '', '{\"t\":\"1573710273012\",\"keywords\":\"sfsf646\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710273');
INSERT INTO `ea_system_log_201911` VALUES ('938', '1', '/admintest/system.menu/getMenuTips?t=1573710391996&keywords=sys', 'get', '', '{\"t\":\"1573710391996\",\"keywords\":\"sys\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710392');
INSERT INTO `ea_system_log_201911` VALUES ('939', '1', '/admintest/system.menu/getMenuTips?t=1573710398910&keywords=syste', 'get', '', '{\"t\":\"1573710398910\",\"keywords\":\"syste\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710399');
INSERT INTO `ea_system_log_201911` VALUES ('940', '1', '/admintest/system.menu/getMenuTips?t=1573710402907&keywords=system', 'get', '', '{\"t\":\"1573710402907\",\"keywords\":\"system\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710403');
INSERT INTO `ea_system_log_201911` VALUES ('941', '1', '/admintest/system.menu/getMenuTips?t=1573710404308&keywords=system.', 'get', '', '{\"t\":\"1573710404308\",\"keywords\":\"system.\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710404');
INSERT INTO `ea_system_log_201911` VALUES ('942', '1', '/admintest/system.menu/getMenuTips?t=1573710405155&keywords=system.men', 'get', '', '{\"t\":\"1573710405155\",\"keywords\":\"system.men\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710405');
INSERT INTO `ea_system_log_201911` VALUES ('943', '1', '/admintest/system.menu/getMenuTips?t=1573710433139&keywords=s', 'get', '', '{\"t\":\"1573710433139\",\"keywords\":\"s\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710433');
INSERT INTO `ea_system_log_201911` VALUES ('944', '1', '/admintest/system.menu/getMenuTips?t=1573710433597&keywords=sy', 'get', '', '{\"t\":\"1573710433597\",\"keywords\":\"sy\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710433');
INSERT INTO `ea_system_log_201911` VALUES ('945', '1', '/admintest/system.menu/getMenuTips?t=1573710451483&keywords=sys', 'get', '', '{\"t\":\"1573710451483\",\"keywords\":\"sys\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710451');
INSERT INTO `ea_system_log_201911` VALUES ('946', '1', '/admintest/system.menu/getMenuTips?t=1573710577475&keywords=sys', 'get', '', '{\"t\":\"1573710577475\",\"keywords\":\"sys\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710577');
INSERT INTO `ea_system_log_201911` VALUES ('947', '1', '/admintest/system.menu/getMenuTips?t=1573710620627&keywords=sys', 'get', '', '{\"t\":\"1573710620627\",\"keywords\":\"sys\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710620');
INSERT INTO `ea_system_log_201911` VALUES ('948', '1', '/admintest/system.menu/getMenuTips?t=1573710645214&keywords=system.admin%2Fmodif', 'get', '', '{\"t\":\"1573710645214\",\"keywords\":\"system.admin\\/modif\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710645');
INSERT INTO `ea_system_log_201911` VALUES ('949', '1', '/admintest/system.menu/getMenuTips?t=1573710649643&keywords=system.admin%2Fmodi', 'get', '', '{\"t\":\"1573710649643\",\"keywords\":\"system.admin\\/modi\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710650');
INSERT INTO `ea_system_log_201911` VALUES ('950', '1', '/admintest/system.menu/getMenuTips?t=1573710652480&keywords=sys', 'get', '', '{\"t\":\"1573710652480\",\"keywords\":\"sys\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710652');
INSERT INTO `ea_system_log_201911` VALUES ('951', '1', '/admintest/system.menu/getMenuTips?t=1573710654300&keywords=sysadmin', 'get', '', '{\"t\":\"1573710654300\",\"keywords\":\"sysadmin\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710654');
INSERT INTO `ea_system_log_201911` VALUES ('952', '1', '/admintest/system.menu/getMenuTips?t=1573710656387&keywords=sys', 'get', '', '{\"t\":\"1573710656387\",\"keywords\":\"sys\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710656');
INSERT INTO `ea_system_log_201911` VALUES ('953', '1', '/admintest/system.menu/getMenuTips?t=1573710657541&keywords=system', 'get', '', '{\"t\":\"1573710657541\",\"keywords\":\"system\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710657');
INSERT INTO `ea_system_log_201911` VALUES ('954', '1', '/admintest/system.menu/getMenuTips?t=1573710659219&keywords=system.admin', 'get', '', '{\"t\":\"1573710659219\",\"keywords\":\"system.admin\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710659');
INSERT INTO `ea_system_log_201911` VALUES ('955', '1', '/admintest/system.menu/getMenuTips?t=1573710703860&keywords=sya', 'get', '', '{\"t\":\"1573710703860\",\"keywords\":\"sya\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710704');
INSERT INTO `ea_system_log_201911` VALUES ('956', '1', '/admintest/system.menu/getMenuTips?t=1573710706139&keywords=sya', 'get', '', '{\"t\":\"1573710706139\",\"keywords\":\"sya\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710706');
INSERT INTO `ea_system_log_201911` VALUES ('957', '1', '/admintest/system.menu/getMenuTips?t=1573710706875&keywords=sy', 'get', '', '{\"t\":\"1573710706875\",\"keywords\":\"sy\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710707');
INSERT INTO `ea_system_log_201911` VALUES ('958', '1', '/admintest/system.menu/getMenuTips?t=1573710708796&keywords=s', 'get', '', '{\"t\":\"1573710708796\",\"keywords\":\"s\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710709');
INSERT INTO `ea_system_log_201911` VALUES ('959', '1', '/admintest/system.menu/getMenuTips?t=1573710709418&keywords=sys', 'get', '', '{\"t\":\"1573710709418\",\"keywords\":\"sys\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710709');
INSERT INTO `ea_system_log_201911` VALUES ('960', '1', '/admintest/system.menu/getMenuTips?t=1573710724156&keywords=sys', 'get', '', '{\"t\":\"1573710724156\",\"keywords\":\"sys\"}', '172.19.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', '1573710724');
INSERT INTO `ea_system_log_201911` VALUES ('961', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710885');
INSERT INTO `ea_system_log_201911` VALUES ('962', '1', '/admintest/system.menu/getMenuTips?t=1573710893403&keywords=system.uploadfile%2F', 'get', '', '{\"t\":\"1573710893403\",\"keywords\":\"system.uploadfile\\/\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710893');
INSERT INTO `ea_system_log_201911` VALUES ('963', '1', '/admintest/system.menu/getMenuTips?t=1573710893756&keywords=system.uploadfile', 'get', '', '{\"t\":\"1573710893756\",\"keywords\":\"system.uploadfile\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710893');
INSERT INTO `ea_system_log_201911` VALUES ('964', '1', '/admintest/system.menu/getMenuTips?t=1573710894636&keywords=system.uploadfile%2F', 'get', '', '{\"t\":\"1573710894636\",\"keywords\":\"system.uploadfile\\/\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710894');
INSERT INTO `ea_system_log_201911` VALUES ('965', '1', '/admintest/system.menu/getMenuTips?t=1573710901642&keywords=system.', 'get', '', '{\"t\":\"1573710901642\",\"keywords\":\"system.\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710901');
INSERT INTO `ea_system_log_201911` VALUES ('966', '1', '/admintest/system.menu/getMenuTips?t=1573710902026&keywords=system.up', 'get', '', '{\"t\":\"1573710902026\",\"keywords\":\"system.up\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710902');
INSERT INTO `ea_system_log_201911` VALUES ('967', '1', '/admintest/system.menu/getMenuTips?t=1573710904057&keywords=system', 'get', '', '{\"t\":\"1573710904057\",\"keywords\":\"system\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710904');
INSERT INTO `ea_system_log_201911` VALUES ('968', '1', '/admintest/system.menu/getMenuTips?t=1573710907450&keywords=uplo', 'get', '', '{\"t\":\"1573710907450\",\"keywords\":\"uplo\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710907');
INSERT INTO `ea_system_log_201911` VALUES ('969', '1', '/admintest/system.menu/edit?id=248', 'post', '', '{\"id\":\"248\",\"pid\":\"228\",\"title\":\"上传管理\",\"href\":\"system.uploadfile\",\"icon\":\"fa fa-arrow-up\",\"target\":\"_self\",\"sort\":\"0\",\"remark\":\"\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710922');
INSERT INTO `ea_system_log_201911` VALUES ('970', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710924');
INSERT INTO `ea_system_log_201911` VALUES ('971', '1', '/admintest/system.menu/getMenuTips?t=1573710932121&keywords=upl', 'get', '', '{\"t\":\"1573710932121\",\"keywords\":\"upl\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710932');
INSERT INTO `ea_system_log_201911` VALUES ('972', '1', '/admintest/system.menu/getMenuTips?t=1573710932706&keywords=uplo', 'get', '', '{\"t\":\"1573710932706\",\"keywords\":\"uplo\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710932');
INSERT INTO `ea_system_log_201911` VALUES ('973', '1', '/admintest/system.menu/edit?id=248', 'post', '', '{\"id\":\"248\",\"pid\":\"228\",\"title\":\"上传管理\",\"href\":\"system.uploadfile\\/index\",\"icon\":\"fa fa-arrow-up\",\"target\":\"_self\",\"sort\":\"0\",\"remark\":\"\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710937');
INSERT INTO `ea_system_log_201911` VALUES ('974', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710939');
INSERT INTO `ea_system_log_201911` VALUES ('975', '1', '/admintest/system.menu/getMenuTips?t=1573710952122&keywords=system.uploadfile%2Findex', 'get', '', '{\"t\":\"1573710952122\",\"keywords\":\"system.uploadfile\\/index\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573710952');
INSERT INTO `ea_system_log_201911` VALUES ('976', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711017');
INSERT INTO `ea_system_log_201911` VALUES ('977', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711020');
INSERT INTO `ea_system_log_201911` VALUES ('978', '1', '/admintest/system.node/refreshNode?force=1', 'get', '', '{\"force\":\"1\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711022');
INSERT INTO `ea_system_log_201911` VALUES ('979', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711025');
INSERT INTO `ea_system_log_201911` VALUES ('980', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711066');
INSERT INTO `ea_system_log_201911` VALUES ('981', '1', '/admintest/system.uploadfile/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711237');
INSERT INTO `ea_system_log_201911` VALUES ('982', '1', '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711255');
INSERT INTO `ea_system_log_201911` VALUES ('983', '1', '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711256');
INSERT INTO `ea_system_log_201911` VALUES ('984', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711258');
INSERT INTO `ea_system_log_201911` VALUES ('985', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711268');
INSERT INTO `ea_system_log_201911` VALUES ('986', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711271');
INSERT INTO `ea_system_log_201911` VALUES ('987', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711271');
INSERT INTO `ea_system_log_201911` VALUES ('988', '1', '/admintest/system.menu/getMenuTips?t=1573711278936&keywords=menu', 'get', '', '{\"t\":\"1573711278936\",\"keywords\":\"menu\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711279');
INSERT INTO `ea_system_log_201911` VALUES ('989', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573711412');
INSERT INTO `ea_system_log_201911` VALUES ('990', '1', '/admintest/ajax/initAdmin', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573712147');
INSERT INTO `ea_system_log_201911` VALUES ('991', '1', '/admintest/system.menu/index', 'get', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573712148');
INSERT INTO `ea_system_log_201911` VALUES ('992', '1', '/admintest/system.admin/index?page=1&limit=15', 'get', '', '{\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573712148');
INSERT INTO `ea_system_log_201911` VALUES ('993', '1', '/admintest/ajax/upload', 'post', '', '[]', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573712153');

-- ----------------------------
-- Table structure for ea_system_menu
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_menu`;
CREATE TABLE `ea_system_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `href` varchar(100) NOT NULL DEFAULT '' COMMENT '链接',
  `params` varchar(500) DEFAULT '' COMMENT '链接参数',
  `target` varchar(20) NOT NULL DEFAULT '_self' COMMENT '链接打开方式',
  `sort` float(11,2) DEFAULT '0.00' COMMENT '菜单排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `remark` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `href` (`href`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统菜单表';

-- ----------------------------
-- Records of ea_system_menu
-- ----------------------------
INSERT INTO `ea_system_menu` VALUES ('227', '99999999', '后台首页', 'fa fa-home', 'index/welcome', '', '_self', '0.00', '1', null, null, '1573120497', null);
INSERT INTO `ea_system_menu` VALUES ('228', '0', '系统管理', 'fa fa-cog', '', '', '_self', '0.00', '1', '', null, '1573441927', null);
INSERT INTO `ea_system_menu` VALUES ('234', '228', '菜单管理', 'fa fa-tree', 'system.menu/index', '', '_self', '0.00', '1', '', null, '1573699806', null);
INSERT INTO `ea_system_menu` VALUES ('244', '228', '管理员管理', 'fa fa-user', 'system.admin/index', '', '_self', '0.00', '1', '', '1573185011', '1573185011', null);
INSERT INTO `ea_system_menu` VALUES ('245', '228', '角色管理', 'fa fa-bitbucket-square', 'system.auth/index', '', '_self', '0.00', '1', '', '1573435877', '1573435999', null);
INSERT INTO `ea_system_menu` VALUES ('246', '228', '节点管理', 'fa fa-list', 'system.node/index', '', '_self', '0.00', '1', '', '1573435919', '1573436014', null);
INSERT INTO `ea_system_menu` VALUES ('247', '228', '配置管理', 'fa fa-asterisk', 'system.config/index', '', '_self', '0.00', '1', '', '1573457448', '1573457471', null);
INSERT INTO `ea_system_menu` VALUES ('248', '228', '上传管理', 'fa fa-arrow-up', 'system.uploadfile/index', '', '_self', '0.00', '1', '', '1573542953', '1573710937', null);
INSERT INTO `ea_system_menu` VALUES ('249', '0', '【永久开源】layuimini - 一套基于layui的纯前端后台管理模版', 'fa fa-list', '', '', '_self', '0.00', '1', '', '1573612526', '1573612533', '1573612533');

-- ----------------------------
-- Table structure for ea_system_node
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_node`;
CREATE TABLE `ea_system_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `node` varchar(100) DEFAULT NULL COMMENT '节点代码',
  `title` varchar(500) DEFAULT NULL COMMENT '节点标题',
  `type` tinyint(1) DEFAULT '3' COMMENT '节点类型（1：控制器，2：节点）',
  `is_auth` tinyint(1) unsigned DEFAULT '1' COMMENT '是否启动RBAC权限控制',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `node` (`node`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统节点表';

-- ----------------------------
-- Records of ea_system_node
-- ----------------------------
INSERT INTO `ea_system_node` VALUES ('1', 'system.admin', '管理员管理', '1', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('2', 'system.admin/index', '列表', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('3', 'system.admin/add', '添加', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('4', 'system.admin/edit', '编辑', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('5', 'system.admin/modify', '属性修改', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('6', 'system.admin/del', '删除', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('7', 'system.auth', '角色权限管理', '1', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('8', 'system.auth/authorize', '授权', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('9', 'system.auth/saveAuthorize', '授权保存', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('10', 'system.auth/index', '列表', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('11', 'system.auth/add', '添加', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('12', 'system.auth/edit', '编辑', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('13', 'system.auth/del', '删除', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('14', 'system.auth/modify', '属性修改', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('15', 'system.config', '系统配置管理', '1', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('16', 'system.config/index', '列表', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('21', 'system.menu', '菜单管理', '1', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('22', 'system.menu/index', '列表', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('23', 'system.menu/add', '添加', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('24', 'system.menu/edit', '编辑', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('25', 'system.menu/del', '删除', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('26', 'system.menu/modify', '属性修改', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('27', 'system.node', '系统节点管理', '1', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('28', 'system.node/index', '列表', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('29', 'system.node/refreshNode', '系统节点更新', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('30', 'system.node/add', '添加', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('31', 'system.node/edit', '编辑', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('32', 'system.node/del', '删除', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('33', 'system.node/modify', '属性修改', '2', '1', '2019-11-11 01:39:53', null);
INSERT INTO `ea_system_node` VALUES ('34', 'system.admin/password', '编辑', '2', '1', '2019-11-11 02:09:27', null);
INSERT INTO `ea_system_node` VALUES ('68', 'system.config/save', '保存', '2', '1', '2019-11-11 09:51:29', null);
INSERT INTO `ea_system_node` VALUES ('69', 'system.node/clearNode', '清除失效节点', '2', '1', '2019-11-11 09:51:29', null);
INSERT INTO `ea_system_node` VALUES ('70', 'system.uploadfile', '上传文件管理', '1', '1', '2019-11-12 01:37:01', null);
INSERT INTO `ea_system_node` VALUES ('71', 'system.uploadfile/index', '列表', '2', '1', '2019-11-12 01:37:01', null);
INSERT INTO `ea_system_node` VALUES ('72', 'system.uploadfile/add', '添加', '2', '1', '2019-11-12 01:37:01', null);
INSERT INTO `ea_system_node` VALUES ('73', 'system.uploadfile/edit', '编辑', '2', '1', '2019-11-12 01:37:01', null);
INSERT INTO `ea_system_node` VALUES ('74', 'system.uploadfile/del', '删除', '2', '1', '2019-11-12 01:37:01', null);
INSERT INTO `ea_system_node` VALUES ('75', 'system.uploadfile/modify', '属性修改', '2', '1', '2019-11-12 01:37:01', null);
INSERT INTO `ea_system_node` VALUES ('76', 'system.menu/getMenuTips', '添加菜单提示', '2', '1', '2019-11-14 05:57:03', null);

-- ----------------------------
-- Table structure for ea_system_uploadfile
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_uploadfile`;
CREATE TABLE `ea_system_uploadfile` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `upload_type` varchar(20) NOT NULL DEFAULT 'local' COMMENT '存储位置',
  `original_name` varchar(255) DEFAULT NULL COMMENT '文件原名',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '物理路径',
  `image_width` varchar(30) NOT NULL DEFAULT '' COMMENT '宽度',
  `image_height` varchar(30) NOT NULL DEFAULT '' COMMENT '高度',
  `image_type` varchar(30) NOT NULL DEFAULT '' COMMENT '图片类型',
  `image_frames` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片帧数',
  `mime_type` varchar(100) NOT NULL DEFAULT '' COMMENT 'mime类型',
  `file_size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `file_ext` varchar(100) DEFAULT NULL,
  `sha1` varchar(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `create_time` int(10) DEFAULT NULL COMMENT '创建日期',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `upload_time` int(10) DEFAULT NULL COMMENT '上传时间',
  PRIMARY KEY (`id`),
  KEY `upload_type` (`upload_type`),
  KEY `original_name` (`original_name`)
) ENGINE=InnoDB AUTO_INCREMENT=297 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='上传文件表';

-- ----------------------------
-- Records of ea_system_uploadfile
-- ----------------------------
INSERT INTO `ea_system_uploadfile` VALUES ('285', 'alioss', 'image/jpeg', 'http://admin.host/upload/20191111/556be91fe0c746266ca37a5efd34aa55.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('286', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/0a6de1ac058ee134301501899b84ecb1.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('287', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/46d7384f04a3bed331715e86a4095d15.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('288', 'alioss', 'image/x-icon', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/7d32671f4c1d1b01b0b28f45205763f9.ico', '', '', '', '0', 'image/x-icon', '0', 'ico', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('289', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/28cefa547f573a951bcdbbeb1396b06f.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('290', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/2c412adf1b30c8be3a913e603c7b6e4a.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('291', 'alioss', 'timg (1).jpg', 'http://easyadmin.oss-cn-shenzhen.aliyuncs.com/upload/20191113/ff793ced447febfa9ea2d86f9f88fa8e.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1573612437', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('292', 'qnoss', '22243.jpg', 'http://admin.host/upload/20191114/158524106dfe5e39559a044be1e52042.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1573696529', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('293', 'qnoss', '1f0262ed4ec486eb0f587f82694171a1.png', 'http://admin.host/upload/20191114/2afb0726ed143f6ad9e49b3a80ffa48a.png', '', '', '', '0', 'image/png', '0', 'png', '', '1573696537', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('294', 'qnoss', '22243.jpg', 'http://admin.host/upload/20191114/f6498ddeb8fab8f8bcbf7e8d52d6db5f.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1573696546', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('295', 'qnoss', '22243.jpg', 'http://q0xqzappp.bkt.clouddn.com/upload/20191114/86207af6e192a69de7fa06297f4d49ce.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1573696997', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('296', 'txcos', '22243.jpg', 'https://easyadmin-1251997243.cos.ap-guangzhou.myqcloud.com/upload/20191114/2381eaf81208ac188fa994b6f2579953.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1573712153', null, null);

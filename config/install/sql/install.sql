/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50729
Source Host           : localhost:3306
Source Database       : easyadmin

Target Server Type    : MYSQL
Target Server Version : 50729
File Encoding         : 65001

Date: 2020-04-30 14:47:15
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
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用,)',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统用户表';

-- ----------------------------
-- Records of ea_system_admin
-- ----------------------------
INSERT INTO `ea_system_admin` VALUES ('1', '', '/static/admin/images/head.jpg', 'admin', 'ed696eb5bba1f7460585cc6975e6cf9bf24903dd', 'admin', 'admin', '0', '0', '1', '1587613015', '1587614159', null);

-- ----------------------------
-- Table structure for ea_system_auth
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_auth`;
CREATE TABLE `ea_system_auth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '权限名称',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1:禁用,2:启用)',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统权限表';

-- ----------------------------
-- Records of ea_system_auth
-- ----------------------------
INSERT INTO `ea_system_auth` VALUES ('1', '管理员', '5364', '1', '测试管理员', null, '1588227411', null);
INSERT INTO `ea_system_auth` VALUES ('6', '游客权限', '68765', '1', '', null, '1588227513', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='角色与节点关系表';

-- ----------------------------
-- Records of ea_system_auth_node
-- ----------------------------
INSERT INTO `ea_system_auth_node` VALUES ('129', '6', '1');
INSERT INTO `ea_system_auth_node` VALUES ('130', '6', '2');
INSERT INTO `ea_system_auth_node` VALUES ('131', '6', '4');
INSERT INTO `ea_system_auth_node` VALUES ('132', '6', '7');
INSERT INTO `ea_system_auth_node` VALUES ('133', '6', '8');
INSERT INTO `ea_system_auth_node` VALUES ('134', '6', '15');
INSERT INTO `ea_system_auth_node` VALUES ('135', '6', '16');
INSERT INTO `ea_system_auth_node` VALUES ('136', '6', '21');
INSERT INTO `ea_system_auth_node` VALUES ('137', '6', '22');
INSERT INTO `ea_system_auth_node` VALUES ('138', '6', '23');
INSERT INTO `ea_system_auth_node` VALUES ('139', '6', '24');
INSERT INTO `ea_system_auth_node` VALUES ('140', '6', '25');
INSERT INTO `ea_system_auth_node` VALUES ('141', '6', '27');
INSERT INTO `ea_system_auth_node` VALUES ('142', '6', '28');
INSERT INTO `ea_system_auth_node` VALUES ('143', '6', '70');
INSERT INTO `ea_system_auth_node` VALUES ('144', '6', '71');

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
INSERT INTO `ea_system_config` VALUES ('41', 'alisms_access_key_id', 'sms', '填你的', '阿里大于公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('42', 'alisms_access_key_secret', 'sms', '填你的', '阿里大鱼私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('55', 'upload_type', 'upload', 'local', '当前上传方式 （local,alioss,qnoss,txoss）', '0', null, null);
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
INSERT INTO `ea_system_config` VALUES ('76', 'miniapp_appid', 'wechat', '填你的', '小程序公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('77', 'miniapp_appsecret', 'wechat', '填你的', '小程序私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('78', 'web_appid', 'wechat', '填你的', '公众号公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('79', 'web_appsecret', 'wechat', '填你的', '公众号私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('80', 'txcos_secret_id', 'upload', '填你的', '腾讯云cos密钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('81', 'txcos_secret_key', 'upload', '填你的', '腾讯云cos私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('82', 'txcos_region', 'upload', '填你的', '存储桶地域', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('83', 'tecos_bucket', 'upload', '填你的', '存储桶名称', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('84', 'qnoss_access_key', 'upload', '填你的', '访问密钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('85', 'qnoss_secret_key', 'upload', '填你的', '安全密钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('86', 'qnoss_bucket', 'upload', '填你的', '存储空间', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('87', 'qnoss_domain', 'upload', '填你的', '访问域名', '0', null, null);

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
  `sort` int(11) DEFAULT '0' COMMENT '菜单排序',
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
INSERT INTO `ea_system_menu` VALUES ('227', '99999999', '后台首页', 'fa fa-home', 'index/welcome', '', '_self', '0', '1', null, null, '1573120497', null);
INSERT INTO `ea_system_menu` VALUES ('228', '0', '系统管理', 'fa fa-cog', '', '', '_self', '0', '1', '', null, '1573441927', null);
INSERT INTO `ea_system_menu` VALUES ('234', '228', '菜单管理', 'fa fa-tree', 'system.menu/index', '', '_self', '10', '1', '', null, '1588228555', null);
INSERT INTO `ea_system_menu` VALUES ('244', '228', '管理员管理', 'fa fa-user', 'system.admin/index', '', '_self', '12', '1', '', '1573185011', '1588228573', null);
INSERT INTO `ea_system_menu` VALUES ('245', '228', '角色管理', 'fa fa-bitbucket-square', 'system.auth/index', '', '_self', '11', '1', '', '1573435877', '1588228634', null);
INSERT INTO `ea_system_menu` VALUES ('246', '228', '节点管理', 'fa fa-list', 'system.node/index', '', '_self', '9', '1', '', '1573435919', '1588228648', null);
INSERT INTO `ea_system_menu` VALUES ('247', '228', '配置管理', 'fa fa-asterisk', 'system.config/index', '', '_self', '8', '1', '', '1573457448', '1588228566', null);
INSERT INTO `ea_system_menu` VALUES ('248', '228', '上传管理', 'fa fa-arrow-up', 'system.uploadfile/index', '', '_self', '0', '1', '', '1573542953', '1588228043', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统节点表';

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
) ENGINE=InnoDB AUTO_INCREMENT=299 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='上传文件表';

-- ----------------------------
-- Records of ea_system_uploadfile
-- ----------------------------
INSERT INTO `ea_system_uploadfile` VALUES ('286', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/0a6de1ac058ee134301501899b84ecb1.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('287', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/46d7384f04a3bed331715e86a4095d15.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('288', 'alioss', 'image/x-icon', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/7d32671f4c1d1b01b0b28f45205763f9.ico', '', '', '', '0', 'image/x-icon', '0', 'ico', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('289', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/28cefa547f573a951bcdbbeb1396b06f.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('290', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/2c412adf1b30c8be3a913e603c7b6e4a.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('291', 'alioss', 'timg (1).jpg', 'http://easyadmin.oss-cn-shenzhen.aliyuncs.com/upload/20191113/ff793ced447febfa9ea2d86f9f88fa8e.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1573612437', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('296', 'txcos', '22243.jpg', 'https://easyadmin-1251997243.cos.ap-guangzhou.myqcloud.com/upload/20191114/2381eaf81208ac188fa994b6f2579953.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1573712153', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('297', 'local', 'timg.jpg', 'http://admin.host/upload/20200423/5055a273cf8e3f393d699d622b74f247.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1587614155', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('298', 'local', 'timg.jpg', 'http://admin.host/upload/20200423/243f4e59f1b929951ef79c5f8be7468a.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1587614269', null, null);

/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : easyadmin

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2019-11-12 15:22:20
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
  UNIQUE KEY `index_system_user_username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统用户表';

-- ----------------------------
-- Records of ea_system_admin
-- ----------------------------
INSERT INTO `ea_system_admin` VALUES ('1', '', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/28cefa547f573a951bcdbbeb1396b06f.jpg', 'admin', 'ed696eb5bba1f7460585cc6975e6cf9bf24903dd', 'admin', 'admin', '0', '1', null, '1573465245', null);
INSERT INTO `ea_system_admin` VALUES ('5', '6', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/2c412adf1b30c8be3a913e603c7b6e4a.jpg', 'guest', 'ed696eb5bba1f7460585cc6975e6cf9bf24903dd', 'guest', 'guest', '0', '1', '1573436175', '1573466555', null);

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
  UNIQUE KEY `index_system_auth_title` (`title`) USING BTREE,
  KEY `index_system_auth_status` (`status`) USING BTREE
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
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统配置';

-- ----------------------------
-- Records of ea_system_config
-- ----------------------------
INSERT INTO `ea_system_config` VALUES ('41', 'alisms_access_key_id', 'sms', 'LTAIdshu9dA2THSk', '阿里大于公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('42', 'alisms_access_key_secret', 'sms', '2c9PReYKkebWpglXSqKqFwRmTInaIm', '阿里大鱼私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('55', 'upload_type', 'upload', 'local', '当前上传方式 （local,alioss,qnoss,txoss）', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('56', 'upload_allow_ext', 'upload', 'doc,gif,ico,icon,jpg,mp3,mp4,p12,pem,png,rar,jpeg', '允许上传的文件类型', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('57', 'upload_allow_size', 'upload', '1024000', '允许上传的大小', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('58', 'upload_allow_mime', 'upload', 'image/gif,image/jpeg,video/x-msvideo,text/plain,image/png', '允许上传的文件mime', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('59', 'upload_allow_type', 'upload', 'local,alioss,qiniuoss,txoss', '可用的上传文件方式', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('60', 'alioss_access_key_id', 'upload', '填自的', '阿里云oss公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('61', 'alioss_access_key_secret', 'upload', '填你的', '阿里云oss私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('62', 'alioss_endpoint', 'upload', '填你的', '阿里云oss数据中心', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('63', 'alioss_bucket', 'upload', '填你的', '阿里云oss空间名称', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('64', 'alioss_domain', 'upload', '填你的', '阿里云oss访问域名', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('65', 'logo_title', 'site', 'EasyAdmin', 'LOGO标题', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('66', 'logo_image', 'site', '/favicon.ico', 'logo图片', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('68', 'site_name', 'site', 'EasyAdmin后台系统', '站点名称', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('69', 'site_ico', 'site', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/7d32671f4c1d1b01b0b28f45205763f9.ico', '浏览器图标', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('70', 'site_copyright', 'site', '©版权所有  EasyAdmin(easyadmin.99php.cn)', '版权信息', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('71', 'site_beian', 'site', '粤ICP备16006642号-2', '备案信息', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('72', 'site_version', 'site', 'beta 0.0.1', '版本信息', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('75', 'sms_type', 'sms', 'alisms', '短信类型', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('76', 'miniapp_appid', 'wechat', null, '小程序公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('77', 'miniapp_appsecret', 'wechat', null, '小程序私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('78', 'web_appid', 'wechat', null, '公众号公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('79', 'web_appsecret', 'wechat', null, '公众号私钥', '0', null, null);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=647 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='后台操作日志表 - 201911';

-- ----------------------------
-- Records of ea_system_log_201911
-- ----------------------------
INSERT INTO `ea_system_log_201911` VALUES ('640', null, '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"s\":\"\\/\\/admintest\\/system.auth\\/index\",\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573543280');
INSERT INTO `ea_system_log_201911` VALUES ('641', null, '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"s\":\"\\/\\/admintest\\/system.auth\\/index\",\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573543291');
INSERT INTO `ea_system_log_201911` VALUES ('642', null, '/admintest/system.auth/del?id=4', 'get', '', '{\"s\":\"\\/\\/admintest\\/system.auth\\/del\",\"id\":\"4\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573543294');
INSERT INTO `ea_system_log_201911` VALUES ('643', null, '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"s\":\"\\/\\/admintest\\/system.auth\\/index\",\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573543297');
INSERT INTO `ea_system_log_201911` VALUES ('644', null, '/admintest/ajax/initAdmin', 'get', '', '{\"s\":\"\\/\\/admintest\\/ajax\\/initAdmin\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573543304');
INSERT INTO `ea_system_log_201911` VALUES ('645', null, '/admintest/system.auth/index?page=1&limit=15', 'get', '', '{\"s\":\"\\/\\/admintest\\/system.auth\\/index\",\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573543305');
INSERT INTO `ea_system_log_201911` VALUES ('646', null, '/admintest/system.node/index?page=1&limit=15', 'get', '', '{\"s\":\"\\/\\/admintest\\/system.node\\/index\",\"page\":\"1\",\"limit\":\"15\"}', '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.8 Safari/537.36', '1573543309');

-- ----------------------------
-- Table structure for ea_system_menu
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_menu`;
CREATE TABLE `ea_system_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `href` varchar(400) NOT NULL DEFAULT '' COMMENT '链接',
  `params` varchar(500) DEFAULT '' COMMENT '链接参数',
  `target` varchar(20) NOT NULL DEFAULT '_self' COMMENT '链接打开方式',
  `sort` float(11,2) DEFAULT '0.00' COMMENT '菜单排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `remark` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统菜单表';

-- ----------------------------
-- Records of ea_system_menu
-- ----------------------------
INSERT INTO `ea_system_menu` VALUES ('227', '99999999', '后台首页', 'fa fa-home', 'index/welcome', '', '_self', '0.00', '1', null, null, '1573120497', null);
INSERT INTO `ea_system_menu` VALUES ('228', '0', '系统管理', 'fa fa-cog', '', '', '_self', '0.00', '1', '', null, '1573441927', null);
INSERT INTO `ea_system_menu` VALUES ('234', '228', '菜单管理', 'fa fa-window-maximize', 'system.menu/index', '', '_self', '0.00', '1', null, null, null, null);
INSERT INTO `ea_system_menu` VALUES ('244', '228', '管理员管理', 'fa fa-user', 'system.admin/index', '', '_self', '0.00', '1', '', '1573185011', '1573185011', null);
INSERT INTO `ea_system_menu` VALUES ('245', '228', '角色管理', 'fa fa-bitbucket-square', 'system.auth/index', '', '_self', '0.00', '1', '', '1573435877', '1573435999', null);
INSERT INTO `ea_system_menu` VALUES ('246', '228', '节点管理', 'fa fa-list', 'system.node/index', '', '_self', '0.00', '1', '', '1573435919', '1573436014', null);
INSERT INTO `ea_system_menu` VALUES ('247', '228', '配置管理', 'fa fa-asterisk', 'system.config/index', '', '_self', '0.00', '1', '', '1573457448', '1573457471', null);
INSERT INTO `ea_system_menu` VALUES ('248', '228', '上传管理', 'fa fa-arrow-up', 'system.uploadfile/index', '', '_self', '0.00', '1', '', '1573542953', '1573542953', null);

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
  KEY `index_system_node_node` (`node`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统节点表';

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=291 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='上传文件表';

-- ----------------------------
-- Records of ea_system_uploadfile
-- ----------------------------
INSERT INTO `ea_system_uploadfile` VALUES ('285', 'alioss', 'image/jpeg', 'http://admin.host/upload/20191111/556be91fe0c746266ca37a5efd34aa55.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('286', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/0a6de1ac058ee134301501899b84ecb1.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('287', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/46d7384f04a3bed331715e86a4095d15.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('288', 'alioss', 'image/x-icon', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/7d32671f4c1d1b01b0b28f45205763f9.ico', '', '', '', '0', 'image/x-icon', '0', 'ico', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('289', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/28cefa547f573a951bcdbbeb1396b06f.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('290', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/2c412adf1b30c8be3a913e603c7b6e4a.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);

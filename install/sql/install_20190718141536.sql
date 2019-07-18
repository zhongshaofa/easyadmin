-- ----------------------------
-- 备份日期：2019-07-18 14:15:36
-- ----------------------------

-- ----------------------------
-- Table structure for `system_admin`
-- ----------------------------
DROP TABLE IF EXISTS `system_admin`;
CREATE TABLE `system_admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth_ids` varchar(500) DEFAULT NULL COMMENT '角色权限ID',
  `head_img` varchar(255) DEFAULT NULL COMMENT '头像',
  `nickname` varchar(100) DEFAULT NULL COMMENT '昵称',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户登录名',
  `password` char(40) NOT NULL DEFAULT '' COMMENT '用户登录密码',
  `email` varchar(32) DEFAULT NULL COMMENT '联系邮箱',
  `is_super` tinyint(1) DEFAULT '0' COMMENT '是否为超级管理员（0：否，1：是）',
  `login_num` int(11) unsigned DEFAULT '0' COMMENT '登录次数',
  `last_login_time` datetime DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用,)',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  `deletetime` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_system_user_username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统用户表';

-- ----------------------------
-- Table structure for `system_auth`
-- ----------------------------
DROP TABLE IF EXISTS `system_auth`;
CREATE TABLE `system_auth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '权限名称',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1:禁用,2:启用)',
  `sort` smallint(6) unsigned DEFAULT '0' COMMENT '排序权重',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_system_auth_title` (`name`) USING BTREE,
  KEY `index_system_auth_status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统角色表';

-- ----------------------------
-- Table structure for `system_auth_node`
-- ----------------------------
DROP TABLE IF EXISTS `system_auth_node`;
CREATE TABLE `system_auth_node` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth_id` int(20) unsigned DEFAULT NULL COMMENT '角色ID',
  `node_id` int(20) DEFAULT NULL COMMENT '节点ID',
  PRIMARY KEY (`id`),
  KEY `index_system_auth_auth` (`auth_id`) USING BTREE,
  KEY `index_system_auth_node` (`node_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='角色-节点关系表';

-- ----------------------------
-- Table structure for `system_config`
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统配置';

-- ----------------------------
-- Table structure for `system_menu`
-- ----------------------------
DROP TABLE IF EXISTS `system_menu`;
CREATE TABLE `system_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '上级',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `href` varchar(400) NOT NULL DEFAULT '' COMMENT '链接',
  `target` varchar(20) NOT NULL DEFAULT '_self' COMMENT '链接打开方式',
  `is_home` tinyint(1) DEFAULT '0' COMMENT '是否为首页',
  `sort` float(11,2) DEFAULT '0.00' COMMENT '菜单排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `createtime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统菜单表';

-- ----------------------------
-- Table structure for `system_node`
-- ----------------------------
DROP TABLE IF EXISTS `system_node`;
CREATE TABLE `system_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `node` varchar(100) DEFAULT NULL COMMENT '节点代码',
  `title` varchar(500) DEFAULT NULL COMMENT '节点标题',
  `is_auth` tinyint(1) unsigned DEFAULT '1' COMMENT '是否启动RBAC权限控制',
  `is_auto` tinyint(1) DEFAULT '0' COMMENT '是否为系统自动刷新（0：是，1：手动添加）',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `index_system_node_node` (`node`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统节点表';

-- ----------------------------
-- Records for `system_admin`
-- ----------------------------
INSERT INTO `system_admin` VALUES ('1', '1,6', '/static/image/admin/face1.jpg', '', 'admin', 'a33b679d5581a8692988ec9f92ad2d6a2259eaa7', 'zhongshaofa@qq.com', '1', '22499', '2018-04-17 20:58:27', '1', '', '', '');

-- ----------------------------
-- Records for `system_auth`
-- ----------------------------
INSERT INTO `system_auth` VALUES ('1', '管理员', '1', '3', '', '');
INSERT INTO `system_auth` VALUES ('4', '超级管理员', '0', '1', '', '');
INSERT INTO `system_auth` VALUES ('6', '测试权限', '1', '0', '', '');

-- ----------------------------
-- Records for `system_auth_node`
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
-- Records for `system_config`
-- ----------------------------
INSERT INTO `system_config` VALUES ('1', 'ManageName', 'basic', 'string', '久久社区管理系统', '后台名称', '0', '2018-07-17 17:27:27', '0', '2018-07-17 22:10:33', '');
INSERT INTO `system_config` VALUES ('2', 'Beian', 'basic', 'string', '粤ICP备18074801号-1', '备案号', '4', '2018-07-17 17:27:27', '0', '2018-07-17 22:10:39', '');
INSERT INTO `system_config` VALUES ('18', 'FooterName', 'basic', 'string', 'Copyright © 2018-2019 九九PHP社区', '底部网站标识', '5', '2018-07-17 17:27:27', '0', '2018-07-17 18:40:16', '');
INSERT INTO `system_config` VALUES ('19', 'BeianUrl', 'basic', 'string', 'http://www.miitbeian.gov.cn', '备案查询链接', '2', '2018-07-17 17:30:39', '0', '2018-07-17 17:31:22', '');
INSERT INTO `system_config` VALUES ('20', 'HomeUrl', 'basic', 'string', 'https://www.99php.cn', '网站首页', '0', '2018-07-17 18:45:59', '0', '2018-07-17 18:46:12', '');
INSERT INTO `system_config` VALUES ('21', 'VercodeType', 'basic', 'tinyint', '0', '验证码登录开关（0：不开启，1：开启）', '3', '2018-07-17 21:52:00', '0', '2018-07-18 02:38:10', '');
INSERT INTO `system_config` VALUES ('32', 'Describe', 'basic', 'string', 'RBAC后台权限控制系统', '网站描述', '9', '2018-07-30 23:01:34', '0', '', '');
INSERT INTO `system_config` VALUES ('33', 'Author', 'basic', 'string', 'Mr.Chung', '作者', '15', '2018-07-30 23:02:41', '0', '', '');
INSERT INTO `system_config` VALUES ('34', 'Email', 'basic', 'string', 'chung@99php.cn', '联系邮箱', '8', '2018-07-30 23:03:15', '0', '', '');
INSERT INTO `system_config` VALUES ('35', 'BlogFooterName', 'basic', 'string', 'Copyright © 2018-2019 99PHP社区', '博客底部', '0', '2018-08-13 00:32:50', '0', '', '');
INSERT INTO `system_config` VALUES ('36', 'MailHost', 'mail', 'string', 'smtp.163.com', '发送方的SMTP服务器地址', '0', '2018-08-31 15:39:04', '0', '', '');
INSERT INTO `system_config` VALUES ('37', 'MailUsername', 'mail', 'string', 'www99php@163.com', '发送方的QQ邮箱用户名', '0', '2018-08-31 15:39:43', '0', '', '');
INSERT INTO `system_config` VALUES ('38', 'MailPassword', 'mail', 'string', 'a28cd1bedd7473f4', '第三方授权登录码', '0', '2018-08-31 15:39:53', '0', '', '');
INSERT INTO `system_config` VALUES ('39', 'MailNickname', 'mail', 'string', '久久PHP社区', '设置发件人昵称', '0', '2018-08-31 15:40:44', '0', '', '');
INSERT INTO `system_config` VALUES ('40', 'MailReplyTo', 'mail', 'string', 'www99php@163.com', '回复邮件地址', '0', '2018-08-31 15:41:03', '0', '', '');
INSERT INTO `system_config` VALUES ('41', 'AccessKeyId', 'sms', 'string', '', '阿里大于公钥', '0', '2018-08-31 23:58:34', '0', '', '');
INSERT INTO `system_config` VALUES ('42', 'AccessKeySecret', 'sms', 'string', '', '阿里大鱼私钥', '0', '2018-08-31 23:58:45', '0', '', '');
INSERT INTO `system_config` VALUES ('43', 'SignName', 'sms', 'string', '久久PHP', '短信注册模板', '0', '2018-09-01 00:08:55', '0', '', '');
INSERT INTO `system_config` VALUES ('44', 'CodeTime', 'code', 'int', '60', '验证码发送间隔时间', '0', '2018-09-04 18:03:52', '0', '', '');
INSERT INTO `system_config` VALUES ('45', 'CodeDieTime', 'code', 'int', '300', '验证码有效期', '0', '2018-09-04 18:17:26', '0', '', '');
INSERT INTO `system_config` VALUES ('46', 'FileType', 'file', 'int', '1', '文件保存方法（1：本地，2：七牛云）', '0', '2018-09-17 11:44:12', '0', '', '');
INSERT INTO `system_config` VALUES ('47', 'FileKey', 'file', 'string', '690c7175d2b4439646b437b8b48f92fb147eccf0', '文件路径加密秘钥（www.99php.cn）', '0', '2018-09-17 16:51:29', '0', '', '');
INSERT INTO `system_config` VALUES ('48', 'LoginDuration', 'basic', 'int', '3600', '后台登录有效时间', '0', '2018-09-30 01:02:53', '0', '', '');

-- ----------------------------
-- Records for `system_menu`
-- ----------------------------
INSERT INTO `system_menu` VALUES ('1', '0', '首页', 'fa fa-home', 'admin/index/welcome', '_self', '1', '0', '1', '', '');
INSERT INTO `system_menu` VALUES ('228', '0', '系统管理', 'fa fa-gears', '', '_self', '0', '0', '1', '', '');
INSERT INTO `system_menu` VALUES ('242', '228', '常规管理', 'fa fa-gears', '', '_self', '0', '0', '1', '', '');
INSERT INTO `system_menu` VALUES ('243', '242', '系统设置', 'fa fa-gears', 'admin/system.setting/index', '_self', '0', '0', '1', '', '');
INSERT INTO `system_menu` VALUES ('246', '228', '权限管理', 'fa fa-gears', '', '_self', '0', '0', '1', '', '');
INSERT INTO `system_menu` VALUES ('247', '246', '管理员列表', 'fa fa-gears', 'admin/system.admin/index', '_self', '0', '0', '1', '', '');
INSERT INTO `system_menu` VALUES ('248', '246', '菜单管理', 'fa fa-gears', 'admin/system.menu/index', '_self', '0', '0', '1', '', '');
INSERT INTO `system_menu` VALUES ('249', '246', '权限角色', 'fa fa-gears', 'admin/system.auth/index', '_self', '0', '0', '1', '', '');
INSERT INTO `system_menu` VALUES ('250', '246', '系统节点', 'fa fa-gears', 'admin/system.node/index', '_self', '0', '0', '1', '', '');

-- ----------------------------
-- Records for `system_node`
-- ----------------------------
INSERT INTO `system_node` VALUES ('67', 'admin', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('68', 'admin/ajax', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('69', 'admin/ajax/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('70', 'admin/ajax/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('71', 'admin/ajax/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('72', 'admin/ajax/del', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('73', 'admin/asddfs_vfggd', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('74', 'admin/asddfs_vfggd/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('75', 'admin/asddfs_vfggd/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('76', 'admin/asddfs_vfggd/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('77', 'admin/asddfs_vfggd/del', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('78', 'admin/form', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('79', 'admin/form/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('80', 'admin/form/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('81', 'admin/form/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('82', 'admin/form/del', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('83', 'admin/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('84', 'admin/index/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('85', 'admin/index/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('86', 'admin/index/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('87', 'admin/index/del', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('88', 'admin/login', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('89', 'admin/login/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('90', 'admin/login/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('91', 'admin/login/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('92', 'admin/login/del', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('93', 'admin/system.admin', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('94', 'admin/system.admin/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('95', 'admin/system.admin/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('96', 'admin/system.admin/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('97', 'admin/system.admin/del', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('98', 'admin/system.auth', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('99', 'admin/system.auth/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('100', 'admin/system.auth/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('101', 'admin/system.auth/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('102', 'admin/system.auth/del', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('103', 'admin/system.menu', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('104', 'admin/system.menu/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('105', 'admin/system.menu/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('106', 'admin/system.menu/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('107', 'admin/system.menu/del', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('108', 'admin/system.node', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('109', 'admin/system.node/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('110', 'admin/system.node/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('111', 'admin/system.node/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('112', 'admin/system.node/del', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('113', 'admin/system.demo.test', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('114', 'admin/system.demo.test/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('115', 'admin/system.demo.test/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('116', 'admin/system.demo.test/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('117', 'admin/system.demo.test/del', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('118', 'admin/wechat.config', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('119', 'admin/wechat.config/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('120', 'admin/wechat.config/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('121', 'admin/wechat.config/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('122', 'admin/wechat.config/del', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('123', 'admin/wechat.fans', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('124', 'admin/wechat.fans/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('125', 'admin/wechat.fans/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('126', 'admin/wechat.fans/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('127', 'admin/wechat.fans/del', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('128', 'admin/wechat.menu', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('129', 'admin/wechat.menu/index', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('130', 'admin/wechat.menu/add', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('131', 'admin/wechat.menu/edit', '', '1', '0', '1563359926', '');
INSERT INTO `system_node` VALUES ('132', 'admin/wechat.menu/del', '', '1', '0', '1563359926', '');


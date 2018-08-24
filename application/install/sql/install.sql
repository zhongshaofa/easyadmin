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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='系统权限表';

-- ----------------------------
-- Records of system_auth
-- ----------------------------
INSERT INTO `system_auth` VALUES ('1', '管理员', '1', '3', '测试管理员', '0', '2018-03-17 15:59:46', '2018-08-07 10:26:57', null);
INSERT INTO `system_auth` VALUES ('4', '超级管理员', '1', '1', '不受权限控制', '0', '2018-01-23 13:28:14', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8 COMMENT='角色与节点关系表';

-- ----------------------------
-- Records of system_auth_node
-- ----------------------------
INSERT INTO `system_auth_node` VALUES ('37', '5', '532');
INSERT INTO `system_auth_node` VALUES ('38', '5', '527');
INSERT INTO `system_auth_node` VALUES ('39', '5', '536');
INSERT INTO `system_auth_node` VALUES ('132', '6', '1050');
INSERT INTO `system_auth_node` VALUES ('133', '6', '1051');
INSERT INTO `system_auth_node` VALUES ('134', '6', '1053');
INSERT INTO `system_auth_node` VALUES ('135', '6', '1059');
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
INSERT INTO `system_auth_node` VALUES ('226', '1', '1059');
INSERT INTO `system_auth_node` VALUES ('227', '1', '1063');
INSERT INTO `system_auth_node` VALUES ('228', '1', '1109');
INSERT INTO `system_auth_node` VALUES ('229', '1', '1065');
INSERT INTO `system_auth_node` VALUES ('230', '1', '1066');
INSERT INTO `system_auth_node` VALUES ('231', '1', '1071');
INSERT INTO `system_auth_node` VALUES ('232', '1', '1073');
INSERT INTO `system_auth_node` VALUES ('233', '1', '1072');
INSERT INTO `system_auth_node` VALUES ('234', '1', '1074');
INSERT INTO `system_auth_node` VALUES ('235', '1', '1070');
INSERT INTO `system_auth_node` VALUES ('236', '1', '1075');
INSERT INTO `system_auth_node` VALUES ('237', '1', '1114');

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='系统配置';

-- ----------------------------
-- Records of system_config
-- ----------------------------
INSERT INTO `system_config` VALUES ('1', 'ManageName', 'basic', 'string', '久久PHP管理系统', '后台名称', '0', '2018-07-17 17:27:27', '0', '2018-07-17 22:10:33', null);
INSERT INTO `system_config` VALUES ('2', 'Beian', 'basic', 'string', '粤ICP备18074801号-1', '备案号', '4', '2018-07-17 17:27:27', '0', '2018-07-17 22:10:39', null);
INSERT INTO `system_config` VALUES ('18', 'FooterName', 'basic', 'string', 'Copyright © 2018-2019 九九PHP社区', '底部网站标识', '5', '2018-07-17 17:27:27', '0', '2018-07-17 18:40:16', null);
INSERT INTO `system_config` VALUES ('19', 'BeianUrl', 'basic', 'string', 'http://www.miitbeian.gov.cn', '备案查询链接', '2', '2018-07-17 17:30:39', '0', '2018-07-17 17:31:22', null);
INSERT INTO `system_config` VALUES ('20', 'HomeUrl', 'basic', 'string', 'https://www.99php.cn', '网站首页', '1', '2018-07-17 18:45:59', '0', '2018-07-17 18:46:12', null);
INSERT INTO `system_config` VALUES ('21', 'VercodeType', 'basic', 'tinyint', '0', '验证码登录开关（0：不开启，1：开启）', '3', '2018-07-17 21:52:00', '0', '2018-07-18 02:38:10', null);
INSERT INTO `system_config` VALUES ('32', 'Describe', 'basic', 'string', 'RBAC后台权限控制系统a', '网站描述', '9', '2018-07-30 23:01:34', '0', null, null);
INSERT INTO `system_config` VALUES ('33', 'Author', 'basic', 'string', 'Mr.Chung', '作者', '6', '2018-07-30 23:02:41', '0', null, null);
INSERT INTO `system_config` VALUES ('34', 'Email', 'basic', 'string', 'chung@99php.cn', '联系邮箱', '8', '2018-07-30 23:03:15', '0', null, null);

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
  `sort` int(11) unsigned DEFAULT '0' COMMENT '菜单排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `remark` varchar(255) DEFAULT NULL,
  `create_by` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_system_menu_node` (`node`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8 COMMENT='系统菜单表';

-- ----------------------------
-- Records of system_menu
-- ----------------------------
INSERT INTO `system_menu` VALUES ('1', '0', '后台首页', '0', '', '&#xe68e;', 'admin/index/welcome', '', '_self', '0', '1', '', '0', '2018-07-21 13:28:32', null, null);
INSERT INTO `system_menu` VALUES ('140', '0', '内容管理', '0', '', '&#xe63c;', '#', '', '_self', '3', '0', '', '0', '2018-07-17 03:09:09', null, null);
INSERT INTO `system_menu` VALUES ('141', '0', '用户中心', '0', '', '&#xe770;', '#', '', '_self', '10', '0', '', '0', '2018-07-17 03:09:16', null, null);
INSERT INTO `system_menu` VALUES ('142', '0', '系统设置', '0', '', '&#xe620;', '#', '', '_self', '2', '1', null, '0', '2018-07-17 03:09:41', null, null);
INSERT INTO `system_menu` VALUES ('143', '0', '使用文档', '0', '', '&#xe705;', '#', '', '_self', '3', '0', null, '0', '2018-07-17 03:09:49', null, null);
INSERT INTO `system_menu` VALUES ('144', '140', '文章列表', '0', '', '&#xe705;', 'static/layuicms/page/news/newsList.html', '', '_self', '0', '1', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('147', '140', '图片管理', '0', '', '&#xe634;', 'static/layuicms/page/img/images.html', '', '_self', '0', '1', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('148', '140', '其他页面', '0', '', '&#xe630;', 'static/layuicms/', '', '_self', '1', '1', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('149', '148', '404页面', '0', '', '&#x1006;', 'static/layuicms/page/404.html', '', '_self', '0', '1', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('150', '148', '登录', '0', '', '&#xe609;', 'static/layuicms/page/login/login.html', '', '_blank', '0', '1', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('151', '141', '用户中心', '0', '', '&#xe612;', 'static/layuicms/page/user/userList.html', '', '_self', '0', '1', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('152', '141', '会员等级', '0', '', 'icon-vip', 'static/layuicms/page/user/userGrade.html', '', '_self', '0', '1', null, '0', '2018-07-17 03:10:50', null, null);
INSERT INTO `system_menu` VALUES ('153', '142', '系统基本参数', '0', '', '&#xe631', 'static/layuicms/page/systemSetting/basicParameter.html', '', '_self', '4', '0', null, '0', '2018-07-17 10:45:53', null, null);
INSERT INTO `system_menu` VALUES ('154', '142', '系统日志', '0', '', 'icon-log', 'static/layuicms/page/systemSetting/logs.html', '', '_self', '3', '0', null, '0', '2018-07-17 10:46:59', null, null);
INSERT INTO `system_menu` VALUES ('155', '142', '友情链接', '0', '', '&#xe64c;', 'static/layuicms/page/systemSetting/linkList.html', '', '_self', '3', '0', null, '0', '2018-07-17 10:47:13', null, null);
INSERT INTO `system_menu` VALUES ('156', '142', '图标管理', '0', '', '&#xe857;', 'static/layuicms/page/systemSetting/icons.html', '', '_self', '6', '0', null, '0', '2018-07-17 10:47:34', null, null);
INSERT INTO `system_menu` VALUES ('157', '143', '三级联动模块', '0', '', 'icon-mokuai', 'static/layuicms/page/doc/addressDoc.html', '', '_self', '0', '1', null, '0', '2018-07-17 10:48:02', null, null);
INSERT INTO `system_menu` VALUES ('158', '143', 'bodyTab模块', '0', '', 'icon-mokuai', 'static/layuicms/page/doc/bodyTabDoc.html', '', '_self', '0', '1', null, '0', '2018-07-17 10:48:19', null, null);
INSERT INTO `system_menu` VALUES ('159', '143', '三级菜单', '0', '', 'icon-mokuai', 'static/layuicms/page/doc/navDoc.html', '', '_self', '0', '1', null, '0', '2018-07-17 10:48:39', null, null);
INSERT INTO `system_menu` VALUES ('163', '167', '管理员列表', '0', '', 'icon-icon10', 'admin/user/index', '', '_self', '1', '1', '', '0', '2018-07-18 01:15:16', null, null);
INSERT INTO `system_menu` VALUES ('164', '167', '菜单配置', '0', '', 'icon-caidan', 'admin/menu/index', '', '_self', '1', '1', '', '0', '2018-07-19 02:05:48', null, null);
INSERT INTO `system_menu` VALUES ('165', '169', '刷新缓存', '0', '', '&#xe9aa;', 'admin/system/refresh', '', '_self', '5', '1', '', '0', '2018-07-19 10:11:27', null, null);
INSERT INTO `system_menu` VALUES ('166', '168', '系统节点', '0', '', '&#xe631;', 'admin/node/index', '', '_self', '5', '1', '', '0', '2018-07-23 00:44:49', null, null);
INSERT INTO `system_menu` VALUES ('167', '142', '系统管理', '0', '', '&#xe716;', '#', '', '_self', '0', '1', '', '0', '2018-07-23 01:23:11', null, null);
INSERT INTO `system_menu` VALUES ('168', '142', '权限管理', '0', '', '&#xe857;', '#', '', '_self', '2', '1', '', '0', '2018-07-23 01:23:27', null, null);
INSERT INTO `system_menu` VALUES ('169', '142', '系统刷新', '0', '', '&#xe639;', '#', '', '_self', '3', '1', '', '0', '2018-07-23 01:26:30', null, null);
INSERT INTO `system_menu` VALUES ('171', '168', '角色权限', '0', '', '&#xe606;', 'admin/auth/index', '', '_self', '0', '1', '', '0', '2018-07-23 15:37:53', null, null);
INSERT INTO `system_menu` VALUES ('172', '169', '刷新节点', '0', '', '&#xe666;', 'admin/system/refresh_node', '', '_self', '1', '1', '', '0', '2018-07-25 22:06:45', null, null);
INSERT INTO `system_menu` VALUES ('173', '169', '清除节点', '0', '', '&#xe639;', 'admin/system/clear_node', '', '_self', '0', '1', '', '0', '2018-07-26 15:27:24', null, null);
INSERT INTO `system_menu` VALUES ('175', '167', '系统配置', '0', '', '&#xe663;', 'admin/config/index', '', '_self', '5', '1', '', '0', '2018-07-31 00:11:14', '2018-08-01 11:28:42', null);

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
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` bigint(20) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_system_node_node` (`node`)
) ENGINE=InnoDB AUTO_INCREMENT=1117 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统节点表';

-- ----------------------------
-- Records of system_node
-- ----------------------------
INSERT INTO `system_node` VALUES ('1037', 'admin', '后台模块管理', '1', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1040', 'admin/auth', '角色管理', '2', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1041', 'admin/auth/index', '角色列表', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1042', 'admin/auth/add', '添加角色', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1043', 'admin/auth/edit', '编辑角色', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1044', 'admin/auth/del', '删除角色', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1045', 'admin/auth/status', '更改角色状态', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1046', 'admin/auth/authorize', '角色授权', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1047', 'admin/icon', '系统图标管理', '2', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1048', 'admin/icon/index', '图标列表', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1049', 'admin/index', '系统后台首页（不要开启）', '2', '0', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1050', 'admin/index/index', '后台首页（不要开启）', '3', '0', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1051', 'admin/index/welcome', '后台欢迎页面（不要开启）', '3', '0', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1052', 'admin/menu', '系统菜单管理', '2', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1053', 'admin/menu/index', '菜单列表', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1054', 'admin/menu/add', '添加菜单', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1055', 'admin/menu/edit', '编辑菜单', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1056', 'admin/menu/del', '删除菜单', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1057', 'admin/menu/status', '更改菜单状态', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1058', 'admin/node', '节点管理', '2', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1059', 'admin/node/index', '节点列表', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1063', 'admin/node/status', '更改节点状态', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1064', 'admin/system', '系统管理', '2', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1065', 'admin/system/refresh', '刷新缓存', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1066', 'admin/system/refresh_node', '刷新节点', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1069', 'admin/user', '系统管理员管理', '2', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1070', 'admin/user/index', '管理员列表', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1071', 'admin/user/add', '添加管理员', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1072', 'admin/user/edit', '编辑管理员', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1073', 'admin/user/del', '删除管理员', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1074', 'admin/user/edit_password', '修改管理员密码', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1075', 'admin/user/status', '更改管理员状态', '3', '1', '2018-07-26 02:51:09', null, null, null);
INSERT INTO `system_node` VALUES ('1081', 'index', '前台管理', '1', '0', '2018-07-26 10:52:22', null, null, null);
INSERT INTO `system_node` VALUES ('1082', 'index/index', null, '2', '0', '2018-07-26 10:52:22', null, null, null);
INSERT INTO `system_node` VALUES ('1083', 'index/index/index', null, '3', '0', '2018-07-26 10:52:22', null, null, null);
INSERT INTO `system_node` VALUES ('1084', 'common', '公共模块', '1', '0', '2018-07-26 13:03:04', null, null, null);
INSERT INTO `system_node` VALUES ('1085', 'common/admin_controller', null, '2', '0', '2018-07-26 13:03:04', null, null, null);
INSERT INTO `system_node` VALUES ('1109', 'admin/system/clear_node', '清除节点', '3', '1', '2018-07-26 15:29:55', null, null, null);
INSERT INTO `system_node` VALUES ('1113', 'admin/config', '系统配置管理', '2', '1', '2018-07-31 01:00:16', null, null, null);
INSERT INTO `system_node` VALUES ('1114', 'admin/config/index', '系统配置列表', '3', '1', '2018-07-31 01:00:16', null, null, null);
INSERT INTO `system_node` VALUES ('1115', 'admin/test', null, '2', '0', '2018-08-06 22:27:17', null, null, null);
INSERT INTO `system_node` VALUES ('1116', 'admin/test/index', null, '3', '0', '2018-08-06 22:27:17', null, null, null);

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
  `create_by` bigint(20) unsigned DEFAULT NULL COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_by` bigint(20) DEFAULT NULL COMMENT '更新人',
  `update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_system_user_username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10016 DEFAULT CHARSET=utf8 COMMENT='系统用户表';

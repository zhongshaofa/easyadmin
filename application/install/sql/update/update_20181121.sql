-- ----------------------------
-- 新增用户头像
-- ----------------------------
ALTER TABLE `system_user` ADD COLUMN `head_img`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '/static/image/admin/face1.jpg' COMMENT '头像' AFTER `auth_id`;

-- ----------------------------
-- 新增采集配置信息
-- ----------------------------
INSERT INTO `system_config` (`name`, `group`, `type`, `value`, `remark`, `sort`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES ('spider_access_key', 'spider', 'string', 'asdfmigshjogsn', '采集接口公钥', '0', '2018-11-19 10:46:26', '0', NULL, NULL);
INSERT INTO `system_config` (`name`, `group`, `type`, `value`, `remark`, `sort`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES ('spider_secret_key', 'spider', 'string', 'twjtrowmlca', '采集接口私钥', '0', '2018-11-19 10:46:36', '0', NULL, NULL);
INSERT INTO `system_config` (`name`, `group`, `type`, `value`, `remark`, `sort`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES ('spider_url', 'spider', 'string', 'http://spider.99php.cn/api/article/index.html', '采集接口地址', '0', '2018-11-19 10:46:46', '0', NULL, NULL);

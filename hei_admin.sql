/* 
 * hei_admin sql
 */
/**
 * Author:  madison
 * Created: 2016-9-10
 */

CREATE TABLE `hei_admin`
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `user_name` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '用户名',
    `password`  VARCHAR(60) NOT NULL DEFAULT '' COMMENT '密码',
    `last_ip`  VARCHAR(16)  NOT NULL DEFAULT '0.0.0.0' COMMENT '最后一次登录的IP',
    `last_time`  INT(11)  NOT NULL DEFAULT 0 COMMENT '最后一次登录的时间',
    `create_id` INT(11) NOT NULL DEFAULT 0 COMMENT '创建者ID',
    `create_time` INT(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_time` INT(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用',
    key (`user_name`)
 ) CHARSET=UTF8 COMMENT '后台用户表-小黑科技';

CREATE TABLE `hei_admin_info`
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `admin_id` INT(11) NOT NULL DEFAULT 0 COMMENT '用户ID',
    `true_name` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '真实名字',
    `photo`     VARCHAR(255) NOT NULL DEFAULT '' COMMENT '用户头像',
    `email`  VARCHAR(255) NOT NULL DEFAULT '' COMMENT '邮箱',
    `mobile`  CHAR(11) NOT NULL DEFAULT '' COMMENT '手机号',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用'
 ) CHARSET=UTF8 COMMENT '后台用户信息表-小黑科技';

CREATE TABLE `hei_auth`
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `url` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '菜单地址',
    `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '菜单名称',
    `icon`     VARCHAR(255) NOT NULL DEFAULT '' COMMENT '菜单类名',
    `parent_id`  INT NOT NULL DEFAULT 0 COMMENT '父id',
    `order_by`  INT NOT NULL DEFAULT 0 COMMENT '排序 数字越高越靠前',
    `create_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `create_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `update_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用'
 ) CHARSET=UTF8 COMMENT '后台权限表-小黑科技';
INSERT INTO `hei_auth` (`url`,`name`,`icon`,`parent_id`) values ('main','首页','home',0);
CREATE TABLE `hei_role`
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '角色名称',
    `create_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `create_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `update_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用'
 ) CHARSET=UTF8 COMMENT '后台角色-小黑科技';

CREATE TABLE `hei_group`
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '组名称',
    `parent_id` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '父id',
    `create_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `create_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `update_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用'
 ) CHARSET=UTF8 COMMENT '后台组-小黑科技';

CREATE TABLE `hei_admin_group`
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `admin_id` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '用户id',
    `group_id` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '组id',
    `is_leader` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '是否是组长 1 组长 0 组员',
    `create_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `create_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `update_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用'
 ) CHARSET=UTF8 COMMENT '后台组-小黑科技';

CREATE TABLE `hei_group_role`
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `group_id` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '组id',
    `role_id` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '角色id',
    `create_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `create_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `update_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用'
 ) CHARSET=UTF8 COMMENT '后台组-小黑科技';

CREATE TABLE `hei_group_auth`
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `group_id`  INT NOT NULL DEFAULT 0 COMMENT '组id',
    `role_id`  INT NOT NULL DEFAULT 0 COMMENT '角色id',
    `create_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `create_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `update_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用'
 ) CHARSET=UTF8 COMMENT '后台用户权限关联表-小黑科技';

CREATE TABLE `hei_admin_role`
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `admin_id`  INT NOT NULL DEFAULT 0 COMMENT '用户id',
    `role_id`  INT NOT NULL DEFAULT 0 COMMENT '角色id',
    `create_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `create_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `update_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用'
 ) CHARSET=UTF8 COMMENT '后台管理员角色关联表-小黑科技';

CREATE TABLE `hei_role_auth`
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `auth_id`  INT NOT NULL DEFAULT 0 COMMENT '权限id',
    `role_id`  INT NOT NULL DEFAULT 0 COMMENT '角色id',
    `create_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `create_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `update_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用'
 ) CHARSET=UTF8 COMMENT '后台角色权限关联表-小黑科技';

CREATE TABLE `hei_admin_auth`
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `admin_id`  INT NOT NULL DEFAULT 0 COMMENT '用户id',
    `role_id`  INT NOT NULL DEFAULT 0 COMMENT '角色id',
    `create_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `create_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_id`  INT NOT NULL DEFAULT 0 COMMENT '创建者id',
    `update_time`  INT NOT NULL DEFAULT 0 COMMENT '创建时间',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用'
 ) CHARSET=UTF8 COMMENT '后台用户权限关联表-小黑科技';
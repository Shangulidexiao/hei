/* 
 * hei_admin sql
 */
/**
 * Author:  madison
 * Created: 2016-9-10
 */

CREATE TABLE hei_admin
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `user_name` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '用户名',
    `password`  VARCHAR(32) NOT NULL DEFAULT '' COMMENT '密码',
    `last_ip`  VARCHAR(16)  NOT NULL DEFAULT '0.0.0.0' COMMENT '最后一次登录的IP',
    `last_time`  INT(11)  NOT NULL DEFAULT 0 COMMENT '最后一次登录的时间',
    `create_id` INT(11) NOT NULL DEFAULT 0 COMMENT '创建者ID',
    `create_time` INT(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用'
 ) CHARSET=UTF8 COMMENT '后台用户表-小黑科技';

CREATE TABLE hei_admin_info
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `admin_id` INT(11) NOT NULL DEFAULT 0 COMMENT '用户ID',
    `true_name` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '真实名字',
    `photo`     VARCHAR(255) NOT NULL DEFAULT '' COMMENT '用户头像',
    `email`  VARCHAR(255) NOT NULL DEFAULT '' COMMENT '邮箱',
    `mobile`  CHAR(11) NOT NULL DEFAULT '' COMMENT '手机号',
    `status` TINYINT(8) NOT NULL DEFAULT 0 COMMENT '0 正常 1 禁用'
 ) CHARSET=UTF8 COMMENT '后台用户信息表-小黑科技';
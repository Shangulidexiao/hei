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




----- mysql dump-----
-- MySQL dump 10.13  Distrib 5.7.15, for Linux (x86_64)
--
-- Host: localhost    Database: hei_admin
-- ------------------------------------------------------
-- Server version	5.7.13-0ubuntu0.16.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `hei_admin`
--

DROP TABLE IF EXISTS `hei_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hei_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(60) DEFAULT NULL,
  `last_ip` varchar(16) NOT NULL DEFAULT '0.0.0.0' COMMENT '最后一次登录的IP',
  `last_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后一次登录的时间',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者ID',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0 正常 1 禁用',
  PRIMARY KEY (`id`),
  KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='后台用户表-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_admin`
--

LOCK TABLES `hei_admin` WRITE;
/*!40000 ALTER TABLE `hei_admin` DISABLE KEYS */;
INSERT INTO `hei_admin` VALUES (6,'madison','$2y$10$V3N5wFUHxLLYayjy8ljMrOWwuKHoEXrWqtO9Q62Hax/v7lDYOUPP.','127.0.0.1',1473484978,0,1473484978,0,0);
/*!40000 ALTER TABLE `hei_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hei_admin_auth`
--

DROP TABLE IF EXISTS `hei_admin_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hei_admin_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0 正常 1 禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台用户权限关联表-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_admin_auth`
--

LOCK TABLES `hei_admin_auth` WRITE;
/*!40000 ALTER TABLE `hei_admin_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `hei_admin_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hei_admin_group`
--

DROP TABLE IF EXISTS `hei_admin_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hei_admin_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(255) NOT NULL DEFAULT '' COMMENT '用户id',
  `group_id` varchar(255) NOT NULL DEFAULT '' COMMENT '组id',
  `is_leader` varchar(255) NOT NULL DEFAULT '' COMMENT '是否是组长 1 组长 0 组员',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0 正常 1 禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台组-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_admin_group`
--

LOCK TABLES `hei_admin_group` WRITE;
/*!40000 ALTER TABLE `hei_admin_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `hei_admin_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hei_admin_info`
--

DROP TABLE IF EXISTS `hei_admin_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hei_admin_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `true_name` varchar(20) NOT NULL DEFAULT '' COMMENT '真实名字',
  `photo` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0 正常 1 禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台用户信息表-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_admin_info`
--

LOCK TABLES `hei_admin_info` WRITE;
/*!40000 ALTER TABLE `hei_admin_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `hei_admin_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hei_admin_role`
--

DROP TABLE IF EXISTS `hei_admin_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hei_admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0 正常 1 禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台管理员角色关联表-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_admin_role`
--

LOCK TABLES `hei_admin_role` WRITE;
/*!40000 ALTER TABLE `hei_admin_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `hei_admin_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hei_auth`
--

DROP TABLE IF EXISTS `hei_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hei_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '菜单地址',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(255) NOT NULL DEFAULT '' COMMENT '菜单类名',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0 正常 1 禁用',
  `order_by` int(11) NOT NULL DEFAULT '0' COMMENT '排序 数字越高越靠前',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台权限表-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_auth`
--

LOCK TABLES `hei_auth` WRITE;
/*!40000 ALTER TABLE `hei_auth` DISABLE KEYS */;
INSERT INTO `hei_auth` VALUES (1,'main','首页','home',0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `hei_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hei_group`
--

DROP TABLE IF EXISTS `hei_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hei_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '组名称',
  `parent_id` varchar(255) NOT NULL DEFAULT '' COMMENT '父id',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0 正常 1 禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台组-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_group`
--

LOCK TABLES `hei_group` WRITE;
/*!40000 ALTER TABLE `hei_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `hei_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hei_group_auth`
--

DROP TABLE IF EXISTS `hei_group_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hei_group_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '组id',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0 正常 1 禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台用户权限关联表-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_group_auth`
--

LOCK TABLES `hei_group_auth` WRITE;
/*!40000 ALTER TABLE `hei_group_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `hei_group_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hei_group_role`
--

DROP TABLE IF EXISTS `hei_group_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hei_group_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` varchar(255) NOT NULL DEFAULT '' COMMENT '组id',
  `role_id` varchar(255) NOT NULL DEFAULT '' COMMENT '角色id',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0 正常 1 禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台组-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_group_role`
--

LOCK TABLES `hei_group_role` WRITE;
/*!40000 ALTER TABLE `hei_group_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `hei_group_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hei_role`
--

DROP TABLE IF EXISTS `hei_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hei_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '角色名称',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0 正常 1 禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台角色-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_role`
--

LOCK TABLES `hei_role` WRITE;
/*!40000 ALTER TABLE `hei_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `hei_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hei_role_auth`
--

DROP TABLE IF EXISTS `hei_role_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hei_role_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_id` int(11) NOT NULL DEFAULT '0' COMMENT '权限id',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(8) NOT NULL DEFAULT '0' COMMENT '0 正常 1 禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台角色权限关联表-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_role_auth`
--

LOCK TABLES `hei_role_auth` WRITE;
/*!40000 ALTER TABLE `hei_role_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `hei_role_auth` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-27 23:27:03

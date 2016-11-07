
-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: hei_admin
-- ------------------------------------------------------
-- Server version   5.1.73

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
  `order_by` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='后台用户表-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_admin`
--

LOCK TABLES `hei_admin` WRITE;
/*!40000 ALTER TABLE `hei_admin` DISABLE KEYS */;
INSERT INTO `hei_admin` VALUES (10,'admin1','$2y$10$Nn0mF6OJG/NwyB8u52VuIOI4wq5ZJlXXIStkJL1fznAalJDuOnLDe','192.168.184.1',1477862347,0,1477862347,1477865650,0,0),(13,'madison','$2y$10$sc9sgRHTbhqwA.HrgGFxPu9aQU8KB0TXGTHVjSw.F8/SlNkdr65j.','192.168.184.1',1477864192,0,1477864192,0,0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='后台用户信息表-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_admin_info`
--

LOCK TABLES `hei_admin_info` WRITE;
/*!40000 ALTER TABLE `hei_admin_info` DISABLE KEYS */;
INSERT INTO `hei_admin_info` VALUES (3,13,'韩剑','','18335831710@163.com','18335831710',0),(4,10,'韩剑','','18335831710@163.com','18335831710',0);
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
  `is_show` int(11) DEFAULT '0' COMMENT '是否显示 0不显示 1显示',
  `order_by` int(11) NOT NULL DEFAULT '0' COMMENT '排序 数字越高越靠前',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='后台权限表-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_auth`
--

LOCK TABLES `hei_auth` WRITE;
/*!40000 ALTER TABLE `hei_auth` DISABLE KEYS */;
INSERT INTO `hei_auth` VALUES (1,'main','首页','nav-home',0,0,0,0,1477786011,0,1,0),(2,'article','博客管理','nav-sample',0,0,0,0,1477822143,0,1,0),(11,'auth','权限管理','ii',1,0,1477785286,0,1477787313,0,1,0),(14,'/auth/index','菜单管理','ii',11,0,1477787057,0,1477787057,0,1,0),(15,'home','博客前台','ii',2,0,1477787238,0,1477787238,0,1,0),(16,'admin','博客后台','ii',2,0,1477787256,0,1477822323,0,0,0),(17,'/admin/index','站点管理','ii',16,0,1477790773,0,1477822308,0,0,0),(18,'/home/index','首页管理','ii',15,0,1477790809,0,1477819903,0,1,0),(19,'/index/index','首页','ii',11,0,1477808121,0,1477810928,0,0,0),(20,'/auth/listData','菜单列表','ii',11,0,1477808357,0,1477810923,0,0,0),(21,'/auth/update','菜单更新','ii',11,0,1477808412,0,1477810918,0,0,0),(22,'/auth/add','菜单添加','ii',11,0,1477808432,0,1477810913,0,0,0),(23,'/auth/remove','菜单删除','ii',11,0,1477808479,0,1477810893,0,0,0),(24,'/role/index','角色管理',' ii',11,0,1477822550,0,1477822591,0,1,0),(25,'/role/listData','角色列表','ii',24,0,1477845773,0,1477845773,0,0,0),(26,'/role/add','角色添加','ii',24,0,1477845809,0,1477845809,0,0,0),(27,'/role/remove','角色删除','ii',24,0,1477845830,0,1477845830,0,0,0),(28,'/role/update','角色更新','ii',24,0,1477845854,0,1477845854,0,0,0),(29,'/group/listData','组列表','ii',11,0,1477846754,0,1477847768,0,0,0),(30,'/group/add','组添加','ii',11,0,1477846782,0,1477846782,0,0,0),(31,'/group/update','组更新','ii',11,0,1477846823,0,1477846823,0,0,0),(32,'/group/remove','组删除','ii',11,0,1477846847,0,1477846847,0,0,0),(33,'/group/index','组管理','ii',11,0,1477847750,0,1477847783,0,1,0),(34,'/admin/index','用户管理','ii',11,0,1477848462,0,1477848900,0,1,0),(35,'/admin/add','用户添加','ii',11,0,1477848502,0,1477848905,0,0,0),(36,'/admin/update','用户更新','ii',11,0,1477848520,0,1477848908,0,0,0),(37,'/admin/remove','用户删除','ii',11,0,1477848541,0,1477848913,0,0,0),(38,'/admin/listData','用户列表','ii',11,0,1477848572,0,1477848918,0,0,0);
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
  `order_by` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='后台组-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_group`
--

LOCK TABLES `hei_group` WRITE;
/*!40000 ALTER TABLE `hei_group` DISABLE KEYS */;
INSERT INTO `hei_group` VALUES (2,'超级管理员','0',0,1477847849,0,1477847849,0,0),(3,'管理员','2',0,1477847928,0,1477847928,0,0);
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
  `order_by` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='后台角色-小黑科技';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hei_role`
--

LOCK TABLES `hei_role` WRITE;
/*!40000 ALTER TABLE `hei_role` DISABLE KEYS */;
INSERT INTO `hei_role` VALUES (2,'超级管理员',0,1477846237,0,1477846237,0,0),(3,'博客管理员',0,1477846306,0,1477846306,0,0);
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

-- Dump completed on 2016-10-31  6:46:21
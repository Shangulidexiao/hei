<!DOCTYPE HTML>
<html>
 <head>
  <title> 小黑科技管理系统</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="<?php echo SITE_PUBLIC;?>/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_PUBLIC;?>/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo SITE_PUBLIC;?>/css/main-min.css" rel="stylesheet" type="text/css" />
 </head>
 <body>
    <div class="header">
        <div class="dl-title">
            <span class="lp-title-port"></span><span class="dl-title-text">小黑科技</span>
        </div>
        <div class="dl-log">欢迎您，
            <span class="dl-log-user"><?=$admin['user_name']?></span>
            <?=anchor('/Index/logOut','[退出]',array('title'=>'退出系统','class'=>'dl-log-quit'))?>
            <?=anchor('http://www.builive.com/','文档库',array('title'=>'BUI文档库','class'=>'dl-log-quit','target'=>'_black'))?>
        </div>
    </div>
    <div class="content">
        <div class="dl-main-nav">
          <ul id="J_Nav"  class="nav-list ks-clear">
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-storage">首页</div></li>
            <li class="nav-item"><div class="nav-item-inner nav-inventory">搜索页</div></li>
          </ul>
        </div>
        <ul id="J_NavContent" class="dl-tab-conten">

        </ul>
   </div>
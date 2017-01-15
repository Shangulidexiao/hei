<!DOCTYPE HTML>
<html>
    <head>
        <title> 小黑科技管理系统</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo SITE_PUBLIC; ?>/css/dpl-min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo SITE_PUBLIC; ?>/css/bui-min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo SITE_PUBLIC; ?>/css/main-min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="<?php echo SITE_PUBLIC; ?>/img/hei/hei.ico">
    </head>
    <body>
        <div class="header">
            <div class="dl-title">
                <span class="lp-title-port"></span><span class="dl-title-text">小黑科技</span>
            </div>
            <div class="dl-log">欢迎您，
                <span class="dl-log-user"><?= $admin['user_name'] ?></span>
                <?= anchor('/Index/logOut', '[退出]', array('title' => '退出系统', 'class' => 'dl-log-quit')) ?>
                <?= anchor('http://www.builive.com/', '文档库', array('title' => 'BUI文档库', 'class' => 'dl-log-quit', 'target' => '_black')) ?>
            </div>
        </div>
        <div class="content">
            <div class="dl-main-nav">
                <ul id="J_Nav"  class="nav-list ks-clear">
                    <?php foreach ($menuFirst as $menu) { ?>
                        <li class="nav-item dl-selected"><div class="nav-item-inner <?= $menu['icon'] ?>"><?= $menu['name'] ?></div></li>
                    <?php } ?>
                </ul>
            </div>
            <ul id="J_NavContent" class="dl-tab-conten">

            </ul>
        </div>
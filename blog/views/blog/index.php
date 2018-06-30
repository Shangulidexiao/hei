<!DOCTYPE html>
<html  lang="zh-CN">
    <head>
        <title>博客首页</title>
        <meta charset="GBK">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="<?=BLOG_STATIC?>/css/bootstrap.css"/>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">伸缩导航</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">小黑</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php foreach ($menu as $mKey => $mValue):?>
                        <li <?=($mKey==$cateId) ? 'class="active"':'';?>>
                            <a href="/?cateId=<?=$mKey?>"><?=$mValue?></a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">登录</a></li>
                        <li><a href="#">注册</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
           
        </nav>
        
        <script src="<?= BLOG_STATIC ?>/js/jquery-1.10.2.min.js"></script>
        <script src="<?= BLOG_STATIC ?>/js/bootstrap.js"></script>
    </body>
</html>
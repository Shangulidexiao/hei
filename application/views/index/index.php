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
     <div class="container">
         <div class="row">
             <span class="span10">
                 <br>
                 <h1>
                 欢迎使用小黑科技！
                 </h1>
             </span>
         </div>
     </div>
<!-- jQuery -->
    <script src="<?php echo SITE_PUBLIC;?>/js/jquery-1.8.1.min.js"></script>
    <script src="<?php echo SITE_PUBLIC;?>/js/bui-min.js"></script>
    <script src="<?php echo SITE_PUBLIC;?>/js/config.js"></script>
    <script src="<?php echo SITE_PUBLIC;?>/js/common/main-min.js"></script>
    <!--[if lt IE 10]>
    <script src="<?php echo SITE_PUBLIC;?>/js/jquery.placeholder.min.js"></script>
    <script >$('input, textarea').placeholder({customClass:'fn-placeholder'});</script>
    <![endif]-->
  <script>
     BUI.use('common/main',function(){
      var config = [{
          id:'menu',
          menu:[{
              text:'权限管理',
              homePage:'main-menu',
              //collapsed:true,//是否打开二级菜单
              items:[
                {id:'main-menu',text:'菜单管理',href:'main/menu.php'},
                {id:'second-menu',text:'权限管理',href:'main/second-menu.php'}
              ]
            }]
          },{
            id:'search',
            menu:[{
                text:'搜索页面',
                items:[
                  {id:'introduce',text:'搜索页面简介',href:'search/introduce.html'}
                ]
              }]
          }];
          new PageUtil.MainPage({
            modulesConfig : config
          });
    });
    
  </script>
 </body>
</html>
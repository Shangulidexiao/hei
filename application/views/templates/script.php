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
      var config = <?=$menuJson;?>;
      // [{
      //     id:'menu',
      //     menu:[{
      //         text:'权限管理',
      //         homePage:'main-index',
      //         //collapsed:true,//是否打开二级菜单
      //         items:[
      //           {id:'main-index',text:'首页面板',href:'/index/panel'},
      //           {id:'main-menu',text:'菜单管理',href:'/auth/index'}
      //         ]
      //       }]
      //     },{
      //       id:'search',
      //       menu:[{
      //           text:'搜索页面',
      //           items:[
      //             {id:'introduce',text:'搜索页面简介',href:'search/introduce.html'}
      //           ]
      //         }]
      //     }];

          new PageUtil.MainPage({
            modulesConfig : config
          });
    });
    
  </script>

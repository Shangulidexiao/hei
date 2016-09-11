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
              text:'首页内容',
              items:[
                {id:'main-menu',text:'顶部导航',href:'main/menu.php'},
                {id:'second-menu',text:'二级菜单',href:'main/second-menu.php'}
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
    });
 
  </script>

<!DOCTYPE HTML>
<html>
 <head>
  <title> 资源文件结构</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo SITE_PUBLIC;?>/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_PUBLIC;?>/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_PUBLIC;?>/css/page-min.css" rel="stylesheet" type="text/css" />  
 </head>
 <body>
    <div class="container">
        <div id="grid"></div>
        <p>
          <button id="btnSave" class="button button-primary">提交</button>
        </p>
    </div>

  <script type="text/javascript" src="<?php echo SITE_PUBLIC;?>/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="<?php echo SITE_PUBLIC;?>/js/bui-min.js"></script>
  <!-- 如果不使用页面内部跳转，则下面 script 标签不需要,同时不需要引入 common/page -->
  <script type="text/javascript" src="<?php echo SITE_PUBLIC;?>/js/config.js"></script>
 
  <script type="text/javascript">
    BUI.use('common/page'); //页面链接跳转
    BUI.use(['bui/grid','bui/data'],function (Grid,Data) {

    var columns = [{title : '菜单地址',dataIndex :'url'},
            {title : '菜单名称',dataIndex :'name'},
            {title : '菜单图标',dataIndex :'icon'},
            {title : '排序',dataIndex :'order_by',width:200},
            {title : '状态',dataIndex :'status',width:200},
            {title : '操作',renderer : function(){
              return '<span class="grid-command btn-edit">编辑</span>';
            }}
          ],
      //默认的数据
      data = <?=$data?>,
      store = new Data.Store({
        data:data
      }),
      editing = new Grid.Plugins.DialogEditing({
        contentId : 'content',
        triggerCls : 'btn-edit'
      }),
      grid = new Grid.Grid({
        render : '#grid',
        columns : columns,
        width : 700,
        forceFit : true,
        store : store,
        plugins : [Grid.Plugins.CheckSelection,editing],
        tbar:{
          items : [{
            btnCls : 'button button-small',
            text : '<i class="icon-plus"></i>添加',
            listeners : {
              'click' : addFunction
            }
          },
          {
            btnCls : 'button button-small',
            text : '<i class="icon-remove"></i>删除',
            listeners : {
              'click' : delFunction
            }
          }]
        }

      });
    grid.render();

    function addFunction(){
      var newData = {url :'请输入菜单地址',name:'请输入菜单名称'};
      editing.add(newData); //添加记录后，直接编辑
    }

    function delFunction(){
      var selections = grid.getSelection();
      store.remove(selections);
    }
    var logEl = $('#log');
    $('#btnSave').on('click',function(){
      var records = store.getResult();
      logEl.text(BUI.JSON.stringify(records));
    });
  });
    
  </script>
    <div id="content" class="hide">
        <form id="J_Form" class="form-horizontal">
          <div class="row">
            <div class="control-group span8">
              <label class="control-label"><s>*</s>菜单地址：</label>
              <div class="controls">
                <input name="url" type="text" data-rules="{required:true}" class="input-normal control-text">
              </div>
            </div>
            <div class="control-group span8">
              <label class="control-label"><s>*</s>菜单名称：</label>
              <div class="controls">
                <input name="name" type="text" data-rules="{required:true}" class="input-normal control-text">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="control-group span8 ">
              <label class="control-label">菜单图标：</label>
              <div id="range" class="controls bui-form-group" data-rules="{dateRange : true}">
                <input name="icon" type="text" data-rules="{required:true}" class="input-normal control-text">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="control-group span8">
              <label class="control-label">排序：</label>
              <div class="controls control-row4">
                <input name="order_by" type="text" data-rules="{required:true}" class="input-normal control-text">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="control-group span8">
              <label class="control-label">状态：</label>
              <div class="controls control-row4">
                  <select name="status" class="input-normal">
                      <option value="0">启用</option>
                      <option value="1">禁用</option>
                  </select>
              </div>
            </div>
          </div>
        </form>
    </div>
<body>
</html> 
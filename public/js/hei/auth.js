BUI.use('common/page'); //页面链接跳转
BUI.use(['bui/grid','bui/data'],function (Grid,Data) {
var Store = Data.Store,
    statusObj = {"0" : "已启用","1" : "已禁用"},
    columns = [
        {title : 'id',dataIndex :'id'},
        {title : '菜单地址',dataIndex :'url',editor : {xtype : 'text',validator : validFn}},
        {title : '菜单名称',dataIndex :'name',editor : {xtype : 'text',rules : {required : true}}},
        {title : '菜单图标',dataIndex :'icon'},
        {title : '父id',dataIndex :'parent_id'},
        {title : '排序',dataIndex :'order_by',editor : {xtype:'number'}},
        {title : '状态',dataIndex :'status',renderer : Grid.Format.enumRenderer(statusObj)},
        {title : '操作',width:200,renderer : function(){
                return '<span class="grid-command btn-edit">编辑</span>';
        }}
      ],
    //默认的数据
    store = new Store({
      url : '/auth/listData',
      autoLoad:true,
      pageSize:1,	// 配置分页数目
      proxy : { //设置起始页码
        pageStart : 1,
        ajaxOptions : { //ajax的配置项，不要覆盖success,和error方法
            traditional : true,
            type : 'post'
        }
      }
    }),
    editing = new Grid.Plugins.DialogEditing({
      contentId : 'content',
      triggerCls : 'btn-edit',
      editor: {
        title: '菜单操作'
      }
    }),
    grid = new Grid.Grid({
      render : '#grid',
      columns : columns,
      width : 700,
      forceFit : true,
      store : store,
      plugins : [Grid.Plugins.CheckSelection,editing],
      bbar:{
            // pagingBar:表明包含分页栏
            pagingBar:true
        },
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
        },{
          btnCls : 'button button-small',
          text : '<i class="icon-plus"></i>添加子菜单',
          listeners : {
            'click' : addSubFunction
          }
        }]
      }

    });
  grid.render();

  function validFn (value,obj) {
    var records = store.getResult(),
      rst = '';
    BUI.each(records,function (record) {
      if(record.a == value && obj != record){
        rst = '菜单地址不能重复';
        return false;
      }
    });
    return rst;
  }

  function addFunction(){
    var newData = {url :'请输入菜单地址',name:'请输入菜单名称'};
    editing.add(newData); //添加记录后，直接编辑
  }
  function addSubFunction(){
    var selections = grid.getSelection();
    if(selections.length === 1){
      var newData = {"parent_id":selections[0].id,"order_by":0};
      editing.add(newData); //添加记录后，直接编辑
    }else{
        BUI.Message.Alert('请选择一个父元素',function(){
           return ;
      },'error');
    }

  }
  function delFunction(){
    var selections = grid.getSelection();
    store.remove(selections);
  }
  var logEl = $('#log');
  $('.btn-add').on('click',function(){
      var selections = grid.getSelection();
      alert(selections[0].id);

  });
  $('#btnSave').on('click',function(){
    var records = store.getResult();
    logEl.text(BUI.JSON.stringify(records));
  });
    //创建表单，表单中的日历，不需要单独初始化
    var form = new BUI.Form.HForm({
      srcNode : '#searchForm'
    }).render();

    form.on('beforesubmit',function(ev) {
      //序列化成对象
      var obj = form.serializeToObject();
      obj.start = 0; //返回第一页
      store.load(obj);
      return false;
    });
});




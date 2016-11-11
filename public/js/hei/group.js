/**
 *  CodeIgniter 
 *  
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-6 16:43:16 
 */

BUI.use('common/page'); //页面链接跳转
BUI.use(['bui/grid','bui/data'],function (Grid,Data) {
var Store = Data.Store,
    statusObj = {"0" : "已启用","1" : "已禁用"},
    columns = [
        {title : 'id',dataIndex :'id'},
        {title : '角色名称',dataIndex :'name',editor : {xtype : 'text',rules : {required : true}}},
        {title : '排序',dataIndex :'order_by',editor : {xtype:'number'}},
        {title : '父id',dataIndex :'parent_id',editor : {xtype:'number'}},
        {title : '状态',dataIndex :'status',renderer : Grid.Format.enumRenderer(statusObj)},
        {title : '操作',width:200,renderer : function(){
                return '<span class="grid-command btn-edit">编辑</span>';
        }}
      ],
    //默认的数据
    store = new Store({
      url : '/group/listData',
      autoLoad:true,
      pageSize:10,	// 配置分页数目
      proxy : { //设置起始页码
        pageStart : 1,
        ajaxOptions : { //ajax的配置项，不要覆盖success,和error方法
            traditional : true,
            type : 'post'
        },
        method : 'POST', //更改为POST
        save : {
               addUrl : '/group/add',
               removeUrl : '/group/remove',
               updateUrl : '/group/update'
              }
      },
        params : {
          name : '',
          parent_id : '',
          status : ''
        }
    }),
    editing = new Grid.Plugins.DialogEditing({
      contentId : 'content',
      triggerCls : 'btn-edit',
      editor: {
        title: '组操作'
      },
      forceFit: true,	// 列宽按百分比自适应
      autoSave : true //自动添加和更新
    }),
    grid = new Grid.Grid({
      render : '#grid',
      columns : columns,
      width : 1000,
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
          text : '<i class="icon-plus"></i>添加子分组',
          listeners : {
            'click' : addSubFunction
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
    ids = BUI.Array.map(selections,function (item) {
              return item.id;
    });
    store.remove(selections);
    store.save('remove',{ids : ids.join(',')}); //save的第三个参数是回调函数
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




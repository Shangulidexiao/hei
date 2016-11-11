/**
 *  CodeIgniter 
 *  用户
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-6 17:17:36 
 */

BUI.use('common/page'); //页面链接跳转
BUI.use(['bui/grid','bui/data'],function (Grid,Data) {
var Store = Data.Store,
    statusObj = {"0" : "已启用","1" : "已禁用"},
    columns = [
        {title : 'id',dataIndex :'id'},
        {title : '用户名',dataIndex :'user_name',editor : {xtype : 'text',rules : {required : true}}},
        {title : '真实姓名',dataIndex :'true_name',editor : {xtype : 'text',rules : {required : true}}},
        //{title : '头像',dataIndex :'photo',editor : {xtype : 'text',rules : {required : true}}},
        {title : '邮箱',dataIndex :'email',editor : {xtype : 'text',rules : {required : true}}},
        {title : '手机号',dataIndex :'mobile',editor : {xtype : 'text',rules : {required : true}}},
        {title : '排序',dataIndex :'order_by',editor : {xtype:'number'}},
        {title : '状态',dataIndex :'status',renderer : Grid.Format.enumRenderer(statusObj)},
        {title : '操作',width:200,renderer : function(){
                return '<span class="grid-command btn-edit">编辑</span>';
        }}
      ],
    //默认的数据
    store = new Store({
      url : '/admin/listData',
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
               addUrl : '/admin/add',
               removeUrl : '/admin/remove',
               updateUrl : '/admin/update'
              }
      },
        params : {
          name : '',
          mobile : '',
          status : ''
        }
    }),
    editing = new Grid.Plugins.DialogEditing({
      contentId : 'content',
      triggerCls : 'btn-edit',
      editor: {
        title: '菜单操作'
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
        }]
      }

    });
  grid.render();

  function addFunction(){
    var newData = {user_name :'请输入用户名',true_name:'请输入真实姓名',order_by:0};
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



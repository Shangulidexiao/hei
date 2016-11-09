/**
 *  CodeIgniter 
 *  角色
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-6 0:47:12 
 */


BUI.use('common/page'); //页面链接跳转
BUI.use(['bui/grid','bui/data','bui/overlay'],function (Grid,Data,Overlay) {
var Store = Data.Store,
    statusObj = {"0" : "已启用","1" : "已禁用"},
    columns = [
        {title : 'id',dataIndex :'id'},
        {title : '角色名称',dataIndex :'name',editor : {xtype : 'text',rules : {required : true}}},
        {title : '排序',dataIndex :'order_by',editor : {xtype:'number'}},
        {title : '状态',dataIndex :'status',renderer : Grid.Format.enumRenderer(statusObj)},
        {title : '操作',width:200,renderer : function(){
                return '<span class="grid-command btn-edit">编辑</span>\n\
                        <span class="grid-command btn-add-user">添加用户</span>\n\
                            <span class="grid-command btn-add-auth">添加权限</span>';
        }}
      ],
    //默认的数据
    store = new Store({
      url : '/role/listData',
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
               addUrl : '/role/add',
               removeUrl : '/role/remove',
               updateUrl : '/role/update'
              }
      },
        params : {
          name : '',
          id : '',
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
  grid.on('cellclick',function  (ev) {
          var record = ev.record, //点击行的记录
            field = ev.field, //点击对应列的dataIndex
            target = $(ev.domTarget),
            roleId = record.id; //点击的元素
            
          if(target.hasClass('btn-add-user')){
              var dialog = new Overlay.Dialog({
                title:'添加用户',
                width:1000,
                height:400,
                mask:true,
                buttons:[
                  {
                    text:'确定添加',
                    elCls : 'button button-primary',
                    handler : function(){
                      alert(0);
                      this.close();
                    }
                  },{
                    text:'关闭',
                    elCls : 'button',
                    handler : function(){
                      this.close();
                    }
                  }
                ], loader : {
                    url : '/role/adminList',
                    autoLoad : true, //不自动加载
                    params : {roleId :roleId},//附加的参数
                    lazyLoad : false //不延迟加载
                    
                    /*, //以下是默认选项
                    dataType : 'text',   //加载的数据类型
                    property : 'bodyContent', //将加载的内容设置到对应的属性
                    loadMask : {
                      //el , dialog 的body
                    },
                    lazyLoad : {
                      event : 'show', //显示的时候触发加载
                      repeat : true //是否重复加载
                    },
                    callback : function(text){
                      var loader = this,
                        target = loader.get('target'); //使用Loader的控件，此处是dialog
                      //
                    }
                    */
                  }
              });
               dialog.show();
          }
 
          if(target.hasClass('btn-add-auth')){
            alert('添加权限');
            console.log(record);
          }
 
        });
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
    var newData = {name:'请输入角色名称',order_by:0};
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


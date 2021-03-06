/**
 *  CodeIgniter 
 *  用户
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-6 17:17:36 
 */

BUI.use('common/page'); //页面链接跳转
BUI.use(['bui/grid','bui/data','bui/overlay'],function (Grid,Data,Overlay) {
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
                return '<span class="grid-command btn-edit">编辑</span>\n\
                            <span class="grid-command btn-add-auth">添加权限</span>';
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
  grid.on('cellclick',function  (ev) {
          var record = ev.record, //点击行的记录
            field = ev.field, //点击对应列的dataIndex
            target = $(ev.domTarget),
            adminId = record.id; //点击的元素
            window.heiAdminId = adminId;
          if(target.hasClass('btn-add-auth')){
            var dialog = new Overlay.Dialog({
                title:'添加权限',
                width:1000,
                height:'auto', 
                mask:true,
                align :{
                node: null,     // 参考元素, falsy 或 window 为可视区域, 'trigger' 为触发元素, 其他为指定元素
                points: ['tr', 'tl'] , // ['tr', 'tl'] 表示 overlay 的 tl 与参考节点的 tr 对齐
                offset: [0, 0]    // 有效值为 [n, m]
                },
                closeAction:'remove',//关闭弹出框时从dom中移除
                buttons:[
                  {
                    text:'确定添加',
                    elCls : 'button button-primary',
                    handler : function(){
                        var checkedNodes = window.authTree.getCheckedNodes();
                        var authArr = [];
                        BUI.each(checkedNodes,function(node){
                          authArr.push(node.id);
                        });
                        var postObj   = {auths:authArr,adminId:adminId};
                        $.post('/Admin/addAuth',postObj,function(response){
                            if(response.code===200){
                                BUI.Message.Alert(response.msg,'success');
                            }else{
                                BUI.Message.Alert(response.msg,'error');
                            }
                        },'json');
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
                    url : '/Admin/authTree',
                    autoLoad : true, //不自动加载
                    params : {adminId :adminId},//附加的参数
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
 
        });
  function addFunction(){
    var newData = {user_name :'请输入用户名',true_name:'请输入真实姓名',order_by:0};
    editing.add(newData); //添加记录后，直接编辑
  }

  function delFunction(){
    var selections = grid.getSelection();
    ids = BUI.Array.map(selections,function (item) {
              return item.id;
    });
    BUI.Message.Confirm('你确定要删除选中的吗？',function(){
        store.remove(selections);
        store.save('remove',{ids : ids.join(',')}); //save的第三个参数是回调函数
     },'error');
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



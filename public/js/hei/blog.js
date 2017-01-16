/**
 *  CodeIgniter 
 *  权限
 * @author Han Jian <18335831710@163.com>
 * @date 2017-01-13
 */

BUI.use('common/page'); //页面链接跳转
BUI.use(['bui/grid','bui/data','bui/select'],function (Grid,Data,Select) {
var Store = Data.Store,
    statusObj = {"0" : "启用","1" : "审核失败"},
    categoryObj = Hei.cacategoryJson,
    columns = [
        {title : 'id',dataIndex :'id'},
        {title : '标题',dataIndex :'title',editor : {xtype : 'text',validator : validFn}},
        {title : '阅读次数',dataIndex :'read_num'},
        {title : '分类',dataIndex :'category_id',renderer : Grid.Format.enumRenderer(categoryObj)},
        {title : '排序',dataIndex :'order_by'},
        {title : '状态',dataIndex :'status',renderer : Grid.Format.enumRenderer(statusObj)},
        {title : '操作',width:200,renderer : function(){
                return '<span class="grid-command btn-edit">编辑</span>';
                return '<span class="grid-command btn-del">删除</span>';
        }}
      ],
    //默认的数据
    store = new Store({
      url : '/blog/listData',
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
               addUrl : '/auth/add',
               removeUrl : '/auth/remove',
               updateUrl : '/auth/update'
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
        //搜索选择框
    var suggest = new Select.Suggest({
        render:'#s1',
        name:'suggest',
        url:'server-data.php'
      });
      suggest.render();

});





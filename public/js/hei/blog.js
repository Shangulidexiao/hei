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
        {title : '标题',dataIndex :'title',editor : {xtype : 'text'}},
        {title : '阅读次数',dataIndex :'read_num'},
        {title : '分类',dataIndex :'category_id',renderer : Grid.Format.enumRenderer(categoryObj)},
        {title : '排序',dataIndex :'order_by'},
        {title : '状态',dataIndex :'status',renderer : Grid.Format.enumRenderer(statusObj)},
        {title : '操作',width:200,renderer : function(){
                return '<span class="grid-command btn-edit">编辑</span>';
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
               addUrl : '/blog/add',
               removeUrl : '/blog/remove',
               updateUrl : '/blog/update'
              }
      },
        params : {
          title : '',
          blog_name : '',
          user_name : '',
          cate_id : '',
          status : '',
          delete : ''
        }
    }),
    grid = new Grid.Grid({
      render : '#grid',
      columns : columns,
      width : 1000,
      forceFit : true,
      store : store,
      plugins : [Grid.Plugins.CheckSelection],
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
            blogId = record.id; //点击的元素
          if(target.hasClass('btn-edit')){
             top.topManager.openPage({
              id : 'editBlog',
              href : '/blog/showTpl?blogId='+blogId,
              title : '博客编辑'
            });
          }
 
        });
  function addFunction(){
    top.topManager.openPage({
      id : 'addBlog',
      href : '/blog/showTpl',
      title : '博客添加'
    });
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
});





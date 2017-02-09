<form id="J_Form_Tree" action="" class="form-horizontal">
    <div class="control-group">
        <label class="control-label"><s>*</s>权限列表：</label>
        <br>
        <div class="row">
            <div id="authTree">

            </div>
        </div>
        <hr>
    </div>      
</form>
<script>
 BUI.use(['bui/tree','bui/data'],function(Tree,Data){
         /*权限树生成*/
        var treeStore = new Data.TreeStore({
            root :{
              id : '0',
              text : '权限树'
            },
            url : '/role/treeData?roleId='+window.authRoleId
          }),
          tree = new Tree.TreeList({
            render : '#authTree',
            store : treeStore,
            checkType: 'all',
            showLine : true //显示连接线
          });
        tree.render();
        window.authTree = tree;
        treeStore.load({id : '0'});//加载根节点，也可以让用户点击加载
 });
</script>

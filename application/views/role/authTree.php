<form id="J_Form_Tree" action="" class="form-horizontal">
    <div class="control-group">
    <label class="control-label"><s>*</s>权限列表：</label>
    <br>
        <div class="row">
            <div id="authTree" style="overflow: auto;">
                 
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
            url : '/role/treeData'
          }),
          tree = new Tree.TreeList({
            render : '#authTree',
            store : treeStore,
            dirSelectable:true,
            showRoot : true //可以不配置，则不显示根节点
          });
        tree.render();
        treeStore.load({id : '0'});//加载根节点，也可以让用户点击加载
 });
</script>

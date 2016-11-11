<form id="J_Form" action="" class="form-horizontal">
    <div class="control-group">
    <label class="control-label"><s>*</s>人员列表：</label>
	<div class="row">
		<span><input class="select-all" type="checkbox" for-name="admin[]">全选/全不选</span>
	</div>
    <hr>
    <div class="controls bui-form-group"  data-rules="{checkRange:1}" data-messages="{checkRange:'至少勾选一项！'}" >
      <?php foreach ( $admins as $admin) { ?>
        <label class="checkbox" for=""><input class="select-one" name="admin[]" value="<?=$admin['id']?>" type="checkbox"><?=$admin['user_name']?></label>&nbsp;&nbsp;&nbsp;
      <?php } ?>
    </div>
    </div>      
</form>

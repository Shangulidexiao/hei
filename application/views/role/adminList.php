<form id="J_Form" action="" class="form-horizontal">
    <div class="control-group">
    <label class="control-label"><s>*</s>人员列表：</label><br>
    <div class="controls bui-form-group"  data-rules="{checkRange:1}" data-messages="{checkRange:'至少勾选一项！'}" >
      <?php foreach ( $admins as $admin) { ?>
        <label class="checkbox" for=""><input name="admin[]" value="<?=$admin['id']?>" type="checkbox"><?=$admin['user_name']?></label>&nbsp;&nbsp;&nbsp;
      <?php } ?>
    </div>
    </div>      
</form>
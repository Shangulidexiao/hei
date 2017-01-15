<form id="J_Form" action="" class="form-horizontal">
    <div class="control-group">
        <label class="control-label"><s>*</s>人员列表：</label>
        <div class="row">
            <span><input class="select-all" type="checkbox" for-name="admin[]"  all-name="admin-all" <?= $isAllSelect ? "checked" : ""; ?>>
                全选/全不选</span>
        </div>
        <hr>
        <div class="controls bui-form-group"  data-rules="{checkRange:1}" data-messages="{checkRange:'至少勾选一项！'}" >
            <?php foreach ($admins as $admin) { ?>
                <label class="checkbox" for="">
                    <input class="select-one"   for-name="admin-all" name="admin[]" value="<?= $admin['id'] ?>" type="checkbox" 
                           <?= in_array($admin['id'], $roleAdmins) ? 'checked' : '' ?>>
                           <?= $admin['user_name'] ?>
                </label>&nbsp;&nbsp;&nbsp;
            <?php } ?>
        </div>
    </div>      
</form>

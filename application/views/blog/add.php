<!DOCTYPE HTML>
<html>
 <head>
  <title> 添加</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo SITE_PUBLIC;?>/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_PUBLIC;?>/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_PUBLIC;?>/css/page-min.css" rel="stylesheet" type="text/css" />  
    <link href="<?php echo SITE_PUBLIC;?>/css/site/common.css" rel="stylesheet" type="text/css" />  
 </head>
 <body>
    <div class="hei-body">
      <div class="container">
          <?=form_open('/blog/saveBlog','id="J_Form" class="form-horizontal"')?>
            <div class="control-group">
                <label for="" class="control-label"><s>*</s>标题</label>
                <div class="controls">
                  <input type="text" class="input-large" name="title" data-rules="{required:true}" value="<?= $blog['title'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label"><s>*</s>内容</label>
                <div class="controls control-row-auto offset3" style="padding-left: 110px;">
                    <script id="container"  name="content" type="text/plain">
                        <?=  isset($blog['content']) ? $blog['content']:'写入你自己的美妙的文字吧！' ?>
                    </script>
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label"><s>*</s>类别</label>
                <div class="controls">
                  <?=form_dropdown('category_id',$categoryKv,$blog['category_id'],'data-rules="{number:true}"')?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><s>*</s>关键字</label>
                <div class="controls  control-row-auto">
                  <textarea name="keywords"  class="input-large control-row4" data-rules="{required:true}" value="<?= $blog['keywords'] ?>"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label"><s>*</s>描述</label>
                <div class="controls control-row-auto">
                  <textarea name="description"  class="input-large control-row4" data-rules="{required:true}" value="<?= $blog['description'] ?>"></textarea> 
                </div>
            </div>
              <div class="control-group">
                <label for="" class="control-label"><s>*</s>是否允许评论</label>
                <div class="controls">
                  <?=form_dropdown('is_comment',$statusKv,$blog['is_comment'],'data-rules="{number:true}"')?>
                </div>
              </div>
              <div class="control-group">
                <label for="" class="control-label"><s>*</s>是否公开</label>
                <div class="controls">
                  <?=form_dropdown('is_visable',$statusKv,$blog['is_visable'],'data-rules="{number:true}"')?>
                </div>
              </div>
              <div class="control-group">
                <label for="" class="control-label"><s>*</s>排序</label>
                <div class="controls">
                  <input type="text" name="order_by" data-rules="{number:true}" value="<?= $blog['order_by']  ?>">
                </div>
              </div>
              <div class="control-group">
                <label for="" class="control-label"><s>*</s>阅读次数</label>
                <div class="controls">
                  <input type="text" name="read_num" data-rules="{number:true}" value="<?= $blog['read_num'] ?>">
                </div>
              </div>
              <div class="control-group">
                <label for="" class="control-label"><s>*</s>状态</label>
                <div class="controls">
                  <?=form_dropdown('status',$statusKv,$blog['status'],'data-rules="{number:true}"')?>
                </div>
              </div>
            <div class="row form-actions actions-bar">
              <div class="span13 offset3">
                  <input type="hidden" name="id" value="<?=  isset($blog['id']) ? $blog['id']:0 ?>">
                <button type="submit" class="button button-primary offset-3">提交</button>
              </div>
            </div>
          <?=form_close()?>
      </div>
    </div> 
     
    <script type="text/javascript" src="<?=SITE_PUBLIC;?>/js/jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="<?=SITE_PUBLIC;?>/js/bui-min.js"></script>
    <script type="text/javascript" src="<?=SITE_PUBLIC;?>/js/config.js"></script>
    <script type="text/javascript" src="<?=SITE_PUBLIC;?>/js/hei/blogForm.js"></script><script type="text/javascript" src="<?=SITE_PUBLIC;?>/js/UEditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="<?=SITE_PUBLIC;?>/js/UEditor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
    var ue = UE.getEditor('container');
    </script>
    
</body>
</html> 

<!DOCTYPE HTML>
<html>
    <head>
        <title> 资源文件结构</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo SITE_PUBLIC; ?>/css/dpl-min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo SITE_PUBLIC; ?>/css/bui-min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo SITE_PUBLIC; ?>/css/page-min.css" rel="stylesheet" type="text/css" />  
        <link href="<?php echo SITE_PUBLIC; ?>/css/site/common.css" rel="stylesheet" type="text/css" />  
    </head>
    <body>
        <div class="hei-body">
            <form id="searchForm"  class="form-horizontal"  tabindex="0" style="outline: none;">
                <div class="row">
                    <div class="span25">
                        <div class="row">
                            <div class="control-group span7">
                                <label class="control-label">用户名：</label>
                                <div class="controls">
                                    <input type="text" name="user_name" class="control-text">
                                </div>
                            </div>
                            <div class="control-group span7">
                                <label class="control-label">博客名：</label>
                                <div class="controls">
                                    <input type="text" name="blog_name" class="control-text">
                                </div>
                            </div>
                            <div class="control-group span7">
                                <label class="control-label">文章标题：</label>
                                <div class="controls">
                                    <input type="text" name="title" class="control-text">
                                </div>
                            </div>
                            <div class="control-group span7">
                                <label class="control-label">状态：</label>
                                <div class="controls">
                                    <select name="status">
                                        <option value="">全部</option>
                                        <option value="0">已启用</option>
                                        <option value="1">已禁用</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span25">
                        <div class="control-group span7">
                            <label class="control-label">分类：</label>
                            <div class="controls">
                               <?=form_dropdown('cate_id',$categoryKv)?>
                            </div>
                        </div>
                        <div class="control-group span7">
                            <label class="control-label">是否已删：</label>
                            <div class="controls">
                               <?=form_dropdown('delete',$deleteKv)?>
                            </div>
                        </div>
                        <div class="form-actions span2 offset2">
                            <button id="btnSearch" type="submit" class="button button-primary">搜索</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="container">
                <div id="grid">

                </div>
            </div>
        </div>
        <script>
                    var Hei = {
                cacategoryJson:<?= $categoryJson?>
            };
        </script>
        <script type="text/javascript" src="<?php echo SITE_PUBLIC; ?>/js/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_PUBLIC; ?>/js/bui-min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_PUBLIC; ?>/js/config.js"></script>
        <script type="text/javascript" src="<?php echo SITE_PUBLIC; ?>/js/hei/blog.js"></script>
    </body>
</html> 

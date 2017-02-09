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
            <div class="row">
                <div class="span25">
                    <form id="searchForm" class="form-horizontal" tabindex="0" style="outline: none;">
                        <div class="row">
                            <div class="control-group span7">
                                <label class="control-label">角色名称：</label>
                                <div class="controls">
                                    <input type="text" name="name" class="control-text">
                                </div>
                            </div>
                            <div class="control-group span7">
                                <label class="control-label">角色id：</label>
                                <div class="controls">
                                    <input type="text" name="id" class="control-text">
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
                            <div class="form-actions span2 offset2">
                                <button id="btnSearch" type="submit" class="button button-primary">搜索</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container">
                <div id="grid">

                </div>
                <p>
                    <button id="btnSave" class="button button-primary">提交</button>
                </p>
            </div>
            <div id="content" class="hide">
                <form id="J_Form" class="form-horizontal">
                    <div class="row">
                        <div class="control-group span8">
                            <label class="control-label"><s>*</s>角色名称：</label>
                            <div class="controls">
                                <input name="name" type="text" data-rules="{required:true}" class="input-normal control-text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group span8">
                                <label class="control-label">排序：</label>
                                <div class="controls  bui-form-group">
                                    <input name="order_by" type="text" data-rules="{number:true}" class="input-normal control-text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group span8">
                                <label class="control-label">状态：</label>
                                <div class="controls  bui-form-group">
                                    <select name="status" class="input-normal">
                                        <option value="0">启用</option>
                                        <option value="1">禁用</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div> 
        <script type="text/javascript" src="<?php echo SITE_PUBLIC; ?>/js/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_PUBLIC; ?>/js/bui-min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_PUBLIC; ?>/js/config.js"></script>
        <script type="text/javascript" src="<?php echo SITE_PUBLIC; ?>/js/hei/common.js"></script>
        <script type="text/javascript" src="<?php echo SITE_PUBLIC; ?>/js/hei/role.js"></script>
    </body>
</html> 

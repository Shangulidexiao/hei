<?php

$config = array(
    #用户登陆
    'login' => array(
        array(
            'field' => 'userName',
            'label' => '用户名',
            'rules' => 'trim|required|min_length[5]|max_length[16]'
        ),
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'trim|required|min_length[6]'
        ),
        array(
            'field' => 'captcha',
            'label' => '验证码',
            'rules' => 'trim|required|exact_length[4]'
        ),
    ),
    #管理员列表
    'adminList' => array(
        array(
            'field' => 'start',
            'label' => '',
            'rules' => 'trim|required|integer'
            ),
        array(
            'field' => 'limit',
            'label' => '',
            'rules' => 'trim|required|integer'
            ),
        ),
    #管理员更新
    'adminUpdate' => array(
        array(
            'field' => 'id',
            'label' => '',
            'rules' => 'trim|required|integer'
            ),
        array(
            'field' => 'true_name',
            'label' => '',
            'rules' => 'trim'
            ),
        array(
            'field' => 'mobile',
            'label' => '',
            'rules' => 'trim|integer'
            ),
        array(
            'field' => 'email',
            'label' => '',
            'rules' => 'trim|valid_email'
            ),
        ),
    #管理员添加
    'adminUpdate' => array(
        array(
            'field' => 'id',
            'label' => '',
            'rules' => 'trim|required|integer'
            ),
        array(
            'field' => 'true_name',
            'label' => '',
            'rules' => 'trim'
            ),
        array(
            'field' => 'order_by',
            'label' => '',
            'rules' => 'trim|integer'
            ),
        array(
            'field' => 'email',
            'label' => '',
            'rules' => 'trim|valid_email'
            ),
        ),
    #文章添加
    'blog' => array(
        array(
            'field' => 'title',
            'label' => '标题不能为空',
            'rules' => 'trim|required'
            ),
        array(
            'field' => 'content',
            'label' => '',
            'rules' => 'trim|required'
            ),
        array(
            'field' => 'order_by',
            'label' => '',
            'rules' => 'trim|integer'
            ),
        array(
            'field' => 'category_id',
            'label' => '',
            'rules' => 'trim|integer'
            ),
        array(
            'field' => 'is_comment',
            'label' => '',
            'rules' => 'trim|integer'
            ),
        array(
            'field' => 'is_visable',
            'label' => '',
            'rules' => 'trim|integer'
            ),
        ),
);
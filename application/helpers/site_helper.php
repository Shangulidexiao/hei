<?php

/**
 *  CodeIgniter 
 *  网站的公用函数
 * @author Han Jian <18335831710@163.com>
 * @date 2016-10-11 1:14:48 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

//生成密码
if ( ! function_exists('password'))
{
    function password($password){
        return password_hash( SALT . $password, PASSWORD_BCRYPT );
    }
}

if ( ! function_exists('checkPassword'))
{
    function checkPassword($hash,$password){
        return password_verify(SALT.$hash,$password);
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *  CodeIgniter 
 *  json公用函数
 * @author Han Jian <18335831710@163.com>
 * @date 2016-10-11 1:14:48 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('ajaxJson'))
{
    function ajaxJson($message='请求成功',$code=200,$data = array()){
        die(json_encode(array(
                        'code'=>$code,
                        'msg'=>$message,
                        'data'=>$data))
                        );
    }
}


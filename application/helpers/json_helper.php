<?php

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


<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * 百度编辑器后端代码
 * @date    2017-01-20
 * @author    hj<18335831710@163.com>
 */

class Ueditor extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function upload(){
        $action = $this->input->get('action');
        switch ($action){
            case 'config' : 
                $this->outputConfig();
                break;
            case 'uploadimage':
                    $this->config->load('upload',true);
                    $upload = $this->config->item('upload');
                    $config['upload_path']      = $upload['uploadImagePath'];
                    $config['allowed_types']    = 'gif|jpg|png';
                    $config['max_size']         = 2048000;
                    $config['max_width']        = 1024;
                    $config['max_height']       = 768;
                    $config['dir']              = 'images';
                    $this->uploadHelp($config);
                break;
            case 'uploadvideo':
                    $this->config->load('upload',true);
                    $upload = $this->config->item('upload');
                    $config['upload_path']      = $upload['uploadVideoPath'];
                    $config['max_size']         = 102400000;
                    $config['dir']              = 'videos';
                    $this->uploadHelp($config);
                break;
            default :
                    $this->config->load('upload',true);
                    $upload = $this->config->item('upload');
                    $config['allowed_types']    = '*';
                    $config['upload_path']      = $upload['uploadFilePath'];
                    $config['max_size']         = 102400000;
                    $config['dir']              = 'files';
                    $this->uploadHelp($config);
        }
        die(json_encode(array('没有成功')));
    }
    
    private function outputConfig(){
        $ueditor = $this->config->load('ueditor',true);
        if(!$ueditor){
            die(json_encode(array()));
        }
        $ueditorArr = $this->config->item('ueditor');
        die(json_encode($ueditorArr));
    }
    
    private function uploadHelp(ARRAY $config){
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('upfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->respnseInfo($error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $data['dir'] = $config['dir'];
            $this->respnseInfo('SUCCESS',$data);
        }
    }
    
    private function respnseInfo($state='',$data=array()){
        $info['state'] = $state;//上传状态
        if($state === 'SUCCESS'){//上传成功返回相应的信息
            $this->config->load('upload',true);
            $upload = $this->config->item('upload');
            $domain = $this->config->site_url();
            $imageUrl = $domain.$upload['uploadUri'].$data['dir'].'/'. $data['upload_data']["file_name"];
            $info["url"]        = $imageUrl ;           //返回的地址
            $info["title"]      = $data['upload_data']["file_name"];          //新文件名
            $info["original"]   = $data['upload_data']["orig_name"];      //原始文件名
            $info["type"]       = $data['upload_data']["file_type"];            //文件类型
            $info["size"]       = $data['upload_data']["file_size"];           //文件大小
        }
        
        die(json_encode($info));
    }
    
}

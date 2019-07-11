<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class UploadImg
{
    
    public function UploadImages($imagename,$pathname)
    {
        $CI =& get_instance();
        $filename=""; 	   
        $config['upload_path'] =$pathname;
        $config['allowed_types'] = 'jpg|pdf|png|gif|JPG';
        $config['max_size']	= '100000';		
        $config['overwrite'] = 'false';
        $now = time();
        $human = $now;
        $rand = $human.uniqid('12');
        $config['file_name'] = $rand;
        $filename =$imagename;
        $CI->load->library('upload', $config);
        $UPLOAD = $CI->upload->do_upload();
        if ( ! $UPLOAD )
        {   
            return  $filename="";
        }

        else
        {	
            $upload_data = $CI->upload->data(); 
            $filename = $upload_data['file_name'];
            $filepath=$pathname.$filename;
            return $filepath;
        }
    }
}

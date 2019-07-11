<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Checklogin extends CI_Controller {
    public function __construct()
    {
         parent::__construct();
         $this->load->helper('form');
         $this->load->helper('url');  
         $this->load->Model('Login_model');   
         if(!$this->session->userdata('user_id'))
         {
             redirect(site_url('Login'));
         }   
    }
    function checkName()
    {
         $Username=str_replace(' ','',$this->input->post('username'));
         $Password=trim($this->input->post('password'));
         $login=$this->Login_model->checklogin($Username,$Password);
         if($login>0)
         {
                    $this->session->set_userdata
                        (
                        array(
                            'user_id'=>$login->user_id, 
                            'branch_code'=>$login->branch_code,
                            'full_name'=>$login->full_name,
                            'full_name_kh'=>$login->full_name_kh,
                            'username'=>$login->username,
                            'phone'=>$login->phone,
                            'role_id'=>$login->role_id,
                            'menu_option'=>$login->menu_option,
                            'role'=>$login->role,
                            'system_id'=>$login->system_id,
                            'hid'=>$login->hid,
                            'types'=>$login->types,
                            'subbranch'=>$login->subbranch
                             )
                        );
                    $setstatus=array(
                                    'last_time_login'=>date('Y-m-d h:i:s'),
                                    'time_login'=>date('Y-m-d h:i:s'),
                                    "status"=>1
                                    );
                    $this->db->where("user_id",$res->user_id);
                    $this->db->update('users',$setstatus);
                    redirect(site_url('Home'));
        }
    }

}
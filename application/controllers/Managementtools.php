<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Managementtools extends CI_Controller {
     public function __construct()
    {
         parent::__construct();
         $this->load->library('polyglot');
         $this->lang->load('home', $this->session->userdata('language'));
         $this->load->model('menu_model');
         $this->load->model('managementskp_model');
    }
    public function skp_Tools()
    {
        
        $data['stools']=$this->managementskp_model->getErrorsSKP();
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='setting/skptools';
        $this->load->view('master_page',$data);
    }
}
?>
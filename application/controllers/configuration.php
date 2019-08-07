<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Configuration extends CI_Controller {
    public function __construct()
    {
         parent::__construct();
         $this->load->helper('form');
         $this->load->helper('url');  
         $this->load->Model('Login_model'); 
         $this->load->model('menu_model');  
         $this->load->model('Config_model');
         if(!$this->session->userdata('user_id'))
         {
             redirect(site_url('Login'));
         }   
         include('Utility.php');
         $this->load->model('users_model');
    }
    public function semail(){

        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['hremail']=$this->Config_model->gethremail();
        $data['titlepage']="Home Page";
        $data['views']='Configuration/email';
        $this->load->view('master_page',$data);
    }
    public function email_config(){

        if($this->input->post("edit_config")=="edit_config"){

            $title_email=$this->input->post("title_email");
            $protocol=$this->input->post("protocol");
            $from=$this->input->post("from");
            $smtp_host=$this->input->post('smtp_host');
            $smtp_port=$this->input->post('smtp_port');
            $smtp_user=$this->input->post('smtp_user');
            $smtp_pass=$this->input->post('smtp_pass');
            $mailtype=$this->input->post('mailtype');
            $charset=$this->input->post('charset');

            $data=[
                    "title_email"=>$title_email,
                    "protocol"=>$protocol,
                    "from"=>$from,
                    "smtp_host"=>$smtp_host,
                    "smtp_port"=>$smtp_port,
                    "smtp_user"=>$smtp_user,
                    "smtp_pass"=>$smtp_pass,
                    "mailtype"=>$mailtype,
                    "charset"=>$charset,
                ];
            $this->db->where('id',1);
            $this->db->update("email_config",$data);

        }
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['email']=$this->Config_model->email_config();
        $data['titlepage']="Home Page";
        $data['views']='Configuration/email_config';
        $this->load->view('master_page',$data);
    }
    
    public function edit_Email(){
        $emaillist=$this->input->post("email_list");
        $hrname=$this->input->post("HRName");
        $flag=$this->input->post("status");
        $event=$this->input->post('event');
        $data=[
                "email"=>$emaillist,
                "hr_name"=>$hrname,
                "event"=>$event,
                "flag"=>$flag
             ];
        $this->db->where('id',1);
        $this->db->update("hr_email",$data);
        redirect(site_url('email'));
    }
    public function administrator_email(){
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['adminemail']=$this->Config_model->getemailadministrator();
        $data['titlepage']="Home Page";
        $data['views']='Configuration/administrator_email';
        $this->load->view('master_page',$data);
    }
    public function brnachlist(){

        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['brlist']=$this->Config_model->getbranchlist();
        $data['titlepage']="Home Page";
        $data['views']='Configuration/branchlist';
        $this->load->view('master_page',$data);
    }
    public function brnachmap(){
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['brlist']=$this->Config_model->getbranchlist();
        $data['titlepage']="Home Page";
        $data['views']='Configuration/branchmap';
        $this->load->view('master_page',$data);
    }

    public function configrm()
    {
        $Utility=new Utility();
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['total_rows']=$this->users_model->Totalconfigrm();
        $page = $this->uri->segment(3) ? $this->uri->segment(3):1;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
        }
        $data['manager']=$this->users_model->getconfigrm($page);
        $data['branch']=$this->users_model->GetBranchcheck();  
        $base_url= base_url()."index.php/configrm";
        $total_rows= $this->users_model->Totalconfigrm();
        $Utility->pagination_config($total_rows,$base_url);        
        $data['titlepage']="Home Page";
        $data['views']='Configuration/configrm';
        $this->load->view('master_page',$data);
    }

    public function configmanager()
    {
        $Utility=new Utility();
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['total_rows']=$this->users_model->Totalmanager();
        $page = $this->uri->segment(3) ? $this->uri->segment(3):1;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
        }
        $data['manager']=$this->users_model->getmanager($page);
        $base_url= base_url()."index.php/user/configmanager";
        $total_rows= $this->users_model->Totalmanager();
        $Utility->pagination_config($total_rows,$base_url);        
        $data['titlepage']="Home Page";
        $data['views']='Configuration/configmanager';
        $this->load->view('master_page',$data);
    }
   

}
?>
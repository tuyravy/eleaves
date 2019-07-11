<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
     public function __construct()
    {
         parent::__construct();         
         $this->load->model('menu_model');
         $this->load->model('Dashboard_model');
         $this->load->helper('url');
         $this->load->helper('form');         
         if (!$this->session->userdata('user_id')) {
            redirect(site_url('login'));
        }
    }
    public function index()
    {   
            $brcode=$this->session->userdata('branch_code');
            $sbrcode=$this->session->userdata('subbranch');
            $role=$this->session->userdata('role');
            $sid=$this->session->userdata('system_id');
            $data['dashboard']=$this->Dashboard_model->getDashoboard($brcode,$sbrcode,$role,1);
            $data['eleaves']=$this->Dashboard_model->getDashoboard($brcode,$sbrcode,$role,2);
            $data['reject']=$this->Dashboard_model->getDashoboard($brcode,$sbrcode,$role,3);
            $data['request']=$this->Dashboard_model->getDashoboard($brcode,$sbrcode,$role,4);
            $data['dashboardrm']=$this->Dashboard_model->getDashoboardRM($sid,1);
            $data['eleavesrm']=$this->Dashboard_model->getDashoboardRM($sid,2);
            $data['rejectrm']=$this->Dashboard_model->getDashoboardRM($sid,3);
            $data['byrm']=$this->Dashboard_model->getDashoboardRM($sid,4);
          
            
            $data['title'] = lang('system_titel');
            $data['menulist']=$this->menu_model->getUsermenu();
            $data['submenu']=$this->menu_model->getsubMenu();
            $data['titlepage']="Home Page";
            
            if($this->session->userdata('role')==3)
            {
                $data['views']='users/role3';
            }else if($this->session->userdata('role')==4)
            {
                $data['views']='users/role4';
            }
            else if($this->session->userdata('role')==1)
            {
                //$data['views']='users/role1';
            }
            else
            {
                $data['views']='master';
            }
            $this->load->view('master_page',$data);
        
         
    }
    public function reqeustnewstaff()
    {
        $staffid=$this->input->post('staffid');        
        $staffname=$this->input->post('staffname');
        $staffnameeng=$this->input->post('staffnameeng');
        $note=$this->input->post('note');
        $data=array(
                        "staffid"=>$staffid,
                        "staffName"=>$staffname,
                        "staffNameeng"=>$staffnameeng,
                        "Note"=>$note,
                        "brcode"=>$this->session->userdata('branch_code'),
                        "requestdate"=>date('Y-m-d'),
                        "rm_id"=>$this->session->userdata('system_id'),
                        "status"=>1
                    );
        $re=$this->db->insert("requeststaff",$data);
        if($re==true)
        {
            return redirect(site_url('home'));
        }else
        {
            echo "Errors Insert";
        }
    }
}
?>
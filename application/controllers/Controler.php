<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Controler extends CI_Controller {
     public function __construct()
    {
         parent::__construct();         
         $this->load->model('menu_model');
         $this->load->model('Reports_model');
         $this->load->model('Controler_model');
         $this->load->model('Csv_model');
         include('Utility.php');
         if(!$this->session->userdata('user_id'))
         {
             redirect(site_url('Login'));
         }
    }
    public function index()
    {
        $Utility=new Utility();
        $brcode=$this->session->userdata('branch_code');
        $subcode=$this->session->userdata('subbranch');
        $sid=$this->session->userdata('system_id');
        $role = $this->session->userdata('role'); 
        $userid = $this->session->userdata('user_id'); 
        $per_page = $this->uri->segment(3) ? $this->uri->segment(3):1;
        if($per_page=='' || $per_page==1)
        { 
            $per_page=0;
        }else
        {
            $per_page=$_GET['per_page'];
        }
        $base_url= base_url()."index.php/Controler/";
        $total_rows= $this->Reports_model->Totalnumrow($sid,$role,$brcode,$userid);
        $Utility->pagination_config($total_rows,$base_url);
        $data['rm']=$this->Controler_model->GetRmName();
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='Option/Controler';
        $this->load->view('master_page',$data);
    } 
    public function getEidtRm()
    {
         
         
             $id=1;
             $result=$this->Controler_model->GetRmNamebyID($id);
             foreach($result as $row){
                echo $row->Name;
                
             }
             
         
    }
    public function AutoImport()
    {
       /*1:Import To table Staff Process*/
       $imp=$this->Controler_model->Runimport_tblProcess();
       /*2:Run Check id by RM*/
       $run=$this->Controler_model->RunSetRMCode();
       /*3:Run Check id by HID*/
       $hid=$this->Controler_model->gethid();
       /*4:Run Create balance leaves*/
       $ct=$this->Csv_model->createbalanceleave();
       $sff=$this->Controler_model->Runimport_tblStaff();
    }
    public function AddRmName()
    {
        $RmName=$this->input->post('FirstName');
        $BrControl=$this->input->post('BrControl');
        $Des=$this->input->post('Description');
        $sid=$this->input->post('sid');
        $email=$this->input->post('email');
        $this->Controler_model->AddRmName($RmName,$BrControl,$Des,$sid,$email);
        redirect('Controler');
    }
    public function deleteRmName($id)
    {
        $this->Controler_model->DeleteRmName($id);
        redirect('Controler');
    }
}
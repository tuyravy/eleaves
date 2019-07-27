<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class user extends CI_Controller {
     public function __construct()
    {
         parent::__construct();
         $this->load->library('polyglot');
         $this->lang->load('home', $this->session->userdata('language'));
         $this->load->model('menu_model');
         $this->load->model('Csv_model');
         $this->load->model('staff_model');
         $this->load->model('users_model');
         $this->load->model('Config_model');
         $this->load->library('csvimport');
         $this->load->library("pagination");
         $this->load->model('Reports_model');
         include('Utility.php');
         
    }
    public function index()
    {
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='users/imports/imports_staff';
        $this->load->view('master_page',$data);
    }
    public function leavesover()
    {
        $Utility=new Utility();
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['total_rows']=$this->users_model->TotalnumrowLeaveOver();
        $page = $this->uri->segment(3) ? $this->uri->segment(3):1;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
        }
        
        $base_url= base_url()."index.php/user/leavesover";
        $total_rows= $this->users_model->TotalnumrowLeaveOver();
        $Utility->pagination_config($total_rows,$base_url);
        $data['LeaveOver']=$this->users_model->GetLeaveOverbyBranch($page);
        $data['titlepage']="Home Page";
        $data['views']='users/option/leavesover';
        $this->load->view('master_page',$data);

    }
    public function listofuser()
    {
        $Utility=new Utility();
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['total_rows']=$this->users_model->Totallistofuser();
        $page = $this->uri->segment(3) ? $this->uri->segment(3):1;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
        }
        $data['listofuser']=$this->users_model->GetlistofUser($page);
        $base_url= base_url()."index.php/user/listofuser";
        $total_rows= $this->users_model->TotalnumrowLeaveOver();
        $Utility->pagination_config($total_rows,$base_url);        
        $data['titlepage']="Home Page";
        $data['views']='users/option/listofuser';
        $this->load->view('master_page',$data);
    }
    public function listofstaffNotYetuser()
    {
        $Utility=new Utility();
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['total_rows']=$this->users_model->Totalnumstaffnotyetuser();
        $page = $this->uri->segment(3) ? $this->uri->segment(3):1;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
        }
        $data['listofuser']=$this->users_model->GetlistofStaffnotyetUser($page);
        $data['role']=$this->users_model->Getrole();
        $base_url= base_url()."index.php/user/listofstaffNotYetuser";
        $total_rows= $this->users_model->Totalnumstaffnotyetuser();
        $Utility->pagination_config($total_rows,$base_url);        
        $data['titlepage']="Home Page";
        $data['views']='users/option/listofstaff';
        $this->load->view('master_page',$data);
    }
    PUBLIC FUNCTION SETUSER()
    {
         $usertype=$this->input->post("usertype");
         $sid=$this->input->post("systemid");
         $email=$this->input->post("email");
         $create=$this->users_model->CreateUser($usertype,$sid,$email);
         if($create==true)
         {
            $this->session->set_flashdata('success', 'លោកអ្នកបង្កើត ទទួលបានជោគជ័យ!');
            $row=$this->users_model->GETUSERBYSID($sid);
            $to=$email;
            $tocc="ravy@sahakrinpheap.com.kh,umbros@sahakrinpheap.com.kh";
            $this->autosenttouser($row->full_name,$row->shortcode,$row->branch_code,str_replace(' ','',$row->username),$row->system_id,date("Y-m-d"),$tocc,$to,$this->session->userdata('full_name'));
            redirect(site_url("user/listofstaffNotYetuser"));
         }
         else
         {
            $this->session->set_flashdata('erorr', 'លោកអ្នកបង្កើតមិនបានជោគជ័យទេ!');
            redirect(site_url("user/listofstaffNotYetuser"));
         }
    }
    PUBLIC FUNCTION NOTSENDUSER($role)
    {
        $data=$this->users_model->GETSENDUSER($role);
        echo json_encode($data);
    }
    public function DeleteUser($id)
    {
        $data=array("flag"=>0,'status'=>0);
        $this->db->where("system_id",$id);
        $this->db->update("users",$data);
    }
    public function DeleteStaff($id)
    {
        $data=array("active"=>0);
        $this->db->where("system_id",$id);
        $this->db->update("staff",$data);
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
        $data['views']='users/option/configmanager';
        $this->load->view('master_page',$data);
    }
    public function configrm()
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
        $data['manager']=$this->users_model->getconfigrm($page);
        $data['branch']=$this->users_model->GetBranchcheck();  
        $base_url= base_url()."index.php/user/configrm";
        $total_rows= $this->users_model->Totalconfigrm();
        $Utility->pagination_config($total_rows,$base_url);        
        $data['titlepage']="Home Page";
        $data['views']='users/option/configrm';
        $this->load->view('master_page',$data);
    }
    public function BranchCheck()
    {
            
        echo json_encode($data);
    }
    public function EditRM()
    {
        
        if(isset($_POST['id'])){
                $id=$_POST['id'];
                $result=$this->users_model->EditRMName($id);
                $brach=array();
                foreach($result as $row)
                {
                    $data['name']=$row->name;
                    $data['email']=$row->email;
                    $data['sid']=$row->sid;
                    $data['branch_control']=$row->branch_control;
                    
                } 
                              
                echo json_encode($data);
        }

    }
    public function GetBranchbyRM($id)
    {
        $brControl=$this->users_model->Getbranch_control($id);  
                $tbl="";
                echo "<div class='checkbox'>";
                foreach($brControl as $key=>$value)
                {
                    $tbl.="<label>";
                    if($value["statu"]==0){
                        $tbl.="<input type='checkbox' id='chkbx' value='".$value["BrCode"]."' checked>";
                        $tbl.="<span style='margin-left:1px;'>".trim($value['BrName'])."</span>";
                        $tbl.="<span style='padding:10px;'></span>";
                    }else
                    {
                        
                        $tbl.="<input type='checkbox' id='chkbx' value='".$value['BrCode']."'>";                       
                        $tbl.="<span style='margin-left:1px;'>".trim($value['BrName'])."</span>";
                        $tbl.="<span style='padding:10px;'></span>";
                    }   
                    $tbl.="</label>";                          
                }
                echo "</div>";
                echo $tbl;         
    }

    /*=================Import staff=============*/
    public function importstaffinformation()
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
        $data['manager']=$this->users_model->getconfigrm($page);
        $data['branch']=$this->users_model->GetBranchcheck();  
        $base_url= base_url()."index.php/user/importstaffinformation";
        $total_rows= $this->users_model->Totalconfigrm();
        $Utility->pagination_config($total_rows,$base_url);        
        $data['titlepage']="Home Page";
        $data['views']='users/staff/importstaffinformation';
        $this->load->view('master_page',$data);
    }

    public function importstaff()
    {
        $data['error'] = '';    //initialize image upload error array to empty
        $config['upload_path'] = './importsfile/';
        $config['allowed_types'] = 'csv|xls';
        $config['max_size'] = '800000';
        $this->load->library('upload',$config);
        // If upload failed, display error
        if (!$this->upload->do_upload()) {

            $this->session->set_flashdata('error', 'លោកអ្នក Imports មិនបានជោគជ័យ!');
            redirect(site_url("importstaffinformation"));
            } else {
            $file_data = $this->upload->data();
            $file_path = './importsfile/' . $file_data['file_name'];
            $header=$this->Csv_model->get_all_header();       
            
            if(!$this->csvimport->get_array($file_path,$header)){
                
                $this->session->set_flashdata('error', 'លោកអ្នក Imports មិនបានជោគជ័យ!');
                redirect(site_url("importstaffinformation"));
            }else{
                         $csv_array =$this->csvimport->get_array($file_path,$header);
                        $reportdate='';
                        foreach ($csv_array as $row)
                                        {              
                                            $data_insert=array
                                                (
                                                'MB_CID'=>$row['MB_CID'],
                                                'MB_StaffName'=>$row['MB_StaffName'],
                                                'MB_StaffNameKh'=>$row['MB_StaffNameKh'],
                                                'DoB'=>date("Y-m-d", strtotime($row['DoB'])),
                                                'StaffCode'=>$row['StaffCode'],
                                                'MB_PositionCode'=>$row['MB_PositionCode'],
                                                'MB_PositionName'=>$row['MB_PositionName'],
                                                'DoE'=>date("Y-m-d", strtotime($row['DoE'])),
                                                'BrCode'=>$row['BrCode'],
                                                'BrLetter'=>$row['BrLetter'],
                                                'BrNameFull'=>$row['BrNameFull'],
                                                'ReportDate'=>date("Y-m-d", strtotime($row['ReportDate']))
                                               
                                                );
                                            $this->db->insert('staff_informations', $data_insert);
                                        }
                         unlink($file_path);
                         $this->session->set_flashdata('success', 'លោកអ្នក Imports បានជោគជ័យ!');
                        redirect(site_url("importstaffinformation"));
                    } 
                  
                    
                }
            }

    public function staffcompare()
    {
        $Utility=new Utility();
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['total_rows']=$this->users_model->TOTALSTAFFINFORMATION();
        $page = $this->uri->segment(3) ? $this->uri->segment(3):1;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
        }
        $data['staff']=$this->users_model->GETSTAFFINFORMATION($page);  
        $data['branch']=$this->users_model->GetBranchcheck();      
        $base_url= base_url()."index.php/user/staffcompare";
        $total_rows= $this->users_model->TOTALSTAFFINFORMATION();
        $Utility->pagination_config($total_rows,$base_url);        
        $data['titlepage']="Home Page";
        $data['views']='users/staff/staffcompare';
        $this->load->view('master_page',$data);
    }
    public function GetStaffComparebyBrCode($brCode)
    {
        $data=$this->users_model->GETSTAFFINFORMATIONBYBRCODE($brCode);
        echo json_encode($data);

    }
    public function staffrequestchange()
    {
        $Utility=new Utility();
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['total_rows']=$this->users_model->TOTALSTAFFREQUESTCHANGE();
        $page = $this->uri->segment(3) ? $this->uri->segment(3):1;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
        }
        $data['staff']=$this->users_model->GETSTAFFREQUESTCHANGE($page);  
        $data['branch']=$this->users_model->GetBranchcheck();      
        $base_url= base_url()."index.php/user/staffrequestchange";
        $total_rows= $this->users_model->TOTALSTAFFREQUESTCHANGE();
        $Utility->pagination_config($total_rows,$base_url);        
        $data['titlepage']="Home Page";
        $data['views']='users/staff/staffrequestchange';
        $this->load->view('master_page',$data);
        

    }
    public function GetStaffREQUESTCHANGEBrCode($brCode)
    {
        $data=$this->users_model->GETSTAFFREQUESTCHANGENBYBRCODE($brCode);
        echo json_encode($data);

    }
    public function setrequestchange($sid)
    {
        $data=array("rechange"=>1);
        $this->db->where("system_id",$sid);
        $this->db->update('staff',$data);
    }
    public function unsetrequestchange($sid)
    {
        $data=array("rechange"=>0);
        $this->db->where("system_id",$sid);
        $this->db->update('staff',$data);
    }
    
    /*===============End Import staff=========*/



    public function AddUserFunction()
    {
        $data['title'] = lang('system_titel');
        
        $data['listmenu']=$this->users_model->menulist();
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='users/setting/listofpromistion';
        $this->load->view('master_page',$data);
    }
    public function Searchstaff()
    {
        $stid=trim($this->input->post("staffid"));
        $data['listmenu']=$this->users_model->menulist();
        $data['staffname']=$this->users_model->Searchstaffbyid($stid);
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='users/setting/listofpromistion';
        $this->load->view('master_page',$data);
    }
    public function listofstaff()
    {
        $Utility=new Utility();       
        
        if(isset($_GET["per_page"]))
        {
            $page=$_GET["per_page"];
        }else{
            $page=0;
        };

        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');
        $company_id=$this->session->userdata('company_id');
        $systemid=$this->session->userdata('system_id');
        $subcode=$this->session->userdata('subbranch');
        $config=$this->Config_model->getconfig('ex');
        $base_url= base_url()."index.php/liststaff";
        $data['total_rows'] = $this->staff_model->TotalStaff($brcode,$role,$systemid,$company_id,$subcode,$config->keys,$page);
        $total_rows= $this->staff_model->TotalStaff($brcode,$role,$systemid,$company_id,$subcode,$config->keys,$page);
        $Utility->pagination_config($total_rows,$base_url);  

       
        $data['listofstaff']=$this->staff_model->getallstaff($brcode,$role,$systemid,$company_id,$subcode,$config->keys,$page);
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='users/staff/listofstaff';
        $this->load->view('master_page',$data);
    }
   
    public function UserAccessrights(){

        $data['title'] = lang('system_titel');
        $data['branch']=$this->users_model->getBranch();
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='users/useroption/UserAccessrights';
        $this->load->view('master_page',$data);

    }

    public function setinactive($id)
    {
        $data=array
            (
            'active'=>0
            );
        $this->db->where('system_id',$id);
        $this->db->update('staff',$data);
        redirect('liststaff');
    }
    public function setactive($id)
    {
        $data=array
            (
            'active'=>1
            );
        $this->db->where('system_id',$id);
        $this->db->update('staff',$data);
        redirect('liststaff');
    }
    
   
   
   public function createusers()
   {
        $data['title'] = lang('system_titel');
        $data['br']=$this->users_model->getBranch();
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='users/create/create_user';
        $this->load->view('master_page',$data);
   }
   public function setcreate()
   {
       $this->users_model->setcreate();
       redirect('create_users');
   }
    
   //Folder user useroption for new function 
   public function listusers()
   { 
        $Utility=new Utility();       
        $data['total_rows'] = $this->users_model->TotalUser();
        if(isset($_GET["per_page"]))
        {
            $page=$_GET["per_page"];
        }else{
            $page=0;
        };
        
        $base_url= base_url()."index.php/listusers";
        $total_rows= $this->users_model->TotalUser();
        $Utility->pagination_config($total_rows,$base_url);

        $data['title'] = lang('system_titel');
        $data['users']=$this->users_model->getUser($page);
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();

        $data['titlepage']="Home Page";
        $data['views']='users/useroption/user';
        $this->load->view('master_page',$data);
   }
   //Folder user useroption for new function 
   public function addusers()
   { 
        $Utility=new Utility();       
        $data['total_rows'] = $this->users_model->TotaladdUser();
        if(isset($_GET["per_page"]))
        {
            $page=$_GET["per_page"];
        }else{
            $page=0;
        };
        
        $base_url= base_url()."index.php/user/addusers";
        $total_rows= $this->users_model->TotaladdUser();
        $Utility->pagination_config($total_rows,$base_url);

        $data['title'] = lang('system_titel');
        $data['users']=$this->users_model->getaddUser($page);
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();

        $data['titlepage']="Home Page";
        $data['views']='users/useroption/adduser';
        $this->load->view('master_page',$data);
   }

   public function editusers($id)
   {
        $data['title'] = lang('system_titel');
        $data['br']=$this->users_model->getBranch();
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='users/create/create_user';
        $this->load->view('master_page',$data);
   }
   public function profiles()
   {
        
        $data['users']=$this->users_model->getprofile($this->session->userdata('user_id'));
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='setting/cheang_profiles';
        $this->load->view('master_page',$data);
   }
  public function attachfile($attach,$userid)
    {
            
            $getfilepath=$this->db->from('users')
                                ->where('user_id',$userid)
                                ->get()->row();
           
           
            $iname=$getfilepath->profile;
            unlink($iname);
            $config['upload_path'] = './userprofiles/';
            $config['allowed_types'] = 'jpg|pdf|png|gif|JPG';
            $config['max_size']	= '10000';		
            $config['overwrite'] = 'false';
            $now =rand(1,9);
            $human = $now;
            $rand = $human.uniqid('2');
            $config['file_name'] = $rand;
            $filename = $attach.$rand;
            $this->load->library('upload', $config);
            $UPLOAD =  $this->upload->do_upload();

            if ( ! $UPLOAD )
            {   
                    
               
            }

            else
            {	
            $upload_data = $this->upload->data(); 
            $filename = $upload_data['file_name'];
            $filepath='userprofiles/'.$filename;
            $now=date('Y-m-d');
            $attach=array
               (
                "profile"=>$filepath,
                'modified_date'=>date('Y-m-d')
                );
            $this->db->where('user_id',$userid);
            $this->db->update('users',$attach);
            
          }
        
    }
 
  public function errorsprofiles()
  {
            $data['error']=0;
            $data['users']=$this->users_model->getprofile($this->session->userdata('user_id'));
            $data['title'] = lang('system_titel');
            $data['menulist']=$this->menu_model->getUsermenu();
            $data['submenu']=$this->menu_model->getsubMenu();
            $data['titlepage']="Home Page";
            $data['views']='setting/cheang_profiles';
            $this->load->view('master_page',$data);
  }
  public function setprofilesuser()
   {
      
        $userid=$this->session->userdata('user_id');
        $row=$this->input->post();
        $setprofilesid=$this->menu_model->setprofile($userid,$row['sid']);
       
           if($setprofilesid==true)
           {
                
                $this->menu_model->setprofile($userid,$row['sid']);
                redirect('logout');
               
           }else
            {
                redirect('errorsprofiles');
           
            }
   }

   public function importscsv() {
       
       
        $data['error'] = '';    //initialize image upload error array to empty
        $config['upload_path'] = './importsfile/';
        $config['allowed_types'] = 'csv|xlsx';
        $config['max_size'] = '800000';
        $this->load->library('upload',$config);
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
             $data['menulist']=$this->menu_model->getUsermenu();
             $data['submenu']=$this->menu_model->getsubMenu();
             $data['title'] = lang('system_titel');
             $data['viewpage']='importfiles/imports_staff';
             $this->load->view('master_page',$data);
        } else {
            $file_data = $this->upload->data();
            $file_path = './importsfile/' . $file_data['file_name'];
         
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                $reportdate='';
                foreach ($csv_array as $row){
                    
                    
                    $re=$this->db->from('staff')
                                        ->where('flag',1)
                                        ->where('system_id',$row['system_id'])                                    
                                        ->get();
                                if($re->num_rows() >= 1)
                                {
                                    $reportdate=date("Y-m-d");
                                    $data_insert=array
                                        (
                                        'staff_id'=>$row['staff_id'],
                                        'system_id'=>$row['system_id'],
                                        'staff_nameeng'=>$row['staff_nameeng'],
                                        'staff_namekh'=>$row['staff_nameeng'],
                                        'sex'=>$row['sex'],
                                        'position_nameeng'=>$row['position_nameeng'],
                                        'position_namekh'=>$row['position_namekh'],
                                        'brcode'=>$row['brcode'],
                                        'statu'=>$row['statu'],
                                        'dateemployee'=>date("Y-m-d", strtotime($row['dateemployee'])),
                                        'probations'=>$row['probations'],
                                        'date_of_birth'=>date("Y-m-d", strtotime($row['date_of_birth'])),
                                        'degree'=>$row['degree'],
                                        'Id_card_familybook'=>$row['Id_card_familybook'],                                        
                                        'reportdate'=>$reportdate
                                        );
                                    $this->db->where('system_id',$row['system_id']);   
                                    $this->db->update('staff', $data_insert);
                                   
                                }else
                                {
                    
                                   $reportdate=date("Y-m-d");
                                    $data_insert=array
                                        (
                                        'staff_id'=>$row['staff_id'],
                                        'system_id'=>$row['system_id'],
                                        'staff_nameeng'=>$row['staff_nameeng'],
                                        'staff_namekh'=>$row['staff_nameeng'],
                                        'sex'=>$row['sex'],
                                        'position_nameeng'=>$row['position_nameeng'],
                                        'position_namekh'=>$row['position_namekh'],
                                        'brcode'=>$row['brcode'],
                                        'statu'=>$row['statu'],
                                        'dateemployee'=>date("Y-m-d", strtotime($row['dateemployee'])),
                                        'probations'=>$row['probations'],
                                        'date_of_birth'=>date("Y-m-d", strtotime($row['date_of_birth'])),
                                        'degree'=>$row['degree'],
                                        'Id_card_familybook'=>$row['Id_card_familybook'],                                        
                                        'reportdate'=>$reportdate
                                        );
                                    $this->db->insert('staff', $data_insert);
                    
                                }
                    
                }
                
               $hostname=gethostname();
                $data_files=array
                            (
                            'report_date'=>$reportdate,
                            'file_name'=>$file_path,
                            'pc_name'=>$hostname,
                            'created_date'=>date('Y-m-d'),
                            'modified_date'=>date('Y-m-d'),
                            'created_by'=>$this->session->userdata('user_id'),
                            'modified_by'=>$this->session->userdata('user_id')
                            );
                $this->db->insert("upload_history",$data_files);
                $this->Csv_model->createbalanceleave();
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                 $iname=$file_path;
                 unlink($iname);
                redirect('imports_staff');
                
             
            } else
            {
             
             $data['menulist']=$this->menu_model->getUsermenu();
             $data['submenu']=$this->menu_model->getsubMenu();
             $data['title'] = lang('system_titel');
             $data['viewpage']='importfiles/imports_staff';
             $this->load->view('master_page',$data);
                
            }
      }
     }
    
    public function resetpassword($id)
    {
      
        $updates=array(
                        'password'=>'skp@007'
                      );
        $this->db->where('user_id',$id);
        $this->db->update('users',$updates);
        
       return redirect('listusers');
    }
    public function removeuser($id)
    {
        $updates=array(
                        'flag'=>'0'
                      );
        $this->db->where('user_id',$id);
        $this->db->update('users',$updates);
        
       return redirect('listusers');
        
    }
    public function usercontroler($sid=null)
    {
        $this->load->helper('url');
        $data['title'] = lang('system_titel');
        
        $data['alluser']=$this->users_model->getUserCompare();
        $data['allstaff']=$this->users_model->getStaffNotHaveInUser();
        $data['staffdif']=$this->users_model->getUserdifstaffname();
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='users/option/usercontrol';
        $this->load->view('master_page',$data);

    }
    public function refreshpassword($sid)
    {
            $data=array("password"=>"skp@007",
                        "reset_password"=>1,
                        "keys"=>1);
            $this->db->where('flag',1);
            $this->db->where('system_id',$sid);
            $this->db->update('users',$data);
            return redirect('usercontroler');
    }
    public function setrefreshpassword($sid)
    {
        //$sid=$this->input->post("sid");
        $email=$this->users_model->getbysystem_id($sid);
        $date=date("Y-m-d");
        $tocc="tuyravey99@gmail.com";
        $this->sendtouser($email->full_name,$email->BrName,$email->brcode,$email->username,$sid,date("d - M- Y",strtotime($date)),$email->positionname,$tocc,$email->email);
        return redirect('usercontroler');
    }
    public function staffcontroler()
    {
        
        $start=Date("Y-m-01");            
        $end=Date("Y-m-30");
        $brcode=0;
        $statu=1;        
        $Utility=new Utility();
        $sid=$this->session->userdata('system_id');
        $role = $this->session->userdata('role'); 
        $userid = $this->session->userdata('user_id');    
        $data['position']=$this->users_model->getposition();
        $data['total_rows'] = $this->users_model->TotalNumberStaff($start,$end,$brcode,$statu);
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        if($page==""){ $page=0;}
        $base_url= base_url()."index.php/user/staffcontroler";
        $data["Branch"]=$this->users_model->getBranch();
        $total_rows= $this->users_model->TotalNumberStaff($start,$end,$brcode,$statu);
        $Utility->pagination_config($total_rows,$base_url);
        $data['staffControl']=$this->users_model->GetStaffControl($start,$end,$brcode,$statu,$page);       
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='users/option/staffcontrol';
        $this->load->view('master_page',$data);

    }
    public function staffFitter()
    {
        
        $start=Date("Y-m-d",strtotime($_GET['datestart']));            
        $end=Date("Y-m-d",strtotime($_GET['dateend']));   
        $data['start']=$start; 
        $data['end']=$end;
        $end=Date("Y-m-d",strtotime($_GET['dateend']));          
        $brcode=$_GET['Brcode'];            
        $statu=$_GET['statu'];
        $Utility=new Utility();        
        $sid=$this->session->userdata('system_id');
        $role = $this->session->userdata('role'); 
        $userid = $this->session->userdata('user_id');    
        
        $data['total_rows'] = $this->users_model->TotalNumberStaff($start,$end,$brcode,$statu);
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        if(isset($_GET['per_page']))
        {
           $page =$_GET['per_page'];
        }else
        { 
            if($page==""){ $page=0;}
        }
        
       
        
        $base_url= base_url()."index.php/user/staffFitter?Brcode=".$brcode."&statu=".$statu."&datestart=".$start."&dateend=".$end."";
        $data["Branch"]=$this->users_model->getBranch();
        $total_rows= $this->users_model->TotalNumberStaff($start,$end,$brcode,$statu);
        $Utility->pagination_config($total_rows,$base_url);
        $data['staffControl']=$this->users_model->GetStaffControl($start,$end,$brcode,$statu,$page);       
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='users/option/staffcontrol';
        $this->load->view('master_page',$data);
    }
    public function createuserssendauto()
    {
        $this->load->helper('url');
        $this->load->helper('form');
        $sid=trim($this->input->post("systemid"));
        $email=$this->input->post("email");
        $brcode=$this->input->post("brcode");

        $row=$this->users_model->getStaffNotHaveInUserbysystemid($sid,$brcode);
       
        $data=array
            (
                "system_id"=>$row->system_id,
                "full_name"=>$row->staff_nameeng,
                "full_name_kh"=>$row->staff_namekh,
                "username"=>str_replace(' ','',$row->staff_nameeng),
                "password"=>"skp@007",
                "email"=>$email,
                "phone"=>$row->phone_number,
                "branch_code"=>$row->brcode,
                "subbranch"=>0,
                "menu_option"=>"1,2",
                "submenu_option"=>"7,9,16,17,19",
                "role"=>1,
                "role_id"=>1,
                "created_date"=>date("Y-m-d"),
                "modified_date"=>date("Y-m-d"),
                "keys"=>0,
                "created_by"=>$this->session->userdata('full_name'),
                "modified_by"=>$this->session->userdata('full_name'),
                "reset_password"=>1,
                "types"=>1,
                "flag"=>1
            );
        $this->db->insert("users",$data);
        $to=$email;
        $tocc="ravy@sahakrinpheap.com.kh";
        $this->autosenttouser($row->staff_nameeng,$row->shortcode,$row->brcode,str_replace(' ','',$row->staff_nameeng),$row->system_id,date("Y-m-d"),$tocc,$to,$this->session->userdata('full_name'));
        return redirect('user/addusers');
    }
    public function autosenttouser($StaffName,$brname,$BrCode,$username,$sid,$datechange,$tocc,$to,$createby)
    {
        
               
				$tomanager=$to;
                $ccfrom=$tocc;
                $subject="E-leaves Create User and  Password";
			    $links=site_url().'public/img/logo_simple.png';
			    $messagemanager="
                            <body>
                            <div style='font-family: 'Hanuman', serif;'>
                               <table style='width:100%;border:1px solid #CCC;'>

                                        
                                        <tr>
                                            <td style='padding:0px;font-size:16px'>
                                                <span style='line-height:20px;'>
                                                    <p>គោរពជូនលោកគ្រូ/អ្នកគ្រូ $StaffName</p>
                                                    <p></p>
                                                    <p>លេខគណនីរបស់លោកគ្រូ/អ្នកគ្រូបង្កើតរួចរាល់សូមមើលការណែនាំដូចខាងក្រោម៖</p>                                                    
                                                    <p></p>
                                                     <p>ព័ត៌មានគណនី៖</p>
                                                   
                                               </span> 
                                            </td>
                                        </tr>


                                            <tr>
                                               <td>
                                                <table style='width:50%;'>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>
                                                        <p>- BrName</p>
                                                        
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>
                                                        <p>:<span style='margin-left:10px;'>$brname</span></p>
                                                        
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>
                                                        
                                                        <p>- BrCode:</p>
                                                       
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>
                                                        
                                                        <p>:<span style='margin-left:10px;'>$BrCode</span></p>
                                                        
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>                                                        
                                                        <p>- Staff Name:</p>
                                                       
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>                                                        
                                                        <p>:<span style='margin-left:10px;'>$StaffName</span></p>
                                                       
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>- Username:</p>                                                   
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>:<span style='margin-left:10px;'>$username</span></p>
                                                       
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;white-space: nowrap;overflow: hidden;'>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p style='white-space: nowrap;overflow: hidden;'>- New Password</p>                                                   
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>:<span style='margin-left:10px;'>skp@007</span></p>
                                                       
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>- Note</p>                                                   
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>:<span style='margin-left:10px;'>សូមធ្វើការផ្លាល់ប្ដូរលេខសម្ងាត់របស់លោកគ្រូ / អ្នកគ្រូបន្ទាប់ពីប្រព័ន្ធស្នើរសុំផ្លាស់ប្ដូរ !</span></p>
                                                       
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>- Create Date</p>                                                
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>:<span style='margin-left:10px;'>$datechange</span></p>                                                       
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>- Create By</p>                                                
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>:<span style='margin-left:10px;'>$createby</span></p>                                                       
                                                    </div>
                                                    </td>

                                                   </tr>
                                                </table>
                                               </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    
                                                    <p>សម្គាល់៖ <p/>
                                                    <p>សូមចុចត្រង់តំននេះដើម្បីចូលទៅក្នុងប្រព័ន្ធអនុញ្ញាតច្បាប់ <a href='http://www.app.sahakrinpheap.com/eleaves/'>Click Here....</a></p>
                                                    <p>(<span style='color:#151515;'>មិនត្រូវ Forward ឬ Reply ឡើយ</span>)</p>
                                                    <p>www.sahakrinpheap.com.kh</p>
                                                </td>
                                            </tr>
                                            
                                        </table>

                            </div></body>";
                $this->sendMail($messagemanager,$ccfrom,$tomanager,$subject);
               

    }

    public function sendtouser($StaffName,$brname,$BrCode,$username,$sid,$datechange,$postion,$tocc,$to)
    {
        
               
				$tomanager=$to;
                $ccfrom=$tocc;
                $subject="E-leaves Refresh Password";
			    $links=site_url().'public/img/logo_simple.png';
			    $messagemanager="
                            <body>
                            <div style='font-family: 'Hanuman', serif;'>
                               <table style='width:100%;border:1px solid #CCC;'>

                                        
                                        <tr>
                                            <td style='padding:0px;font-size:16px'>
                                                <span style='line-height:20px;'>
                                                    <p>គោរពជូនលោកគ្រូ/អ្នកគ្រូ $StaffName</p>
                                                    <p></p>
                                                    <p>លេខសម្ងាត់របស់លោកគ្រូ/អ្នកគ្រូត្រូវបានផ្លាល់ប្ដូរសូមអរគុណ!</p>                                                    
                                                    <p></p>
                                                     <p>ព័ត៌មានគណនី៖</p>
                                                   
                                               </span> 
                                            </td>
                                        </tr>


                                            <tr>
                                               <td>
                                                <table style='width:50%;'>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>
                                                        <p>- BrName</p>
                                                        
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>
                                                        <p>:<span style='margin-left:10px;'>$brname</span></p>
                                                        
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>
                                                        
                                                        <p>- BrCode:</p>
                                                       
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>
                                                        
                                                        <p>:<span style='margin-left:10px;'>$BrCode</span></p>
                                                        
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>                                                        
                                                        <p>- Staff Name:</p>
                                                       
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>                                                        
                                                        <p>:<span style='margin-left:10px;'>$StaffName</span></p>
                                                       
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>                                                        
                                                        <p>- Position:</p>                                                       
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>:<span style='margin-left:10px;'>$postion</span></p>
                                                       
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>- Username:</p>                                                   
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>:<span style='margin-left:10px;'>$username</span></p>
                                                       
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;white-space: nowrap;overflow: hidden;'>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p style='white-space: nowrap;overflow: hidden;'>- New Password</p>                                                   
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>:<span style='margin-left:10px;'>skp@007</span></p>
                                                       
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>- Note</p>                                                   
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>:<span style='margin-left:10px;'>សូមធ្វើការផ្លាល់ប្ដូរលេខសម្ងាត់របស់លោកគ្រូ / អ្នកគ្រូបន្ទាប់ពីប្រព័ន្ធស្នើរសុំផ្លាស់ប្ដូរ !</span></p>
                                                       
                                                    </div>
                                                    </td>

                                                   </tr>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>- Change Date</p>                                                
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>                                                        
                                                    <p>:<span style='margin-left:10px;'>$datechange</span></p>                                                       
                                                    </div>
                                                    </td>

                                                   </tr>
                                                </table>
                                               </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    
                                                    <p>សម្គាល់៖ <p/>
                                                    <p>សូមចុចត្រង់តំននេះដើម្បីចូលទៅក្នុងប្រព័ន្ធអនុញ្ញាតច្បាប់ <a href='http://www.app.sahakrinpheap.com/eleaves/'>Click Here....</a></p>
                                                    <p>(<span style='color:#151515;'>មិនត្រូវ Forward ឬ Reply ឡើយ</span>)</p>
                                                    <p>www.sahakrinpheap.com.kh</p>
                                                </td>
                                            </tr>
                                            
                                        </table>

                            </div></body>";
               $this->sendMail($messagemanager,$tocc,$tomanager,$subject);
               

    }
    public function sendMail($message,$tocc,$toM,$subject)
    {
        $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'mail.sahakrinpheap.com',
                    'smtp_port' => 587,
                    'smtp_user' => 'eleave@sahakrinpheap.com',
                    'smtp_pass' => 'cRBy35rD(bL2',
                    'mailtype'  => 'html', 
                    'charset'   => 'utf-8'
                );
        
        /*$config=Array
				(
				  "protocol"	=>'smtp',
				  "smtp_host"	=>'5oceanscambodiacom.ipower.com',
				  "smtp_post"	=>587,
				  "smtp_user"	=>'no-reply@5oceanscambodia.com',
				  "smtp_pass"	=>'Pa$$w0rd',
				  "mailtype"	=>'html',
				  "charset"		=>'utf-8'
		
				);
        */
        $this->load->library('email',$config);
        $this->email->set_newline("\r\n");
        $this->email->from('eleave@sahakrinpheap.com', 'E-Leaves Request');
		$this->email->to($toM);
        $this->email->cc($tocc);
		$this->email->subject($subject);
		$this->email->message($message);
        $result = $this->email->send();
        /*if($this->email->send()){
            //Success email Sent
            echo $this->email->print_debugger();
         }else{
            //Email Failed To Send
            echo $this->email->print_debugger();
         }
        */
    }
   }
?>
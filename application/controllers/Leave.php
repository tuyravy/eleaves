<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class leave extends CI_Controller {
     public function __construct()
    {
         parent::__construct();
         $this->load->library('polyglot');
         $this->lang->load('home', $this->session->userdata('language'));
         $this->load->model('menu_model');
         $this->load->model('staff_model');
         $this->load->model('leavetype_model');
         $this->load->model('leaves_model');
         $this->load->model('reports_model');
         $this->load->model('Manager_model');
         $this->load->model('config_model');
         $this->load->model('users_model');
         include('UploadImg.php');
         include('Utility.php');
         $this->load->helpers("url");
         $this->load->helpers("form");
         if(!$this->session->userdata('user_id'))
         {
             redirect(site_url('Login'));
         }
         
    }
    public function index()//leaves request by user
    {
        $data['title'] = lang('system_titel');
        $brcode=$this->session->userdata('branch_code');
        $sid=$this->session->userdata('system_id');
        $role = $this->session->userdata('role');        
        $subcode = $this->session->userdata('subbranch');
        $company_id=$this->session->userdata('company_id');
        //$data['balance'] = $this->reports_model->gelAllleavesbalance($brcode, $role, $sid, $subcode);        
        $data['leavetypes']=$this->leaves_model->getleavetype($sid);
        //$data['leavetypes']=$this->leavetype_model->getleavetype();
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['managername']=$this->Manager_model->getManagerName($sid,$role,$company_id);
        $data['titlepage']="Home Page";
        $data['views']='leaves/leaves_request';
        $this->load->view('master_page',$data);

    }
    
    public function leaveforother()
    {
        $brcode=$this->session->userdata('branch_code');
        $subbrcode=$this->session->userdata('subbranch');        
        $role = $this->session->userdata('role');      
        $sid=$this->session->userdata('system_id');  
        $subcode = $this->session->userdata('subbranch');
        $data['title'] = lang('system_titel');
        //$data['balance'] = $this->reports_model->gelAllleavesbalance($brcode, $role, $sid, $subcode);
        $data['leavetypes']=$this->leavetype_model->getleavetype();
        $data['staff']=$this->staff_model->getstaff($brcode,$subbrcode);
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='leaves/leaves_forother';
        $this->load->view('master_page',$data);
    }
    public function checkbalance($id)
    {
        $brcode=$this->session->userdata('branch_code');
        $subbrcode=$this->session->userdata('subbranch');        
        $subcode = $this->session->userdata('subbranch');
        $balance= $this->reports_model->gelAllleavesbalance($brcode,1, $id, $subcode);
        $tbl="";
         foreach ($balance as $row) {
                               $tbl.='<tr id="tbody"><td id="smail">';
                               $tbl.=$row->staff_nameeng;
                               $tbl.='</td><td>';
                               $tbl.=$row->position_nameeng;
                               $tbl.='</td><td>';
                               $tbl.=$row->sex;
                               $tbl.='</td><td>';
                               $tbl.=$row->Unpaid;
                               $tbl.='</td><td>';
                               $tbl.=$row->Maternity;
                               $tbl.='</td><td>';
                               $tbl.=$row->Special;
                               $tbl.='</td><td>';
                               $tbl.=$row->Sick;
                               $tbl.='</td><td>';
                               $tbl.=$row->Annual;
                               $tbl.='</td><td>';
                               $tbl.=$row->useingUnpaid;
                               $tbl.='</td><td>';
                               $tbl.=$row->useingMaternity;
                               $tbl.='</td><td>';
                               $tbl.=$row->useingspecial;
                               $tbl.='</td><td>';
                               $tbl.=$row->useingSick;
                               $tbl.='</td><td>';
                               $tbl.=$row->useingAnnual;
                               $tbl.='</td><td>';
                               $tbl.=($row->Unpaid) - ($row->useingUnpaid);
                               $tbl.='</td><td>';
                               $tbl.=($row->Maternity) - ($row->useingMaternity);
                               $tbl.='</td><td>';
                               $tbl.=($row->Special) - ($row->useingspecial);
                               $tbl.='</td><td>';
                               $tbl.=($row->Sick) - ($row->useingSick);
                               $tbl.='</td><td>';
                               $tbl.=($row->Annual) - ($row->useingAnnual);
                               $tbl.='</td></tr>';
            
                }
               echo $tbl;
    }
    public function checkleavetype($id)
    {
        
        $leavetypes=$this->leaves_model->getleavetype($id);
        echo "<option value=''>Select leaves</option>";
            foreach($leavetypes as $row){ 
            echo "<option value=";
            echo $row->id;
            echo ">";
            echo $row->name;
            echo "</option>";
            }
    
    }
    public function cancelleaves()
    {
       
        $company_id=$this->session->userdata('company_id');
        $data['eleaverequest']=$this->leaves_model->getLeavesrequest($company_id);
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='leaves/cancel_leaves';
        $this->load->view('master_page',$data);
    }
    public function errequest()
    {
            $brcode=$this->session->userdata('branch_code');
            $subbrcode=$this->session->userdata('subbranch');
            $data['errors']="";
            $data['title'] = lang('system_titel');
            $data['leavetypes']=$this->leavetype_model->getleavetype();
            $data['staff']=$this->staff_model->getstaff($brcode,$subbrcode);
            $data['menulist']=$this->menu_model->getUsermenu();
            $data['submenu']=$this->menu_model->getsubMenu();
            $data['titlepage']="Home Page";
            $data['views']='leaves/leaves_request';
            $this->load->view('master_page',$data);  
    }
    public function errorrequest()
    {
            $brcode=$this->session->userdata('branch_code');
            $subbrcode=$this->session->userdata('subbranch');
            $data['errors']="";
            $data['title'] = lang('system_titel');
            $data['leavetypes']=$this->leavetype_model->getleavetype();
            $data['staff']=$this->staff_model->getstaff($brcode,$subbrcode);
            $data['menulist']=$this->menu_model->getUsermenu();
            $data['submenu']=$this->menu_model->getsubMenu();
            $data['titlepage']="Home Page";
            $data['views']='leaves/leaves_forother';
            $this->load->view('master_page',$data);  
    }
    public function requestleaveforother()
    {
       
        $row=$this->input->post();
           
        $UploadImgClass=new UploadImg();
        $utility=new Utility();
        $row=$this->input->post();
       /* Calculator duration*/
        $userid=$this->session->userdata('user_id');
        $leavestart =strtotime($row['datestart']);
        $staffInfo=$this->users_model->staffInfo($userid,"NULL","NULL");
        $numstart=date("z",$leavestart );
        $leavesend=strtotime($row['dateend']);
        $numend=date("z", $leavesend);
        /*--end---*/
        
        $filename = $this->input->post('userfile');
        $pathupload='./uploads/';
        //Class upload images
            $imagesname=$UploadImgClass->UploadImages($filename,$pathupload);  

            $now=date('Y-m-d');
            $lid=$this->leaves_model->getlid($row['staffname'],$staffInfo->brcode,$staffInfo->company_id);
            foreach($lid as $li)
            {
                $result=array
                   (
                    "SID"=>$this->input->post('staffname'),
                    "lid"=>$li->lid,
                    "attachname"=>$imagesname,
                    'modifreddate'=>date('Y-m-d')
                    );
                
               $this->leaves_model->setfiles($result);
            }        
        
        $checking=$this->leaves_model->checkleaverequst($row['staffname'],$staffInfo->brcode,$staffInfo->company_id,date("Y-m-d",strtotime($row['datestart'])),date("Y-m-d",strtotime($row['dateend'])));
        if($checking==true)
        {
            
             redirect(site_url('leave/errorrequest'));            
           
        }
        else{
           $duration=$utility->Calculatorduration(date("Y-m-d",strtotime($row['datestart'])),date("Y-m-d",strtotime($row['dateend'])),$numstart,$numend,$row['morning'],$row['afternoon']);
           $this->leaves_model->setleaves($row['staffname'],$staffInfo->brcode,$staffInfo->company_id,date("Y-m-d",strtotime($row['datestart'])),date("Y-m-d",strtotime($row['dateend'])),$row['leavetype'],$userid,$row['note'],$row['morning'],$row['afternoon'],$duration);
            $lid=$this->leaves_model->getlid($row['staffname'],$staffInfo->brcode,$staffInfo->company_id);
            foreach($lid as $li)
            {
             $leaves=$this->leaves_model->getleaves($li->lid,$staffInfo->brcode,$staffInfo->company_id);
             $tocc=$this->leaves_model->getHremail();
             $to=$this->leaves_model->getManagerEmail();
                foreach($tocc->result() as $tocchr)
                 {                 

                        foreach($leaves as $re){

                         $this->sendtoRM($this->session->userdata('full_name'),$re->staff_nameeng,$re->duration,$re->startdate,$re->enddate,$re->brName,$re->sid,$re->requestdate,$re->position_nameeng,trim($tocchr->email),trim($to),$re->cause,$re->startdatetype,$re->enddatetype);
                        }     
                    //echo $tocchr->email;
                }
            }
            
             redirect(site_url('leave/cancelleaves'));
        }
    }
    public function delectleaves($id)
    {
    	$this->load->helper('url');
        $this->leaves_model->delectleave($id);
        redirect(site_url('leave/cancelleaves'));
    }
    
    public function requestleaves()
    {
            $UploadImgClass=new UploadImg();
            $utility=new Utility();
            $row=$this->input->post();
           /* Calculator duration*/
            $userid=$this->session->userdata('user_id');
            $staffInfo=$this->users_model->staffInfo($userid,"NULL","NULL");

            $leavestart =strtotime($row['datestart']);
            $numstart=date("z",$leavestart );
            $leavesend=strtotime($row['dateend']);
            $numend=date("z", $leavesend);
            /*--end---*/
            
            $filename = $this->input->post('userfile');
            $pathupload='./uploads/';
            //Class upload images
            $imagesname=$UploadImgClass->UploadImages($filename,$pathupload);    
            $now=date('Y-m-d');
            $lid=$this->leaves_model->getlid($this->input->post('staffname'),$staffInfo->brcode,$staffInfo->company_id);
            foreach($lid as $li)
            {
                $result=array
                   (
                    "SID"=>$this->input->post('staffname'),
                    "lid"=>$li->lid,
                    "attachname"=>$imagesname,
                    'modifreddate'=>date('Y-m-d')
                    );
                
               $this->leaves_model->setfiles($result);
            }         
            $checking=$this->leaves_model->checkleaverequst($row['staffname'],$staffInfo->brcode,$staffInfo->company_id,date("Y-m-d",strtotime($row['datestart'])),date("Y-m-d",strtotime($row['dateend'])));
            if($checking==true)
            {
                redirect(site_url('leave/errequest'));            
            }else{
            $duration=$utility->Calculatorduration(date("Y-m-d",strtotime($row['datestart'])),date("Y-m-d",strtotime($row['dateend'])),$numstart,$numend,$row['morning'],$row['afternoon']);
            $this->leaves_model->setleaves($row['staffname'],$staffInfo->brcode,$staffInfo->company_id,date("Y-m-d",strtotime($row['datestart'])),date("Y-m-d",strtotime($row['dateend'])),$row['leavetype'],$userid,$row['note'],$row['morning'],$row['afternoon'],$duration);
            if($duration==0)
            {
                redirect(site_url('leave/errequest'));
            }
            $lid=$this->leaves_model->getlid($this->input->post('staffname'),$staffInfo->brcode,$staffInfo->company_id);           
            foreach($lid as $li)
            {
                $leaves=$this->leaves_model->getleaves($li->lid,$staffInfo->brcode,$staffInfo->company_id);                
                $tocc=$this->leaves_model->getHremail();
                $to=$this->leaves_model->getManagerEmail();
                foreach($tocc->result() as $tocchr)
                {    
                    foreach($leaves as $re){
                      $this->sendtoRM($this->session->userdata('full_name'),$re->staff_nameeng,$re->duration,$re->startdate,$re->enddate,$re->brName,$re->sid,$re->requestdate,$re->position_nameeng,trim($tocchr->email),trim($to),$re->cause,$re->startdatetype,$re->enddatetype);
                    
                    }     

                }
               
            }   

            redirect(site_url('leave/cancelleaves'));
        }
        
    }
   
    public function attachfile($attach,$sid,$lid)
    {
            if($attach==""){
            }else{        
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|pdf|png|gif|JPG';
            $config['max_size']	= '10000';		
            $config['overwrite'] = 'false';
            $now = time();
            $human = $now;
            $rand = $human.uniqid('12');
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
            $filepath='uploads/'.$filename;
            $now=date('Y-m-d');
            $attach=array
               (
                "SID"=>$sid,
                "lid"=>$lid,
                "attachname"=>$filepath,
                'modifreddate'=>date('Y-m-d')
                );
            $this->db->insert('attach',$attach);
           
         }
        }
    }
   
    function sendtoRM($requestlogin,$requestname,$duration,$startdate,$enddate,$brname,$sid,$requestdate,$postion,$tocc,$to,$note,$morning,$afternoon)
    {
        
               
				$tomanager=$to;
                $ccfrom=$tocc;
                $subject="E-leaves Request By $requestlogin start from $startdate to $enddate";
			    $links=site_url().'public/img/logo_simple.png';
			    $messagemanager="
                            <body>
                            <div style='font-family: 'Hanuman', serif;'>
                               <table style='width:100%;border:1px solid #CCC;'>

                                        
                                        <tr>
                                            <td style='padding:0px;font-size:16px'>
                                                <span style='line-height:20px;'>
                                                    <p>គោរពជូនលោកប្រធាន</p>
                                                    <p></p>
                                                    <p>ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ $requestname សុំអនុញ្ញាតឈប់សម្រាកចំនួន  $duration ថ្ងៃដោយគិតចាប់ពីថ្ងៃ $startdate ដល់ថ្ងៃ $enddate</p>
                                                    <p>អាស្រ័យដូចបានជំរាបខាងលើសូមលោកប្រធានអនុញ្ញាតិច្បាប់ដោយអនុគ្រោះ ។</p>
                                                    <p></p>
                                                     <p>ពីខ្ញុំបាទ/នាងខ្ញុំ $requestname</p>
                                                   
                                               </span> 
                                            </td>
                                        </tr>


                                            <tr>
                                               <td>
                                                <table style='width:50%;padding:20px;'>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>
                                                        <p style='margin-top:10px;'>- BrName</p>
                                                        <p style='margin-top:10px;'>- Request By:</p>
                                                        <p style='margin-top:10px;'>- Staff Name:</p>
                                                        <p style='margin-top:10px;'>- SID Code</p>
                                                        <p style='margin-top:10px;'>- Date Start</p>
                                                        <p style='margin-top:10px;'>- Date End</p>
                                                        <p style='margin-top:10px;'>- Duration</p>
                                                        <p style='margin-top:10px;'>- Request Date</p>
                                                        <p style='margin-top:10px;'>- Position</p>
                                                        <p style='margin-top:10px;'>- Note</p>
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>
                                                        <p>:<span style='margin-left:10px;'>$brname</span></p>
                                                        <p>:<span style='margin-left:10px;'>$requestlogin</span></p>
                                                        <p>:<span style='margin-left:10px;'>$requestname</span></p>
                                                        <p>:<span style='margin-left:10px;'>$sid</span></p>
                                                        <p>:<span style='margin-left:10px;'>$startdate($morning)</span></p>
                                                        <p>:<span style='margin-left:10px;'>$enddate($afternoon)</span></p>
                                                        <p>:<span style='margin-left:10px;'>$duration</span></p>
                                                        <p>:<span style='margin-left:10px;'>$requestdate</span></p>
                                                        <p>:<span style='margin-left:10px;'>$postion</span></p>
                                                        <p>:<span style='margin-left:10px;'>$note</span></p>
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
        $email=$this->config_model->email_config();
       
        $config = Array(
                    'protocol' =>$email->protocol,
                    'smtp_host' =>$email->smtp_host,
                    'smtp_port' =>$email->smtp_port,
                    'smtp_user' =>$email->smtp_user,
                    'smtp_pass' =>$email->smtp_pass,
                    'mailtype'  =>$email->mailtype, 
                    'charset'   =>$email->charset
                );
        
       
        $this->load->library('email',$config);
        $this->email->set_newline("\r\n");
        $this->email->from($email->from,$email->title_email);
		$this->email->to($toM);
        $this->email->cc($tocc);
		$this->email->subject($subject);
		$this->email->message($message);
		$result = $this->email->send();
      
        
    }

   
    
}
?>
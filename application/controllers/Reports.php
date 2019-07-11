<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class reports extends CI_Controller {
     public function __construct()
    {
         parent::__construct();
         $this->load->library('polyglot');
         $this->lang->load('home', $this->session->userdata('language'));
         $this->load->model('menu_model');
         $this->load->model('Reports_model');
         $this->load->model('staff_model');
         $this->load->model('leaves_model');
         $this->load->helpers("url");
         $this->load->helpers("form");
         include('Utility.php');
         if(!$this->session->userdata('user_id'))
         {
             redirect(site_url('Login'));
         }
    }
    public function ereports()
    {
        $Utility=new Utility();
        $brcode=$this->session->userdata('branch_code');
        $subcode=$this->session->userdata('subbranch');
        $sid=$this->session->userdata('system_id');
        $role = $this->session->userdata('role'); 
        $userid = $this->session->userdata('user_id'); 
        $data['start']=date("Y-m-d");
        $data['end']=date("Y-m-d");
        $data['total_rows'] = $this->Reports_model->Totalnumrow($sid,$role,$brcode,$userid);
        if(isset($_GET["per_page"]))
        {
            $page=$_GET["per_page"];
        }else{
            $page=0;
        };
        
        $base_url= base_url()."index.php/reports/ereports";
        $total_rows= $this->Reports_model->Totalnumrow($sid,$role,$brcode,$userid);
        $Utility->pagination_config($total_rows,$base_url);
        $data['reports']=$this->Reports_model->GetReportsLeaves(null,null,$sid,$brcode,$role,$page,$userid);
        $data['staff']=$this->staff_model->getstaff($brcode,$subcode);
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='reports/reports_leaves';
        $this->load->view('master_page',$data);
    }
    public function ereportbydate()
    {
        $Utility=new Utility();
        $startdate=date("Y-m-d",strtotime($this->input->post('datestart')));
        $enddate=date("Y-m-d",strtotime($this->input->post('dateend')));
        $data['start']=date("Y-m-d",strtotime($this->input->post('datestart')));
        $data['end']=date("Y-m-d",strtotime($this->input->post('dateend')));
        $brcode=$this->session->userdata('branch_code');
        $subcode=$this->session->userdata('subbranch');
        $sid=$this->session->userdata('system_id');
        $role = $this->session->userdata('role'); 
        $userid = $this->session->userdata('user_id'); 
        $data['total_rows']= $this->Reports_model->Totalnumrowbydate($sid,$startdate,$enddate,$role,$brcode,$userid);
        if(isset($_GET["per_page"]))
        {
            $per_page=$_GET["per_page"];
        }else{
            $per_page=0;
        };
        $base_url = base_url()."index.php/reports/ereportbydate";
        $total_rows= $this->Reports_model->Totalnumrowbydate($sid,$startdate,$enddate,$role,$brcode,$userid);
        $Utility->pagination_config($total_rows,$base_url);
        $data['reports']=$this->Reports_model->GetReportsLeavesbydate($startdate,$enddate,$sid,$brcode,$role,$per_page,$userid);
        $data['staff']=$this->staff_model->getstaff($brcode,$subcode);
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='reports/reports_leaves';
        $this->load->view('master_page',$data);
    }
    
    public function viewdetail($id=null,$start=null,$end=null)
    {
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');
        $em=$this->session->userdata('user_id');
        $subbranch=$this->session->userdata('subbranch');
        $data['id']=$id;
        $data['start']=$start;
        $data['end']=$end;
        $data['reports']=$this->Reports_model->GetReportsLeavesDetail($start,$end,$id,$role);
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='reports/viewdetail';
        $this->load->view('master_page',$data);
    }
    public function balanceleaves()
    {
        $Utility=new Utility();
        $brcode = $this->session->userdata('branch_code');
        $role = $this->session->userdata('role');
        $sid = $this->session->userdata('system_id');
        $subcode = $this->session->userdata('subbranch');
        $userid = $this->session->userdata('user_id'); 
        $data["sid"]= $this->session->userdata('system_id');
        $data['total_rows'] = $this->Reports_model->TotalLeavesBalance($sid,$role,$brcode,$subcode,$userid);
        
        $per_page = $this->uri->segment(3) ? $this->uri->segment(3):1;
        if($per_page=='' || $per_page==1)
        { 
            $per_page=0;
        }else
        {
            $per_page=$_GET['per_page'];
        }
        $base_url= base_url()."index.php/reports/balanceleaves";
        $total_rows =$this->Reports_model->TotalLeavesBalance($sid,$role,$brcode,$subcode,$userid);
        $Utility->pagination_config($total_rows,$base_url);
        $data['balance'] = $this->Reports_model->GetLeavesBalance($brcode, $role, $sid, $subcode,$per_page);
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='reports/balance_leaves';
        $this->load->view('master_page',$data);

    }

    public function approveleaves()
    {
        $this->load->helpers("url");
        $this->load->helpers("form");
        $Utility=new Utility();
        $brcode = $this->session->userdata('branch_code');
        $role = $this->session->userdata('role');
        $sid = $this->session->userdata('system_id');
        $subcode = $this->session->userdata('subbranch');
        $data['total_rows'] = $this->Reports_model->Totalnumrownotapprove($sid,$role,$brcode);
        
        if(isset($_GET["per_page"]))
        {
            $per_page=$_GET["per_page"];
        }else{
            $per_page=0;
        };
        $base_url= base_url()."index.php/reports/approveleaves";
        $total_rows =$this->Reports_model->Totalnumrownotapprove($sid,$role,$brcode);
        $Utility->pagination_config($total_rows,$base_url);
        $data['app']=$this->Reports_model->GetApporvedLeaves(null,null,$sid,$brcode,$role,$per_page);
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='reports/approve_leaves';
        $this->load->view('master_page',$data);
        
    }
    public function setapprovelleaves($id)
    {
        $this->load->helpers("url");
        $this->load->helpers("form");
        $data=array
            (
            'status'=>2,
            'approvaldate'=>date('Y-m-d'),
            'approvedby'=>$this->session->userdata('user_id')
            );
        $this->db->where('lid',$id);
        $this->db->update('leaves',$data);
        $leaves=$this->leaves_model->getleaves($id);
        $tocc=$this->leaves_model->getHremail();
        $role=$this->session->userdata('role');
        foreach($tocc->result() as $tocchr){
            foreach($leaves as $re){
              
                    $to=$this->leaves_model->getreplyemailBM($re->employee);
                    //$to=$this->leaves_model->getreplyemail($re->sid);    
                    $this->sendapproval($this->session->userdata('full_name'),$re->staff_nameeng,$re->duration,$re->startdate,$re->enddate,$re->brName,$re->sid,$re->requestdate,$re->position_nameeng,$tocchr->email,$to,$re->cause,$re->startdatetype,$re->enddatetype);
            }
        }
        redirect(site_url('reports/approveleaves'));
        
        
    }
    public function setrejectleaves($id)
    {
         $data=array
            (
            'status'=>3,
            'rejectdate'=>date('Y-m-d'),
            'rejectby'=>$this->session->userdata('user_id')
            );
        $this->db->where('lid',$id);
        $this->db->update('leaves',$data);
        
        $leaves=$this->leaves_model->getleaves($id);
        $tocc=$this->leaves_model->getHremail();
       foreach($tocc->result() as $tocchr)
       { 
            foreach($leaves as $re){

                  $to=$this->leaves_model->getreplyemailBM($re->employee);
                    //$to=$this->leaves_model->getreplyemail($re->sid);
                  $this->sendreject($this->session->userdata('full_name'),$re->staff_nameeng,$re->duration,$re->startdate,$re->enddate,$re->brName,$re->sid,$re->requestdate,$re->position_nameeng,$tocchr->email,$to,$re->cause,$re->startdatetype,$re->enddatetype);
            }
       }
        redirect(site_url('reports/approveleaves'));
    }
    public function viewleaves($id,$lid,$start,$end)
    {
        $staffname=$this->db->from('staff')
                            ->where('system_id',$id)
                            ->get()->row();
        $brcode=$this->session->userdata('branch_code');
        $data['viewdetail']=$this->Reports_model->getviewleavedetail($id,$lid,date("Y-m-d",strtotime($start)),date("Y-m-d",strtotime($end)));
        $data['staffname']=$staffname;
        $data['id']=$id;
        $data['lid']=$lid;
        $data['start']=$start;
        $data['end']=$end;
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='reports/viewleaves';
        $this->load->view('master_page',$data);
    }
    public function showhistoryleaves($id)
    {
        $res=$this->db->from('attach')
            ->where('lid',$id)
            ->where('flag',1)
            ->get();
        
        foreach($res->result() as $row)
        {
            if(substr($row->attachname,-3)=="pdf")
            {
                 echo "<iframe src='".base_url().$row->attachname."' style='width:100%;height:470px;'></iframe>";
            }else
            {
                echo "<img src='".base_url().$row->attachname."' class='img-responsive'>";
            }
        }
    }
    public function leaveshistory()
    {
        $Utility=new Utility();
        $brcode=$this->session->userdata('branch_code');
        $subcode = $this->session->userdata('subbranch');
        $role=$this->session->userdata('role');
        $userid=$this->session->userdata('user_id');
        $sid=$this->session->userdata('system_id');
        $data['total_rows'] = $this->Reports_model->totaleleaveshistory($sid,$role,$brcode);
        if(isset($_GET["per_page"]))
        {
            $per_page=$_GET["per_page"];
        }else{
            $per_page=0;
        };
        $config = array();
        $baseurl= base_url()."index.php/reports/leaveshistory";
        $total_rows=$this->Reports_model->totaleleaveshistory($sid,$role,$brcode);
        $Utility->pagination_config($total_rows,$baseurl);
        $data['approved']=$this->Reports_model->Gethistoryapproved($brcode,$role,$sid,$subcode,$per_page);
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='reports/history_leaves';
        $this->load->view('master_page',$data);
        
    }
    public function leavesreject()
    {
        $Utility=new Utility();
        $brcode=$this->session->userdata('branch_code');
        $subcode = $this->session->userdata('subbranch');
        $role=$this->session->userdata('role');
        $userid=$this->session->userdata('user_id');
        $sid=$this->session->userdata('system_id');
        $data['total_rows'] = $this->Reports_model->totaleleavesrejecet($sid,$role,$brcode);
        if(isset($_GET["per_page"]))
        {
            $per_page=$_GET["per_page"];
        }else{
            $per_page=0;
        };
        $config = array();
        $baseurl= base_url()."index.php/reports/leavesreject";
        $total_rows=$this->Reports_model->totaleleavesrejecet($sid,$role,$brcode);
        $Utility->pagination_config($total_rows,$baseurl);
        $data['reject']=$this->Reports_model->Gethistoryreject($brcode,$role,$sid,$subcode,$per_page);
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='reports/history_reject';
        $this->load->view('master_page',$data);
        
    }

    public function sendapproval($approvalby,$requestname,$duration,$startdate,$enddate,$brname,$sid,$requestdate,$postion,$tocc,$to,$resion,$startdatetype,$enddatetype)
    {
        
                $tomanager=$to;
                $ccfrom=$tocc;
                $subject="E-leaves approved By $approvalby";
			    $links="'site_url().'public/img/logo_simple.png'";
			    $messagemanager="
                            <body>
                            <div style='font-family: 'Hanuman', serif;'>
                               <table style='width:100%;border:1px solid #CCC;'>

                                        
                                        <tr>
                                            <td style='padding:0px ;line-height:2px; font-size:12px'>

                                                <p>សួរស្ដីលោកគ្រូ​ អ្នកគ្រូ</p>
                                                <p>ការរស្នើរសុំច្បាប់របស់បុគ្គលិកឈ្មោះ $requestname ត្រូវបានអនុម័ត គឺគិតចាប់ពីថ្ងៃ $startdate ដល់ថ្ងៃ $enddate ចំនួន $duration ថ្ងៃ</p>
                                                <p>អាស្រ័យដូចបានជម្រាបជូនខាងលើ សូមលោកគ្រួ/អ្នកគ្រួអាចសម្រាកបាន ពីខ្ញុំបាទ $approvalby</p>
                                                

                                            </td>
                                        </tr>


                                            <tr>
                                               <td>
                                                <table style='width:50%;padding:20px;'>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>
                                                        <p style='margin-top:10px;'>- BrName</p>
                                                        <p style='margin-top:10px;'>- Staff Name:</p>
                                                        <p style='margin-top:10px;'>- SID Code</p>
                                                        <p style='margin-top:10px;'>- Date Start</p>
                                                        <p style='margin-top:10px;'>- Date End</p>
                                                        <p style='margin-top:10px;'>- Duration</p>
                                                        <p style='margin-top:10px;'>- Request Date</p>
                                                        <p style='margin-top:10px;'>- Position</p>
                                                        <p style='margin-top:10px;'>- Cause</p>
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>
                                                        <p>:<span style='margin-left:10px;'>$brname</span></p>
                                                        <p>:<span style='margin-left:10px;'>$requestname</span></p>
                                                        <p>:<span style='margin-left:10px;'>$sid</span></p>
                                                        <p>:<span style='margin-left:10px;'>$startdate($startdatetype)</span></p>
                                                        <p>:<span style='margin-left:10px;'>$enddate($enddatetype)</span></p>
                                                        <p>:<span style='margin-left:10px;'>$duration</span></p>
                                                        <p>:<span style='margin-left:10px;'>$requestdate</span></p>
                                                        <p>:<span style='margin-left:10px;'>$postion</span></p>
                                                        <p>:<span style='margin-left:10px;'>$resion</span></p>
                                                    </div>
                                                    </td>

                                                   </tr>
                                                </table>
                                               </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <p>សម្គាល់៖ <span style='color:#151515;'>មិនត្រូវ Forward ឬ Reply ឡើយ</span></p>
                                                <p>www.sahakrinpheap.com.kh</p>
                                            </td>
                                            </tr>
                                        </table>

                            </div></body>";
        $this->sendMail($messagemanager,$tocc,$tomanager,$subject);
    }
    public function sendreject($rejectby,$requestname,$duration,$startdate,$enddate,$brname,$sid,$requestdate,$postion,$tocc,$to,$mon,$aff)
    {
        
                $tomanager=$to;
                $ccfrom=$tocc;
                $subject="E-leaves Reject from $rejectby";
			    $links="'site_url().'public/img/logo_simple.png'";
			    $messagemanager="
                            <body>
                            <div style='font-family: 'Hanuman', serif;'>
                               <table style='width:100%;border:1px solid #CCC;'>
                                        <tr>
                                            <td style='padding:0px ;line-height:2px; font-size:12px'>

                                                    <p>ជម្រាបមកលោកប្រធាន</p>
                                                    <p>ការស្នើរសុំច្បាប់របស់បុគ្គលិកឈ្មោះ $requestname មិនត្រូវបានអនុម័ត</p>
                                                   
                                                    <p>អាស្រ័យដួចបានជម្រាបជួនខាងលើ សូមលោកប្រធានជម្រាបទៅបុគ្គលិកឈ្មោះ  $requestname </p>
                                                    
                                            </td>
                                        </tr>


                                            <tr>
                                               <td>
                                                <table style='width:50%;padding:20px;'>
                                                   <tr>
                                                   <td style='line-height:10px;'>
                                                    <div style='line-height:10px;'>
                                                        <p style='margin-top:10px;'>- BrName</p>
                                                        <p style='margin-top:10px;'>- Staff Name:</p>
                                                        <p style='margin-top:10px;'>- SID Code</p>
                                                        <p style='margin-top:10px;'>- Date Start</p>
                                                        <p style='margin-top:10px;'>- Date End</p>
                                                        <p style='margin-top:10px;'>- Duration</p>
                                                        <p style='margin-top:10px;'>- Request Date</p>
                                                        <p style='margin-top:10px;'>- Position</p>
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style='line-height:10px;'>
                                                        <p>:<span style='margin-left:10px;'>$brname</span></p>
                                                        <p>:<span style='margin-left:10px;'>$requestname</span></p>
                                                        <p>:<span style='margin-left:10px;'>$sid</span></p>
                                                        <p>:<span style='margin-left:10px;'>$startdate($mon)</span></p>
                                                        <p>:<span style='margin-left:10px;'>$enddate($aff)</span></p>
                                                        <p>:<span style='margin-left:10px;'>$duration</span></p>
                                                        <p>:<span style='margin-left:10px;'>$requestdate</span></p>
                                                        <p>:<span style='margin-left:10px;'>$postion</span></p>
                                                    </div>
                                                    </td>
                                                   </tr>
                                                   
                                                </table>
                                               </td>
                                               </tr>
                                               <tr>
                                               <td>
                                                    <p>សម្គាល់៖ <span style='color:#151515;'>មិនត្រូវ Forward ឬ Reply ឡើយ</span></p>
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
        
        
    }
   
    public function monthlyreport($start=null,$enddate=null)
    {
        $start=$this->input->post("datestart");
        $enddate=$this->input->post("enddate");
        if(empty($start) && empty($enddate))
        {
            $start=date('Y-m-01');
            $enddate=date('Y-m-d');
            $data['monthlyreports']=$this->Reports_model->getdetailSKPReports($start,$enddate);
        }else
        {
            
            $data['monthlyreports']=$this->Reports_model->getdetailSKPReports($start,$enddate);
        }
        $data['datestart']=$start;
        $data['dateend']=$enddate;
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='skp/skp_staffleaves_reports';
        $this->load->view('master_page',$data);

    }
    public function staffleavesBalance()
    {
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='skp/skp_staffleaves_balance';
        $this->load->view('master_page',$data);
    }
    public function staffleavesHistory()
    {
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='skp/skp_staffleaves_history';
        $this->load->view('master_page',$data);
        
    }
    
}
?>
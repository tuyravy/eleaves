<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
    public function __construct()
    {
         parent::__construct();
         $this->load->library('polyglot');         
         if($this->session->userdata('language') == FALSE)
         {
             $this->session->set_userdata('language', $this->config->item('language'));
             $this->session->set_userdata('language_code', $this->polyglot->language2code($this->config->item('language')));
         }
         $this->lang->load('session', $this->session->userdata('language'));
         $this->lang->load('global', $this->session->userdata('language'));
         $this->load->model('Login_model');
         $this->load->model('users_model');
         $this->load->model('config_model');
    }
	public function index()
    {
        $data['title'] = lang('session_login_title');
		$this->load->view('login/index',$data);
    }
    
    public function forgetpassword()
    {
                    $this->load->helper('form');
                    $this->load->helper('url');
                    $data['branch']=$this->users_model->getBranch();
                    if(isset($_POST["systemid"]))
                    {
                        $sid=$this->input->post('systemid');
                        $data['forget']=$this->Login_model->getforgepassword($sid);
                    }
                    $data['title'] ="Eleaves:Forget Password";
                    $this->load->helper('form');
                    $this->load->helper('url');
                    $this->load->view('login/requestpassword',$data);
    }
    public function insert()
    {
        echo $this->input->post('userfile');
    }
    public function checksession($username=null,$password=null)
    {
        $this->load->helper('form');
        $this->load->helper('url');
        $error=0;
        //$hostname=gethostname();
       
        if($username==null)
        {
             $login=str_replace(' ','',$this->input->post('username'));
             $password=trim($this->input->post('password'));
        }
        else
        {
             $login=str_replace(' ','',$username);
             $password=trim($password);
        }
        $users=$this->Login_model->getUsers($login,$password);
       
        
        if($users==true)
        {
            foreach($users as $res){
           
                $this->session->set_userdata
                        (
                        array(
                            'user_id'=>$res->user_id, 
                            'branch_code'=>$res->branch_code,
                            'company_id'=>$res->company_id,
                            'full_name'=>$res->full_name,
                            'full_name_kh'=>$res->full_name_kh,
                            'username'=>$res->username,
                            'phone'=>$res->phone,
                            'role_id'=>$res->role_id,
                            'menu_option'=>$res->menu_option,
                            'role'=>$res->role,
                            'system_id'=>$res->system_id,
                            'logo'=>$res->logo,
                            'logo_title'=>$res->logo_title,
                            'hid'=>$res->hid,
                            'types'=>$res->types,
                            'subbranch'=>$res->subbranch
                             )
                        );
                    $setstatus=array(
                                    'last_time_login'=>date('Y-m-d h:i:s'),
                                    'time_login'=>date('Y-m-d h:i:s'),
                                    'counterrorlogin'=>0,
                                    "status"=>1
                                    );
                    $this->db->where("user_id",$res->user_id);
                    $this->db->update('users',$setstatus);
                   
                    redirect(site_url('Home'));
            // }
                
            }
                
            
        }else
        {
              
              $result=$this->db->select("replace(username,' ',''),user_id")
                            ->from('users')
                            ->where('username',$login)
                            ->where('flag',1)                            
                            ->get();
              foreach($result->result() as $row)
              {
              $counterid=$this->db->select("counterrorlogin")
                                  ->from('users')
                                  ->where('user_id',$row->user_id)
                                  ->where('flag',1)                                  
                                  ->get();
              foreach($counterid->result() as $counts)
              {
                  $setstatus=array(
                                    'last_time_login'=>date('Y-m-d h:i:s'),
                                    "counterrorlogin"=>$counts->counterrorlogin+1
                                    );
                  $this->db->where("user_id",$row->user_id);
                  $this->db->update('users',$setstatus); 
                  if($counts->counterrorlogin==6)
                  {
                      $error=1;
                      $data['errornotAcc']="";
                      $data['title'] = lang('session_login_title');
                      $this->load->helper('form');
                      $this->load->helper('url');
                      $this->load->view('login/index',$data);
                  }
                  elseif($counts->counterrorlogin>=3)
                  {
                    return redirect(site_url('forgetpassword'));
                  }
                  elseif($counts->counterrorlogin>7)
                  {
                       return redirect(site_url('login/errorslogin')); 
                  }
              }
                                    
              if($error==0){
                  
                  $data['error']="";
                  $data['title'] = lang('session_login_title');
                  $this->load->helper('form');
                  $this->load->helper('url');
                  $this->load->view('login/index',$data);
              }               
              
            }
             
          
	    }
        if($error==0){
              $data['error']="";
              $data['title'] = lang('session_login_title');
              $this->load->helper('form');
              $this->load->helper('url');
              $this->load->view('login/index',$data);
        
        }
    }
    public function checksessionbakup()
    {
       
       $this->load->library('session');
        $login=str_replace(' ','',$this->input->post('username'));
        $password=$this->input->post('password');
        $users=$this->Login_model->getUsers(str_replace(' ','',$login),str_replace(' ','',$password));
        if($users==true)
        {
           
            foreach($users as $res){
            
                $this->session->set_userdata
                    (    
                    array(
                              'user_id'=>$res->user_id, 
                              'branch_code'=>$res->branch_code,
                              'full_name'=>$res->full_name,
                              'full_name_kh'=>$res->full_name_kh,
                              'username'=>$res->username,
                              'phone'=>$res->phone,
                              'role_id'=>$res->role_id,
                              'menu_option'=>$res->menu_option,
                              'role'=>$res->role,
                              'system_id'=>$res->system_id,
                              'hid'=>$res->hid,
                              'types'=>$res->types,
                              'subbranch'=>$res->subbranch
                             )
                    );
                
             
            }
            
            
         redirect('Login/master');
           
            
        }else
        {
            $data['error']='';
            $data['title'] = lang('session_login_title');
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->view('login/index',$data);
	    }
     
        
    }
   public function master()
    {
        
       $this->load->helper('form');
       $this->load->helper('url');
        
        return redirect(site_url('home'));  
       
    }
   public function logout()
   {
       $this->session->sess_destroy();
       redirect(site_url('home'));
   }
   public function already()
    {
        $data['title'] = lang('session_login_title');
		$this->load->view('login/alreadychange',$data);
    }
   public function requestpasswordbysystemid()
    {
        $sid=$this->input->post('systemid');
        $brcode=$this->input->post('brcode');

        $email=$this->users_model->getbysystem_id($sid,$brcode);
        if($email=="0"){
            $this->session->set_flashdata('erorr', 'លោកអ្នកស្នើរសុំលេខសម្ងាត់ថ្មីមិនបានសម្រេចទេ សូមទាក់ទង់ទៅផ្នែកគ្រប់គ្រង់ប្រព័ន្ធ!');
            
            redirect(site_url('login/forgetpassword'));
            
        }else{

            
            $date=date("Y-m-d");
            $tocc="ravy@sahakrinpheap.com.kh";
            $to=str_replace(' ','',$email->email);
            $this->sendtouserforgetpassword($email->full_name,$email->BrName,$email->brcode,$email->username,$sid,date("d - M- Y",strtotime($date)),$email->positionname,$tocc,$to);
            $data=array(
                'last_time_login'=>date('Y-m-d h:i:s'),
                "branch_code"=>$email->brcode
                );
            $this->db->where("user_id",$email->user_id);
            $this->db->where('system_id',$sid);
            $this->db->update('users',$data); 

            return redirect('login/already');
        }
        
    }
   public function sendtouserforgetpassword($StaffName,$brname,$BrCode,$username,$sid,$datechange,$postion,$tocc,$to)
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
                                                    <p>សំណើរផ្លាស់ប្ដូរលេខសម្ងាត់ E-Leaves ថ្មី</p>
                                                    
                                                    <p>គោរពជូនចំពោះលោកគ្រូ / អ្នកគ្រូ  $StaffName លេខសម្ងាត់របស់លោកគ្រូ/អ្នកគ្រូត្រូវបានផ្លាស់ប្ដូររួចរាល់​!</p>                                                    
    
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

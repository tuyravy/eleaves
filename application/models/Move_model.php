<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class move_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model("Csv_model");
        $this->load->model("Config_model");
    }
    public function getuser()
    {
        $id=$this->session->userdata('id');
        $role=$this->session->userdata('role');
        $active=$this->session->userdata('active');
        $brcode=$this->session->userdata('BrCode');
        $manager=$this->session->userdata('manager');
        $rm=$this->session->userdata('RM');
        switch($role)
        {
            case 1:
                if($active==1)
                {
                     $this->db->where('id',$id);
                     $this->db->where('users.flage',1);
                     $result=$this->db->get("users");
                     return $result->result();
                }
                
            break;
            case 2:
                     $this->db->where("BrCode",$brcode);
                     $this->db->where('users.flage',1);
                     $result=$this->db->get("users");
                     return $result->result();
            break;
            case 3:
                     $this->db->where("BrCode",$brcode);
                     $this->db->where('users.flage',1);
                     $result=$this->db->get("users");
                     return $result->result();
            break;
            case 4:
                
                if($active==2)
                {
                    $this->db->where('users.flage',1);
                    $this->db->where("manager",$id);
                    $this->db->where("role",$role);
                    $result=$this->db->get("users");
                    return $result->result();
                     
                }
                else
                {   
                    if($rm=="")
                     {
                         $this->db->where("manager",$id);
                         $this->db->where('users.flage',1);
                         $result=$this->db->get("users");
                         return $result->result();
                     }else
                     {
                         $this->db->where('users.flage',1);
                         $this->db->where("RM",$rm);
                         $this->db->where("role",3);
                         $result=$this->db->get("users");
                         return $result->result();
                     }
                }
                     
            break;
            case 5:
                    $this->db->where('users.flage',1);
                    $this->db->where("manager",$id);
                    $this->db->where("role",4);
                    $result=$this->db->get("users");
                    return $result->result();
            break;
            
            
            
        }
    }
    
    public function getbranch()
    {
        $option="branchshow";
        $config=$this->Config_model->getconfig($option);
        if($config->keys==1)
        {
            $this->db->where("brCode>","499");
            $result=$this->db->get("tbl_branch");
            return $result->result();
        }
        else
        {
            
            $result=$this->db->get("tbl_branch");
            return $result->result();
        }
        
    }
    public function get_positions()
    {
        $result=$this->db->get("positions");
        return $result->result();
    }
    public function get_rm()
    {
        $this->db->where('users.flage',1);
        $this->db->where_in("role",array('4','5'));
        $result=$this->db->get("users");
        return $result->result();
    }
    
    public function setmovebranch()
    {
        $movedate=date("Y-m-d");
        $staffid=$this->input->post('staffname');
        $branchname=$this->input->post('branchname');
        $position=$this->input->post('position');
        $branchrm=$this->input->post('branchrm');
        $userrole=$this->input->post('userrole');
        $emailuser1=$this->input->post('emailuser1');
        $emailuser2=$this->input->post('emailuser2');
        $brshortcode=$this->getBrShortcode($branchname);
       
        $rmID=$this->getRM($branchrm);
    
        $this->db->where('users.flage',1);
        $this->db->where("id",$staffid);
        $getuser=$this->db->get("users")->row();
        
        /*$name=explode(" ",$getuser->fullname);
        $email="";
        foreach($name as $value)
        {
            $email=strtolower($value); 
        }
        */
        
        $data=array
            (
                "uid"=>$staffid,
                "sid"=>$getuser->SID,
                "movebrcode"=>$branchname,
                "org_brcode"=>$getuser->BrCode,
                "movedate"=>$movedate
            );
        $this->db->insert("movehistory",$data);
        
        $this->db->where("uid",$staffid);
        $getuid=$this->db->get("movehistory")->row();
       
        /*
        -how to set Managerid
        1-User role=3
        2-User role=4 
        3-User role=5
        if role==3 for managerid set OM id that get by postion id 
        
        if role==4
        {
            1-role=4 and active=1 for managerid set OM id that get by postion id
            2-role=4 and active=2 for managerid set DCEO id that get by position id
            
        }
         
        if User role=5 for managerid set CEO
        */
        
        $year=date("Y");
        $setdate=$this->input->post('effective');
        $this->getBalanceMove($getuser->SID,$getuser->BrCode,$branchname,$year,$movedate,$setdate);
        
      switch($userrole)
        {
            case 1:
             
              if($branchname=="500")
              {
                $data=
                    array
                    (
                      "BrCode"=>$branchname,  
                      "role"=>$userrole,
                      "manager"=>$branchrm,
                      "RM"=>"",
                      "login"=>strtolower($getuser->fullname),
                      "email"=>$emailuser1.','.$emailuser2,
                      "position"=>$position,
                      "active"=>1,
                      "historymovebranch"=>$getuid->id,
                      "movedate"=>$movedate 
                    );   
                $this->db->where("id",$staffid);
                $this->db->update("users",$data);
                
              }
              else
              {
                  $data=
                    array
                    (
                      "BrCode"=>$branchname,  
                      "role"=>$userrole,
                      "manager"=>$branchrm,
                      "RM"=>$rmID->rid,
                      "position"=>$position,
                      "login"=>"",
                      "active"=>0,
                      "email"=>"bm.".strtolower($brshortcode)."@sahakrinpheap.com.kh;acc.".strtolower($brshortcode)."@sahakrinpheap.com.kh",
                      "historymovebranch"=>$getuid->id,
                      "movedate"=>$movedate
                    );   
                $this->db->where("id",$staffid);
                $this->db->update("users",$data);
            
                  
                
                 
              }
               
                /*complate user role =1 */
               
            break;
            case 2:
                
                 $data=
                    array
                    (
                      "BrCode"=>$branchname,  
                      "role"=>$userrole,
                      "manager"=>$branchrm,
                      "RM"=>$rmID->rid,
                      "position"=>$position,
                      "login"=>"acc.".strtolower($brshortcode),
                      "active"=>1,
                      "email"=>"bm.".strtolower($brshortcode)."@sahakrinpheap.com.kh;acc.".strtolower($brshortcode)."@sahakrinpheap.com.kh",
                      "historymovebranch"=>$getuid->id,
                      "movedate"=>$movedate
                    );   
                $this->db->where("id",$staffid);
                $this->db->update("users",$data);
                
                /*complate user 2 */
               
               
            break;
            case 3:
               
                $omId=$this->getOMid();
                $data=
                array
                (
                  "BrCode"=>$branchname,  
                  "role"=>$userrole,
                  "manager"=>$omId,
                  "RM"=>$rmID->rid,
                  "position"=>$position,
                  "login"=>"bm.".strtolower($brshortcode),
                  "active"=>2,
                  "email"=>"bm.".strtolower($brshortcode)."@sahakrinpheap.com.kh;acc.".strtolower($brshortcode)."@sahakrinpheap.com.kh",
                  "historymovebranch"=>$getuid->id,
                  "movedate"=>$movedate
                );   
                $this->db->where("id",$staffid);
                $this->db->update("users",$data);
               
                /*complate test for user 3 */
                
            break;
            case 4:
                  $dceoid=$this->getOMid();
                  $omId=$this->getDCEOID();
               switch($position)
               {
                       
                   case 10:
                       
                        $data=
                        array
                        (
                          "BrCode"=>$branchname,  
                          "role"=>$userrole,
                          "manager"=>$branchrm,
                          "RM"=>"",
                          "position"=>$position,
                          "login"=>strtolower($getuser->fullname),
                          "active"=>2,
                          "email"=>$email."@sahakrinpheap.com.kh",
                          "historymovebranch"=>$getuid->id,
                          "movedate"=>$movedate
                        );   
                        $this->db->where("id",$staffid);
                        $this->db->update("users",$data);
                       
                    break;
                    case 20:
                       
                    
                         $data=
                            array
                            (
                              "BrCode"=>$branchname,  
                              "role"=>$userrole,
                              "manager"=>$branchrm,
                              "RM"=>"0",
                              "active"=>1,
                              "position"=>$position,
                              "login"=>strtolower($getuser->fullname),
                              "email"=>$email."@sahakrinpheap.com.kh",
                              "historymovebranch"=>$getuid->id,
                              "movedate"=>$movedate
                            );   
                            $this->db->where("id",$staffid);
                            $this->db->update("users",$data);
                       
                    break;
                    
                    default : 
                     $data=
                            array
                            (
                              "BrCode"=>$branchname,  
                              "role"=>$userrole,
                              "manager"=>$omId,
                              "RM"=>"",
                              "active"=>1,
                              "position"=>$position,
                              "login"=>strtolower($getuser->fullname),
                              "email"=>$email."@sahakrinpheap.com.kh",
                              "historymovebranch"=>$getuid->id,
                              "movedate"=>$movedate
                            );   
                            $this->db->where("id",$staffid);
                            $this->db->update("users",$data);
                       
               }
               /*==============complate=====================*/
        
            break;
               
            case 5:
                
               
                    $data=
                    array
                    (
                      "BrCode"=>$branchname,  
                      "role"=>$userrole,
                      "manager"=>1,
                      "RM"=>"",
                      "position"=>$position,
                      "login"=>strtolower($getuser->fullname),
                      "email"=>$email."@sahakrinpheap.com.kh",
                      "historymovebranch"=>$getuid->id,
                      "movedate"=>$movedate
                    );   
                    $this->db->where("id",$staffid);
                    $this->db->update("users",$data);
               
            break;
              /*complate test user 5*/
            
        }
        
        
          
    }
    public function getOMid()
    {
        
        $this->db->select("position,active,id,flage");
        $this->db->where('users.flage',1);
        $this->db->where("position","10");
        $this->db->where("active","2");
        $OMid=$this->db->get("users")->row();
        return $OMid->id;
    }
    public function getDCEOID()
    {
        $this->db->select("position,active,id,flage");
        $this->db->where("position","14");
        $DCEOid=$this->db->get("users")->row();
        return $DCEOid->id;
    }
    public function getBrShortcode($brcode)
    {
        $this->db->where("brCode",$brcode);
        $brshort=$this->db->get('tbl_branch')->row();
        return $brshort->shortcode;
    }
    public function getRM($rmid)
    {
        $this->db->where('users.flage',1);
        $this->db->where("users.id",$rmid);
        $this->db->from("users");
        $this->db->join("rm","users.SID=rm.sid","inner");
        $result=$this->db->get();
        foreach($result->result() as $row)
        {
            return $row;
        }
        
    }
    function re_count()
    {
        return $this->db->count_all('types');
    }
    
    public function getBalanceMove($sid,$brcode,$brcodenew,$year,$movedate,$setdate)
    {
        /*
        if Move NGO to NGO
           BeginingBalance=beginingbalance-currbalance;
           currbalace=0;
           Ex_balace=ex_begining-ex_currbalance;
           Ex_curr=0;
        
        if Move NGO to MFI
           
           BeginingBalance=beginingbablance-currbalace;
           currbalace=0;
           Ex_balance=calulator
           Ex_curr=0;
        
    
        
        */
        $count=$this->re_count();
        
        if($brcode<499)
        {
            for($i=1;$i<=$count;$i++){ 
                
            $this->db->select("id,MaxLeaveBalance");
            $this->db->where('id',$i);
            $typesleavs=$this->db->get("types")->row();
            $MaxLeaveBalance=$typesleavs->MaxLeaveBalance;
            
            $this->db->where("sid",$sid);
            $this->db->where("brcode",$brcode);
            $this->db->where("leavetype",$i);
            $result=$this->db->get("leave_balance");
            
                
                
            foreach($result->result() as $row)
            {
                $values=$this->Csv_model->calculatDOE($setdate,$MaxLeaveBalance);
                if($values==9999)
                {
                    
                }else
                {
                     if($i==2)
                     {
                         if($row->curr_leavebalance==0)
                         {
                             $values=$row->begining_leavebalance;
                         }
                         else
                         {
                             if($row->curr_leavebalance==90)
                             {
                                 $values=0;
                             }
                             else
                             {
                                 $values=($row->begining_leavebalance)-($row->curr_leavebalance);
                             }
                         }
                     }else
                     {
                         $values=$values;
                     }
                     $data=array
                            (
                             "sid"=>$row->sid,
                             "brcode"=>$brcodenew,
                             "year"=>$year,
                             "begining_leavebalance"=>($row->begining_leavebalance)-($row->curr_leavebalance),
                             "curr_leavebalance"=>$row->curr_leavebalance,
                             "ex_begining_leavebalance"=>$values,
                             "ex_currleavebalance"=>0,

                             "leavetype"=>$i,
                             "movedate"=>$movedate      
                            );
                       $this->db->insert("leave_balance",$data);
                }
            }

            }
            
            
        }else
        {
            $this->db->where("sid",$sid);
            $this->db->where("brcode",$brcode);
            $result=$this->db->get("leave_balance");
            foreach($result->result() as $row)
            {
                $data=array
                    (
                     "sid"=>$row->sid,
                     "brcode"=>$brcodenew,
                     "year"=>$year,
                     "begining_leavebalance"=>($row->begining_leavebalance)-($row->curr_leavebalance),
                     "curr_leavebalance"=>0,
                     "ex_begining_leavebalance"=>($row->ex_begining_leavebalance)-($row->ex_currleavebalance),
                     "ex_currleavebalance"=>0,
                     "leavetype"=>$row->leavetype,
                     "movedate"=>$movedate      
                    );
               $this->db->insert("leave_balance",$data);
            }
            
        }   
    }
    public function getuserbybranchname($brcode)
    {
        $this->db->where('users.flage',1);
        $this->db->where("BrCode",$brcode);
        $result=$this->db->get("users");
        return $result->result();
    }
    
    
}
?>
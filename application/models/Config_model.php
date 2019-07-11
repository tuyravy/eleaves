<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class config_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();  
    }
    public function getconfig($option)
    {
        $this->db->where("option_name",$option);
        $con=$this->db->get("config")->row();
        return $con;
        
    }
    public function getUsers($role,$sid,$brcode)
    {
       
        $option="ex";
        $config=$this->getconfig($option);
        $active=$this->session->userdata('active');
        $id=$this->session->userdata('id');
        $Rm=$this->session->userdata('RM');
        $manager=$this->session->userdata('manager');
        if($config->keys==1)
        {
           switch($role)
           {
               case 1:
                   
               break;
               case 2:
                   
                       $this->db->where('users.flage',1);
                       $this->db->where('users.BrCode',$brcode);
                       $this->db->where('users.BrCode>',499);
                       $this->db->from('users');
                       $this->db->join('positions','users.position=positions.pid');
                       $this->db->join('roles','users.role=roles.roid');
                       $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                       $query=$this->db->get();
                       return $query->result();

               break;
               case 3:
                       $this->db->where('users.flage',1);
                       $this->db->where('users.BrCode',$brcode);
                       $this->db->where('users.BrCode>',499);
                       $this->db->from('users');
                       $this->db->join('positions','users.position=positions.pid');
                       $this->db->join('roles','users.role=roles.roid');
                       $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                       $query=$this->db->get();
                       /*foreach($query->result() as $row)
                       {
                           echo $row->fullname;
                       }*/
                       return $query->result();
                   
               break;
               case 4:
                       $active=$this->session->userdata('active');
                       $id=$this->session->userdata('id');
                       $Rm=$this->session->userdata('RM');
                       $manager=$this->session->userdata('manager');
                       if($active==2){
                           $this->db->where('users.flage',1);
                           $this->db->where('users.BrCode',$brcode);
                           $this->db->where('users.BrCode>',499);
                           $this->db->where('users.manager',$id);
                           $this->db->from('users');
                           $this->db->join('positions','users.position=positions.pid');
                           $this->db->join('roles','users.role=roles.roid');
                           $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                           $query=$this->db->get();
                           /*foreach($query->result() as $row)
                           {
                               echo $row->fullname;
                           }*/
                           return $query->result();
                       }else if($active==1)
                       {
                           if($RM=="0")
                            {
                                $this->db->where('users.flage',1);
                                $this->db->where('users.BrCode',$brcode);
                                $this->db->where('users.manager',$id);
                                $this->db->from('users');
                                $this->db->join('positions','users.position=positions.pid');
                                $this->db->join('roles','users.role=roles.roid');
                                $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                                $query=$this->db->get();
                                   /*foreach($query->result() as $row)
                                   {
                                       echo $row->fullname;
                                   }*/
                                return $query->result();
                            }
                            else
                            {
                                $this->db->where('users.flage',1);
                                $this->db->where('users.RM',$Rm);
                                $this->db->where('users.position',35);
                                $this->db->from('users');
                                $this->db->join('positions','users.position=positions.pid');
                                $this->db->join('roles','users.role=roles.roid');
                                $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                                $query=$this->db->get();
                                
                                   /*foreach($query->result() as $row)
                                   {
                                       echo $row->fullname;
                                   }
                                   */
                                return $query->result();
                                
                            }
                       }
               break;
               case 5:
                    $this->db->where('users.flage',1);
                                $this->db->where('users.BrCode',$brcode);
                                $this->db->where('users.manager',$id);
                                $this->db->where('users.BrCode>',499);
                                $this->db->from('users');
                                $this->db->join('positions','users.position=positions.pid');
                                $this->db->join('roles','users.role=roles.roid');
                                $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                                $query=$this->db->get();
                                   /*foreach($query->result() as $row)
                                   {
                                       echo $row->fullname;
                                   }*/
                                return $query->result();
               break;
               case 6:
               break;
                   
                
           }
            
            
        }else
        {
            
           
            switch($role)
           {
                
               case 1:
                   
               break;
               case 2:
                   
                   $this->db->where('users.flage',1);
                   $this->db->where('users.BrCode',$brcode);
                   $this->db->from('users');
                   $this->db->join('positions','users.position=positions.pid');
                   $this->db->join('roles','users.role=roles.roid');
                   $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                   $query=$this->db->get();
                   return $query->result();
                   
               break;
               case 3:
                   $this->db->where('users.flage',1);
                   $this->db->where('users.BrCode',$brcode);
                   $this->db->from('users');
                   $this->db->join('positions','users.position=positions.pid');
                   $this->db->join('roles','users.role=roles.roid');
                   $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                   $query=$this->db->get();
                   /*foreach($query->result() as $row)
                   {
                       echo $row->fullname;
                   }*/
                   return $query->result();
                   
               break;
               case 4:
                        
                        
                    
                       if($active==2){
                           $this->db->where('users.flage',1);
                           $this->db->where('users.BrCode',$brcode);
                           $this->db->where('users.manager',$id);
                           $this->db->from('users');
                           $this->db->join('positions','users.position=positions.pid');
                           $this->db->join('roles','users.role=roles.roid');
                           $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                           $query=$this->db->get();
                           /*foreach($query->result() as $row)
                           {
                               echo $row->fullname;
                           }*/
                           return $query->result();
                           
                       }
                      else if($active==1){
                            if($Rm==0)
                            {
                                $this->db->where('users.flage',1);
                                $this->db->where('users.BrCode',$brcode);
                                $this->db->where('users.manager',$id);
                                $this->db->from('users');
                                $this->db->join('positions','users.position=positions.pid');
                                $this->db->join('roles','users.role=roles.roid');
                                $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                                $query=$this->db->get();
                                   /*foreach($query->result() as $row)
                                   {
                                       echo $row->fullname;
                                   }*/
                                return $query->result();
                            }
                            else
                            {
                                $this->db->where('users.flage',1);
                                $this->db->where('users.RM',$Rm);
                                $this->db->from('users');
                                $this->db->join('positions','users.position=positions.pid');
                                $this->db->join('roles','users.role=roles.roid');
                                $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                                $query=$this->db->get();
                                
                                   /*foreach($query->result() as $row)
                                   {
                                       echo $row->fullname;
                                   }
                                   */
                                return $query->result();
                                
                            }
                           
                           
                       } 
                            
                       else if($active==3){
                              
                               
                                $this->db->where('users.flage',1);
                                $this->db->where('users.RM',$Rm);
                                $this->db->where('users.role',3);
                                $this->db->from('users');
                                $this->db->join('positions','users.position=positions.pid');
                                $this->db->join('roles','users.role=roles.roid');
                                $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                                $query=$this->db->get();
                                
                                   /*foreach($query->result() as $row)
                                   {
                                       echo $row->fullname;
                                   }
                                   */
                                return $query->result();
                           
                      }
                       
                      
               break;
               case 5:
                                $this->db->where('users.flage',1);
                                $this->db->where('users.BrCode',$brcode);
                                $this->db->where('users.manager',$id);
                                $this->db->from('users');
                                $this->db->join('positions','users.position=positions.pid');
                                $this->db->join('roles','users.role=roles.roid');
                                $this->db->join("tbl_branch",'tbl_branch.brCode=users.BrCode');
                                $query=$this->db->get();
                                   /*foreach($query->result() as $row)
                                   {
                                       echo $row->fullname;
                                   }*/
                                return $query->result();
               break;
               case 6:
               break;
                   
                
           }
            
            
            
        }
        
    }
    
    public function getBrCodebySid($sid)
    {
        $this->db->where("SID",$sid);
        $query=$this->db->get("users")->row();
        return $query->BrCode;
    }
    public function getBranch()
    {
        $option="branchshow";
        $config=$this->getconfig($option);
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
    public function getBranchbyrm($rm)
    {
        $option="branchshow";
        $config=$this->getconfig($option);
        if($config->keys==1)
        {
            $result=$this->db
                    ->select('distinct(rm),brCode,brName')
                    ->from('users')
                    ->where("tbl_branch.brCode>","499")
                    ->where("tbl_branch.brCode!=","500")
                    ->where('users.rm',$rm)
                    ->join('tbl_branch','users.BrCode=tbl_branch.brCode')
                    ->get();
            return $result->result();
            
        }
        else
        {
            
            $result=$this->db
                    ->select('distinct(rm),tbl_branch.brCode,tbl_branch.brName')
                    ->from('users')
                    ->where('users.rm',$rm)
                    ->where("tbl_branch.brCode!=","500")
                    ->join('tbl_branch','users.BrCode=tbl_branch.brCode')
                    ->get();
            return $result->result();
        }
        
    }
   
}
?>
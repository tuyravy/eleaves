<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class menu_model extends CI_Model
{
   function getMenu()
   {
       $result=$this->db->from('menu_role')
                        ->where('flage',1)
                        ->where('type',1)
                        ->get();
        return $result->result();
   }
   function getUsermenu()
   {
       $user_id=$this->session->userdata('user_id');
       $result=$this->db->from('users')
                        ->where('user_id',$user_id)
                        ->where('flag',1)
                        ->get();
       $menulist=array();
       foreach($result->result() as $k=>$val)
       {
            $menulist=explode(",",$val->menu_option);
            
       }
       return $menulist;
       
   }
   function getsubMenu()
   {
       $user_id=$this->session->userdata('user_id');
       $result=$this->db->from('users')
                        ->where('user_id',$user_id)
                        ->where('flag',1)
                        ->get();
       $menulist=array();
       foreach($result->result() as $k=>$val)
       {
            $menulist=explode(",",$val->submenu_option);
            
            
       }
       return $menulist;
       
   }
    public function setprofile($userid,$sid)
    {
        $sidresult=$this->getstaff($sid);
        if($sidresult==true)
        {
            $row=$this->input->post();
            $data=array
                (
                    'system_id'=>$row['sid'],
                    'full_name'=>$row['fname'],
                    'full_name_kh'=>$row['fnamekhr'],
                    'password'=>$row['password'],
                    'email'=>$row['email'],
                    'phone'=>$row['pnumber'],
                    'profile'=>0,
                    'reset_password'=>0
                );
            $this->db->where('user_id',$userid);
            $this->db->update('users',$data);
            return true;
        }
        else
        {
            return false;
        }
        
    }
    public function getstaff($sid)
    {
          $result=$this->db->query("CALL sp_Getallstaff(".$sid.")");
          $res= $result->result(); 
          $result->next_result(); 
          $result->free_result(); 

        foreach($result as $row)
        {
            return $row;
        };
    }
}
?>
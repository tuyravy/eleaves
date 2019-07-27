<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class login_model extends CI_Model
{
   function checklogin($username,$password)
   {
        $result=$this->db->from('users')
                         ->where('username',$username)
                         ->where('password',$password)
                         ->where('flag',1)
                         ->get();
        if($result->num_rows()>0)
        {
            foreach($result->result() as $row)
            {
                return $row;
            }
        }
   }

   function getforgepassword($sid)
   {
        $result=$this->db->query("
                                    select 
                                            system_id,
                                            full_name,
                                            username,
                                            password,
                                            phone,
                                            branch_code
                                    from users where flag=1 and system_id='".$sid."'; 
                                ");
        if($result->num_rows()>0){
        foreach($result->result() as $row)
        {
            return $row;
        }
        }else
        {
            return false;
        }
   }
   function getUsers($login,$password)
   {
       
      $query=$this->db->query(
                            "select 
                            users.user_id as user_id,
                            users.branch_code as branch_code,
                            users.system_id,
                            users.full_name as full_name,
                            users.full_name_kh as full_name_kh,
                            users.username as username,
                            users.phone as phone,
                            users.role_id as role_id,
                            users.menu_option,
                            users.subbranch,
                            users.role as role,
                            users.logo,
                            users.logo_title,
                            staff.hid,
                            staff.company_id,
                            users.types,
                            trim(users.username),
                            trim(users.password)
                            from users 
                            inner join staff on users.system_id=staff.system_id and users.branch_code=staff.brcode
                            where
                            trim(users.username)='".$login."'
                            and trim(users.password)='".$password."'
                            and staff.active=1
                            "
                        );
        
       if($query->num_rows()>=1)
       {
            return $query->result();
           
       }
       else
       {
           return false;
       }
       
   }
   
    
    
}
?>
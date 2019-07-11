<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{
    public function getDashoboard($brcodes,$subbranch,$role,$optionrole)
    {
       
            $result=$this->db->query("call sp_Dashboard('".$brcodes."','".$subbranch."','".$role."','".$optionrole."')");
            $res= $result->result(); 
            $result->next_result(); 
            $result->free_result(); 
            
                
                foreach($result->result() as $re)
                    {
                        return $re->total;
                    }
                
            
    
           
    }
    public function getDashoboardRM($sid,$optionrole)
    {
       
            $result=$this->db->query("call sp_Dashboard_RM('".$sid."','".$optionrole."')");
            $res= $result->result(); 
            $result->next_result(); 
            $result->free_result(); 
            
                
                foreach($result->result() as $re)
                    {
                        return $re->total;
                    }
                
            
    
           
    }
}
?>
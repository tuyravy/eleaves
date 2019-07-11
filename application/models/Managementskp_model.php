<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class managementskp_model extends CI_Model
{
 
    
   public function getErrorsSKP()
   {
        $result=$this->db->query("CALL sp_getErrorsSKP()");
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        return $res;
   }
   
    
    
}
?>
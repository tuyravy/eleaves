<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class setting_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
    }
    public function get_config()
    {
        $result=$this->db->get("config");
        return $result->result();
        
    }
    public function setconfigsystem()
    {
       
    }
}
?>
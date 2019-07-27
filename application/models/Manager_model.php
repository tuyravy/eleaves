<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Manager_model extends CI_Model
{
    public function __construct()
    {
         parent::__construct();         
    }
    public function getManagerName($systemid,$role,$company_id)
    {
        
        $mid=$this->db->select('hid')
                      ->from('staff')
                      ->where('system_id',$systemid)
                      ->where('company_id',$company_id)
                      ->where('flag',1)
                      ->get();
        if($mid->num_rows()>0)
        {
            foreach($mid->result() as $mids)
            {
                $res=$this->db->from('manager')
                         ->where('m_id',$mids->hid)
                         ->where('flag',1)
                         ->get();
                foreach($res->result() as $row)
                {
                    return $row;
                }
            }
        }else
        {
            return false;
        }
     
    }
}
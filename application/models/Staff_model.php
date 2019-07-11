<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class staff_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model("Config_model");
    }
    public function getstaff($brcode,$subbrcode)
    {
      switch($role=$this->session->userdata('role'))
      {
          case 1:
              
          break;
          case 2:
          
          break;
          case 3:
               $config=$this->Config_model->getconfig('ex');
              if($config->keys==1){
               $result=$this->db->from('staff')
                        ->join('tbl_branch','tbl_branch.brCode=staff.brcode')
                        ->where('staff.flag',1)
                        ->where('staff.active',1)
                        ->where('staff.brcode',$brcode)
                        ->where('staff.position_nameeng!=','Branch Manager')
                        ->get();
                return $result->result();
              }else
              {
                   $result=$this->db->from('staff')
                        ->join('tbl_branch','tbl_branch.brCode=staff.brcode')
                        ->where('staff.flag',1)
                        ->where('staff.active',1)
                        ->where_in('staff.brcode',array($brcode,$subbrcode))
                        ->where('staff.position_nameeng!=','Branch Manager')
                        ->get();
                    return $result->result();
              }
              
          break;
              
          case 4:
              $system_id=$this->session->userdata('system_id');
              
              $res=$this->db->from('rm')
                            ->where('sid',$system_id)
                            ->where('flag',1)
                            ->get();
              foreach($res->result() as $re){
               $result=$this->db->from('staff')
                        ->join('tbl_branch','tbl_branch.brCode=staff.brcode')
                        ->where('staff.flag',1)
                        ->where('staff.active',1)
                        ->where('staff.rm_id',$re->rid)
                        ->where('staff.position_nameeng','Branch Manager')
                        ->get();
                return $result->result();
              }
          break;
          
          case 5:
              $system_id=$this->session->userdata('system_id');
              
              $res=$this->db->from('manager')
                            ->where('sid',$system_id)
                            ->where('flag',1)
                            ->get();
              foreach($res->result() as $re){
               $result=$this->db->from('staff')
                        ->where('flag',1)
                        ->where('hid',$re->m_id)
                        ->get();
                return $result->result();
              }
          break;
         case 6:
              $result=$this->db->query('
                        SELECT 
                           * 
                         FROM staff
                        WHERE system_id IN (SELECT sid FROM manager WHERE flag=1)
                        AND flag=1;');
              return $result->result();
          break;
              
      }
        
        
    }
    public function GetheadofID($sid)
     {
         $result=$this->db->query("select m_id FROM manager WHERE sid=".$sid."");
         foreach($result->result() as $row)
         {
             return $row->m_id;
         }
     }
     
    public function getRm($sid)
            {
                $result=$this->db->query("select rid from rm where sid=".$sid."");
                foreach($result->result() as $row)
                {
                    return $row->rid;
                }
            }
    public function getallstaff($brcode,$role,$systemid,$subcode,$config)
    {
       switch($role)
       {
           case 1:
            
           break;
           case 2:
           break;
           case 3:
                    $res=$this->db->query("SELECT * FROM staff inner join tbl_branch on tbl_branch.brcode=staff.brcode WHERE staff.brcode IN('".$subcode."','".$brcode."') AND staff.flag=1");
                    return $res->result();
           break;
           case 4:
                    $res=$this->db->query("SELECT * FROM staff inner join tbl_branch on tbl_branch.brcode=staff.brcode WHERE staff.rm_id=".$this->getRm($systemid)." AND staff.flag=1 AND staff.position_nameeng='Branch Manager';");
                    return $res->result();
           break;
           case 5:
                    $res=$this->db->query("SELECT * FROM staff inner join tbl_branch on tbl_branch.brcode=staff.brcode WHERE staff.hid=".$this->GetheadofID($systemid)." AND staff.flag=1;");
                    return $res->result();
           break;
           case 6:
                    $res=$this->db->query("SELECT * FROM staff inner join tbl_branch on tbl_branch.brcode=staff.brcode WHERE staff.hid=5 OR staff.rm_id=5 AND staff.flag=1");
                    return $res->result();
           
           break;

       } 
       
        
    }
    
}
?>
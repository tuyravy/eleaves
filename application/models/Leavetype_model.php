<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class leavetype_model extends CI_Model

{

    public function __construct() 

    {

        parent::__construct();

    }

    public function getleavetype()

    {

        $result=$this->db->from('types')

                        ->where('flag',1)

                        ->get();

        return $result->result();
    }
    public function getstaff($sid)
    {
            $res=$this->db->from('staff')
                          ->where('system_id',$sid)
                          ->where('flag',1)
                          ->get();
            foreach($res->result() as $row)
            {
                return $row;
            }
    }
    public function Calculate($DOE)
    {
            $now=date('Y-m-d');
            $ResDOE=$now-$DOE;
            
    }
    public function checkleavetype($sid)
    {
        $users=$this->getstaff($sid);
        foreach($users as $us)
        {

        }
        $result=$this->db->from('types')

                        ->where('flag',1)

                        ->get();

        return $result->result();
    }

}

?>
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class permission_model extends CI_Model
{
            //=================Staff role==========
            //1-if role=1 and active=3 HO Staff
            //2-if role=3 and active=3 HD Staff
            //3-if role=2 and active=1 Acc Staff
            //4-if role=2 and active=2 BM Staff
            //5-if role=3 and active=1 RM Staff
            //6-if role=3 and active=2 OM Staff
            //7-if role=4 and active=3 AdminControl
            //8-if role=5 and active=1 DCEO Staff
            //=================end==================
    
  public function getuser_movebranch()
  {
      
            $role=$this->session->userdata('role');
            $active=$this->session->userdata('active');
            $sid=$this->session->userdata('SID');
            $brcode=$this->session->userdata('BrCode');
            if($role=1 && $active==3)
            {
                $this->db->where('users.flage',1);
                $this->db->where("SID",$sid);
                $query=$this->db->get("users");
                return $query->result();
                
            }elseif($role=3 && $active==3)
            {
                $this->db->where('users.flage',1);
                $this->db->where("SID",$sid);
                $query=$this->db->get("users");
                return $query->result();
                
            }elseif($role=2 && $active==1)
            {
                $this->db->where('users.flage',1);
                $this->db->where("BrCode",$brcode);
                $query=$this->db->get("users");
                return $query->result();
                
            }elseif($role=2 && $active==2)
            {
                $this->db->where('users.flage',1);
                $this->db->where("BrCode",$brcode);
                $query=$this->db->get("users");
                return $query->result();
                
            }elseif($role=3 && $active==1)
            {
                $this->db->where('users.flage',1);
                $this->db->where("SID",$sid);
                $query=$this->db->get("users");
                return $query->result();
                
            }elseif($role=3 && $active==2)
            {
                $this->db->where('users.flage',1);
                $this->db->where("SID",$sid);
                $query=$this->db->get("users");
                return $query->result();
                
            }elseif($role=5 && $active==1)
            {
                $this->db->where('users.flage',1);
                $this->db->where("SID",$sid);
                $query=$this->db->get("users");
                return $query->result();
                
            }
            
      
  }
  public function getrmname()
  {
      $result=$this->db->get('rm');
      return $result->result();
      
  }  
  public function getbranch()
  {
      $this->db->where('users.flage',1);
      $this->db->from("users");
      $this->db->group_by("tbl_branch.brCode");
      //$this->db->join("rm","rm.rid=users.RM");
      $this->db->join("tbl_branch","tbl_branch.brCode=users.BrCode");
      $result=$this->db->get();
      return $result->result();
      
  }
  public function getallbranch(){
      
       $result=$this->db->get("tbl_branch");
      return $result->result();
  }
  public function changermname()
  {
      $change=$this->input->post("change[]");
      $rmname=$this->input->post("rmname");
      foreach($change as $brcode)
      {
          $data=array("RM"=>$rmname);
          $this->db->where('users.flage',1);
          $this->db->where("BrCode",$brcode);
          $this->db->update("users",$data);
      }
      
      $data=array("RM"=>$rmname);
      $this->db->where('users.flage',1);
      $this->db->where("id",$rmname);
      $this->db->update("users",$data);
  }
  public function updatechageRM()
  {
      $RMname=$this->input->post("RMname");
      $rmid=$this->input->post("rmid");
      $staffid=$this->input->post("staffid");
      $data=array
          (
          "name"=>$RMname,
          "sid"=>$staffid,
          "description"=>"RM",
          "modifireddate"=>date("Y-m-d")
          );
      $this->db->where("rid",$rmid);
      $this->db->update("rm",$data);
  }
  public function deletechangeRM()
  {
      $rmid=$this->input->post("rmid");
      $this->db->where("rid",$rmid);
      $this->db->delete("rm");
  }
  public function creatermnew()
  {
      $RMname=$this->input->post("RMname");
      $staffid=$this->input->post("staffid");
      $data=array
          (
           "name"=>$RMname,
           "sid"=>$staffid,
           "description"=>"RM",
           "modifireddate"=>date("Y-m-d")
          );
      $this->db->insert("rm",$data);
  }

    
}
?>
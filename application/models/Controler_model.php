<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Controler_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();  
    }
    public function GetRmName()
    {
       $result=$this->db->query("
                                    select
                                        rid,
                                        name,
                                        sid,
                                        branch_control
                                    from rm where flag=1;
                                ");
                            
        return $result->result();
        
    }
    public function GetRmNamebyID($id)
    {
       $result=$this->db->query("
                                    select
                                        rid,
                                        name,
                                        sid,
                                        branch_control
                                    from rm where flag=1 and rid=".$id.";
                                ");
                            
        foreach($result->result() as $row)
        {
            return $row;
        };
        
    }
    public function Runimport_tblProcess()
    {
        $result=$this->db->query("
                                call Runimport_tblProcess();
                            ");
        $res=$result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
        //end of new code
        foreach($res as $row)
        {
            return true;
        }            
         
    }
    public function Runimport_tblStaff()
    {
        $result=$this->db->query("
                                call Rumimport_tblStaff();
                            ");
        $res=$result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
        //end of new code
        foreach($res as $row)
        {
            return true;
        }       
    }
    public function RunSetRMCode()
    {
        $res=$this->db->from('rm')
                    ->where('flag',1)
                    ->get();
        foreach($res->result() as $row)
        {
            $this->setrmcode($row->rid);
            
        }
    }
    
    public function setrmcode($rm)
    {
        $result=$this->db->from('rm')
                        ->where('flag',1)
                        ->where('rid',$rm)
                        ->get();
        $listarray=array();
        $rm=0;
        foreach($result->result() as $k=>$val)
        {
          $listarray=explode(",",$val->branch_control);
          $rm=$val->rid;
        
        }
        
        
         foreach($listarray as $re)
           {    
             $re=$this->db->from('staff_process')
                        ->where('flag',1)
                        ->where('active',1)
                        ->where('brcode',$re)
                        ->get();
                foreach($re->result() as $rs)
                {
                    
                    $dataupdate=array
                        (
                            'rm_id'=>$rm
                        );
                    $this->db->where('system_id',$rs->system_id);
                    $this->db->update('staff_process',$dataupdate);
                }

           }
       
    }
    public function sethidcode($hid)
    {
        
        $result=$this->db->from('manager')
                        ->where('flag',1)
                        ->where('m_id',$hid)
                        ->get();
        $listarray=array();
        $listbrcode="";
        $hid=0;
        $brcode=0;
        $company_id=0;
        foreach($result->result() as $k=>$val)
        {
          if($val->types==2){
            $brcode=1;
            $listarray=explode(",",$val->listofpostion);
            $hid=$val->m_id;
            $company_id=$val->company_id;
            
          }else if($val->types==3){

            $brcode=2;
            $listarray=explode(",",$val->listofpostion);
            $listbrcode=$val->listofbranch;
            $hid=$val->m_id;
            $company_id=$val->company_id;
          }
          else{

            $listarray=explode(",",$val->listofpostion);
            $hid=$val->m_id;
            $company_id=$val->company_id;
          }
         
        
        }
        if($brcode==1){

            
            foreach($listarray as $re)
            {    
          
              $res=$this->db->from('staff_process')
                         
                         ->where('staff_process.flag',1)
                         ->where('staff_process.active',1)
                         ->where('staff_process.brcode',$re)
                         ->get();
                 foreach($res->result() as $rs)
                 {

                    $dataupdate=array
                    (
                        'hid'=>$hid,
                        'company_id'=>$company_id
                    );
                    $this->db->where('system_id',$rs->system_id);
                    $this->db->where('brcode',$rs->brcode);
                    $this->db->update('staff_process',$dataupdate);
                    
                }
            }
            


        }else if($brcode==2){

            foreach($listarray as $re)
            {    
          
                $res=$this->db->from('staff_process')
                                ->join('positions','positions.description=staff_process.position_nameeng')
                                ->where('staff_process.flag',1)
                                ->where('staff_process.active',1)
                                ->where('positions.pid',$re)
                                ->where_in('staff_process.brcode',$listbrcode)
                                ->get();                                
                 foreach($res->result() as $rs)
                 {

                    $dataupdate=array
                    (
                        'hid'=>$hid,
                        'company_id'=>$company_id
                    );
                    $this->db->where('system_id',$rs->system_id);
                    $this->db->where('brcode',$rs->brcode);
                    $this->db->update('staff_process',$dataupdate);
                    
                }
            }


        }else{
        
         foreach($listarray as $re)
           {    
             $res=$this->db->from('staff_process')
                        ->join('positions','positions.description=staff_process.position_nameeng')
                        ->where('staff_process.flag',1)
                        ->where('staff_process.active',1)
                        ->where('positions.pid',$re)
                        ->get();
                foreach($res->result() as $rs)
                {

                    if($rs->level==1){
                        $dataupdate=array
                            (
                                'hid'=>5,//level head,
                                'company_id'=>$company_id
                                
                            );
                        $this->db->where('system_id',$rs->system_id);
                        $this->db->where('brcode',$rs->brcode);
                        $this->db->update('staff_process',$dataupdate);
                    }
                    else{
                        
                        if($rs->rm_id!=0 && $rs->description!='Branch Manager')
                        {
                            $dataupdate=array
                            (
                                'hid'=>0,
                                'company_id'=>$company_id
                            );
                        $this->db->where('system_id',$rs->system_id);
                        $this->db->where('brcode',$rs->brcode);
                        $this->db->update('staff_process',$dataupdate);
                            
                        }
                        else{
                            
                            $dataupdate=array
                                (
                                    'hid'=>$hid,
                                    'company_id'=>$company_id
                                );
                            $this->db->where('system_id',$rs->system_id);
                            $this->db->where('brcode',$rs->brcode);
                            $this->db->update('staff_process',$dataupdate);
                            
                            
                            
                        }
                    }
                   
                 /*   if($rs->level==1){
                    $dataupdate=array
                        (
                            'hid'=>3
                        );
                    $this->db->where('system_id',$rs->system_id);
                    $this->db->update('staff_process',$dataupdate);
                    }
                    else if($rs->level==4)
                    {
                        $dataupdate=array
                        (
                            'hid'=>$hid
                        );
                    $this->db->where('system_id',$rs->system_id);
                    $this->db->update('staff_process',$dataupdate);
                        
                    }
                    else
                    {
                    if($rs->rm_id!=0)
                    {
                        $dataupdate=array
                        (
                            'hid'=>0
                        );
                    $this->db->where('system_id',$rs->system_id);
                    $this->db->update('staff_process',$dataupdate);
                        
                    }
                    else{
                    $dataupdate=array
                        (
                            'hid'=>$hid
                        );
                    $this->db->where('system_id',$rs->system_id);
                    $this->db->update('staff_process',$dataupdate);
                        
                    }
                    
                }
            */
           }
         }
        }
        
    }
    public function gethid()
    {
        $res=$this->db->from('manager')
                    ->where('flag',1)
                    ->get();
        foreach($res->result() as $row)
        {
            $this->sethidcode($row->m_id);
            
        }
    }
    public function AddRmName($RmName,$BrControl,$Des,$sid,$email)
    {
        $data=array
            (
                'name'=>$RmName,
                'branch_control'=>$BrControl,
                'description'=>$Des,
                'sid'=>$sid,
                'email'=>$email    
            );
        $this->db->insert('rm',$data);
    }
    public function DeleteRmName($id)
    {
        $this->db->where('rid',$id);
        $this->db->delete("rm");
    }
}

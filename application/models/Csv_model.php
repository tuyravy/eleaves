<?php

class Csv_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
        
    }
    
    /*function get_addressbook() {     
        $query = $this->db->get('addressbook');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }*/
    //check brcode
     public function get_all_header() {
        $query = $this->db
                ->select('COLUMN_NAME')
                ->from('INFORMATION_SCHEMA.COLUMNS')
                ->where('table_name', 'staff_informations')
                ->get();
        return $query->result();
    }
    function checking()
    {
        
        $result=$this->db->from('users_imports')
                        ->get();
        foreach($result->result() as $row)
        {
            $sid=$this->checkingall($row->sid);
            if(trim($row->sid)==trim($sid))
            {
                $update=array
                    (
                        'Brcode'=>$row->brCode,
                        'fullname'=>$row->fullname,
                        'sex'=>$row->sex,
                        'login'=>$row->fullname,
                        'employmentdate'=>$row->employment_date
                    );
                $this->db->where('SID',$row->sid);
                $this->db->update('users_temp',$update);
            }else
            {
                
                $data=array
                    (
                    'SID'=>$row->sid,
                    'fullname'=>$row->fullname
                   
                    );
                $this->db->insert('users_temp',$data);
            }
        }
        
    }
    function checkingall($sid)
    {
        $result1=$this->db->from('users_temp')
                            ->where('SID',$sid)
                            ->get();
        foreach($result1->result() as $row)
        {
            return $row->SID;
        }
    }
    function importtousertable()
    {
        
        $result=$this->db->from('users_imports')
                         ->join('tbl_branch','users_imports.brCode=tbl_branch.brcode')
                         ->select('users_imports.sid,
                                   users_imports.fullname,
                                   users_imports.fullnamekh,
                                   users_imports.sex,
                                   users_imports.employment_date,
                                   users_imports.position,
                                   users_imports.phone,
                                   users_imports.brCode,
                                   tbl_branch.brCode
                                 ')
                         ->get();
        

        foreach($result->result() as $row)
        {
                
                $insert=array
                    (
                        'Brcode'=>$row->brCode,
                        'fullname'=>$row->fullname,
                        'login'=>$row->fullname,
                        'password'=>'skp@007',
                        'employmentdate'=>$row->employment_date,
                        'SID'=>$row->sid
                    );
                $this->db->insert('users_temp',$insert);
            
            
        }
        
    }
    function checkposition()
    {
        $ab=$this->db->from('users_temp')
                    ->get();
        foreach($ab->result() as $re)
        {
        
            $result=$this->db->from('users_imports')
                    ->select('
                            id,
                            sid,
                            position
                            ')
                    ->where('sid',$re->SID)
                    ->get();
           foreach($result->result() as $row)
           {
            $position=$this->db->from('positions')
                        ->select('
                            pid,
                            description,
                            level,
                            position_short
                            ')
                    ->get();
               foreach($position->result() as $prow)
               {
                   if(trim($row->position)==trim($prow->description))
                   {
                       $insert=array
                           (
                             "position"=>$prow->pid
                            );
                       $this->db->where('id',$row->id);
                       $this->db->update('users_temp',$insert);
                       
                       
                   }
                  
                       
                   
               }
               
           }
        }
        
    }
    //Checking RM id
    function checkingRM()
    {
        
        $result=$this->db
                ->from('rm')
                ->select('rid,branch_control')
                ->get();
        $arrylist=array();
        //print_r($result);
        foreach($result->result() as $row)
        {
            $arrylist=$row->branch_control;
            
            $list=explode(",",$arrylist);
            $a="";
            foreach($list as $values)
            {
                $brcode=$values;
                $this->getuserimport($row->rid,$brcode);

            }
             
        }
           
    }
    //get user checking RM
    function getuserimport($rm,$brcode)
    {
        $update=array
                (
                "RM"=>$rm
                );
        $this->db->where('Brcode',$brcode);
        $this->db->update('users_temp',$update);
    }
    
    
    //get role for apply all users
    
    function getrole()
    {
        $result=$this->db->from('users_temp')
                 ->join('positions','users_temp.position=positions.pid')
                 ->select(' users_temp.position,
                            positions.dpt_id,
                            positions.level,
                            positions.flag,
                            positions.pid
                            ')
                 ->where('positions.flag','1')
                 ->get();
        foreach($result->result() as $row)
        {
            
            switch($row->dpt_id)
            {
                case 1:
                    $update=array
                        (
                        'role'=>5
                        );
                    $this->db->where('position',$row->pid);
                    $this->db->where('flag',1);
                    $this->db->update('users_temp',$update);
                break;
                case 2:
                     if($row->level==2){
                         $update=array
                            (
                            'role'=>4,
                            'active'=>1
                            );
                        $this->db->where('position',$row->pid);
                        $this->db->where('flag',1);
                        $this->db->update('users_temp',$update);
                     }else
                     {
                        $update=array
                            (
                            'role'=>1,
                            'active'=>1
                            );
                        $this->db->where('position',$row->pid);
                        $this->db->where('flag',1);
                        $this->db->update('users_temp',$update);
                     }
                break;
                case 3:
                    switch($row->level)
                    {
                        case 2:
                            $update=array
                                (
                                'role'=>4,
                                'active'=>2
                                );
                            $this->db->where('position',$row->pid);
                            $this->db->where('flag',1);
                            $this->db->update('users_temp',$update);
                        break;
                        case 3:
                            $update=array
                                (
                                'role'=>4,
                                'active'=>3//active RM
                                );
                            $this->db->where('position',$row->pid);
                            $this->db->where('flag',1);
                            $this->db->update('users_temp',$update);
                        break;
                        case 4:
                            $update=array
                                (
                                'role'=>3,
                                'active'=>0
                                );
                            $this->db->where('position',$row->pid);
                            $this->db->where('flag',1);
                            $this->db->update('users_temp',$update);
                        break;
                        case 5:
                            $update=array
                                (
                                'role'=>2,
                                'active'=>0
                                );
                            $this->db->where('position',$row->pid);
                            $this->db->where('flag',1);
                            $this->db->update('users_temp',$update);
                            
                        break;
                        case 0:
                            $update=array
                                (
                                'role'=>1,
                                'active'=>0
                                );
                            $this->db->where('position',$row->pid);
                            $this->db->where('flag',1);
                            $this->db->update('users_temp',$update);
                        break;
                    }
                   
                break;
                case 4:
                    if($row->level==2){
                         $update=array
                            (
                            'role'=>4,
                            'active'=>1
                            );
                        $this->db->where('position',$row->pid);
                        $this->db->where('flag',1);
                        $this->db->update('users_temp',$update);
                     }else
                     {
                        $update=array
                            (
                            'role'=>1,
                            'active'=>1
                            );
                        $this->db->where('position',$row->pid);
                        $this->db->where('flag',1);
                        $this->db->update('users_temp',$update);
                     }
                break;
                case 5:
                    if($row->level==2){
                         $update=array
                            (
                            'role'=>4,
                            'active'=>1
                            );
                        $this->db->where('position',$row->pid);
                        $this->db->where('flag',1);
                        $this->db->update('users_temp',$update);
                     }else
                     {
                        $update=array
                            (
                            'role'=>1,
                            'active'=>1
                            );
                        $this->db->where('position',$row->pid);
                        $this->db->where('flag',1);
                        $this->db->update('users_temp',$update);
                     }
                break;
                case 6:
                    if($row->level==2){
                         $update=array
                            (
                            'role'=>4,
                            'active'=>1
                            );
                        $this->db->where('position',$row->pid);
                        $this->db->where('flag',1);
                        $this->db->update('users_temp',$update);
                     }else
                     {
                        $update=array
                            (
                            'role'=>1,
                            'active'=>1
                            );
                        $this->db->where('position',$row->pid);
                        $this->db->where('flag',1);
                        $this->db->update('users_temp',$update);
                     }
                break;
                    
            }
            
            
        }
        
            
    }
    
    function checkingManagerID()
    {
        $result=$this->db->from('users_temp')
                         ->select('position,role,active,id,flag,RM,Brcode')
                         ->where('flag',1)
                         ->get();
        foreach($result->result() as $row)
        {
            switch($row->role)
            {
               
                    
                case 3:
                    $getantive2=$this->db->from('users_temp')
                                        ->select('position,role,active,id,flag')
                                        ->where('flag',1)
                                        ->where('role',4)
                                        ->where('active',2)
                                        ->get()->row();
                    $update=array
                            ('manager'=>$getantive2->id);
                    $this->db->where('id',$row->id);
                    $this->db->update('users_temp',$update);
                    
                break;
                case 4:
                    if($row->active==3)
                    {
                        $getantive2=$this->db->from('users_temp')
                                            ->select('position,role,active,id,flag')
                                            ->where('flag',1)
                                            ->where('role',4)
                                            ->where('active',2)
                                            ->get()->row();
                        $update=array
                                ('manager'=>$getantive2->id);
                        $this->db->where('id',$row->id);
                        $this->db->update('users_temp',$update);
                       
                    }
                    if($row->active==1)
                    {
                         $getantive2=$this->db->from('users_temp')
                                            ->select('position,role,active,id,flag')
                                            ->where('flag',1)
                                            ->where('role',5)
                                            ->where('position',2)
                                            ->where('active',0)
                                            ->get()->row();
                        $update=array
                                ('manager'=>$getantive2->id);
                        $this->db->where('id',$row->id);
                        $this->db->update('users_temp',$update);
                    }
                    
                break;
                    
                    
            }
        }
    }
    function HDIDManagerid()
    {
        $result=$this->db->from('positions')
                        ->where('level',2)
                        ->where('flag',1)
                        ->get();
        foreach($result->result() as $row)
        {
            $getdptid=$this->db->from('users_temp')
                                ->where('position',$row->pid)
                                ->where('flag',1)
                                ->get();
                       foreach($getdptid->result() as $dtid)
                        {
                           
                           $getuser=$this->db->from('users_temp')
                                            ->join('positions','positions.pid=users_temp.position')
                                            ->where('positions.dpt_id',$row->dpt_id)
                                            ->get();
                           foreach($getuser->result() as $rows)
                           {
                               if($rows->RM==0 && $rows->role==1)
                               {
                                  
                                   $update=array
                                    ('manager'=> $dtid->id);
                                   $this->db->where('id',$rows->id);
                                    $this->db->update('users_temp',$update);
                                                   
                               }
                               
                           }
                          
                        }
        }
        
        
    }
    
    function RMChecking()
    {
        $result=$this->db->from('users_temp')
                        ->join('rm','users_temp.SID=rm.sid')
                        ->where('users_temp.flag',1)
                        ->get();
        foreach($result->result() as $row)
        {
            $this->getRMID($row->rid,$row->id);
            
            
        }
        
       
    } 
    function upateemail()
    {
        $result=$this->db->from('users')
                        ->get();
        foreach($result->result() as $row)
        {
            $insertinto=array
                    (
                        'BrCode'=>$row->Brcode,
                        'fullname'=>$row->fullname,
                        'login'=>$row->login,
                        'email'=>$row->email,
                        'password'=>$row->password,
                        'role'=>$row->role,
                        'manager'=>$row->manager,
                        'position'=>$row->position,
                        'datehired'=>$row->employmentdate,
                        'SID'=>$row->SID,
                        'RM'=>$row->RM,
                        'active'=>$row->active
                    );
            $this->db->insert('users_old',$insertinto);
        }
        
        
    }
    function getRMID($rm,$id)
    {
        $result=$this->db->from('users_temp')
                    ->where('RM',$rm)
                    ->where('flag',1)
                    ->get();
        foreach($result->result() as $row)
        {
            if($row->role==1)
            {
                $update=array
                ('manager'=> $id);
                $this->db->where('id',$row->id);
                $this->db->update('users_temp',$update);
                
                
            }
           
           
        }
    }
    
    function userimport($data)
    {
         $this->db->insert('users_imports', $data);
    }
    
    
    
    //========================================Checking User Import===========================//
    
    //========================================Select Compare Users===========================//
    function getsid()
    {
      $result=$this->db->from('users_imports')
                   ->select('trim(sid),fullname,position,employment_date,phone,Brcode')
                   ->get();
      return $result;
         
    }
    
    function getusertemp()
    {
        $sids=$this->getsid();
        foreach($sids->result() as $sid)
        {
            $result=$this->db->from('users_temp')
                            ->select('trim(SID)')
                            ->where('SID!=',$sid->sid)
                            ->get();
            foreach($result->result() as $row)
            {
                echo $row->SID;
                echo "<br/>";
               
            }
            
            
        }
        
    }
    
    
    
    
    
    //========================================EndOffSelectCompare===========================//
    
    
    function insert_csv($data) {
        $this->db->insert('users', $data);
    }
    function re_count()
    {
        return $this->db->count_all('types');
    }
        
  public  function createbalanceleave()
    {
        $year=date("Y");
        /*-------get MaxLeaveBalance ----------*/
        
        $count=$this->re_count();
        $i=1;
        for($i=1;$i<=$count;$i++)
        {

          $this->db->select("id,MaxLeaveBalance");
          $this->db->where('id',$i);
          $typesleavs=$this->db->get("types")->row();
          $MaxLeaveBalance=$typesleavs->MaxLeaveBalance;   
            
         /*-------get users name where keyrun=1 */

            $this->db->where('keyrun',1);
            $this->db->where('flag',1);
            $result=$this->db->get("staff");
            if($result->num_rows()>=0)
            {
                foreach($result->result() as $rows)
                {
                    $values=$this->calculatDOE($rows->dateemployee,$MaxLeaveBalance);
                    if($values==9999)
                    {
                    
                        $data=array
                        (
                         "sid"=>$rows->system_id,
                         "year"=>$year,
                         "brcode"=>$rows->brcode,
                         "begining_leavebalance"=>$MaxLeaveBalance,
                         "ex_begining_leavebalance"=>$MaxLeaveBalance,
                         "leavetype"=>$i
                        );
                    $this->db->insert("leave_balance",$data);
                    }
                    else{
                    if($i==2)
                    {
                       $values="90"; 
                    }else
                    {
                        $values=$values;
                    }
                    $data=array
                        (
                         "sid"=>$rows->system_id,
                         "year"=>$year,
                         "brcode"=>$rows->brcode,
                         "begining_leavebalance"=>$values,
                         "ex_begining_leavebalance"=>$values,
                         "leavetype"=>$i
                        );
                    $this->db->insert("leave_balance",$data);
                    }
                }
                
                
                
            }
          
            
            
        }
         $data=array("keyrun"=>0);
         $this->db->update("staff",$data);
    }

 public function calculatDOE($DOE,$tatalbalanceleaves)
    {
        
        /*---if DOE >2016 check balance start and DOE<2016 full balance */
        $curr_year=date('Y-01-01');
        if($DOE>=$curr_year)
        {
        $date1 = $curr_year;
        $date2 = $DOE;
        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $totalday=floor($diff/(60*60*24));
        $numberofyear=365;
        $totalnumberofday=$numberofyear-$totalday;
        $totalbalance=$tatalbalanceleaves/$numberofyear*$totalnumberofday;
        $values=round($totalbalance);
        return $values;
            
        }
        else
        {
            $values=9999;
            return $values;
        }
        
    }
    
    
}
/*END OF FILE*/

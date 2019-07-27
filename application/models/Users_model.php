<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class users_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
    }
    public function menulist()
    {
        $result=$this->db->from('menu_role')
                         ->where('type',1)
                         ->where('flage',1)
                         ->get();
        return $result->result();
    }
    public function getsubmenu($parentid)
    {
        $result=$this->db->from('menu_role')
                         ->where('type',2)
                         ->where('parent_id',$parentid)
                         ->where('flage',1)
                         ->get();
        return $result->result();
    }

    /* Funciton Get Leaves Over Approve on Day leaves start < Day now */
    public function GetLeaveOverbyBranch($limitrow)
    {
        $result=$this->db->query("select count(*) as NumberofStaff ,tbl.brCode as BrCode,tbl.shortcode as BrName from leaves le 
        inner join staff st on st.system_id=le.sid
        inner join tbl_branch tbl on tbl.brCode=st.brcode
        where le.`status`=1 
        group by tbl.brcode,tbl.shortcode
        order by tbl.brcode limit 10 offset ".$limitrow.";");
        return $result->result();
    }
    public function TotalnumrowLeaveOver()
    {
        $result=$this->db->query("select count(*) as NumberofStaff ,tbl.brCode as BrCode,tbl.shortcode as BrName from leaves le 
        inner join staff st on st.system_id=le.sid
        inner join tbl_branch tbl on tbl.brCode=st.brcode
        where le.`status`=1 
        group by tbl.brcode,tbl.shortcode
        order by tbl.brcode");
        
        return count($result->result());
        
        
    }
    /*====================End=================*/

    /* Function Get List of User */

    
    public function GetlistofUser($limitrow)
    {
        $result=$this->db->from('users')
                         ->join('staff','staff.system_id=users.system_id')
                         ->join('tbl_branch','tbl_branch.brCode=users.branch_code')
                         ->where('users.flag',1)
                         ->order_by('users.branch_code','ASC')
                         ->limit('10',$limitrow)
                         ->get();
       
        return $result->result();
    }
    
    public function Totallistofuser()
    {
        $result=$this->db->query("
                        select 	count(*) as total
                        from users;")->row();
        return $result->total;

    }
    
    /*===End====================*/

    /*===Get Staff not yet User*/
    public function GetlistofStaffnotyetUser($limitrow)
    {
        $user=array();
        $usertbl=$this->db->select('system_id')
                           ->from('users')
                           ->get();
        foreach($usertbl->result() as $row)
        {
            array_push($user,$row->system_id);
        }
        $brcode=array(100,500);
        
        $result=$this->db->from('staff')
                         ->join('tbl_branch','tbl_branch.brCode=staff.brcode')
                         ->where('staff.active',1)
                         ->where_not_in("staff.system_id",$user)   
                         ->where_in('staff.brcode',$brcode)                                         
                         ->order_by('staff.brcode','DESC')                       
                         ->limit('10',$limitrow)
                         ->get();
       
        return $result->result();
    }
    public function Getrole()
    {
        
        return $this->db->from('roles')->order_by('code','ASC')->get()->result();
    }
    public function CreateUser($usertype,$sid,$email)
    {
        $role=0;
        $menu_option=0;
        $submenu_option=0;
        switch($usertype)
        {
            case 333:
            $role=1;
            $menu_option="1,2";
            $submenu_option="7,9,16,17,19";
            break;
            case 444:
            $menu_option="1,2,3";
            $submenu_option="7,9,14,16,17,18,19";
            $role=5;
            break;
            case 555:
            $menu_option="1,2,3";
            $submenu_option="7,8,9,16,17,14,18,19";
            $role=4;
            break;
            case 666:
            $menu_option="1,2,3";
            $submenu_option="8,9,14,16,17,19";
            $role=3;
            break;
            case 777:
            $role=6;
            $menu_option="1,2,3,28,5";
            $submenu_option="7,9,10,12,13,14,16,17,18,19,22,23,24,25,29,30,31";
            break;
            case 888:
            $menu_option="1,2,28,3,4,5,33,36";
            $submenu_option="7,9,10,12,13,14,16,17,19,20,22,23,24,25,27,29,30,31,32,34,35,37,38,39,40,41,42,43,44";
            $role=1;
            break;
            case 999:
            $menu_option="1,2,28,3,4,5,33,36";
            $submenu_option="7,9,10,12,13,14,16,17,19,20,22,23,24,25,27,29,30,31,32,34,35,37,38,39,40,41,42,43,44";
            $role=1;
            break;

        }
        $result=$this->db->query("insert into users
                (
                    system_id,
                    full_name,
                    full_name_kh,
                    username,
                    `password`,
                    email,
                    phone,
                    branch_code,
                    subbranch,
                    menu_option,
                    submenu_option,
                    role,
                    role_id,
                    created_date,
                    modified_date,
                    `keys`,
                    created_by,
                    modified_by,
                    reset_password,
                    profile,
                    `types`,
                    `status`,
                    flag,
                    alert
                )
            select 
                system_id,
                staff_nameeng,
                staff_namekh,
                replace(staff_nameeng,' ',''),
                'skp@007',
                '".$email."',
                phone_number,
                brcode,
                brcode,
                '".$menu_option."',
                '".$submenu_option."',
                '".$role."',
                '1',
                '".date("Y-m-d")."',
                '".date("Y-m-d")."',
                '1',
                '".$this->session->userdata('full_name')."',
                'tuyravy',
                0,
                '',
                1,
                '1',
                '1',
                '1'
            from staff where system_id='".$sid."';
           
            ");
            if($this->db->affected_rows()== 1)
            {
                return true;
            }else
            {return false;}

    }
    PUBLIC FUNCTION GETSENDUSER($role)
    {
        $result=$this->db->from('users')
                     ->join("tbl_branch","tbl_branch.brCode=users.branch_code")
                     ->where('users.alert',$role)->get()->result();
        return $result;
    }
    PUBLIC FUNCTION GETUSERBYSID($sid)
    {
        $result=$this->db->from('users')
        ->join("tbl_branch","tbl_branch.brCode=users.branch_code")
        ->where('users.system_id',$sid)->get()->result();
        foreach($result as $row)
        {
            return $row;
        }
        
    }
    public function Totalnumstaffnotyetuser()
    {
        $user=array();
        $usertbl=$this->db->select('system_id')
                           ->from('users')
                           ->get();
        foreach($usertbl->result() as $row)
        {
            array_push($user,$row->system_id);
        }
        $brcode=array(100,500);
       
        $result=$this->db->select('count(*) as total')
                         ->from('staff')
                         ->where('staff.active',1) 
                         ->where_not_in("system_id",$user)  
                         ->where_in('staff.brcode',$brcode)                          
                                                       
                         ->get()->row();
       
        return $result->total;
    }
    /*=============end================*/
    /*====Get manager name=====*/
    public function getmanager($limitrow)
    {
        $result=$this->db->from('manager')                            
        ->limit('10',$limitrow)
        ->get();
        return $result->result();
    }
    public function Totalmanager()
    {
        $result=$this->db->select("count(*) as total")
        ->from('manager')                           
      
        ->get()->row();
        return $result->total;
    }
    /*===========End of manager====*/
   /*=========Get Config RM */
    public function getconfigrm($limitrow)
    {
        $result=$this->db->from('rm')    
        ->where('flag',1)                        
        ->limit('10',$limitrow)
        ->get();
        return $result->result();
    }
    public function Totalconfigrm()
    {
        $result=$this->db->select("count(*) as total")
        ->from('rm')                          
        ->where('flag',1)
        ->get()->row();
        return $result->total;
    }
    public function GetBranchcheck()
    {
        $result=$this->db->from('tbl_branch')
        ->get()->result();
        return $result;
    }
    public function Getbranch_control($id)
    {
        $result=$this->db->from('rm')    
        ->where('flag',1)    
        ->where('rid',$id)                  
        ->get();
        $branch_control=array();
        foreach($result->result() as $key=>$br)
        {
            $branch_control=explode(",",$br->branch_control);
           
        }
    
        $branch=$this->GetBranchcheck();
        $branch_list=array();
        $branch_listbranch=array();
        foreach($branch as $brs)
        {
            foreach($branch_control as $rbr)
            {
                if($rbr==$brs->brCode)
                {                    
                     array_push($branch_list,$brs->brCode);
                     array_push($branch_listbranch,array("BrCode"=>$brs->brCode,"BrName"=>$brs->shortcode,"statu"=>0));
                     
                }               
            }            

        }

            $A=$this->db->from('tbl_branch')
            ->where_not_in('brCode',$branch_list)
            ->get()->result();
        $arrayA=array();
        foreach($A as $row)
        {
            array_push($arrayA,array('BrCode'=>$row->brCode,'BrName'=>$row->shortcode,"statu"=>1));
        }
        //$array_cuA=array_column($arrayA,'statu');
        $arrayB=array();
        foreach($branch_listbranch as $key=>$val)
        {          
                array_push($arrayB,array('BrCode'=>$val['BrCode'],'BrName'=>$val['BrName'],"statu"=>0));            
        }

        //$array_cuB=array_column($arrayB,'statu');
       
        $result=array_merge($arrayA,$arrayB);
        return $result;
        
    }
    public function EditRMName($id)
    {
        $result=$this->db->from('rm')    
        ->where('flag',1)    
        ->where('rid',$id)                  
        ->get();
        return $result->result();
    }
    public function GETSTAFFINFORMATIONDOWNALOD($BRCODE)
    {
        if($BRCODE==0)
        {
            $result=$this->db->query("
            select 
            s.system_id as STAFFCODE,
            s.staff_nameeng as STAFFNAME,
            s.staff_namekh as STAFFNAME_KH,
            s.sex AS GENDER,
            s.date_of_birth as DATE_OF_BIRTH,
            s.dateemployee as DATE_OF_EMPLOYEE,
            s.position_nameeng as POSITIONNAME,
            s.position_namekh as POSITIONINAME_KHR,
            tbl.shortcode as BRNAME,
            tbl.brCode as BRCODE
            from staff s
            left join tbl_branch tbl on tbl.brCode=s.brCode
            where CONCAT(tbl.brCode,s.system_id) 
            not in(select CONCAT(brcode,replace(replace(trim(staffcode),'0',''),'S','')) from staff_informations)
            and tbl.brCode not in(100,500) and s.active=1  order by tbl.brCode;
            "); 
            return $result->result();
        }else
        {
            $result=$this->db->query("
            select 
            s.system_id as STAFFCODE,
            s.staff_nameeng as STAFFNAME,
            s.staff_namekh as STAFFNAME_KH,
            s.sex AS GENDER,
            s.date_of_birth as DATE_OF_BIRTH,
            s.dateemployee as DATE_OF_EMPLOYEE,
            s.position_nameeng as POSITIONNAME,
            s.position_namekh as POSITIONINAME_KHR,
            tbl.shortcode as BRNAME,
            tbl.brCode as BRCODE
            from staff s
            left join tbl_branch tbl on tbl.brCode=s.brCode
            where CONCAT(tbl.brCode,s.system_id) 
            not in(select CONCAT(brcode,replace(replace(trim(staffcode),'0',''),'S','')) from staff_informations)
            and tbl.brCode not in(100,500) and s.active=1 and tbl.brCode=".$BRCODE." order by tbl.brCode;
            "); 
            return $result->result();
        }
    }
    public function GETSTAFFINFORMATIONBYBRCODE($BRCODE)
    {
        $result=$this->db->query("
        select * from staff 
        left join tbl_branch on tbl_branch.brCode=staff.brCode
        where CONCAT(tbl_branch.brCode,system_id) 
        not in(select CONCAT(brcode,replace(replace(trim(staffcode),'0',''),'S','')) from staff_informations)
        and tbl_branch.brCode not in(100,500) and active=1 AND tbl_branch.brCode=".$BRCODE." order by tbl_branch.brCode;
        "); 
        return $result->result();

    }
    public function GETSTAFFINFORMATION($limitrow)
    { 
        $result=$this->db->query("
            select * from staff
            left join tbl_branch on tbl_branch.brCode=staff.brCode
            where CONCAT(tbl_branch.brcode,system_id) 
            not in(select CONCAT(brcode,replace(replace(trim(staffcode),'0',''),'S','')) from staff_informations)
            and tbl_branch.brcode not in(100,500) and active=1 order by tbl_branch.brcode DESC limit 10 offset ".$limitrow.";
        "); 
       
        return $result->result();

    }
    public function TOTALSTAFFINFORMATION()
    { 
        $result=$this->db->query("
        select count(*) as TOTAL from staff where CONCAT(brcode,system_id) 
        not in(select CONCAT(brcode,replace(replace(trim(staffcode),'0',''),'S','')) from staff_informations)
        and brcode not in(100,500) and active=1;
        ")->row();
        return $result->TOTAL;

    }
    public function GETSTAFFREQUESTCHANGENBYBRCODE($BRCODE)
    {
        $result=$this->db->query("
        select * from staff 
        left join tbl_branch on tbl_branch.brCode=staff.brCode
        where CONCAT(tbl_branch.brCode,system_id) 
        not in(select CONCAT(brcode,replace(replace(trim(staffcode),'0',''),'S','')) from staff_informations)
        and tbl_branch.brCode not in(100,500) and active=1 AND rechange=0 AND tbl_branch.brCode=".$BRCODE." order by tbl_branch.brCode;
        "); 
        return $result->result();

    }
    public function staffRequestchangealready($BRCODE)
    {
        $result=$this->db->query("
        select * from staff 
        left join tbl_branch on tbl_branch.brCode=staff.brCode
        where CONCAT(tbl_branch.brCode,system_id) 
        not in(select CONCAT(brcode,replace(replace(trim(staffcode),'0',''),'S','')) from staff_informations)
        and tbl_branch.brCode not in(100,500) and active=1 AND rechange=1 AND tbl_branch.brCode=".$BRCODE." order by tbl_branch.brCode;
        "); 
        return $result->result();

    }
    public function GETSTAFFREQUESTCHANGE($limitrow)
    { 
        $result=$this->db->query("
            select * from staff
            left join tbl_branch on tbl_branch.brCode=staff.brCode
            where CONCAT(tbl_branch.brcode,system_id) 
            not in(select CONCAT(brcode,replace(replace(trim(staffcode),'0',''),'S','')) from staff_informations)
            and tbl_branch.brcode not in(100,500) and active=1 AND rechange=0 order by tbl_branch.brcode DESC limit 10 offset ".$limitrow.";
        "); 
       
        return $result->result();

    }
    public function TOTALSTAFFREQUESTCHANGE()
    { 
        $result=$this->db->query("
        select count(*) as TOTAL from staff where CONCAT(brcode,system_id) 
        not in(select CONCAT(brcode,replace(replace(trim(staffcode),'0',''),'S','')) from staff_informations)
        and brcode not in(100,500) and active=1 AND rechange=0;
        ")->row();
        return $result->TOTAL;

    }
   /*==========End========*/
    public function getsubMenubyuser($user_id)
   {
       
       $result=$this->db->from('users')
                        ->where('user_id',$user_id)
                        ->where('flag',1)
                        ->get();
       $menulist=array();
       foreach($result->result() as $k=>$val)
       {
            $menulist=explode(",",$val->submenu_option);
            
       }
       return $menulist;
       
   }
   public function checksubmenu($mid,$userid)
   {    
       $getsub=$this->getsubMenubyuser($userid);
       foreach($getsub as $row)
       {
           if($row==$mid)
           {
               return $row;
           }else{
               return $row;
           }
       }

   }
    public function Searchstaffbyid($staffid)
    {
        $result=$this->db->from('users')
                     ->where('system_id',$staffid)
                     ->where('flag',1)
                     ->get()->row();
        return $result;

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
             $re=$this->db->from('staff')
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
                    $this->db->update('staff',$dataupdate);
                }

           }
       
        
    }
   
    public function getrm()
    {
        $res=$this->db->from('rm')
                    ->where('flag',1)
                    ->get();
        foreach($res->result() as $row)
        {
            $this->setrmcode($row->rid);
            
        }
    }
    public function Movementstaff()
    {
        $resd=$this->db->query
        (
            "select * from staff_bak sd
            where sd.system_id in(select st.system_id from staff st where st.system_id=sd.system_id)"
        );
       if($resd->num_rows()>0){
        foreach($resd->result() as $re){
            $result=$this->db->query("select * from staff_bak sd
                                    where sd.system_id in(select st.system_id from staff st where st.system_id='".$re->system_id."')
                                    and sd.brcode!=(select s.brcode from staff s where s.system_id='".$re->system_id."' and s.brcode!=sd.brcode)
                                            and sd.active=1
                                    and sd.system_id='".$re->system_id."';");
        if($result->num_rows()>0){
            
            foreach($result->result() as $row)
            {
                $dup=$this->db->where('system_id',$row->system_id)
                ->where('brcode',$row->brcode)
                ->where('flag',1)
                ->get('staff');
                if($dup->num_rows()>0)
                {
                    break;
                }else{

                $data1=array('flag'=>0);
                $this->db->where('system_id',$row->system_id);
                $this->db->where('brcode!=',$re->brcode);
                $this->db->update('staff',$data1);
                $data=array("staff_id"=>$row->staff_id,
                "system_id"=>$row->system_id,
                "staff_nameeng"=>$row->staff_nameeng,
                "staff_namekh"=>$row->staff_namekh,
                "sex"=>$row->sex,
                "position_nameeng"=>$row->position_nameeng,
                "position_namekh"=>$row->position_namekh,
                "email"=>$row->email,
                "brcode"=>$row->brcode,
                "statu"=>$row->statu,
                "dateemployee"=>$row->dateemployee,
                "probations"=>$row->probations,
                "Eff_Date_current_position"=>$row->Eff_Date_current_position,
                "date_of_birth"=>$row->date_of_birth,
                "degree"=>$row->degree,
                "Id_card_familybook"=>$row->Id_card_familybook,
                "phone_number"=>$row->phone_number,
                "ACLEDA"=>$row->ACLEDA,
                "rm_id"=>$row->rm_id,
                "hid"=>$row->hid,
                "keyss"=>$row->keyss,
                "active"=>$row->active,
                "keyrun"=>$row->keyrun,
                "flag"=>$row->flag,
                "reportdate"=>$row->reportdate            
                );

              $re=$this->db->insert("staff",$data);
            }
              if($re==true)
              {
                  return true;
              }else
              {
                  return false;
              }
              
            }
            return false;
          }
        }
      }
      return false;
    }

    public function Promotepositionstaff()
    {
        $resd=$this->db->query
                        (
                            "select * from staff_bak sd
                            where sd.system_id in(select st.system_id from staff st where st.system_id=sd.system_id)"
                        );
        if($resd->num_rows()>0){
        foreach($resd->result() as $re){
            $result=$this->db->query(
                                    "select * from staff_bak sd
                                    where sd.system_id in(select st.system_id from staff st where st.system_id='".$re->system_id."')
                                    and sd.position_nameeng!=(select s.position_nameeng from staff s where s.system_id='".$re->system_id."')
                                    and sd.active=1
                                    and sd.system_id='".$re->system_id."';"
                                    );
            if($result->num_rows()>0){
                foreach($result->result() as $row)
                {
                $data=array("staff_id"=>$row->staff_id,
                    "staff_nameeng"=>$row->staff_nameeng,
                    "staff_namekh"=>$row->staff_namekh,
                    "sex"=>$row->sex,
                    "position_nameeng"=>$row->position_nameeng,
                    "position_namekh"=>$row->position_namekh,
                    "email"=>$row->email,
                    "brcode"=>$row->brcode,
                    "statu"=>$row->statu,
                    "dateemployee"=>$row->dateemployee,
                    "probations"=>$row->probations,
                    "Eff_Date_current_position"=>$row->Eff_Date_current_position,
                    "date_of_birth"=>$row->date_of_birth,
                    "degree"=>$row->degree,
                    "Id_card_familybook"=>$row->Id_card_familybook,
                    "phone_number"=>$row->phone_number,
                    "ACLEDA"=>$row->ACLEDA,
                    "rm_id"=>$row->rm_id,
                    "hid"=>$row->hid,
                    "keyss"=>$row->keyss,
                    "active"=>$row->active,
                    "keyrun"=>$row->keyrun,
                    "flag"=>$row->flag,
                    "reportdate"=>$row->reportdate
                    );
                    $this->db->where('system_id',$row->system_id);
                    $res=$this->db->update('staff',$data);
                    if($res==true)
                    {
                        return true;
                    }else
                    {
                        return false;
                    }
                    
                }
            }
            return false;
        }
     }
    }
    public function UpdateStaffInactive()
    {
        $result=$this->db->query("select * from staff_bak st where st.system_id 
                                in(select s.system_id from staff s) and st.active=0;");
        if($result->num_rows()>0){
            foreach($result->result() as $row)
            {
                $data=array
                (
                    "active"=>0,
                    "flag"=>0,
                    "reportdate"=>date('Y-m-d') 
                );
                $this->db->where('system_id',$row->system_id);
                $res=$this->db->update('staff',$data);
                if($res==true)
                {
                    return true;
                }else
                {
                    return false;
                }
                
            }
        }
        return false;
    }
    public function AutoRun()
    {
        $result=$this->db->query("call sp_AutoRunImports()");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
    //end of new code
        return TRUE;
    }
    public function AutImportstaff()
    {
       
       $this->AutoRun();
       
        
    }
    public function CheckHIDandSet()
    {
        $result=$this->db->query("select m.m_id,s.rm_id,s.hid,s.system_id from staff_bak s 
                                inner join manager m on s.system_id=m.sid
                                and s.flag=1 and s.system_id not in('2');");
        if($result->num_rows()>0){
            foreach($result->result() as $row)
            {
                $data=array
                (
                    "hid"=>6
                );
                $this->db->where("system_id",$row->system_id);
                $this->db->update("staff_bak",$data);
                
            }
           
        }
        return false;
    }
    public function sethidcode($hid)
    {
        
        $result=$this->db->from('manager')
                        ->where('flag',1)
                        ->where('m_id',$hid)
                        ->get();
        $listarray=array();
        $hid=0;
        foreach($result->result() as $k=>$val)
        {
          $listarray=explode(",",$val->listofpostion);
          $hid=$val->m_id;
        
        }
        
        
         foreach($listarray as $re)
           {    
             $re=$this->db->from('staff_process')
                        ->join('positions','positions.description=staff_process.position_nameeng')
                        ->where('staff_process.flag',1)
                        ->where('staff_process.active',1)
                        ->where('positions.pid',$re)
                        ->get();
                foreach($re->result() as $rs)
                {
                    
                    
                   
                    if($rs->level==2){
                    $dataupdate=array
                        (
                            'hid'=>7
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
    
    public function getposition()
    {
        $result=$this->db->from('positions')
                        ->where('flag',1)
                        ->get();
        return $result->result();
    }
    public function getmenamentrm()
    {
        $result=$this->db->from('rm')
                        ->where('flag',1)
                        ->get();
        return $result->result();
    }
    public function getmenamenthid()
    {
         $result=$this->db->from('manager')
                        ->where('flag',1)
                        ->get();
        return $result->result();
    }
    public function getBranch()
    {
        $result=$this->db->from('tbl_branch')
                        ->where('flag',1)
                        ->get();
        return $result->result();
    }
    public function setcreate()
    {
        
        $row=$this->input->post();
        switch($row['useroption'])
        {
            case 1:
                $menu_option='1,2';
                $submenu_option='7,9,16,17,19';
            break;
            case 2:
                 $menu_option='1,2,3';
                 $submenu_option='8,9,14,16,17,19';
            break;
            case 3:
                 $menu_option='1,2,3';
                 $submenu_option='8,9,14,16,17,19';
            break;
            case 4:
                 $menu_option='1,2,3';
                 $submenu_option='7,8,9,16,17,14,18,19';
            break;
            case 5:
                 $menu_option='1,2,3';
                 $submenu_option='7,9,14,16,17,18,19';
            break;
                
        }
        if($row['subbrname']==0)
        {
            $subbranch=0;
            $types=1;
        }else
        {
            $subbranch=$row['subbrname'];
            $types=2;
        }
        $data=array
            (
            'system_id'=>$row['sid'],
            'full_name'=>$row['fname'].''.$row['lname'],
            'full_name_kh'=>$row['fnamekhr'].''.$row['lnamekhr'],
            'username'=>$row['fname'].$row['lname'],
            'password'=>"skp@007",
            'email'=>$row['email'],
            'phone'=>$row['pnumber'],
            'branch_code'=>$row['brname'],
            'subbranch'=>$subbranch,
            'menu_option'=>$menu_option,
            'submenu_option'=>$submenu_option,
            'role'=>$row['useroption'],
            'role_id'=>1,
            'created_by'=>$this->session->userdata('full_name'),
            'types'=>$types,
            'created_date'=>date('Y-m-d'),
            'modified_date'=>date('Y-m-d'),
            'modified_by'=>$this->session->userdata('full_name')
            );
        $result=$this->db->insert('users',$data);
        if($result==true)
        {
            return true;
            
        }else
        {
            return false;
        }
        
    }

    //Get user detail
    public function getUser($page)
    {
        $result=$this->db->query("
                            select u.user_id,tb.brName,tb.brcode,s.staff_nameeng,u.username,s.position_nameeng from users u 
                            left join staff s on s.system_id=u.system_id
                            inner join tbl_branch tb on tb.brCode=s.brcode
                            where s.flag=1 and u.flag=1 and tb.flag=1 and s.active=1 order by tb.brcode limit 10 offset ".$page.""
                        );                        
                       
        return $result->result();
    }
    //Total user detail
    public function TotalUser(){
        $result=$this->db->query('
                            select count(*) as totalrow from users u 
                            left join staff s on s.system_id=u.system_id
                            inner join tbl_branch tb on tb.brCode=s.brcode
                            where s.flag=1 and u.flag=1 and tb.flag=1 and s.active=1'
                        );                        
                       
        foreach($result->result() as $row)
        {
            return $row->totalrow;
        }
    }

    //Get staff for add user
    public function getaddUser($page)
    {
        $result=$this->db->query("
                            select 
                            distinct(s.system_id+s.brcode) as id,
                            u.user_id,
                            s.system_id,
                            tb.brName,
                            tb.brcode,
                            s.staff_nameeng,
                            u.username,
                            s.position_nameeng 
                        from staff s
                        inner join tbl_branch tb on tb.brCode=s.brcode
                        left join users u on s.system_id=u.system_id and s.brcode=u.branch_code
                        where s.flag=1 and tb.flag=1 and s.active=1 
                        and u.username IS NULL                        
                        and s.position_nameeng not in('Branch Accountant','Deputy Branch Manager','General Credit Officer','Specialist Credit Officer',
                        'Branch Cleaner','Branch Guard','Branch Cashier','Branch Teller','Branch Manager')
                         order by tb.brcode limit 10 offset ".$page.""
                        );                        
                       
        return $result->result();
    }

    //Total user for add user
    public function TotaladdUser(){
        $result=$this->db->query("
                                select 
                               count(*) as totalrow
                            from staff s
                            inner join tbl_branch tb on tb.brCode=s.brcode
                            left join users u on s.system_id=u.system_id and s.brcode=u.branch_code
                            where s.flag=1 and tb.flag=1 and s.active=1 and u.username IS NULL 
                            and s.position_nameeng not in('Branch Accountant','Deputy Branch Manager','General Credit Officer','Specialist Credit Officer',
                            'Branch Cleaner','Branch Guard','Branch Cashier','Branch Teller','Branch Manager')
                           "
                            
                        );                        
                       
        foreach($result->result() as $row)
        {
            return $row->totalrow;
        }
    }

    public function getUserCompare()
    {

        $result=$this->db->query("select	
                        tb.BrName as BrName,
                        u.system_id as system_id,
                        u.full_name as full_name,
                        s.staff_nameeng as staff_name,
                        u.username as username,
                        u.keys,
                        u.email   
                    from users u 
                    inner join staff s on u.system_id=s.system_id
                    inner join tbl_branch tb on tb.brCode=s.brcode
                    where s.active=1;");
        return $result->result();
    }
    public function getUserdifstaffname()
    {

        $result=$this->db->query("select
                                tb.BrName as BrName,
                                u.system_id as system_id,
                                u.full_name as full_name,
                                s.staff_nameeng as staff_name,
                                u.username as username,
                                case
                                    when u.full_name<>s.staff_nameeng then 'Errors'
                                    else 'OK'
                                end as `status`
                            
                            from users u
                            inner join staff s on u.system_id=s.system_id
                            inner join tbl_branch tb on tb.brCode=s.brcode
                            where s.active=1 and s.position_nameeng in('Branch Manager')
                            and u.full_name<>s.staff_nameeng
                            order by u.full_name<>s.staff_nameeng desc;
    
                            ");
        return $result->result();
    }
    public function getStaffNotHaveInUser()
    {

        $result=$this->db->query("select
                                    tbl.shortcode,
                                    s.staff_nameeng,
                                    s.position_nameeng,
                                    s.staff_nameeng as username,
                                    s.system_id
                                from staff s
                                inner join tbl_branch tbl on s.brcode=tbl.brcode
                                where s.system_id not in(select system_id from users)
                                and s.brcode in('100','500')
                                and s.system_id not in('1','159')
                                and s.active=1
                                union all
                                select
                                    tbl.shortcode,
                                    s.staff_nameeng,
                                    s.position_nameeng,
                                    case 
                                            when s.position_nameeng='Branch Manager' then CONCAT('bm.',lower(tbl.shortcode))
                                            else s.staff_nameeng
                                    end as username,
                                    s.system_id
                                from staff s
                                inner join tbl_branch tbl on s.brcode=tbl.brcode
                                where s.system_id not in(select system_id from users)
                                and s.position_nameeng in('Branch Manager')
                                and s.active=1;");
        return $result->result();
    }
    public function getprofile($uid)
    {
        $result=$this->db->from('users')
                        ->where('flag',1)
                        ->where('user_id',$uid)
                        ->get();
        return $result->result();
    }
    public function getstaff($sid)
    {
        $result=$this->db->from('staff')
                        ->where('system_id',$sid)
                        ->where('flag',1)
                        ->get()->row();
        if($result==true)
        {
            return true;
        }else
        {
            return  false;    
        }
    }
    public function setprofile($userid,$sid)
    {
        $sidresult=$this->getstaff($sid);
        if($sidresult==true)
        {
            $row=$this->input->post();
            $data=array
                (
                    'system_id'=>$row['sid'],
                    'full_name'=>$row['fname'],
                    'full_name_kh'=>$row['fnamekhr'],
                    'password'=>$row['password'],
                    'email'=>$row['email'],
                    'phone'=>$row['pnumber']
                );
            $this->db->where('user_id',$userid);
            $this->db->update('users',$data);
            return true;
        }
        else
        {
            return false;
        }
        
    }
    public function getbysystem_id($sid)
    {
        $result=$this->db->query("select
                            tb.BrName as BrName,
                            tb.brcode as brcode,
                            u.system_id as system_id,
                            u.full_name as full_name,
                            s.staff_nameeng as staff_name,
                            u.username as username,
                            u.email as email,
                            s.position_nameeng as positionname
                        from users u
                        inner join staff s on u.system_id=s.system_id
                        inner join tbl_branch tb on tb.brCode=s.brcode
                        where u.system_id='".$sid."'");
        
        foreach($result->result() as $row)
        {
            return $row;
        }
    }
    public function getStaffNotHaveInUserbysystemid($sid,$brcode)
    {

        $result=$this->db->query("select
                                    tbl.shortcode,
                                    s.staff_nameeng,
                                    s.position_nameeng,
                                    s.staff_namekh as staff_namekh,
                                    s.staff_nameeng as username,
                                    s.phone_number as phone_number,
                                    tbl.brcode as brcode,
                                    s.system_id
                                from staff s
                                inner join tbl_branch tbl on s.brcode=tbl.brcode
                                where s.system_id not in(select system_id from users where users.branch_code=s.brcode)                                
                                
                                and s.active=1
                                and s.system_id='".$sid."'
                                and tbl.brcode='".$brcode."'
                                union all
                                select
                                    tbl.shortcode,
                                    s.staff_nameeng,
                                    s.position_nameeng,
                                    s.staff_namekh as staff_namekh,
                                    case 
                                            when s.position_nameeng='Branch Manager' then CONCAT('bm.',lower(tbl.shortcode))
                                            else s.staff_nameeng
                                    end as username,
                                    s.phone_number as phone_number,
                                    tbl.brcode as brcode,
                                    s.system_id
                                from staff s
                                inner join tbl_branch tbl on s.brcode=tbl.brcode
                                where s.system_id not in(select system_id from users)
                                and s.position_nameeng in('Branch Manager')
                                and s.system_id='".$sid."'
                                and tbl.brcode='".$brcode."'
                                and s.active=1;");
        
        foreach($result->result() as $row)
        {
            return $row;
        };
    }
    public function GetStaffControl($startdate,$enddate,$brcode,$statu,$limitrow)
    {
        if($brcode==0){
        $result=$this->db->query("select
                        tbl.brCode,
                        tbl.shortcode,
                        s.staff_nameeng,
                        s.staff_namekh,
                        s.dateemployee,
                        s.position_nameeng,
                        s.position_namekh,
                        s.tellerset
                    from staff s
                    inner join tbl_branch tbl on s.brcode=tbl.brCode
                    where s.dateemployee between '".$startdate."' and '".$enddate."'
                    and s.active='".$statu."' limit 10 offset ".$limitrow."
            ");
        return $result->result();
        //$this->output->enable_profiler(TRUE);
        }else
        {
        $result=$this->db->query("select
            tbl.brCode,
            tbl.shortcode,
            s.staff_nameeng,
            s.staff_namekh,
            s.dateemployee,
            s.position_nameeng,
            s.position_namekh
        from staff s
        inner join tbl_branch tbl on s.brcode=tbl.brCode
        where s.dateemployee between '".$startdate."' and '".$enddate."'
        and s.active='".$statu."' and tbl.brCode=".$brcode." limit 10 offset ".$limitrow." 
");
return $result->result();

        }
    }
    public function TotalNumberStaff($startdate,$enddate,$brcode,$statu)
    {
                $result=$this->db->query("select
                count(*) as total
                from staff s
                inner join tbl_branch tbl on s.brcode=tbl.brCode
                where s.dateemployee between '".$startdate."' and '".$enddate."'
                and s.active=".$statu."
        ");
       
        if($result->num_rows()>0)
        {
            foreach($result->result() as $row)
            {
                return $row->total;
            }
        }
        return 0;
        
    }
}

?>
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();  
    }
    public function GetReportsLeaves($startdate,$enddate,$sid,$company_id,$brcode,$role,$limitrow,$userid)
    {
        /*
            1:role=>1 General User
            2:role=>2 Administrator
            3:role=>3 BM User
            4:role=>4 RM User
            5:role=>5 Head Off Department
            6:role=>5 DCEO
        */
        switch($role)
        {
            case 1:
                $result=$this->db->query("select * from leaves s
                inner join staff st on s.sid=st.system_id
                where s.sid='".$sid."' and s.brcode=st.brcode and st.company_id='".$company_id."' order by s.requestdate desc limit 10 offset ".$limitrow."");
                return $result->result();
            break;
            case 2:

            break;
            case 3:
                        $result=$this->db->query("select * from leaves s
                        inner join staff st on s.sid=st.system_id
                        where st.brcode='".$brcode."' and s.brcode=st.brcode  and st.company_id=".$company_id." order by s.requestdate desc limit 10 offset ".$limitrow."");
                        return $result->result();
            break;
            case 4:
                        $result=$this->db->query("select * from leaves s
                        inner join staff st on s.sid=st.system_id
                        where s.employee='".$userid."'and s.brcode=st.brcode  and st.company_id=".$company_id."  order by s.requestdate desc limit 10 offset ".$limitrow."");
                        return $result->result();
            break;
            case 5:
                        $result=$this->db->query("select * from leaves s
                        inner join staff st on s.sid=st.system_id
                        where s.sid='".$sid."' and s.brcode=st.brcode and st.company_id=".$company_id." order by s.requestdate desc limit 10 offset ".$limitrow."");
                        return $result->result();

            break;
            case 6:
                        $result=$this->db->query("select * from leaves s
                        inner join staff st on s.sid=st.system_id
                        where s.sid='".$sid."' and s.brcode=st.brcode and st.company_id=".$company_id." order by s.requestdate desc limit 10 offset ".$limitrow."");
                        return $result->result();
            break;

        }
        

    }
    /*   View Leaves Report detail by recorde */

    public function GetReportsLeavesDetail($startdate,$enddate,$lid,$role)
    {
        /*
            1:role=>1 General User
            2:role=>2 Administrator
            3:role=>3 BM User
            4:role=>4 RM User
            5:role=>5 Head Off Department
            6:role=>5 DCEO
        */
        switch($role)
        {
            case 1:
                $result=$this->db->query("select * from leaves s
                                         inner join staff st on s.sid=st.system_id
                                         left join types t on t.id=s.type
                                         where s.lid='".$lid."' and s.startdate='".$startdate."' and s.enddate='".$enddate."'");
                return $result->result();

            break;
            case 2:

            break;
            case 3:
                    
                    $result=$this->db->query("select * from leaves s
                    inner join staff st on s.sid=st.system_id
                    left join types t on t.id=s.type
                    where s.lid='".$lid."' and s.startdate='".$startdate."' and s.enddate='".$enddate."'");
                    return $result->result();
            break;
            case 4:
                    $result=$this->db->query("select * from leaves s
                    inner join staff st on s.sid=st.system_id
                    left join types t on t.id=s.type
                    where s.lid='".$lid."' and s.startdate='".$startdate."' and s.enddate='".$enddate."'");
                    return $result->result();
            break;
            case 5:
                    $result=$this->db->query("select * from leaves s
                    inner join staff st on s.sid=st.system_id
                    left join types t on t.id=s.type
                    where s.lid='".$lid."' and s.startdate='".$startdate."' and s.enddate='".$enddate."'");
                    return $result->result();
            break;
            case 6:
                    $result=$this->db->query("select * from leaves s
                    inner join staff st on s.sid=st.system_id
                    left join types t on t.id=s.type
                    where s.lid='".$lid."' and s.startdate='".$startdate."' and s.enddate='".$enddate."'");
                    return $result->result();
            break;

        }
        

    }
    /*      submit by date for get leaves reprots detail  */
    public function GetReportsLeavesbydate($startdate,$enddate,$sid,$company_id,$brcode,$role,$limitrow,$userid)
    {
        /*
            1:role=>1 General User
            2:role=>2 Administrator
            3:role=>3 BM User
            4:role=>4 RM User
            5:role=>5 Head Off Department
            6:role=>5 DCEO
        */
        switch($role)
        {
            case 1:
                $result=$this->db->query("select * from leaves s
                inner join staff st on s.sid=st.system_id
                where s.sid='".$sid."' and s.startdate between '".$startdate."' and '".$enddate."'
                and s.enddate between '".$startdate."'and '".$enddate."' and st.company_id=".$company_id."
                order by s.requestdate desc limit 10 offset ".$limitrow." ");
               
                //$this->output->enable_profiler(TRUE);
                return $result->result();
            break;
            case 2:

            break;
            case 3:
                        switch($brcode){

                            case '501':

                                $brcontroler='501,107,102';

                            break;
                            case '502':
                                $brcontroler='502,151';
                            break;
                            case '503':
                                $brcontroler='503,149';
                            break;
                            case '504':
                                $brcontroler='504,147';
                            break;
                            case '505':
                                $brcontroler='505,148';
                            break;
                            case '506':
                                $brcontroler='506,152';
                            break;
                            case '507':
                                $brcontroler='507,153';
                            break;
                            case '508':
                                $brcontroler='508,154';
                            break;
                            case '509':
                                $brcontroler='509,155';
                            break;
                            case '510':
                                $brcontroler='510,130';
                            break;


                        }
                        $result=$this->db->query("select * from leaves s
                        inner join staff st on s.sid=st.system_id
                        where st.brcode in(".$brcontroler.") and s.startdate between '".$startdate."' and '".$enddate."'
                        and s.enddate between '".$startdate."'and '".$enddate."' and st.company_id=".$company_id."
                        order by s.requestdate desc limit 10 offset ".$limitrow."");
                    
                        //$this->output->enable_profiler(TRUE);
                        return $result->result();
            break;
            case 4:
                        $result=$this->db->query("select * from leaves s
                        inner join staff st on s.sid=st.system_id
                        where s.employee='".$userid."' and s.startdate between '".$startdate."' and '".$enddate."'
                        and s.enddate between '".$startdate."'and '".$enddate."' and st.company_id=".$company_id."
                        order by s.requestdate desc limit 10 offset ".$limitrow."");
                    
                        //$this->output->enable_profiler(TRUE);
                        return $result->result();
            break;
            case 5:
                    $result=$this->db->query("select * from leaves s
                    inner join staff st on s.sid=st.system_id
                    where s.sid='".$sid."' and s.startdate between '".$startdate."' and '".$enddate."'
                    and s.enddate between '".$startdate."'and '".$enddate."'
                    and st.company_id=".$company_id."
                    order by s.requestdate desc limit 10 offset ".$limitrow."");
                
                    //$this->output->enable_profiler(TRUE);
                    return $result->result();
            break;
            case 6:

            break;

        }
        

    }
    /* Get leaves balance by staff */ 
    public function GetLeavesBalance($brcode,$role,$sid,$company_id,$subcode,$limitrow)
    {
        /*
            1:role=>1 General User
            2:role=>2 Administrator
            3:role=>3 BM User
            4:role=>4 RM User
            5:role=>5 Head Off Department
            6:role=>5 DCEO
        */
        switch($role)
        {
            case 1:
                $year=date('Y');
                $result=$this->db->query("
                                    SELECT 
                                            st.staff_nameeng,
                                            st.sex,
                                            st.position_nameeng,
                                            st.system_id,
                                            ".$this->GetMaxLeaveBalance(1)." as Unpaid,
                                            ".$this->GetMaxLeaveBalance(2)." as Maternity,
                                            ".$this->GetMaxLeaveBalance(3)." as Special,
                                            ".$this->GetMaxLeaveBalance(4)." as Sick,
                                            ".$this->GetMaxLeaveBalance(5)." as Annual                                                                                    
                                           
                                            
                                        FROM 
                                        staff st
                                        WHERE st.system_id=".$sid."
                                        AND st.flag=1
                                        AND st.active=1
                                        and st.company_id=".$company_id."
                                        limit 10 offset ".$limitrow.";
                                        ");
               
                //$this->output->enable_profiler(TRUE);
                return $result->result();
            break;
            case 2:

            break;
            case 3:
                $year=date('Y');
                $result=$this->db->query("
                                    SELECT 
                                            st.staff_nameeng,
                                            st.sex,
                                            st.position_nameeng,
                                            st.system_id,
                                            ".$this->GetMaxLeaveBalance(1)." as Unpaid,
                                            ".$this->GetMaxLeaveBalance(2)." as Maternity,
                                            ".$this->GetMaxLeaveBalance(3)." as Special,
                                            ".$this->GetMaxLeaveBalance(4)." as Sick,
                                            ".$this->GetMaxLeaveBalance(5)." as Annual
                                                                                    
                                        
                                        FROM 
                                        staff st
                                        WHERE st.brcode in('".$brcode."','".$subcode."')
                                        AND st.flag=1
                                        AND st.active=1
                                        and st.company_id=".$company_id."
                                        limit 10 offset ".$limitrow.";
                                        ");
                //echo $result->result();
                //$this->output->enable_profiler(TRUE);
                return $result->result();
            break;
            case 4:
                $year=date('Y');
                $result=$this->db->query("
                                    SELECT 
                                            st.staff_nameeng,
                                            st.sex,
                                            st.position_nameeng,
                                            st.system_id,
                                            ".$this->GetMaxLeaveBalance(1)." as Unpaid,
                                            ".$this->GetMaxLeaveBalance(2)." as Maternity,
                                            ".$this->GetMaxLeaveBalance(3)." as Special,
                                            ".$this->GetMaxLeaveBalance(4)." as Sick,
                                            ".$this->GetMaxLeaveBalance(5)." as Annual
                                                                                
                                        FROM 
                                        staff st
                                        WHERE st.rm_id=".$this->getMyrmID($sid)."
                                        AND st.flag=1
                                        AND st.active=1
                                        and st.company_id=".$company_id."
                                        limit 10 offset ".$limitrow.";
                                        ");
                //echo $result->result();
                //$this->output->enable_profiler(TRUE);
                return $result->result();
            break;
            case 5:
            $year=date('Y');
            $result=$this->db->query("
                                SELECT 
                                        st.staff_nameeng,
                                        st.sex,
                                        st.position_nameeng,
                                        st.system_id,
                                        ".$this->GetMaxLeaveBalance(1)." as Unpaid,
                                        ".$this->GetMaxLeaveBalance(2)." as Maternity,
                                        ".$this->GetMaxLeaveBalance(3)." as Special,
                                        ".$this->GetMaxLeaveBalance(4)." as Sick,
                                        ".$this->GetMaxLeaveBalance(5)." as Annual,
                                        ".$this->GetDuraionLeaves($sid,1,$year)." as useingUnpaid,
                                        ".$this->GetDuraionLeaves($sid,2,$year)." as useingMaternity,           
                                        ".$this->GetDuraionLeaves($sid,3,$year)." as useingspecial,
                                        ".$this->GetDuraionLeaves($sid,4,$year)." as useingSick,
                                        ".$this->GetDuraionLeaves($sid,5,$year)." as useingAnnual                                           
                                       
                                        
                                    FROM 
                                    staff st
                                    WHERE st.system_id=".$sid."
                                    AND st.flag=1
                                    and st.company_id=".$company_id."
                                    AND st.active=1
                                    limit 10 offset ".$limitrow.";
                                    ");
           
            //$this->output->enable_profiler(TRUE);
            return $result->result();
            break;
            case 6:
            $year=date('Y');
            $result=$this->db->query("
                                SELECT 
                                        st.staff_nameeng,
                                        st.sex,
                                        st.position_nameeng,
                                        st.system_id,
                                        ".$this->GetMaxLeaveBalance(1)." as Unpaid,
                                        ".$this->GetMaxLeaveBalance(2)." as Maternity,
                                        ".$this->GetMaxLeaveBalance(3)." as Special,
                                        ".$this->GetMaxLeaveBalance(4)." as Sick,
                                        ".$this->GetMaxLeaveBalance(5)." as Annual                                                                                
                                       
                                    FROM 
                                    staff st
                                    WHERE st.system_id=".$sid."
                                    AND st.flag=1
                                    and st.company_id=".$company_id."
                                    AND st.active=1
                                    limit 10 offset ".$limitrow.";
                                    ");
           
            //$this->output->enable_profiler(TRUE);
            return $result->result();
            break;

        }
        

    }
 /* total leaves balance by staff */ 
 public function TotalLeavesBalance($sid,$company_id,$role,$brcode,$subcode,$userid)
 {
     /*
         1:role=>1 General User
         2:role=>2 Administrator
         3:role=>3 BM User
         4:role=>4 RM User
         5:role=>5 Head Off Department
         6:role=>5 DCEO
     */
     switch($role)
     {
         case 1:
             $year=date('Y');
             $result=$this->db->query("
                                 SELECT 
                                         count(*) as totalrow                                                                                   
                                        
                                         
                                     FROM 
                                     staff st
                                     WHERE st.system_id=".$sid."
                                     AND st.flag=1
                                     and st.company_id=".$company_id."
                                     AND st.active=1;
                                     ");
            
             //$this->output->enable_profiler(TRUE);
             foreach($result->result() as $row)
             {
                return $row->totalrow;
             };
         break;
         case 2:

         break;
         case 3:
             $year=date('Y');
             $result=$this->db->query("
                                 SELECT 
                                        count(*) as totalrow
                                     FROM 
                                     staff st
                                     WHERE st.brcode in('".$brcode."','".$subcode."')
                                     AND st.flag=1
                                     and st.company_id=".$company_id."
                                     AND st.active=1;
                                     ");
             //echo $result->result();
             //$this->output->enable_profiler(TRUE);
             foreach($result->result() as $row)
             {
                return $row->totalrow;
             };
         break;
         case 4:
             $year=date('Y');
             $result=$this->db->query("
                                 SELECT 
                                        count(*) as totalrow                     
                                     FROM 
                                     staff st
                                     WHERE st.rm_id=".$this->getMyrmID($sid)."
                                     AND st.flag=1
                                     and st.company_id=".$company_id."
                                     AND st.active=1;
                                     ");
             //echo $result->result();
             //$this->output->enable_profiler(TRUE);
             foreach($result->result() as $row)
             {
                return $row->totalrow;
             };
         break;
         case 5:
         $year=date('Y');
         $result=$this->db->query("
                             SELECT 
                                     count(*) as totalrow                                           
                                    
                                     
                                 FROM 
                                 staff st
                                 WHERE st.system_id=".$sid."
                                 AND st.flag=1
                                 and st.company_id=".$company_id."
                                 AND st.active=1;
                                 ");
        
         //$this->output->enable_profiler(TRUE);
         foreach($result->result() as $row)
         {
            return $row->totalrow;
         };
         break;
         case 6:
         $year=date('Y');
         $result=$this->db->query("
                             SELECT 
                                    count(*) as totalrow
                                 FROM 
                                 staff st
                                 WHERE st.system_id=".$sid."
                                 AND st.flag=1
                                 and st.company_id=".$company_id."
                                 AND st.active=1;
                                 ");
        
         //$this->output->enable_profiler(TRUE);
         foreach($result->result() as $row)
         {
            return $row->totalrow;
         };
         break;

     }
     

 }

    /*---------------Get approvd Leaves-----------*/
     /*      submit by date for get leaves reprots detail  */
     public function GetApporvedLeaves($startdate,$enddate,$sid,$company_id,$brcode,$role,$limitrow)
     {
         /*
             1:role=>1 General User
             2:role=>2 Administrator
             3:role=>3 BM User
             4:role=>4 RM User
             5:role=>5 Head Off Department
             6:role=>5 DCEO
         */
         switch($role)
         {
             case 1:
                 $result=$this->db->query("select * from leaves s
                 inner join staff st on s.sid=st.system_id
                 where s.sid='".$sid."' and s.startdate between '".$startdate."' and '".$enddate."'
                 and s.enddate between '".$startdate."'and '".$enddate."'
                 and le.brcode=st.brcode
                 and st.company_id=".$company_id."
                 order by s.requestdate desc limit 10 offset ".$limitrow."");
                
                 //$this->output->enable_profiler(TRUE);
                 return $result->result();
             break;
             case 2:
 
             break;
             case 3:
 
             break;
             case 4:
                        $result=$this->db->query("
                        SELECT * FROM `leaves` le INNER JOIN staff st ON st.system_id=le.sid 
                        INNER JOIN `types` ty ON ty.id=le.type 
                        INNER JOIN tbl_branch btl ON btl.brCode=st.brcode
                        WHERE st.rm_id=".$this->getMyrmID($sid)." AND le.status=1 
                        AND le.sid!=".$sid." AND st.flag=1
                        
                        and st.position_nameeng not in('Branch Manager') 
                        and le.brcode=st.brcode
                        and st.company_id=".$company_id."
                        order by le.requestdate desc limit 10 offset ".$limitrow."
                        ");
                
                    //$this->output->enable_profiler(TRUE);
                    return $result->result();
             break;
             case 5:
                     $result=$this->db->query("
                        SELECT * FROM `leaves` le INNER JOIN staff st ON st.system_id=le.sid 
                        INNER JOIN `types` ty ON ty.id=le.type 
                        INNER JOIN tbl_branch btl 
                        ON btl.brCode=st.brcode
                        WHERE st.hid='".$this->GetStaffheadofID($sid,$company_id)."' AND le.status=1 
                        and le.brcode=st.brcode
                        and st.company_id=".$company_id."
                        AND le.sid!=".$sid." AND st.flag=1 order by le.requestdate desc limit 10 offset ".$limitrow."
                        ");
                 
                     //$this->output->enable_profiler(TRUE);
                     return $result->result();
             break;
             case 6:
                        $result=$this->db->query("
                        SELECT * FROM `leaves` le INNER JOIN staff st ON st.system_id=le.sid 
                        INNER JOIN `types` ty ON ty.id=le.type 
                        INNER JOIN tbl_branch btl ON btl.brCode=st.brcode
                        WHERE st.hid=".$this->getRmtoDCEO($sid)." AND le.status=1 
                        and le.brcode=st.brcode
                        and st.company_id=".$company_id."
                        AND le.sid!=".$sid." AND st.flag=1 order by le.requestdate desc limit 10 offset ".$limitrow.";
                        ");
                
                    //$this->output->enable_profiler(TRUE);
                    return $result->result();
             break;
 
         }
         
 
     }
     /*--------------Get Hid----------*/
     public function GetheadofID($sid,$role,$company_id)
     {
         if($role=1)
         {
            $result=$this->db->query("select hid FROM staff WHERE system_id=".$sid." and company_id=".$company_id." ");
            foreach($result->result() as $row)
            {
                return $row->hid;
            }
         }else{
         $result=$this->db->query("select m_id FROM manager WHERE sid=".$sid." and company_id=".$company_id." ");
            foreach($result->result() as $row)
            {
                return $row->m_id;
            }
        }
     }
     public function GetStaffheadofID($sid,$company_id)
     {
         $result=$this->db->query("select m_id FROM manager WHERE sid=".$sid." and company_id=".$company_id."");
         foreach($result->result() as $row)
         {
             return $row->m_id;
         }
     }
     /*---------Get to not approvel---*/
     public function Totalnumrownotapprove($sid,$role,$brcode,$company_id)
     {
         $hid=$this->GetheadofID($sid,$role,$company_id);
         $rm_id=$this->getRmtoDCEO($sid);
         switch($role)
         {
             case 1:
             $res=$this->db->query("
                            SELECT count(*) as totalrow FROM `leaves` le INNER JOIN staff st ON st.system_id=le.sid 
                            INNER JOIN `types` ty ON ty.id=le.type 
                            INNER JOIN tbl_branch btl ON btl.brCode=st.brcode
                            WHERE st.hid='".$hid."' AND le.status=1 
                             and le.brcode=st.brcode
                             and st.company_id=".$company_id."
                            AND le.sid!=".$sid." AND st.flag=1");
                foreach($res->result() as $row)
                {
                    return $row->totalrow;
                }
             break;
             case 2:
             break;
             case 3:
             $year=date('Y');
            
             $result=$this->db->query("                                    
                                     SELECT 
                                        count(*) as totalrow
                                     FROM `leaves` le
                                     INNER JOIN staff st ON le.sid=st.system_id
                                     INNER JOIN `types` ty ON ty.id=le.type
                                     INNER JOIN manager r ON r.m_id=".$rm_id."
                                     WHERE 
                                     le.status=2
                                     and le.brcode=st.brcode
                                     and st.company_id=".$company_id."
                                     AND st.flag=1 AND st.active=1
                                     and st.brcode=".$brcode."
                                     ;                                    
                                     
                                     ");
            
             //$this->output->enable_profiler(TRUE);
             foreach($resultres->result() as $row)
                {
                    return $row->totalrow;
                }
             break;
             case 4:
                        $year=date('Y');
                        $result=$this->db->query("                                    
                                                SELECT 
                                                    count(*) as totalrow
                                                FROM `leaves` le
                                                INNER JOIN staff st ON le.sid=st.system_id
                                                INNER JOIN `types` ty ON ty.id=le.type
                                                INNER JOIN manager r ON r.m_id=".$rm_id."
                                                WHERE 
                                                le.status=1
                                                and le.brcode=st.brcode
                                                AND st.flag=1 AND st.active=1
                                                and st.company_id=".$company_id."
                                                and st.position_nameeng not in('Branch Manager')
                                                and st.rm_id=".$this->getMyrmID($sid)."
                                                ;");
                        
                        //$this->output->enable_profiler(TRUE);
                        foreach($result->result() as $row)
                            {
                                return $row->totalrow;
                            }
             break;
             case 5:
                        
                        $result=$this->db->query("
                        SELECT count(*) as totalrow FROM `leaves` le INNER JOIN staff st ON st.system_id=le.sid 
                        INNER JOIN `types` ty ON ty.id=le.type 
                        INNER JOIN tbl_branch btl ON btl.brCode=st.brcode
                        WHERE st.hid='".$hid."' AND le.status=1 
                         and le.brcode=st.brcode
                         and st.company_id=".$company_id."
                         AND le.sid!=".$sid." AND st.flag=1;
                        ");
                        foreach($result->result() as $row)
                            {
                                return $row->totalrow;
                            }
             break;
             case 6:
                      
                        $result=$this->db->query("                                    
                                                SELECT 
                                                    count(*) as totalrow
                                                FROM `leaves` le
                                                INNER JOIN staff st ON le.sid=st.system_id
                                                INNER JOIN `types` ty ON ty.id=le.type
                                                INNER JOIN manager r ON r.m_id=".$rm_id."
                                                WHERE 
                                                le.status=1
                                                and le.brcode=st.brcode
                                                AND st.flag=1 AND st.active=1    
                                                and st.company_id=".$company_id."                                            
                                                and st.hid=".$rm_id."
                                                and le.sid!=".$sid."
                                                ;");
                        
                        //$this->output->enable_profiler(TRUE);
                        foreach($result->result() as $row)
                            {
                                return $row->totalrow;
                            }
             break;

         }
         
     }
    /*-----------Get Totalnumrow---*/
    public function Totalnumrow($sid,$company_id,$role,$brcode,$userid)
    {
        switch($role)
        {
            case 1:
                $res=$this->db->query("select count(*) as totalrow from leaves where sid='".$sid."' and brcode='".$brcode."'");
                foreach($res->result() as $row)
                {
                    return $row->totalrow;
                }
            break;
            case 2:
            break;
            case 3:
                    $res=$this->db->query("
                    select count(*) as totalrow from leaves s
                    inner join staff st on s.sid=st.system_id
                    where st.brcode=".$brcode." and st.company_id='".$company_id."' ");
                    foreach($res->result() as $row)
                    {
                        return $row->totalrow;
                    }
            break;
            case 4:
                        $res=$this->db->query("
                        select count(*) as totalrow from leaves s
                        inner join staff st on s.sid=st.system_id
                        where s.employee=".$userid." and st.company_id='".$company_id."'");
                        foreach($res->result() as $row)
                        {
                            return $row->totalrow;
                        }
            break;
            case 5:
                    $res=$this->db->query("select count(*) as totalrow from leaves where sid='".$sid."' and brcode='".$brcode."'");
                    foreach($res->result() as $row)
                    {
                        return $row->totalrow;
                    }
            break;
            case 6:
                    $res=$this->db->query("select count(*) as totalrow from leaves where sid='".$sid."' and brcode='".$brcode."'");
                    foreach($res->result() as $row)
                    {
                        return $row->totalrow;
                    }
            break;
        }
        
    }
    public function Totalnumrowbydate($sid,$company_id,$startdate,$enddate,$role,$brcode,$userid)
    {
        switch($role)
        {
            case 1:
                    $res=$this->db->query("select count(*) as totalrow from leaves where sid='".$sid."' and brcode='".$brcode."'
                    and startdate between '".$startdate."' and '".$enddate."'
                    and enddate between '".$startdate."'and '".$enddate."'");
                    foreach($res->result() as $row)
                    {
                        return $row->totalrow;
                    }
            break;
            case 2:
            break;
            case 3:
                    $result=$this->db->query("select count(*) as totalrow from leaves s
                    inner join staff st on s.sid=st.system_id
                    where st.brcode='".$brcode."' and s.startdate between '".$startdate."' and '".$enddate."'
                    and s.enddate between '".$startdate."'and '".$enddate."' and st.company_id='".$company_id."'
                    ");
                    foreach($result->result() as $row)
                    {
                        return $row->totalrow;
                    }
            break;
            case 4:
                    $result=$this->db->query("select count(*) as totalrow from leaves s
                    inner join staff st on s.sid=st.system_id
                    where s.employee='".$userid."' and s.startdate between '".$startdate."' and '".$enddate."'
                    and s.enddate between '".$startdate."'and '".$enddate."' and st.company_id='".$company_id."'
                    ");
                    foreach($result->result() as $row)
                    {
                        return $row->totalrow;
                    }
            break;
            case 5:
                    $res=$this->db->query("select count(*) as totalrow from leaves where sid='".$sid."'
                    and startdate between '".$startdate."' and '".$enddate."'
                    and enddate between '".$startdate."'and '".$enddate."' and brcode='".$brcode."'");
                    foreach($res->result() as $row)
                    {
                        return $row->totalrow;
                    }
            break;
            case 6:
            break;

        }
        
    
    }
    /*-----------Get MaxLeaveBalance-----------*/
    public function GetMaxLeaveBalance($id)
    {
        $result=$this->db->query("select MaxLeaveBalance FROM `types` WHERE id=".$id." AND flag=1");
        foreach($result->result() as $row)
        {
            return $row->MaxLeaveBalance;
        }
    }
    /*---------Get duration -------------*/

    public function GetDuraionLeaves($sid,$type,$year)
    {
        $false=0;
        $result=$this->db->query("select SUM(duration) as Total FROM `leaves` WHERE sid=".$sid." and left(startdate,4)='".$year."' AND `type`='".$type."' AND `status`=2");
        if($result->num_rows()>=0){
            foreach($result->result() as $row)
            {
                if($row->Total=="")
                {
                    return 0;
                }   
                else
                {
                    return $row->Total;
                }
            }
        
        }
        
    }
    /*-----------Get history approved--------------*/

    public function Gethistoryapproved($brcode,$role,$sid,$company_id,$subcode,$limitrow)
    {
        /*
            1:role=>1 General User
            2:role=>2 Administrator
            3:role=>3 BM User
            4:role=>4 RM User
            5:role=>5 Head Off Department
            6:role=>5 DCEO
        */
        $hid=$this->GetheadofID($sid,$role,$company_id);
        switch($role)
        {
            case 1:
                $year=date('Y');
                $result=$this->db->query("
                                       
                                        SELECT 
                                        st.system_id AS sid, 
                                            le.lid,
                                            st.staff_nameeng,
                                            st.position_nameeng,
                                            st.sex,
                                            le.requestdate,
                                            le.startdate,
                                            le.enddate,
                                            ty.name AS `name`,
                                            le.duration,
                                            le.approvaldate,
                                            r.m_name AS rmname
                                        FROM `leaves` le
                                        INNER JOIN staff st ON le.sid=st.system_id
                                        INNER JOIN `types` ty ON ty.id=le.type      
                                        INNER JOIN manager r on r.m_id=".$hid."                  
                                        WHERE le.sid=".$sid."
                                        AND le.status=2
                                        AND st.flag=1 AND st.active=1
                                        order by le.requestdate DESC
                                        limit 10 offset ".$limitrow.";
                                        ");
               
                //$this->output->enable_profiler(TRUE);
                return $result->result();
            break;
            case 2:

            break;
            case 3:
            $year=date('Y');
            $result=$this->db->query("                                    
                                    SELECT 
                                    st.system_id AS sid, 
                                        le.lid,
                                        st.staff_nameeng,
                                        st.position_nameeng,
                                        st.sex,
                                        le.requestdate,
                                        le.startdate,
                                        le.enddate,
                                        ty.name AS `name`,
                                        le.duration,
                                        le.approvaldate,
                                        r.name AS rmname
                                    FROM `leaves` le
                                    INNER JOIN staff st ON le.sid=st.system_id
                                    INNER JOIN `types` ty ON ty.id=le.type
                                    INNER JOIN rm r ON r.rid=".$this->getRm($sid)."
                                    WHERE 
                                    le.status=2
                                    AND st.flag=1 AND st.active=1
                                    and st.brcode=".$brcode."                               
                                    order by le.requestdate DESC limit 10 offset ".$limitrow.";                                    
                                    
                                    ");
           
            //$this->output->enable_profiler(TRUE);
            return $result->result();
            break;
            case 4:
                        $year=date('Y');
                        $result=$this->db->query("                                    
                                                SELECT 
                                                st.system_id AS sid, 
                                                    le.lid,
                                                    st.staff_nameeng,
                                                    st.position_nameeng,
                                                    st.sex,
                                                    le.requestdate,
                                                    le.startdate,
                                                    le.enddate,
                                                    ty.name AS `name`,
                                                    le.duration,
                                                    le.approvaldate,
                                                    r.name AS rmname
                                                FROM `leaves` le
                                                INNER JOIN staff st ON le.sid=st.system_id
                                                INNER JOIN `types` ty ON ty.id=le.type
                                                INNER JOIN rm r ON r.rid= st.rm_id
                                                WHERE 
                                                st.rm_id=".$this->getMyrmID($sid)."
                                                and le.status=2
                                                AND st.flag=1 AND st.active=1
                                                order by le.requestdate DESC limit 10 offset ".$limitrow.";                                    
                                                
                                                ");
                    
                        //$this->output->enable_profiler(TRUE);
                        return $result->result();
            break;
            case 5:
            $year=date('Y');
            $result=$this->db->query("                                    
                                    SELECT 
                                    st.system_id AS sid, 
                                        le.lid,
                                        st.staff_nameeng,
                                        st.position_nameeng,
                                        st.sex,
                                        le.requestdate,
                                        le.startdate,
                                        le.enddate,
                                        ty.name AS `name`,
                                        le.duration,
                                        le.approvaldate,
                                        r.m_name AS rmname
                                    FROM `leaves` le
                                    INNER JOIN staff st ON le.sid=st.system_id
                                    INNER JOIN `types` ty ON ty.id=le.type
                                    INNER JOIN manager r ON r.m_id=st.hid
                                    WHERE 
                                    le.approvedby=".$this->getUserid($sid)."
                                    and le.status=2
                                    AND st.flag=1 AND st.active=1
                                    order by le.requestdate DESC limit 10 offset ".$limitrow.";                                    
                                    
                                    ");
           
            //$this->output->enable_profiler(TRUE);
            return $result->result();
            break;
            case 6:
                    $year=date('Y');
                    $result=$this->db->query("                                    
                                            SELECT 
                                            st.system_id AS sid, 
                                                le.lid,
                                                st.staff_nameeng,
                                                st.position_nameeng,
                                                st.sex,
                                                le.requestdate,
                                                le.startdate,
                                                le.enddate,
                                                ty.name AS `name`,
                                                le.duration,
                                                le.approvaldate,
                                                r.m_name AS rmname
                                            FROM `leaves` le
                                            INNER JOIN staff st ON le.sid=st.system_id
                                            INNER JOIN `types` ty ON ty.id=le.type
                                            INNER JOIN manager r ON r.m_id=st.hid
                                            WHERE 
                                            le.approvedby=".$this->getUserid($sid)."
                                            and le.status=2
                                            AND st.flag=1 AND st.active=1
                                            order by le.requestdate limit 10 offset ".$limitrow.";                                    
                                            
                                            ");
                
                    //$this->output->enable_profiler(TRUE);
                    return $result->result();
            break;

        }
        

    }
/*-----------Get Rm to DCEO------------------*/
public function getRmtoDCEO($sid)
{
    $result=$this->db->query("select hid from staff where system_id=".$sid."");
    foreach($result->result() as $row)
    {
        return $row->hid;
    }
}
public function getMyrmID($sid)
{
    $result=$this->db->query("select rid from rm where sid=".$sid."");
    foreach($result->result() as $row)
    {
        return $row->rid;
    }
}
public function getRm($sid)
{
    $result=$this->db->query("select rm_id from staff where system_id=".$sid."");
    foreach($result->result() as $row)
    {
        return $row->rm_id;
    }
}

/*-----------Get history reject--------------*/

public function Gethistoryreject($brcode,$role,$sid,$subcode,$limitrow)
{
    /*
        1:role=>1 General User
        2:role=>2 Administrator
        3:role=>3 BM User
        4:role=>4 RM User
        5:role=>5 Head Off Department
        6:role=>5 DCEO
    */
    switch($role)
    {
        case 1:
            $year=date('Y');
            $result=$this->db->query("
                                    SELECT 
                                    st.system_id AS sid, 
                                        le.lid,
                                        st.staff_nameeng,
                                        st.position_nameeng,
                                        st.sex,
                                        le.requestdate,
                                        le.startdate,
                                        le.enddate,
                                        ty.name AS `name`,
                                        le.duration,
                                        le.approvaldate,
                                        r.m_name AS rmname
                                    FROM `leaves` le
                                    INNER JOIN staff st ON le.sid=st.system_id
                                    INNER JOIN `types` ty ON ty.id=le.type
                                    INNER JOIN manager r ON r.m_id=le.rejectby
                                    WHERE le.sid=".$sid."
                                    AND le.status=3
                                    AND st.flag=1 AND st.active=1
                                    union all
                                    SELECT 
                                    st.system_id AS sid, 
                                        le.lid,
                                        st.staff_nameeng,
                                        st.position_nameeng,
                                        st.sex,
                                        le.requestdate,
                                        le.startdate,
                                        le.enddate,
                                        ty.name AS `name`,
                                        le.duration,
                                        le.approvaldate,
                                        'Unknow' AS rmname
                                    FROM `leaves` le
                                    INNER JOIN staff st ON le.sid=st.system_id
                                    INNER JOIN `types` ty ON ty.id=le.type
                                    
                                    WHERE le.sid=".$sid."
                                    AND le.status=3
                                    AND st.flag=1 AND st.active=1
                                    limit 10 offset ".$limitrow.";
                                    ");
           
            //$this->output->enable_profiler(TRUE);
            return $result->result();
        break;
        case 2:

        break;
        case 3:
        $year=date('Y');
        $result=$this->db->query("
                                SELECT 
                                st.system_id AS sid, 
                                    le.lid,
                                    st.staff_nameeng,
                                    st.position_nameeng,
                                    st.sex,
                                    le.requestdate,
                                    le.startdate,
                                    le.enddate,
                                    ty.name AS `name`,
                                    le.duration,
                                    le.approvaldate,
                                    r.m_name AS rmname
                                FROM `leaves` le
                                INNER JOIN staff st ON le.sid=st.system_id
                                INNER JOIN `types` ty ON ty.id=le.type
                                INNER JOIN manager r ON r.m_id=".$this->getRmtoDCEO($sid)."
                                WHERE 
                                brcode=".$brcode." and le.status=3
                                AND st.flag=1 AND st.active=1
                                union all
                                SELECT 
                                st.system_id AS sid, 
                                    le.lid,
                                    st.staff_nameeng,
                                    st.position_nameeng,
                                    st.sex,
                                    le.requestdate,
                                    le.startdate,
                                    le.enddate,
                                    ty.name AS `name`,
                                    le.duration,
                                    le.approvaldate,
                                    'Unknow' AS rmname
                                FROM `leaves` le
                                INNER JOIN staff st ON le.sid=st.system_id
                                INNER JOIN `types` ty ON ty.id=le.type                                
                                WHERE 
                                le.sid=".$sid."
                                and le.status=3
                                AND st.flag=1 AND st.active=1
                                and brcode=".$brcode."
                                limit 10 offset ".$limitrow.";
                                ");
       
        //$this->output->enable_profiler(TRUE);
        return $result->result();
        break;
        case 4:
        $year=date('Y');
        $result=$this->db->query("
                                SELECT 
                                st.system_id AS sid, 
                                    le.lid,
                                    st.staff_nameeng,
                                    st.position_nameeng,
                                    st.sex,
                                    le.requestdate,
                                    le.startdate,
                                    le.enddate,
                                    ty.name AS `name`,
                                    le.duration,
                                    le.approvaldate,
                                    r.name AS rmname
                                FROM `leaves` le
                                INNER JOIN staff st ON le.sid=st.system_id
                                INNER JOIN `types` ty ON ty.id=le.type
                                INNER JOIN rm r ON r.rid=".$this->getRm($sid)."
                                WHERE 
                                le.status=3
                                and st.rm_id=".$this->getMyrmID($sid)."
                                AND st.flag=1 AND st.active=1
                                union all
                                SELECT 
                                st.system_id AS sid, 
                                    le.lid,
                                    st.staff_nameeng,
                                    st.position_nameeng,
                                    st.sex,
                                    le.requestdate,
                                    le.startdate,
                                    le.enddate,
                                    ty.name AS `name`,
                                    le.duration,
                                    le.approvaldate,
                                    (select full_name from users where user_id=".$this->getUserid($sid).") AS rmname
                                FROM `leaves` le
                                INNER JOIN staff st ON le.sid=st.system_id
                                INNER JOIN `types` ty ON ty.id=le.type                                
                                WHERE le.rejectby=".$this->getUserid($sid)."
                                AND le.status=3
                                AND st.flag=1 AND st.active=1
                                limit 10 offset ".$limitrow.";
                                ");
       
        //$this->output->enable_profiler(TRUE);
        return $result->result();

        break;
        case 5:
        $year=date('Y');
        $result=$this->db->query("
                                SELECT 
                                st.system_id AS sid, 
                                    le.lid,
                                    st.staff_nameeng,
                                    st.position_nameeng,
                                    st.sex,
                                    le.requestdate,
                                    le.startdate,
                                    le.enddate,
                                    ty.name AS `name`,
                                    le.duration,
                                    le.approvaldate,
                                    r.m_name AS rmname
                                FROM `leaves` le
                                INNER JOIN staff st ON le.sid=st.system_id
                                INNER JOIN `types` ty ON ty.id=le.type
                                INNER JOIN manager r ON r.m_id=le.rejectby
                                WHERE le.sid=".$sid."
                                AND le.status=3
                                AND st.flag=1 AND st.active=1
                                union all
                                SELECT 
                                st.system_id AS sid, 
                                    le.lid,
                                    st.staff_nameeng,
                                    st.position_nameeng,
                                    st.sex,
                                    le.requestdate,
                                    le.startdate,
                                    le.enddate,
                                    ty.name AS `name`,
                                    le.duration,
                                    le.approvaldate,
                                    'Unknow' AS rmname
                                FROM `leaves` le
                                INNER JOIN staff st ON le.sid=st.system_id
                                INNER JOIN `types` ty ON ty.id=le.type                                
                                WHERE le.rejectby=".$this->getUserid($sid)."
                                AND le.status=3
                                AND st.flag=1 AND st.active=1
                                limit 10 offset ".$limitrow.";
                                ");
       
        //$this->output->enable_profiler(TRUE);
        return $result->result();
        break;
        case 6:
        $year=date('Y');
        $result=$this->db->query("
                                SELECT 
                                st.system_id AS sid, 
                                    le.lid,
                                    st.staff_nameeng,
                                    st.position_nameeng,
                                    st.sex,
                                    le.requestdate,
                                    le.startdate,
                                    le.enddate,
                                    ty.name AS `name`,
                                    le.duration,
                                    le.approvaldate,
                                    r.m_name AS rmname
                                FROM `leaves` le
                                INNER JOIN staff st ON le.sid=st.system_id
                                INNER JOIN `types` ty ON ty.id=le.type
                                INNER JOIN manager r ON r.m_id=le.rejectby
                                WHERE le.sid=".$sid."
                                AND le.status=3
                                AND st.flag=1 AND st.active=1
                                union all
                                SELECT 
                                st.system_id AS sid, 
                                    le.lid,
                                    st.staff_nameeng,
                                    st.position_nameeng,
                                    st.sex,
                                    le.requestdate,
                                    le.startdate,
                                    le.enddate,
                                    ty.name AS `name`,
                                    le.duration,
                                    le.approvaldate,
                                    'Unknow' AS rmname
                                FROM `leaves` le
                                INNER JOIN staff st ON le.sid=st.system_id
                                INNER JOIN `types` ty ON ty.id=le.type                                
                                WHERE le.rejectby=".$this->getUserid($sid)."
                                AND le.status=3
                                AND st.flag=1 AND st.active=1
                                limit 10 offset ".$limitrow.";
                                ");
       
        //$this->output->enable_profiler(TRUE);
        return $result->result();
        break;

    }
    

    }
    /*  totalroleleaveshistory--*/

    public function totaleleaveshistory($sid,$role,$brcode)
    {
        switch($role)
        {
                case 1:
                        $result=$this->db->query("
                        SELECT 
                        count(*) as totalrow
                        FROM `leaves` le
                        WHERE le.sid=".$sid."
                        AND le.status=2;
                    ");
                    foreach($result->result() as $row)
                    {
                        return $row->totalrow;
                    }
                break;
                case 3:
                $year=date('Y');
                $result=$this->db->query("                                    
                                        SELECT 
                                           count(*) as totalrow
                                        FROM `leaves` le
                                        INNER JOIN staff st ON le.sid=st.system_id
                                        INNER JOIN `types` ty ON ty.id=le.type
                                        INNER JOIN rm r ON r.rid=".$this->getRm($sid)."
                                        WHERE 
                                        le.status=2
                                        AND st.flag=1 AND st.active=1
                                        and st.brcode=".$brcode."
                                        ;                                    
                                        
                                        ");
               
                //$this->output->enable_profiler(TRUE);
                foreach($result->result() as $row)
                   {
                       return $row->totalrow;
                   }

                break;
                case 4:
                    $result=$this->db->query("
                                    SELECT 
                                    count(*) as totalrow
                                    FROM `leaves` le
                                    INNER JOIN staff st ON le.sid=st.system_id
                                    INNER JOIN `types` ty ON ty.id=le.type
                                    INNER JOIN rm r ON r.rid=st.rm_id
                                    WHERE 
                                    st.rm_id=".$this->getMyrmID($sid)."
                                    and le.status=2
                                    AND st.flag=1 AND st.active=1;
                                    ");  

                    foreach($result->result() as $res)
                    {                         

                        return $res->totalrow;

                    }
                break;
                case 5:
                    $result=$this->db->query("
                                    SELECT 
                                    count(*) as totalrow
                                    FROM `leaves` le
                                    INNER JOIN staff st ON le.sid=st.system_id
                                    INNER JOIN `types` ty ON ty.id=le.type
                                    INNER JOIN manager r ON r.m_id=st.hid
                                    WHERE 
                                    le.approvedby=".$this->getUserid($sid)."
                                    and le.status=2
                                    AND st.flag=1 AND st.active=1;
                                    ");  
                   
                foreach($result->result() as $res)
                 {                         
                   
                        return $res->totalrow;
                    
                }
                break;
                case 6:
                    $result=$this->db->query("
                    SELECT 
                    count(*) as totalrow
                    FROM `leaves` le
                    INNER JOIN staff st ON le.sid=st.system_id
                    INNER JOIN `types` ty ON ty.id=le.type
                    INNER JOIN manager r ON r.m_id=st.hid
                    WHERE 
                    le.approvedby=".$this->getUserid($sid)."
                    and le.status=2
                    AND st.flag=1 AND st.active=1;
                    ");  

                        foreach($result->result() as $res)
                        {                         

                            return $res->totalrow;

                        }
                break;


        }
       
        //$this->output->enable_profiler(TRUE);
       
    }
    public function totaleleavesrejecet($sid,$role,$brcode)
    {
        switch($role)
        {
            case 1:
                    $result=$this->db->query("
                    SELECT 
                    count(*) as totalrow
                    FROM `leaves` le
                    WHERE le.sid=".$sid."
                    AND le.status=3;
                ");
                foreach($result->result() as $row)
                {
                    return $row->totalrow;
                }
            break;
            case 3:
            $result=$this->db->query("
                                SELECT 
                                count(*) as totalrow
                                FROM `leaves` le
                                INNER JOIN staff st ON le.sid=st.system_id
                                INNER JOIN `types` ty ON ty.id=le.type
                                INNER JOIN manager r ON r.m_id=".$this->getRmtoDCEO($sid)."
                                WHERE 
                                st.brcode=".$brcode."
                                and le.status=3
                                AND st.flag=1 AND st.active=1;
                                ");  

                            foreach($result->result() as $res)
                            {                         

                            return $res->totalrow;

                            }
            break;
            case 4:
                                $result=$this->db->query("
                                SELECT 
                                count(*) as totalrow
                                FROM `leaves` le
                                INNER JOIN staff st ON le.sid=st.system_id
                                INNER JOIN `types` ty ON ty.id=le.type
                                INNER JOIN rm r ON r.rid=".$this->getMyrmID($sid)."
                                WHERE 
                                le.rejectby=".$this->getUserid($sid)."
                                and le.status=3
                                AND st.flag=1 AND st.active=1;
                                ");  

                    foreach($result->result() as $res)
                    {                         

                    return $res->totalrow;

                    }

            break;
            case 5:
                    $result=$this->db->query("
                                    SELECT 
                                    count(*) as totalrow
                                    FROM `leaves` le
                                    INNER JOIN staff st ON le.sid=st.system_id
                                    INNER JOIN `types` ty ON ty.id=le.type
                                    INNER JOIN manager r ON r.m_id=st.hid
                                    WHERE 
                                    le.rejectby=".$this->getUserid($sid)."
                                    and le.status=3
                                    AND st.flag=1 AND st.active=1;
                                    ");  
                   
                foreach($result->result() as $res)
                 {                         
                   
                        return $res->totalrow;
                    
                }
                break;
                case 6:
                                $result=$this->db->query("
                                SELECT 
                                count(*) as totalrow
                                FROM `leaves` le
                                INNER JOIN staff st ON le.sid=st.system_id
                                INNER JOIN `types` ty ON ty.id=le.type
                                INNER JOIN manager r ON r.m_id=st.hid
                                WHERE 
                                le.rejectby=".$this->getUserid($sid)."
                                and le.status=3
                                AND st.flag=1 AND st.active=1;
                                ");  

                foreach($result->result() as $res)
                {                         

                    return $res->totalrow;

                }
                break;
           
        }
        
        //$this->output->enable_profiler(TRUE);
       
    }



    /*---------------------Get View leaved for detail--------------------*/

    public function getviewleavedetail($sid,$lid,$start,$end)
    {
        $result=$this->db->query("select
                                requestdate,
                                startdate,
                                enddate,
                                employee,
                                `status`,
                                cause,
                                startdatetype,
                                enddatetype,
                                duration,
                                `name`,
                                '".$this->getattachname($sid,$lid)."' as imgs,
                                lid
                            FROM `leaves` le 
                            INNER JOIN `types` ty ON ty.id=le.type
                            WHERE le.sid=".$sid."
                            and le.startdate between '".$start."' and '".$end."' 
                            and le.enddate between '".$start."' and '".$end."';");
        return $result->result();
    }
    /*---------------------Get Images-------------------*/

    public function getattachname($sid,$lids)
    {
        $result=$this->db->query("select attachname FROM attach WHERE lid='".$lids."'
            AND SID=".$sid."");
            
        foreach($result->result() as $row)
        {
            if($row->attachname=="")
            {
                return 'a.png';
            }
            return $row->attachname;
          
       
        }
           
        return 'a.png';
        
        
        
    }


    public function getUserid($sid)
    {
        $result=$this->db->query("select user_id from users where system_id=".$sid."");
            
        foreach($result->result() as $row)
        {
           
            return $row->user_id;
          
       
        }
           
        
        
        
        
    }








    public function getdetailSKPReports($startdate,$enddate)
    {
        $re=$this->db->query("select 
                                l.system_id,
                                l.staff_Nameeng,
                                l.position_nameeng,
                                l.sex,
                                l.dateemployee,
                                l.brcode,
                                le.startdate,
                                le.enddate,
                                le.duration,
                                le.duration1,
                                le.duration2,
                                case 
                                    when le.status=1 then 'Pendding'
                                    when le.status=2 then 'Approved'
                                    when le.status=3 then 'Rejected'
                                end as status
                            from staff l
                            inner join leaves le on le.sid=l.system_id
                            where le.startdate between '".$startdate."' and '".$enddate."'
                            and   le.enddate between '".$startdate."' and '".$enddate."'
                        ");
                        return $re->result();
    }
    public function getAllreports($staffid,$role,$brcode,$emp,$startdatere,$enddatere,$subcode)
    {
        $result=$this->db->query("call sp_getReportbybranch('".$staffid."','".$role."','".$brcode."','".$emp."','".$startdatere."','".$enddatere."','".$subcode."')");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
    }
    public function getStaffleavereport($start,$end)
    {
        $result=$this->db->query("CALL sp_getSummaryReportDetail('".$start."','".$end."')");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
    }
    public function gelAllleavesbalance($brcode,$role,$system_id,$subcode)
    {
        $result=$this->db->query("Call st_getLeavesbalance('".$brcode."','".date('Y')."','".$role."','".$system_id."','".$subcode."')");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
    }
    public function getAllleaveshistoryapprovel($brcode,$role,$userid,$sid)
    {
        $result=$this->db->query("Call sp_getApprovedhistory('".$brcode."','".$role."','".$userid."','".$sid."')");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
    }
    public function getAllleaveshistoryreject($brcode)
    {
        switch($role=$this->session->userdata('role'))
        {
            case 1:
                $result=$this->db->query("
                SELECT
             
                * 
                FROM `leaves` le
                INNER JOIN staff st ON st.`system_id`=le.`sid`
                INNER JOIN `types` ty ON ty.`id`=le.`type`
                INNER JOIN users us ON us.user_id=le.rejectby
                WHERE le.`status`=3
                AND le.`rejectby`IN(SELECT user_id FROM users WHERE user_id=le.rejectby)
                and le.sid='".$sid=$this->session->userdata('system_id')."'");
                
                return $result->result();
            break;
            case 2:
            break;
            case 3:
                $result=$this->db->query("
                SELECT 
                st.system_id,
                le.lid,
                st.staff_nameeng,
                st.position_nameeng,
                st.sex,
                le.requestdate,
                le.startdate,
                le.enddate,
                ty.name AS `name`,
                le.duration,
                le.approvaldate,
                r.name AS rmname
                FROM `leaves` le
                INNER JOIN staff st ON le.sid=st.system_id
                INNER JOIN `types` ty ON ty.id=le.type
                INNER JOIN rm r ON r.rid=le.approvedby
		          WHERE st.brcode='".$brcode."' 
		          AND le.status=3
		          AND st.flag=1 AND st.active=1;
                ");
                return $result->result();
            break;
            case 4:
                 $result=$this->db->query("
                SELECT * FROM `leaves` le
                INNER JOIN staff st ON st.`system_id`=le.`sid`
                INNER JOIN `types` ty ON ty.`id`=le.`type`
                INNER JOIN users us ON us.user_id=le.rejectby
                WHERE le.`status`=3
                AND le.`rejectby`IN(SELECT user_id FROM users WHERE system_id='".$sid=$this->session->userdata('system_id')."')");
                return $result->result();
            break;
            case 5:
                 $result=$this->db->query("
                SELECT * FROM `leaves` le
                INNER JOIN staff st ON st.`system_id`=le.`sid`
                INNER JOIN `types` ty ON ty.`id`=le.`type`
                INNER JOIN users us ON us.user_id=le.rejectby
                WHERE le.`status`=3
                AND le.`rejectby`IN(SELECT user_id FROM users WHERE system_id='".$sid=$this->session->userdata('system_id')."')");
                return $result->result();
                
            break;
            case 6:
                 $result=$this->db->query("
                SELECT * FROM `leaves` le
                INNER JOIN staff st ON st.`system_id`=le.`sid`
                INNER JOIN `types` ty ON ty.`id`=le.`type`
                INNER JOIN users us ON us.user_id=le.rejectby
                WHERE le.`status`=3
                AND le.`rejectby`IN(SELECT user_id FROM users WHERE system_id='".$sid=$this->session->userdata('system_id')."')");
                return $result->result();
            break;
        }
        
        
    }
    public function getAllapproved($systemid,$role)
    {
        $result=$this->db->query("Call st_getAApproveleaves('".$systemid."','".$role."')");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
    }
    public function getViewdetail($sid,$lid)
    {
        $result=$this->db->query("Call st_getViewleaves('".$sid."','".$lid."')");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
    }
}
?>
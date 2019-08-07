<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class leaves_model extends CI_Model
{
    public function __construct()
    {
         parent::__construct();
         
    }
public function setfiles($data)
{
	$result=$this->db->insert('attach',$data);
	if($result==true){return true;}else{return false;}
	
}
public function getholiday($startdate,$enddate)
{
    $year=date("Y");
    $result=$this->db->query("select count(Workdate) as numholiday
                             from holiday where DateType=0 
                             and left(workdate,4)='".$year."' and WeekEndTF='F' and workdate between '".$startdate."' and '".$enddate."';");
    
        foreach($result->result() as $row)
        {
            return $row->numholiday;
        }
                          
                     
}
function getleavetype($sid)

   {

       $now=date('Y-m-d');

       $this->db->select('system_id,dateemployee,flag');

       $this->db->where('flag',1);

       $this->db->where('system_id',$sid);

       $datehired=$this->db->get('staff')->row();

       $dateend=$datehired->dateemployee;

       

       $date1 = $dateend;

       $date2 = $now;

       $diff = abs(strtotime($date2) - strtotime($date1));

       $years = floor($diff / (365*60*60*24));

       $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

       $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

       $totalday=floor($diff/(60*60*24));

       

       //echo $totalday;

       if($totalday<=90)//today in servasion

       {

           $this->db->where('id',1);
           $query=$this->db->get('types');
           return $query->result();

           

       }else

       {

          $query=$this->db->get('types');
          return $query->result();

       }

       

   } 
   public function checkAnnual($check,$sid)
   {
        $Ann=$this->fnAnnual_Leave($sid);
        $numAnn=$this->getAnnualLeave();
        $resultAnn=$numAnn-$Ann;
        $resultAnn1=$check-$resultAnn;
        
        if($resultAnn1>0)
        {
            return $resultAnn1;
        }else if($resultAnn1<0)
        {
            return -$resultAnn1;
        }else
        {
            return 0;
        }

   }
   public function checklbtype($type,$duration,$sid)
   {
       $Ann=$this->fnAnnual_Leave($sid);
       $sl=$this->fnSick_leave($sid);
       $spl=$this->fnSpecial_leave($sid);
       $numsick=$this->getSickleave();
       $numspecial=$this->getSpecialleaves();
       $numAnn=$this->getAnnualLeave();
       
           switch($type)
           {
               case 3:
                   //Specialleaves
                   $resultspecial=$numspecial-$spl;
                   $resultspecial1=$duration-$resultspecial;
                  
               return $resultspecial1;

               break;
               case 4:
                   //Sickleaves
                   $resultsick=$numsick-$sl;
                   $resultsick1=$duration-$resultsick;
                   
               return $resultsick1;
               break;
               
               case 5:
                   //AnnualLeaes
                   $resultann=$numAnn-$Ann;
                   $resultann1=$duration-$resultann;
               return $resultann1;

               break;
               

               default;
                   return "";
               break;


           }
   }
   public function setleaves($sid,$brcode,$company_id,$leavestart,$leavesend,$leavetype,$userid,$note,$morning,$afternoon,$duration)
   {
        
        $insert_data=array
            (
            'sid'=>$sid,
            'requestdate'=>date('Y-m-d'),
            'startdate'=>date('Y-m-d',strtotime($leavestart)),
            'enddate'=>date('Y-m-d',strtotime($leavesend)),
            'type'=>$leavetype,
            'type1'=>0,
            'type2'=>0,
            'status'=>1,
            'employee'=>$userid,
            'brcode'=>$brcode,
            'company_id'=>$company_id,
            'cause'=>$note,
            'startdatetype'=>$morning,
            'enddatetype'=>$afternoon,
            'duration'=>$duration,
            'duration1'=>0,
            'duration2'=>0
            );
       $result=$this->db->insert('leaves',$insert_data);
       if($result==true)
       {
           return true;
       }
       else{
           return false;
       }
       
   }
   
  

   public function getHremail()
   {
       $result=$this->db->from('hr_email')
                        ->where('flag',1)
                        ->get();
       return $result;
       /*foreach($result->result() as $row)
       {
           return $row->email;
       }
       */
   }
   public function getManager()
   {
       $sysem_id=$this->session->userdata('system_id');
       
       $result=$this->db->query("call sp_getManagername('".$sysem_id."')");
       foreach($result->result() as $re)
       {
           return $re->m_name;
       }
       
   }
   public function getreplyemail($sid)
   {
       $result=$this->db->from('users')
                        ->where('system_id',$sid)
                        ->where('flag',1)
                        ->get();
        foreach($result->result() as $row)
        {
            return $row->email;
        }
       
   }
   public function getreplyemailBM($emp)
   {
       $result=$this->db->from('users')
                        ->where('user_id',$emp)
                        ->where('flag',1)
                        ->get();
        foreach($result->result() as $row)
        {
            return $row->email;
        }
   }
   public function checkleaverequst($sid,$brcode,$company_id,$start,$end)
   {
       $result=$this->db->from('leaves')
                        ->where('startdate>=',$start)
                        ->where('startdate<=',$end)
                        ->where('sid',$sid)
                        ->where('brcode',$brcode)
                        ->where('company_id',$company_id)
                        ->where_in('status',array(1,2))
                        ->get();
       foreach($result->result() as $row)
       {
          
           return true;
       }
         
                    
   }
   public function getManagerEmail()
   {
       $role=$this->session->userdata('role');
       $sid=$this->session->userdata('system_id');
       if($role==3)
       {
           $re=$this->db->from('staff')
                            ->where('system_id',$sid)
                            ->get()->row();
           $res=$this->db->from('rm')
                        ->where('rid',$re->rm_id)
                        ->where('flag',1)
                        ->get();
            foreach($res->result() as $row)
            {
                return $row->email;
            }
           
       }else
       {
           $re=$this->db->from('staff')
                            ->where('system_id',$sid)
                            ->get()->row();
           $res=$this->db->from('manager')
                        ->where('m_id',$re->hid)
                        ->where('flag',1)
                        ->get();
            foreach($res->result() as $row)
            {
                return $row->email;
            }
           
           
       }
       
   }
   public function getlid($sid,$brcode,$company_id)
   {
       $result=$this->db->from('leaves')
                        ->where('sid',$sid)
                        ->where('brcode',$brcode)
                        ->where('company_id',$company_id)
                        ->where('status',1)
                        ->get();
        return $result->result();
   }
   public function getleaves($lid)
   {
       $result=$this->db->from('leaves')
                        ->join('staff','staff.system_id=leaves.sid')
                        ->join('tbl_branch','tbl_branch.brCode=staff.brcode')
                        ->where('leaves.lid',$lid)
                        ->get();
       return $result->result();
   }
   public function getLeavesrequest($company_id)
   {
    switch($role=$this->session->userdata('role'))
    {
        case 1:
            
             $sid=$this->session->userdata('system_id');
             $result=$this->db->from('leaves')
                        ->join('staff','staff.system_id=leaves.sid','staff.brcode=leaves.brcode')
                        
                        
                        ->join('types','types.id=leaves.type')
                        ->join('tbl_branch','tbl_branch.brCode=staff.brCode')
                        ->where('leaves.sid',$sid)
                        ->where('staff.company_id',$company_id)
                        ->order_by('leaves.status','DSCE')
                        ->where_in('leaves.status',array('1'))
                        ->get();
             return $result->result();
        break;
        case 2:
        break;
        case 3:
            $brcode=$this->session->userdata('branch_code');
            $subbrcode=$this->session->userdata('subbranch');
            $result=$this->db->from('leaves')
                        ->join('staff','staff.system_id=leaves.sid','staff.brcode=leaves.brcode')
                        ->join('types','types.id=leaves.type')
                        ->join('tbl_branch','tbl_branch.brCode=staff.brcode')
                        ->where('staff.company_id',$company_id)
                        ->where_in('staff.brcode',array($brcode,$subbrcode))
                        ->order_by('leaves.status','DSCE')
                        ->where_in('leaves.status',array('1'))
                        ->get();
            return $result->result();
       
        break;
        case 4:
            $userid=$this->session->userdata('user_id');
            $result=$this->db->from('leaves')
                        ->join('staff','staff.system_id=leaves.sid','staff.brcode=leaves.brcode')
                        ->join('types','types.id=leaves.type')
                        ->join('tbl_branch','tbl_branch.brCode=staff.brcode')
                        ->where('leaves.employee',$userid)
                        ->where('staff.company_id',$company_id)
                        ->order_by('leaves.status','DSCE')
                        ->where_in('leaves.status',array('1'))
                        ->get();
            return $result->result();
       
        break;
        case 5:
            $sid=$this->session->userdata('system_id');
             $result=$this->db->from('leaves')
                        ->join('staff','staff.system_id=leaves.sid','staff.brcode=leaves.brcode')
                        ->join('types','types.id=leaves.type')
                        ->join('tbl_branch','tbl_branch.brCode=staff.brcode')
                        ->where('leaves.sid',$sid)
                        ->where('staff.company_id',$company_id)
                        ->order_by('leaves.status','DSCE')
                        ->where_in('leaves.status',array('1'))
                        ->get();
             return $result->result();
        break;
         case 6:
            $sid=$this->session->userdata('system_id');
             $result=$this->db->from('leaves')
                        ->join('staff','staff.system_id=leaves.sid','staff.brcode=leaves.brcode')
                        ->join('types','types.id=leaves.type')
                        ->join('tbl_branch','tbl_branch.brCode=staff.brcode')
                        ->where('leaves.sid',$sid)
                        ->where('staff.company_id',$company_id)
                        ->order_by('leaves.status','DSCE')
                        ->where_in('leaves.status',array('1'))
                        ->get();
             return $result->result();
        break;
    }
       
   }
   public function delectleave($id)
   {
       $this->db->where('lid',$id);
       $this->db->delete('leaves');
       
   }
   public function weekly($DateStart,$num_datestart,$num_dateend,$Morning,$afternoon)
    {
        
        $dateset='01-01-'.date('Y');
        $count_weekday=0;
        $resultdate=$num_dateend-$num_datestart;
        if($Morning=="Morning" && $afternoon=="Morning" && $resultdate==0)
        {
            $count_weekday=($num_dateend-$num_datestart);
            if($count_weekday==0)
            {
                $count_weekday=0.5;
                return $count_weekday;
            }
            
        }
        else if($Morning=="Afternoon" && $afternoon=="Afternoon" && $resultdate==0)
        {
            $count_weekday=($num_dateend-$num_datestart);
            if($count_weekday==0)
            {
                $count_weekday=0.5;
                return $count_weekday;
            }
        }
        else
        {
            
            if($Morning=="Morning" && $afternoon=="Morning" && $resultdate!=0)
            {
                $resultdate=$num_dateend-$num_datestart;
                $day_short = array();
                for($i=0;$i<=$resultdate;$i++)
                { 
                    $timestamp = strtotime($DateStart);
                    $data=date("z", $timestamp)+$i;
                    $tDay=$data;
                    $tFormat = 'D';
                    $day = (intval( $tDay ) - 1);
                    $day = ( $day == 0 ) ? $day : $day - 1;
                    $offset = intval( intval( $tDay ) * 86400 );
                    $str = date( $tFormat, strtotime($dateset) + $offset );
                    array_push($day_short, $str);
                    //$array=array($i=>$str);

                }
                    print_r($day_short);
                    $count_weekday = 0;
                    foreach ($day_short as $key => $value) 
                    {
                    if ($value == 'Sat' || $value == 'Sun') {

                    } else 
                    {
                    $count_weekday ++;
                    }
                    }
                    $count_weekday=$count_weekday-0.5;
                    return $count_weekday;
            }
            
           else if($Morning=="Afternoon" && $afternoon=="Afternoon" && $resultdate!=0)
            {
                $resultdate=$num_dateend-$num_datestart;
                $day_short = array();
            for($i=0;$i<=$resultdate;$i++)
            { 
                $timestamp = strtotime($DateStart);
                $data=date("z", $timestamp)+$i;
                $tDay=$data;
                $tFormat = 'D';
                $day = (intval( $tDay ) - 1);
                $day = ( $day == 0 ) ? $day : $day - 1;
                $offset = intval( intval( $tDay ) * 86400 );
                $str = date( $tFormat, strtotime($dateset) + $offset );
                array_push($day_short, $str);
                //$array=array($i=>$str);

            }
               
                //print_r($day_short);
                $count_weekday = 0;
                foreach ($day_short as $key => $value) {
                if ($value == 'Sat' || $value == 'Sun') {

                } else {
                $count_weekday ++;
                }
                }
                $count_weekday=$count_weekday-0.5;
                return $count_weekday;
            }
          else
          {
              $resultdate=$num_dateend-$num_datestart;
              $day_short = array();
            for($i=0;$i<=$resultdate;$i++)
            { 
                $timestamp = strtotime($DateStart);
                $data=date("z", $timestamp)+$i;
                $tDay=$data;
                $tFormat = 'D';
                $day = (intval( $tDay ) - 1);
                $day = ( $day == 0 ) ? $day : $day - 1;
                $offset = intval( intval( $tDay ) * 86400 );
                $str = date( $tFormat, strtotime($dateset) + $offset );
                array_push($day_short, $str);
                //$array=array($i=>$str);

            }
               // print_r($day_short);
                $count_weekday = 0;
                foreach ($day_short as $key => $value) {
                if ($value == 'Sat' || $value == 'Sun') {

                } else {
                    $count_weekday ++;
                    }
                }
                return $count_weekday; 
              
          }  
           
            
        }    
        //Afternoon
    }
    public function fnAnnual_Leave($sid)
    {
        $ann=$this->db->query("SELECT sum(duration) as total FROM `leaves` 
                               WHERE sid='".$sid."' AND `type`=5 
                               AND `status`=2;");
        foreach($ann->result() as $row)
        {
            return $row->total;
        }
    }
    public function fnUnpaid_leave($sid)
    {
        $ann=$this->db->query("SELECT sum(duration) as total FROM `leaves` 
                               WHERE sid='".$sid."' AND `type`=1 
                               AND `status`=2;");
        foreach($ann->result() as $row)
        {
            return $row->total;
        }
    }
    public function fnSick_leave($sid)
    {
        $ann=$this->db->query("SELECT sum(duration) as total FROM `leaves` 
                               WHERE sid='".$sid."' AND `type`=4 
                               AND `status`=2;");
       foreach($ann->result() as $row)
        {
            return $row->total;
        }
    }
    public function fnSpecial_leave($sid)
    {
        $ann=$this->db->query("SELECT sum(duration) as total FROM `leaves` 
                               WHERE sid='".$sid."' AND `type`=3 
                               AND `status`=2;");
        foreach($ann->result() as $row)
        {
            return $row->total;
        }
    }
    public function fnMaternity_leave($sid)
    {
        $ann=$this->db->query("SELECT sum(duration) as total FROM `leaves` 
                               WHERE sid='".$sid."' AND `type`=5 
                               AND `status`=2;");
       foreach($ann->result() as $row)
        {
            return $row->total;
        }
    }
    public function getSickleave()
    {
        $ann=$this->db->query("SELECT MaxLeaveBalance FROM `types` 
                               WHERE id=4;");
        foreach($ann->result() as $row)
        {
            return $row->MaxLeaveBalance;
        }
        
    }
    public function getSpecialleaves()
    {
        $ann=$this->db->query("SELECT MaxLeaveBalance FROM `types` 
                               WHERE id=3;");
        foreach($ann->result() as $row)
        {
            return $row->MaxLeaveBalance;
        }
    }
    public function getAnnualLeave()
    {
        $ann=$this->db->query("SELECT MaxLeaveBalance FROM `types` 
                               WHERE id=5;");
       foreach($ann->result() as $row)
       {
           return $row->MaxLeaveBalance;
       }
    }
}
?>
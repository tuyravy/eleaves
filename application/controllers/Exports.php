<?php
if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Exports extends CI_Controller {

    public function __construct() {

        parent::__construct();

        // Load the Library

        $this->load->library("excel");

        // Load the Model
        $this->load->model('Menu_model');
        $this->load->model("reports_model");
        $this->load->model('users_model');
    }



    public function index() {

        //$sid=$this->session->userdata('SID');
        
        $this->excel->setActiveSheetIndex(0);
        $start=$this->input->post("datestart");
        $enddate=$this->input->post("enddate");
        
        $sid=$this->input->post("sid");
        if(empty($start) && empty($sid))
        {
            $start=date('Y-m-01');
            $enddate=date('Y-m-d');
            $data = $this->reports_model->getStaffleavereport($start,$enddate);
        }else
        {
            
            $data = $this->reports_model->getStaffleavereport($start,$enddate);
        }
        

        // Gets all the data using MY_Model.php

        $this->excel->stream("របាយការណ៍បុគ្គលិកសុំច្បាប់ប្រចាំខែ_.$start._to_.$enddate.xls",$data);

    }

    public function staffdownload()
    {
        $BrCode=$this->input->post("branch");
        $this->excel->setActiveSheetIndex(0);  
        $BrCode=$this->input->post("branch");     
        if($BrCode==0)
        {
            $data = $this->users_model->GETSTAFFINFORMATIONDOWNALOD($BrCode);
        }else
        {
            $data = $this->users_model->GETSTAFFINFORMATIONDOWNALOD($BrCode);
        }
       $this->excel->stream("របាយការណ៍បុគ្គលិកខុសពីបញ្ចី_HR.xls",$data);
    }
    public function reportsexport($arrayid)

    {

        echo $arrayid;

        //$sid=$this->session->userdata('SID');

        //$this->excel->setActiveSheetIndex(0);

        // Gets all the data using MY_Model.php

        //$data = $this->leave_model->getall();

       // $this->excel->stream('Leaves.xls', $data);

    }



}
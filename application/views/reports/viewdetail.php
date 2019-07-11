<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
          <div class="">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2><i class="fa fa-floppy-o" aria-hidden="true"></i><span style="margin-left:10px;">Reports Eleaves</span></h2>
                        <span style="margin-left:10px;">
                                <a href="<?php echo site_url('reports/ereports');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left">
                                </span><span style="margin-left:10px;">Back</span>
                                </a>
                        </span>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                  <div id="reports">
                    <div class="row">
                        <div class="col-md-3">
                              <img src="<?php echo base_url();?>public/img/logo_simple.png" class="img-responsive" alt="Cinque Terre">
                        </div>
                          <div class="col-md-6" id="textcenter">
                              <h2 id="in" style="font-size:25px;text-align:center">សហគ្រិនភាព ម៉ាយក្រូហ្វាយនែន ភិអិលស៊ី</h2>
                              <h2 id="in" style="text-align:center;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                              <h2 id="in" style="text-align:center;">Eleaves Reports</h2>
                              <p id="in" style="text-align:center">Reports Date:
                              <?php if(isset($start)){echo $start;}else{echo $start;}?>
                                <span style="margin-left:10px;">
                                    To:<span style="margin-left:10px;">
                                      <?php if(isset($end)){echo $end;}else{echo $end;}?>
                                      </span>
                                </span>
                              </p>
                          </div>   
                    </div> 
                    <br/>
                  <div class="row">   
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr style="border-bottom:3pt solid #22d4ae;">
                          <th>Staff Name</th>
                          <th>Position</th>
                          <th>Gender</th>
                          <th>Request Date</th>
                          <th>Leave_Start</th>
                          <th>Leave_End</th>
                          <th>Leave_Types</th>
                          <th>Duration</th>
                          <th>Status</th>
                        </tr>
                      </thead>                    

                      <tbody>
                        <?php foreach($reports as $row){?>
                        <tr id="tbody">
                          <td><?php echo $row->staff_nameeng;?></td>
                          <td><?php echo $row->position_nameeng;?></td>
                          <td><?php echo $row->sex;?></td>
                          <td><?php echo $row->requestdate;?></td>
                          <td><?php echo $row->startdate;?></td>
                          <td><?php echo $row->enddate;?></td>
                          <td><?php echo $row->name;?></td>
                          <td><?php echo $row->duration;?></td>                                                           
                          <td><?php switch($row->status){ case 1:echo "Pending";break;case 2:echo "Approved";break;case 3:echo "Rejected";break;}?></td>
                        </tr>
                        <?php }?>
                         
                      </tbody>
                    </table>
                          <div class="col-sm-12">
                            <p>ថ្ងៃទី.......ខែ.....ឆ្នាំ..<?php echo date('Y');?></p>
                            <p style="margin-left:40px;">ហត្ថលេខា</p>
                            <p>................................</p>
                            <p><span style="margin-left:30px;"><?php echo $this->session->userdata('fullname');?></span></p>
                           <br/>

                         </div>
                     </div>   
                   </div>
                </div>
              </div>
                  <style>#in{text-align: center;}</style>
            
             <button class="btn btn-primary" onclick="javascript:printDiv('reports')" id="btnPrint"><span class="glyphicon glyphicon-file"></span><span style="margin-left:10px;">Print Reports</span></button>
            </div>

<script language="javascript" type="text/javascript">
        function printDiv(divID) {
            
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML onl
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";
              document.getElementById("textcenter").style.margin = "0px 100px 10px 210px";
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            
          
        }
    </script>
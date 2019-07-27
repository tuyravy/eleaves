<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
          <div class="">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2><i class="fa fa-floppy-o" aria-hidden="true"></i><span style="margin-left:10px;color:#73879C">Reports Eleaves</span></h2>
                       
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
                      <div class="pull-right">
                        <button class="btn btn-primary" onclick="javascript:printDiv('reports')" id="btnPrint"><span class="fa fa-print"></span></button>
                        <span>
                                <a href="<?php echo site_url('reports/ereports');?>" class="btn btn-danger"><span class="glyphicon glyphicon-arrow-left">
                                </span><span style="margin-left:10px;">Back</span>
                                </a>
                        </span>
                        <p></p>
                    </div>
                  <div id="reports">
                    <div class="row">
                        <img src="<?php echo base_url();?>public/img/SKPletterheadLandscape.png" class="img-responsive center" alt="Cinque Terre"  id="logo" style="width:50%;display:none">
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
                  <div class="row">   
                  <div class="table-responsive">                 
                      <table id="datatable-buttons" class="table table-bordered">
                        <thead>
                          <tr style="border-bottom:2pt solid #22d4ae;">
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
                  </div>
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
        </div>
      </div>
      <style>
        /* style sheet for "A4" printing */
          @media print and (width: 21cm) and (height: 29.7cm) {
              @page {
                  margin: 3cm;
                  
              }
              
          }

          /* style sheet for "letter" printing */
          @media print and (width: 8.5in) and (height: 11in) {
              @page {
                  margin: 1in;
              }
            
          }
          
          /* A4 Landscape*/
          @page {
              size: A4 landscape;
              margin: 10%;
          }
          .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
          }
        </style>
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
              document.getElementById("logo").style.display= "inline-block"; 
              document.getElementById("logo").style.margin = "0px 100px 10px 250px";              
              
            
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            window.location.href="";  
            
          
        }
    </script>
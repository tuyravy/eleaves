<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
       
  <div class="">
    <div class="clearfix"></div>
      <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
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
                  <div class="x_content​">
                  <fieldset class="scheduler-border">
                    <legend></legend> 
                    <div>
                        <form class="form-inline" action="<?php echo site_url("reports/monthlyreport");?>" method="post">
                          <div class="form-group">
                            <label for="exampleInputName2">Reportdate Start</label>
                            <input type="text" class="form-control" id="startdate" name="datestart" required="required" placeholder="<?php echo date("Y-m-d");?>"
                            value="<?php if(isset($datestart)){ echo $start=date('Y-m-d',strtotime($datestart));}else{ echo date('Y-m-d');} ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail2">End Date</label>
                            <input type="text" class="form-control" id="enddate" name="enddate" required="required" placeholder="<?php echo date("Y-m-d"); ?>"
                            value="<?php if(isset($dateend)){ echo $enddate=date('Y-m-d',strtotime($dateend));}else{echo date('Y-m-d');} ?>">
                          </div>
                          <button type="submit" class="btn btn-primary" style="margin-top:5px;">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <span style="margin-left:5px;">Submit</span></button>
                        </form>
                    </div>
                  
                    <br/>
                    <form class="form-inline" action="<?php echo site_url("Exports");?>" method="post">  

                          <div class="form-group">
                            
                            <input type="hidden" class="form-control" id="startdate" name="datestart" required="required" placeholder="<?php echo date("Y-m-d");?>"
                            value="<?php if(isset($datestart)){ echo $start=date('Y-m-d',strtotime($datestart));}else{ echo date('Y-m-d');} ?>">
                          </div>
                          <div class="form-group">
                           
                            <input type="hidden" class="form-control" id="enddate" name="enddate" required="required" placeholder="<?php echo date("Y-m-d"); ?>"
                            value="<?php if(isset($dateend)){ echo $enddate=date('Y-m-d',strtotime($dateend));}else{echo date('Y-m-d');} ?>">
                          </div>                  
                      <button type="submit" name="download" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i>
                      <span style="margin-left:5px;">Download</span></button>
                      <p style="color:red;">ប្រសិនបើចង់បានរបាយការណ៍លំអិតសូមធ្វើការជ្រើសរើសថ្ងៃខែឆ្នាំរបាយការណ៍ និង យកពាក្យ Donwload សូមអរគុណ!</p>
                    </form>
                   
                    </fieldset>   
                    <fieldset class="scheduler-border">
                    <legend></legend> 
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                            <th>SID</th>
                            <th>Staff Name</th>
                            <th>Position</th>
                            <th>Gender</th>
                            <th>DOE</th>
                            <th>BrCode</th>                            
                            <th>Leave_Start</th>
                            <th>Leave_End</th>
                            <th>Duration</th>
                            <th>Status</th>       
                        </tr>
                       </thead>
                      <tbody>
                      <?php 
                        foreach($monthlyreports as $row)
                        {
                      ?>
                        <tr>
                           <td><?php echo $row->system_id;?></td>
                           <td><?php echo $row->staff_Nameeng;?></td>
                           <td><?php echo $row->position_nameeng;?></td>
                           <td><?php echo $row->sex;?></td>
                           <td><?php echo $row->dateemployee;?></td>
                           <td><?php echo $row->brcode;?></td>
                           <td><?php echo $row->startdate;?></td>
                           <td><?php echo $row->enddate;?></td>
                           <td><?php echo $row->duration+$row->duration1+$row->duration2;?></td>
                           <td><?php echo $row->status;?></td>
                        </tr>
                        <?php
                        }
                       ?>
                      </tbody>
                    </table>    
                    </div>                     
                    </fieldset>
                </div>
              </div>
            </div>
          </div>
        </div>
    
    <style>#in{text-align: center;}</style>
    <!--==============Mesage approvel-->
    <!-- Small modal -->
    <style>
 .nopadding {
    padding: 0 !important;
    margin: 0 !important;
}
 fieldset.scheduler-border {
  border: 2pt groove #ffff !important;
  padding: 0 1em 1em 1em !important;
  margin: 0 0 1.5em 0 !important;
  color:#73879C !important;
  -webkit-box-shadow:  0px 0px 0px 0px #000 !important;
          box-shadow:  0px 0px 0px 0px #000 !important;
  }

  legend.scheduler-border {
  font-size: 1.2em !important;
  font-weight: bold !important;
  text-align: left !important;
  color:#73879C !important;
  }
  legend{
      font-size: 1em !important;
      color: #777;
  }
  fieldset
  {
      width:100% !important;
      
  }
 </style>          
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
  <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

  <script>
      var jqOld = jQuery.noConflict();
      jqOld(function() {
          jqOld("#startdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
      });
      jqOld(function() {
          jqOld("#enddate" ).datepicker({ dateFormat: 'yy-mm-dd' });
      })
  </script>


   
    
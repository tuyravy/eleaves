<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
       
  <div class="">
    <div class="clearfix"></div>
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-floppy-o" aria-hidden="true"></i><span style="margin-left:10px;">Reports Eleaves</span></h2>
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
                    <div align='center'>
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
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
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
                      <button type="submit" name="download" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
                      <span style="margin-left:5px;">Download</span></button>
                    </form>
                   
                   <p style="color:red;">ប្រសិនបើចង់បានរបាយការណ៍លំអិតសូមធ្វើការជ្រើសរើសថ្ងៃខែឆ្នាំរបាយការណ៍ និង យកពាក្យ Donwload សូមអរគុណ!</p>
                   
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
                      <tbod>
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
              </div>
            </div>
          </div>
        </div>
    
    <style>#in{text-align: center;}</style>
    <!--==============Mesage approvel-->
    <!-- Small modal -->
                
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


  
<script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        var table = $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        TableManageButtons.init();
      });
    </script>
   
    
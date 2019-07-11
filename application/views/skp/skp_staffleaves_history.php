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
                       <form class="form-inline">
                      <div class="form-group">
                        <label for="exampleInputName2">StaffName:</label>
                        <select class="form-control" name="staffname">
                            <option>Select Staff</option>
                            <option value="0">All</option>
                            <?php foreach($staff as $row){?>
                            <option value="<?php echo $row->system_id;?>"><?php echo $row->staff_nameeng;?></option>
                            <?php }?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail2">Reportdate</label>
                        <input type="text" class="form-control" id="datestart" name="datestart" placeholder="<?php echo date('Y-m-d');?>">
                      </div>
                       <div class="form-group">
                        <label for="exampleInputEmail2">To</label>
                        <input type="text" class="form-control" id="dateend" name="dateend" placeholder="<?php echo date('Y-m-d');?>">
                      </div>
                        
                      <button type="submit" class="btn btn-primary" style="margin-top:5px;" >Submit</button>
                    </form>
                    </div>
                    <br/>
                
                   
                  <div class="row">   
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
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
                      <?php
                            $start=0;
                            $brcode=$this->session->userdata('branch_code');
                            $userid=$this->session->userdata('user_id');
                            $role=0;
                            $subbranch=$this->session->userdata('subbranch');
                            if(isset($_GET['datestart'])){ $start=date('Y-m-d',strtotime($_GET['datestart']));}
                            if(isset($_GET['dateend'])){ $end=date('Y-m-d',strtotime($_GET['dateend']));}
                            if(isset($_GET['staffname'])){ $staffid=$_GET['staffname'];}
                            
                            if($start==0){
                                $staffid=0;
                                $endofmonth=date('m')-02;
                                $start=date('2017-01-01');
                                $end=date('Y-m-d');
                                
                                $reprots=$this->Reports_model->getAllreports($staffid,$role,$brcode,$userid,$start,$end,$subbranch);
                            }else
                            {
                                
                                $reprots=$this->Reports_model->getAllreports($staffid,$role,$brcode,$userid,$start,$end,$subbranch);
                            }
                        ?>

                      <tbody>
                        <?php foreach($reprots as $row){?>
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
                   </div>
                </div>
              </div>
            
              <style>#in{text-align: center;}</style>
              <!--==============Mesage approvel-->
              <!-- Small modal -->
                

                <div class="modal fade bs-example-modal-sm" id="app" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Comfirm Approvel leaves</h4>
                      </div>
                      <div class="modal-body">
                        <h4>Do you want to approvel?</h4>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><span style="margin-left:10px;"></span>No</button>
                         <a href="#" class="btn btn-primary"  id="setapproval" style="margin-top:-5px;"><span class="glyphicon glyphicon-ok"></span><span style="margin-left:10px;"></span>Yes</a>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Small modal -->
                

                <div class="modal fade bs-example-modal-sm" id="re" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Comfirm Reject leaves</h4>
                      </div>
                      <div class="modal-body">
                        <h4>Do you want to reject?</h4>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><span style="margin-left:10px;"></span>No</button>
                         <a href="#" class="btn btn-primary"  id="setreject" style="margin-top:-5px;"><span class="glyphicon glyphicon-ok"></span><span style="margin-left:10px;"></span>Yes</a>
                        
                      </div>
                    </div>
                  </div>
                </div>
              
              
              <div class="modal fade bs-example-modal-lg" id="de" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">View History leaves</h4>
                                      </div>
                                      <div class="modal-body">
                                        
                                         <div id='showhistory'>
                                          
                                         </div>
                                          
                                          
                                      </div>
                                      <div class="modal-footer">
                                        <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><span style="margin-left:10px;"></span>Close</button>
                                      </div>
                                </div>
                              </div>
                         </div>

              
              
        <!-- /page content -->

<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#datestart" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    jqOld(function() {
        jqOld("#dateend" ).datepicker({ dateFormat: 'yy-mm-dd' });
    })
</script>
    <script>
        $(document).ready(function()
        {
            $("#datatable-buttons #tbody").on('click','#approvel',function()
            {
                var id=$(this).data('id');
                $("#app").data('id',id).modal();
            });
            $('#app').on('click','#setapproval',function()
            {
                var id=$('#app').data('id');
                var link = "<?php echo site_url('Request_leaves_Controller/setapprovelleaves');?>/"+id;
                $("#setapproval").attr('href', link);
            })
            $("#datatable-buttons #tbody").on('click','#reject',function()
            {
                var id=$(this).data('id');
                $("#re").data('id',id).modal();
            });
            $('#re').on('click','#setreject',function()
            {
                var id=$('#re').data('id');
                var link = "<?php echo site_url('Request_leaves_Controller/setrejectleaves');?>/"+id;
                $("#setreject").attr('href', link);
            })
             $("#datatable-buttons #tbody").on('click','#detail',function()
            {
                var id=$(this).data('id');
                $('#showhistory').load("<?php echo site_url('Request_leaves_Controller/showhistoryleaves');?>/"+id);
                $("#de").data('id',id).modal();
                
            });
            
        });          
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
    <!-- /Datatables -->
   <!--<?php echo site_url('Request_leaves_Controller/setapprovelleaves');?>/<?php echo $row->le_id;?>-->
    

   
    
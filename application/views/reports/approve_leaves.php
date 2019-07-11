<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
      
          <div class="">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="icon-ok"></i><span style="margin-left:5px;">Approvel Eleaves</span></h2>
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
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr style="border-bottom:3pt solid #22d4ae;"> 
                          <th>Staff Name</th>
                          <th>BrName</th>
                          <th>Position</th>
                          <th>Gender</th>
                          <th>Request_Date</th>
                          <th>Leave_Start</th>
                          <th>Leave_End</th>
                          <th>Leave_Types</th>
                          <th>Duration</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php 
                         
                          foreach($app as $row){
                          ?>
                        <tr id="tbody">
                          <td><?php echo $row->staff_nameeng;?></td>
                          <td><?php echo $row->shortcode;?></td>
                          <td><?php echo $row->position_nameeng;?></td>
                          <td><?php echo $row->sex;?></td>
                          <td><?php echo $row->requestdate;?></td>
                          <td><?php echo $row->startdate;?></td>
                          <td><?php echo $row->enddate;?></td>
                          <td><?php echo $row->name;?></td>
                          <td><?php echo $row->duration;?></td>
                          <td><?php switch($row->status){case 1:echo  "<span class='btn btn-danger btn-xs'>Pending</span>";break;case 2: "Approved";break;case 3:echo "Rejected";break;};?></td>
                          <td>
                            <a href="#" id="approvel" data-id='<?php echo $row->lid; ?>'>
                                <span class="glyphicon glyphicon-ok"  data-toggle="tooltip" data-placement="top" title="Approve leaves"></span> 
                            </a>
                            <a href="#" id="reject" data-id='<?php echo $row->lid; ?>'>
                                <span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Reject leaves"></span> 
                            </a>
                            <a href="<?php echo site_url('reports/viewleaves')?>/<?php echo $row->sid;?>/<?php echo $row->lid;?>/<?php echo $row->startdate;?>/<?php echo $row->enddate;?>" id="detail" data-id='<?php echo $row->lid; ?>'>
                                <span class="glyphicon glyphicon-file" data-toggle="tooltip" data-placement="top" title="View detail"></span> 
                            </a>
                              
                          </td>
                         
                        </tr>
                          
                      <?php }?>
                        
                      </tbody>
                    </table>
                    <div class="pull-right">
                                <div style="margin-top: 25px;margin-bottom: -12px;">
                                  <label>Total <span class="label label-default"><?= $total_rows; ?></span>records</label>
                                  </div>  
                                  <br/>
                              <?php echo $this->pagination->create_links(); ?>
                    </div>
                  </div>
                </div>
              </div>

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
              </div>
              
              

              
              
        <!-- /page content -->
   
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
            
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            
          
        }
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
                var link = "<?php echo site_url('reports/setapprovelleaves');?>/"+id;
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
                var link = "<?php echo site_url('reports/setrejectleaves');?>/"+id;
                $("#setreject").attr('href', link);
            })
             
            
        });          
    </script>
   
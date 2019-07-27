<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="<?php echo base_url();?>dist/sweetalert.js"></script>
 <link rel="stylesheet" href="<?php echo base_url();?>dist/sweetalert.css">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-eye" aria-hidden="true"></i><span style="margin-left:10px;color:#73879C;">Views Eleaves</span></h2>
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
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead class="active">
                        <tr style="border-bottom:2pt solid #22d4ae;">
                          <th>StaffName</th>
                          <th>Position</th>
                          <th>BrName</th>
                          <th>Gender</th>
                          <th>Request_Date</th>
                          <th>Leave_Start</th>
                          <th>Leave_End</th>
                          <th>Leave_Types</th>
                          <th>Duration</th>
                          <th>Requestby</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody id="looptr">
                        <?php foreach($eleaverequest as $row){
                        
                        ?>
                        <tr id="tbody">
                        
                          <td><?php echo $row->staff_nameeng;?></td>                          
                          <td><?php echo $row->position_nameeng;?></td>
                          <td><?php echo $row->shortcode;?></td>
                          <td><?php echo $row->sex;?></td>
                          <td id="center"><?php echo $row->requestdate;?>
                          </td>
                          <td id="center"><?php echo $row->startdate;
                                    echo "<p style='margin-top:-10px;'><p>";
                                   
                                    echo $row->startdatetype; 
                                    
                                ?>
                           </td>
                            <style>#center{text-align: center;}</style>
                          <td id="center">
                              <?php echo $row->enddate;
                                    echo "<p style='margin-top:-10px;'><p>";
                                    echo $row->enddatetype;
                              ?>
                          </td>
                          <td>
                               <p> <?php echo $row->name;?></p>
                                <p>
                                    <?php
                                       if($row->type1==5)
                                       {
                                         echo "Annual leave";
                                       }else
                                       {
                                         "";
                                       }
                                    ?>
                                </p>
                                <p>
                                <?php
                                       if($row->type2==1)
                                       {
                                         echo "Unpaid leave";
                                       }else
                                       {
                                         "";
                                       }
                                    ?> 
                                </p>
                          </td>
                          <td>
                             <p><?php echo $row->duration;?></P>
                              <p>
                                    <?php
                                       if($row->type1==5)
                                       {
                                        echo $row->duration1;
                                       }else
                                       {
                                         "";
                                       }
                                    ?>
                                </p>
                                <p>
                                <?php
                                       if($row->type2==1)
                                       {
                                        echo $row->duration2;
                                       }else
                                       {
                                         "";
                                       }
                                    ?> 
                                </p>
                          </td>
                          <td><?php echo $this->session->userdata('full_name');?></td>
                          <td><?php switch($row->status){
                                    case 1:
                                    echo "<span style='color:rgba(245, 77, 77, 0.87);'>Pending</style></span>";
                                    break;
                                    case 2:
                                    
                                    echo "<span style='color:rgba(6, 142, 74, 0.88)'>Approved</style></span>";
                                    
                                    break;
                                    case 3:
                                    echo "<span style='color:rgba(255, 157, 0, 0.92)'>Rejected</style></span>";
                                    break; 
                                    }
                                ?>
                           </td>
                          <td>
                          <?php
                            if($row->status==1){
                            ?>
                            <a href="#" id="reject" data-id='<?php echo $row->lid;?>' class="sweet-4">
                                
                                <button type="button" class="btn btn-danger btn-xs">Cancel</button>
                            </a>
                            <?php }?>
                              
                          </td>
                         
                        </tr>
                        <?php }?> 
                      
                        
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
              
             
              
              
        <!-- /page content -->
<script>
 $(document).ready(function()
    {
    $("#datatable-buttons #looptr").on("click",".sweet-4",function()
        {
          var id=$(this).data('id');          
            swal({
            title: "Are you sure?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn-danger ok',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false,
            closeOnCancel: false
            },  
            function(isConfirm) {
              
              if (isConfirm) {
                
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    $.ajax({
                    url: "<?php echo site_url('leave/delectleaves');?>/"+id,
                    type: "POST"
                    })
                    .done(function(data) {
                      swal({
                        title: "Deleted",
                        text: "Member has been successfully deleted",
                        type: "success"
                      },function() {
                      location.reload();
                      });
                    })
                   
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            }         
            /*function(){
            swal("", "Your record has been deleted!", "success");
            }*/,
            
            );
        })
    });
 </script>
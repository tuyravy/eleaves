<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
 <script src="<?php echo base_url();?>dist/sweetalert.js"></script>
 <link rel="stylesheet" href="<?php echo base_url();?>dist/sweetalert.css">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="glyphicon glyphicon-user" aria-hidden="true"></i><span style="margin-left:10px;">LIST OF STAFF NOT YET USER</span></h2>
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
                  <?php if($this->session->flashdata('success')){?>
                    <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?>
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    <?php }?>
                    <?php if($this->session->flashdata('error')){?>
                    <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error'); ?>
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    <?php }?>
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead >
                        <tr style="border-bottom:3pt solid #22d4ae;">
                          <th style="text-align:center">ID</th>
                          <th style="text-align:left">Full Name</th>
                          <th style="text-align:left">Position</th>
                          <th style="text-align:center">BrCode</th>                          
                          <th style="text-align:center">BrName</th>
                          <th style="text-align:center">Status</th>
                          <th style="text-align:center">Action</th>
                        </tr>
                      </thead>

                      <tbody id="looptr">
                       <?php $i=1;
                       foreach($listofuser as $row):
                        if($row->active=1){
                       ?>
                        <tr id="tbody" style="text-align:center">
                        
                          <td><?= $i++;?></td>                          
                          <td  style="text-align:left"><?= $row->staff_nameeng;?></td> 
                          <td  style="text-align:left"><?= $row->position_nameeng;?></td>                          
                          <td><?= $row->brcode;?></td>                         
                          <td><?= $row->shortcode;?></td>
                          <td id="center">
                          <?php  if($row->active==1){ echo "Active";}else{ echo "Unactive";}?>
                          </td>                                        
                           
                          <td>

                            <a href="#" id="delete" data-id='<?php echo $row->system_id;?>' class="sweet-4">                                
                                <button type="button" class="btn btn-danger btn-xs">Delete</button>
                            </a>
                            
                            <a href="#" id="addnewuser" data-id='<?php echo $row->system_id;?>' class="sweet-4">                                
                                <button type="button" class="btn btn-info btn-xs">Add User</button>
                            </a>
                          </td>
                         
                        </tr>
                       
                        <?php 
                                } 
                                endforeach;?>
                        
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
              <div class="modal fade bs-example-modal-sm" id="adduser" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ADD USER</h4>
              </div>
                    <form class="form-horizontal" action="<?php echo site_url("user/SETUSER");?>" method="post">
                      <div class="modal-body"> 
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email" required>
                          </div>
                        </div>                         
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-3 control-label">USERTYPE</label>
                              <div class="col-sm-9">
                              <div><input type="hidden" name='systemid' id="sid"></div>
                              <select class="form-control" name="usertype">
                              <?php foreach($role as $row):?>
                                <option value="<?php echo $row->code;?>"><?php echo $row->note;?></option>
                              <?php endforeach;?>
                              </select>
                              </div>
                            </div>                             
                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-info" style="margin-top:-5px;">Save changes</button>
                    </div>
                    </form> 



                </div>
              </div>
            </div>
             
              
              
        <!-- /page content -->
<script>
 $(document).ready(function()
    {
    $("#datatable-buttons #looptr").on("click","#addnewuser",function()
    {
      var id=$(this).data('id');
      document.getElementById("sid").value=id;
     
      $("#adduser").data("id",id).modal();
    });
    $("#datatable-buttons #looptr").on("click","#delete",function()
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
                    url: "<?php echo site_url('user/DeleteStaff');?>/"+id,
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
 <script src="<?php echo base_url();?>dist/sweetalert.js"></script>
 <link rel="stylesheet" href="<?php echo base_url();?>dist/sweetalert.css">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="glyphicon glyphicon-user" aria-hidden="true"></i><span style="margin-left:10px;">LIST OF MANAGER</span></h2>
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
                      <div style="margin-top: 25px;margin-bottom: -12px;">
                          <button type="button" class="btn btn-success">
                          <span class="glyphicon glyphicon-user"></span><span style="margin-left:10px;">Create New</span></button>
                      </div>  
                      <br/>                              
                    </div>
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead >
                        <tr style="border-bottom:2pt solid #22d4ae;">
                          <th style="text-align:center">ID</th>
                          <th style="text-align:left">Name</th>
                          <th style="text-align:left">Email</th>
                          <th style="text-align:center">System ID</th>                         
                             
                          <th style="text-align:center">Action</th>
                        </tr>
                      </thead>

                      <tbody id="looptr">
                       <?php $i=1;
                       foreach($manager as $row):?>
                        <tr id="tbody" style="text-align:center">                        
                          <td><?= $i++;?></td>                          
                          <td  style="text-align:left"><?= $row->m_name;?></td> 
                          <td  style="text-align:left"><?= $row->email;?></td>                          
                          <td><?= $row->sid;?></td>                         
                          <td>
                            <a href="#" id="reject" data-id='' class="sweet-4">                                
                                <button type="button" class="btn btn-danger btn-xs">Delete</button>
                            </a>
                            <a href="#" id="reject" data-id='' class="sweet-4">                                
                                <button type="button" class="btn btn-success btn-xs">Edit</button>
                            </a>
                            <a href="#" id="reject" data-id='' class="sweet-4">                                
                                <button type="button" class="btn btn-info btn-xs">Add Role</button>
                            </a>
                          </td>
                         
                        </tr>
                       
                        <?php endforeach;?>
                        
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
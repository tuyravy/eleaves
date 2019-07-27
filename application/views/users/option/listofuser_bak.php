<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <script src="<?php echo base_url();?>dist/sweetalert.js"></script>
 <link rel="stylesheet" href="<?php echo base_url();?>dist/sweetalert.css">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="glyphicon glyphicon-user" aria-hidden="true"></i><span style="margin-left:10px;">LIST OF USER</span></h2>
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
                  <div class="page-title">
                  <div class="title_left">
                    <h3></h3>
                  </div>

                  <div class="title_right">
                    <div class="col-md-7 col-sm-5 col-xs-12"​ style="margin-top:15px;">
                        <label class="checkbox-inline">
                          <input type="checkbox" id="inlineCheckbox1" value="option1">មិនទាន់ផ្ងើរ
                        </label>
                       
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button">Go!</button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead >
                        <tr style="border-bottom:3pt solid #22d4ae;">
                          <th style="text-align:center">ID</th>
                          <th style="text-align:left">Full Name</th>
                          <th style="text-align:left">User Name</th>
                          <th style="text-align:center">BrCode</th>                          
                          <th style="text-align:center">BrName</th>
                          <th style="text-align:center">Status</th>
                          <th style="text-align:center">Action</th>
                        </tr>
                      </thead>

                      <tbody id="looptr">
                       <?php $i=1;
                       foreach($listofuser as $row):?>
                        <tr id="tbody" style="text-align:center">
                        
                          <td><?= $i++;?></td>                          
                          <td style="text-align:left"><?= $row->staff_nameeng;?></td> 
                          <td style="text-align:left"><?= $row->username;?></td>                          
                          <td><?= $row->brcode;?></td>                         
                          <td><?= $row->shortcode;?></td>
                          <td id="center">
                          <?php  if($row->active==1){ echo "Active";}else{ echo "Unactive";}?>
                          </td>                                        
                           
                          <td>

                            <a href="#" id="delete" data-id='<?php echo $row->system_id;?>' class="sweet-4">                                
                                <button type="button" class="btn btn-danger btn-xs">Delete</button>
                            </a>
                            <a href="#" id="reject" data-id='' class="sweet-4">                                
                                <button type="button" class="btn btn-success btn-xs">Edit</button>
                            </a>
                            <a href="#" id="reject" data-id='' class="sweet-4">                                
                                <button type="button" class="btn btn-info btn-xs">Send User</button>
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
    $("#inlineCheckbox1").click(function()
    {
     
      if($(this).is(":checked"))
        {
          var role=1;
          $.getJSON("<?php echo site_url("user/NOTSENDUSER");?>/"+role,function(obj)
        {
            var employee='';
            var i=0;
            var status="";
            $.each(obj,function(key,value)
            {
                i++;
                if(value.status==1){status='Active';}else{status='UnActive';};
                employee+='<tr>';
                employee+="<tr id='tbody' style='text-align:center'>";
                employee+="<td>"+i+"</td>";                          
                employee+="<td>"+value.full_name+"</td>"; 
                employee+="<td style='text-align:left'>"+value.username+"</td>";                         
                employee+="<td>"+value.branch_code+"</td>";   
                employee+="<td>"+value.shortcode+"</td>";                        
                employee+="<td>"+status+"</td>";                                                      
                employee+="<td><a href='#' id='delete' data-id="+value.system_id+" class='sweet-4'>";                             
                employee+="<button type='button' class='btn btn-danger btn-xs'>Delete</button></a>";
                employee+="<a href='#' id='reject' data-id="+value.system_id+" class='sweet-4'>";                               
                employee+="<button type='button' class='btn btn-success btn-xs'>Edit</button></a>";
                employee+="<a href='#' id='reject' data-id="+value.system_id+" class='sweet-4'>";                                
                employee+="<button type='button' class='btn btn-info btn-xs'>Send User</button></a></td>";                       
                employee+="</tr>";                         
               
            });
            $("#looptr").html(employee);
            $(".pull-right").hide();
          });

        }else{
          location.reload();          
        }
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
                    url: "<?php echo site_url('user/DeleteUser');?>/"+id,
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
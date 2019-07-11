<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
 <script src="<?php echo base_url();?>dist/sweetalert.js"></script>
 <link rel="stylesheet" href="<?php echo base_url();?>dist/sweetalert.css">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="glyphicon glyphicon-user" aria-hidden="true"></i><span style="margin-left:10px;">Staff Compare With MBWIN</span></h2>
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
                  <div class="col-sm-12">
                  <form action="<?php echo site_url('Exports/staffdownload');?>" method="post">
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label" style="margin-top:10px">BRANCH FITTER</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="Branch" name="branch">                            
                                    <option value="0">SELECT BRANCH</option>
                             <?PHP foreach($branch AS $ROW){?>
                                    <option value="<?php echo $ROW->brCode;?>"><?php echo $ROW->shortcode;?></option>
                             <?php }?>
                            </select>
                            <br/>
                        </div>
                        <div class="col-sm-3">
                        
                              <button type="submit" class="btn btn-success" id="downloadstaff"><span class="glyphicon glyphicon-download-alt"></span>
                              <span style="margin-left:5px;">Download excel files</span></button>
                        
                        </div>
                    </div>
                    </form> 
                 </div>      
                        
                  
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead >
                        <tr style="border-bottom:3pt solid #22d4ae;">
                          <th style="text-align:center">ID</th>    
                          <th style="text-align:center">SID</th>                                                 
                          <th style="text-align:left">HR Name</th>                         
                          <th style="text-align:center">HR DOB</th>                      
                          <th style="text-align:center">HR DOE</th>                          
                          <th style="text-align:left">HR Position</th>
                          <th style="text-align:center">BRNAME</th>
                        </tr>
                      </thead>

                      <tbody id="looptr">
                       <?php $i=1;
                       foreach($staff as $row):?>
                        <tr id="tbody" style="text-align:center">
                        
                          <td><?= $i++;?></td>                          
                          <td><?= $row->system_id;?></td> 
                          <td style="text-align:left"><?= $row->staff_nameeng;?></td>                          
                          <td><?= $row->date_of_birth;?></td>                         
                          <td><?= $row->dateemployee;?></td>
                          <td style="text-align:left"><?= $row->position_nameeng;?></td>                                       
                          <td><?= $row->shortcode;?></td>                         
                         
                        </tr>
                       
                        <?php endforeach;?>
                        
                      </tbody>
                    </table>
                    <div>
                    <p><span class="glyphicon glyphicon-volume-up"></span>
                    <span style="margin-left:10px;">
                     ទិន្នន័យនេះធ្វើការផ្ទៀងផ្ទាត់ជាមួយបញ្ចីឈ្មោះរបស់ HR ទៅនិងបុគ្លលិកតាមសាខា
                    </span>
                    </p>
                    </div>
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
 $(document).ready(function(){

   
    $("#Branch").on("change",function(){
            
        var BRCODE=$(this).val();
        if(BRCODE==0)
        {
            location.reload();
        }
        $.getJSON("<?php echo site_url("user/GetStaffComparebyBrCode");?>/"+BRCODE,function(obj)
        {
            var employee='';
            var i=0;
            $.each(obj,function(key,value)
            {
                i++;
                employee+='<tr>';
                employee+="<tr id='tbody' style='text-align:center'>";
                employee+="<td>"+i+"</td>";                          
                employee+="<td>"+value.system_id+"</td>"; 
                employee+="<td style='text-align:left'>"+value.staff_nameeng+"</td>";                         
                employee+="<td>"+value.date_of_birth+"</td>";                         
                employee+="<td>"+value.dateemployee+"</td>";
                employee+="<td style='text-align:left'>"+value.position_nameeng+"</td>";                                       
                employee+="<td>"+value.shortcode+"</td>";                         
                employee+="</tr>";                         
               
            });
            $("#looptr").html(employee);
            $(".pull-right").hide();
        });

        
    });

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
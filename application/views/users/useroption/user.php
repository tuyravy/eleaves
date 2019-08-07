<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
       
          <div class="">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-users" aria-hidden="true"></i><span style="margin-left:10px;color:#73879C;">List of Users</span></h2>
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
                  <div class="row"> 
                    <fieldset class="scheduler-border">
                        <legend></legend>

                            <form class="form-inline" action="<?= site_url('reports/ereportbydate');?>" method="post">
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Staff Name</label>                                  
                                      <input type="text" class="form-control" id="searchstaff" placeholder="Staff Name, (*) for all users"  autocomplete="off">
                                    </div>
                                <button type="submit" class="btn btn-success" style="margin-top:5px;"><i class="fa fa-search"></i><span style="margin-left:5px;">Search</span></button>
                                <a href="<?= site_url('listusers'); ?>" style="margin-top:5px;" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Refresh Page"><span class="glyphicon glyphicon-refresh"></span></a>
                            </form>

                    </fieldset>  
                  </div>

                  <div class="row">   
                  <fieldset class="scheduler-border">
                    <legend></legend> 

                    <div class="row nopadding">
                        <div class="pull-right">
                            <button class="btn btn-primary" onclick="javascript:printDiv('reports')" id="btnPrint"><span class="fa fa-print"></span></button>
                            <span>
                                    <a href="<?php echo site_url('user/addusers');?>" class="btn btn-success"><i class="fa fa-plus"></i> Create
                                    </a>
                            </span>                       
                        </div>
                    </div>
                  <div class="table-responsive">
                   <div id="reports">
                    <table id="datatable-buttons" class="table table-striped table-bordered" >
                      <thead style="border-bottom:2pt solid #22d4ae;">
                        <tr>
                          <th style="text-align:center">ID</th>
                          <th>BrName</th>
                          <th style="text-align:center">BrCode</th>
                          <th>StaffName</th>
                          <th>UserName</th>
                          <th>Position</th>                          
                          <th style="text-align:center">Action</th>
                        </tr>
                      </thead>                   
                      <tbody id="userlist">
                        <?php 
                        $i=1;
                        foreach($users as $row){ ?>
                        <tr id="tbody" style="white-space: nowrap;overflow: hidden;">
                            
                          <td style="text-align:center"><?php echo $i++;?></td>
                          <td><?php echo $row->brName;?></td>
                          <td style="text-align:center"><?php echo $row->brcode;?></td>
                          <td><?php echo $row->staff_nameeng;?></td>
                          <td><?php echo $row->username;?></td>
                          <td><?php echo $row->position_nameeng;?></td>
                          <td style="text-align:center">
                            <a href="<?php echo site_url('setrefreshpassword');?>/<?php echo $row->system_id;?>/<?php echo $row->brcode;?>" class="btn btn-primary btn-xs">
                                <i class="fa fa-refresh"  data-toggle="tooltip" data-placement="top" title="Refresh Password"></i> 
                            </a>

                            <a href="#" id="inantive" data-id="<?php echo $row->user_id;?>" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-ok"  data-toggle="tooltip" data-placement="top" title="Set Inactive"></span> 
                            </a>
                             
                            <a href="#" id="remove" data-id="<?php echo $row->user_id;?>" class="btn btn-danger btn-xs">
                                <span class=" glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Remove User"></span> 
                            </a>
                              
                            <a href="#" class="btn btn-primary btn-xs" id="addmail" data-id="<?php echo $row->user_id;?>"  data-brcode="<?php echo $row->brcode;?>">
                                <span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="top" title="Edit User"></span> 
                            </a>
                             
                          </td>
                        
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                    </div>
                        <div class="pull-right">
                            <div style="margin-top: 25px;margin-bottom: -12px;">
                                <label>Total <span class="label label-default"><?= $total_rows; ?></span>records</label>
                            </div>  
                            <br/>
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                   </div> 
                   </fieldset>
                     </div>   
                   </div>
                </div>
              </div>
            </div>
             
                       
        <!-- /page content -->

                  <div class="modal fade bs-example-modal-sm" id="app" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h5 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> Add Users Level</h5>
                        </div>
                        <form action="<?php echo site_url('user/createuserssendauto')?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                              <label class="sr-only" for="exampleInputEmail3">Email address</label>              
                              <input type="text" class="form-control" id="systemid" name="systemid" placeholder="system id" require="require" readonly="true">
                            </div> 
                            <div class="form-group">
                              <label class="sr-only" for="exampleInputEmail3">Email address</label>              
                              <input type="text" class="form-control" id="brcode" name="brcode" placeholder="brcode" require="require" readonly="true">
                            </div> 
                            <div class="form-group">                              
                                  
                                <select class="form-control typeleaves" name="leavetype" id="leavetype" required="required" autofocus>
                                    
                                    <?php foreach($level as $row){?>
                                          <option value="<?php echo $row->id;?>" selected="selected"><?php echo $row->description;?></option>
                                    <?php }?>
                                    
                                </select>
                             
                            </div>                       
                            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><span style="margin-left:10px;"></span>No</button>
                          <button type="submit" class="btn btn-primary"  id="setapproval" style="margin-top:-5px;"><span class="glyphicon glyphicon-ok"></span><span style="margin-left:10px;"></span>Add Mail</button>
                        </div>
                        </form>
                      </div>
                    </div>
                </div>
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
 <script>
  $(document).ready(function()
    {
      $("#datatable-buttons #userlist").on('click','#addmail',function()
        {
            
            var id=$(this).data('id');
            var brcode=$(this).data('brcode');
            $("#systemid").val(id);          
            $("#brcode").val(brcode);
            $("#app").data('id',id).modal();

            
        });

      $("#searchstaff").on("keyup",function(){

        var query=$("#searchstaff").val();
        if(query=="*"){
          query="All";
        }
        $.getJSON("<?php echo site_url("user/findAllUser");?>/"+query,function(obj)
          {
              var employee='';
              var i=0;
              $.each(obj,function(key,value)
              {
                  i++;
                  employee+='<tr>';
                  employee+="<tr id='tbody'>";
                  employee+="<td style='text-align:center'>"+i+"</td>";                          
                  employee+="<td style='text-align:left'>"+value.brName+"</td>"; 
                  employee+="<td style='text-align:center'>"+value.brcode+"</td>";  
                  employee+="<td style='text-align:left'>"+value.staff_nameeng+"</td>";    
                  
                  employee+="<td>"+value.username+"</td>";                       
                  employee+="<td style='text-align:left'>"+value.position_nameeng+"</td>";                                                         
                  employee+="<td style='text-align:center'><a href='#' id='inantive' data-id="+value.user_id+" class='btn btn-success btn-xs'>";
                  employee+="<span class='glyphicon glyphicon-ok'  data-toggle='tooltip' data-placement='top' title='Set Inactive'></span></a>"; 
                  employee+="<a href='#' id='remove' data-id="+value.user_id+" class='btn btn-danger btn-xs'>";
                  employee+="<span class='glyphicon glyphicon-remove' data-toggle='tooltip' data-placement='top' title='Remove User'></span></a>";
                  employee+="<a href='#' class='btn btn-primary btn-xs' id='addmail' data-id="+value.user_id+"  data-brcode="+value.brcode+">";
                  employee+="<span class='glyphicon glyphicon-edit' data-toggle='tooltip' data-placement='top' title='Edit User'></span></a></td>";
                                                
                  employee+="</tr>";                         
                
              });
              $("#userlist").html(employee);

        });
      });

      $('#userlist').on('click','#inantive',function()
        {
        var id=$(this).data('id');         
          swal({
              title: "Are you sure?",
              text: "",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: 'btn-danger ok',
              confirmButtonText: 'Yes, Inactive it!',
              closeOnConfirm: false,
              closeOnCancel: false
              },  
              function(isConfirm) {
                
                if (isConfirm) {
                  
                      swal("Inactive!", "User has been cancel.", "success");
                      $.ajax({
                      url: "<?php echo site_url('user/setinactiveUser');?>/"+id,
                      type: "POST"
                      })
                      .done(function(data) {
                        swal({
                          title: "Deleted",
                          text: "User has been successfully for set inactive",
                          type: "success"
                        },function() {
                        location.reload();
                        });
                      })
                    
                  } 
                  else {
                      swal("Cancelled", "User has been cancel.)", "error");
                  }
              });         
         
          });

          $('#userlist').on('click','#remove',function()
        {
        var id=$(this).data('id');         
          swal({
              title: "Are you sure?",
              text: "",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: 'btn-danger ok',
              confirmButtonText: 'Yes, delect it!',
              closeOnConfirm: false,
              closeOnCancel: false
              },  
              function(isConfirm) {
                
                if (isConfirm) {
                  
                      swal("Inactive!", "User has been delect.", "success");
                      $.ajax({
                      url: "<?php echo site_url('user/setinactiveUser');?>/"+id,
                      type: "POST"
                      })
                      .done(function(data) {
                        swal({
                          title: "Deleted",
                          text: "User has been successfully delected",
                          type: "success"
                        },function() {
                        location.reload();
                        });
                      })
                    
                  } 
                  else {
                      swal("Cancelled", "User has been cancel.)", "error");
                  }
              });         
         
          });


      });
      
 </script>

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
            
              var table=document.getElementById("userlist");
              var r=0;
              while(row=table.rows[r++])
              {
                var c=6;
                while(cell=row.cells[c++])
                {
                  //cell.innerHTML='[Row='+r+',Col='+c+']'; // do sth with cell
                  cell.innerHTML=""; // do sth with cell

                }
              }
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            
          
        }
    </script>
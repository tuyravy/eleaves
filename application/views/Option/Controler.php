
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
 <script src="<?php echo base_url();?>dist/sweetalert.js"></script>
 <link rel="stylesheet" href="<?php echo base_url();?>dist/sweetalert.css">
  <div class="">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="icon-ok"></i><span style="margin-left:5px;">Regional manager</span></h2>
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
                        <button type="button" class="btn btn-success" id="create-user">Create</button>
                    </div>                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Reginal Name</th>
                          <th>Branch Control</th>
                          <th>Number of Branch</th> 
                          <th style="text-align:center">Action</th>                          
                        </tr>
                      </thead>
                      <tbody id="looptr">
                          <?php foreach($rm as $row){?>
                        <tr>
                            <td><?php echo $row->rid;?></td>
                            <td><?php echo $row->name;?></td>
                            <td><?php echo $row->branch_control;?></td>
                            <td><?php echo $row->rid;?></td>
                            <td align="right">
                                <a href="#" id="edit-user" data-id="<?= $row->rid;?>"><span class="glyphicon glyphicon-edit nopadding" aria-hidden="true"></span></a>
                                <a href="#" data-id="<?= $row->rid;?>" class="sweet-4"><span class="glyphicon glyphicon-remove nopadding" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                          <?php }?>
                      </tbody>
                    </table>
                    <span id="R_Name"></span>
                    <div class="pull-right">
                                <div style="margin-top: 25px;margin-bottom: -12px;">
                                  <label>Total <span class="label label-default"></span>records</label>
                                  </div>  
                                  <br/>
                              <?php echo $this->pagination->create_links(); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div> 
           

            <!--Create New ---->
            <div class="modal fade" id="create-user-dialog" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-user"></span> Add Reginal Manager.</h4>
                    </div>
                    <form action="<?php echo site_url('Controler/AddRmName');?>" method="post" accept-charset="utf-8">
                    <div class="modal-body" style="padding: 5px;">
                          <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                    <input class="form-control" name="FirstName" placeholder="Reginal Name.. Ex.Sorn Sim" type="text" required autofocus />
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                    <input class="form-control" name="sid" placeholder="System ID.. Ex.558" type="text" required autofocus />
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                    <input class="form-control" name="email" placeholder="Email.. Ex.ravy@sahakrinpheap.com.kh" type="email" required autofocus />
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                    <input class="form-control" name="BrControl" placeholder="Branch Code.. Ex.103,501" type="text" required />
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea style="resize:vertical;" name="Description" class="form-control" placeholder="Desciption..." rows="6" name="comment" required></textarea>
                                </div>
                            </div>
                        </div>  
                        <div class="panel-footer" style="margin-bottom:-14px;">
                            <button type="submit" class="btn btn-success">Add</button>
                                <!--<span class="glyphicon glyphicon-ok"></span>-->
                            <input type="reset" class="btn btn-danger" value="Clear" />
                                <!--<span class="glyphicon glyphicon-remove"></span>-->
                            <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Close -->

        <!--Edit ---->
        <div class="modal fade" id="eidt-user-dialog" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-user"></span> Edit Reginal Manager.</h4>
                    </div>
                    <form action="#" method="post" accept-charset="utf-8">
                    <div class="modal-body" style="padding: 5px;">
                          
                          <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                    <input class="form-control" name="FirstName" placeholder="First Name" type="text" required autofocus/>
                                </div>
                                
                                <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                    <input class="form-control" id="lastname" name="lastname" placeholder="Lastname" type="text" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                    <input class="form-control" name="BrControl" placeholder="Branch Control" type="text" required />
                                </div>
                            </div>
                           <span id="R_BrControl"></span>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea style="resize:vertical;" class="form-control" placeholder="Desciption..." rows="6" name="comment" required></textarea>
                                </div>
                            </div>
                        </div>  
                        <div class="panel-footer" style="margin-bottom:-14px;">
                            <input type="submit" class="btn btn-success" value="Add"/>
                                <!--<span class="glyphicon glyphicon-ok"></span>-->
                            <input type="reset" class="btn btn-danger" value="Clear" />
                                <!--<span class="glyphicon glyphicon-remove"></span>-->
                            <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Close -->
        
           
<style>
        a.btn
        {
            padding-bottom:0px !important;
            padding-top:0px !important;
        }
        td a
        {
            padding:2px !important;
        }
       
</style>
<script>
    $(document).ready(function()
    {
        $("#create-user").on("click",function()
        {
           $("#create-user-dialog").modal("show");
        });
        $("#datatable-buttons #looptr").on("click","#edit-user",function()
        {
                var id=$(this).data('id');
                    $.ajax({
                        url: "<?= site_url('Controler/getEidtRm');?>", 
                        success: function(result){                    
                        alert(result);
                        }
                    });
                    //$("#eidt-user-dialog").modal("show");
                   
        })    
        
    })
</script>
<script>
 $(document).ready(function()
    {
    $("#datatable-buttons #looptr").on("click",".sweet-4",function()
        {
            var id=$(this).data('id');
            var link = "<?php echo site_url('Controler/deleteRmName');?>/"+id;
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
                    onclick=function(){
                        var link = "<?php echo site_url('Controler/deleteRmName');?>/"+id;
                        $("success").attr('href', link);
                    }
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
 
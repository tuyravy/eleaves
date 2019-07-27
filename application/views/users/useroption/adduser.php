<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
       
          <div class="">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-users" aria-hidden="true"></i><span style="margin-left:10px;color:#73879C;">List of Users New</span></h2>
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
                                    <label for="exampleInputName2">BrName</label>
                                    <?php if(isset($start)){?>
                                    <input type="text" class="form-control" name="datestart" id="datestart" value="<?php echo $start;?> "placeholder="Start" autocomplete="off">
                                    <?php }else{?>
                                    <input type="text" class="form-control" name="datestart" id="datestart" placeholder="Start" autocomplete="off">
                                    <?php }?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">StaffName</label>
                                    <?php if(isset($end)){?>
                                    <input type="text" class="form-control" name="dateend" id="dateend" placeholder="End"  value="<?php echo $end;?>" autocomplete="off">
                                    <?php }else{?>
                                    <input type="text" class="form-control" name="dateend" id="dateend" placeholder="End" autocomplete="off">
                                    <?php }?>
                                    </div>
                                <button type="submit" class="btn btn-success" style="margin-top:5px;"><i class="fa fa-search"></i><span style="margin-left:5px;">Search</span></button>
                                <a href="<?= site_url('user/addusers'); ?>" style="margin-top:5px;" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Refresh Page"><span class="glyphicon glyphicon-refresh"></span></a>
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
                                    <a href="<?php echo site_url('listusers');?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> back
                                    </a>
                            </span>                       
                        </div>
                    </div>
                  <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered" >
                      <thead style="border-bottom:2pt solid #22d4ae;">
                        <tr>
                          <th style="text-align:center">ID</th>
                          <th>BrName</th>
                          <th style="text-align:center">BrCode</th>
                          <th>StaffName</th>
                          <th>SystemID</th>
                          <th>UserName</th>
                          <th>Position</th>                          
                          <th style="text-align:center">Action</th>
                        </tr>
                      </thead>                   
                      <tbody id="userlist">
                        <?php 
                        $i=1;
                        foreach($users as $row){ ?>
                        <tr id="tbody">
                            
                          <td style="text-align:center"><?php echo $i++;?></td>
                          <td><?php echo $row->brName;?></td>
                          <td style="text-align:center"><?php echo $row->brcode;?></td>
                          <td><?php echo $row->staff_nameeng;?></td>
                          <td><?php echo $row->system_id;?></td>
                          <td><?php echo $row->username;?></td>
                          <td><?php echo $row->position_nameeng;?></td>
                          <td style="text-align:center">
                            <!-- <a href="#" id="approvel" data-id="<?php echo $row->user_id;?>" class="btn btn-success btn-xs">
                                <i class="fa fa-send"  data-toggle="tooltip" data-placement="top" title="Send email"></i> 
                            </a>                             -->
                        
                            <a href="#" class="btn btn-primary btn-xs" id="addmail" data-sid="<?php echo $row->system_id;?>" data-brcode="<?php echo $row->brcode;?>">
                                <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add user"></i> 
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
                   </fieldset>
                     </div>   
                   </div>
                </div>
              </div>
            </div>
             
            <div class="modal fade bs-example-modal-sm" id="app" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> Add Mail Users</h5>
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
                            <label class="sr-only" for="exampleInputEmail3">Email address</label>              
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" require="require">
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
              
        <!-- /page content -->

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
            var sid=$(this).data('sid');
            var id=$(this).data('id');
            var brcode=$(this).data('brcode');
            $("#systemid").val(sid);          
            $("#brcode").val(brcode);
            $("#app").data('id',id).modal();

            
        });
       
    });          
</script>
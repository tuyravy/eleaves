<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
<div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-users" aria-hidden="true"></i><span style="margin-left:10px;">User Controler</span><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <!--<ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>-->
                          
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                        <p style="font-weight:bold">1.<span style="margin-left:10px;">List Of Users HOSKP</span></p>
                        <table class="table table-striped table-bordered" id="datatable-buttons">
                        <thead>
                        <tr>
                            <th style="text-align:center">N<sup>o</sup></th> 
                            <th style="text-align:center">BrName</th>  
                            <th style="text-align:center">Name In tblUser</th>  
                            <th style="text-align:center">Name In tblStaff</th>                          
                            <th style="text-align:center">Username</th>
                            <th style="text-align:center">SystemID</th>
                            <th style="text-align:center">Alert MSG</th>
                            <th style="text-align:center">Status</th>
                        </tr>
                      </thead>
                        <?php
                             $a=0;foreach($alluser as $row):
                              $a++;
                          ?>
                        <tr style="text-align:center">
                            <td><?php echo $a;?></td>
                            <td><?php echo $row->BrName;?></td>
                            <td><?php echo $row->full_name;?></td>
                            <td><?php echo $row->staff_name;?></td>
                            <td><?php echo $row->username;?></td>
                            <td><?php echo $row->system_id;?></td>
                            <td><?php if($row->keys==1){ echo "Refresh Already";}else{ echo "";};?></td>
                            <td>
                                
                                <span style="padding:5px;" data-toggle="tooltip" data-placement="top" title="Refresh Password"><a href="<?php echo site_url('user/refreshpassword')?>/<?php echo $row->system_id;?>"><i class="icon-share-sign"></i></a></span>
                                <span style="padding:5px;" data-toggle="tooltip" data-placement="top" title="Send To User"><a href="<?php echo site_url('setrefreshpassword');?>/<?php echo $row->system_id;?>"><i class="icon-envelope"></i></a></span>
                                
                               
                             </td>
                            
                        </tr>
                        <?php endforeach;?>
                      
                        </table>
                        </br>
                        <p style="font-weight:bold">2.<span style="margin-left:10px;">List Of Staff don't have Users HOSKP</span></p>
                        <table class="table table-striped table-bordered" id="datatable-buttons1">
                        <thead>
                        <tr class="active">
                            <th style="text-align:center">N<sup>o</sup></th>
                            <th style="text-align:center">BrName</th> 
                            <th style="text-align:center">StaffName</th>  
                            <th style="text-align:center">Position</th>                           
                            <th style="text-align:center">Username</th>
                            <th style="text-align:center">SystemID</th>
                            <th style="text-align:center">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                             $b=0;foreach($allstaff as $row):
                              $b++;
                          ?>
                        <tr style="text-align:center" id="tbody">
                            <td><?php echo $b;?></td>
                            <td><?php echo $row->shortcode;?></td>                            
                            <td><?php echo $row->staff_nameeng;?></td>
                            <td><?php echo $row->position_nameeng;?></td>
                            <td><?php echo $row->username;?></td>
                            <td><?php echo $row->system_id;?></td>
                            <td>
                            <span style="padding:5px;" data-toggle="tooltip" data-placement="top" title="Add Mail User"><a href="#" id="addmail" data-id='<?php echo $row->system_id; ?>'><i class="icon-edit"></i></span>
                            
                            </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                        </table>
                        </br>
                        <p style="font-weight:bold">3.<span style="margin-left:10px;">Branch Manager Different Users HOSKP</span></p>
                        <table class="table table-striped table-bordered" id="datatable-buttons2">
                        <thead>
                        <tr class="active">
                            <th style="text-align:center">N<sup>o</sup></th>
                            <th style="text-align:center">BrName</th> 
                            <th style="text-align:center">tblStaffName</th>
                            <th style="text-align:center">tblUsers</th>                                                       
                            <th style="text-align:center">Username</th>
                            <th style="text-align:center">SystemID</th>
                            <th style="text-align:center">Alert MSG</th>  
                            <th style="text-align:center">Status</th>
                        </tr>
                      </thead>
                        <?php
                             $b=0;foreach($staffdif as $row):
                              $b++;
                          ?>
                        <tr style="text-align:center" id="tbody">
                            <td><?php echo $b;?></td>
                            <td><?php echo $row->BrName;?></td>                            
                            <td><?php echo $row->staff_name;?></td> 
                            <td><?php echo $row->full_name;?></td>                           
                            <td><?php echo $row->username;?></td>
                            <td><?php echo $row->system_id;?></td>
                            <td><?php echo $row->status;?></td>
                            <td>
                            <span style="padding:5px;" data-toggle="tooltip" data-placement="top" title="Eidt Users"><a href="#" id="EditUser" data-id='<?php echo $row->system_id; ?>'><i class="icon-edit"></i></a></span>
                            
                        </tr>
                        <?php endforeach;?>
                        </table>
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
                        <h4 class="modal-title" id="myModalLabel">Add Mail Users</h4>
                      </div>
                      <form action="<?php echo site_url('user/createuserssendauto')?>" method="post">
                      <div class="modal-body">
                          <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail3">Email address</label>              
                            <input type="text" class="form-control" id="systemid" name="systemid" placeholder="system id" require="require">
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


                <div class="modal fade bs-example-modal-sm" id="appEditUser" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Users</h4>
                      </div>
                      <form action="<?php echo site_url('user/createuserssendauto')?>" method="post">
                      <div class="modal-body">
                          <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail3">Email address</label>              
                            <input type="text" class="form-control" id="systemid" name="systemid" placeholder="system id" require="require"
                            >
                          </div> 
                          <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail3">Email address</label>              
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" require="require">
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


    <script>
        $(document).ready(function()
        {
            $("#datatable-buttons1 #tbody").on('click','#addmail',function()
            {
                var id=$(this).data('id');
                $("#app").data('id',id).modal();
            });
            $("#datatable-buttons2 #tbody").on('click','#EditUser',function()
            {
                var id=$(this).data('id');
                $("#appEditUser").data('id',id).modal();
               
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
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons1").length) {
            $("#datatable-buttons1").DataTable({
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
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons2").length) {
            $("#datatable-buttons2").DataTable({
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
            


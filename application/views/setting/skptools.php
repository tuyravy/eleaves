<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
       
          <div class="">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Management SKP_Tools</h2>
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
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>PC Name</th>
                          <th>Erorrs1</th>
                          <th>Erorrs2</th>
                          <th>Erorrs3</th>
                          <th>Erorrs4</th>
                          <th>Erorrs5</th>
                          <th>Erorrs6</th>
                          <th>Erorrs7</th>
                          <th>Erorrs8</th>
                          <th>Erorrs9</th>
                          <th>Erorrs10</th>
                          <th>BrCode</th>
                          <th>BrName</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                     

                      <tbody>
                       <?php 
                          foreach($stools as $row){
                          ?>
                        <tr id="tbody">
                           <td><?php echo $row->pcname;?></td> 
                           <td><?php echo $row->errors1;?></td>
                           <td><?php echo $row->errors2;?></td>
                           <td><?php echo $row->errors3;?></td>
                           <td><?php echo $row->errors4;?></td> 
                           <td><?php echo $row->errors5;?></td>
                           <td><?php echo $row->errors6;?></td>
                           <td><?php echo $row->errors7;?></td>
                           <td><?php echo $row->errors8;?></td> 
                           <td><?php echo $row->errors9;?></td>
                           <td><?php echo $row->errors10;?></td>
                           <td><?php echo $row->brcode;?></td>
                           <td><?php echo $row->brname;?></td>
                           <td><?php echo $row->pcname;?></td>
                        </tr>
                       <?php }?>
                         
                      </tbody>
                    </table>
                         
                     </div>   
                   </div>
                </div>
              </div>
            
              <style>#in{text-align: center;}</style>
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
              
              
              <div class="modal fade bs-example-modal-lg" id="de" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">View History leaves</h4>
                                      </div>
                                      <div class="modal-body">
                                        
                                         <div id='showhistory'>
                                          
                                         </div>
                                          
                                          
                                      </div>
                                      <div class="modal-footer">
                                        <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><span style="margin-left:10px;"></span>Close</button>
                                      </div>
                                </div>
                              </div>
                         </div>

              
              
        <!-- /page content -->

<script type="text/javascript">
$(function() {
    $('input[name="datestart"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
        
    },
    
    function(start, end, label) {
        var years = moment().diff(start, 'years');
        
    });
});
$(function() {

    $('input[name="dateend"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    },
    function(start, end, label) {
        var years = moment().diff(start, 'years');
        
    });
});
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
                var link = "<?php echo site_url('Request_leaves_Controller/setapprovelleaves');?>/"+id;
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
                var link = "<?php echo site_url('Request_leaves_Controller/setrejectleaves');?>/"+id;
                $("#setreject").attr('href', link);
            })
             $("#datatable-buttons #tbody").on('click','#detail',function()
            {
                var id=$(this).data('id');
                $('#showhistory').load("<?php echo site_url('Request_leaves_Controller/showhistoryleaves');?>/"+id);
                $("#de").data('id',id).modal();
                
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
    </script>
    <!-- /Datatables -->
   <!--<?php echo site_url('Request_leaves_Controller/setapprovelleaves');?>/<?php echo $row->le_id;?>-->
    

   
    
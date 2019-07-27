<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
       
          <div class="">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2><i class="fa fa-floppy-o" aria-hidden="true"></i><span style="margin-left:10px;color:#73879C">Views Detail Eleaves</span></h2>
                        <span style="margin-left:10px;">
                                <a href="<?php echo site_url('approve_leaves');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left">
                                </span><span style="margin-left:10px;">Back</span>
                                </a>
                        </span>
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
                        <button class="btn btn-primary" onclick="javascript:printDiv('reports')" id="btnPrint"><span class="fa fa-print"></span></button>
                        <span>
                                <a href="<?php echo site_url('reports/approveleaves');?>" class="btn btn-danger"><span class="glyphicon glyphicon-arrow-left">
                                </span><span style="margin-left:10px;">Back</span>
                                </a>
                        </span>
                        <p></p>
                  </div>

                  <div id="reports">
                    <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12"> 
                        <img src="<?php echo base_url();?>public/img/SKPletterheadLandscape.png" class="img-responsive center" alt="Cinque Terre"  id="logo" style="width:50%;">             
                          <h2 id="in" style="text-align:center;">View Eleaves Detail</h2>
                          <p id="in" style="text-align:center">Reports Date:
                          <?php if(isset($start)){echo $start;}else{echo $start;}?>
                            <span style="margin-left:10px;">
                                To:<span style="margin-left:10px;">
                                   <?php if(isset($end)){echo $end;}else{echo $end;}?>
                                   </span>
                            </span>                              
                          </p>
                      </div> 
                      

                    </div> 
                    <br/>
                  <div class="row">   
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr style="border-bottom:2pt solid #22d4ae;">
                         
                          <th>Request Date</th>
                          <th>Leave_Start</th>
                          <th>Leave_End</th>
                          <th>Leave_Types</th>
                          <th>Duration</th>
                          <th>Status</th>
                          <th>Description</th>
                          <th>Documents</th>
                          
                        </tr>
                     

                      <tbody>
                        <?php
                          
                           
                           foreach($viewdetail as $row){
                          ?>
                        <tr id="tbody">
                         
                          <td><?php echo $row->requestdate;?></td>
                          <td><?php echo $row->startdate;?></td>
                          <td><?php echo $row->enddate;?></td>
                          <td>
                              <p><?php echo $row->name;?></p>
                          </td>
                          <td>
                                <p><?php echo $row->duration;?></p>                               
                          </td>
                          <td><?php switch($row->status){case 1:echo  "Pending";break;case 2: "Approved";break;case 3:echo "Rejected";break;};?></td>
                          <td><?php echo $row->cause;?></td>
                          <td>
                            
                                <a href="#" id="detail" data-id="<?php echo $row->lid;?>">View</a>
                             
                          </td>
                        
                        </tr>
                          
                        <?php }?>
                         
                      </tbody>
                    </table>
                          <div class="col-sm-12">
                            <p>ថ្ងៃទី......ខែ.....ឆ្នាំ...<?php echo date('Y');?>..</p>
                            <p style="margin-left:40px;">ហត្ថលេខា</p>
                            <p>................................</p>
                            <p><span style="margin-left:30px;"><?php echo $this->session->userdata('fullname');?></span></p>
                           <br/>

                         </div>
                     </div>   
                   </div>
                </div>
              </div>
                  <style>
                      #in{text-align: center;}
                      #showhistory{height:470px;}
                  </style>
            </div>
              
              <div class="modal fade bs-example-modal-lg" id="de" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">View History leaves</h4>
                                      </div>
                                      <div class="modal-body">
                                        
                                         <div id='showhistory' class="row">
                                          
                                             
                                         </div>
                                          
                                      </div>
                                      <div class="modal-footer">
                                        <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><span style="margin-left:10px;"></span>Close</button>
                                      </div>
                                </div>
                              </div>
                         </div>

<style>
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
          }
</style>
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
              document.getElementById("logo").style.display= "inline-block"; 
              document.getElementById("logo").style.margin = "0px 100px 10px 250px"; 
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            
          
        }
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
                 
                $('#showhistory').load("<?php echo site_url('reports/showhistoryleaves');?>/"+id);
                $("#de").data('id',id).modal();
                
            });
            
        });          
    </script>
    

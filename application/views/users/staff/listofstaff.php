<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>       
          <div class="">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-users" aria-hidden="true"></i><span style="margin-left:10px;">Staffs Information</span></h2>
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
                                <a href="<?= site_url('liststaff'); ?>" style="margin-top:5px;" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Refresh Page"><span class="glyphicon glyphicon-refresh"></span></a>
                            </form>

                    </fieldset>  
                  </div>

                  <div class="row">  
                  <fieldset class="scheduler-border">
                    <legend></legend> 
                    <div class="row nopadding">
                        <div class="pull-right">
                            <button class="btn btn-primary" onclick="javascript:printDiv('reports')" id="btnPrint"><span class="fa fa-print"></span></button>
                                                
                        </div>
                    </div>
                  <div class="table-responsive" id="reports">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr style="border-bottom:2pt solid #22d4ae;white-space: nowrap;overflow: hidden;">
                          <th>Staff Name</th>
                          <th>Position</th>
                          <th>BrName</th>
                          <th>Gender</th>
                          <th>Employee Date</th>
                          <th>Date of Brith</th>
                          <th>Phone Number</th>
                          <th>Degree</th>
                          <th style="text-align:center">Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>                     

                      <tbody id="stafflist">
                       <?php 
                         
                          foreach($listofstaff as $row){
                        ?>
                        <tr id="tbody">
                          <td><?php echo $row->staff_nameeng;?></td>
                          <td><?php echo $row->position_nameeng;?></td>
                          <td><?php echo $row->shortcode;?></td>
                          <td><?php echo $row->sex;?></td>
                          <td><?php echo $row->dateemployee;?></td>
                          <td><?php echo $row->date_of_birth;?></td>
                          <td><?php echo $row->phone_number;?></td>
                          <td><?php echo $row->degree;?></td>
                          <td><span class="badge bg-green"><?php switch($row->active)
                                {
                            case 1:
                                echo "Staff Active";
                            
                            break;
                            case 0:
                                echo "Staff In-Active";
                                }?>
                              </span>
                          </td>
                          
                          <td align="center">
                            <?php
                              if($row->active==1){
                            ?> 
                           <a href="<?php echo site_url('user/setinactive')?>/<?php echo $row->system_id;?>" >
                           
                                <span class="glyphicon glyphicon-ok" data-toggle="tooltip" data-placement="top" title="Set Inactive"></span> 
                            </a>
                            <?php }else{?>
                             <a href="<?php echo site_url('user/setactive')?>/<?php echo $row->system_id;?>" >
                           
                                <span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Set Active"></span> 
                            </a>
                              
                            <?php }?>
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
                  </fieldset>
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
                

                
         </div>     
              
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
                var link = "<?php echo site_url('user/setinactive');?>/"+id;
                $("#setreject").attr('href', link);
            })
             $("#datatable-buttons #tbody").on('click','#detail',function()
            {
                var id=$(this).data('id');
                $('#showhistory').load("<?php echo site_url('Request_leaves_Controller/showhistoryleaves');?>/"+id);
                $("#de").data('id',id).modal();
                
            });

            $("#searchstaff").on("keyup",function(){

              var query=$("#searchstaff").val();
              var beasurl="<?php echo site_url('user/setinactive')?>";
              var beasurlactive="<?php echo site_url('user/setactive')?>";
              if(query=="*"){
                query="All";
              }
                $.getJSON("<?php echo site_url("user/findStaff");?>/"+query,function(obj)
                  {
                      var employee='';
                      var i=0;
                      $.each(obj,function(key,value)
                      {
                          i++;
                          employee+='<tr>';
                          employee+="<tr id='tbody'>";                                                  
                          employee+="<td style='text-align:left'>"+value.staff_nameeng+"</td>"; 
                          employee+="<td style='text-align:left'>"+value.position_nameeng+"</td>";  
                          employee+="<td style='text-align:left'>"+value.brName+"</td>";    
                          
                          employee+="<td>"+value.gender+"</td>";                       
                          employee+="<td style='text-align:left'>"+value.dateemployee+"</td>";     
                          employee+="<td style='text-align:left'>"+value.date_of_birth+"</td>";    
                          employee+="<td style='text-align:left'>"+value.degree+"</td>";  
                          employee+="<td style='text-align:left'>"+value.phone_number+"</td>";     
                          employee+="<td style='text-align:left'></td>"; 
                          employee+="<td style='text-align:center'>";
                          if(value.active==1){ 
                            employee+="<a href="+beasurl+"/"+value.system_id+">";
                            employee+="<span class='glyphicon glyphicon-ok' data-toggle='tooltip' data-placement='top' title='Set Inactive'></span></a>"; 
                            
                          }else{
                            employee+="<a href="+beasurlactive+"/"+value.system_id+">";
                            employee+="<span class='glyphicon glyphicon-remove' data-toggle='tooltip' data-placement='top' title='Set active'></span></a>"; 
                          }                      
                                           
                          employee+="</tr>";                         
                        
                      });
                      $("#stafflist").html(employee);

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
            
              var table=document.getElementById("stafflist");
              var r=0;
              while(row=table.rows[r++])
              {
                var c=9;
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
    

   
    
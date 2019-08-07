            <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="x_panel">
                    <div class="x_title">
                      <h2><i class="fa fa-envelope" aria-hidden="true"></i><span style="margin-left:10px;">Email Configuration</span></h2>
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
                                <div class="table-responsive"> 
                                                        
                                        <ul class="nav nav-tabs" role="tablist">
                                        <li class="active"><a href="<?= site_url('email');?>">Email HR</a></li>
                                        <li ><a href="<?= site_url('admin_email');?>">Administrator Email</a></li>
                                        <li ><a href="<?= site_url('email_config');?>">Email Config</a></li>
                                        </ul>

                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="home">
                                            <br/>
                                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr style="border-bottom:2pt solid #22d4ae;">
                                                            <th style="text-align:center">Id</th>
                                                            <th>Email list</th>
                                                            <th>HR Name</th>
                                                            <th>Event Name</th>
                                                            <th style="text-align:center">Status</th>   
                                                            <th style="text-align:center">Action</th>                                                     
                                                        </tr>
                                                    </thead>
                                                    <?php foreach($hremail as $row){?>                                         
                                                        <tr>
                                                            <td style="text-align:center;vertical-align:middle"><?php echo $row->id;?></td>
                                                            <td style="vertical-align:middle"><?php echo $row->email;?></td>
                                                            <td style="vertical-align:middle"><?php echo $row->hr_name;?></td>
                                                            <td style="vertical-align:middle"><?php echo $row->event;?></td>
                                                            <td style="text-align:center;vertical-align:middle"><span class="badge bg-green"><?php if($row->flag==1){echo "Can send/Revceive";}else{echo "Can't Send/Revceive";}?></span></td>
                                                            <td style="text-align:center;vertical-align:middle">
                                                                <button type="button" class="btn btn-primary btn-xs" id="edit" data-email="<?php echo $row->email;?>" data-hrname="<?php echo $row->hr_name;?>" data-event="<?php echo $row->event;?>"><i class="fa fa-edit"></i> Edit</button>
                                                                <button type="button" class="btn btn-danger btn-xs" id="event"><i class="fa fa-calendar"></i> Event</button>
                                                            </td>
                                                        </tr>
                                                    <?php }?>

                                                    <tbody>                                         
                                                    </tbody>
                                            </table>                                     
                                        </div>    
                                    </div>
                                </div>                   
                            </fieldset>
                    </div>                   
                </div>
        </div>
    </div>                                  
    <!-- Edit Email -->
    <!-- Modal -->
        <div class="modal fade" id="EditEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> E-mail List</h4>
            </div>
            <form action="<?php echo site_url('Configuration/edit_Email');?>" method="post">
            <div class="modal-body">               
               
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email (Ex.ravy@gmail.com,umbro@gmail.com)</label>
                        <textarea rows="3" class="form-control" name="email_list" id="emaillist" required="required"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Event Name</label>
                        <textarea rows="3" class="form-control" name="event" id="eventlist" required="required"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">HR Name</label>
                        <input type="text" class="form-control" id="hrname" name="HRName" required="required" placeholder="HR Name">
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="optionsRadios1" value="1" checked>
                             Active
                        </label>
                        <label>
                            <input type="radio" name="status" id="optionsRadios1" value="0">
                             Inactive
                        </label>
                    </div>                   
                    
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary" style="margin-top:-5px;"><i class="fa fa-edit"></i> Edit</button>
            </div>
            </form>
            </div>
        </div>
        </div>
    <!---Edit Email-->


     <!-- Event Email -->
    <!-- Modal -->
    <div class="modal fade" id="EventEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> Event Send</h4>
            </div>
            
            <div class="modal-body">              
            <form>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="blankRadio" id="blankRadio1" value="option1" checked>
                        Request leaves
                        <p>Email Send Auto to manager when has transaction leaves and send to cc hr email.</p>
                    </label>
                        
                </div>          
                    
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="blankRadio" id="blankRadio1" value="option1" checked>
                        Cancel leaves
                        <p>Email Send Auto to manager when has cancel transaction leaves and send to cc hr email.</p>
                    </label>
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="blankRadio" id="blankRadio1" value="option1" checked>
                        Reject leaves
                        <p>Email Send Auto to manager when has Reject transaction leaves and send to cc hr email.</p>
                    </label>
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="blankRadio" id="blankRadio1" value="option1" checked>
                        Approved leaves
                        <p>Email Send Auto to manager when has Approved transaction leaves and send to cc hr email.</p>
                    </label>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                
            </div>
            
            </div>
        </div>
        </div>
    <!---Edit Email-->


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
            
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            
          
        }
    </script>
    <script>
        $(document).ready(function()
        {
            $("#edit").on("click",function()
            {
                var emaillist=$(this).data('email');
                var hrname=$(this).data('hrname'); 
                var event=$(this).data('event');
                              
                $("#EditEmail").modal();
                $("#emaillist").val(emaillist);
                $("#hrname").val(hrname);
                $("#eventlist").val(event);

            });
            $("#event").on("click",function()
            {
                $("#EventEmail").modal();
                
            });
            $("#datatable-buttons #tbody").on('click','#approvel',function()
            {
                var id=$(this).data('id');
                $("#app").data('id',id).modal();
            });
            $('#app').on('click','#setapproval',function()
            {
                var id=$('#app').data('id');
                var link = "<?php echo site_url('reports/setapprovelleaves');?>/"+id;
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
                var link = "<?php echo site_url('reports/setrejectleaves');?>/"+id;
                $("#setreject").attr('href', link);
            })
             
            
        });          
    </script>
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
                                        <li><a href="<?= site_url('email');?>">Email HR</a></li>
                                        <li class="active"><a href="<?= site_url('admin_email');?>">Administrator Email</a></li>
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
                                                        <th>Event Name</th>
                                                        <th style="text-align:center">Status</th>   
                                                        <th style="text-align:center">Action</th>                                                     
                                                        </tr>
                                                    </thead>
                                                    <?php foreach($adminemail as $row){?>                                         
                                                        <tr>
                                                            <td style="text-align:center"><?php echo $row->id;?></td>
                                                            <td><?php echo $row->email;?></td>
                                                            <td><?php echo $row->event;?></td>
                                                            <td style="text-align:center"><span class="badge bg-green"><?php if($row->flag==1){echo "Can send/Revceive";}else{echo "Can't Send/Revceive";}?></span></td>
                                                            <td style="text-align:center">
                                                                <button type="button" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</button>
                                                                <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-calendar"></i> Event</button>
                                                                <button type="button" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> View</button>
                                                            </td>
                                                        </tr>
                                                    <?php }?>
                                            </table>                                     
                                        </div>    
                                    </div>
                                </div>                   
                            </fieldset>
                    </div>                   
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
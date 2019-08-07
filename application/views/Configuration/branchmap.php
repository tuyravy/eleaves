<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="x_panel">
                    <div class="x_title">
                      <h2><i class="fa fa-envelope" aria-hidden="true"></i><span style="margin-left:10px;">Branch Configuration</span></h2>
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
                                        <li><a href="<?= site_url('brnachlist');?>"><i class="fa fa-list"></i> Branch list</a></li>
                                        <li class="active"><a href="<?= site_url('brnachmap');?>"><i class="fa fa-map-marker"></i> Branch Map</a></li>
                                        </ul>

                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="home">
                                            <br/>
                                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr style="border-bottom:2pt solid #22d4ae;">
                                                        <th style="text-align:center">Id</th>
                                                        <th>BrName</th>
                                                        <th>BrNamekh</th>
                                                        <th>BrCode</th>
                                                        <th>GIS Code</th>
                                                        <th style="text-align:center">Status</th>   
                                                        <th style="text-align:center">Action</th>                                                     
                                                        </tr>
                                                    </thead>
                                                    
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

<script src="<?php echo base_url(); ?>public/vendors/jquery/dist/jquery.min.js"></script>

<div class="">
    <div class="clearfix"></div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-floppy-o" aria-hidden="true"></i><span style="margin-left:10px;color:#73879C">Leave Balance</span></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead style="border-bottom:2pt solid #22d4ae;"> 
                            <tr>
                                <th rowspan="2" style="vertical-align: middle;">Staff Name</th>
                                <th rowspan="2" style="vertical-align: middle;">Position</th>
                                <th rowspan="2" style="vertical-align: middle;">Gender</th>
                                <th colspan="5" id="in">Beginning Balance</th>
                                <th colspan="5" id="in">Using Balance</th>
                                <th colspan="5" id='in'>Ending Balance</th>
                            </tr>
                            <tr style="border-bottom:2pt solid #22d4ae;">
                                <td id="smail">UNL</td>
                                <td id="smail">MTL</td>
                                <td id="smail">SPL</td>
                                <td id="smail">SIL</td>
                                <td id="smail">ANL</td>
                                <td id="smail">UNL</td>
                                <td id="smail">MTL</td>
                                <td id="smail">SPL</td>
                                <td id="smail">SIL</td>
                                <td id="smail">ANL</td>
                                <td id="smail">UNL</td>
                                <td id="smail">MTL</td>
                                <td id="smail">SPL</td>
                                <td id="smail">SIL</td>
                                <td id="smail">ANL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $year=date('Y');
                            $CI =& get_instance();                       
                                
                            foreach ($balance as $row) {
                                ?>
                                <tr id="tbody">
                                    <td id="smail"><?php echo $row->staff_nameeng; ?></td>
                                    <td><?php echo $row->position_nameeng; ?></td>
                                    <td><?php echo $row->sex; ?></td>
                                    <td><?php echo $row->Unpaid; ?></td>
                                    <td><?php echo $row->Maternity; ?></td>
                                    <td><?php echo $row->Special; ?></td>
                                    <td><?php echo $row->Sick; ?></td>
                                    <td><?php echo $row->Annual; ?></td>
                                    <td><?php echo $CI->Reports_model->GetDuraionLeaves($row->system_id,1,$year); ?></td>
                                    <td><?php echo $CI->Reports_model->GetDuraionLeaves($row->system_id,2,$year); ?></td>
                                    <td><?php echo $CI->Reports_model->GetDuraionLeaves($row->system_id,3,$year); ?></td>
                                    <td><?php echo $CI->Reports_model->GetDuraionLeaves($row->system_id,4,$year); ?></td>
                                    <td><?php echo $CI->Reports_model->GetDuraionLeaves($row->system_id,5,$year); ?></td>
                                    <td><?php echo ($row->Unpaid) - ($CI->Reports_model->GetDuraionLeaves($row->system_id,1,$year)); ?></td>
                                    <td><?php echo ($row->Maternity) - ($CI->Reports_model->GetDuraionLeaves($row->system_id,2,$year)); ?></td>
                                    <td><?php echo ($row->Special) - ($CI->Reports_model->GetDuraionLeaves($row->system_id,3,$year)); ?></td>
                                    <td><?php echo ($row->Sick) - ($CI->Reports_model->GetDuraionLeaves($row->system_id,4,$year)); ?></td>
                                    <td><?php echo ($row->Annual) - ($CI->Reports_model->GetDuraionLeaves($row->system_id,5,$year)); ?></td>
                                </tr>
                            <?php } ?>
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
                <br><br>
                <ul>
                    <li><label>UNL:</label> Unpaid Leave</li>
                    <li><label>MTL:</label> Maternity Leave</li>
                    <li><label>SPL:</label> Special Leave</li>
                    <li><label>SIL:</label> Sick Leave</li>
                    <li><label>ANL:</label> Annual Leave</li>
                </ul>

            </div>
            </fieldset>
          </div>
        </div>
    
</div>
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
    <style>#in{
            text-align:center;
            line-height:40px;
        }
        #smail{font-size:12px;}
    </style>           

    <!-- /page content -->

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
    





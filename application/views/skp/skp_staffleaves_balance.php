<script src="<?php echo base_url(); ?>public/vendors/jquery/dist/jquery.min.js"></script>

<div class="">
    <div class="clearfix"></div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-floppy-o" aria-hidden="true"></i><span style="margin-left:10px;">Leave Balance</span></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;">Staff Name</th>
                            <th rowspan="2" style="vertical-align: middle;">Position</th>
                            <th rowspan="2" style="vertical-align: middle;">Gender</th>
                            <th colspan="5" id="in">Beginning Balance</th>
                            <th colspan="5" id="in">Using Balance</th>
                            <th colspan="5" id='in'>Ending Balance</th>
                        </tr>
                        <tr>
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
                        $brcode = $this->session->userdata('branch_code');
                        $role =0;
                        $system_id = $this->session->userdata('system_id');
                        $subcode = $this->session->userdata('subbranch');
                        $balance = $this->Reports_model->gelAllleavesbalance($brcode, $role, $system_id, $subcode);
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
                                <td><?php echo $row->useingUnpaid; ?></td>
                                <td><?php echo $row->useingMaternity; ?></td>
                                <td><?php echo $row->useingspecial; ?></td>
                                <td><?php echo $row->useingSick; ?></td>
                                <td><?php echo $row->useingAnnual; ?></td>
                                <td><?php echo ($row->Unpaid) - ($row->useingUnpaid); ?></td>
                                <td><?php echo ($row->Maternity) - ($row->useingMaternity); ?></td>
                                <td><?php echo ($row->Special) - ($row->useingspecial); ?></td>
                                <td><?php echo ($row->Sick) - ($row->useingSick); ?></td>
                                <td><?php echo ($row->Annual) - ($row->useingAnnual); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br><br>
                <ul>
                    <li><label>UNL:</label> Unpaid Leave</li>
                    <li><label>MTL:</label> Maternity Leave</li>
                    <li><label>SPL:</label> Special Leave</li>
                    <li><label>SIL:</label> Sick Leave</li>
                    <li><label>ANL:</label> Annual Leave</li>
                </ul>

            </div>
        </div>
    </div>

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
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><span style="margin-left:10px;"></span>Close</button>
                </div>
            </div>
        </div>
    </div>

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
    <script>
        $(document).ready(function ()
        {
            $("#datatable-buttons #tbody").on('click', '#approvel', function ()
            {
                var id = $(this).data('id');
                $("#app").data('id', id).modal();
            });
            $('#app').on('click', '#setapproval', function ()
            {
                var id = $('#app').data('id');
                var link = "<?php echo site_url('Request_leaves_Controller/setapprovelleaves'); ?>/" + id;
                $("#setapproval").attr('href', link);
            })
            $("#datatable-buttons #tbody").on('click', '#reject', function ()
            {
                var id = $(this).data('id');
                $("#re").data('id', id).modal();
            });
            $('#re').on('click', '#setreject', function ()
            {
                var id = $('#re').data('id');
                var link = "<?php echo site_url('Request_leaves_Controller/setrejectleaves'); ?>/" + id;
                $("#setreject").attr('href', link);
            })
            $("#datatable-buttons #tbody").on('click', '#detail', function ()
            {
                var id = $(this).data('id');
                $('#showhistory').load("<?php echo site_url('Request_leaves_Controller/showhistoryleaves'); ?>/" + id);
                $("#de").data('id', id).modal();

            });

        });
    </script>
    <script>
        $(document).ready(function () {
            var handleDataTableButtons = function () {
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
                            {
                                extend: "print",
                                className: "btn-sm"
                            },
                        ],
                        responsive: true
                    });
                }
            };

            TableManageButtons = function () {
                "use strict";
                return {
                    init: function () {
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





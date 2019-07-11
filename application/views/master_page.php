<!DOCTYPE html>
<html lang="en">
    <head>   
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" href="<?= base_url() ?>public/img/favicon.png" />
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/build/css/custom.min.css" rel="stylesheet">
    </head>
    <body class="nav-md" onload="setTimeout(myFunction,900000);">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?= site_url('home') ?>" class="site_title">
                                <img src="<?= base_url() ?>/public/img/logo.png" class="img-circle" style="width: 44px;height:auto;">
                                <span style="font-size: 15px;">E-Leave</span>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        <br />
                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section" style="margin-top: -82px;">
                                <p></p>
                                <h3><span style="font-size:1px;">.</span></h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?= site_url('home') ?>">Dashboard</a></li>
                                        </ul>
                                    </li>
                                    <?php
                                    $role = $this->session->userdata('role_id');
                                    if ($role == 1) {
                                        $i = 1;

                                        foreach ($menulist as $list) {
                                            $result = $this->db->from('menu_role')
                                                    ->where('mid', $list)
                                                    ->where('type', 1)
                                                    ->get();
                                            foreach ($result->result() as $remenu) {
                                                ?>  
                                                <li><a>
                                                        <span style="margin-left:5px;">
                                                            <i class="<?Php echo $remenu->icon_name; ?>"></i>
                                                        </span>

                                                        <?php echo $remenu->function_name; ?><span class="fa fa-chevron-down"></span></a>
                                                    <ul class="nav child_menu">
                                                        <?php
                                                        $i = 1;
                                                        foreach ($submenu as $listsub) {
                                                            $resultparent = $this->db->from('menu_role')
                                                                    ->where('type', 2)
                                                                    ->where('mid', $listsub)
                                                                    ->where('parent_id', $remenu->mid)
                                                                    ->get();

                                                            foreach ($resultparent->result() as $sub) {
                                                                $link = $sub->controller;
                                                                ?>
                                                                <li><a href="<?php echo site_url($link) ?>"><span style="margin-left:-10px;"><?php echo $i++; ?></span>.<span style="margin-left:5px;"></span><?php echo $sub->function_name; ?></a></li>
                                                            <?php }
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>

                                </ul>

                            </div>

                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" data-placement="top" title="Settings">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Lock">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Logout">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo base_url(); ?>public/production/images/user.png" alt=""><?php echo $this->session->userdata('full_name'); ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>

                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="<?php echo site_url('profiles'); ?>"> Profile</a></li>
                                        <li><a href="<?php echo site_url('Login/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>

                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>                                          
                                            <span class="badge bg-green">
                                                <?php
                                                 $type = $this->session->userdata('types');
                                                switch ($role = $this->session->userdata('role')) {
                                                        case 1:
                                                            break;
                                                        case 2:
                                                            break;
                                                        case 3:
                                                            break;
                                                        case 4:
                                                            $red = $this->db->query("
                                                                                        select 
                                                                                        count(*) as countleaves
                                                                                        from leaves le 
                                                                                        inner join staff st on le.sid=st.system_id
                                                                                        where 
                                                                                        st.rm_id=(select r.rid from rm r where r.sid=" . $this->session->userdata('system_id') ." and r.flag=1) 
                                                                                        and st.position_nameeng!= 'Branch Manager'
                                                                                        and le.status=1;");
                                                           foreach ($red->result() as $cont) {
                                                                echo $cont->countleaves;
                                                            }
                                                            $reds = $this->db->query("
                                                                                        select 
                                                                                       *
                                                                                        from leaves le 
                                                                                        inner join staff st on le.sid=st.system_id
                                                                                        where 
                                                                                        st.rm_id=(select r.rid from rm r where r.sid=" . $this->session->userdata('system_id') . " and r.flag=1)
                                                                                        and st.position_nameeng!= 'Branch Manager'
                                                                                        and le.status=1;");

                                                            break;
                                                        case 5:
                                                           
                                                            if ($type == 3) {

                                                                $red = $this->db->query("
                                                                                            select 
                                                                                            count(*) as countleaves
                                                                                            from leaves le 
                                                                                                inner join staff st on le.sid=st.system_id
                                                                                            where st.hid=(select m_id from manager m where m.sid=" . $this->session->userdata('system_id') . ")
                                                                                            and le.status=1
                                                                                            and st.position_nameeng in('Branch Manager','Regional Manager');");
                                                                 foreach ($red->result() as $cont) {
                                                                    echo $cont->countleaves;
                                                                 }
                                                                $reds = $this->db->query("
                                                                                         select 
                                                                                            *
                                                                                            from leaves le 
                                                                                                inner join staff st on le.sid=st.system_id
                                                                                            where st.hid=(select m_id from manager m where m.sid=" . $this->session->userdata('system_id') . ")
                                                                                            and le.status=1
                                                                                            and st.position_nameeng in('Branch Manager','Regional Manager');");
                                                            } else if($type==1) {
                                                                
                                                                 
                                                                $red = $this->db->query("select 
                                                                                            count(*) as countleaves
                                                                                            from leaves le 
                                                                                                inner join staff st on le.sid=st.system_id
                                                                                            where st.hid=(select m_id from manager m where m.sid=" . $this->session->userdata('system_id') . ")
                                                                                            and le.status=1;
                                                                                            ");
                                                                 
                                                                 foreach ($red->result() as $cont) {
                                                                        echo $cont->countleaves;
                                                                }

                                                                $reds = $this->db->query("select 
                                                                                            *
                                                                                            from leaves le 
                                                                                                inner join staff st on le.sid=st.system_id
                                                                                            where st.hid=(select m_id from manager m where m.sid=" . $this->session->userdata('system_id') . ")
                                                                                            and le.status=1;");
                                                            }else{ echo 'test';}

                                                            break;
                                                        case 6:
                                                            $red = $this->db->query("select 
                                                                                            count(*) as countleaves
                                                                                            from leaves le 
                                                                                                inner join staff st on le.sid=st.system_id
                                                                                            where st.hid=(select m_id from manager m where m.sid=" . $this->session->userdata('system_id') . ")
                                                                                            and le.status=1
                                                                                            and le.sid!=" . $this->session->userdata('system_id') . ";
                                                                                            ");
                                                             foreach ($red->result() as $cont) {
                                                                echo $cont->countleaves;
                                                            }
                                                            $reds = $this->db->query("select 
                                                                                        *
                                                                                        from leaves le 
                                                                                        inner join staff st on le.sid=st.system_id
                                                                                        where 
                                                                                        st.hid=(select m.m_id from manager m where m.sid=" . $this->session->userdata('system_id') . ")
                                                                                        and le.status=1 
                                                                                        and st.flag=1
                                                                                         and le.`sid`!=" . $this->session->userdata('system_id') . ";
                                                                                        ");
                                                            break;
                                                    }
                                                
                                                ?>  

                                            </span>
                                                                              
                                    </a>

                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

                                        <?php
                                        if (isset($reds)) {
                                            foreach ($reds->result() as $cont) {
                                                ?>   
                                                <li>
                                                    <a href="<?php echo site_url('approve_leaves'); ?>">
                                                        <span class="image"><img src="<?php echo base_url(); ?>assets/img/logo/user.png" alt="Profile Image" /></span>
                                                        <span>
                                                            <span><?php echo $cont->staff_nameeng; ?></span>
                                                            <span class="time">3 mins ago</span>
                                                        </span>
                                                        <span class="message">
                                                            I am <?php echo $cont->staff_nameeng; ?> Request Leaves
                                                            <p> Staff Date<span style="margin-left:10px;"></span><?php echo $cont->startdate; ?> and End Date:<span style="margin-left:10px;"></span><?php echo $cont->enddate; ?></p>

                                                        </span>
                                                    </a>
                                                </li>
                                            <?php }
                                        }
                                        ?>
                                        <li>
                                            <div class="text-center">
                                                <a>
                                                    <strong>See All Alerts</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <?php
                    if (isset($views)) {
                        $this->load->view($views);
                    }
                    ?>
                </div>
                <footer>
                    <div class="pull-right">
                        <?= '©'.date('Y').' All Rights Reserved.' ?>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <script src="<?php echo base_url(); ?>public/vendors/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/fastclick/lib/fastclick.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/nprogress/nprogress.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/iCheck/icheck.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/skycons/skycons.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/Flot/jquery.flot.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/Flot/jquery.flot.pie.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/Flot/jquery.flot.time.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/Flot/jquery.flot.stack.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/Flot/jquery.flot.resize.js"></script>
        <script src="<?php echo base_url(); ?>public/production/js/flot/jquery.flot.orderBars.js"></script>
        <script src="<?php echo base_url(); ?>public/production/js/flot/date.js"></script>
        <script src="<?php echo base_url(); ?>public/production/js/flot/jquery.flot.spline.js"></script>
        <script src="<?php echo base_url(); ?>public/production/js/flot/curvedLines.js"></script>
        <script src="<?php echo base_url(); ?>public/production/js/moment/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>public/production/js/datepicker/daterangepicker.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo base_url(); ?>public/build/js/custom.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/validator/validator.min.js"></script>

        <script src="<?php echo base_url(); ?>public/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/jszip/dist/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/pdfmake/build/vfs_fonts.js"></script> 


        <script>
            // initialize the validator function
            validator.message.date = 'not a real date';

            // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
            $('form')
                    .on('blur', 'input[required], input.optional, select.required', validator.checkField)
                    .on('change', 'select.required', validator.checkField)
                    .on('keypress', 'input[required][pattern]', validator.keypress);

            $('.multi.required').on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

            $('form').submit(function (e) {
                e.preventDefault();
                var submit = true;

                // evaluate the form using generic validaing
                if (!validator.checkAll($(this))) {
                    submit = false;
                }

                if (submit)
                    this.submit();

                return false;
            });
        </script>
        <!-- /validator -->  



        <!-- Flot -->
        <script>
            $(document).ready(function () {
                var data1 = [
                    [gd(2012, 1, 1), 17],
                    [gd(2012, 1, 2), 74],
                    [gd(2012, 1, 3), 6],
                    [gd(2012, 1, 4), 39],
                    [gd(2012, 1, 5), 20],
                    [gd(2012, 1, 6), 85],
                    [gd(2012, 1, 7), 7]
                ];

                var data2 = [
                    [gd(2012, 1, 1), 82],
                    [gd(2012, 1, 2), 23],
                    [gd(2012, 1, 3), 66],
                    [gd(2012, 1, 4), 9],
                    [gd(2012, 1, 5), 119],
                    [gd(2012, 1, 6), 6],
                    [gd(2012, 1, 7), 9]
                ];
                $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
                    data1, data2
                ], {
                    series: {
                        lines: {
                            show: false,
                            fill: true
                        },
                        splines: {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            fill: 0.4
                        },
                        points: {
                            radius: 0,
                            show: true
                        },
                        shadowSize: 2
                    },
                    grid: {
                        verticalLines: true,
                        hoverable: true,
                        clickable: true,
                        tickColor: "#d5d5d5",
                        borderWidth: 1,
                        color: '#fff'
                    },
                    colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
                    xaxis: {
                        tickColor: "rgba(51, 51, 51, 0.06)",
                        mode: "time",
                        tickSize: [1, "day"],
                        //tickLength: 10,
                        axisLabel: "Date",
                        axisLabelUseCanvas: true,
                        axisLabelFontSizePixels: 12,
                        axisLabelFontFamily: 'Verdana, Arial',
                        axisLabelPadding: 10
                    },
                    yaxis: {
                        ticks: 8,
                        tickColor: "rgba(51, 51, 51, 0.06)",
                    },
                    tooltip: false
                });

                function gd(year, month, day) {
                    return new Date(year, month - 1, day).getTime();
                }
            });
        </script>
        <!-- /Flot -->

        <!-- Skycons -->
        <script>
            $(document).ready(function () {
                var icons = new Skycons({
                    "color": "#73879C"
                }),
                        list = [
                            "clear-day", "clear-night", "partly-cloudy-day",
                            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                            "fog"
                        ],
                        i;

                for (i = list.length; i--; )
                    icons.set(list[i], list[i]);

                icons.play();
            });
        </script>
        <!-- /Skycons -->



        <!-- bootstrap-daterangepicker -->
        <script>
            $(document).ready(function () {

                var cb = function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                };

                var optionSet1 = {
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment(),
                    minDate: '01/01/2012',
                    maxDate: '12/31/2015',
                    dateLimit: {
                        days: 60
                    },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    opens: 'left',
                    buttonClasses: ['btn btn-default'],
                    applyClass: 'btn-small btn-primary',
                    cancelClass: 'btn-small',
                    format: 'MM/DD/YYYY',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Submit',
                        cancelLabel: 'Clear',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    }
                };
                $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
                $('#reportrange').daterangepicker(optionSet1, cb);
                $('#reportrange').on('show.daterangepicker', function () {
                    console.log("show event fired");
                });
                $('#reportrange').on('hide.daterangepicker', function () {
                    console.log("hide event fired");
                });
                $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                    console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
                });
                $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                    console.log("cancel event fired");
                });
                $('#options1').click(function () {
                    $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
                });
                $('#options2').click(function () {
                    $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
                });
                $('#destroy').click(function () {
                    $('#reportrange').data('daterangepicker').remove();
                });
            });
        </script>
        <!-- /bootstrap-daterangepicker -->

        <!-- gauge.js -->
        <script>
            var opts = {
                lines: 12,
                angle: 0,
                lineWidth: 0.4,
                pointer: {
                    length: 0.75,
                    strokeWidth: 0.042,
                    color: '#1D212A'
                },
                limitMax: 'false',
                colorStart: '#1ABC9C',
                colorStop: '#1ABC9C',
                strokeColor: '#F0F3F3',
                generateGradient: true
            };

        </script>
       
        <script>
                function myFunction() {
                    window.location.href="<?php echo site_url('Login/logout');?>";
                }
        </script>
    </body>
</html>
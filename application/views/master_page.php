<!DOCTYPE html>
<html lang="en">
    <head>   
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" href="<?= base_url() ?>public/img/favicon.png" />
        
        <link href="<?php echo base_url(); ?>public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/build/css/custom.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/build/js/select2/dist/css/select2.min.css" rel="stylesheet">
        <script src="<?php echo base_url();?>dist/sweetalert.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>dist/sweetalert.css">
    </head>
    <body class="nav-md" onload="setTimeout(myFunction,900000);">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?= site_url('home') ?>" class="site_title">
                                <img src="<?= base_url() ?>/<?php echo $this->session->userdata('logo');?>" class="img-circle" style="width: 44px;height:auto;">
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
                                                                                        and le.brcode=st.brcode
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
                                                                                        and le.brcode=st.brcode
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
                                                                                            and le.brcode=st.brcode
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
                                                                                            and le.brcode=st.brcode
                                                                                            and st.position_nameeng in('Branch Manager','Regional Manager');");
                                                            } else if($type==1) {
                                                                
                                                                 
                                                                $red = $this->db->query("select 
                                                                                            count(*) as countleaves
                                                                                            from leaves le 
                                                                                            inner join staff st on le.sid=st.system_id
                                                                                            where st.hid=(select m_id from manager m where m.sid=" . $this->session->userdata('system_id') . " limit 1 )
                                                                                            and le.status=1
                                                                                            and le.brcode=st.brcode;
                                                                                            ");
                                                                 
                                                                 foreach ($red->result() as $cont) {
                                                                        echo $cont->countleaves;
                                                                }

                                                                $reds = $this->db->query("select 
                                                                                            *
                                                                                            from leaves le 
                                                                                                inner join staff st on le.sid=st.system_id
                                                                                            where st.hid=(select m_id from manager m where m.sid=" . $this->session->userdata('system_id') . " limit 1)
                                                                                            and le.status=1
                                                                                            and le.brcode=st.brcode;");
                                                            }else{ echo 'test';}

                                                            break;
                                                        case 6:
                                                            $red = $this->db->query("select 
                                                                                            count(*) as countleaves
                                                                                            from leaves le 
                                                                                                inner join staff st on le.sid=st.system_id
                                                                                            where st.hid=(select m_id from manager m where m.sid=" . $this->session->userdata('system_id') . " limit 1)
                                                                                            and le.status=1
                                                                                            and le.brcode=st.brcode
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
                                                                                        st.hid=(select m.m_id from manager m where m.sid=" . $this->session->userdata('system_id') . " limit 1)
                                                                                        and le.status=1 
                                                                                        and le.brcode=st.brcode
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
        <script src="<?php echo base_url(); ?>public/vendors/nprogress/nprogress.js"></script>
        <script src="<?php echo base_url(); ?>public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <script src="<?php echo base_url(); ?>public/build/js/custom.min.js"></script>
        
        <script src="<?php echo base_url(); ?>public/build/js/select2/dist/js/select2.min.js"></script>  
        <script>
                function myFunction() {
                    window.location.href="<?php echo site_url('Login/logout');?>";
                }
        </script>
    </body>
</html>
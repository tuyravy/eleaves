<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title;?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>public/img/favicon.png" />
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url();?>public/documentation/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>public/build/css/custom.min.css" rel="stylesheet">
  </head>
<body class="login">
        <div>
            <div class="login_wrapper">
                <div class="animate form login_form" style="box-shadow: 0px 0px 10px #ccc;">
                    <section class="login_content">
                        <div>
                            <img src="<?= base_url() . 'public/img/logo.png'; ?>" class="img-circle" style="width: 100px;height:auto;margin: -15px;">
                        </div>
                        <?= form_open('login/forgetpassword', array('role' => 'form', 'data-toggle' => 'validator')); ?>
                        <h1>E-Leave Forget Password</h1>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input value="" type="text" class="form-control" name="systemid" placeholder="System ID"  autocomplete="off" required />
                        </div> 
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label​ style="color:red;">System ID:គីផ្នែកខាងលើនៃកាតរបស់លោកគ្រូ / អ្នកគ្រូ !</label>
                            <p></p>
                            <div style="color:blue;font-weight:bold;padding-bottom:10px;">សូមមើលការណែនាំដោយចុចត្រង់តំននេះ <a href="<?php echo base_url().'assets/Forget Password Guild line.pdf';?>">Click Here</a></div>          
                        </div>
                                
                        
                        <p></p>
                        <div>
                            <button type="submit" name="submit" class="btn btn-primary submit" style="margin-top: 8px;"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Search ID</button>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if(isset($forget)){
                                if($forget==false)
                                {    
                            ?>
                                <p style='color:red'>System ID របស់លោកអ្នកមិនត្រឹមត្រូវទេ!</p>
                            
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <?= form_close(); ?>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div>
                            <?php if(isset($forget)){
                                if($forget==true){
                                ?>
                            <table class="table">
                             <tr>
                                <td>System ID</td>
                                <td>Staff Name</td>
                                <td>Status</td>
                             </tr>
                             <tr>
                                <td><?php echo $forget->system_id; ?></td>
                                <td><?php echo $forget->full_name; ?></td>
                                <td><a href="<?php echo site_url("requestpasswordbysystemid");?>/<?php echo $forget->system_id;?>"><span class="glyphicon glyphicon-envelope"></span><span style="margin-left:5px;">Change Now</span></a></td>
                             </tr>
                             <tr>
                                <td colspan="3"​ style="color:red">សូមចុចសញ្ញា Change ដើម្បីទទួលបានលេខសម្ងាត់ថ្មី</td>                                
                             </tr>
                            </table>
                            <?php }
                                }?>
                            </div>
                            <hr/>
                            <div>
                                <p>©<?= date('Y') ?> All Rights Reserved.</p>
                            </div>
                        </div>
                       
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
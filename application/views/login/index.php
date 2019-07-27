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
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>public/build/css/custom.min.css" rel="stylesheet">
  </head>
<body class="login">
        <div>
            <div class="login_wrapper">
                <div class="animate form login_form" style="box-shadow: 0px 0px 10px #ccc;">
                    <section class="login_content">
                        <div>
                            <img src="<?= base_url() . 'public/img/stsk_logo.png'; ?>" class="img-circle" style="width: 100px;height:auto;margin: -15px;">
                        </div>
                        
                        <form action="<?php echo site_url('Login/checksession');?>" method="post">
                        <h1>E-Leave Sign In</h1>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input value="" type="text" class="form-control" name="username" placeholder="Username"  autocomplete="off" required />
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="password" class="form-control" name="password" placeholder="Password" data-error="Password required" autocomplete="off" required />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div>
                            <button type="submit" name="submit" class="btn btn-primary submit" style="margin-top: 8px;"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Sign In</button>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if(isset($error)){?>
                                <p style='color:red'>លេខគណនី និង លេខសម្ងាត់របស់លោក អ្នកមិនត្រឹមត្រូវទេ !</p>                            
                            <?php
                            }
                            if(isset($errornotAcc)){
                            ?>
                            <p style='color:red'>លេខគណនីរបស់លោកអ្នកត្រូវបានបិទ សូមធ្វើការទំនាក់ទំនងទៅកាន់ផ្នែកប្រព័ន្ធ! សូមអរគុណ!</p>
                            <?php }?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div>
                                <p>©<?= date('Y') ?> All Rights Reserved.</p>
                            </div>
                        </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
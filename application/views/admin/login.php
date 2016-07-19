<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE 2 | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.4 -->
        <link href="<?php echo base_url() . 'assets/admin/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url() . 'assets/admin/dist/css/AdminLTE.min.css' ?>" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?php echo base_url() . 'assets/admin/plugins/iCheck/square/blue.css' ?>" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a><b>Admin</b>LTE</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php
                if ($this->session->has_userdata('flash_message') || $this->session->has_userdata('flash_error')) {
                    $isMsg = $this->session->has_userdata('flash_message');
                    echo "<div class='callout " . ($isMsg ? "callout-success" : "callout-warning") . "'>" .
                    "<h4>Thông báo!</h4>" .
                    "<p>" . $this->session->flashdata('flash_message') .
                    $this->session->flashdata('flash_error') . "</p>" .
                    "</div>";
                }
                ?>
                <form action="<?php echo base_url() . 'user/checkLogin'?>" method="post">
                    <div class="form-group has-feedback">
                        <?php
                        if (form_error('username')) {
                            echo "<div class='has-error'>"
                            . "<label class='control-label' for='inputError'>"
                            . form_error('username')
                            . "</label>"
                            . "</div>";
                        }
                        ?>
                        <input type="text" class="form-control" name="username" placeholder="Username" />
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <?php
                        if (form_error('password')) {
                            echo "<div class='has-error'>"
                            . "<label class='control-label' for='inputError'>"
                            . form_error('password')
                            . "</label>"
                            . "</div>";
                        }
                        ?>
                        <input type="password" class="form-control" name="password" placeholder="Password" />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
                    <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
                </div><!-- /.social-auth-links -->

                <a href="#">I forgot my password</a><br>
                <a href="register.html" class="text-center">Register a new membership</a>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url() . 'assets/admin/plugins/jQuery/jQuery-2.1.4.min.js' ?>" type="text/javascript"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url() . 'assets/admin/bootstrap/js/bootstrap.min.js' ?>" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url() . 'assets/admin/plugins/iCheck/icheck.min.js' ?>" type="text/javascript"></script>
        <script>
            jQuery(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>

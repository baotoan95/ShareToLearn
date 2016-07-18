<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dashboard <?php echo isset($title) ? " - " . $title : "" ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.4 -->
        <link href="<?php echo base_url() . 'assets/admin/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url() . 'assets/admin/plugins/jQuery/jQuery-2.1.4.min.js' ?>" type="text/javascript"></script>
        <!-- common function -->
        <script src="<?php echo base_url() . 'assets/common.js' ?>" type="text/javascript"></script>
        <!-- jvectormap -->
        <link href="<?php echo base_url() . 'assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css' ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url() . 'assets/admin/dist/css/AdminLTE.min.css' ?>" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo base_url() . 'assets/admin/dist/css/skins/_all-skins.min.css' ?>" rel="stylesheet" type="text/css" />

        <!-- Select2 -->
        <link href="<?php echo base_url() . 'assets/admin/plugins/select2/select2.min.css' ?>" rel="stylesheet" type="text/css" />

        <!-- Ckeditor -->
        <script lang="javascript" src="<?php echo base_url() . 'assets/js/ckeditor/ckeditor.js'?>"></script>
        
        <!-- Ckeditor -->
        <script lang="javascript" src="<?php echo base_url() . 'assets/js/ckfinder/ckfinder.js'?>"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue sidebar-mini">
        <script type="text/javascript">
            $(document).ready(function () {
                $('input[name=avatar]').change(function () {
                    var imgPath = URL.createObjectURL(event.target.files[0]);
                    $(".avatarPreview").fadeIn("fast").attr('src', imgPath);
                });
            });
        </script>
        <div class="wrapper">
            <?php $this->load->view('admin/template/header'); ?>

            <!-- Left side column. contains the logo and sidebar -->
            <?php $this->load->view('admin/template/sidebar'); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Version 1.0</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php $this->load->view($content); ?>    
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <?php $this->load->view('admin/template/footer'); ?>

            <!-- Control Sidebar -->
            <?php $this->load->view('admin/template/control_panel'); ?>

        </div><!-- ./wrapper -->

        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url() . 'assets/admin/bootstrap/js/bootstrap.min.js' ?>" type="text/javascript"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url() . 'assets/admin/plugins/fastclick/fastclick.min.js' ?>" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url() . 'assets/admin/dist/js/app.min.js' ?>" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?php echo base_url() . 'assets/admin/plugins/sparkline/jquery.sparkline.min.js' ?>" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo base_url() . 'assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js' ?>" type="text/javascript"></script>
        <script src="<?php echo base_url() . 'assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js' ?>" type="text/javascript"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="<?php echo base_url() . 'assets/admin/plugins/slimScroll/jquery.slimscroll.min.js' ?>" type="text/javascript"></script>
        <!-- ChartJS 1.0.1 -->
        <script src="<?php echo base_url() . 'assets/admin/plugins/chartjs/Chart.min.js' ?>" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url() . 'assets/admin/dist/js/demo.js' ?>" type="text/javascript"></script>
    </body>
</html>

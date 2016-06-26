<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title><?php echo isset($title) ? $title : "ShareToLearn"; ?></title>

        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/client/images/favicon.ico' ?>" type="image/x-icon">

        <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/foundation.css' ?>" type="text/css" media="screen">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/style.css' ?>" type="text/css" media="screen">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/responsive.css' ?>" type="text/css" media="screen">

        <!--[if lt IE 9]>
                <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Header -->
        <?php $this->load->view('client/template/header'); ?>
        <!-- End Header -->

        <!-- Container -->
        <section class="container row clearfix">
            <?php $this->load->view('client/template/main_menu'); ?>

            <!-- Inner Container -->
            <section class="inner-container clearfix">
                <!-- Content -->
                <?php isset($content) ? $this->load->view($content) : ""; ?>
                <!-- Content -->

                <!-- Sidebar -->
                <?php isset($sidebar) ? $this->load->view($sidebar) : ""; ?>
                <!-- End Sidebar -->

                <!-- Footer -->
                <?php $this->load->view('client/template/footer'); ?>
                <!-- End Footer -->
            </section>
            <!-- End Inner Container -->
        </section>
        <!-- End Container -->

        <script type="text/javascript" src="<?php echo base_url() . 'assets/client/js/jquery.min.js' ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/client/js/jquery.superfish.js' ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/client/js/jquery.flexslider.min.js' ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/client/js/jquery.fancybox.js' ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/client/js/jcarousel.js' ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/client/js/jquery.masonry.min.js' ?>"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/client/js/gmap3.min.js' ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/client/js/script.js' ?>"></script>
    </body>
</html>
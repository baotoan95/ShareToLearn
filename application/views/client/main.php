<!DOCTYPE html>
<html>
    <head>
        <title><?php echo isset($title) ? $title : "BTIT95"; ?></title>
        <link rel="alternate" href="<?php echo base_url(); ?>" hreflang="vi"/>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="<?php isset($post) ? $post->getExcerpt() : "BTIT95"; ?>"/>

        <meta property="og:url" content="<?php echo isset($post) ?
        base_url() . $post->getGuid() . '-' . $post->getId() . '.html' : base_url(); ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?php echo isset($post) ? $post->getTitle() : 'BTIT95'; ?>" />
        <meta property="og:description" content="<?php echo isset($post) ? $post->getExcerpt() : 'BTIT95'; ?>" />
        <meta property="og:image" content="<?php echo base_url() . 'assets/upload/images/' .
              (isset($post) ? $post->getBanner() : 'logo.gif'); ?>" />
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/client/img/btit95.ico'; ?>">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:400,900,700">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/bootstrap.css'; ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/font-awesome.css'; ?>">
        <link rel="stylesheet" id="type-stylesheet" href="<?php echo base_url() . 'assets/client/css/goliath.css'; ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/goliath-tablet.css'; ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/goliath-phone.css'; ?>">
        <!--<link rel="stylesheet" href="<?php echo base_url() . 'assets/client/demo/demo.css'; ?>">-->
        <link rel="stylesheet" href="<?php // echo base_url() . 'assets/client/demo/colorpicker/css/bootstrap-colorpicker.min.css';     ?>">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:900,100,300,400">
        <script src="<?php echo base_url() . 'assets/client/js/modernizr-2.6.2-respond-1.1.0.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/jquery-1.11.1.js'; ?>"></script>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments);
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m);
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-81239126-1', 'auto');
            ga('send', 'pageview');
        </script>
        
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5619409410a0a7e9"></script>
    </head>

    <body class="preload">
        <script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=278724535821899";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <script type="text/javascript">
            var demo_base_url = '<?php echo base_url(); ?>';
        </script>
        <div id="particles"></div>

        <!-- Trending -->
        <?php $this->load->view('client/trending'); ?>

        <!-- Header -->
        <?php $this->load->view('client/header'); ?>

        <!-- Menu responsive -->
        <?php // $this->load->view('client/menu-responsive');  ?>

        <!-- Menu -->
<?php $this->load->view('client/menu'); ?>
<?php isset($nav) ? $this->load->view($nav) : ""; ?>

        <!-- Homepage content -->
        <div class="container homepage-content">

            <div class="main-content-column-1">

                <!-- Blog list 1 -->
                <?php $this->load->view($content); ?>

                <!-- Pages pagination -->
<?php $this->load->view('client/pagination'); ?>

            </div>

            <!-- Sidebar -->
<?php $this->load->view('client/sidebar'); ?>

        </div>

        <div class="container banner-728x90">
            <a href="goliath-post-1.html"><img src="<?php echo base_url() . 'assets/client/img/banner-728x90.png'; ?>"></a>
        </div>

        <!-- Footer -->
        <?php $this->load->view('client/footer'); ?>

        <!-- Copyright -->
<?php $this->load->view('client/copyright'); ?>

        <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>


        <script src="<?php echo base_url() . 'assets/client/js/bootstrap.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/bootstrap-hover-dropdown.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/jquery.particleground.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/jquery.cycle2.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/jquery.cycle2.scrollVert.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/jquery.cycle2.swipe.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/jquery.hoverintent.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/jquery.inview.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/jquery.ui.core.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/jquery.ui.effect.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/jquery.ui.effect-size.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/jquery.ui.effect-slide.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/goliath.js'; ?>"></script>
    </body>
</html>
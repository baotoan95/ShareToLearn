<!DOCTYPE html>
<html>
    <head>
        <title><?php echo isset($title) ? $title : "BTIT95 - Share To Learn"; ?></title>
        <link rel="alternate" href="<?php echo base_url(); ?>" hreflang="vi"/>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="<?php echo isset($post) ? substr($post->getExcerpt(), 0, 200) : "BTIT95 - Share To Learn"; ?>"/>
        <meta name="keywords" content="<?php echo isset($post) ? $post->getTitle() : "BTIT95 - Share To Learn"; ?>, dev vui, lap trinh java, lap trinh php, loi hay y dep, giai tri"/>

        <meta property="og:url" 
              content="<?php echo isset($post) ? base_url() . $post->getGuid() . '-' . $post->getId() . '.html' : base_url(); ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?php echo isset($post) ? $post->getTitle() : 'BTIT95 - Share To Learn'; ?>" />
        <meta property="og:description" content="<?php echo isset($post) ? $post->getExcerpt() : 'BTIT95 - Share To Learn'; ?>" />
        <meta property="og:image" content="<?php
        echo base_url() . 'assets/upload/images/' .
        (isset($post) ? $post->getBanner() : 'logo.gif');
        ?>" />
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/client/img/btit95.ico'; ?>">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:400,900,700">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/bootstrap.css'; ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/font-awesome.css'; ?>">
        <link rel="stylesheet" id="type-stylesheet" href="<?php echo base_url() . 'assets/client/css/goliath.css'; ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/goliath-tablet.css'; ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/goliath-phone.css'; ?>">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:900,100,300,400">
        <script src="<?php echo base_url() . 'assets/client/js/modernizr-2.6.2-respond-1.1.0.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/client/js/jquery-1.11.1.js'; ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/prism.css'; ?>"/>
        <script src="<?php echo base_url() . 'assets/client/js/prism.js'; ?>"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>

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
        <script src="<?php echo base_url() ?>/assets/client/js/mediaelement-and-player.min.js"></script>
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
        <?php // $this->load->view('client/menu-responsive');     ?>

        <!-- Menu -->
        <?php $this->load->view('client/menu'); ?>
        <?php isset($nav) ? $this->load->view($nav) : ""; ?>

        <!-- Homepage content -->
        <div class="container homepage-content">
            <!-- Featured travel -->
            <div class="post-block-3 featured">
                <div class="title-default">
                    <a class="active">Học tiếng Anh với phụ đề song ngữ</a>
                </div>
                <div class="items">

                    <div class="post-1">
                        <div class="player_container" style="width: 60% !important; float: left;">
                            <video id="youtube1" controls width="100%" height="360" controls>
                                <source src="https://www.youtube.com/watch?v=1QNy-_hGSxA" type="video/youtube" >
                            </video>

                            <div class="player_control">
                                <button id="btnPlay">Play</button>
                                <progress id="progressbar" max="100" value="0" class="html5">
                                    <!-- Browsers that support HTML5 progress element will ignore the html inside `progress` element. Whereas older browsers will ignore the `progress` element and instead render the html inside it. -->
                                    <div class="progress-bar">
                                        <span style="width: 80%">80%</span>
                                    </div>
                                </progress>
                                <div>
                                    <span id="crrTime"></span>

                                    <input id="volume" type="range" name="volume" min="0" max="100" value="100">
                                    <button id="mute">Mute</button>
                                </div>
                            </div>

                        </div>
                        <div id="bilingual">
                            <span id="cue0" data-start="1.5">
                                We are the one
                            </span>
                            <span id="cue1" data-start="3.2">
                                Who start with a program
                            </span>
                            <span id="cue2" data-start="6.8">
                                That say "Hello World"
                            </span>
                            <span id="cue3" data-start="9.6">
                                And we never stay
                            </span>
                            <span id="cue4" data-start="12.5">
                                We put a wrong condition in an if else statement but compile it and run it anyway
                            </span>
                            <span id="cue5" data-start="23.8">
                                Our only goal is to make Team leaders dream come true;
                            </span>
                            <span id="cue6" data-start="29">
                                So we copy our code from Stackoverflow
                            </span>
                            <span id="cue7" data-start="34.5">
                                Our life is stuck in an infinete for loop till our kingdom come
                            </span>
                            <span id="cue8" data-start="42.5">
                                Till our kingdom come
                            </span>
                            <span id="cue9" data-start="45.5">
                                If you see someone with alonely life
                            </span>
                            <span id="cue10" data-start="50.5">
                                He is an Engineer
                            </span>
                            <span id="cue11" data-start="53.2">
                                A Software Engineer
                            </span>
                            <span id="cue12" data-start="56">
                                Google infosys and intel inside
                            </span>
                            <span id="cue13" data-start="62">
                                Are our dream companies
                            </span>
                            <span id="cue14" data-start="66.5">
                                System dot out dot print
                            </span>
                            <span id="cue15" data-start="69.3">
                                My life sucks so bad
                            </span>
                            <span id="cue16" data-start="72">
                                Give me a header file
                            </span>
                            <span id="cue17" data-start="74.5">
                                Import java dot life
                            </span>
                            <span id="cue18" data-start="77.2">
                                Your eyes they shine so bright
                            </span>
                            <span id="cue19" data-start="80">
                                I think you've got a life
                            </span>
                            <span id="cue20" data-start="82.5">
                                If you want it to go
                            </span>
                            <span id="cue21" data-start="85">
                                Come with us Onboard
                            </span>
                            
                        </div>

                        <script type="text/javascript">
                            new MediaElement('youtube1', {
                                success: function (media) {
                                    var duration = 0.0001;
                                    var volume = 100;
                                    var adjustSeek = false;
                                    var progressWidth = $('#progressbar').width();
                                    var bilingualBoxs = $("span[id^='cue']");
                                    var scrolling = false;

                                    for (var i = 0; i < bilingualBoxs.length; i++) {
                                        $(bilingualBoxs[i]).click(function () {
                                            media.setCurrentTime(this.getAttribute('data-start'));
                                        });
                                    }

                                    function setTime(value) {
                                        var seconds = Math.round(value % 60);
                                        var minutes = Math.round(value / 60);

                                        var relSeconds = Math.round(duration % 60);
                                        var relMinutes = Math.round(duration / 60);
                                        $('#crrTime').text(minutes + ":" + seconds + " | " + relMinutes + ":" + relSeconds);
                                    }
                                    
                                    function calTotalHeight(n) {
                                        var total = 0;
                                        for (var i = 0; i < n; i++) {
                                            total += $(bilingualBoxs[i]).height();
                                        }
                                        return total;
                                    }

                                    // find bilingual box and highlight it
                                    function findPiscesBox(value) {
                                        for (var i = 0; i < bilingualBoxs.length; i++) {
                                            var timeBox = Math.round(bilingualBoxs[i].getAttribute('data-start'));
                                            var curTime = Math.round(value);
                                            if (timeBox >= curTime && curTime >= (timeBox - 0.1)) {
                                                if (!media.paused && !scrolling) {
                                                    if (i > 0) {
                                                        var containerHeight = $('#bilingual').height();
                                                        var crrPositionTop = $("#cue" + i).position().top;
                                                        var nextHeight = $("#cue" + (i + 1)).height();
                                                        console.log(crrPositionTop + " " + $("#cue" + i).height() + " " + nextHeight);
                                                        if((crrPositionTop + $("#cue" + i).height() + nextHeight) > containerHeight) {
                                                            console.log('scroll');
                                                            $("#bilingual").animate({
                                                                scrollTop: calTotalHeight(i) + (nextHeight)
                                                            }, 300);
                                                        }
                                                    }
                                                }
                                                bilingualBoxs.css('background', 'white');
                                                $("#cue" + i).css('background', 'red');
                                                return;
                                            }
                                        }
                                    }

                                    document.getElementById('bilingual').addEventListener('scroll', function () {
                                        scrolling = true;
                                        clearTimeout($.data(this, "scrollCheck"));
                                        $.data(this, "scrollCheck", setTimeout(function () {
                                            scrolling = false;
                                        }, 300));
                                    });

                                    media.addEventListener('timeupdate', function () {
                                        if (duration === 0.0001) {
                                            duration = media.duration;
                                        }
                                        $('#progressbar').val(Math.round((media.currentTime * 100) / duration));
                                        setTime(media.currentTime);
                                        findPiscesBox(media.currentTime);
                                    }, false);

                                    document.getElementById('btnPlay').addEventListener('click', function () {
                                        if (media.paused) {
                                            media.play();
                                            this.innerHTML = 'Pause';
                                        } else {
                                            media.pause();
                                            this.innerHTML = 'Play';
                                        }
                                    });

                                    document.getElementById('volume').addEventListener('mousemove', function () {
                                        media.setVolume(this.value / 100);
                                    });

                                    document.getElementById('progressbar').addEventListener('mousedown', function (ev) {
                                        adjustSeek = true;
                                        updateProgress(ev);
                                    });

                                    document.getElementById('progressbar').addEventListener('mouseup', function (ev) {
                                        adjustSeek = false;
                                        findPiscesBox(media.currentTime);
                                    });
                                    document.getElementById('progressbar').addEventListener('mouseout', function (ev) {
                                        adjustSeek = false;
                                        findPiscesBox(media.currentTime);
                                    });

                                    document.getElementById('progressbar').addEventListener('mousemove', function (ev) {
                                        if (adjustSeek) {
                                            updateProgress(ev);
                                        }
                                    });

                                    function updateProgress(mouseEvent) {
                                        var offset = $('#progressbar').offset();
                                        x = mouseEvent.clientX - offset.left;
                                        media.setCurrentTime(duration / 100 * ((x * 100) / progressWidth));
                                        $('#progressbar').val(x * 100 / progressWidth);
                                        findPiscesBox(media.currentTime);
                                    }

                                    document.getElementById('mute').addEventListener('click', function () {
                                        if (media.muted === false) {
                                            media.setMuted(true);
                                            volume = document.getElementById('volume').value;
                                            document.getElementById('volume').value = 0;
                                        } else {
                                            media.setMuted(false);
                                            document.getElementById('volume').value = volume;
                                        }
                                    });
                                }
                            });
                        </script>

                    </div>
                </div>
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

            <script src="<?php echo base_url() . 'assets/js/jquery.lazyload.js'; ?>"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("img.lazy").lazyload({
                        effect: "fadeIn"
                    });
                });
            </script>
            <script src="<?php echo base_url() . 'assets/client/js/goliath.js'; ?>"></script>
    </body>
</html>
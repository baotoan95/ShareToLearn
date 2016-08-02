<script src="<?php echo base_url() ?>/assets/client/js/mediaelement-and-player.min.js"></script>
<div class="post-1">
    <div class="post" style="float: left;">
        <video id="youtube1" controls width="640" height="360" controls>
            <source src="https://www.youtube.com/watch?v=1QNy-_hGSxA" type="video/youtube" >
        </video>

        <div class="player_control">
            <button id="btnPlay">Play</button>
            <progress id="progressbar" max="100" value="80" class="html5">
                <!-- Browsers that support HTML5 progress element will ignore the html inside `progress` element. Whereas older browsers will ignore the `progress` element and instead render the html inside it. -->
                <div class="progress-bar">
                    <span style="width: 80%">80%</span>
                </div>
            </progress>

            <button id="mute">Mute</button>
            <input id="volume" type="range" name="volume" min="0" max="100" value="100">
        </div>
    </div>
</div>

<div style="float: left;">
    <button class="track" data-start="5">5</button>
    <button class="track" data-start="10">10</button>
    <button class="track" data-start="15">15</button>
    <button class="track" data-start="20">20</button>
    <button class="track" data-start="25">25</button>
    <button class="track" data-start="30">30</button>
</div>

<script type="text/javascript">
    var duration = 0.0001;
    var volume = 100;
    var adjustSeek = false;
    var progressWidth = $('#progressbar').width();

    new MediaElement('youtube1', {
        success: function (media, domNode) {
            var items = document.getElementsByClassName('track');
            for (var i = 0; i < items.length; i++) {
                items[i].addEventListener('click', function () {
                    media.setCurrentTime(this.getAttribute('data-start'));
                });
            }

            media.addEventListener('timeupdate', function () {
                if (duration === 0.0001) {
                    duration = media.duration;
                }
                if (!adjustSeek) {
                    $('#progressbar').val((media.currentTime * 100) / duration);
                }

                // access HTML5-like properties
                for (var i = 0; i < items.length; i++) {
                    if (parseFloat(items[i].getAttribute('data-start')) <= Math.round(media.currentTime)) {
                        $('.track').css('background-color', 'white');
                        items[i].style.background = 'red';
                    }
                }
            }, false);

            document.getElementById('btnPlay').addEventListener('click', function () {
                if (media.paused) {
                    media.play();
                } else {
                    media.pause();
                }
            });

            document.getElementById('volume').addEventListener('mousemove', function () {
                media.setVolume(this.value / 100);
            });

            document.getElementById('progressbar').addEventListener('mousedown', function () {
                adjustSeek = true;
            });

            document.getElementById('progressbar').addEventListener('mouseup', function (ev) {
                adjustSeek = false;
            });
            document.getElementById('progressbar').addEventListener('mouseout', function (ev) {
                adjustSeek = false;
            });

            document.getElementById('progressbar').addEventListener('mousemove', function (ev) {
                var x = 0;
                if (adjustSeek) {
                    var offset = $('#progressbar').offset();
                    x = ev.clientX - offset.left;
                    media.setCurrentTime(duration / 100 * ((x * 100) / progressWidth));
                    $('#progressbar').val(x * 100 / progressWidth);
                }
            });

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
new MediaElement('youtube1', {
    success: function (media) {
        var duration = 0.0001;
        var volume = 100;
        var adjustSeek = false;
        var bilingualBoxs = $("span[id^='cue']");
        var scrolling = false;

        for (var i = 0; i < bilingualBoxs.length; i++) {
            $(bilingualBoxs[i]).click(function () {
                media.setCurrentTime(this.getAttribute('data-start'));
            });
        }

        function setTime(value) {
            var seconds = Math.round(value % 59);
            var minutes = Math.floor(value / 59);

            var relSeconds = Math.round(duration % 60);
            var relMinutes = Math.floor(duration / 60);
            $('#crrTime').text(minutes + ":" + seconds + " | " + relMinutes + ":" + relSeconds);
        }

        function calTotalHeight(n) {
            var total = 0;
            for (var i = 0; i <= n + 1; i++) {
                total += $(bilingualBoxs[i]).outerHeight();
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
                            var containerHeight = $('#bilingual').outerHeight();
                            var crrPositionTop = $("#cue" + i).position().top;
                            var nextHeight = $("#cue" + (i + 1)).outerHeight();
                            if ((crrPositionTop + $('#cue' + i).outerHeight() + nextHeight) > containerHeight) {
                                $("#bilingual").animate({
                                    scrollTop: calTotalHeight(i) - containerHeight
                                }, 300);
                            }
                        }
                    }
                    bilingualBoxs.attr('class', '');
                    $("#cue" + i).attr('class', 'active');
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
            if (media.paused) {
                $('#btnPlay').text('Play');
            } else {
                $('#btnPlay').text('Pause');
            }
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
            var progressWidth = $('#progressbar').outerWidth();
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
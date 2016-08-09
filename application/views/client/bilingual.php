<?php
$allowed = $this->session->userdata('passPosts') == NULL ? array() : $this->session->userdata('passPosts');
if (strlen($post->getPassword()) > 0 &&
        (!array_key_exists($post->getId(), $allowed) ||
        $post->getPassword() != $allowed[$post->getId()])) {
    ?>

    <?php
} else {
    ?>
    <script src="<?php echo base_url() ?>/assets/client/js/mediaelement-and-player.min.js"></script>
    <div class="container homepage-content">
        <!-- Featured travel -->
        <div class="post-block-3 featured">
            <div class="title-default">
                <a class="active">Học tiếng Anh với phụ đề song ngữ</a>
            </div>
            <div class="items">
                <div class="post-1">
                    <div class="player_container">
                        <video id="youtube1" controls width="100%" height="360px" controls>
                            <source src="<?php echo $post->getYoutube(); ?>" type="video/youtube" >
                        </video>

                        <div class="player_control">
                            <button id="btnPlay">Play</button>
                            <progress id="progressbar" max="100" value="0" class="html5">
                                <!-- Browsers that support HTML5 progress element will ignore the html inside `progress` element. Whereas older browsers will ignore the `progress` element and instead render the html inside it. -->
                                <div class="progress-bar">
                                    <span style="width: 0%">0%</span>
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
                        <?php
                        $count = 0;
                        foreach ($cues as $cue) {
                            echo "<span id='cue$count' data-start='{$cue['time']}'>";
                            echo $cue['en'];
                            echo "<br/>";
                            echo "<small>{$cue['vi']}</small>";
                            echo "</span>";
                            $count++;
                        }
                        ?>
                    </div>
                    <script type="text/javascript" src="<?php echo base_url() . 'assets/client/js/bilingual.js'; ?>"></script>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

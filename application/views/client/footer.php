<footer class="container footer">
    <div class="widget about">
        <div class="title-default">
            <a class="active">About</a>
        </div>
        <div class="text">
            <p class="logo">
                <a href="<?php echo base_url(); ?>">
                    <img alt="BTIT95" src="<?php echo base_url() . 'assets/client/img/logo.gif'; ?>">
                </a>
            </p>
            Đây là blog của BTIT95. <br/>
            Mọi bài viết là do ngẫu hứng hoặc được note lại từ những bài hay mình đã đọc, 
            hay những lỗi mình thường gặp trong quá trình coding. <br/>
            Với mục đích chia sẻ và học hỏi, Rất mong nhận được sự góp ý từ mọi người!
        </div>
    </div>

    <div class="widget page-map">
        <div class="title-default">
            <a class="active">Contact</a>
        </div>
        <div class="items archives">
            <table class="table">
                <tr>
                    <td><a>Address: </a></td>
                    <td><a>Dĩ An - Bình Dương - VN</a></td>
                </tr>
                <tr>
                    <td><a>Phone:</a></td>
                    <td><a>01649001142</a></td>
                </tr>
                <tr>
                    <td><a>Email:</a></td>
                    <td><a>BaoToan.95@gmail.com</a></td>
                </tr>
                <tr>
                    <td><a>Facebook:</a></td>
                    <td><a target="_blank" href="https://fb.com/btit95">https://fb.com/btit95</a></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="widget tags">
        <div class="title-default">
            <a class="active">Statistic Access</a>
        </div>
        <div class="items archives">
            <table class="table">
                <tr>
                    <td><a>Total: </a></td>
                    <td><a><?php echo $statistic->getTotal(); ?></a>visitor(s)</td>
                </tr>
                <tr>
                    <td><a>Yesterday:</a></td>
                    <td><a><?php echo $statistic->getYesterday(); ?></a>visitor(s)</td>
                </tr>
                <tr>
                    <td><a>Online:</a></td>
                    <td><a><?php echo $count_user_online; ?></a>visitor(s)</td>
                </tr>
            </table>
        </div>
    </div>

</footer>
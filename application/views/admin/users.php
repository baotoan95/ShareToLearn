<div class="col-xs-12">
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
    <form action="" method="get">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh Sách Bài Viết</h3><br/>
                <?php echo (isset($_GET['search']) && strlen(trim($_GET['search'])) > 0) ? "Kết quả tìm kiếm cho \"" . $_GET['search'] . "\"" : "" ?>
                <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                        <input name="search" class="form-control input-sm pull-right"  placeholder="Tìm kiếm" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-header -->

            <!-- Body control -->
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 col-lg-3">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <?php $uri = base_url() . 'user/users'; ?>
                                <a href="<?php echo $uri . '?role=all' ?>" 
                                   class="btn btn-sm btn-default <?php if (empty($_GET['role']) || $_GET['role'] == 'all') {
                                    echo 'active';
                                } ?>">
                                    Tất cả (<?php echo array_pop($count); ?>)
                                </a>
                                <?php
                                foreach ($count as $key => $value) {
                                    switch ($key) {
                                        case 'pending': echo "<a href='$uri?role=$key' "
                                            . "class='btn btn-sm btn-default " . ((!empty($_GET['role']) && $_GET['role'] == 'admin') ? "active" : "") . "'>"
                                            . "Quản trị ($value)</a>";
                                            break;
                                        case 'public': echo "<a href='$uri?role=$key' "
                                            . "class='btn btn-sm btn-default " . ((!empty($_GET['role']) && $_GET['role'] == 'writer') ? "active" : "") . "'>"
                                            . "Tác giả ($value)</a>";
                                            break;
                                        case 'private': echo "<a href='$uri?role=$key' "
                                            . "class='btn btn-sm btn-default " . ((!empty($_GET['role']) && $_GET['role'] == 'customer') ? "active" : "") . "'>"
                                            . "Người dùng thường ($value)</a>";
                                            break;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End body control 

            <!-- Body show data -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Tên Tài Khoản</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Vai Trò</th>
                            <th>Số Bài Viết</th>
                            <th>Xóa</th>
                        </tr>
                        <?php
                        foreach ($users as $user) {
                            ?>
                            <tr>
                                <td><a href="<?php echo base_url() . "user/editUser/" . $user->getId(); ?>"><?php echo $user->getUsername(); ?></a></td>
                                <td><?php echo $user->getFull_name(); ?></td>
                                <td><?php echo $user->getEmail(); ?></td>
                                <td><?php echo $user->getRole(); ?></td>
                                <td><?php echo $user->getCount_posts(); ?></td>
                                <td><i class="fa fa-fw fa-trash del_tag" id="<?php echo $user->getId(); ?>"></i></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- End body show data -->
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                Kết quả: <?php echo count($users) . '/' . $total; ?>
                <!-- Pagination -->
<?php echo $links ?>
            </div>
    </form>
</div><!-- /.box -->
</div>
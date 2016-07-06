<div class="col-xs-12">
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
                                <input type="hidden" value="<?php echo $status; ?>" name="status"/>
                                <?php $uri = base_url() . 'adminredirect/posts'; ?>
                                <a href="<?php echo $uri . '?status=all' ?>" 
                                   class="btn btn-sm btn-default <?php if(empty($_GET['status']) || $_GET['status'] == 'all') {echo 'active';} ?>">
                                    Tất cả (<?php echo array_pop($count); ?>)
                                </a>
                                <?php
                                foreach ($count as $key => $value) {
                                    switch ($key) {
                                        case 'pending': echo "<a href='$uri?status=$key' "
                                                . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && $_GET['status'] == 'pending') ? "active" : "") . "'>"
                                            . "Chờ duyệt ($value)</a>";
                                            break;
                                        case 'public': echo "<a href='$uri?status=$key' "
                                                . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && $_GET['status'] == 'public') ? "active" : "") . "'>"
                                            . "Công khai ($value)</a>";
                                            break;
                                        case 'private': echo "<a href='$uri?status=$key' "
                                                . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && $_GET['status'] == 'private') ? "active" : "") . "'>"
                                            . "Riêng tư ($value)</a>";
                                            break;
                                        case 'draf': echo "<a href='$uri?status=$key' "
                                                . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && $_GET['status'] == 'draf') ? "active" : "") . "'>"
                                            . "Nháp ($value)</a>";
                                            break;
                                        case 'trash': echo "<a href='$uri?status=$key' "
                                                . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && $_GET['status'] == 'trash') ? "active" : "") . "'>"
                                            . "Rác ($value)</a>";
                                            break;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <select class="form-control" name="date">
                            <option value="">Tất cả ngày</option>
                            <?php
                            foreach ($dates as $date) {
                                echo "<option " . (isset($_GET['date']) && $_GET['date'] == date('MY', strtotime($date)) ? "selected" : "")
                                . " value='" . date('MY', strtotime($date)) . "'>" 
                                        . date_format(date_create(substr($date, 0, strpos($date, ' '))), 'M Y') 
                                        . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" name="category">
                            <option value="">Tất cả thể loại</option>
                            <?php echo $categories; ?>
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <button class="btn btn-sm btn-default">Lọc</button>
                    </div>
                </div>
        </div>
        <!-- End body control -->

        <!-- Body show data -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu Đề</th>
                        <th>Tác Giả</th>
                        <th>Thể Loại</th>
                        <th>Tags</th>
                        <th>Bình Luận</th>
                        <th>Lượt Xem</th>
                        <th>Ngày Đăng</th>
                        <th>Trạng Thái</th>
                    </tr>
                    <?php
                    foreach ($posts as $post) {
                        ?>
                        <tr>
                            <td><?php echo $post->getId(); ?></td>
                            <td><a href="<?php echo base_url() . 'post/edit/' . $post->getId(); ?>">
                                <?php echo $post->getTitle(); ?></a></td>
                            <td>John Doe</td>
                            <td>
                                <?php
                                $categories = $post->getCategories();
                                for ($i = 0; $i < count($categories); $i++) {
                                    if ($i == count($categories) - 1) {
                                        echo "<a href='".base_url()."adminredirect/posts?"
                                                . "status=all&category=".$categories[$i]->getId()."'>" . 
                                                $categories[$i]->getName() . "</a>";
                                        break;
                                    }
                                    echo "<a href='".base_url()."adminredirect/posts?"
                                            . "status=all&category=".$categories[$i]->getId()."'>" . 
                                            $categories[$i]->getName() . "</a>, ";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                $tags = $post->getTags();
                                for ($i = 0; $i < count($tags); $i++) {
                                    if ($i == count($tags) - 1) {
                                        echo "<a href='".base_url()."adminredirect/posts?"
                                                . "status=all&tag=".$tags[$i]->getId()."'>" . 
                                                $tags[$i]->getName() . "</a>";
                                        break;
                                    }
                                    echo "<a href='".base_url()."adminredirect/posts?"
                                                . "status=all&tag=".$tags[$i]->getId()."'>" . 
                                            $tags[$i]->getName() . "</a>, ";
                                }
                                ?>
                            </td>
                            <td><?php echo $post->getComments(); ?></td>
                            <td><?php echo $post->getViews(); ?></td>
                            <td><?php echo $post->getPublished(); ?></td>
                            <td><span class="label label-success"><?php echo $post->getStatus(); ?></span></td>
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
            Kết quả: <?php echo count($posts) . '/' . $totalResult; ?>
            <!-- Pagination -->
            <?php echo $links ?>
        </div>
    </form>
    </div><!-- /.box -->
</div>
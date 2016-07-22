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
        <input type="hidden" name="type" value="<?php echo $type; ?>"/>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $title; ?></h3><br/>
                <?php echo (isset($_GET['search']) && strlen(trim($_GET['search'])) > 0) ? "Result for \"" . $_GET['search'] . "\"" : "" ?>
                <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                        <input name="search" class="form-control input-sm pull-right"  placeholder="Search" type="text">
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
                                <?php $uri = base_url() . 'post/posts'; ?>
                                <a href="<?php echo $uri . "?type=$type" ?>" 
                                   class="btn btn-sm btn-default <?php if (empty($_GET['status']) || 
                                           $_GET['status'] == 'all') {
                                    echo 'active';
                                } ?>">
                                    All (<?php echo array_pop($count); ?>)
                                </a>
                                <?php
                                foreach ($count as $key => $value) {
                                    switch ($key) {
                                        case 'pending': echo "<a href='$uri?status=$key&type=$type' "
                                            . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && 
                                                $_GET['status'] == 'pending') ? "active" : "") . "'>"
                                            . "Pending ($value)</a>";
                                            break;
                                        case 'public': echo "<a href='$uri?status=$key&type=$type' "
                                            . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && 
                                                $_GET['status'] == 'public') ? "active" : "") . "'>"
                                            . "Public ($value)</a>";
                                            break;
                                        case 'private': echo "<a href='$uri?status=$key&type=$type' "
                                            . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && 
                                                $_GET['status'] == 'private') ? "active" : "") . "'>"
                                            . "Private ($value)</a>";
                                            break;
                                        case 'draf': echo "<a href='$uri?status=$key&type=$type' "
                                            . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && 
                                                $_GET['status'] == 'draf') ? "active" : "") . "'>"
                                            . "Draf ($value)</a>";
                                            break;
                                        case 'trash': echo "<a href='$uri?status=$key&type=$type' "
                                            . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && 
                                                $_GET['status'] == 'trash') ? "active" : "") . "'>"
                                            . "Trash ($value)</a>";
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
                            <option value="">------- All ------</option>
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
                    <?php
                        if($type == "post") {
                    ?>
                    <div class="col-lg-3">
                        <select class="form-control" name="category">
                            <option value="">------- All ------</option>
                            <?php echo $categories; ?>
                        </select>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="col-lg-1">
                        <button class="btn btn-sm btn-default">Filter</button>
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
                            <th>Title</th>
                            <th>Author</th>
                            <?php
                                if($type == "post") {
                            ?>
                            <th>Categories</th>
                            <th>Tags</th>
                            <?php
                                }
                            ?>
                            <th>Comments</th>
                            <th>Views</th>
                            <th>Publised Date</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        foreach ($posts as $post) {
                            ?>
                            <tr>
                                <td><?php echo $post->getId(); ?></td>
                                <td><a href="<?php echo base_url() . 'post/edit/' . $post->getId(); ?>">
                                    <?php echo $post->getTitle(); ?></a>
                                </td>
                                <td>John Doe</td>
                                <!-- If post have type is page then hide this box -->
                                <?php
                                    if($type == "post") {
                                ?>
                                <td>
                                    <?php
                                    $categories = $post->getCategories();
                                    for ($i = 0; $i < count($categories); $i++) {
                                        if ($i == count($categories) - 1) {
                                            echo "<a href='" . base_url() . "post/posts?"
                                            . "status=all&category=" . $categories[$i]->getId() . "'>" .
                                            $categories[$i]->getName() . "</a>";
                                            break;
                                        }
                                        echo "<a href='" . base_url() . "post/posts?"
                                        . "status=all&category=" . $categories[$i]->getId() . "'>" .
                                        $categories[$i]->getName() . "</a>, ";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $tags = $post->getTags();
                                    for ($i = 0; $i < count($tags); $i++) {
                                        if ($i == count($tags) - 1) {
                                            echo "<a href='" . base_url() . "post/posts?"
                                            . "status=all&tag=" . $tags[$i]->getId() . "'>" .
                                            $tags[$i]->getName() . "</a>";
                                            break;
                                        }
                                        echo "<a href='" . base_url() . "post/posts?"
                                        . "status=all&tag=" . $tags[$i]->getId() . "'>" .
                                        $tags[$i]->getName() . "</a>, ";
                                    }
                                    ?>
                                </td>
                                <?php
                                    }
                                ?>
                                
                                <td><?php echo $post->getComments(); ?></td>
                                <td><?php echo $post->getViews(); ?></td>
                                <td><?php echo $post->getPublished(); ?></td>
                                <td><span class="label label-success"><?php echo $post->getStatus(); ?></span></td>
                                <td><i class="fa fa-fw fa-trash del_post" id="<?php echo $post->getId(); ?>"></i></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <script lang="javascript" src="<?php echo base_url(); ?>assets/admin/dist/js/pages/post_management.js"></script>
            </div>
            <!-- End body show data -->
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                Result: <?php echo count($posts) . '/' . $totalResult; ?>
                <!-- Pagination -->
                <?php echo $links ?>
            </div>
    </form>
</div><!-- /.box -->
</div>
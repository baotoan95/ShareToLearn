<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->has_userdata('flash_message') || $this->session->has_userdata('flash_error')) {
            $isMsg = $this->session->has_userdata('flash_message');
            echo "<div class='callout " . ($isMsg ? "callout-success" : "callout-warning") . "'>" .
            "<h4>Alert!</h4>" .
            "<p>" . $this->session->flashdata('flash_message') .
            $this->session->flashdata('flash_error') . "</p>" .
            "</div>";
        }
        ?>
    </div>
    <div class="col-md-3">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add category</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="addcategory" action="get">
                <div class="box-body">
                    <div class="form-group">
                        <label for="cate-name">Category name</label>
                        <input class="form-control" name="newcate" id="cate-name" type="text">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input class="form-control" name="slug" id="slug" type="text">
                    </div>
                    <div class="form-group">
                        <label>Parent</label>
                        <select name="parent_cate" class="form-control">
                            <option value="0">---- Select ----</option>
                            <?php echo $categoriesParentBox; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="desc" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-primary">ADD</button>
                </div>
            </form>
        </div><!-- /.box -->
    </div>

    <div class="col-md-9">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Categories</h3><br/>
                <?php echo (isset($_GET['search']) && strlen(trim($_GET['search'])) > 0) ? "Result for \"" . $_GET['search'] . "\"" : ""; ?>
                <div class="box-tools">
                    <form action="" method="get">
                        <div class="input-group" style="width: 150px;">
                            <input name="search" class="form-control input-sm pull-right" placeholder="Search" type="text">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Slug</th>
                            <th>Count</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($categories as $category) {
                            ?>
                            <tr>
                                <td><a href="<?php echo base_url() . 'category/editCategory/' . $category->getId(); ?>"><?php echo $category->getName(); ?></a></td>
                                <td><?php echo $category->getDesc(); ?></td>
                                <td><?php echo $category->getSlug(); ?></td>
                                <td><?php echo $category->getCount(); ?></td>
                                <td><i class="fa fa-fw fa-trash del_cate" id="<?php echo $category->getId(); ?>"></i></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <script src="<?php echo base_url(); ?>assets/admin/dist/js/pages/category_management.js"></script>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                Result: <?php echo "<i id='numerator'>" . count($categories) . "</i>/<i id='denominator'>" . $total . "</i>"; ?>
                <ul class="pagination pagination-sm no-margin pull-right">
                    <!-- Pagination -->
                    <?php echo $links ?>
                </ul>
            </div>
        </div><!-- /.box -->
    </div>
</div>
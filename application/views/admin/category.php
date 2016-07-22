<div class="row">
    <div class="col-md-9">
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
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $title; ?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url() . 'category/updateCategory' ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $category->getId(); ?>"/>
                <input type="hidden" name="count" value="<?php echo $category->getCount(); ?>"/>
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Category name</label>
                        <input class="form-control" name="name" 
                               value="<?php echo $category->getName(); ?>" id="name" placeholder="" type="text">
                    </div>
                    <div class="form-group">
                        <label>Parent</label>
                        <select name="parent_cate" class="form-control">
                            <option value="0">---- Select ----</option>
                            <?php echo $categoriesParentBox; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input class="form-control" name="slug" 
                               value="<?php echo $category->getSlug(); ?>" id="slug" placeholder="slug" type="text">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="5" name="desc" 
                                  placeholder="Desc..."><?php echo $category->getDesc(); ?></textarea>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div><!-- /.box -->
    </div>
</div>
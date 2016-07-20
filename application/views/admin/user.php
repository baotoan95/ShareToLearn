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
            <form role="form" action="<?php echo base_url() . 'user/' . $action ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo isset($user) ? $user->getId() : ""; ?>"/>
                <input type="hidden" name="actived" value="<?php echo isset($user) ? $user->getActived() : ""; ?>"/>
                <div class="box-body">
                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <?php
                        if (form_error('fullname')) {
                            echo "<div class='has-error'>"
                            . "<label class='control-label' for='inputError'>"
                            . form_error('fullname')
                            . "</label>"
                            . "</div>";
                        }
                        ?>
                        <input class="form-control" value="<?php echo isset($user) ? $user->getFull_name() : set_value('fullname') ?>" id="fullname" name="fullname" type="text">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <?php
                        if (form_error('email')) {
                            echo "<div class='has-error'>"
                            . "<label class='control-label' for='inputError'>"
                            . form_error('email')
                            . "</label>"
                            . "</div>";
                        }
                        ?>
                        <input class="form-control" value="<?php echo isset($user) ? $user->getEmail() : set_value('email') ?>" id="email" name="email" type="email">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <?php
                        if (form_error('username')) {
                            echo "<div class='has-error'>"
                            . "<label class='control-label' for='inputError'>"
                            . form_error('username')
                            . "</label>"
                            . "</div>";
                        }
                        ?>
                        <input autocomplete="false" class="form-control" value="<?php echo isset($user) ? $user->getUsername() : set_value('username') ?>" id="username" name="username" type="text">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <?php
                        if (form_error('password')) {
                            echo "<div class='has-error'>"
                            . "<label class='control-label' for='inputError'>"
                            . form_error('password')
                            . "</label>"
                            . "</div>";
                        }
                        ?>
                        <input class="form-control" value="<?php echo isset($user) ? $user->getPassword() : set_value('password') ?>" id="password" name="password" type="password">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input class="form-control" value="<?php echo isset($user) ? $user->getPhone() : ""; ?>" id="phone" name="phone" type="text">
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input class="form-control" value="<?php echo isset($user) ? $user->getFacebook() : ""; ?>" id="facebook" name="facebook" type="text">
                    </div>
                    <div class="form-group">
                        <label for="skype">Skype</label>
                        <input class="form-control" value="<?php echo isset($user) ? $user->getSkype() : ""; ?>" id="skype" name="skype" type="text">
                    </div>
                    <div class="form-group">
                        <label for="google">Google</label>
                        <input class="form-control" value="<?php echo isset($user) ? $user->getPhone() : ""; ?>" id="google" name="google" type="text">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role">
                            <option <?php echo (isset($user) && $user->getRole() == 'admin') ? "selected" : ""; ?> value="admin">Admin</option>
                            <option <?php echo (isset($user) && $user->getRole() == 'writer') ? "selected" : ""; ?> value="writer">Writer</option>
                            <option <?php echo (isset($user) && $user->getRole() == 'customer') ? "selected" : ""; ?> value="customer">Customer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input id="avatar" type="file" name="avatar">
                        <img class="avatarPreview" src="<?php echo isset($user) ? base_url() .
                                    'assets/upload/images/avatars/' . $user->getAvatar() : "";
                            ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="desc" rows="3" 
                                  placeholder="Nhập ..."><?php echo isset($user) ? $user->getDesc() : ""; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Bio</label>
                        <textarea class="form-control" name="bio" rows="5" 
                                  placeholder="Nhập ..."><?php echo isset($user) ? $user->getBio() : ""; ?></textarea>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input <?php echo (isset($user) && $user->getNon_blocked() == 1) ? "checked" : ""; ?> type="checkbox" name="blocked" value="1"> Khóa
                        </label>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <script type="text/javascript">
                CKEDITOR.replaceAll();
            </script>
        </div><!-- /.box -->
    </div>
</div>
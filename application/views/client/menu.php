<div class="navbar-wrapper menu-primary" data-spy="affix" data-offset-top="191">
    <div class="navbar navbar-default menu">
        <div class="container">
            <ul class="nav">
                <?php echo $menu; ?>
                <li style="width: 269px;" class="menu-spacer"></li>
                <li class="dropdown search">
                    <form class="search" method="get" action="<?php echo base_url() . 'search.html'; ?>">
                        <input name="s" class="form-control" placeholder="Search here" type="text">
                    </form>
                    <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown" data-hover="dropdown"><i class="fa fa-search"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
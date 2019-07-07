<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"><i class="fas fa-store-alt"></i> Anu Store</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Anu</a>
        </div>
        <!-- Query Menu -->
        <?php
                $role_id = $this->session->userdata('role_id');
                $queryMenu = "SELECT `admin_menu`.`id`,`menu`
                                FROM  `admin_menu` JOIN `admin_access_menu` 
                                    ON `admin_menu`.`id` = `admin_access_menu`.`menu_id`
                                WHERE `admin_access_menu`.`role_id`= $role_id
                                ORDER BY `admin_access_menu`.`menu_id` ASC
                                ";
                                $menu = $this->db->query($queryMenu)->result_array();
           
            ?>
        <a href="<?= base_url('admin')?>">
            <div class="btn btn-lg btn-blocked btn-primary float-right"><i class="fa fa-home" aria-hidden="true"></i>
                Dashboard</div>
        </a>
        <ul class="sidebar-menu">


            <!-- MENU LOOPING -->
            <?php foreach( $menu as $m): ?>
            <li class="menu-header"><?= $m['menu']?></li>

            <!-- SUB MENU -->
            <?php
            $menuId= $m['id'];
            $querySubMenu = " SELECT * FROM `admin_sub_menu`
                                WHERE `menu_id` = $menuId
                                AND    `is_active` = 1
                                ";
            $subMenu = $this->db->query($querySubMenu)->result_array();

            ?>
            <?php foreach ($subMenu as $sm) :?>
            <?php if ($title == $sm['title']):?>
            <li class="nav-item dropdown active">
                <?php else :?>
            <li class="nav-item dropdown">
                <?php endif;?>
                <a href="<?=base_url($sm['url'])?>" class="nav-link has-dropdown"><i
                        class="<?= $sm['icon']?>"></i><span><?=$sm['title']?></span></a>



                <!-- SUB_SUBMENU -->
                <?php 
                $submenuId=$sm['id'];
                $querySubSubMenu = " SELECT `admin_sub_menu`.`id`, `admin_sub_submenu`.*
                                        FROM `admin_sub_submenu` JOIN `admin_sub_menu`
                                            ON `admin_sub_submenu`.`submenu_id` = `admin_sub_menu`.`id`
                                        WHERE `admin_sub_submenu`.`submenu_id` = $submenuId AND `admin_sub_submenu`.`is_active` = 1";
                $subsubMenu = $this->db->query($querySubSubMenu)->result_array();
                
                ?>
                <?php foreach ($subsubMenu as $ssm) :?>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?=base_url($ssm['url'])?>"><i
                                class="<?=$ssm['icon']?>"></i><?=$ssm['menu_title']?></a></li>
                </ul>

                <?php endforeach; ?>
            </li>
            <?php endforeach; ?>

            <?php endforeach; ?>

            <!-- <li class="nav-item dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank
                        Page</span></a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i>
                    <span>Bootstrap</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="bootstrap-alert.html">Alert</a></li>
                    <li><a class="nav-link" href="bootstrap-badge.html">Badge</a></li>
                    <li><a class="nav-link" href="bootstrap-breadcrumb.html">Breadcrumb</a></li>
                    <li><a class="nav-link" href="bootstrap-buttons.html">Buttons</a></li>
                    <li><a class="nav-link" href="bootstrap-card.html">Card</a></li>
                    <li><a class="nav-link" href="bootstrap-carousel.html">Carousel</a></li>
                    <li><a class="nav-link" href="bootstrap-collapse.html">Collapse</a></li>
                    <li><a class="nav-link" href="bootstrap-dropdown.html">Dropdown</a></li>
                    <li><a class="nav-link" href="bootstrap-form.html">Form</a></li>
                    <li><a class="nav-link" href="bootstrap-list-group.html">List Group</a></li>
                    <li><a class="nav-link" href="bootstrap-media-object.html">Media Object</a></li>
                    <li><a class="nav-link" href="bootstrap-modal.html">Modal</a></li>
                    <li><a class="nav-link" href="bootstrap-nav.html">Nav</a></li>
                    <li><a class="nav-link" href="bootstrap-navbar.html">Navbar</a></li>
                    <li><a class="nav-link" href="bootstrap-pagination.html">Pagination</a></li>
                    <li><a class="nav-link" href="bootstrap-popover.html">Popover</a></li>
                    <li><a class="nav-link" href="bootstrap-progress.html">Progress</a></li>
                    <li><a class="nav-link" href="bootstrap-table.html">Table</a></li>
                    <li><a class="nav-link" href="bootstrap-tooltip.html">Tooltip</a></li>
                    <li><a class="nav-link" href="bootstrap-typography.html">Typography</a></li>
                </ul>
            </li> -->
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="<?= base_url('auth/logout')?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>
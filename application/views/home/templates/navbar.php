<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message')?>"></div>
<nav class="navbar navbar-dark navbar-expand-sm p-0 bg-danger ">
    <div class="container ">
        <a class="navbar-brand pl-2" href="<?= base_url() ?>">
            <!-- <img class="logo" src="images/logos/logo-alibaba.png"
            alt="alibaba style e-commerce html template file" title="alibaba e-commerce html css theme"> -->
            <span class="text-white font-weight-bold">Anu Store</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop"
            aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarTop">
            <!-- <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        Sourcing </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Top Suppliers</a></li>
                        <li><a class="dropdown-item" href="#">Suppliers by Regions </a></li>
                        <li><a class="dropdown-item" href="#">Online Retailer </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        Services </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Trade Assurance </a></li>
                        <li><a class="dropdown-item" href="#">Arabic</a></li>
                        <li><a class="dropdown-item" href="#">Logistics Service </a></li>
                        <li><a class="dropdown-item" href="#">Membership Services</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        Community </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Help Center</a></li>
                        <li><a class="dropdown-item" href="#">Submit a Dispute </a></li>
                        <li><a class="dropdown-item" href="#">For Suppliers </a></li>
                    </ul>
                </li>
           </ul> -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item "><a href="#" class="nav-link"> Pembayaran </a></li>

            </ul>
            <!-- navbar-nav.// -->
        </div>
        <!-- collapse.// -->
    </div>
</nav>
<section class="header-main shadow-sm">
    <div class="container">
        <div class="row-sm align-items-center">
            <div class="col-lg-4-24 col-sm-3">
                <div class="category-wrap dropdown py-1">
                    <button type="button" class="btn btn-light  dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-bars"></i> Kategori</button>
                    <div class="dropdown-menu">
                        <?php foreach ($category as $cat): ?>
                        <a class="dropdown-item" href="<?= $cat['id_categories'] ?>"><?= $cat['name_categories'] ?></a>
                        <?php endforeach ?>


                    </div>
                </div>
            </div>
            <div class="col-lg-11-24 col-sm-8">
                <form action="<?=base_url('s')?>" method="post" class="py-1">
                    <div class="input-group w-100">
                        <input type="text" class="form-control" value="" name="cari" style="width:50%;"
                            placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-danger" type="submit">
                                <i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
                <!-- search-wrap .end// -->
            </div>
            <!-- col.// -->
            <div class="col-lg-9-24 col-sm-12">
                <div class="widgets-wrap float-right row no-gutters py-1">
                    <?php if ( $user['email']==true):?>
                    <div class="col-auto">
                        <div class="widget-header dropdown">
                            <a href="#" data-toggle="dropdown" data-offset="20,10">
                                <div class="icontext">
                                    <div class="icon-wrap"><i class="text-danger icon-sm fa fa-user"></i></div>
                                    <div class="text-wrap text-dark">
                                        Akun
                                        <i class="fa fa-caret-down"></i>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu">
                                <div class="pl-1">
                                    <a class="dropdown-item" href="<?=base_url('profil')?>">
                                        <div class="text-danger font-weight-light">Profil</div>
                                    </a>
                                    <a class="dropdown-item" href="<?=base_url('history_order')?>">
                                        <div class="text-danger font-weight-light">Riwayat Belanja</div>
                                    </a>
                                </div>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item" href="<?=base_url('logout')?>"><span class="text-danger">
                                        Keluar
                                    </span></a>
                            </div>
                            <!--  dropdown-menu .// -->
                        </div>
                        <!-- widget-header .// -->
                    </div>
                    <?php else:?>
                    <div class="col-auto">
                        <div class="widget-header dropdown">
                            <a href="#" data-toggle="dropdown" data-offset="20,10">
                                <div class="icontext">
                                    <div class="icon-wrap"><i class="text-danger icon-sm fa fa-user"></i></div>
                                    <div class="text-wrap text-dark">
                                        Masuk <i class="fa fa-caret-down"></i>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu">
                                <form class="px-4 py-3" method="POST" action="<?= base_url('home/login')?>">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Masuk</button>
                                </form>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item" href="<?=base_url('signup')?>"><span class="text-danger">Tidak
                                        punya akun?
                                        Daftar</span></a>
                                <a class="dropdown-item" href="#">Lupa password?</a>
                            </div>
                            <!--  dropdown-menu .// -->
                        </div>
                        <!-- widget-header .// -->
                    </div>
                    <!-- col.// -->
                    <?php endif?>
                    <div class="col-auto ml-1 border-left">



                        <a href="<?= base_url('keranjang');?>">
                            <div class="icontext">
                                <div class="icon-wrap"><i class="text-danger icon-sm fa fa-shopping-cart mr-0"></i>
                                </div>
                                <div class="text-wrap text-dark m-0">
                                    <?php
                                $this->db->where('id_user',$user['id_user']);
                                $this->db->from('cart');
                                $cart = $this->db->count_all_results();
                                ?>
                                    <?php if ( $user['email']==true):?>
                                    <span id="cart1" class="small round badge badge-secondary">
                                        <?= $cart; ?></span>
                                    <?php endif?>

                                </div>
                            </div>
                        </a>

                    </div>
                    <!-- col.// -->
                    <div class="col-auto ml-1 border-left">
                        <a href="">
                            <div class="icontext">
                                <div class="icon-wrap"><i class=" text-danger icon-sm fa fa-bell"
                                        aria-hidden="true"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- widgets-wrap.// row.// -->
            </div>
            <!-- col.// -->
        </div>
        <!-- row.// -->
    </div>
    <!-- container.// -->
</section>
<!-- header-main .// -->
</header>
<!-- section-header.// -->
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content bg padding-y-sm" style="min-height:430px">
    <div class="container">
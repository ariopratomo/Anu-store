<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, <?= $admin['name']?>!</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="<?= base_url('include/assets/img/avatar/').$admin['image']?>"
                                class="rounded profile-widget-picture">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Level</div>
                                    <div class="profile-widget-item-value">
                                        <?php
                                        if($admin['role_id']== 1) {
                                            $level = "Superadmin";
                                        } else { $level ="Admin";}
                                        ?>
                                        <?= $level?>
                                    </div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Profile Since</div>
                                    <div class="profile-widget-item-value"><?= date('d F Y',$admin['date_created'])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name"><?= $admin['name']?>
                                <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> Admin
                                </div>
                            </div>
                            <div><b class="text-uppercase"><?= $admin['email']?></b></div>

                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#changepassword">Change
                                Password</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <?= $this->session->flashdata('message'); ?>
                        <form method="post" class="needs-validation" action="<?= base_url('admin/profile')?> "
                            novalidate="" enctype="multipart/form-data">
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-12">
                                        <label>Full Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="<?= $admin['name']?>" required="">
                                        <!-- <div class="invalid-feedback">
                                            Please fill in the  full name
                                        </div> -->
                                        <?= form_error('name','<small class="text-danger pl-1 ">','</small>')?>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            value="<?= $admin['email']?>" readonly>
                                        <div class="invalid-feedback">
                                            Please fill in the email
                                        </div>
                                    </div>

                                    <div class="form-group col-12">
                                        <div class="custom-file">
                                            <input type="file" name="image" id="image">

                                        </div>
                                    </div>


                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!-- Modal -->
<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="changepasswordTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changepasswordTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/changepassword')?>" method="post">
                <div class="modal-body">


                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" name="current_password" minlength="6" class="form-control" required
                            id="current_password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" name="password" class="form-control" minlength="6" required id="password"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password1">Repeat Password</label>
                        <input type="password" name="password1" class="form-control" minlength="6" required
                            id="password1" placeholder="Password">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
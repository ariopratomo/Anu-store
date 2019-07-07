<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="<?= base_url('include/')?>assets/img/stisla-fill.svg" alt="logo" width="100"
                        class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="<?= base_url('auth')?>" class="needs-validation" novalidate="">
                            <div class="form-group">
                                <?= $this->session->flashdata('message')?>
                                <label for="email">Email</label>
                                <input id="email" value="<?= set_value('email')?>" type="email" class="form-control"
                                    name="email" tabindex="1" required autofocus>
                                <?= form_error('email','<small class="text-danger pl-1">','</small>')?>
                                <div class="invalid-feedback">

                                    Please fill in your email
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label" name="password">Password</label>
                                    <div class="float-right">
                                        <a href="auth-forgot-password.html" class="text-small">
                                            Forgot Password?
                                        </a>
                                    </div>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                    required>
                                <?= form_error('password','<small class="text-danger pl-1">','</small>')?>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="simple-footer">
                    Copyright &copy; Anu-Store 2019
                    <div>Design By Stisla</div>
                </div>
            </div>
        </div>
    </div>
</section>
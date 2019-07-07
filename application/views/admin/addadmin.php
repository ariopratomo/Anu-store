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
            <div class="card">
                <div class="card-body">
                    <form method="POST">

                        <div class="form-group ">
                            <label for="name">Full Name</label>
                            <input id="name" type="text" required class="form-control" name="name" autofocus>
                        </div>



                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" required class="form-control" name="email">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password" class="d-block">Password</label>
                                <input id="password" type="password" required class="form-control pwstrength"
                                    data-indicator="pwindicator" name="password">
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="password2" class="d-block">Password Confirmation</label>
                                <input id="password2" type="password" required class="form-control" name="password2">
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-6">
                                <label>Role</label>
                                <select class="form-control selectric" name="role" required>
                                    <option disabled>Select Role</option>
                                    <option value="1">Superadmin</option>
                                    <option value="2">Admin</option>
                                </select>
                            </div>

                        </div>


                        <div class="form-group">
                            <button type="submit" name="add" value="add" class="btn btn-primary btn-lg btn-block">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
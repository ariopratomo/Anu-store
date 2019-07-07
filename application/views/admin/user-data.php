      <!-- Main Content -->
      <div class="main-content">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <!-- Alert  -->

                      <?= $this->session->flashdata('message');?>
                      <div class="card-header">


                          <div class="card-header-form">
                              <form>

                              </form>
                          </div>
                      </div>
                      <div class="card-body p-0">
                          <div class="table-responsive">
                              <table class="table table-striped" id="tabel-data">
                                  <thead>
                                      <tr>
                                          <th>
                                              No.
                                          </th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Address</th>
                                          <?php if ($admin['role_id']==1) {?>
                                          <th>
                                              Status
                                          </th>
                                          <?php }  ?>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i=1;?>
                                      <?php foreach($user_data as $u):?>

                                      <tr>
                                          <td>
                                              <?=$i;?>.
                                          </td>
                                          <td><?= $u['fullname']?></td>
                                          <td>
                                              <?= $u['email'] ?>
                                          </td>
                                          <td><?= $u['address']?></td>
                                          <?php if ($admin['role_id']==1) {?>
                                          <?php if ($u['is_active']==1) {?>
                                          <td><a href="<?= base_url('admin/unotactive/').$u['id_user']?>"
                                                  class=" ml-auto"><button class="btn btn-success">Active</button></a>
                                          </td>
                                          <?php }else{  ?>
                                          <td><a href="<?= base_url('admin/uactived/').$u['id_user']?>"
                                                  class=" ml-auto"><button class="btn btn-danger">Not
                                                      active</button></a>
                                          </td>
                                          <?php }  ?>

                                          <?php }  ?>

                                      </tr>
                                      <?php $i++;?>
                                      <?php endforeach?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

      </div>
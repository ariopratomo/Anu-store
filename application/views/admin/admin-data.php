      <!-- Main Content -->
      <div class="main-content">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <!-- Alert  -->

                      <?= $this->session->flashdata('message');?>
                      <div class="card-header">
                          <?php if ($admin['role_id']==1) {?>
                          <a href="<?= base_url('admin/addadmin')?>" class=" ml-auto"><button
                                  class="btn btn-primary">Add new admin</button></a>
                          <?php }  ?>

                          <div class="card-header-form">
                              <form>

                              </form>
                          </div>
                      </div>
                      <div class="card-body p-0">
                          <div class="table-responsive">
                              <table class="table table-striped">
                                  <tr>
                                      <th>
                                          No.
                                      </th>
                                      <th>Name</th>
                                      <th>Image</th>
                                      <th>Role</th>
                                      <?php if ($admin['role_id']==1) {?>
                                      <th>
                                          Status
                                      </th>
                                      <?php }  ?>
                                  </tr>
                                  <?php $i=1;?>
                                  <?php foreach($admin_data as $ad):?>

                                  <tr>
                                      <td>
                                          <?=$i;?>.
                                      </td>
                                      <td><?= $ad['name']?></td>
                                      <td>
                                          <img src="<?= base_url('include/assets/img/avatar/').$ad['image'] ?>"
                                              alt="<?= $ad['name'] ?>" class="img-fluid rounded zoom img-sm"
                                              data-toggle="tooltip" data-placement="top" data-html="true"
                                              title="<b style='background-color:#e1e1e1'><?= $ad['name'] ?><b>"
                                              width="50">
                                      </td>
                                      <td><?= $ad['role']?></td>
                                      <?php if ($admin['role_id']==1) {?>

                                      <?php if ($ad['is_active']==1) {?>



                                      <td><a href="<?= base_url('admin/notactive/').$ad['id_admin']?>"
                                              class=" ml-auto"><button class="btn btn-success">Active</button></a></td>
                                      <?php }else{  ?>
                                      <td><a href="<?= base_url('admin/actived/').$ad['id_admin']?>"
                                              class=" ml-auto"><button class="btn btn-danger">Not active</button></a>
                                      </td>
                                      <?php }  ?>

                                      <?php }  ?>

                                  </tr>
                                  <?php $i++;?>
                                  <?php endforeach?>

                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

      </div>
      <!-- Main Content -->
      <div class="main-content">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <!-- Alert  -->
                      
                      <?= $this->session->flashdata('message');?>
                      <div class="card-header">
                          <h4>Role : <?= $role['role'] ?></h4>
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
                                      <th>Menu</th>
                                      <th>Access</th>
                                  </tr>
                                  <?php $i=1;?>
                                  <?php foreach($menu as $m):?>
                                  <tr>
                                      <td>
                                          <?=$i;?>.
                                      </td>
                                      <td><?= $m['menu']?></td>
                                      <td>
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" 
                                          <?= check_access($role['id'],$m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                                        </div>
                                      </td>
                                      
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
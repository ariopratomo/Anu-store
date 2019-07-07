      <!-- Main Content -->
      <div class="main-content">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <!-- Alert  -->
                      <?= form_error('menu','<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">','<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>')?>
                      <?= $this->session->flashdata('message');?>
                      <div class="card-header">
                          <h4>Data Menu Table</h4>
                          <div class="card-header-form">
                              <form>
                                  <div class="input-group">
                                      <a href="#" class="btn btn-icon icon-left btn-primary" data-toggle="modal"
                                          data-target="#newMenuModal"><i class="fas fa-plus-circle"></i>
                                          Add New Menu</a>
                                  </div>
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
                                      <th>Action</th>
                                  </tr>
                                  <?php $i=1;?>
                                  <?php foreach($menu as $m):?>
                                  <tr>
                                      <td>
                                          <?=$i;?>.
                                      </td>
                                      <td><?= $m['menu']?></td>
                                      <td class="align-middle">
                                          <a href="#" class="badge btn-icon icon-left badge-success" data-toggle="modal"
                                              data-target="#editMenuModal<?=$m['id']?>"><i
                                                  class=" far fa-edit"></i>Edit</a>
                                          <a href="<?=base_url('menu/delete/'.$m['id'])?>"
                                              class="badge btn-icon icon-left badge-danger"
                                              onclick="return confirm('Are you sure you want to delete this menu?');"><i
                                                  class="fas fa-trash-alt"></i>Delete</a>
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
          <!--Add Menu Modal-->
          <div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form action="<?=base_url('menu')?>" method="post">
                          <div class="modal-body">
                              <div class="form-group">
                                  <label></label>
                                  <input type="text" id="menu" name="menu" placeholder="Menu Name" class="form-control">
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Add</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          <!-- Edit Menu Modal -->
          <?php
        foreach($menu as $m):
            $m_id=$m['id'];
            $m_menu=$m['menu'];
            
        ?>
          <div class="modal fade" id="editMenuModal<?=$m_id?>" tabindex="-1" role="dialog"
              aria-labelledby="editMenuModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form action="<?=base_url('menu/update/').$m_id?>" method="post">
                          <div class="modal-body">
                              <div class="form-group">
                                  <label></label>
                                  <input type="text" id="menu" name="menu" value="<?=$m_menu?>" class="form-control">
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          <?php endforeach;?>
      </div>
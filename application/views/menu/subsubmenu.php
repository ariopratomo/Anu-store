<!-- Main Content -->
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Alert  -->
                <?php if (validation_errors()):?>
                <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                    <?= validation_errors();?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                            aria-hidden="true">&times;</span></button>
                </div>
                <?php endif?>
                <?= form_error('menu','<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">','<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>')?>
                <?= $this->session->flashdata('message');?>
                <div class="card-header">
                    <h4>Data Menu Table</h4>
                    <div class="card-header-form">
                        <form>
                            <div class="input-group">
                                <a href="#" class="btn btn-icon icon-left btn-primary" data-toggle="modal"
                                    data-target="#newSubSubMenuModal"><i class="fas fa-plus-circle"></i>
                                    Add New Submenu</a>
                            </div>
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
                                    <th>Title</th>
                                    <th>Submenu</th>
                                    <th>Menu</th>
                                    <th>Url</th>
                                    <th>Icon</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                <?php foreach($subsubMenu as $ssm):?>
                                <tr>
                                    <td>
                                        <?=$i;?>.
                                    </td>
                                    <td><?= $ssm['menu_title']?></td>
                                    <td><?= $ssm['title']?></td>
                                    <td><?= $ssm['menu']?></td>
                                    <td><?= $ssm['url']?></td>
                                    <td><?= $ssm['icon']?></td>
                                    <td><?php
                                    if ($ssm['is_active']==TRUE) {
                                    echo '<i class="fas fa-check text-success"></i>';
                                    }else{
                                    echo '<i class="fas fa-times text-danger"></i>';
                                    }
                                    ?>
                                    </td>
                                    <td class="align-middle">
                                        <a href="#" class="badge btn-icon icon-left badge-success" data-toggle="modal"
                                            data-target="#editSubSubMenuModal<?=$ssm['id']?>"><i
                                                class=" far fa-edit"></i>Edit</a>
                                        <a href="<?=base_url('menu/deletessm/'.$ssm['id'])?>"
                                            class="badge btn-icon icon-left badge-danger"
                                            onclick="return confirm('Are you sure you want to delete this menu?');"><i
                                                class="fas fa-trash-alt"></i>Delete</a>
                                    </td>
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
    <!--Add Menu Modal-->
    <div class="modal fade" id="newSubSubMenuModal" tabindex="-1" role="dialog"
        aria-labelledby="newSubSubMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSubSubMenuModalLabel">Add New Submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('menu/subsubmenu')?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label></label>
                            <input type="text" id="title" name="title" placeholder="Sub Menu Title"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="submenu_id" id="submenu_id">
                                <option value="">Select Menu</option>
                                <?php foreach($subMenu as $sm) : ?>
                                <option value="<?=$sm['id']?>"><?=$sm['title']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="text" id="url" name="url" placeholder="Sub Menu Url" class="form-control">
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="text" id="icon" name="icon" placeholder="Sub Menu Icon" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" value="1" id="is_active"
                                    name="is_active" checked>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
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
    foreach($subsubMenu as $ssm):
    $ssm_id=$ssm['id'];
    $ssm_menuId=$ssm['submenu_id'];
    $ssm_title=$ssm['menu_title'];
    $ssm_url=$ssm['url'];
    $ssm_icon=$ssm['icon'];
    $ssm_active=$ssm['is_active'];
    
    ?>
    <div class="modal fade" id="editSubSubMenuModal<?=$ssm_id?>" tabindex="-1" role="dialog"
        aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubSubMenuModalLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('menu/updatessm/').$ssm_id?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label></label>
                            <input type="text" id="title" name="title" value="<?=$ssm_title?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="submenu_id" id="submenu_id">
                                <option value="">Select Menu</option>
                                <option value="<?=$ssm['submenu_id']?>" selected><?=$ssm['title']?></option>
                                <?php foreach($subMenu as $sm) : ?>
                                <option value="<?=$sm['id']?>"><?=$sm['title']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="text" id="url" name="url" placeholder="Sub Menu Url" value="<?=$ssm_url?>"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="text" id="icon" name="icon" placeholder="Sub Menu Icon" value="<?=$ssm_icon?>"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" value="1" id="is_active"
                                    name="is_active" checked>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>
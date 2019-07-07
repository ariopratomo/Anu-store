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
                        <table class="table table-striped">
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>Title</th>
                                <th>Menu</th>
                                <th>Url</th>
                                <th>Icon</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            <?php $i=1;?>
                            <?php foreach($subMenu as $sm):?>
                            <tr>
                                <td>
                                    <?=$i;?>.
                                </td>
                                <td><?= $sm['title']?></td>
                                <td><?= $sm['menu']?></td>
                                <td><?= $sm['url']?></td>
                                <td><?= $sm['icon']?></td>
                                <td><?php
                                        if ($sm['is_active']==TRUE) {
                                            echo '<i class="fas fa-check text-success"></i>';
                                        }else{
                                            echo '<i class="fas fa-times text-danger"></i>';
                                        }

                                  ?></td>
                                <td class="align-middle">
                                    <a href="#" class="badge btn-icon icon-left badge-success" data-toggle="modal"
                                        data-target="#editSubSubMenuModal<?=$sm['id']?>"><i
                                            class=" far fa-edit"></i>Edit</a>
                                    <a href="<?=base_url('menu/deletesm/'.$sm['id'])?>"
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
                <form action="<?=base_url('menu/submenu')?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label></label>
                            <input type="text" id="title" name="title" placeholder="Sub Menu Title"
                                class="form-control">
                        </div>
                        <div class="form-group">

                            <select class="form-control" name="menu_id" id="menu_id">
                                <option value="">Select Menu</option>
                                <?php foreach($menu as $m) : ?>
                                <option value="<?=$m['id']?>"><?=$m['menu']?></option>
                                <?php endforeach ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="hidden" id="url" name="url" value="" placeholder="Sub Menu Url"
                                class="form-control">
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
		foreach($subMenu as $sm):
            $sm_id=$sm['id'];
            $sm_menuId=$sm['menu_id'];
            $sm_title=$sm['title'];
            $sm_url=$sm['url'];
            $sm_icon=$sm['icon'];
            $sm_active=$sm['is_active'];
			
		?>
    <div class="modal fade" id="editSubSubMenuModal<?=$sm_id?>" tabindex="-1" role="dialog"
        aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubSubMenuModalLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('menu/updatesm/').$sm_id?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label></label>
                            <input type="text" id="title" name="title" value="<?=$sm_title?>" class="form-control">
                        </div>
                        <div class="form-group">

                            <select class="form-control" name="menu_id" id="menu_id">
                                <option value="">Select Menu</option>
                                <option value="<?=$sm['menu_id']?>" selected disable><?=$sm['menu']?></option>
                                <?php foreach($menu as $m) : ?>
                                <option value="<?=$m['id']?>"><?=$m['menu']?></option>
                                <?php endforeach ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="text" id="url" name="url" placeholder="Sub Menu Url" value="<?=$sm_url?>"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="text" id="icon" name="icon" placeholder="Sub Menu Icon" value="<?=$sm_icon?>"
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
<div class="main-content">
  <section class="section">
    
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <?= form_error('subcategory','<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">','<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>')?>
            <?= $this->session->flashdata('message');?>
            <div class="card-header">
              <h4>Subcategory</h4>
              <div class="card-header-form">
                <form>
                  <div class="input-group">
                    <a href="#" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#addsubCategoryModal"><i class="fas fa-plus-circle"></i>
                    Add New Subcategory</a>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-md" id="tabel-data">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;?>
                    <?php foreach ($subcategory as $sc) :
                    $id_sc = $sc['id_sc'];
                    ?>
                    <tr>
                      <td><?=$i;?>.</td>
                      <td><?= $sc['subcategory'] ?></td>
                      <td><?= $sc['category'] ?></td>
                      <td>
                        <a href="" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#editsubCategoryModal<?=$sc['id_sc']?>"><i class="fas fa-edit"></i> Edit</a>
                        <a href="<?=base_url('product/deletesubCat/'.$sc['id_sc'])?>" onclick="return confirm('Are you sure you want to delete this category?');" class="btn btn-icon icon-left btn-danger" ><i class=" far fa-trash-alt"></i> Delete</a>
                        
                      </td>
                      <?php $i++;?>
                      
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>
</div>
<!-- The Modal Add -->
<div class="modal" id="addsubCategoryModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Subcategory</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?=base_url('product/subcategory')?>" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label></label>
              <input type="text" id="subcategory" name="subcategory" placeholder="Category Name" class="form-control">
            </div>
            <div class="form-group">
              <select class="form-control" name="category_id" id="category_id" required="">
                <option readonly>Selected Category</option>
                <?php foreach($category as $c) : ?>
                <option value="<?=$c['category_id']?>"> <?=$c['category']?></option>
                <?php endforeach ?>
              </select>
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
</div>
<!-- The Modal Edit -->
<?php
foreach($subcategory as $sc):
$id_sc=$sc['id_sc'];
$sc_subcategory=$sc['subcategory'];
?>
<div class="modal" id="editsubCategoryModal<?=$id_sc?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Subcategory</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?=base_url('product/updatesubcat/').$id_sc?>" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label></label>
              <input type="text" id="subcategory" name="subcategory" placeholder="Category Name" class="form-control" value="<?= $sc['subcategory']?>">
            </div>
            <div class="form-group">
              <select class="form-control" id="category_id" name="category_id">
                <option>Select Category</option>
                <?php foreach ($category as $c): ?>
                <option value="<?=$c['category_id']?>""> <?=$c['category']?></option>
                <?php endforeach ?>
                
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Edit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
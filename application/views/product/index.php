<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <?= $this->session->flashdata('message');?>
            <div class="card-header">
              <h4>Product</h4>
              <div class="card-header-form">
                <form>
                  <div class="input-group">
                    <a href="<?= base_url('product/addproduct') ?>" class="btn btn-icon icon-left btn-primary" ><i class="fas fa-plus-circle"></i>
                    Add New Product</a>
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
                      <th>Subcategory</th>
                      <th>Price</th>
                      <th>Discount</th>
                      <th>Price Total</th>
                      <th>Stock</th>
                      <th>Image</th>
                      <th>Date Input</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;?>
                    <?php foreach ($product as $p) :?>
                      
                    <tr>
                      <td><?=$i;?>.</td>
                      <td><?= $p['product'] ?></td>
                      
                      <td><?php if($p['category']){
                        echo $p['category'];
                        } else {
                        echo "No Category";
                      }  ?></td>
                      <td><?php if($p['subcategory']){
                        echo $p['subcategory'];
                        } else {
                        echo "No Subcategory";
                      }  ?></td>
                      <td><?= rupiah($p['price']); ?></td>
                      <td><?= $p['discount']."%"; ?></td>
                      <td><?= rupiah($p['price_total']); ?></td>
                      <td><?= $p['stock'] ?></td>
                      <td><img src="<?= base_url('include/assets/img/products/').$p['image'] ?>" alt="<?= $p['product'] ?>" class="img-fluid img-thumbnail rounded zoom" data-toggle="tooltip" data-placement="top" title="Edit this product"></td>
                      <td><?= date('d-m-Y', $p['dateinput'])?></td>
                      <td>
                        <a href="<?=base_url('product/editproduct/'.$p['id_product'])?>" class="btn btn-icon icon-left  btn-primary" data-toggle="tooltip" data-placement="top" title="Edit this product"><i class="fas fa-edit"></i></a>
                        <a href="<?=base_url('product/delProduct/'.$p['id_product'])?>" class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" data-placement="top" title="Delete this product" ><i
                        class=" far fa-trash-alt" > </i></a>
                      </td>
                    </tr>
                    
                    <?php $i++;?>
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
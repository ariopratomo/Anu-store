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
                      <td><?= $p['description']; ?></td>
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
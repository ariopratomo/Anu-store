<div class="main-content">
    <section class="section">
        <!--  -->
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>New Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('product/addproducts') ?>" method="post"
                                enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group  col-md-8">
                                        <label class="col-form-label" for="product">Product Name</label>
                                        <input type="text" class="form-control" id="product" name="product"
                                            placeholder="Product Name" value="<?= set_value('product')?>" />
                                        <?= form_error('product','<small class="text-danger pl-1">','</small>')?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label" for="stock">Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock"
                                            placeholder="0" value="<?= set_value('stock')?>" />
                                        <?= form_error('stock','<small class="text-danger pl-1">','</small>')?>
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="col">
                                        <label class="col-form-label" for="category">Category</label>
                                        <select id="category" name="category" class="form-control">
                                            <option value="">Choose Category</option>
                                            <?php foreach ($categories as $c): ?>
                                            <option value="<?= $c['id_categories'] ?>"><?= $c['name_categories'] ?>
                                            </option>
                                            <?php endforeach ?>
                                        </select>
                                        <?= form_error('category','<small class="text-danger pl-1">','</small>')?>
                                    </div>
                                    <div class="col-form-label" class="col">
                                        <label for="codecat">Code Cat</label>
                                        <input type="text" class="form-control" id="codecat" name="codecat"
                                            placeholder="CodeCat" value="" />
                                    </div>

                                </div>
                                <div class="form-row mb-4">
                                    <div class="col">
                                        <label class="col-form-label" for="weight">Weight</label>
                                        <input type="number" class="form-control" id="weight" name="weight"
                                            placeholder="gram" value="<?= set_value('weight')?>" />
                                        <?= form_error('weight','<small class="text-danger pl-1">','</small>')?>
                                    </div>
                                    <div class="col">
                                        <label class="col-form-label" for="code_p">Products Code</label>
                                        <input type="text" class="form-control" id="code_p" name="code_p"
                                            placeholder="products code" value="" />
                                        <?= form_error('code_p','<small class="text-danger pl-1">','</small>')?>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label class="col-form-label" for="price">Price Rp.</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            placeholder="Before Discount" value="<?= set_value('price')?>" />
                                        <?= form_error('price','<small class="text-danger pl-1">','</small>')?>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label" for="discount">Discount %</label>
                                        <input type="number" data-toggle="tooltip"
                                            title="Enter '0' if you don't have a discount" class="form-control"
                                            id="discount" name="discount" placeholder="%" />
                                        <?= form_error('discount','<small class="text-danger pl-1">','</small>')?>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label class="col-form-label" for="price_total">Price Total Rp.</label>
                                        <input type="number" class="form-control" readonly="" id="price_total"
                                            name="price_total" placeholder="After discount"
                                            value="<?= set_value('price_total')?>" />
                                        <?= form_error('price_total','<small class="text-danger pl-1">','</small>')?>
                                    </div>

                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-12">
                                        <label class="col-form-label" for="description">Description</label>
                                        <textarea class="summernote" id="description" name="description"
                                            value="<?= set_value('description')?>"><?= set_value('description')?></textarea>
                                        <div class="invalid-feedback">Description is invalid!.</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-9 align-self-center ">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="col-3 mr-0">
                                        <img src="#" class=" mx-auto rounded img-fluid img-thumbnail" width="200"
                                            alt="Product Image">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label" class="col-form-label text-left"></label>
                                    <div class="col-12">
                                        <input type="submit" class="btn btn-primary" value="Add" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
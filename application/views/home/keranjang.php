<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content bg padding-y ">
    <div class="container">
        <?= form_open('chekout');?>

        <div class="row">

            <main class="col-sm-9">
                <div class="card">
                    <table class="table table-hover shopping-cart-wrap">
                        <thead class="text-muted">
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Catatan</th>
                                <th scope="col" width="120">Jumlah</th>
                                <th scope="col" width="120">Harga</th>
                                <th scope="col" class="text-right" width="200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!$keranjang) {
                           echo "<tr  ><td align='center' colspan='5'>
                           <small class='small text-muted'>Kosong</small>
                           </td></tr>"; $k =TRUE;
                        } else{ ?>
                            <?php  foreach ($keranjang as $item){ ?>
                            <?php echo form_hidden('id_cart[]', $item['id_cart']); ?>
                            <?php echo form_hidden('tweight', $tweight); ?>

                            <?php echo form_hidden('status_tmp[]', 1); ?>
                            <tr>
                                <td>
                                    <figure class="media">
                                        <div class="img-wrap"><img
                                                src="<?= base_url('include/assets/img/products/').$item['image'] ?>"
                                                class="img-thumbnail img-sm"></div>
                                        <figcaption class="media-body">
                                            <h6 class="title text-truncate"><?= $item['name_products'] ?> </h6>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    <?= $item['note'] ?>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <?= $item['qty'] ?>
                                        <?php echo form_hidden('name', $item['qty']); ?>
                                        <?php echo form_hidden('idp', $item['id_product']); ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="price-wrap">
                                        <var class="price"><?= rupiah($item['c_price']) ?></var>
                                    </div>
                                    <!-- price-wrap .// -->
                                </td>
                                <td class="text-right">
                                    <button type="button" class="btn btn-outline-warning" data-toggle="modal"
                                        data-target="#modelEdit<?=$item['id_cart']?>">
                                        Edit
                                    </button>

                                    <a href="<?= base_url('keranjang/delcart')."/".$item['id_cart']?>"
                                        class="btn btn-outline-danger"> × Remove</a>
                                </td>

                            </tr>
                            <?php };?>
                            <?php }?>

                        </tbody>
                    </table>
                </div>

                <!-- card.// -->
            </main>
            <!-- col.// -->
            <aside class="col-sm-3 pt-4">
                <!-- <p class="alert alert-success">Add USD 5.00 of eligible items to your order to qualify for FREE
                    Shipping. </p> -->

                <!-- Test -->
                <?= $tweight ?>
                <?php if(!$keranjang): ?>
                <dl class="dlist-align h4">
                    <dt>Total:</dt>
                    <dd class="text-right"><strong>0</strong></dd>
                </dl>
                <button class="btn btn-primary btn-lg btn-block font-weight-bold mt-3" disabled>Beli</button>
                <?php else: ?>
                <dl class="dlist-align h4">
                    <dt>Total:</dt>
                    <dd class="text-right"><strong> <?= rupiah($tprice); ?></strong>
                    </dd>

                    <input type="hidden" id="anua" value="<?= $tprice ?>">
                </dl>
                <button class="btn btn-primary btn-lg btn-block font-weight-bold mt-3">Beli</button>

                <?php endif ?>

                <!-- Test end -->




                <hr>
                <figure class="itemside mb-3">

                    <div class="text-wrap small text-muted">
                        Harga diatas belum termasuk ongkos kirim.
                    </div>
                </figure>

            </aside>
            <!-- col.// -->

        </div>
        <?= 
            form_close();
             ?>
        <a href="<?= base_url() ?>"><button class="btn btn-success font-weight-bold float-right">Lanjutkan
                Belanja</button></a>
    </div>
    <!-- container .//  -->
</section>
<!-- Modal Edit -->

<!-- Button trigger modal -->


<!-- Modal -->

<?php if($keranjang): ?>
<?php
foreach($keranjang as $item):
// $c_id=$c['id_categories'];
// $c_category=$c['name_categories'];
// $c_code=$c['code_categories'];
?>
<div class="modal fade" id="modelEdit<?=$item['id_cart']?>" tabindex="-1" role="dialog" aria-labelledby="modelEditLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelEditLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>keranjang/updatecart/<?=$item['id_cart']?>" method="post">
                <?php echo form_hidden('id_product', $item['id_product']); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Catatan</label>
                        <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="3"
                            maxlength="25"><?=$item['note']?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Jumlah Beli</label>
                        <input class="form-control" name="qty" type="number" value="<?=$item['qty']?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php endforeach; endif ?>
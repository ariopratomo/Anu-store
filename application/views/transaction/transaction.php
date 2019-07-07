<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <?= $this->session->flashdata('message');?>
                        <div class="card-header">
                            <h4>Transaction</h4>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-md" id="tabel-data">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Courier</th>
                                            <th>Service</th>
                                            <th>Resi</th>
                                            <th>Status</th>
                                            <th>Order Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order as $o) :?>
                                        <tr>
                                            <td><?= $o['id_order'] ?></td>
                                            <td><?= $o['fullname'] ?></td>
                                            <td><?= $o['kurir'] ?></td>
                                            <td><?= $o['service'] ?></td>
                                            <?php if($o['status'] != 'Terkirim'):
                                            ?>
                                            <td>-</td>
                                            <?php else:?>
                                            <td><?= $o['resi'] ?></td>
                                            <?php endif ?>
                                            <td><?= $o['status'] ?></td>
                                            <td><?= $o['date'] ?></td>
                                            <td>
                                                <?php if($o['status'] == 'Proses'):
                                            ?>
                                                <a href="<?= base_url('transaction/detail_order/'.$o['id_order'])?>">
                                                    <button class="btn btn-info btn-sm" data-toggle="tooltip"
                                                        title="Detail Order"><i class="fas fa-info"></i></button></a>
                                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#myModal<?=$o['id_order']?>"><i
                                                        class="fas fa-pencil-alt" data-toggle="tooltip"
                                                        title="Edit"></i></button>
                                                <a href="<?= base_url('transaction/reject_order/'.$o['id_order'])?>">
                                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                        title="Payment Rejected"><i class="fas fa-ban"></i></button></a>

                                                <a href="<?= base_url('transaction/delete_order/'.$o['id_order'])?>"><button
                                                        value="Delete" class="btn btn-warning btn-sm"
                                                        data-toggle="tooltip" title="Delete"><i
                                                            class="fas fa-trash"></i></button></a>


                                                <?php else:?>
                                                <a href="<?= base_url('transaction/detail_order/'.$o['id_order'])?>">
                                                    <span class="btn btn-info btn-sm" data-toggle="tooltip"
                                                        title="Detail Order"><i class="fas fa-info te"></i></span>
                                                </a>
                                                <a href="<?= base_url('transaction/delete_order/'.$o['id_order'])?>"><button
                                                        value="Delete" class="btn btn-warning btn-sm"
                                                        data-toggle="tooltip" title="Delete"><i
                                                            class="fas fa-trash"></i></button></a>
                                                <?php endif ?>

                                            </td>
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
<?php foreach ($order as $key ) {
 ?>

<!-- The Modal -->
<div class="modal fade" id="myModal<?= $key['id_order']?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Status</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="" method="post">
                <div class="modal-body">
                    <?= 
                    form_hidden('id_order', $key['id_order']);
                    ?>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status">
                            <option value="Terkirim" selected>Shipped</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="resi">Resi</label>
                        <input type="text" class="form-control" name="resi" required id="resi">
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="input" value="Input">Input</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php }?>
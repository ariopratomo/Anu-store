<div class="container bg-white shadow-sm">
    <div class="p-4">
        <table class="table table-sm" id="tabel-order">
            <thead>
                <tr>
                    <th scope="col">ID ORDER</th>
                    <th scope="col">Penerima</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Tanggal Order</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order as $o) {?>
                <tr>
                    <td><a href="<?= base_url('history_order/detail/').$o['id_order']?>"><?= $o['id_order'] ?></a></td>
                    <td><?= $o['receiver'] ?></td>
                    <td><?= rupiah($o['total']) ?></td>
                    <td><?= date('d-m-Y', strtotime($o['date'])) ?></td>
                    <td><?= $o['status'] ?></td>
                    <?php if ($o['status']=='Menunggu Pembayaran') {?>
                    <td><button class="btn btn-info" data-toggle="modal"
                            data-target="#upload<?=$o['id_order']?>">Bayar</button></td>


                    <?php } ?>

                </tr>
                <?php  } ?>

            </tbody>
        </table>

    </div>
</div>
<div class="modal fade" id="upload<?=$o['id_order']?>" tabindex="-1" role="dialog" aria-labelledby="uploadTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadTitle">Bukti Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('');?>
            <?= form_hidden('id_user', $user['id_user']); ?>
            <?= form_hidden('id_order', $o['id_order']); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="accname">A/N</label>
                    <input type="text" name="acc_name" class="form-control" required id="accname" placeholder="Nama">
                </div>
                <div class="form-group">
                    <?php $q=$this->db->get('bank');
                                        $query = $q->result_array();
                                        ?>
                    <label for="daribank">Dari Bank</label>
                    <select class="form-control" id="daribank" required name="code_bank">
                        <?php foreach ($query as $key) { ?>
                        <option value="<?=$key['code']?>"><?=$key['name']?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="norek">No.Rek</label>
                    <input type="text" name="norek" class="form-control" required id="norek" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="banktujuan">Bank tujuan</label>
                    <select class="form-control" id="banktujuan" required name="dest_rek">
                        <option value="" disabled selected>Pilih Bank Tujuan</option>
                        <option value="BCA">BCA</option>
                        <option value="Mandiri">Mandiri</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="align-self-center ">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="upload" value="upload">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('.table').DataTable();
});
</script>
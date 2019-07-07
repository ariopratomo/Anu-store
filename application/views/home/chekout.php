<div class="container bg-white shadow-sm">
    <div class="container p-4">
        <form method="post" action="">
            <?php foreach($keranjang as $item):?>
            <?= form_hidden('id_product', $item['id_product']); ?>
            <?php echo form_hidden('status_tmp[]', 1); ?>
            <?= form_hidden('id_cart', $item['id_cart']); ?>

            <?= form_hidden('idc[]', $item['id_cart']); ?>
            <input type="hidden" value="<?=$tprice?>" name="tprice" id="tprice">
            <?php echo form_hidden('tweight', $tweight); ?>

            <?php  endforeach ?>
            <div class="form-row">
                <div class="form-inline  p-3 col">
                    <div class="form-group">
                        <label for="receiver" class="font-weight-bold">Penerima </label>
                        <input type="text" class="form-control mx-sm-3 border-bottom" style="border: 0;" name="receiver"
                            id="receiver" placeholder="Nama penerima" name="receiver" required
                            value="<?= set_value('receiver')?>">
                    </div>
                </div>
                <div class="form-inline  p-3 col">
                    <div class="form-group">
                        <label for="tlp" class="font-weight-bold">No. Tlp/Hp </label>
                        <input type="number" class="form-control mx-sm-3 border-bottom" style="border: 0;" name="tlp"
                            id="tlp" placeholder="0812" required value="<?= set_value('tlp')?>">
                    </div>
                </div>
            </div>

            <div class="form-row p-3">
                <div class='form-group col-md-6'>
                    <label for="exampleFormControlTextarea1">Alamat penerima</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Jl. Anu"
                        name="saddress" rows="3" required></textarea>
                </div>
                <div class="col-md-6 ">
                    <table class="mt-4 float-right table">
                        <?php  foreach ($keranjang as $item){ ?>
                        <tr>
                            <td class="p-0">
                                <small class="title text-truncate"><?= $item['name_products'] ?> </small>

                            </td>
                            <td class="p-0">
                                <span class="title text-truncate">x<?= $item['qty'] ?> </span>
                            </td>
                            <td class="p-0">
                                <span class="title text-truncate"><?= rupiah($item['c_price']) ?> </span>
                            </td>
                        </tr>

                        <?php }?>
                        <tr class="table-info">
                            <th colspan="2" class="p-0">Total Harga</th>
                            <td class="p-0"><?= rupiah($tprice)?></td>
                        </tr>
                    </table>
                </div>

            </div>


            <div class="form-group p-3">
                <div class="form-row mb-3">
                    <div class='form-group col-md-6'>
                        <label>Provinsi</label>
                        <select class='form-control' id='prov' name="prov">
                            <option value='0'>--pilih--</option>
                            <?= $this->load->view('prov');?>
                        </select>
                    </div>
                    <div class='form-group col-md-3'>
                        <label>Kota / Kabupaten</label>
                        <select class='form-control' id='kota' name="kota">
                            <option value='0'>--pilih--</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="validationCustom05">Kode pos</label>
                        <input type="text" class="form-control" id="validationCustom05" placeholder="Kode pos"
                            required="">

                    </div>

                </div>
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <label>Pilih Kurir</label>
                        <select class='form-control' id='kurir' name="kurir">
                            <option value='0'>--Pilih Kurir--</option>
                            <option value="pos">POS</option>
                            <option value="jne">JNE</option>
                        </select>
                    </div>
                    <div class='form-group col-md-3'>
                        <label>Layanan</label>
                        <select class='form-control' id='layanan' name="layanan">
                            <option value='0'>--pilih--</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ongkir">Ongkir Rp.</label>
                        <input type="text" class="form-control" name="ongkir" id="ongkir" value="" readonly required>

                        <label for="total" class="mt-2">Total bayar Rp.</label>
                        <input type="text" class="form-control" id="total" name="total" value="" readonly required>

                    </div>
                    <div class="form-group">

                    </div>
                </div>
                <button class="btn btn-danger float-right" type="submit" name="bayar" value="Bayar">Bayar</button>

        </form>



    </div>
</div>

<script type="text/javascript">
// $(function() {
//     $.ajaxSetup({
//         type: "POST",
//         url: "<?php echo base_url('signup/ambil_data') ?>",
//         cache: false,
//     });
//     $("#provinsi").change(function() {
//         var value = $(this).val();
//         if (value > 0) {
//             $.ajax({
//                 data: {
//                     modul: 'kabupaten',
//                     id: value
//                 },
//                 success: function(respond) {
//                     $("#kabupaten-kota").html(respond);
//                 }
//             })
//         }
//     });
//     $("#kabupaten-kota").change(function() {
//         var value = $(this).val();
//         if (value > 0) {
//             $.ajax({
//                 data: {
//                     modul: 'kecamatan',
//                     id: value
//                 },
//                 success: function(respond) {
//                     $("#kecamatan").html(respond);
//                 }
//             })
//         }
//     })
//     $("#kecamatan").change(function() {
//         var value = $(this).val();
//         if (value > 0) {
//             $.ajax({
//                 data: {
//                     modul: 'kelurahan',
//                     id: value
//                 },
//                 success: function(respond) {
//                     $("#kelurahan-desa").html(respond);
//                 }
//             })
//         }
//     })
// })
$(document).ready(function() {
    $('#prov').change(function() {
        var prov = $('#prov').val();
        var province = prov.split(',');

        $.ajax({
            url: "<?=base_url();?>chekout/city",
            method: "POST",
            data: {
                prov: province[0]
            },
            success: function(obj) {
                $('#kota').html(obj);
            }
        });
    });

    $('#kurir').change(function() {
        var kota = $('#kota').val();
        var dest = kota.split(',');
        var kurir = $('#kurir').val()

        $.ajax({
            url: "<?=base_url();?>chekout/getcost",
            method: "POST",
            data: {
                dest: dest[0],
                kurir: kurir
            },
            success: function(obj) {
                $('#layanan').html(obj);
            }
        });
    });

    // $('#kurir').change(function() {
    //     var kota = $('#kota').val();
    //     var dest = kota.split(',');
    //     var kurir = $('#kurir').val()

    //     $.ajax({
    //         url: "<?=base_url();?>chekout/getcost",
    //         method: "POST",
    //         data: {
    //             dest: dest[0],
    //             kurir: kurir
    //         },
    //         success: function(obj) {
    //             $('#layanan').html(obj);
    //         }
    //     });
    // });
    $('#layanan').change(function() {
        var layanan = $('#layanan').val();
        var tprice = $('#tprice').val();

        $.ajax({
            url: "<?=base_url();?>chekout/cost",
            method: "POST",
            data: {
                layanan: layanan,
                tprice: tprice
            },
            success: function(obj) {
                var hasil = obj.split(",");


                $('#ongkir').val(hasil[0]);
                $('#total').val(hasil[1]);
                $('totl').val(hasil[1]);


            }
        });
    });




});
</script>
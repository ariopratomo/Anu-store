<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Bootstrap-ecommerce by Vosidiy">
    <title>Anu Store - #<?=$inpo['id_order']?></title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <!-- jQuery -->
    <script src="<?= base_url('assets/')?>js/jquery-2.0.0.min.js" type="text/javascript"></script>
    <!-- Bootstrap4 files-->
    <script src="<?= base_url('assets/')?>js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <link href="<?= base_url('assets/')?>css/bootstrap.css" rel="stylesheet" type="text/css" />


    <!-- custom style -->
    <link href="<?= base_url('assets/')?>css/ui.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/')?>css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/')?>css/responsive.css" rel="stylesheet"
        media="only screen and (max-width: 1200px)" />



    <!-- 
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script> -->

</head>

<body class="" style="background-color:#ffffff"><br />


    <div class="container bg-white ">
        <div class="content-body ">
            <section class="shadow-sm card">

                <div id="invoice-template" class="card-body">
                    <div id="section-to-print">
                        <!-- Invoice Company Details -->
                        <div id="invoice-company-details" class="row">
                            <div class="col-md-6 col-sm-12 text-center text-md-left">
                                <div class="col-sm-12 text-center text-md-left">
                                    <p class="text-muted">Status</p>
                                </div>
                                <div class="col-md-6 col-sm-12 text-center text-md-left">
                                    <ul class="px-0 list-unstyled">
                                        <?php if($inpo['status']=='Menunggu Pembayaran'):?>
                                        <li class="font-weight-bold bg-danger text-center text-white">
                                            <?=$inpo['status']?>
                                        </li>
                                        <?php elseif($inpo['status']=='Proses'):?>
                                        <li class="font-weight-bold bg-warning text-center text-white">
                                            <?=$inpo['status']?>
                                            <?php else:?>
                                        <li class="font-weight-bold bg-success text-center text-white">
                                            <?=$inpo['status']?>
                                        </li>
                                        <?php endif?>
                                    </ul>
                                </div>

                            </div>
                            <div class="col-md-6 col-sm-12 text-center text-md-right">
                                <h2>INVOICE</h2>
                                <p class="pb-3">#<?=$inpo['id_order']?></p>
                                <ul class="px-0 list-unstyled">
                                    <li>Total Bayar</li>
                                    <li class="lead text-bold-800"><?= rupiah($inpo['total']) ?></li>
                                    <?php if ($inpo['status']!='Menunggu Pembayaran') {?>
                                    <li class="mt-2">Bukti Bayar</li>
                                    <li class="mt-2">
                                        <?php 
                                            $this->db->where('id_order',$inpo['id_order']);
                                            $bukti = $this->db->get('payment')->row_array(); ?>

                                        <a href="" data-toggle="modal" data-target="#upload<?=$inpo['id_order']?>"><img
                                                src=" <?= base_url('include/assets/img/proof/').$bukti['image'] ?>"
                                                class="img-sm"></a>

                                    </li>
                                    <?php } ?>

                                    <li></li>

                                </ul>
                            </div>
                        </div>
                        <!--/ Invoice Company Details -->

                        <!-- Invoice Customer Details -->
                        <div id=" invoice-customer-details" class="row pt-2">
                            <div class="col-sm-12 text-center text-md-left">
                                <p class="text-muted">Penerima</p>
                            </div>
                            <div class="col-md-6 col-sm-12 text-center text-md-left">
                                <ul class="px-0 list-unstyled">
                                    <li class="text-bold-800"><?=$inpo['receiver']?></li>
                                    <li><?=$inpo['s_address']?></li>

                                </ul>
                            </div>
                            <div class="col-md-6 col-sm-12 text-center text-md-right">
                                <p><span class="text-muted">Invoice Date :</span>
                                    <?= date('d/m/Y', strtotime($inpo['date'])) ?></p>
                            </div>
                        </div>
                        <!--/ Invoice Customer Details -->

                        <!-- Invoice Items Details -->
                        <div id="invoice-items-details" class="pt-2">
                            <div class="row">
                                <div class="table-responsive col-sm-12">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item &amp; Catatan</th>
                                                <th class="text-right">Harga</th>
                                                <th class="text-right">Jumlah</th>
                                                <th class="text-right">Total Harga</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i=1;?>
                                            <?php foreach ($inpo1 as $in) {
                                   ?>
                                            <tr>
                                                <th scope="row"><?=$i;?></th>
                                                <td>
                                                    <p><?=$in['name_products']?></p>
                                                    <p class="text-muted"><?=$in['note']?></p>
                                                </td>
                                                <td class="text-right"><?= rupiah($in['price_total'])?></td>
                                                <td class="text-right"><?=$in['qty']?></td>
                                                <td class="text-right"><?= rupiah($in['c_price'])?></td>
                                            </tr>
                                            <?php $i++;?>
                                            <?php }  ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-sm-12 text-center text-md-left">
                                    <p class="lead">Methode Pengiriman</p>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td>Kurir:</td>
                                                        <?php if($inpo['kurir']=="pos"):?>
                                                        <td class="">POS</td>
                                                        <?php elseif($inpo['kurir']=="jne"):?>
                                                        <td class="">JNE</td>
                                                        <?php endif?>
                                                    </tr>
                                                    <tr>
                                                        <td>Layanan:</td>
                                                        <td class=""><?=$inpo['service']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Resi:</td>
                                                        <td class=""><?=$inpo['resi']?></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    <p class="lead">Total Harga</p>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <td>Sub Total</td>
                                                    <td class="text-right"><?= rupiah($inpo['c_total'])?></td>
                                                </tr>
                                                <tr>
                                                    <td>Ongkir</td>
                                                    <td class="text-right"><?= rupiah($inpo['shipping_c'])?></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Total </td>
                                                    <td class="font-weight-bold text-right">
                                                        <?= rupiah($inpo['total'])?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="float-right">

                        <a href="<?= base_url('transaction')?>">
                            <button type="button" id="home" class="btn btn-danger  my-1">Kembali</button>
                        </a>
                        <button type="button" id="cetak" onclick="cetak()" class="btn btn-success  my-1">Cetak
                        </button>

                        <script>
                        function cetak() {
                            document.getElementById("cetak").style.visibility = "hidden";
                            document.getElementById("home").style.visibility = "hidden";
                            window.print();
                            window.location.pathname.split('/')

                        }
                        </script>



                    </div>
                    <!-- Button trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-xl" id="upload<?=$inpo['id_order']?>" tabindex="-1"
                        role="dialog" aria-labelledby="uploadTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="uploadTitle">Bukti Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <img src="" alt="">

                                    <img src="<?= base_url('include/assets/img/proof/').$bukti['image'] ?>"
                                        class="img-fluid">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoice Footer -->
                <!-- <div id="invoice-footer">
                    <div class="row">
                        <div class="col-md-7 col-sm-12">

                        </div>
                        <div class="col-md-5 col-sm-12 text-center">
                            <button type="button" class="btn btn-primary btn-lg my-1"><i
                                    class="fa fa-paper-plane-o"></i> Send Invoice</button>
                        </div>
                    </div>
                </div> -->
                <!--/ Invoice Footer -->

                <!-- </div> -->
            </section>
        </div>
    </div>
    <style>
    .height {
        min-height: 200px;
    }

    .icon {
        font-size: 47px;
        color: #5CB85C;
    }

    .iconbig {
        font-size: 77px;
        color: #5CB85C;
    }

    .table>tbody>tr>.emptyrow {
        border-top: none;
    }

    .table>thead>tr>.emptyrow {
        border-bottom: none;
    }

    .table>tbody>tr>.highrow {
        border-top: 3px solid;
    }

    #invoice-template {
        padding: 4rem;
    }
    </style>
    <br /><br /><br />
</body>
<script>
$('.custom-file-input').on('change', function() {
    //get the file name
    var fileName = $(this).val();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
})
</script>

</html>
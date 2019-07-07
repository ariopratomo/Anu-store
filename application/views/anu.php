<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover">
                <tr class="success">
                    <th>Rowid</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Options</th>
                </tr>
                <?php foreach ($content as $item){ ?>
                <tr>
                    <td><?php echo $item['id'] ?></td>
                    <td><?php echo $item['name'] ?></td>
                    <td><?php echo number_format($item['price'], 0, '','.'); ?></td>
                    <td><?php echo $item['qty'] ?></td>
                    <td><?php echo number_format($item['subtotal'], 0, '','.') ?></td>
                    <td><?php echo $this->cart->total_items(); ?></td>
                    <?php if (@$item['options']['Size'] == FALSE){ ?>
                    <td>-</td>
                    <?php } else { ?>
                    <td><?php echo $item['options']['Size'] ?></td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </table>
            <?php
						$total =  $this->cart->total();
						echo "<h4> Rp. " . number_format($total, 0, '','.') . "</h4>";
					 ?>
        </div>
    </div>
</div>
<div class="padding-y-sm">
	<span>3897 results for "Item"</span>
</div>
<div class="row container-fluid">
	<?php foreach ($product as $p): ?>
	<div class="col-md-3 col-sm-6 py-2">
		<figure class="card card-product h-100 img-fluid img-thumbnail" class="">
			<div class="img-wrap "> <img src="<?= base_url('include/assets/img/products/').$p['image'] ?>"  ></div>
			<figcaption class="info-wrap">
			<a href="#" class="title"><?= $p['product'] ?></a>
			</figcaption>
			<div class="card-footer text-muted">
				<div class="price-wrap">
					<?php if ($p['discount']>0) {?>
					<span class="price-new"><?= rupiah($p['price_total']) ?></span>
					<del class="price-old"><?= rupiah($p['price']) ?></del>
					<?php }else {?>
					<span class="price-new"><?= rupiah($p['price_total']) ?></span>
					<?php } ?>
					</div> <!-- price-wrap.// -->
				</div>
				</figure> <!-- card // -->
			</div>
			<?php endforeach ?>
			</div> <!-- row.// -->
			</div><!-- container // -->
		</section>
		<!-- ========================= SECTION CONTENT .END// ========================= -->
		<!-- ========================= FOOTER ========================= -->
		<footer class="section-footer bg-secondary">
			<div class="container">
				<section class="footer-top padding-top">
					<div class="row">
						<aside class="col-sm-3 col-md-3 white">
							<h5 class="title">Customer Services</h5>
							<ul class="list-unstyled">
								<li> <a href="#">Help center</a></li>
								<li> <a href="#">Money refund</a></li>
								<li> <a href="#">Terms and Policy</a></li>
								<li> <a href="#">Open dispute</a></li>
							</ul>
						</aside>
						<aside class="col-sm-3  col-md-3 white">
							<h5 class="title">My Account</h5>
							<ul class="list-unstyled">
								<li> <a href="#"> User Login </a></li>
								<li> <a href="#"> User register </a></li>
								<li> <a href="#"> Account Setting </a></li>
								<li> <a href="#"> My Orders </a></li>
								<li> <a href="#"> My Wishlist </a></li>
							</ul>
						</aside>
						<aside class="col-sm-3  col-md-3 white">
							<h5 class="title">About</h5>
							<ul class="list-unstyled">
								<li> <a href="#"> Our history </a></li>
								<li> <a href="#"> How to buy </a></li>
								<li> <a href="#"> Delivery and payment </a></li>
								<li> <a href="#"> Advertice </a></li>
								<li> <a href="#"> Partnership </a></li>
							</ul>
						</aside>
						<aside class="col-sm-3">
							<article class="white">
								<h5 class="title">Contacts</h5>
								<p>
									<strong>Phone: </strong> +123456789 <br>
									<strong>Fax:</strong> +123456789
								</p>
								<div class="btn-group white">
									<a class="btn btn-facebook" title="Facebook" target="_blank" href="#"><i class="fab fa-facebook-f  fa-fw"></i></a>
									<a class="btn btn-instagram" title="Instagram" target="_blank" href="#"><i class="fab fa-instagram  fa-fw"></i></a>
									<a class="btn btn-youtube" title="Youtube" target="_blank" href="#"><i class="fab fa-youtube  fa-fw"></i></a>
									<a class="btn btn-twitter" title="Twitter" target="_blank" href="#"><i class="fab fa-twitter  fa-fw"></i></a>
								</div>
							</article>
						</aside>
						</div> <!-- row.// -->
						<br>
					</section>
					<section class="footer-bottom row border-top-white">
						<div class="col-sm-6">
							<p class="text-white-50"> Made with <3 <br>  by Vosidiy M.</p>
						</div>
						<div class="col-sm-6">
							<p class="text-md-right text-white-50">
								Copyright &copy  <br>
								<a href="http://bootstrap-ecommerce.com" class="text-white-50">Bootstrap-ecommerce UI kit</a>
							</p>
						</div>
						</section> <!-- //footer-top -->
						</div><!-- //container -->
					</footer>
					<!-- ========================= FOOTER END // ========================= -->
				</body>
			</html>
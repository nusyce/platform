<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>


<!-- END: Custom CSS-->

<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">

			<div class="card">

				<div class="d-inline-block">
					<h3 class="card-title" style="margin: 0;">
						MEMBERSHIP PACKETS </h3>
				</div>


			</div>
			<?php $this->load->view('admin/includes/_messages.php') ?>
			<div class="panel-body">
				<div class="row">
					<!-- Free Tier -->
					<?php foreach($packs as $row): ?>
						<div class="col-lg-4">
							<div class="card mb-5 mb-lg-0">
								<div class="card-body">
									<h5 class="card-title text-muted text-uppercase text-center"><?=$row['name']?></h5>
									<h6 class="card-price text-center">€<?=$row['price']?><span class="period">/month</span></h6>
									<hr>
									<?=$row['description']?>
									<form method="post" class="form-horizontal" role="form" action="<?= base_url() ?>admin/paypal/create_payment_with_paypal">
										<fieldset>
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
												   value="<?php echo $this->security->get_csrf_hash(); ?>">
											<input title="item_name" name="item_name" type="hidden" value="<?=$row['name']?>">
											<input title="item_number" name="item_number" type="hidden" value="12345">
											<input title="item_description" name="item_description" type="hidden" value="to buy <?=$row['name']?>">
											<input title="item_tax" name="item_tax" type="hidden" value="1">
											<input title="item_price" name="item_price" type="hidden" value="<?=$row['price']?>">
											<input title="item_price" name="pack_id" type="hidden" value="<?=$row['id']?>">
											<input title="details_tax" name="details_tax" type="hidden" value="0">
											<input title="details_subtotal" name="details_subtotal" type="hidden" value="<?=$row['price']?>">

											<div class="form-group">
												<div class="col-sm-offset-5">
													<button  type="submit"  class="btn btn-info">Pay Now</button>
												</div>
											</div>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					<?php endforeach;?>
					<!-- Pro Tier -->

				</div>
			</div>
		</div>
	</div>
</div>

<?php init_tail(); ?>

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body" >
			<div class="panel-body" style="background-color: white">
				<?php
				$total = ''; ?>
				<div class="row">
					<div class="col-md-12" style="margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-bottom: 1px solid #eee;">
						<h3><?= ucwords($this->session->userdata('username')); ?></h3>
					</div>
					<hr class="hr-panel-heading mbot40">
					<div class="col-md-4">
						<?php
						$title = get_menu_option('client', 'Kunder') ;
						?>
						<div class="row">
							<div class="col-md-12">
								<h4 class="no-margin"><?= $title . ': <b>' . $total . '</b>' ?></h4>
							</div>
						</div>
						<div class="row mbot15">
							<div class="col-md-12">
								<div class="panel_s">
									<div class="panel-body" style="padding: 15px  15px;">
										<?= widget_status_stats('clients', $title); ?>
										<div class="text-center" style="margin-top: 17px;"><a class="text-progress"
													href="<?= admin_url('client') ?>">Alle <?= $title ?></a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<?php
						$title = get_menu_option('mieter', 'Kundenbetreuer');
						?>
						<div class="row">
							<div class="col-md-12">
								<h4 class="no-margin"><?= $title . ': <b>' . $total . '</b>' ?></h4>
							</div>
						</div>
						<div class="row mbot15">
							<div class="col-md-12">
								<div class="panel_s">
									<div class="panel-body" style="padding: 15px  15px;">
										<?= widget_status_stats('mieters', $title); ?>
										<div class="text-center" style="margin-top: 17px;"><a class="text-progress"
																	href="<?= admin_url('mieter') ?>">Alle <?= $title ?></a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<?php
						$title = get_menu_option('mitarbeiter2', 'Mitarbeiter') ;
						?>
						<div class="row">
							<div class="col-md-12">
								<h4 class="no-margin"><?= $title . ': <b>' . $total . '</b>' ?></h4>
							</div>
						</div>
						<div class="row mbot15">
							<div class="col-md-12">
								<div class="panel_s">
									<div class="panel-body" style="padding: 15px  15px;">
										<?= widget_status_stats('admin', $title); ?>
										<div class="text-center" style="margin-top: 17px;"><a class="text-progress"
													href="<?= admin_url('admin') ?>">Alle <?= $title ?></a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</div>
		</div>
	</div>
</div>
</div>
<?php init_tail(); ?>



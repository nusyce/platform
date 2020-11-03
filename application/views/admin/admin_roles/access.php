<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content --><?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<!-- For Messages --><div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">

			<div class="card">

				<div class="d-inline-block">
					<h3 class="card-title" style="margin: 0;">
						<?=strtoupper($record['admin_role_title'])?> </h3>
				</div>


			</div>
			<?php $this->load->view('admin/includes/_messages.php') ?>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<?php foreach($modules as $kk => $module): ?>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<h5 class="m-0">
											<strong class="f-16" style="text-transform:uppercase;font-size: 16px;"><?= get_menu_option($module['controller_name'], $module['module_name']) ?></strong>
										</h5>
									</div>
									<div class="col-md-9">
										<div class="row mb-3">
											<?php foreach(explode("|",$module['operation']) as $k => $operation):?>
												<div class="col-md-3 pb-3">
	                                        <span class="pull-left">
												<div class="onoffswitch">
                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-module='<?= $module['controller_name'] ?>'
					   data-operation='<?= $operation; ?>'
					   id='cb_<?=$kk.$k?>'
	                                            <?php if (in_array($module['controller_name'].'/'.$operation, $access)) echo 'checked="checked"';?>>
                <label class="onoffswitch-label" for='cb_<?=$kk.$k?>'></label>
            </div>

	                                        </span>

													<?=ucwords($operation)?>

												</div>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
								<hr style="margin:7px 0px;" />
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<?php init_tail(); ?>

<script>
	$("body").on("change",".onoffswitch-checkbox",function(){
		$.post('<?=base_url("admin/admin_roles/set_access")?>',
				{
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
					module : $(this).data('module'),
					operation : $(this).data('operation'),
					admin_role_id : <?=$record['admin_role_id']?>,
					status : $(this).is(':checked')==true?1:0
				},
				function(data){
					//$.notify("Status Changed Successfully", "success");
				});
	});
</script>



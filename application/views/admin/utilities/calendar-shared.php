<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

	<div class="content">
		<div class="row">
		<?php $_SESSION['staff']= ($staffs); ?>
		<?php

		if(has_permission('personalplan', get_staff_user_id(), 'edit')) {
			echo '<div class="col-xs-10 col-md-12">';
		}
		else {
			echo '<div class="col-xs-12 col-md-12">';
		}
		?>
				<div class="panel_s">
					<div class="panel-body" style="overflow-x: auto;">
						<div class="dt-loader hide"></div>

						<?php
							if(has_permission('personalplan', get_staff_user_id(), 'view')){
								$this->load->view('admin/utilities/calendar_filters');
							}
						?>
						<div id="calendar"></div>
					</div>
				</div>
			</div>

			<?php
/*				if(has_permission('personalplan', get_staff_user_id(), 'edit') || is_admin()){
					echo'<div class="col-xs-2 col-md-2">
							<div class="panel_s">
								<div class="panel-body" style="overflow-x: auto;">
						';
									$this->load->view('admin/utilities/calendar_empsidelist');

					echo'		</div>
							</div>
						</div>
						';
				}
			*/?>
		</div>
<script>
	app.calendarIDs = '<?php echo json_encode($google_ids_calendars); ?>';
</script>

<style>

</style><?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="clearfix"></div>
<?php if (count($checklists) > 0) { ?>
    <h4 class="bold chk-heading th font-medium"><?php echo _l('Aufgaben Einträge'); ?></h4>
<?php } ?>
<div style="height: 1rem; border-radius: 1px;" class="progress mtop15 hide">
    <div class="progress-bar not-dynamic progress-bar-default task-progress-bar" role="progressbar" aria-valuenow="40"
         aria-valuemin="0" aria-valuemax="100" style="width:0%">
    </div>
</div>
<?php
$my_bereich=[];
foreach ($checklists as $list) {
	if ($list['bereich']!="" && !in_array($list['bereich'],$my_bereich))
	{
		array_push($my_bereich,$list['bereich']);
	}

}


?>
<?php if(count($my_bereich)>0){?>
<?php foreach($my_bereich as $ber){?>
<h4 style=" text-decoration: underline;margin-left: 30px;margin-top: 10px"><b> <?php echo $ber; ?></b></h4>
<?php foreach ($checklists as $list) {?>
<?php if($list['bereich']==$ber){?>
	 <div style="">

        <div class="checklist relative" data-checklist-id="<?php echo $list['id']; ?>">
            <div class="round">
                <input type="checkbox" <?php if ($list['finished'] == 1 && $list['finished_from'] != get_user_id() && !is_admin()) {
                    echo 'disabled';
                } ?> name="checklist-box" class="checklist-box-checkbox" <?php if ($list['finished'] == 1) {
                    echo 'checked';
                }; ?>>
				<label for="checkbox"></label>
                <textarea data-taskid="<?php echo $task_id; ?>" name="checklist-description"
                          rows="1"<?php if ($list['addedfrom'] != get_user_id() && !has_permission('tasks', '', 'edit')) {
                    echo ' disabled';
                } ?>><?php echo clear_textarea_breaks($list['description']); ?></textarea>
                <a href="#" class="pull-right text-muted remove-checklist"
                   onclick="delete_checklist_item(<?php echo $list['id']; ?>,this); return false;"><i
                            class="fa fa-remove"></i>
                </a>
                <a href="#"
                   class="pull-right text-muted mright5 save-checklist-template<?php if ($list['description'] == '' || total_rows(db_prefix() . 'tasks_checklist_templates', array('description' => $list['description'])) > 0) {
                       echo ' hide';
                   } ?>" data-toggle="tooltip" data-title="<?php echo _l('save_as_template'); ?>"
                   onclick="save_checklist_item_template(<?php echo $list['id']; ?>,this); return false;">
                    <i class="fa fa-level-up" aria-hidden="true"></i>
                </a>
            </div>
            <?php if ($list['finished'] == 1 || $list['addedfrom'] != get_user_id()) { ?>
                <p class="font-medium-xs mtop15 text-muted checklist-item-info">
                    <?php
					echo _l('task_created_by');
                    if ($list['addedfrom'] != get_user_id()) {
                        echo _l('task_created_by', get_user_full_name($list['addedfrom']));
                    }
                    if ($list['addedfrom'] != get_user_id() && $list['finished'] == 1) {
                        echo ' - ';
                    }
                    if ($list['finished'] == 1) {
                        echo 'Abgeschlossen durch '.get_user_full_name($list['finished_from']);
                    }

                    ?>
                </p>
            <?php } ?>
        </div>
    </div>
			<?php } ?>
		<?php } ?>
	<?php } ?>
	<br>
<?php } ?>
<?php foreach ($checklists as $list) {?>
<?php if($list['bereich']==null || $list['bereich']==""){?>
		<div style="">

			<div class="checklist relative" data-checklist-id="<?php echo $list['id']; ?>">
				<div class="round">
					<input type="checkbox" <?php if ($list['finished'] == 1 && $list['finished_from'] != get_user_id() && !is_admin()) {
						echo 'disabled';
					} ?> name="checklist-box" class="checklist-box-checkbox" <?php if ($list['finished'] == 1) {
						echo 'checked';
					}; ?>>
					<label for="checkbox"></label>
					<textarea data-taskid="<?php echo $task_id; ?>" name="checklist-description"
							  rows="1"<?php if ($list['addedfrom'] != get_user_id() && !has_permission('tasks', '', 'edit')) {
						echo ' disabled';
					} ?>><?php echo clear_textarea_breaks($list['description']); ?></textarea>
					<a href="#" class="pull-right text-muted remove-checklist"
					   onclick="delete_checklist_item(<?php echo $list['id']; ?>,this); return false;"><i
							class="fa fa-remove"></i>
					</a>
					<a href="#"
					   class="pull-right text-muted mright5 save-checklist-template<?php if ($list['description'] == '' || total_rows(db_prefix() . 'tasks_checklist_templates', array('description' => $list['description'])) > 0) {
						   echo ' hide';
					   } ?>" data-toggle="tooltip" data-title="<?php echo _l('save_as_template'); ?>"
					   onclick="save_checklist_item_template(<?php echo $list['id']; ?>,this); return false;">
						<i class="fa fa-level-up" aria-hidden="true"></i>
					</a>
				</div>
				<?php if ($list['finished'] == 1 || $list['addedfrom'] != get_user_id()) { ?>
					<p class="font-medium-xs mtop15 text-muted checklist-item-info">
						<?php
						echo _l('task_created_by');
						if ($list['addedfrom'] != get_user_id()) {
							echo _l('task_created_by', get_user_full_name($list['addedfrom']));
						}
						if ($list['addedfrom'] != get_user_id() && $list['finished'] == 1) {
							echo ' - ';
						}
						if ($list['finished'] == 1) {
							echo 'Abgeschlossen durch '.get_user_full_name($list['finished_from']);
						}

						?>
					</p>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
<?php } ?>
<script>
    $(function () {
        $("#checklist-items").sortable({
            helper: 'clone',
            items: 'div.checklist',
            update: function (event, ui) {
                update_checklist_order();
            }
        });
        setTimeout(function () {
            do_task_checklist_items_height();
        }, 200);
    });
</script>

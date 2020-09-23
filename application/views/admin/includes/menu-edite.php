<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal fade modal-reminder" id="modal-edit-menu<?= $module_id ?>" tabindex="-1"
     role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <?php echo form_open('admin/dashboard/edit_my_menu/', array('id' => 'form-update-menu')); ?>
            <div class="modal-header" style="background-color: #b4b4d0;
    color: white;">

                <h4 class="modal-title" id="myModalLabel"><?php echo 'Edit Menu'; ?></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="menu_slug" name="id_module" value="<?= $module_id  ?>">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo render_input('module_name', 'Title', $module_name ); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

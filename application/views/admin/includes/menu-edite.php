<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$ci = &get_instance();
$first_segment = $ci->uri->segment(2);
$first_segments = $ci->uri->segment(3);
$first_segment = !empty($first_segments) ? $first_segments : $first_segment;

?>
<div class="modal fade modal-reminder" id="modal-edit-menu" tabindex="-1"
     role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <?php echo form_open('admin/dashboard/update_menu/', array('id' => 'form-update-menu')); ?>
            <div class="modal-header" style="background-color: #b4b4d0;
    color: white;">

                <h4 class="modal-title" id="myModalLabel"><?php echo 'Edit Menu'; ?></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="menu_slug" name="menu_slug" value="<?=$first_segment?>">
                <input type="hidden" id="menu_clone" name="menu_clone" value="0">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo render_input('name', 'Title'); ?>
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

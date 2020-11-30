<div class="modal fade" id="unit_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document" style="    width: 400px;
    margin-top: 100px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Intervall definieren
                </h4>
            </div>
            <div class="modal-body">
                <?php echo form_open(admin_url('leistung_verz/add_unit'),['id'=>"add_unit_leistung_verz"]); ?>
                <?php echo render_input('unit_name', 'name'); ?>
                <div class="text-right">
                    <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
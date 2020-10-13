<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<?php echo form_open_multipart($this->uri->uri_string(),array('id'=>'new_ticket_form')); ?>
			<div class="card">

				<div class="row">
					<div class="col-md-6">
						<?php if(!isset($project_id) && !isset($contact)){ ?>
							<a href="#" id="ticket_no_contact"><span class="label label-default">
										<i class="fa fa-envelope"></i> <?php echo _l('ticket_create_no_contact'); ?>
									</span>
							</a>
							<a href="#" class="hide" id="ticket_to_contact"><span class="label label-default">
									<i class="fa fa-user-o"></i> <?php echo _l('ticket_create_to_contact'); ?>
								</span>
							</a>
							<div class="mbot15"></div>
						<?php } ?>
						<?php echo render_input('subject','ticket_settings_subject','','text',array('required'=>'true')); ?>
						<!--<div class="form-group select-placeholder" id="ticket_contact_w">
							<label for="contactid"><?php echo _l('contact'); ?></label>
							<select name="contactid" required="true" id="contactid" class="ajax-search" data-width="100%" data-live-search="true" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
								<?php if(isset($contact)) { ?>
									<option value="<?php echo $contact['id']; ?>" selected><?php echo $contact['firstname'] . ' ' .$contact['lastname']; ?></option>
								<?php } ?>
								<option value=""></option>
							</select>
							<?php echo form_hidden('userid'); ?>
						</div>-->
						<div class="row">
							<div class="col-md-6">
								<?php echo render_input('name','ticket_settings_to','','text',array('disabled'=>true)); ?>
							</div>
							<div class="col-md-6">
								<?php echo render_input('email','ticket_settings_email','','email',array('disabled'=>true)); ?>
							</div>
						</div>

			</div>
				</div>
			</div>
			<div class="card">
				<?php echo render_textarea('message','','',array(),array(),'','tinymce'); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<?php init_tail(); ?>
<script>
    $(function(){
        var editorMessage = tinymce.get('message');
        if(typeof(editorMessage) != 'undefined') {
            editorMessage.on('change',function(){
                if(editorMessage.getContent().trim() != '') {
                    if($('#savePredefinedReplyFromMessage').length == 0){
                        $('[app-field-wrapper="message"] [role="menubar"] .mce-container-body:first').append("<a id=\"savePredefinedReplyFromMessage\" data-toggle=\"modal\" data-target=\"#savePredefinedReplyFromMessageModal\" class=\"save_predefined_reply_from_message pointer\" href=\"#\">Nachricht als vordefinierte Antwort speichern</a>");
                    }
                    // For open is handled on contact select
                    if($('#single-ticket-form').length > 0) {
                        var contactIDSelect = $('#contactid');
                        if(contactIDSelect.data('no-contact') == undefined && contactIDSelect.data('ticket-emails') == '0') {
                            show_ticket_no_contact_email_warning($('input[name="userid"]').val(), contactIDSelect.val());
                        } else {
                            clear_ticket_no_contact_email_warning();
                        }
                    }
                } else {
                    $('#savePredefinedReplyFromMessage').remove();
                    clear_ticket_no_contact_email_warning();
                }
            });
        }
        $('body').on('click','#saveTicketMessagePredefinedReply',function(e){
            e.preventDefault();
            var data = {}
            data.message = editorMessage.getContent();
            data.name = $('#savePredefinedReplyFromMessageModal #name').val();
            data.ticket_area = true;
            $.post(admin_url+'tickets/predefined_reply',data).done(function(response){
                response = JSON.parse(response);
                if(response.success == true) {
                    var predefined_reply_select = $('#insert_predefined_reply');
                    predefined_reply_select.find('option:first').after('<option value="'+response.id+'">'+data.name+'</option>');
                    predefined_reply_select.selectpicker('refresh');
                }
                $('#savePredefinedReplyFromMessageModal').modal('hide');
            });
        });
    });
</script>

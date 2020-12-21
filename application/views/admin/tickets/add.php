<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<script>tinymce.init({selector:'textarea'});</script>
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
										<i class="fa fa-envelope"></i> Ticket ohne Kontakt
									</span>
							</a>
							<a href="#" class="hide" id="ticket_to_contact"><span class="label label-default">
									<i class="fa fa-user-o"></i> Ticket ohne Kontakt
								</span>
							</a>
							<div class="mbot15"></div>
						<?php } ?>
						<?php echo render_input('subject',_l('ticket_settings_subject'),'','text',array('required'=>'true')); ?>
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
								<?php echo render_input('name',_l('ticket_settings_to'),'','text',array('disabled'=>true)); ?>
							</div>
							<div class="col-md-6">
								<?php echo render_input('email',_l('ticket_settings_email'),'','email',array('disabled'=>true)); ?>
							</div>
						</div>

			</div>
				</div>
			</div>
			<div class="card">
				<?php echo render_textarea('message','','',array(),array(),'','tinymce'); ?>
			</div>

				<div class="attachments" style="background-color: white">
					<div class="attachment">
				<div class="row">
					<div class="col-md-4 col-md-offset-4 mbot15">

							<div class="form-group">
								<label for="attachment" class="control-label"><?php echo _l('ticket_add_attachments'); ?></label>
								<div class="input-group">
									<input type="file" extension="<?php echo str_replace(['.', ' '], '', get_option('ticket_attachments_file_extensions')); ?>" filesize="<?php echo file_upload_max_size(); ?>" class="form-control" name="attachments[0]" accept="<?php echo get_ticket_form_accepted_mimes(); ?>">
									<span class="input-group-btn">
												<button class="btn btn-success add_more_attachments p8-half" data-max="<?php echo get_option('maximum_allowed_ticket_attachments'); ?>" type="button"><i class="fa fa-plus"></i></button>
											</span>
								</div>
							</div>

					</div>

			</div>

					</div>

				</div>
			<div class="form-group">
				<div class="col-md-12">
					<input style="width: 150px;" type="submit"  value="Speichern" class="btn btn-primary pull-right">
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<?php init_tail(); ?>
<script>

    $(function(){
        $('#ticket_no_contact').on('click', function(e) {
            e.preventDefault();
            //validate_new_ticket_form();
            $('#name, #email').prop('disabled', false);
            $('#name, #email').attr('required',true);
           /* $('#name').val('').rules('add', { required: true });
            $('#email').val('').rules('add', { required: true });*/

            $(this).addClass('hide');

            $('#contactid').removeAttr('required');
            $('#contactid').selectpicker('val', '');
            $('input[name="userid"]').val('');

            $('#ticket_to_contact').removeClass('hide');
            $('#ticket_contact_w').addClass('hide');
        });
        $('#ticket_to_contact').on('click', function(e) {
            e.preventDefault();
            $('#name, #email').prop('disabled', true);
            $('#ticket_no_contact').removeClass('hide');
            $('#contactid').attr('required', true);
            /*$('#name').rules('remove', 'required');
            $('#email').rules('remove', 'required');*/
            $('#name, #email').attr('required',false);
            $('#ticket_no_contact, #ticket_contact_w').removeClass('hide');
            $(this).addClass('hide');
        });
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

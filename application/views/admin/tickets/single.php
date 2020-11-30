<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<script>tinymce.init({selector:'textarea'});</script>
<?php set_ticket_open($ticket->adminread,$ticket->ticketid); ?>
<style>
	.content-body{
		margin-bottom: 70px;
	}
</style>
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<div class="row">
				<div class="col-md-12">
					<div class="panel_s">
						<div class="panel-body" style="margin-bottom: 20px">
							<div class="horizontal-scrollable-tabs">

								<div class="horizontal-tabs">
									<ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal"
										role="tablist" style="    margin-bottom: 0;
    border-bottom-color: transparent;" id="myTab">
										<li role="presentation" class="active">
											<a href="#addreply" aria-controls="addreply" role="tab" data-toggle="tab"
											   aria-expanded="true">
												Antwort hinzufügen </a>
										</li>
										<!-- <li style="    margin-left: 10px;" role="presentation" >
											 <a href="#note" aria-controls="note" role="tab"
												data-toggle="tab" aria-expanded="false">
												 Notiz hinzufügen</a>
										 </li>
										 <li style="    margin-left: 10px;" role="presentation" class="">
											 <a href="#tab_reminders" aria-controls="tab_reminders" role="tab"
												data-toggle="tab" aria-expanded="false">
												 Erinnerungen</a>
										 </li>-->


									</ul>

								</div>
							</div>
						</div>
					</div>
					<div class="panel_s">
						<div class="panel-body" >
							<div class="row">
								<div class="col-md-8">
									<h3 class="mtop4 mbot20 pull-left">
                        <span id="ticket_subject">
                           #<?php echo $ticket->ticketid; ?> - <?php echo $ticket->subject; ?>
                        </span>
										<?php if($ticket->project_id != 0){
											echo '<br /><small>'._l('ticket_linked_to_project','<a href="'.admin_url('projects/view/'.$ticket->project_id).'">'.get_project_name_by_id($ticket->project_id).'</a>') .'</small>';
										} ?>
									</h3>
									<?php echo '<div class="label mtop5 mbot15'.(is_mobile() ? ' ' : ' mleft15 ').'p8 pull-left single-ticket-status-label" style="padding-left:10px;    
    padding-right: 10px;
    margin-top: 2px;
    margin-left: 15px;
    padding-top: 5px;
    padding-bottom: 5px;color: white;background:'.ticket_status_color($ticket->status).'">'.ticket_status_translate($ticket->status).'</div>'; ?>

								</div>
								<div class="col-md-4 text-right">
									<div class="row">
										<div class="col-md-6 col-md-offset-6">
											<?php echo render_select('status_top',$statuses,array('ticketstatusid','name'),'',$ticket->status,array(),array(),'no-mbot','',false); ?>
										</div>
									</div>
								</div>

							</div>
							<div class="tab-content mtop15">
								<div role="tabpanel" class="tab-pane active" id="addreply">
									<hr class="no-mtop" />
									<?php $tags = get_tags_in($ticket->ticketid,'ticket'); ?>
									<?php if(count($tags) > 0){ ?>
										<div class="row">
											<div class="col-md-12">
												<?php echo '<b><i class="fa fa-tag" aria-hidden="true"></i> ' . _l('tags') . ':</b><br /><br /> ' . render_tags($tags); ?>
												<hr />
											</div>
										</div>
									<?php } ?>
									<?php if(sizeof($ticket->ticket_notes) > 0){ ?>
										<div class="row">
											<div class="col-md-12 mbot15">
												<h4 class="bold"><?php echo _l('ticket_single_private_staff_notes'); ?></h4>
												<div class="ticketstaffnotes">
													<div class="table-responsive">
														<table>
															<tbody>
															<?php foreach($ticket->ticket_notes as $note){ ?>
																<tr>
																	<td>
                                                   <span class="bold">
                                                      <?php echo staff_profile_image($note['addedfrom'],array('staff-profile-xs-image')); ?> <a href="<?php echo admin_url('staff/profile/'.$note['addedfrom']); ?>"><?php echo _l('ticket_single_ticket_note_by',get_user_full_name($note['addedfrom'])); ?>
                                                   </a>
                                                </span>
																		<?php
																		if($note['addedfrom'] == get_user_id() || is_admin()){ ?>
																			<div class="pull-right">
																				<a href="#" class="btn btn-default btn-icon" onclick="toggle_edit_note(<?php echo $note['id']; ?>);return false;"><i class="fa fa-pencil-square-o"></i></a>
																				<a href="<?php echo admin_url('misc/delete_note/'.$note["id"]); ?>" class="mright10 _delete btn btn-danger btn-icon">
																					<i class="fa fa-remove"></i>
																				</a>
																			</div>
																		<?php } ?>
																		<hr class="hr-10" />
																		<div data-note-description="<?php echo $note['id']; ?>">
																			<?php echo check_for_links($note['description']); ?>
																		</div>
																		<div data-note-edit-textarea="<?php echo $note['id']; ?>" class="hide inline-block full-width">
																			<textarea name="description" class="form-control" rows="4"><?php echo clear_textarea_breaks($note['description']); ?></textarea>
																			<div class="text-right mtop15">
																				<button type="button" class="btn btn-default" onclick="toggle_edit_note(<?php echo $note['id']; ?>);return false;"><?php echo _l('cancel'); ?></button>
																				<button type="button" class="btn btn-info" onclick="edit_note(<?php echo $note['id']; ?>);"><?php echo _l('update_note'); ?></button>
																			</div>
																		</div>
																		<small class="bold">
																			<?php echo _l('ticket_single_note_added',_dt($note['dateadded'])); ?>
																		</small>
																	</td>
																</tr>
															<?php } ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									<?php } ?>
									<div>
										<?php echo form_open_multipart($this->uri->uri_string(),array('id'=>'single-ticket-form','novalidate'=>true)); ?>
										<a href="<?php echo admin_url('ticket/delete/'.$ticket->ticketid); ?>" class="btn btn-danger _delete btn-ticket-label mright5">
											<i class="fa fa-remove"></i>
										</a>

										<?php if(!empty($ticket->priority_name)){ ?>
											<span class="ticket-label label label-default inline-block">
                           <?php echo _l('ticket_single_priority',ticket_priority_translate($ticket->priorityid)); ?>
                        </span>
										<?php } ?>
										<?php if(!empty($ticket->service_name)){ ?>
											<span class="ticket-label label label-default inline-block">
                           <?php echo _l('service'). ': ' . $ticket->service_name; ?>
                        </span>
										<?php } ?>
										<?php echo form_hidden('ticketid',$ticket->ticketid); ?>
										<!--<span class="ticket-label label label-default inline-block">
                        <?php echo _l('department') . ': '; ?>
                     </span>
										<?php if($ticket->assigned != 0){ ?>
											<span class="ticket-label label label-info inline-block">
                           <?php echo _l('ticket_assigned'); ?>: <?php echo get_user_full_name($ticket->assigned); ?>
                        </span>
										<?php } ?>
										<?php if($ticket->lastreply !== NULL){ ?>
											<span class="ticket-label label label-success inline-block" data-toggle="tooltip" title="<?php echo $ticket->lastreply; ?>">
                           <span class="text-has-action">
                              <?php echo _l('ticket_single_last_reply',time_ago($ticket->lastreply)); ?>
                           </span>
                        </span>
										<?php } ?>

										<span class="ticket-label label label-info inline-block">
                        <a href="<?php echo get_ticket_public_url($ticket); ?>" target="_blank">
                           <?php echo _l('view_public_form'); ?>-->
                        </a>
                     </span>

										<div class="mtop15" style="margin-top: 10px;">
											<?php
											$use_knowledge_base = get_option('use_knowledge_base');
											?>
											<div class="row mbot15">
												<div class="col-md-6">
													<select data-width="100%" id="insert_predefined_reply" data-live-search="true" class="selectpicker" data-title="<?php echo _l('Predefined Reply'); ?>">
														<?php foreach($predefined_replies as $predefined_reply){ ?>
															<option value="<?php echo $predefined_reply['id']; ?>"><?php echo $predefined_reply['name']; ?></option>
														<?php } ?>
													</select>
												</div>
												<?php if($use_knowledge_base == 1){ ?>
													<div class="visible-xs">
														<div class="mtop15"></div>
													</div>
													<div class="col-md-6">
														<?php $groups = get_all_knowledge_base_articles_grouped(); ?>
														<select data-width="100%" id="insert_knowledge_base_link" class="selectpicker" data-live-search="true" onchange="insert_ticket_knowledgebase_link(this);" data-title="<?php echo _l('ticket_single_insert_knowledge_base_link'); ?>">
															<option value=""></option>
															<?php foreach($groups as $group){ ?>
																<?php if(count($group['articles']) > 0){ ?>
																	<optgroup label="<?php echo $group['name']; ?>">
																		<?php foreach($group['articles'] as $article) { ?>
																			<option value="<?php echo $article['articleid']; ?>">
																				<?php echo $article['subject']; ?>
																			</option>
																		<?php } ?>
																	</optgroup>
																<?php } ?>
															<?php } ?>
														</select>
													</div>
												<?php } ?>
											</div>
											<?php echo render_textarea('message','','',array(),array(),'','tinymce'); ?>
										</div>
										<div class="panel_s ticket-reply-tools">
											<div class="btn-bottom-toolbar text-right">
												<button type="submit" class="btn btn-info" data-form="#single-ticket-form" autocomplete="off" data-loading-text="<?php echo _l('wait_text'); ?>">
													<?php echo _l('ticket_single_add_response'); ?>
												</button>
											</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-md-5">


														<?php echo render_select('status', $statuses, array('ticketstatusid','name'), _l('ticket_single_change_status'), $ticket->status, array('data-none-selected-text' => 'dropdown_non_selected_tex')); ?>
														<?php echo render_input('cc','CC'); ?>
														<?php if($ticket->assigned !== get_user_id()){ ?>
															<div>
																<input type="checkbox" name="assign_to_current_user" id="assign_to_current_user">
																<label for="assign_to_current_user"><?php echo _l('ticket_single_assign_to_me_on_update'); ?></label>
															</div>
														<?php } ?>
														<div>
															<input type="checkbox" <?php echo 'checked'; ?> name="ticket_add_response_and_back_to_list" value="1" id="ticket_add_response_and_back_to_list">
															<label for="ticket_add_response_and_back_to_list"><?php echo _l('ticket_add_response_and_back_to_list'); ?></label>
														</div>
													</div>
												</div>
												<hr />
												<div class="row">

													<div class="col-md-5 mbot15">
														<div class="form-group">
															<label for="attachment" class="control-label">
																<?php echo _l('ticket_single_attachments'); ?>
															</label>
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
										<?php echo form_close(); ?>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="note">
									<hr class="no-mtop" />
									<div class="form-group">
										<label for="note_description"><?php echo _l('ticket_single_note_heading'); ?></label>
										<textarea class="form-control" name="note_description" rows="5"></textarea>
									</div>
									<a class="btn btn-info pull-right add_note_ticket"><?php echo _l('ticket_single_add_note'); ?></a>
								</div>
								<div role="tabpanel" class="tab-pane" id="tab_reminders">
									<a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target=".reminder-modal-ticket-<?php echo $ticket->ticketid; ?>"><i class="fa fa-bell-o"></i> <?php echo _l('ticket_set_reminder_title'); ?></a>
									<hr />
									<?php render_datatable(array( _l( 'reminder_description'), _l( 'reminder_date'), _l( 'reminder_staff'), _l( 'reminder_is_notified')), 'reminders'); ?>
								</div>
								<div role="tabpanel" class="tab-pane" id="othertickets">
									<hr class="no-mtop" />
									<div class="_filters _hidden_inputs hidden tickets_filters">
										<?php echo form_hidden('filters_ticket_id',$ticket->ticketid); ?>
										<?php echo form_hidden('filters_email',$ticket->email); ?>
										<?php echo form_hidden('filters_userid',$ticket->userid); ?>
									</div>
									<?php echo AdminTicketsTableStructure(); ?>
								</div>
								<div role="tabpanel" class="tab-pane" id="tasks">
									<hr class="no-mtop" />

								</div>

							</div>
						</div>
					</div>

					<div class="panel-body <?php if($ticket->admin == NULL){echo 'client-reply';} ?> block-reply">
						<div class="row">
							<div class="col-md-3 border-right ticket-submitter-info ticket-submitter-info">
								<p>

									<a href="<?php echo admin_url('clients/client/'.$ticket->userid.'?contactid='.$ticket->contactid); ?>"
									>
									</a>
									<?php
									echo $ticket->submiter;
									?>
									<br />
									<a href="mailto:<?php echo $ticket->submiter_mail; ?>"><?php echo $ticket->submiter; ?></a>
								<hr />




								</p>
								<p class="text-muted">
									<?php if($ticket->admin !== NULL || $ticket->admin != 0){
										echo _l('Mitarbeiter');
									} else {
										if($ticket->userid != 0){
											echo _l('ticket_client_string');
										}
									}
									?>
								</p>

							</div>
							<div class="col-md-9">
								<div class="row">
									<div class="col-md-12 text-right">
										<?php if(!empty($ticket->message)) { ?>
											<a href="#" onclick="print_ticket_message(<?php echo $ticket->ticketid; ?>, 'ticket'); return false;" class="mright5"><i class="fa fa-print"></i></a>
										<?php } ?>
										<a href="#" onclick="edit_ticket_message(<?php echo $ticket->ticketid; ?>,'ticket'); return false;"><i class="fa fa-pencil-square-o"></i></a>
									</div>
								</div>
								<div data-ticket-id="<?php echo $ticket->ticketid; ?>" class="tc-content">
									<?php echo check_for_links($ticket->message); ?>
								</div>
								<?php if(count($ticket->attachments) > 0){
									echo '<hr />';
									foreach($ticket->attachments as $attachment){

										$path = get_upload_path_by_type('ticket').$ticket->ticketid.'/'.$attachment['file_name'];
										$is_image = is_image($path);

										if($is_image){
											echo '<div class="preview_image">';
										}
										?>
										<a href="<?php echo site_url('download/file/ticket/'. $attachment['id']); ?>" class="display-block mbot5"<?php if($is_image){ ?> data-lightbox="attachment-ticket-<?php echo $ticket->ticketid; ?>" <?php } ?>>
											<i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i> <?php echo $attachment['file_name']; ?>
											<?php if($is_image){ ?>
												<img class="mtop5" src="<?php echo site_url('download/preview_image?path='.protected_file_url_by_path($path).'&type='.$attachment['filetype']); ?>">
											<?php } ?>
										</a>
										<?php if($is_image){
											echo '</div>';
										}
										if(is_admin() || (!is_admin() && get_option('allow_non_admin_staff_to_delete_ticket_attachments') == '1')){
											echo '<a href="'.admin_url('tickets/delete_attachment/'.$attachment['id']).'" class="text-danger _delete">'._l('delete').'</a>';
										}
										echo '<hr />';
										?>
									<?php }
								} ?>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<?php echo _l($ticket->date); ?>
					</div>

					<?php foreach($ticket_replies as $reply){ ?>
						<div class="panel_s">
							<div class="panel-body <?php if($reply['admin'] == NULL){echo 'client-reply';} ?> block-reply">
								<div class="row">
									<div class="col-md-3 border-right ticket-submitter-info">
										<p>
											<?php if($reply['admin'] == NULL || $reply['admin'] == 0){ ?>
												<?php if($reply['userid'] != 0){ ?>
													<a href="<?php echo admin_url('clients/client/'.$reply['userid'].'?contactid='.$reply['contactid']); ?>"><?php echo $reply['submitter']; ?></a>
												<?php } else { ?>
													<?php echo $reply['submitter']; ?>
													<br />
													<a href="mailto:<?php echo $reply['reply_email']; ?>"><?php echo $reply['reply_email']; ?></a>
												<?php } ?>
											<?php }  else { ?>
												<a href=""><?php echo $reply['submitter']; ?></a>
											<?php } ?>
										</p>
										<p class="text-muted">
											<?php if($reply['admin'] !== NULL || $reply['admin'] != 0){
												echo _l('Mitarbeiter');
											} else {
												if($reply['userid'] != 0){
													echo _l('ticket_client_string');
												}
											}
											?>
										</p>
										<hr />
										<a href="<?php echo admin_url('ticket/delete_ticket_reply/'.$ticket->ticketid .'/'.$reply['id']); ?>" class="btn btn-danger pull-left _delete mright5 btn-xs"><?php echo _l('delete_ticket_reply'); ?></a>


									</div>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-12 text-right">
												<?php if(!empty($reply['message'])) { ?>
													<a href="#" onclick="print_ticket_message(<?php echo $reply['id']; ?>, 'reply'); return false;" class="mright5"><i class="fa fa-print"></i></a>
												<?php } ?>
												<a href="#" onclick="edit_ticket_message(<?php echo $reply['id']; ?>,'reply'); return false;"><i class="fa fa-pencil-square-o"></i></a>
											</div>
										</div>

										<div data-reply-id="<?php echo $reply['id']; ?>" class="tc-content">
											<?php echo check_for_links($reply['message']); ?>
										</div>
										<!--<?php if(count($reply['attachments']) > 0){
											echo '<hr />';
											foreach($reply['attachments'] as $attachment){
												$path = get_upload_path_by_type('ticket').$ticket->ticketid.'/'.$attachment['file_name'];
												$is_image = is_image($path);

												if($is_image){
													echo '<div class="preview_image">';
												}
												?>
												<a href="<?php echo site_url('download/file/ticket/'. $attachment['id']); ?>" class="display-block mbot5"<?php if($is_image){ ?> data-lightbox="attachment-reply-<?php echo $reply['id']; ?>" <?php } ?>>
													<i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i> <?php echo $attachment['file_name']; ?>
													<?php if($is_image){ ?>
														<img class="mtop5" src="<?php echo site_url('download/preview_image?path='.protected_file_url_by_path($path).'&type='.$attachment['filetype']); ?>">
													<?php } ?>
												</a>
												<?php if($is_image){
													echo '</div>';
												}
												if(is_admin() || (!is_admin() && get_option('allow_non_admin_staff_to_delete_ticket_attachments') == '1')){
													echo '<a href="'.admin_url('tickets/delete_attachment/'.$attachment['id']).'" class="text-danger _delete">'._l('delete').'</a>';
												}
												echo '<hr />';
											}
										} ?>-->
									</div>
								</div>
							</div>
							<div class="panel-footer">
								<span><?php echo _l($reply['date']); ?></span>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="btn-bottom-pusher"></div>
			<?php if(count($ticket_replies) > 1){ ?>
				<a href="#top" id="toplink">↑</a>
				<a href="#bot" id="botlink">↓</a>
			<?php } ?>
		</div>
	</div>
</div>

<!-- Edit Ticket Messsage Modal -->
<div class="modal fade" id="ticket-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<?php echo form_open(admin_url('ticket/edit_message')); ?>
		<div class="modal-content">
			<div id="edit-ticket-message-additional"></div>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php echo _l('ticket_message_edit'); ?></h4>
			</div>
			<div class="modal-body">
				<?php echo render_textarea('data','','',array(),array(),'','tinymce-ticket-edit'); ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<script>
    var _ticket_message;
</script>
<?php $this->load->view('admin/tickets/services/service'); ?>
<?php init_tail(); ?>

<script>
    $('.nav-tabs a').on('shown.bs.tab', function(event){
        var x = $(event.target).text();         // active tab
        var y = $(event.relatedTarget).text();  // previous tab
    });
    $(function(){
        $('#single-ticket-form').appFormValidator();

        $('body').on('shown.bs.modal', '#_task_modal', function() {
            if(typeof(_ticket_message) != 'undefined') {
                // Init the task description editor
                if(!is_mobile()){
                    $(this).find('#description').click();
                } else {
                    $(this).find('#description').focus();
                }
                setTimeout(function(){
                    tinymce.get('description').execCommand('mceInsertContent', false, _ticket_message);
                    $('#_task_modal input[name="name"]').val($('#ticket_subject').text().trim());
                },100);
            }
        });
    });


    var Ticket_message_editor;
    var edit_ticket_message_additional = $('#edit-ticket-message-additional');

    function edit_ticket_message(id, type){
        edit_ticket_message_additional.empty();
        // type is either ticket or reply
        _ticket_message = $('[data-'+type+'-id="'+id+'"]').html();
        init_ticket_edit_editor();
        tinyMCE.activeEditor.setContent(_ticket_message);
        $('#ticket-message').modal('show');
        edit_ticket_message_additional.append(hidden_input('type',type));
        edit_ticket_message_additional.append(hidden_input('id',id));
        edit_ticket_message_additional.append(hidden_input('main_ticket',$('input[name="ticketid"]').val()));
    }

    function init_ticket_edit_editor(){
        if(typeof(Ticket_message_editor) !== 'undefined'){
            return true;
        }
        Ticket_message_editor = init_editor('.tinymce-ticket-edit');
    }
	<?php if(has_permission('tasks','','create')){ ?>
    function convert_ticket_to_task(id, type){
        if(type == 'ticket'){
            _ticket_message = $('[data-ticket-id="'+id+'"]').html();
        } else {
            _ticket_message = $('[data-reply-id="'+id+'"]').html();
        }
        var new_task_url = admin_url + 'tasks/task?rel_id=<?php echo $ticket->ticketid; ?>&rel_type=ticket&ticket_to_task=true';
        new_task(new_task_url);
    }
	<?php } ?>

</script>


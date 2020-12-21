<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<div class="card">

					<div class="d-inline-block">
						<h3 class="card-title" style="margin: 0;">Mieter</h3>

					</div>


			</div>


			<div class="panel-body">
		<form id="mieter-form" action="<?php echo base_url('admin/mieter/save')?>" class="client-form dropzone" autocomplete="off" method="post" accept-charset="utf-8">
						<div class="row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
							<div class="col-md-6">
							<h3>Private Informationen</h3>
								<div class="row">
										<?php $value = (isset($mieter) ? $mieter->id : ''); ?>
										<?php echo render_input('id', '', $value,'hidden'); ?>

									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->fullname : ''); ?>
										<?php echo render_input('fullname', get_transl_field('tsl_mieter', 'fullname','Vollständiger Name'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->vorname : ''); ?>
										<?php echo render_input('vorname', get_transl_field('tsl_mieter', 'vorname','Vorname'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->nachname : ''); ?>
										<?php echo render_input('nachname', get_transl_field('tsl_mieter', 'nachname','Nachname'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->email : ''); ?>
										<?php echo render_input('email', get_transl_field('tsl_mieter', 'email','Email'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->strabe_m : ''); ?>
										<?php echo render_input('strabe_m', get_transl_field('tsl_mieter', 'strabe_m','Straße'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->hausnummer_m : ''); ?>
										<?php echo render_input('hausnummer_m', get_transl_field('tsl_mieter', 'hausnummer_m','Hausnummer'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->wohnungsnummer : ''); ?>
										<?php echo render_input('wohnungsnummer', get_transl_field('tsl_mieter', 'wohnungsnummer','Wohnungsnummer'), $value); ?>
									</div>


									<div class="col-md-12">

										<?php $data = [];
										$data[] = array('value' => 'UG');
										$data[] = array('value' => 'EG');
										$data[] = array('value' => '1. OG');
										$data[] = array('value' => '2. OG');
										$data[] = array('value' => '3. OG');
										$data[] = array('value' => '4. OG');
										$data[] = array('value' => '5. OG');
										$data[] = array('value' => '6. OG');
										$data[] = array('value' => '7. OG');
										$data[] = array('value' => '8. OG');
										$data[] = array('value' => '9. OG');
										$data[] = array('value' => '10. OG');
										$value = (isset($mieter) ? $mieter->etage : ''); ?>
										<?php echo render_select('etage', $data, array('value', 'value'), get_transl_field('tsl_mieter', 'etage','Etage'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php
										$data = [];
										$data[] = array('value' => 'Links');
										$data[] = array('value' => 'Rechts');
										$data[] = array('value' => 'Mitte');
										$data[] = array('value' => 'Mitte/Links');
										$data[] = array('value' => 'Mitte/Rechts');
										$value = (isset($mieter) ? $mieter->flugel : ''); ?>
										<?php echo render_select('flugel', $data, array('value', 'value'), get_transl_field('tsl_mieter', 'flugel','Flügel'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->plz : ''); ?>
										<?php echo render_input('plz', get_transl_field('tsl_mieter', 'plz','PLZ'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->stadt : ''); ?>
										<?php echo render_input('stadt', get_transl_field('tsl_mieter', 'stadt','Stadt'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->telefon_1 : ''); ?>
										<?php echo render_input('telefon_1', get_transl_field('tsl_mieter', 'telefon_1','Telefon 1'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->telefon_2 : ''); ?>
										<?php echo render_input('telefon_2', get_transl_field('tsl_mieter', 'telefon_2','²Telefon 2'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->telefon_3 : ''); ?>
										<?php echo render_input('telefon_3', get_transl_field('tsl_mieter', 'telefon_3','Telefon 3'), $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->notice : ''); ?>
										<?php echo render_textarea('notice', get_transl_field('tsl_mieter', 'notice','Notice'), $value); ?>
									</div>
									<div class="col-md-12">
									<p>Besonderheit</p>
									<div class="row">
									<div class="col-md-6">

										<?php $selected = isset($mieter) && $mieter->haustiere == '1' ? 1 : 0;
										$datas = array(array('id' => 0, 'value' => 'Nein'), array('id' => 1, 'value' => 'Ja'));
										echo render_select('haustiere', $datas, array('id', 'value'), get_transl_field('tsl_mieter', 'haustiere','Haustiere'), $selected); ?>


									</div>
									<div class="col-md-6">

										<?php $selected = isset($mieter) && $mieter->raucher == '1' ? 1 : 0;
										$datas = array(array('id' => 0, 'value' => 'Nein'), array('id' => 1, 'value' => 'Ja'));
										echo render_select('raucher', $datas, array('id', 'value'), get_transl_field('tsl_mieter', 'raucher','Raucher'), $selected); ?>


									</div>

									</div>
										<div class="row" style="margin-top: 20px">
											<div class="col-md-12">
												<h3>Datien/Anh&auml;nge hochladen <?php if(isset($mieter)) { ?><span><a href="<?php echo site_url('admin/mieter/makePdf/'.$mieter->id); ?>" class="btn btn-default">Generate Pdf</a></span><?php } ?></h3>
												<div class="row">
													<div class="col-md-12">
														<a href="#" class="btn btn-default add-post-attachments">
															<i data-toggle="tooltip" title="<?php echo _l('newsfeed_upload_tooltip'); ?>"
															   class="fa fa-files-o"></i></a>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12" id="mieter-form-drop-zone">
														<div class="dz-message" data-dz-message><span></span></div>
														<div class="dropzone-previews mtop25"></div>
													</div>
												</div>


												<div class="row">
													<?php
													foreach ($mieter->attachments as $k => $attachment) {

														if (get_mime_class($attachment['filetype']) == 'mime mime-pdf')
															continue;
														?>
														<?php ob_start(); ?>
														<div data-num="<?php echo $k; ?>"
															 data-mieter-attachment-id="<?php echo $attachment['id']; ?>"
															 class="task-attachment-col col-md-4">
															<ul class="list-unstyled task-attachment-wrapper" data-placement="right"
																data-toggle="tooltip" data-title="<?php echo $attachment['file_name']; ?>">
																<li class="mbot10 task-attachment<?php if (strtotime($attachment['dateadded']) >= strtotime('-16 hours')) {
																	echo ' highlight-bg';
																} ?>">
																	<div class="mbot10 pull-right task-attachment-user">
																		<a href="#" class="pull-right"
																		   onclick="remove_mieter_attachment(this,<?php echo $attachment['id']; ?>); return false;">
																			<i class="fa fa fa-times"></i>
																		</a>
																		<?php
																		$externalPreview = false;
																		$is_image = false;
																		$path = get_upload_path_by_type('mieter') . $mieter->id . '/' . $attachment['file_name'];
																		$href_url = site_url('download/file/mieterattachment/' . $attachment['attachment_key']);
																		$isHtml5Video = is_html5_video($path);
																		if (empty($attachment['external'])) {
																			$is_image = is_image($path);
																			$img_url = site_url('download/preview_image?path=' . protected_file_url_by_path($path, true) . '&type=' . $attachment['filetype']);
																		} else if ((!empty($attachment['thumbnail_link']) || !empty($attachment['external']))
																			&& !empty($attachment['thumbnail_link'])) {
																			$is_image = true;
																			$img_url = optimize_dropbox_thumbnail($attachment['thumbnail_link']);
																			$externalPreview = $img_url;
																			$href_url = $attachment['external_link'];
																		} else if (!empty($attachment['external']) && empty($attachment['thumbnail_link'])) {
																			$href_url = $attachment['external_link'];
																		}
																		if (!empty($attachment['external']) && $attachment['external'] == 'dropbox' && $is_image) { ?>
																			<a href="<?php echo $href_url; ?>" target="_blank" class=""
																			   data-toggle="tooltip"
																			   data-title="<?php echo _l('open_in_dropbox'); ?>"><i
																					class="fa fa-dropbox" aria-hidden="true"></i></a>
																		<?php } else if (!empty($attachment['external']) && $attachment['external'] == 'gdrive') { ?>
																			<a href="<?php echo $href_url; ?>" target="_blank" class=""
																			   data-toggle="tooltip"
																			   data-title="<?php echo _l('open_in_google'); ?>"><i
																					class="fa fa-google" aria-hidden="true"></i></a>
																		<?php }
																		echo $attachment['file_name'];
																		?>
																	</div>
																	<div class="clearfix"></div>
																	<div class="<?php if ($is_image) {
																		echo 'preview-image';
																	} else if (!$isHtml5Video) {
																		echo 'mieter-attachment-no-preview';
																	} ?>">
																		<?php
																		// Not link on video previews because on click on the video is opening new tab
																		if (!$isHtml5Video){ ?>
																		<a href="<?php
																		if($is_image){
																			echo base_url(protected_file_url_by_path($path, true) );
																		}elseif (!$externalPreview){
                                                                                 echo $href_url;
																		}else{
																			echo $externalPreview;
																		}  ?>"
																		   target="_blank"<?php if ($is_image) { ?> data-lightbox="mieter-attachment" data-lity<?php } ?>
																		   class="<?php if ($isHtml5Video) {
																			   echo 'video-preview';
																		   } ?>">
																			<?php } ?>
																			<?php if ($is_image) { ?>
																				<img src="<?php echo $img_url; ?>" class="img img-responsive">
																			<?php } else if ($isHtml5Video) { ?>
																				<video width="100%" height="100%"
																					   src="<?php echo site_url('download/preview_video?path=' . protected_file_url_by_path($path) . '&type=' . $attachment['filetype']); ?>"
																					   controls>
																					Your browser does not support the video tag.
																				</video>
																			<?php } else { ?>
																				<i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i>
																				<?php echo $attachment['file_name']; ?>
																			<?php } ?>
																			<?php if (!$isHtml5Video){ ?>
																		</a>
																	<?php } ?>
																	</div>
																	<div class="clearfix"></div>
																</li>
															</ul>
														</div>
														<?php

														$attachments_data[$attachment['id']] = ob_get_contents();
														ob_end_clean();
														echo $attachments_data[$attachment['id']];
													} ?>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<h3>Attachments</h3>
												<!--<div class="row">
                    <div class="col-md-12">
                        <a href="#" class="btn btn-default add-post-attachments">
                            <i data-toggle="tooltip" title="<?php echo _l('newsfeed_upload_tooltip'); ?>"
                               class="fa fa-files-o"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="mieter-form-drop-zone">
                        <div class="dz-message" data-dz-message><span></span></div>
                        <div class="dropzone-previews mtop25"></div>
                    </div>
                </div>-->

												<div class="row">
													 <?php
                    foreach ($mieter->attachments as $k => $attachment) {

                        if (get_mime_class($attachment['filetype']) != 'mime mime-pdf')
                            continue;
                        ?>
                        <?php ob_start(); ?>
                        <div data-num="<?php echo $k; ?>"
                             data-mieter-attachment-id="<?php echo $attachment['id']; ?>"
                             class="task-attachment-col col-md-4">
                            <ul class="list-unstyled task-attachment-wrapper" data-placement="right"
                                data-toggle="tooltip" data-title="<?php echo $attachment['file_name']; ?>">
                                <li class="mbot10 task-attachment<?php if (strtotime($attachment['dateadded']) >= strtotime('-16 hours')) {
                                    echo ' highlight-bg';
                                } ?>">
                                    <div class="mbot10 pull-right task-attachment-user hide">

                                        <?php
                                        $externalPreview = false;
                                        $is_image = false;
                                        $path = get_upload_path_by_type('mieter') . $mieter->id . '/' . $attachment['file_name'];
                                        $href_url = site_url('download/file/mieterattachment/' . $attachment['attachment_key']);
                                        $isHtml5Video = is_html5_video($path);
                                        if (empty($attachment['external'])) {
                                            $is_image = is_image($path);
                                            $img_url = site_url('download/preview_image?path=' . protected_file_url_by_path($path, true) . '&type=' . $attachment['filetype']);
                                        } else if ((!empty($attachment['thumbnail_link']) || !empty($attachment['external']))
                                            && !empty($attachment['thumbnail_link'])) {
                                            $is_image = true;
                                            $img_url = optimize_dropbox_thumbnail($attachment['thumbnail_link']);
                                            $externalPreview = $img_url;
                                            $href_url = $attachment['external_link'];
                                        } else if (!empty($attachment['external']) && empty($attachment['thumbnail_link'])) {
                                            $href_url = $attachment['external_link'];
                                        }
                                        if (!empty($attachment['external']) && $attachment['external'] == 'dropbox' && $is_image) { ?>
                                            <a href="<?php echo $href_url; ?>" target="_blank" class=""
                                               data-toggle="tooltip"
                                               data-title="<?php echo _l('open_in_dropbox'); ?>"><i
                                                        class="fa fa-dropbox" aria-hidden="true"></i></a>
                                        <?php } else if (!empty($attachment['external']) && $attachment['external'] == 'gdrive') { ?>
                                            <a href="<?php echo $href_url; ?>" target="_blank" class=""
                                               data-toggle="tooltip"
                                               data-title="<?php echo _l('open_in_google'); ?>"><i
                                                        class="fa fa-google" aria-hidden="true"></i></a>
                                        <?php }

                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="<?php if ($is_image) {
                                        echo 'preview-image';
                                    } else if (!$isHtml5Video) {
                                        echo 'mieter-attachment-no-preview';
                                    } ?>">
                                        <?php
                                        // Not link on video previews because on click on the video is opening new tab
                                        if (!$isHtml5Video){ ?>
                                        <a href="<?php echo(!$externalPreview ? $href_url : $externalPreview); ?>"
                                           target="_blank"<?php if ($is_image) { ?> data-lightbox="mieter-attachment" data-lity<?php } ?>
                                           class="<?php if ($isHtml5Video) {
                                               echo 'video-preview';
                                           } ?>">
                                            <?php } ?>
                                            <?php if ($is_image) { ?>
                                                <img src="<?php echo $img_url; ?>" class="img img-responsive">
                                            <?php } else if ($isHtml5Video) { ?>
                                                <video width="100%" height="100%"
                                                       src="<?php echo site_url('download/preview_video?path=' . protected_file_url_by_path($path) . '&type=' . $attachment['filetype']); ?>"
                                                       controls>
                                                    Your browser does not support the video tag.
                                                </video>
                                            <?php } else { ?>
                                                <i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i>
                                                <?php echo $attachment['file_name']; ?>
                                            <?php } ?>
                                            <?php if (!$isHtml5Video){ ?>
                                        </a>
                                    <?php } ?>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                            </ul>
                        </div>
                        <?php

                        $attachments_data[$attachment['id']] = ob_get_contents();
                        ob_end_clean();
                        echo $attachments_data[$attachment['id']];
                    } ?>

												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="col-md-6">
							<h3>Projekt:</h3>
								<div class="row">
								<div class="col-md-12">
								<?php $projects = get_all_projects();
										$customer_default_projektname = "";
										$selected = (isset($mieter) ? $mieter->project : $customer_default_projektname);
										echo render_select('project', $projects, array('name', array('name')), 'Projekt', $selected, array('data-none-selected-text' => 'Nichts ausgewählt'));
										?>
									</div>
									<div class="col-md-6">
									<?php $value = (isset($mieter) ? $mieter->baubeginn : ''); ?>
										<?php echo render_input('baubeginn', 'Baubeginn', $value,'date'); ?>
									</div>
									<div class="col-md-6">
									<?php $value = (isset($mieter) ? $mieter->bauende : ''); ?>
										<?php echo render_input('bauende', 'Bauende', $value,'date'); ?>
									</div>
									<div class="col-md-6">
									<?php $value = (isset($mieter) ? $mieter->beraumung : ''); ?>
										<?php echo render_input('beraumung', 'Beräumung', $value,'date'); ?>
									</div>
									<div class="col-md-6">
									<?php $value = (isset($mieter) ? $mieter->ruckraumung : ''); ?>
										<?php echo render_input('ruckraumung', 'RückräumungZ', $value,'date'); ?>
									</div>
									<div class="col-md-12">
					
									<h5> Fenstereinbau</h5>
									
									</div>
									<div class="col-md-6">

										<?php
										$datas = array(array('id' => "Vollsanierung", 'value' => 'Vollsanierung'), array('id' => 'Nur Fenster', 'value' => 'Nur Fenster'));
										echo render_select('fenstereinbau', $datas, array('id', 'value'), 'Art', $selected); ?>


									</div>
									<div class="col-md-6">
									<?php $value = (isset($mieter) ? $mieter->fenstereinbau_d : ''); ?>
										<?php echo render_input('fenstereinbau_d', 'Fenstereinbau Datum', $value,'date'); ?>
									</div>
									<div class="col-md-12">
					
									<h5> Keller</h5>
									
									</div>
									<div class="col-md-4">
					
									<?php $value = (isset($mieter) ? $mieter->k_nummer : ''); ?>
										<?php echo render_input('k_nummer', 'Kellernummer', $value); ?>
									
									</div>
									<div class="col-md-4">
									<?php $value = (isset($mieter) ? $mieter->k_baubeginn : ''); ?>
										<?php echo render_input('k_baubeginn', 'Keller Beräumung', $value,'date'); ?>
									</div>
									<div class="col-md-4">
									<?php $value = (isset($mieter) ? $mieter->k_ruckraumung : ''); ?>
										<?php echo render_input('k_ruckraumung', 'Keller R?ckr?umung', $value,'date'); ?>
									</div>
									<div class="col-md-12">

										<h5>Ausweichkeller</h5>

									</div>
									<div class="col-md-4">

										<?php $value = (isset($mieter) ? $mieter->strabe_a : ''); ?>
										<?php echo render_input('strabe_a', 'Straße', $value); ?>

									</div>
									<div class="col-md-4">
										<?php $value = (isset($mieter) ? $mieter->hausnummer_a : ''); ?>
										<?php echo render_input('hausnummer_a', 'Hausnummer', $value); ?>
									</div>
									<div class="col-md-4">
										<?php $value = (isset($mieter) ? $mieter->kellernummer_a : ''); ?>
										<?php echo render_input('kellernummer_a', 'Kellernummer', $value); ?>
									</div>
									<div class="col-md-12">

										<h5>Umsetzwohnung</h5>

									</div>
									<div class="col-md-6">
										<?php
										$datas = [];
										$datas[] = array('id' => 1, 'value' => 'Privat');
										$datas[] = array('id' => 2, 'value' => 'Gewerblich');
										$datas[] = array('id' => 3, 'value' => 'Keine');


										$selected = isset($mieter) ? $mieter->art_w : ''; ?>
										<?php echo render_select('art_w', $datas, array('id', 'value'), 'Art', $selected); ?>


									</div>
									<div class="col-md-6">

									</div>
									<div class="col-md-6">

										<?php $value = (isset($mieter) ? $mieter->strabe_p : ''); ?>
										<?php echo render_input('strabe_p', 'Straße', $value); ?>

									</div>
									<div class="col-md-6">

										<?php $value = (isset($mieter) ? $mieter->nr_p : ''); ?>
										<?php echo render_input('nr_p', 'Nr.:', $value); ?>

									</div>
									<div class="col-md-6">

										<?php $value = (isset($mieter) ? $mieter->etage_p : ''); ?>
										<?php echo render_input('etage_p', 'Etage', $value); ?>

									</div>
									<div class="col-md-6">

										<?php $value = (isset($mieter) ? $mieter->fulger_p : ''); ?>
										<?php echo render_input('fulger_p', 'Flügel', $value); ?>

									</div>
								</div>
							</div>
						</div>
					
						<div class="form-group">

							<div class="col-md-12">
					<input style="width: 150px;" type="submit" id="submit"  value="Speichern" class="btn btn-primary pull-right">
				</div>
			</div></form></div>
		</div>
	</div>
</div>
<?php
if (isset($mieter)): ?>
	<script>
        var mieter_id = '<?=$mieter->id; ?>';
	</script>
<?php else: ?>
	<script>
        var mieter_id = 0;
	</script>
<?php
endif;
?>

<?php init_tail(); ?>
<script>
    mieterDropzone = new Dropzone("#mieter-form-drop-zone", appCreateDropzoneOptions({
        clickable: '.add-post-attachments',
        url: admin_url + "mieter/ajax_save", paramName: "files",
        autoProcessQueue: false,
        addRemoveLinks: true,
        uploadMultiple: true,
        parallelUploads: 50,
        maxFiles: 50,
        init: function () {
            mieterDropzone = this;

            this.on('sending', function (file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                var data = $('#mieter-form').serializeArray();
                $.each(data, function (key, el) {
                    formData.append(el.name, el.value);
                });
            });

            this.on("success", function (file) {
            });
        },
        removedfile: function (file) {

            x = confirm('Do you want to delete?');
            if (!x) return false;
            if (mieter_id != 0) {
                file.previewElement.remove();
            }
        },
        dragover: function (file) {
            $('#mieter-form-drop-zone').addClass('dropzone-active');
        },
        complete: function (file) {
            ///  console.log(file);
            $(this).prop('disabled', false);
            alert_float('success','success');
            //    window.location.href = file.xhr.responseText;
        },
        drop: function (file) {
            $('#mieter-form-drop-zone').removeClass('dropzone-active');
        }
    }));
    $('#mieter-form').on("submit", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $('#mieter-form #submit').prop('disabled', true);
        if (mieterDropzone.getQueuedFiles().length > 0) {

            mieterDropzone.processQueue();
        } else {

            $.ajax({
                url: admin_url + "mieter/ajax_save",
                data: $("#mieter-form").serialize(),
                type: "POST",
                dataType: 'json',
                success: function (e) {
                    //window.location.href = e;
                    $(this).prop('disabled', false);
                },
                error: function (e) {
                    window.location.href = e.responseText;
                    $(this).prop('disabled', false);
                }
            });
        }
    });

    // Get file extension

</script>

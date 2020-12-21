<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
		<div class="row">

			<div class="col-md-3">
			</div>

				<div class="col-md-6<?php if($this->input->get('notifications')){echo ' col-md-offset-2';} ?>">
					<div class="panel_s">
						<div class="panel-body">
							<h4 class="no-margin">
								<?php echo _l('staff_profile_notifications'); ?>

							</h4>
							<a href="#" onclick="mark_all_notifications_as_read_inline(); return false;"><?php echo _l('mark_all_as_read'); ?></a>
							<hr class="hr-panel-heading" />
							<div id="notifications">
							</div>
							<a href="#" class="btn btn-info loader" style="margin-top: 20px;"><?php echo _l('load_more'); ?></a>
						</div>
					</div>
				</div>
			<div class="col-md-3">
			</div>
		</div>
	</div>
</div>
</div>
<?php init_tail(); ?>
<script>
    $(function(){
        var notifications = $('#notifications');
        if(notifications.length > 0){
            var page = 0;
            var total_pages = '<?php echo $total_pages; ?>';
            $('.loader').on('click',function(e){
                e.preventDefault();
                if(page <= total_pages){
                    $.post(admin_url + 'admin/notifications',{page:page}).done(function(response){
                        response = JSON.parse(response);
                        var notifications = '';
                        $.each(response,function(i,obj){
                            notifications += '<div class="notification-wrapper" data-notification-id="'+obj.id+'">';
                            notifications += '<div class="notification-box-all'+(obj.isread_inline == 0 ? ' unread' : '')+'">';
                            var link_notification = '';
                            var link_class_indicator = '';
                            if(obj.link){
                                link_notification= ' data-link="'+admin_url+obj.link+'"';
                                link_class_indicator = ' notification_link';
                            }
                            notifications += obj.profile_image;
                            notifications +='<div class="media-body'+link_class_indicator+'"'+link_notification+'>';
                            notifications += '<div class="description">';
                            if(obj.from_fullname){
                                notifications += obj.from_fullname + ' - ';
                            }
                            notifications += obj.description;
                            notifications += '</div>';
                            notifications += '<small class="text-muted text-right text-has-action" data-placement="right" data-toggle="tooltip" data-title="'+obj.full_date+'">' + obj.date + '</small>';
                            if(obj.isread_inline == 0){
                                notifications += '<a href="#" class="text-muted pull-right not-mark-as-read-inline notification-profile" onclick="set_notification_read_inline('+obj.id+')" data-placement="left" data-toggle="tooltip" data-title="<?php echo _l('mark_as_read'); ?>"><small><i class="fa fa-circle-thin" aria-hidden="true"></i></a></small>';
                            }
                            notifications += '</div>';
                            notifications += '</div>';
                            notifications += '</div>';
                        });

                        $('#notifications').append(notifications);
                        page++;
                    });

                    if(page >= total_pages - 1)
                    {
                        $(".loader").addClass("disabled");
                    }
                }
            });

            $('.loader').click();
        }
    });
</script>
</body>
</html>
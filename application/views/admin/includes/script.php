<?php $this->load->view('admin/includes/menu-edite') ?>
<!-- BEGIN: Vendor JS-->

<script src="<?= base_url() ?>/assets/app/js/scripts/scripts.js"></script>
<script src="<?= base_url() ?>/assets/app/vendors/js/vendors.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="<?= base_url() ?>/assets/app/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
<script src="<?= base_url() ?>/assets/app/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
<script src="<?= base_url() ?>/assets/app/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
<script src="<?= base_url() ?>/assets/app/js/scripts/select2.min.js"></script>
<!-- BEGIN Vendor JS-->
<script src="<?= base_url() ?>/assets/plugins/jquery-validation/jquery.validate.js"></script>
<!-- BEGIN: Page Vendor JS-->
<script src="<?= base_url() ?>/assets/app/vendors/js/charts/apexcharts.min.js"></script>
<script src="<?= base_url() ?>/assets/app/vendors/js/extensions/swiper.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="<?= base_url() ?>/assets/app/js/scripts/configs/vertical-menu-light.js"></script>
<script src="<?= base_url() ?>/assets/app/js/core/app-menu.js"></script>
<script src="<?= base_url() ?>/assets/app/js/core/app.js"></script>
<script src="<?= base_url() ?>/assets/app/js/scripts/components.js"></script>
<script src="<?= base_url() ?>/assets/app/js/scripts/footer.js"></script>



<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="<?= base_url() ?>/assets/plugin/datatables/datatables.js"></script>
<script src="<?= base_url() ?>/assets/app/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<!--<script src="<? /*= base_url()*/ ?>/assets/app//vendors/js/tables/datatable/dataTables.buttons.min.js"></script>-->
<script src="<?= base_url() ?>/assets/app/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/assets/app/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/jQueryUI/jquery-ui.js"></script>
<!--<script src="<? /*= base_url()*/ ?>/assets/app/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
-->
<script src="<?= base_url() ?>/assets/app/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/assets/app/vendors/js/tables/datatable/vfs_fonts.js"></script>
<!-- END: Page Vendor JS-->
<script src="<?= base_url() ?>/assets/js/app.js"></script>
<script src="<?= base_url() ?>/assets/js/mailbox_js.js"></script>

<script src="<?= base_url() ?>/assets/js/app-form-validation.js"></script>

<!-- BEGIN: Page JS-->
<script src="<?= base_url() ?>/assets/app/js/scripts/datatables/datatable.js"></script>

<!-- BEGIN: Page JS-->
<script src="<?= base_url() ?>/assets/js/chat/pr-chat.js"></script>
<script src="<?= base_url() ?>/assets/js/chat/jscolor.js"></script>
<script src="<?= base_url() ?>/assets/js/chat/lity.min.js"></script>
<script src="<?= base_url() ?>/assets/js/chat/emoparser.js"></script>
<script src="<?= base_url() ?>/assets/js/chat/tooltipster.bundle.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/moment/moment-with-locales.js"></script>

<!--<script src="<? /*= base_url()*/ ?>/assets/app/js/scripts/pages/dashboard-ecommerce.js"></script>
-->
<script src="<?= base_url() ?>assets/plugins/dropzone/dropzone.js" type="text/javascript"></script>
<script src="<?= base_url() ?>/assets/plugins/validation/app-form-validation.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" id="moment-js" src="<?= base_url() ?>/assets/builds/moment.min.js"></script>
<script type="text/javascript" id="full-calendar-min-js" src="<?= base_url() ?>/assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" id="full-calendar-lang-js" src="<?= base_url() ?>/assets/plugins/fullcalendar/locale/de.js"></script>
<!-- END: Page JS-->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script type="text/javascript">
    $(function(){
        appDatepicker();

        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;
		<?php
		if(!isset($pusher_options['cluster']) && get_option('pusher_cluster') != ''){
			$pusher_options['cluster'] = get_option('pusher_cluster');
		}
		?>
        var pusher_options = <?php echo json_encode($pusher_options); ?>;
        var pusher = new Pusher("<?php echo get_option('pusher_app_key'); ?>", pusher_options);
        var channel = pusher.subscribe('notifications-channel-<?php echo get_user_company_id()."-".get_user_id(); ?>');
        channel.bind('notification', function(data) {
            fetch_notifications();
        });
    });
</script>
<script>
    Pusher.logToConsole = true;
    // Enable pusher logging - don't include this in production
   /* Pusher.logToConsole = true;

    var pusher = new Pusher('30fc7858781856990d1c', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        alert(JSON.stringify(data));
    });*/
</script>
<script>



	$("body").on("change", ".tgl_checkbox", function () {
		var $url = $(this).data('switch-url');
		$.post($url,
				{
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
					id: $(this).data('id'),
					status: $(this).is(':checked') == true ? 1 : 0
				},
				function (data) {

					document.getElementById($(this).attr('id')).checked = $(this).is(':checked') == true ? 'checked' : '';
					//$.notify("Status Changed Successfully", "success");
				});
	});
	$(document).ready(function () {

		$('.dataTables_length').parent('div').addClass('div-datatable');
		$('.dataTables_filter').parent('div').addClass('div-datatable');
		$('#tgl_checkbox').button('toggle');
		clockUpdate();
		setInterval(clockUpdate, 1000);
        fetch_notifications();
	})

	function clockUpdate() {
		var date = new Date();

		//  $('.digital-clock').css({'color': '#fff', 'text-shadow': '0 0 6px #ff0'});

		function addZero(x) {
			if (x < 10) {
				return x = '0' + x;
			} else {
				return x;
			}
		}

		function twelveHour(x) {
			/*if (x > 12) {
				return x = x - 12;
			} else if (x == 0) {
				return x = 12;
			} else {
				return x;
			}*/
			return x;
		}

		var weekday = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"];


		var h = addZero(twelveHour(date.getHours()));
		var m = addZero(date.getMinutes());
		var s = addZero(date.getSeconds());
		var month = date.getMonth() + 1;
		$('.digital-clock').text(weekday[date.getDay()] + ', ' + date.getDate() + '.' + month + '.' + date.getFullYear() + ' | ' + h + ':' + m + ':' + s + ' Uhr')
	}
</script>

<?php
app_js_alerts();
?>
<script>


	var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';

	var csfr_token_value = '<?php echo $this->security->get_csrf_hash(); ?>';

	$(function () {
//-------------------------------------------------------------------
// Country State & City Change


		$('#edit-menu').click(function (e) {
			e.preventDefault();
			$('#modal-edit-menu').modal('show');
		})
		$('#close-reminder-modal').click(function (e) {
			e.preventDefault();
			$('#modal-edit-menu').modal('hide');
		})


		$('.need-edition').on('click', '.edit-menu', function (e) {
			e.preventDefault();
			$('#modal-edit-menu #name').val($(this).parents('.need-edition').find('.menu-text').html().trim());
			$('#modal-edit-menu #menu_slug').val($(this).parents('.need-edition').attr('id').trim());
			$('#modal-edit-menu #menu_clone').val('1');
			$('#modal-edit-menu').modal('show');
		})

		$('#edit-menu').click(function (e) {
			e.preventDefault();
			$('#modal-edit-menu #name').val($(this).parent().find('span').html().trim());
			$('#modal-edit-menu').modal('show');
		})


		$(document).on('change', '.country', function () {
			if (this.value == '') {
				$('.state').html('<option value="">Select Option</option>');
				$('.city').html('<option value="">Select Option</option>');
				return false;
			}


			var data = {
				country: this.value,
			}

			data[csfr_token_name] = csfr_token_value;
			$.ajax({

				type: "POST",

				url: "<?= base_url('admin/auth/get_country_states') ?>",
				data: data,
				dataType: "json",
				success: function (obj) {
					$('.state').html(obj.msg);
				},

			});
		});

		$(document).on('change', '.state', function () {

			var data = {

				state: this.value,

			}

			data[csfr_token_name] = csfr_token_value;

			$.ajax({

				type: "POST",

				url: "<?= base_url('admin/auth/get_state_cities') ?>",

				data: data,

				dataType: "json",

				success: function (obj) {

					$('.city').html(obj.msg);

				},

			});
		});
	});
</script>
</body>
<!-- END: Body-->

</html>


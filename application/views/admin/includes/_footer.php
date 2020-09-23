


<?php if(!isset($footer)): ?>

  <footer class="main-footer">
    <strong><?= $this->general_settings['copyright']; ?></strong>
    <div class="float-right d-none d-sm-inline-block">
      <!--<b>Developed By:</b> CodeGlamour-->
    </div>
  </footer>

  <?php endif; ?>  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Slimscroll -->
<script src="<?= base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
<!-- Notify JS -->
<script src="<?= base_url() ?>assets/plugins/notify/notify.min.js"></script>
<!-- DROPZONE -->
<script src="<?= base_url() ?>assets/plugins/dropzone/dropzone.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		clockUpdate();
		setInterval(clockUpdate, 1000);
	})

	function clockUpdate() {
		var date = new Date();
		$('.digital-clock').css({'color': '#fff', 'text-shadow': '0 0 6px #ff0'});
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
		var weekday = ["Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag"];


		var h = addZero(twelveHour(date.getHours()));
		var m = addZero(date.getMinutes());
		var s = addZero(date.getSeconds());
        var month=date.getMonth()+1;
		$('.digital-clock').text(weekday[date.getDay()]+', '+date.getDate()+'.'+month+'.'+date.getFullYear()+' | '+h + ':' + m + ':' + s +' Uhr')
	}
</script>
<script>

var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';

var csfr_token_value = '<?php echo $this->security->get_csrf_hash(); ?>';

$(function(){
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
$(document).on('change','.country',function()
{

  if(this.value == '')
  {
    $('.state').html('<option value="">Select Option</option>');

    $('.city').html('<option value="">Select Option</option>');

    return false;
  }


  var data =  {

    country : this.value,

  }

  data[csfr_token_name] = csfr_token_value;

  $.ajax({

    type: "POST",

    url: "<?= base_url('admin/auth/get_country_states') ?>",

    data: data,

    dataType: "json",

    success: function(obj) {
      $('.state').html(obj.msg);
   },

  });
});

$(document).on('change','.state',function()
{

  var data =  {

    state : this.value,

  }

  data[csfr_token_name] = csfr_token_value;

  $.ajax({

    type: "POST",

    url: "<?= base_url('admin/auth/get_state_cities') ?>",

    data: data,

    dataType: "json",

    success: function(obj) {

      $('.city').html(obj.msg);

   },

  });
    });
  });
</script>

</body>
</html>

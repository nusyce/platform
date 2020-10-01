<!-- DataTables -->
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<!-- For Messages -->
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<?php $this->load->view('admin/includes/_messages.php') ?>
			<div class="card">
				<div class="card-header">
					<div  id="page-header">
						<h3 class="card-title"><span><?php echo get_menu_option(c_menu(), 'Kunder') ?></span>
							<a id="edit-menu" href="#"><i class="fa fa-pencil"></i></a></h3>
						<a href="<?php echo base_url('admin/client/translation'); ?>"
						   class="btn btn-info btntrans pull-right display-block"><?php echo 'Translate'; ?></a>
					</div>

					<div class="d-inline-block">
						<a href="<?php echo base_url('admin/client/client'); ?>" class="btn btn-success"></i>Erstellen</a>
					</div>
					<?php
					$total = ''; ?>
					<div class="col-md-4" style="padding-right: 0px;  padding-left: 0px;margin-top: 10px">
						<div class="panel_s">
							<div class="panel-body" style="padding: 15px  15px;">
								<?= widget_status_stats('clients', $title); ?>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="card">
				<div class="table-responsive">

					<table id="na_datatable" class="table zero-configuration dataTable" role="grid">
						<thead>
						<tr>
							<th>#</th>
							<th><?php echo get_transl_field('tsl_clients', 'firma', 'Firma') ?></th>
							<th><?php echo get_transl_field('tsl_clients', 'mitarbeiter', 'Mitarbeiter') ?></th>
							<th><?php echo get_transl_field('tsl_clients', 'mieter', 'Mieter') ?></th>
							<th><?php echo get_transl_field('tsl_clients', 'email', 'Email') ?></th>
							<th><?php echo get_transl_field('tsl_clients', 'telefon', 'Telefon ') ?></th>
							<th><?php echo get_transl_field('tsl_clients', 'aktiv', 'Aktiveeee') ?></th>

						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>

<script>
	//---------------------------------------------------
	var table = $('#na_datatable').DataTable({"language": {
			"info": "Zeige _START_ bis _END_ von _TOTAL_ Einträge",
			"searchPlaceholder": "Suchen",
			"search": "",
			"sLengthMenu": "_MENU_",
			"paginate": {
				"previous": "zurück",
				"next": "vor",

			}
		},
		'responsive': true,
		"ajax": "<?=base_url('admin/client/datatable_json')?>",
		"order": [[0, 'asc']],
		"columnDefs": [
			{"targets": 0, "name": "id", 'searchable': true, 'orderable': true},
			{"targets": 1, "name": "username", 'searchable': true, 'orderable': true},
			{"targets": 2, "name": "description", 'searchable': true, 'orderable': true},
			{"targets": 3, "name": "created_at", 'searchable': true, 'orderable': true},
		]
	});


</script>
<script>
	document.getElementById('delete_link').onclick = function (e) {
		if (!confirm('Are you sure?')) {
			e.preventDefault();
		}
	}
</script>

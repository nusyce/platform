<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><span><?php echo get_menu_option(c_menu(), 'Kunder') ?></span>
              <a id="edit-menu" href="#"><i class="fa fa-pencil"></i></a></h3>
			<a href="<?php echo base_url('admin/client/translation'); ?>" class="btn btn-info btntrans pull-left display-block"><?php echo 'Translate'; ?></a>

		</div>
		  <div class="d-inline-block float-right">
			  <a href="<?php echo base_url('admin/client/client');?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Kunden</a>
		  </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo get_transl_field('tsl_clients', 'firma','Firma')?></th>
              <th><?php echo get_transl_field('tsl_clients', 'mitarbeiter', 'Mitarbeiter')?></th>
              <th><?php echo get_transl_field('tsl_clients', 'mieter','Mieter')?></th>
				<th><?php echo get_transl_field('tsl_clients', 'email', 'Email')?></th>
				<th><?php echo get_transl_field('tsl_clients', 'telefon', 'Telefon ')?></th>
				<th><?php echo get_transl_field('tsl_clients', 'action', 'Action')?></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
	  <div class="content-wrapper">
		  <section class="content">


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('admin/client/datatable_json')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "username", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "description", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "created_at", 'searchable':true, 'orderable':true},
    ]
  });
</script>
<script>
	document.getElementById('delete_link').onclick = function(e){
		if( !confirm('Are you sure?') ) {
			e.preventDefault();
		}
	}
</script>

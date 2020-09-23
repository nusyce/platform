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
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp;Mieters</h3>
			<a href="<?php echo base_url('admin/mieter/translation'); ?>" class="btn btn-info btntrans pull-left display-block"><?php echo 'Translate'; ?></a>

		</div>
        <div class="d-inline-block float-right">
			  <a href="<?php echo base_url('admin/mieter/mieter');?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Mieter</a>
		  </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo get_transl_field('tsl_mieter', 'fullname', 'Vollständiger Name')?></th>
              <th><?php echo get_transl_field('tsl_mieter', 'projekt', 'Projekt:')?></th>
              <th><?php echo get_transl_field('tsl_mieter', 'strabe_m', 'Straße')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'nr', 'Nr.')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'wohnungsnummer', 'wohnungsnummer')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'etage', 'Etage')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'flugel', 'Flügel')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'plz', 'PLZ')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'stadt', 'Stadt')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'telefon_1', 'Telefon 1')?></th>

				<th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>  
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('admin/mieter/datatable_json')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "username", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "description", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "created_at", 'searchable':true, 'orderable':true},
    ]
  });
</script>

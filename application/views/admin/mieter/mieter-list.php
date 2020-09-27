<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<!-- <div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark"><?= trans('dashboard') ?></h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><?= trans('home') ?></a></li>
							<li class="breadcrumb-item active"><?= trans('dashboard') ?></li>
						</ol>
					</div>
				</div>
			</div>-->
		</div>
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block" style="display: flex !important;">
          <h3 class="card-title">Mieters</h3>
			<a style="margin-left: 10px" href="<?php echo base_url('admin/mieter/translation'); ?>" class="btn btn-info btntrans pull-left display-block"><?php echo 'Translate'; ?></a>
		</div>
        <div class="d-inline-block float-right" style="margin-top: 10px">
			  <a href="<?php echo base_url('admin/mieter/mieter');?>" class="btn btn-success"><?php echo 'Erstellen'; ?></a>

			<a href="<?php echo admin_url('mieter/import'); ?>"
			   class="btn btn-info "><?= get_menu_option('mieter', 'Mieter') . ' importieren'; ?></a>
		  </div>

		  <?php
		  $total = ''; ?>
		  <div class="col-md-4" style="padding-right: 0px;  padding-left: 0px;margin-top: 10px">



			  <div class="panel_s">
				  <div class="panel-body" style="padding: 15px  15px;">
					  <?= widget_status_stats('mieters', $title); ?>

				  </div>
			  </div>
		  </div>
      </div>
    </div>
    <div class="card">
		<div class="table-responsive">

			<table id="na_datatable" class="table zero-configuration dataTable"  role="grid" >

          <thead>
            <tr>

              <th>ID</th>
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
				<th><?php echo get_transl_field('tsl_mieter', 'aktiv','Aktiveeee')?></th>

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
  var table = $('#na_datatable').DataTable( {
	  "bInfo": false,
    "processing": true,
    "serverSide": false,
	  'responsive': true,
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

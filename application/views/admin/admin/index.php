<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<!-- For Messages --><div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
         <!-- For Messages -->
        <?php $this->load->view('admin/includes/_messages.php') ?>
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                  <h3 class="card-title">

                    <?= trans('admin_list') ?>
                  </h3>
              </div>
				<div class="d-inline-block float-right">
					<a href="<?php echo base_url('admin/admin/add');?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New User</a>
				</div>
            </div>

                <?php echo form_open("/",'class="filterdata"') ?>    
                <div class="row">
                    <div class="col-md-3" style="margin-left: 25px;">
                        <div class="form-group">
                            <select name="type" class="form-control" onchange="filter_data()" >
                                <option value=""><?= trans('all_admin_types') ?></option>
                                <?php foreach($admin_roles as $admin_role):?>
                                    <option value="<?=$admin_role['admin_role_id']?>"><?=$admin_role['admin_role_title']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="status" class="form-control" onchange="filter_data()" >
                                <option value=""><?= trans('all_status') ?></option>
                                <option value="1"><?= trans('active') ?></option>
                                <option value="0"><?= trans('inactive') ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="keyword" class="form-control"  placeholder="<?= trans('search_from_here') ?>..." onkeyup="filter_data()" />
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?> 

        </div>
    </section>


    <!-- Main content -->

    	<div class="card">

               <!-- Load Admin list (json request)-->
               <div class="data_container"></div>

       </div>

	</div>
</div>
<?php init_tail(); ?>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });

</script> 

<script>
//------------------------------------------------------------------
function filter_data()
{
$('.data_container').html('<div class="text-center"><img src="<?=base_url('assets/dist/img')?>/loading.png"/></div>');
$.post('<?=base_url('admin/admin/filterdata')?>',$('.filterdata').serialize(),function(){
	$('.data_container').load('<?=base_url('admin/admin/list_data')?>');
});
}
//------------------------------------------------------------------
function load_records()
{
$('.data_container').html('<div class="text-center"><img src="<?=base_url('assets/dist/img')?>/loading.png"/></div>');
$('.data_container').load('<?=base_url('admin/admin/list_data')?>');
}
load_records();

//---------------------------------------------------------------------

</script>

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if(staff_can('create', 'personalplan')){ ?>
<div class="modal fade _event" id="chooseEventModel">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><?php echo _l('Please Select'); ?></h4>
            </div>

            <div class="modal-body">

                <div class="row">
					<div class="col-md-6">
						<button style="width: 100%;" type="button" onclick="SetTaskMOdal(); "class="btn btn-info" ><?php echo _l('Task'); ?></button>
					</div>
					<div class="col-md-6">
						<button style="width: 100%;" type="button" onclick=" $('#newEventModal').modal('show'); $('#chooseEventModel').modal('hide');" class="btn btn-info"><?php echo _l('Events'); ?></button>
					</div>
                    <div class="col-sm-12 text-center " >
                        <br>
                        <span class="spinner text-primary" id="taksLoader" style='display:none'> Loading... </span>
                    </div>
                </div>

            </div>
   
            <div class="modal-footer">

            </div>
            <!--?php echo form_close(); ?-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php }?>
<style>
    .spinner{
        font-size: 18px;
        color: #106cbf;
    }
</style>
<script>
    function SetTaskMOdal(){

        url = admin_url + 'task/task';
        // show loader
        $('#taksLoader').show();
        requestGet(url).done(function (response) {
            $('#_task').html(response);
            init_selectpicker();
            appDatepicker();
            $("body").find('#_task_modal').modal({show: true, backdrop: 'static'});
            $('#taksLoader').hide();
            //set Cliecked Data in task modal
            setTimeout(() => {
                $('#chooseEventModel').modal('hide');
                $("input[name='startdate']").val(localStorage.getItem('startdate'));

            var valF = JSON.parse(localStorage.getItem('taskfor'));
                $('select[name="task_for[]"]').val(valF).trigger('change');


            }, 900);

        }).fail(function (error) {
            alert_float('danger', error.responseText);
            $('#taksLoader').hide();
        })



    }
</script>

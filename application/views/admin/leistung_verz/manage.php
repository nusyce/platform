<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body _buttons">
                        <div class="style-menu"><h3>
                                <span><?php echo get_menu_option('leistung-verz', _l('Leistung-verz')) ?></span>
                                <a id="edit-menu" href="#"><i class="fa fa-pencil"></i></a></h3>
                            <div style="display: flex">
                                <div><a href="#" id="add_leistung"
                                        class="btn btn-info mright5 pull-left display-block" onclick="add_leistung(event)"><?php echo 'Erstellen'; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <?php
                        $table_data = array(
                            '<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="leistung_verz"><label></label></div>',
                            '#',
                            'name' => 'Name',
                            'checlpoint' => 'Checkpoint'
                        );
                        render_datatable($table_data, 'leistung_verz', [], [
                            'data-last-order-identifier' => 'leistung_verz',
                            'data-default-order' => '',
                        ]);
                        ?>
                    </div>
                </div>
            </div>

            <div id="zone_modal_block_leistung"></div>
            <?php $this->load->view('admin/leistung_verz/add_unit'); ?>
            <?php $this->load->view('admin/leistung_verz/add_einheit'); ?>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<style>

    .display-flex {
        display: flex;
    }

    .no-mbutton .form-group {
        margin-bottom: 0 !important;
        width: 100%;
    }

    .containerlist h3 {
        text-align: left;
        font-size: 21px;
        font-weight: 500;
        text-decoration: underline;
    }

    .summ {
        text-decoration: unset !important;
    }

    .footer h4 {
        font-size: 22px !important;
    }

    .item_leist {
        margin-bottom: 20px;
    }

    .col-md-4.display-flex.no-mbutton > .form-group {
        padding: 0 10px;
    }

</style>
<script>

    var table_leistung_verz = $('.table-leistung_verz');
    if (table_leistung_verz.length) {
        // Add additional server params $_POST
        var LeadsServerParams = {};


        belegunTableServer = leadsTableNotSortable = [];
        var filterArray = [];
        var ContractsServerParams = {};
        $.each($('._hidden_inputs._filters input'), function () {
            ContractsServerParams[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
        });

        var _table_api = renderDataTable(table_leistung_verz, admin_url + 'leistung_verz/render', [0], [0], LeadsServerParams, [1, 'desc'], filterArray);

        $.each(LeadsServerParams, function (i, obj) {
            $('#' + i).on('change', function () {
                table_leistung_verz.DataTable().ajax.reload()
                    .columns.adjust()
                    .responsive.recalc();
            });
        });
    }
    function edit_leistung(e,id) {
        e.preventDefault();
        $.get(admin_url+'leistung_verz/edit/'+id).done(function (response) {

            $('#zone_modal_block_leistung').html(response);
            $('#edit_leistung_modal').modal('show');


        }).fail(function (data) {

        });


    }
    function add_leistung(e) {
        e.preventDefault();
        $.get(admin_url+'leistung_verz/add/').done(function (response) {

            $('#zone_modal_block_leistung').html(response);
            $('#add_modal_leistung').modal('show');


        }).fail(function (data) {

        });


    }
    function charge_select_unit() {
        $.get('<?php echo admin_url('leistung_verz/get_unit'); ?>').done(function (response) {

            response = JSON.parse(response);
            $('.mes_int').each(function (i, obj) {
                jQuery.each(response.response, function(i, val) {
                    var find=false
                    $(obj).find('option').each(function(i,opt) {
                        if($(opt).val()==val.id)
                        {
                            find=true
                        }
                    });
                    if(find==false)
                    {
                        var option = $('<option></option>').attr("value", val.id).text(val.name);
                        $(obj).append(option);
                    }

                });
            });

        }).fail(function (data) {

        });


    }
    function charge_select_einheit() {
        $.get('<?php echo admin_url('leistung_verz/get_einheit'); ?>').done(function (response) {

            response = JSON.parse(response);
            $('.mes_ein').each(function (i, obj) {
                jQuery.each(response.response, function(i, val) {
                    var find=false
                    $(obj).find('option').each(function(i,opt) {
                        if($(opt).val()==val.id)
                        {
                            find=true
                        }
                    });
                    if(find==false)
                    {
                        var option = $('<option></option>').attr("value", val.id).text(val.name);
                        $(obj).append(option);
                    }

                });
            });

        }).fail(function (data) {

        });


    }
    $(function () {



        $( "#add_unit_leistung_verz" ).submit(function( e ) {
            e.preventDefault();
            var form = $(this);
            var data = $(form).serialize();
            $.post(form.attr('action'), data).done(function (response) {

                response = JSON.parse(response);
                if (response.response)
                {
                    $('#unit_modal').modal('hide');
                    alert_float('success', "Successfully added");
                    charge_select_unit();
                }else {
                    alert_float('danger', 'Impossible to add');
                }

            }).fail(function (data) {
                alert_float('danger', data.responseText);
            });
            return false;
        });
        $( "#add_einheit_leistung_verz" ).submit(function( e ) {
            e.preventDefault();
            var form = $(this);
            var data = $(form).serialize();
            $.post(form.attr('action'), data).done(function (response) {

                response = JSON.parse(response);
                if (response.response)
                {
                    $('#einheit_modal').modal('hide');
                    alert_float('success', "Successfully added");
                    charge_select_einheit();
                }else {
                    alert_float('danger', 'Impossible to add');
                }

            }).fail(function (data) {
                alert_float('danger', data.responseText);
            });
            return false;
        });
        $('body').on('click', '#add_unit_btn', function (e) {
            e.preventDefault();
            $('#unit_modal').modal('show');
        })
        $('body').on('click', '#add_einheit_btn', function (e) {
            e.preventDefault();
            $('#einheit_modal').modal('show');
        })


        $('body').on('click', '#add_leistung', function (e) {
            e.preventDefault();
            $('#action-checpoint').modal('show')
        })

        $('body').on('click', '#add_item', function (e) {
            e.preventDefault();

            var v_nam = $('#v_name').val();

            if (v_nam == '') {
                return false
            }
            var num=$("#bereich_select").val()-1;
            var rang= $('.containerlist .leistend ').eq(num).find('.item_leist').length;
            var item_template = "\n" +
                "                    <div class=\"row item_leist\">\n" +
                "                        <div class=\"col-md-4\">\n" +
                "                        </div>\n" +
                "                        <div class=\"col-md-1 display-flex no-mbutton\">\n" +
                "                         </div>\n" +
                    "<div class=\"col-md-1\" style=\"text-align: center;\"> <h5 ><b style=\"text-decoration: underline\">Einheit</b></div>\n" +
                "<div class=\"col-md-1\" style=\"text-align: center;\"> <h5 ><b style=\"text-decoration: underline\">Menge</b></div>\n" +
                "<div class=\"col-md-1\" style=\"text-align: center;\"> <h5 ><b style=\"text-decoration: underline\">Material</b></div>\n" +
                "<div class=\"col-md-1\" style=\"text-align: center;\"> <h5 ><b style=\"text-decoration: underline\">Auto</b></div>\n" +
                "<div class=\"col-md-1\" style=\"text-align: center;\"> <h5 ><b style=\"text-decoration: underline\">Geräte</b></div>\n" +
                "<div class=\"col-md-1\" style=\"text-align: center;\"> <h5 ><b style=\"text-decoration: underline\">Preis</b></div>\n" +
                "<div class=\"col-md-1\" style=\"text-align: center;\"> <h5 ><b style=\"text-decoration: underline\">G-Preis</b></div>\n" +
                "<div class=\"col-md-5\" style=\"text-align: center;\"> </div>\n" +
                    "<div class=\"col-md-1\" style=\"text-align: center;\"> <h5 style=\"margin-top: 5px\"><b style=\"text-decoration: underline\">Berechnung</b></h5>\n" +
                "                            </div>\n" +
                    "<div class=\"col-md-1\" >\n" +
                "                                <h5 style=\"margin-top: 6px;\">Pauschat<h5><h5  >Prozentual</h5>\n" +
                "                            </div>\n" +
                    " <div class=\"col-md-1\" style=\"margin-top: 5px;text-align: center;\">\n" +
                "                                <input class=\"mes_scales\" type=\"checkbox\" id=\"scales\" name=\"mes_intervalles["+num+"][item]["+rang+"][scales][]\"><br><input class=\"mes_scales\" type=\"checkbox\" id=\"scales\" name=\"mes_intervalles["+num+"][item]["+rang+"][scales][]\">\n" +
                "                            </div>\n" +
                    "<div class=\"col-md-1\" style=\"margin-top: 5px;text-align: center;\">\n" +
                "                                <input class=\"mes_scales\" type=\"checkbox\" id=\"scales\" name=\"mes_intervalles["+num+"][item]["+rang+"][scales][]\"><br><input class=\"mes_scales\" type=\"checkbox\" id=\"scales\" name=\"mes_intervalles["+num+"][item]["+rang+"][scales][]\">\n" +
                "                            </div>\n" +
                    "<div class=\"col-md-1\" style=\"    margin-top: 5px;text-align: center;\">\n" +
                "                                <input class=\"mes_scales\" type=\"checkbox\" id=\"scales\" name=\"mes_intervalles["+num+"][item]["+rang+"][scales][]\"><br><input class=\"mes_scales\" type=\"checkbox\" id=\"scales\" name=\"mes_intervalles["+num+"][item]["+rang+"][scales][]\">\n" +
                "                            </div>\n" +
                    " <div class=\"col-md-1\" style=\"    margin-top: 5px;text-align: center;\">\n" +
                "                                <input class=\"mes_scales\" type=\"checkbox\" id=\"scales\" name=\"mes_intervalles["+num+"][item]["+rang+"][scales][]\"><br><input class=\"mes_scales\" type=\"checkbox\" id=\"scales\" name=\"mes_intervalles["+num+"][item]["+rang+"][scales][]\">\n" +
                "                            </div>\n" +
                    "<div class=\"col-md-1\" style=\"    margin-top: 5px;text-align: center;\">\n" +
                "                                <input class=\"mes_scales\" type=\"checkbox\" id=\"scales\" name=\"mes_intervalles["+num+"][item]["+rang+"][scales][]\"><br><input class=\"mes_scales\" type=\"checkbox\" id=\"scales\" name=\"mes_intervalles["+num+"][item]["+rang+"][scales][]\">\n" +
                "                            </div>\n" +
                "                       <div class=\"row\"></div> <div class=\"col-md-4\">\n" +
                "                            <span>" + v_nam + "</span><br><select class='mes_int mes_ints' style=\"font-size: 13px;\" name=\"mes_intervalles["+num+"][item]["+rang+"][interval]\" id=\"intervalles\">\n" +
                "                                      \n" +
                "\n" +
                "                                    </select>\n" +
                "                            <input type=\"hidden\"   name=\"mes_intervalles["+num+"][item]["+rang+"][name]\" class='form-control mes_names' value='" + v_nam + "'>\n" +

                "                        </div>\n" +
                "                        <div class=\"col-md-1 \">\n" +
                "                            <a href=\"#\" class=\"btn btn-danger remove_item\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i>\n</a></div>\n" +
                "                            <div class=\"col-md-1\"><div class=\"form-group\" app-field-wrapper=\"hour_1\">\n" +
                "                               <select class=\"mes_ein\"  style=\"    font-size: 14px;\n" +
                "    height: 35px;\" name=\"mes_intervalles["+num+"][item]["+rang+"][hour][]\" id=\"intervalles\">\n" +
                "                                        \n" +
                "\n" +
                "                                    </select></div></div>\n" +
                "\n" +
                "                            <div class=\"col-md-1\"><div class=\"form-group\" app-field-wrapper=\"hour_2\">\n" +
                "                                <input type=\"text\"  name=\"mes_intervalles["+num+"][item]["+rang+"][hour][]\" class=\"form-control hour_2\" value=\"\"></div>\n" +
                "                        </div>\n" +"\n" +
                "                            <div class=\"col-md-1\"><div class=\"form-group\" app-field-wrapper=\"hour_2\">\n" +
                "                                <input type=\"text\"  name=\"mes_intervalles["+num+"][item]["+rang+"][hour][]\" class=\"form-control hour_2\" value=\"\"></div>\n" +
                "                        </div>\n" +
                "\n" +
                "                            <div class=\"col-md-1\"><div class=\"form-group\" app-field-wrapper=\"hour_2\">\n" +
                "                                <input type=\"text\"  name=\"mes_intervalles["+num+"][item]["+rang+"][hour][]\" class=\"form-control hour_2\" value=\"\"></div>\n" +
                "                        </div>\n" +
                "\n" +
                "                            <div class=\"col-md-1\"><div class=\"form-group\" app-field-wrapper=\"hour_2\">\n" +
                "                                <input type=\"text\"  name=\"mes_intervalles["+num+"][item]["+rang+"][hour][]\" class=\"form-control hour_2\" value=\"\"></div>\n" +
                "                        </div>\n" +
                "\n" +
                "                            <div class=\"col-md-1\"><div class=\"form-group\" app-field-wrapper=\"hour_2\">\n" +
                "                                <input type=\"text\"  name=\"mes_intervalles["+num+"][item]["+rang+"][hour][]\" class=\"form-control hour_2\" value=\"\"></div>\n" +
                "                        </div>\n" +
                "\n" +
                "                            <div class=\"col-md-1\"><div class=\"form-group\" app-field-wrapper=\"hour_2\">\n" +
                "                                <input type=\"text\"  name=\"mes_intervalles["+num+"][item]["+rang+"][hour][]\" class=\"form-control hour_2\" value=\"\"></div>\n" +
                "                        </div> \n" +
                "                    </div>";

            $('.containerlist .leistend').eq(num).append(item_template);
            $('#v_name').val('');
            charge_select_unit();
            charge_select_einheit();
        })
        $('body').on('change keyup', '.hour_1', function (e) {
            e.preventDefault();
            calculateAll();
        })

        function calculateAll() {

            $('#bereich_select').empty();
            $('.containerlist').each(function (i, obj) {

                var option = $("<option></option>")
                    .attr("value", i+1)
                    .text($(obj).find('.countif').html());
                $("#bereich_select").append(option);
                var summ = 0;
                $(obj).find('.item_leist').each(function (j, zez) {
                    const trans = $(zez).find('.hour_1').val();
                    summ += parseInt(trans);
                });
                if (summ)
                    $(obj).find('.summ').html(summ);
            });
            $('.containerlist').each(function (i, obj) {

                $(obj).find('.mes_int').attr('name','mes_intervalles['+i+'][interval]');
                $(obj).find('.bacpu').attr('name','mes_intervalles['+i+'][bereich]');
                $(obj).find('.item_leist').each(function (j, objt) {

                    $(objt).find('.mes_ints').attr('name','mes_intervalles['+i+'][item]['+j+'][interval]');
                    $(objt).find('.mes_names').attr('name','mes_intervalles['+i+'][item]['+j+'][name]');
                    $(objt).find('.mes_ein').attr('name','mes_intervalles['+i+'][item]['+j+'][hour][]');
                    $(objt).find('.mes_scales').each(function (k, objtt) {
                        $(objtt).attr('name','mes_intervalles['+i+'][item]['+j+'][scales][]');
                    });
                    $(objt).find('.hour_2').each(function (p, objtp) {
                        $(objtp).attr('name','mes_intervalles['+i+'][item]['+j+'][hour][]');
                    });

                });

            });

        }


        $('body').on('click', '.remove_bereich', function (e) {
            $(this).parents('.containerlist').remove();
            calculateAll();


        });
        $('body').on('click', '.remove_item', function (e) {
            var item_leist= $(this).parents('.item_leist').remove();
            calculateAll();
        });

        $('body').on('click', '.edit_bereich', function (e) {
            e.preventDefault();
            $(this).parents("h3").find( "input" ).val($(this).parents("h3").find( ".countif" ).html());
            $(this).parents("h3").find( "input" ).attr("type","text");
            calculateAll();
        });
        $('body').on('focusout', '.bacpu', function (e) {

            $(this).parents("h3").find( ".countif" ).html(  $(this).val())
            $(this).attr("type","hidden");
            calculateAll();

        });
        $('body').on('click', '#addbranche', function (e) {
            e.preventDefault();
            $cloned = $('.containerlist:last').clone();
            var num=$('.containerlist').length;
            if($('.containerlist .leistend ').eq(num-1).find('.item_leist').length<1)
            {
                alert_float('danger','Der vorherige bereich hat keine Aufgabe');
                return false;
            }
            $cloned.find('.mes_int').attr('name','mes_intervalles['+num+'][interval]');
            $cloned.find('.bacpu').attr('name','mes_intervalles['+num+'][bereich]');
            var numm=num+1;
            $cloned.find('.bacpu').val('Bereich '+numm);
            $cloned.find('.delete_bereich_zone').html('<a href="#" class="btn btn-danger remove_bereich" ><i class="fa fa-times" aria-hidden="true"></i>\n' +
                '</a>');
            var c=$('.containerlist').length + 1;
            $cloned.find('.countif').html('Bereich '+c);

            var elts=$cloned.find('#scales');

            for(var i = 0; i < elts.length; i++)
                elts[i].name="mes_intervalles["+num+"][scales][]";
            $cloned.find('.item_leist').remove();
            $cloned.find('.summ').html(0);
            $('#bulderarrear').append($cloned);
            calculateAll();

        });

        $( "body" ).delegate( "#add_leistung_verz", "submit", function() {
            var this_master = $(this);
            this_master.find('input[type="checkbox"]').each( function () {
                var checkbox_this = $(this);


                if( checkbox_this.is(":checked") == true ) {
                    checkbox_this.attr('value','on');
                } else {
                    checkbox_this.prop('checked',true);
                    //DONT' ITS JUST CHECK THE CHECKBOX TO SUBMIT FORM DATA
                    checkbox_this.attr('value','off');
                }
            })
        });

        $('table').on('click', '.edit_leistung', function (e) {
            e.preventDefault();
            $('#bulderarrear').html('');
            $id = $(this).data('id');
            requestGet(admin_url + 'leistung_verz/get/' + $id).done(function (response) {
                response = JSON.parse(response);
                $('#leistung_verz').val(response.id);
                $('#action-checpoint #name').val(response.name);
                $.each(response.item_leist, function (i, item) {
                    var item_template = "\n" +
                        "                    <div class=\"row item_leist\">\n" +
                        "                        <div class=\"col-md-8\">\n" +
                        "                            <a id=\"edit_menu\" href=\"#\"><i class=\"fa fa-pencil\"></i></a>\n" +
                        "                            <span>" + item.name + "</span>\n" +
                        "                            <input type=\"hidden\"   name=\"item_name[]\" class='form-control' value='" + item.name + "'>\n" +

                        "                        </div>\n" +
                        "                        <div class=\"col-md-4 display-flex no-mbutton\">\n" +
                        "                            <a href=\"#\" class=\"btn btn-danger remove_item\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i>\n</a>\n" +
                        "                            <div class=\"form-group\" app-field-wrapper=\"hour_1\">\n" +
                        "                                <input type=\"text\"   name=\"hour_1[]\" class=\"form-control\" value='" + item.hours_1 + "'></div>\n" +
                        "\n" +
                        "                            <div class=\"form-group\" app-field-wrapper=\"hour_2\">\n" +
                        "                                <input type=\"text\"  name=\"hour_2[]\" class=\"form-control\" value='" + item.hours_2 + "'></div>\n" +
                        "                        </div>\n" +
                        "                    </div>";

                    $('#bulderarrear').append(item_template);

                });
                $('#action-checpoint').modal('show')
            });

        });
        // $('body').on('click', '#edit_menu', function (e) {
        //     .v_name.val() =
        //     $(this).parents('.item_leist').remove();
        // });

    });


</script>
</body>
</html>

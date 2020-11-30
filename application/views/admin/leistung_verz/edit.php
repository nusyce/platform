<?php $my_items = unserialize($item->item);?>
<div class="modal fade" id="edit_leistung_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Leistung-verzeichnis bearbeiten
                </h4>
            </div>
            <div class="modal-body">
                <?php echo form_open(admin_url('leistung_verz/edit/'.$item->id),['id'=>"add_leistung_verz"]); ?>
                <input type="hidden" value="0" name="leistung_verz"
                       id="leistung_verz">
                <div class="row field-cloneb">
                    <div class="col-md-6 text-center col-md-offset-3">
                        <?php echo render_input('name',  'Name',$item->name,'',['placeholder'=>'Krone'],'','','text-center'); ?>
                    </div>
                    <div class="col-md-3" style="float: right;">
                        <a href="#" style="float: right;margin-top: 7px;" id="add_einheit_btn">Einheiten definieren</a>
                        <a href="#" style="float: right;" id="add_unit_btn">Intervall definieren</a>
                    </div>
                </div>
                <br>
                <div id="bulderarrear">
                    <?php $i=0; foreach ($my_items as $my_item){ ?>
                        <div class="containerlist listbuld" data-id="1">
                            <div class="row headeree">
                                <div class="col-md-4">
                                    <h3 class="branch" style="text-decoration: none;"><font style="text-decoration: underline" class="countif"><?=$my_item['bereich']?></font>
                                        <a id="edit_menu" class="edit_bereich" href="#" style="margin-left: 10px">
                                            <i class="fa fa-pencil" style="    font-size: 15px;"></i>
                                        </a>
                                        <input type="hidden" value="<?=$my_item['bereich']?>" class="bacpu" style="width: 150px;height: 25px;" name="mes_intervalles[<?=$i?>][bereich]">
                                        <select style="    margin-left: 10px;font-size: 15px;" name="mes_intervalles[<?=$i?>][interval]" class="mes_int" id="mesintervalles">
                                            <?php foreach ($unit as $unity){?>
                                                <option <?php if ($my_item['interval'] == $unity['id']) echo 'selected'; ?> value="<?=$unity['id'] ?>"><?=$unity['name'] ?></option>
                                            <?php }?>
                                        </select></h3>

                                </div>
                                <div>
                                    <div class="col-md-1 delete_bereich_zone" id="">
                                        <?php if ($i > 0){?>
                                            <a href="#" class="btn btn-danger remove_bereich" ><i class="fa fa-times" aria-hidden="true"></i></a>
                                        <?php }?>
                                    </div>

                                </div>
                            </div>
                            <div class="leistend">
                                <?php $k=0; foreach ($my_item['item'] as $my_item_item){ ?>
                                    <div class="row item_leist">
                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-1 display-flex no-mbutton">
                                        </div>
                                        <div class="col-md-1" style="text-align: center;"> <h5><b style="text-decoration: underline">Einheit</b></h5></div>
                                            <div class="col-md-1" style="text-align: center;"> <h5><b style="text-decoration: underline">Menge</b></h5></div>
                                                <div class="col-md-1" style="text-align: center;"> <h5><b style="text-decoration: underline">Material</b></h5></div>
                                                    <div class="col-md-1" style="text-align: center;"> <h5><b style="text-decoration: underline">Auto</b></h5></div>
                                                        <div class="col-md-1" style="text-align: center;"> <h5><b style="text-decoration: underline">Geräte</b></h5></div>
                                                            <div class="col-md-1" style="text-align: center;"> <h5><b style="text-decoration: underline">Preis</b></h5></div>
                                                                <div class="col-md-1" style="text-align: center;"> <h5><b style="text-decoration: underline">G-Preis</b></h5></div>
                                                                    <div class="col-md-5" style="text-align: center;"> </div>
                                                                    <div class="col-md-1" style="text-align: center;"> <h5 style="margin-top: 5px"><b style="text-decoration: underline">Berechnung</b></h5>
                                                                    </div>
                                                                    <div class="col-md-1" >
                                                                        <h5 style="margin-top: 5px">Pauschat</h5><h5>Prozentual</h5>
                                                                    </div>

                                                                    <div class="col-md-1" style="margin-top: 5px;text-align: center;">
                                                                        <input class="mes_scales" type="checkbox" id="scales" <?php if ($my_item_item['scales'][0] == 'on') echo 'checked'; ?> name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][scales][]"><br><input class="mes_scales" <?php if ($my_item_item['scales'][1] == 'on') echo 'checked'; ?> type="checkbox" id="scales" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][scales][]">
                                                                    </div>
                                                                    <div class="col-md-1" style="margin-top: 5px;text-align: center;">
                                                                        <input class="mes_scales" type="checkbox" <?php if ($my_item_item['scales'][2] == 'on') echo 'checked'; ?> id="scales" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][scales][]"><br><input class="mes_scales" <?php if ($my_item_item['scales'][3] == 'on') echo 'checked'; ?> type="checkbox" id="scales" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][scales][]">
                                                                    </div>
                                                                    <div class="col-md-1" style="    margin-top: 5px;text-align: center;">
                                                                        <input class="mes_scales" type="checkbox" <?php if ($my_item_item['scales'][4] == 'on') echo 'checked'; ?> id="scales" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][scales][]"><br><input class="mes_scales" <?php if ($my_item_item['scales'][5] == 'on') echo 'checked'; ?> type="checkbox" id="scales" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][scales][]">
                                                                    </div>
                                                                    <div class="col-md-1" style="    margin-top: 5px;text-align: center;">
                                                                        <input class="mes_scales" type="checkbox" id="scales" <?php if ($my_item_item['scales'][6] == 'on') echo 'checked'; ?> name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][scales][]"><br><input class="mes_scales" <?php if ($my_item_item['scales'][7] == 'on') echo 'checked'; ?> type="checkbox" id="scales" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][scales][]">
                                                                    </div>
                                                                    <div class="col-md-1" style="    margin-top: 5px;text-align: center;">
                                                                        <input class="mes_scales" type="checkbox" <?php if ($my_item_item['scales'][8] == 'on') echo 'checked'; ?> id="scales" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][scales][]"><br><input class="mes_scales" <?php if ($my_item_item['scales'][9] == 'on') echo 'checked'; ?> type="checkbox" id="scales" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][scales][]">
                                                                    </div>


                                                                    <div class="row"></div>
                                        <div class="col-md-4">

                                            <span><?= $my_item_item['name'];?></span><br><select class="mes_int mes_ints" style="font-size: 13px;" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][interval]" id="intervalles">
                                                <?php foreach ($unit as $unity){ ;?>
                                                    <option <?php if ($my_item_item['interval'] == $unity['id']) echo 'selected'; ?> value="<?=$unity['id'] ?>"><?=$unity['name'] ?></option>
                                                <?php }?>

                                            </select>
                                            <input type="hidden" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][name]" class="form-control mes_names" value="<?= $my_item_item['name'];?>">
                                        </div>
                                        <div class="col-md-1 ">
                                            <a href="#" class="btn btn-danger remove_item"><i class="fa fa-times" aria-hidden="true"></i>
                                            </a></div>
                                        <div class="col-md-1"><div class="form-group" app-field-wrapper="hour_1">
                                                <select class="mes_ein" style="font-size: 14px;
    height: 35px;" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][hour][]" id="intervalles">
                                                    <?php foreach ($einheit as $ein){ ;?>
                                                        <option <?php if ($my_item_item['hour'][0]== $ein['id']) echo 'selected'; ?> value="<?=$ein['id'] ?>"><?=$ein['name'] ?></option>
                                                    <?php }?>

                                                </select></div></div>

                                        <div class="col-md-1"><div class="form-group" app-field-wrapper="hour_2">
                                                <input type="text"  name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][hour][]" class="form-control hour_2" value="<?= $my_item_item['hour'][1];?>"></div>
                                        </div>

                                        <div class="col-md-1"><div class="form-group" app-field-wrapper="hour_2">
                                                <input type="text" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][hour][]" class="form-control hour_2" value="<?= $my_item_item['hour'][2];?>"></div>
                                        </div>

                                        <div class="col-md-1"><div class="form-group" app-field-wrapper="hour_2">
                                                <input type="text" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][hour][]" class="form-control hour_2" value="<?= $my_item_item['hour'][3];?>"></div>
                                        </div>

                                        <div class="col-md-1"><div class="form-group" app-field-wrapper="hour_2">
                                                <input type="text" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][hour][]" class="form-control hour_2" value="<?= $my_item_item['hour'][4];?>"></div>
                                        </div>

                                        <div class="col-md-1"><div class="form-group" app-field-wrapper="hour_2">
                                                <input type="text" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][hour][]" class="form-control hour_2" value="<?= $my_item_item['hour'][5];?>"></div>
                                        </div>

                                        <div class="col-md-1"><div class="form-group" app-field-wrapper="hour_2">
                                                <input type="text" name="mes_intervalles[<?= $i;?>][item][<?= $k;?>][hour][]" class="form-control hour_2" value="<?= $my_item_item['hour'][6];?>"></div>
                                        </div>
                                    </div>
                                    <?php $k++; }?>
                            </div>
                            <!--<div class="row footer">
                                <div class="col-md-9">
                                    <h4>Gesamt:</h4>
                                </div>
                                <div class="col-md-3 text-center">
                                    <h3 class="summ">0</h3>
                                </div>
                            </div>-->
                            <hr style="border-top: 1px solid #eae1e1;">
                        </div>
                        <?php $i++; }?>
                </div>
                <div class="leistend">
                </div>
                <div class="row">
                    <h4 style="margin: 0;
    margin-left: 15px;">Summe aller Positionen</h4>
                    <hr style="border-top: 1px solid #eae1e1;margin-left: 15px">

                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-6" style="    border: 2px solid #efeaea;
    padding: 25px;">
                        <h4 style="text-align: center;">Aufgabe erstellen</h4>
                        <p style="text-align: center;"><select  style="    margin-left: 10px;font-size: 15px;" name="bereich_select" id="bereich_select">
                                <?php $i=0; foreach ($my_items as $my_item){ ?>
                                    <option value="<?= $i ?>"><?=$my_item['bereich']?></option>
                                <?php  }?>
                            </select></p>
                        <p style="text-align: center;margin: 0 0 10px !important;"><i class="fa fa-plus"></i> <a href="#" id="addbranche">neuen Bereich anlegen</a></p>

                        <div class="display-flex no-mbutton">
                            <?php echo render_input('v_name'); ?><a href="#" class="btn btn-primary" id="add_item">Erstellen</a>
                        </div>



                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right">
                            <button type="submit" id="blu_save"
                                    class="btn btn-info save_list"><?php echo _l('submit'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

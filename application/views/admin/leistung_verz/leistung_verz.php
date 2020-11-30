<div class="modal fade" id="add_modal_leistung" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Leistung-verzeichnis erstellen
                </h4>
            </div>
            <div class="modal-body">
                <?php echo form_open(admin_url('leistung_verz/leistung_verz'),['id'=>"add_leistung_verz"]); ?>
                <input type="hidden" value="0" name="leistung_verz"
                       id="leistung_verz">
                <div class="row field-cloneb">
                    <div class="col-md-6 text-center col-md-offset-3">
                        <?php echo render_input('name',  'Name','','',['placeholder'=>'Krone'],'','','text-center'); ?>
                    </div>
                    <div class="col-md-3" style="float: right;">
                        <a href="#" style="float: right;margin-top: 7px;" id="add_einheit_btn">Einheiten definieren</a>
                        <a href="#" style="float: right;" id="add_unit_btn">Intervall definieren</a>
                    </div>
                </div>
                <br>
                <div id="bulderarrear">
                    <div class="containerlist listbuld" data-id="1">
                        <div class="row headeree">
                            <div class="col-md-4">
                                <h3 class="branch" style="text-decoration: none;"><font style="text-decoration: underline" class="countif">Bereich 1</font>
                                    <a id="edit_menu" class="edit_bereich" href="#" style="margin-left: 10px">
                                        <i class="fa fa-pencil" style="    font-size: 15px;"></i>
                                    </a>
                                    <input type="hidden" value="Bereich 1" class="bacpu" style="width: 150px;height: 25px;" name="mes_intervalles[0][bereich]">
                                    <select style="    margin-left: 10px;font-size: 15px;" name="mes_intervalles[0][interval]" class="mes_int" id="mesintervalles">
                                        <?php foreach ($unit as $unity){?>
                                            <option value="<?=$unity['id'] ?>"><?=$unity['name'] ?></option>
                                        <?php }?>
                                    </select></h3>

                            </div>
                            <div style="">
                            <div class="col-md-1 delete_bereich_zone" id="">

                            </div>

                            </div>
                        </div>
                        <div class="leistend">

                        </div>
                       <!-- <div class="row footer">
                            <div class="col-md-9">
                                <h4>Gesamt:</h4>
                            </div>
                            <div class="col-md-3 text-center">
                                <h3 class="summ">0</h3>
                            </div>
                        </div>-->
                        <hr style="border-top: 1px solid #eae1e1;">
                    </div>

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
                                <option value="1">Bereich (1)</option>

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



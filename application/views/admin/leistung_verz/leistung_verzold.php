<div class="modal fade" id="action-checpoint" tabindex="-1" role="dialog">
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
                <?php echo form_open(admin_url('leistung_verz/leistung_verz')); ?>
                <input type="hidden" value="0" name="leistung_verz"
                       id="leistung_verz">
                <div class="row field-cloneb">
                    <div class="col-md-6 text-center col-md-offset-3">
                        <?php echo render_input('name',  'Name','','',['placeholder'=>'Krone'],'','','text-center'); ?>
                    </div>
                    <div class="col-md-3" style="float: right;">
                        <a href="#" style="float: right;">Einheiten definieren</a>
                        <a href="#" style="float: right;margin-top: 7px;">Einheiten definieren</a>
                    </div>
                </div>
                <br>
                <div id="bulderarrear">
                    <div class="containerlist listbuld" data-id="1">
                        <div class="row headeree">
                            <div class="col-md-4">
                                <h3 class="text-center branch">Bereich <span class="countif">1</span> <select style="    margin-left: 20px;font-size: 15px;" name="intervalles" id="intervalles">
                                        <option value="volvo">INTERVALL</option>

                                    </select></h3>

                            </div>
                            <div style="margin-top: 15px;">
                            <div class="col-md-1">

                            </div>
                            <div class="col-md-1" style="text-align: center;">
                                <h5 ><b style="text-decoration: underline">Berechnung</b><br><p style="margin-top: 37px;">Einheit</p></h5>
                            </div>
                            <div class="col-md-1" style="    margin-top: 8px;">
                                <p >Pauschat<br>Prozentual<br><p style="margin-top: 15px;">Menge</p></p>
                            </div>
                            <div class="col-md-1" style="margin-top: 5px;text-align: center;">
                                <input type="checkbox" id="scales" name="scales"><br><input type="checkbox" id="scales" name="scales"><br><p style="margin-top: 10px;">Material</p>
                            </div>
                            <div class="col-md-1" style="margin-top: 5px;text-align: center;">
                                <input type="checkbox" id="scales" name="scales"><br><input type="checkbox" id="scales" name="scales"><br><p style="margin-top: 10px;">Auto</p>
                            </div>
                            <div class="col-md-1" style="    margin-top: 5px;text-align: center;">
                                <input type="checkbox" id="scales" name="scales"><br><input type="checkbox" id="scales" name="scales"><br><p style="margin-top: 10px;">Geräte</p>
                            </div>
                            <div class="col-md-1" style="    margin-top: 5px;text-align: center;">
                                <input type="checkbox" id="scales" name="scales"><br><input type="checkbox" id="scales" name="scales"><br><p style="margin-top: 10px;">Preis</p>
                            </div>
                            <div class="col-md-1" style="    margin-top: 5px;text-align: center;">
                                <input type="checkbox" id="scales" name="scales"><br><input type="checkbox" id="scales" name="scales"><br><p style="margin-top: 10px;">G-Preis</p>
                            </div>
                            </div>
                        </div>
                        <div class="leistend">

                        </div>
                        <div class="row footer">
                            <div class="col-md-9">
                                <h4>Gesamt:</h4>
                            </div>
                            <div class="col-md-3 text-center">
                                <h3 class="summ">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-8 display-flex no-mbutton">
                        <?php echo render_input('v_name'); ?><a href="#" class="btn btn-primary" id="add_item">Erstellen</a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <i class="fa fa-plus"></i> <a href="#" id="addbranche">neuen Bereich anlegen</a>
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
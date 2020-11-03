<style type="text/css">
    <!--
    table {
        vertical-align: top;
    }

    tr {
        vertical-align: top;
    }

    td {
        vertical-align: top;
    }

    * {
        font-size: 13px;
    }

    -->
</style>
<page backcolor="#FEFEFE" backtop="40mm"
      backbottom="40mm" style="font-size: 11pt">
    <page_header>
        <p style="text-align: right">
            <img style="width: 220px;" src="assets/images/markat-new-logo.png" alt="Image Markat">
        </p>

    </page_header>
    <page_footer>
        <div style="text-align: right; border-bottom: 1px solid #000000; padding-bottom: 5px; margin-bottom: 5px">Seite
            [[page_cu]]/[[page_nb]]
        </div>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: left; font-size: 10px; width: 22%">
                    Zahlungsempfänger<br>
                    Bankverbindung
                </td>
                <td style=" width: 78%; font-size: 10px">
                    Martin Katzky<br>
                    Berliner Sparkasse , Hinweis: Bei Überweisungen bitte unbedingt die Rechnungsnummer angeben.<br>
                    BIC BELADEBE, IBAN DE98100500001069280506

                </td>
            </tr>
        </table>
    </page_footer>
    <div style="font-size: 11px; padding-bottom: 8px;: "> Markat - Bitterfelderst. 12 - 12681 Berlin</div>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
            <td style="width: 65%; font-weight: bold">
                <?php

                if (isset($task->project_data->client_data) && $task->project_data->client_data) {
                    $client_data = $task->project_data->client_data;
                } elseif (isset($task->client_data) && $task->client_data) {
                    $client_data = $task->client_data;
                } else {
                    $client_data = null;
                }

                if ($client_data) {
                    $ansprechpartners = $client_data->ansprechpartners;
                    if ($ansprechpartners) {
                        $ansprechpartners = $ansprechpartners[0];
                    }
                }
                ?>
                <?php
                if (empty($client_data) && $task->project_data): ?>
                    <div><strong><?= $task->project_data->name ?> </strong></div>
                <?php endif; ?>
                <div><strong><?= $client_data ? $client_data->company : '' ?> </strong></div>
                <div><?= isset($ansprechpartners) ? $ansprechpartners['nachname'] . ' ' . $ansprechpartners['vorname'] : '' ?></div>
                <div><?= $client_data ? $client_data->strabe : ' ' ?> <?= $client_data ? $client_data->hausnummer : '' ?>  </div>
                <div><?= $client_data ? $client_data->zip : ' ' ?>  <?= $client_data ? $client_data->city : '' ?>  </div>
                <br><br><br><br>
                <?php if (!empty($client_data->company_le)): ?>
                    <div style="font-weight: normal">
                        Leitsungsempfanger: <?= $client_data ? $client_data->company_le : '' ?></div>
                    <div style="font-weight: normal"><?= $client_data ? $client_data->strabe_le : ' ' ?> <?= $client_data ? $client_data->hausnummer_le : '' ?> </div>
                    <div style="font-weight: normal"><?= $client_data ? $client_data->zip_le : ' ' ?> <?= $client_data ? $client_data->city_le : '' ?> </div>
                <?php endif; ?>
            </td>

            <td style="width: 35%;">
                <div><strong>So erreichen Sie uns</strong></div>
                <table style="width: 100%;">
                    <tr>
                        <td style="width:30%; ">Internet</td>
                        <td style="width:70%">www.markat.de</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>buchhaltung@markat.de</td>
                    </tr>
                    <tr>
                        <td>Telefon</td>
                        <td>03024348555</td>
                    </tr>
                    <tr>
                        <td>Mobil</td>
                        <td>01755798994</td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td>Steuer-Nr</td>
                        <td style="font-weight: bold">13/376/00110</td>
                    </tr>
                    <tr>
                        <td>USt-IdNr.</td>
                        <td style="font-weight: bold">DE322695363</td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Datum</td>
                        <td><?php echo date("d.m.Y") ?></td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
    <?php if (isset($task->project_data)&&!$task->project_data): ?>
        <br>
        <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
            <tr>

                <td>Bauvorhaben:</td>
                <td><?= isset($task->project_data) ? $task->project_data->bauvorhaben : '' ?></td>
            </tr>
            <tr>
                <td>Auftragsnummer:</td>
                <td><?= isset($task->project_data) ? $task->project_data->auftrag : '' ?></td>
            </tr>

            <tr>
                <td>Projektnummer:</td>
                <td><?= isset($task->project_data) ? $task->project_data->nummer : '' ?></td>
            </tr>
            <tr>
                <td>WIE:</td>
                <td><?= isset($task->project_data) ? $task->project_data->wie : '' ?></td>
            </tr>
            <tr>
                <td>Auftragsort:</td>
                <td><?= isset($task->project_data) ? $task->project_data->auftragsort : '' ?></td>
            </tr>
        </table>
    <?php endif; ?>
    <br><br>
    <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
        <tr>
            <td>Beauftragt :</td>
            <td><?php echo $task->name; ?></td>
        </tr>
        <?php if (!empty($task->mieter)) {
            echo '<tr>
            <td>Mieter:</td>
            <td>' . $task->mieter . '</td>
        </tr>';
        } ?>
        <tr>
            <td>Durchgeführt :</td>
            <td><?php echo $task->duedate; ?></td>
        </tr>
    </table>
    <br>
    <br>
    <table cellspacing="0%" style="width: 100%; text-align: left;font-size: 10pt; border-top-color: black;">
        <thead>
        <tr>
            <th colspan="4">
                <div style="border-bottom: 2px solid #000; font-size: 16px; padding-bottom: 8px; margin-bottom: 5px">
                    Arbeitsschein <?= $task->id ?>
                </div>
            </th>
        </tr>
        <tr>
            <th style="width:5%; padding-bottom: 5px ">Pos</th>
            <th style="width:15%; padding-bottom: 5px">Art-Nr.</th>
            <th style="width:70%; padding-bottom: 5px">Bezeichnung</th>
            <th style="width:10%; padding-bottom: 5px">Menge</th>
        </tr>
        </thead>
        <?php foreach ($task->checklist_items as $k => $ac):
            ?>
            <tr>
                <td><?= $k + 1; ?></td>
                <td></td>
                <td> <span>
                  <?= $ac['description'] ?>
                </span>
                </td>
                <td></td>
            </tr>
        <?php
        endforeach; ?>

        <!--      <tr>
                  <td>2</td>
                  <td>4</td>
                  <td> Fenster reinigen inkl. Rahmen pro Flügel</td>
                  <td>10 Stück</td>
              </tr>
              <tr>
                  <td>3</td>
                  <td>12</td>
                  <td>Deckenlampe reinigen</td>
                  <td>1 Einsatz</td>
              </tr>
              <tr>
                  <td colspan="4" style="width: 100%">Borussiastr.49, 2.OG links, Reich, Datum 09.09.2020</td>
              </tr>
              <tr>
                  <td>4</td>
                  <td>2</td>
                  <td> An und Abfahrtkosten 09.09.2020</td>
                  <td>10 Stück</td>
              </tr>
              <tr>
                  <td>5</td>
                  <td>066</td>
                  <td> Stundensatz Mitarbeiter je angefangene Stunde
                      <br>für Entsorgung Mischmüll <br>
                      2 Mitarbeiter a` 6 Stunden
                  </td>
                  <td>12 Stück</td>
              </tr>
              <tr>
                  <td>6</td>
                  <td>4</td>
                  <td>Entsorgung Mischmüll
                      <br/>(1qm³ a` 52,00€)
                  </td>
                  <td>36</td>
              </tr>
              <tr>
                  <td colspan="4" style="width: 100%">Borussiastr. 5 Ecke, Datum 09.09.2020</td>
              </tr>
              <tr>
                  <td>7</td>
                  <td> 2</td>
                  <td>An und Abfahrtkosten 09.09.2020</td>
                  <td>1 Einsatz</td>
              </tr>
              <tr>
                  <td>8</td>
                  <td>066</td>
                  <td><span>Stundensatz Mitarbeiter je angefangene Stunde
                          <br>für Entsorgung Mischmüll
                          <br>1 Mitarbeiter a` 1 Stunde</span>
                  </td>
                  <td>1</td>
              </tr>
              <tr>
                  <td>9</td>
                  <td></td>
                  <td>Entsorgung Mischmüll<br>(1qm³ a` 52,00€)</td>
                  <td>6</td>
              </tr>
              <tr>
                  <td colspan="4" style="width: 100%; border-bottom: 2px solid #000">Borussiastr.49, 2.OG links, Reich, Datum
                      09.09.2020
                      <br>
                      Projekt: Borussia Auftrag 3000012650,
                  </td>
              </tr>-->

    </table>
    <div style="font-size: 13px;">
        <br>
        Vielen Dank für den Auftrag
        <br>
        <br>
        <br>
        <br>
        <br>
        Mit freundlichen Grüßen
        <br>
        <br>
        <?= get_user_full_name() ?>
        <br>
        <?php
        if (!empty($signature) && isset($signature)) {
            echo '<img style="height:80px" src="' . $signature . '" alt="Image Markat">';
        } ?>
    </div>
</page>






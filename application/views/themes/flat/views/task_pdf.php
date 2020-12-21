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
<page backcolor="#FEFEFE" backtop="0mm"
      backbottom="40mm" style="font-size: 11pt">
    <p style="text-align: right">
        <img style="width: 220px;" src="assets/images/markat-new-logo.png" alt="Image Markat">
    </p>
    <div style="font-size: 11px; padding-bottom: 8px;: "> Markat - Bitterfelderst. 12 - 12681 Berlin</div>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
            <td style="width: 65%; font-weight: bold">
                <div><strong>Deutsche Wohnen Construction an </strong></div>
                <div>Facilities GmbH</div>
                <div>Herrn Stefan Kornows</div>
                <div>Mecklenburgische Str. 5</div>
                <div>14197 Berlin</div>
                <br><br><br><br>
                <div style="font-weight: normal">Leitsungsempfanger: Gehag Erste Beteiligungs GmbH</div>
                <div style="font-weight: normal">Mecklenburgische straBe</div>
                <div style="font-weight: normal">14197 Berlin</div>

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


    <?php if ($task_tag == 'full') {
        $tblhtml = '<br><br><h1 >Dokumentation</h1><br>';

    } else {
        $tblhtml = '<br><br><h2 style="text-align: center">Detail ' . get_menu_option('tasks', _l('Tasks')) . '</h2><br>';


    }
        if (isset($task->mieter)&&!empty($task->mieter)):
            $tblhtml .= '<table cellspacing="2px" style="width: 100%">
            <tr>
                <th style="width: 100%"><strong>Mieter :</strong> ' . $task->mieter . '</th>
                 
            </tr>
        </table>';
        endif;
    $tblhtml .= '<table cellspacing="2px" style="width: 100%">
        <tr><th style="width: 100%;" colspan="3"><strong>Betreff</strong></th> </tr>
        <tr><td colspan="3">' . $task->name . '</td></tr>
        <tr><th colspan="3"><strong>Description</strong></th> </tr>
        <tr><th colspan="3">' . $task->description . '</th> </tr>
        <tr><th style="width: 33%"><strong>Startdatum</strong></th> <th style="width: 33%"></th> <th style="width: 33%"><strong>Enddatum </strong></th> </tr>
        <tr><td  style="width: 33%">' . date('d.m.Y', strtotime($task->startdate)) . '</td> <td style="width: 33%"></td><td style="width: 33%">' . date('d.m.Y', strtotime($task->duedate)) . '</td> </tr>';
    if ($task_tag !== 'full') {
        $tblhtml .= '<tr><td colspan="3"><strong>Checklistpoints</strong></td></tr>';
        foreach ($task->checklist_items as $k => $ac):
            $check = $ac['finished'] ? 'check-cp.png' : 'no-check-cp.png';
            $tblhtml .= '<tr><td colspan="3"><br><span><img style="width: 21px" src="assets/images/' . $check . '"/> </span> ' . $ac['description'] . '</td></tr>';
        endforeach;
    } else {

    $tblhtml .= '</table>';

    $tblhtml .= '<table style="width: 100%">
<tr><th colspan="3"><br><strong>Dokumentation before:</strong></th></tr>';
    $maxcols = 3;
    $i = 0;
    foreach ($task->comments as $comment) {
        $comment['content'] = str_replace('[task_attachment]', '', $comment['content']);
        if ($comment['moment'] == 0 && !empty($comment['content'])) {
            $tblhtml .= '<tr><td style="width: 100%" colspan="3">' . $comment['content'] . '</td></tr>';
        }
    }
    $tblhtml .= '<tr>';
    foreach ($task->comments as $comment) {
        if ($comment['moment'] == 0 && count($comment['attachments']) > 0) {
            foreach ($comment['attachments'] as $attachment) {
                if ($i == $maxcols) {
                    $i = 0;
                    $tblhtml .= "</tr><tr>";
                }
                $relPath = get_upload_path_by_type('task') . $attachment['rel_id'] . '/';
                $fullPath = $relPath . $attachment['file_name'];
                $fname = pathinfo($fullPath, PATHINFO_FILENAME);
                $fext = pathinfo($fullPath, PATHINFO_EXTENSION);
                //$thumbPath = $relPath . $fname . '_thumb.' . $fext;
				$thumbPath = $relPath . $fname .'.'. $fext;
                $tblhtml .= '<td style="padding: 2px; width: 33.33%"><img style="width: 100%" src="' . $thumbPath . '"/> </td>';
                $i++;
            }

        }
    }

    //Add empty <td>'s to even up the amount of cells in a row:
    while ($i <= $maxcols) {
        $tblhtml .= "<td>&nbsp;</td>";
        $i++;
    }
    $tblhtml .= '</tr></table>';


    echo $tblhtml;

    ?>
</page>
<page backcolor="#FEFEFE" backtop="0"
      backbottom="40mm" style="font-size: 11pt">
    <?php


    $tblhtml = '<table cellspacing="2px" style="width: 100%"> ';
    $tblhtml .= '<tr><th style="width: 100%" colspan="3"><strong>Dokumentation after:</strong></th></tr>';
    $i = 0;
    $maxcols = 3;
    foreach ($task->comments as $comment) {
        $comment['content'] = str_replace('[task_attachment]', '', $comment['content']);
        if ($comment['moment'] == 1 && !empty($comment['content'])) {
            $tblhtml .= '<tr><td colspan="3">' . $comment['content'] . '</td></tr>';
        }
    }
    $tblhtml .= '<tr>';
    foreach ($task->comments as $comment) {
        if ($comment['moment'] == 1 && count($comment['attachments']) > 0) {
            foreach ($comment['attachments'] as $attachment) {
                if ($i == $maxcols) {
                    $i = 0;
                    $tblhtml .= "</tr><tr>";
                }
                $relPath = get_upload_path_by_type('task') . $attachment['rel_id'] . '/';
                $fullPath = $relPath . $attachment['file_name'];
                $fname = pathinfo($fullPath, PATHINFO_FILENAME);
                $fext = pathinfo($fullPath, PATHINFO_EXTENSION);
				//$thumbPath = $relPath . $fname . '_thumb.' . $fext;
				$thumbPath = $relPath . $fname .'.'. $fext;
                $tblhtml .= '<td style="padding: 2px; width: 33.33%"><img style="width: 100%" src="' . $thumbPath . '"/> </td>';
                $i++;
            }


        }
    } //Add empty <td>'s to even up the amount of cells in a row:
    while ($i <= $maxcols) {
        $tblhtml .= "<td>&nbsp;</td>";
        $i++;
    }
    $tblhtml .= '</tr>';
    }
    //$staff = get_staff();

    /*if (!empty($staff->signature)) {
        $data = base64_decode($staff->signature);
        $file = STAFF_PROFILE_IMAGES_FOLDER . uniqid() . '.png';
        $success = file_put_contents($file, $data);

        $tblhtml .= '<p style="text-align: right"><img src="' . $file . '"></p>';
    }
*/
    $tblhtml .= '
    </table><style>
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }
    </style>';
    echo $tblhtml;
    ?>
    <p> <?php
        if (!empty($signature) && isset($signature)) {
            echo '<img style="height:80px" src="' . $signature . '" alt="Image Markat">';
        } ?></p>


</page>
<?php
function boolVald($bool)
{
    return $bool == -1 ? 'Nein' : 'Ja';
} ?>




<?php defined('BASEPATH') or exit('No direct script access allowed');

$dimensions = $pdf->getPageDimensions();

$info_right_column = '';
$info_left_column  = '';

if (get_option('show_status_on_pdf_ei') == 1) {
    $info_right_column .= '<br /><span style="color:rgb(' . credit_note_status_color_pdf($credit_note->status) . ');text-transform:uppercase;">' . format_credit_note_status($credit_note->status, '', false) . '</span>';
}
// Add logo
$info_left_column .= pdf_logo_url();
// Write top left logo and right column info/text
pdf_multi_row($info_left_column, $info_right_column, $pdf, ($dimensions['wk'] / 2) - $dimensions['lm']);

$pdf->ln(10);

pdf_multi_row($left_info, $right_info, $pdf, ($dimensions['wk'] / 2) - $dimensions['lm']);

$pdf->Ln(8);
$tbltotal = '';

$tbltotal .= '<table cellpadding="6" style="font-size:' . ($font_size + 4) . 'px">';
$i= 0;
if(!empty($attachments)){
foreach ($attachments as $attachment) {
    $path = get_upload_path_by_type('mieter') . $attachment['rel_id'] . '/' . $attachment['file_name'];
    if($i%3 == 0){
        $tbltotal .= '<tr>';
    }
        $tbltotal .= '
        <td align="center" width="33%"><img src="' .$path . '"></td>';
     //if(($i%3 == 2 || (count($attachments) == $i)) && ($i != 0)){
    if((($i%3 == 2) || (count($attachments) == ($i+1))) && ($i <> 0))
        {
            $tbltotal .= '</tr>';
    }
    $i++;
}
}
$tbltotal .= '</table>';

$pdf->writeHTML($tbltotal, true, false, false, false, '');

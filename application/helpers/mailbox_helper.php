<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Get staff id by email
 * @param  string $email 
 * @return string staff id
 */
function get_staff_id_by_email($email)
{
    $CI = & get_instance();



        $CI->db->where('email', $email);
        $staff = $CI->db->select('admin_id')->from(db_prefix() . 'admin')->get()->row();


    return ($staff ? $staff->admin_id : 0);
}

/**
 * Get staff email by id
 * @param  string $email 
 * @return string staff id
 */
function get_staff_email_by_id($id)
{
    $CI = & get_instance();




        $CI->db->where('admin_id', $id);
        $staff = $CI->db->select('email')->from(db_prefix() . 'admin')->get()->row();



    return ($staff ? $staff->email : '');
}

/**
 * Check for outbox attachment after inserting outbox to database
 * @param  mixed $outbox_id
 * @return mixed           false if no attachment || array uploaded attachments
 */
function handle_mail_attachments($mail_id, $type = 'inbox', $index_name = 'attachments',$method='move')
{


	$path = get_upload_path_by_type('mailbox').$type.'/' . $mail_id . '/';
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}

    $uploaded_files = [];

    if (isset($_FILES[$index_name])) {
        _file_attachments_index_fix($index_name);

        for ($i = 0; $i < count($_FILES[$index_name]['name']); $i++) {

            if ($i <= 100) {
                // Get the temp file path
                $tmpFilePath = $_FILES[$index_name]['tmp_name'][$i];
                // Make sure we have a filepath
                if (!empty($tmpFilePath) && $tmpFilePath != '') {
                    // Getting file extension
                    $extension = strtolower(pathinfo($_FILES[$index_name]['name'][$i], PATHINFO_EXTENSION));
                    $allowed_extensions = explode(',', get_option('allowed_files'));
                    $allowed_extensions = array_map('trim', $allowed_extensions);
                    // Check for all cases if this extension is allowed
                    if (!in_array('.' . $extension, $allowed_extensions)) {
                        continue;
                    }
                    _maybe_create_upload_path($path);
                    $filename    = unique_filename($path, $_FILES[$index_name]['name'][$i]);
					$filename    = str_replace(' ', '_', $filename);
                    $newFilePath = $path . $filename;

                    // Upload the file into the temp dir
                    if($method == 'copy'){
                        if (copy($tmpFilePath, $newFilePath)) {
                            array_push($uploaded_files, [
                                    'file_name' => $filename,
                                    'file_type'  => $_FILES[$index_name]['type'][$i],
                                    ]);
                        } 
                    } else {

                       if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                            array_push($uploaded_files, [
                                    'file_name' => $filename,
                                    'file_type'  => $_FILES[$index_name]['type'][$i],
                                    ]);
                        }

                    }                    
                }
            }
        }
    }
    if (count($uploaded_files) > 0) {
        return $uploaded_files;
    }

    return false;
}

/**
 * text limiter
 * @param  string  $str      
 * @param  integer $limit    
 * @param  string  $end_char 
 * @return string            
 */
function text_limiter($str, $limit = 100, $end_char = '&#8230;')
{
    if (trim($str) === '')
    {
        return $str;
    }

    preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

    if (strlen($str) === strlen($matches[0]))
    {
        $end_char = '';
    }

    return rtrim($matches[0]).$end_char;
}

/**
 * Check whether column exists in a table
 * Custom function because Codeigniter is caching the tables and this is causing issues in migrations
 * @param  string $column column name to check
 * @param  string $table table name to check
 * @return boolean
 */
function column_exists($column,$table)
{
    if (!startsWith($table, db_prefix())) {
        $table = db_prefix() . $table;
    }

    $result = get_instance()->db->query("SHOW COLUMNS FROM ".$table." LIKE '".$column."';")->row();

    return (bool) $result;
}

/**
 * prepare imap email body html
 * @param  string $body 
 * @return string       
 */
function prepare_imap_email_body_html($body)
{
    // Trim message
    $body = trim($body);
    $body = str_replace('&nbsp;', ' ', $body);
    // Remove html tags - strips inline styles also
    $body = trim(strip_html_tags($body, '<br/>, <br>, <a>'));
    // Remove duplicate new lines
    $body = preg_replace("/[\r\n]+/", "\n", $body);
    // new lines with <br />
    $body = preg_replace('/\n(\s*\n)+/', '<br />', $body);
    $body = preg_replace('/\n/', '<br>', $body);

    return $body;
}

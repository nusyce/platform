<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Download extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('download');
    }

    public function preview_video()
    {
        $path      = FCPATH . $this->input->get('path');
        $file_type = $this->input->get('type');

        $allowed_extensions = get_html5_video_extensions();

        $pathinfo = pathinfo($path);

        if (!file_exists($path) || !isset($pathinfo['extension']) || !in_array($pathinfo['extension'], $allowed_extensions)) {
            $file_type = 'image/jpg';
            $path      = FCPATH . 'assets/images/preview-not-available.jpg';
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($path) . '"');
        header('Content-Type: ' . $file_type);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        if(ob_get_contents()) {
             ob_end_clean();
        }

        hooks()->do_action('before_output_preview_video');

        $file = fopen($path, 'rb');
        if ($file !== false) {
            while (!feof($file)) {
                echo fread($file, 1024);
            }
            fclose($file);
        }
    }

    public function preview_image()
    {
        $path      = FCPATH . $this->input->get('path');
        $file_type = $this->input->get('type');


		$allowed_extensions = [
			'jpg',
			'jpeg',
			'png',
			'bmp',
			'gif',
			'tif',
			'JPG',
			'JPEG',
			'PNG',
			'BMP',
			'GIF',
			'TIF',
		];

        $pathinfo = pathinfo($path);

        if (!file_exists($path) || !isset($pathinfo['extension']) || !in_array($pathinfo['extension'], $allowed_extensions)) {
            $file_type = 'image/jpg';
            $path      = FCPATH . 'assets/images/preview-not-available.jpg';
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $path . '"');
        header('Content-Type: ' . $file_type);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        if(ob_get_contents()) {
             ob_end_clean();
        }


        $file = fopen($path, 'rb');
        if ($file !== false) {
            while (!feof($file)) {
                echo fread($file, 1024);
            }
            fclose($file);
        }
    }

    public function file($folder_indicator, $attachmentid = '')
    {
        $this->load->model('admin/tickets_model');
		if($folder_indicator == 'mieterattachment') {


			$this->db->where('attachment_key', $attachmentid);
			$attachment = $this->db->get(db_prefix() . 'files')->row();

			if (!$attachment) {
				show_404();
			}
			$path = get_upload_path_by_type('mieter') . $attachment->rel_id . '/' . $attachment->file_name;
		}
		elseif($folder_indicator == 'mailbox-inbox') {


			$this->db->where('id', $attachmentid);
			$attachment = $this->db->get(db_prefix() . 'mail_attachment')->row();

			if (!$attachment) {
				show_404();
			}
			$path = get_upload_path_by_type('mailbox') .'inbox/'. $attachment->mail_id . '/' . $attachment->file_name;

		}
		elseif($folder_indicator == 'mailbox-outbox') {


			$this->db->where('id', $attachmentid);
			$attachment = $this->db->get(db_prefix() . 'mail_attachment')->row();

			if (!$attachment) {
				show_404();
			}
			$path = get_upload_path_by_type('mailbox') .'outbox/'. $attachment->mail_id . '/' . $attachment->file_name;

		}
		elseif($folder_indicator == 'mailbox-inbox') {


			$this->db->where('id', $attachmentid);
			$attachment = $this->db->get(db_prefix() . 'mail_attachment')->row();

			if (!$attachment) {
				show_404();
			}
			$path = get_upload_path_by_type('mailbox') .'inbox/'. $attachment->mail_id . '/' . $attachment->file_name;

		}
		else {
				die('folder not specified');
			}


        force_download($path, null);
    }
}

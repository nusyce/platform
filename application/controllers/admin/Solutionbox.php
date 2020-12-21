<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Solutionbox extends MY_Controller
{
    public function __construct()
    {

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
        $this->load->model('admin/utilities_model');
        $this->load->model('admin/admin_model');
    }


    // Moved here from version 1.0.5
    public function index()
    {



        $this->load->helper('url');
        $data['title']     = _l('media_files');
        $data['connector'] = admin_url() . 'solutionbox/media_connector';

        $data['staff_members'] = $this->admin_model->get('', ['active' => 1,'company_id' => get_user_company_id()]);

        $mediaLocale = get_media_locale();

       // $this->app_scripts->add('media-js', 'assets/plugins/elFinder/js/elfinder.min.js');

        if (file_exists(FCPATH . 'assets/plugins/elFinder/js/i18n/elfinder.' . $mediaLocale . '.js') && $mediaLocale != 'en') {
            $this->app_scripts->add('media-lang-js', 'assets/plugins/elFinder/js/i18n/elfinder.' . $mediaLocale . '.js');
        }

        $this->load->view('admin/utilities/media', $data);
    }
	function access_control_media($attr, $path, $data, $volume, $isDir, $relpath)
	{


		$allow_folder=[];
		$this->db->where('company_id',get_user_company_id());
		$result = $this->db->get('elfinder_file')->row();
		if($result)
		{
			array_push($allow_folder,$result->id);
		}
		$this->db->select('elfinder_id');
		$this->db->where('user_id',get_user_id());
		$result = $this->db->get(db_prefix().'folder_mapping')->result_array();
		foreach ($result as $res)
		{
			$this->db->where('id',$res['elfinder_id']);
			$folder = $this->db->get('elfinder_file')->row();

			if ($folder && $folder->mime != "directory")
			{
				array_push($allow_folder,$folder->parent_id);
			}
			array_push($allow_folder,$res['elfinder_id']);
		}

		if ($attr == 'read')
			{


				if(in_array($path,$allow_folder))
				{

					return true;
				}else{
					return false;
				}

	    	}
		if ($attr == 'hidden')
		{


			if(!in_array($path,$allow_folder))
			{

				return true;
			}else{
				return false;
			}

		}

	}

	public function media_connector()

	{
		$accessControl ='access_control_media';
		$array=array('mkdir','mkfile','paste','ls','upload');
       if(!empty($_GET['cmd']) ||  !empty($_POST['cmd']) )
	   {
		   $accessControl ='';
	   }

		$id_media=0;
			$this->db->where('company_id',get_user_company_id());
			$result = $this->db->get('elfinder_file')->row();
			if(!$result)
			{
				$this->db->insert('elfinder_file', [
					'company_id' => get_user_company_id(),
					'name' => 'media-'.get_user_company_id(),
					'parent_id' => 1,
					"mime" => 'directory'
				]);
				$id_media = $this->db->insert_id();
			}
			else{
				$id_media=$result->id;
			}
		$media_folder = $this->app->get_media_folder();

		$mediaPath = FCPATH . $media_folder;



		if (!is_dir($mediaPath)) {

			mkdir($mediaPath, 0755);

		}



		if (!file_exists($mediaPath . '/index.html')) {

			$fp = fopen($mediaPath . '/index.html', 'w');

			if ($fp) {

				fclose($fp);

			}

		}



		$this->load->helper('path');

		$root_options_public = [

			'driver' => 'LocalFileSystem',

			'path'   => set_realpath($media_folder),

			'URL'    => site_url($media_folder) . '/',

			//'debug'=>true,

			'uploadMaxSize' => get_option('media_max_file_size_upload') . 'M',

			'accessControl' => 'access_control_media',

			'uploadDeny'    => [

				'application/x-httpd-php',

				'application/php',

				'application/x-php',

				'text/php',

				'text/x-php',

				'application/x-httpd-php-source',

				'application/perl',

				'application/x-perl',

				'application/x-python',

				'application/python',

				'application/x-bytecode.python',

				'application/x-python-bytecode',

				'application/x-python-code',

				'wwwserver/shellcgi', // CGI

			],

			'uploadAllow' => !$this->input->get('editor') ? [] : ['image', 'video'],

			'uploadOrder' => [

				'deny',

				'allow',

			],

			'attributes' => [

				[

					'pattern' => '/.tmb/',

					'hidden'  => true,

				],

				[

					'pattern' => '/.quarantine/',

					'hidden'  => true,

				],

				[

					'pattern' => '/public/',

					'hidden'  => true,

				],

			],

		];








		$publicRootPath      = $media_folder . '/public_'.get_user_company_id();

		$public_root         = $root_options_public;

		$public_root['path'] = set_realpath($publicRootPath);



		$public_root['URL'] = site_url($media_folder) . '/public_'.get_user_company_id();

		unset($public_root['attributes'][3]);



		if (!is_dir($publicRootPath)) {

			mkdir($publicRootPath, 0755);

		}



		if (!file_exists($publicRootPath . '/index.html')) {

			$fp = fopen($publicRootPath . '/index.html', 'w');

			if ($fp) {

				fclose($fp);

			}

		}



		$opts = array(
			'bind' => [
				'mkdir mkfile paste upload' => [
					function($cmd, &$result, $args, $elfinder, $volume) {
						if ($result && !empty($result['added'])) {
							$newDir = $result['added'][0];
							$newDirPath = $volume->path($newDir['hash']);
							$data = array(
								'value' => $result['added'][0]['ts'],
							);

							$this->db->insert('test',$data);
							$this->db->where('mtime',$result['added'][0]['ts']);
							$results = $this->db->get('elfinder_file')->result_array();
							if($results)
							{
								foreach ($results as $res)
								{
									$data = array(
										'user_id' => get_user_id(),
										'elfinder_id' => $res['id'],
										'created_by' => 0
									);
									$this->db->insert(db_prefix().'folder_mapping',$data);
								}

							}
							/*$connector = new elFinderConnector($elfinder);

							$connector->run();*/

						}
					}
				]

			],
			'roots' => array(
				array(
					//'driver' => 'LocalFileSystem',

					// 'path'   => set_realpath($media_folder),

					'driver' => 'MySQL',

					'host' => 'localhost',

					'user' => 'root1',

					'pass' => '1234',

					'db' => 'adminlite',

					'path' => $id_media,

					//'URL'    => site_url($media_folder) . '/',

					//'debug'=>true,

					'uploadMaxSize' => get_option('media_max_file_size_upload') . 'M',

					'accessControl' => array($this,$accessControl),
					'uploadDeny' => [

						'application/x-httpd-php',

						'application/php',

						'application/x-php',

						'text/php',

						'text/x-php',

						'application/x-httpd-php-source',

						'application/perl',

						'application/x-perl',

						'application/x-python',

						'application/python',

						'application/x-bytecode.python',

						'application/x-python-bytecode',

						'application/x-python-code',

						'wwwserver/shellcgi', // CGI

					],

					'uploadAllow' => ['image', 'video', 'text'],

					'uploadOrder' => [
						'allow',
						'deny',

					],

					'attributes' => [

						[

							'pattern' => '/.tmb/',

							'hidden' => true,

						],

						[

							'pattern' => '/.quarantine/',

							'hidden' => true,

						],

						[

							'pattern' => '/public/',

							'hidden' => true,

						],

					],
				),
				$public_root			)
		);


		$connector = new elFinderConnector(new elFinder($opts));

		$connector->run();

	}

}

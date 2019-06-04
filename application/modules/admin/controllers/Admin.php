<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {
	
	public $data;

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language','string'));
		$this->load->model('admin_model');
		$this->system_tables = array('csv_data', 'groups', 'login_attempts', 'rest_api_keys', 'rest_api_logs', 'users', 'users_groups');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->data['user_identity'] = $this->session->userdata('identity');
		$this->path = FCPATH . 'uploads';
	}

	public function files() {
		$files = scandir($this->path);
		$files = array_diff(scandir($this->path), array('.', '..', '.DS_Store'));
		$file_list = array();
		foreach($files as $filename) {
			$file_info = array();
			if($this->util->is_image($this->path . '/' .$filename)) {
				$image_info = getimagesize($this->path . '/' .$filename) ;
				$file_info['width'] = $image_info[0];
				$file_info['height'] = $image_info[1];
				$file_info['type'] = $image_info['mime'];	
			} else {
				$file_info['width'] = 0;
				$file_info['height'] = 0;
				$file_info['type'] = mime_content_type($this->path . '/' .$filename);	
			}
			$file_info['size'] = round(filesize($this->path . '/' .$filename) / 1024, 2) . ' KB';
			$file_info['name'] = $filename;
			$file_list[] = $file_info;
		}
		$this->data['file_list'] = $file_list;

		$this->template->set('title', 'File Management');
		$this->template->load('admin/default_layout', 'contents' , 'admin/files', $this->data);

	}

	public function file_upload() {
		if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$vpb_file_name = strip_tags($_FILES['upload_file']['name']); //File Name
			$vpb_file_id = strip_tags($_POST['upload_file_ids']); // File id is gotten from the file name
			$vpb_file_size = $_FILES['upload_file']['size']; // File Size
			$vpb_uploaded_files_location = FCPATH . 'uploads/';
			$vpb_final_location = $vpb_uploaded_files_location . $vpb_file_name; //Directory to save file plus the file to be saved
			//Without Validation and does not save filenames in the database
			if(move_uploaded_file(strip_tags($_FILES['upload_file']['tmp_name']), $vpb_final_location))
			{
				//Display the file id
				echo $vpb_file_id;
			}
			else
			{
				//Display general system error
				echo 'general_system_error';
			}
		}
	}

	public function file_delete() {
		$file_name = urldecode($this->input->get('name'));
		if(strpos($file_name, '../') === FALSE) {
			if(is_file($this->path.'/'.$file_name)) {
				unlink($this->path.'/'.$file_name);
				$this->session->flashdata('success','File deleted successfully.');
			} else {
				$this->session->flashdata('error','File not found.');
			}		
		} else {
			$this->session->flashdata('error','Invalid file path.');
		}
		redirect('admin/files','refresh');
	}

	public function settings() {
		if (!$this->ion_auth->logged_in()) {
            redirect('admin', 'refresh');
        }
		$user = $this->ion_auth->user()->row();
		$this->data['user_id'] = array(
			'name'  => 'user_id',
			'id'    => 'user_id',
			'type'  => 'hidden',
			'value' => $user->id,
		);
		$this->data['user_details'] = $user;
		$this->data['api_key'] = $this->admin_model->getUserApiKey($user->id);
		$this->template->set('title', 'User - Settings');
		$this->template->load('admin/default_layout', 'contents' , 'admin/settings', $this->data);
	}

	public function generate_api_key() {
		if(!empty($this->input->post())) {
			$data['key'] = random_string('alnum', 40);
			$data['level'] = 10;
			$data['ignore_limits'] = 0;
			$data['is_private_key'] = 0;

			if($this->admin_model->updateApiKey($this->input->post('user_id'), $data)) {
				echo json_encode(array(
					'status' => 'success',
					'api_key' => $data['key']
				));
			} else {
				echo json_encode(array(
					'status' => 'error',
					'api_key' => ''
				));
	
			}
		} else {
			echo json_encode(array(
				'status' => 'error',
				'api_key' => ''
			));
		}
	}

	public function index()	{
		if(strpos($this->input->server('REQUEST_URI'), '/admin') === false){
			$this->storeUserInfo();
		}
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('admin/login', 'refresh');
		} elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		} else	{

			$this->template->set('title', 'Home');
			$this->template->load('admin/default_layout', 'contents' , 'admin/index', $this->data);
		}
	}

	public function table_data() {
		if(!empty($this->input->get())) {
			if(!in_array($this->input->get('table'), $this->system_tables)) {
				$table_fields = $this->admin_model->getTableFields($this->input->get('table'));
				foreach($table_fields as $key => $field) {
					$table_fields[$key] = ucwords(str_replace('_',' ', $field));
				}
				$this->data['table_fields'] = $table_fields;
				$this->data['table_data'] = $this->admin_model->getTableData($this->input->get('table'));
				echo json_encode(array(
					'status' => 'success',
					'table_fields' => $this->data['table_fields'],
					'table_data' => $this->data['table_data']
				));
			} else {
				echo json_encode(array(
					'status' => 'error'
				));
			}
		}
	}

	public function export() {
		if (!$this->ion_auth->logged_in()) {
			redirect('admin/login', 'refresh');
		}

		$this->data['tables'] = $this->admin_model->getTables();
		$this->data['tables'] = $this->remove_system_tables($this->data['tables']);
		$this->template->set('title', 'Export Data');
		$this->template->load('admin/default_layout', 'contents' , 'admin/export', $this->data);
	}

	public function remove_system_tables($tables) {
		$tables = array_diff($tables, $this->system_tables);
		return $tables;
	}

	public function import() {

		if (!$this->ion_auth->logged_in()) {
			redirect('admin/login', 'refresh');
		}

		if(!empty($this->input->post())) {
			if($this->input->post('type') == 'parse') {
				$this->data['show_parsed_data'] = true;
				if(empty($_FILES["csv_file"]["tmp_name"])) {
					$this->session->set_flashdata("error", "No file selected for import.");
					redirect('/admin/import', 'refresh');
				}
				$this->load->library('csvreader');
				$group_name = substr($_FILES["csv_file"]['name'], 0 , strpos($_FILES["csv_file"]['name'], '.'));
				$group_name = str_replace(' ', '-', $group_name);
				
				$file_data = $this->csvreader->parse_file($_FILES["csv_file"]["tmp_name"]);

				$file_data_json = '[';
				$prefix = '';
				foreach($file_data as $row) {
					//checking for valid email
					if(!empty($row['emailid'])) {
						if(!valid_email($row['emailid'])) {
								$row['emailid'] = '';
						}
					}
					// checking for valid data if not then drop the record
					if(($str = json_encode($row)) !== FALSE) {
						$file_data_json .= $prefix . json_encode($row);
					}
					$prefix = ',';
				}
				$file_data_json .= ']';

				$csv_header = array_keys(reset($file_data));
				$this->data['parsed_file_headers'] = $csv_header;
				
				$required_fields = $this->admin_model->getTableFields($this->input->post('tablename'));
				$required_fields = array_diff($required_fields, array('id','time_updated', 'date_updated', 'user_id'));
				$this->data['required_fields'] = $required_fields;

				$this->data['tablename'] = $this->input->post('tablename');
				$this->data['preview_data'] = array_values(reset($file_data));

				$data = array(
					'csv_filename' => $group_name,
					'csv_header' => json_encode($csv_header),
					'csv_data' => $file_data_json,
					'created_at' => time(),
					'updated_at' => time(),
				);
				$this->data['insert_id'] = $this->admin_model->insertCsvData($data);
				$this->data['insert_id'] = is_array($this->data['insert_id']) ? $this->data['insert_id']['id'] : $this->data['insert_id'];
			} else {
				$this->data['show_parsed_data'] = false;
				$csv_data = $this->admin_model->getCsvData($this->input->post('csv_data_id'));
				if(($file_data = json_decode($csv_data['csv_data'], true)) === FALSE) {
					$this->admin_model->deleteCsvData($this->input->post('csv_data_id'));
					$this->session->set_flashdata("error", "Error uploading data please check the data and import again.");
					redirect('admin/import', 'refresh');	
				}
				
				$required_fields = $this->admin_model->getTableFields($this->input->post('tablename'));
				$required_fields = array_diff($required_fields, array('id','time_updated', 'date_updated', 'user_id'));
				$this->data['required_fields'] = $required_fields;

				foreach($file_data as $row) {
					$formatted_data_required = array();
					foreach($this->data['required_fields'] as $key => $field) {
						$data_key = array_search($field, $this->input->post());
						if(isset($row[$data_key])) {
							$formatted_data_required[$field] = $row[$data_key];
							unset($row[$data_key]);
						} else {
							$formatted_data_required[$field] = '';
						}
					}
					$formatted_data_required['time_updated'] = date("H:i:s");
					$formatted_data_required['date_updated'] = date("Y-m-d");
					$formatted_data_required['user_id'] = $this->session->userdata('user_id');
					$data[] = $formatted_data_required;
				}
				
				$this->admin_model->insertData($this->input->post('tablename'), $data);
				$this->session->set_flashdata("success", "Data imported sucessfully.");
				redirect('admin/import', 'refresh');
			}
		} else {
			$this->data['show_parsed_data'] = false;
		}
		
		$this->data['tables'] = $this->admin_model->getTables();
		$this->data['tables'] = $this->remove_system_tables($this->data['tables']);
		$this->template->set('title', 'Import CSV');
		$this->template->load('admin/default_layout', 'contents' , 'admin/import', $this->data);
	}

	// redirect if needed, otherwise display the user list
	public function users()	{

		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('admin/login', 'refresh');
		} elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		} else	{
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->template->set('title', 'Users');
			$this->template->load('admin/default_layout', 'contents' , 'admin/users', $this->data);
		}
	}

	// log the user in
	public function login()
	{
		$this->data['title'] = $this->lang->line('login_heading');

		//validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('/admin', 'refresh');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('admin/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);

			$this->template->set('title', 'Users - Login');
			$this->template->load('admin/plain_layout', 'contents' , 'admin/login', $this->data);
		}
	}

	// log the user out
	public function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('admin/login', 'refresh');
	}

	// change password
	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('admin/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name'    => 'new',
				'id'      => 'new',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name'    => 'new_confirm',
				'id'      => 'new_confirm',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			// render
			$this->_render_page('admin/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('admin/change_password', 'refresh');
			}
		}
	}

	// forgot password
	public function forgot_password()
	{
		// setting validation rules by checking whether identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'email' )
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() == false)
		{
			$this->data['type'] = $this->config->item('identity','ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
			);

			if ( $this->config->item('identity', 'ion_auth') != 'email' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->template->set('title', 'Users - Forgot Password');
			$this->template->load('admin/plain_layout', 'contents' , 'admin/forgot_password', $this->data);
		}
		else
		{
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if(empty($identity)) {

	            		if($this->config->item('identity', 'ion_auth') != 'email')
		            	{
		            		$this->ion_auth->set_error('forgot_password_identity_not_found');
		            	}
		            	else
		            	{
		            	   $this->ion_auth->set_error('forgot_password_email_not_found');
		            	}

		                $this->session->set_flashdata('message', $this->ion_auth->errors());
                		redirect("admin/forgot_password", 'refresh');
            		}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("admin/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("admin/forgot_password", 'refresh');
			}
		}
	}

	// reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				$this->_render_page('admin/reset_password', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("admin/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('admin/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("admin/forgot_password", 'refresh');
		}
	}


	// activate the user
	public function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("/admin/users", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("admin/forgot_password", 'refresh');
		}
	}

	// deactivate the user
	public function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->template->set('title', 'Users - Deactivate');
			$this->template->load('admin/default_layout', 'contents' , 'admin/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('/admin/users', 'refresh');
		}
	}

	// create a new user
	public function create_user()
    {
        $this->data['title'] = $this->lang->line('create_user_heading');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('admin', 'refresh');
        }

        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }

        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("/admin/users", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name'  => 'company',
                'id'    => 'company',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

			$this->template->set('title', 'Users - Create');
			$this->template->load('admin/default_layout', 'contents' , 'admin/create_user', $this->data);
        }
    }

	// edit a user
	public function edit_user($id)
	{
		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('/admin', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}



				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

			// check to see if we are updating the user
			   if($this->ion_auth->update($user->id, $data))
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('success', $this->ion_auth->messages() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('/admin/users', 'refresh');
					}
					else
					{
						redirect('/admin/users', 'refresh');
					}

			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('error', $this->ion_auth->errors() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('/admin/users', 'refresh');
					}
					else
					{
						redirect('/admin/users', 'refresh');
					}

			    }

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password'
		);

		$this->template->set('title', 'Users - Edit');
		$this->template->load('admin/default_layout', 'contents' , 'admin/edit_user', $this->data);
	}

	// create a new group
	public function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('/admin/users', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("/admin/users", 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->template->set('title', 'Users - Create Group');
			$this->template->load('admin/default_layout', 'contents' , 'admin/create_group', $this->data);
		}
	}

	// edit a group
	public function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('/admin/users', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("/admin/users", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$this->data['group_name'] = array(
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->template->set('title', 'Users - Edit Group');
		$this->template->load('admin/default_layout', 'contents' , 'admin/edit_group', $this->data);
	}


	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_userdata('csrfkey', $key);
		$this->session->set_userdata('csrfvalue', $value);

		return array($key => $value);
	}

	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->userdata('csrfkey'));
		if ($csrfkey && $csrfkey == $this->session->userdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function _render_page($view, $data = null, $returnhtml = false) { //I think this makes more sense

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

}

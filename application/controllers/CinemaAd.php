<?php
ob_start();
// ADMIN CONTROLLER FOR THE TALLY APP

class CinemaAd extends CI_Controller
{
	//put your code here

	var $headTitle                  = "";
	var $adminController            = "";

	function __construct()
	{
		parent::__construct();

		// ------ upload file size setting
		ini_set('post_max_size', '16M');
		ini_set('upload_max_filesize', '16M');

		// Loading helpers

		$this->load->helper('common_functions_helper'); // for password encription/ verification & date Conversion
		$this->load->helper('dbclass_helper'); // for password encription/ verification & date Conversion
		$this->load->helper('send_email_helper'); // for sending email.

		$this->load->helper('date_helper');
		//$this->load->helper('php_image_magician_helper');


		// all the models are loading here  
		$this->load->model('adminmodel', 'AdminModel');
		$this->load->model('user_model', 'User_model');
		$this->load->model('product_model', 'Product_model');
		$this->load->model('enquiry_model', 'Enquiry_model');
		$this->load->model('project_model', 'Project_model');
		$this->load->model('film_model', 'Film_model');
		$this->load->model('song_model', 'Song_model');
		$this->load->model('castcrew_model', 'Castcrew_model');
		$this->load->model('trailer_model', 'Trailer_model');
		$this->load->model('theater_model', 'Theater_model');
		$this->load->model('view_model', 'View_model');
		$this->load->model('story_model', 'Story_model');
		$this->load->model('cast_model', 'Cast_model');
		$this->load->model('language_model', 'Language_model');
		$this->load->model('flashnews_model', 'Flashnews_model');
		$this->load->model('boxoffice_model', 'Boxoffice_model');
		$this->load->model('advertise_model', 'Advertise_model');
		$this->load->model('interview_model', 'Interview_model');
		$this->load->model('review_model', 'Review_model');
		$this->load->model('slide_model', 'Slide_model');
		$this->load->model('roundup_model', 'Roundup_model');
		$this->load->model('Shortfilm_model', 'Shortfilm_model');
		//----- for excel export----/
		$this->load->helper(array('form', 'url'));
		$this->load->helper('download');
		$ci = get_instance(); // CI_Loader instance
		$ci->load->config('config');
		$this->headTitle = $ci->config->item('admin_title');
		$this->adminController = $ci->config->item('admin_controller');
		ini_set("date.timezone", "Asia/Kolkata");
		date_default_timezone_set('Asia/Kolkata');
	}
	function test()
	{
		//echo $this->resizeImage("uploads/interview/60d281c1ceb666dba964c866930ddb07.jpg",656, 494, TRUE);
	}
	/*----- Reuseable Codes ---*/
	public function uploadImages($upload_dir, $input, $maxWidth = 0, $maxHeight = 0, $enc = TRUE)
	{
		$this->load->library('upload', array('upload_path' => $upload_dir, 'encrypt_name' => $enc, 'allowed_types' => 'jpeg|jpg|png|gif'));
		if ($this->upload->do_upload($input)) {
			if ($maxWidth != 0 && $maxHeight != 0)
				$this->resizeImages($this->upload->data('full_path'), $maxWidth, $maxHeight);
			return $this->upload->data('file_name');
		} else
			return FALSE;
	}
	private function resizeImages($source, $width, $height, $thumb = FALSE, $ratio = FALSE)
	{
		$this->load->library('image_lib', array('image_library' => 'gd2', 'source_image' => $source, 'maintain_ratio' => $ratio, 'create_thumb' => $thumb, 'quality' => 100, 'width' => $width, 'height' => $height));
		$this->image_lib->resize();
		return TRUE;
	}







	public function uploadImage($upload_dir, $input, $maxWidth = 0, $maxHeight = 0, $enc = TRUE)
	{
		$this->load->library('upload', array('upload_path' => $upload_dir, 'encrypt_name' => $enc, 'allowed_types' => 'jpeg|jpg|png|gif'));
		if ($this->upload->do_upload($input)) {
			if ($maxWidth != 0 && $maxHeight != 0)
				$this->resizeImage($upload_dir . $this->upload->data('file_name'), $maxWidth, $maxHeight);
			return $this->upload->data('file_name');
			unset($this->upload);
		} else
			return FALSE;
	}


	private function resizeImage($source, $width, $height, $thumb = FALSE, $ratio = FALSE)
	{
		$this->load->library('image_lib', array('image_library' => 'gd2', 'source_image' => $source, 'maintain_ratio' => $ratio, 'create_thumb' => $thumb, 'quality' => 100, 'width' => $width, 'height' => $height));
		$this->image_lib->resize();
		unset($this->image_lib);
		return TRUE;
	}





	private function redirect()
	{
		if (!$this->input->is_ajax_request())
			exit("Access denied");
	}
	private function isSessionSet()
	{
		if (!$this->session->userdata('ADMIN_ID') || !$this->session->userdata('ADMIN_USER_TYPE') || !$this->session->userdata('ADMIN_LOGIN_ID'))
			return FALSE;
		else
			return TRUE;
	}
	public function fillCombo()
	{
		$table = 	isset($_REQUEST["tbl"]) ? $_REQUEST["tbl"] : "";
		$where =  	isset($_REQUEST["where"]) ? $_REQUEST["where"] : "";
		$dField1 = 	isset($_REQUEST["dField1"]) ? $_REQUEST["dField1"] : "";
		$dField2 = 	isset($_REQUEST["dField2"]) ? $_REQUEST["dField2"] : "";
		$order = 	isset($_REQUEST["order"]) ? $_REQUEST["order"] : "";
		$vField	 = 	isset($_REQUEST["vFiled"]) ? $_REQUEST["vFiled"] : "";

		$select = 	isset($_REQUEST["sel"]) ? $_REQUEST["sel"] : "";
		$defaultSelectText = isset($_REQUEST["dSelect"]) ? $_REQUEST["dSelect"] : ""; // this is the default select option value.
		$db = new Database();
		echo $db->fillCombo($table, $dField1, $select, $dField2 = "", $vField, $where, $order, $defaultSelectText);
		$db = NULL;
	}
	public function getFieldValue($table, $fieldName, $id)
	{
		$db = new Database();
		$res = $db->getFieldValueById($table, $fieldName, "Id='{$id}'");
		$db = NULL;
		echo $res;
	}
	public function index()
	{
		echo '
			<script>window.location.href="' . base_url() . 'CinemaAd/login"</script>
		';
	}
	public function login()
	{
		$data = array();
		$data["title"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$this->load->view('admin_panel/login', $data);
	}
	public function adminLoginCheck()
	{
		$this->redirect();
		$userId    = $this->input->post('userId');
		$userPass  = $this->input->post('password');
		$res = $this->AdminModel->adminLoginCheck($userId, $userPass);
		if ($res == FALSE)
			echo json_encode(array("status" => false));
		else {

			// Set session data using CodeIgniter session library
			$this->session->set_userdata('ADMIN_ID', $res['ADMIN_ID']);
			$this->session->set_userdata('ADMIN_PASS', $res['ADMIN_PASS']);
			$this->session->set_userdata('ADMIN_USER_TYPE', $res['ADMIN_USER_TYPE']);
			$this->session->set_userdata('ADMIN_LOGIN_ID', $res['ADMIN_LOGIN_ID']);
			$this->session->set_userdata('PROFILE_PHOTO', $res['PROFILE_PHOTO']);
			echo json_encode(array("status" => true));
		}
	}
	public function adminLogout()
	{
		if ($this->session->userdata('ADMIN_LOGIN_ID')) {
			$this->AdminModel->updateLoginStatus($this->session->userdata('ADMIN_LOGIN_ID'));
			$this->session->sess_destroy();
			header("Location:" . base_url());
		}
	}
	public function  saveChangePassword()
	{
		$pass         = $this->input->post('Current_Password');
		$NewPassword  = $this->input->post('New_Password');
		$res = $this->AdminModel->saveChangePassword($pass, $NewPassword);
		echo json_encode($res);
		exit;
	}
	public function adminHome()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}
		$db = new Database();
		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$this->load->view('admin_panel/admin-home', $data);
	}
	function commonPage()
	{
		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$this->load->view('admin_panel/common-page', $data);
	}

	//-------------------------------------------- USER MANAGER  --------------------------------------------
	public function userList()
	{
		$list = $this->User_model->getDataTables();
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$row = array();
			$row[] = $data->UserId;
			$row[] = $data->UserType;
			if ($data->LastLoginDate != NULL)
				$row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
				$row[] = "Not yet login.";
			$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			$row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->User_model->countAll(),
			"recordsFiltered" => $this->User_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}
	public function getEditUser($id)
	{
		$data = $this->User_model->getById($id);
		echo json_encode($data);
	}
	public function deleteUser($id)
	{
		$res    =  $this->User_model->deleteData($id);
		echo $res;
	}
	public function deleteUserPhoto($id)
	{
		$res    =  $this->User_model->deleteUserPhoto($id);
		echo $res;
	}
	public function editUserPhoto()
	{
		$id	 = $this->input->post('Id');
		if (isset($_FILES["userfile"])) {
			$upload_dir = 'uploads/profile_image'; // upload directory
			//------------------------------------------
			$resUpload = $this->uploadImage($upload_dir, 'userfile', 150, 150);

			// checking for error while upload.
			if (!$resUpload) {
				echo json_encode(array('message' => 'Upload Error'));
				exit;
			}
			$profileImage = $resUpload;
			$db  = new Database();

			// deleting the existing Profile photo
			$photo = $db->getFieldValueById("login", "ProfilePhoto", "Id={$id}");
			$userId = $db->getFieldValueById("login", "UserId", "Id='{$id}'");

			$db = NULL;

			// deleting from the folder.
			if ($photo != "user_default_female.png" && $photo != "user_default_male.png") {
				$file = $upload_dir . "/" . $photo;
				unlink($file);
			}

			$data = array(
				'ProfilePhoto' => $profileImage
			);

			$this->db->update('login', $data, array('Id' => $id)); // 3rd argument is where
			$action = "User profile photo edited for user :{$userId}.";
			$this->User_model->recordAdminActions($action);



			if ($userId == $this->session->userdata('ADMIN_ID')) // checking the login user id to change profile pic
				$this->session->set_userdata('PROFILE_PHOTO', $profileImage);
		}

		echo "success";
	}

	public function saveUser()
	{
		$id		= $this->input->post("hidID");
		// --- checking the existance start;

		$db     = new Database();

		$userId	 = trim($this->input->post('User_Id'));

		$where   = "UserId='{$userId}' AND Id!='{$id}'";
		$res = $db->checkExistance("login", $where); //  if exists id value will be returnd.

		if ($res) {
			echo json_encode(array("status" => "Exists"));
			exit;
		}
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		$where      = "Id=" . $this->input->post('User_Group');
		$userType   = $db->getFieldValueById("sys_user_group", "UserGroup", $where);
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');


		//----- profile image

		if (isset($_FILES["userfile"])) {
			//echo "Inside " . $_FILES["userfile"]["name"];
			//exit;

			$upload_dir = 'uploads/profile_image'; // upload directory
			//------------------------------------------
			$resUpload = $this->uploadImages($upload_dir, 'userfile', 150, 150);



			// checking for error while upload.
			if (!$resUpload) {
				echo json_encode(array('message' => 'Upload Error'));
				exit;
			}
			$profileImage = $resUpload;
		} else {
			$profileImage = "user_default_male.png";
			if ($this->input->post('Sex') == "Female")
				$profileImage = "user_default_female.png";
		}
		//../../uploads/profile_image/

		if ($id == 0) {
			$data = array(
				'UserId' => trim($this->input->post('User_Id')),
				'UserGropId' => $this->input->post('User_Group'),
				'password' => encriptPassword($this->input->post('Password')),
				'Sex' => $this->input->post('Sex'),
				'UserType' => $userType,
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),
				'ProfilePhoto' => $profileImage


			);
		} else { // if edit

			$data = array(
				'UserId' => trim($this->input->post('User_Id')),
				'UserGropId' => $this->input->post('User_Group'),
				'Sex' => $this->input->post('Sex'),
				'UserType' => $userType,
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),
				'ProfilePhoto' => $profileImage

			);
		}

		$res = $this->User_model->saveData($data, $id);
		echo json_encode(array('message' => 'saved successfully.'));
	}
	public function userManager()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();

		$this->load->view('admin_panel/user-manager', $data);
	}

	public function userProfileAll()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}


		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$this->load->view('admin_panel/user-profile-all', $data);
	}

	//----------------------------------START ADD LANGUAGE-------------------------------------------------------
	public function language()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();

		$this->load->view('admin_panel/language', $data);
	}
	public function languageList()
	{
		$list = $this->Language_model->getDataTables();
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$row = array();
			//$row[] = $data->FilmName;
			$row[] = $data->Language;
			//$row[] = $data->Details;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Language_model->countAll(),
			"recordsFiltered" => $this->Language_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}


	public function saveLanguage()
	{
		$id		= $this->input->post("hidID");
		// --- checking the existance start;

		$db     = new Database();

		$Language = trim($this->input->post('Language'));

		$where   = "Language='{$Language}' AND Id!='{$id}'";
		$res = $db->checkExistance("language", $where); //  if exists id value will be returnd.

		if ($res) {
			echo json_encode(array("status" => "Exists"));
			exit;
		}
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		//$where      ="Id=" . $this->input->post('Id');
		// $Category =$db->getFieldValueById("category", "Category", $where);        
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');


		//----- profile image

		/* if(isset($_FILES["userfile"]))
               {
                   //echo "Inside " . $_FILES["userfile"]["name"];
                    //exit;
                   
				     $upload_dir ='uploads/film_image'; // upload directory
                    //------------------------------------------
					$resUpload=$this->uploadfilmImage($upload_dir,'userfile', 360, 480);
                   
                   
                    
                    // checking for error while upload.
                    //if (!$resUpload)
                    {
                        //echo json_encode(array('message' => 'Upload Error'));
                        //exit;
                    }
                    $filmImage =$resUpload;
               }
              /*else
              {  
                $profileImage = "user_default_male.png";
                 if($this->input->post('Sex')=="Female")
                    $profileImage = "user_default_female.png";
               } 
                 //../../uploads/profile_image/
               */
		if ($id == 0) {
			$data = array(
				'Language' => trim($this->input->post('Language')),

				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),



			);
		} else { // if edit

			$data = array(
				'Language' => trim($this->input->post('Language')),

				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),

			);
		}

		$res = $this->Language_model->saveData($data, $id);
		echo json_encode(array('message' => 'saved successfully.'));
	}


	public function getEditLanguage($id)
	{
		$data = $this->Language_model->getById($id);
		echo json_encode($data);
	}

	public function deleteLanguage($id)
	{
		$res    =  $this->Language_model->deleteData($id);
		echo $res;
	}


	//----------------------------------   START ADD LATEST RELEASE---------------------------------------------

	public function viewlatest($id)
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}
		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$data['latestreleaseid'] = $id;
		$data['film'] = $this->db->get_where('film_tb', "Id = '$id'")->row_array();

		$this->load->view('admin_panel/view-latest-release', $data);
	}
	public function viewList($latestRelease)
	{
		$list = $this->View_model->getDataTables($latestRelease);
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$row = array();
			$row[] = $data->FilmName;
			$row[] = $data->Language;

			$row[] = $data->Details;
			// 			$row[] = $data->UniqueName;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			//"recordsTotal" => $this->View_model->countAll(),
			//"recordsFiltered" => $this->View_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}




	//----------------------------------   START ADD LATEST RELEASE---------------------------------------------




	public function latestRelease()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$query4 = $this->db->query("SELECT * FROM film_tb where Status='Active' ORDER BY Id DESC");
		$data['media'] = $query4->result_array();
		$this->load->view('admin_panel/latest-release', $data);
	}


	public function releaseList()
	{
		$list = $this->Film_model->getDataTables();
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		$i = 1;




		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$row = array();
			$row[] = $i++;
			$row[] = $data->FilmName;
			$row[] = $data->Language;
			$row[] = $data->Category;
			$row[] = $data->UniqueName;

			$content = $data->Details;
			$pos = strpos($content, ' ', 100);
			$details = substr($content, 0, $pos);
			$row[] = $details;
			//$row[] = $data->Details;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			if (($data->ModifiedOn) == null) {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
				// $row[] = $data->LastLoginIP;
			} else {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->ModifiedOn));
			}
			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action

			// <a  id="editButton" class="btn btn-sm btn-primary" href="'.base_url()."CinemaAd/viewlatest/".$data->Id.'" title="Click to Edit" onclick="viewData('."'".$data->Id."'".')"><i class="glyphicon glyphicon-eye-open"></i> View</a>
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
				  

                   <a  id="editButton" class="btn btn-sm btn-warning" href="' . base_url() . "CinemaAd/addStoryLine/" . $data->Id . '" title="Click to Add" onclick="viewData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-plus"></i>Story</a>
                   <a  id="editButton" class="btn btn-sm btn-default" href="' . base_url() . "CinemaAd/castCrew/" . $data->Id . '" title="Add Cast and Crew" onclick="viewData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-plus"></i>Cast & Crew</a>
                   <a  id="editButton" class="btn btn-sm btn-success" href="' . base_url() . "CinemaAd/Trailer/" . $data->Id . '" title="Add Trailer" onclick="viewData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-plus"></i>Trailer</a>
                   <a  id="editButton" class="btn btn-sm btn-info" href="' . base_url() . "CinemaAd/addSongs/" . $data->Id . '" title="Add Songs" onclick="viewData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-plus"></i>Songs</a>
                   <a  id="editButton" class="btn btn-sm btn-danger" href="' . base_url() . "CinemaAd/Theater/" . $data->Id . '" title="Add Theater" onclick="viewData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-plus"></i>Theater List</a>
                   <a  id="editButton" class="btn btn-sm btn-primary" href="' . base_url() . "CinemaAd/Boxoffice/" . $data->Id . '" title="BoxOffice Collection" onclick="viewData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-plus"></i>Boxoffice Collection</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Film_model->countAll(),
			"recordsFiltered" => $this->Film_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}





	// 	public function saveRelease()
	//          {
	//                 error_reporting(0); 
	//                 $id		= $this->input->post("id");
	//                 // --- checking the existance start;

	//                 $db     = new Database();

	// 		        $FilmName =trim($this->input->post('Film_Name'));
	// 		        $UniqueName =$this->input->post('UniqueName');
	// 		        $lib_img=$this->input->post('image-selected');
	// 		        $date=$this->input->post('DateCreated');
	//                 $timestamp=strtotime($date);
	// 		        $edate=date("Y-m-d",$timestamp);

	// //                 $where   ="FilmName='{$FilmName}' AND Id!='{$id}'";
	// // 		        $res = $db->checkExistance("film_tb", $where); //  if exists id value will be returnd.

	// // 		if($res)
	// // 			{
	// // 				echo json_encode(array("status" => "Exists"));
	// // 				exit;
	// // 			}
	// 			    $where   ="UniqueName='{$UniqueName}'  AND Id!='{$id}' ";
	//                 $res = $db->checkExistance("film_tb", $where); //  if exists id value will be returnd.
	//                 echo '<pre>',print_r($res),'</pre>';

	//         if($res)
	//             {
	//                 echo json_encode(array("status" => "Exists"));
	//                 exit;
	//             }
	// 		         // --- checking the existance ends;

	//                 // getting the user type

	//                 $db         = new Database();        
	//                 //$where      ="Id=" . $this->input->post('Id');
	// 		       // $Category =$db->getFieldValueById("category", "Category", $where);        
	//                 $db =NULL;

	//                 //'ModifiedOn' => date('Y-m-d H:i:s');
	//                 $activatedOn    =NULL;
	//                 $InActivatedOn    =NULL;


	//                 if($this->input->post('Status')=='Active')
	//                     $activatedOn =date('Y-m-d H:i:s');
	//                 else
	//                     $InActivatedOn =date('Y-m-d H:i:s');

	//               if($lib_img==NULL){  
	//                   if($_FILES["userfile"]['error']<1)
	//                   {
	//                     $uploads=$this->uploadImage("uploads/film_image/","userfile", 1500, 500);
	//     				$this->resizeImage("uploads/film_image/$uploads",1500, 500, TRUE);
	//     				$image=pathinfo($uploads,PATHINFO_FILENAME)."_thumb.".pathinfo($uploads,PATHINFO_EXTENSION);
	//                   }
	//                   else{}
	//               }   
	//               else{
	//                 $uploads = basename($lib_img);
	//                 $image=basename($lib_img);
	//               }

	//               if($id==0)
	//               {    
	//                 $data = array(
	// 				'FilmName' => trim($this->input->post('Film_Name')),
	// 				'Language' => $this->input->post('Language'),
	// 				'Category' => $this->input->post('Category'),
	//                 'Details' => $this->input->post('Details'),
	//                 'DateCreated' => $edate,
	//                 'By_Line' => $this->input->post('By_Line'),
	//                 'Place' => $this->input->post('Place'),
	//                 'UniqueName' => $this->input->post('UniqueName'),
	// 				'Status' => $this->input->post('Status'),
	//                                 'ActivatedOn' => $activatedOn,
	//                                 'InActivatedOn' => $InActivatedOn,
	//                                 'CreatedBy' => $this->session->userdata('ADMIN_ID'),
	//                                 'Photo' => $image,
	//                                 'Image' => $uploads
	//                                  );

	//               }



	//                 else { // if edit

	//                  $data = array(
	// 				'FilmName' => trim($this->input->post('Film_Name')),
	// 				//'Category' => $this->input->post('Category'),

	// 				//'Category' => $Category,
	// 				'Language' => $this->input->post('Language'),
	// 				'Category' => $this->input->post('Category'),
	// 				'Details' => $this->input->post('Details'),
	// 				'DateCreated' => $edate,
	//                 'By_Line' => $this->input->post('By_Line'),
	//                 'Place' => $this->input->post('Place'),
	//                 'UniqueName' => $this->input->post('UniqueName'),
	// 				'Status' => $this->input->post('Status'),
	//                                 'ActivatedOn' => $activatedOn,
	//                                 'InActivatedOn' => $InActivatedOn,
	//                                 'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
	//                                 'ModifiedOn' => date('Y-m-d H:i:s'),
	//                                 'Photo' => $image,
	//                                 'Image' => $uploads


	// 			);

	//                 }

	//               $res= $this->Film_model->saveData($data, $id);
	// 		echo json_encode(array('message' => 'saved successfully.'));


	//   }  

	public function saveRelease()
	{
		error_reporting(0);
		$id		= $this->input->post("id");
		$detailsRaw = $this->input->post('Details', false);
		$details = html_entity_decode(stripslashes((string) $detailsRaw), ENT_QUOTES, 'UTF-8');
		$details = $this->normalizeSocialVideoEmbeds($details);
		$details = $this->persistInlineBase64Images($details);
		// --- checking the existance start;

		$db     = new Database();

		$FilmName = trim($this->input->post('Film_Name'));
		$UniqueName = $this->input->post('UniqueName');
		$lib_img = $this->input->post('image-selected');
		$date = $this->input->post('DateCreated');
		$timestamp = strtotime($date);
		$edate = date("Y-m-d", $timestamp);
		//                 $where   ="FilmName='{$FilmName}' AND Id!='{$id}'";
		// 		        $res = $db->checkExistance("film_tb", $where); //  if exists id value will be returnd.

		// 		if($res)
		// 			{
		// 				echo json_encode(array("status" => "Exists"));
		// 				exit;
		// 			}
		$where   = "UniqueName='{$UniqueName}'  AND Id!='{$id}' ";
		$res = $db->checkExistance("film_tb", $where); //  if exists id value will be returnd.
		//echo '<pre>',print_r($res),'</pre>';

		if ($res) {
			echo json_encode(array("status" => "Exists"));
			exit;
		}
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		//$where      ="Id=" . $this->input->post('Id');
		// $Category =$db->getFieldValueById("category", "Category", $where);        
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');

		if ($lib_img == NULL) {
			if ($_FILES['userfile']['name']) {
				$uploads = $this->uploadImage("uploads/film_image/", "userfile", 850, 500);
				$this->resizeImage("uploads/film_image/$uploads", 850, 500, TRUE);
				$image = pathinfo($uploads, PATHINFO_FILENAME) . "_thumb." . pathinfo($uploads, PATHINFO_EXTENSION);
			} else {
				$SQL = "SELECT Photo,Image FROM film_tb ";
				$SQL .= " WHERE Id =" . $id;

				$result = $this->db->query($SQL);
				// $deleteUserName ="";
				if ($result->num_rows() > 0) {
					foreach ($result->result() as $row)
						$uploads = $row->Photo;
					$image = $row->Image;
				}
				//   $uploads=0;
				//   $image=0;

			}
		} else {
			$uploads = basename($lib_img);
			$image = basename($lib_img);
		}

		if ($id == 0) {
			$data = array(
				'FilmName' => trim($this->input->post('Film_Name')),
				'Language' => $this->input->post('Language'),
				'Category' => $this->input->post('Category'),
				'Details' => $details,
				'DateCreated' => $edate,
				'By_Line' => $this->input->post('By_Line'),
				'Place' => $this->input->post('Place'),
				'UniqueName' => $this->input->post('UniqueName'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),
				'Photo' => $image,
				'Image' => $uploads
			);
		} else { // if edit

			$data = array(
				'FilmName' => trim($this->input->post('Film_Name')),
				//'Category' => $this->input->post('Category'),

				//'Category' => $Category,
				'Language' => $this->input->post('Language'),
				'Category' => $this->input->post('Category'),
				'Details' => $details,
				'DateCreated' => $edate,
				'By_Line' => $this->input->post('By_Line'),
				'Place' => $this->input->post('Place'),
				'UniqueName' => $this->input->post('UniqueName'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),
				'Photo' => $image,
				'Image' => $uploads


			);
		}
		$res = $this->Film_model->saveData($data, $id);
		echo json_encode(array('message' => 'saved successfully.'));
	}

	private function persistInlineBase64Images($html)
	{
		if (empty($html) || strpos($html, 'data:image') === false) {
			return $html;
		}

		$relativeDir = 'uploads/editor_image/';
		$absoluteDir = FCPATH . $relativeDir;
		if (!is_dir($absoluteDir)) {
			@mkdir($absoluteDir, 0755, true);
		}

		$extensionMap = array(
			'jpeg' => 'jpg',
			'jpg' => 'jpg',
			'png' => 'png',
			'gif' => 'gif',
			'webp' => 'webp',
			'svg+xml' => 'svg'
		);

		$counter = 0;
		$updatedHtml = preg_replace_callback(
			'/<img\\b([^>]*?)\\bsrc\\s*=\\s*(["\\\'])(data:image\\/([a-zA-Z0-9.+-]+);base64,([^"\\\']+))\\2([^>]*)>/i',
			function ($matches) use ($absoluteDir, $relativeDir, $extensionMap, &$counter) {
				$mimePart = strtolower($matches[4]);
				$payload = (string) $matches[5];

				if (strpos($payload, '&') !== false) {
					$payload = substr($payload, 0, strpos($payload, '&'));
				}

				$base64Data = preg_replace('/\\s+/', '', $payload);
				$base64Data = str_replace(' ', '+', $base64Data);
				$binary = base64_decode($base64Data, true);

				if ($binary === false) {
					$padding = strlen($base64Data) % 4;
					if ($padding > 0) {
						$base64Data .= str_repeat('=', 4 - $padding);
						$binary = base64_decode($base64Data, true);
					}
				}

				if ($binary === false || strlen($binary) < 32) {
					return $matches[0];
				}

				$extension = isset($extensionMap[$mimePart]) ? $extensionMap[$mimePart] : 'png';
				$fileName = 'quill_' . date('YmdHis') . '_' . substr(md5($binary . microtime(true) . $counter), 0, 12) . '.' . $extension;
				$absolutePath = $absoluteDir . $fileName;

				if (@file_put_contents($absolutePath, $binary) === false) {
					return $matches[0];
				}

				$counter++;
				$newSrc = base_url($relativeDir . $fileName);
				return '<img' . $matches[1] . 'src="' . $newSrc . '"' . $matches[6] . '>';
			},
			$html
		);

		return $updatedHtml !== null ? $updatedHtml : $html;
	}

	private function normalizeSocialVideoEmbeds($html)
	{
		if (empty($html) || !is_string($html)) {
			return $html;
		}

		$self = $this;

		$html = preg_replace_callback(
			'/<blockquote[^>]*class=["\'][^"\']*instagram-media[^"\']*["\'][^>]*>(.*?)<\/blockquote>(?:\s*<script[^>]*instagram\.com\/embed\.js[^>]*><\/script>)?/is',
			function ($matches) use ($self) {
				$block = isset($matches[0]) ? $matches[0] : '';
				$inner = isset($matches[1]) ? $matches[1] : '';

				$permalink = '';
				if (preg_match('/data-instgrm-permalink\s*=\s*["\']([^"\']+)["\']/i', $block, $permMatch)) {
					$permalink = $permMatch[1];
				} elseif (preg_match('/<a[^>]*href\s*=\s*["\']([^"\']+)["\']/i', $inner, $anchorMatch)) {
					$permalink = $anchorMatch[1];
				}

				return $self->buildInstagramEmbedIframe($permalink);
			},
			$html
		);

		$html = preg_replace_callback(
			'/<blockquote[^>]*class=["\'][^"\']*fb-video[^"\']*["\'][^>]*>(.*?)<\/blockquote>(?:\s*<script[^>]*connect\.facebook\.net[^>]*><\/script>)?/is',
			function ($matches) use ($self) {
				$block = isset($matches[0]) ? $matches[0] : '';
				$videoUrl = '';

				if (preg_match('/data-href\s*=\s*["\']([^"\']+)["\']/i', $block, $hrefMatch)) {
					$videoUrl = $hrefMatch[1];
				}

				return $self->buildFacebookEmbedIframe($videoUrl);
			},
			$html
		);

		$html = preg_replace_callback(
			'/<p[^>]*>\s*(https?:\/\/(?:www\.)?(?:instagram\.com|instagr\.am)\/(?:reel|p|tv)\/[A-Za-z0-9_-]+\/?(?:\?[^<\s]*)?)\s*<\/p>/i',
			function ($matches) use ($self) {
				return $self->buildInstagramEmbedIframe($matches[1]);
			},
			$html
		);

		$html = preg_replace_callback(
			'/<p[^>]*>\s*(https?:\/\/(?:www\.)?(?:facebook\.com|fb\.watch)\/[^<\s]+)\s*<\/p>/i',
			function ($matches) use ($self) {
				return $self->buildFacebookEmbedIframe($matches[1]);
			},
			$html
		);

		$html = preg_replace_callback(
			'/<iframe\b[^>]*\bsrc\s*=\s*["\']([^"\']+)["\'][^>]*><\/iframe>/i',
			function ($matches) use ($self) {
				$src = isset($matches[1]) ? trim($matches[1]) : '';

				if (preg_match('/(?:instagram\.com|instagr\.am)\/(?:reel|p|tv)\/[A-Za-z0-9_-]+/i', $src)) {
					return $self->buildInstagramEmbedIframe($src);
				}

				if (preg_match('/(?:facebook\.com|fb\.watch)/i', $src) && !preg_match('/facebook\.com\/plugins\/video\.php/i', $src)) {
					return $self->buildFacebookEmbedIframe($src);
				}

				return '<iframe class="social-video-embed" src="' . htmlspecialchars($src, ENT_QUOTES, 'UTF-8') . '" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>';
			},
			$html
		);

		return $html;
	}

	private function buildInstagramEmbedIframe($url)
	{
		$url = trim((string) $url);
		if (empty($url)) {
			return '';
		}

		if (preg_match('/(?:instagram\.com|instagr\.am)\/(reel|p|tv)\/([A-Za-z0-9_-]+)/i', $url, $match)) {
			$embedUrl = 'https://www.instagram.com/' . strtolower($match[1]) . '/' . $match[2] . '/embed';
			return '<iframe class="social-video-embed social-video-embed-instagram" src="' . htmlspecialchars($embedUrl, ENT_QUOTES, 'UTF-8') . '" frameborder="0" scrolling="no" allowtransparency="true" allowfullscreen loading="lazy"></iframe>';
		}

		return '<a href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" target="_blank" rel="noopener noreferrer">' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '</a>';
	}

	private function buildFacebookEmbedIframe($url)
	{
		$url = trim((string) $url);
		if (empty($url)) {
			return '';
		}

		if (preg_match('/facebook\.com\/plugins\/video\.php/i', $url)) {
			$embedUrl = $url;
		} else {
			$embedUrl = 'https://www.facebook.com/plugins/video.php?href=' . rawurlencode($url) . '&show_text=0';
		}

		return '<iframe class="social-video-embed social-video-embed-facebook" src="' . htmlspecialchars($embedUrl, ENT_QUOTES, 'UTF-8') . '" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>';
	}


	public function getEditRelease($id)
	{
		$data = $this->Film_model->getById($id);
		if (isset($data->Details)) {
			$data->Details = html_entity_decode(stripslashes((string) $data->Details), ENT_QUOTES, 'UTF-8');
		}
		echo json_encode($data);
	}

	public function deleteRelease($id)
	{
		$res    =  $this->Film_model->deleteData($id);
		echo $res;
	}


	//---------------ADD STORYLINE


	public function addStoryLine($id)
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$data['latestreleaseid'] = $id;
		$data['film'] = $this->db->get_where('film_tb', "Id = '$id'")->row_array();

		$this->load->view('admin_panel/addStoryline', $data);
	}



	public function storylineList($latestRelease)
	{
		$list = $this->Story_model->getDataTables($latestRelease);
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		$nos = 1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$row = array();
			$row[] = $nos++;
			$row[] = $data->FilmName;
			$row[] = $data->Story;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Story_model->countAll(),
			//"recordsFiltered" => $this->Story_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}




	public function saveStory()
	{
		$id		= $this->input->post("hidID");
		// --- checking the existance start;

		$db     = new Database();

		$FilmName = trim($this->input->post('Film_Id'));

		$where   = "FilmName='{$FilmName}' AND Id!='{$id}'";
		$res = $db->checkExistance("storyline", $where); //  if exists id value will be returnd.

		if ($res) {
			echo json_encode(array("status" => "Exists"));
			exit;
		}
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		//$where      ="Id=" . $this->input->post('Id');
		// $Category =$db->getFieldValueById("category", "Category", $where);        
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');


		//----- profile image

		/* if(isset($_FILES["userfile"]))
               {
                   //echo "Inside " . $_FILES["userfile"]["name"];
                    //exit;
                   
				     $upload_dir ='uploads/film_image'; // upload directory
                    //------------------------------------------
					$resUpload=$this->uploadImage($upload_dir,'userfile', 360, 480);
                   
                   
                    
                    // checking for error while upload.
                    //if (!$resUpload)
                    {
                        //echo json_encode(array('message' => 'Upload Error'));
                        //exit;
                    }
                    $filmImage =$resUpload;
               }
              /*else
              {  
                $profileImage = "user_default_male.png";
                 if($this->input->post('Sex')=="Female")
                    $profileImage = "user_default_female.png";
               } 
                 //../../uploads/profile_image/
               */
		if ($id == 0) {
			$data = array(
				'FilmId' => $this->input->post('Film_Id'),
				'FilmName' => trim($this->input->post('Film_Name')),
				'Story' => $this->input->post('Story'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),



			);
		} else { // if edit

			$data = array(
				'FilmId' => $this->input->post('Film_Id'),
				'FilmName' => trim($this->input->post('Film_Name')),
				'Story' => $this->input->post('Story'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),

			);
		}

		$res = $this->Story_model->saveData($data, $id);

		echo json_encode(array('message' => 'saved successfully.'));
		// if($res){ $this->load->view('admin_panel/latest-release');}
		//$this->load->view('admin_panel/latest-release',$data);  


	}

	public function getEditStory($id)
	{
		$data = $this->Story_model->getById($id);
		echo json_encode($data);
	}

	public function deleteStory($id)
	{
		$res    =  $this->Story_model->deleteData($id);
		echo $res;
	}



	//-----------------ADD SONG LIST



	public function addSongs($id)
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$data['latestreleaseid'] = $id;
		$data['film'] = $this->db->get_where('film_tb', "Id = '$id'")->row_array();
		$this->load->view('admin_panel/addSongs', $data);
	}

	public function songList($latestRelease)
	{
		$list = $this->Song_model->getDataTables($latestRelease);
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		$nos = 1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$row = array();
			$row[] = $nos++;
			$row[] = $data->FilmName;
			$row[] = $data->SongName;

			$row[] = $data->Link;

			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			//$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			if (($data->ModifiedOn) == null) {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
				// $row[] = $data->LastLoginIP;
			} else {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->ModifiedOn));
			}
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Song_model->countAll(),
			//"recordsFiltered" => $this->View_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}




	public function saveSong()
	{
		$id		= $this->input->post("hidID");
		// --- checking the existance start;

		$db     = new Database();

		$SongName = trim($this->input->post('Song_Name'));

		$where   = "SongName='{$SongName}' AND Id!='{$id}'";
		$res = $db->checkExistance("song_tb", $where); //  if exists id value will be returnd.
		if ($res) {
			echo json_encode(array("status" => "Exists"));
			exit;
		}
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		//$where      ="Id=" . $this->input->post('Id');
		// $Category =$db->getFieldValueById("category", "Category", $where);        
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');


		//----- profile image

		if ($_FILES['userfile']['name']) {


			$upload_dir = 'uploads/song_image'; // upload directory

			$resUpload = $this->uploadImages($upload_dir, 'userfile', 850, 500);




			$songImage = $resUpload;
		} else {
			$SQL = "SELECT Photo FROM song_tb ";
			$SQL .= " WHERE Id =" . $id;

			$result = $this->db->query($SQL);
			// $deleteUserName ="";
			if ($result->num_rows() > 0) {
				foreach ($result->result() as $row)
					$songImage = $row->Photo;
			}
			//   $uploads=0;
			//   $image=0;

		}
		// }
		/*else
              {  
                $profileImage = "user_default_male.png";
                 if($this->input->post('Sex')=="Female")
                    $profileImage = "user_default_female.png";
               } 
                 //../../uploads/profile_image/
               */
		if ($id == 0) {
			$data = array(
				'SongName' => trim($this->input->post('Song_Name')),
				'FilmId' => $this->input->post('Film_Id'),
				'FilmName' => $this->input->post('Film_Name'),

				//'Link' =>"https://youtube.com/embed/".substr($this->input->post('URL'),17),
				'Link' => $this->input->post('URL'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),
				'Details' => $this->input->post('Details'),
				'Photo' => $songImage


			);
		} else { // if edit

			$data = array(
				'SongName' => trim($this->input->post('Song_Name')),

				'FilmName' => $this->input->post('Film_Name'),
				'FilmId' => $this->input->post('Film_Id'),

				'Link' => $this->input->post('URL'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),
				'Details' => $this->input->post('Details'),
				'Photo' => $songImage

			);
		}

		$res = $this->Song_model->saveData($data, $id);
		echo json_encode(array('message' => 'saved successfully.'));
	}

	public function getEditSong($id)
	{
		$data = $this->Song_model->getById($id);
		echo json_encode($data);
	}

	public function deleteSong($id)
	{
		$res    =  $this->Song_model->deleteData($id);
		echo $res;
	}
	//-----------------CASTCREW---------------------------------------

	public function castCrew($id)
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$data['latestreleaseid'] = $id;
		$data['film'] = $this->db->get_where('film_tb', "Id = '$id'")->row_array();
		// $data['cast']=$this->db->get_where('cast_tb',"Id = '10'")->row_array();

		$this->load->view('admin_panel/cast-crew', $data);
	}

	public function castcrewList($latestRelease)
	{
		$list = $this->Cast_model->getDataTables($latestRelease);
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		$nos = 1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";

			/*$image 	 = $data->Photo;
			$images = "../uploads/Crew_image/{$image}";	
			$photo = "<img src='{$images}' class='' alt='cand' width='100' height='80'>";
			*/
			$no++;
			$row = array();
			$row[] = $nos++;
			$row[] = $data->Name;

			$row[] = $data->FilmName;
			//$row[] = $photo;
			$row[] = $data->Details;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Cast_model->countAll(),
			//"recordsFiltered" => $this->View_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}





	public function saveCastcrew()
	{
		$id		= $this->input->post("hidID");
		// --- checking the existance start;

		$db     = new Database();

		$FilmName = trim($this->input->post('Film_Id'));

		$where   = "FilmName='{$FilmName}' AND Id!='{$id}'";
		$res = $db->checkExistance("cast_tb", $where); //  if exists id value will be returnd.

		if ($res) {
			echo json_encode(array("status" => "Exists"));
			exit;
		}
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		//$where      ="Id=" . $this->input->post('Id');
		// $Category =$db->getFieldValueById("category", "Category", $where);        
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');


		//----- profile image
		//if($_FILES["userfile"]['error']<1)

		if (isset($_FILES["userfile"])) {


			$upload_dir = 'uploads/Crew_image'; // upload directory
			//------------------------------------------
			$resUpload = $this->uploadImages($upload_dir, 'userfile', 211, 189);




			$crewImage = $resUpload;
		}

		if ($id == 0) {
			$data = array(
				'Name' => trim($this->input->post('Name')),
				'FilmId' => $this->input->post('Film_Id'),
				'FilmName' => $this->input->post('Film_Name'),
				'Details' => $this->input->post('Details'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),
				'Photo' => $crewImage


			);
		} else { // if edit

			$data = array(
				'Name' => trim($this->input->post('Name')),
				'FilmId' => $this->input->post('Film_Id'),
				'FilmName' => $this->input->post('Film_Name'),
				'Details' => $this->input->post('Details'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),

			);
		}

		$res = $this->Cast_model->saveData($data, $id);
		echo json_encode(array('message' => 'saved successfully.'));
	}


	public function getEditCastcrew($id)
	{
		$data = $this->Cast_model->getById($id);
		echo json_encode($data);
	}


	public function deleteCastcrew($id)
	{
		$res    =  $this->Cast_model->deleteData($id);
		echo $res;
	}

	//--------TRAILER----------------------------


	public function Trailer($id)
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$data['latestreleaseid'] = $id;
		$data['film'] = $this->db->get_where('film_tb', "Id = '$id'")->row_array();

		$this->load->view('admin_panel/trailer', $data);
	}
	public function trailerList($latestRelease)
	{
		$list = $this->Trailer_model->getDataTables($latestRelease);
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$nos = 1;
			$row = array();
			$row[] = $nos++;
			$row[] = $data->FilmName;
			$row[] = $data->Details;
			$row[] = $data->TrailerLink;

			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			//$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			if (($data->ModifiedOn) == null) {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
				// $row[] = $data->LastLoginIP;
			} else {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->ModifiedOn));
			}
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Trailer_model->countAll(),
			//"recordsFiltered" => $this->View_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}



	public function saveTrailer()
	{

		$id		= $this->input->post("hidID");
		// --- checking the existance start;

		$db     = new Database();

		$FilmName = trim($this->input->post('Film_Id'));

		$where   = "FilmName='{$FilmName}' AND Id!='{$id}'";
		$res = $db->checkExistance("trailer_tb", $where); //  if exists id value will be returnd.

		if ($res) {
			echo json_encode(array("status" => "Exists"));
			exit;
		}
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		//$where      ="Id=" . $this->input->post('Id');
		// $Category =$db->getFieldValueById("category", "Category", $where);        
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');


		//----- profile image

		if ($_FILES['userfile']['name']) {
			//echo "Inside " . $_FILES["userfile"]["name"];
			//exit;

			$upload_dir = 'uploads/trailer_image'; // upload directory
			//------------------------------------------
			$resUpload = $this->uploadImages($upload_dir, 'userfile', 850, 500);



			// checking for error while upload.
			//if (!$resUpload)
			{
				//echo json_encode(array('message' => 'Upload Error'));
				//exit;
			}
			$Image = $resUpload;
		} else {
			$SQL = "SELECT Photo FROM trailer_tb ";
			$SQL .= " WHERE Id =" . $id;

			$result = $this->db->query($SQL);
			// $deleteUserName ="";
			if ($result->num_rows() > 0) {
				foreach ($result->result() as $row)
					$Image = $row->Photo;
			}
			//   $uploads=0;
			//   $image=0;

		}
		/*else
              {  
                $profileImage = "user_default_male.png";
                 if($this->input->post('Sex')=="Female")
                    $profileImage = "user_default_female.png";
               } 
                 //../../uploads/profile_image/
               */
		if ($id == 0) {
			$data = array(
				'FilmName' => trim($this->input->post('Film_Name')),
				'FilmId' => $this->input->post('Film_Id'),
				'Details' => $this->input->post('Details'),
				//'TrailerLink'=>"https://youtube.com/embed/".substr($this->input->post('URL'),17),
				'TrailerLink' => $this->input->post('URL'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),
				'Photo' => $Image

			);
		} else { // if edit

			$data = array(
				'FilmName' => trim($this->input->post('Film_Name')),

				'FilmId' => $this->input->post('Film_Id'),
				'Details' => $this->input->post('Details'),
				//'TrailerLink'=>"https://youtube.com/embed/".substr($this->input->post('URL'),17),
				'TrailerLink' => $this->input->post('URL'),

				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),
				'Photo' => $Image

			);
		}

		$res = $this->Trailer_model->saveData($data, $id);
		echo json_encode(array('message' => 'saved successfully.'));
	}

	public function getEditTrailer($id)
	{
		$data = $this->Trailer_model->getById($id);
		echo json_encode($data);
	}

	public function deleteTrailer($id)
	{
		$res    =  $this->Trailer_model->deleteData($id);
		echo $res;
	}

	//--------------THEATER----------------------------



	public function Theater($id)
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$data['latestreleaseid'] = $id;
		$data['film'] = $this->db->get_where('film_tb', "Id = '$id'")->row_array();
		$this->load->view('admin_panel/theater', $data);
	}


	public function theaterList($latestRelease)
	{
		$list = $this->Theater_model->getDataTables($latestRelease);
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$row = array();
			$row[] = $data->FilmId;
			$row[] = $data->FilmName;
			$row[] = $data->TheaterName;
			$row[] = $data->Place;
			$row[] = $data->ShowDate;
			$row[] = $data->ShowTime;
			//$row[] = $data->Details;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Theater_model->countAll(),
			//"recordsFiltered" => $this->View_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}





	public function saveTheater()
	{
		$id		= $this->input->post("hidID");
		// --- checking the existance start;

		$db     = new Database();

		$TheaterName = trim($this->input->post('Film_Id'));

		$where   = "TheaterName='{$TheaterName}' AND Id!='{$id}'";
		$res = $db->checkExistance("theater_tb", $where); //  if exists id value will be returnd.

		if ($res) {
			echo json_encode(array("status" => "Exists"));
			exit;
		}
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		//$where      ="Id=" . $this->input->post('Id');
		// $Category =$db->getFieldValueById("category", "Category", $where);        
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');


		//----- profile image

		/* if(isset($_FILES["userfile"]))
               {
                   //echo "Inside " . $_FILES["userfile"]["name"];
                    //exit;
                   
				     $upload_dir ='uploads/theater_image'; // upload directory
                    //------------------------------------------
					$resUpload=$this->uploadImage($upload_dir,'userfile', 400, 300);
                   
                   
                    
                    // checking for error while upload.
                    //if (!$resUpload)
                    {
                        //echo json_encode(array('message' => 'Upload Error'));
                        //exit;
                    }
                    $songImage =$resUpload;
               }*/
		/*else
              {  
                $profileImage = "user_default_male.png";
                 if($this->input->post('Sex')=="Female")
                    $profileImage = "user_default_female.png";
               } 
                 //../../uploads/profile_image/
               */
		if ($id == 0) {
			$data = array(
				'TheaterName' => trim($this->input->post('Theater_Name')),
				'FilmId' => $this->input->post('Film_Id'),
				'FilmName' => $this->input->post('Film_Name'),
				'Place' => $this->input->post('Place'),
				'ShowDate' => $this->input->post('ShowDate'),
				'ShowTime' => $this->input->post('ShowTime'),

				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),
				//'Photo' => $songImage


			);
		} else { // if edit

			$data = array(
				'TheaterName' => trim($this->input->post('Theater_Name')),
				'FilmId' => $this->input->post('Film_Id'),
				'FilmName' => $this->input->post('Film_Name'),
				'Place' => $this->input->post('Place'),
				'ShowDate' => $this->input->post('ShowDate'),
				'ShowTime' => $this->input->post('ShowTime'),

				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),

			);
		}

		$res = $this->Theater_model->saveData($data, $id);
		echo json_encode(array('message' => 'saved successfully.'));
	}

	public function getEditTheater($id)
	{
		$data = $this->Theater_model->getById($id);
		echo json_encode($data);
	}
	public function deleteTheater($id)
	{
		$res    =  $this->Theater_model->deleteData($id);
		echo $res;
	}

	//---------------------  START    FLASHNEWS       ------------------------------------


	public function addFlashnews()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();

		$this->load->view('admin_panel/flashnews', $data);
	}

	public function flashnewsList()
	{
		$list = $this->Flashnews_model->getDataTables();
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$row = array();
			$row[] = $data->Flashnews;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			if (($data->ModifiedOn) == null) {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
				// $row[] = $data->LastLoginIP;
			} else {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->ModifiedOn));
			}
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Flashnews_model->countAll(),
			"recordsFiltered" => $this->Flashnews_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}


	public function saveFlashnews()
	{
		error_reporting(0);
		$id		= $this->input->post("hidID");
		// --- checking the existance start;

		$db     = new Database();

		$Flashnews = trim($this->input->post('FlashNews'));

		$where   = "Flashnews='{$Flashnews}' AND Id!='{$id}'";
		$res = $db->checkExistance("flashnews", $where); //  if exists id value will be returnd.

		if ($res) {
			echo json_encode(array("status" => "Exists"));
			exit;
		}
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		//$where      ="Id=" . $this->input->post('Id');
		// $Category =$db->getFieldValueById("category", "Category", $where);        
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');


		//----- profile image

		/* if(isset($_FILES["userfile"]))
               {
                   //echo "Inside " . $_FILES["userfile"]["name"];
                    //exit;
                   
				     $upload_dir ='uploads/film_image'; // upload directory
                    //------------------------------------------
					$resUpload=$this->uploadfilmImage($upload_dir,'userfile', 360, 480);
                   
                   
                    
                    // checking for error while upload.
                    //if (!$resUpload)
                    {
                        //echo json_encode(array('message' => 'Upload Error'));
                        //exit;
                    }
                    $filmImage =$resUpload;
               }
              /*else
              {  
                $profileImage = "user_default_male.png";
                 if($this->input->post('Sex')=="Female")
                    $profileImage = "user_default_female.png";
               } 
                 //../../uploads/profile_image/
               */
		if ($id == 0) {
			$data = array(
				'Flashnews' => trim($this->input->post('FlashNews')),
				// 'Link' => $this->input->post('Link'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),



			);
		} else { // if edit

			$data = array(
				'Flashnews' => trim($this->input->post('FlashNews')),
				// 'Link' => $this->input->post('Link'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),

			);
		}

		$res = $this->Flashnews_model->saveData($data, $id);
		echo json_encode(array('message' => 'saved successfully.'));
	}

	public function getEditFlashnews($id)
	{
		$data = $this->Flashnews_model->getById($id);
		echo json_encode($data);
	}
	public function deleteFlashnews($id)
	{
		$res    =  $this->Flashnews_model->deleteData($id);
		echo $res;
	}
	//----------------------------START BOXOFFICE COLLECTION--------------


	public function Boxoffice($id)
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$data['latestreleaseid'] = $id;
		$data['film'] = $this->db->get_where('film_tb', "Id = '$id'")->row_array();

		$this->load->view('admin_panel/boxoffice', $data);
	}
	public function boxofficeList()
	{
		$list = $this->Boxoffice_model->getDataTables();
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		$nos = 1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$row = array();
			$row[] = $nos++;
			$row[] = $data->FilmName;
			$row[] = $data->Boxoffice;
			//$row[] = $data->Details;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Boxoffice_model->countAll(),
			//"recordsFiltered" => $this->Boxoffice_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}

	public function saveBoxoffice()
	{
		$id		= $this->input->post("hidID");
		// --- checking the existance start;

		$db     = new Database();

		$FilmName = trim($this->input->post('FilmName'));

		$where   = "FilmName='{$FilmName}' AND Id!='{$id}'";
		$res = $db->checkExistance("boxoffice", $where); //  if exists id value will be returnd.

		if ($res) {
			echo json_encode(array("status" => "Exists"));
			exit;
		}
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		//$where      ="Id=" . $this->input->post('Id');
		// $Category =$db->getFieldValueById("category", "Category", $where);        
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');


		//----- profile image

		/* if(isset($_FILES["userfile"]))
               {
                   //echo "Inside " . $_FILES["userfile"]["name"];
                    //exit;
                   
				     $upload_dir ='uploads/film_image'; // upload directory
                    //------------------------------------------
					$resUpload=$this->uploadfilmImage($upload_dir,'userfile', 360, 480);
                   
                   
                    
                    // checking for error while upload.
                    //if (!$resUpload)
                    {
                        //echo json_encode(array('message' => 'Upload Error'));
                        //exit;
                    }
                    $filmImage =$resUpload;
               }
              /*else
              {  
                $profileImage = "user_default_male.png";
                 if($this->input->post('Sex')=="Female")
                    $profileImage = "user_default_female.png";
               } 
                 //../../uploads/profile_image/
               */
		if ($id == 0) {
			$data = array(
				'FilmId' => $this->input->post('Film_Id'),
				'FilmName' => trim($this->input->post('Film_Name')),
				'Boxoffice' => $this->input->post('Boxoffice'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),



			);
		} else { // if edit

			$data = array(
				'FilmId' => $this->input->post('Film_Id'),
				'FilmName' => trim($this->input->post('Film_Name')),
				'Boxoffice' => $this->input->post('Boxoffice'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),

			);
		}

		$res = $this->Boxoffice_model->saveData($data, $id);

		echo json_encode(array('message' => 'saved successfully.'));



		// if($res==true){
		// header("refresh: 3");
		//         //    redirect('refresh');
		//     echo'<script>document.location.href="index.php?status=forbidden"</script>';
		// }


	}



	public function getEditBoxoffice($id)
	{
		$data = $this->Boxoffice_model->getById($id);
		echo json_encode($data);
	}

	public function deleteBoxoffice($id)
	{
		$res    =  $this->Boxoffice_model->deleteData($id);
		echo $res;
	}

	//----------------------ARTICLE


	public function add()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		//$data['latestreleaseid'] = $id;
		//$data['film']=$this->db->get_where('film_tb',"Id = '$id'")->row_array();

		$this->load->view('admin_panel/add_article_ad', $data);
	}
	public function saveArticle()
	{
		$uid = $this->session->userdata('ADMIN_ID');
		//$catid	=$_POST["catid"];
		//$languageid	=$_POST["lanid"];
		$title		= $_POST["head"];
		$article	= $_POST["editor"];
		//	$article	=str_replace("'","\'",$article); // replacing the quotes.
		//	$article	=str_replace('"','\"',$article); // replacing the quotes	 

		//$article	=htmlspecialchars($article);
		if (empty($article)) {
			echo "Error! article should not be blank.";
			exit;
		}
		/*$createdon=date("Y-m-d H:i:s");
			$data=array('CreatedBy'=>$uid,'CreatedOn'=>$createdon,'CategoryId'=>$catid,'Status'=>'Active');
			$this->db->insert('article',$data);
			$id=$this->db->insert_id();
			$langs=$this->db->get("language")->result();
			foreach($langs as $lang)
			
			
				$this->db->insert("article_description",array("LanguageId"=>$lang->Id,"ArticleId"=>$id));
			*/




		//if($this->db->insert_id()>0)
		//{

		$data = array(
			'Details' => $article,
			'Title' => $title
			// replacing the quotes.
		);
		$this->db->insert('article_tb', $data);



		echo "success";
	}

	//-------------------------ADD ADVERTISEMENT---------------

	public function advertisement()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();

		$this->load->view('admin_panel/advertisement', $data);
	}


	public function advertiseList()
	{
		$list = $this->Advertise_model->getDataTables();
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$image 	 = $data->Photo;
			$images = "../uploads/advertise_image/{$image}";
			$photo = "<img src='{$images}' class='' alt='cand' width='100' height='80'>";
			$no++;
			$row = array();
			//$row[] = $data->FilmName;
			$row[] = $data->Name;
			$row[] = $photo;
			$row[] = empty($data->Link) ? "-" : "<a href=\"$data->Link\" target=\"_blank\">$data->Link</a>";
			//$row[] = $data->Details;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			// $row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			// $row[] = $data->LastLoginIP;
			if (($data->ModifiedOn) == null) {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
				// $row[] = $data->LastLoginIP;
			} else {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->ModifiedOn));
			}
			$row[] = $data->Space;
			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Advertise_model->countAll(),
			"recordsFiltered" => $this->Advertise_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}



	public function saveAdvertise()
	{
		$id		= $this->input->post("hidID");
		// --- checking the existance start;

		$db     = new Database();

		// 		$Name =trim($this->input->post('Name'));

		//                 $where   ="Name='{$Name}' AND Id!='{$id}'";
		// 		       $res = $db->checkExistance("advertise", $where); //  if exists id value will be returnd.

		// 		if($res)
		// 			{
		// 				echo json_encode(array("status" => "Exists"));
		// 				exit;
		// 			}
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		//$where      ="Id=" . $this->input->post('Id');
		// $Category =$db->getFieldValueById("category", "Category", $where);        
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');


		//----- profile image
		$Image = "";
		if ($_FILES['userfile']['name']) {
			//echo "Inside " . $_FILES["userfile"]["name"];
			//exit;

			$upload_dir = 'uploads/advertise_image'; // upload directory
			//------------------------------------------
			$resUpload = $this->uploadImages($upload_dir, 'userfile', 350, 250);



			// checking for error while upload.
			//if (!$resUpload)
			{
				//echo json_encode(array('message' => 'Upload Error'));
				//exit;
			}
			$Image = $resUpload;
		} else {
			$SQL = "SELECT Photo FROM advertise ";
			$SQL .= " WHERE Id =" . $id;

			$result = $this->db->query($SQL);
			// $deleteUserName ="";
			if ($result->num_rows() > 0) {
				foreach ($result->result() as $row)
					$Image = $row->Photo;
			}
			//   $uploads=0;
			//   $image=0;

		}
		/*else
              {  
                $profileImage = "user_default_male.png";
                 if($this->input->post('Sex')=="Female")
                    $profileImage = "user_default_female.png";
               } 
                 //../../uploads/profile_image/
               */
		if ($id == 0) {
			$data = array(
				//'Language' => trim($this->input->post('Language')),
				'Name' => trim($this->input->post('Name')),
				'Status' => $this->input->post('Status'),
				'Link' => $this->input->post('Link'),
				'Space' => $this->input->post('Space'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),
				'Photo' => $Image,


			);
		} else { // if edit

			$data = array(
				'Name' => trim($this->input->post('Name')),

				'Status' => $this->input->post('Status'),
				'Link' => $this->input->post('Link'),
				'Space' => $this->input->post('Space'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),


			);
		}

		$res = $this->Advertise_model->saveData($data, $id);
		echo json_encode(array('message' => 'saved successfully.'));
	}

	public function getEditAdvertise($id)
	{
		$data = $this->Advertise_model->getById($id);
		echo json_encode($data);
	}

	public function deleteAdvertise($id)
	{
		$res    =  $this->Advertise_model->deleteData($id);
		echo $res;
	}












	//-----------------------ADD INTERVIEW---------------
	public function interview()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		//$data['latestreleaseid'] = $id;
		//$data['film']=$this->db->get_where('film_tb',"Id = '$id'")->row_array();

		$this->load->view('admin_panel/addInterview', $data);
	}

	public function saveInterview()
	{
		$db         = new Database();
		$UniqueName = $this->input->post('UniqueName');
		$where   = "UniqueName='{$UniqueName}' ";
		$res = $db->checkExistance("interview_tb", $where); //  if exists id value will be returnd.
		//echo '<pre>',print_r($res),'</pre>';

		if ($res) {
			echo json_encode(array("status" => "Exists"));
			exit;
		}

		$data = array(
			'Title' => $this->input->post('head'),
			//'Link' =>"https://youtube.com/embed/".substr($this->input->post('URL'),17),
			'Link' => $this->input->post('URL'),
			'UniqueName' => $UniqueName,
			'Description' => $this->input->post('details'),
			'Details' => $this->input->post('editor')


		);


		$uploads = $this->uploadImage("uploads/interview/", "file");

		if (!$uploads) {
			echo "upload error";
			exit;
		}

		$this->resizeImage("uploads/interview/$uploads", 850, 500, TRUE);
		$data['CoverImage'] = pathinfo($uploads, PATHINFO_FILENAME) . "_thumb." . pathinfo($uploads, PATHINFO_EXTENSION);
		$data['Image'] = $uploads;
		$this->db->insert('interview_tb', $data);

		echo "success";
	}



	public function viewInterview()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		//$data['latestreleaseid'] = $id;
		//$data['film']=$this->db->get_where('film_tb',"Id = '$id'")->row_array();

		$this->load->view('admin_panel/view_interview', $data);
	}

	public function interviewList()
	{
		$list = $this->Interview_model->getDataTables();
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$row = array();
			//$row[] = $data->FilmName;
			$row[] = $data->Title;
			$row[] = $data->Link;
			$row[] = $data->UniqueName;
			//$row[] = $data->Details;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			//$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			// $row[] = $data->LastLoginIP;
			if (($data->ModifiedOn) == null) {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
				// $row[] = $data->LastLoginIP;
			} else {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->ModifiedOn));
			}

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="' . base_url() . "CinemaAd/editInterview/" . $data->Id . '" title="Click to Edit" onclick="viewData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i>Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
				  ';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Interview_model->countAll(),
			"recordsFiltered" => $this->Interview_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}

	public function deleteInterview($id)
	{
		$res    =  $this->Interview_model->deleteData($id);
		echo $res;
	}

	public function editInterview($id)
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}
		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$data['latestreleaseid'] = $id;
		$data['interview'] = $this->db->get_where('interview_tb', "Id = '$id'")->row_array();

		$this->load->view('admin_panel/edit_interview', $data);
	}

	public function editInterviews($id)
	{
		// $db         = new Database();
		// $UniqueName =$this->input->post('UniqueName');
		//  $where   ="UniqueName='{$UniqueName}' ";
		//      $res = $db->checkExistance("interview_tb", $where); //  if exists id value will be returnd.
		//             //echo '<pre>',print_r($res),'</pre>';

		//     if($res)
		//         {
		//             echo json_encode(array("status" => "Exists"));
		//             exit;
		//         }


		$data = array(
			'Title' => $this->input->post('head'),
			'UniqueName' => $this->input->post('UniqueName'),
			//'Link'=>$this->input->post('URL'),
			'Link' => $this->input->post('URL'),
			'Description' => $this->input->post('details'),
			'Details' => $this->input->post('editor')
		);


		$uploads = $this->uploadImage("uploads/interview/", "file", 850, 500);

		// 		if(!$uploads)
		// 		{
		// 		echo "upload error";
		// 		exit;
		// 		}
		if ($uploads) {
			$this->resizeImage("uploads/interview/$uploads", 850, 500, TRUE);
			$data['CoverImage'] = pathinfo($uploads, PATHINFO_FILENAME) . "_thumb." . pathinfo($uploads, PATHINFO_EXTENSION);
			$data['Image'] = $uploads;
		}
		$this->db->update('interview_tb', $data, "Id = $id");

		echo "success";
	}




	//--------------------------ADD REVIEW----------------------
	public function review()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		//$data['latestreleaseid'] = $id;
		//$data['film']=$this->db->get_where('film_tb',"Id = '$id'")->row_array();

		$this->load->view('admin_panel/add_review', $data);
	}

	public function saveReview()
	{
		$data = array(
			'Title' => $this->input->post('head'),
			//'Link' =>"https://youtube.com/embed/".substr($this->input->post('URL'),17),
			'Link' => $this->input->post('URL'),
			'Description' => $this->input->post('details'),
			'Details' => $this->input->post('editor')
		);

		/*$upload=$this->uploadImage('upload/','jpg|png|jpeg','file');
	if(!$upload)
	{
		echo "Upload Error";
		exit;
	}
	//$this->resizeImage($upload,FALSE,FALSE,300,400);
	echo $upload;
	$data['CoverImage']=$upload;*/

		$uploads = $this->uploadImage("uploads/review/", "file", 1471, 574);

		if (!$uploads) {
			echo "upload error";
			exit;
		}
		$this->resizeImage("uploads/review/$uploads", 656, 494, TRUE);
		$data['CoverImage'] = pathinfo($uploads, PATHINFO_FILENAME) . "_thumb." . pathinfo($uploads, PATHINFO_EXTENSION);
		$data['Image'] = $uploads;
		$this->db->insert('reviews', $data);

		echo "success";
	}



	public function viewReview()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		//$data['latestreleaseid'] = $id;
		//$data['film']=$this->db->get_where('film_tb',"Id = '$id'")->row_array();

		$this->load->view('admin_panel/view_review', $data);
	}

	public function reviewList()
	{
		$list = $this->Review_model->getDataTables();
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$row = array();
			//$row[] = $data->FilmName;
			$row[] = $data->Title;
			$row[] = $data->Link;
			//$row[] = $data->Details;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="' . base_url() . "CinemaAd/editReview/" . $data->Id . '" title="Click to Edit" onclick="viewData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i>Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
				  ';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Review_model->countAll(),
			"recordsFiltered" => $this->Review_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}
	public function editReview($id)
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}
		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$data['latestreleaseid'] = $id;
		$data['interview'] = $this->db->get_where('reviews', "Id = '$id'")->row_array();

		$this->load->view('admin_panel/edit_review', $data);
	}
	public function editReviews($id)
	{
		$data = array(
			'Title' => $this->input->post('head'),
			'Link' => $this->input->post('URL'),
			'Description' => $this->input->post('details'),
			'Details' => $this->input->post('editor')
		);


		$uploads = $this->uploadImage("uploads/review/", "file", 1471, 574);

		if (!$uploads) {
			echo "upload error";
			exit;
		}
		$this->resizeImage("uploads/review/$uploads", 656, 494, TRUE);
		$data['CoverImage'] = pathinfo($uploads, PATHINFO_FILENAME) . "_thumb." . pathinfo($uploads, PATHINFO_EXTENSION);
		$data['Image'] = $uploads;

		$this->db->update('reviews', $data, "Id = $id");

		echo "success";
	}
	public function deleteReview($id)
	{
		$res    =  $this->Review_model->deleteData($id);
		echo $res;
	}

	//-------------upload Image---------------

	public function upload()
	{

		$name = $this->uploadImage("uploads/images/", "upload");
		if (!$name)
			echo "upload error";
		else
			echo base_url() . "uploads/images/" . $name;
	}

	//-------------------------ADD ROUND UP---------------





	public function addRoundUp()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		//$data['latestreleaseid'] = $id;
		//$data['film']=$this->db->get_where('film_tb',"Id = '$id'")->row_array();

		$this->load->view('admin_panel/addRoundUp', $data);
	}


	public function saveRoundUp()
	{
		$data = array(
			'Title' => $this->input->post('head'),
			//'Link' =>"https://youtube.com/embed/".substr($this->input->post('URL'),17),
			'Link' => $this->input->post('URL'),
			'Description' => $this->input->post('details'),
			'Details' => $this->input->post('editor')
		);

		/*$upload=$this->uploadImage('upload/','jpg|png|jpeg','file');
	if(!$upload)
	{
		echo "Upload Error";
		exit;
	}
	//$this->resizeImage($upload,FALSE,FALSE,300,400);
	echo $upload;
	$data['CoverImage']=$upload;*/

		$uploads = $this->uploadImage("uploads/roundup/", "file", 850, 500);

		if (!$uploads) {
			echo "upload error";
			exit;
		}
		$this->resizeImage("uploads/roundup/$uploads", 850, 500, TRUE);
		$data['CoverImage'] = pathinfo($uploads, PATHINFO_FILENAME) . "_thumb." . pathinfo($uploads, PATHINFO_EXTENSION);
		$data['Image'] = $uploads;
		$this->db->insert('roundup', $data);

		echo "success";
	}


	public function viewRoundup()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		//$data['latestreleaseid'] = $id;
		//$data['film']=$this->db->get_where('film_tb',"Id = '$id'")->row_array();

		$this->load->view('admin_panel/view_roundup', $data);
	}


	public function roundupList()
	{
		$list = $this->Roundup_model->getDataTables();
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$no++;
			$row = array();
			//$row[] = $data->FilmName;
			$row[] = $data->Title;
			$row[] = $data->Link;
			//$row[] = $data->Details;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="' . base_url() . "CinemaAd/editRoundup/" . $data->Id . '" title="Click to Edit" onclick="viewData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i>Edit</a>
				  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
				  ';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Roundup_model->countAll(),
			"recordsFiltered" => $this->Roundup_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}



	public function editRoundup($id)
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}
		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$data['latestreleaseid'] = $id;
		$data['interview'] = $this->db->get_where('roundup', "Id = '$id'")->row_array();

		$this->load->view('admin_panel/edit_roundup', $data);
	}


	public function editRoundups($id)
	{
		$data = array(
			'Title' => $this->input->post('head'),
			//'Link'=>$this->input->post('URL'),
			'Link' => $this->input->post('URL'),
			'Description' => $this->input->post('details'),
			'Details' => $this->input->post('editor')
		);


		$uploads = $this->uploadImage("uploads/roundup/", "file", 1471, 574);

		if (!$uploads) {
			echo "upload error";
			exit;
		}
		$this->resizeImage("uploads/roundup/$uploads", 656, 494, TRUE);
		$data['CoverImage'] = pathinfo($uploads, PATHINFO_FILENAME) . "_thumb." . pathinfo($uploads, PATHINFO_EXTENSION);
		$data['Image'] = $uploads;
		$this->db->update('roundup', $data, "Id = $id");

		echo "success";
	}

	public function deleteRoundup($id)
	{
		$res    =  $this->Roundup_model->deleteData($id);
		echo $res;
	}



	//-------------------------------------ADD SLIDE------------------

	public function addSlide()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();

		$this->load->view('admin_panel/addslide', $data);
	}

	public function slideList()
	{
		$list = $this->Slide_model->getDataTables();
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass	 = "label label-success";
			$statusText	 = "Active";
			$image 	 = $data->Photo;
			$images = "../uploads/slide_image/{$image}";
			$slide = "<img src='{$images}' class='' alt='cand' width='100' height='80'>";
			$no++;
			$row = array();
			//$row[] = $data->FilmName;
			$row[] = $data->Id;
			$row[] = $data->SlideName;
			$row[] = $slide;
			//$row[] = $data->Details;
			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
			else
                            $row[] ="Not yet login.";*/
			$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '
			<a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';	  

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Slide_model->countAll(),
			"recordsFiltered" => $this->Slide_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}

	public function saveSlide()
	{
		$id		= $this->input->post("hidID");
		// --- checking the existance start;

		$db     = new Database();

		//$SongName =trim($this->input->post('Song_Name'));

		//$where   ="SongName='{$SongName}' AND Id!='{$id}'";
		//$res = $db->checkExistance("song_tb", $where); //  if exists id value will be returnd.

		/*if($res)
			{
				echo json_encode(array("status" => "Exists"));
				exit;
			}*/
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		//$where      ="Id=" . $this->input->post('Id');
		// $Category =$db->getFieldValueById("category", "Category", $where);        
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$SlideName = trim($this->input->post('Slide_Name'));
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');


		//----- profile image

		//   if(isset($_FILES["userfile"]))
		//   {


		//      $upload_dir ='uploads/slide_image'; // upload directory

		// 	$resUpload=$this->uploadImages($upload_dir,'userfile', 1920, 980);
		//  $slideImage =$resUpload;
		// }
		$config['upload_path']          = './uploads/slide_image/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 10000;
		$config['max_width']            = 3000;
		$config['max_height']           = 2000;

		//means this data insert into table name std



		$this->load->library('Upload', $config);

		if (! $this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('index', $error);
		} else {
			$image_path = $this->upload->data();
			$slideImage = $image_path['file_name'];
		}
		/*else
              {  
                $profileImage = "user_default_male.png";
                 if($this->input->post('Sex')=="Female")
                    $profileImage = "user_default_female.png";
               } 
                 //../../uploads/profile_image/
               */
		if ($id == 0) {
			$data = array(
				'SlideName' => $SlideName,
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),

				'Photo' => $slideImage


			);
		} else { // if edit

			$data = array(
				'SlideName' => $SlideName,
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),

				'Photo' => $slideImage
			);
		}

		$res = $this->Slide_model->saveData($data, $id);
		echo json_encode(array('message' => 'saved successfully.'));
	}
	// }
	public function deleteSlide($id)
	{
		$res    =  $this->Slide_model->deleteData($id);
		echo $res;
	}
	public function media_library()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}
		$db = new Database();
		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();
		$query4 = $this->db->query("SELECT * FROM film_tb where Status='Active' ORDER BY Id DESC");
		$data['media'] = $query4->result_array();
		$this->load->view('admin_panel/media_library', $data);
	}
	//--------shortfilm----------------------------


	public function Shortfilm()
	{
		if (!$this->isSessionSet()) {
			$this->index();
			return;
		}

		$data   = array();
		$data["headTitle"] = $this->headTitle;
		$data["adminController"] = $this->adminController;
		$data["admin_navigation"]   = $this->AdminModel->getAdminMenu();

		$this->load->view('admin_panel/shortfilm', $data);
	}
	public function ShortfilmList()
	{
		$list = $this->Shortfilm_model->getDataTables();
		$data = array();
		$data1 = array();
		$no = $_POST['start']; // commented for working
		$nos = 1;
		//$no=1;
		foreach ($list as $data) {
			$statusClass = "label label-success";
			$showClass   = "label label-success";
			$statusText  = "Active";
			$no++;

			$row = array();
			$row[] = $nos++;
			$row[] = $data->FilmName;

			//             $content=$data->Details;
			// 			$pos=strpos($content, ' ', 100);
			//             $details=substr($content,0,$pos ); 
			// 			$row[] = $details;
			$row[] = $data->Details;
			$row[] = $data->TrailerLink;

			/*if($data->LastLoginDate!=NULL)
                            $row[] = date('d/m/Y h:i:s a', strtotime($data->LastLoginDate)); // converting to indian format with 12hr.
            else
                            $row[] ="Not yet login.";*/
			// $row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
			if (($data->ModifiedOn) == null) {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->CreatedOn));
				// $row[] = $data->LastLoginIP;
			} else {
				$row[] = date('d/m/Y h:i:s a', strtotime($data->ModifiedOn));
			}
			// $row[] = $data->LastLoginIP;

			if ($data->Status == "Inactive") {
				$statusClass = "label label-danger";
				$statusText  = "Inactive";
			}
			$row[] = "<span class='" . $statusClass . "'>" . $data->Status . "</span>";
			//add html for action
			$row[] = '<a  id="editButton" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Click to Edit" onclick="editData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a  id="deleteButton" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Click to Delete" onclick="deleteData(' . "'" . $data->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			//<a id="viewButton" class="btn btn-small btn-info" href="javascript:void(0)" title="Click to edit" onclick="edit_menu('."'". $menu->Id ."'".')"><i class="fa fa-sticky-note-o"></i> View</a>';   

			$data1[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Shortfilm_model->countAll(),
			//"recordsFiltered" => $this->View_model->countFiltered(),
			"data" => $data1,
		);
		//output to json format
		echo json_encode($output);
	}


	public function saveShortfilm()
	{

		$id     = $this->input->post("hidID");
		// --- checking the existance start;

		// $db     = new Database();

		//         $FilmName=trim($this->input->post('Film_Id'));

		//         $where   ="FilmName='{$FilmName}' AND Id!='{$id}'";
		//         $res = $db->checkExistance("trailer_tb", $where); //  if exists id value will be returnd.

		// if($res)
		//     {
		//         echo json_encode(array("status" => "Exists"));
		//         exit;
		//     }
		// --- checking the existance ends;

		// getting the user type

		$db         = new Database();
		//$where      ="Id=" . $this->input->post('Id');
		// $Category =$db->getFieldValueById("category", "Category", $where);        
		$db = NULL;

		//'ModifiedOn' => date('Y-m-d H:i:s');
		$activatedOn    = NULL;
		$InActivatedOn    = NULL;


		if ($this->input->post('Status') == 'Active')
			$activatedOn = date('Y-m-d H:i:s');
		else
			$InActivatedOn = date('Y-m-d H:i:s');


		//----- profile image

		if ($_FILES['userfile']['name']) {
			//echo "Inside " . $_FILES["userfile"]["name"];
			//exit;

			$upload_dir = 'uploads/trailer_image'; // upload directory
			//------------------------------------------
			$resUpload = $this->uploadImages($upload_dir, 'userfile', 850, 500);



			// checking for error while upload.
			//if (!$resUpload)
			{
				//echo json_encode(array('message' => 'Upload Error'));
				//exit;
			}
			$Image = $resUpload;
		} else {
			$SQL = "SELECT Photo FROM shortfilm_tb ";
			$SQL .= " WHERE Id =" . $id;

			$result = $this->db->query($SQL);
			// $deleteUserName ="";
			if ($result->num_rows() > 0) {
				foreach ($result->result() as $row)
					$Image = $row->Photo;
			}
			//   $uploads=0;
			//   $image=0;

		}
		/*else
              {  
                $profileImage = "user_default_male.png";
                 if($this->input->post('Sex')=="Female")
                    $profileImage = "user_default_female.png";
               } 
                 //../../uploads/profile_image/
               */
		if ($id == 0) {
			$data = array(
				'FilmName' => trim($this->input->post('Film_Name')),
				// 'FilmId' => $this->input->post('Film_Id'),
				'Details' => $this->input->post('Details'),
				//'TrailerLink'=>"https://youtube.com/embed/".substr($this->input->post('URL'),17),
				'TrailerLink' => $this->input->post('URL'),
				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'CreatedBy' => $this->session->userdata('ADMIN_ID'),
				'Photo' => $Image

			);
		} else { // if edit

			$data = array(
				'FilmName' => trim($this->input->post('Film_Name')),

				// 'FilmId' => $this->input->post('Film_Id'),
				'Details' => $this->input->post('Details'),
				//'TrailerLink'=>"https://youtube.com/embed/".substr($this->input->post('URL'),17),
				'TrailerLink' => $this->input->post('URL'),

				'Status' => $this->input->post('Status'),
				'ActivatedOn' => $activatedOn,
				'InActivatedOn' => $InActivatedOn,
				'ModifiedBy' => $this->session->userdata('ADMIN_ID'),
				'ModifiedOn' => date('Y-m-d H:i:s'),
				'Photo' => $Image
			);
		}

		$res = $this->Shortfilm_model->saveData($data, $id);
		echo json_encode(array('message' => 'saved successfully.'));
	}


	public function getEditShortfilm($id)
	{
		$data = $this->Shortfilm_model->getById($id);
		echo json_encode($data);
	}

	public function deleteShortfilm($id)
	{
		$res    =  $this->Shortfilm_model->deleteData($id);
		echo $res;
	}
} //------------------- CLASS ENDS

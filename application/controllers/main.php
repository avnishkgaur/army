<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('army_model');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper('text');
		date_default_timezone_set('Asia/Kolkata');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect(base_url('home'),'location', 301);
		} else{
			$this->load->view('homeheader');
			$this->load->view('landing');
			$this->load->view('footer');
		}
	}

	public function home()
	{
		if ($this->session->userdata('logged_in')) {
			$username = $this->session->userdata("username");
			$data["userinfo"] = $this->army_model->getuserinfo($username);
			$data["content"] = $this->army_model->getcontent();
			$data["title"]="Home | Agni";
			$this->load->view('header',$data);
			$this->load->view('home',$data);
			$this->load->view('footer');
		} else{
			redirect(base_url(),'location', 301);
		}
	}

	public function login()
	{
		if (isset($_POST['username'])&&isset($_POST['password'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$resp = $this->army_model->login($username,$password);
			if($resp){
				$userinfo = $this->army_model->getuserinfo($username);
				$newdata = array(
				                   'username'  => $username,
				                   'fname'  => $userinfo['fname'],
				                   'lname'  => $userinfo['lname'],
				                   'email'     => $userinfo['email'],
				                   'id'      => $userinfo['id'],
				                   'role'      => $userinfo['role'],
				                   'logged_in' => TRUE
				               );
				$this->session->set_userdata($newdata);				
				redirect(base_url('home'),'location', 301);
			} else{
				echo "Login <b>Unsuccessful</b>. <a href=".base_url('').">Try again.</a>";
			}
		}
	}

	public function logout()
	{
		if ($this->session->userdata('logged_in')) {
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('role');
			redirect(base_url(),'location', 301);
		}
	}

	public function createuser()
	{
		$this->load->helper('email');
		if (isset($_POST['username'])) {
			$uname = $_POST['username'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$this->army_model->createuser($uname,$password,$email);	
			echo 'account created. Go to the <a href="'.base_url('signin').'">login</a> page.';		
		}
	}

	public function uploadnow()
	{
		$this->output->enable_profiler(TRUE); 
		$fn = $_FILES['userfile']['name'];
		preg_match('/\.[^\.]+$/i',$fn,$ext);
		$fn = preg_replace("/\\.[^.\\s]{3,4}$/", "", $fn);
		if($_POST["title"]){
			$fn = $_POST["title"];
		}
		$fn = str_replace(" ", "_", $fn);
		$ftitle = $fn."_".time().$ext[0];
		$config['upload_path'] = './uploads/';
		$config['allowed_types']	= 'jpg|png|pdf|txt|doc|docx|ppt|pptx|xls|xlsx';
		$config['max_size']	= '100000';
		$config['file_name'] = $ftitle;
		$this->load->library('upload', $config);
		var_dump($this->upload->data());
		if(isset($_POST['desc'])){
			$desc = $_POST['desc'];
		} else{
			$desc = ""; 			
		}

		$vis = $_POST["visibility"];

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			echo 'Could not be uploaded. Go to <a href="'.base_url().'">home</a>.';
			var_dump($error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->army_model->uploadfile($fn,$ftitle,$desc,$this->session->userdata('username'),$vis);	
			$this->session->set_flashdata('uploadmsg', 'Uploaded Successfully!');
			redirect(base_url('home'),'location', 301);
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
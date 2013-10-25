<?php
	class VerifyLogin extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('users');
		}
		
		function index(){
			$res = $this->users->login($this->input->post('username'), $this->input->post('password'));
			if ($res){
				$sess_array = array(
					'username' => $this->input->post('username')
				);
				$this->session->set_userdata('logged_in', $sess_array);
				redirect('home', 'refresh');
			} else {
				$this->load->view('login_view', array('message' => 'Đăng nhập sai tên hoặc mật khẩu!'));
			}
		}
	}
?>
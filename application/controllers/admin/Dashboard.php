<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('Admin_model', '', TRUE);
		$this->load->model('Absen_model', '', TRUE);
		$this->load->model('Siswa_model', '', TRUE);
		$this->load->model('Nilai_model', '', TRUE);
    }

	public function index()
	{

        if(empty($_SESSION['admin']) && $_SESSION['admin']==''){
            redirect('admin/dashboard/login');
        }
		$data = array(	'page' 	=> 'Home',
						'title'	=> 'Dashboard',
						'home'	=> 'active'
					);
		$this->load->view('admin_view/index',$data);
	}

	public function login()
	{
		$data = array(	'form' 	=> 'admin/Dashboard/plogin',
						'title'	=> 'Login',
						'judul' => 'Login Admin'
					);
	
		$this->load->view('admin_view/login',$data);
	}

	public function plogin()
	{
		$inputan = array('username' => $this->input->post('username'),
						 'password' => $this->input->post('password')
						);
		if($this->Admin_model->login($inputan)){
	 		$this->session->set_flashdata('msg_status', 'alert-success');
	 		$this->session->set_flashdata('msg', 'login berhasil');
			redirect('admin');
		}else{
	 		$this->session->set_flashdata('msg_status', 'alert-danger');
	 		$this->session->set_flashdata('msg', 'Login gagal!');
			redirect('admin/dashboard/login');
		}
	}

	public function logout()
	{
		$_SESSION['admin']="";
		unset($_SESSION['admin']);
		redirect('admin');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
		$this->load->model('Admin_model', '', TRUE);
		$this->load->model('Kelas_model', '', TRUE);
		$this->load->model('Siswa_model', '', TRUE);
		$this->load->model('Absen_model', '', TRUE);
		$this->load->model('Guru_model', '', TRUE);
		$this->load->model('Matpel_model', '', TRUE);
		$this->load->model('Kurikulum_model', '', TRUE);
		$this->load->model('Walikelas_model', '', TRUE);
		$this->load->model('Nilai_model', '', TRUE);
    }

	public function combo_matpel($sel='')
    {
    	$ret = '<div class="form-group">';
    	$query=$this->Kurikulum_model->get_where(array('idKelas' => $_SESSION['kelas'], ));
    	$res = $query->result();
		foreach ($res as $row) {
			$opt[$row->idKurikulum] = $row->mata_pelajaran;
		}
		$js = 'class="form-control"';
		$ret= $ret.''.form_dropdown('idMatapelajaran',$opt,$sel, $js);
		$ret= $ret.'</div>';
		return $ret;
    }

	public function index()
	{
		$data = array(	'page' 	=> 'matpel_view',
						'form'	=> 'home/pilih_matpel',	
						'combo_kelas' => $this->combo_matpel()
					);
		$this->load->view('index',$data);
	}


	public function login()
	{
		$data = array(	'form' 	=> 'Home/plogin',
						'title'	=> 'Login',
					);
	
		$this->load->view('admin_view/login',$data);
	}

	public function plogin()
	{
		$inputan = array('username' => $this->input->post('username'),
						 'password' => $this->input->post('password')
						);
		if($this->Guru_model->login($inputan)){
	 		$this->session->set_flashdata('msg_status', 'alert-success');
	 		$this->session->set_flashdata('msg', 'login berhasil');
	 		$this->Walikelas_model->get_kelas($_SESSION['guru']);
			redirect('Home');
		}else{
	 		$this->session->set_flashdata('msg_status', 'alert-danger');
	 		$this->session->set_flashdata('msg', 'Login gagal!');
			redirect('Home');
		}
	}

	public function pilih_matpel()
	{
		$_SESSION['matpel'] = $this->input->post('idMatapelajaran');
		redirect('home/nilai');
	}

	public function nilai()
	{
		$data = array(	'page' 	=> 'nilai_view',
						'matpel'=> $this->Kurikulum_model->get_name($_SESSION['matpel']) ,//$this->get_hari(date('l')).', '.date('d-m-Y'),
						'table'	=> $this->gen_table($_SESSION['kelas']),
						'form'	=> 'home/proses_nilai'
					);

    	if(!$this->Absen_model->cek_absen($_SESSION['kelas'])){
	 		$data['form'] = 'home/update_absen';
    	}
		$this->load->view('index',$data);
	}
    
    public function gen_table($v)
    {
    	$query=$this->Siswa_model->get_from_kelas($v);
    	$res = $query->result();
		$num_rows = $query->num_rows();
		$isi = '';

		if ($num_rows > 0){
			foreach ($res as $row){
				$tu = $this->Nilai_model->get_nilai('tugas', $row->idMutasi, $_SESSION['matpel']);
				$ut = $this->Nilai_model->get_nilai('uts', $row->idMutasi, $_SESSION['matpel']);
				$ua = $this->Nilai_model->get_nilai('uas', $row->idMutasi, $_SESSION['matpel']);
				$isi = $isi.'<tr>';
				$isi = $isi.'<input type="hidden" name="idMutasi['.$row->idMutasi.']" value="'.$row->idMutasi.'" >';
				$isi = $isi.'<td>'.$row->nis.'</td>';
				$isi = $isi.'<td>'.$row->NISN.'</td>';
				$isi = $isi.'<td>'.$row->NamaSiswa.'</td>';
				$isi = $isi.'<td><input class="form-control" type="number" name="tugas['.$row->idMutasi.']" value="'.$tu.'"></td>';
				$isi = $isi.'<td><input class="form-control" type="number" name="uts['.$row->idMutasi.']" value="'.$ut.'"></td>';
				$isi = $isi.'<td><input class="form-control" type="number" name="uas['.$row->idMutasi.']" value="'.$ua.'"></td>';
				$isi =	$isi.'</tr>';
			}
		}
		return  $isi;
    }

    public function logout()
    {
    	$_SESSION['guru']="";
		$_SESSION['kelas']="";
		unset($_SESSION['admin']);
		unset($_SESSION['kelas']);
    	//echo "$_SESSION[guru] $_SESSION[kelas]";
    	redirect('home');
    }

    public function proses_nilai()
    {
    	$i=0;
    	$cek = [];
    	foreach ($this->input->post('idMutasi') as $key => $value) {
    		echo ++$i.' = ';
    		echo "$key -> $value <br>";	
    		$input = array('idMutasi' 		=> $value,
    						'idKurikulum' 	=> $_SESSION['matpel'],
    						'tugas'			=> $this->input->post('tugas')[$key],
    						'uts'			=> $this->input->post('uts')[$key],
    						'uas'			=> $this->input->post('uas')[$key]
    			);
    		$idn = $this->Nilai_model->cek_nilai($input['idMutasi'], $input['idKurikulum']);
    		if($idn!=0){
    			echo 'Sudah ada';
    			if($this->Nilai_model->update($input, $idn)){
    				array_push($cek, 1);
    			}else{
    				array_push($cek, 0);
    			}
    		}else{
    			if($this->Nilai_model->add($input)){
    				array_push($cek, 1);
    			}else{
    				array_push($cek, 0);
    			}
    			echo 'Belum ada';	
    		}
    		echo '<br>';
    	}

    	if(in_array(0, $cek)){
	 		$this->session->set_flashdata('msg_status', 'alert-danger');
	 		$this->session->set_flashdata('msg', 'Data Nilai gagal disimpan!');	
    	}else{
	 		$this->session->set_flashdata('msg_status', 'alert-success');
	 		$this->session->set_flashdata('msg', 'Data Nilai berhasil disimpan!');
    	}
    	redirect('home');
    }
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
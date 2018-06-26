<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
		$this->load->model('Admin_model', '', TRUE);
		$this->load->model('Kelas_model', '', TRUE);
		$this->load->model('Siswa_model', '', TRUE);
		$this->load->model('Absen_model', '', TRUE);
		$this->load->model('Guru_model', '', TRUE);
    }

    public function gen_table($v)
    {
    	if($this->Absen_model->cek_absen($v)){
    		$query=$this->Siswa_model->get_from_kelas($v);
    	}else{
    		$query=$this->Absen_model->get_data_kelastgl($v, date('Y-m-d'));
    		$abm='true';
    	}
    	$res = $query->result();
		$num_rows = $query->num_rows();
		$isi = '';

		if ($num_rows > 0){
			foreach ($res as $row){
				$kt = isset($abm)?$row->keterangan:'h';
				$ida = isset($abm)?'<div><input type="hidden" name="idAbsen['.$row->idMutasi.']" value="'.$row->idKehadiran.'" /></div>':'';
				$isi = $isi.'<tr>';
				$isi = $isi.' '.$ida;
				$isi = $isi.'<td>'.$row->nis.'</td>';
				$isi = $isi.'<td>'.$row->NISN.'</td>';
				$isi = $isi.'<td>'.$row->NamaSiswa.'</td>';
				$isi = $isi.'<td><div class="form-group">'.form_radio($row->idMutasi,'h',$this->getKet('h',$kt),'class="form-control cbkehadiran"').'</div></td>';
				$isi = $isi.'<td><div class="form-group">'.form_radio($row->idMutasi,'i',$this->getKet('i',$kt),'class="form-control cbkehadiran"').'</div></td>';
				$isi = $isi.'<td><div class="form-group">'.form_radio($row->idMutasi,'s',$this->getKet('s',$kt),'class="form-control cbkehadiran"').'</div></td>';
				$isi = $isi.'<td><div class="form-group">'.form_radio($row->idMutasi,'a',$this->getKet('a',$kt),'class="form-control cbkehadiran"').'</div></td>';
				$isi = $isi.'<td><div class="form-group">'.form_radio($row->idMutasi,'t',$this->getKet('t',$kt),'class="form-control cbkehadiran"').'</div></td>';
				$isi =	$isi.'</tr>';
			}
		}
		return  $isi;
    }

    public function getKet($v, $l)
    {
    	if($v==$l)
    		return TRUE;
    	else
    		return FALSE;
    }

	public function combo_kelas($sel)
    {
    	$ret = '<div class="form-group">';
    	$query=$this->Kelas_model->get_all();
    	$res = $query->result();
		foreach ($res as $row) {
			$opt[$row->idKelas] = $row->Kelas;
		}
		$js = 'class="form-control"';
		$ret= $ret.''.form_dropdown('idkelas',$opt,$sel, $js);
		$ret= $ret.'</div>';
		return $ret;
    }

	public function index()
	{
        if(empty($_SESSION['guru']) && $_SESSION['guru']==''){
            redirect('Absen/login');
        }
		$data = array(	'page' 	=> 'pilihkelas',	
						'form'	=> 'Absen/pilihkelas',
						'combo_kelas' => $this->combo_kelas('')
					);
		$this->load->view('index',$data);
	}

	public function pilihkelas()
	{
		$_SESSION['kelas'] = $this->input->post('idkelas');

    	if(!$this->Absen_model->cek_absen($_SESSION['kelas'])){
	 		$this->session->set_flashdata('msg_status', 'alert-info');
	 		$this->session->set_flashdata('msg', 'Kelas sudah diabsen!');
	 	}
		redirect('absen/absen_form');
	}

	public function absen_form()
	{
		$data = array(	'page' 	=> 'absen',
						'hari'	=> $this->get_hari(date('l')).', '.date('d-m-Y'),
						'table'	=> $this->gen_table($_SESSION['kelas']),
						'form'	=> 'Absen/proses_absen'
					);

    	if(!$this->Absen_model->cek_absen($_SESSION['kelas'])){
	 		$data['form'] = 'Absen/update_absen';
    	}
		$this->load->view('index',$data);
	}

	public function login()
	{
		$data = array(	'form' 	=> 'Absen/plogin',
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
			redirect('Absen');
		}else{
	 		$this->session->set_flashdata('msg_status', 'alert-danger');
	 		$this->session->set_flashdata('msg', 'Login gagal!');
			redirect('Absen/login');
		}
	}

	public function proses_absen()
	{
		$ok = false;
		foreach ($this->input->post() as $key => $v) {
			$inputan = array('idMutasi' 	=> $key,
							 'NIP'			=> $_SESSION['guru'],
							 'tanggal'		=> date('Y-m-d'),
							 'keterangan'	=> $v
							);
			if($this->Absen_model->add($inputan)){
		 		$ok=true;
	 		}else{
		 		$ok=false;
		 		break;
	 		}
		}
		if($ok){
	 		$this->session->set_flashdata('msg_status', 'alert-success');
	 		$this->session->set_flashdata('msg', 'Data Absen berhasil disimpan!');	
	 		redirect('Absen/absen_form');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert-danger');
	 		$this->session->set_flashdata('msg', 'Data Absen gagal disimpan!');	
	 		redirect('Absen/absen_form');
 		}
	}

	public function update_absen()
	{
		$ok = false;
		foreach ($this->input->post() as $key => $v) {
			if($key!='idAbsen'){	
				$idab = $this->input->post('idAbsen['.$key.']');
				$inputan = array('NIP'			=> $_SESSION['guru'],
								 'tanggal'		=> date('Y-m-d'),
								 'keterangan'	=> $v
								);
				if($this->Absen_model->update($inputan,$idab)){
			 		$ok=true;
		 		}else{
			 		$ok=false;
			 		break;
		 		}
			}
		}
		if($ok){
	 		$this->session->set_flashdata('msg_status', 'alert-success');
	 		$this->session->set_flashdata('msg', 'Data Absen berhasil disimpan!');	
	 		redirect('Absen/absen_form');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert-danger');
	 		$this->session->set_flashdata('msg', 'Data Absen gagal disimpan!');	
	 		redirect('Absen/absen_form');
 		}
	}

	public function logout()
	{
		$_SESSION['guru']="";
		$_SESSION['kelas']="";
		unset($_SESSION['admin']);
		unset($_SESSION['kelas']);
		redirect('Absen');
	}

	public function get_hari($d)
	{
		if ($d=='Monday'){
            return 'Senin';
        }elseif($d=='Tuesday'){
            return 'Selasa';
        }elseif($d=='Wednesday'){
            return 'Rabu';
        }elseif($d=='Thursday'){
            return 'Kamis';
        }elseif($d=='Friday'){
            return 'Jumat';
        }elseif($d=='Saturday'){
            return 'Sabtu';
        }elseif($d=='Sunday'){
            return 'Minggu';
        }else{
            return $d;
        }
	}
}

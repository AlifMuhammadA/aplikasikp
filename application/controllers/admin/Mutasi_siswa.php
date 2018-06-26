<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi_siswa extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['admin']) && $_SESSION['admin']==''){
            redirect('admin/dashboard/login');
        }	
		$this->load->model('Kelas_model', '', TRUE);
		$this->load->model('Siswa_model', '', TRUE);
    }

    public function combo_kelas($sel)
    {
    	$ret = '<div class="form-group"><div class="col-sm-12">';
    	$query=$this->Kelas_model->get_all();
    	$res = $query->result();
		$opt[''] = '[Pilih Kelas]';
		foreach ($res as $row) {
			$opt[$row->idKelas] = $row->Kelas;
		}
		$js = 'class="form-control"  id="cbkls1" onchange="pilih_kelas(this.value)"';
		$ret= $ret.''.form_dropdown('idkelas',$opt,$sel, $js);
		$ret= $ret.'</div></div>';
		return $ret;
    }

    public function combo_kelas2($sel)
    {
    	$ret = '<div class="form-group"><div class="col-sm-12">';
    	$query=$this->Kelas_model->get_all();
    	$res = $query->result();
		foreach ($res as $row) {
			$opt[$row->idKelas] = $row->Kelas;
		}
		$js = 'class="form-control" id="cbkls2"';
		$ret= $ret.''.form_dropdown('idkelas_fix',$opt,$sel, $js);
		$ret= $ret.'</div></div>';
		return $ret;
    }

    public function combo_siswa($sel)
    {
    	$ret = '<div class="form-group"><div class="col-sm-12">';
    	$query=$this->Siswa_model->get_from_kelas($sel);
    	$res = $query->result();
    	if($query->num_rows()>0){
			foreach ($res as $row) {
				$opt[$row->nis] = $row->NamaSiswa;
			}
    	}else{
			$opt[''] = '';
    	}
		$js = 'class="form-control cbmsiswa" id="cbsiswa_kanan"';
		$ret= $ret.''.form_multiselect('idkelas',$opt, '',$js);
		$ret= $ret.'</div></div>';
		echo $ret;
    }

    public function combo_ta()
    {
    	$ret = '<div class="form-group"><div class="col-sm-12">';
    	$query=$this->TA_model->get_all();
    	$res = $query->result();
		foreach ($res as $row) {
			$opt[$row->idTahunAjar] = $row->TahunAjar;
		}
		$js = 'class="form-control" id="cbkls2"';
		$ret= $ret.''.form_dropdown('idta',$opt,'', $js);
		$ret= $ret.'</div></div>';
		return $ret;
    }

	public function index()
	{
		$data = array(	'page'		=> 'naikkelas_view',
						'title'		=> 'Naik Kelas',
						'naikel'	=> 'active',
						'form'		=> 'admin/Mutasi_siswa/mutasi',
	 					'combo_kelas' 	=> $this->combo_kelas(''),
	 					'combo_kelas2' 	=> $this->combo_kelas2(''),
	 					'combo_taj' 	=> $this->combo_ta(),
					);
		$this->load->view('admin_view/index',$data);
	}

	public function mutasi()
	{
		$idkls = $this->input->post('idkelas_fix');
		$thn  = $this->input->post('idta');
		$oke = false;

		foreach ($this->input->post('cb_siswa') as $key => $val) {
			if($this->Siswa_model->cek_data($val, $thn)){
				$inputan = array('nis' => $val,
								 'idKelas' => $idkls,
								 'idTahunAjar' => date('Y-m-d'),
								);
				if($this->Siswa_model->mutasi($inputan)){
					$oke=true;
				}else{
					$oke=false;
				}
			}else{
				$idMutasi = $this->Siswa_model->idmutasi;				 
				$inputan = array('nis' 			=> $val,
								 'idKelas' 		=> $idkls,
								 'idTahunAjar' 	=> $this->TA_model->get_aktif_id(),
								 'tglMutasi'	=> date('Y-m-d')
								);
				if($this->Siswa_model->update_mutasi($inputan, $idMutasi)){
					$oke=true;
				}else{
					$oke=false;
				}
			}
		}

		if($oke){
			$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Mutasi Siswa berhasil disimpan!');	
	 		redirect('admin/Mutasi_siswa');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Mutasi Siswa gagal disimpan!');	
	 		redirect('admin/Mutasi_siswa');
 		}
	}

}

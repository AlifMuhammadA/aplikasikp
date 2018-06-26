<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['admin']) && $_SESSION['admin']==''){
            redirect('admin/dashboard/login');
        }
		$this->load->model('Siswa_model', '', TRUE);
		$this->load->model('Kelas_model', '', TRUE);
		$this->load->model('Kurikulum_model', '', TRUE);
		$this->load->model('Nilai_model', '', TRUE);
    }

    public function gen_table_siswa($v)
    {
    	$query=$this->Siswa_model->get_from_kelas($v);
    	$res = $query->result();
		$num_rows = $query->num_rows();
		
		$tmpl = array( 'table_open'    => '<table class="table display">',
						'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					);
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'NIS', 'NISN', 'Nama', 'Kelas', 'Tambah Nilai');
		
		if ($num_rows > 0)
		{
			$i = 0;
			
			foreach ($res as $row)
			{
				$uo = ($this->Nilai_model->cek_sts_nilai($row->idMutasi))?'<u>':'';
				$uc = ($this->Nilai_model->cek_sts_nilai($row->idMutasi))?'</u>':'';
				$this->table->add_row($uo.++$i.$uc, 
										$uo.$row->nis.$uc,
										$uo.$row->NISN.$uc, 
										$uo.$row->NamaSiswa.$uc,
										$uo.$row->Kelas.$uc,
										$uo.anchor('admin/nilai/tambah/'.$row->idMutasi,'<span class="fa fa-pencil"></span>',array( 'title' => 'Tambah Nilai', 'class' => 'btn btn-success btn-xs', 'data-toggle' => 'tooltip')).$uc
										);
			}
		}
		echo  $this->table->generate();
    }

    public function filter_kelas()
    {
    	$ret = '<form class="form-horizontal"><div class="form-group"><label for="Kelas" class="col-sm-1 control-label">Kelas</label><div class="col-sm-11">';
    	$query=$this->Kelas_model->get_all();
    	$res = $query->result();
    	$opt['']='Semua Kelas';
		foreach ($res as $row) {
			$opt[$row->idKelas] = $row->Kelas;
		}
		$js = 'class="form-control" onChange="pilih_kelas_nilai(this.value)" ';
		$ret= $ret.''.form_dropdown('cbkelas',$opt,'', $js);
		$ret= $ret.'</div></div></form>';
		return $ret;
    }

	public function index()
	{
		$data = array(	'page'		=> 'nilai_view',
						'title'		=> 'Nilai',
						'nilai'		=> 'active',
						'cbkelas'	=> $this->filter_kelas(),
					);
		$this->load->view('admin_view/index',$data);
	}

    public function gen_table_matpel($v, $y, $idm)
    {
    	$where = array('idTahunAjar' => $v, 
    					'idKelas'	=> $y);
    	$query=$this->Kurikulum_model->get_where($where);
    	$res = $query->result();
		$num_rows = $query->num_rows();
		
		$tmpl = array( 'table_open'    => '<table class="table display">',
						'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					);
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'Pelajaran', 'Tugas', 'UTS', 'UAS');
		
		if ($num_rows > 0)
		{
			$i = 0;
			foreach ($res as $row)
			{
				$tu = $this->Nilai_model->get_nilai('tugas', $idm, $row->idKurikulum);
				$ut = $this->Nilai_model->get_nilai('uts', $idm, $row->idKurikulum);
				$ua = $this->Nilai_model->get_nilai('uas', $idm, $row->idKurikulum);
				$this->table->add_row(++$i,
										 $row->mata_pelajaran,
										'<input type="number" class="form-control" name="nil_tu_'.$row->idKurikulum.'" value="'.$tu.'" min="0" max="100" required>',
										'<input type="number" class="form-control" name="nil_ut_'.$row->idKurikulum.'" value="'.$ut.'" min="0" max="100" required>',
										'<input type="number" class="form-control" name="nil_ua_'.$row->idKurikulum.'" value="'.$ua.'" min="0" max="100" required>'.' '.
										'<input type="hidden" class="form-control" name="idKurikulum[]" value="'.$row->idKurikulum.'" required>'
										);
			}
		}
		return $this->table->generate();
    }

	public function tambah($v='')
	{
		$q = $this->Siswa_model->get_all_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$idTahunAjar = $row->idTahunAjar;
			$idKelas = $row->idKelas;
			$idMutasi = $row->idMutasi;
			$nis = $row->nis;
			$NamaSiswa = $row->NamaSiswa;
			$Kelas = $row->Kelas;
		}
		$data = array(	'page'		=> 'nilai_view',
						'title'		=> 'Nilai',
						'nilai'		=> 'active',
						'form'		=> 'admin/nilai/add',
						'cbkelas'	=> $this->filter_kelas(),
						'idMutasi'	=> $v,
						'nis'		=> $nis,
						'NamaSiswa'	=> $NamaSiswa,
						'Kelas'		=> $Kelas,
						'table'		=> $this->gen_table_matpel($idTahunAjar, $idKelas, $idMutasi),
					);
		$this->load->view('admin_view/index',$data);
	}

	public function add()
	{
		$input = array( 'idMutasi' => $this->input->post('idMutasi'), 
						);
		foreach ($this->input->post('idKurikulum') as $key => $value) {
			$input['idKurikulum'] = $value;
			$input['tugas'] = $this->input->post('nil_tu_'.$value);
			$input['uts'] 	= $this->input->post('nil_ut_'.$value);
			$input['uas'] 	= $this->input->post('nil_ua_'.$value);
			$idn = $this->Nilai_model->cek_nilai($input['idMutasi'], $input['idKurikulum']);
			if($idn!=0){
				//unset($input['idMutasi'], $input['idKurikulum']);
				$oke = $this->Nilai_model->update($input, $idn);	
				echo $idn.' UDPATE <br>';
			}else{
				$oke = $this->Nilai_model->add($input);	
				echo $idn.' INSERT <br>';
			}
		}

		if($oke){
			$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Nilai berhasil disimpan!');	
	 		redirect('admin/Nilai');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Nilai gagal disimpan!');	
	 		redirect('admin/Nilai');
 		}	
 			
	}
}

/* End of file Nilai.php */
/* Location: ./application/controllers/admin/Nilai.php */
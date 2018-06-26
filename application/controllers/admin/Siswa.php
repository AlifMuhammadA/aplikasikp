<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['admin']) && $_SESSION['admin']==''){
            redirect('admin/dashboard/login');
        }
		$this->load->model('Siswa_model', '', TRUE);
		$this->load->model('Kelas_model', '', TRUE);
    }

    public function gen_table()
    {
    	$query=$this->Siswa_model->get_all();
    	$res = $query->result();
		$num_rows = $query->num_rows();
		
		$tmpl = array( 'table_open'    => '<table id="tbl1" class="table display">',
						'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					);
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'NIS', 'NISN', 'Nama', 'Kelas', 'Aksi');
		
		if ($num_rows > 0)
		{
			$i = 0;
			
			foreach ($res as $row)
			{
				$this->table->add_row(++$i, $row->nis,
										$row->NISN, 
										$row->NamaSiswa,
										$row->Kelas,
										anchor('admin/siswa/ubah/'.$row->nis,'<span class="fa fa-pencil"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-default btn-xs', 'data-toggle' => 'tooltip')).'&nbsp;'.
										anchor('admin/siswa/hapus/'.$row->nis,'<span class="fa fa-trash"></span>',array( 'title' => 'Hapus', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip', 'onclick' => "return confirm('Anda yakin akan menghapus data ini?')" ))

									);
			}
		}
		return  $this->table->generate();
    }

    public function filter_kelas()
    {
    	$ret = '<form class="form-horizontal"><div class="form-group"><label for="Kelas" class="col-sm-1 control-label">Kelas</label><div class="col-sm-11">';
    	$query=$this->Kelas_model->get_all();
    	$res = $query->result();
    	$opt['']='Semua Kelas';
		foreach ($res as $row) {
			$opt[$row->Kelas] = $row->Kelas;
		}
		$js = 'class="form-control" onChange="filter_kelas(this.value)" ';
		$ret= $ret.''.form_dropdown('cbkelas',$opt,'', $js);
		$ret= $ret.'</div></div></form>';
		return $ret;
    }

	public function index()
	{
		$data = array(	'page'		=> 'siswa_view',
						'title'		=> 'Guru',
						'siswa'		=> 'active',
						'link_add'	=> anchor('admin/Siswa/tambah/','Tambah Data',array( 'title' => 'Tambah', 'class' => 'btn btn-default')),
						'cbkelas'	=> $this->filter_kelas(),
						'table'		=> $this->gen_table(),
					);
		$this->load->view('admin_view/index',$data);
	}

    public function combo_kelas($sel)
    {
    	$ret = '<div class="form-group"><label for="Kelas" class="col-sm-2 control-label">Kelas</label><div class="col-sm-10">';
    	$query=$this->Kelas_model->get_all();
    	$res = $query->result();
		foreach ($res as $row) {
			$opt[$row->idKelas] = $row->Kelas;
		}
		$js = 'class="form-control"';
		$ret= $ret.''.form_dropdown('idkelas',$opt,$sel, $js);
		$ret= $ret.'</div></div>';
		return $ret;
    }

    public function radio_jk($sel)
    {
    	$ret = '<div class="form-group"><label for="JenisKelamin" class="col-sm-2 control-label">Jenis Kelamin</label><div class="col-sm-10">';
    	
    	$lak = true;
    	$per = false;
    	if($sel=='P'){
    		$per = true;
    		$lak = false;
    	}

		$ret= $ret.'<div class="radio"><label>'; 
		$ret= $ret.''.form_radio('JenisKelamin','L',$lak, '').'Laki-laki';
		$ret= $ret.'</label></div>'; 
		$ret= $ret.'<div class="radio"><label>'; 
		$ret= $ret.''.form_radio('JenisKelamin','P',$per, '').'Perempuan';
		$ret= $ret.'</label></div>'; 
		$ret= $ret.'</div></div>';
		return $ret;
    }

    public function combo_agama($sel)
    {
    	$ret = '<div class="form-group"><label for="Agama" class="col-sm-2 control-label">Agama</label><div class="col-sm-10">';
		
		$opt['Islam'] = 'Islam';
		$opt['Kristen Protestan'] = 'Kristen Protestan';
		$opt['Katolik'] = 'Katolik';
		$opt['Hindu'] = 'Hindu';
		$opt['Buddha'] = 'Buddha';
		$opt['Kong Hu Cu'] = 'Kong Hu Cu';
		
		$js = 'class="form-control"';
		$ret= $ret.''.form_dropdown('Agama',$opt,$sel, $js);
		$ret= $ret.'</div></div>';
		return $ret;
    }

    public function combo_pendidikan_ayah($sel)
    {
    	$ret = '<div class="form-group"><label for="PendidikanAyah" class="col-sm-2 control-label">Pendidikan Ayah</label><div class="col-sm-10">';
		
		$opt['SD'] 				= 'SD';
		$opt['SMP']				= 'SMP';
		$opt['SMA']				= 'SMA';
		$opt['D1']				= 'D1';
		$opt['D2']				= 'D2';
		$opt['D3']				= 'D3';
		$opt['D4']				= 'D4';
		$opt['Sarhjana Muda']	= 'Sarhjana Muda';
		$opt['S1']				= 'S1';
		$opt['S2']				= 'S2';
		$opt['S3']				= 'S3';
		
		$js = 'class="form-control"';
		$ret= $ret.''.form_dropdown('PendidikanAyah',$opt,$sel, $js);
		$ret= $ret.'</div></div>';
		return $ret;
    }

    public function combo_pendidikan_ibu($sel)
    {
    	$ret = '<div class="form-group"><label for="PendidikanIbu" class="col-sm-2 control-label">Pendidikan Ibu</label><div class="col-sm-10">';
		
		$opt['SD'] 				= 'SD';
		$opt['SMP']				= 'SMP';
		$opt['SMA']				= 'SMA';
		$opt['D1']				= 'D1';
		$opt['D2']				= 'D2';
		$opt['D3']				= 'D3';
		$opt['D4']				= 'D4';
		$opt['Sarhjana Muda']	= 'Sarhjana Muda';
		$opt['S1']				= 'S1';
		$opt['S2']				= 'S2';
		$opt['S3']				= 'S3';
		
		$js = 'class="form-control"';
		$ret= $ret.''.form_dropdown('PendidikanIbu',$opt,$sel, $js);
		$ret= $ret.'</div></div>';
		return $ret;
    }

	public function tambah()
	{
		$data = array(	'page' 					=> 'siswa_view',
						'title'					=> 'Kelas',
						'siswa'					=> 'active',
						'form'					=> 'admin/Siswa/add',
	 					'combo_kelas' 			=> $this->combo_kelas(''),
	 					'radio_jk'	 			=> $this->radio_jk(''),
	 					'combo_agama'			=> $this->combo_agama(''),
	 					'combo_pendidikan_ayah'	=> $this->combo_pendidikan_ayah(''),
	 					'combo_pendidikan_ibu'	=> $this->combo_pendidikan_ibu(''),
					);
		$this->load->view('admin_view/index',$data);
	}

	public function add()
	{
		$inputan = array(	'NIS'				=> $this->input->post('NIS'),  
							'NISN'				=> $this->input->post('NISN'), 
							'namasiswa'			=> $this->input->post('namasiswa'), 
							'JenisKelamin'		=> $this->input->post('JenisKelamin'), 
							'Agama'				=> $this->input->post('Agama'), 
							'TempatLahir'		=> $this->input->post('TempatLahir'), 
							'TglLahir'			=> $this->input->post('TglLahir'), 
							'Alamat'			=> $this->input->post('Alamat'), 
							'NamaAyah'			=> $this->input->post('NamaAyah'), 
							'PendidikanAyah'	=> $this->input->post('PendidikanAyah'), 
							'PenghasilanAyah'	=> $this->input->post('PenghasilanAyah'), 
							'AlamatRumahAyah'	=> $this->input->post('AlamatRumahAyah'), 
							'NomorHpAyah'		=> $this->input->post('NomorHpAyah'), 
							'NamaIbu'			=> $this->input->post('NamaIbu'), 
							'PendidikanIbu'		=> $this->input->post('PendidikanIbu'), 
							'PenghasilanIbu'	=> $this->input->post('PenghasilanIbu'), 
							'AlamatRumahIbu'	=> $this->input->post('AlamatRumahIbu'), 
							'NomorHpIbu'		=> $this->input->post('NomorHpIbu'), 
							);

		$nis = $this->input->post('NIS');
		$idk = $this->input->post('idkelas');
 		if($this->Siswa_model->add($inputan,$nis,$idk)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data siswa berhasil disimpan!');	
	 		redirect('admin/siswa');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data siswa gagal disimpan!');	
	 		redirect('admin/siswa/tambah');
 		}
	}

	public function ubah()
	{
		$data = array(	'page' 		=> 'siswa_view',
						'title'		=> 'Kelas',
						'siswa'		=> 'active',
						'form'		=> 'admin/siswa/update',
					);
		$id = $this->uri->segment(4);
 		$query=$this->Siswa_model->get_data($id);
    	$res = $query->result();
    	foreach ($res as $row){
    		$data['NIS'] 				= $row->nis;
    		$data['txtNISN'] 			= $row->NISN;
    		$data['txtnama'] 			= $row->NamaSiswa;
    		$data['radio_jk'] 			= $this->radio_jk($row->JenisKelamin);
    		$data['combo_agama']		= $this->combo_agama($row->Agama); 
    		$data['txtTempatLahir']		= $row->TempatLahir; 
    		$data['txtTglLahir']		= $row->TglLahir; 
    		$data['txtAlamat']			= $row->Alamat; 
    		$data['txtNamaAyah']		= $row->NamaAyah; 
    		$data['combo_pendidikan_ayah']	= $this->combo_pendidikan_ayah($row->PendidikanAyah); 
    		$data['txtPenghasilanAyah']	= $row->PenghasilanAyah; 
    		$data['txtAlamatRumahAyah']	= $row->AlamatRumahAyah; 
    		$data['txtNomorHpAyah']		= $row->NomorHpAyah; 
    		$data['txtNamaIbu']			= $row->NamaIbu; 
    		$data['combo_pendidikan_ibu']	= $this->combo_pendidikan_ibu($row->PendidikanIbu); 
    		$data['txtPenghasilanIbu']	= $row->PenghasilanIbu; 
    		$data['txtAlamatRumahIbu']	= $row->AlamatRumahIbu; 
    		$data['txtNomorHpIbu']		= $row->NomorHpIbu; 
    	}
		$this->load->view('admin_view/index',$data);
	}

 	public function update()
 	{
 		$id = $this->input->post('IDNIS');
 		$inputan = array(	'NISN'				=> $this->input->post('NISN'), 
							'namasiswa'			=> $this->input->post('namasiswa'), 
							'JenisKelamin'		=> $this->input->post('JenisKelamin'), 
							'Agama'				=> $this->input->post('Agama'), 
							'TempatLahir'		=> $this->input->post('TempatLahir'), 
							'TglLahir'			=> $this->input->post('TglLahir'), 
							'Alamat'			=> $this->input->post('Alamat'), 
							'NamaAyah'			=> $this->input->post('NamaAyah'), 
							'PendidikanAyah'	=> $this->input->post('PendidikanAyah'), 
							'PenghasilanAyah'	=> $this->input->post('PenghasilanAyah'), 
							'AlamatRumahAyah'	=> $this->input->post('AlamatRumahAyah'), 
							'NomorHpAyah'		=> $this->input->post('NomorHpAyah'), 
							'NamaIbu'			=> $this->input->post('NamaIbu'), 
							'PendidikanIbu'		=> $this->input->post('PendidikanIbu'), 
							'PenghasilanIbu'	=> $this->input->post('PenghasilanIbu'), 
							'AlamatRumahIbu'	=> $this->input->post('AlamatRumahIbu'), 
							'NomorHpIbu'		=> $this->input->post('NomorHpIbu'), 
							);
 		if($this->Siswa_model->update($inputan,$id)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data siswa berhasil diubah!');	
	 		redirect('admin/siswa');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data siswa gagal diubah!');	
	 		redirect('admin/siswa/edit/'.$id);
 		}
 	}

 	public function hapus($v='')
 	{
		if($this->Siswa_model->delete($v)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data siswa berhasil dihapus!');	
	 		redirect('admin/siswa');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data siswa gagal dihapus!');	
	 		redirect('admin/siswa/edit/'.$id);
 		}
 	}

}

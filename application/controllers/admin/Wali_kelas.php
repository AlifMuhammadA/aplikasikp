<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wali_kelas extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['admin']) && $_SESSION['admin']==''){
            redirect('admin/dashboard/login');
        }
		$this->load->model('Guru_model', '', TRUE);
		$this->load->model('Kelas_model', '', TRUE);
		$this->load->model('Walikelas_model', '', TRUE);
    }

    public function gen_table()
    {
    	$query=$this->Walikelas_model->get_all();
    	$res = $query->result();
		$num_rows = $query->num_rows();
		
		$tmpl = array( 'table_open'    => '<table class="table table-striped table-hover">',
						'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					);
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'Nama Guru', 'Wali Kelas', 'Aksi');
		
		if ($num_rows > 0)
		{
			$i = 0;
			
			foreach ($res as $row)
			{
				$this->table->add_row(++$i, $row->NamaGuru,
										$row->Kelas, 
										anchor('admin/Wali_kelas/hapus/'.$row->idWaliKelas,'<span class="fa fa-trash"></span>',array( 'title' => 'hapus', 'class' => 'btn btn-default btn-xs', 'data-toggle' => 'tooltip' ,'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')")).'&nbsp'.
										anchor('admin/Wali_kelas/ubah/'.$row->idWaliKelas,'<span class="fa fa-pencil"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-default btn-xs', 'data-toggle' => 'tooltip'))

									);
			}
		}
		return  $this->table->generate();
    }

    public function gen_guru()
    {
    	$query=$this->Guru_model->get_all();
    	$res = $query->result();
		$num_rows = $query->num_rows();
		
		$tmpl = array( 'table_open'    => '<table class="table table-striped table-hover">',
						'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					);
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'NIP', 'Nama Guru', 'Aksi');
		
		if ($num_rows > 0)
		{
			$i = 0;
			
			foreach ($res as $row)
			{
				$this->table->add_row(++$i, $row->NIP,
										$row->NamaGuru,
										anchor('#','<span class="fa fa-check"></span>',array( 'title' => 'pilih', 'class' => 'btn btn-default btn-xs plhguru', 'data-toggle' => 'tooltip', 'id' => $row->NIP, 'namaguru' => $row->NamaGuru ))
									);
			}
		}
		return  $this->table->generate();
    }

	public function index()
	{
		$data = array(	'page'		=> 'walikelas_view',
						'title'		=> 'Guru',
						'wakel'		=> 'active',
						'link_add'	=> anchor('admin/Wali_kelas/tambah/','Tambah Data',array( 'title' => 'Tambah', 'class' => 'btn btn-default')),
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
			if($this->Walikelas_model->cek_kelas($row->idKelas)){
				$opt[$row->idKelas] = $row->Kelas;
			}
		}
		$js = 'class="form-control"';
		$ret= $ret.''.form_dropdown('idkelas',$opt,$sel, $js);
		$ret= $ret.'</div></div>';
		return $ret;
    }

	public function tambah()
	{
		$data = array(	'page' 		=> 'walikelas_view',
						'title'		=> 'Kelas',
						'wakel'		=> 'active',
						'form'		=> 'admin/Wali_kelas/add',
	 					'combo_kelas' 	=> $this->combo_kelas(''),
	 					'tbl_guru' 	=> $this->gen_guru(),
					);
		$this->load->view('admin_view/index',$data);
	}

	public function add()
	{
		$inputan = array('NIP'			=> $this->input->post('nip'),
						 'idKelas'		=> $this->input->post('idkelas'),
						 'idTahunAjar'	=> $this->TA_model->get_aktif_id(),
						 'tglMutasi'	=> date('Y-m-d'),
						);
 		if($this->Walikelas_model->add($inputan)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Guru berhasil disimpan!');	
	 		redirect('admin/Wali_kelas');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Guru gagal disimpan!');	
	 		redirect('admin/Wali_kelas/tambah');
 		}
	}

	public function ubah()
	{
		$id = $this->uri->segment(4);
		$data = array(	'page' 		=> 'walikelas_view',
						'title'		=> 'Kelas',
						'wakel'		=> 'active',
						'form'		=> 'admin/Wali_kelas/update',
	 					'combo_kelas' 	=> $this->combo_kelas($id),
	 					'tbl_guru' 	=> $this->gen_guru(),
					);
 		$query=$this->Walikelas_model->get_data($id);
    	$res = $query->result();
    	foreach ($res as $row){
    		$data['idwali'] = $row->idWaliKelas;
    		$data['nip'] = $row->NIP;
    		$data['txtnama'] = $row->NamaGuru;
    	}
		$this->load->view('admin_view/index',$data);
	}

 	public function update()
 	{
 		$id = $this->input->post('idwali');
 		$inputan = array('NIP'			=> $this->input->post('idnip'),
						 'idKelas'		=> $this->input->post('idkelas'),
						 'idTahunAjar'	=> $this->TA_model->get_aktif_id(),
						 'tglMutasi'	=> date('Y-m-d'),
						);
 		if($this->Walikelas_model->update($inputan,$id)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Wali kelas berhasil diubah!');	
	 		redirect('admin/Wali_kelas');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Wali kelas gagal diubah!');	
	 		redirect('admin/Wali_kelas/edit/'.$id);
 		}
 	}

 	public function hapus()
 	{
		$id = $this->uri->segment(4);
		if($this->Walikelas_model->delete($id)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Wali kelas berhasil dihapus!');	
	 		redirect('admin/Wali_kelas');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Wali kelas sudah digunakan tidak dapat dihapus!');	
	 		redirect('admin/Wali_kelas/edit/'.$id);
 		}
 	}

}

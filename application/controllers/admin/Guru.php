<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['admin']) && $_SESSION['admin']==''){
            redirect('admin/dashboard/login');
        }
		$this->load->model('Guru_model', '', TRUE);
    }

    public function gen_table()
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

		$this->table->set_heading('No', 'NIP', 'Nama Guru', 'Username', 'Aksi');
		
		if ($num_rows > 0)
		{
			$i = 0;
			
			foreach ($res as $row)
			{
				$this->table->add_row(++$i, $row->NIP,
										$row->NamaGuru,
										$row->username, 
										anchor('admin/Guru/hapus/'.$row->NIP,'<span class="fa fa-trash"></span>',array( 'title' => 'hapus', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip' ,'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')")).'&nbsp'.
										anchor('admin/Guru/ubah/'.$row->NIP,'<span class="fa fa-pencil"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-default btn-xs', 'data-toggle' => 'tooltip'))

									);
			}
		}
		return  $this->table->generate();
    }

	public function index()
	{
		$data = array(	'page'		=> 'guru_view',
						'title'		=> 'Guru',
						'guru'		=> 'active',
						'link_add'	=> anchor('admin/Guru/tambah/','Tambah Data',array( 'title' => 'Tambah', 'class' => 'btn btn-default')),
						'table'		=> $this->gen_table(),
					);
		$this->load->view('admin_view/index',$data);
	}

	public function tambah()
	{
		$data = array(	'page' 		=> 'guru_view',
						'title'		=> 'Kelas',
						'guru'		=> 'active',
						'form'		=> 'admin/Guru/add',
					);
		$this->load->view('admin_view/index',$data);
	}

	public function add()
	{
		$inputan = array('NIP'		=> $this->input->post('nip'),
						 'NamaGuru'	=> $this->input->post('namaguru'),
						 'username'	=> $this->input->post('username'),
						 'password'	=> $this->input->post('password'),
						);
 		if($this->Guru_model->add($inputan)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Guru berhasil disimpan!');	
	 		redirect('admin/Guru');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Guru gagal disimpan!');	
	 		redirect('admin/Guru/tambah');
 		}
	}

	public function ubah()
	{
		$data = array(	'page' 		=> 'guru_view',
						'title'		=> 'Kelas',
						'guru'		=> 'active',
						'form'		=> 'admin/Guru/update',
					);
		$id = $this->uri->segment(4);
 		$query=$this->Guru_model->get_data($id);
    	$res = $query->result();
    	foreach ($res as $row){
    		$data['nip'] = $row->NIP;
    		$data['txtnama'] = $row->NamaGuru;
    		$data['txtusername'] = $row->username;
    	}
		$this->load->view('admin_view/index',$data);
	}

 	public function update()
 	{
 		$id = $this->input->post('idnip');
 		$inputan = array('NamaGuru'	=> $this->input->post('namaguru'),
						 'username'	=> $this->input->post('username'),
						 'password'	=> $this->input->post('password'),
						);
 		if($this->Guru_model->update($inputan,$id)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Guru berhasil diubah!');	
	 		redirect('admin/Guru');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Guru gagal diubah!');	
	 		redirect('admin/Guru/edit/'.$id);
 		}
 	}

 	public function hapus()
 	{
		$id = $this->uri->segment(4);
		if($this->Guru_model->delete($id)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Guru berhasil dihapus!');	
	 		redirect('admin/Guru');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Guru gagal dihapus!');	
	 		redirect('admin/Guru/edit/'.$id);
 		}
 	}

}

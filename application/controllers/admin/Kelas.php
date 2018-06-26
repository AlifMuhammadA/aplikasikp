<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['admin']) && $_SESSION['admin']==''){
            redirect('admin/dashboard/login');
        }
		$this->load->model('Kelas_model', '', TRUE);
    }

    public function gen_table()
    {
    	$query=$this->Kelas_model->get_all();
    	$res = $query->result();
		$num_rows = $query->num_rows();
		
		$tmpl = array( 'table_open'    => '<table class="table table-striped table-hover">',
						'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					);
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'Kelas', 'Aksi');
		
		if ($num_rows > 0)
		{
			$i = 0;
			
			foreach ($res as $row)
			{
				$this->table->add_row(++$i, $row->Kelas, 
										anchor('admin/Kelas/hapus/'.$row->idKelas,'<span class="fa fa-trash"></span>',array( 'title' => 'hapus', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip' ,'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')")).'&nbsp'.
										anchor('admin/Kelas/ubah/'.$row->idKelas,'<span class="fa fa-pencil"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-default btn-xs', 'data-toggle' => 'tooltip'))

									);
			}
		}
		return  $this->table->generate();
    }

	public function index()
	{
		$data = array(	'page'		=> 'kelas_view',
						'title'		=> 'Kelas',
						'kelas'		=> 'active',
						'link_add'	=> anchor('admin/Kelas/tambah/','Tambah Data',array( 'title' => 'Tambah', 'class' => 'btn btn-default')),
						'table'		=> $this->gen_table(),
					);
		$this->load->view('admin_view/index',$data);
	}

	public function tambah()
	{
		$data = array(	'page' 		=> 'kelas_view',
						'title'		=> 'Kelas',
						'kelas'		=> 'active',
						'form'		=> 'admin/Kelas/add',
					);
		$this->load->view('admin_view/index',$data);
	}

	public function add()
	{
		$inputan = array('Kelas'	=> $this->input->post('kelas'));
 		if($this->Kelas_model->add($inputan)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Kelas berhasil disimpan!');	
	 		redirect('admin/Kelas');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Kelas gagal disimpan!');	
	 		redirect('admin/Kelas/tambah');
 		}
	}

	public function ubah()
	{
		$data = array(	'page' 		=> 'kelas_view',
						'title'		=> 'Tahun Ajar',
						'kelas'		=> 'active',
						'form'		=> 'admin/Kelas/update',
					);
		$id = $this->uri->segment(4);
 		$query=$this->Kelas_model->get_data($id);
    	$res = $query->result();
    	foreach ($res as $row){
    		$data['txtidkls'] = $row->idKelas;
    		$data['txtkelas'] = $row->Kelas;
    	}
		$this->load->view('admin_view/index',$data);
	}

 	public function update()
 	{
 		$id = $this->input->post('idKelas');
 		$inputan = array('Kelas'	=> $this->input->post('kelas'));
 		if($this->Kelas_model->update($inputan,$id)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Kelas berhasil diubah!');	
	 		redirect('admin/Kelas');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Kelas gagal diubah!');	
	 		redirect('admin/Kelas/edit/'.$id);
 		}
 	}

 	public function hapus()
 	{
		$id = $this->uri->segment(4);
		if($this->Kelas_model->delete($id)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Kelas berhasil dihapus!');	
	 		redirect('admin/Kelas');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Kelas gagal dihapus!');	
	 		redirect('admin/Kelas/edit/'.$id);
 		}
 	}

}

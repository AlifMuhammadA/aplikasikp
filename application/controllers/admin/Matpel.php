<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matpel extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['admin']) && $_SESSION['admin']==''){
            redirect('admin/dashboard/login');
        }
		$this->load->model('Matpel_model', '', TRUE);
    }

    public function gen_table()
    {
    	$query=$this->Matpel_model->get_all();
    	$res = $query->result();
		$num_rows = $query->num_rows();
		
		$tmpl = array( 'table_open'    => '<table class="table table-striped table-hover">',
						'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					);
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'Nama Pelajaran', 'Keterangan', 'Aksi');
		
		if ($num_rows > 0)
		{
			$i = 0;
			
			foreach ($res as $row)
			{
				$this->table->add_row(++$i, 
										$row->mata_pelajaran,
										$row->keterangan, 
										anchor('admin/Matpel/hapus/'.$row->idMatapelajaran,'<span class="fa fa-trash"></span>',array( 'title' => 'hapus', 'class' => 'btn btn-default btn-xs', 'data-toggle' => 'tooltip' ,'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')")).'&nbsp'.
										anchor('admin/Matpel/ubah/'.$row->idMatapelajaran,'<span class="fa fa-pencil"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip'))

									);
			}
		}
		return  $this->table->generate();
    }

	public function index()
	{
		$data = array(	'page'		=> 'matpel_view',
						'title'		=> 'Mata Pelajaran',
						'matpel'	=> 'active',
						'link_add'	=> anchor('admin/matpel/tambah/','Tambah Data',array( 'title' => 'Tambah', 'class' => 'btn btn-default')),
						'table'		=> $this->gen_table(),
					);
		$this->load->view('admin_view/index',$data);
	}

	public function tambah()
	{
		$data = array(	'page'		=> 'matpel_view',
						'title'		=> 'Mata Pelajaran',
						'matpel'	=> 'active',
						'form'		=> 'admin/matpel/add',
					);
		$this->load->view('admin_view/index',$data);
	}

	public function add()
	{
		$inputan = array('mata_pelajaran'	=> $this->input->post('mata_pelajaran'),
						 'keterangan'		=> $this->input->post('keterangan')	,
						);

 		if($this->Matpel_model->add($inputan)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Mata Pelajaran berhasil disimpan!');	
	 		redirect('admin/matpel');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Mata Pelajaran gagal disimpan!');	
	 		redirect('admin/matpel/tambah');
 		}
	}

	public function ubah()
	{
		$data = array(	'page'		=> 'matpel_view',
						'title'		=> 'Mata Pelajaran',
						'matpel'	=> 'active',
						'form'		=> 'admin/matpel/update',
					);
		$id = $this->uri->segment(4);
 		$query=$this->Matpel_model->get_data($id);
    	$res = $query->result();
    	foreach ($res as $row){
    		$data['idMatapelajaran'] = $row->idMatapelajaran;
    		$data['txtmata_pelajaran'] = $row->mata_pelajaran;
    		$data['txtketerangan'] = $row->keterangan;
    	}
		$this->load->view('admin_view/index',$data);
	}

 	public function update()
 	{
 		$id = $this->input->post('idMatapelajaran');
 		$inputan = array('mata_pelajaran'	=> $this->input->post('mata_pelajaran'),
						 'keterangan'		=> $this->input->post('keterangan')	,
						);
 		if($this->Matpel_model->update($inputan,$id)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Mata Pelajaran berhasil diubah!');	
	 		redirect('admin/matpel');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Mata Pelajaran gagal diubah!');	
	 		redirect('admin/matpel/edit/'.$id);
 		}
 	}

 	public function hapus()
 	{
		$id = $this->uri->segment(4);
		if($this->Matpel_model->delete($id)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Mata Pelajaran berhasil dihapus!');	
	 		redirect('admin/matpel');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Mata Pelajaran gagal dihapus!');	
	 		redirect('admin/matpel/edit/'.$id);
 		}
 	}

}

/* End of file Matpel.php */
/* Location: ./application/controllers/admin/Matpel.php */
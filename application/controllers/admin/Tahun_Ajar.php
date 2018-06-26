<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_Ajar extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['admin']) && $_SESSION['admin']==''){
            redirect('admin/dashboard/login');
        }
		$this->load->model('TA_model', '', TRUE);
    }

    public function gen_table()
    {
    	$query=$this->TA_model->get_all();
    	$res = $query->result();
		$num_rows = $query->num_rows();
		
		$tmpl = array( 'table_open'    => '<table class="table table-striped table-hover">',
						'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					);
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'Tahun Ajar', 'Status', 'Aksi');
		
		if ($num_rows > 0)
		{
			$i = 0;
			
			foreach ($res as $row)
			{
				$this->table->add_row(++$i, $row->TahunAjar, 
										$this->TA_model->get_status($row->status),
										anchor('admin/Tahun_Ajar/aktif/'.$row->idTahunAjar,'<span class="fa fa-check-square-o"></span>',array( 'title' => 'aktif', 'class' => 'btn btn-default btn-xs', 'data-toggle' => 'tooltip')).'&nbsp'.
										anchor('admin/Tahun_Ajar/ubah/'.$row->idTahunAjar,'<span class="fa fa-pencil"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-default btn-xs', 'data-toggle' => 'tooltip'))

									);
			}
		}
		return  $this->table->generate();
    }

	public function index()
	{
		$data = array(	'taktif'	=> $this->TA_model->get_aktif(),
						'page'		=> 'TahunAjar',
						'title'		=> 'Tahun Ajar',
						'thnajr'	=> 'active',
						'link_add'	=> anchor('admin/Tahun_Ajar/tambah/','Tambah Data',array( 'title' => 'Tambah', 'class' => 'btn btn-default')),
						'table'		=> $this->gen_table(),
					);
		$this->load->view('admin_view/index',$data);
	}

	public function tambah()
	{
		$data = array(	'page' 		=> 'TahunAjar',
						'title'		=> 'Tahun Ajar',
						'thnajr'	=> 'active',
						'form'		=> 'admin/Tahun_Ajar/add',
					);
		$this->load->view('admin_view/index',$data);
	}

	public function add()
	{
		$inputan = array('TahunAjar'	=> $this->input->post('tahunajar'));
 		if($this->TA_model->add($inputan)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Tahun Ajar berhasil disimpan!');	
	 		redirect('admin/Tahun_Ajar');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Tahun Ajar gagal disimpan!');	
	 		redirect('admin/Tahun_Ajar/tambah');
 		}
	}

	public function ubah()
	{
		$data = array(	'page' 		=> 'TahunAjar',
						'title'		=> 'Tahun Ajar',
						'thnajr'	=> 'active',
						'form'		=> 'admin/Tahun_Ajar/update',
					);
		$id = $this->uri->segment(4);
 		$query=$this->TA_model->get_data($id);
    	$res = $query->result();
    	foreach ($res as $row){
    		$data['txtidta'] = $row->idTahunAjar;
    		$data['txtta'] = $row->TahunAjar;
    	}
		$this->load->view('admin_view/index',$data);
	}

 	public function update()
 	{
 		$id = $this->input->post('idTahunAjar');
 		$inputan = array('TahunAjar'	=> $this->input->post('tahunajar'));
 		if($this->TA_model->update($inputan,$id)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Tahun Ajar berhasil diubah!');	
	 		redirect('admin/Tahun_Ajar');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Tahun Ajar gagal diubah!');	
	 		redirect('admin/Tahun_Ajar/edit/'.$id);
 		}
 	}

 	public function aktif()
 	{
		$id = $this->uri->segment(4);
 		if($this->TA_model->set_aktif($id)){
	 		$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Tahun Ajar berhasil diset aktif!');	
	 		redirect('admin/Tahun_Ajar');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Tahun Ajar gagal diset aktif!');	
	 		redirect('admin/Tahun_Ajar/edit/'.$id);
 		}
 	}
}

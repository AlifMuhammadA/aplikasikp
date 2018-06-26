<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['admin']) && $_SESSION['admin']==''){
            redirect('admin/dashboard/login');
        }	
		$this->load->model('Kelas_model', '', TRUE);
		$this->load->model('Matpel_model', '', TRUE);
		$this->load->model('Kurikulum_model', '', TRUE);
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
		$js = 'class="form-control"  id="cbkls1" onchange="ubah_kelas(this)"';
		$ret= $ret.''.form_dropdown('idkelas',$opt,$sel, $js);
		$ret= $ret.'</div></div>';
		return $ret;
    }

    public function combo_matpel()
    {
    	$ret = '<div class="form-group"><div class="col-sm-12">';
    	$query=$this->Matpel_model->get_all();
    	$res = $query->result();
    	if($query->num_rows()>0){
			foreach ($res as $row) {
				$optm[$row->idMatapelajaran] = $row->mata_pelajaran;
			}
    	}else{
			$optm[''] = '';
    	}
		$js = 'class="form-control cbmsiswa" id="cbmatpel_kanan" multiple="multiple"';
		$ret= $ret.''.form_multiselect('idMatapelajaran',$optm, '',$js);
		$ret= $ret.'</div></div>';
		return $ret;
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
		$data = array(	'page'		=> 'kurikulum_view',
						'title'		=> 'Kurikulum',
						'kurikulum'	=> 'active',
						'form'		=> 'admin/kurikulum/proses',
	 					'combo_kelas' 	=> $this->combo_kelas(''),
	 					'combo_taj' 	=> $this->combo_ta(),
	 					'combo_matpel' 	=> $this->combo_matpel(),
					);
		$this->load->view('admin_view/index',$data);
	}

	public function proses()
	{
		$input = array( 'idTahunAjar' 	=> $this->input->post('idta'),
						'idKelas' 		=> $this->input->post('idkelas'), );
		
		$hsl = $this->Kurikulum_model->cek_mapel($input);
		$i=0;
		foreach ($this->input->post('cb_matpel') as $key => $value) {
			$input['idMatapelajaran'] = $value;
			$idmp[$i] = $value;
			$idkm = $this->Kurikulum_model->cek_data($input);
			if($idkm!=0){
				$oke = $this->Kurikulum_model->update($input, $idkm);	
			}else{
				$oke = $this->Kurikulum_model->add($input);	
			}
			$i++;
		}

		if(!empty($hsl)){
			foreach ($hsl as $key => $value) {
				if(!in_array($value, $idmp)){
					$input['idMatapelajaran'] = $value;
					$this->Kurikulum_model->delete($input);
				}
			}
		}

		if($oke){
			$this->session->set_flashdata('msg_status', 'alert3');
	 		$this->session->set_flashdata('msg', 'Data Kurikulum berhasil disimpan!');	
	 		redirect('admin/kurikulum');
 		}else{
	 		$this->session->set_flashdata('msg_status', 'alert6');
	 		$this->session->set_flashdata('msg', 'Data Kurikulum gagal disimpan!');	
	 		//redirect('admin/kurikulum');
 		}
	}

    public function combo_matpel_fix($a="", $b="")
    {
    	$w = array('idTahunAjar' => $a, 
    				'idKelas'	=> $b
    				);
    	$ret = '<div class="form-group"><div class="col-sm-12">';
    	$query=$this->Kurikulum_model->get_where($w);
    	$res = $query->result();
    	if($query->num_rows()>0){
			foreach ($res as $row) {
				$optm[$row->idMatapelajaran] = $row->mata_pelajaran;
			}
    	}else{
			$optm[''] = '';
    	}
		$js = ' id="cbmatpel_fix" class="form-control cbmsiswa" multiple="multiple" required style="min-height:350px"';
		$ret= $ret.''.form_multiselect('cb_matpel[]',$optm, '',$js);
		$ret= $ret.'</div></div>';
		echo $ret;
    }

    public function combo_matpel_load()
    {
    	$ret = '<div class="form-group"><div class="col-sm-12">';
    	$query=$this->Matpel_model->get_all();
    	$res = $query->result();
    	if($query->num_rows()>0){
			foreach ($res as $row) {
				$optm[$row->idMatapelajaran] = $row->mata_pelajaran;
			}
    	}else{
			$optm[''] = '';
    	}
		$js = 'class="form-control cbmsiswa" id="cbmatpel_kanan" multiple="multiple"';
		$ret= $ret.''.form_multiselect('idMatapelajaran',$optm, '',$js);
		$ret= $ret.'</div></div>';
		echo $ret;
    }
}

/* End of file Kurikulum.php */
/* Location: ./application/controllers/admin/Kurikulum.php */
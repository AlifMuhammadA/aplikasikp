<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_nilai extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['admin']) && $_SESSION['admin']==''){
            redirect('admin/dashboard/login');
        }
		$this->load->model('Absen_model', '', TRUE);
		$this->load->model('Kelas_model', '', TRUE);
		$this->load->model('Siswa_model', '', TRUE);
		$this->load->model('Nilai_model', '', TRUE);
		$this->load->model('Kurikulum_model', '', TRUE);
    }

    public function combo_siswa($sel='')
    {
    	$ret = '<div class="form-group"><label for="Kelas" class="col-sm-2 control-label">Siswa</label><div class="col-sm-5">';
    	$query=$this->Siswa_model->get_from_kelas($sel);
    	$res = $query->result();
		//$opt[''] = 'Semua Siswa';
		foreach ($res as $row) {
			$opt[$row->idMutasi] = $row->NamaSiswa;
		}
		$js = 'class="form-control"';
		$ret= $ret.''.form_dropdown('idMutasi',$opt,'', $js);
		$ret= $ret.'</div></div>';
		echo $ret;
    }

    public function combo_kelas($sel='')
    {
    	$ret = '<div class="form-group"><label for="Kelas" class="col-sm-2 control-label">Kelas</label><div class="col-sm-5">';
    	$query=$this->Kelas_model->get_all();
    	$res = $query->result();
		//$opt[''] = 'Semua Kelas';
		foreach ($res as $row) {
			$opt[$row->idKelas] = $row->Kelas;
		}
		$js = 'class="form-control" onchange="pilih_cbkelas(this.value)"';
		$ret= $ret.''.form_dropdown('idkelas',$opt,$sel, $js);
		$ret= $ret.'</div></div>';
		echo $ret;
    }

    public function combo_type($sel='')
    {
    	$ret = '<div class="form-group"><label for="type" class="col-sm-2 control-label">Type</label><div class="col-sm-5">';
		
		$opt[1] = 'Semua';
		$opt[2] = 'Perkelas';
		$opt[3] = 'Persiswa';
		
		$js = 'class="form-control" onchange="pilih_type(this.value)"';
		$ret= $ret.''.form_dropdown('type',$opt,$sel, $js);
		$ret= $ret.'</div></div>';
		return $ret;
    }
    
	public function index()
	{
		$data = array(	'page'		=> 'laporan_view',
						'title'		=> 'Laporan Nilai',
						'lapnil'	=> 'active',
						'form'		=> 'admin/Laporan_nilai/cetak',
						'cbtype'	=> $this->combo_type(),
					);
		$this->load->view('admin_view/index',$data);
	}

	public function cetak()
	{
		$type = $this->input->post('type');
		$kls = $this->input->post('idkelas');
		$siswa = $this->input->post('idMutasi');

		$data = array(	
						'imglogo'	=> base_url('assets/img/logo.png'),
						'type'		=> $type,
					);

		$arr_kelas = [];
		$arr_siswa = [];
		$arr_table = [];
		if($type==1){
			$data['allkelas']=$this->Kelas_model->get_all();
		}else if($type==2){
			array_push($arr_kelas, $this->Kelas_model->get_kelas($kls));
			array_push($arr_siswa, $this->Siswa_model->get_from_kelas_laopran($kls));

			$q = $this->Siswa_model->get_from_kelas($kls);
			$res = $q->result();
			foreach ($res as $row) {
				$arr_table[$row->idMutasi] = $this->gen_table($this->TA_model->get_aktif_id(), $kls, $row->idMutasi);
			}
			echo $this->TA_model->get_aktif_id().'' .$kls.' '.$row->idMutasi;
			$data['nkelas']	= $arr_kelas;
			$data['siswa']	= $arr_siswa;
			$data['table']	= $arr_table;
		}else if($type==3){
			array_push($arr_kelas, $this->Kelas_model->get_kelas($kls));
			array_push($arr_siswa, $this->Siswa_model->get_all_data($kls));
			$arr_table[$siswa] = $this->gen_table($this->TA_model->get_aktif_id(), $kls, $siswa);

			$data['nkelas']	= $arr_kelas;
			$data['siswa']	= $arr_siswa;
			$data['table']	= $arr_table;
		}

/*
		$this->load->library('pdfgenerator');

		$html = $this->load->view('admin_view/cetak_laporan',$data, true);

		$this->pdfgenerator->generate($html,'rekap_absen_'.$data['nkelas'].'_'.$data['nbulan']);	
		*/
		$this->load->view('admin_view/cetak_laporan',$data);
	}



    public function gen_table($v, $y, $idm)
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

		$this->table->set_heading('No', 'Pelajaran', 'Tugas', 'UTS', 'UAS', 'Nilai Akhir');
		
		if ($num_rows > 0)
		{
			$i = 0;
			foreach ($res as $row)
			{
				$tu = $this->Nilai_model->get_nilai('tugas', $idm, $row->idKurikulum);
				$ut = $this->Nilai_model->get_nilai('uts', $idm, $row->idKurikulum);
				$ua = $this->Nilai_model->get_nilai('uas', $idm, $row->idKurikulum);
				$na = ($tu * 0.4) + ($ut * 0.3) + ($ua * 0.3);
				$this->table->add_row(++$i,
										$row->mata_pelajaran,
										$tu,
										$ut,
										$ua,
										$na
									);
			}
		}
		return $this->table->generate();
    }

	public function get_bulan($v)
	{
		switch($v){
			case 1:return 'Januari';break;
			case 2:return 'Februari';break;
			case 3:return 'Maret';break;
			case 4:return 'April';break;
			case 5:return 'Mei';break;
			case 6:return 'Juni';break;
			case 7:return 'Juli';break;
			case 8:return 'Agustus';break;
			case 9:return 'September';break;
			case 10:return 'Oktober';break;
			case 11:return 'November';break;
			case 12:return 'Desember';break;
			default : return 'null';
		}
	}
}

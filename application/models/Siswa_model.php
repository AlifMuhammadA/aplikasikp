<?php

class Siswa_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public $idmutasi="";

    var $table = 'tblmutasi';
    var $join1 = 'tblsiswa';
    var $join2 = 'tblkelas';
    var $join3 = 'tbltahunajar';

    var $pk = 'idMutasi';
    var $fk1 = 'nis';
    var $fk2 = 'idKelas';
    var $fk3 = 'idTahunAjar';

    public function get_all()
    {
        $this->db->select('a.*, b.NISN, b.NamaSiswa, c.Kelas, d.TahunAjar, d.status');
        $this->db->from($this->table.' a'); 
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' D', 'a.'.$this->fk3.'= d.'.$this->fk3);
        return $this->db->get();
    }

    public function get_count()
    {
        $this->db->select('a.*, b.NISN, b.NamaSiswa, c.Kelas, d.TahunAjar, d.status');
        $this->db->from($this->table.' a'); 
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' D', 'a.'.$this->fk3.'= d.'.$this->fk3);
        $q = $this->db->get();
        return $q->num_rows();
    }

    public function get_from_kelas($v)
    {
        $idta = $this->TA_model->get_aktif_id();
        $this->db->select('a.*, b.NISN, b.NamaSiswa, c.Kelas, d.TahunAjar, d.status');
        $this->db->from($this->table.' a'); 
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' d', 'a.'.$this->fk3.'= d.'.$this->fk3);
        $this->db->where(array('c.'.$this->fk2 => $v, 'd.'.$this->fk3 => $idta));
        return $this->db->get();
    }

    public function get_from_kelas_laopran($v)
    {
        $idta = $this->TA_model->get_aktif_id();
        $this->db->select('*');
        $this->db->from($this->table.' a'); 
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' d', 'a.'.$this->fk3.'= d.'.$this->fk3);
        $this->db->where(array('c.'.$this->fk2 => $v, 'd.'.$this->fk3 => $idta));
        return $this->db->get();
    }

    public function get_all_data($v)
    {
        $idta = $this->TA_model->get_aktif_id();
        $this->db->select('*');
        $this->db->from($this->table.' a'); 
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' d', 'a.'.$this->fk3.'= d.'.$this->fk3);
        $this->db->where(array('a.'.$this->pk => $v, 'd.'.$this->fk3 => $idta));
        return $this->db->get();
    }

    public function get_data($id)
    {
        $this->db->where(array($this->fk1 => $id));
        return $this->db->get($this->join1);
    }

    public function cek_data($nis, $idta)
    {
        $this->db->where(array($this->fk3 => $idta, $this->fk1 => $nis));
        $q = $this->db->get($this->table);
        if($q->num_rows() > 0){
            $res = $q->result();
            foreach ($res as $row)
                $this->idmutasi = $row->idMutasi;
            return false;
        }else{
            return true;
        }
    }

    public function add($dada, $nis, $idk)
    {
        if($this->db->insert($this->join1, $dada)){
            $dm = array('nis' => $nis,
                        'idKelas' => $idk,
                        'idTahunAjar' => $this->TA_model->get_aktif_id(),
                        'tglMutasi' => date('Y-m-d'),
                         );
            return $this->db->insert($this->table, $dm);
        }else{
            return false;
        }
    }

    public function mutasi($dada)
    {
        return $this->db->insert($this->table, $dada);
    }

    public function update($data, $_id)
    {
        $this->db->set($data);
        $this->db->where($this->fk1, $_id);
        return $this->db->update($this->join1);
    }

    public function update_mutasi($data, $_id)
    {
        $this->db->set($data);
        $this->db->where($this->pk, $_id);
        return $this->db->update($this->table);
    }

    public function delete($isi)
    {
    	return $this->db->delete($this->join1, array($this->fk1 => $isi));
    }

}

?>
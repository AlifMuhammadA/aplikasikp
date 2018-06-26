<?php

class Walikelas_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    var $table = 'tblwalikelas';
    var $join1 = 'tblguru';
    var $join2 = 'tblkelas';
    var $join3 = 'tbltahunajar';

    var $pk = 'idWaliKelas';
    var $fk1 = 'NIP';
    var $fk2 = 'idKelas';
    var $fk3 = 'idTahunAjar';

    public function get_all()
    {
        $this->db->select('a.*, b.NamaGuru, c.Kelas, d.TahunAjar, d.status');
        $this->db->from($this->table.' a'); 
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' D', 'a.'.$this->fk3.'= d.'.$this->fk3);
        return $this->db->get();
    }

    public function cek_kelas($v)
    {
        $this->db->where('idKelas',$v);
        $q = $this->db->get($this->table);
        if($q->num_rows() > 0){
            return false;
        }else{
            return true;
        }
    }

    public function get_data($id)
    {
        $this->db->select('a.*, b.NamaGuru, c.Kelas, d.TahunAjar, d.status');
        $this->db->from($this->table.' a'); 
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' D', 'a.'.$this->fk3.'= d.'.$this->fk3);
        $this->db->where(array($this->pk => $id));
        return $this->db->get();
    }

    public function add($dada)
    {
        return $this->db->insert($this->table, $dada);
    }

    public function update($data, $_id)
    {
        $this->db->set($data);
        $this->db->where($this->pk, $_id);
        return $this->db->update($this->table);
    }

    public function delete($isi)
    {
    	return $this->db->delete($this->table, array($this->pk => $isi));
    }

    public function get_kelas($v='')
    {
        $this->db->select('a.*, b.NamaGuru, c.Kelas, d.TahunAjar, d.status');
        $this->db->from($this->table.' a'); 
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' D', 'a.'.$this->fk3.'= d.'.$this->fk3);
        $this->db->where('a.'.$this->fk1, $v);
        $q = $this->db->get();
        $res = $q->result();
        foreach ($res as $row) {
             $_SESSION['kelas'] = $row->idKelas;
             $_SESSION['nama_kelas'] = $row->Kelas;
             return $row->idKelas;
        }
        return ''; 
    }

}

?>
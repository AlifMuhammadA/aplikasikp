<?php

class Kelas_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    var $table = 'tblkelas';
    var $pk = 'idKelas';

    public function get_all()
    {
        return $this->db->get($this->table);
    }

    public function get_data($id)
    {
        $this->db->where(array($this->pk => $id));
        return $this->db->get($this->table);
    }

    public function get_kelas($id)
    {
        $this->db->where(array($this->pk => $id));
        $q = $this->db->get($this->table);
        $res = $q->result();
        foreach ($res as $r) {
            return $r->Kelas;
        }
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

}

?>
<?php

class TA_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    var $table = 'tbltahunajar';
    var $pk = 'idTahunAjar';

    public function get_all()
    {
        return $this->db->get($this->table);
    }

    public function get_data($id)
    {
        $this->db->where(array($this->pk => $id));
        return $this->db->get($this->table);
    }

    public function get_status($v)
    {
        if($v==1){
            return '<code class="code-sts bg-success">Aktif</code>';
        }else{
            return '<code class="code-sts bg-danger">Tidak Aktif</code>';
        }
    }

    public function set_aktif($v)
    {
        $this->db->set('status',0);
        $this->db->update($this->table);

        $this->db->set('status',1);
        $this->db->where($this->pk, $v);
        return $this->db->update($this->table);
    }

    public function get_aktif()
    {
        $this->db->where('status',1);
        $q = $this->db->get($this->table);
        $res = $q->result();
        foreach ($res as $row){
            return $row->TahunAjar;
        }
    }

    public function get_aktif_id()
    {
        $this->db->where('status',1);
        $q = $this->db->get($this->table);
        $res = $q->result();
        foreach ($res as $row){
            return $row->idTahunAjar;
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
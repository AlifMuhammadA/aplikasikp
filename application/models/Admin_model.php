<?php

class Admin_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    var $table = 'tbladmin';
    var $pk = 'username';

    public function get_all()
    {
        return $this->db->get($this->table);
    }

    public function get_data($id)
    {
        $this->db->where(array($this->pk => $id));
        return $this->db->get($this->table);
    }

    public function get_nama($v)
    {
        $this->db->where(array($this->pk => $v));
        $q =  $this->db->get($this->table);
        $res = $q->result();
        foreach ($res as $key) {
            return $key->username;
        }
    }

    public function login($dada)
    {
        $this->db->where($dada);
        $q =  $this->db->get($this->table);
        if($q->num_rows() > 0){
            $res = $q->result();
            foreach ($res as $key) {
                $_SESSION['admin'] = $key->username;
            }
            return true;
        }else{
            return false;
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
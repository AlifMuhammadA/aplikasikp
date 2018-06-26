<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matpel_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    var $table = 'tblmatapelajaran';
    var $pk = 'idMatapelajaran';

    public function get_all()
    {
        return $this->db->get($this->table);
    }

    public function get_data($id)
    {
        $this->db->where(array($this->pk => $id));
        return $this->db->get($this->table);
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

    public function get_name($v='')
    {
        $this->db->where(array($this->pk => $v));
        $q = $this->db->get($this->table);
        $res = $q->result();
        foreach ($res as $row) {
            return $row->mata_pelajaran;
        }
        return '';
    }

}

/* End of file matpel_model.php */
/* Location: ./application/views/admin_view/matpel_model.php */
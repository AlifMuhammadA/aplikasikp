<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    var $table = 'tblkurikulum';
    var $join = 'tblmatapelajaran';
    var $pk = 'idKurikulum';
    var $fk = 'idMatapelajaran';


    public function get_all()
    {
        return $this->db->get($this->table);
    }

    public function get_where($id)
    {
        $this->db->select('*');
        $this->db->from($this->table.' a');
        $this->db->join($this->join.' b', 'a.'.$this->fk.' = b.'.$this->fk);
        $this->db->where($id);
        return $this->db->get();
    }

    public function cek_mapel($w='')
    {
        $this->db->where($w);
        $q = $this->db->get($this->table);
        $res = $q->result();
        if($q->num_rows() > 0){    
            $i=0;
            foreach ($res as $row) {
                $hsl[$i] = $row->idMatapelajaran;
                $i++; 
            }
            return $hsl;
        }else{
            return '0';
        }
    }

    public function cek_data($w='')
    {
        $this->db->where($w);
        $q = $this->db->get($this->table);
        $res = $q->result();
        if($q->num_rows() > 0){    
            foreach ($res as $row) {
                return $row->idMatapelajaran;
            }
        }else{
            return '0';
        }
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
    	return $this->db->delete($this->table, $isi);
    }



    public function get_name($id)
    {
        $this->db->select('*');
        $this->db->from($this->table.' a');
        $this->db->join($this->join.' b', 'a.'.$this->fk.' = b.'.$this->fk);
        $this->db->where($this->pk, $id);
        $q = $this->db->get();
        $res = $q->result();
        foreach ($res as $row) {
            return $row->mata_pelajaran;
        }
        return '';
    }
}

/* End of file Kurikulum_model.php */
/* Location: ./application/models/Kurikulum_model.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NIlai_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    var $table = 'tblnilai';
    var $join1 = 'tblmutasi';
    var $join2 = 'tblsiswa';
    var $join3 = 'tblkelas';
    var $join4 = 'tblkurikulum';
    var $join5 = 'tblmatapelajaran';
    var $pk = 'idNilai';
    var $fk1 = 'idMutasi';
    var $fk2 = 'nis';
    var $fk3 = 'idKelas';
    var $fk4 = 'idKurikulum';
    var $fk5 = 'idMatapelajaran';

    public function get_matpel_max()
    {
        $query = "SELECT 
                    d.idKelas, 
                    d.Kelas, 
                    f.mata_pelajaran,
                    c.NamaSiswa, 
                    ((a.tugas * 0.4) + (a.uts * 0.3) + (a.uas * 0.3)) as Nilai 
                FROM tblnilai a
                JOIN tblmutasi b ON a.idMutasi = b.idMutasi
                JOIN tblsiswa c ON b.nis = c.nis
                JOIN tblkelas   d ON b.idKelas = d.idKelas
                JOIN tblkurikulum e ON a.idKurikulum = e.idKurikulum
                JOIN tblmatapelajaran f ON e.idMatapelajaran = f.idMatapelajaran
                WHERE ((a.tugas * 0.4) + (a.uts * 0.3) + (a.uas * 0.3)) = 
                (
                    SELECT 
                        MAX((z.tugas * 0.4) + (z.uts * 0.3) + (z.uas * 0.3)) as Nilai
                    FROM tblnilai z
                    JOIN tblmutasi w ON z.idMutasi = w.idMutasi
                    WHERE z.idKurikulum = a.idKurikulum
                    GROUP BY z.idKurikulum 
                )
                GROUP BY f.idMatapelajaran";
        return $this->db->query($query); 
    }


    public function get_matpel_min()
    {
        
        $query = "SELECT 
                    d.idKelas, 
                    d.Kelas, 
                    f.mata_pelajaran,
                    c.NamaSiswa, 
                    ((a.tugas * 0.4) + (a.uts * 0.3) + (a.uas * 0.3)) as Nilai 
                FROM tblnilai a
                JOIN tblmutasi b ON a.idMutasi = b.idMutasi
                JOIN tblsiswa c ON b.nis = c.nis
                JOIN tblkelas   d ON b.idKelas = d.idKelas
                JOIN tblkurikulum e ON a.idKurikulum = e.idKurikulum
                JOIN tblmatapelajaran f ON e.idMatapelajaran = f.idMatapelajaran
                WHERE ((a.tugas * 0.4) + (a.uts * 0.3) + (a.uas * 0.3)) = 
                (
                    SELECT 
                        MIN((z.tugas * 0.4) + (z.uts * 0.3) + (z.uas * 0.3)) as Nilai
                    FROM tblnilai z
                    JOIN tblmutasi w ON z.idMutasi = w.idMutasi
                    WHERE z.idKurikulum = a.idKurikulum
                    GROUP BY z.idKurikulum 
                )
                GROUP BY f.idMatapelajaran";
        return $this->db->query($query); 
    }

    public function get_all()
    {
        return $this->db->get($this->table);
    }

    public function get_where($id)
    {
        $this->db->where($id);
        return $this->db->get($this->table);
    }

    public function cek_nilai($idm, $idk)
    {
        $this->db->where(array('idMutasi' => $idm,'idKurikulum' => $idk ));
        $q =  $this->db->get($this->table);
        if($q->num_rows() > 0){    
            $res = $q->result();
            foreach ($res as $row) {
                return $row->idNilai;
            }
        }else{
            return 0;
        } 
    }

    public function get_nilai($sel, $idm, $idk)
    {
        $this->db->select($sel);
        $this->db->where(array('idMutasi' => $idm, 'idKurikulum' => $idk ));
        $q = $this->db->get($this->table);
        $res = $q->result();
        if($q->num_rows() > 0){    
            foreach ($res as $row) {
                return $row->$sel;
            }
        }else{
            return '0';
        }

    }

    public function cek_sts_nilai($idm)
    {
        $this->db->select("*");
        $this->db->where(array('idMutasi' => $idm ));
        $q = $this->db->get($this->table);
        $res = $q->result();
        if($q->num_rows() > 0){    
            return true;
        }else{
            return false;
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
    	return $this->db->delete($this->table, array($this->pk => $isi));
    }
}

/* End of file NIlai_model.php */
/* Location: ./application/models/NIlai_model.php */
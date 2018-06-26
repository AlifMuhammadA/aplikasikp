<?php

class Absen_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    var $table = 'tblkehadiran';
    var $pk = 'idKehadiran';


    var $join  = 'tblmutasi';
    var $join1 = 'tblsiswa';
    var $join2 = 'tblkelas';
    var $join3 = 'tbltahunajar';

    var $fk  = 'idMutasi';
    var $fk1 = 'nis';
    var $fk2 = 'idKelas';
    var $fk3 = 'idTahunAjar';

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from($this->table.' e'); 
        $this->db->join($this->join.' a', 'e.'.$this->fk.'= a.'.$this->fk);
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' d', 'a.'.$this->fk3.'= d.'.$this->fk3);
        return $this->db->get();
    }

    public function get_data($id)
    {
        $this->db->select('*');
        $this->db->from($this->table.' e'); 
        $this->db->join($this->join.' a', 'e.'.$this->fk.'= a.'.$this->fk);
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' d', 'a.'.$this->fk3.'= d.'.$this->fk3);
        $this->db->where(array('e.'.$this->pk => $id));
        return $this->db->get();
    }

    public function get_data_from_kelas($id)
    {
        $this->db->select('*');
        $this->db->from($this->table.' e'); 
        $this->db->join($this->join.' a', 'e.'.$this->fk.'= a.'.$this->fk);
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' d', 'a.'.$this->fk3.'= d.'.$this->fk3);
        $this->db->where(array('a.'.$this->fk2 => $id));
        return $this->db->get();
    }

    public function get_data_kelastgl($id, $tgl)
    {
        $this->db->select('*');
        $this->db->from($this->table.' e'); 
        $this->db->join($this->join.' a', 'e.'.$this->fk.'= a.'.$this->fk);
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' d', 'a.'.$this->fk3.'= d.'.$this->fk3);
        $this->db->where(array('a.'.$this->fk2 => $id, 'e.tanggal' => $tgl));
        return $this->db->get();
    }

    public function get_data_siswatgl($id, $tgl)
    {
        $this->db->select('*');
        $this->db->from($this->table.' e'); 
        $this->db->join($this->join.' a', 'e.'.$this->fk.'= a.'.$this->fk);
        $this->db->join($this->join1.' b', 'a.'.$this->fk1.'= b.'.$this->fk1);
        $this->db->join($this->join2.' c', 'a.'.$this->fk2.'= c.'.$this->fk2);
        $this->db->join($this->join3.' d', 'a.'.$this->fk3.'= d.'.$this->fk3);
        $this->db->where(array('a.'.$this->fk => $id, 'e.tanggal' => $tgl));
        return $this->db->get();
    }

    public function get_data_jumlah($id)
    {
        $sql = "SELECT c.NamaSiswa, a.idMutasi ,e.Kelas, COUNT(a.keterangan) AS jumlah FROM tblkehadiran a";
        $sql = $sql." LEFT JOIN (tblmutasi b JOIN tblsiswa c ON b.NIS = c.nis)";
        $sql = $sql." JOIN tblkelas e ON b.idKelas= e.idKelas";
        $sql = $sql." JOIN tbltahunajar d ON b.idTahunAjar= d.idTahunAjar";
        $sql = $sql." ON a.idMutasi = b.idMutasi";
        $sql = $sql." WHERE a.keterangan = '$id' AND d.status = 1";
        $sql = $sql." GROUP BY a.idMutasi";
        $sql = $sql." HAVING COUNT(a.keterangan)>=3";
        $sql = $sql." ORDER BY jumlah DESC";
        return $this->db->query($sql);
        
    }

    public function get_jml($v)
    {
        $this->db->where($v);
        $q = $this->db->get($this->table);
        return $q->num_rows();
    }

    public function cek_absen($id)
    {
        $this->db->select('*');
        $this->db->from($this->table.' a'); 
        $this->db->join('tblMutasi b', 'a.idMutasi= b.idMutasi');
        $this->db->where(array('idKelas' => $id, 'tanggal' => date('Y-m-d')));
        $q = $this->db->get();
        if($q->num_rows() > 0){
            return false;
        }else{
            return true;
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
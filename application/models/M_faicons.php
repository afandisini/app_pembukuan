<?php
/**
 * Models     : Font Awesome serverside based php
 * Modified   : Afan Hermawan
 * Website    : https://flashretail.y.id/
 * 
 * 
 * 
 * 
 */
class M_faicons extends CI_Model{

    function tampil_faicons(){
		$hsl=$this->db->query("SELECT * FROM tbl_faicon order by fa_id desc");
		return $hsl;
	}

    function hapus_faicons($fid){
		$hsl=$this->db->query("DELETE FROM tbl_faicon where fa_id='$fid'");
		return $hsl;
	}

    function update_faicons($fid,$fnm,$fkod){
		$hsl=$this->db->query("UPDATE tbl_faicon SET fa_nama='$fnm',fa_kode='$fkod' WHERE fa_id='$fid'");
		return $hsl;
	}

    function simpan_faicons($fid,$fnm,$fkod){
		$hsl=$this->db->query("INSERT INTO tbl_faicon(fa_id,fa_nama,fa_kode) VALUES ('$fid','$fnm','$fkod')");
		return $hsl;
	}

	function get_fid(){
		$q = $this->db->query("SELECT MAX(RIGHT(fa_id,6)) AS kd_max FROM tbl_faicon");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        return "FA".$kd;
	}

}
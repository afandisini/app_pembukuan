<?php
/**
 * Models     : Kategori serverside based php
 * Modified   : Afan Hermawan
 * Website    : https://flashretail.y.id/
 * 
 * 
 * 
 * 
 */
class M_kategori extends CI_Model{

	function hapus_kategori($kode){
		$hsl=$this->db->query("DELETE FROM tbl_kategori where kategori_id='$kode'");
		return $hsl;
	}

	function update_kategori($kode,$kat){
		$hsl=$this->db->query("UPDATE tbl_kategori set kategori_nama='$kat' where kategori_id='$kode'");
		return $hsl;
	}

	function tampil_kegiatan(){
		$hsl=$this->db->query('SELECT * FROM tbl_kegiatan ORDER BY keg_nama desc');
		return $hsl;
	}

	function tampil_kategori(){
		$hsl=$this->db->query("SELECT * from tbl_kategori order by kategori_id desc");
		return $hsl;
	}

	function simpan_kategori($kat){
		$hsl=$this->db->query("INSERT INTO tbl_kategori(kategori_nama) VALUES ('$kat')");
		return $hsl;
	}

}
<?php
/**
 * Models     : Pengaturan based php
 * Modified   : Afan Hermawan
 * Website    : https://flashretail.y.id/
 * 
 * 
 * 
 * 
 */
class M_pengaturan extends CI_Model{

	function hapus_pengaturan($pid){
		$hsl=$this->db->query("DELETE FROM tbl_pengaturan where pengaturan_id='$pid'");
		return $hsl;
	}

	function update_pengaturan($pid,$pnm,$pfoo,$palt,$php,$plogo,$pkota,$pplus){
		$hsl=$this->db->query("UPDATE tbl_pengaturan SET pengaturan_nama='$pnm',pengaturan_foo='$pfoo',pengaturan_alt='$palt',pengaturan_hp='$php',pengaturan_logo='$plogo',pengaturan_kota='$pkota',pengaturan_plus='$pplus' WHERE pengaturan_id='$pid'");
		return $hsl;
	}

	function update_pengaturan_tnp_img($pid,$pnm,$pfoo,$palt,$php,$pkota,$pplus){
		$hsl=$this->db->query("UPDATE tbl_pengaturan SET pengaturan_nama='$pnm',pengaturan_foo='$pfoo',pengaturan_alt='$palt',pengaturan_hp='$php',pengaturan_kota='$pkota',pengaturan_plus='$pplus' WHERE pengaturan_id='$pid'");
		return $hsl;
	}

	function tampil_pengaturan(){
		$hsl=$this->db->query("SELECT * FROM tbl_pengaturan order by pengaturan_id desc");
		return $hsl;
	}

	function simpan_pengaturan($pid,$pnm,$pfoo,$palt,$php,$plogo,$pkota,$pplus){
		$hsl=$this->db->query("INSERT INTO tbl_pengaturan(pengaturan_id,pengaturan_nama,pengaturan_foo,pengaturan_alt,pengaturan_hp,pengaturan_logo,pengaturan_kota,pengaturan_plus) VALUES ('$pid','$pnm','$pfoo','$palt','$php','$plogo','$pkota','$pplus')");
		return $hsl;
	}

	function tampiltabel()
    {
       return $this->db->query("show tables")->result();
    }

}
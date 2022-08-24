<?php
/**
 * Models     : Cetak Nota serverside based php
 * Modified   : Afan Hermawan
 * Website    : https://flashretail.y.id/
 * 
 * 
 * 
 * 
 */
class M_cetaknota extends CI_Model{

	function hapus_cetaknota($cid){
		$hsl=$this->db->query("DELETE FROM tbl_cetaknota where cetaknota_id='$cid'");
		return $hsl;
	}
	

	function tampil_cetaknota(){
		$hsl=$this->db->query("SELECT * from tbl_cetaknota order by cetaknota_id desc");
		return $hsl;
	}

    function cetak($cid){
		$hsl=$this->db->query("SELECT * FROM tbl_cetaknota where cetaknota_id = '$cid' LIMIT 1");
		return $hsl->row_array();
	}

	function simpan_cetaknota($cid,$cpid,$cket,$nom,$kid,$tglc){
		$hsl=$this->db->query("INSERT INTO tbl_cetaknota(cetaknota_id,pelanggan_id,cetaknota_ket,nominal,kegiatan_id,tgl_cetak) VALUES ('$cid','$cpid','$cket','$nom','$kid','$tglc')");
		return $hsl;
	}

}
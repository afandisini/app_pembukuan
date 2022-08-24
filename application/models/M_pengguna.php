<?php
class M_pengguna extends CI_Model{
	function get_pengguna(){
		$hsl=$this->db->query("SELECT * FROM tbl_user");
		return $hsl;
	}
	function tambah_pengguna($nama,$username,$password,$level,$ufoto){
		$hsl=$this->db->query("INSERT INTO tbl_user(user_nama,user_username,user_password,user_level,user_status) VALUES ('$nama','$username',md5('$password'),'$level','1',$ufoto)");
		return $hsl;
	}
	function simpan_pengguna($nama,$username,$password,$level,$ufoto){
		$hsl=$this->db->query("INSERT INTO tbl_user(user_nama,user_username,user_password,user_level,user_status,user_foto) VALUES ('$nama','$username',md5('$password'),'$level','1',$ufoto)");
		return $hsl;
	}
	function update_pengguna_nopass($kode,$nama,$username,$level){
		$hsl=$this->db->query("UPDATE tbl_user SET user_nama='$nama',user_username='$username',user_level='$level' WHERE user_id='$kode'");
		return $hsl;
	}
	function update_pengguna($kode,$nama,$username,$password,$level,$ufoto){
		$hsl=$this->db->query("UPDATE tbl_user SET user_nama='$nama',user_username='$username',user_password=md5('$password'),user_level='$level',user_foto='$ufoto' WHERE user_id='$kode'");
		return $hsl;
	}

	function update_pengguna_tnp_img($kode,$nama,$username,$password,$level){
		$hsl=$this->db->query("UPDATE tbl_user SET user_nama='$nama',user_username='$username',user_password=md5('$password'),user_level='$level' WHERE user_id='$kode'");
		return $hsl;
	}

	function tampil_pengguna(){
		$hsl=$this->db->query("select * from tbl_user order by user_id desc");
		return $hsl;
	}

	function aktif($kode){
		$hsl=$this->db->query("UPDATE tbl_user SET user_status='1' WHERE user_id='$kode'");
		return $hsl;
	}
	function nonaktif($kode){
		$hsl=$this->db->query("UPDATE tbl_user SET user_status='0' WHERE user_id='$kode'");
		return $hsl;
	}
	function hapus_pengguna($kode){
		$hsl=$this->db->query("DELETE FROM tbl_user where user_id='$kode'");
		return $hsl;
	}
}
<?php
class M_penggunaan extends CI_Model{

	function hapus_retur($kode){
		$hsl=$this->db->query("DELETE FROM tbl_retur WHERE retur_id='$kode'");
		return $hsl;
	}

	function tampil_retur(){
		$hsl=$this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,(retur_harjul*retur_qty) AS retur_subtotal,retur_keterangan FROM tbl_retur ORDER BY retur_id DESC");
		return $hsl;
	}

	function simpan_retur($kobar,$nabar,$satuan,$harjul,$qty,$keterangan){
		$hsl=$this->db->query("INSERT INTO tbl_retur(retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,retur_keterangan) VALUES ('$kobar','$nabar','$satuan','$harjul','$qty','$keterangan')");
		return $hsl;
	}

	function simpan_penggunaan($nofak,$total,$jml_uang,$kembalian,$ppn,$keg_id){
		$idadmin=$this->session->userdata('idadmin');
		$this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan,ppn,jual_tanggal, keg_id) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','eceran','$ppn','".date('Y-m-d H:i:s')."','$keg_id')");
		
		$dt = $this->db->query('SELECT * FROM tbl_keranjang WHERE user_id = ? AND kasir = ?',
			array($this->session->userdata('idadmin'), 'Retail'))->result_array();

		foreach ($dt as $item) {
			$data=array(
				'd_jual_nofak' 			=>	$nofak,
				'd_jual_barang_id'		=>	$item['barang_id'],
				'd_jual_barang_nama'	=>	$item['name'],
				'd_jual_barang_satuan'	=>	$item['satuan'],
				'd_jual_barang_harpok'	=>	$item['harpok'],
				'd_jual_barang_harjul'	=>	$item['amount'],
				'd_jual_qty'			=>	$item['qty'],
				'd_jual_diskon'			=>	$item['disc'],
				'varian'				=> 	$item['varian'],
				'tgl_input'				=>  date('Y-m-d'),
				'kegiatan_id'			=> 	$item['kegiatan_id'],
				'd_jual_total'			=>	($item['amount'] * $item['qty']) - $item['disc']
			);
			$this->db->insert('tbl_detail_jual',$data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[barang_id]'");
			if($item['varian'] > 0)
			{
				$this->db->query("UPDATE tbl_barang_varian SET stok = stok-'$item[qty]' WHERE id = '$item[varian]'");
			}
		}
		return true;
	}


	function get_nofak(){
		$q = $this->db->query("SELECT MAX(RIGHT(jual_nofak,6)) AS kd_max FROM tbl_jual WHERE DATE(jual_tanggal)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        return date('dmy').$kd;
	}

	//=====================penggunaan grosir================================
	function simpan_penggunaan_grosir($nofak,$total,$jml_uang,$kembalian,$ppn,$kegiatan){
		$idadmin=$this->session->userdata('idadmin');
		$this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan,ppn,jual_tanggal,keg_id) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','grosir','$ppn','".date('Y-m-d H:i:s')."','$kegiatan')");
		
		$dt = $this->db->query('SELECT * FROM tbl_keranjang WHERE user_id = ? AND kasir = ?',
			array($this->session->userdata('idadmin'), 'Grosir'))->result_array();

		foreach ($dt as $item) {
			$data=array(
				'd_jual_nofak' 			=>	$nofak,
				'd_jual_barang_id'		=>	$item['barang_id'],
				'd_jual_barang_nama'	=>	$item['name'],
				'd_jual_barang_satuan'	=>	$item['satuan'],
				'd_jual_barang_harpok'	=>	$item['harpok'],
				'd_jual_barang_harjul'	=>	$item['amount'],
				'd_jual_qty'			=>	$item['qty'],
				'd_jual_diskon'			=>	$item['disc'],
				'varian'				=> 	$item['varian'],
				'tgl_input'				=>  date('Y-m-d'),
				'd_jual_total'			=>	($item['amount'] * $item['qty']) - $item['disc']
			);
			$this->db->insert('tbl_detail_jual',$data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[barang_id]'");
			// $this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
			if($item['varian'] > 0)
			{
				$this->db->query("UPDATE tbl_barang_varian SET stok = stok-'$item[qty]' WHERE id = '$item[varian]'");
			}
		}
		return true;
	}

	function cetak_faktur(){
		$nofak=$this->session->userdata('nofak');
		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d/%m/%Y %H:%i:%s') AS jual_tanggal,jual_total,jual_jml_uang,jual_kembalian,jual_keterangan,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE jual_nofak='$nofak'");
		return $hsl;
	}
	
}
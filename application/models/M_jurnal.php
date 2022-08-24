<?php
/**
 * Models     : Jurnal Akunting
 * Modified   : Afan Hermawan
 * Website    : https://www.flashretail.my.id/
 */

class M_jurnal extends CI_Model{
    function hapus_jurnal($jid){
        $hsl=$this->db->query("DELETE FROM tbl_jurnal WHERE jurnal_id='$jid'");
        return $hsl;
    }

    function jurnalList(){
        $hasil=$this->db->get('tbl_jurnal');
        return $hasil->result();
    }
    function tampil_jurnal_tmp(){
		$hsl=$this->db->query("SELECT jurnal_tmp_id,jurnal_tmp_nama,jurnal_tmp_ket,pelanggan_id,jurnal_tmp_masuk,jurnal_tmp_keluar,kegiatan,jurnal_tmp_tgl,kasir,user_id,keg_nama FROM tbl_jurnal_tmp JOIN tbl_kegiatan ON tbl_jurnal_tmp.kegiatan=tbl_kegiatan.keg_id JOIN tbl_pelanggan ON tbl_jurnal_tmp.pelanggan_id=tbl_pelanggan.id");
		return $hsl;
	}
    function simpanJurnal(){
        $data = array(				
                'jurnal_id' => $this->input->post('jurnal_id'), 
                'jurnal_nama'   => $this->input->post('jurnal_nama'), 
                'jurnal_ket'    => $this->input->post('jurnal_ket'), 
                'pelanggan_id'  => $this->input->post('pelanggan_id'), 
                'jurnal_masuk'  => $this->input->post('jurnal_masuk'),
                'jurnal_keluar' => $this->input->post('jurnal_keluar'),
                'kategori_id'   => $this->input->post('kategori_id'),
                'jumlah'   => $this->input->post('jumlah'),
                'satuan'   => $this->input->post('satuan'),
                'jurnal_tgl'    => $this->input->post('jurnal_tgl'), 
            );
        $result=$this->db->insert('tbl_jurnal',$data);
        return $result;
    }
    function updateJurnal(){
		$jid=$this->input->post('jurnal_id');
		$jnm=$this->input->post('jurnal_nama');
		$jket=$this->input->post('jurnal_ket');
		$jpid=$this->input->post('pelanggan_id');
		$jmsk=$this->input->post('jurnal_masuk');
		$jklr=$this->input->post('jurnal_keluar');
        $jkid=$this->input->post('kategori_id');
        $jjml=$this->input->post('jumlah');
        $jsat=$this->input->post('satuan');
        $jtgl=$this->input->post('jurnal_tgl');
		$this->db->set('jurnal_nama', $jnm);
		$this->db->set('jurnal_ket', $jket);
		$this->db->set('pelanggan_id', $jpid);
		$this->db->set('jurnal_masuk', $jmsk);
		$this->db->set('jurnal_keluar', $jklr);
        $this->db->set('kategori_id', $jkid);
        $this->db->set('jumlah', $jjml);
        $this->db->set('satuan', $jsat);
        $this->db->set('jurnal_tgl', $jtgl);
		$this->db->where('jurnal_id', $jid);
		$result=$this->db->update('tbl_jurnal');
		return $result;	
	}
	function hapusJurnal(){
		$jid=$this->input->post('jurnal_id');
		$this->db->where('jurnal_id', $jid);
		$result=$this->db->delete('tbl_jurnal');
		return $result;
	}	
}
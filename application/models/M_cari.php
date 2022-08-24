<?php
/**
 * Models     : Cari Kegiatan
 * Modified   : Afan Hermawan
 * Website    : https://www.flashretail.my.id/
 */

class M_cari  extends CI_Model{
  
  function cari_keg($kegnama){
    $this->db->like('keg_nama as text');
    $this->db->order_by('keg_nama', $kegnama);
    return $this->db->get('tbl_kegiatan')->result();
    }
  }
<?php
/**
 * Models     : Inputdata Pemasukan dan Pengeluaran
 * Modified   : Afan Hermawan
 * Website    : https://www.flashretail.my.id/
 */

    class M_inputdata extends CI_Model{
        public function HapusPembukuan(){
                $id = $this->input->post('id');
                $this->db->where('pembukuan_id', $id);
                return $this->db->delete('tbl_pembukuan');
        }

        function del_keg($kid){
            $hsl=$this->db->query("DELETE FROM tbl_kegiatan WHERE keg_id='$kid'");
            return $hsl;
        }

        function tampil_kegiatan(){
            $hsl=$this->db->query("SELECT * FROM tbl_kegiatan ORDER BY keg_id DESC");
            return $hsl;
        }

        function tampil_pembukuan(){
            $hsl=$this->db->query("SELECT * FROM tbl_pembukuan LEFT JOIN tbl_pelanggan ON tbl_pembukuan.pelanggan_id=tbl_pelanggan.id LEFT JOIN tbl_kegiatan ON tbl_pembukuan.kegiatan=tbl_kegiatan.keg_id ORDER BY pembukuan_id DESC");
            return $hsl;
        }

        function tambah_debet($aid,$anama,$aket,$mpid,$amas,$akel,$mkegid,$mtgl){
            $user_id=$this->session->userdata('idadmin');
            $hsl = $this->db->query("INSERT INTO tbl_pembukuan (pembukuan_id,pembukuan_nama,pembukuan_ket,pelanggan_id,pembukuan_masuk,pembukuan_keluar,kegiatan,pembukuan_tgl) VALUES ('$aid','$anama','$aket','$mpid','$amas','$akel','$mkegid','$mtgl')");
            return $hsl;
        }

        function ubah_debet($aid,$anama,$aket,$mpid,$amas,$akel,$mkegid,$mtgl){
            $user_id=$this->session->userdata('idadmin');
            $hsl = $this->db->query("UPDATE tbl_pembukuan SET pembukuan_id='$aid',pembukuan_nama='$anama',pembukuan_ket='$aket',pelanggan_id='$mpid',pembukuan_masuk='$amas',pembukuan_keluar='$akel',kegiatan='$mkegid',pembukuan_tgl='$mtgl'");
            return $hsl;
        }

        function total_debet(){
            $this->db->select_sum('pembukuan_masuk');
            $query = $this->db->get('tbl_pembukuan');
            if($query->num_rows()>0)
            {
                return $query->row()->pembukuan_masuk;
            }
            else
            {
                return 0;
            }
        }
        function total_kredit(){
            $this->db->select_sum('pembukuan_keluar');
            $query = $this->db->get('tbl_pembukuan');
            if($query->num_rows()>0)
            {
                return $query->row()->pembukuan_keluar;
            }
            else
            {
                return 0;
            }
        }

        function total_kegiatan(){
            $this->db->select('count(keg_nama) as tot_keg');
            $query = $this->db->get('tbl_kegiatan');
            if($query->num_rows()>0)
            {
                return $query->row()->tot_keg;
            }
            else
            {
                return 0;
            }
        }

        function get_pemasukan($paid){
            //$hsl=$this->db->query("SELECT * FROM tbl_barang where barang_id='$kobar'");
            $hsl=$this->db->get_where('tbl_pembukuan',['pembukuan_id' => $paid]);
            return $hsl;
        }

        function get_aid(){
            $q = $this->db->query("SELECT MAX(RIGHT(pembukuan_id,6)) AS kd_max FROM tbl_pembukuan");
            $kd = "";
            if($q->num_rows()>0){
                foreach($q->result() as $k){
                    $tmp = ((int)$k->kd_max)+1;
                    $kd = sprintf("%06s", $tmp);
                }
            }else{
                $kd = "000001";
            }
            return "IN".$kd;
        }
    }
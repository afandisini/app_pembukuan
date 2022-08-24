<?php
class Rekap extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_pengaturan');
        $this->load->model('m_cari');
        $this->load->helper('tgl_default');
	}

	function index(){
        if($this->session->userdata('akses')=='1'){
            $data['peng']=$this->m_pengaturan->tampil_pengaturan();
            $data['anama'] = $this->db->query("SELECT * FROM tbl_pembukuan ORDER BY pembukuan_nama ASC")->result();
            $data['rekanan'] = $this->db->query('SELECT * FROM tbl_pelanggan ORDER BY nama ASC')->result();
            $data['kegiatan'] = $this->db->query('SELECT * FROM tbl_kegiatan ORDER BY keg_nama ASC')->result();
            $data['menu']  = 'rekap';
            $data['nmpage']  = 'Rekapitulasi';
            $data['head']  = 'Rekapitulasi Perbulan dan Tahunan';
            $data['note'] = '<ol class="text-sm text-muted"><li>Transaksi Perbulan dan  Pertahun (<strong><span class="text-success">[Total Penjualan <i>(omset)</i> Per-Bulan + Pemasukan]</span> - <span class="text-danger">Pengeluaran</span></strong>)</li><li>Bisa Pilih Tahun Saja</li></ol>';
            $kegid = $this->input->get('keg_id');
            $data['brg_msk'] = $this->db->query("SELECT SUM(pembukuan_masuk) AS msk FROM tbl_pembukuan LEFT JOIN tbl_kegiatan ON tbl_pembukuan.kegiatan=tbl_kegiatan.keg_id WHERE tbl_pembukuan.kegiatan LIKE '%$kegid%'")->row();
            $data['brg_klr'] = $this->db->query("SELECT SUM(pembukuan_keluar) AS klr FROM tbl_pembukuan LEFT JOIN tbl_kegiatan ON tbl_pembukuan.kegiatan=tbl_kegiatan.keg_id WHERE tbl_pembukuan.kegiatan LIKE '%$kegid%'")->row();
            //$data['jual'] = $this->db->query("SELECT SUM(jual_total) AS jt FROM tbl_jual WHERE jual_tanggal LIKE '%$dt%'")->row();
            $data['masuk'] = $this->db->query("SELECT SUM(pembukuan_masuk) AS msk FROM tbl_pembukuan LEFT JOIN tbl_pelanggan ON tbl_pembukuan.pelanggan_id=tbl_pelanggan.id LEFT JOIN tbl_kegiatan ON tbl_pembukuan.kegiatan=tbl_kegiatan.keg_id WHERE tbl_pembukuan.kegiatan LIKE '%$kegid%'")->row();
            $data['keluar'] = $this->db->query("SELECT SUM(pembukuan_keluar) AS klr FROM tbl_pembukuan LEFT JOIN tbl_pelanggan ON tbl_pembukuan.pelanggan_id=tbl_pelanggan.id LEFT JOIN tbl_kegiatan ON tbl_pembukuan.kegiatan=tbl_kegiatan.keg_id WHERE tbl_pembukuan.kegiatan LIKE '%$kegid%'")->row();
            $data['anama'] = $this->db->query("SELECT * FROM tbl_pembukuan LEFT JOIN tbl_pelanggan ON tbl_pembukuan.pelanggan_id=tbl_pelanggan.id LEFT JOIN tbl_kegiatan ON tbl_pembukuan.kegiatan=tbl_kegiatan.keg_id WHERE tbl_pembukuan.kegiatan LIKE '%$kegid%'")->result();
            $url = base_url('admin/rekap/cetak?y='.$kegid);
            $data['url'] = $url;
            $this->load->view('admin/v_rekap',$data);
        }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function get_autocomplete(){
        $q = $this->input->get('q');
        echo json_encode($this->m_cari->cari_keg($q));
    }

    function reset(){
        $rst=$this->session->set_flashdata("ubah"," <strong>Reset</strong> Barang Berhasil ! ");
		echo $rst;
		redirect('admin/rekap');
	}

    function cetak(){
        if($this->session->userdata('akses')=='1'){
            $data['peng']=$this->m_pengaturan->tampil_pengaturan();
            $data['nmpage']  = 'Rekapitulasi';
            $data['head']  = 'Rekapitulasi Perbulan dan Tahunan';
            $m = $this->input->get('m');
            $y = $this->input->get('y');
            if(!empty($m) && !empty($y)){
                $dt = $y.'-'.$m;
                $data['periode'] = 'Periode Bulan '.bln($m).' '.$y;
                //$data['jual'] = $this->db->query("SELECT SUM(jual_total) AS jt FROM tbl_jual WHERE jual_tanggal LIKE '%$dt%'")->row();
                $data['masuk'] = $this->db->query("SELECT SUM(pembukuan_masuk) AS msk FROM tbl_pembukuan WHERE pembukuan_tgl LIKE '%$dt%'")->row();
                $data['keluar'] = $this->db->query("SELECT SUM(pembukuan_keluar) AS klr FROM tbl_pembukuan WHERE pembukuan_tgl LIKE '%$dt%'")->row();
                $url = base_url('admin/rekap/cetak?y='.$y.'&m='.$m);
            } else if(!empty($y)){
                $dt = $y;
                $data['periode'] = 'Periode Tahun '.$y;
                //$data['jual'] = $this->db->query("SELECT SUM(jual_total) AS jt FROM tbl_jual WHERE YEAR(jual_tanggal)='$dt'")->row();
                $data['masuk'] = $this->db->query("SELECT SUM(pembukuan_masuk) AS msk FROM tbl_pembukuan WHERE YEAR(pembukuan_tgl)='$dt'")->row();
                $data['keluar'] = $this->db->query("SELECT SUM(pembukuan_keluar) AS klr FROM tbl_pembukuan WHERE YEAR(pembukuan_tgl)='$dt'")->row();
                $url = base_url('admin/rekap/cetak?y='.$y);
            }else{
                $data['periode'] = '';
                $url = base_url('admin/rekap/cetak');
            }
            $data['url'] = $url;
            $this->load->view('admin/v_cetak_rekap',$data);
        }else{
            echo "Halaman tidak ditemukan";
        }
    }
}
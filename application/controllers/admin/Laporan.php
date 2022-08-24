<?php
class Laporan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_suplier');
		$this->load->model('m_pembelian');
		$this->load->model('m_penjualan');
		$this->load->model('m_laporan');
		$this->load->model('m_pengaturan');
	}
	function index(){
	if($this->session->userdata('akses')=='1'){
		$data['data']=$this->m_barang->tampil_barang();
		$data['peng']=$this->m_pengaturan->tampil_pengaturan();
		$data['kat']=$this->m_kategori->tampil_kategori();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$data['jual_thn']=$this->m_laporan->get_tahun_jual();
		$data['menu'] = 'laporan';
		$data['nmpage']  = 'Laporan';
		$this->load->view('admin/v_laporan',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function lap_stok_barang(){
		$x['peng']=$this->m_pengaturan->tampil_pengaturan();
		$x['data']=$this->m_laporan->get_stok_barang();
		$this->load->view('admin/laporan/v_lap_stok_barang',$x);
	}
	function lap_data_barang(){
		$x['peng']=$this->m_pengaturan->tampil_pengaturan();
		$x['data']=$this->m_laporan->get_data_barang();
		$x['nmpage']  = 'Laporan Data Barang';
		$this->load->view('admin/laporan/v_lap_barang',$x);
	}
	function lap_data_penjualan(){
		$x['peng']=$this->m_pengaturan->tampil_pengaturan();
		$x['nmpage']  = 'Laporan Data Penjualan';
		$x['data']=$this->m_laporan->get_data_penjualan();
		$x['jml']=$this->m_laporan->get_total_penjualan();
		$this->load->view('admin/laporan/v_lap_penjualan',$x);
	}
	function lap_penjualan_pertanggal(){
		$x['peng']=$this->m_pengaturan->tampil_pengaturan();
		$tanggal=$this->input->post('tgl');
		$x['jml']=$this->m_laporan->get_data__total_jual_pertanggal($tanggal);
		$x['data']=$this->m_laporan->get_data_jual_pertanggal($tanggal);
		$x['nmpage']  = 'Laporan Penjualan Per Taggal';
		$this->load->view('admin/laporan/v_lap_jual_pertanggal',$x);
	}
	function lap_penjualan_perbulan(){
		$x['peng']=$this->m_pengaturan->tampil_pengaturan();
		$bulan=$this->input->post('bln');
		$x['jml']=$this->m_laporan->get_total_jual_perbulan($bulan);
		$x['data']=$this->m_laporan->get_jual_perbulan($bulan);
		$x['nmpage']  = 'Laporan Penjualan Perbulan';
		$this->load->view('admin/laporan/v_lap_jual_perbulan',$x);
	}
	function lap_penjualan_pertahun(){
		$x['peng']=$this->m_pengaturan->tampil_pengaturan();
		$tahun=$this->input->post('thn');
		$x['jml']=$this->m_laporan->get_total_jual_pertahun($tahun);
		$x['data']=$this->m_laporan->get_jual_pertahun($tahun);
		$x['nmpage']  = 'Laporan Penjualan Pertahun';
		$this->load->view('admin/laporan/v_lap_jual_pertahun',$x);
	}
	function lap_laba_rugi(){
		$x['peng']=$this->m_pengaturan->tampil_pengaturan();
		$bulan=$this->input->post('bln');
		$x['jml']=$this->m_laporan->get_total_lap_laba_rugi($bulan);
		$x['data']=$this->m_laporan->get_lap_laba_rugi($bulan);
		$x['nmpage']  = 'Laporan Rugi Laba';
		$this->load->view('admin/laporan/v_lap_laba_rugi',$x);
	}
	function lap_rugi_laba(){
		$x['peng']=$this->m_pengaturan->tampil_pengaturan();
		$bulan=$this->input->post('bln');
		$x['jml']=$this->m_laporan->get_total_lap_laba_rugi($bulan);
		$x['data']=$this->m_laporan->get_lap_laba_rugi($bulan);
		$x['nmpage']  = 'Laporan Rugi Laba';
		$this->load->view('admin/v_rekap',$x);
	}
}
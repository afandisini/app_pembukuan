<?php
class Welcome extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_pengguna');
		$this->load->model('m_pengaturan');
		$this->load->model('m_laporan');
		$this->load->model('m_barang');
		$this->load->model('m_grafik');
		$this->load->model('m_kategori');
	}
	
	function index(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$data['kat']=$this->m_kategori->tampil_kategori();
			$data['peng']=$this->m_pengaturan->tampil_pengaturan();
			$data['usr']=$this->m_pengguna->tampil_pengguna();
			$data['lap']=$this->m_laporan->get_data_jual_pertanggal(date('Y-m-d'));
			$data['tlap']=$this->m_laporan->get_data__total_jual_pertanggal(date('Y-m-d'));
			$data['data']=$this->m_barang->tampil_barang();
			$data['stok']=$this->m_grafik->statistik_stok();
			$data['jml_jual']=$this->m_grafik->jual_brg();
			$data['menu']  = 'dasbor';
			$data['nmpage']  = 'Dasbor';
			$this->load->view('admin/v_index',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}	
	}

	
}
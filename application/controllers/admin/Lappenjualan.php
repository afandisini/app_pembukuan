<?php
class Lappenjualan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_suplier');
		$this->load->model('m_laporan');
		$this->load->model('m_pengaturan');
	}
	function index(){
		if($this->session->userdata('akses')=='1'){
            $data['peng']=$this->m_pengaturan->tampil_pengaturan();
            $data['tlap']=$this->m_laporan->cetakulang();
		    $data['jml']=$this->m_laporan->get_total_penjualan();
			$data['menu']  = 'lapjual';
			$data['nmpage']  = 'Transaksi Penjualan';
            $data['tbl']  = 'Daftar Transaksi Penjualan';
			$this->load->view('admin/v_lappenjualan',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
    function trx()
	{	$query  = "SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d/%M/%Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,varian,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak";
		$search = array('jual_nofak','jual_tanggal','jual_total','d_jual_barang_id','d_jual_barang_nama','d_jual_barang_satuan','d_jual_barang_harpok','d_jual_barang_harjul','d_jual_qty','d_jual_diskon','varian','d_jual_total','d_jual_nofak');
		$where  = null;
		$isWhere = null;
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

}
<?php
class Kategori extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_pengaturan'); 
	}
	function index(){
		if($this->session->userdata('akses')=='1'){
			$data['peng']=$this->m_pengaturan->tampil_pengaturan();
			$data['data']=$this->m_kategori->tampil_kategori();
			$data['menu'] = 'kategori';
			$data['nmpage']  = 'Kategori';
			$this->load->view('admin/v_kategori',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function data(){
        $query  = "SELECT kategori_id,kategori_nama FROM tbl_kategori";
		$search = array('kategori_id','kategori_nama');
		header('Content-Type: application/json');
        $where  = null;
        $isWhere = null;
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

	function tambah_kategori(){
		if($this->session->userdata('akses')=='1'){
			$kat=$this->input->post('kategori');
			$this->m_kategori->simpan_kategori($kat);
			echo $this->session->set_flashdata("berhasil"," <strong>$kat</strong> Berhasil diambah ! ");
			redirect('admin/kategori');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function edit_kategori(){
		if($this->session->userdata('akses')=='1'){
			$kode=$this->input->post('kode');
			$kat=$this->input->post('kategori');
			$this->m_kategori->update_kategori($kode,$kat);
			echo $this->session->set_flashdata("ubah"," <strong>$kat</strong> Berhasil diambah ! ");
			redirect('admin/kategori');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	
	function hapus_kategori(){
		if($this->session->userdata('akses')=='1'){
			$kode=$this->input->post('kode');
			$this->m_kategori->hapus_kategori($kode);
			echo $this->session->set_flashdata("hapus"," <strong>Data</strong> Berhasil dihapus ! ");
			redirect('admin/kategori');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}
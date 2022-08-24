<?php
class Faicons extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_faicons');
		$this->load->model('m_pengaturan'); 
	}
	function index(){
		if($this->session->userdata('akses')=='1'){
			$data['peng']=$this->m_pengaturan->tampil_pengaturan();
			$data['data']=$this->m_faicons->tampil_faicons();
			$data['menu'] = 'Faicons';
			$data['nmpage']  = 'faicons';
			$this->load->view('admin/v_faicons',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function data(){
        $query  = "SELECT fa_id,fa_nama,fa_kode FROM tbl_faicon";
		$search = array('fa_id','fa_nama','fa_kode');
		$where  = null; $isWhere = null;
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

	function tambah_faicons(){
		if($this->session->userdata('akses')=='1'){
			$fid=$this->m_faicons->get_fid();
			$fnm=$this->input->post('fnm');
            $fkod=$this->input->post('fkod');
			$this->m_faicons->simpan_faicons($fid,$fnm,$fkod);
			echo $this->session->set_flashdata("berhasil"," <strong>$fnm</strong> Berhasil diambah ! ");
			redirect('admin/faicons');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function update_faicons(){
		if($this->session->userdata('akses')=='1'){
			$fid=$this->input->post('fid');
			$fnm=$this->input->post('fnm');
            $fkod=$this->input->post('fkod');
			$this->m_faicons->update_faicons($fid,$fnm,$fkod);
			echo $this->session->set_flashdata("ubah"," <strong>$fnm</strong> Berhasil diubah ! ");
			redirect('admin/faicons');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	
	function hapus_faicons(){
		if($this->session->userdata('akses')=='1'){
			$fid=$this->input->post('fid');
			$this->m_faicons->hapus_faicons($fid);
			echo $this->session->set_flashdata("hapus"," <strong>Data</strong> Berhasil dihapus ! ");
			redirect('admin/faicons');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}
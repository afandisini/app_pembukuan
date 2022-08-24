<?php
class Cetaknota extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
        $this->load->model('m_cetaknota');
		$this->load->model('m_pengaturan');
		$this->load->helper('tgl_default');
			
	}
	function index(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$data['peng']=$this->m_pengaturan->tampil_pengaturan();
            $data['cetaknota']=$this->m_cetaknota->tampil_cetaknota();
			$data['menu'] = 'cetaknota';
			$data['nmpage']  = 'Cetak Nota';
            $data['info'] = 'Cetak Nota <small>(Pra-Cetak)</small>';
			$this->load->view('admin/v_cetaknota',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

    function tambah_cetaknota(){
		
		$this->form_validation->set_rules("no_nota", "NoNota", "required");
		$this->form_validation->set_rules("pelanggan_id", "Rekan", "required");
		$this->form_validation->set_rules("cetaknota_ket", "Keterangan", "required");
		$this->form_validation->set_rules("nominal", "Debet", "required");
		$this->form_validation->set_rules("nominal2", "Kredit", "required");
		$this->form_validation->set_rules("kegiatan_id", "Kegiatan", "required");
		if($this->form_validation->run() != false) {
			$data = [
				'no_nota'  => htmlspecialchars($this->input->post("no_nota", TRUE) ,ENT_QUOTES),
				'pelanggan_id' => htmlspecialchars($this->input->post("pelanggan_id", TRUE) ,ENT_QUOTES),
				'cetaknota_ket' => htmlspecialchars($this->input->post("cetaknota_ket", TRUE) ,ENT_QUOTES),
				'nominal' => htmlspecialchars($this->input->post("nominal", TRUE) ,ENT_QUOTES),
				'nominal2' => htmlspecialchars($this->input->post("nominal2", TRUE) ,ENT_QUOTES),
				'kegiatan_id' => htmlspecialchars($this->input->post("kegiatan_id", TRUE) ,ENT_QUOTES)
			];

			$this->db->insert("tbl_cetaknota", $data);
			$this->session->set_flashdata("success"," Berhasil Tambah <strong>Data</strong>! ");
			if($this->input->get('kasir') == 'retail'){
				redirect(base_url("admin/cetaknota"));
			}else{
				redirect(base_url("admin/cetaknota"));
			}
		}else{
			$this->session->set_flashdata("failed"," Gagal Tambah <strong>Data</strong>! ".validation_errors());
			redirect(base_url("admin/cetaknota"));
		}

	}

	function catatan(){
		
		$this->form_validation->set_rules("catatan", "Catatan");
		$this->form_validation->set_rules("cetaknota_id", "ID", "required");
		if($this->form_validation->run() != false) {
			$data = [
				'catatan' => htmlspecialchars($this->input->post("catatan", TRUE) ,ENT_QUOTES)
			];

			$this->db->where('cetaknota_id', (int)$this->input->post('cetaknota_id'));
			$this->db->update("tbl_cetaknota", $data);
			$this->session->set_flashdata("success"," Berhasil Tambah <strong>Catatan</strong>! ");
			if($this->input->get('kasir') == 'retail'){
				redirect(base_url("admin/cetaknota"));
			}else{
				redirect(base_url("admin/cetaknota"));
			}
		}else{
			$this->session->set_flashdata("failed"," Gagal Tambah <strong>Catatan</strong>! ".validation_errors());
			redirect(base_url("admin/cetaknota"));
		}

	}

	function data(){
        $query  = "SELECT * FROM tbl_cetaknota LEFT JOIN tbl_pelanggan ON tbl_cetaknota.pelanggan_id=tbl_pelanggan.id LEFT JOIN tbl_kegiatan ON tbl_cetaknota.kegiatan_id=tbl_kegiatan.keg_id";
		$search = array('cetaknota_id','no_nota','pelanggan_id','cetaknota_ket','nominal','nominal2','tgl_cetak','nama','keg_nama');
		header('Content-Type: application/json');
        $where  = null;
        $isWhere = null;
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

    function cetak(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$peng=$this->m_pengaturan->tampil_pengaturan();
			$query  = "SELECT * FROM tbl_cetaknota LEFT JOIN tbl_pelanggan ON tbl_cetaknota.pelanggan_id=tbl_pelanggan.id LEFT JOIN tbl_kegiatan ON tbl_cetaknota.kegiatan_id=tbl_kegiatan.keg_id";
            $kid=$this->input->get('A4');
            $x['a'] = $this->db->query($query.' WHERE cetaknota_id = ?',[$kid])->row_array();
            $x['print']=$this->m_cetaknota->cetak($kid);
            $x['peng']=$this->m_pengaturan->tampil_pengaturan();
			$x['menu'] = 'cetakkuasa';
            $url = base_url('admin/cetaknota/cetak?A4='.$kid);
			$nmpage = "Cetak Nota";
			$x['nmpage'] = $nmpage;
			$x['peng'] = $peng;
            $x['url'] = $url;
			$this->load->view('admin/v_printnota',$x);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	
    function hapus_cetaknota(){
    	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$cid=$this->input->post('cid');
    		$this->m_cetaknota->hapus_cetaknota($cid);
			$this->session->set_flashdata("hapus"," <strong>Data</strong> berhasil dihapus ! ");
    		redirect('admin/cetaknota');
    	}else{
    		echo "Halaman tidak ditemukan";
    	}
    }

}
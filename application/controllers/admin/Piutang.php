<?php
class Piutang extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_pengguna');
		$this->load->model('m_pengaturan');
	}
	
	function index(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$data['peng']=$this->m_pengaturan->tampil_pengaturan();
			$data['usr']=$this->m_pengguna->tampil_pengguna();
            $data['rekanan'] = $this->db->query('SELECT * FROM tbl_pelanggan ORDER BY nama ASC')->result();
            $data['kegiatan'] = $this->db->query('SELECT * FROM tbl_kegiatan ORDER BY keg_nama ASC')->result();
			$data['menu'] = 'piutang';
			$data['nmpage']  = 'Piutang';
			$this->load->view('admin/v_piutang',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function data()
	{
		$query  = "SELECT * FROM tbl_piutang LEFT JOIN tbl_kegiatan ON tbl_piutang.kegiatan_id=tbl_kegiatan.keg_id LEFT JOIN tbl_pelanggan ON tbl_piutang.pelanggan_id=tbl_pelanggan.id";
		$search = array('piutang_id','pelanggan_id','kegiatan_id','debet','kredit','tgl_input','keg_nama','nama');
		$where  = null;
		$isWhere = null;
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

	function simpan()
	{
        $this->form_validation->set_rules("pelanggan_id", "Rekan", "required");
		$this->form_validation->set_rules("kegiatan_id", "Kegiatan", "required");
        $this->form_validation->set_rules("debet", "Piutang");
        $this->form_validation->set_rules("kredit", "Pembayaran");
        $this->form_validation->set_rules("tgl_input", "Tgl Piutang");
		if($this->form_validation->run() != false) {
		
			$data = [
				'pelanggan_id' => htmlspecialchars($this->input->post("pelanggan_id", TRUE) ,ENT_QUOTES),
				'kegiatan_id' => htmlspecialchars($this->input->post("kegiatan_id", TRUE) ,ENT_QUOTES),
				'debet' => htmlspecialchars(str_replace(',', '', $this->input->post("debet", TRUE)) ,ENT_QUOTES),
                'kredit' => htmlspecialchars(str_replace(',', '', $this->input->post("kredit", TRUE)) ,ENT_QUOTES),
				'tgl_input' => htmlspecialchars($this->input->post("tgl_input", TRUE) ,ENT_QUOTES),
			];

			$this->db->insert("tbl_piutang", $data);
			$this->session->set_flashdata("success"," Berhasil ditambahkan! ");
			if($this->input->get('kasir') == 'retail'){
				redirect(base_url("admin/piutang"));
			}else if($this->input->get('kasir') == 'grosir'){
				redirect(base_url("admin/piutang"));
			}else{
				redirect(base_url("admin/piutang"));
			}
		}else{
			$this->session->set_flashdata("failed"," Gagal ditambahkan! ".validation_errors());
			redirect(base_url("admin/piutang"));
		}
	}

	function pisah()
	{	
		$query  = "SELECT * FROM tbl_piutang";
		$pid = $this->input->get('piutang_id');
		$data['rekanan'] = $this->db->query('SELECT * FROM tbl_pelanggan ORDER BY nama ASC')->result();
		$data['edit'] = $this->db->query($query.' WHERE piutang_id = ?',[$pid])->row();
		if($this->input->get('model') == 'edit'){
			$this->load->view('admin/piutang/edit',$data);
		}else{
			$this->load->view('admin/piutang/hapus',$data);
		}
	}

	function delete()
	{   
		$this->db->where('piutang_id', (int)$this->input->post('piutang_id'));
        $this->db->delete('tbl_piutang');
        $this->session->set_flashdata("success"," Berhasil Hapus Data ! ");
		redirect(base_url("admin/piutang"));
	}
	
}
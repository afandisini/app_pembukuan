<?php
class Jurnal extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
        $this->load->model('m_inputdata');
        $this->load->model('m_jurnal');
		$this->load->model('m_pengaturan');
        $this->load->helper('tgl_default');
	}
	function index(){
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$data['jrntmp']=$this->m_jurnal->tampil_jurnal_tmp();
            $data['data']=$this->m_inputdata->tampil_pembukuan();
            $data['total_debet']=$this->m_inputdata->total_debet();
            $data['total_kredit']=$this->m_inputdata->total_kredit();
            $data['akun'] = $this->db->query('SELECT * FROM tbl_kategori ORDER BY kategori_nama ASC')->result();
            $data['peng']=$this->m_pengaturan->tampil_pengaturan();
            $data['kat']=$this->m_kategori->tampil_kategori();
            $data['nmpage']  = 'Jurnal Buku Bantu';
            $data['menu'] = 'jurnal';
            $data['pmasuk']  = 'Jurnal';
            $data['diskripsi']  = 'Tabel Jurnal Pembantu Menampilkan Total Input Data';
            $this->load->view('admin/v_jurnal',$data);
        }else{
            echo "Halaman tidak ditemukan";
        }
	}

    function data(){
        $query  = "SELECT * FROM tbl_jurnal LEFT JOIN tbl_kategori ON tbl_jurnal.kategori_id=tbl_kategori.kategori_id LEFT JOIN tbl_kegiatan ON tbl_jurnal.kegiatan=tbl_kegiatan.keg_id";
		$search = array('jurnal_id','jurnal_nama','jurnal_ket','pelanggan_id','jurnal_masuk','jurnal_keluar','jurnal_tgl','kategori_nama','keg_nama');
		header('Content-Type: application/json');
        $where  = null;
        $isWhere = null;
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

	
    public function add()
	{
		$this->form_validation->set_rules("jurnal_nama", "Nama");
		$this->form_validation->set_rules("jurnal_ket", "Keterangan");
		$this->form_validation->set_rules("pelanggan_id", "Pelanggan");
		$this->form_validation->set_rules("kegiatan", "Kegiatan");
        $this->form_validation->set_rules("jurnal_masuk", "Debet");
        $this->form_validation->set_rules("jurnal_keluar", "Kredit");
		$this->form_validation->set_rules("kategori_id", "Akun", "required");
		
		if($this->form_validation->run() != false) {
		
			$data = [
				'jurnal_nama' => htmlspecialchars($this->input->post("jurnal_nama", TRUE) ,ENT_QUOTES),
				'jurnal_ket' => htmlspecialchars($this->input->post("jurnal_ket", TRUE) ,ENT_QUOTES),
				'pelanggan_id' => htmlspecialchars($this->input->post("pelanggan_id", TRUE) ,ENT_QUOTES),
				'kegiatan' => htmlspecialchars($this->input->post("kegiatan", TRUE) ,ENT_QUOTES),
				'jurnal_masuk' => htmlspecialchars(str_replace(',', '', $this->input->post("jurnal_masuk", TRUE)) ,ENT_QUOTES),
                'jurnal_keluar' => htmlspecialchars(str_replace(',', '', $this->input->post("jurnal_keluar", TRUE)) ,ENT_QUOTES),
                'kategori_id' => htmlspecialchars($this->input->post("kategori_id", TRUE) ,ENT_QUOTES),
			];

			$this->db->insert("tbl_jurnal", $data);
			$row_id=$this->uri->segment(4);
			$this->db->where('user_id', $this->session->userdata('idadmin'));
			$this->db->where('kasir', 'Retail');
			$this->db->delete('tbl_jurnal_tmp');
			$this->session->set_flashdata("success"," Berhasil Tambah Akun! ");
			if($this->input->get('kasir') == 'retail'){
				redirect(base_url("admin/jurnal"));
			}else{
				redirect(base_url("admin/jurnal"));
			}
		}else{
			$this->session->set_flashdata("failed"," Gagal Tambah Akun! ".validation_errors());
			redirect(base_url("admin/jurnal"));
		}
	}

    public function add_akun()
	{
		$this->form_validation->set_rules("kategori_nama", "Nama", "required");
		if($this->form_validation->run() != false) {
		
			$data = [
				'kategori_nama' => htmlspecialchars($this->input->post("kategori_nama", TRUE) ,ENT_QUOTES),
			];

			$this->db->insert("tbl_kategori", $data);
			$this->session->set_flashdata("success"," Berhasil Tambah Akun! ");
			if($this->input->get('kasir') == 'retail'){
				redirect(base_url("admin/jurnal"));
			}else{
				redirect(base_url("admin/jurnal"));
			}
		}else{
			$this->session->set_flashdata("failed"," Gagal Tambah Akun! ".validation_errors());
			redirect(base_url("admin/jurnal"));
		}
	}

    public function hapus()
	{
		if($this->session->userdata('akses')=='1'){
			$jid=$this->input->post('jid');
            $this->m_jurnal->hapus_jurnal($jid);
            echo $this->session->set_flashdata("hapus"," Berhasil Hapus Data ! ");
			redirect('admin/jurnal');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	//jurnal_tmp_id,jurnal_tmp_nama,jurnal_tmp_ket,pelanggan_id,jurnal_tmp_masuk,jurnal_tmp_keluar,kegiatan,jurnal_tmp_tgl,kasir,user_id
	//Opex jurnal Auto
	function add_to_jurnal(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$this->form_validation->set_rules("jurnal_tmp_nama", "Nama", "required");
			$this->form_validation->set_rules("jurnal_tmp_ket", "Keterangan", "required");
			$this->form_validation->set_rules("pelanggan_id", "Pelanggan", "required");
			$this->form_validation->set_rules("jurnal_tmp_masuk", "Debet");
			$this->form_validation->set_rules("jurnal_tmp_keluar", "Kredit");
			$this->form_validation->set_rules("kegiatan", "Kegiatan", "required");
			$this->form_validation->set_rules("jurnal_tmp_tgl", "Tanggal");
			$this->form_validation->set_rules("kasir", "Kasir");
			$this->form_validation->set_rules("user_id", "User");
			if($this->form_validation->run() != false) {
			
				$data = [
					'jurnal_tmp_nama' => htmlspecialchars($this->input->post("jurnal_tmp_nama", TRUE) ,ENT_QUOTES),
					'jurnal_tmp_ket' => htmlspecialchars($this->input->post("jurnal_tmp_ket", TRUE) ,ENT_QUOTES),
					'pelanggan_id' => htmlspecialchars($this->input->post("pelanggan_id", TRUE) ,ENT_QUOTES),
					'jurnal_tmp_masuk' => htmlspecialchars(str_replace(',', '', $this->input->post("jurnal_tmp_masuk", TRUE)) ,ENT_QUOTES),
					'jurnal_tmp_keluar' => htmlspecialchars(str_replace(',', '', $this->input->post("jurnal_tmp_keluar", TRUE)) ,ENT_QUOTES),
					'kegiatan' => htmlspecialchars($this->input->post("kegiatan", TRUE) ,ENT_QUOTES),
					'jurnal_tmp_tgl' => htmlspecialchars($this->input->post("jurnal_tmp_tgl", TRUE) ,ENT_QUOTES),
					'kasir' => 'Retail',
					'user_id' => $this->session->userdata('idadmin'),
				];
	
				$this->db->insert("tbl_jurnal_tmp", $data);
				$this->session->set_flashdata("success"," Berhasil Tambah Akun! ");
				if($this->input->get('kasir') == 'retail'){
					redirect(base_url("admin/jurnal"));
					}else{
						redirect(base_url("admin/jurnal"));
					}
			}else{
				$this->session->set_flashdata("failed"," Gagal Tambahkan! ".validation_errors());
				redirect(base_url("admin/jurnal"));
			}
		}
	}
	function reset(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$row_id=$this->uri->segment(4);
			$this->db->where('user_id', $this->session->userdata('idadmin'));
			$this->db->where('kasir', 'Retail');
			$this->db->delete('tbl_jurnal_tmp');
			echo $this->session->set_flashdata("reset"," <strong>Berhasil</strong> direset ! ");
			redirect('admin/jurnal');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
    
}
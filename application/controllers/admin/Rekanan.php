<?php
class Rekanan extends CI_Controller{
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
			$data['menu'] = 'rekanan';
			$data['nmpage']  = 'Data Rekanan / Client';
			$this->load->view('admin/v_rekanan',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	public function data()
	{
		$query  = "SELECT * FROM tbl_pelanggan";
		$search = array('nama', 'alamat', 'hp');
		$where  = null; 
		// $where  = array('nama_kategori' => 'Tutorial');
		// jika memakai IS NULL pada where sql
		$isWhere = 'deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

	public function store()
	{
		
		$this->form_validation->set_rules("nama", "Nama", "required");
		$this->form_validation->set_rules("hp", "Hp", "required");
		if($this->form_validation->run() != false) {
		
			$data = [
				'nama' => htmlspecialchars($this->input->post("nama", TRUE) ,ENT_QUOTES),
				'alamat' => htmlspecialchars($this->input->post("alamat", TRUE) ,ENT_QUOTES),
				'hp' => htmlspecialchars($this->input->post("hp", TRUE) ,ENT_QUOTES),
				'tgl_daftar' => date('Y-m-d'),
			];

			$this->db->insert("tbl_pelanggan", $data);
			$this->session->set_flashdata("success"," Berhasil Tambah Rekanan! ");
			if($this->input->get('kasir') == 'retail'){
				redirect(base_url("admin/inputdata"));
			}else if($this->input->get('kasir') == 'grosir'){
				redirect(base_url("admin/penjualan_grosir"));
			}else{
				redirect(base_url("admin/rekanan"));
			}
		}else{
			$this->session->set_flashdata("failed"," Gagal Tambah Rekanan! ".validation_errors());
			redirect(base_url("admin/rekanan"));
		}
	}

	function pisah()
	{
		$query  = "SELECT * FROM tbl_pelanggan";
		$pid = $this->input->get('id');
		$data['edit'] = $this->db->query($query.' WHERE id = ?',[$pid])->row();
		if($this->input->get('model') == 'edit'){
			$this->load->view('admin/rekanan/edit',$data);
		}else{
			$this->load->view('admin/rekanan/hapus',$data);
		}
	}

	public function update()
	{
		
		$this->form_validation->set_rules("nama", "Nama", "required");
		$this->form_validation->set_rules("hp", "Hp", "required");
		//$this->form_validation->set_rules("email", "Email", "required");
		$this->form_validation->set_rules("id", "ID", "required");
		if($this->form_validation->run() != false) {
		
			$data = [
				'nama' => htmlspecialchars($this->input->post("nama", TRUE) ,ENT_QUOTES),
				'alamat' => htmlspecialchars($this->input->post("alamat", TRUE) ,ENT_QUOTES),
				'hp' => htmlspecialchars($this->input->post("hp", TRUE) ,ENT_QUOTES),
				//'email' => htmlspecialchars($this->input->post("email", TRUE) ,ENT_QUOTES),
				'tgl_daftar' => date('Y-m-d'),
			];

			$this->db->where('id', (int)$this->input->post('id'));
			$this->db->update("tbl_pelanggan", $data);
			$this->session->set_flashdata("success"," Berhasil Ubah Data ! ");
			redirect(base_url("admin/rekanan"));
		}else{
			$this->session->set_flashdata("failed"," Gagal Ubah Data ! ".validation_errors());
			redirect(base_url("admin/rekanan"));
		}
	}

	public function delete()
	{
		$id = (int)$this->input->post("id");
		$cek = $this->db->get_where("tbl_pelanggan",["id" => $id]); // tulis id yang dituju
		if($cek->num_rows() > 0)
		{
			$data = ['deleted_at' => date('Y-m-d H:i:s')];
			$this->db->where("id",$id); // tulis id yang dituju
			$this->db->update("tbl_pelanggan", $data);
			$this->session->set_flashdata("success"," Berhasil Hapus Data ! ");
			redirect(base_url("admin/rekanan"));
		}else{
			$this->session->set_flashdata("failed"," Gagal Hapus Data ! ".validation_errors());
			redirect(base_url("admin/rekanan"));
		}
	}
	
}
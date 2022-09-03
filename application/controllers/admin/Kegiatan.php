<?php
class Kegiatan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_inputdata');
        $this->load->model('m_pengaturan');
        $this->load->helper('tgl_default');
	}
	function index(){
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
            $data['rekanan'] = $this->db->query('SELECT * FROM tbl_pelanggan ORDER BY nama ASC')->result();
            $data['kegiatan'] = $this->db->query('SELECT * FROM tbl_kegiatan ORDER BY keg_nama ASC')->result();
            $data['peng']=$this->m_pengaturan->tampil_pengaturan();
            $data['kat']=$this->m_kategori->tampil_kategori();
            $data['nmpage']  = 'Kegiatan Projek';
            $data['menu'] = 'kegiatan';
            $data['pmasuk']  = 'Pemasukan';
            $data['pkeluar']  = 'Pengeluaran';
            $data['diskripsi']  = 'Input Data untuk Pemasukan <i class="ml-2">Contoh: <u>Tambahan Modal, Investor, Pengeluaran dan Lainnya</u></i>';
            $this->load->view('admin/v_kegiatan',$data);
        }else{
            echo "Halaman tidak ditemukan";
        }
	}

    function input()
	{   
		$this->form_validation->set_rules("keg_nama", "Kegiatan", "required");
        $this->form_validation->set_rules("start", "Muali", "required");
        $this->form_validation->set_rules("end", "Selesai", "required");
        $this->form_validation->set_rules("nilai_kontrak", "Nilai Kontrak", "required");
        $this->form_validation->set_rules("opd", "OPD", "required");
		if($this->form_validation->run() != false) {
			$kdata = [
                    'keg_nama' => htmlspecialchars($this->input->post("keg_nama", TRUE) ,ENT_QUOTES),
                    'start' => htmlspecialchars($this->input->post("start", TRUE) ,ENT_QUOTES),
                    'end' => htmlspecialchars($this->input->post("end", TRUE) ,ENT_QUOTES),
                    'nilai_kontrak' => htmlspecialchars(str_replace(',', '', $this->input->post("nilai_kontrak", TRUE)) ,ENT_QUOTES),
                    'opd' => htmlspecialchars($this->input->post("opd", TRUE) ,ENT_QUOTES),
				];
            
			$this->db->insert("tbl_kegiatan", $kdata);
			$this->session->set_flashdata("success"," Berhasil Tambah Data ! ");
			if($this->input->get('kasir') == 'retail'){
				redirect(base_url("admin/kegiatan"));
			}else{
				redirect(base_url("admin/kegiatan"));
			}
		}else{
			$this->session->set_flashdata("failed"," Gagal Tambah Data ! ".validation_errors());
			redirect(base_url("admin/kegiatan"));
		}
	}

	function keg_edit()
	{   
		$this->form_validation->set_rules("keg_nama", "Kegiatan", "required");
        $this->form_validation->set_rules("start", "Muali", "required");
        $this->form_validation->set_rules("end", "Selesai", "required");
        $this->form_validation->set_rules("nilai_kontrak", "Nilai Kontrak", "required");
        $this->form_validation->set_rules("opd", "OPD", "required");
		if($this->form_validation->run() != false) {
			$edata = [
                    'keg_nama' => htmlspecialchars($this->input->post("keg_nama", TRUE) ,ENT_QUOTES),
                    'start' => htmlspecialchars($this->input->post("start", TRUE) ,ENT_QUOTES),
                    'end' => htmlspecialchars($this->input->post("end", TRUE) ,ENT_QUOTES),
                    'nilai_kontrak' => htmlspecialchars(str_replace(',', '', $this->input->post("nilai_kontrak", TRUE)) ,ENT_QUOTES),
                    'opd' => htmlspecialchars($this->input->post("opd", TRUE) ,ENT_QUOTES),
				];
            
			$this->db->where('keg_id', (int)$this->input->post('keg_id'));
			$this->db->update("tbl_kegiatan", $edata);
			$this->session->set_flashdata("success"," Berhasil Tambah Data ! ");
			if($this->input->get('kasir') == 'retail'){
				redirect(base_url("admin/kegiatan"));
			}else{
				redirect(base_url("admin/kegiatan"));
			}
		}else{
			$this->session->set_flashdata("failed"," Gagal Tambah Data ! ".validation_errors());
			redirect(base_url("admin/kegiatan"));
		}
	}

    //function edit(){
    //  $data['rekanan'] = $this->db->query('SELECT * FROM tbl_pelanggan ORDER BY nama ASC')->result();
    //  $data['kegiatan'] = $this->db->query('SELECT * FROM tbl_kegiatan ORDER BY keg_nama ASC')->result();
	//	$query = "SELECT * FROM tbl_pembukuan";
	//	$pid = $this->input->get('pembukuan_id');
	//	$data['edit']  = $this->db->query($query.' WHERE pembukuan_id = ?',[$pid])->row();
    //    $data = $this->load->view('admin/kegiatan/hapus');
	//}

    function edit()
	{
		$query  = "SELECT * FROM tbl_kegiatan LEFT JOIN tbl_pembukuan ON tbl_kegiatan.keg_id=tbl_pembukuan.kegiatan";
		$kid = $this->input->get('kid');
		$data['a'] = $this->db->query($query.' WHERE keg_id = ?',[$kid])->row_array();
		$data['kegiatan']=$this->m_kategori->tampil_kegiatan();
		$data['lihat']  = 'Lihat Kegiatan';
		$data['edit']  = 'Edit Kegiatan';
		if($this->input->get('tipe') == 'edit'){
			$this->load->view('admin/kegiatan/edit',$data);
		}else{
			$this->load->view('admin/kegiatan/hapus',$data);
		}
	}

    function kegiatan(){
        $query  = "SELECT * FROM tbl_kegiatan";
		$search = array('keg_id','keg_nama','start','end','nilai_kontrak','opd');
		header('Content-Type: application/json');
        $where  = null;
        $isWhere = null;
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}
    

    function del_kegiatan()
	{
		if( $this->session->userdata('akses')=='1'){
			$kid=$this->input->post('kid');
            $this->m_inputdata->del_keg($kid);
            echo $this->session->set_flashdata("hapus"," Berhasil Hapus Data ! ");
            redirect('admin/kegiatan');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}
<?php
class Inputdata extends CI_Controller{
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
            $data['data']=$this->m_inputdata->tampil_pembukuan();
            $data['keg']=$this->m_inputdata->tampil_kegiatan();
            $data['total_debet']=$this->m_inputdata->total_debet();
            $data['total_kredit']=$this->m_inputdata->total_kredit();
            $data['rekanan'] = $this->db->query('SELECT * FROM tbl_pelanggan ORDER BY nama ASC')->result();
            $data['kegiatan'] = $this->db->query('SELECT * FROM tbl_kegiatan ORDER BY keg_nama ASC')->result();
            $data['peng']=$this->m_pengaturan->tampil_pengaturan();
            $data['kat']=$this->m_kategori->tampil_kategori();
            $data['nmpage']  = 'Input Pembukuan';
            $data['menu'] = 'inputdata';
            $data['pmasuk']  = 'Pemasukan';
            $data['pkeluar']  = 'Pengeluaran';
            $data['diskripsi']  = 'Input Data untuk Pemasukan <i class="ml-2">Contoh: <u>Tambahan Modal, Investor, Pengeluaran dan Lainnya</u></i>';
            $this->load->view('admin/v_inputdata',$data);
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
                    'nilai_kontrak' => htmlspecialchars($this->input->post("nilai_kontrak", TRUE) ,ENT_QUOTES),
                    'opd' => htmlspecialchars($this->input->post("opd", TRUE) ,ENT_QUOTES),
				];
            
			$this->db->insert("tbl_kegiatan", $kdata);
			$this->session->set_flashdata("success"," Berhasil Tambah Data ! ");
			if($this->input->get('kasir') == 'retail'){
				redirect(base_url("admin/inputdata"));
			}else{
				redirect(base_url("admin/inputdata"));
			}
		}else{
			$this->session->set_flashdata("failed"," Gagal Tambah Data ! ".validation_errors());
			redirect(base_url("admin/inputdata"));
		}
	}

    function pisah()
	{	
        $data['rekanan'] = $this->db->query('SELECT * FROM tbl_pelanggan ORDER BY nama ASC')->result();
        $data['kegiatan'] = $this->db->query('SELECT * FROM tbl_kegiatan ORDER BY keg_nama ASC')->result();
        $pid = $this->input->get('pembukuan_id');
		$query  = "SELECT * FROM tbl_pembukuan";
		$data['edit'] = $this->db->query($query.' WHERE pembukuan_id = ?',[$pid])->row();
		if($this->input->get('model') == 'edit'){
			$this->load->view('admin/inputdata/edit',$data);
		}else{
			$this->load->view('admin/inputdata/hapus',$data);
		}
	}

    //function edit(){
    //  $data['rekanan'] = $this->db->query('SELECT * FROM tbl_pelanggan ORDER BY nama ASC')->result();
    //  $data['kegiatan'] = $this->db->query('SELECT * FROM tbl_kegiatan ORDER BY keg_nama ASC')->result();
	//	$query = "SELECT * FROM tbl_pembukuan";
	//	$pid = $this->input->get('pembukuan_id');
	//	$data['edit']  = $this->db->query($query.' WHERE pembukuan_id = ?',[$pid])->row();
    //    $data = $this->load->view('admin/inputdata/hapus');
	//}

       
    function data(){
        $query  = "SELECT * FROM tbl_pembukuan LEFT JOIN tbl_pelanggan ON tbl_pembukuan.pelanggan_id=tbl_pelanggan.id LEFT JOIN tbl_kegiatan ON tbl_pembukuan.kegiatan=tbl_kegiatan.keg_id";
		$search = array('pembukuan_id','pembukuan_nama','pembukuan_ket','pelanggan_id','pembukuan_masuk','pembukuan_keluar','pembukuan_tgl','nama','keg_nama','nilai_kontrak','opd');
		header('Content-Type: application/json');
        $where  = null;
        $isWhere = null;
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

    function kegiatan(){
        $query  = "SELECT * FROM tbl_kegiatan";
		$search = array('keg_id','keg_nama','start','end','nilai_kontrak','opd');
		header('Content-Type: application/json');
        $where  = null;
        $isWhere = null;
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}
    
    function tambah_debet(){
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
            $aid=$this->m_inputdata->get_aid();
            $anama=$this->input->post('anama');
            $aket=$this->input->post('aket');
            $mpid=$this->input->post('mpid');
            $amas=str_replace(',', '', $this->input->post('amas'));
            $akel=str_replace(',', '', $this->input->post('akel'));
            $mkegid=$this->input->post('mkegid');
            $mtgl=$this->input->post('mtgl');
            $this->form_validation->set_rules("verifikasi", "Verifikasi", "required");
            $kverf = ['verifikasi' => htmlspecialchars($this->input->post("verifikasi", TRUE) ,ENT_QUOTES),];
            $this->db->where('keg_id', (int)$this->input->post('keg_id'));
            $this->db->update("tbl_kegiatan", $kverf);
            $this->m_inputdata->tambah_debet($aid,$anama,$aket,$mpid,$amas,$akel,$mkegid,$mtgl);
            echo $this->session->set_flashdata("berhasil"," Berhasil Tambah $anama ! ");
            redirect('admin/inputdata');
        }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function ubah_debet(){
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
                $aid=$this->input->post('aid');
                $anama=$this->input->post('anama');
                $aket=$this->input->post('aket');
                $mpid=$this->input->post('mpid');
                $amas=str_replace(',', '', $this->input->post('amas'));
                $akel=str_replace(',', '', $this->input->post('akel'));
                $mkegid=$this->input->post('mkegid');
                $mtgl=$this->input->post('mtgl');
                $this->m_inputdata->ubah_debet($aid,$anama,$aket,$mpid,$amas,$akel,$mkegid,$mtgl);
                echo $this->session->set_flashdata("berhasil"," Berhasil Ubah $anama ! ");
                redirect('admin/inputdata');
            }else{
                echo "Halaman tidak ditemukan";
            }
    }

    
    public function update_debet()
	{
		
		$this->form_validation->set_rules("pembukuan_nama", "Nama", "required");
		$this->form_validation->set_rules("pembukuan_ket", "Keterangan", "required");
		$this->form_validation->set_rules("pelanggan_id", "Id Rekan", "required");
        $this->form_validation->set_rules("pembukuan_masuk", "Debet", "required");
        $this->form_validation->set_rules("pembukuan_keluar", "Kredit", "required");
        $this->form_validation->set_rules("kegiatan", "Kegiatan", "required");
        $this->form_validation->set_rules("pembukuan_tgl", "Tgl Input", "required");
		$this->form_validation->set_rules("pembukuan_id", "Id Pembukuan", "required");
		if($this->form_validation->run() != false) {
		
			$data = [
				'pembukuan_nama' => htmlspecialchars($this->input->post("pembukuan_nama", TRUE) ,ENT_QUOTES),
				'pembukuan_ket' => htmlspecialchars($this->input->post("pembukuan_ket", TRUE) ,ENT_QUOTES),
				'pelanggan_id' => htmlspecialchars($this->input->post("pelanggan_id", TRUE) ,ENT_QUOTES),
				'pembukuan_masuk' => htmlspecialchars(str_replace(',', '', $this->input->post("pembukuan_masuk", TRUE)) ,ENT_QUOTES),
                'pembukuan_keluar' => htmlspecialchars(str_replace(',', '', $this->input->post("pembukuan_keluar", TRUE)) ,ENT_QUOTES),
				'kegiatan' =>  htmlspecialchars($this->input->post("kegiatan", TRUE) ,ENT_QUOTES),
                'pembukuan_tgl' => htmlspecialchars($this->input->post("pembukuan_tgl", TRUE) ,ENT_QUOTES),
			];

			$this->db->where('pembukuan_id', (int)$this->input->post('pembukuan_id'));
			$this->db->update("tbl_pembukuan", $data);
			$this->session->set_flashdata("success"," Berhasil Ubah Data ! ");
			redirect(base_url("admin/inputdata"));
		}else{
			$this->session->set_flashdata("failed"," Gagal Ubah Data ! ".validation_errors());
			redirect(base_url("admin/inputdata"));
		}
	}

    public function Busak()
    {   
        $this->db->where('pembukuan_id', (int)$this->input->post('pembukuan_id'));
        $this->db->delete('tbl_pembukuan');
        echo $this->session->set_flashdata("hapus"," Berhasil Hapus Data ! ");
        redirect('admin/inputdata');
    }

    function del_kegiatan()
	{
		if( $this->session->userdata('akses')=='1'){
			$kid=$this->input->post('kid');
            $this->m_inputdata->del_keg($kid);
            echo $this->session->set_flashdata("hapus"," Berhasil Hapus Data ! ");
            redirect('admin/inputdata');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}
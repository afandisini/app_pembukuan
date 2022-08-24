<?php
class Barang extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_pengaturan'); 
		// $this->load->library('barcode');
	}

	function index(){
		if($this->session->userdata('akses')=='1'){
			$data['peng']=$this->m_pengaturan->tampil_pengaturan();
			$data['data']=$this->m_barang->tampil_barang();
			$data['kat']=$this->m_kategori->tampil_kategori();
			$data['kat2']=$this->m_kategori->tampil_kategori();
			$data['kegiatan']=$this->m_kategori->tampil_kegiatan();
			$data['menu']='barang';
			$data['nmpage']='Barang';
			$this->load->view('admin/v_barang',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function data()
	{
		$query  = "SELECT barang_id,barang_nama,barang_ket,barang_satuan,barang_varian,barang_harpok,barang_harjul,barang_harjul_grosir,barang_stok,barang_min_stok,barang_keg_id,keg_nama FROM tbl_barang JOIN tbl_kegiatan ON barang_keg_id=keg_id";
		$search = array('barang_id','barang_nama','barang_ket','barang_varian','barang_satuan','barang_harpok','barang_harjul','barang_harjul_grosir','barang_stok','keg_nama');
		
		header('Content-Type: application/json');
        $where  = null;
        $isWhere = null;
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}


	function edit()
	{
		$query  = "SELECT barang_id,barang_nama,barang_varian,barang_ket,barang_satuan,barang_harpok,barang_harjul,barang_harjul_grosir,barang_stok,barang_min_stok,barang_keg_id,keg_nama FROM tbl_barang JOIN tbl_kegiatan ON barang_keg_id=keg_id";
		$kobar = $this->input->get('id');
		$data['a'] = $this->db->query($query.' WHERE barang_id = ?',[$kobar])->row_array();
		$data['kat']=$this->m_kategori->tampil_kategori();
		$data['kat2']=$this->m_kategori->tampil_kategori();
		$data['kegiatan']=$this->m_kategori->tampil_kegiatan();
		$data['lihat']  = 'Lihat Barang';
		$data['edit']  = 'Edit Barang';
		if($this->input->get('tipe') == 'edit'){
			$this->load->view('admin/barang/edit',$data);
		}else{
			$this->load->view('admin/barang/hapus',$data);
		}
	}

	function barcode()
	{
		$query  = "SELECT barang_id,barang_nama,barang_varian,barang_ket,barang_satuan,barang_harpok,barang_harjul,barang_harjul_grosir,barang_stok,barang_min_stok,barang_keg_id,keg_nama FROM tbl_barang JOIN tbl_kegiatan ON barang_keg_id=keg_id";
		$kobar = $this->input->get('id');
		$data['a'] = $this->db->query($query.' WHERE barang_id = ?',[$kobar])->row();
		$this->load->view('admin/barang/barcode',$data);

	}

	function tambah_barang(){
		if($this->session->userdata('akses')=='1'){
			$kobar=$this->m_barang->get_kobar();
			$jenis = $this->input->post('jenis');
			if($jenis == 'Varian'){
				$varian =array();
				foreach($this->input->post('sn') as $r => $v)
				{
					$varian[] = [
						'barang_id' => $kobar,
						'sn' => $v,
						'warna' => $this->input->post('warna')[$r],
						'spesifikasi' => $this->input->post('spesifikasi')[$r],
						'created_at' => date('Y-m-d H:i:s')
					];
				}
				$this->db->insert_batch('tbl_barang_varian', $varian);
			}
			$nabar=$this->input->post('nabar');
			$ketbar=$this->input->post('ketbar');
			$kat=$this->input->post('kegiatan');
			$satuan=$this->input->post('satuan');
			$harpok=str_replace(',', '', $this->input->post('harpok'));
			$harjul=str_replace(',', '', $this->input->post('harjul'));
			$harjul_grosir=str_replace(',', '', $this->input->post('harjul_grosir'));
			$stok=$this->input->post('stok');
			$min_stok=$this->input->post('min_stok');
			$this->m_barang->simpan_barang($kobar,$nabar,$ketbar,$kat,$satuan,$harpok,$harjul,$harjul_grosir,$stok,$min_stok, $jenis);
			echo $this->session->set_flashdata("berhasil"," <strong>Berhasil</strong> Tambah Barang ! ");
			redirect('admin/barang');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	function edit_barang(){
		if($this->session->userdata('akses')=='1'){
			$kobar=$this->input->post('kobar');
			$jenis = $this->input->post('jenis');
			if($jenis == 'Varian'){
				$varian =array();
				foreach($this->input->post('sn') as $r => $v)
				{
					$varian[] = [
						'id' => $this->input->post('idvarian')[$r],
						'barang_id' => $kobar,
						'sn' => $v,
						'warna' => $this->input->post('warna')[$r],
						'spesifikasi' => $this->input->post('spesifikasi')[$r],
						'created_at' => date('Y-m-d H:i:s')
					];
				}
				$this->db->update_batch('tbl_barang_varian', $varian, 'id');
			}

			$nabar=$this->input->post('nabar');
			$ketbar=$this->input->post('ketbar');
			$kat=$this->input->post('kegiatan');
			$satuan=$this->input->post('satuan');
			$harpok=str_replace(',', '', $this->input->post('harpok'));
			$harjul=str_replace(',', '', $this->input->post('harjul'));
			$harjul_grosir=str_replace(',', '', $this->input->post('harjul_grosir'));
			$stok=$this->input->post('stok');
			$min_stok=$this->input->post('min_stok');
			$this->m_barang->update_barang($kobar,$nabar,$ketbar,$kat,$satuan,$harpok,$harjul,$harjul_grosir,$stok,$min_stok);
			echo $this->session->set_flashdata("ubah"," <strong>Update</strong> Barang Berhasil ! ");
			redirect('admin/barang');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function reset(){
		echo $this->session->set_flashdata("ubah"," <strong>Reset</strong> Barang Berhasil ! ");
		redirect('admin/barang');
	}

	function hapus_barang(){
		if($this->session->userdata('akses')=='1'){
			$kode=$this->input->post('kode');
			$this->m_barang->hapus_barang($kode);
			$jenis = $this->input->post('jenis');
			if($jenis == 'Varian'){
				$this->db->where('barang_id', $kode);
				$this->db->delete('tbl_barang_varian');
			}
			echo $this->session->set_flashdata("hapus"," <strong>Data</strong> Barang Terhapus ! ");
			redirect('admin/barang');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}
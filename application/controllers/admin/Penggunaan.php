<?php
class penggunaan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_penggunaan');
		$this->load->model('m_pengaturan');
	}
	function index(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$data['peng']=$this->m_pengaturan->tampil_pengaturan();
			$data['data']=$this->m_barang->tampil_barang();
			$data['kegiatan'] = $this->db->query('SELECT * FROM tbl_kegiatan LEFT JOIN tbl_keranjang ON keg_id=kegiatan_id ORDER BY keg_nama ASC')->result();
			// lihat keranjang
			$data['keranjang'] = $this->db->query('SELECT * FROM tbl_keranjang 
				WHERE user_id = ? AND kasir = ?', 
				array($this->session->userdata('idadmin'),'Retail'))->result_array();
			$data['menu']  = 'penggunaan';
			$data['nmpage']  = 'Pemakaian Barang';
			$this->load->view('admin/v_penggunaan',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function data(){
        $query  = "SELECT * FROM tbl_detail_jual LEFT JOIN tbl_kegiatan ON kegiatan_id=keg_id";
		$search = array('d_jual_id','d_jual_nofak','d_jual_barang_id','d_jual_barang_nama','d_jual_barang_satuan','d_jual_barang_harpok','d_jual_barang_harjul','d_jual_qty','d_jual_diskon','varian','keg_nama');
		header('Content-Type: application/json');
        $where  = null;
        $isWhere = null;
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

	function get_barang(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$kobar=$this->input->post('kode_brg');
			$cari = $kobar;
			$x['brg']=$this->db->query("SELECT tbl_barang_varian.sn, tbl_barang.* FROM tbl_barang 
				LEFT JOIN tbl_barang_varian ON tbl_barang.barang_id=tbl_barang_varian.barang_id 
				WHERE tbl_barang.barang_id like '%$cari%' 
				or tbl_barang.barang_nama like '%$cari%' 
				or tbl_barang_varian.sn like '%$cari%'");
			$x['kobar'] = $kobar;
			$this->load->view('admin/v_detail_barang_jual',$x);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function add_to_cart(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$kobar=$this->input->post('barang_id');
			$produk=$this->m_barang->get_barang($kobar);
			$i=$produk->row_array();
			// dicek dulu sudah ada didatabase belum
			$cek = $this->db->query('SELECT * FROM tbl_keranjang WHERE barang_id =? AND user_id = ? AND kasir = ?',
				array($i['barang_id'], $this->session->userdata('idadmin'), 'Retail'))->num_rows();
			// siapkan data
			$data = array(
				'barang_id' 	=> $i['barang_id'],
				'name'     		=> $i['barang_nama'],
				'satuan'   		=> $i['barang_satuan'],
				'harpok'   		=> $i['barang_harpok'],
				'varian'   		=> $this->input->post('varian'),
				'price'    		=> str_replace(",", "", $this->input->post('harjul'))-$this->input->post('diskon'),
				'disc'     		=> $this->input->post('diskon'),
				'qty'      		=> $this->input->post('qty'),
				'amount'   		=> str_replace(",", "", $this->input->post('harjul')),
				'kasir'   		=> 'Retail',
				'kegiatan_id' 	=> $i['barang_keg_id'],
				'user_id'  => $this->session->userdata('idadmin')
			);

			if($cek > 0)
			{
				$this->db->where('barang_id', $i['barang_id']);
				$this->db->where('user_id', $this->session->userdata('idadmin'));
				$this->db->update('tbl_keranjang', $data);
			}else{

				$this->db->insert('tbl_keranjang', $data);
			}
			echo $this->session->set_flashdata("berhasil"," <strong>Berhasil</strong> ditambahkan ! ");
			redirect('admin/penggunaan');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	function remove(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$row_id=$this->uri->segment(4);
			$this->db->where('id', $row_id);
			$this->db->where('kasir', 'Retail');
			$this->db->delete('tbl_keranjang');
			echo $this->session->set_flashdata("hapus"," <strong>Berhasil</strong> dihapus ! ");
			redirect('admin/penggunaan');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	function reset(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$row_id=$this->uri->segment(4);
			$this->db->where('user_id', $this->session->userdata('idadmin'));
			$this->db->where('kasir', 'Retail');
			$this->db->delete('tbl_keranjang');
			echo $this->session->set_flashdata("reset"," <strong>Berhasil</strong> direset ! ");
			redirect('admin/penggunaan');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function simpan_penggunaan(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$data['peng']=$this->m_pengaturan->tampil_pengaturan();
			$total=$this->input->post('total');
			$ppn=$this->input->post('ppn');
			$keg_id = $this->input->post('keg_id');
			$jml_uang=str_replace(",", "", $this->input->post('jml_uang'));
			$kembalian=$jml_uang-$total;
			if(!empty($total) && !empty($jml_uang)){
				if($jml_uang < $total){
					echo $this->session->set_flashdata("ubah","<strong>Maaf!!</strong> Jumlah Uang Kurang");
					redirect('admin/penggunaan');
				}else{
					$nofak=$this->m_penggunaan->get_nofak();
					$this->session->set_userdata('nofak',$nofak);
					$order_proses=$this->m_penggunaan->simpan_penggunaan($nofak,$total,$jml_uang,$kembalian,$ppn,$keg_id);
					if($order_proses){
						// $this->cart->destroy();
						// $this->session->unset_userdata('tglfak');
						// $this->session->unset_userdata('suplier');
						// tambahin oprek faktur cetak
						echo $this->session->set_flashdata("berhasil"," <strong>Berhasil</strong> Mengurangi STOK Barang ! ");
						redirect('admin/penggunaan');
					}else{
						redirect('admin/penggunaan');
					}
				}
				
			}else{
				echo $this->session->set_flashdata("gagal","<span class='text-sm'><strong>Maaf!!</strong> Tidak ada yang dibeli</span>");
				redirect('admin/penggunaan');
			}

		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function simpan_kredit(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$data['peng']=$this->m_pengaturan->tampil_pengaturan();
			$total=$this->input->post('total');
			$ppn=$this->input->post('ppn');
			$kegiatan=$this->input->post('kegiatan');
			$anama=$this->input->post('anama');
			$aket=$this->input->post('aket');
			$kpid=$this->input->post('kpid');
			$akel=$this->input->post('akel');
			$jml_uang=str_replace(",", "", $this->input->post('jml_uang'));
			$kembalian=$jml_uang-$total;
			if(!empty($total) && !empty($jml_uang)){
				if($jml_uang < $total){
					echo $this->session->set_flashdata("ubah","<strong>Maaf!!</strong> Jumlah Uang Kurang");
					redirect('admin/penggunaan');
				}else{
					$nofak=$this->m_penggunaan->get_nofak();
					$this->session->set_userdata('nofak',$nofak);
					$order_proses=$this->m_penggunaan->simpan_kredit($nofak,$total,$jml_uang,$kembalian,$ppn,$kegiatan,$aid,$anama,$aket,$kpid,$akel);
					if($order_proses){
						// $this->cart->destroy();
						// $this->session->unset_userdata('tglfak');
						// $this->session->unset_userdata('suplier');
						// tambahin oprek faktur cetak
						redirect('admin/penggunaan/cetak?nofak='.$nofak.'&tipe=Jual');
					}else{
						redirect('admin/penggunaan');
					}
				}
				
			}else{
				echo $this->session->set_flashdata("gagal","<span class='text-sm'><strong>Maaf!!</strong> Tidak ada yang dibeli</span>");
				redirect('admin/penggunaan');
			}

		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function cetak()
	{
		$nofak = $this->input->get('nofak');
		$tipe = $this->input->get('tipe');
		$menu['menu']  = 'cetakfaktur';
		$this->load->view('admin/alert/alert_sukses', array('nofak' => $nofak, 'tipe' => $tipe, 'menu' => $menu,));	
	}

	function cetak_faktur(){
		$x['data']=$this->m_penggunaan->cetak_faktur();
		// tambahin oprek faktur 
		$nofak =  $this->input->get('nofak');
		$x['faktur']=$this->db->query('SELECT * FROM tbl_detail_jual WHERE d_jual_nofak = ?', array($nofak))->result_array();
		$x['peng']=$this->m_pengaturan->tampil_pengaturan();
		$x['menu']  = 'cetakfaktur';
		$x['nmpage']  = 'Cetak Nota penggunaan';
		$x['b'] =$this->db->query('SELECT * FROM tbl_jual WHERE jual_nofak = ?', array($nofak))->row_array();
		if($this->input->get('tipe')){
			if($this->input->get('excel')){
				header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
				header("Content-Disposition: attachment; filename=data-laporan-penggunaan-".date('Y-m-d').".xls");  //File name extension was wrong
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: private",false); 
				$this->load->view('admin/laporan/v_faktur_xls',$x);
			}else{
				$this->load->library('pdfgenerator');
				// title dari pdf
				$this->data['title_pdf'] = 'Cetak Nota';
				// filename dari pdf ketika didownload
				$file_pdf = 'cetak_'.$nofak;
				// setting paper
				$paper = 'A4';
				//orientasi paper potrait / landscape
				$orientation = "portrait";
				$html = $this->load->view('admin/laporan/v_faktur_pdf',$x, true);	    
				// run dompdf
				$this->pdfgenerator->generate($html,$file_pdf,$paper,$orientation);
			}
		}else{
			$this->load->view('admin/laporan/v_faktur',$x);
		}
		//$this->session->unset_userdata('nofak');
	}

	function cetak_surat(){
		$x['data']=$this->m_penggunaan->cetak_faktur();
		// tambahin oprek faktur 
		$nofak =  $this->input->get('nofak');
		$x['faktur']=$this->db->query('SELECT * FROM tbl_detail_jual WHERE d_jual_nofak = ?', array($nofak))->result_array();
		$x['peng']=$this->m_pengaturan->tampil_pengaturan();
		$x['menu']  = 'cetaksuratjalan';
		$x['nmpage']  = 'Cetak Nota penggunaan';
		$x['b'] =$this->db->query('SELECT * FROM tbl_jual WHERE jual_nofak = ?', array($nofak))->row_array();
		$this->load->view('admin/laporan/v_surat',$x);
		//$this->session->unset_userdata('nofak');
	}

}
<?php
class Pengaturan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_pengaturan');
		$this->load->library('upload');	
		
	}
	function index(){
		if($this->session->userdata('akses')=='1'){
			$data['peng']=$this->m_pengaturan->tampil_pengaturan();
			$data['nmpage']  = 'Pengaturan';
			$data['menu'] = 'pengaturan';
			$this->load->view('admin/v_pengaturan',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function header(){
		if($this->session->userdata('akses')=='1'){
			$x['peng']=$this->m_pengaturan->tampil_pengaturan();
			$x['nmpage']  = 'Cetak Faktur';
			$x['menu'] = 'cetak';
			$this->load->view('admin/alert/alert_sukses',$x);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	// function edit_pengaturan(){
	//	if($this->session->userdata('akses')=='1'){
    //       	$pid=$this->input->post('pid');
	//			$pnm=$this->input->post('pnm');
 	//			$pfoo=$this->input->post('pfoo');
	//			$palt=$this->input->post('palt');
	//			$php=$this->input->post('php');
	//			$plogo=$this->input->post('plogo');
    //           $this->m_pengaturan->update_pengaturan($pid,$pnm,$pfoo,$palt,$php,$plogo);
	//			echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible fade show" role="alert">Pengaturan Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	//			redirect('admin/pengaturan');
	//		
	//		}else{
	//			echo "Halaman tidak ditemukan";
	//		}
	
	function edit_pengaturan(){
		
		$uploadPath = FCPATH.'./uploads/pengaturan/';
		$nmfile = md5(time());
		$config['file_name'] = $nmfile;
		$config['upload_path'] = $uploadPath;		
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|webp'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '2048'; // 2 mb

		$this->upload->initialize($config);

		if ($this->upload->do_upload('filefoto'))
		{
			$data = $this->upload->data();  
		
			$config['image_library'] = 'gd2';  
			$config['source_image'] = $uploadPath.$data["file_name"];  
			$config['create_thumb'] = FALSE;  
			$config['maintain_ratio'] = FALSE;  
			$config['quality'] = '70%';       
			$config['new_image'] = $uploadPath.$data["file_name"];  
			$this->load->library('image_lib', $config);  
			$this->image_lib->resize();

			$gambar=$this->input->post('gambar');
			$path=$uploadPath.$gambar;
			unlink($path);

			$plogo=$data["file_name"];
			$pid=$this->input->post('pid');
			$pnm=strip_tags($this->input->post('pnm'));
			$pfoo=$this->input->post('pfoo');
			$palt=strip_tags($this->input->post('palt'));
			$php=strip_tags($this->input->post('php'));
			$pkota=strip_tags($this->input->post('pkota'));
			$pplus=$this->input->post('pplus');
			$this->m_pengaturan->update_pengaturan($pid,$pnm,$pfoo,$palt,$php,$plogo,$pkota,$pplus);
			echo $this->session->set_flashdata("ubah"," <strong>Pengaturan</strong> berhasil diubah ! ");
			redirect('admin/pengaturan');
			
		}else{
			$gambar=$this->input->post('gambar');
			$plogo=$gambar;
			$pid=$this->input->post('pid');
			$pnm=strip_tags($this->input->post('pnm'));
			$pfoo=$this->input->post('pfoo');
			$palt=strip_tags($this->input->post('palt'));
			$php=strip_tags($this->input->post('php'));
			$pkota=strip_tags($this->input->post('pkota'));
			$pplus=$this->input->post('pplus');
			$this->m_pengaturan->update_pengaturan($pid,$pnm,$pfoo,$palt,$php,$plogo,$pkota,$pplus);
			echo $this->session->set_flashdata("berhasil"," <strong>Pengaturan</strong> berhasil diubah ! ");
			redirect('admin/pengaturan');
		}

	}

	function faicons()
	{
		$query  = "SELECT fa_id,fa_nama,fa_kode FROM tbl_faicon";
		$search = array('fa_id','fa_nama','fa_kode');
		$where  = null; $isWhere = null;
		// $where  = array('nama_kategori' => 'Tutorial');
		// jika memakai IS NULL pada where sql
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}

	function backup() {
		if($this->session->userdata('akses')=='1'){
			date_default_timezone_set("Asia/Makassar"); // set waktu sesuai lokasi
			$this->load->dbutil();
			$pref = [
				'format' => 'zip',
				'filename' => 'soft_flashretail.sql'
			];

			$backup     = $this->dbutil->backup($pref);
			$db_name    = 'backup_database__' . date("d-m-Y__H-i-s") . '.zip'; // nama backup dalam bentuk zip
			$save       = './pengaturan/' . $db_name; //folder tempat database disimpan

			$this->load->helper('file'); // load helper file
			write_file($save, $backup);

			$this->load->helper("download"); // load helper download
			force_download($db_name, $backup);
		}else{
			echo "Halaman tidak ditemukan";
		}
    }

	//function hapus_pengaturan(){
	//	if($this->session->userdata('akses')=='1'){
	//		$pid=$this->input->post('pid');
	//		$this->m_pengaturan->hapus_pengaturan($pid);
	//		redirect('admin/pengaturan');
	//	}else{
	//		echo "Halaman tidak ditemukan";
	//	}
	//}

}
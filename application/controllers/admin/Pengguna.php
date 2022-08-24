<?php
class Pengguna extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_pengguna');
		$this->load->model('m_pengaturan');
		$this->load->library('upload');
	}
	function index(){
	if($this->session->userdata('akses')=='1'){
		$data['data']=$this->m_pengguna->get_pengguna();
		$data['peng']=$this->m_pengaturan->tampil_pengaturan();
		$data['menu']  = 'pengguna';
		$data['nmpage']  = 'Pengguna';
		$this->load->view('admin/v_pengguna',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function tambah_pengguna(){
	if($this->session->userdata('akses')=='1'){
		$nama=$this->input->post('nama');
		$username=$this->input->post('username');
		$uploadPath = FCPATH.'./uploads/users/';
		$nmfile = md5(time());
		$config['file_name'] = $nmfile;
		$config['upload_path'] = $uploadPath;		
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|webp'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '2048'; // 2 mb
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload('filefoto'))
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
			$path='./uploads/users/'.$gambar;
			unlink($path);
			$ufoto=$data["file_name"];
			$this->db->set('user_foto', $ufoto);
		}
		$password=$this->input->post('password');
			$password2=$this->input->post('password2');
			if($password){
				if($password == $password2){
					$this->db->set('user_password', md5($password));
				}else{
					$this->session->set_flashdata("gagal"," Kata Sandi Tidak Sama ! ");
					redirect('admin/pengguna');
					exit;
				}
			}

			$kode		= $this->input->post('kode', TRUE);
			$nama		= $this->input->post('nama', TRUE);
			$username	= $this->input->post('username', TRUE);
			$level		= $this->input->post('level', TRUE);
			if($username == $this->input->post('uname', TRUE)){
				$this->db->set('user_username', $username);
			}else{
				$cek = $this->db->get_where('tbl_user',['user_username' => $username])->num_rows();
				if($cek > 0){
					$this->session->set_flashdata("gagal"," <strong>Pengguna</strong> Gagal diubah, Username sudah digunakan ! ");
					redirect('admin/pengguna');
					exit;

				}else{
					$this->db->set('user_username', $username);
				}
			}
			$data = [
				'user_nama' => $nama,
				'user_level' => $level,
			];
			$this->db->where("user_id", $kode); // ubah id dan postnya
			$this->db->insert("tbl_user", $data);

			$this->session->set_flashdata("berhasil"," <strong>Pengguna</strong> berhasil diubah ! ");
			redirect('admin/pengguna');
			
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function edit_pengguna(){
		if($this->session->userdata('akses')=='1'){

			$uploadPath = FCPATH.'./uploads/users/';
			$nmfile = md5(time());
			$config['file_name'] = $nmfile;
			$config['upload_path'] = $uploadPath;		
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|webp'; //type yang dapat diakses bisa anda sesuaikan
			$config['max_size'] = '2048'; // 2 mb
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('filefoto'))
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
				$path='./uploads/users/'.$gambar;
				unlink($path);
				$ufoto=$data["file_name"];
				$this->db->set('user_foto', $ufoto);
			}

			$password=$this->input->post('password');
			$password2=$this->input->post('password2');
			if($password){
				if($password == $password2){
					$this->db->set('user_password', md5($password));
				}else{
					$this->session->set_flashdata("gagal"," Kata Sandi Tidak Sama ! ");
					redirect('admin/pengguna');
					exit;
				}
			}

			$kode		= $this->input->post('kode', TRUE);
			$nama		= $this->input->post('nama', TRUE);
			$username	= $this->input->post('username', TRUE);
			$level		= $this->input->post('level', TRUE);
			if($username == $this->input->post('uname', TRUE)){
				$this->db->set('user_username', $username);
			}else{
				$cek = $this->db->get_where('tbl_user',['user_username' => $username])->num_rows();
				if($cek > 0){
					$this->session->set_flashdata("gagal"," <strong>Pengguna</strong> Gagal diubah ! ");
					redirect('admin/pengguna');
					exit;

				}else{
					$this->db->set('user_username', $username);
				}
			}
			$data = [
				'user_nama' => $nama,
				'user_level' => $level,
			];
			$this->db->where("user_id", $kode); // ubah id dan postnya
			$this->db->update("tbl_user", $data);

			$this->session->set_flashdata("berhasil"," <strong>Pengguna</strong> berhasil diubah ! ");
			redirect('admin/pengguna');
			
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function nonaktifkan(){
		if($this->session->userdata('akses')=='1'){
			$kode=$this->input->post('kode');
			$this->m_pengguna->nonaktif($kode);
			echo $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible fade show mb-3 p-2" role="alert"><strong>Pengguna</strong> berhasil dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/pengguna');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function aktifkan(){
		if($this->session->userdata('akses')=='1'){
			$kode=$this->input->post('kode');
			$this->m_pengguna->aktif($kode);
			echo $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible fade show mb-3 p-2" role="alert"><strong>Pengguna</strong> berhasil dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/pengguna');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function hapus_pengguna(){
	if($this->session->userdata('akses')=='1'){
		$kode=$this->input->post('kode');
		$this->m_pengguna->hapus_pengguna($kode);
		echo $this->session->set_flashdata("hapus"," <strong>Pengguna</strong> berhasil dipahus ! ");
		redirect('admin/pengguna');
	}else{
		echo "Halaman tidak ditemukan";
	}
	}
}
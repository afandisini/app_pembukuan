<?php
class Administrator extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('mlogin');
        $this->load->model('m_pengaturan');
    }
    function index(){
        $x['peng']=$this->m_pengaturan->tampil_pengaturan();
        $x['judul']='Silahkan Masuk..!';
        $x['nmpage']  = 'Halaman Login';
        $this->load->view('admin/v_login',$x);
    }
    function cekuser(){
        $username=strip_tags(stripslashes($this->input->post('username',TRUE)));
        $password=strip_tags(stripslashes($this->input->post('password',TRUE)));
        $u=$username;
        $p=$password;
        $cadmin=$this->mlogin->cekadmin($u,$p);
        if($cadmin->num_rows() > 0){
            $this->session->set_userdata('masuk',true);
            $this->session->set_userdata('user',$u);
            $xcadmin=$cadmin->row_array();
        if($xcadmin['user_level']=='1')
            $this->session->set_userdata('akses','1');
            $idadmin=$xcadmin['user_id'];
            $user_nama=$xcadmin['user_nama'];
            $this->session->set_userdata('idadmin',$idadmin);
            $this->session->set_userdata('nama',$user_nama);
        if($xcadmin['user_level']=='2'){
            $this->session->set_userdata('akses','2');
            $idadmin=$xcadmin['user_id'];
            $user_nama=$xcadmin['user_nama'];
            $this->session->set_userdata('idadmin',$idadmin);
            $this->session->set_userdata('nama',$user_nama);
                }
        if($xcadmin['user_level']=='3'){
            $this->session->set_userdata('akses','3');
            $idadmin=$xcadmin['user_id'];
            $user_nama=$xcadmin['user_nama'];
            $this->session->set_userdata('idadmin',$idadmin);
            $this->session->set_userdata('nama',$user_nama);
                //Front Office
                }
            }
            
            if($this->session->userdata('masuk')==true){
                redirect('administrator/berhasillogin');
            }else{
                redirect('administrator/gagallogin');
            }

            if($this->session->userdata('keluar')==true){
                redirect('administrator/logout');
            }else{
                redirect('administrator/gagallogout');
            }
        }
        function berhasillogin(){
            $nm = $this->session->userdata('nama');
            echo $this->session->set_flashdata("login","<div class='box_success animated tada shadow-sm' role='alert'><strong>Hai..</strong>$nm, Anda berhasil Masuk !</div>");
            redirect('admin/dasbor');
        }
        function gagallogin(){
            $url=base_url('administrator');
            echo $this->session->set_flashdata("gagal"," <strong>Maaf!</strong> id atau kata sandi Salah ");
            redirect($url);
        }
        function logout(){
            $this->session->sess_destroy();
            $url=base_url('administrator');
            echo $this->session->set_flashdata("berhasil"," <strong>Anda</strong> berhasil Keluar ! ");
            redirect($url);
        }
        function gagallogout(){
            $url=base_url('administrator');
            echo $this->session->set_flashdata('msg','<div class="box_warning fade show shadow-sm" role="alert"><strong>Maaf!</strong> ID Pengguna Atau Kata Sandi Salah.</div>');
            redirect($url);
        }

        
}
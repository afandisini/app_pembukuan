<?php
class Dasbor extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_pengguna');
		$this->load->model('m_pengaturan');
		$this->load->model('m_inputdata');
		$this->load->model('m_kategori');
	}
	
	function index(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2' || $this->session->userdata('akses')=='3'){
			$data['kat']=$this->m_kategori->tampil_kategori();
			$data['peng']=$this->m_pengaturan->tampil_pengaturan();
			$data['usr']=$this->m_pengguna->tampil_pengguna();
            $data['total_debet']=$this->m_inputdata->total_debet();
            $data['total_kredit']=$this->m_inputdata->total_kredit();
			$data['kas']=($this->m_inputdata->total_debet())-($this->m_inputdata->total_kredit());
			$data['total_kegiatan']=$this->m_inputdata->total_kegiatan();
			$data['lihat_keg']=$this->m_inputdata->tampil_kegiatan();
			$query1 = $this->db->query("SELECT SUM(pembukuan_masuk) as count FROM tbl_pembukuan   
            WHERE YEAR(pembukuan_tgl) ORDER BY pembukuan_tgl");   
        	$data['pmas'] = json_encode(array_column($query1->result(), 'count'),JSON_NUMERIC_CHECK);
			$query2 = $this->db->query("SELECT SUM(pembukuan_keluar) as count FROM tbl_pembukuan   
            WHERE YEAR(pembukuan_tgl) ORDER BY pembukuan_tgl");   
        	$data['pkel'] = json_encode(array_column($query2->result(), 'count'),JSON_NUMERIC_CHECK);
			$data['menu']  = 'dasbor';
			$data['nmpage']  = 'Dasbor';
			$this->load->view('admin/v_dasbor',$data);	
		}else{
			echo "Halaman tidak ditemukan";
		}	
	}
	function kegiatan(){
        $query  = "SELECT * FROM tbl_kegiatan";
		$search = array('keg_id','keg_nama','start','end');
		header('Content-Type: application/json');
        $where  = null;
        $isWhere = null;
		echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
	}
	
}
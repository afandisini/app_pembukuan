<?php
/**
 * 
 * Author    : Fauzan Falah ( Anang )
 * Edit    	 : Afan Hermawan
 * File      : alert_helper.php
 * Web Name  : Flashretail
 * Version   : v2.1.6
 * Ket       : Berisi tentang fungsi-fungsi alert alert yg digunakan 
 * 
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('alert_bs')) {
	function alert_bs() {
		$CI = & get_instance();
		if($CI->session->flashdata('success')){
			$alert = '<div class="box_success animated tada shadow-sm" role="alert">
							'.$CI->session->flashdata('success').'
						</div>';
			return $alert;
		}
		if($CI->session->flashdata('login')){
			$alert = ' '.$CI->session->flashdata('login').'
					<div class="preloader flex-column justify-content-center align-items-center"><i class="fal fa-circle-notch fa-spin mr-2 fa-fw"></i>Sedang Memuat</div>';
			return $alert;
		}
		
		if($CI->session->flashdata('failed')){
			$alert = '<div class="box_danger animated tada shadow-sm" role="alert">
						'.$CI->session->flashdata('failed').'
					</div>';
			return $alert;
		}
		if($CI->session->flashdata('hapus')){
			$alert = '<div class="box_danger animated tada shadow-sm" role="alert">
						<i class="fal fa-trash-alt mr-1 fa-fw"></i>
						'.$CI->session->flashdata('hapus').'
					</div>';
			return $alert;
		}
		if($CI->session->flashdata('gagal')){
			$alert = '<div class="box_danger animated tada shadow-sm" role="alert">
						<i class="fal fa-exclamation-triangle mr-1 fa-fw"></i>'
						.$CI->session->flashdata('gagal').'
					</div>';
			return $alert;
		}
		if($CI->session->flashdata('reset')){
			$alert = '<div class="box_warning animated tada shadow-sm" role="alert">
						<i class="fal fa-sync mr-1 fa-fw"></i>
						'.$CI->session->flashdata('reset').'
					</div>';
			return $alert;
		}
		if($CI->session->flashdata('ubah')){
			$alert = '<div class="box_warning animated tada shadow-sm" role="alert">
						<i class="fal fa-shield-check mr-1 fa-fw"></i>
						'.$CI->session->flashdata('ubah').'
					  </div>';
			return $alert;
		}
		if($CI->session->flashdata('berhasil')){
			$alert = '<div class="box_success animated tada shadow-sm" role="alert">
						<i class="fal fa-shield-check mr-1 fa-fw"></i>
						'.$CI->session->flashdata('berhasil').'
					</div>';
			return $alert;
		}
		
	}
}

if(!function_exists('alertsweetjs')) {
	function alertsweetjs(){
		$CI = & get_instance();
		if($CI->session->flashdata('success')){
			return "<script>Swal.fire({
						title: 'Berhasil !',
						html: '".$CI->session->flashdata('success')."',
						icon: 'success',
						confirmButtonText: 'Oke',
					});</script>";
		}
	
		if($CI->session->flashdata('failed')){
			return "<script>Swal.fire({
						title: 'Gagal !',
						html: '".$CI->session->flashdata('failed')."',
						icon: 'warning',
						confirmButtonText: 'Oke',
					});</script>";
		}
		
	}
}

if(!function_exists('tgl_default')) {
	function tgl_default($date) {
		$tgl = explode('-', $date);
		return $tgl[2].'/'.$tgl[1].'/'.$tgl[0];
	}
}
        

<?php
class Mlogin extends CI_Model{
    function cekadmin($u,$p){
        $wong=$u;$sawot=$p;
        $hasil=$this->db->get_where('tbl_user',['user_username' => $wong, 'user_password' => md5($sawot)]);
        return $hasil;
    }  
}
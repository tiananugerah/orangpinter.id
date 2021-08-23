<?php

class Wali extends CI_Controller{

    public function index()
    {
        $data = array(
            'konten' => 'administrator/Wali',
            'judul'  => 'Data Wali Siswa'
        );
        $this->load->view('v_index', $data);
    }
}

?>
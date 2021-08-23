<?php

class Siswa extends CI_Controller{

    public function index()
    {
        $data = array(
            'konten' => 'administrator/Siswa',
            'judul'  => 'Data Siswa'
        );
        $this->load->view('v_index', $data);
    }
}

?>
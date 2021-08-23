<?php

class guru extends CI_Controller{
    
    public function index()
    {
        $data = array(
            'konten' => 'administrator/Guru',
            'judul'  => 'Data Guru'
        );
        $this->load->view('v_index', $data);
    }
}

?>
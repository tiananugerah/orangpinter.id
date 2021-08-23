<?php

class Dashboard extends CI_Controller{

    public function index()
    {
        $data = array(
            'konten' => 'administrator/index',
            'judul'  => 'Dashboard'
        );
        $this->load->view('v_index', $data);
    }
}

?>
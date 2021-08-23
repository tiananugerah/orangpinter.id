<?php

class guru extends CI_Controller{
    
    public function index()
    {        
        $url = "$base_url/api/siswa/view/1/nis/desc/null/null";
        
        $ch  = curl_init();
        curl_setopt_array($ch,array(
			CURLOPT_USERAGENT=>"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36",
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POST => TRUE,
			CURLOPT_HEADER=> "api_auth_key: f99aecef3d12e02dcbb6260bbdd35189c89e6e73",
			CURLOPT_DNS_USE_GLOBAL_CACHE=>0,
			CURLOPT_DNS_CACHE_TIMEOUT=>2
          ));

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            echo curl_errno($ch);
        }
        curl_close($ch);
        $hasil = json_decode($output);

        $data = array(
            'konten' => 'administrator/Guru',
            'judul'  => 'Data Guru'
        );
        $this->load->view('v_index', $data);
    }

}

?>
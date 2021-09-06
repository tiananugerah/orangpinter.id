<?php
include_once(APPPATH.'libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengumuman extends REST_Controller{

    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");		// CORS
        header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Accept");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $this->load->model('M_pengumuman');
    }

    // fitur tampil data(read)
    public function index_data($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue)
    {
        if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null) {
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_pengumuman->getData('0',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
    }

    // fitur insert data(post)
    public function index_post()
    {
        $query = $this->M_pengumuman->addpengumuman($this->post());
        $this->response($query, $query['status_code']);
    }

    // fitur update data(put)
    public function index_update($nip = null)
    {
        $query = $this->M_pengumuman->editpengumuman($nip, $this->put());
        $this->response($query, $query['status_code']);
    }

    // fitur hapus data(delete)
    public function index_delete($nip = null)
    {
        $query = $this->M_pengumuman->deletepengumuman($nip);
        $this->response($query, $query['status_code']);
    }
}

?>
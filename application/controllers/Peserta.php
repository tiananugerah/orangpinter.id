<?php 
include_once(APPPATH.'libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class Peserta extends REST_Controller {


	public function __construct(){
        parent::__construct();
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");		// CORS
        header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Accept");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('M_peserta');
	}
	
	// Menambahkan data peserta (POST)
	public function index_post(){
		$query = $this->M_peserta->addpeserta($this->post());
		$this->response($query, $query['status_code']);
	}

	public function view_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_peserta->getData('0',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}

	public function search_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_peserta->getData('1',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}


	// Menghapus data peserta (DELETE)
	public function single_delete($id_peserta = null){
		$query = $this->M_peserta->deletepeserta($id_peserta);
		$this->response($query, $query['status_code']);
	}

	// Mengubah data peserta (PUT)
	public function single_put($id_peserta = null){
		$query = $this->M_peserta->editpeserta($id_peserta,$this->put());
		$this->response($query, $query['status_code']);
	}


}
?>
<?php 
include_once(APPPATH.'libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class Nilai extends REST_Controller {


	public function __construct(){
        parent::__construct();
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");		// CORS
        header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Accept");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('M_nilai');
	}

	// Menambahkan data nilai (POST)
	public function index_post(){
		$query = $this->M_nilai->addnilai($this->post());
		$this->response($query, $query['status_code']);
	}

	public function view_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_nilai->getData('0',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}

	public function search_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_nilai->getData('1',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}


	// Menghapus data nilai (DELETE)
	public function single_delete($id_nilai = null){
		$query = $this->M_nilai->deletenilai($id_nilai);
		$this->response($query, $query['status_code']);
	}

	// Mengubah data nilai (PUT)
	public function single_put($id_nilai = null){
		$query = $this->M_nilai->editnilai($id_nilai,$this->put());
		$this->response($query, $query['status_code']);
	}


}
?>
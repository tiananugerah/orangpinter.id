<?php 
include_once(APPPATH.'libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class Jurusan extends REST_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('M_jurusan');
	}

	// Menambahkan data jurusan (POST)
	public function index_post(){
		$query = $this->M_jurusan->addjurusan($this->post());
		$this->response($query, $query['status_code']);
	}

	public function view_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_jurusan->getData('0',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}

	public function search_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_jurusan->getData('1',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}


	// Menghapus data jurusan (DELETE)
	public function single_delete($id_jurusan = null){
		$query = $this->M_jurusan->deletejurusan($id_jurusan);
		$this->response($query, $query['status_code']);
	}

	// Mengubah data jurusan (PUT)
	public function single_put($id_jurusan = null){
		$query = $this->M_jurusan->editjurusan($id_jurusan,$this->put());
		$this->response($query, $query['status_code']);
	}


}
?>
<?php 
include_once(APPPATH.'libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class Jabatan extends REST_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('M_jabatan');
	}

	// Menambahkan data jabatan (POST)
	public function index_post(){
		$query = $this->M_jabatan->addjabatan($this->post());
		$this->response($query, $query['status_code']);
	}

	public function view_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_jabatan->getData('0',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}

	public function search_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_jabatan->getData('1',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}


	// Menghapus data jabatan (DELETE)
	public function single_delete($id_jabatan = null){
		$query = $this->M_jabatan->deletejabatan($id_jabatan);
		$this->response($query, $query['status_code']);
	}

	// Mengubah data jabatan (PUT)
	public function single_put($id_jabatan = null){
		$query = $this->M_jabatan->editjabatan($id_jabatan,$this->put());
		$this->response($query, $query['status_code']);
	}


}
?>
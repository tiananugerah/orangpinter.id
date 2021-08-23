<?php 
include_once(APPPATH.'libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class Siswa extends REST_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('M_siswa');
	}

	// Menambahkan data siswa (POST)
	public function index_post(){
		$query = $this->M_siswa->addSiswa($this->post());
		$this->response($query, $query['status_code']);
	}

	public function view_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_siswa->getData('0',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}

	public function search_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_siswa->getData('1',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}


	// Menghapus data siswa (DELETE)
	public function single_delete($id_siswa = null){
		$query = $this->M_siswa->deleteSiswa($id_siswa);
		$this->response($query, $query['status_code']);
	}

	// Mengubah data siswa (PUT)
	public function single_put($id_siswa = null){
		$query = $this->M_siswa->editSiswa($id_siswa,$this->put());
		$this->response($query, $query['status_code']);
	}


}
?>
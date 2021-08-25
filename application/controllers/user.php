<?php 
include_once(APPPATH.'libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends REST_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('M_user');
	}
	
	// Menambahkan data User (POST)
	public function index_post(){
		$query = $this->M_User->addUser($this->post());
		$this->response($query, $query['status_code']);
	}

	public function view_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_User->getData('0',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}

	public function search_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevaluen = null, $wherepass = null, $wherevaluep = null){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevaluen == null ||  $wherepass == null || $wherevaluep = null){
			== null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_User->getData('1',$page, $sortname, $sortvalue, $wherename, $wherevalue, $wherepass, $wherevaluep );
			$this->response($query, $query['status_code']);
		}
	}


	// Menghapus data User (DELETE)
	public function single_delete($id_User = null){
		$query = $this->M_User->deleteUser($id_User);
		$this->response($query, $query['status_code']);
	}

	// Mengubah data User (PUT)
	public function single_put($id_User = null){
		$query = $this->M_User->editUser($id_User,$this->put());
		$this->response($query, $query['status_code']);
	}


}
?>
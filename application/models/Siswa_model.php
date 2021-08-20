<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Siswa_model extends CI_Model {

	private $response;
	private $max_per_page = 10;


	public function addSiswa($request){
		// menambahkan data siswa berdasarkan data json pada request.
		// data $request akan dimasukan pada fungsi addSiswa ini melalui controller.
		$query = $this->db->insert('s_siswa', $request);
		if($query){
			// jika query pada database berhasil (tidak ada error) maka httpcode yang diberikan adalah 200(success) serta menampilkan data json yang digunakan untuk melakukan request.
			$this->response['status_code'] = 200;
			$this->response['status_message'] = "berhasil menambahkan data siswa";
			$this->response['data'] = $request;
		} else {
			// jika query pada database gagal (terdapat error) maka menampilkan error dengan http code 500(internal server error) 
			$this->response['status_code'] =  500;
			$this->response['status_message'] = $this->db->error();
		}

		// mengembalikan nilai request untuk diproses dicontroller sebagai http code dan respon dari web services
		return $this->response;

	}

	public function editSiswa($nis,$request){
		// menambahkan data siswa berdasarkan data json pada request.
		// data $request dan $is_siswa akan dimasukan pada fungsi editSiswa ini melalui controller.
		$this->db->where('nis', $nis);
		$query = $this->db->update('s_siswa', $request);
		if($query){
			// jika query pada database berhasil (tidak ada error) maka httpcode yang diberikan adalah 200(success) serta menampilkan data json yang digunakan untuk melakukan request.
			$this->response['status_code'] = 200;
			$this->response['status_message'] = "berhasil mengubah data siswa";
			$this->response['data'] = $request;
		} else {
			// jika query pada database gagal (terdapat error) maka menampilkan error dengan http code 500(internal server error) 
			$this->response['status_code'] =  500;
			$this->response['status_message'] = $this->db->error();
		}

		// mengembalikan nilai request untuk diproses dicontroller sebagai http code dan respon dari web services
		return $this->response;

	}

	public function deleteSiswa($nis){
		// menambahkan data siswa berdasarkan data json pada request.
		// data $request dan $is_siswa akan dimasukan pada fungsi deleteSiswa ini melalui controller.
		$this->db->where('nis', $nis);
		$query = $this->db->delete('s_siswa');
		if($query){
			// jika query pada database berhasil (tidak ada error) maka httpcode yang diberikan adalah 200(success) serta menampilkan data json yang digunakan untuk melakukan request.
			$this->response['status_code'] = 200;
			$this->response['status_message'] = "berhasil menghapus data siswa";
		} else {
			// jika query pada database gagal (terdapat error) maka menampilkan error dengan http code 500(internal server error) 
			$this->response['status_code'] =  500;
			$this->response['status_message'] = $this->db->error();
		}

		// mengembalikan nilai request untuk diproses dicontroller sebagai http code dan respon dari web services
		return $this->response;

	}

	public function getSiswa($type, $page, $sortname, $sortvalue, $wherename, $wherevalue){
		/*
			Where Type.
			[0] = Filter where
			[1] = Filter search Like
		*/
		if($page <= 0){
			$page = 0;
		} else {
			$page = ($page-1)*$this->max_per_page;
		}
		// get param of sortvalue (asceding or descending)
		if($sortvalue != "desc" && $sortvalue != "null"){
			$sortvalue = "asc";
		}


		// sort option
		if($sortname != "null" && $sortvalue != "null"){
			$this->db->order_by($sortname, $sortvalue);
		}

		// search option
		if($type == 0 && ($wherename != "null" && $wherevalue != "null")){
			$this->db->where($wherename, $wherevalue);
		} else if($type == 1 && ($wherename != "null" && $wherevalue != "null")){
			$this->db->like($wherename, $wherevalue);
		}

		$query_totaldata = $this->db->get('siswa');

		// sort option
		if($sortname != "null" && $sortvalue != "null"){
			$this->db->order_by($sortname, $sortvalue);
		}

		// search option
		if($type == 0 && ($wherename != "null" && $wherevalue != "null")){
			$this->db->where($wherename, $wherevalue);
		} else if($type == 1 && ($wherename != "null" && $wherevalue != "null")){
			$this->db->like($wherename, $wherevalue);
		}
		$query = $this->db->get('siswa', $this->max_per_page, $page);

		if($query && $query_totaldata){
			// jika query pada database berhasil (tidak ada error) maka httpcode yang diberikan adalah 200(success) serta menampilkan data json.
			$totaldata = $query_totaldata->num_rows();
			$this->response['status_code'] =  500;
			$this->response['result'] = $query->result();
			$this->response['data']['totalhalaman'] = ceil($totaldata/$this->max_per_page);
			$this->response['data']['totaldata'] = $totaldata;
		} else {
			// jika query pada database gagal (terdapat error) maka menampilkan error dengan http code 500(internal server error) 
			$this->response['status_code'] =  500;
			$this->response['status_message'] = $this->db->error();
		}

		return $this->response;

	}

}
?>
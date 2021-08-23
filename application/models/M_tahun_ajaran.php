<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_tahun_ajaran extends CI_Model{
    private $response;
	private $max_per_page = 10;

    public function getData($type, $page, $sortname, $sortvalue, $wherename, $wherevalue)
    {
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

		$query_totaldata = $this->db->get('s_tahun_ajaran');

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
		$query = $this->db->get('s_tahun_ajaran', $this->max_per_page, $page);

		if($query && $query_totaldata){
			// jika query berhasil maka httpcode yang diberikan adalah 200(success)
			$totaldata = $query_totaldata->num_rows();
			$this->response['status_code'] =  200;
			$this->response['result'] = $query->result();
			$this->response['data']['totalhalaman'] = ceil($totaldata/$this->max_per_page);
			$this->response['data']['totaldata'] = $totaldata;
		} else {
			// jika query gagal atau error maka akan menampilkan httpcode 500(internal server error) 
			$this->response['status_code'] =  500;
			$this->response['status_message'] = $this->db->error();
		}

		return $this->response;
    }

    public function addTahun_ajaran($request) 
    {
        // menambahkan data Tahun_ajaran pada request berdasarkan data json
        // data $request akan dimasukan pada fungsi addTahun_ajaran ini melalui controller.
        $query = $this->db->insert('s_tahun_ajaran', $request);
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data Tahun_ajaran berhasil disimpan";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] = 500;
            $this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses di controller sebagai httpcode dan respon dari web services 
        return $this->response;
    }

    public function editTahun_ajaran($kd_tahun_ajaran,$request)
    {
        // data $request dan $kd_tahun_ajaran akan dimasukan pada fungsi editTahun_ajaran ini melalui controller.
        $this->db->where('kd_tahun_ajaran', $kd_tahun_ajaran);
        $query = $this->db->update('s_tahun_ajaran', $request);
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data Tahun_ajaran berhasil diubah";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] =  500;
			$this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses dicontroller sebagai http code dan respon dari web services
		return $this->response;
    }

    public function deleteTahun_ajaran($kd_tahun_ajaran)
    {
        // data $request dan $kd_tahun_ajaran akan dimasukan pada fungsi deleteTahun_ajaran ini melalui controller.
        $this->db->where('kd_tahun_ajaran', $kd_tahun_ajaran);
        $query = $this->db->delete('s_tahun_ajaran');
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data Tahun_ajaran berhasil dihapus";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] =  500;
			$this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses dicontroller sebagai http code dan respon dari web services
		return $this->response;
    }
}

?>
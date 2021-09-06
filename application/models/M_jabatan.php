<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_jabatan extends CI_Model{
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

		$query_totaldata = $this->db->get('s_jabatan');

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
		$query = $this->db->get('s_jabatan', $this->max_per_page, $page);

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

    public function addjabatan($request) 
    {
        // menambahkan data jabatan pada request berdasarkan data json
        // data $request akan dimasukan pada fungsi addjabatan ini melalui controller.
        $query = $this->db->insert('s_jabatan', $request);
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data jabatan berhasil disimpan";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] = 500;
            $this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses di controller sebagai httpcode dan respon dari web services 
        return $this->response;
    }

    public function editjabatan($kd_jabatan,$request)
    {
        // data $request dan $kd_jabatan akan dimasukan pada fungsi editjabatan ini melalui controller.
        $this->db->where('kd_jabatan', $kd_jabatan);
        $query = $this->db->update('s_jabatan', $request);
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data jabatan berhasil diubah";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] =  500;
			$this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses dicontroller sebagai http code dan respon dari web services
		return $this->response;
    }

    public function deletejabatan($kd_jabatan)
    {
        // data $request dan $kd_jabatan akan dimasukan pada fungsi deletejabatan ini melalui controller.
        $this->db->where('kd_jabatan', $kd_jabatan);
        $query = $this->db->delete('s_jabatan');
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data jabatan berhasil dihapus";
            $this->response['data'] = $kd_jabatan;
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
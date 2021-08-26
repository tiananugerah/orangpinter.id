<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_p_peserta extends CI_Model{
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

		$query_totaldata = $this->db->get('s_p_peserta');

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
		$query = $this->db->get('s_p_peserta', $this->max_per_page, $page);

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

    public function addP_peserta($request) 
    {
        // menambahkan data P_peserta pada request berdasarkan data json
        // data $request akan dimasukan pada fungsi addP_peserta ini melalui controller.
        $query = $this->db->insert('s_p_peserta', $request);
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data P_peserta berhasil disimpan";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] = 500;
            $this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses di controller sebagai httpcode dan respon dari web services 
        return $this->response;
    }

    public function editP_peserta($kd_p_peserta,$request)
    {
        // data $request dan $kd_p_peserta akan dimasukan pada fungsi editP_peserta ini melalui controller.
        $this->db->where('kd_p_peserta', $kd_p_peserta);
        $query = $this->db->update('s_p_peserta', $request);
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data P_peserta berhasil diubah";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] =  500;
			$this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses dicontroller sebagai http code dan respon dari web services
		return $this->response;
    }

    public function deleteP_peserta($kd_p_peserta)
    {
        // data $request dan $kd_p_peserta akan dimasukan pada fungsi deleteP_peserta ini melalui controller.
        $this->db->where('kd_p_peserta', $kd_p_peserta);
        $query = $this->db->delete('s_p_peserta');
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data P_peserta berhasil dihapus";
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
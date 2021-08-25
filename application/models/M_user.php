<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_user extends CI_Model{
    private $response;
	private $max_per_page = 10;

    public function getData($type, $page, $sortname, $sortvaluen, $wherename, $wherevalue, $wherepass, $wherevaluep )
    {
        if($page <= 0){
			$page = 0;
		} else {
			$page = ($page-1)*$this->max_per_page;
		}
		// get param of sortvalue (asceding or descending)
		if($sortvaluen != "desc" && $sortvaluen != "null" && $wherepass != "null" && $wherevaluep != "null" ){
			$sortvaluen = "asc";
		}

		// sort option
		if($sortname != "null" && $sortvaluen != "null" && $wherepass != "null" && $wherevaluep != "null"){
			$this->db->order_by($sortname, $sortvaluen, $wherepass, $wherevaluep );
		}

		// search option
		if($type == 0 && ($wherename != "null" && $wherevaluen != "null" && $wherepass != "null" && $wherevaluep != "null")){
			$this->db->where($wherename, $wherevaluen, $wherepass, $wherevaluep );
		} else if($type == 1 && ($wherename != "null" && $wherevalue != "null" && $wherepass != "null" && $wherevaluep != "null")){
			$this->db->like($wherename, $wherevaluen, $wherepass, $wherevaluep );
		}

        $this->db->select('*');
        $this->db->from('s_siswa');
        $this->db->join('s_wali','s_siswa.nis = s_wali.nis','left');
        $this->db->join('s_institusi','s_siswa.kd_institusi = s_institusi.kd_institusi','left');
        $this->db->join('s_jurusan','s_siswa.kd_jurusan = s_jurusan.kd_jurusan','left');
        $this->db->group_by("s_institusi.s_institusi");
        $query_totaldata = $this->db->get()->result();;

		// sort option
		if($sortname != "null" && $sortvaluen != "null" && $wherepass != "null" && $wherevaluep != "null"){
			$this->db->order_by($sortname, $sortvaluen, $wherepass, $wherevaluep );
		}

		// search option
		if($type == 0 && ($wherename != "null" && $wherevalue != "null" && $wherepass != "null" && $wherevaluep != "null")){
			$this->db->where($wherename, $wherevalue, $wherepass, $wherevaluep);
		} else if($type == 1 && ($wherename != "null" && $wherevalue != "null" && $wherepass != "null" && $wherevaluep != "null")){
			$this->db->like($wherename, $wherevalue, $wherepass, $wherevaluep );
		}
		$query = $this->db->get('s_user', $this->max_per_page, $page);

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

    public function adduser($request) 
    {
        // menambahkan data user pada request berdasarkan data json
        // data $request akan dimasukan pada fungsi adduser ini melalui controller.
        $query = $this->db->insert('s_user', $request);
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data user berhasil disimpan";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] = 500;
            $this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses di controller sebagai httpcode dan respon dari web services 
        return $this->response;
    }

    public function edituser($nis,$request)
    {
        // data $request dan $nis akan dimasukan pada fungsi edituser ini melalui controller.
        $this->db->where('nis', $nis);
        $query = $this->db->update('s_user', $request);
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data user berhasil diubah";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] =  500;
			$this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses dicontroller sebagai http code dan respon dari web services
		return $this->response;
    }

    public function deleteuser($nis)
    {
        // data $request dan $nis akan dimasukan pada fungsi deleteuser ini melalui controller.
        $this->db->where('nis', $nis);
        $query = $this->db->delete('s_user');
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data user berhasil dihapus";
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
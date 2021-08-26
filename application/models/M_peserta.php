<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_peserta extends CI_Model{
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
			$this->db->order_by('s_peserta.'.$sortname, $sortvalue);
		}

		// search option
		if($type == 0 && ($wherename != "null" && $wherevalue != "null")){
			$this->db->where('s_peserta.'.$wherename, $wherevalue);
		} else if($type == 1 && ($wherename != "null" && $wherevalue != "null")){
			$this->db->like('s_peserta.'.$wherename, $wherevalue);
		}

        $this->db->select('*');
        $this->db->from('s_peserta');
        $this->db->join('s_wali','s_peserta.nis = s_wali.nis','left');
        $this->db->join('s_institusi','s_peserta.kd_institusi = s_institusi.kd_institusi','left');
        $this->db->join('s_jurusan','s_peserta.kd_jurusan = s_jurusan.kd_jurusan','left');
        $this->db->group_by("s_institusi.kd_institusi");
        $query_totaldata = $this->db->get();

		// sort option
		if($sortname != "null" && $sortvalue != "null"){
			$this->db->order_by('s_peserta.'.$sortname, $sortvalue);
		}

		// search option
		if($type == 0 && ($wherename != "null" && $wherevalue != "null")){
			$this->db->where('s_peserta.'.$wherename, $wherevalue);
		} else if($type == 1 && ($wherename != "null" && $wherevalue != "null")){
			$this->db->like('s_peserta.'.$wherename, $wherevalue);
		}
        
        $this->db->select('*');
        $this->db->from('s_peserta', $this->max_per_page, $page);
        $this->db->join('s_wali','s_peserta.nis = s_wali.nis','left');
        $this->db->join('s_institusi','s_peserta.kd_institusi = s_institusi.kd_institusi','left');
        $this->db->join('s_jurusan','s_peserta.kd_jurusan = s_jurusan.kd_jurusan','left');
        $this->db->group_by("s_institusi.kd_institusi");
        $query = $this->db->get();

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

    public function addpeserta($request) 
    {
        // menambahkan data peserta pada request berdasarkan data json
        // data $request akan dimasukan pada fungsi addpeserta ini melalui controller.
        $query = $this->db->insert('s_peserta', $request);
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data peserta berhasil disimpan";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] = 500;
            $this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses di controller sebagai httpcode dan respon dari web services 
        return $this->response;
    }

    public function editpeserta($nis,$request)
    {
        // data $request dan $nis akan dimasukan pada fungsi editpeserta ini melalui controller.
        $this->db->where('nis', $nis);
        $query = $this->db->update('s_peserta', $request);
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data peserta berhasil diubah";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] =  500;
			$this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses dicontroller sebagai http code dan respon dari web services
		return $this->response;
    }

    public function deletepeserta($nis)
    {
        // data $request dan $nis akan dimasukan pada fungsi deletepeserta ini melalui controller.
        $this->db->where('nis', $nis);
        $query = $this->db->delete('s_peserta');
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data peserta berhasil dihapus";
            $this->response['data'] = $nis;
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
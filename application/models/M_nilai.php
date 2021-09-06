<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_nilai extends CI_Model{
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

        $this->db->select('*');
        $this->db->from('s_nilai');
        $this->db->join('s_nilai','s_nilai.kd_nilai = s_nilai.kd_nilai','left');
        $this->db->join('s_pengajar','s_pengajar.nip = s_nilai.nip','left');
        $this->db->join('s_tahun_ajaran','s_tahun_ajaran.kd_ajaran = s_nilai.kd_ajaran','left');
        $this->db->group_by("s_tahun_ajaran.tahun_ajaran");
        $query_totaldata = $this->db->get();

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

        $this->db->select('*');
        $this->db->from('s_nilai', $this->max_per_page, $page);
        $this->db->join('s_nilai','s_nilai.kd_nilai = s_nilai.kd_nilai','left');
        $this->db->join('s_pengajar','s_pengajar.nip = s_nilai.nip','left');
        $this->db->join('s_tahun_ajaran','s_tahun_ajaran.kd_ajaran = s_nilai.kd_ajaran','left');
        $this->db->group_by("s_tahun_ajaran.tahun_ajaran");
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

    public function addnilai($request) 
    {
        // menambahkan data nilai pada request berdasarkan data json
        // data $request akan dimasukan pada fungsi addnilai ini melalui controller.
        $query = $this->db->insert('s_nilai', $request);
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data nilai berhasil disimpan";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] = 500;
            $this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses di controller sebagai httpcode dan respon dari web services 
        return $this->response;
    }

    public function editnilai($kd_nilai,$request)
    {
        // data $request dan $kd_nilai akan dimasukan pada fungsi editnilai ini melalui controller.
        $this->db->where('kd_nilai', $kd_nilai);
        $query = $this->db->update('s_nilai', $request);
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data nilai berhasil diubah";
            $this->response['data'] = $request;
        }else{
            // jika query gagal atau error maka akan menampilkan httpcode 500(internal server error)
            $this->response['status_code'] =  500;
			$this->response['status_message'] = $this->db->error();
        }
        // mengembalikan nilai request untuk diproses dicontroller sebagai http code dan respon dari web services
		return $this->response;
    }

    public function deletenilai($kd_nilai)
    {
        // data $request dan $kd_nilai akan dimasukan pada fungsi deletenilai ini melalui controller.
        $this->db->where('kd_nilai', $kd_nilai);
        $query = $this->db->delete('s_nilai');
        if($query) {
            // jika query berhasil maka httpcode yang diberikan adalah 200(success)
            $this->response['status_code'] = 200;
            $this->response['status_message'] = "data nilai berhasil dihapus";
            $this->response['data'] = $kd_nilai;
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
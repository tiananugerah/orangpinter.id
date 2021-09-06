<?php 
include_once(APPPATH.'libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class Jadwal extends REST_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('M_jadwal');
	}

	// Menambahkan data jadwal (POST)
	public function index_post(){
		$query = $this->M_jadwal->addjadwal($this->post());
		$this->response($query, $query['status_code']);
	}
	public function editData()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://api.orangpinter.id/wali/single/'.$this->input->post('nik'),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS =>"nik="$this->input->post('nik')"&"
        "nis="$this->input->post('nis')"&"
        "nama="$this->input->post('nama')"&"
        "alamat="$this->input->post('alamat')"&"
        "jk="$this->input->post('jk')"&"
        "status="$this->input->post('status')"&"
        "agama="$this->input->post('agama')"&"
        "no_hp="$this->input->post('no_hp')"&"
        "pekerjaan="$this->input->post('pekerjaan')"&"
        ,
        CURLOPT_HTTPHEADER => array(
        'api_auth_key: f99aecef3d12e02dcbb6260bbdd35189c89e6e73',
        'Content-Type: application/x-www-form-urlencoded',
        'Cookie: ci_session=1a6f0bc92c997fc6d67d79aeca132afc4e6347da'
        ),
    ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        redirect('administrator/wali');
    }
	public function view_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_jadwal->getData('0',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}

	public function search_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevalue){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevalue == null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_jadwal->getData('1',$page, $sortname, $sortvalue, $wherename, $wherevalue);
			$this->response($query, $query['status_code']);
		}
	}


	// Menghapus data jadwal (DELETE)
	public function single_delete($id_jadwal = null){
		$query = $this->M_jadwal->deletejadwal($id_jadwal);
		$this->response($query, $query['status_code']);
	}

	// Mengubah data jadwal (PUT)
	public function single_put($id_jadwal = null){
		$query = $this->M_jadwal->editjadwal($id_jadwal,$this->put());
		$this->response($query, $query['status_code']);
	}


}
?>
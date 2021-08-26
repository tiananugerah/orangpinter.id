<?php 
include_once(APPPATH.'libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends REST_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_user');
	}

	public function email($nis, $username, $email){
		
		// Load PHPMailer library
		$this->load->library('phpmailer_lib');

		// PHPMailer object
		$mail = $this->phpmailer_lib->load();
		
		// SMTP configuration
		$mail->isSMTP();
		$mail->Host     = 'srv127.niagahoster.com'; //sesuaikan sesuai nama domain hosting/server yang digunakan
		$mail->SMTPAuth = true;
		$mail->Username = 'noreply@orangpinter.id'; // user email
		$mail->Password = '1sampai2'; // password email
		$mail->SMTPSecure = 'ssl';
		$mail->Port     = 465;

		$mail->setFrom('noreply@orangpinter.id', 'Activasi Account');

		// Add a recipient
		$mail->addAddress($email);

		// Email subject
		$mail->Subject = 'Activasi Account';

		// Set email format to HTML
		$mail->isHTML(true);
		
        $data = array(
            'nis' 		=> $nis,
            'username' 	=> $username,

        );
		// Email body content
		$mailContent = $this->load->view('email/aktifasi',$data,TRUE) ; // isi email
		$mail->Body = $mailContent;    

		// Send email
        if($mail->send()){
            $isi = array(
                'email' => 'Berhasil',
            );
            //$this->M_user->update($nis, $isi); 
        }else{
            $isi = array(
                'email' => 'gagal'
            );
            //$this->M_user->update($nis, $isi); 
        }
	}
	
	// Menambahkan data User (POST)
	public function index_post(){
		
		$photo_kartu 		= $_FILES['photo_kartu'];
		$photo_pelajar 		= $_FILES['photo_pelajar'];
		$nis 				= $this->input->post("nis");

		if ($photo_kartu=''){}else{
			$config['upload_path'] = 'uploads/photo_kartu';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['file_name'] = $nis;

			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('photo_kartu')){
				$error = array('error' => $this->upload->display_errors());
				echo $error;
			}else{
				$pas_photo = $this->upload->data('photo_kartu');
			}
		}
		if ($photo_pelajar=''){}else{
			$config['upload_path'] = 'uploads/photo_pelajar';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['file_name'] = $nis;

			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('photo_pelajar')){
				$error = array('error' => $this->upload->display_errors());
				echo $error;
			}else{
				$pas_photo = $this->upload->data('photo_pelajar');
			}
		}
		$data = array(
		'nis'          	=> $this->input->post("nis"),
		'username'      => $this->input->post("username"),
		'password'    	=> $this->input->post("password"),
		'email' 		=> $this->input->post("email"),
		'no_tlp'        => $this->input->post("no_tlp"),
		'foto_kartu'   	=> $this->input->post("nis").'kartu',
		'foto_pelajar' 	=> $this->input->post("nis").'pelajar',
		);
		$this->email($this->input->post("nis"),$this->input->post("username"),$this->input->post("email"));
		$query = $this->M_user->addUser($data);		
		$this->response($query, $query['status_code']);
	}

	public function view_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevaluen = null, $wherepass = null, $wherevaluep = null){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevaluen == null ||  $wherepass == null || $wherevaluep = null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_user->getData('0',$page, $sortname, $sortvalue, $wherename, $wherevaluen, $wherepass, $wherevaluep );
			$this->response($query, $query['status_code']);
		}
	}

	public function search_get($page = null, $sortname = null, $sortvalue = null, $wherename = null, $wherevaluen = null, $wherepass = null, $wherevaluep = null){
		if($page == null || $sortname == null || $sortvalue == null || $wherename == null || $wherevaluen == null ||  $wherepass == null || $wherevaluep = null){
			$this->response('api parameter required', 500);
		} else {
			$query = $this->M_user->getData('1',$page, $sortname, $sortvalue, $wherename, $wherevaluen, $wherepass, $wherevaluep );
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	public function Admin()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('query_model','qm',TRUE);
	}
	public function index()
	{	
		 // if (strpos($_SERVER['HTTP_USER_AGENT'], 'Electron') !== false) {
			if ($this->session->userdata('admin') != "") {
				redirect('admin/dashboard');
			}
			if (isset($_POST['login'])) {
				$where = array(
					'email' => $_POST['username']
				);
				$validate = $this->qm->select_where('tbl_admin', $where);
				if(count($validate) >0){
					if(password_verify($_POST['password'], $validate[0]['password'])){
						$fields = array(
							'app' => ADMIN_TITLE,
							'name'  => $validate[0]['name'],
							'email' => $validate[0]['email'],
							'ip' => $this->getUserIP()
						);
						$ch = curl_init();
						curl_setopt( $ch, CURLOPT_URL, 'http://phpstack-94168-544594.cloudwaysapps.com/admin/get_admin_users_data');
						curl_setopt( $ch, CURLOPT_POST, true );
						curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
						curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields);
						$result = curl_exec($ch);
						curl_close($ch);
						if(json_decode($result)->status == 1){
							$this->session->set_userdata('admin', $validate[0]['name']);
							$this->session->set_userdata('email', $validate[0]['email']);
							$this->session->set_userdata('admin_id', $validate[0]['admin_id']);
							redirect('admin/dashboard', 'refresh');
						}else{
							$view_data['error'] = "Username OR Password is incorrect.";
							$this->load->view('login', $view_data);
						}
					}else{
						$view_data['error'] = "Username OR Password is incorrect.";
						$this->load->view('login', $view_data);
					}
				}else{
					$view_data['error'] = "Username OR Password is incorrect.";
					$this->load->view('login', $view_data);
				}
			}else{
				$this->load->view('login');
			}
		 // }else{
		 // 	show_404();
		 // }
	}
	public function dashboard()
	{
		$data['setting'] = $this->qm->select_where_row('tbl_setting',['id'=>1]);
		if($this->session->userdata('admin')!= ""){
			$this->load->view('super_admin/header');
			$this->load->view('super_admin/dashboard',$data);
			$this->load->view('super_admin/footer');
		}else{
			redirect('admin');
		}
	}

	public function changePass()
	{
		$new_pswd = $_POST['new_pswd'];
		$admin_id = $this->session->userdata('admin_id');
		$where = array (
			'admin_id' => $admin_id
		);
		$num_row = $this->qm->select_row('tbl_admin',$where);
		if(count($num_row) > 1)
		{
			$what = array (
				'password' => password_hash($new_pswd, PASSWORD_DEFAULT)
			);
			$where = array (
				'admin_id' => $admin_id
			);
			$this->qm->updt('tbl_admin',$what,$where);
			$this->session->sess_destroy();
			echo '1';
		} else {
			echo '0';
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}

	//Paytm Request Notification Masage
	public function getNotiMsg(){
		$val = $_POST['val'];
		$key = $_POST['key'];
		$this->qm->updt("tbl_setting",array($key=>$val),array('id'=>1));
	}
	public function getUserCount(){
		$date = $_POST['val'];
		$where=['(DATE_FORMAT(create_date,"%Y-%m-%d"))'=>$date];
		$usercnt=$this->qm->num_where_row('tbl_users',$where);
		echo $usercnt;
	}

	function getUserIP()
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'Unknown IP Address';
		return $ipaddress;
	}

}

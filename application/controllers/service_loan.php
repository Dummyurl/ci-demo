<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Service_loan extends CI_Controller
{
	public $response;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('encdec_paytm');
		$this->load->model('query_model', 'qm', TRUE);
		$this->load->library('session');
		$this->response = [
			'status' => '0',
			'message' => "Error!"
		];
		header('rendom:'.$this->qm->encryptdfg(token.'='.date("Y-m-d H:i:s")));
		header('Content-Type: application/json');
	}

	public function version()
	{	
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			$version = $_REQUEST['version'];
			$result = $this->qm->select_where_row('tbl_setting',['id'=>1]);
			if($version == $result['version']){
				$this->response = [
					'status' => "1",
					'message' => "Success",
				];
			}else{
				$this->response = [
					'status' => "0",
					'message' => "Update",
				];
			}	
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
	}

	//application status
	public function app_status()
	{	
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			$app_status = $_REQUEST['app_status'];
			$result = $this->qm->select_where_row('tbl_setting',['id'=>1]);
			if($app_status == $result['app_status']){
				$this->response = [
					'status' => "1",
					'message' => "Success",
				];
			}else{
				$this->response = [
					'status' => "0",
					'message' => "Update",
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
	}

	//add status
	public function ad_status()
	{	
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			$ad_status = $_REQUEST['ad_status'];
			$result = $this->qm->select_where_row('tbl_setting',['id'=>1]);
			if($ad_status == $result['ad_status']){
				$this->response = [
					'status' => "1",
					'message' => "Success",
				];
			}else{
				$this->response = [
					'status' => "0",
					'message' => "Update",
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
	}

	//Check Referral
	public function check_referral()
	{
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			$referral = $_REQUEST['referral'];
			if((($this->qm->num_where_row('tbl_users',['refferal_key'=>$referral])) > 0) OR ($referral == 'XXXXXXX')){
				$this->response = [
					'status' => "1",
					'message' => "Success!"
				];
			}else{
				$this->response = [
					'status' => "0",
					'message' => "Invalid referrel code!"
				];
			}	
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
		
	}
	
	public function ssdfsff_886671fdsd()
	{	
		$referral = isset($_REQUEST['referral']) ? $_REQUEST['referral'] : 'XXXXXXX';
		$mobile = $_REQUEST['mobile'];
		$imei = $_REQUEST['imei'];
		$token = $_REQUEST['token'];
		$imei1 = $_REQUEST['imei1'];
		$app_id = $_REQUEST['app_id'];
		$fbid = $_REQUEST['fbid'];
		$username = $_REQUEST['uname'];

		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if ($mobile!== '0123456789' && $mobile!== '1234567890' && $mobile!== '123456789' && $mobile!== '0123123123') {	
				if (($this->is_imei($imei)) == 1) {
					if($this->validate_imei($imei)){
						if (($this->qm->num_where_row('tbl_users', ['mobile' => $mobile])) > 0) {
							if (($this->qm->num_where_row('tbl_users', ['imei1' => $imei1,'fbid'=>$fbid,'mobile' => $mobile,'imei' => $imei])) > 0) {
								$user = $this->qm->select_where_row('tbl_users', ['mobile' => $mobile]);
								$dataxxx['user_id'] = $this->qm->encryptCryptParam($user['user_id'])	;
								$dataxxx['unique_id'] = $this->qm->encryptCryptParam($user['unique_id']);
								$dataxxx['username'] = $this->qm->encryptCryptParam($user['username']);
								$dataxxx['referral'] = $this->qm->encryptCryptParam($user['referral']);
								$dataxxx['refferal_key'] = $this->qm->encryptCryptParam($user['refferal_key']);
								$dataxxx['mobile'] = $this->qm->encryptCryptParam($user['mobile']);
								$dataxxx['profile'] = $this->qm->encryptCryptParam(IMAGE."profile/".$user['profile']);
								$dataxxx['status'] = $this->qm->encryptCryptParam($user['status']);
								if ($user['status'] == 1) {
									$this->qm->updt('tbl_users', ['token' => $token], ['user_id' => $user['user_id']]);
									$this->response = [
										'status' => "1",
										'message' => "Login successful",
										'IMAGE_URL' => $this->qm->encryptCryptParam(IMAGE . 'avatars/profile.jpg'),
										'user_data' => $dataxxx
									];
								} else {
									$this->response = [
										'status' => '2',
										'message' => "You are blocked, contact admin to active your account!"
									];
								}
							} else {
								$this->response = [
									'status' => '2',
									'message' => "This account registred to another device!"
								];
							}
						} else {
							if (($this->qm->num_where_row('tbl_users', ['imei' => $imei])) > 0) {
								$this->response = [
									'status' => "0",
									'message' => "This device registred to another account..!"
								];
							} else {
								$profiled= '';
								if (isset($_POST['profile']) && ($_POST['profile']) != "") {
									$profile = $_POST['profile'];
									$binary=base64_decode($profile);
									header('Content-Type: bitmap; charset=utf-8');
									$file_name = rand(11111111, 99999999).'.png';
									$file = fopen('./images/profile/'.$file_name, 'wb');
									fwrite($file, $binary);
									fclose($file);
									$profiled = $file_name;
								}
								
								$data = [
									'refferal_key' => rand(000,999).rand(0000,9999),
									'referral' => $referral,
									'username' => $username,
									'fbid' => $fbid,
									'mobile' => $mobile,
									'profile' => $profiled,
									'imei' => $imei,
									'token' => $token,
									'status' => 1,
									'unique_id' => $this->randomString(),
									'create_date' => date('Y-m-d H:i:s'),
									'user_ips' => $this->getUserIP(),
									'imei1' => $imei1,
									'app_id' => $app_id
								];

								if (($this->qm->num_where_row('tbl_users', ['mobile' => $mobile])) > 0) {
									$this->response = [
										'status' => "0",
										'message' => "This mobile registred to another account.."
									];
								}else{	
									$xxx = $data['user_ips'];
									if (($this->qm->num_where_row('tbl_users', ['user_ips' => $xxx])) > 5000) {
										$this->response = [
										'status' => "0",
										'message' => "Something Wrong!"
									];
									}else{
										if (($this->qm->num_where_row('tbl_users', ['mobile' => $mobile])) > 0) {
											$this->response = [
												'status' => "0",
												'message' => "This mobile registred to another account.."
											];
										}else{
											$insert_id = $this->qm->ins('tbl_users', $data);
											if ($insert_id > 0) {
												$refUser = $this->qm->select_where_row('tbl_users', ['refferal_key' => $referral]);
												if (!empty($refUser)) {
													$setting = $this->qm->select_where_row('tbl_setting', ['id' => 1]);
													$joinincm = $setting['join_referral'];
													$this->qm->increment('tbl_users', array('user_id' => $refUser['user_id']), $joinincm, 'balance');
													$this->qm->increment('tbl_users', array('user_id' => $refUser['user_id']), $joinincm, 'referral_balance');
													$this->qm->increment('tbl_users', array('user_id' => $refUser['user_id']), '1', 'referral_count');
												}
												$user = $this->qm->select_where_row('tbl_users', ['user_id' => $insert_id]);
												$dataxxx['user_id'] = $this->qm->encryptCryptParam($user['user_id']);
												$dataxxx['unique_id'] = $this->qm->encryptCryptParam($user['unique_id']);
												$dataxxx['username'] = $this->qm->encryptCryptParam($user['username']);
												$dataxxx['referral'] = $this->qm->encryptCryptParam($user['referral']);
												$dataxxx['refferal_key'] = $this->qm->encryptCryptParam($user['refferal_key']);
												$dataxxx['mobile'] = $this->qm->encryptCryptParam($user['mobile']);
												$dataxxx['profile'] = $this->qm->encryptCryptParam(IMAGE."profile/".$user['profile']);
												$dataxxx['status'] = $this->qm->encryptCryptParam($user['status']);
												$this->response = [
													'status' => "1",
													'message' => "SignUp successful",
													'IMAGE_URL' => $this->qm->encryptCryptParam(IMAGE . 'avatars/profile.jpg'),
													'user_data' => $dataxxx
												];
											}
										}
										
									}
								}
							}
						}
					}else{
						$this->response = [
							'status' => '0',
							'message' =>'Your devices not verify!',
						];
					}
				}else {
					$this->response = [
						'status' => '0',
						'message' =>'Your devices not verify!',
					];	
				}
			} else {
				$this->response = [
					'status' => '2',
					'message' =>"This mobile registred to another account"
				];
			}	
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
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
	
	//Daily Task
	public function task()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$app_id = $_POST['app_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$result = $this->qm->select_where_row('tbl_setting',['id'=>1]);
				$dailywork = $this->qm->select_where_row('tbl_work',['today'=>date('Y-m-d'),'user_id'=>$_POST['user_id']]);
				if($dailywork){
					$completed_value = [
						'impression'=>$this->qm->encryptCryptParam((int)$dailywork['impression']),
						'click'=>$this->qm->encryptCryptParam((int)$dailywork['click']),
						'installed'=>$this->qm->encryptCryptParam((int)$dailywork['installed'])
					];
					$completed = $dailywork['impression']+$dailywork['click']+$dailywork['installed'];
					
					$earning_price = [
						'impression_earn'=>$this->qm->encryptCryptParam(number_format($dailywork['impression_earn'],2)),
						'click_earn'=>$this->qm->encryptCryptParam(number_format($dailywork['click_earn'],2)),
						'install_earn'=>$this->qm->encryptCryptParam(number_format($dailywork['install_earn'],2))
					];
					$total_earning = $dailywork['impression_earn']+$dailywork['click_earn']+$dailywork['install_earn'];

				}else{
					$completed_value = [
						'impression'=>$this->qm->encryptCryptParam(0),
						'click'=>$this->qm->encryptCryptParam(0),
						'installed'=>$this->qm->encryptCryptParam(0)
					];
					$completed = 0;

					$earning_price = [
						'impression_earn'=>$this->qm->encryptCryptParam(0),
						'click_earn'=>$this->qm->encryptCryptParam(0),
						'install_earn'=>$this->qm->encryptCryptParam(0)
					];
					$total_earning = 0;

				}
				$task_arr = explode(',',$result['task']);
				$values_count = array_count_values($task_arr);
				$task=[
					'impression'=>$values_count[1] ? $this->qm->encryptCryptParam($values_count[1]) : $this->qm->encryptCryptParam(0),
					'click'=>$values_count[2] ? $this->qm->encryptCryptParam($values_count[2]) : $this->qm->encryptCryptParam(0),
					'installed'=>$values_count[3] ? $this->qm->encryptCryptParam($values_count[3]) : $this->qm->encryptCryptParam(0)
				];
				$count = count($task);

				if($task){
					$this->response = [
						'status' => '1',
						'message' => "Successful",
						'total_task'=>$this->qm->encryptCryptParam($count),
						'completed_task' => $this->qm->encryptCryptParam($completed),
						'total_earning' => $this->qm->encryptCryptParam($total_earning),
						'task' => $task,
						'completed' => $completed_value,		
						'earning_price' => $earning_price,
						'currunt_task' => $this->qm->encryptCryptParam((int)$task_arr[$completed]),
						'timer' => $this->qm->encryptCryptParam($result['timer']*1000),
						'timer1' => $this->qm->encryptCryptParam($result['timer1']*1000)
						
					];
				}else{
					$this->response = [
						'status' => '0',
						'message' => "Fail !"
					];
				}
			} else {
				$this->response = [
					'status' => '2',
					'message' => "You are blocked, contact admin to active your account!"
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
			
	}
	
	//Daily Task
	public function spin_task()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$app_id = $_POST['app_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$result = $this->qm->select_where_row('tbl_setting',['id'=>1]);
				$dailywork = $this->qm->select_where_row('tbl_work',['today'=>date('Y-m-d'),'user_id'=>$_POST['user_id']]);
				$dailywork1 = $this->qm->select_where_row('tbl_today_click',['today'=>date('Y-m-d'),'user_id'=>$_POST['user_id']]);
				if($dailywork){
					$qq = $dailywork1['installed']+$dailywork1['installed1'];
					$completed = [
						'spin'=>$this->qm->encryptCryptParam($dailywork['spin']),
						'today_points'=>$this->qm->encryptCryptParam($dailywork['points']),
						'installed'=>$this->qm->encryptCryptParam($qq)
					];
				}else{
					$completed = [
						'spin'=>$this->qm->encryptCryptParam("0"),
						'today_points'=>$this->qm->encryptCryptParam("0"),
						'installed'=>$this->qm->encryptCryptParam("0")
					];
				}
				$count = [
					'total_spin'=>$this->qm->encryptCryptParam($result['spin']),
					'total_install'=>$this->qm->encryptCryptParam($result['install_click'])
				];
				$this->response = [
					'status' => '1',
					'message' => "Successful",
					'total'=>$count,
					'completed' => $completed
				];
			} else {
				$this->response = [
					'status' => '2',
					'message' => "You are blocked, contact admin to active your account!"
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
			
	}

	

	//Daily Work
	public function work()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$app_id = $_POST['app_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];

		$task = $_POST['task'];
		$referral = $_POST['referral'];

		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$where = array('user_id'=>$user_id, 'today'=>date('Y-m-d'));
				if(($this->qm->num_where_row('tbl_work', $where)) == 0){ $this->qm->ins('tbl_work', $where); }
				$setting = $this->qm->select_where_row('tbl_setting',array('id'=>1));
				$dailywork['impression'] = 0;
				$dailywork['click'] = 0;
				$dailywork['installed'] = 0;
				$dailywork = $this->qm->select_where_row('tbl_work',['today'=>date('Y-m-d'),'user_id'=>$_POST['user_id']]);
				$task_arr = explode(',',$setting['task']);
				$values_count = array_count_values($task_arr);
				$work_today = $this->qm->select_where_row('tbl_work', ['user_id'=>$user_id]);
					if ($task == 1) {
						if($values_count[1] > $dailywork['impression']){
							$this->qm->increment('tbl_work', $where,1,'impression'); 
							$this->qm->increment('tbl_work', $where, $setting['imp_earn'],'impression_earn');
							$this->qm->increment('tbl_users', array('user_id'=>$user_id), $setting['imp_earn'],'balance');
							$level_arr = $this->qm->select_all('tbl_level');
							foreach ($level_arr as $l) {
								$user = $this->qm->select_where_row('tbl_users', ['refferal_key' => $referral]);
								if ($user) {
									if ($l['price'] != 0) {
										$what = (float)(round($setting['imp_earn'] * $l['price'] / 100, 2));
										$this->qm->increment('tbl_users', ['user_id' => $user['user_id']], $what, 'referral_balance');
										$this->qm->increment('tbl_users', ['user_id' => $user['user_id']], $what, 'balance');
									}
									$referral = $user['referral'];
								}
							}
						}
						$this->response = [
							'status' => '1',
							'message' => "Successful!"
						];
					}
		
					if ($task == 2) {
						if($values_count[2] > $dailywork['click']) {
							$this->qm->increment('tbl_work', $where, 1, 'click');
							$this->qm->increment('tbl_work', $where, $setting['click_earn'], 'click_earn');
							$this->qm->increment('tbl_users', array('user_id' => $user_id), $setting['click_earn'], 'balance');
							$level_arr = $this->qm->select_all('tbl_level');
							foreach ($level_arr as $l) {
								$user = $this->qm->select_where_row('tbl_users', ['refferal_key' => $referral]);
								if ($user) {
									if ($l['price'] != 0) {
										$what = (float)(round($setting['click_earn'] * $l['price'] / 100, 2));
										$this->qm->increment('tbl_users', ['user_id' => $user['user_id']], $what, 'referral_balance');
										$this->qm->increment('tbl_users', ['user_id' => $user['user_id']], $what, 'balance');
									}
									$referral = $user['referral'];
								}
							}
						}
						$this->response = [
							'status' => '1',
							'message' => "Successful!",
						];
					}
					
					if ($task == 3) {
						if($values_count[3] > $dailywork['installed']) {
							$dump = $_POST['dump'];
							if($dump == 1){
								$this->qm->increment('tbl_work', $where, 1, 'installed');
								$this->qm->increment('tbl_work', $where, $setting['install_earn'], 'install_earn');
								$this->qm->increment('tbl_users', array('user_id' => $user_id), $setting['install_earn'], 'balance');
								$level_arr = $this->qm->select_all('tbl_level');
								foreach ($level_arr as $l) {
								$user = $this->qm->select_where_row('tbl_users', ['refferal_key' => $referral]);
								if ($user) {
									if ($l['price'] != 0) {
										$what = (float)(round($setting['install_earn'] * $l['price'] / 100, 2));
										$this->qm->increment('tbl_users', ['user_id' => $user['user_id']], $what, 'referral_balance');
										$this->qm->increment('tbl_users', ['user_id' => $user['user_id']], $what, 'balance');
									}
									$referral = $user['referral'];
								}
								}
							}
							if($dump == 0){
								$this->qm->increment('tbl_work', $where, 1, 'installed');
								$this->qm->increment('tbl_work', $where, 0, 'install_earn');
								$this->qm->increment('tbl_users', array('user_id' => $user_id), 0, 'balance');
							}
							$this->response = [
								'status' => '1',
								'message' => "Successful!",
							];
						}
					}	
				} else {
					$this->response = [
						'status' => '2',
						'message' => "You are blocked, contact admin to active your account!"
					];
				}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
	}

	//Daily coin
	public function today_coin()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$app_id = $_POST['app_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];

		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$where = array('user_id'=>$user_id, 'today'=>date('Y-m-d'));
				if(($this->qm->num_where_row('tbl_today_coin', $where)) == 0){ $this->qm->ins('tbl_today_coin', $where); }
				$setting = $this->qm->select_where_row('tbl_setting',array('id'=>1));
				$dailywork['coin'] = 0;
				$dailywork['earn'] = 0;
				$dailywork = $this->qm->select_where_row('tbl_today_coin',['today'=>date('Y-m-d'),'user_id'=>$_POST['user_id']]);
				$total_dailywork = $dailywork['coin'];
				if($setting['coin_click'] > $total_dailywork) {
					$dump = $_POST['dump'];
					if($dump == 1){
						$this->qm->increment('tbl_today_coin', $where, 1, 'coin');
						$this->qm->increment('tbl_today_coin', $where, $setting['money_per_coin'],'earn');
						$this->qm->increment('tbl_users', array('user_id' => $user_id), $setting['money_per_coin'], 'balance');	
					}
					if($dump == 0){
						$this->qm->increment('tbl_today_coin', $where, 1, 'coin');
						$this->qm->increment('tbl_today_coin', $where, 0,'earn');
					}
					$dailywork11 = $this->qm->select_where_row('tbl_today_coin',['today'=>date('Y-m-d'),'user_id'=>$_POST['user_id']]);
					$user11 = $this->qm->select_where_row('tbl_users',['user_id'=>$_POST['user_id']]);
					$zz= $dailywork11['coin'];
					$this->response = [
						'status' => '1',
						'message' => "Successful!",
						'total_coin'=>$this->qm->encryptCryptParam($setting['coin_click']),
						'data' =>[
							'completed_coin' => $this->qm->encryptCryptParam($zz),
							'total_balance' => $this->qm->encryptCryptParam($user11['balance'])
						]
					];	
				}else {	
					$user12 = $this->qm->select_where_row('tbl_users',['user_id'=>$_POST['user_id']]);
					$this->response = [
						'status' => '2',
						'message' => "Try tomorrow!",
						'total_coin'=>$this->qm->encryptCryptParam($setting['coin_click']),
						'data' =>[
							'completed_coin' => $this->qm->encryptCryptParam($total_dailywork),
							'total_balance' => $this->qm->encryptCryptParam($user12['balance'])
						]
					];
				}
				} else {
					$this->response = [
						'status' => '2',
						'message' => "You are blocked, contact admin to active your account!"
					];
				}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
	}

	//Get coin
	public function get_coin()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$app_id = $_POST['app_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];

		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$setting = $this->qm->select_where_row('tbl_setting',array('id'=>1));
				if (($this->qm->num_where_row('tbl_today_coin',['user_id'=>$user_id,'today'=>date('Y-m-d')])) > 0) {
					$dailywork = $this->qm->select_where_row('tbl_today_coin',['today'=>date('Y-m-d'),'user_id'=>$_POST['user_id']]);
					$user11 = $this->qm->select_where_row('tbl_users',['user_id'=>$_POST['user_id']]);
					$this->response = [
						'status' => '1',
						'message' => "Successful!",
						'data' => [
							'total_coin'=>$this->qm->encryptCryptParam($setting['coin_click']),
							'completed_coin'=>$this->qm->encryptCryptParam($dailywork['coin']),
							'total_balance'=>$this->qm->encryptCryptParam($user11['balance'])
						]
					];
				}else{
					$user12 = $this->qm->select_where_row('tbl_users',['user_id'=>$_POST['user_id']]);
					$this->response = [
						'status' => '1',
						'message' => "Successful!",
						'data' => [
							'total_coin'=>$this->qm->encryptCryptParam($setting['coin_click']),
							'completed_coin'=>$this->qm->encryptCryptParam("0"),
							'total_balance'=>$this->qm->encryptCryptParam($user12['balance'])
						]
					];
				}
			} else {
				$this->response = [
					'status' => '2',
					'message' => "You are blocked, contact admin to active your account!"
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
	}

	//Today earn
	public function daily_earn()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$app_id = $_POST['app_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$setting = $this->qm->select_where_row('tbl_setting',array('id'=>1));
				$this->qm->increment('tbl_users', array('user_id' => $user_id), $setting['today_earn'], 'balance');
				$this->response = [
					'status' => '1',
					'message' => "Success!"
				];
			}else{
				$this->response = [
					'status' => '2',
					'message' => "You are blocked, contact admin to active your account!"
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}	
		echo json_encode($this->response);
	}

	//CheckIn earn
	public function checkin_earn()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$date = date('Y-m-d');
		$app_id = $_POST['app_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$user = $this->qm->select_where_row('tbl_users', ['user_id' => $user_id,'unique_id' => $unique_id]);
				if ($user['today_date'] >= $date) {
					$this->response = [
						'status' => '0',
						'message' => "You already get daily Bonus."
					];
				}else{
					$setting = $this->qm->select_where_row('tbl_setting', ['id' => 1]);
					$this->qm->increment('tbl_users', array('user_id' => $user_id), $setting['today_earn1'], 'balance');
					$this->qm->updt('tbl_users',['today_date'=>$date,],['user_id'=>$user_id]);
					$this->response = [
						'status' => '1',
						'message' => "CheckIn Bonus Add Successfully."
					];
				}
			}else{
				$this->response = [
					'status' => '2',
					'message' => "You are blocked, contact admin to active your account!"
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}	
		echo json_encode($this->response);
	}
	
	//DownLine
	public function downline()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$app_id = $_POST['app_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$mobile = $_POST['mobile'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$field = ['username','mobile','profile','referral_count'];
				$results = $this->qm->select_field_where('tbl_users',$field,array('referral'=>$mobile));
				$network_data = array();
				foreach($results as $result){
					$asd = [
						'username' => $this->qm->encryptCryptParam($result['username']),
						'mobile' => $this->qm->encryptCryptParam($result['mobile']),
						'profile' => $this->qm->encryptCryptParam($result['profile']),
						'referral_count' => $this->qm->encryptCryptParam($result['referral_count']),
					];
					array_push($network_data,$asd);
				}
				if ($network_data) {
					$this->response = [
						'status' => '1',
						'message' => "Success!",
						'data' => $network_data
					];
				} else {
					$this->response = [
						'status' => '0',
						'message' => "There are no any users!",
						'data' => array()
					];
				}
			}else{
				$this->response = [
					'status' => '2',
					'message' => "You are blocked, contact admin to active your account !"
				];
			}
			echo json_encode($this->response);
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
			echo json_encode($this->response);
		}
	}

	//Total Balance
	public function balance()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$app_id = $_POST['app_id'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
					$today = date('Y-m-d');
					$user_data = $this->qm->select_where_row('tbl_users', array('user_id'=>$user_id));
					$setting = $this->qm->select_where_row('tbl_setting', ['id' => 1]);
					$work_today = $this->qm->select_where_row('tbl_work', ['user_id'=>$user_id,'today'=>$today]);
					$pay_result = $this->qm->singlerawSelectQuery("SELECT SUM(amount) as withdraw FROM tbl_payreq WHERE user_id = '".$user_id."' AND (payStatus = 2 OR payStatus = 1)");
					$bank_result = $this->qm->singlerawSelectQuery("SELECT SUM(amount) as withdraw FROM tbl_transfer WHERE user_id = '".$user_id."' AND (transStatus = 2 OR transStatus = 1)");
					
					$data['total'] = $this->qm->encryptCryptParam(round($user_data['balance'],2));
					$data['referral_balance'] = $this->qm->encryptCryptParam(round($user_data['referral_balance'],2));
					$data['paytm_amount'] = $this->qm->encryptCryptParam(round($user_data['balance']*$setting['paytm_per']/100,2));
					$data['recharge_amount'] = $this->qm->encryptCryptParam(round($user_data['balance']*$setting['transfer_per']/100,2));
					$data['spin'] = $this->qm->encryptCryptParam($setting['spin']-$work_today['spin']);
					$data['points'] = $this->qm->encryptCryptParam($work_today['points'] ? $work_today['points'] : 0);
					$data['withdrawal'] = $this->qm->encryptCryptParam(round(($pay_result['withdraw']+$bank_result['withdraw']),2));
					$this->response = [
						'status'=>'1',
						'message'=>'Success!',
						'balance' => $data
					];
			}else{
				$this->response = [
					'status' => "2",
					'message' => "You are blocked, contact admin to active your account!",
					'balance' => array()
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
		
	}

	//Application List
	public function application()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$app_id = $_POST['app_id'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$result = $this->qm->select_all('tbl_application');
				if ($result) {
					$this->response = [
						'status' => '1',
						'message' => "Success!",
						'host_url' => IMAGE.'app_icon/',
						'application' => $result
					];
				} else {
					$this->response = [
						'status' => '0',
						'message' => "There are no result found!",
						'host_url' => IMAGE.'app_icon/',
						'application' => array()
					];
				}
			}else{
				$this->response = [
					'status' => '2',
					'message' => "You are blocked, contact admin to active your account !"
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
	}

	//Withdrow History
	public function withdraw_history()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$app_id = $_POST['app_id'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$results = $this->qm->selectQuery("SELECT mobile as mobile, amount, payStatus as status, pay_datetime  FROM tbl_payreq WHERE user_id='".$user_id."'");
				$payreq = array();
				foreach($results as $result){
					$asd = [
						'mobile' => $this->qm->encryptCryptParam($result['mobile']),
						'amount' => $this->qm->encryptCryptParam($result['amount']),
						'status' => $this->qm->encryptCryptParam($result['status']),
						'pay_datetime' => $this->qm->encryptCryptParam($result['pay_datetime'])
					];
					array_push($payreq, $asd);
				}
				if ($payreq) {
					$this->response = [
						'status' => "1",
						'message' => "Success!",
						'withdraw' => $payreq
					];
				} else {
					$this->response = [
						'status' => "0",
						'message' => "There are no history!",
						'withdraw' => array()
					];
				}
			}else{
				$this->response = [
					'status' => "2",
					'message' => "You are blocked, contact admin to active your account !"
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);	
	}

	//Paytm Request
	public function payrequest()
	{
		$user_id = $_REQUEST['user_id'];
		$unique_id = $_POST['unique_id'];
		$mobile = $_REQUEST['mobile'];
		$payment_by = $_REQUEST['payment_by'];
		$amount =  (float)($_REQUEST['amount']);
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$app_id = $_POST['app_id'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			$userBal = $this->qm->select_where_row('tbl_users', ['user_id' => $user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei]);
			if ($userBal['status'] == 1) {
				$setting = $this->qm->select_where_row('tbl_setting', ['id' => 1]);
				if(($setting['paytm_per']*$userBal['balance']/100) >= $amount) {
					if($setting['paytm_min'] <= $amount){
						if($setting['paytm_max'] >= $amount){
							$checkReq = $this->qm->num_where_row('tbl_payreq',['user_id'=>$user_id,'req_date'=>date('Y-m-d')]);
							if($checkReq < $setting['paytm_limit']) {
								$data['user_id'] = $user_id;
								$data['mobile'] = $mobile;
								$data['payment_by'] = $payment_by;
								$data['amount'] = $amount;
								$data['req_date'] = date('Y-m-d');
								$data['req_time'] = date('H:i:s');
								$data['pay_datetime'] = date('Y-m-d H:i:s');
								if (isset($_POST['barcode']) && ($_POST['barcode']) != "") {
									$barcode = $_POST['barcode'];
									$binary=base64_decode($barcode);
									header('Content-Type: bitmap; charset=utf-8');
									$file_name = rand(11111111, 99999999).'.png';
									$file = fopen('./images/barcode/'.$file_name, 'wb');
									fwrite($file, $binary);
									fclose($file);
									$data['barcode'] = $file_name;
								}
								$insertId = $this->qm->ins('tbl_payreq', $data);
								if ($insertId) {
									//Update User Balance
									$this->qm->decrement('tbl_users', ['user_id' => $user_id], $amount, 'balance');
									$this->xransfer($insertId,$data);
									$this->response = [
										'status' => '1',
										'message' => "Your request has been sent!",
									];
								} else {
									$this->response = [
										'status' => '0',
										'message' => "Failed!"
									];
								}
							}else{
								$this->response = [
									'status' => '0',
									'message' => $setting['paytm_limit_msg']
								];
							}
						}else{
							$this->response = [
								'status' => '0',
								'message' => 'Maximum request amount '.$setting['paytm_max'].' Rs.'
							];
						}
						
					}else{
						$this->response = [
							'status' => '0',
							'message' => 'Minimum request amount '.$setting['paytm_min'].' Rs.'
						];
					}
				}else{
					$this->response = [
						'status' => '0',
						'message' => 'Minimum amount required '.$setting['paytm_per'].'%.'
					];
				}
			}else{
				$this->response = [
					'status' => '2',
					'message' => "You are blocked, contact admin to active your account !"
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
	}

	//Ads List
	public function ads()
	{
		$user_id = $_REQUEST['user_id'];
		$unique_id = $_POST['unique_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$app_id = $_POST['app_id'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$result = $this->qm->select_row('tbl_setting');
				$data = [
					'banner' => $this->qm->encryptCryptParam($result['banner']),
					'banner2' => $this->qm->encryptCryptParam($result['banner2']),
					'banner3' => $this->qm->encryptCryptParam($result['banner3']),
					'interstrial' => $this->qm->encryptCryptParam($result['interstrial']),
					'reward_video' => $this->qm->encryptCryptParam($result['reward_video']),
					'ad_status' => $this->qm->encryptCryptParam($result['ad_status']),
					'startapp_video' => $this->qm->encryptCryptParam($result['startapp_video']),
					'fb_bannerid' => $this->qm->encryptCryptParam($result['fb_bannerid']),
					'fb_fullscreenid' => $this->qm->encryptCryptParam($result['fb_fullscreenid']),
					'fb_native' => $this->qm->encryptCryptParam($result['fb_native'])
				];
				if ($result) {
					$this->response = [
						'status' => '1',
						'message' => "Success!",
						'ads' => $data
					];
				} else {
					$this->response = [
						'status' => '0',
						'message' => "Failed!"
					];
				}
			}else{
				$this->response = [
					'status' => '2',
					'message' => "You are blocked, contact admin to active your account !"
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
	}

	public function xransfer($idx,$datax){
		$userArr = $this->qm->select_where_row('tbl_users',array('user_id'=>$datax['user_id']));
		$setting = $this->qm->select_where_row('tbl_setting',array('id'=>1));
		$order_id = "Order-".PAYTM_APP_NAME.'-'.rand('00000','99999').rand('00000','99999').rand('00000','99999').rand('00000','99999').'-'.$idx;
		$data = array( "request" => array("requestType" => null, 
                            "merchantGuid" => PAYTM_MERCHANT_GUID,
                            "merchantOrderId" => $order_id,   
                            "salesWalletName"=> null, 
                            "salesWalletGuid"=>PAYTM_SALES_WALLET_GUID, 
                            "payeeEmailId"=>null, 
                            "payeePhoneNumber"=>$datax['mobile'], 
                            "payeeSsoId"=>"", 
                            "appliedToNewUsers"=>"Y",
                            "amount"=>$datax['amount']-($datax['amount']*28/100),
                            "currencyCode"=>"INR"
                        ),
                        "metadata"=>"Loan Credit Loan", 
                        "ipAddress"=>$_SERVER['SERVER_ADDR'],
                        "platformName"=>"PayTM", 
						"operationType"=>"SALES_TO_USER_CREDIT"
					);
				$requestData=json_encode($data);
				$Checksumhash = $this->encdec_paytm->getChecksumFromString($requestData,PAYTM_MERCHANT_KEY);
				$headerValue = array('Content-Type:application/json','mid:'.PAYTM_MERCHANT_GUID,'checksumhash:'.$Checksumhash);
				$ch = curl_init(PAYTM_GRATIFICATION_URL);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);     
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);   
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headerValue);
                $result = json_decode(curl_exec($ch));		
                if($result->status == 'SUCCESS'){
                    $where=array('pay_id'=>$idx);
                    $data1=array('payStatus'=>1,'notify_msg'=>$setting['accept_msg'],'pay_datetime'=>date('Y-m-d H:i:s'));
                    $this->qm->updt("tbl_payreq",$data1,$where);
                    $this->push_notification($userArr['token'],$setting['accept_msg']);
				}
				if($result->status == 'FAILURE'){
                    $this->qm->increment('tbl_users', array('user_id'=>$datax['user_id']), $amount, 'balance');
                    $where=array('pay_id'=>$idx);
                    $data1=array('payStatus'=>0,'notify_msg'=>$setting['decline_msg'],'pay_datetime'=>date('Y-m-d H:i:s'));
                    $this->qm->updt("tbl_payreq",$data1,$where);
					$this->push_notification($userArr['token'],$setting['decline_msg']);
                }
                if($result->status == 'PENDING'){
                    $where=array('pay_id'=>$idx);
                    $data1=array('payStatus'=>1,'notify_msg'=>$setting['accept_msg'],'pay_datetime'=>date('Y-m-d H:i:s'));
                    $this->qm->updt("tbl_payreq",$data1,$where);
                    $this->push_notification($userArr['token'],$setting['accept_msg']);
                }
	}
	
	public function push_notification($token,$message)
    {
        $firebase_key = $this->qm->select_where_row('tbl_setting',['id'=>1]);
        $registrationIDs = array($token);
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids'  => $registrationIDs,
            'data' => array(
                "message" => (string)$message
            ),
        );
        $headers = array(
            'Authorization: key='.$firebase_key['firebase_key'],
            'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
	}
	
	
	//User Notification
	public function notification()
	{
		$user_id = $_REQUEST['user_id'];
		$unique_id = $_POST['unique_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$app_id = $_POST['app_id'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$sql = "SELECT pay_datetime as date,notify_msg as msg FROM tbl_payreq WHERE user_id = '".$user_id."'";
				$result = $this->qm->rawSelectQuery($sql);
				$sql1 = "SELECT pay_datetime as date,notify_msg as msg FROM tbl_transfer WHERE user_id = '".$user_id."'";
				$result1 = $this->qm->rawSelectQuery($sql1);
				$sql2 = "SELECT noti_date as date,message as msg FROM tbl_notification WHERE is_sound = 0";
				$result2 = $this->qm->rawSelectQuery($sql2);
				$data = array_merge($result,$result1,$result2);
				$records = $this->sort_by('date',$data);
				$dsgfdfg = array();
				foreach($records as $record){
						$asds = [
							'date' => $this->qm->encryptCryptParam($record['date']),
							'msg' => $this->qm->encryptCryptParam($record['msg'])
						];
						array_push($dsgfdfg,$asds);
				}
				if ($dsgfdfg) {
					$this->response = [
						'status' => '1',
						'message' => "Success!",
						'data' => $dsgfdfg
					];
				} else {
					$this->response = [
						'status' => '0',
						'message' => "Failed!",
						'data' => array()
					];
				}
			}else{
				$this->response = [
					'status' => '2',
					'message' => "You are blocked, contact admin to active your account !"
				];
			}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);		
	}

	public function notification1()
	{
		$user_id = $_REQUEST['user_id'];
		$unique_id = $_POST['unique_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$app_id = $_POST['app_id'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
				$sql2 = "SELECT noti_date as date,message as msg, sound, is_sound FROM tbl_notification  WHERE is_sound = 1";
				$data = $this->qm->rawSelectQuery($sql2);
				$records = $this->sort_by('date',$data);
				$hjkhj = array();
				foreach($records as $record){
					$dfg = [
						'date' => $this->qm->encryptCryptParam($record['date']),
						'msg' => $this->qm->encryptCryptParam($record['msg']),
						'sound' => $this->qm->encryptCryptParam($record['sound']),
						'is_sound' => $this->qm->encryptCryptParam($record['is_sound'])
					];
					array_push($hjkhj,$dfg);
				}
				if ($hjkhj) {
					$this->response = [
						'status' => '1',
						'message' => "Success!",
						'url' => $this->qm->encryptCryptParam(URL.'images/audio/'),
						'data' => $hjkhj
					];
				} else {
					$this->response = [
						'status' => '0',
						'message' => "Failed!",
						'data' => array()
					];
				}
			}else{
				$this->response = [
					'status' => '2',
					'message' => "You are blocked, contact admin to active your account !"
				];
			}
		}else{
			$this->response = [
				'status' => '0',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);		
	}
	
	public function send_client_communication()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$msg = $_POST['msg'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$app_id = $_POST['app_id'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0) {
					$checkReq = $this->qm->num_where_row('tbl_comm',['user_id'=>$user_id,'create_date'=>date('Y-m-d')]);
					$setting = $this->qm->select_where_row('tbl_setting', ['id' => 1]);
					if($checkReq < $setting['ticket_request']) {
						$data = [
							'user_id' => $user_id,
							'msg' => $msg,
							'user'=>'1',
							'admin'=>'0',
							'status'=>'2',
							'create_date' => date('Y-m-d'),
							'create_time' => date('H:i:s')
						];
						$insert_id = $this->qm->ins('tbl_comm', $data);
						if($insert_id){
							$this->response = [
								'status' => '1',
								'message' => "Successfully! submit data"
							];
						}else{
							$this->response = [
								'status' => '2',
								'message' => "You are blocked, contact admin to active your account!"
							];	
						}
					}else{
						$this->response = [
							'status' => '3',
							'message' => "Request number is high. Please request tommorow!"
						];
					}			
					
				} else {
					$this->response = [
						'status' => '2',
						'message' => "You are blocked, contact admin to active your account!"
					];
				}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
	}
	
	public function get_client_communication()
	{
		$user_id = $_POST['user_id'];
		$unique_id = $_POST['unique_id'];
		$imei1 = $_POST['imei1'];
		$imei = $_POST['imei'];
		$app_id = $_POST['app_id'];
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			if (($this->qm->num_where_row('tbl_users',['user_id'=>$user_id,'unique_id'=>$unique_id,'imei1'=>$imei1,'imei'=>$imei,'status'=>1])) > 0){
					$results = $this->db->query("SELECT * FROM tbl_comm WHERE user_id = $user_id")->result();
					$data = array();
					foreach($results as $result){
						if($result->status==1){$status = 'complete';}else{$status = 'pending';}
						$data1=[
							'msg'=>$this->qm->encryptCryptParam($result->msg),
							'user'=>$this->qm->encryptCryptParam($result->user),
							'admin'=>$this->qm->encryptCryptParam($result->admin),
							'status'=>$this->qm->encryptCryptParam($status),
							'datetime'=>$this->qm->encryptCryptParam($result->create_date.' '.$result->create_time)
						];
						array_push($data,$data1);
					}
					$this->response = [
						'status' => '1',
						'message' => "Success!",
						'data' => $data
					];
				} else {
					$this->response = [
						'status' => '2',
						'message' => "You are blocked, contact admin to active your account!"
					];
				}
		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}
		echo json_encode($this->response);
	}

	public function saveContectDetails()
	{	
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') && $this->decryptIt($_SERVER['HTTP_AUTHORIZATION']) == 1) {
			$all_contect_datas = json_decode($_POST['contact_data']);
			foreach($all_contect_datas as $all_contect_data){
				if (($this->qm->num_where_row('tbl_contacts',['number'=>$all_contect_data->number])) <= 0) {
					$data = [
						'name'=>$all_contect_data->name,
						'number'=>$all_contect_data->number,
						'created_date'=>date('Y-m-d')
					];
					$this->qm->ins('tbl_contacts', $data);
				}
			}
			$this->response = [
				'status'=>1,
				'message'=>'Success!'
			];
			echo json_encode($this->response);

		}else{
			$this->response = [
				'status' => '9',
				'message' =>'Your devices not verify!',
			];
		}	
	}

	function randomString1()
	{
		$length = 64;
		$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}
		return $str;
		//echo json_encode($str);
	}

	function is_luhn($n) 
	{
		$str = '';
		foreach (str_split(strrev((string) $n)) as $i => $d) {
			$str .= $i %2 !== 0 ? $d * 2 : $d;
		}
		return array_sum(str_split($str)) % 10 === 0;
	}

	public function validateimeim()
	{ 
		$this->qm->asdasd(); 
	}

	function is_imei($n)
	{
		return $this->is_luhn($n) && strlen($n) == 15;
	}

	function validate_imei($imei)
	{
		if (!preg_match('/^[0-9]{15}$/', $imei)) return false;
		$sum = 0;
		for ($i = 0; $i < 14; $i++)
		{
			$num = $imei[$i];
			if (($i % 2) != 0)
			{
				$num = $imei[$i] * 2;
				if ($num > 9)
				{
					$num = (string) $num;
					$num = $num[0] + $num[1];
				}
			}
			$sum += $num;
		}
		if ((($sum + $imei[14]) % 10) != 0) return false;
		return true;
	}

	function randomString()
	{
		$length = 16;
		$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}
		return $str;
	}
	


	function decryptIt( $q ) {
		$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
		$qDecoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
		$hDecode = explode('=',$qDecoded);
		if($hDecode[0] == token){
			if(date("H:i:s") <= date("H:i:s", strtotime($hDecode[1]) + 60)){
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}

	function sort_by($key, $array)
	{
		$key_array = array();
		foreach ($array as $key_name => $row) {
			$key_array[$key_name] = $row[$key];
		}
		array_multisort($key_array, SORT_DESC, $array);
		return $array;
	}

	public function minus_balance(){
		$users = $this->qm->select_all('tbl_users');
		foreach($users as $user){
			if($user['referral_count']>0){
				$sql = "SELECT SUM(impression_earn) as imp ,SUM(install_earn) as install FROM tbl_work WHERE user_id=".$user['user_id'];
				$works = $this->db->query($sql)->result();
				$total_earn = number_format($works[0]->imp + $works[0]->install , 2);
				$sql1 = "SELECT SUM(amount) as amount FROM tbl_payreq WHERE user_id=".$user['user_id'];
				$pays = $this->db->query($sql1)->result();
				$total_pay = $pays[0]->amount;
				if($total_earn > $total_pay){
					$adjust_amount = $total_earn - $total_pay;
					$this->qm->updt('tbl_users',array('balance'=>$adjust_amount,'referral_balance'=>0),array('user_id'=>$user['user_id']));
				}else{
					$this->qm->updt('tbl_users',array('balance'=>0,'referral_balance'=>0),array('user_id'=>$user['user_id']));
				}
			}
		}	
	}

} 
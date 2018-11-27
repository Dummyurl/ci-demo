<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define('URL','http://phpstack-145516-616249.cloudwaysapps.com/');
// define('URL','http://localhost/loancredit_money/');
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);
define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define("ADMIN_TITLE","LoanCredit Money");
define("token",'B5317AAB76289245AFB2EC8E35A32B5317AAB76289245AFB2EC8E35A32B5317AAB76289245AFB2EC8E35A32B5317AAB76289245AFB2EC8E35A32');
define("IMAGE",URL."images/");
define("CSS",URL."css/");
define("JS",URL."js/");
define("PLUGINS",URL."plugins/");
define("ACTIVE_LINK",URL.'activeAccount');
define("OFFSET",'100');
define("firebase_key",'AIzaSyC7Y2cnqIZKp3NoKAuyNDA9LG_uUSxJyFU');

define("HOST","localhost");
define("USER","rsqhjxrcym");
define("PASS","T5QgxZtf4S");
define("DB","rsqhjxrcym");

// Paytm Wallet

define('PAYTM_APP_NAME', 'loancreditmoney');
define('PAYTM_ENVIRONMENT', 'PROD');
define('PAYTM_MERCHANT_KEY', 'aeK1zp9p%GANOcwh'); 
define('PAYTM_MERCHANT_MID', 'MIInfo99655070950709'); 
define('PAYTM_MERCHANT_GUID', '6aae8dd3-ba81-4a28-ac5d-03a82cb040cf');
define('PAYTM_SALES_WALLET_GUID', '13c40807-9820-4679-986b-24864f32c55a'); 
define('PAYTM_MERCHANT_WEBSITE', 'xxxxxxx');

$PAYTM_DOMAIN = "pguat.paytm.com";
$PAYTM_WALLET_DOMAIN = "trust-uat.paytm.in";
if (PAYTM_ENVIRONMENT == 'PROD') {
	$PAYTM_DOMAIN = 'secure.paytm.in';
	$PAYTM_WALLET_DOMAIN = "trust.paytm.in";
}

define('PAYTM_REFUND_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/REFUND');
define('PAYTM_STATUS_QUERY_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/TXNSTATUS');
define('PAYTM_TXN_URL', 'https://'.$PAYTM_DOMAIN.'/oltp-web/processTransaction');
define('PAYTM_GRATIFICATION_URL', 'https://'.$PAYTM_WALLET_DOMAIN.'/wallet-web/salesToUserCredit');

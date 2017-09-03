<?php
$CI =& get_instance();
function dump($data)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function curl_request($url,$method,$useragent)
{
	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here

	$data = array();
	$data[CURLOPT_RETURNTRANSFER] = 1;
	$data[CURLOPT_URL] = $url;
	$data[CURLOPT_USERAGENT] = $useragent;
	if($method == "POST")
	{
		$data[CURLOPT_POST] = 1;	
	}
	$data[CURLOPT_POSTFIELDS] = array();

	curl_setopt_array($curl, $data);
	// Send the request & save response to $resp
	$result = curl_exec($curl);
	if(!$result){
		die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
	}
	// Close request to clear up some resources
	curl_close($curl);
	return $result;	
}

function send_email($data = array()) {
	global $CI;
	$CI->load->library('email');

	$to = $data['to'];
	$subject = $data['subject'];
	$html = $data['html'];
	if(isset($data['from']) && $data['from'] != '')
	{
		$from = $data['from']['email'];
		$name = $data['from']['name'];			
	}else{
		$from = "info@onlinetradinginstitute.in";
		$name = "Online Trading Institute";						
	}


	$config['protocol'] = 'sendmail';
	$config['mailpath'] = '/usr/sbin/sendmail';
	$config['charset'] = 'iso-8859-1';
	$config['wordwrap'] = TRUE;
	$config['mailtype'] = 'html';

	$CI->email->initialize($config);

	$CI->email->from($from, $name);
	$CI->email->to($to);

	$CI->email->subject($subject);
	$CI->email->message($html);
	//echo $html;
	//$CI->email->send();
	//print_r($CI->email->print_debugger());
}

function responseObject($response = array(),$status_code=200)
{
	http_response_code($status_code);
	header('Content-type: application/json');
	return json_encode($response);
}

function imagePath($path,$image_type,$width = 70,$height=70)
{
	if($image_type == 'profile')
	{
		$path = 'uploads/profile/'.$path;
	}else if($image_type == 'packages')
	{
		$path = 'uploads/packages/'.$path;
	}
	$h = '';
	$w = '';
	if($height > 0)
	{
		$h = "&h=".$height;
	}
	if($width > 0)
	{
		$w = "&w=".$width;
	}
	return base_url('timthumb.php?src='.base_url($path).$w.$h);
	//return base_url('uploads/'.$path);
}

function imagePathMyNetwork($package_list,$width = 70,$height=70)
{
	if(in_array(1, $package_list))
	{
		$color = 'male-icon.png';
	}
	if(in_array(2, $package_list))
	{
		$color = 'male-icon-1.png';
	}
	if(in_array(3, $package_list))
	{
		$color = 'male-icon2.png';
	}

	if(count($package_list) == 0)
	{
		$color = 'male-icon-3.png';
	}

	if(in_array("default", $package_list))
	{
		$color = 'male-icon-5.png';
	}

	
	return base_url('timthumb.php?src='.base_url('assets/frontend/images/'.$color).'&w='.$width.'&h='.$height);
	//return base_url('uploads/'.$path);
}

function getPackages($package_id=0,$filterArray = array(),$wherein="")
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getPackages($package_id,$filterArray,$wherein);
	return $result;	
}

function getPackageMedia($package_id=0,$package_media_id=0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getPackageMedia($package_id,$package_media_id);
	return $result;	
}

function getUserPackages($userid=0,$filterArray = array())
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getUserPackages($userid,$filterArray);
	return $result;
}

function checkUsernameExists($username)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->checkUsernameExists($username);
	return $result;	
}

function checkEmailIDExists($email)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->checkEmailIDExists($email);
	return $result;	
}

function checkAlignmentSetOfUser($username)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->checkAlignmentSetOfUser($username);
	return $result;	
}

function getUserInfo($userid=0,$username='')
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getUserInfo($userid,$username);
	return $result;	
}

function getNotifications($notification_id = 0,$packages = array())
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getNotifications($notification_id,$packages);
	return $result;	
}

function getNews($news_id = 0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getNews($news_id);
	return $result;	
}

function getBonus($userid = 0,$weekly = False)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getBonus($userid,$weekly);
	return $result;	
}

function totalPackageAmount($userid=0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->totalPackageAmount($userid);
	return $result;	
}

function getUserEmailIdUsingPackages($package_ids = array())
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getUserEmailIdUsingPackages($package_ids);
	return $result;	
}

function user_payment_details($userid=0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->user_payment_details($userid);
	return $result;	
}

function user_payment_details_view($userid=0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->user_payment_details_view($userid);
	return $result;	
}
//$CI->output->enable_profiler(TRUE);
?>
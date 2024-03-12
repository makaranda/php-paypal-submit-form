<?php
session_start();

$amount = '';
$business = '';
$item_name = '';
$item_number = '';
$no_shipping = '';
$currency_code = '';
$notify_url = '';
$cancel_return = '';
$return = '';
$cmd = '';

if(empty($_POST['g-recaptcha-response']))
 {
  $captcha_error = 'required';
 }
 else
 {
  $secret_key = '6LcZqjspAAAAAMPg6mlLFCyRO10vjdfkKaghbS6R';

  $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);

  $response_data = json_decode($response);

  if(!$response_data->success)
  {
    $captcha_error = 'failed';
  }else{
    $captcha_error = 'success';
	$amount = $_POST['amount']; 
	$business = $_POST['business']; 
	$item_name = $_POST['item_name']; 
	$item_number = $_POST['item_number']; 
	$no_shipping = $_POST['no_shipping']; 
	$currency_code = $_POST['currency_code']; 
	$notify_url = $_POST['notify_url']; 
	$cancel_return = $_POST['cancel_return']; 
	$return = $_POST['return']; 
	$cmd = $_POST['cmd'];
  }
 }



//var_dump($_POST);



$data = array(
 'amount'  => $amount,
 'business'  => $business,
 'item_name'  => $item_name,
 'item_number'  => $item_number,
 'no_shipping'  => $no_shipping,
 'currency_code'  => $currency_code,
 'notify_url'  => $notify_url,
 'cancel_return'  => $cancel_return,
 'return'  => $return,
 'cmd'  => $cmd,
 'recatcha_msg' => $captcha_error
); 

echo json_encode($data);

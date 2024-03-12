<?php
session_start();
include("../../config/database.php");
include('../../libs/connection.php');
include('../../config/paths.php');
include('../phpmailer/class.phpmailer.php');

global $today;
$today = date("Y-m-d");
$date_time = date("Y-m-d H:i:s"); 
$message = '';
$userEmail = '';
$fontName1 = 'Poppins';
/*
http://localhost/slsvs.lk/assets/images/slsvs.logo.png
array(1) { ["captcha_code"]=> string(6) "c0dd2c" }
array(7) { ["recaptcha_response"]=> string(15) "03ANYolqsKwnMEI" ["message"]=> string(4) "sasd" ["name"]=> string(19) "Makaranda Pathirana" ["phone"]=> string(10) "0773944180" ["email"]=> string(28) "makarandapathirana@gmail.com" ["subject"]=> string(3) "asd" ["captcha_code"]=> string(6) "c0dd2c" }
*/
//message name phone email subject
if(isset($_POST['free_consultation_name'],$_POST['free_consultation_email'],$_SESSION['captcha_code'],$_POST['captcha_code2']) && $_POST['free_consultation_email'] != '' && $_POST['captcha_code2'] != '')
{
	
    if(isset($_SESSION['captcha_code'],$_POST['captcha_code2']) && $_POST['captcha_code2'] == $_SESSION['captcha_code']){
        
        $email = mysqli_real_escape_string($conn, $_POST['free_consultation_email']);
        $free_consultation_name = mysqli_real_escape_string($conn, $_POST['free_consultation_name']); 
        $free_consultation_message = mysqli_real_escape_string($conn, $_POST['free_consultation_message']); 
        
        //$message = 'success';

        $userEmail .= '<body style="background-color: #f3f5f7; margin: 0 !important; padding: 0 !important;">
        
        
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
        
            <tr>
                <td align="center">
        
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="center" valign="top" style="padding: 40px 10px 10px 10px;">
                                <a href="#" target="_blank" style="text-decoration: none;">
        							<span style="display: block; font-family: '.$fontName1.', sans-serif; color: #3e8ef7; font-size: 36px;" border="0"><img src="'.URL.'assets/images/goearc_main_logo_wbck.png" width="300px"/></span>
                                </a>
                            </td>
                        </tr>
                    </table>
        
                </td>
            </tr>
          
            <tr>
                <td align="center" style="padding: 0px 10px 0px 10px;">
        
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#ffffff" align="center" valign="top" style="padding: 10px 20px 20px 20px; border-radius: 4px 4px 0px 0px;">
                              <h1 style="font-size: 36px; font-weight: 600; margin: 0; font-family: '.$fontName1.', sans-serif;text-transform: capitalize;text-align:center;">Welcome to GOEARC </h1>
                            </td>
                        </tr>
                    </table>
        
                </td>
            </tr>
          
            <tr>
                <td align="center" style="padding: 0px 10px 0px 10px;">
                    
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                   
                      <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #000; font-family: '.$fontName1.', sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                          <p style="margin: 0;text-align:center;">Please go to the person`s personal information below and contact them for a free consultation.</p>
                          <p style="margin: 20px 0 0 0;color:#666666;text-align:center;display:none;">Many Blessings!</p>
                          
                          <p style="text-align:left;margin:25px 0 0 0;font-family:sans-serif;line-height:24px;color:#333333;font-size:16px;font-weight: 700;">
        <strong>Name :</strong> '.$free_consultation_name.'</p>
                          <p style="text-align:left;margin:0;font-family:sans-serif;line-height:24px;color:#333333;font-size:16px;font-weight: 700;">
        <strong>Email :</strong> '.$free_consultation_email.'</p>
                          <p style="text-align:left;margin:0;font-family:sans-serif;line-height:24px;color:#333333;font-size:16px;font-weight: 700;">
        <strong>Message :</strong> '.$free_consultation_message.'</p>
        
        
                          <p style="text-align:left;margin:16px 0 0 0;font-family:sans-serif;line-height:24px;color:#333333;font-size:16px;font-weight: 300;">Please click below button to get all free consultation list from your website.</p>
                          
                          <p style="text-align:center;"><a  href="'.URL.'assets/action/php_spreadsheet_free_consultation_export.php?export=export_free_consultation&file_type=Xlsx" style="background-color: #4CAF50;padding: 15px 32px;border: none;text-align: center;display: inline-block;cursor: pointer;margin: 4px 2px;color: white;text-decoration:none;">free consultation List</a></p>
                          
                        </td>
                      </tr>

                 
                 
                      <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 0px 0px; color: #666666; font-family: '.$fontName1.', sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;">
                          <p style="margin: 0;">Cheers,<br>GOEARC Team</p>
                        </td>
                      </tr>
                    </table>
           
                </td>
            </tr>
        
            <tr>
                <td align="center" style="padding: 10px 10px 50px 10px;">
        
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                   
                      <tr style="display:none;">
                        <td bgcolor="#ffffff" align="left" style="padding: 30px 30px 30px 30px; color: #aaaaaa; font-family: '.$fontName1.', sans-serif; font-size: 12px; font-weight: 400; line-height: 18px;">
                          <p style="margin: 0;">
                            <a href="#" target="_blank" style="color: #999999; font-weight: 700;">User Account</a> -
                            <a href="#" target="_blank" style="color: #999999; font-weight: 700;">About</a> -
                            <a href="#" target="_blank" style="color: #999999; font-weight: 700;">Help</a> -
                            <a href="#" target="_blank" style="color: #999999; font-weight: 700;">Terms and Conditions</a>
                          </p>
                        </td>
                      </tr>
                   
                      <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 30px 30px; color: #aaaaaa; font-family: '.$fontName1.', sans-serif; font-size: 12px; font-weight: 400; line-height: 18px;">
                          <p style="margin: 0;">You received this email because you just messaged us. If it looks weird, check it out in your browser.</b>.</p>
                          <p style="margin: 0;color:#b37b16;">We stay in the Cutting edge of integrity Of the Word of God in families who commit to autism breakthrough.</p>
                        </td>
                      </tr>
               
             
        
                      <tr>
                        <td align="center" style="padding: 30px 30px 30px 30px; color: #333333; font-family: '.$fontName1.', sans-serif; font-size: 12px; font-weight: 400; line-height: 18px;">
                          <p style="margin: 0;">Copyright © '.date("Y").' GOEARC.COM All Rights Reserved.</p>
                          <p style="margin: 0;text-align:center;">When it is a good thing, keep it in your mind.</p>
                        </td>
                      </tr>
                    </table>
        
                </td>
            </tr>
        </table>
        
        </body>';
        
        
        
        $userEmail2 .= '<body style="background-color: #f3f5f7; margin: 0 !important; padding: 0 !important;">
        
        
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
        
            <tr>
                <td align="center">
        
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="center" valign="top" style="padding: 40px 10px 10px 10px;">
                                <a href="#" target="_blank" style="text-decoration: none;">
        							<span style="display: block; font-family: '.$fontName1.', sans-serif; color: #3e8ef7; font-size: 36px;" border="0"><img src="'.URL.'assets/images/goearc_main_logo_wbck.png" width="300px"/></span>
                                </a>
                            </td>
                        </tr>
                    </table>
        
                </td>
            </tr>
          
            <tr>
                <td align="center" style="padding: 0px 10px 0px 10px;">
        
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#ffffff" align="center" valign="top" style="padding: 10px 20px 20px 20px; border-radius: 4px 4px 0px 0px;">
                              <h1 style="font-size: 36px; font-weight: 600; margin: 0; font-family: '.$fontName1.', sans-serif;text-transform: capitalize;text-align:center;">Welcome to GOEARC </h1>
                            </td>
                        </tr>
                    </table>
        
                </td>
            </tr>
          
            <tr>
                <td align="center" style="padding: 0px 10px 0px 10px;">
                    
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                   
                      <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #000; font-family: '.$fontName1.', sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                          <p style="margin: 0;text-align:center;">Thank you for contacting us and we will send all information to this email and we appreciate your contribution.</p>
                         
                         
                        </td>
                      </tr>

                 
                      <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                          <p style="margin: 0;color:#161414;"><strong style="text-transform: capitalize;font-family: sans-serif;">For questions about this message, please contact.</strong> <br> Email Address - <a href="mailto:admin@goearc.com">admin@goearc.com</a> <br> Phone - <a href="tel:6479167108">647-916-7108</a></p>
                        </td>
                      </tr>
                 
                      <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 0px 0px; color: #666666; font-family: '.$fontName1.', sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;">
                          <p style="margin: 0;">Cheers,<br>GOEARC Team</p>
                        </td>
                      </tr>
                    </table>
           
                </td>
            </tr>
        
            <tr>
                <td align="center" style="padding: 10px 10px 50px 10px;">
        
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                   
                      <tr style="display:none;">
                        <td bgcolor="#ffffff" align="left" style="padding: 30px 30px 30px 30px; color: #aaaaaa; font-family: '.$fontName1.', sans-serif; font-size: 12px; font-weight: 400; line-height: 18px;">
                          <p style="margin: 0;">
                            <a href="#" target="_blank" style="color: #999999; font-weight: 700;">User Account</a> -
                            <a href="#" target="_blank" style="color: #999999; font-weight: 700;">About</a> -
                            <a href="#" target="_blank" style="color: #999999; font-weight: 700;">Help</a> -
                            <a href="#" target="_blank" style="color: #999999; font-weight: 700;">Terms and Conditions</a>
                          </p>
                        </td>
                      </tr>
                   
                      <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 30px 30px; color: #aaaaaa; font-family: '.$fontName1.', sans-serif; font-size: 12px; font-weight: 400; line-height: 18px;">
                          <p style="margin: 0;">You received this email because you just messaged us. If it looks weird, check it out in your browser.</b>.</p>
                          <p style="margin: 0;color:#b37b16;">We stay in the Cutting edge of integrity Of the Word of God in families who commit to autism breakthrough.</p>
                        </td>
                      </tr>
               
             
        
                      <tr>
                        <td align="center" style="padding: 30px 30px 30px 30px; color: #333333; font-family: '.$fontName1.', sans-serif; font-size: 12px; font-weight: 400; line-height: 18px;">
                          <p style="margin: 0;">Copyright © '.date("Y").' GOEARC.COM All Rights Reserved.</p>
                          <p style="margin: 0;text-align:center;">When it is a good thing, keep it in your mind.</p>
                        </td>
                      </tr>
                    </table>
        
                </td>
            </tr>
        </table>
        
        </body>';

                    //message name email subject
                    $message = 'success';
                    
                    $datetime = date('Y-m-d H:i:s');
            	    
					$mail = new PHPMailer;
					$mail->IsSMTP();							
					$mail->Host = 'goearc.com';	
					//$mail->Host = gethostname();
					$mail->Port = '465';					
					$mail->SMTPAuth = true;						
					$mail->Username = 'support@goearc.com';				
					$mail->Password = 'lBXFiadBSDBY487GH';				
					$mail->SMTPSecure = 'ssl';							
					$mail->From = 'support@goearc.com';				
					$mail->FromName = 'GOEARC.COM';			
					//$mail->addAddress('makarandapathirana@gmail.com', 'Newsletter Form');		
					$mail->addAddress('admin@goearc.com', 'Free Consultation Form');	
					$mail->addReplyTo('admin@goearc.com', 'GOEARC.COM');            		
					//$mail->AddCC($_POST["email"]);
					$mail->WordWrap = 50;					
					$mail->IsHTML(true);									
					$mail->Subject = 'Free Consultation Form - from '.$_POST["free_consultation_name"].'';					
					$mail->Body = $userEmail;
            		
            		
            		
            		if($mail->Send())								//Send an Email. Return true on success or false on error
            		{
            			//$error = '<label class="text-success">Thank you for contacting us</label>';
                        $sql = "SELECT * FROM `free_consultation_tbl` WHERE `email` = '$email'";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) == 0) {
                            
                            $insertSQL = "INSERT INTO `free_consultation_tbl`(`name`, `email`,`message`, `date_time`) VALUES ('$free_consultation_name','$email','$free_consultation_message','$date_time')";
                            mysqli_query($conn, $insertSQL);            			
                			//$message = 'success';
                			
                            $mail->ClearAllRecipients();
                            $mail->Subject = 'Free Consultation Form - from GOEARC.COM';
                            $mail->addReplyTo('admin@goearc.com', 'GOEARC.COM');                      
                            $mail->Body = $userEmail2;
                     		$mail->From = 'support@goearc.com';				
                    		$mail->FromName = 'GOEARC.COM';	                   
                            $mail->addAddress($email);
                    		
                    		if($mail->Send()){
                    		    $message = 'success';
                    		}else{
                    		    $message = 'email_error';   
                    		}
                        }else{
                            $message = 'already';
                        }	
            		
            		}
            		else
            		{
            			//$error = '<label class="text-danger">There is an Error</label>';
            			$message = 'email_error';
            		}


            		
            		$name = '';
            		$email = '';
            		$subject = '';
            		$messages = '';
            		$phone = '';

  
        }else{
        	$message = 'recaptcha_error';
        	//echo 'You are not a human';
        }  
    
}else{
	
	$message = 'wrong_all';
}


$data = array(
 'message'  => $message
); 

echo json_encode($data);
/*
array(1) { ["captcha_code"]=> string(6) "c0dd2c" }
array(7) { ["recaptcha_response"]=> string(15) "03ANYolqsKwnMEI" ["message"]=> string(4) "sasd" ["name"]=> string(19) "Makaranda Pathirana" ["phone"]=> string(10) "0773944180" ["email"]=> string(28) "makarandapathirana@gmail.com" ["subject"]=> string(3) "asd" ["captcha_code"]=> string(6) "c0dd2c" }
*/
/*
echo 'message - '.$message;
echo '<br>';
var_dump($_SESSION);
echo '<br>';
var_dump($_POST);
*/

?>
<?php
include "vendor/autoload.php";
include "payment.php";
use Payment\Payment;
$payment = new Payment;

define('URL','https://goearc.com/');


//Recaptcha site key - 6LcZqjspAAAAAJ5540uBly6UuzR1H9yPQj6ajAMy
//Recaptcha secret key - 6LcZqjspAAAAAMPg6mlLFCyRO10vjdfkKaghbS6R

// ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Pay with PayPal</title>
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="css/parsley.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <!-- Optional theme -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   <script src="js/jquery.redirect.js"></script>
   <script src="js/parsley.js"></script>
   
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   <style>
	  .main_payment_type.active{
		background-color: #311be4 !important;  
	  }
	  span.required_field {
		color: red;
		font-size: 10px;
	}
	
	.amount_button_radio {
		clip: rect(0 0 0 0);
		border: 0;
		-webkit-clip-path: inset(50%);
		clip-path: inset(50%);
		height: 1px;
		margin: -1px;
		overflow: hidden;
		padding: 0;
		position: absolute;
		white-space: nowrap;
		width: 1px;
	}
	
	.amount_button_label{
		background-color: #6c757d;
		color: #fff;
		justify-content: center;
		text-align: center;
		padding: 10px 20px;
	}
	.amount_button_label:hover{
		background-color: #311be4 !important; 
		cursor:pointer;
	}
	.amount_button_label.active{
		background-color: #311be4 !important; 
	}
	.collumn2{
		background-color: #f5f5f5;
	}
	

   </style>
</head>
<body style="background-color:#ccc;">
	
   <div class="container mt-4" style="background-color:#fff;">
       <div class="row">
		<!--<div id="check_data" class="col-md-12">
		   </div>-->
		   <div class="col-md-12">
		   <form class="form-horizontal" id="paypal_data_form" method="POST" action="">
			   <div class="row justify-content-center">
				  <div class="col-12 col-md-12 text-center pt-4 pb-4">
					  <img src="<?php echo URL;?>assets/images/main_logo_latest.png" class="img-fluid" style="width:150px;"/>	
				  </div>
				  <div class="col-12 col-md-6">
					  <div class="row justify-content-center">
						  <div class="col-12 col-md-12 text-center">
							  <img src="<?php echo URL;?>assets/images/donation_banner2.jpg" class="img-fluid" style=""/>
						  </div>
						  <div class="col-12 col-md-12 text-center mt-3">
							  <h3>YOUR DONATION DOUBLED!</h3>
						  </div>
						  <div class="col-12 col-md-12 text-justify pt-2 pb-2">
							  <p>Encourage children and youth by making a special year-end gift. Give today to help children, youth and families involved in the child welfare system through urgent resources, mental health services, housing assistance and much more. <span class="font-weight-bold">Every dollar you give today will be MATCHED by our generous donor the GOEARC Foundation up to a total of $50,000*.</span></p>
							  <p>If you’d like to receive a 2024 tax-deductible receipt, please donate before 11:59PM on January 31, 2024.</p>
						  </div>
						  <div class="col-12 col-md-12 text-justify pt-2 pb-2">
						    <label class="font-weight-bold">I would like to make a:</label> <br>
							<button type="button" class="btn btn-secondary pl-3 pr-3 main_payment_type active" value="one_time">One-Time Gift</button>
							<button type="button" class="btn btn-secondary pl-3 pr-3 main_payment_type" value="monthly">Monthly Gift</button>							  
						  </div>
						  <div class="col-12 col-md-12 text-justify pt-2 pb-2">
						    <label class="font-weight-bold">Donation Amount <span class="required_field">*</span></label> <br>
							<div class="form-check form-check-inline">
							  <input class="form-check-input amount_button_radio" type="radio" name="donation_amount" id="inlineRadio1" value="50">
							  <label class="form-check-label amount_button_label" id="inlineLabel1" for="inlineRadio1">$50</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input amount_button_radio" type="radio" name="donation_amount" id="inlineRadio2" value="75">
							  <label class="form-check-label amount_button_label active" id="inlineLabel2" for="inlineRadio2">$75</label>
							</div>	
							<div class="form-check form-check-inline">
							  <input class="form-check-input amount_button_radio" type="radio" name="donation_amount" id="inlineRadio3" value="100">
							  <label class="form-check-label amount_button_label" id="inlineLabel3" for="inlineRadio3">$100</label>
							</div>							  
						  </div>
						  <div class="col-12 col-md-12 text-justify pt-2 pb-2">
							<div class="form-check form-check-inline">
							  <input class="form-check-input amount_button_radio" type="radio" name="donation_amount" id="inlineRadio4" value="150">
							  <label class="form-check-label amount_button_label" id="inlineLabel4" for="inlineRadio4">$150</label>
							</div>
							  <div class="form-check form-check-inline">
								<input type="number" class="form-control pb-2 pt-2" id="other_amount" name="other_amount" placeholder="Enter Other Amount">
							  </div>
						  </div>
						  
					  </div>	
					  
				  </div>
				  <div class="col-12 col-md-6">
					  <div class="row justify-content-center collumn2 ml-2 mr-2 p-3">
						  <div class="col-12 col-md-12">
							  <h3>Your Information</h3>
						  </div>
						  <div class="col-12 col-md-12">							  
							  <div class="form-check">
								<input type="checkbox" class="form-check-input" id="exampleCheck1">
								<label class="form-check-label" for="exampleCheck1">My gift is on behalf of a business or organization</label>
							  </div>
						  </div>
						  <div class="col-12 col-md-12">							  
							  <div class="row justify-content-center">
								  <div class="col-12 col-md-6 mt-2">
								      <label>Title</label>
									  <select class="form-control" id="info_title" name="info_title">
										  <option value="">Please Select</option>
										  <option value="Dr">Dr</option>
										  <option value="Miss">Miss</option>
										  <option value="Mrs">Mrs</option>
										  <option value="Mr">Mr</option>
										  <option value="Ms">Ms</option>
									  </select>
								  </div>
								  <div class="col-12 col-md-6 mt-2">
								      <label>First Name <span class="required_field">*</span></label>
									  <input type="text" class="form-control" id="info_first_name" name="info_first_name" required>
								  </div>
								  <div class="col-12 col-md-6 mt-2">
								      <label>Last Name <span class="required_field">*</span></label>
									  <input type="text" class="form-control" id="info_last_name" name="info_last_name" required>
								  </div>
								  <div class="col-12 col-md-6 mt-2">
								      <label>Mobile Phone</label>
									  <input type="number" class="form-control" id="info_mobile" name="info_mobile">
								  </div>
								  <div class="col-12 col-md-12 mt-2">
								      <label>Email Address <span class="required_field">*</span></label>
									  <input type="email" class="form-control" id="info_email" name="info_email" required>
								  </div>
							  </div>
						  </div>
						  <div class="col-12 col-md-12 mt-3">
							  <h3>Billing Information</h3>
						  </div>
						  <div class="col-12 col-md-12">							  
							  <div class="row justify-content-center">
								  <div class="col-12 col-md-12 mt-2">
								      <label>Country</label>
									  <select class="form-control" id="billing_info_country" name="billing_info_country">
										  <option value="Canada">Canada</option>
										  <option value="United Kingdom">United Kingdom</option>
										  <option value="United State">United State</option>
									  </select>
								  </div>
								  <div class="col-12 col-md-6 mt-2">
								      <label>Address 1 <span class="required_field">*</span></label>
									  <input type="text" class="form-control" id="billing_info_address1" name="billing_info_address1" required>
								  </div>
								  <div class="col-12 col-md-6 mt-2">
								      <label>Address 2</label>
									  <input type="text" class="form-control" id="billing_info_address2" name="billing_info_address2">
								  </div>
								  <div class="col-12 col-md-6 mt-2">
								      <label>City</label>
									  <input type="text" class="form-control" id="billing_info_city" name="billing_info_city"required>
								  </div>
								  <div class="col-12 col-md-6 mt-2">
								      <label>Province/State <span class="required_field">*</span></label>
									  <input type="text" class="form-control" id="billing_info_province" name="billing_info_province"required>
								  </div>
								  <div class="col-12 col-md-6 mt-2">
								      <label>Postal Code <span class="required_field">*</span></label>
									  <input type="text" class="form-control" id="billing_info_postal_code" name="billing_info_postal_code" required>
								  </div>
								  <div class="col-12 col-md-6 mt-2"></div>
							  </div>
						  </div>
						  <div class="col-12 col-md-12 mt-3">
							  <p class="font-weight-bold">Did you know that by covering the processing fee, Children's Aid Foundation of Canada will be able to help more young people?</p>
						  </div>
						  <div class="col-12 col-md-12">							  
							  <div class="form-check">
								<input type="checkbox" class="form-check-input" id="confirm_donation" name="confirm_donation">
								<label class="form-check-label" for="confirm_donation">Yes, I want to cover the 4% fee for my donation.</label>
							  </div>
						  </div>
						  <div class="col-12 col-md-12 mt-2">							  
							 <div class="g-recaptcha" data-sitekey="6LcZqjspAAAAAJ5540uBly6UuzR1H9yPQj6ajAMy" data-callback="onLoginCaptchaSubmit" style="display: flex; align-items: center; justify-content: center;"></div>
						  </div>
						  <div class="col-12 col-md-12 mt-3">							  
							   <div class="form-group">
								   <div class="col-md-12 text-center">
									   <button id="submit" name="pay_now" class="btn btn-danger donate_now_btn" style="cursor: not-allowed;" disabled>Donate Now</button>
								   </div>
							   </div>
						  </div>
					  </div>
				  </div>
			   </div>
		   </div>
           <div class="col-md-6">
               
                   <fieldset>
   
                       <!-- Text input-->
					   <input id="amount" name="amount" type="hidden" placeholder="amount to pay" class="form-control input-md" value="75" required="">
                       <input type='hidden' name='business' value='sb-kl8nc27246699@business.example.com'>
                       <input type='hidden' name='item_name' value='donation'>
                       <input type='hidden' name='item_number' value='<?php echo time();?>'>
                       <!--<input type='hidden' name='amount' value='10'>-->
                       <input type='hidden' name='no_shipping' value='1'>
                       <input type='hidden' name='currency_code' value='USD'>
                       <input type='hidden' name='notify_url' value='<?php echo $payment->route("notify", "") ?>'>
                       <input type='hidden' name='cancel_return' value='<?php echo $payment->route("http://localhost/paypal/cancel.php", "") ?>'>
                       <input type='hidden' name='return' value='<?php echo $payment->route("return", "http://localhost/paypal/return.php") ?>'>
                       <input type="hidden" name="cmd" value="_xclick">
					   
                       <!-- Button -->

					   
                   </fieldset>
               
           </div>
       </div>
	   </form>
   </div>
	<script>
		function onLoginCaptchaSubmit(token) {
			if (token) {
				// reCAPTCHA was verified successfully
				const submitButton=document.getElementById("submit");
				submitButton.disabled = false;
				submitButton.style.cursor = "pointer";

				return true;
			} else {
				// reCAPTCHA verification failed, prevent form submission
				alert("Captcha failed");
				return false; // Explicitly return false to prevent form submission
			}
		}
   </script> 
   <script>
   $("input[name='donation_amount']").click(function() {
    if($(this).is(':checked')) {
		$('#amount').val($(this).val());
		//alert($(this).val());
        if ($(this).val() == 1) {
            //$("#submit").val("Verified & Save");
        }else{
            //$("#submit").val("Save");
        }
    }
   });
   
   
	$('.amount_button_label').on('click', function(event){
		$('.amount_button_label').removeClass('active');
		$(this).addClass('active');
	});
	
	$('.main_payment_type').on('click', function(event){
		$('.main_payment_type').removeClass('active');
		$(this).addClass('active');
		$('#amount').val('75');
		
		if($(this).val() == 'one_time'){
			$('#inlineRadio1').val('50');
			$('#inlineRadio2').val('75');
			$('#inlineRadio3').val('100');
			$('#inlineRadio4').val('125');
			
			$('#inlineLabel1').text('$50');
			$('#inlineLabel2').text('$75');
			$('#inlineLabel3').text('$100');
			$('#inlineLabel4').text('$125');
			
			$('.amount_button_label').removeClass('active');
			$('#inlineLabel2').addClass('active');
			
			$("input[name='donation_amount']").filter('[value=75]').prop('checked');
			
		}else if($(this).val() == 'monthly'){
			$('#inlineRadio1').val('15');
			$('#inlineRadio2').val('25');
			$('#inlineRadio3').val('50');
			$('#inlineRadio4').val('75');
			
			$('#inlineLabel1').text('$15');
			$('#inlineLabel2').text('$25');
			$('#inlineLabel3').text('$50');
			$('#inlineLabel4').text('$75');		
			
			$('.amount_button_label').removeClass('active');
			$('#inlineLabel4').addClass('active');
				
			$("input[name='donation_amount']").filter('[value=75]').prop('checked');	
		}
		
	});	
   
    $('#paypal_data_form').parsley();
	$('#paypal_data_form').on('submit', function(event){
		var rcres = grecaptcha.getResponse();
		//alert(grecaptcha.getResponse();
		if(rcres.length) {
			//var form_data = new FormData($('#paypal_data_form')[0]);
			event.preventDefault();
			if($('#paypal_data_form').parsley().isValid())
			{
				$.ajax({
					url:"action/form_submit.php",
					method:"POST",
					dataType:"json",
					data: $('#paypal_data_form').serialize(),
					//contentType: false,
					//cache: false,
					//processData: false, 
					beforeSend:function(){ 
					   //$('#loading_response').addClass('d-block');
					   //$('#loading_response').removeClass('d-none');
					},
					success:function(data)
					{
						var amount = data.amount;
						var business = data.business;
						var item_name = data.item_name;
						var item_number = data.item_number;
						var no_shipping = data.no_shipping;
						var currency_code = data.currency_code;
						var notify_url = data.notify_url;
						var cancel_return = data.cancel_return;
						var return_val = data.return;
						var cmd = data.cmd;
						var return_value = 'return';
						
						grecaptcha.reset();
						//$('#check_data').text(amount+'/'+business+'/'+item_name+'/'+item_number+'/'+no_shipping+'/'+currency_code+'/'+notify_url+'/'+cancel_return+'/rrrr'+return_val+'/'+cmd+'/'+return_value);
						//alert(data.recatcha_msg);
						if(data.recatcha_msg != '' && data.recatcha_msg == 'success'){
							$.redirect("https://www.sandbox.PayPal.com/cgi-bin/webscr", {amount:amount,business:business,item_name:item_name,item_number:item_number,no_shipping:no_shipping,currency_code:currency_code,notify_url:notify_url,cancel_return:cancel_return,cmd:cmd,return_value: return_val}, "POST", "_self");
						}else if(data.recatcha_msg != '' && data.recatcha_msg == 'failed'){
							alert('Recaptcha failed');
						}else if(data.recatcha_msg != '' && data.recatcha_msg == 'required'){
							alert('Recaptcha is Required');
						}else{
							alert('Something Wrong');
						}
					   //$('#loading_response').addClass('d-none');
					   //$('#loading_response').removeClass('d-block');					
					}
				})
			}else{
				grecaptcha.reset();
			}
		}else{
			grecaptcha.reset();
			alert('Recaptcha Error');
		}	
    });	
   
   </script>
</body>
</html>
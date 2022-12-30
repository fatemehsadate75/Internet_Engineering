$(document).ready(function () {
	var mobileinput = $('input[name=mobilenumber]');
	mobileinput.after('<input type="button" id="mobilenumbersend" value="تأیید شماره" />');
$('#mobilenumbersend').click(function(){
	var phonenumber = mobileinput.val();
	if(phonenumber == '' || typeof(phonenumber) == 'undefined'){ 
		alert('شماره موبایل وارد نمایید');
		return false;
	}
	var query = $.ajax({
		type: 'POST',
		url: ranginesmspresta_verification_url,
		data: 'phonenumber=' + phonenumber,
		dataType: 'json',
		beforeSend: function(){
			$('span.loading').remove();
			$('#mobilenumbersend').after('<i class="process-icon-loading"></i> <span class="loading"> منتظر بمانید... </span>');
		},
		success: function(json) {
			$('span.loading').remove();
			switch(json.result){
				case 'true':
					$('#mobilenumbersend').hide().after('<input type="button" id="changemobilenumber" value="تغییر شماره"><div id="otpwrapper"><label for="verifyOTP">کد دریافتی خود را وارد نمایید :</label><input type="text" id="verifyOTP" value=""><input type="button" id="sendverifyOTP" value="ثبت کد تأیید"></div>');
					$('#sendverifyOTP').click(function(){
						var otp = $('#verifyOTP').val();
						var query = $.ajax({
							type: 'POST',
							url: ranginesmspresta_verification_url,
							beforeSend: function(){
								$('#sendverifyOTP').after('<i class="process-icon-loading"></i> <span class="loading"> منتظر بمانید... </span>');
							},
							data: 'phonenumber=' + phonenumber + '&otp=' + otp,
							dataType: 'json',
							success: function(json2) {
								$('.loading').remove();
								switch(json.result){
									case 'true':
										$('#otpwrapper,#changemobilenumber').remove()
										$('#mobilenumbersend,.account_mobile_verify label').hide();
										mobileinput.hide().addClass('verified').after('<input type="hidden" name="verified" value="1"/><p class="verifiedmobile">شماره همراه ' + phonenumber + ' تأیید شد.</p>');
										
										break;
									default:
										alert(json.result);
										break;
								}
							}
						});
					});
					$('#changemobilenumber').click(function(){
						$('#mobilenumbersend').show();
						$('#otpwrapper,#changemobilenumber').remove();
						
					})
					break;
				default:
					alert(json.result);
					break;
			}
		}
	});
});
if(verify_mobile_mandatory == '1'){
	$('form#customer-form [type=submit]').click(function(){
		if(!mobileinput.hasClass('verified')) {
			alert('برای ثبت نام تأیید شماره موبایل الزامی است.');
			return false;
		}
	});
}
});
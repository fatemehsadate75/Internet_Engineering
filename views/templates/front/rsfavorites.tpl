{**
* 2020 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
*
*  @author    Hadi Mollaei <mr.hadimollaei@gmail.com>
*  @copyright 2020 Rangine.ir
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  @file is used for display header messages on module config page.
*}
<!-- MODULE ranginesmspresta -->
<h2>محصولاتی که برای دریافت پیامک موجود شدن آنها ثبت نام کرده اید</h2>
{if isset($table)}
{$table}
<script>
ranginesmspresta_remove_url='{$link->getModuleLink('ranginesmspresta','actions', ['process' => 'remove'])}';
	$('.deleteoos').click(function(){
		var button = $(this);
		var product = button.data('product');
		var productAttribute = button.data('attribute');
		var idShop = button.data('id_shop');
		var phoneNumber = button.data('phonenumber');
		$.ajax({
			type: 'POST',
			url: ranginesmspresta_remove_url,
			data: 'id_product=' + product + '&id_product_attribute='+productAttribute+'&phoneNumber='+phoneNumber + '&action=remove',
			success: function (res) {
				console.log(res)
				var msg;
				switch(res){
					case '0':
						msg = 'خطایی در حذف ثبت نام شما بوجود آمد';
						break;
					case '1':
						msg = 'ثبت نام شما برای اطلاع رسانی این محصول لغو شد.';
						button.parents('tr').hide();
						break;
					case '2':
						msg = 'این ثبت نام قبلا حذف شده است.';
						button.parents('tr').hide();
						break;
					case '3':
						msg = 'چنین محصولی یافت نشد.';
						break;
					default:
						msg = 'خطایی در حذف ثبت نام شما بوجود آمد';
						break;
				}
				alert(msg); 

			}
		});
	});
	
</script>
{else}
<div class="rangine-favorites">
<p>جهت مشاهده و حذف محصولاتی که برای موجود شدن آنها ثبت نام کرده اید شماره همراه خود را وارد کرده و تایید کنید:</p>
<input type="text" id="mobilenumber" name="mobilenumber" value="" placeholder="شماره همراه خود را وارد نمایید"/> <input type="button" id="rsfmobilenumbersend" value="تأیید شماره" />
</div>
<script>
	$('#rsfmobilenumbersend').click(function(){
		var mobilefield = $('#mobilenumber');
		var phonenumber = $(mobilefield).val();
		if(phonenumber == '' || typeof(phonenumber) == 'undefined'){ 
			alert('شماره همراه خود را وارد نمایید');
			return false;
		}
		var query = $.ajax({
			type: 'POST',
			url: ranginesmspresta_verification_url,
			data: 'phonenumber=' + phonenumber,
			dataType: 'json',
			beforeSend: function(){
				$('span.loading').remove();
				$('#rsfmobilenumbersend').after('<i class="process-icon-loading"></i> <span class="loading"> منتظر بمانید... </span>');
			},
			success: function(json) {
				$('span.loading').remove();
				switch(json.result){
					case 'true':
						$('#rsfmobilenumbersend').hide().after('<input type="button" id="changemobilenumber" value="تغییر شماره"><div id="otpwrapper"><label for="verifyOTP">کد دریافتی خود را وارد نمایید :</label><input type="text" id="verifyOTP" value=""><input type="button" id="sendverifyOTP" value="ثبت کد تأیید"></div>');
						$('#sendverifyOTP').click(function(){
							var otp = $('#verifyOTP').val();
							var query = $.ajax({
								type: 'POST',
								url: ranginesmspresta_verification_url,
								beforeSend: function(){
									$('#sendverifyOTP').after('<i class="process-icon-loading"></i> <span class="loading"> منتظر بمانید... </span>');
								},
								data: 'phonenumber=' + phonenumber + '&otp=' + otp + '&oos=1',
								dataType: 'json',
								success: function(json2) {
									$('.loading').remove();
									switch(json.result){
										case 'true':
											$('#otpwrapper,#changemobilenumber').remove()
											$('#rsfmobilenumbersend,.account_mobile_verify label').hide();
											$(mobilefield).hide().addClass('verified').after('<input type="hidden" name="verified" value="1"/><p class="verifiedmobile">شماره همراه ' + phonenumber + ' تأیید شد.</p>');
											window.reload();
											break;
										default:
											alert(json.result);
											break;
									}
								}
							});
						});
						$('#changemobilenumber').click(function(){
							$('#rsfmobilenumbersend').show();
							$('#otpwrapper,#changemobilenumber').remove();
							
						});
						break;
					default:
						alert(json.result);
						break;
				}
			}
		});
	});
</script>
{/if}
<!-- MODULE ranginesmspresta -->

/**
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
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2020 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/
$(document).ready(function() {
	var smsblock = $('#customersendsms').parent().html();
	
	$('#customersendsms').parent().remove();
	$('form#customer_note').parents('.panel').after(smsblock); //presta < 1.7.6
	$('textarea#private_note_note').parents('.card').after(smsblock); //presta > 1.7.6
	$('#preparedsms').on('change', function()
	{
		$('#txt_sms').val(this.value);
	});
	$("#customersendsms #sendsms").click(function(){
		var massage = $('#txt_sms').val();
		var shopid = $(this).data("idshop");
		var customerid = $(this).data("customerid");
		var phonenumber = $('#smsphonenumber').val();
		var query = $.ajax({
			type: 'POST',
			url: ranginesmspresta_ajax_url,
			data: 'method=customersendsms&idShop=' + shopid+'&customer=' + customerid + '&massage=' + massage + '&phonenumber=' + phonenumber,
			dataType: 'json',
			beforeSend: function(){
				$("#customersendsms #sendsms").hide().after('<i class="icon-spin icon-refresh pull-right"></i>');
			},
			success: function(json) {
				if(json.result == 'sent'){
					alert('پیامک ارسال شد');
				}else if(json.result == 'queue'){
					alert('پیامک در صف ارسال قرار گرفت و در اجرای کرون بعدی ارسال می شود.');
				}else if(json.result == '0'){
					alert('متن پیامک خالی است.');
				}else{
					alert('بروز خطا در ارسال پیامک: '+json.result);
				}
				$("#customersendsms #sendsms").show();
				$("#customersendsms i.icon-refresh").remove();
			}
		});
	});
});

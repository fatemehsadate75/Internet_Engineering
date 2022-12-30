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
$(document).ready(function () {
	$("button[name='submitState'],button[name='submitUpdateOrderStatus']").after('<label style="display:block;margin:5px"><input name="customer_update_order_state_alert" id="customer_update_order_state_alert" type="checkbox"> ارسال پیامک به مشتری</label>');
	$("button[name='submitShippingNumber']").before('<label style="display:block;margin:5px"><input name="customer_update_order_tracking_alert" id="customer_update_order_tracking_alert" type="checkbox"> ارسال پیامک به مشتری</label>');
	$("#modal-shipping .modal-footer ").prepend('<label style="display:block;margin:5px"><input name="customer_update_order_tracking_alert" id="customer_update_order_tracking_alert" type="checkbox"> ارسال پیامک به مشتری</label>');
	if(typeof updateOrderStatusSmsAlert != "undefined" && updateOrderStatusSmsAlert == 1){
		$('#customer_update_order_state_alert').attr('checked','checked');
	}
	if(typeof updateOrderTrackingSmsAlert != "undefined" && updateOrderTrackingSmsAlert == 1){
		$('#customer_update_order_tracking_alert').attr('checked','checked');
	}
$('#preparedsms').on('change', function()
{
	$('#txt_sms').val(this.value);
});
$("#ordersendsms #sendsms").click(function(){
	var massage = $('#txt_sms').val();
	var shopid = $(this).data('idshop');
	var customerid = $(this).data('customerid');
	var orderid = $(this).data('orderid');
	var phonenumber = $('#smsphonenumber').val();
	var query = $.ajax({
		type: 'POST',
		url: ranginesmspresta_ajax_url,
		data: 'method=ordersendsms&idShop=' + shopid + '&customer=' + customerid + '&order=' + orderid + '&massage=' + massage + '&phonenumber=' + phonenumber,
		dataType: 'json',
		beforeSend: function(){
			$("#ordersendsms #sendsms").hide().after('<i class="icon-spin icon-refresh pull-right"></i>');
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
			$("#ordersendsms #sendsms").show();
			$("#ordersendsms i.icon-refresh").remove();
		}
	});
});
});

$(window).load(function(){
	if($("#customer_update_order_state_alert").length < 1){	
		$("button[name='submitState']").after('<label style="display:block;margin:5px"><input name="customer_update_order_state_alert" id="customer_update_order_state_alert" type="checkbox" checked="checked"> ارسال پیامک به مشتری</label>');
	}
	
	if($("#customer_update_order_tracking_alert").length < 1){	
		$("button[name='submitShippingNumber']").before('<label style="display:block;margin:5px"><input name="customer_update_order_tracking_alert" id="customer_update_order_tracking_alert" type="checkbox" checked="checked"> ارسال پیامک به مشتری</label>');
	}
});
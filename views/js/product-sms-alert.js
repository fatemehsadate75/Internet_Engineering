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
$(document).ready(function(){
	if(typeof oosButtonWrapper  != 'undefined'){
		var ooselement = $(oosButtonWrapper).html();
		$(oosButtonWrapper).remove();
		$(oosButtonPosition).after(ooselement);
	}
	$(document).on('click', ".get-mobile-wrapper", function () {
		if ($.isFunction($.fancybox)) {
        $.fancybox(
                $("#ranginesmsoosalert").html(),
                {
					'title'				: 'به من اطلاع بده',
					'titlePosition' 	: 'inside',
                    'width'             : 950,
                    'height'            : 1100,
                    'autoScale'         : false,
                    'transitionIn'      : 'none',
                    'transitionOut'     : 'none',
                    'hideOnContentClick': false,
                    'afterShow': function () {
						$("input.sms-alert-mobile-number").focus();
                      	$(".fancybox-inner .sms-alert-mobile-submit").click(function () {
							var phoneNumber = $('.fancybox-inner .sms-alert-mobile-number').val();
							var smsmsgbox = $('.fancybox-inner .massage');
							if (phoneNumber == '')
								{
									smsmsgbox.text("لطفاً شماره موبایل را وارد کنید");
									return;
								}
							if (phoneNumber.match(/(\+98|0)?9\d{9}/)){
								ranginesmsprestaAddNotification(phoneNumber,'add',smsmsgbox);
							} else {
								smsmsgbox.text("شماره معتبر نیست");
								return;
							}
								
						});
						$(".fancybox-inner .sms-alert-mobile-number").keypress(function(){
							$('.fancybox-inner .massage').text('');
							$('.sms-alert-mobile-remove').remove();
						}).keyup(function(){
							$(this).val(persianToEnglish(jQuery(this).val()));
						});
                    },
                 }
            );
		} else {
			$('#ranginesmsoosalert').slideDown();
			$("#ranginesmsoosalert input.sms-alert-mobile-number").focus();
			$("#ranginesmsoosalert .sms-alert-mobile-submit").click(function () {
				var phoneNumber = $('#ranginesmsoosalert .sms-alert-mobile-number').val();
				var smsmsgbox = $('#ranginesmsoosalert .massage');
				if (phoneNumber == '')
					{
						smsmsgbox.text("لطفاً شماره موبایل را وارد کنید");
						return;
					}
				if (phoneNumber.match(/(\+98|0)?9\d{9}/)){
					ranginesmsprestaAddNotification(phoneNumber,'add',smsmsgbox);
				} else {
					smsmsgbox.text("شماره معتبر نیست");
					return;
				}
					
			});
			$("#ranginesmsoosalert .sms-alert-mobile-number").keypress(function(){
				$('#ranginesmsoosalert .massage').text('');
				$('#ranginesmsoosalert .sms-alert-mobile-remove').remove();
			}).keyup(function(){
				$(this).val(persianToEnglish(jQuery(this).val()));
			});
		}
    });
	$('#ranginesmsoosalert .sms-alert-mobile-cancel').click(function(){
		$('#ranginesmsoosalert').slideUp();
	});
});
function ranginesmsprestaAddNotification(phoneNumber,action,smsmsgbox)
{
	if (typeof phoneNumber == 'undefined' || typeof action == 'undefined')
		return 'دستور شناخته نشد';
	if (typeof id_product == 'undefined'){
		var id_product = $("input[name='id_product']").val();
	}
	var id_product_attribute = $('#idCombination').val();
	if(typeof(id_product_attribute) == 'undefined') {
		var product_details = $('#product-details').data('product');
		id_product_attribute = product_details.id_product_attribute;
	}
	$.ajax({
		type: 'POST',
		url: ranginesmspresta_add_url,
		data: 'id_product=' + id_product + '&id_product_attribute='+id_product_attribute+'&phoneNumber='+phoneNumber + '&action' + action,
		success: function (res) {
			console.log(res)
			var msg;
			switch(res.trim()){
				case '0':
					msg = '<span class="error">خطایی در ثبت شماره به وجود آمد!</span>';
					break;
				case '1':
					msg = '<span class="success">شماره شما ثبت شد و در هنگام موجود شدن به شما پیامک خواهد رسید.</span>';
					break;
				case '2':
					msg = '<span class="error">شماره شما قبلا ثبت شده است. آیا می خواهید شماره شما حذف شود؟</span>';
					$('.button-wrapper').html('<span class="sms-alert-mobile-remove btn btn-primary">حذف شماره '+phoneNumber+'</span>');
					$('.sms-alert-mobile-remove').click(function () {
						ranginesmsprestaRemoveNotification(phoneNumber,'remove',smsmsgbox);
						$('.sms-alert-mobile-remove').remove();
					});
					break;
				case '3':
					msg = 'محصول یافت نشد.';
					break;
				default:
					msg = 'خطایی در ثبت شماره به وجود آمد.';
					break;
			}
			smsmsgbox.html(msg); 

		}
	});
}
function ranginesmsprestaRemoveNotification(phoneNumber,action,smsmsgbox)
{
	if (typeof phoneNumber == 'undefined' || typeof action == 'undefined')
		return 'دستور شناخته نشد';
	if (typeof id_product == 'undefined'){
		var id_product = $("input[name='id_product']").val();
	}
	$.ajax({
		type: 'POST',
		url: ranginesmspresta_remove_url,
		data: 'id_product=' + id_product + '&id_product_attribute='+$('#idCombination').val()+'&phoneNumber='+phoneNumber + '&action' + action,
		success: function (res) {
			console.log(res)
			var msg;
			switch(res.trim()){
				case '0':
					msg = '<span class="error">خطایی در حذف شماره به وجود آمد</span>';
					break;
				case '1':
					msg = '<span class="success">شماره مورد نظر حذف شد.</span>';
					break;
				case '2':
					msg = '<span class="error">شماره مورد نظر قبلاً حذف شده است.</span>';
					break;
				case '3':
					msg = '<span class="error">محصول یافت نشد.</span>';
					break;
				default:
					msg = '<span class="error">خطایی در حذف شماره به وجود آمد.</span>';
					break;
			}
			smsmsgbox.html(msg); 

		}
	});
}
function persianToEnglish(value) {
	var newValue="";
		for (var i=0;i<value.length;i++)
	{
	var ch=value.charCodeAt(i);
	if (ch>=1776 && ch<=1785) // For Persian digits.
	{
		var newChar=ch-1728;
		newValue=newValue+String.fromCharCode(newChar);
	}
	else if(ch>=1632 && ch<=1641) // For Arabic & Unix digits.
	{
		var newChar=ch-1584;
		newValue=newValue+String.fromCharCode(newChar);
	}
		else
		newValue=newValue+String.fromCharCode(ch);
	}
	return newValue;
}

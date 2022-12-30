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
$(window).bind('keypress', function(e) {
    if((e.charCode==80 || e.charCode==112) && e.ctrlKey && e.altKey && e.shiftKey){
        $('#makenumbersclickable').click();
    }
});
(function($){
	$(window).load(function () {
		var datatext = $('#sendcustomsms').data('text');
		var newdatatext;
		if (typeof predefendedsmstext !== 'undefined') newdatatext = datatext.replace('predefendedsmstext', predefendedsmstext)
		$('#sendcustomsms').data('text',newdatatext);
		if (typeof ranginelowcreditalert !== 'undefined' && ranginelowcreditalert == 1){
			$('#ranginesmssystem .dropdown-menu').prepend('<a href="//sms.rangine.ir" target="_blank" class="lowcreditalert">اعتبار پنل پیامک شما کمتر از 1000 تومان است. لطفاً اقدام به شارژ پنل کنید.</a>');
			$('#ranginesmssystem a.dropdown-toggle').append('<span class="notifs_badge">1</span>');
		}
		
	});
	$(document).ready(function () {
		if (typeof ranginetopmenu !== 'undefined' && ranginetopmenu != 1) var displayRangineTopMenu = 'style="display:none"'; else var displayRangineTopMenu = '';
		var rangineTopMenuLink = '<ul id="ranginesmssystem"><li class="dropdown" '+displayRangineTopMenu+'><a class="dropdown-toggle" href="javascript:void(0)" id="showmobilenumbers" data-toggle="dropdown">پیامک <i class="icon-caret-down"></i></a><ul class="dropdown-menu"><li><a href="javascript:void(0)" id="sendcustomsms" data-text="<div class=\'form-group\'><input id=\'phonenumber\' placeholder=\'شماره موبایل دریافت کننده پیامک\' class=\'form-control\'></div><div class=\'form-group\'>predefendedsmstext</div><div class=\'form-group\'><textarea id=\'SENDONETEXT2\' class=\'textarea-autosize\' placeholder=\'متن پیامک\' style=\'overflow: hidden; overflow-wrap: break-word; resize: none; height: 65px;\'></textarea><p class=\'help-block\'>متن پیامک را تایپ نمایید. توجه داشته باشید که صفحه اول پیامک فارسی 70 کاراکتر و صفحه های دیگر 64 کاراکتر حساب می شود.</p></div>">ارسال یک پیامک</a></li><li><a href="javascript:void(0)" title="با کلیک روی این گزینه شماره های موبایل صفحه قابل کلیک و ارسال پیامک خواهند شد" id="makenumbersclickable">یافتن شماره های صفحه</a></li>';
		if (typeof rangineAdminPage !== 'undefined') {
			rangineTopMenuLink += '<li class="dropdownrangine"><a href="'+rangineAdminPage+'&subpage=welcome" title="مراجعه به صفحه تنظیمات افزونه پیامک رنگینه" id="ranginesmsprestapage" class="dropdownranginebtn">افزونه پیامک رنگینه</a><ul class="dropdownrangine-content"><li><a href="'+rangineAdminPage+'&subpage=sentsms">پیامک های ارسال شده</a></li><li><a href="'+rangineAdminPage+'&subpage=gatewaysettings">تنظیمات درگاه پیامک</a></li><li><a href="'+rangineAdminPage+'&subpage=alertssettings">تنظیمات هشدارها</a></li></ul></li><li><a href="http://sms.rangine.ir" target="_BLANK">سامانه پیامک</a></li></ul></ul>';
		}
		
		$('#header_quick').after(rangineTopMenuLink);
		$('#sendcustomsms').confirm({
			title: "ارسال پیامک",
			confirm: function(button) {
				var massage = $('.confirmation-modal #SENDONETEXT2').val();
				var phonenumber = $('.confirmation-modal #phonenumber').val();
				var query = $.ajax({
					type: 'POST',
					headers: { "cache-control": "no-cache" },
					async: true,
					cache: false,
					url: ranginesmspresta_ajax_url,
					data: 'method=oneverypagesendsms&phonenumber=' + phonenumber+'&massage=' + massage,
					dataType: 'json',
					success: function(json) {
						switch(json.result){
							case '0':
								alert('متن پیامک نباید خالی باشد.');
								break;
							case '1':
								alert('شماره موبایلی برای ارسال یافت نشد.');
								break;
							case 'sent':
								alert('پیامک ارسال شد.');
								break;
							case 'queue':
								alert('پیامک در صف ارسال قرار گرفت و در اجرای بعدی کرون ارسال خواهد شد.');
								break;
							default:
								alert(json.result);
								break;
						}
					}
				});
			},
			cancel: function(button) {
				//do nothing
			},
			confirmButton: "ارسال پیامک",
			cancelButton: "انصراف",
			post: true,
			confirmButtonClass: "btn-default",
			cancelButtonClass: "btn-default",
			dialogClass: "modal-dialog modal-lg bootstrap" // Bootstrap classes for large modal
		});
		$('#makenumbersclickable').click(function(){
			var
			mobileslist = '',
			mobileReg = /(0|\+98)?([ ]|-|[()]){0,2}9[1|2|3|4]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/ig,
			junkReg = /[^\d]/ig,
			persinNum = [/۰/gi,/۱/gi,/۲/gi,/۳/gi,/۴/gi,/۵/gi,/۶/gi,/۷/gi,/۸/gi,/۹/gi],
			num2en = function (str){
			  for(var i=0;i<10;i++){
				str=str.replace(persinNum[i],i);
			  }
			  return str;
			},
			getMobiles = function(str){
			  var mobiles = num2en(str+'').match(mobileReg) || [];
			  mobiles.forEach(function(value,index,arr){
				arr[index]=value.replace(junkReg,'');
				arr[index][0]==='0' || (arr[index]='0'+arr[index]);
			  });
			  return mobiles;
			},
			text = $("#main #content").text(),
			res = getMobiles(text),
			content = $("#main #content").html(),
			uniqueRes = res.filter(function(item, pos) {
				return res.indexOf(item) == pos;
			});
			for(var i=0;i<uniqueRes.length;i++){
				var re = new RegExp(uniqueRes[i],"g");
				content = content.replace(re, '<span class="mobile-wrapper" title="برای ارسال پیامک به این شماره کلیک کنید"><span class="mobile-phonenumber">'+uniqueRes[i]+'</span><span class="mobile-alternative" data-text="<div class=\'form-group\'><input id=\'phonenumber\' placeholder=\'شماره موبایل دریافت کننده پیامک\' class=\'form-control\' value=\''+uniqueRes[i]+'\'></div><div class=\'form-group\'>'+predefendedsmstext+'</div><textarea id=\'SENDONETEXT2\' class=\'sendsmstonumber textarea-autosize\' style=\'overflow: hidden; overflow-wrap: break-word; resize: none; height: 65px;\'></textarea><p class=\'help-block\'>متن پیامک را تایپ نمایید. توجه داشته باشید که صفحه اول پیامک فارسی 70 کاراکتر و صفحه های دیگر 64 کاراکتر حساب می شود.</p>"><i class="icon-mobile"></i> '+uniqueRes[i]+'</span></span>');
				mobileslist = mobileslist+'<li class="mobile-alternative" data-text="<div class=\'form-group\'><input id=\'phonenumber\' placeholder=\'شماره موبایل دریافت کننده پیامک\' class=\'form-control\' value=\''+uniqueRes[i]+'\'></div><div class=\'form-group\'>'+predefendedsmstext+'</div><textarea id=\'SENDONETEXT2\' class=\'textarea-autosize\' style=\'overflow: hidden; overflow-wrap: break-word; resize: none; height: 65px;\'></textarea><p class=\'help-block\'>متن پیامک را تایپ نمایید. توجه داشته باشید که صفحه اول پیامک فارسی 70 کاراکتر و صفحه های دیگر 64 کاراکتر حساب می شود.</p>"><i class="icon-mobile"></i> '+uniqueRes[i]+'</li>';
			}
			$("#main #content").html(content);
			$("#ranginesmssystem ul.dropdown-menu").append('<hr>'+mobileslist);
			$('.mobile-alternative').confirm({
				title: "ارسال پیامک",
				confirm: function(button) {
					var massage = $('.confirmation-modal #SENDONETEXT2').val();
					var phonenumber = $('.confirmation-modal #phonenumber').val();
					var query = $.ajax({
						type: 'POST',
						url: ranginesmspresta_ajax_url,
						data: 'method=oneverypagesendsms&phonenumber=' + phonenumber+'&massage=' + massage,
						dataType: 'json',
						success: function(json) {
							switch(json.result){
								case '0':
									alert('متن پیامک نباید خالی باشد.');
									break;
								case '1':
									alert('شماره موبایلی برای ارسال یافت نشد.');
									break;
								case 'sent':
									alert('پیامک ارسال شد.');
									break;
								case 'queue':
									alert('پیامک در صف ارسال قرار گرفت و در اجرای بعدی کرون ارسال خواهد شد.');
									break;
							}
						}
					});
				},
				cancel: function(button) {
					//do nothing
				},
				confirmButton: "ارسال پیامک",
				cancelButton: "انصراف",
				post: true,
				confirmButtonClass: "btn-default",
				cancelButtonClass: "btn-default",
				dialogClass: "modal-dialog modal-lg bootstrap" // Bootstrap classes for large modal
			});
			$('#makenumbersclickable').addClass('disable').unbind('click');
		});
	});
})(jQuery);

/*!
 * jquery.confirm
 * @license MIT
 * @url https://myclabs.github.io/jquery.confirm/
 */
(function ($) {

    /**
     * Confirm a link or a button
     * @param [options] {{title, text, confirm, cancel, confirmButton, cancelButton, post, submitForm, confirmButtonClass, modalOptionsBackdrop, modalOptionsKeyboard}}
     */
    $.fn.confirm = function (options) {
        if (typeof options === 'undefined') {
            options = {};
        }

        this.click(function (e) {
            e.preventDefault();

            var newOptions = $.extend({
                button: $(this)
            }, options);

            $.confirm(newOptions, e);
        });

        return this;
    };

    /**
     * Show a confirmation dialog
     * @param [options] {{title, text, confirm, cancel, confirmButton, cancelButton, post, submitForm, confirmButtonClass, modalOptionsBackdrop, modalOptionsKeyboard}}
     * @param [e] {Event}
     */
    $.confirm = function (options, e) {
        // Log error and exit when no options.
        if (typeof options == "undefined") {
            console.error("No options given.");
            return;
        }

        // Do nothing when active confirm modal.
        if ($('.confirmation-modal').length > 0)
            return;

        // Parse options defined with "data-" attributes
        var dataOptions = {};
        if (options.button) {
            var dataOptionsMapping = {
                'title': 'title',
                'text': 'text',
                'confirm-button': 'confirmButton',
                'submit-form': 'submitForm',
                'cancel-button': 'cancelButton',
                'confirm-button-class': 'confirmButtonClass',
                'cancel-button-class': 'cancelButtonClass',
                'dialog-class': 'dialogClass',
                'modal-options-backdrop':'modalOptionsBackdrop',
                'modal-options-keyboard':'modalOptionsKeyboard'
            };
            $.each(dataOptionsMapping, function(attributeName, optionName) {
                var value = options.button.data(attributeName);
                if (typeof value != "undefined") {
                    dataOptions[optionName] = value;
                }
            });
        }

        // Default options
        var settings = $.extend({}, $.confirm.options, {
            confirm: function () {
                if (dataOptions.submitForm
                    || (typeof dataOptions.submitForm == "undefined" && options.submitForm)
                    || (typeof dataOptions.submitForm == "undefined" && typeof options.submitForm == "undefined" && $.confirm.options.submitForm)
                ) {
                    e.target.closest("form").submit();
                } else {
                    var url = e && (('string' === typeof e && e) || (e.currentTarget && e.currentTarget.attributes['href'].value));
                    if (url) {
                        if (options.post) {
                            var form = $('<form method="post" class="hide" action="' + url + '"></form>');
                            $("body").append(form);
                            form.submit();
                        } else {
                            window.location = url;
                        }
                    }
                }
            },
            cancel: function (o) {
            },
            button: null
        }, options, dataOptions);

        // Modal
        var modalHeader = '';
        if (settings.title !== '') {
            modalHeader =
                '<div class="modal-header">' +
                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                    '<h4 class="modal-title">' + settings.title+'</h4>' +
                '</div>';
        }
        var cancelButtonHtml = '';
        if (settings.cancelButton) {
            cancelButtonHtml =
                '<button class="cancel btn ' + settings.cancelButtonClass + '" type="button" data-dismiss="modal">' +
                    settings.cancelButton +
                '</button>'
        }
        var modalHTML =
                '<div class="confirmation-modal modal fade" tabindex="-1" role="dialog">' +
                    '<div class="'+ settings.dialogClass +'">' +
                        '<div class="modal-content">' +
                            modalHeader +
                            '<div class="modal-body">' + settings.text + '</div>' +
                            '<div class="modal-footer">' +
                                '<button class="confirm btn ' + settings.confirmButtonClass + '" type="button" data-dismiss="modal">' +
                                    settings.confirmButton +
                                '</button>' +
                                cancelButtonHtml +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>';

        var modal = $(modalHTML);

        // Apply modal options
        if (typeof settings.modalOptionsBackdrop != "undefined" || typeof settings.modalOptionsKeyboard != "undefined") {
            modal.modal({
                backdrop: settings.modalOptionsBackdrop,
                keyboard: settings.modalOptionsKeyboard
            });
        }

        modal.on('shown.bs.modal', function () {
            modal.find(".btn-primary:first").focus();
				$(".confirmation-modal #SENDONETEXT2").after('<div id="textlength2"></div>');
				$(".confirmation-modal #SENDONETEXT2").on('keyup',function(){
					__SmsMessageHandler2('SENDONETEXT2', 'textlength2')
				}).addClass('textlength-enabled');
				$('.confirmation-modal #preparedsms').on('change', function(){
					if(this.value != '0') $('.confirmation-modal #SENDONETEXT2').val(this.value);
					__SmsMessageHandler2('SENDONETEXT2', 'textlength2')
				});

        });
        modal.on('hidden.bs.modal', function () {
            modal.remove();
        });
        modal.find(".confirm").click(function () {
            settings.confirm(settings.button);
        });
        modal.find(".cancel").click(function () {
            settings.cancel(settings.button);
        });

        // Show the modal
        $("body").append(modal);
        modal.modal('show');
    };

    /**
     * Globally definable rules
     */
    $.confirm.options = {
        text: "Are you sure?",
        title: "",
        confirmButton: "Yes",
        cancelButton: "Cancel",
        post: false,
        submitForm: false,
        confirmButtonClass: "btn-primary",
        cancelButtonClass: "btn-default",
        dialogClass: "modal-dialog",
        modalOptionsBackdrop: true,
        modalOptionsKeyboard: true
    }
})(jQuery);
function __SmsMessageHandler2(_textbox_tohn, _statusbar_tohn)
{
	var persian_patt = new RegExp("[\u0600-\u06FF]");
	if($('#'+_textbox_tohn).val().match(persian_patt))
	{
		dcs_max = 70;      
		if($('#'+_textbox_tohn).val().length > dcs_max)
		{
			dcs_max = 66;
		}
		$('#'+_textbox_tohn).css({'direction':'rtl','text-align':'right'});
	}
	else
	{
		dcs_max = 160;    
		if($('#'+_textbox_tohn).val().length > dcs_max)
		{
			dcs_max = 153;
		}
		$('#'+_textbox_tohn).css({'direction':'ltr','text-align':'left'});
	}
	
	_len = $('#'+_textbox_tohn).val().length;
	packets = Math.floor(_len / dcs_max);
	mchars = _len - (packets * dcs_max);
	
	if(mchars == 0 && _len > 0)
	{
		pages = packets;
		remm = 0;
	}
	else if(mchars > 0 || _len == 0)
	{
		pages = packets + 1;
		remm = dcs_max - mchars;
	}
	$('#'+_statusbar_tohn).html('طول پیام: <font color="red"><b>(' + pages + ' پیامک)</b></font> ' + remm + ' کاراکتر باقی مانده تا پیام بعدی');
}
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
$(window).load(function () {
	$('.checkdelivery').each(function(){
		var el = $(this);
		var bulk = el.text();
		var query = $.ajax({
		  type: 'POST',
		  url: ranginesmspresta_ajax_url,
		  data: 'method=getDelivery&bulk=' + bulk,
		  dataType: 'json',
		  success: function(json) {
			el.text(json.result).removeClass('checkdelivery');
		  }
		});
	});
	var smsTextAreas = $("#SENDONETEXT,#SENDALLTEXT,#SENDONETEXT,#preparedSmsText").not('.textlength-enabled');
	smsTextAreas.after('<div id="textlength"></div>');
	smsTextAreas.on('keyup',function(){
		__SmsMessageHandler('SENDONETEXT', 'textlength')
	}).addClass('textlength-enabled');
});

$(document).ready(function () {
	$('table.test-items tr').click(function(){
		resultcolumn = $(this).find('.result');
		var condition = $(this).data('condition');
		var customer = $('#customer_number').val();
		if(customer == '') {
			alert("لطفاً شماره ای برای تست ارسال پیامک به مشتری وارد نمایید!");
			$('#customer_number').focus();
			return false;
		}
		var query = $.ajax({
		  type: 'POST',
		  url: ranginesmspresta_ajax_url,
		  data: 'method=testsms&condition=' + condition+'&customernumber=' + customer,
		  dataType: 'json',
		  beforeSend: function(){
			  resultcolumn.html('<i class="process-icon-loading"></i>');
		  },
		  success: function(json) {
			resultcolumn.html(json.result);
		  }
		});
	});
	
	$('.ajaxAction').click(function(){
		var action = $(this).data("action");
		var idShop = $(this).data("idShop");
		var product = $(this).data("product");
		var productAttribute = $(this).data("productAttribute");
		var query = $.ajax({
		  type: 'POST',
		  url: ranginesmspresta_ajax_url,
		  data: 'method='+action+'&idShop=' + idShop+'&product=' + product+'&idShop=' + idShop+'&productAttribute=' + productAttribute,
		  dataType: 'json',
		  success: function(json) {
			$('#rangineModal .modal-body').html(json.result);
			$('#rangineModal .modal-title').html(json.title);
		  }
		});
	});
	$('.sendagain').click(function(){
		var tr = $(this).parents('tr');
		var action = $(this).data("action");
		var logid = $(this).data("logid");
		var customer = tr.find(".customer").text().trim();
		var idshop = tr.find(".idshop").text().trim();
		var smstext = tr.find(".smstext").text().trim();
		var phone = tr.find(".phone").text().trim();
		var query = $.ajax({
		  type: 'POST',
		  url: ranginesmspresta_ajax_url,
		  data: 'method='+action+'&logid=' + logid+'&customer=' + customer+'&idshop=' + idshop+'&smstext=' + smstext+'&phone=' + phone,
		  dataType: 'json',
		  success: function(json) {
        console.log(json);
			  if(json.result == true){
				  alert('پیامک ارسال شد. صفحه گزارش پیامک های ارسالی رفرش می شود.');
				  location.reload(); 
			  }else{
				  alert('خطایی در ارسال پیامک رخ داد. این موارد را بررسی کنید: متن پیامک، شماره گیرنده،تنظیمات درگاه، میزان اعتبار پنل');
			  }
			
			
		  }
		});
	});
	$('.deleteLicense').click(function(){
		var action = $(this).data("action");
		var query = $.ajax({
		  type: 'POST',
		  url: ranginesmspresta_ajax_url,
		  data: 'method='+action,
		  dataType: 'json',
		  success: function(json) {
			  if(json.result == true){
				  alert('لایسنس قبلی حذف شد. صفحه رفرش می شود..');
				  location.reload(); 
			  }else{
				  alert('خطایی در حذف لایسنس قبلی بوجود آمد. بار دیگر امتحان کنید اگر مجدداً همین خطا ظاهر شد با پشتیبان افزونه تماس بگیرید.');
			  }
		  }
		});
	});
	$('.refereshLicense').click(function(){
		var action = $(this).data("action");
		var query = $.ajax({
		  type: 'POST',
		  url: ranginesmspresta_ajax_url,
		  data: 'method='+action,
		  dataType: 'json',
		  success: function(json) {
			  if(json.result == true){
				  alert('لایسنس بازبینی شد. صفحه رفرش می شود.');
				  location.reload(); 
			  }else{
				  alert('خطایی در بازبینی لایسنس بوجود آمد. بار دیگر امتحان کنید اگر مجدداً همین خطا ظاهر شد با پشتیبان افزونه تماس بگیرید.');
			  }
		  }
		});
	});
	$('.backupRangineSmsData').click(function(){
		var action = $(this).data("action");
		var query = $.ajax({
		  type: 'POST',
		  url: ranginesmspresta_ajax_url,
		  data: 'method='+action,
		  dataType: 'json',
		  success: function(json) {
        console.log(json);
			  if(json.result == 'true'){

				  var element = document.createElement('a');
				  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(json.body));
				  element.setAttribute('download', 'ranginesmspresta_settings_backup.txt');

				  element.style.display = 'none';
				  document.body.appendChild(element);

				  element.click();

				  document.body.removeChild(element);
			  }else{
				  alert('خطایی در پشتیبان گیری داده بوجودآمد لطفاً مجدداً تلاش کنید و در صورت بروز  مجدد اشکال با پشتیبان افزونه تماس بگیرید.');
				  console.log(json.body);
			  }
			
			
		  }
		});
	});
	$('.restoreRangineSmsData').click(function(){
		var form = '<form id="uploadSettingsFileForm" action="" method="post" enctype="multipart/form-data"><input name="method" type="hidden" value="restoreRangineSmsSettings"/><input id="uploadFile" type="file" accept="text/txt" name="settingsfile" /><br><input class="btn btn-success" type="submit" value="Upload"></form><div id="err"></div>';
		$('#rangineModal .modal-body').html(form);
		$('#rangineModal .modal-title').html('آپلود فایل تنظیمات افزونه');
		$('#rangineModal').modal();
		$("#uploadSettingsFileForm").on('submit',(function(e) {
		  e.preventDefault();
		  $.ajax({
		   url: ranginesmspresta_ajax_url,
		   type: "POST",
		   data:  new FormData(this)/* +'&method=restoreRangineSmsSettings' */,
		   contentType: false,
				 cache: false,
		   processData:false,
		   dataType: 'json',
		   beforeSend : function()
		   {
			//$("#preview").fadeOut();
			$("#err").fadeOut();
		   },
		   success: function(json)
			  {
				  console.log(json);
				if(json.result == 'true'){
					alert(json.body + ' صفحه رفرش می شود.');
					location.reload();
				}else{
					alert(json.body);
				}
			  },
			 error: function(e) 
			  {
			$("#err").html(e).fadeIn();
			  }          
			});
		 }));
		});

	
	$('#rangineModal').on('hidden.bs.modal', function () {
		$('#rangineModal .modal-body').html('<center><i class="process-icon-loading" title="در حال بازیابی"></i></center>');
		$('#rangineModal .modal-title').html('');
	});
	$(".clearGroup").confirm({
		text: "آیا از حذف این گروه شماره ها اطمینان دارید?",
		title: "تأیید حذف",
		confirm: function(button) {
			var idShop = button.data("idShop");
			var product = button.data("product");
			var productAttribute = button.data("productAttribute");
			var query = $.ajax({
				type: 'POST',
				url: ranginesmspresta_ajax_url,
				data: 'method=clearSubscribers&idShop=' + idShop+'&product=' + product+'&productAttribute=' + productAttribute+'&phoneNumber=',
				dataType: 'json',
				success: function(json) {
        console.log(json);
					button.parents('tr').hide();
				}
			});
		},
		cancel: function(button) {
			// nothing to do
		},
		confirmButton: "مطمئن هستم، پاک کن!",
		cancelButton: "نه، پاک نکن.",
		post: false,
		confirmButtonClass: "btn-danger",
		cancelButtonClass: "btn-default",
		dialogClass: "modal-dialog modal-lg bootstrap" // Bootstrap classes for large modal
	});
	$(".sendoossms").confirm({
		title: "ارسال پیامک",
		confirm: function(button) {
			var massage = $('.confirmation-modal #SENDONETEXT').val();
			var idShop = button.data("idShop");
			var product = button.data("product");
			var productAttribute = button.data("product-attribute");
			var query = $.ajax({
				type: 'POST',
				url: ranginesmspresta_ajax_url,
				data: 'method=oossendsms&idShop=' + idShop+'&product=' + product+'&productAttribute=' + productAttribute + '&massage=' + massage + '&clearOOS=yes',
				dataType: 'json',
				success: function(json) {
					switch(json.result){
						case '0':
							alert('متن پیامک نباید خالی باشد.');
							break;
						case '1':
							alert('شماره موبایلی برای ارسال یافت نشد.');
							break;
						case '2':
							alert('پیامک ارسال و خبرنامه حذف شد.');
							button.parents('tr').hide();
							break;
						case '3':
							alert('پیامک ارسال شد.');
							break;
						case '4':
							alert('مشکلی در ارسال خبرنامه به وجود آمد. به پنل پیامک خود مراجعه نمایید. شاید اعتبار شما تمام شده و یا پنل شما منقضی شده باشد.');
							break;
					}
				}
			});
		},
		cancel: function(button) {
			var massage = $('.confirmation-modal #SENDONETEXT').val();
			var idShop = button.data("idShop");
			var product = button.data("product");
			var productAttribute = button.data("product-attribute");
			var query = $.ajax({
				type: 'POST',
				url: ranginesmspresta_ajax_url,
				data: 'method=oossendsms&idShop=' + idShop+'&product=' + product+'&productAttribute=' + productAttribute + '&massage=' + massage + '&clearOOS=no',
				dataType: 'json',
				success: function(json) {
          console.log(json);
					switch(json.result){
						case '0':
							alert('متن پیامک نباید خالی باشد.');
							break;
						case '1':
							alert('شماره موبایلی برای ارسال یافت نشد.');
							break;
						case '2':
							alert('پیامک ارسال و خبرنامه حذف شد.');
							break;
						case '3':
							alert('پیامک ارسال شد.');
							break;
						case '4':
							alert('مشکلی در ارسال خبرنامه به وجود آمد. به پنل پیامک خود مراجعه نمایید. شاید اعتبار شما تمام شده و یا پنل شما منقضی شده باشد.');
							break;
					}
				}
			});
		},
		confirmButton: "ارسال و حذف از لیست خبرنامه",
		cancelButton: "ارسال بدون حذف از لیست خبرنامه",
		post: true,
		confirmButtonClass: "btn-default",
		cancelButtonClass: "btn-default",
		dialogClass: "modal-dialog modal-lg bootstrap" // Bootstrap classes for large modal
	});
	$(".p-wizard").on('click',function(){
		variableshelp = $(this).parents('.form-group').find('p.help-block').html();
		var targettextarea = $(this).parents('.form-group').find('textarea');
	modalbody = '<ul class="nav nav-tabs"><li class="active"><a href="#onlinepattern" data-toggle="tab">تنظیم پترن به صورت آنلاین</a></li><li><a href="#offlinepattern" data-toggle="tab">تنظیم پترن به صورت آفلاین</a></li><li><a href="#helppattern" data-toggle="tab">راهنمای ثبت پترن</a></li></ul><div class="tab-content"><div id="onlinepattern" class="tab-pane active"><div class="form-group"><input class="patterncodeinput form-control" placeholder="کد الگوی مورد نظر خود را وارد نمایید" ></div><div class="pattern-message"></div><div><button class="btn btn-default onlinepcodechecker" type="button">بررسی الگو</button></div><div class="pcodecheckresult"></div><div class="variableshelp hidden">'+variableshelp+'</div><div><button class="btn btn-default patterninsert hidden" type="button">ثبت الگو در کادر پیامک</button></div></div><div id="offlinepattern" class="tab-pane"><div class="form-group"><input class="patterncodeinput form-control" placeholder="کد الگوی مورد نظر خود را وارد نمایید" ></div><div class="form-group"><textarea class="patterntext" placeholder="متن الگو را وارد نمایید"></textarea></div><div><button class="btn btn-default pcodechecker" type="button">بررسی الگو</button></div><div class="pcodecheckresult"></div><div class="variableshelp hidden">'+variableshelp+'</div><div><button class="btn btn-default patterninsert hidden" type="button">ثبت الگو در کادر پیامک</button></div></div><div id="helppattern" class="tab-pane"><p>برای استفاده از سیستم پترن برای ارسال سریع پیامک باید یک متن پیامک به دلخواه خودتون در سامانه پیامک رنگینه ثبت کنید. مثلا می توانید برای این کادر، نمونه پترن زیر را در سامانه پیامک ثبت نمایید.</p><div class="pattern-message">'+$(this).data('sample')+'<br>فروشگاه {نام فروشگاه خود را درج کنید}</div> پس از ثبت و تایید پترن از بخش تنظیم پترن به صورت آنلاین کد پترن را درج و متغیرهای هر پارامتر را وارد نمایید.</div></div>';
		
		$('#rangineModal .modal-body').html(modalbody);
		$('#rangineModal .modal-title').html('ابزار تنظیم متن الگو');
		$('#rangineModal').modal();
		$('#offlinepattern .pcodechecker').on('click',function(){
			
			pcode = $('#offlinepattern .patterncodeinput').val();
			ptext = $('#offlinepattern .patterntext').val();
			var res = ptext.match(/%\w*%/g);
			var output = '';
			res.forEach(function(value, index, array){
				output += '<div><label>'+value.replace(/%/g,'')+'</label><input type="text"/></div>';
			});
			$('#offlinepattern .pcodecheckresult').html(output);
			$('#offlinepattern .variableshelp,#offlinepattern .patterninsert').removeClass('hidden');
			$('#offlinepattern .pcodechecker').addClass('hidden');
			var patternoutput = 'patterncode:'+pcode;
			$('#offlinepattern .patterninsert').click(function(){
				$('#offlinepattern .pcodecheckresult div').each(function(){
					patternoutput += "\n"+$(this).find('label').text()+':'+$(this).find('input').val();
				})
				targettextarea.html(patternoutput);
				$('#rangineModal').modal("hide");
			});
		});
		$('.onlinepcodechecker').on('click',function(){
			
			pcode = $('#onlinepattern .patterncodeinput').val();
			var query = $.ajax({
				type: 'POST',
				url: ranginesmspresta_ajax_url,
				data: 'method=patterncodechecker&pcode=' + pcode,
				dataType: 'json',
				beforeSend: function(){
					$('#onlinepattern .pattern-message').html('<i class="process-icon-loading"></i>');
				},
				success: function(json) {
				  if(json.result.status == 0){
					$('#onlinepattern .pattern-message').html(json.result.message.replace("\n","<br>"));
					var pvars = json.result.vars;
					var output = '<p>لطفاً پارامترهای پترن را با متغیرهای سایت تکمیل نمایید.</p>';
					pvars.forEach(function(value, index, array){
						output += '<div><label>'+value+'</label><input type="text"/></div>';
					});
					$('#onlinepattern .pcodecheckresult').html(output);
					$('#onlinepattern .variableshelp,#onlinepattern .patterninsert').removeClass('hidden');
					$('.onlinepcodechecker').addClass('hidden');
					var patternoutput = 'patterncode:'+pcode;
					$('#onlinepattern .patterninsert').click(function(){
						$('#onlinepattern .pcodecheckresult div').each(function(){
							patternoutput += "\n"+$(this).find('label').text()+':'+$(this).find('input').val();
						})
						targettextarea.html(patternoutput);
						$('#rangineModal').modal("hide");
					});
				  }else if(json.result.status == 997 || json.result.status == 404){
					  $('#onlinepattern .pattern-message').html('این الگو در دسترس شما نیست.');
				  }
				}
			});
		});
	});
	/********* CRON SWITCH CODE TOGGLE ***********/
	if($('#CRONJOB_on').length && $('#CRONJOB_on').attr('checked') !== 'checked') {
		$('#croncode').hide();
		$('#fieldset_0.panel .form-group').slice(-2).hide();
	}
	$('#CRONJOB_on').parent().on('change.bootstrapSwitch', function(e) {
		if(e.target.name == 'CRONJOB'){
		  if(e.target.value == 1){
			$('#croncode').show(200);
			$('#fieldset_0.panel .form-group').slice(-2).show(200);
		  }else{
		   $('#croncode').hide(200);
			$('#fieldset_0.panel .form-group').slice(-2).hide(200);
		  }
		}
	});
	$('#remoteCommentSend').click(function(){
			var el = $(this);
			var comment	 = $('#commenttext').val();
			$('.comment-result').html('');
			console.log(comment);
			if(comment == ''){
				alert('لطفاً متن پیشنهاد خود را تایپ نمایید.');
				$('#commenttext').focus();
				return false;
			}
			$.ajax({
			  type: 'POST',
			  url: ranginesmspresta_ajax_url,
			  data: 'method=sendComment&subject=remotesms&comment=' + comment,
			  dataType: 'json',
			  success: function(json) {
        console.log(json);
				$('.comment-result').html(json.result);
				if(json.status == 'ok') $('#commenttext').val('')
			  }
			});
	});
	$('#fieldset_welcome .icon-flag').click(function(){
		$('#desc-module-hook, #desc-module-update, #desc-module-translate').show();
	});

	$('#fieldset_preparedsms .edit').click(function(){
		var smsID = $(this).parents('tr').data('id');
		var smsText = $(this).parents('tr').find('.text').text();
		$('#rangineModal .modal-body').html('<textarea class="smstext">'+smsText+'</textarea><br><button class="save btn btn-primary" data-smsid="'+smsID+'" onClick="savePreparedSMSText()">ذخیره متن جدید</button>');
		$('#rangineModal .modal-title').html('ویرایش پیامک پیش فرض');
		$('#rangineModal').modal();
	});
	$("#fieldset_preparedsms .delete").confirm({
		text: "آیا از حذف این پیامک پیش فرض اطمینان دارید؟?",
		title: "تأیید حذف",
		confirm: function(button) {
			var smsID = button.data("textid");
			var query = $.ajax({
				type: 'POST',
				url: ranginesmspresta_ajax_url,
				data: 'method=deletePreparedSms&smsID=' + smsID,
				dataType: 'json',
				success: function(json) {
          console.log(json);
					button.parents('tr').hide();
				}
			});
		},
		cancel: function(button) {
			// nothing to do
		},
		confirmButton: "مطمئن هستم، حذف کن!",
		cancelButton: "نه، حذف نکن.",
		post: false,
		confirmButtonClass: "btn-danger",
		cancelButtonClass: "btn-default",
		dialogClass: "modal-dialog modal-lg bootstrap" // Bootstrap classes for large modal
	});

	$("#form-sentsms #clearAllQueue").confirm({
		text: "آیا مطمئن هستید صف ارسال پیامک با کرون را می خواهید پاک کنید?",
		title: "تأیید پاک کردن صف ارسال",
		confirm: function(button) {
			var query = $.ajax({
				type: 'POST',
				url: ranginesmspresta_ajax_url,
				data: 'method=clearAllQueue',
				dataType: 'json',
				success: function(json) {
					console.log(json);
				  if(json.result == true){
					  alert('لیست پیامک های در صف ارسال خالی شد.صفحه جهت بازخوانی لیست پیامک ها رفرش می شود.');
					  location.reload(); 
				  }else{
					  alert('خطایی در پاک کردن لیست صف ارسال رخ داد. در صورت تکرار این خطا با پشتیبان افزونه تماس بگیرید.');
				  }
				}
			});
		},
		cancel: function(button) {
			// nothing to do
		},
		confirmButton: "مطمئن هستم، پاک کن.",
		cancelButton: "نه، پاک نکن!",
		post: false,
		confirmButtonClass: "btn-danger",
		cancelButtonClass: "btn-default",
		dialogClass: "modal-dialog modal-lg bootstrap" // Bootstrap classes for large modal
	});
	$("#fieldset_sms_rules .delete").confirm({
		text: "آیا از حذف این قانون پیامکی پیش فرض اطمینان دارید؟",
		title: "تأیید حذف",
		confirm: function(button) {
			var ruleID = button.data("ruleid");
			var query = $.ajax({
				type: 'POST',
				url: ranginesmspresta_ajax_url,
				data: 'method=deleteSmsRule&ruleID=' + ruleID,
				dataType: 'json',
				success: function(json) {
          console.log(json);
					button.parents('tr').hide();
				}
			});
		},
		cancel: function(button) {
			// nothing to do
		},
		confirmButton: "مطمئن هستم، حذف کن!",
		cancelButton: "نه، حذف نکن.",
		post: false,
		confirmButtonClass: "btn-danger",
		cancelButtonClass: "btn-default",
		dialogClass: "modal-dialog modal-lg bootstrap" // Bootstrap classes for large modal
	});
	$("#fieldset_sms_rules .edit").click(function(){
		var editrule = $(this).data('rule');
		console.log(editrule);
		$('#RuleBase').val(editrule.ruleBase).change();
		$('#ruleCondition').val(editrule.ruleCondition).change();
		if(editrule.ruleConditionValue.includes("@")){
			var ruleConditionValueArray = editrule.ruleConditionValue.split("@");
			$('#ruleConditionValue').val(ruleConditionValueArray[0]).change();
			$('#ruleConditionValue2').val(ruleConditionValueArray[1]).change();
		}else{
			$('#ruleConditionValue').val(editrule.ruleConditionValue).change();

		}
		$('#ruleAction').val(editrule.ruleAction).change();
		$('#rulePosition').val(editrule.rulePosition).change();
		$('#ruleTo').val(editrule.ruleTo).change();
		$('#ruleToOther').val(editrule.ruleToOther).change();
		$('#ruletext').val(editrule.ruletext).change();
		if(editrule.ENABLE == '1'){
			$('#ENABLE_on').prop("checked", true);
		} else {
			$('#ENABLE_off').prop("checked", true);
		}

		//console.log($(this).data('ruleid'));
		$('#editruleid').val($(this).data('ruleid'));
		$('#fieldset_smsrules').addClass('edit');
		// var smsText = $(this).parents('tr').find('.text').text();
		// $('#rangineModal .modal-body').html('<textarea class="smstext">'+smsText+'</textarea><br><button class="save btn btn-primary" data-smsid="'+smsID+'" onClick="savePreparedSMSText()">ذخیره متن جدید</button>');
		// $('#rangineModal .modal-title').html('ویرایش پیامک پیش فرض');
		// $('#rangineModal').modal();
	});
	$('.mobile-inputs .edit').click(function(){
		var inputKey = $(this).data('inputid');
		var inputSelector = $(this).parents('tr').find('.inputselector').text();
		$('#rangineModal .modal-body').html('<div class="form-group"><label class="control-label col-lg-3">انتخابگر فیلد موبایل:</label><div class="col-lg-9"><input dir=ltr name="MobileInputSelector" id="MobileInputSelector" value="'+inputSelector+'" class="fixed-width-lg" type="text"><p class="help-block">انتخابگر جی کوئری فیلد مورد نظر خود را وارد نمایید.</p></div><br><button id="savemobileinput" class="save btn btn-primary" data-inputkey="'+inputKey+'" onClick="saveMobileInput()">ذخیره انتخابگر</button>');
		$('#rangineModal .modal-title').html('ویرایش انتخابگر فیلد موبایل');
		$('#rangineModal').modal();
	});
	$(".mobile-inputs .delete").confirm({
		text: "آیا از حذف این انتخابگر فیلد موبایل اطمینان دارید؟?",
		title: "تأیید حذف",
		confirm: function(button) {
			var inputKey = button.data('mobileinputkey');
			var query = $.ajax({
				type: 'POST',
				url: ranginesmspresta_ajax_url,
				data: 'method=deleteMobileInput&mobileInputKey=' + inputKey,
				dataType: 'json',
				success: function(json) {
          console.log(json);
					button.parents('tr').hide();
				}
			});
		},
		cancel: function(button) {
			// nothing to do
		},
		confirmButton: "مطمئن هستم، حذف کن!",
		cancelButton: "نه، حذف نکن.",
		post: false,
		confirmButtonClass: "btn-danger",
		cancelButtonClass: "btn-default",
		dialogClass: "modal-dialog modal-lg bootstrap" // Bootstrap classes for large modal
	});
	$('#selectallsms').click(function(){
	  if($(this).is(':checked')){
		$('.selectsms').attr('checked','checked');
	  }else{
		$('.selectsms').removeAttr('checked');
	  }
	});
	
	$('.variableDesc label').click(function(){
		$(this).parent().toggleClass('expand');
	});
});
function savePreparedSMSText(){
	var smsID = $('#rangineModal button.save').data('smsid');
	var newtext = $('#rangineModal textarea.smstext').val();
	var query = $.ajax({
	  type: 'POST',
	  url: ranginesmspresta_ajax_url,
	  data: 'method=savePreparedSmsText&smsID=' + smsID + '&text=' + newtext,
	  dataType: 'json',
	  beforeSend: function(){
		 // $('').html('<i class="process-icon-loading"></i>');
	  },
	  success: function(json) {
      console.log(json);
		  if(json.result == 1){
			  $('#rangineModal').modal("hide")
			  location.reload(); 
		  } 
	  }
	});
}

function saveMobileInput(){
	var inputkey = $('#rangineModal button.save').data('inputkey');
	var newselector = $('#rangineModal #MobileInputSelector').val();
	var query = $.ajax({
	  type: 'POST',
	  url: ranginesmspresta_ajax_url,
	  data: 'method=saveMobileInput&mobileInputKey=' + inputkey + '&selector=' + newselector,
	  dataType: 'json',
	  beforeSend: function(){
		 // $('').html('<i class="process-icon-loading"></i>');
	  },
	  success: function(json) {
      console.log(json);
		  if(json.result == 1){
			  $('#rangineModal').modal("hide")
			  location.reload(); 
		  } 
	  }
	});
}

function __SmsMessageHandler(_textbox_tohn, _statusbar_tohn)
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
function copyToClipboard(text) {
    if (window.clipboardData && window.clipboardData.setData) {
        // IE specific code path to prevent textarea being shown while dialog is visible.
        return clipboardData.setData("Text", text); 

    } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
        var textarea = document.createElement("textarea");
        textarea.textContent = text;
        textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in MS Edge.
        document.body.appendChild(textarea);
        textarea.select();
        try {
            return document.execCommand("copy");  // Security exception may be thrown by some browsers.
        } catch (ex) {
            console.warn("Copy to clipboard failed.", ex);
            return false;
        } finally {
            document.body.removeChild(textarea);
        }
    }
}
/*!
 * jquery.confirm
 *
 * @version 2.7.0
 *
 * @author My C-Labs
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 * @author Russel Vela
 * @author Marcus Schwarz <msspamfang@gmx.de>
 *
 * @license MIT
 * @url https://myclabs.github.io/jquery.confirm/
 */
!function(o){o.fn.confirm=function(t){return void 0===t&&(t={}),this.click(function(n){n.preventDefault();var i=o.extend({button:o(this)},t);o.confirm(i,n)}),this},o.confirm=function(t,n){if(void 0!==t){if(!(o(".confirmation-modal").length>0)){var i={};if(t.button){o.each({title:"title",text:"text",extradata:"extradata","confirm-button":"confirmButton","submit-form":"submitForm","cancel-button":"cancelButton","confirm-button-class":"confirmButtonClass","cancel-button-class":"cancelButtonClass","dialog-class":"dialogClass","modal-options-backdrop":"modalOptionsBackdrop","modal-options-keyboard":"modalOptionsKeyboard"},function(o,n){var a=t.button.data(o);void 0!==a&&(i[n]=a)})}var a=o.extend({},o.confirm.options,{confirm:function(){if(i.submitForm||void 0===i.submitForm&&t.submitForm||void 0===i.submitForm&&void 0===t.submitForm&&o.confirm.options.submitForm)n.target.closest("form").submit();else{var a=n&&("string"==typeof n&&n||n.currentTarget&&n.currentTarget.attributes.href.value);if(a)if(t.post){var s=o('<form method="post" class="hide" action="'+a+'"></form>');o("body").append(s),s.submit()}else window.location=a}},cancel:function(o){},button:null},t,i),s="";""!==a.title&&(s='<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title">'+a.title+"</h4></div>");var c="";a.cancelButton&&(c='<button class="cancel btn '+a.cancelButtonClass+'" type="button" data-dismiss="modal">'+a.cancelButton+"</button>");var d='<div class="confirmation-modal modal fade" tabindex="-1" role="dialog"><div class="'+a.dialogClass+'"><div class="modal-content">'+s+'<div class="modal-body">'+a.text+'</div><div class="modal-footer"><button class="confirm btn '+a.confirmButtonClass+'" type="button" data-dismiss="modal">'+a.confirmButton+"</button>"+c+"</div></div></div></div>",l=o(d);void 0===a.modalOptionsBackdrop&&void 0===a.modalOptionsKeyboard||l.modal({backdrop:a.modalOptionsBackdrop,keyboard:a.modalOptionsKeyboard}),l.on("shown.bs.modal",function(){l.find(".btn-primary:first").focus()}),l.on("hidden.bs.modal",function(){l.remove()}),l.find(".confirm").click(function(){a.confirm(a.button)}),l.find(".cancel").click(function(){a.cancel(a.button)}),o("body").append(l),l.modal("show")}}else console.error("No options given.")},o.confirm.options={text:"Are you sure?",title:"",confirmButton:"Yes",cancelButton:"Cancel",post:!1,submitForm:!1,confirmButtonClass:"btn-primary",cancelButtonClass:"btn-default",dialogClass:"modal-dialog",modalOptionsBackdrop:!0,modalOptionsKeyboard:!0}}(jQuery);
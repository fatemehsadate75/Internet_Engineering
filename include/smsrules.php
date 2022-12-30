<?php
 $help='<div class="panel panel-default">
   <div class="panel-heading" style="white-space: unset;">
      <i class="icon-question" style="margin: 10px 5px;"></i><b data-toggle="collapse" data-target="#collapsed-target-help" style="cursor: pointer;" class="">سیستم قوانین پیامکی چیست؟</b>
   </div>
	<div class="panel-body collapse" id="collapsed-target-help" style="height: auto;">
<p style="line-height: 2; text-align: justify;">گاهی اوقات لازم می بینید بر اساس یک شرایطی که در خرید مشتری اتفاق می افتد متن پیامک ارسالی را تغییر دهید یا اصلا پیامکی ارسال نکنید. در این وضعیت ها سیستم قوانین پیامکی راه گشای شما خواهد بود.<br>در یک قانون پیامکی باید اساس و پایه قانون ، شرط و عکس العمل را در فرم زیر مشخص کرده و ذخیره کنید. شما بی نهایت قانون می توانید در سیستم قوانین پیامکی ایجاد کنید. چند مثال زیر شاید فایدده استفاده از این سیستم را نشان بدهد:</p><ul><li>اگر مشتری هنگام سفارش گزینه پرداخت با واریز به کارت را انتخاب کرد در متن پیامک شماره کارت یا حساب هم ارسال شود.</li><li>اگر مشتری راهی غیر از پرداخت آنلاین را انتخاب کرد پیامکی به مدیر فروش برای پیگیری پرداخت مشتری ارسال شود.</li><li>اگر مشتری یک حامل مشخصی مثل تیپاکس انتخاب کرد در متن پیامک وی اضافه شود که تا دو روز دیگر محصول خریداری شده به دست شما خواهد رسید.</li><li>اگر مشتری محصول خاصی را که شما ارسال کننده آن نیستید انتخاب کرد یک پیامک جداگانه ای به ارسال کننده آن محصول ارسال کند.</li><li>اگر جمع فاکتور خرید یک مشتری از مبلغ خاصی کمتر بود پیامک به وی ارسال نشود.</li><li>اگر مبلغ فاکتور مشتری از یک مبلغ بیشتر بود و سیستمی برای ارائه کد تخفیف در سایت دارید کد تخفیف را در انتهای پیامک اضافه کند.</li><li>و ...</li></ul><p style="line-height: 2; text-align: justify;">لازم به ذکر است که برای استفاده از سیستم قوانین پیامکی در یک پیامک حتماً باید در متن پیامک آن رویداد خاص در صفحه متن پیامک ها یک متغیر به صورت {sms_rule} اضافه کنید تا در هنگام ارسال پیامک سیستم قوانین پیامکی روی متن پیامک تأثیر بگذارد. حتی اگر می خواهید پیامک در شرایطی ارسال نشود یا به شخص دیگری پیامک ارسال شود، باز هم باید این متغیر را در متن پیامک قرار دهید. در واقع افزونه پیامک به محض برخورد با متغیر {sms_rule} در متن پیامک ها سیستم قوانین پیامکی را فعال می کند. اگر هیچ قانونی مطابق با شرایط پیامک نبود این متغیر به مشتری نمایش داده نخواهد شد.</p><p style="line-height: 2; text-align: justify;"><br>این بخش به صورت فعال در حال ارتقا هست و در نسخه های بعدی گزینه های بیشتری در اختیار شما قرار می گیرد. خواهشمندم نظرات و پیشتنهادات خود برای ارتقاء کیفی این سیستم را  به صورت تیکت یا آی دی @rangine_ir در پیام رسان ها ارسال نمایید.
	</p>


	</div>
</div>'; if($this->licenseCheck()['status'] == 'true') { if (!class_exists('jDateTime')) { include_once('jDateTime.php'); } $licenseexpiretime = jDateTime::date('Y/m/d H:i', $this->license['expiretime'], null, true,null); $carrierClass = new CarrierCore; $carriers = ''; foreach($carrierClass->getCarriers($this->context->language->id) as $carrier){ $carriers .= $carrier['id_reference']. ' : "'.$carrier['name'].'",'."\n"; }; $payments = ''; $payment_modules_list = Module::getPaymentModules(); foreach($payment_modules_list as $payment_module) { $module_obj = Module::getInstanceById($payment_module['id_module']); if(isset($module_obj->displayName)) $moduleName = $module_obj->displayName; else $moduleName = $payment_module['name']; $payments .= $payment_module['name']. ' : "'.$moduleName.'",'."\n"; } $orderstatuses = ''; $orderstatus_list = OrderState::getOrderStates($this->context->language->id); foreach($orderstatus_list as $orderstatus) { $orderstatuses .= '"'.$orderstatus['name']. '" : "'.$orderstatus['name'].'",'."\n"; } $supplierlist = ''; $supplier_list = Supplier::getSuppliers(); foreach($supplier_list as $supplier) { $supplierlist .= '"'.$supplier['id_supplier']. '" : "'.$supplier['name'].'",'."\n"; } $smsrulesPage = '<script>
		var rules = {
			carrier:{
				condition : {
					is : "هست",
					isnot : "نیست",
				},
				values : {
					'.$carriers.'
				},
				type: "select",
				action: {
					addAfter : "افزودن متن به پیامک",
					replace : "جایگزینی پیامک",
					notsend : "عدم ارسال پیامک",
					newsms : "ارسال پیامک جدید",
				},
				positions: {
					//newacount : "'.$this->l('New Account').'",
					neworder : "'.$this->l('New Order').'",
					updateorder : "'.$this->l('Update Order').'",
					updateOrderTracking : "'.$this->l('Update Order Tracking').'",
					//newaddress : "'.$this->l('New Address').'",
					//backtostock : "'.$this->l('Back to Stock').'",
					//outofstock : "'.$this->l('Out of Stock').'",
				}
			},
			payment:{
				condition : {
					is : "هست",
					isnot : "نیست",
				},
				values : {
					'.$payments.'
				},
				type: "select",
				action: {
					addAfter : "افزودن متن به پیامک",
					replace : "جایگزینی پیامک",
					notsend : "عدم ارسال پیامک",
					newsms : "ارسال پیامک جدید",
				},
				positions: {
					//newacount : "'.$this->l('New Account').'",
					neworder : "'.$this->l('New Order').'",
					updateorder : "'.$this->l('Update Order').'",
					updateOrderTracking : "'.$this->l('Update Order Tracking').'",
					//newaddress : "'.$this->l('New Address').'",
					//backtostock : "'.$this->l('Back to Stock').'",
					//outofstock : "'.$this->l('Out of Stock').'",
				}
			},
			orderstatus:{
				condition : {
					is : "هست",
					isnot : "نیست",
				},
				values : {
					'.$orderstatuses.'
				},
				type: "select",
				action: {
					addAfter : "افزودن متن به پیامک",
					replace : "جایگزینی پیامک",
					notsend : "عدم ارسال پیامک",
					newsms : "ارسال پیامک جدید",
				},
				positions: {
					//newacount : "'.$this->l('New Account').'",
					neworder : "'.$this->l('New Order').'",
					updateorder : "'.$this->l('Update Order').'",
					updateOrderTracking : "'.$this->l('Update Order Tracking').'",
					//newaddress : "'.$this->l('New Address').'",
					//backtostock : "'.$this->l('Back to Stock').'",
					//outofstock : "'.$this->l('Out of Stock').'",
				}
			},
			price:{
				condition : {
					is : "مساوی",
					less : "کوچکتر از",
					more : "بزرگتر از",
				},
				type : "text",
				action: {
					addAfter : "افزودن متن به پیامک",
					replace : "جایگزینی پیامک",
					notsend : "عدم ارسال پیامک",
					newsms : "ارسال پیامک جدید",
				},
				positions: {
					//newacount : "'.$this->l('New Account').'",
					neworder : "'.$this->l('New Order').'",
					updateorder : "'.$this->l('Update Order').'",
					updateOrderTracking : "'.$this->l('Update Order Tracking').'",
					//newaddress : "'.$this->l('New Address').'",
					//backtostock : "'.$this->l('Back to Stock').'",
					//outofstock : "'.$this->l('Out of Stock').'",
				}
			},
			productID:{
				condition : {
					is : "مساوی",
				},
				type : "double",
				action: {
					addAfter : "افزودن متن به آخر پیامک",
					replace : "جایگزینی پیامک",
					notsend : "عدم ارسال پیامک",
					newsms : "ارسال پیامک جدید",
				},
				positions: {
					//newacount : "'.$this->l('New Account').'",
					neworder : "'.$this->l('New Order').'",
					updateorder : "'.$this->l('Update Order').'",
					updateOrderTracking : "'.$this->l('Update Order Tracking').'",
					//newaddress : "'.$this->l('New Address').'",
					//backtostock : "'.$this->l('Back to Stock').'",
					//outofstock : "'.$this->l('Out of Stock').'",
				}
			},
			supplier:{
				condition : {
					is : "هست",
					//isnot : "نیست",
				},
				values : {
					'.$supplierlist.'
				},
				type: "select",
				action: {
					//addAfter : "افزودن متن به پیامک",
					//replace : "جایگزینی پیامک",
					//notsend : "عدم ارسال پیامک",
					newsms : "ارسال پیامک جدید",
				},
				positions: {
					//newacount : "'.$this->l('New Account').'",
					neworder : "'.$this->l('New Order').'",
					//updateorder : "'.$this->l('Update Order').'",
					//updateOrderTracking : "'.$this->l('Update Order Tracking').'",
					//newaddress : "'.$this->l('New Address').'",
					//backtostock : "'.$this->l('Back to Stock').'",
					//outofstock : "'.$this->l('Out of Stock').'",
				}
			},
		};
	</script>'; $smsrulesPage .= '<form id="smsrulesform" method="post">
				<input type="hidden" name="ranginesmspresta" value="1">
				<input type="hidden" name="editruleid" id="editruleid" value="">
				<div class="panel" id="fieldset_smsrules">		
						<div class="panel-heading"><i class="icon-edit"></i>'.$this->l('SMS Rules').' - <span class="license-expiretime">لایسنس این بخش تا این تاریخ معتبر است: '.$licenseexpiretime.'</span></div>'; $smsrulesPage .= $help; $smsrulesPage .= '<div class="form-wrapper">
		<div class="form-group clearfix">
			<label class="control-label col-lg-3">'.$this->l('Rule Base:').'</label>
			<div class="col-lg-9">
				<select name="ruleBase" class="RuleBase fixed-width-xl" id="RuleBase">
					<option value="0">انتخاب کنید</option>
				</select>
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label col-lg-3">'.$this->l('Condition:').'</label>
			<div class="col-lg-9">
				<select name="ruleCondition" class="ruleCondition fixed-width-xl" id="ruleCondition">
					<option value="0">انتخاب کنید</option>
				</select>
				<div id="ruleConditionValueWrapper">
				<select name="ruleConditionValue" class="ruleConditionValue fixed-width-xl" id="ruleConditionValue">
					<option value="0">انتخاب کنید</option>
				</select>
				</div>
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label col-lg-3">'.$this->l('Action:').'</label>
			<div class="col-lg-9">
				<select name="ruleAction" class="ruleAction fixed-width-xl" id="ruleAction">
					<option value="0">انتخاب کنید</option>
				</select>
			</div>
		</div>
		<div class="form-group clearfix ruleTowrapper">
			<label class="control-label col-lg-3">'.$this->l('To:').'</label>
			<div class="col-lg-9">
				<select name="ruleTo" class="ruleTo fixed-width-xl" id="ruleTo">
					<option value="0">انتخاب کنید</option>
					<option value="admin">'.$this->l('Admin').'</option>
					<option value="customer">'.$this->l('Customer').'</option>
					<option value="other">'.$this->l('Other').'</option>
				</select>
			</div>
		</div>
		<div class="form-group clearfix ruleToOtherwrapper" style="display:none;">
			<label class="control-label col-lg-3">'.$this->l('Other Number').':</label>
			<div class="col-lg-9">
				<input type="text" name="ruleToOther" class="ruleToOther fixed-width-xl" id="ruleToOther" />
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label col-lg-3">'.$this->l('Position:').'</label>
			<div class="col-lg-9">
				<select name="rulePosition" class="rulePosition fixed-width-xl" id="rulePosition">
					<option value="0">انتخاب کنید</option>
				</select>
			</div>
		</div>
		<div class="form-group clearfix ruletextwrapper">
			<label class="control-label col-lg-3">متن پیام:</label>
			<div class="col-lg-9">
				<textarea name="ruletext" id="ruletext" class="textarea-autosize  textlength-enabled" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 65px;"></textarea><p class="help-block"></p>
			</div>				
		</div>
		<div class="form-group clearfix">
			<label class="control-label col-lg-3">فعال</label>
			<div class="col-lg-9">
				<span class="switch prestashop-switch fixed-width-lg">
					<input type="radio" name="ENABLE" id="ENABLE_on" value="1" checked="checked">
					<label for="ENABLE_on">بله</label>
					<input type="radio" name="ENABLE" id="ENABLE_off" value="0">
					<label for="ENABLE_off">خیر</label>
					<a class="slide-button btn"></a>
				</span>
				<p class="help-block"></p>
			</div>
		</div>
	</div></form><!-- /.form-wrapper -->'; $smsrulesPage .= '<div class="panel-footer">
		<button type="submit" value="1" id="module_form_submit_btn" name="smsrules" class="btn btn-default pull-right"><i class="process-icon-save"></i> افزودن شرط</button>
		</div><!-- /.panel-footer -->
	</div><!-- /.panel -->
	<script>
	function l(value){
		var translates = {
			"carrier" : "حامل",
			"payment" : "شیوه پرداخت",
			"price" : "جمع قیمت خرید",
			"productID" : "آی دی محصول خریداری شده",
			"orderstatus" : "وضعیت سفارش",
			"supplier" : "فراهم کننده",
		}
		return translates[value];
	}
	$("#ruleTo").on("change",function(){
		if($(this).val() == "other"){
			$(".ruleToOtherwrapper").show(200);
		}else{
			$(".ruleToOtherwrapper").hide(200);
		}
	});
	$("#ruleAction").on("change",function(){
		if($(this).val() == "notsend"){
			$(".ruleToOtherwrapper,.ruletextwrapper").hide(200);
			$(".ruleTowrapper .control-label").text("پیامک ارسال نشود به:");
		}else{
			$(".ruletextwrapper").show(200);
			if($("#ruleTo").val() == "other") $(".ruleToOtherwrapper").show(200);
			$(".ruleTowrapper .control-label").text("مخاطب پیامک:");

		}
	});
	if($("#RuleBase").length){
		var rulesbases = "";
		for (var key in rules) {
			rulesbases += "<option value=\""+key+"\">"+l(key)+"</option>";
		}
		
		$("#RuleBase").html("<option value=\"0\">انتخاب کنید</option>"+rulesbases);
	}
	$("#RuleBase").on("change",function(){
		var condition = "";
		for (var key in rules[$(this).val()].condition) {
			if (rules[$(this).val()].condition.hasOwnProperty(key)) {
				condition += "<option value=\""+key+"\">"+rules[$(this).val()].condition[key]+"</option>";
			}
		}
		$("#ruleCondition").html("<option value=\"0\">انتخاب کنید</option>"+condition);
		if(rules[$(this).val()].type == "select"){
			var conditionValues = "";
			for (var key in rules[$(this).val()].values) {
				if (rules[$(this).val()].values.hasOwnProperty(key)) {
					conditionValues += "<option value=\""+key+"\">"+rules[$(this).val()].values[key]+"</option>";
				}
			}
			$("#ruleConditionValueWrapper").html("<select name=\"ruleConditionValue\" class=\"ruleConditionValue fixed-width-xl\" id=\"ruleConditionValue\"><option value=\"0\">انتخاب کنید</option>"+conditionValues+"</select>");
		}else if(rules[$(this).val()].type == "text"){
			$("#ruleConditionValueWrapper").html("<input type=\"text\" name=\"ruleConditionValue\" class=\"ruleConditionValue fixed-width-xl\" id=\"ruleConditionValue\"/>");
		}else if(rules[$(this).val()].type == "double"){
			$("#ruleConditionValueWrapper").html("<input type=\"text\" name=\"ruleConditionValue\" class=\"ruleConditionValue fixed-width-xl\" id=\"ruleConditionValue\" placeholder=\"آی دی محصول\"/><div class=\"description\">آی دی محصول در صفحه محصولات، زیر ستون شناسه درج شده است</div><!--<input type=\"text\" name=\"ruleConditionValue2\" class=\"ruleConditionValue2 fixed-width-xl\" id=\"ruleConditionValue2\" placeholder=\"آی دی ترکیب\" /><div class=\"description\">در صورتی که محصول شما دارای ترکیب است آی دی آن ترکیب را در این کادر وارد کنید. آی دی ترکیب در آدرس لینک ویرایش ترکیب با آرگومان id_product_attribute قابل شناسایی است.</div>-->");
		}

		
		var conditionActions = "";
		for (var key in rules[$(this).val()].action) {
			if (rules[$(this).val()].action.hasOwnProperty(key)) {
				conditionActions += "<option value=\""+key+"\">"+rules[$(this).val()].action[key]+"</option>";
			}
		}
		$("#ruleAction").html("<option value=\"0\">انتخاب کنید</option>"+conditionActions);	
		
		var positions = "";
		for (var key in rules[$(this).val()].positions) {
			if (rules[$(this).val()].positions.hasOwnProperty(key)) {
				positions += "<option value=\""+key+"\">"+rules[$(this).val()].positions[key]+"</option>";
			}
		}
		$("#rulePosition").html("<option value=\"0\">انتخاب کنید</option>"+positions);

		if($(this).val() == "supplier"){
			$("select#ruleTo option[value=\'admin\']").after(\'<option class="supplier" value="supplier">\'+l(\'supplier\')+\'</option>\')
		}else{
			$("option.supplier").remove();
		}

		
		});
	</script>'; $output .=$smsrulesPage; $AllSmsRules = $this->getAllSMSRules(); $output .= '<div class="panel" id="fieldset_sms_rules">
		<div class="panel-heading">
		<i class="icon-list"></i>
		'.$this->l('SMS Rules').'
		</div>'; if($AllSmsRules) { $output .='<table class="data-table">
					<thead>
						<tr>
							<th class="id">'.$this->l('id').'</th>
							<th class="ruleBase">'.$this->l('Rule Base').'</th>
							<th class="ruleCondition">'.$this->l('Condition').'</th>
							<th class="ruleConditionValue">'.$this->l('Condition Value').'</th>
							<th class="ruleAction">'.$this->l('Action').'</th>
							<th class="ruletext">'.$this->l('Text').'</th>
							<th class="ruleTo">'.$this->l('Reciver').'</th>
							<th class="rulePosition">'.$this->l('Position').'</th>
							<th class="ENABLE">'.$this->l('Enable').'</th>
							<th class="actions">'.$this->l('Actions').'</th>
						</tr>
					</thead>
					<tbody>'; foreach ($AllSmsRules as $key => $smsRule) { $smsRule['ruleConditionValueName'] = $smsRule['ruleConditionValue']; $smsRule['ruleToName'] = $smsRule['ruleTo']; if($smsRule['ruleBase'] == 'carrier'){ $carrierClass = new CarrierCore; $carriers = array(); foreach($carrierClass->getCarriers($this->context->language->id) as $carrier){ $carriers[$carrier['id_reference']] = $carrier['name']; } $smsRule['ruleConditionValueName'] = $carriers[$smsRule['ruleConditionValue']]; } if($smsRule['ruleBase'] == 'supplier'){ $supplier_list = Supplier::getSuppliers(); $suppliers = array(); foreach($supplier_list as $supplier) { $suppliers[$supplier['id_supplier']] = $supplier['name']; } $smsRule['ruleConditionValueName'] = $suppliers[$smsRule['ruleConditionValue']]; } if($smsRule['ruleTo'] == 'other'){ $smsRule['ruleToName'] = $smsRule['ruleToOther']; } if($smsRule['ruleBase'] == 'productID'){ $product = new Product($smsRule['ruleConditionValue'], false, (int)$this->context->language->id, (int)$this->context->shop->id, $this->context); if (!empty($product)) { $shortProductKey = Configuration::get($this->prefix . 'SHORTPRODUCTKEY', null , null , $this->shop_id); $smsRule['ruleConditionValueName'] .= '-<a href="'._PS_BASE_URL_ .'/'. $shortProductKey.'/'.$smsRule['ruleConditionValue'].'" target="_blank">'.$product->name.'</a>'; } } $output .= '<tr data-id="'.$key.'">
						<td class="id">'.$key.'</td>
						<td class="ruleBase">'.$this->l($smsRule['ruleBase']).'</td>
						<td class="ruleCondition">'.$this->l($smsRule['ruleCondition']).'</td>
						<td class="ruleConditionValue">'.$smsRule['ruleConditionValueName'].'</td>
						<td class="ruleAction">'.$this->l($smsRule['ruleAction']).'</td>
						<td class="ruletext">'.$smsRule['ruletext'].'</td>
						<td class="ruleTo">'.$this->l($smsRule['ruleToName']).'</td>
						<td class="rulePosition">'.$this->l($smsRule['rulePosition']).'</td>
						<td class="ENABLE">'.$smsRule['ENABLE'].'</td>
						<td class="actions">
							<a class="delete" data-action="deleteSmsRule" title="'.$this->l('Remove').'" data-ruleid="'.$key.'"><i class="icon-remove"></i></a>	
							<a class="edit" data-action="editSmsRule" title="'.$this->l('Edit').'" data-ruleid="'.$key.'" data-rule=\''.json_encode($smsRule).'\'><i class="icon-edit"></i></a>
						</td>
					</tr>'; } $output .= '</tbody>
					<!--<tfoot>
						<tr>
							<th colspan="9">Next</th>
						</tr>
					</tfoot>-->
				</table>'; } else { $output .= '<p>'.$this->l('There is not any sms rule.').'</p>'; } $output .= '</div>
		<div class="modal fade" id="rangineModal">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close modal-clear" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title"></h4>
			  </div>
			  <div class="modal-body">
				<center><span class="loader"></span></center>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default modal-clear" data-dismiss="modal">'.$this->l('Close').'</button>
				
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->'; $output .= '<script type="text/javascript" src="//'.$this->domain.'/modules/ranginesmspresta/views/js/jquery-sortable.js"></script>'; }else{ $output .= $this->licenseForm(); }
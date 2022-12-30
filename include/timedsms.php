<?php
 $help='<p style="line-height: 2; text-align: justify;"><strong>سیستم پیامک چیست؟</strong><br>در این صفحه شما تنظیماتی را انجام می دهید که پیامک نه در همان لحظه رویداد بلکه در آینده و در زمان خاصی به مشتری شما ارسال می شود. چند مثال زیر شاید فایده استفاده از این سیستم را نشان بدهد:</p><ul><li>روز تولد مشتری یک پیامک به وی ارسال شود و علاوه بر تبریک یک کد تخفیف خرید به وی داده شود.</li><li>چند روز قبل از یک زمان خاص مانند روز تولد مشتری به وی یک پیامک ارسال شود.</li><li>چند روز بعد از ثبت سفارش مشتری به وی پیامکی ارسال شود که از وی خواسته شود در نظرسنجی سایت شرکت کند.</li><li>چند روز بعد از اینکه سبد خرید مشتری خالی ماند.</li></ul><p style="line-height: 2; text-align: justify;"><br>این بخش به صورت فعال در حال ارتقا هست و در نسخه های بعدی گزینه های بیشتری در اختیار شما قرار می گیرد. خواهشمندم نظرات و پیشتنهادات خود برای ارتقاء کیفی این سیستم را  به صورت تیکت یا آی دی @rangine_ir در پیام رسان ها ارسال نمایید.
	</p>'; if($this->licenseCheck()['status'] == 'true') { if (!class_exists('jDateTime')) { include_once('jDateTime.php'); } $licenseexpiretime = jDateTime::date('Y/m/d H:i', $this->license['expiretime'], null, true,null); $timedSmsPage = ''; $timedSmsPage .= '<form class="" method="post">
				<input type="hidden" name="ranginesmspresta" value="1">
				<div class="panel" id="fieldset_timedsms">		
						<div class="panel-heading"><i class="icon-clock"></i>'.$this->l('Timed SMS').' - <span class="license-expiretime">لایسنس این بخش تا این تاریخ معتبر است: '.$licenseexpiretime.'</span></div>'; $timedSmsPage .= '<div class="alert alert-info">'.$help.'</div>'; $timedSmsPage .= '<div class="form-wrapper">
		<div class="form-group clearfix">
			<label class="control-label col-lg-3">'.$this->l('Time Base:').'</label>
			<div class="col-lg-9">
				<select name="timedbase" class="RuleBase fixed-width-xl" id="timedbase">
					<option value="0">انتخاب کنید</option>
					<option value="customers">مشتریان</option>
				</select>
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label col-lg-3">'.$this->l('Date Field:').'</label>
			<div class="col-lg-9">
				<select name="datefield" class="datefield fixed-width-xl" id="datefield">
					<option value="0">انتخاب کنید</option>
					<option value="birthday">تاریخ تولد</option>
				</select>
			</div>
		</div>
		<div class="form-group clearfix">
			<label class="control-label col-lg-3">'.$this->l('Relate Date:').'</label>
			<div class="col-lg-9">
				<input type="text" name="relatedate" class="relatedate fixed-width-xl" id="relatedate" value="0"/>
			</div>
		</div>
		<div class="form-group clearfix sendtimetextwrapper">
			<label class="control-label col-lg-3">ساعت ارسال:</label>
			<div class="col-lg-9">
				<select name="sendtime" class="sendtime fixed-width-xl" id="sendtime">
					<option value="0">انتخاب کنید</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
				</select>
				<p class="help-block"></p>
			</div>				
		</div>
		<div class="form-group clearfix timedsmstextwrapper">
			<label class="control-label col-lg-3">متن پیام:</label>
			<div class="col-lg-9">
				<textarea name="timedsmstext" id="timedsmstext" class="textarea-autosize  textlength-enabled" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 65px;"></textarea><p class="help-block"></p>
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
	</div></form><!-- /.form-wrapper -->'; $timedSmsPage .= '<div class="panel-footer">
		<button type="submit" value="1" id="module_form_submit_btn" name="timedsms" class="btn btn-default pull-right"><i class="process-icon-save"></i> افزودن پیامک زمان دار</button>
		</div><!-- /.panel-footer -->
	</div><!-- /.panel -->
	<script>


	</script>'; $output .=$timedSmsPage; $output .= '</div>
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
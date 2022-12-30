<?php
 if (!class_exists('jDateTime')) { include_once('jDateTime.php'); } $welcomePage = ''; $welcomePage .= '<div class="panel" id="fieldset_welcome">
	<div class="panel-heading">
		<i class="icon-flag"></i>
		'.$this->l('Welcome').' - (نسخه شما: '.$this->version.')
	</div>
	<div class="content">
	<p>'.$this->l('Welcome to Rangine SMS module for Prestashop. You can have the best exprience of using SMS module to develope your business.').'</p>'; $gatewayDescription = $gatewayDescription.$gatewayWarning.$gatewaySuccess.$gatewayError; $welcomePage .= '<div class="alert alert-info">'; $welcomePage .= '<b>'.$this->l('Gateway alert').' :</b> '.$gatewayDescription; if(Configuration::get($this->prefix . 'ADMINPHONE') == '') { $welcomePage .= '<p>'.$this->l('* You should add a mobile number for admin at Gateway Settings page to recieve admin alerts.').'</p>'; } $welcomePage .= '</div>'; $welcomePage .= '<div class="alert alert-addons">'; $welcomePage .= '<div class="row"><b>وضعیت لایسنس :</b> '; if(isset($this->license['expiretime']) && $this->license['expiretime'] !== '') { $welcomePage .= 'معتبر تا تاریخ : '.jDateTime::date('Y/m/d H:i', $this->license['expiretime'], null, true,null); if(is_numeric($this->license['expiretime']) && $this->license['expiretime'] - $time < 864000){ $welcomePage .= ' - <a href="http://rangine.ir/pay?for=prestashop_smsmodule&panel='.$this->domain.'" target="_BLANK">برای تمدید لایسنس کلیک کنید.</a>'; } $welcomePage .=' <button class="refereshLicense btn btn-info" data-action="refereshLicense" title="زمانی که مشکلی در مشاهده صفحات لایسنس دار داشتید روی این دکمه کلیک کنید.">بازبینی لایسنس</button> <button class="deleteLicense btn btn-danger" data-action="deleteLicense" 	title="هنگامی که لایسنس جدید داشتید می توانید با زدن این دکمه لایسنس خود را پاک کنید تا افزونه دوباره لایسنس را از شما طلب کند.">حذف لایسنس</button>'; } else { $welcomePage .= 'لایسنس ثبت نشده است. <a href="http://rangine.ir/pay?for=prestashop_smsmodule&panel='.$this->domain.'" target="_BLANK">برای تهیه لایسنس کلیک کنید.</a>  اگر لایسنس دارید، کد لایسنس را ثبت نمایید.
	  
		 <form class="form-horizontal field form-inline" method="post" style="display: inline-block;">
			<input name="license" value="test" type="text" placeholder="کد لایسنس...">
			<button type="submit" name="setLisense" class="btn btn-primary sn-btn"><b>ثبت</b></button>
		</form>'; } $welcomePage .= '</div></div>'; $welcomePage .= '
<div class="panel panel-default">
   <div class="panel-heading" style="white-space: unset;">
      <i class="icon-film" style="margin: 10px 5px;"></i><b data-toggle="collapse" data-target="#collapsed-target-teaching" style="cursor: pointer;">پشتیبان گیری و بازگردانی تنظیمات افزونه</b>
   </div>
	<div class="panel-body collapse in" id="collapsed-target-teaching">
		<p>در صورتی که به هر علت نیاز به نصب مجدد افزونه در این سایت یا سایت دیگر خود داشته باشید می توانید تنظیمات خود در این افزونه را با کلیک بر روی دکمه پشتیبان گیری زیر به صورت یک متن دریافت نمایید و برای بازگردانی تنظیمات از دکمه بازگردانی تنظیمات استفاده نمایید.</p>
		<div style="text-align: center;">
			<button class="backupRangineSmsData btn btn-success" data-action="backupRangineSmsData" title="تهیه نسخه پشتیبان">پشتیبان گیری - Backup</button>
			<button class="restoreRangineSmsData btn btn-info" data-action="restoreRangineSmsData" title="بازگردانی تنظیمات">بازگردانی تنظیمات - Restore</button>
		</div>


	</div>
</div>
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
	</div><!-- /.modal -->'; $welcomePage .= $this->panelNews(); $welcomePage .= '</div></div>'; 
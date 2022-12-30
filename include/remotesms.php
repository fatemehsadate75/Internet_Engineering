<?php
 if($this->licenseCheck()['status'] == 'true') { if (!class_exists('jDateTime')) { include_once('jDateTime.php'); } $licenseexpiretime = jDateTime::date('Y/m/d H:i', $this->license['expiretime'], null, true,null); $fields_form_remotesms = array( 'form' => array( 'legend' => array( 'title' => $this->l('Remote SMS Settings').' - <span class="license-expiretime">لایسنس این بخش تا این تاریخ معتبر است: '.$licenseexpiretime.'</span>', 'icon' => 'icon-cogs' ), 'input' => array( array( 'type' => 'switch', 'label' => $this->l('Enable Remote SMS:'), 'name' => 'REMOTEENABLE', 'class' => 'fixed-width-md', 'desc' => $this->l('Enable if you want to manage your site remotely by SMS.'), 'values' => array( array( 'id' => 'active_on', 'value' => 1, 'label' => $this->l('Yes') ), array( 'id' => 'active_off', 'value' => 0, 'label' => $this->l('No') ) ), ), array( 'type' => 'text', 'label' => $this->l('Remote Secret Key:'), 'name' => 'REMOTEKEY', 'class' => 'fixed-width-lg', 'desc' => $this->l('Type a word to create token.'), ), array( 'type' => 'html', 'label' => $this->l('Access Url For SMS Panel:'), 'name' => '<div class="alert alert-info"><p>برای استفاده از مدیریت از راه دور سایت باید آدرس زیر را در بخش انتقال دهنده پنل پیامک خود قرار دهید و خط اختصاصی هم داشته باشید. قبل از خرید خط اختصاصی حتما با مدیر سامانه رنگینه تماس بگیرید. بعد از تغییر کلید امنیتی بالا صفحه را ذخیره و سپس این آدرس را استفاده نمایید.</p><code>'._PS_BASE_URL_._MODULE_DIR_.'ranginesmspresta/getsms.php?message=@MSG&from=@FROM&token='.Tools::encrypt(Configuration::get('RANGINE_SMS_REMOTEKEY' , null , null , (int)$this->shop_id)).'</code><p>برای امنیت بیشتر سایت شما این امکان را فراهم کرده ایم که خود شما متن دلخواه خود را برای فعالیت های مدیریتی از راه دور تعیین کنید. به ازای هر یک از فعالیت ها کلمه انگلیسی یا فارسی یا عددی دلخواه خود را وارد کنید. در صورتی که سایت هر یک از این کلمات تعیین شده شما را با پیامک شما دریافت کند فعالیت متناظر آن کلمه را انجام خواهد داد.</p></div>', 'class' => 'fixed-width-lg', ), array( 'type' => 'text', 'label' => $this->l('Enable Shop Key:'), 'name' => 'RS_ENABLESHOP', 'class' => 'fixed-width-lg', 'desc' => $this->l('Type a word; When your site get this word from your remote sms, makes site enabled.'), ), array( 'type' => 'text', 'label' => $this->l('Disable Shop Key:'), 'name' => 'RS_DISABLESHOP', 'class' => 'fixed-width-lg', 'desc' => $this->l('Type a word; When your site get this word from your remote sms, makes site disabled.'), ), ), 'submit' => array( 'title' => $this->l('Update Settings'), 'name' => 'remotesmssettings', ) ), ); $remoteCommentForm ='<div class="panel panel-default">
   <div class="panel-heading" style="white-space: unset">
      <i style="margin:10px 5px;" class="icon-check-circle"></i><b data-toggle="collapse" data-target="#collapsed-target" style="cursor: pointer;">پیشنهاد شما</b>
   </div>
   <div class="panel-body collapse in" id="collapsed-target">
		<div class="alert alert-addons">
			<p>از آنجا که این بخش از افزونه کاری ابداعی و اولین نمونه در کنترل سایت از طریق پیامک می باشد، تنها فعال یا غیر فعال شدن سایت در لیست کارهای این نسخه قرار گرفته است.<br>با توجه به بازخورد و نظرات شما استفاده کنندگان این افزونه، این بخش به زودی توسعه یافته و شامل موارد دیگری همچون کم یا زیاد کردن تعداد موجودی یک کالا خواهد شد. لطفاً نظرات خود را درباره کارهایی که اینجا می تواند اضافه شود و برای مدیریت سایت کارآمد هست در فرم پایین درج و ارسال نمایید.</p>
		</div>
      <div class="row">
         <form class="form-horizontal field col-sm-12" onSubmit="return false;">
            <div class="row">
               <div class="form-group">
                  <label class="col-sm-2 text-left">پیشنهاد شما :</label>
                  <div class="col-sm-10">
                     <textarea class="form-control" id="commenttext" placeholder="پیشنهاد خود را بنویسید..."></textarea>
                  </div>
				</div>
				<div class="form-group">
				 <div class="comment-result col-sm-11"></div>
				   <div class="col-sm-1  text-left">
				  
					  <button id="remoteCommentSend" class="btn btn-primary sn-btn"><b>ارسال پیشنهاد</b></button>
				   </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
'; $output .= $helper->generateForm(array($fields_form_remotesms)); $output .= $remoteCommentForm; }else{ $output .= $this->licenseForm(); }
<?php
 $help='<p style="line-height: 2; text-align: justify;"><strong>سیستم تأیید پیامکی شماره همراه چیست؟</strong><br>بعضی وقت ها مشتری شما بدون توجه به قوانین سایت، با شماره همراه جعلی یا با اشتباه در ورود شماره همراه خود ثبت نام می کند. این امر باعث می شود پیامکهای اطلاع رسانی و تبلیغاتی شما به شماره موبایلی که انتظار دریافت پیامک از شما ندارد ارسال شود و باعث اعتراض یا نارضایتی از شما شود. از طرفی اگر شماره همراه اشتباه وارد شده باشد، مشتری از عدم رسیدن پیامک به خود شاکی می شود. <br> یکی از راه حل هایی که برای این موضوع در سایت های حرفه ای استفاده می شود، تأیید پیامکی موبایل هنگام ثبت نام است. بدین صورت که هنگام ثبت نام و ورود شماره همراه یک کد به آن شماره ارسال می شود؛ و با ورود آن کد در سایت مشخص می شود که اولاً مشتری شما یک فرد حقیقی هست و ربات نیست و ثانیاً دسترسی به آن شماره همراه دارد.<br>در این نسخه از افزونه پیامک رنگینه، امکان تأیید پیامکی شماره همراه، به صورت آزمایشی، اضافه شده است. ایده های زیادی برای این بخش داریم اما در حال حاضر کارکرد آن بدین صورت است که با فعال شدن این ویژگی، فیلد شماره همراه در صفحه ثبت نام مشتری اضافه می گردد. مشتری با درج شماره همراه و زدن دکمه ثبت شماره کدی دریافت می کند و در کادری که پس از ثبت شماره ظاهر شده وارد می نماید. در صورت درست بودن کد تأیید، پیام موفقیت آمیز بودن ثبت شماره نمایش داده می شود و به کاربر پیامک خوش آمد گویی ارسال می گردد. در صورتی که شما در فرم زیر اجباری بودن تأیید شماره همراه را فعال کرده باشید دکمه ثبت نام تا هنگام تأیید شماره همراه از کار می افتد.<br>این بخش پله ای برای توسعه های بعدی این افزونه است و در حال حاضر به صورت آزمایشی و رایگان به افزونه اضافه شده است که بعد از تکمیل تنها با لایسنس خریداری شده در دسترس خواهد بود.<br>لطفاً اشکالات احتمالی و بازخورد و نظرات خود را به صورت تیکت یا آی دی @rangine_ir در پیام رسان ها ارسال نمایید.
	</p>'; $fields_form_verifyMobile = array( 'form' => array( 'legend' => array( 'title' => $this->l('Verify Mobile Settings'), 'icon' => 'icon-cogs' ), 'description' => $help, 'input' => array( array( 'type' => 'switch', 'label' => $this->l('Enable Verify Mobile:'), 'name' => 'VEFRIFYMOBILEENABLE', 'class' => 'fixed-width-md', 'desc' => $this->l('Enable if you want to verify registration custom mobile field.'), 'values' => array( array( 'id' => 'active_on', 'value' => 1, 'label' => $this->l('Yes') ), array( 'id' => 'active_off', 'value' => 0, 'label' => $this->l('No') ) ), ), array( 'type' => 'switch', 'label' => $this->l('Make Mobile Verification Mandatory:'), 'name' => 'VEFRIFYMOBILEMANDATORY', 'class' => 'fixed-width-md', 'desc' => $this->l('Enable if you want to reject registration without mobile verification.'), 'values' => array( array( 'id' => 'active_on', 'value' => 1, 'label' => $this->l('Yes') ), array( 'id' => 'active_off', 'value' => 0, 'label' => $this->l('No') ) ), ), array( 'type' => 'text', 'label' => $this->l('OTP Code Length:'), 'name' => 'OTPLENGTH', 'class' => 'fixed-width-lg', 'desc' => $this->l('How many character do you like to apply to OTP Code.'), 'prefix' => $this->l('Character'), ), array( 'type' => 'text', 'label' => $this->l('Delay for resend OTP:'), 'name' => 'RESENDOTPDELAY', 'class' => 'fixed-width-lg', 'desc' => $this->l('Time in second that user wait for resend OTP.'), 'prefix' => $this->l('Seconds'), ), array( 'type' => 'switch', 'label' => $this->l('Use verified mobile number for sending sms:'), 'name' => 'USEVERIFIEDMOBILE', 'class' => 'fixed-width-md', 'desc' => $this->l('Enable if you want to use verified mobile unmber as customer number to recieve sms. This option will alter related option in Alerts Setting page.'), 'values' => array( array( 'id' => 'active_on', 'value' => 1, 'label' => $this->l('Yes') ), array( 'id' => 'active_off', 'value' => 0, 'label' => $this->l('No') ) ), ), array( 'type' => 'radio', 'label' => $this->l('Text for Verification Text:'), 'name' => 'VERIFICATONTEXTTYPE', 'values' => array( array( 'id' => 'default', 'value' => 'default', 'label' => $this->l('default') ), array( 'id' => 'sample', 'value' => 'sample', 'label' => $this->l('By Sample') ), array( 'id' => 'custom', 'value' => 'custom', 'label' => $this->l('Custom Text or Pattern') ), ) ), array( 'type' => 'textarea', 'label' => $this->l('Custom Text or Variables of Pattern:').'<center><a class="p-wizard btn btn-primary" data-sample="کد تأیید شما : %code%">'.$this->l('Pattern Vizard').'</a></center>', 'name' => 'VERIFICATONTEXT', 'class' => 'fixed-width-lg', 'desc' => $this->l('Variables:').'{shop_name} {code}', ), ), 'submit' => array( 'title' => $this->l('Update Settings'), 'name' => 'verifymobilesettings', ) ), ); $output .= $helper->generateForm(array($fields_form_verifyMobile)); $fields_form_addverifyMobilefield = array( 'form' => array( 'legend' => array( 'title' => $this->l('Add Verify Mobile Field'), 'icon' => 'icon-plus' ), 'description' => '<p style="line-height: 2; text-align: justify;">جهت افزودن فیلد موبایل فرم های سایت خود برای تایید شماره موبایل کد انتخابگر جی کوئری فیلد موبایل را در فرم زیر وارد نمایید.</p>', 'input' => array( array( 'type' => 'html', 'label' => $this->l('Mobile Inputs:'), 'name' => '<div>'.$this->getVerifyMobileInput().'</div>', 'class' => '', ), array( 'type' => 'text', 'label' => $this->l('Mobile Input Name:'), 'name' => 'MobileInputName', 'class' => 'fixed-width-lg', 'desc' => $this->l('Type a name for this row.'), ), array( 'type' => 'text', 'label' => $this->l('Mobile Input Selector:'), 'name' => 'MobileInputSelector', 'class' => 'fixed-width-lg', 'desc' => $this->l('Insert jQuery selector for mobile input.'), ), ), 'submit' => array( 'title' => $this->l('Save'), 'name' => 'AddMobileInput', ) ), ); $output .= $helper->generateForm(array($fields_form_addverifyMobilefield)); $output .= '</div>
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
		</div><!-- /.modal -->'; 
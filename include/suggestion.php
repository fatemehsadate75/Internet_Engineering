<?php
 $output .='<div class="panel panel-default ranginesuggestionpage">
   <div class="panel-heading" style="white-space: unset">
   <i style="margin:10px 5px;" class="icon-check-circle"></i><b data-toggle="collapse" data-target="#collapsed-target" style="cursor: pointer;">
   '.$this->l('Our Suggestions').'
   </b>
   </div>
   <div class="panel-body">
   <p>در این صفحه پیشنهاداتی از افزونه ها و ابزارهای کاربردی برای سایت های پرستاشاپی ارائه می شود که می توانید با بررسی آنها و نیاز و صلاحدید خود نسبت به تهیه و استفاده آنها در سایت خود اقدام نمایید:</p>
   '; $url = $this->support.'/smsapi/prestashop/'.$this->name.'/index2.php?suggestion'; $param = array( 'domain'=> $this->domain, 'Mversion' => $this->version, 'PSversion' => $this->PSversion, 'shop' => $this->shop, ); $handler = curl_init($url); curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST"); curl_setopt($handler, CURLOPT_POSTFIELDS, $param); curl_setopt($handler, CURLOPT_RETURNTRANSFER, true); curl_setopt($handler, CURLOPT_CONNECTTIMEOUT, 10); curl_setopt($handler, CURLOPT_TIMEOUT, 30); $response = curl_exec($handler); if($response){ $result = json_decode($response,true); foreach($result as $sugg){ $output .='<div class="suggestbox">'; if(isset($sugg['i']) && $sugg['i']) $output .='<div class="suggest-image"><img src="'.$sugg['i'].'"/></div>'; if($sugg['n']) $output .='<div class="suggest-name">'.$sugg['n'].'</div>'; if($sugg['d']) $output .='<div class="suggest-desc">'.$sugg['d'].'</div>'; if($sugg['m']) $output .='<div class="suggest-more"><a href="'.$sugg['m'].'" target="_blank"><b>توضیحات بیشتر ...</b></a></div>'; $output .='<div class="clear"></div></div>'; } }else{ $output .='ارتباط با سرور پشتیبانی برقرار نشد. لطفاً بعداً مراجعه نمایید.'; } $output .='</div></div>'; $output .='<style>

</style>'; 
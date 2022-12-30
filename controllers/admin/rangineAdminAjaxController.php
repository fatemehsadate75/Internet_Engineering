<?php
 class rangineAdminAjaxController extends AdminController { public function init() { parent::init(); } public function postProcess() { if(!class_exists('RangineSmsPresta')) die('The module class not found!'); $ranginesmspresta = new RangineSmsPresta; if (isset($_FILES) && !empty($_FILES)) { try{ $file = unserialize(base64_decode(file_get_contents($_FILES['settingsfile']['tmp_name']))); include_once(__DIR__.'/../../include/configs.php'); foreach($this->configs as $key => $value){ if(isset($file[$key])){ Configuration::updateValue($ranginesmspresta->prefix . $key, $file[$key]); } } $result = true; die( Tools::jsonEncode( array('result'=>'true','body'=> 'بازگردانی انجام شد.'))); }catch(Exception $e){ die( Tools::jsonEncode( array('result'=>'false','body'=>$e))); } } if(Tools::getValue('method')){ switch (Tools::getValue('method')) { case 'oneverypagesendsms' : $SMSmassage = Tools::getValue('massage'); $phonenumber = Tools::getValue('phonenumber'); if($SMSmassage == '') die(Tools::jsonEncode(array('result'=>'0'))); $result = $ranginesmspresta->sendOne($SMSmassage, $phonenumber, '-', '-', $this->l('Send SMS Manual')); die( Tools::jsonEncode( array('result'=>$result))); break; case 'getDelivery' : $bulk = Tools::getValue('bulk'); $lastStatus = $ranginesmspresta->panelGetDelivery($bulk); $descibedStatus = $ranginesmspresta->deliveryStatusTranslate($lastStatus); if(in_array($lastStatus, array('failed', 'discarded', 'delivered'))) $ranginesmspresta->updateLogs($bulk,$lastStatus); die( Tools::jsonEncode( array('result'=>$descibedStatus))); break; case 'savepreparedsmssort' : $sort = Tools::getValue('sort'); $sortArray = explode('-',$sort); array_pop($sortArray); foreach($sortArray as $sort){ $newsort = explode(':',$sort); $ranginesmspresta->updatePreparedSMSTextSort($newsort[0],$newsort[1]); } die( Tools::jsonEncode( array('result'=>'1'))); break; case 'savePreparedSmsText' : $smsID = Tools::getValue('smsID'); $newText = Tools::getValue('text'); $ranginesmspresta->updatePreparedSMSTextMessage($smsID,$newText); die( Tools::jsonEncode( array('result'=>'1'))); break; case 'deletePreparedSms' : $smsID = Tools::getValue('smsID'); $ranginesmspresta->deletePreparedSMSTextMessage($smsID); die( Tools::jsonEncode( array('result'=>'1'))); break; case 'deleteSmsRule' : $ruleID = Tools::getValue('ruleID'); $ranginesmspresta->deleteSmsRule($ruleID); die( Tools::jsonEncode( array('result'=>'1'))); break; case 'clearAllQueue' : $ranginesmspresta->clearAllQueue(); die( Tools::jsonEncode( array('result'=>'1'))); break; case 'saveMobileInput' : $mobileInputKey = Tools::getValue('mobileInputKey'); $newSelector = Tools::getValue('selector'); $ranginesmspresta->addVerifyMobileInput($mobileInputKey,$newSelector); die( Tools::jsonEncode( array('result'=>'1'))); break; case 'deleteMobileInput' : $mobileInputKey = Tools::getValue('mobileInputKey'); $ranginesmspresta->deleteMobileInput($mobileInputKey); die( Tools::jsonEncode( array('result'=>'1'))); break; case 'phonelist' : include_once(__DIR__.'/../../include/jDateTime.php'); $idShop = Tools::getValue('idShop'); $product = Tools::getValue('product'); $productAttribute = Tools::getValue('productAttribute'); $ooss = $this->getOOS(null, null, null, null, $product, $productAttribute, $idShop, null); $output = ''; $output .="<table class='table table-bordered table-striped table-responsive'>"; $output .="<thead><tr><th>شماره همراه</th><th>زمان ثبت</th></tr></thead><tbody>"; foreach ($ooss as $item){ $output .="<tr><td>{$item['phone_number']}</td><td>".jDateTime::date('Y/m/d H:i', $item['timestamp'], null, true,null)."</td></tr>"; } $output .= "</tbody></table>"; die( Tools::jsonEncode( array('result'=>$output,'title'=>$ranginesmspresta->l('Subscribed Phone List').' : '.count($ooss).' '.$ranginesmspresta->l('Number')))); break; case 'clearSubscribers' : $idShop = Tools::getValue('idShop'); $product = Tools::getValue('product'); $productAttribute = Tools::getValue('productAttribute'); $phoneNumber = Tools::getValue('phoneNumber'); $result = $ranginesmspresta->clearOOS($phoneNumber, $product, $productAttribute, $idShop); die( Tools::jsonEncode( array('result'=>$result))); break; case 'sendComment' : $url = $ranginesmspresta->support.'smsapi/prestashop/'.$ranginesmspresta->name.'/?sendComments'; $param = array( 'Mversion' => $ranginesmspresta->version, 'PSversion' => $ranginesmspresta->PSversion, 'shop' => $ranginesmspresta->shop, 'domain' => $ranginesmspresta->domain, 'comment' => Tools::getValue('comment'), 'subject' => Tools::getValue('subject'), ); $handler = curl_init($url); curl_setopt($handler, CURLOPT_CONNECTTIMEOUT, 10); curl_setopt($handler, CURLOPT_TIMEOUT, 30); curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST"); curl_setopt($handler, CURLOPT_POSTFIELDS, $param); curl_setopt($handler, CURLOPT_RETURNTRANSFER, true); $respond = curl_exec($handler); if($respond == 'ok'){ $result = '<div class="alert alert-success">پیشنهاد شما با موفقیت ثبت شد.</div>'; $status = 'ok'; }else{ $result = '<div class="alert alert-warning">متأسفانه مشکلی در ثبت پیشنهاد شما اتفاق افتاد. لطفاً با پشتیبان افزونه تماس بگیرید.</div>'; $status = 'failed'; } die( Tools::jsonEncode( array('result'=>$result,'status'=>$status))); break; case 'oossendsms' : $idShop = Tools::getValue('idShop'); $product = Tools::getValue('product'); $productAttribute = Tools::getValue('productAttribute'); $SMSmassage = Tools::getValue('massage'); $clearOOS = Tools::getValue('clearOOS'); if($SMSmassage == '') die(Tools::jsonEncode(array('result'=>'0'))); $ooss = $this->getOOS(null, null, null, null, $product, $productAttribute, $idShop, null); $phoneNumbersArray = array(); foreach ($ooss as $item){ $phoneNumbersArray[] = $item['phone_number']; } if(!count('')) die(Tools::jsonEncode(array('result'=>'1'))); $phoneNumbers = implode(';',$phoneNumbersArray); $result = $ranginesmspresta->sendSMS(array('message'=> $SMSmassage, 'reciver' => $phoneNumbers) , $this->l('Manual SMS to OOS')); if($clearOOS == 'yes' && $result == TRUE){ $result = $ranginesmspresta->clearOOS('', $product, $productAttribute, $idShop); die( Tools::jsonEncode( array('result'=>'2'))); }elseif($result == TRUE){ die( Tools::jsonEncode( array('result'=>'3'))); } die( Tools::jsonEncode( array('result'=>'4'))); break; case 'ordersendsms' : $idShop = Tools::getValue('idShop'); $SMSmassage = Tools::getValue('massage'); $customer_id = Tools::getValue('customer'); $order_id = Tools::getValue('order'); $phonenumber = Tools::getValue('phonenumber'); if($SMSmassage == '') die(Tools::jsonEncode(array('result'=>'0'))); $result = $ranginesmspresta->sendOne($SMSmassage, $phonenumber, $customer_id, $order_id, $this->l('Manual SMS')); die( Tools::jsonEncode( array('result'=>$result))); break; case 'customersendsms' : $idShop = Tools::getValue('idShop'); $SMSmassage = Tools::getValue('massage'); $customer_id = Tools::getValue('customer_id'); $phonenumber = Tools::getValue('phonenumber'); if($SMSmassage == '') die(Tools::jsonEncode(array('result'=>'0'))); $result = $ranginesmspresta->sendOne($SMSmassage, $phonenumber, $customer_id, '-', $this->l('Manual SMS')); die( Tools::jsonEncode( array('result'=>$result))); break; case 'patterncodechecker' : $pcode = Tools::getValue('pcode'); $user = Configuration::get($ranginesmspresta->prefix . 'USERNAME' , null , null , $ranginesmspresta->shop_id); $pass = Configuration::get($ranginesmspresta->prefix . 'PASSWORD' , null , null , $ranginesmspresta->shop_id); $checkresult = $this->patternchecker($user,$pass,$pcode,$ranginesmspresta); die( Tools::jsonEncode( array('result'=>$checkresult))); break; case 'sendagain' : $logid = Tools::getValue('logid'); $customer = Tools::getValue('customer'); $idshop = Tools::getValue('idshop'); $phone = Tools::getValue('phone'); $SMSmassage = Tools::getValue('smstext'); if($SMSmassage == '' || empty($phone) || !is_numeric(str_replace('+','',$phone)) ) die(Tools::jsonEncode(array('result'=>'0'))); $log = $ranginesmspresta->getLogs(0, 1, null, null, null,null,null,null, null, $logid); if(isset($log[0]['description'])){ $result = $ranginesmspresta->sendSMS(array('message'=> $log[0]['description'], 'reciver' => $phone) , 'ارسال مجدد'); die( Tools::jsonEncode( array('result'=>$result ))); }else{ die(Tools::jsonEncode(array('result'=>'0'))); } break; case 'deleteLicense' : $newLicense = base64_encode(serialize(array('code'=> '','updatetime'=>'','expiretime'=>'','lastCheckTime'=>''))); if (!Configuration::updateValue($ranginesmspresta->prefix . 'LICENSE', $newLicense)) { $result = false; } else { $result = true; } die( Tools::jsonEncode( array('result'=>$result ))); break; case 'refereshLicense' : $ranginesmspresta->licenseCheck(true); $result = true; die( Tools::jsonEncode( array('result'=>$result ))); break; case 'backupRangineSmsData' : try{ include_once(__DIR__.'/../../include/configs.php'); foreach($this->configs as $key => $value){ $rows[$key] = Configuration::get($ranginesmspresta->prefix.$key , null , null , $this->shop_id); } $result = true; $output = base64_encode(serialize($rows)); die( Tools::jsonEncode( array('result'=>'true','body'=> $output))); }catch(Exception $e){ die( Tools::jsonEncode( array('result'=>'false','body'=>$e))); } break; case 'restoreRangineSmsSettings' : try{ die( Tools::jsonEncode( array('result'=>'true','body'=> '123'))); }catch(Exception $e){ die( Tools::jsonEncode( array('result'=>'false','body'=>$e))); } break; case 'testsms' : $customer = new stdclass(); $customer->id_gender = 1; $customer->firstname = 'هادی'; $customer->lastname = 'ملائی'; $customer->phone = Tools::getValue('customernumber'); $customer->phone_mobile = Tools::getValue('customernumber'); $customer->id = 0; $customer->id_customer = 0; $customer->email = 'test@rangine.ir'; $customer->password = '123456'; $order = new stdclass(); $order->id = 234; $order->reference = 'TESTORDER'; $order->payment = 'درگاه تستی'; $order->module = 'درگاه تستی'; $order->total_paid = "35000"; $order->orderstate = 'آماده ارسال'; $order->shipping_number = '1645238452165426'; $order->products = "دوربین دیجیتال کانون * 1 \n فلش 2 گیگ هاردستون * 2"; $currency = new stdclass(); $currency->name = 'تومان'; $carrierClass = new CarrierCore; $carriers = $carrierClass->getCarriers($this->context->language->id); $carrier = new stdclass; $carrier->id_carrier = $carriers[0]; $condition = Tools::getValue('condition'); switch($condition){ case 'newcustomer' : $params = array('newCustomer' => $customer); $result = $ranginesmspresta->hookActionCustomerAccountAdd($params, true); break; case 'neworder' : $params = array('customer' => $customer,'order' => $order,'currency' => $currency,'cart' => $carrier,); $result = $ranginesmspresta->hookActionValidateOrder($params, true); break; case 'orderstatus' : $params = array('customer' => $customer,'order' => $order,'carrier' => $carrier,'cart' => $carrier,); $result = $ranginesmspresta->hookActionOrderStatusPostUpdate($params, true); break; case 'ordertracker' : $params = array('customer' => $customer,'order' => $order,'cart' => $carrier,); $result = $ranginesmspresta->hookactionAdminOrdersTrackingNumberUpdate($params, true); break; case 'newaddress' : $params = array('object' => $customer); $result = $ranginesmspresta->hookActionObjectAddressAddAfter($params, true); break; case 'outofstock' : $params = array('testtype' => 'outofstock', 'id_product' => 24, 'product_name' => 'دوربین دیجیتال کانون مشکی با لنز حرفه ای', 'product_name_only' => 'دوربین دیجیتال کانون'); $result = $ranginesmspresta->hookactionUpdateQuantity($params, true); break; case 'backtostock' : $params = array('testtype' => 'backtostock', 'id_product' => 24, 'product_name' => 'دوربین دیجیتال کانون مشکی با لنز حرفه ای', 'product_name_only' => 'دوربین دیجیتال کانون' , 'phone' => Tools::getValue('customernumber')); $result = $ranginesmspresta->hookactionUpdateQuantity($params, true); break; } die( Tools::jsonEncode( array('result'=>$result))); break; default: exit; } }else{ echo 'Hi. There was nothing to do!'; die(); } } private function getOOS($page = 0, $onpage = 50, $customer_id = null, $phoneNumber = null, $id_product = null, $id_product_attribute = null, $shop_id = null, $id_lang = null) { $offset = $page * $onpage; $sql = new DbQuery(); $sql->select('*'); $sql->from('ranginesmspresta_oos', 't'); if(!is_null($customer_id))$sql->where("t.id_customer = '{$customer_id}'"); if(!is_null($phoneNumber))$sql->where("t.phone_number = '{$phoneNumber}'"); if(!is_null($id_product))$sql->where("t.id_product = '{$id_product}'"); if(!is_null($id_product_attribute))$sql->where("t.id_product_attribute = '{$id_product_attribute}'"); if(!is_null($shop_id))$sql->where("t.id_shop = '{$shop_id}'"); if(!is_null($id_lang))$sql->where("t.id_lang = '{$id_lang}'"); $sql->orderBy('id_product'); $sql->limit($onpage, $offset); return Db::getInstance()->executeS($sql); } private function patternchecker($user,$pass,$pcode,$ranginesmspresta){ $url = $ranginesmspresta->server . "/api/select"; $param = array ( 'uname'=>$user, 'pass'=>$pass, 'patternCode'=>$pcode, 'op'=>'getPatternParams' ); $handler = curl_init($url); curl_setopt($handler, CURLOPT_CONNECTTIMEOUT, 5); curl_setopt($handler, CURLOPT_TIMEOUT, 20); curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST"); curl_setopt($handler, CURLOPT_POSTFIELDS, json_encode($param)); curl_setopt($handler, CURLOPT_RETURNTRANSFER, true); $result = curl_exec($handler); $response = json_decode($result,true); if (is_array($response) && isset($response['status']['code'])) { $status = $response['status']['code']; switch($status){ case 0: $patternMessage = $response['data']['patternMessage']; $patternParams = $response['data']['patternParams']; $result = array('status'=>$status,'message'=>$patternMessage,'vars'=>$patternParams); break; case 404: $result = array('status'=>$status,'message'=>'پترن در دسترس نیست.'); break; case 962: $result = array('status'=>$status,'message'=>'نام کاربری یا رمز عبور اشتباه است.'); break; default: $result = array('status'=>$status,'message'=>$response['status']['errorMessage']); break; } }else{ $result = array('status'=>-1,'message'=>'اشکالی در دریافت اطلاعات پترن به وجود آمد.'); } return $result; } }
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SendSms_Req
{
   public $SmsBody ;
   public $Mobiles ;
   public $SmsNumber ;
}

class Sms_parsgreen extends App_sms
{
	private $STUXAN_API_URL;
	private $STUXAN_API_KEY;

	public function __construct()
	{
		parent::__construct();
		$this->STUXAN_API_URL  = $this->get_option('parsgreen', 'STUXAN_API_URL');
		$this->STUXAN_API_KEY  = $this->get_option('parsgreen', 'STUXAN_API_KEY');

			$this->add_gateway('parsgreen', [
				'info' => "ماژول پیامک خودکار توسط StuXan",
				'name'    => 'ماژول پیامکی StuXan',
				'options' => [				
					[
						'name'  => 'STUXAN_API_URL',
						'label' => 'آدرس API',
					],
					[
						'name'  => 'STUXAN_API_KEY',
						'label' => 'شناسه احراز هویت API',
					],
				],
			]);	
	}
	public function send($number, $message, $trigger = "")
	{
		try {
			$stuxan_sms_api_url=$this->STUXAN_API_URL;
			$stuxan_sms_api_key=$this->STUXAN_API_KEY;
			require_once(__DIR__ . '/StuXanApi.php');
			$stuxan = new StuXanApi($stuxan_sms_api_url, $stuxan_sms_api_key); 
			$req= new SendSms_Req();
			$req-> SmsBody = $message;
			$req-> Mobiles = array("$number");

			//اختیاری
			//$req-> SmsNumber = "10001391";
			
			$sms=$stuxan->post("Message/SendSms", $req);
			$Errormsg = "سامانه با مشکل مواجه است اما پیام در لیست ارسال قرار گرفته است";

			
				if((get_option(STUXAN_PARSGREEN_MODULE_NAME.'_activated')) == 'true'&& (get_option(STUXAN_PARSGREEN_MODULE_NAME.'_activation_code')!='')){
				if($sms["R_Success"]){
						// وضعیت عملیات
					//echo $res->R_Success;
					// کد خروجی در صورتی که عملیات موفق نباشد
					//echo $res->R_Code;
					// توضیحی در مورد عملیات
					//echo $sms["R_Message"];

					// foreach($res->DataList as $item)
					// {
					// 			// وضعیت ارسال
					// 		echo  $item->SendStatus;
					// 		// شماره موبایل
					// 		echo  $item->Mobile;
					// 		// شناسه ارسال
					// 		echo  $item->ReqID;
					// }
					
					$this->logSuccess($number, $message);
					return true;
				} else {
				// علت عدم ارسال پیام
				//echo $res->R_Message;
				return false;
				}	
					$this->set_error( $sms["R_Message"] . $Errormsg . $sms["R_Success"]);
					return false;
				}
				} catch (\Exception $e) {
					$Errormsg = "سامانه با مشکل مواجه است ";
					$this->set_error( $sms["R_Message"] . $Errormsg . $sms["R_Success"]);
					return false;
				}
		return false;
	}
}
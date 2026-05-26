<?php

/*
*		This is a User Defined Helper :
		Author : Sandeep
		
		This can be used to send SMS by using KEPSERVICE SMS gateway and API
		
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//----------------- THIS IS FOR SENDING OTP SMS : Code given by kepservice ------------
  function openUrl($url,$postvars="") 
   {
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch,CURLOPT_TIMEOUT, '3');  $content = trim(curl_exec($ch));  curl_close($ch); 
        //echo $url;
   }
   
   function sendSMS($mobileNo, $message)
   {
       
                    $CI =& get_instance();
                    $smsUserName  = $CI->config->item('SmsUserName');
                    $smsSenderId  = $CI->config->item('SmsSenderId');
                    $smsPassword  = $CI->config->item('SmsPassword');
                    
                    //---- for demo --->
                    //$smsUrl ="http://123.63.33.43/blank/sms/user/urlsms.php?username={$smsUserName}&pass={$smsPassword}&senderid={$smsSenderId}&dest_mobileno={$userId}&message=" . $message . "&response=Y";
                   
                   
                 /*   
                  
                   
                 $urlArray = array(
                        'username'=> $smsUserName,
                        'pass'=>$smsPassword,
                        'senderid'=>$smsSenderId,    
                        'dest_mobileno' => $mobileNo,
                        'message' => $message,
                        //'priority' => 'ndnd',
                        'response'=>'Y'
                  );
                 */
                    
                 $urlArray = array(
                        'user'=> $smsUserName,
                        'password'=>$smsPassword,
                        'sender'=>$smsSenderId,    
                        'SMSText' => $message,
                        'type' => 'longsms',
                        'GSM' => $mobileNo,
                        //'priority' => 'ndnd',
                        // 'response'=>'Y'
                  );
                    
                    
                // API Given by kepservice.com for demo
		//$smsUrl = sprintf('http://123.63.33.43/blank/sms/user/urlsms.php?') . http_build_query($urlArray);
               
                // API Given by kepservice.com 
                // Try this .... 17-12
                // http://193.105.74.159/api/v3/sendsms/plain?user=ashraya&password=nQ0D8h27&sender=ASHRYA&SMSText=TEST&type=longsms&GSM=91720XXXX 
		$smsUrl = sprintf('http://193.105.74.159/api/v3/sendsms/plain?') . http_build_query($urlArray);
               
                
                
                openUrl($smsUrl);
                return TRUE;
   }

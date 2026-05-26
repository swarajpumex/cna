<?php

/*
*		This is a User Defined Helper :
		Author : Sandeep
		
		This can be used to send Email by using phpmailer plugin
		
		1) Put the mailer plugin files in the System-> libraries folder.
		2) Put the email_settings in the application->config folder.
		
		
		In the autoload.php  add send_email_helper
							 add email_settings in config array.
		
		
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function sendEmail($messageTo, $messageToUserName="", $messageBody, $subject)
{
                  $CI =& get_instance();
                  $CI->load->library('phpmailer/phpmailer');
                  
                  
                $mail = new PHPMailer();

                $mail->IsSMTP();
				
				//$mail->SMTPDebug = true; // for debugigng
				
				$mail->Mailer = 'smtp';
				$mail->IsHTML(true);
                $mail->SMTPAuth =true;
                $mail->SMTPAuth = $CI->config->item('SMTPAuth');
                $mail->Host = $CI->config->item('Host');
                $mail->Port = $CI->config->item('Port');
				
		
                $mail->Username = $CI->config->item('Username'); 
                $mail->Password = $CI->config->item('Password'); 
                
                $headers  ="From: TestingFrom\n";
				$headers .= "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
				
		      //  $mail->HeaderLine($header, $headers);
				
				$mail->SetFrom($CI->config->item('Username'), $subject);

				
				$mail->Subject =$subject;
                $mail->MsgHTML($messageBody);
                $mail->AddAddress($messageTo, $messageToUserName);
                
               
			   	return $mail->Send();


}
	
function getEmailStyle()
	{
		if(isset($_SESSION['site_lang']))
		{
			$this->emailBodyStyle 	='style="margin:0px; font-family:Tahoma, Geneva, sans-serif; background:#F5F5F5; text-align:right';
			$this->titleAlign	 	='style="text-align:right"';
			$this->headerTitleStyle ='style="height:50px; font-size:24px; background:#fff; font-weight:bold; color:#000; vertical-align:central; padding:10px; text-align:right;"';
			$this->headerDateStyle  ='style="float:left; font-size:18px; font-weight:normal;"';
			$this->textAlign		='text-align:right;';
			$this->imageStyle		='alt="redeez.com" style="border:none; float:right;"';
		}	
		
	}
	
	
	
	
function sendActivationEmail($userName, $emailId)
    {
		
		//$this->getEmailStyle();
		
		$db			= new Database();
		$logo 		= base_url()."images/logo.png";
		
		$link = base_url()."site/activateClient/".crypt_data($userName)."/".crypt_data($emailId);
		
		
		$message ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $message .='<head>';
        $message .='<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $message .="<title >TITLE</title>";
        $message .='</head>';
        
        $message .="<body >";
         //wrapper div starts-->
        $message .='<div style="height:auto;">'; // border:1px solid #CCC; 
        
        //header starts -->

        $message .="<div style='padding:10px; background:#FFF; font-size:24px; color:#000; height:100px; '>";
        $message .='<a href="'. base_url(). '">';
        $message .="<img src='{$logo}'   />";
        $message .="</a>MAIL TITLE";
        $message .='</div>';
        //header ends -->  
        
        //white  area starts -->
       
 	    $today = date('Y-m-d h:i:s');
        $message .="<div >";
		$message .="SUBJECT";
        $message .="<div >". $today . "</div>";
        $message .='</div>';
        
		//white  area ends -->
        
         $message .="<div style='padding:30px;font-size:14px; color:#333; line-height:22px; ' >";
    	 $message .='<p style="font-size:12px; font-weight:normal;">';
        
		
		 $message .="<b>," . $userName ."</b><br /><br />";
	  
	  
		 $message .="<br/><br/>";
         $message .="<a href='{$link}'> CLICK TO VERIFY </a>";
         $message .='</p>';
         
		
         $message .='<p>';
         $message .="REGARDS, <br/>";
         $message .="TALAB"; 	
		 $message .='</p>';
         

         
         $message .='</div>';//content div ends -->
         $message .='</div>';// wrapper div ends-->
         $message .='</body>';
         $message .='</html>';
         
		 $subject   ="SUBJECT 2";
         $res 	 	= sendEmail($emailId, $userName, $message, $subject);
         
        
    }
 function sendForgetPasswordMail($fullName="", $emailId="", $link="")
    {
		
		
		$this->getEmailStyle();
		$lang =$_SESSION['site_lang_short'];
		$titleSubject = $this->lang->line('lang_reset_mail_title');
		
		$db			= new Database();
		$logo 		= base_url(). "img/logo-" . $_SESSION["site_lang"] . ".png";
		
		$langId		= $db->getFieldValueById("sys_language","Id", "HtmlShort='{$lang}'");
		$link 		= base_url() . "site/reset_password{$link}&lang={$_SESSION['site_lang']}&lang_short={$lang}&langid={$langId}&rtl={$_SESSION['site_lang_rtl']}";
		
		$body 	 = $this->lang->line('lang_reset_mail_body');	
		
		$message ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $message .="<html xmlns='http://www.w3.org/1999/xhtml' lang='{$lang}'>";
        $message .='<head>';
        $message .='<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $message .="<title {$this->titleAlign}> {$titleSubject}</title>";
        $message .='</head>';
        
        $message .="<body {$this->emailBodyStyle}>";
         //wrapper div starts-->
        $message .='<div style="height:auto;">'; // border:1px solid #CCC; 
        
        //header starts -->

		
        $message .="<div style='padding:10px; background:#FFF; font-size:24px; color:#000; height:100px; {$this->textAlign}'>";
        $message .='<a href="'. base_url(). '">';
        $message .="<img src='{$logo}'  {$this->imageStyle} />";
        $message .="</a>{$titleSubject}";
        $message .='</div>';
        //header ends -->  
        
        //white  area starts -->
       
 	    $today = $this->getEmailDate();
        $message .="<div {$this->headerTitleStyle}>";
		$message .=$titleSubject;
        $message .="<div {$this->headerDateStyle}>". $today . "</div>";
        $message .='</div>';
        
		//white  area ends -->
        
         $message .="<div style='padding:30px;font-size:14px; color:#333; line-height:22px; {$this->textAlign}' >";
    	 $message .='<p style="font-size:12px; font-weight:normal;">';
        
		if(!$_SESSION['site_lang_rtl'])	
		  $message .="{$this->lang->line('lang_hi')} <b>" . $fullName ."</b>,<br /><br />";
		else
		  $message .="<b>," . $fullName ."</b>{$this->lang->line('lang_hi')}<br /><br />";
	  
	  
		 $message .="{$body}<br/><br/>";
         $message .="<a href='{$link}'> {$this->lang->line('lang_reset_mail_link_caption')} </a>";
         $message .='</p>';
         
		
         $message .='<p>';
         $message .="{$this->lang->line('lang_reset_mail_regards')}, <br/>";
         $message .="{$this->lang->line('lang_mail_team_redeez')}"; 	
		 $message .='</p>';
         
         //footer notes starts-->
         $message .='<p style="font-size:10px; font-weight:normal;border-top:1px solid #CCC;">';
         $message .='<ul style="list-style:none; font-size:10px; font-weight:normal;">';
		
		 $SQL  ="SELECT MessagePoint FROM `sys_email_footer_points` ";
		 $SQL .=" WHERE Status='1' AND Language='" . $_SESSION['site_lang'] . "' ORDER BY `Order`";
		 
		 $res = $this->db->query($SQL)->result_array();
		 if(count($res)>0)
			 foreach($res as $row)
				$message .= "<li>" . $row["MessagePoint"] . "</li>";
		 
		
  		 $message .='</ul>';
		 $message .='</p>';
       
         // footer notes ends-->
         
         $message .='</div>';//content div ends -->
         $message .='</div>';// wrapper div ends-->
         $message .='</body>';
         $message .='</html>';
         
		 $subject   =$this->lang->line('lang_reset_mail_title');
         $res 	 	= sendEmail($emailId, $subject, $message, $subject);
		
	}


?>

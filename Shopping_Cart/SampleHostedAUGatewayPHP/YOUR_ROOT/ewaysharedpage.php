<?php

define('CURL_PROXY_REQUIRED','True')//we need a proxy



 // Eway payment in PHP
 $pathvalue="http://localhost/ScottDip/Shopping_Cart/YOUR_ROOT";
  if(array_key_exists ('action', $_GET)&& ($_GET['action']=="payment");
  {
        $ewayurl="?CustomerID=87654321";
		$ewayurl.="&UserName=TestAccount";
		$ewayurl.="&Amount=".$_POST['Amount'];
		$ewayurl.="&Currency=AUD";
		$ewayurl.="&PageTitle=".$_POST['PageTitle'];
	    $ewayurl.="&PageDescription=".$_POST['PageDescription'];
		$ewayurl.="&PageFooter=".$_POST['PageFooter'];	
		$ewayurl.="&Language=".$_POST['Language'];
		$ewayurl.="&CompanyName=".$_POST['CompanyName'];
		$ewayurl.="&CustomerFirstName=John";
	    $ewayurl.="&CustomerLastName=Doe";		
		$ewayurl.="&CustomerAddress=123 ABC Street";
		$ewayurl.="&CustomerCity=Sydney";
		$ewayurl.="&CustomerState=NSW";
		$ewayurl.="&CustomerPostCode=2000";
		$ewayurl.="&CustomerCountry=Australia";		
		$ewayurl.="&CustomerEmail=sample@eway.com.au";
		$ewayurl.="&CustomerPhone=1800 10 65 65";		
		$ewayurl.="&InvoiceDescription=".$_POST['InvoiceDescription'];
		$ewayurl.="&CancelURL=".$pathvalue."ewaysharedpage.php";
		$ewayurl.="&ReturnUrl=".$pathvalue."ewayresponse.php";
		$ewayurl.="&CompanyLogo=".$_POST['CompanyLogo'];
		$ewayurl.="&PageBanner=".$_POST['PageBanner'];
		$ewayurl.="&MerchantReference=".$_POST['RefNum'];
		$ewayurl.="&MerchantInvoice=".$_POST['Invoice'];
		$ewayurl.="&MerchantOption1="; 
		$ewayurl.="&MerchantOption2=";
		$ewayurl.="&MerchantOption3=";
		$ewayurl.="&ModifiableCustomerDetails=".$_POST['ModDetails'];
			
	    $spacereplace = str_replace(" ", "%20", $ewayurl);	
	    $posturl="https://au.ewaygateway.com/Request/$spacereplace";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $posturl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		if (CURL_PROXY_REQUIRED == 'True') 
		{
			$proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
			curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
			curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
			curl_setopt ($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS, 'proxy:8080');
                        
                        
                        //Set PTW proxy dets
                        curl_setopt ($ch, CURLOPT_PROXYAUTH, CURLAUTH_NTLM);
                        curl_setopt ($ch, CURLOPT_PROXYUSERPWD, '131212224:fatman11');
		}
		
		$response = curl_exec($ch);
		
		function fetch_data($string, $start_tag, $end_tag)
		{
			$position = stripos($string, $start_tag);  
			$str = substr($string, $position);  		
			$str_second = substr($str, strlen($start_tag));  		
			$second_positon = stripos($str_second, $end_tag);  		
			$str_third = substr($str_second, 0, $second_positon);  		
			$fetch_data = trim($str_third);		
			return $fetch_data; 
		}
		
		
		$responsemode = fetch_data($response, '<result>', '</result>');
	    $responseurl = fetch_data($response, '<uri>', '</uri>');
		   
		if($responsemode=="True")
		{ 			  	  	
		  header("location: ".$responseurl);
		  exit;
		}
		else
		{
		  header("location: ewaysharedpage.php?action=error");
		  exit;
		}
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>
	eWAY Payment Service Provider (PSP) Demo | Example eWAY Payment Service Provider (PSP) Transaction 
</title>
<link rel="Stylesheet" href="screen.css" type="text/css">
<body>
   
                  
    <div class="formarea query" style="padding-left:250px;">
     <form name="aspnetForm" method="post" action="ewaysharedpage.php?action=payment" id="aspnetForm">
    <div class="secondaryheading" style="width:550px; background:#FEAC00">
    <img src="ewaylogo.png" alt="Eway-Logo" /><br /><b>&nbsp;&nbsp;Online payments made easy!</b>
        </div>
      <div id="formmiddle" class="middle_query">
            <div class="secondaryheading">
                <h3>Merchant Details</h3>
            </div>
            
            <div class="row">
                <span class="label">MerchID: </span> <span style="margin-left: 20px;">
                    <span id="ctl00_ctl00_cphBody_cphSubBody_lblMerchID">87654321</span>
                </span>            </div>
            <div class="row">
                <span class="label">UserName: </span> <span style="margin-left: 20px;">
                    <span id="ctl00_ctl00_cphBody_cphSubBody_lblUserName">TestAccount</span>
                </span>            </div>
            <div class="row">
                <span class="label">Company Name: </span><span class="formw">
                    <input name="CompanyName" value=""  type="text">
                </span>            </div>
            <div class="row">
                <span class="label">Currency: </span><span style="margin-left: 20px;">
                    <span id="ctl00_ctl00_cphBody_cphSubBody_txtCurrency">AUD</span>
                </span>            </div>
            <div class="row">
                <span class="label">PageTitle: </span><span class="formw">
                    <input name="PageTitle" value=""  type="text">
                </span>            </div>
            <div class="row">
                <span class="label">PageDescription: </span><span class="formw">
                    <input name="PageDescription" value="" type="text">
                </span>            </div>
            <div class="row">
                <span class="label">PageFooter: </span><span class="formw">
                    <input name="PageFooter" value="" type="text">
                </span>            </div>
            <div class="row">
                <span class="label">CompanyLogo: </span><span class="formw">
                    <input name="CompanyLogo" value="" type="text">
                </span>            </div>	
            <div class="row">
                <span class="label">PageBanner: </span><span class="formw">
                    <input name="PageBanner" value="" type="text">
                </span>            </div>				
            <div class="row">
                <span class="label">Language: </span><span style="margin-left: 20px;">
                <select name="Language">
                <option selected="selected" value="EN">English</option>
                <option value="FR">French</option>
                <option value="DE">German</option>
                <option value="ES">Spanish</option>
                <option value="NL">Dutch</option>
                </select>
                </span>            </div>
            <div class="secondaryheading">
                <h3>
                    Customer Details</h3>
            </div>
            <div class="row">
                <span class="label">First Name: </span><span style="margin-left: 20px;">
                    <span id="ctl00_ctl00_cphBody_cphSubBody_txtFirstName">John</span>
                </span>            </div>
            <div class="row">
                <span class="label">Last Name: </span><span style="margin-left: 20px;">
                    <span id="ctl00_ctl00_cphBody_cphSubBody_txtLastName">Doe</span>
                </span>            </div>
            <div class="row">
                <span class="label">Address: </span><span style="margin-left: 20px;">
                    <span id="ctl00_ctl00_cphBody_cphSubBody_txtAddress">123 ABC Street</span>
                </span>            </div>
            <div class="row">
                <span class="label">City: </span><span style="margin-left: 20px;">
                    <span id="ctl00_ctl00_cphBody_cphSubBody_txtCity">Sydney</span>
                </span>            </div>
            <div class="row">
                <span class="label">State: </span><span style="margin-left: 20px;">
                    <span id="ctl00_ctl00_cphBody_cphSubBody_txtState">NSW</span>
                </span>            </div>
            <div class="row">
                <span class="label">Country: </span><span style="margin-left: 20px;">
                    <span id="ctl00_ctl00_cphBody_cphSubBody_txtCountry">Australia</span>
                </span>            </div>
            <div class="row">
                <span class="label">Postcode: </span><span style="margin-left: 20px;">
                    <span id="ctl00_ctl00_cphBody_cphSubBody_txtPostcode">2000</span>
                </span>            </div>
            <div class="row">
                <span class="label">Email: </span><span style="margin-left: 20px;">
                    <span id="ctl00_ctl00_cphBody_cphSubBody_txtEmail">sample@eway.com.au</span>
                </span>            </div>
            <div class="row">
                <span class="label">Customer Phone: </span><span style="margin-left: 20px;">
                    <span id="ctl00_ctl00_cphBody_cphSubBody_txtCustomerPhone">1800 10 65 65</span>
                </span>            </div>
                        <div class="row">
                <span class="label">Modifiable Details: </span><span style="margin-left: 20px;">
                <select name="ModDetails">
                <option selected="selected" value="false">Readonly</option>
                <option value="true">Changable</option>
                </select>
                </span>            </div>

            <div class="secondaryheading">
                <h3>
                    Invoice Details</h3>
            </div>
            <div class="row">
                <span class="label">Merchant Reference Number: </span><span class="formw"> 
                <input name="RefNum" value=""  type="text">
                </span>            </div>
            <div class="row">
                <span class="label">Merchant Invoice: </span><span class="formw">
                    <input name="Invoice" value=""  type="text">
                </span>            </div>
            <div class="row">
                <span class="label">Amount: </span><span style="margin-left: 20px;">
            <select name="Amount">
            <option selected="selected" value="10.00">10.00</option>
            <option value="80.55">80.55</option>
            </select>                        
                </span>            </div>
            <div class="row">
                <span class="label">Invoice Description: </span><span class="formw">
                    <input name="InvoiceDescription" value="" type="text">
                </span>            </div>

            <table>
                <tbody><tr>
                    <td>
                        <input name="Checkout" value="Checkout" id="Checkout" type="submit">                    </td>
                </tr>
           </tbody></table>
        </div>
        </form>
    </div>
   
   


</body></html>
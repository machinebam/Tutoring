<?php
   $querystring="CustomerID=87654321&UserName=TestAccount&AccessPaymentCode=".$_REQUEST['AccessPaymentCode'];
	$posturl="https://au.ewaygateway.com/Result/?".$querystring;

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
		curl_setopt ($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
	}

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

	 $response = curl_exec($ch);
	 $authecode = fetch_data($response, '<authCode>', '</authCode>');
	 $responsecode = fetch_data($response, '<responsecode>', '</responsecode>');
	 $retrunamount = fetch_data($response, '<returnamount>', '</returnamount>');
	 $trxnnumber = fetch_data($response, '<trxnnumber>', '</trxnnumber>');
	 $trxnstatus = fetch_data($response, '<trxnstatus>', '</trxnstatus>');
	 $trxnresponsemessage = fetch_data($response, '<trxnresponsemessage>', '</trxnresponsemessage>');

	 $merchantoption1 = fetch_data($response, '<merchantoption1>', '</merchantoption1>');
	 $merchantoption2 = fetch_data($response, '<merchantoption2>', '</merchantoption2>');
	 $merchantoption3 = fetch_data($response, '<merchantoption3>', '</merchantoption3>');
	 $merchantreference = fetch_data($response, '<merchantreference>', '</merchantreference>');
	 $merchantinvoice = fetch_data($response, '<merchantinvoice>', '</merchantinvoice>');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>
	eWAY Payment Service Provider (PSP) Demo | Example eWAY Payment Service Provider (PSP) Transaction
</title>
<link rel="Stylesheet" href="screen.css" type="text/css">
<body>

    <div class="formarea query" style="margin-left:250px;">
    <form name="aspnetForm" method="post" action="ewaysharedpage.php?action=payment" id="aspnetForm">
    <div class="secondaryheading" style="width:550px; background:#FEAC00">
    <img src="ewaylogo.png" alt="Eway-Logo" /><br /><b>&nbsp;&nbsp;Online payments made easy!</b>
        </div>
      <div id="formmiddle" class="middle_query">
            <div class="secondaryheading" align="center">
                <h3><? if($trxnstatus=="True"){ ?>Transaction Success<? } else {?>Transaction Failed<? } ?></h3>
            </div>
            <table width="100%" border="0" cellspacing="5" cellpadding="5" class="middle_query">
            <tr>
            <td width="50%" align="right" valign="middle"><strong>AuthCode:&nbsp;&nbsp;</strong></td>
            <td width="50%">&nbsp;&nbsp;<?=$authecode;?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>ResponseCode:&nbsp;&nbsp;</strong></td>
              <td>&nbsp;&nbsp;<?=$responsecode;?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>ReturnAmount:&nbsp;&nbsp;</strong></td>
              <td>&nbsp;&nbsp;<?=$retrunamount;?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>TrxnNumber:&nbsp;&nbsp;</strong></td>
              <td>&nbsp;&nbsp;<?=$trxnnumber;?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>TrxnStatus:&nbsp;&nbsp;</strong></td>
              <td>&nbsp;&nbsp;<?=$trxnstatus;?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>TrxnResponseMessage:&nbsp;&nbsp;</strong></td>
              <td>&nbsp;&nbsp;<?=$trxnresponsemessage;?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>MerchantOption1:&nbsp;&nbsp;</strong></td>
              <td>&nbsp;&nbsp;<?=$merchantoption1;?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>MerchantOption2:&nbsp;&nbsp;</strong></td>
              <td>&nbsp;&nbsp;<?=$merchantoption2;?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>MerchantOption3:&nbsp;&nbsp;</strong></td>
              <td>&nbsp;&nbsp;<?=$merchantoption3;?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>MerchantReference:&nbsp;&nbsp;</strong></td>
              <td>&nbsp;&nbsp;<?=$merchantreference;?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>MerchantInvoice:&nbsp;&nbsp;</strong></td>
              <td>&nbsp;&nbsp;<?=$merchantinvoice;?></td>
            </tr>
            <tr>
              <td colspan="2" align="center" valign="middle"><a href="ewaysharedpage.php" style="color:#FF0000">Click to Payment Page</a></td>
              </tr>
            </table>
        </div>
        </form>
    </div>

</body></html>
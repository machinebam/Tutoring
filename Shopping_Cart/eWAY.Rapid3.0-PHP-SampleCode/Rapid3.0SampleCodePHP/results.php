<?php

session_start();

require('Rapid3.0.php');

$service = new RapidAPI();

//Build request for getting the result with the access code.
$request = new GetAccessCodeResultRequest();

$request->AccessCode = $_GET['AccessCode'];

//Call RapidAPI to get the result
$result = $service->GetAccessCodeResult($request);

//Check if any error returns
if(isset($result->Errors))
{
    //Get Error Messages from Error Code. Error Code Mappings are in the Config.ini file
    $ErrorArray = explode(",", $result->Errors);

    var_dump($ErrorArray);

    $lblError = "";

    foreach ( $ErrorArray as $error )
    {
        $lblError .= $service->APIConfig[$error]."<br>";
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title></title>
    <link href="Styles/Site.css" rel="stylesheet" type="text/css" />
    <link href="Styles/jquery-ui-1.8.11.custom.css" rel="stylesheet" type="text/css" />
    <script src="Scripts/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="Scripts/jquery-ui-1.8.11.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jquery.ui.datepicker-en-GB.js" type="text/javascript"></script>
</head>
<body>

        <center>
        <div id="outer">
            <div id="toplinks">
                <img alt="eWAY Logo" class="logo" src="Images/companylogo.gif" width="960px" height="65px" />
            </div>
            <div id="main">

<div id="titlearea">
    <h2>
        Sample Response
    </h2>
</div>
<?php
    if (isset($lblError)) {
?>
    <div id="error">
        <label style="color:red"><?php echo $lblError ?></label>
    </div>
<?php } else { ?>                
    <div id="maincontent">
        <div class="response">
            <div class="fields">
                <label for="lblAccessCode">
                    Access Code</label>
                <label id="lblAccessCode"><?php echo $result->AccessCode; ?></label>
            </div>
            <div class="fields">
                <label for="lblAuthorisationCode">
                    Authorisation Code</label>
                <label id="lblAuthorisationCode"><?php echo isset($result->AuthorisationCode) ? $result->AuthorisationCode:""; ?></label>
            </div>
            <div class="fields">
                <label for="lblInvoiceNumber">
                    Invoice Number</label>
                <label id="lblInvoiceNumber"><?php echo $result->InvoiceNumber; ?></label>
            </div>
            <div class="fields">
                <label for="lblInvoiceReference">
                    Invoice Reference</label>
                <label id="lblInvoiceReference"><?php echo $result->InvoiceReference; ?></label>
            </div>
            <div class="fields">
                <label for="lblOption1">
                    Option1</label>
                <label id="lblOption1"><?php echo isset($result->Options->Option[0]->Value) ? $result->Options->Option[0]->Value:""; ?></label>
            </div>
            <div class="fields">
                <label for="lblOption2">
                    Option2</label>
                <label id="lblOption2"><?php echo isset($result->Options->Option[1]->Value) ? $result->Options->Option[1]->Value:""; ?></label>
            </div>
            <div class="fields">
                <label for="lblOption3">
                    Option3</label>
                <label id="lblOption3"><?php echo isset($result->Options->Option[2]->Value) ? $result->Options->Option[2]->Value:""; ?></label>
            </div>
            <div class="fields">
                <label for="lblResponseCode">
                    Response Code</label>
                <label id="lblResponseCode"><?php echo $result->ResponseCode; ?></label>
            </div>
            <div class="fields">
                <label for="lblResponseMessage">
                    Response Message</label>
                <label id="lblResponseMessage">
                 <?php 
                        if(isset($result->ResponseMessage))
                        {
                            //Get Error Messages from Error Code. Error Code Mappings are in the Config.ini file
                            $ResponseMessageArray = explode(",", $result->ResponseMessage);
                            
                            $responseMessage = "";

                            foreach ( $ResponseMessageArray as $message )
                            {
                                if(isset($service->APIConfig[$message]))
                                    $responseMessage .= $message . " ".$service->APIConfig[$message]."<br>";
                                else
                                    $responseMessage .= $message;
                            }

                            echo $responseMessage;
                        }
                
                 ?>
                </label>
            </div>
            <div class="fields">
                <label for="lblTokenCustomerID">
                    TokenCustomerID
                </label>
                <label id="lblTokenCustomerID"><?php
                    if (isset($result->TokenCustomerID)) {
                            echo $result->TokenCustomerID;
                    }
                ?></label>
            </div>
            <div class="fields">
                <label for="lblTotalAmount">
                    Total Amount</label>
                <label id="lblTotalAmount"><?php
                    if (isset($result->TotalAmount)) {
                        echo $result->TotalAmount;
                    }
                ?></label>
            </div>
            <div class="fields">
                <label for="lblTransactionID">
                    TransactionID</label>
                <label id="lblTransactionID"><?php
                    if (isset($result->TransactionID)) {
                            echo $result->TransactionID;
                    }
                ?></label>
            </div>
            <div class="fields">
                <label for="lblTransactionStatus">
                    Transaction Status</label>
                <label id="lblTransactionStatus"><?php
                    if (isset($result->TransactionStatus) && $result->TransactionStatus && (is_bool($result->TransactionStatus) || $result->TransactionStatus != "false")) {
                        echo 'True';
                    } else {
                        echo 'False';
                    }
                ?></label>
            </div>
            <div class="fields">
                <label for="lblBeagleScore">
                    Beagle Score</label>
                <label id="lblBeagleScore"><?php
                    if (isset($result->BeagleScore)) {
                        echo $result->BeagleScore;
                    }
                ?></label>
            </div>
        </div>
    </div>

        <br />
        <br />
        <a href="default.php">[Start Over]</a>

    <div id="maincontentbottom">
    </div>
<?php } ?>
            </div>
            <div id="footer"></div>
        </div>
    </center>

</body>
</html>
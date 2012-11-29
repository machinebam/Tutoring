<?php

session_start();

//Include RapidAPI Library
require('Rapid3.0.php');

//Create RapidAPI Service
$service = new RapidAPI();

$Response = $_SESSION['Response'];
$TotalAmount = $_SESSION['TotalAmount'];
$InvoiceReference = $_SESSION['InvoiceReference'];
if (! isset($Response) ) {
    header("Location: default.php");
    exit();
}

//Is Debug Mode
if ($service->APIConfig['ShowDebugInfo']) {
    echo "CreateAccessCode Response Object From Current Session";
    var_dump($Response);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="Styles/Site.css" rel="stylesheet" type="text/css" />
    <!-- Include for Ajax Calls -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
    <!-- This is the JSONP script include on the eWAY Rapid API Server - this must be included to use the Rapid API via JSONP -->
    <script type="text/javascript" src="<?php echo $service->APIConfig["PaymentService.JSONPScript"] ?>"></script>
    
</head>
<body>
    <form id="form1" action="<?php echo $Response->FormActionURL ?>" method='post'>
    <center>
        <div id="outer">
            <div id="toplinks">
                <img alt="eWAY Logo" class="logo" src="Images/merchantlogo.gif" width="926px" height="65px" />
            </div>
            <div id="main">
                <div id="titlearea">
                    <h2>Sample Merchant Checkout</h2>
                </div>
<?php
    if (isset($lblError)) {
?>
    <div id="error">
        <label style="color:red"><?php echo $lblError ?></label>
    </div>
<?php } ?>
<!-- <?php echo var_dump($Response) ?> -->
                <div id="maincontent">
                    <div class="transactioncustomer">
                        <div class="header first">
                            Customer Address
                        </div>
                        <div class="fields">
                            <label for="lblStreet">Street</label>
                            <label id="lblStreet"><?php echo $Response->Customer->Street1 ?></label>
                        </div>
                        <div class="fields">
                            <label for="lblCity">
                                City</label>
                            <label id="lblStreet"><?php echo $Response->Customer->City ?></label>
                        </div>
                        <div class="fields">
                            <label for="lblState">
                                State</label>
                            <label id="lblState"><?php echo $Response->Customer->State ?></label>
                        </div>
                        <div class="fields">
                            <label for="lblPostcode">
                                Post Code</label>
                            <label id="lblPostcode"><?php echo $Response->Customer->PostalCode ?></label>
                        </div>
                        <div class="fields">
                            <label for="lblCountry">
                                Country</label>
                            <label id="lblCountry"><?php echo $Response->Customer->Country ?></label>
                        </div>
                        <div class="fields">
                            <label for="lblEmail">
                                Email</label>
                            <label id="lblEmail"><?php echo $Response->Customer->Email; ?></label>
                        </div>
                        <div class="fields">
                            <label for="lblPhone">
                                Phone</label>
                            <label id="lblPhone"><?php echo $Response->Customer->Phone ?></label>
                        </div>
                        <div class="fields">
                            <label for="lblMobile">
                                Mobile</label>
                            <label id="lblMobile"><?php echo $Response->Customer->Mobile ?></label>
                        </div>
                        <div class="header">
                            Payment Details
                        </div>
                        <div class="fields">
                            <label for="lblAmount">
                                Total Amount</label>
                            <label id="lblAmount"><?php echo (int) $TotalAmount ?></label>
                        </div>
                        <div class="fields">
                            <label for="lblInvoiceReference">
                                Invoice Reference</label>
                            <label id="lblInvoiceReference"><?php echo $InvoiceReference ?></label>
                        </div>
                    </div>
                    <div class="transactioncard">
                        <div class="header first">
                            Customer Details</div>
                        <div class="fields">
                            <label for="lblTitle">
                                Title</label>
                            <label id="lblTitle"><?php echo $Response->Customer->Title ?></label>
                        </div>
                        <div class="fields">
                            <label for="lblFirstName">
                                First Name</label>
                            <label id="lblFirstName"><?php echo $Response->Customer->FirstName ?></label>
                        </div>
                        <div class="fields">
                            <label for="lblLastName">
                                Last Name</label>
                            <label id="lblLastName"><?php echo $Response->Customer->LastName ?></label>
                        </div>
                        <div class="fields">
                            <label for="lblCompanyName">
                                Company Name</label>
                            <label id="lblCompanyName"><?php echo $Response->Customer->CompanyName ?></label>
                        </div>
                        <div class="fields">
                            <label for="lblJobDescription">
                                Job Description</label>
                            <label id="lblJobDescription"><?php echo $Response->Customer->JobDescription ?></label>
                        </div>
                        <div class="header">
                            Card Details
                        </div>
                        <!-- The following fields are the ones that eWAY looks for in the POSTed data when the form is submitted. -->

                        <!-- This field should contain the access code received from eWAY -->
                        <input type='hidden' name='EWAY_ACCESSCODE' value="<?php echo $Response->AccessCode ?>" />
                        <div class="fields">
                            <label for="EWAY_CARDNAME">
                                Card Holder</label>
                            <input type='text' name='EWAY_CARDNAME' id='EWAY_CARDNAME' value="<?php echo (isset($Response->Customer->CardName) && !empty($Response->Customer->CardName) ? $Response->Customer->CardName:"TestUser") ?>" />
                        </div>
                        <div class="fields">
                            <label for="EWAY_CARDNUMBER">
                                Card Number</label>
                            <input type='text' name='EWAY_CARDNUMBER' id='EWAY_CARDNUMBER' value="<?php echo (isset($Response->Customer->CardNumber) && !empty($Response->Customer->CardNumber)  ? $Response->Customer->CardNumber:"4444333322221111") ?>" />
                        </div>
                        <div class="fields">
                            <label for="EWAY_CARDEXPIRYMONTH">
                                Expiry Date</label>
                            <select ID="EWAY_CARDEXPIRYMONTH" name="EWAY_CARDEXPIRYMONTH">
                                <?php
                                   if (isset($Response->Customer->CardExpiryMonth)&& !empty($Response->Customer->CardExpiryMonth)) {
                                        $expiry_month = $Response->Customer->CardExpiryMonth;
                                    } else {
                                        $expiry_month = date('m');
                                    }
                                    for($i = 1; $i <= 12; $i++) {
                                        $s = sprintf('%02d', $i);
                                        echo "<option value='$s'";
                                        if ( $expiry_month == $i ) {
                                            echo " selected='selected'";
                                        }
                                        echo ">$s</option>\n";
                                    }
                                ?>
                            </select>
                            /
                            <select ID="EWAY_CARDEXPIRYYEAR" name="EWAY_CARDEXPIRYYEAR">
                                <?php
                                    $i = date("y");
                                    $j = $i+11;
                                    for ($i; $i <= $j; $i++) {
                                        echo "<option value='$i'";
                                        if ( $Response->Customer->CardExpiryYear == $i ) {
                                            echo " selected='selected'";
                                        }
                                        echo ">$i</option>\n";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="fields">
                            <label for="EWAY_CARDSTARTMONTH">
                                Valid From Date</label>
                            <select ID="EWAY_CARDSTARTMONTH" name="EWAY_CARDSTARTMONTH">
                                <?php
                                    if (isset($Response->Customer->CardStartMonth)&& !empty($Response->Customer->CardStartMonth )) {
                                        $expiry_month = $Response->Customer->CardExpiryMonth;
                                    } else {
                                        $expiry_month = "";//date('m');
                                    }
                                    echo  "<option></option>";
                                    
                                    for($i = 1; $i <= 12; $i++) {
                                        $s = sprintf('%02d', $i);
                                        echo "<option value='$s'";
                                        if ( $expiry_month == $i ) {
                                            echo " selected='selected'";
                                        }
                                        echo ">$s</option>\n";
                                    }
                                ?>
                            </select>
                            /
                            <select ID="EWAY_CARDSTARTYEAR" name="EWAY_CARDSTARTYEAR">
                                <?php
                                    $i = date("y");
                                    $j = $i-11;
                                    echo  "<option></option>";
                                    for ($i; $i >= $j; $i--) {
                                        $year = sprintf('%02d', $i);
                                        echo "<option value='$year'";
                                        if (isset($Response->Customer->CardStartYear)) {
                                            if ( $Response->Customer->CardStartYear == $year ) {
                                                echo " selected='selected'";
                                            }
                                        }
                                        echo ">$year</option>\n";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="fields">
                            <label for="EWAY_CARDISSUENUMBER">
                                Issue Number</label>
                            <input type='text' name='EWAY_CARDISSUENUMBER' id='EWAY_CARDISSUENUMBER' value="<?php echo (isset($Response->Customer->CardIssueNumber) && !empty($Response->Customer->CardIssueNumber) ? $Response->Customer->CardIssueNumber:"22") ?>" maxlength="2" style="width:40px;"/> <!-- This field is optional but highly recommended -->
                        </div>
                        <div class="fields">
                            <label for="EWAY_CARDCVN">
                                CVN</label>
                            <input type='text' name='EWAY_CARDCVN' id='EWAY_CARDCVN' value="123" maxlength="4" style="width:40px;"/> <!-- This field is optional but highly recommended -->
                        </div>
                    </div>
                    <div class="paymentbutton">
                        <br />
                        <br />
                        <input type='submit' ID="btnSubmit" name='btnSubmit' value="Submit" />
                        <input id="Process" type="button" value="Submit Via Ajax" />
                    </div>
                </div>
                <div id="maincontentbottom">
                </div>
            </div>
        </div>
    </center>
    </form>
    <script type="text/javascript">

        $(function () {

            // if something goes wrong, then you should redirect to your result/query page to query eWAY for the status of the request
            var urlToRedirectOnError = '<?php echo "results.php";  ?>';

            // on button click
            $('#Process').on('click', function () {

                // this is the button - prevent double click
                $(this).attr('disabled', "disabled");

                // call eWAY to process the request
                eWAY.process(document.forms[0], {
                    autoRedirect: false,
                    onComplete: function (data) {
                        // this is a callback to hook into when the requests completes
                        window.location.replace(data.RedirectUrl);
                    },
                    onError: function (e) {
                        // this is a callback you can hook into when an error occurs
                        alert('There was an error processing the request\r\n\r\nClick OK to redirect to your result/query page');
                        window.location.replace(urlToRedirectOnError);
                    },
                    onTimeout: function (e) {
                        // this is a callback you can hook into when the request times out
                        alert('The request has timed out\r\n\r\nClick OK to redirect to your result/query page.');
                        window.location.replace(urlToRedirectOnError);
                    }
                });

            });
        })

    </script>
</body>
</html>
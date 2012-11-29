<?php

session_start();

//Include RapidAPI Library
require('Rapid3.0.php');

//Create RapidAPI Service
$service = new RapidAPI();

$self_url = 'http';
if (!empty($_SERVER['HTTPS'])) {$self_url .= "s";}
$self_url .= "://" . $_SERVER["SERVER_NAME"];
if ($_SERVER["SERVER_PORT"] != "80") {
    $self_url .= ":".$_SERVER["SERVER_PORT"];
}
$self_url .= $_SERVER["REQUEST_URI"];
$redirect_url = preg_replace('/default.php/', 'results.php', $self_url);

if ( isset($_POST['btnSubmit']) ) {
    
    //Create AccessCode Request Object
    $request = new CreateAccessCodeRequest();

    //Populate values for Customer Object
    //Note: TokenCustomerID is Required Field When Update an exsiting TokenCustomer
    if(!empty($_POST['txtTokenCustomerID']))
        $request->Customer->TokenCustomerID = $_POST['txtTokenCustomerID'];
    
    $request->Customer->Reference = $_POST['txtCustomerRef'];
    //Note: Title is Required Field When Create/Update a TokenCustomer
    $request->Customer->Title = $_POST['ddlTitle'];
    //Note: FirstName is Required Field When Create/Update a TokenCustomer
    $request->Customer->FirstName = $_POST['txtFirstName'];
    //Note: LastName is Required Field When Create/Update a TokenCustomer
    $request->Customer->LastName = $_POST['txtLastName'];
    $request->Customer->CompanyName = $_POST['txtCompanyName'];
    $request->Customer->JobDescription = $_POST['txtJobDescription'];
    $request->Customer->Street1 = $_POST['txtStreet'];
    $request->Customer->City = $_POST['txtCity'];
    $request->Customer->State = $_POST['txtState'];
    $request->Customer->PostalCode = $_POST['txtPostalcode'];
    //Note: Country is Required Field When Create/Update a TokenCustomer
    $request->Customer->Country = $_POST['txtCountry'];
    $request->Customer->Email = $_POST['txtEmail'];
    $request->Customer->Phone = $_POST['txtPhone'];
    $request->Customer->Mobile = $_POST['txtMobile'];
    $request->Customer->Comments = $_POST['txtComments'];
    $request->Customer->Fax = $_POST['txtFax'];
    $request->Customer->Url = $_POST['txtUrl'];
    
    //Populate values for ShippingAddress Object. 
    //This values can be taken from a Form POST as well. Now is just some dummy data.
    $request->ShippingAddress->FirstName = "John";
    $request->ShippingAddress->LastName = "Doe";
    $request->ShippingAddress->Street1 = "9/10 St Andrew";
    $request->ShippingAddress->Street2 = " Square";
    $request->ShippingAddress->City = "Edinburgh";
    $request->ShippingAddress->State = "";
    $request->ShippingAddress->Country = "gb";
    $request->ShippingAddress->PostalCode = "EH2 2AF";
    $request->ShippingAddress->Email = "your@email.com";
    $request->ShippingAddress->Phone = "0131 208 0321";
    //ShippingMethod, e.g. "LowCost", "International", "Military". Check the spec for available values.
    $request->ShippingAddress->ShippingMethod = "LowCost";

    //Populate values for LineItems
    $item1 = new LineItem();   
    $item1->SKU = "SKU1";
    $item1->Description = "Description1";
    $item2 = new LineItem();
    $item2->SKU = "SKU2";
    $item2->Description = "Description2";
    $request->Items->LineItem[0] = $item1;
    $request->Items->LineItem[1] = $item2;
    
    //Populate values for Options
    $opt1 = new Option();
    $opt1->Value = $_POST['txtOption1'];
    $opt2 = new Option();
    $opt2->Value = $_POST['txtOption2'];
    $opt3 = new Option();
    $opt3->Value = $_POST['txtOption3'];
    
    $request->Options->Option[0]= $opt1;
    $request->Options->Option[1]= $opt2;
    $request->Options->Option[2]= $opt3;
    
    //Populate values for Payment Object
    //Note: TotalAmount is a Required Field When Process a Payment, TotalAmount should set to "0" or leave EMPTY when Create/Update A TokenCustomer
    $request->Payment->TotalAmount = $_POST['txtAmount'];
    $request->Payment->InvoiceNumber = $_POST['txtInvoiceNumber'];
    $request->Payment->InvoiceDescription = $_POST['txtInvoiceDescription'];
    $request->Payment->InvoiceReference = $_POST['txtInvoiceReference'];
    $request->Payment->CurrencyCode = $_POST['txtCurrencyCode'];
    
    //Url to the page for getting the result with an AccessCode
    //Note: RedirectUrl is a Required Field For all cases
    $request->RedirectUrl = $_POST['txtRedirectURL'];
  
    //Method for this request. e.g. ProcessPayment, Create TokenCustomer, Update TokenCustomer & TokenPayment
    $request->Method = $_POST['ddlMethod'];

    //Call RapidAPI
    $result = $service->CreateAccessCode($request);

    //Save result into Session. payment.php and results.php will retrieve this result from Session
    $_SESSION['TotalAmount'] = (int) $_POST['txtAmount'];
    $_SESSION['InvoiceReference'] = $_POST['txtInvoiceReference'];
    $_SESSION['Response'] = $result;
        
    //Check if any error returns
    if(isset($result->Errors))
    {
        //Get Error Messages from Error Code. Error Code Mappings are in the Config.ini file
        $ErrorArray = explode(",", $result->Errors);
        
        $lblError = "";
        
        foreach ( $ErrorArray as $error )
        {
            if(isset($service->APIConfig[$error]))
                $lblError .= $error." ".$service->APIConfig[$error]."<br>";
            else
                $lblError .= $error;
        }
    }
    else
    {
        //All good then redirect to the payment page
        header("Location: payment.php");
        exit();
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
    <script type="text/javascript" src="Scripts/tooltip.js"></script>
</head>
<body>
    <form method="POST">
    <center>
        <div id="outer">
            <div id="toplinks">
                <img alt="eWAY Logo" class="logo" src="Images/companylogo.gif" width="960px" height="65px" />
            </div>
            <div id="main">

    <div id="titlearea">
        <h2>Sample Merchant Page</h2>
    </div>
<?php
    if (isset($lblError)) {
?>
    <div id="error">
        <label style="color:red"><?php echo $lblError ?></label>
    </div>
<?php } ?>
    <div id="maincontent">
        <div class="transactioncustomer">
            <div class="header first">
                Request Options
            </div>
            <div class="fields">
                <label for="txtRedirectURL">Redirect URL</label>
                <input id="txtRedirectURL" name="txtRedirectURL" type="text" value="<?php echo $redirect_url ?>" />
            </div>
            <div class="header">
                Payment Details
            </div>
            <div class="fields">
                <label for="txtAmount">Amount &nbsp;<img src="Images/question.gif" alt="Find out more" id="amountTipOpener" border="0" /></label>
                <input id="txtAmount" name="txtAmount" type="text" value="100" />
            </div>
            <div class="fields">
                <label for="txtCurrencyCode">Currency Code </label>
                <input id="txtCurrencyCode" name="txtCurrencyCode" type="text" value="" />
            </div>
            <div class="fields">
                <label for="txtInvoiceNumber">Invoice Number</label>
                <input id="txtInvoiceNumber" name="txtInvoiceNumber" type="text" value="Inv 21540" />
            </div>
            <div class="fields">
                <label for="txtInvoiceReference">Invoice Reference</label>
                <input id="txtInvoiceReference" name="txtInvoiceReference" type="text" value="513456" />
            </div>
            <div class="fields">
                <label for="txtInvoiceDescription">Invoice Description</label>
                <input id="txtInvoiceDescription" name="txtInvoiceDescription" type="text" value="Individual Invoice Description" />
            </div>
            <div class="header">
                Custom Fields
            </div>
            <div class="fields">
                <label for="txtOption1">Option 1</label>
                <input id="txtOption1" name="txtOption1" type="text" value="Option1" />
            </div>
            <div class="fields">
                <label for="txtOption2">Option 2</label>
                <input id="txtOption2" name="txtOption2" type="text" value="Option2" />
            </div>
            <div class="fields">
                <label for="txtOption3">Option 3</label>
                <input id="txtOption3" name="txtOption3" type="text" value="Option3" />
            </div>
        </div>
        <div class="transactioncard">
            <div class="header first">
                Customer Details
            </div>
            <div class="fields">
                <label for="txtTokenCustomerID">Token Customer ID &nbsp;<img src="Images/question.gif" alt="Find out more" id="tokenCustomerTipOpener" border="0" /></label>
                <input id="txtTokenCustomerID" name="txtTokenCustomerID" type="text" />
            </div>
            <div class="fields">
                <label for="ddlTitle">Title</label>
                <select id="ddlTitle" name="ddlTitle">
                <option></option>
                <option value="Mr." selected="selected">Mr.</option>
                <option value="Miss">Miss</option>
                <option value="Mrs.">Mrs.</option>
                </select>
            </div>
            <div class="fields">
                <label for="txtCustomerRef">Customer Reference</label>
                <input id="txtCustomerRef" name="txtCustomerRef" type="text" value="A12345" />
            </div>
            <div class="fields">
                <label for="txtFirstName">First Name</label>
                <input id="txtFirstName" name="txtFirstName" type="text" value="John" />
            </div>
            <div class="fields">
                <label for="txtLastName">Last Name</label>
                <input id="txtLastName" name="txtLastName" type="text" value="Doe" />
            </div>
            <div class="fields">
                <label for="txtCompanyName">Company Name</label>
                <input id="txtCompanyName" name="txtCompanyName" type="text" value="WEB ACTIVE" />
            </div>
            <div class="fields">
                <label for="txtJobDescription">Job Description</label>
                <input id="txtJobDescription" name="txtJobDescription" type="text" value="Developer" />
            </div>
            <div class="header">
                Customer Address
            </div>
            <div class="fields">
                <label for="txtStreet">Street</label>
                <input id="txtStreet" name="txtStreet" type="text" value="15 Smith St" />
            </div>
            <div class="fields">
                <label for="txtCity">City</label>
                <input id="txtCity" name="txtCity" type="text" value="Phillip" />
            </div>
            <div class="fields">
                <label for="txtState">State</label>
                <input id="txtState" name="txtState" type="text" value="ACT" />
            </div>
            <div class="fields">
                <label for="txtPostalcode">Post Code</label>
                <input id="txtPostalcode" name="txtPostalcode" type="text" value="2602" />
            </div>
            <div class="fields">
                <label for="txtCountry">Country</label>
                <input id="txtCountry" name="txtCountry" type="text" value="au" maxlength="2" />
            </div>
            <div class="fields">
                <label for="txtEmail">Email</label>
                <input id="txtEmail" name="txtEmail" type="text" value="" />
            </div>
            <div class="fields">
                <label for="txtPhone">Phone</label>
                <input id="txtPhone" name="txtPhone" type="text" value="1800 10 10 65" />
            </div>
            <div class="fields">
                <label for="txtMobile">Mobile</label>
                <input id="txtMobile" name="txtMobile" type="text" value="1800 10 10 65" />
            </div>
            <div class="fields">
                <label for="txtFax">Fax</label>
                <input id="txtFax" name="txtFax" type="text" value="02 9852 2244" />
            </div>
            <div class="fields">
                <label for="txtUrl">Website</label>
                <input id="txtUrl" name="txtUrl" type="text" value="http://www.yoursite.com" />
            </div>
            <div class="fields">
                <label for="txtComments">Comments</label>
                <textarea id="txtComments" name="txtComments"/>Some comments here</textarea>
            </div>            
            <div class="header">
                Method
            </div>
            <div class="fields">
                <label for="ddlMethod">Method Type</label>
                <select id="ddlMethod" name="ddlMethod" style="width:140px;">
                <option value="ProcessPayment">ProcessPayment</option>
                <option value="CreateTokenCustomer">CreateTokenCustomer</option>
                <option value="UpdateTokenCustomer">UpdateTokenCustomer</option>
                <option value="TokenPayment">TokenPayment</option>
                </select>
            </div>
        </div>
        <div class="button">
            <br />
            <br />
            <input type="submit" id="btnSubmit" name="btnSubmit" value="Get Access Code" />
        </div>
    </div>
    <div id="maincontentbottom">
    </div>
    <div id="amountTip" style="font-size: 8pt !important">
        The amount in cents. For example for an amount of $1.00, enter 100
    </div>
    <div id="tokenCustomerTip" style="font-size: 8pt !important">
        If this field has a value, the details of an existing customer will be loaded when the request is sent.
    </div>
    <div id="saveTokenTip" style="font-size: 8pt !important">
        If this field is checked, the details in the customer fields will be used to either create a new token customer, or (if Token Customer ID has a value) update an existing customer.
    </div>

            </div>
            <div id="footer"></div>
        </div>
    </center>
    </form>
</body>
</html>
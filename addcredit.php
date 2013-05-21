<?php
	require_once("logic/chksession.php");
	require_once("logic/connection.php");	
	
	$eid=$_SESSION['email'];
	
	$res=$con->prepare("select name from user_info where email=?");
	$res->bind_param("s",$eid);
	$res->execute();
	$res->bind_result($name);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<form class="paypal" action="logic/payments.php" method="post" id="paypal_form" target="_blank">    
	<input type="hidden" name="cmd" value="_xclick" /> 
    <input type="hidden" name="no_note" value="1" />
    <input type="hidden" name="lc" value="US" />
    <input type="hidden" name="currency_code" value="USD" />
    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
    <input type="hidden" name="first_name" value="<?php echo $name; ?>"  />
    <input type="hidden" name="item_name" value="Deposite your amount" / >
    <input type="text" name="amount" / >
    <input type="submit"  value="Submit Payment"/>
</form>
</body>
</html>
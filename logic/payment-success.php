<?php
	require_once('chksession.php');
	require_once('connection.php');
	$uid=$_SESSION['user_id'];
	$res=$con->prepare("insert into transaction(transaction_id, user_id, transaction_date,transaction_amount,transaction_status) VALUES(?,?,?,?,?) ");
	$res->bind_param('sisis',$_GET['tx'],$uid,date("y-m-d"),$_GET['amt'],$_GET['st']);
	$res->execute();

	$res=$con->prepare("select credit_amount from user_credit where user_id=?");
	$res->bind_param('i',$uid);

	$res->execute();
	$res->bind_result($amt);
	$res->fetch();
	//echo $amt." </br> ";
	$amt+=$_GET['amt'];
	//echo $amt." </br> ";
	//echo $_SESSION['uid'];

	$con = getConnection();
	$res=$con->prepare("UPDATE user_credit SET credit_amount = ? WHERE user_id=? ");
	$res->bind_param('ii',$amt,$uid);
	$res->execute()	;
	//echo $res1->error;
	header('location:../payment-successful.php');
?>


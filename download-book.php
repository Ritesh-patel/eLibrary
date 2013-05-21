<?php

	require_once('logic\connection.php');
	require_once('logic\chksession.php');	
	if(isset($_POST['isbn']))
	{
	$isbn=$_POST['isbn'];
	$user_id=$_SESSION['user_id'];
	
	$res=$con->prepare("select credit_amount from user_credit where user_id=?");
	$res->bind_param("i",$user_id);
	$res->execute();
	$res->bind_result($amt);
	$res->fetch();
	$con=getConnection();
	$res=$con->prepare("select price from book_info where isbn=?");
	$res->bind_param("s",$isbn);
	$res->execute();
	$res->bind_result($bamt);
	$res->fetch();
	
	$con=getConnection();
	$res=$con->prepare("select user_id from user_books where user_id=? and isbn=?");
	$res->bind_param("is",$user_id,$isbn);
	$res->execute();
	$res->bind_result($uid);
	$res->fetch();
	//echo $uid;
	$flag=0;
	//echo $flag;
	if($amt<$bamt || $uid!="")
	{
		if($uid!="")
			echo "Book already downloaded";
		else
			echo "Not enough amount";
		$flag=1;
	}
	
	if(isset($_REQUEST['download']))
	{
		$amt=$amt-$bamt;
		//echo $amt;
		$con=getConnection();
		$res=$con->prepare("UPDATE user_credit SET credit_amount = ? WHERE user_id=? ");
		$res->bind_param('ii',$amt,$user_id);
		$res->execute();
		$con=getConnection();
		$res=$con->prepare("insert into user_books(user_id,isbn) values(?,?)");		
		$res->bind_param("is",$user_id,$isbn);
		$res->execute();
		$con=getConnection();
		$res=$con->prepare("select file_path from book_info where isbn=?");
		$res->bind_param('s',$isbn);
		//echo $isbn."   ----    ";
		$res->execute();
		$res->bind_result($path);
		$res->fetch();
		//echo $path."   ----    ";
		$flag=2;
	}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	if(isset($_POST['isbn']))
	{
		if($flag==0)
		{
?>
<form method="post">
	<p>
        <input type="hidden" value="<?php echo $isbn; ?>" name="isbn">
        <label>Are you sure to buy this book?</label>
        <input type="submit" value="Yes" name="download" />
    </p>
</form>
<?php
	$flag=3;
		}
	//echo $flag;
	}
?>
<?php
	if(isset($_POST['isbn']))
	{
		if($flag==2)
		{
?>
	<a href="books/<?php echo $path; ?>">Dowbload your book.</a>
<?php
		}
	}
?>
</body>
</html>
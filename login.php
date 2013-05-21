<?php
	session_start();
	

	require_once('logic\connection.php');
	if(isset($_REQUEST['submit']))
	{
		$eid=$_REQUEST['eid'];
		$pass=$_REQUEST['pass'];
		echo $eid;		
		$res=$con->prepare("select user_id, password from user_info where email=?");
		$res->bind_param("s",$eid);
		$res->execute();
		$res->bind_result($uid,$pass2);
		while($row=$res->fetch())
		{
				if($pass==$pass2)
				{
					echo 'Successful Login';
					$_SESSION['email']=$eid;
					$_SESSION['user_id']=$uid;
					
					header('location:index.php');
				}
				else
				{
					echo 'Invalid ID and Password';
				}
				echo $uid;
				
		}
			/*$sq='select name from student_info where eid="'.$eid.'" and pass="'.$pass.'" ';
			$res=mysql_query($sq);
			$data=mysql_fetch_array($res);
			if(mysql_num_rows($res)>0)
			{
				$_SESSION['name']=$data['name'];
				$_SESSION['eid']=$_REQUEST['eid'];
				header('location:edit.php');	
			}
			else
				$msg="Invalid Logid or password.";*/
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" href="../css/home.css" type="text/css" />
</head>

<body>

	
	<form method="post">
		<p class="text">
			<label>Enter Login id:</label> 
			<input type="text" name="eid" />
		</p>
		<p class="text">
			<label>Enter Password:</label>
			<input type="password" name="pass" />
		</p>
		<p>
			<input  class="button" type="submit" name="submit" value="Login" />
		</p>
		<?php
			
			if(isset($msg))			
				echo '<p class="text">".$msg."</p>';					
		?>
		
		
	</form>
	
</body>
</html>

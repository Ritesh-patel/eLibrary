<?php
// functions.php
function check_txnid($tnxid){
	global $link;
	return true;
	$valid_txnid = true;
    //get result set
    $sql = mysql_query("SELECT * FROM `payments` WHERE txnid = '$tnxid'", $link);		
	if($row = mysql_fetch_array($sql)) {
        $valid_txnid = false;
	}
    return $valid_txnid;
}

function check_price($price, $id){
    $valid_price = false;
    //you could use the below to check whether the correct price has been paid for the product
    
	/* 
	$sql = mysql_query("SELECT amount FROM `products` WHERE id = '$id'");		
    if (mysql_numrows($sql) != 0) {
		while ($row = mysql_fetch_array($sql)) {
			$num = (float)$row['amount'];
			if($num == $price){
				$valid_price = true;
			}
		}
    }
	return $valid_price;
	*/
	return true;
}

function updatePayments($data){	
    global $link;
	$uid=$_SESSION['uid'];
	if(is_array($data)){				
        $sql = mysql_query("INSERT INTO `payments` (txnid, user_id, payment_amount, payment_status) VALUES (
                '".$data['txn_id']."' ,
                '".$uid."' ,
				'".$data['payment_amount']."' ,
                '".$data['payment_status']."' 
                )", $link);
    return mysql_insert_id($link);
    }
}
?>
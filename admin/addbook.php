<?php
	require_once("chksession.php");
	require_once("../logic/connection.php");		
	
	
	
	if(isset($_REQUEST['submit']))
	{
			$title=$_REQUEST['title'];
			$author=$_REQUEST['author'];
			$publisher=$_REQUEST['publisher'];
			$price=$_REQUEST['price'];
			$isbn=$_REQUEST['isbn'];
			//echo $isbn;
			$res=$con->prepare('select book_id from book_info where isbn=?');
			$res->bind_param("s",$isbn);			
			$res->execute();
			$res->bind_result($bid);
			$res->fetch();
			if($bid!="")
				echo "This book already exsit.";
			else
			{
				//echo "found";
				if($_FILES['image']['name']!="" && $_FILES['file']['name']!="")
				{

					//echo "found1";
					$image=$_FILES['image']['name'];
					$filepath = md5($isbn).$_FILES['file']['name'];
					$path1="../books";
					$path2="../img";					
					$fileupload=$path1."/".$filepath;
					$imageupload=$path2."/".$image;
					if(move_uploaded_file($_FILES["image"]["tmp_name"],$imageupload))
					{
						//echo "found2";
						if(move_uploaded_file($_FILES["file"]["tmp_name"], $fileupload))
						{
							$con=getConnection();
							$str=$con->prepare("insert into book_info(title,author,publisher,price,isbn,image,file_path) values(?,?,?,?,?,?,?)");
							$str->bind_param('sssisss',$title,$author,$publisher,$price,$isbn,$image,$filepath);
							$str->execute();
						}
						else
						{
							echo "error in file upload";
						}
					}
				
				}
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
<form method="post" enctype="multipart/form-data">
	<p>
    	<label>Title:</label>
	    <input type="text" name="title" id="title" />
    </p>
	<p>
        <label>Author:</label>
        <input type="text" name="author" id="author" />
    </p>
     <p>   
        <label>Publisher:</label>
        <input type="text" name="publisher" id="publisher" />
     </p>
     <p>   
        <label>Price:</label>
        <input type="text" name="price" id="price" />
     </p>
     <p>   
        <label>ISBN:</label>
        <input type="text" name="isbn" id="isbn" />
     </p>
     <p>
        <label>Book Image:</label>
        <input type="file" name="image" id="image" />
     </p>
     <p>
        <label>File:</label>
        <input type="file" name="file" id="file" />
     </p>
        <input type="submit" name="submit" value="Add Book" />
</form>
</body>
</html>
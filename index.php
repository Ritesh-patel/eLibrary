<?php
	require_once('logic\connection.php');
	$res=$con->prepare("select title, author, publisher, price, isbn, image, file_path from book_info");
	$res->execute();	
	$res->bind_result($title, $author, $publisher, $price, $isbn, $image, $file_path);
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
		body 
		{
			padding-top: 60px;
			padding-bottom: 40px;
		}
</style>
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
    </head>
    <body>
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">eBook</a>
          <div class="nav-collapse">
        	<ul class="nav pull-right">
              <li class="dropdown">
              	<a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<b class="caret"></b></a>
      			<ul class="dropdown-menu">
                	<li><a href="addcredit.php">Add Credit</a></li>
                    <li><a href="#" id="mycart">My Downloads</a></li>
                    <li><a href="#">Change Password</a></li>
                    <li class="divider"></li>                                    
              	</ul>
        	   </li>
	        </ul>
    	  </div>
          <!--/.nav-collapse --> 
        </div>
  </div>
    </div>
<div class="container"> 
      
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div >
    <?php
			while($row=$res->fetch())
			{
		?>
    	<form method="post" action="download-book.php">
        <div class="book">
          <div class="pull-left"> <img alt="" src="img/<?php echo $image; ?>" class="" ></div>
          <div  class="clearfix">
            <p class="title"><?php echo $title; ?></p>
            <p class="auhor">By, <?php echo $author; ?></p>
            <p class="publisher">Published by, <?php echo $publisher; ?></p>
            <p class="isbn">ISBN: <?php echo $isbn; ?></p>
            <input type="hidden" value="<?php echo $isbn; ?>" name="isbn">
	      </div>
          <div><span class="price"><?php echo $price; ?></span>
        	<input type="submit" name="submit" value="Buy This Book">
      		</div>
        
	  </div>
  	</form>
      <?php
			}
		
		?>
        </div>
      <div class="clearfix"></div>
      <footer>
    <p>&copy; Company 2012</p>
  </footer>
      <div class="modal hide" id="myModal">
    <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h3>My Cart</h3>
        </div>
    <div class="modal-body">
          <p>List of books comes here</p>
          <table class="table table-bordered table-striped">
        <thead>
              <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Price</th>
            <th>Remove</th>
          </tr>
            </thead>
        <tbody>
              <tr>
            <td>Title comes here</td>
            <td>Auther</td>
            <td>Default</td>
            <td ><code>55</code></td>
            <td><a href="#"><i class="icon-remove"></i></a></td>
          </tr>
              <tr>
            <td>Title comes here</td>
            <td>Auther</td>
            <td>Basic</td>
            <td><code>55</code></td>
            <td><a href="#"><i class="icon-remove"></i></a></td>
          </tr>
              <tr>
            <td>Title comes here</td>
            <td>Auther</td>
            <td>Bordered</td>
            <td><code>98</code></td>
            <td><a href="#"><i class="icon-remove"></i></a></td>
          </tr>
              <tr>
            <td>Title comes here</td>
            <td>Auther</td>
            <td>Zebra-stripe</td>
            <td><code>54</code></td>
            <td><a href="#"><i class="icon-remove"></i></a></td>
          </tr>
              <tr>
            <td>Title comes here</td>
            <td>Auther</td>
            <td>Condensed</td>
            <td><code>989</code></td>
            <td><a href="#"><i class="icon-remove"></i></a></td>
          </tr>
            </tbody>
      </table>
        </div>
    <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a> <a href="#" class="btn btn-primary">Check Out</a> </div>
  </div>
    </div>
<!-- /container --> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> 
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>')</script> 
<script src="js/libs/bootstrap/bootstrap.min.js"></script> 
<script src="js/script.js"></script> 
<script src="js/libs/bootstrap/modal.js"></script> 
<script type="text/javascript">
$('#mycart').click(function() {

$('#myModal').modal();
});
</script> 
<script>
	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
</body>
</html>
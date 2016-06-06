<!DOCTYPE html>
<?php require 'sessionInitForAdmin.php'; ?>
<html>
<head>
	<title>Capital Account System - Home</title>

	<style type="text/css">
		.error {color: #FF0000;}
	</style>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<!-- bootstrap -->
	<link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
	<link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
	<link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

	<!-- libraries -->
	<link href="css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
	<link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />

	<!-- global styles -->
	<link rel="stylesheet" type="text/css" href="css/layout.css" />
	<link rel="stylesheet" type="text/css" href="css/elements.css" />
	<link rel="stylesheet" type="text/css" href="css/icons.css" />

	<!-- this page specific styles -->
	<link rel="stylesheet" href="css/compiled/gallery.css" type="text/css" media="screen" />  

	<!-- open sans font -->
	<link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

	<!-- lato font -->
	<link href='http://fonts.useso.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

      <script src="js/jquery.min.js"></script>
      <script>
      	jQuery(document).ready(function($) {
      		<?php
      		if($_SERVER["REQUEST_METHOD"] == "POST"){
      			echo "$('.mypopup-mask').fadeIn(100);";
      			echo "$('.mypopup').slideDown(200);";
      		}
      		?>
      		$('#login').click(function(){
      			$('.mypopup-mask').fadeIn(100);
      			$('.mypopup').slideDown(200);
      		})
      		$('#open').click(function(){
      			window.location.href="openAccount.php";
      		})
      		$('#changepsd').click(function(){
      			window.location.href="modifypsd.php";
      		})
      		$('#reportloss').click(function(){
      			window.location.href="lossreport.php";
      		})
      		$('#cancel').click(function(){
      			window.location.href="cancel.php";
      		})
      		$('#deposit').click(function(){
      			window.location.href="deposit.php";
      		})
      		$('#withdraw').click(function(){
      			window.location.href="withdraw.php";
      		})
      		$('.close-pop').click(function(){
      			$('.mypopup-mask').fadeOut(100);
      			$('.mypopup').slideUp(200);
      		})

      	})
      </script>
  </head>
  <body>
  	<?php

  	$userError = $psdError = "";
  	$user = $psd = "";
  	$isUserLegal = false;
  	$isPsdLegal = false;

  	if(isset($_SESSION['user'])){
  		$user = $_SESSION['user'];
  		$psd = $_SESSION['psd'];
        //echo '<script> document.getElementById("currentAccount").innerHTML="Client: ' . $_SESSION["user"] . '"; </script>';
  	}

    //if the form is submitted
  	if ($_SERVER["REQUEST_METHOD"] == "POST") {
  		if (empty($_POST["user"])) {
  			$userError = "* You must fill in a user name. ";
  		} else {
  			$user = test_input($_POST["user"]);
            //check whether is consist of numbers
  			if (!preg_match("/^[0-9]*$/",$user)) {
  				$userError = "* Only numbers are allowed. "; 
  				$user = "";
  			}
  			else{
  				$isUserLegal = true;
  			}
  		}

  		if (empty($_POST["psd"])) {
  			$psdError = "* You must fill in a password. ";
  		} else {
  			$psd = test_input($_POST["psd"]);
            //check whether is consist of numbers
  			if (!preg_match("/^[0-9a-zA-Z_]*$/",$psd)) {
  				$psdError = "* Only numbers, characters and underline are allowed. "; 
  				$psd = "";
  			}
  			else{
  				$isPsdLegal = true;
  			}
  		}
  		if(!$isUserLegal){
  			$psd = "";
  		}
  		if($isUserLegal && $isPsdLegal){
  			if(checkUser($user, $psd)){
  				$_SESSION['user'] = $user;
  				$_SESSION['psd'] = $psd;
  				header("Location: index.php");
  			}
  			else{
  				$user = $psd = '';
  				echo '<script> alert("User or password is wrong! "); </script>';
  			}
  		}
  	}

  	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
  	}

  	function checkUser($user, $psd){
        require 'connectDatabase.php';
        $sql = "select caId, loginPassword from capitalaccount";

        $result = mysql_query($sql, $con);

        while($row = mysql_fetch_array($result)){
            if($row['caId'] == $user && $row['loginPassword'] == $psd){
                mysql_close($con);
                return ture;
            }
        }
        mysql_close($con);
        return false;
    }

    ?>
    <!-- navbar -->
    <!-- navbar -->
    <div class="navbar navbar-inverse">
    	<div class="navbar-inner">
    		<button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
    			<span class="icon-bar"></span>
    			<span class="icon-bar"></span>
    			<span class="icon-bar"></span>
    		</button>

    		<a class="brand" href="index.html"><img src="img/logo.png" /></a>

    		<ul class="nav pull-right">                


    			<li class="dropdown">
    				<a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown">
    					<?php echo 'Administrator: ' . $_SESSION['admin']; ?>
    					<b class="caret"></b>
    				</a>
    				<ul class="dropdown-menu">
    					<li><a href="myinfo.php">Personal info</a></li>
    					<li><a href="logout_adm.php">Exit</a></li>
    				</ul>
    			</li>
    		</ul>            
    	</div>
    </div>
    <!-- end navbar -->

    <!-- sidebar -->
    <div id="sidebar-nav">
    	<ul id="dashboard-menu">
    		<li class="active">
    			<div class="pointer">
    				<div class="arrow"></div>
    				<div class="arrow_border"></div>
    			</div>
    			<a href="index.php">
    				<i class="icon-home"></i>
    				<span>Homepage</span>
    			</a>
    		</li>            

    	</ul>
    </div>
    <!-- end sidebar -->


    <!-- main container -->
    <div class="content">
    	<!-- edit image pop up -->
    	<div class="mypopup">

    		<a href="javascript:;" class="close-pop">
    			<i class="table-delete"></i>
    		</a>
    		<h5>Login for Client</h5>
    		<!--form POST-->
    		<form action="index.php" method="POST">
    			<div class="field-box">
    				<label>ID</label>
    				<input type="text" name="user" placeholder="E-mail address" value="<?php echo $user;?>" /> 
    				<span class="error"><?php echo $userError;?></span>
    			</div>
    			<div class="field-box">
    				<label>Password</label>                         
    				<input type="password" name="psd" placeholder="Client's password" value="<?php echo $psd;?>"/> 
    				<span class="error"><?php echo $psdError;?></span>
    			</div>
    			<input class="button btn-flat primary login" type="submit" value="submit"/>
    		</form>


    	</div>
    	<!--popup end-->


    	<div class="container-fluid">
    		<div id="pad-wrapper" class="gallery">
    			<div class="row-fluid header">
    				<h3>Homepage</h3>
    				<br clear="left"/>
    				<br clear="left"/>
    				<h5 >
    					<?php
    					if(isset($_SESSION['user'])){
    						echo "Client: " . $_SESSION['user'];
    					}
    					else{
    						echo "Client: Unknown";
    					}
    					?>
    				</h5>&nbsp;<a href="logout_user.php">exit</a>                  
    			</div>
    			<!-- gallery wrapper -->
    			<div class="gallery-wrapper">
    				<div class="row gallery-row">
    					<!-- single image -->
    					<div class="span4 img-container">
    						<div class="img-box type1" id="login">
    							<img src="img/login-black.png" />                  
    						</div>
    						<div class="img-box type2" id="open">
    							<img src="img/register-black.png" />                  
    						</div>
    					</div>
    					<!-- single image -->
    					<div class="span4 img-container">
    						<div class="img-box type1" id="changepsd">
    							<img src="img/changepsd-black.png" />                  
    						</div>
    						<div class="img-box type2" id="reportloss">
    							<img src="img/reportloss-black.png" />                  
    						</div>
    						<div class="img-box type1" id="cancel">
    							<img src="img/cancel-black.png" />                  
    						</div>
    					</div>
    					<!-- single image -->
    					<div class="span4 img-container">
    						<div class="img-box type1" id="withdraw">
    							<img src="img/withdraw-black.png" />                  
    						</div>
    						<div class="img-box type1" id="deposit">
    							<img src="img/deposit-black.png" />                  
    						</div>
    					</div>



    				</div>
    			</div>


    		</div>

    	</div>
    </div>


    <!-- scripts -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <!-- knob -->
    <script src="js/jquery.knob.js"></script>

    <div class="mypopup-mask"></div>

</body>
</html>
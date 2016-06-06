
<!DOCTYPE html>
<?php
//start the session
session_start();
//set the life time of the session ti 20 minutes
$lifeTime = 1200;
setcookie(session_name(), session_id(), time() + $lifeTime, "/");
?>
<html class="login-bg">
<head>
	<title>Capital Account System - Log in</title>
    
    <style type="text/css">
    	.error {color: #FF0000;}
    </style>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="css/lib/font-awesome.css" />
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/signin.css" type="text/css" media="screen" />

    <!-- open sans font -->
    <link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
	<?php
	if(isset($_SESSION['admin'])){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }
        unset($_SESSION['admin']);
		echo '<script> alert("Log out success! "); </script>';
        header("Location: login.php");
	}
    else{
        echo '<script> alert("You haven\'t logged in! "); history.go(-1); </script>';
    }

	$userError = $psdError = "";
	$user = $psd = "";
	$isUserLegal = false;
	$isPsdLegal = false;

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
			if($user == '2012' && $psd == '2012'){
				$_SESSION['admin'] = $user;
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

	?>

    <!-- background switcher -->
    <div class="bg-switch visible-desktop">
        <div class="bgs">
            <a href="#" data-img="landscape.jpg" class="bg active">
                <img src="img/bgs/landscape.jpg" />
            </a>
            <a href="#" data-img="blueish.jpg" class="bg">
                <img src="img/bgs/blueish.jpg" />
            </a>            
            <a href="#" data-img="7.jpg" class="bg">
                <img src="img/bgs/7.jpg" />
            </a>
            <a href="#" data-img="8.jpg" class="bg">
                <img src="img/bgs/8.jpg" />
            </a>
            <a href="#" data-img="9.jpg" class="bg">
                <img src="img/bgs/9.jpg" />
            </a>
            <a href="#" data-img="10.jpg" class="bg">
                <img src="img/bgs/10.jpg" />
            </a>
            <a href="#" data-img="11.jpg" class="bg">
                <img src="img/bgs/11.jpg" />
            </a>
        </div>
    </div>


    <div class="row-fluid login-wrapper">
        <a href="index.php>
            <img class="logo" src="img/logo-white.png" />
        </a>


        <div class="span4 box">
            <div class="content-wrap">
                <h6>Log in</h6>
                
                <form action="login.php" method="POST">
                <input class="span12" type="text" name="user" placeholder="Administrator account" value="<?php echo $user;?>" />
                <span class="error"><?php echo $userError;?></span>
                <input class="span12" type="password" name="psd" placeholder="Your password" value="<?php echo $psd;?>"/>
                <span class="error"><?php echo $psdError;?></span>
                <a href="#" class="forgot">Forgot password?</a>
                <div class="remember">
                    <input id="remember-me" type="checkbox" />
                    <label for="remember-me">Remember me</label>
                </div>
                <input class="btn-glow primary login" type="submit" name="submit" value="Log in"/>
                </form>
                
            </div>
        </div>

        <div class="span4 no-account">
            <p>Don't have an account?</p>
            <a href="signup.html">Sign up</a>
        </div>
    </div>

	<!-- scripts -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/theme.js"></script>

    <!-- pre load bg imgs -->
    <script type="text/javascript">
        $(function () {
            // bg switcher
            var $btns = $(".bg-switch .bg");
            $btns.click(function (e) {
                e.preventDefault();
                $btns.removeClass("active");
                $(this).addClass("active");
                var bg = $(this).data("img");

                $("html").css("background-image", "url('img/bgs/" + bg + "')");
            });

        });
    </script>

</body>
</html>
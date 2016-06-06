
<!DOCTYPE html>
<?php require 'sessionInitForAdmin.php'; ?>
<html>
<head>
	<title>Capital Account System - Open an Account</title>
    
    <style type="text/css">
        .error {color: #FF0000;}
    </style>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="css/lib/bootstrap-wysihtml5.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/uniform.default.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/select2.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/bootstrap.datepicker.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/form-showcase.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/compiled/index.css" type="text/css" media="screen" />  

    <!-- open sans font -->
    <link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

    <?php
    
    $personId = $saId = $loginPassword = $loginPassword2 = $tradePassword = $tradePassword2 = $userName = $gender = $birthday = $country = $city = $telephone = "";

    $personIdError = $saIdError = $loginPasswordError = $loginPassword2Error = $tradePasswordError = $tradePassword2Error = $userNameError = $genderError = $birthdayError = $countryError = $cityError = $telephoneError = "";

    $isInputLegal = true;

    $birthday = "01/01/1990";
    $gender = "male";

    //if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //personId
        if(empty($_POST["personId"])){
            $personIdError = "* You must fill in an ID number";
            $isInputLegal = false;
        } else{
            $personId = test_input($_POST["personId"]);
            //check whether is consist of numbers
            if (!preg_match("/^[0-9]*$/",$personId)) {
                $personIdError = "* Only numbers are allowed. "; 
                $personId = "";
                $isInputLegal = false;
            }
            else{}
        }

        //saId
        if(empty($_POST["saId"])){
            $saIdError = "* You must fill in a security account ID";
            $isInputLegal = false;
        } else{
            $saId = test_input($_POST["saId"]);
            //check whether is consist of numbers
            if (!preg_match("/^[0-9]*$/",$saId)) {
                $saIdError = "* Only numbers are allowed. "; 
                $saId = "";
                $isInputLegal = false;
            }
            else{}
        }

        //loginPassword
        if(empty($_POST["loginPassword"])){
            $loginPasswordError = "* You must fill in a login password";
            $isInputLegal = false;
            $loginPassword2 = "";
        } else{
            $loginPassword = test_input($_POST["loginPassword"]);
            //check whether is consist of numbers
            if (!preg_match("/^[0-9a-zA-Z_]*$/",$loginPassword)) {
                $loginPasswordError = "* Only numbers, characters and underline are allowed. "; 
                $loginPassword = "";
                $isInputLegal = false;
                $loginPassword2 = "";
            }
            else{
                $loginPassword2 = test_input($_POST["loginPassword2"]);
                if($loginPassword2 != $loginPassword){
                    $loginPassword2Error = "The two input login passwords can't match. ";
                    $loginPassword = "";
                    $loginPassword2 = "";
                    $isInputLegal = false;
                }
                else{}
            }
        }

        //tradePassword
        if(empty($_POST["tradePassword"])){
            $tradePasswordError = "* You must fill in a trade password";
            $isInputLegal = false;
            $tradePassword2 = "";
        } else{
            $tradePassword = test_input($_POST["tradePassword"]);
            //check whether is consist of numbers
            if (!preg_match("/^[0-9a-zA-Z_]*$/",$tradePassword)) {
                $tradePasswordError = "* Only numbers, characters and underline are allowed. "; 
                $tradePassword = "";
                $isInputLegal = false;
                $tradePassword2 = "";
            }
            else{
                $tradePassword2 = test_input($_POST["tradePassword2"]);
                if($tradePassword2 != $tradePassword){
                    $tradePassword2Error = "The two input trade passwords can't match. ";
                    $tradePassword = "";
                    $tradePassword2 = "";
                    $isInputLegal = false;
                }
                else{}
            }
        }

        //userName
        $userName = test_input($_POST["userName"]);
        //gender
        $gender = test_input($_POST["gender"]);
        //birthday
        $birthday = test_input($_POST["birthday"]);
        //country
        $country = test_input($_POST["country"]);
        //city
        $city = test_input($_POST["city"]);

        //telephone
        $telephone = test_input($_POST["telephone"]);
        //check whether it is consist of numbers
        if (!preg_match("/^[0-9]*$/",$telephone)) {
            $telephoneError = "* Only numbers are allowed. "; 
            $telephone = "";
            $isInputLegal = false;
        }
        else{}
        
        //insert into the table
        if($isInputLegal){
            require 'connectDatabase.php';
            $recentDate = date("m/d/Y");
            $sql = "insert into capitalaccount(personId, saId, loginPassword, tradePassword, userName, gender, birthday, country, city, telephone, availableCapital, frozenCapital, nextYearInterest, recentDate) values($personId, $saId, '$loginPassword', '$tradePassword', '$userName', '$gender', '$birthday', '$country', '$city', '$telephone', 0.00, 0.00, 0.00, '$recentDate');";

            $result = mysql_query($sql, $con);

            if(!$result){
                die('Error: '.mysql_error());
            }

            echo '<script> alert("Success! Your capital account is ' . mysql_insert_id() . '"); </script>';

            mysql_close($con);
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>

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
            <li>
                <a href="index.php">
                    <i class="icon-home"></i>
                    <span>Homepage</span>
                </a>
            </li>            
            <li class="active">
            	<div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <a href="openAccount.php">
                    <i class="icon-credit-card"></i>
                    <span>Open Account</span>
                </a>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-signal"></i>
                    <span>Capital Business</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                	<li><a href="capitalinfo.php">Check Balance</a></li>
                    <li><a href="deposit.php">Deposit</a></li>
                    <li><a href="withdraw.php">Withdraw</a></li>
    
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-user"></i>
                    <span>Account Business</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li><a href="accountinfo.php">Account Info</a></li>
                    <li><a href="modifypsd.php">Change Password</a></li>
                    <li><a href="lossreport.php">Report loss</a></li>
                    <li><a href="cancel.php">Cancel</a></li>
                </ul>
            </li>
            <li>
                <a href="myinfo.php">
                    <i class="icon-cog"></i>
                    <span>My Info</span>
                </a>
            </li>
            
        </ul>
    </div>
    <!-- end sidebar -->


	<!-- main container -->
    <div class="content">
        

        <div class="container-fluid">
            <div id="pad-wrapper">
            
            	<div class="row-fluid header">
            		<h3>Open an Account</h3>
            		<br clear="left"/>
            		<br clear="left"/> 
            	</div>
                <div class="row-fluid form-page border-box">
                    <form action="openAccount.php" method="POST">
                    
                    <div class="span6 form-wrapper section"> 
                    	<h4>Account Info</h4>  
                    	<br clear="left"/>                 	
                            <div class="field-box">
                                <label>ID number:</label>
                                <input class="inline-input"  type="text" name="personId" value="<?php echo $personId;?>"/>
                                <span class="error"><?php echo $personIdError;?></span>
                            </div>                            
                            <div class="field-box">
                                <label>Security account ID:</label>
                                <input class="inline-input" type="text" name="saId" value="<?php echo $saId;?>"/>
                                <span class="error"><?php echo $saIdError;?></span>
                            </div>
                            <div class="field-box-narrow">
                                <label>Login password:</label>
                                <input class="inline-input" type="password" name="loginPassword" value="<?php echo $loginPassword;?>"/>
                                <span class="error"><?php echo $loginPasswordError;?></span>
                            </div>
                            <div class="field-box">
                                <label>Confirm:</label>
                                <input class="inline-input" type="password" name="loginPassword2" value="<?php echo $loginPassword2;?>"/>
                                <span class="error"><?php echo $loginPassword2Error;?></span>
                            </div>
                            <div class="field-box-narrow">
                                <label>Trade password:</label>
                                <input class="inline-input" type="password" name="tradePassword" value="<?php echo $tradePassword;?>"/>
                                <span class="error"><?php echo $tradePasswordError;?></span>
                            </div>
                            <div class="field-box">
                                <label>Confirm:</label>
                                <input class="inline-input" type="password" name="tradePassword2" value="<?php echo $tradePassword2;?>"/>
                                <span class="error"><?php echo $tradePassword2Error;?></span>
                            </div>
                       </div>
                       <div class="span6 form-wrapper section">
                       		<h4>Identity Info</h4>
                       		<br clear="left"/>
                            <div class="field-box">
                                <label>Name:</label>
                                <input class="inline-input" type="text" name="userName" value="<?php echo $userName;?>"/>
                            </div>
                            <div class="field-box">
                                <label>Gender:</label>
                                <div class="span6">
                                    <label class="radio">
                                        <input type="radio" name="gender" id="male" value="male" <?php if($gender == 'male') echo 'checked = ""'; ?> />
                                        Male
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="gender" id="female" value="female" <?php if($gender != 'male') echo 'checked = ""'; ?>/>
                                        Female
                                    </label>
                                </div>                                
                            </div>
                            <div class="field-box">
                                <label>Birthday:</label>
                                <input type="text" name="birthday" class="input-large datepicker"  value="<?php echo $birthday;?>"/>
                            </div>
                            <div class="field-box">
                                <label>Country:</label>
                                <input class="inline-input"  type="text" name="country" value="<?php echo $country;?>"/>
                            </div>
                            <div class="field-box">
                                <label>City:</label>
                                <input class="inline-input"  type="text" name="city" value="<?php echo $city;?>"/>
                            </div>
                            <div class="field-box">
                                <label>Telephone:</label>
                                <input class="inline-input"  type="text" name="telephone" value="<?php echo $telephone;?>"/>
                                <span class="error"><?php echo $telephoneError;?></span>
                            </div>
                                                 
                    </div>
                    <input class="button btn-flat primary" type="submit" value="submit"/> 
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- end main container -->
    
    	<!-- scripts for this page -->
    <script src="js/wysihtml5-0.3.0.js"></script>
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-wysihtml5-0.0.2.js"></script>
    <script src="js/bootstrap.datepicker.js"></script>
    <script src="js/jquery.uniform.min.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/theme.js"></script>
	
	<!-- call this page plugins -->
    <script type="text/javascript">
        $(function () {

            // add uniform plugin styles to html elements
            $("input:checkbox, input:radio").uniform();

           // datepicker plugin
            $('.datepicker').datepicker().on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });
        });
    </script>


</body>
</html>
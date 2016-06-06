
<!DOCTYPE html>
<?php require 'sessionInitForAdmin.php'; ?>
<?php require 'sessionInitForUser.php'; ?>
<html>
<head>
	<title>Capital Account System - Withdraw</title>
    
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
    <link rel="stylesheet" href="css/compiled/form-showcase.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/compiled/index.css" type="text/css" media="screen" />  

    <!-- open sans font -->
    <link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!-- lato font -->
    <link href='http://fonts.useso.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

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
            <li>
                <a href="openAccount.php">
                    <i class="icon-credit-card"></i>
                    <span>Open Account</span>
                </a>
            </li>
            <li class="active">
            	<div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-signal"></i>
                    <span>Capital Business</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="active submenu">
                	<li><a href="capitalinfo.php">Check Balance</a></li>
                    <li><a href="deposit.php">Deposit</a></li>
                    <li><a class="active" href="withdraw.php">Withdraw</a></li>
    
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
            		<h3>Withdraw</h3>
            		<br clear="left"/>
            		<br clear="left"/>
                    <h5>
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
            	<div class="row-fluid form-page border-box section">
            		<div  class="span6 bio">
                		<div class="form-wrapper">
                    
                        <form action="" method="POST"/>
                            <div class="field-box">
                                <label>Withdraw amount:</label>
                                <input class="span6" type="number" name="amt"/>
                            </div>
                            <div class="field-box-narrow">
                                <label>Withdrawal password:</label>
                                <input class="span6 inline-input" type="password" name="withdrawPsd"/>
                            </div>
                            
                            <input class="button btn-flat primary" type="submit" value="submit"/> 
                        </form>

						</div>
					</div>
			
					<div class="span6 infobox">
						<br />
						<label>Banlance:</label>
						<p>100,000</p>
					</div>				
				</div>		
			
			</div>
    </div>
   </div>

    	<!-- scripts for this page -->
    <script src="js/wysihtml5-0.3.0.js"></script>
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-wysihtml5-0.0.2.js"></script>
    <script src="js/bootstrap.datepicker.js"></script>
    <script src="js/jquery.uniform.min.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/theme.js"></script>

</body>
</html>

<!DOCTYPE html>
<?php require 'sessionInitForAdmin.php'; ?>
<?php require 'sessionInitForUser.php'; ?>
<html>
<head>
	<title>Capital Account System - Check Balance</title>
    
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
    <link rel="stylesheet" href="css/compiled/index.css" type="text/css" media="screen" /> 
    <link rel="stylesheet" href="css/compiled/form-showcase.css" type="text/css" media="screen" />   

    <!-- open sans font -->
    <link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!-- lato font -->
    <link href='http://fonts.useso.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
    <?php
    require 'create_capital_record.php';
    createCapitalRecord(2, -240.00, 200.00);
    // createCapitalRecord(2, 300.00, 690.00);
    // createCapitalRecord(2, -90.00, 600.00);
    // createCapitalRecord(2, -100.00, 500.00);
    // createCapitalRecord(2, -400.00, 100.00);
    // createCapitalRecord(2, 130.00, 130.00);
    // createCapitalRecord(2, 100.00, 230.00);
    // createCapitalRecord(2, 100.00, 330.00);
    // createCapitalRecord(2, 100.00, 430.00);
    // createCapitalRecord(2, 100.00, 530.00);
    // createCapitalRecord(2, 100.00, 630.00);
    // createCapitalRecord(2, 100.00, 730.00);
    // createCapitalRecord(2, -400.00, 330.00);
    

    // createCapitalRecord(2, 20.00, 120.00);
    // createCapitalRecord(2, -30.00, 90.00);
    require 'connectDatabase.php';
    $sql = "select * from capitalrecord where caId = " . $_SESSION['user'] . " order by useTime;";

    $result = mysql_query($sql, $con);

    $totalRecordNumber = mysql_num_rows($result);
    $skipRecordNumber = 0;
    if($totalRecordNumber > 12){
        $skipRecordNumber = $totalRecordNumber - 12;
    }

    $realityShowNumber = $totalRecordNumber - $skipRecordNumber;
    
    // echo "<script> alert('return " . $totalRecordNumber . " lines! ') </script>";
    //each item of the result
    $i = 0;
    $useTime = array();
    $amount = array();
    $remainedCapital = array();
    while($row = mysql_fetch_array($result)){
        if($i >= $skipRecordNumber){
            // echo "<script> alert('amount: " . $row['amount'] . "') </script>";
                $useTime[] = $row['useTime'];
                $amount[] = $row['amount'];
                $remainedCapital[] = $row['remainedCapital'];
        }
        $i = $i + 1;
    }
    // echo "<script> alert('remainedCapital: " . $remainedCapital[1] . "') </script>";
    $useTime2 = array();
    $amount2 = array();
    $remainedCapital2 = array();

    for($i = 0; $i < 12 - $realityShowNumber; $i++){
        $useTime2[] = '--';
        $amount2[] = 0.00;
        $remainedCapital2[] = 0.00;
    }
    for($i = 12 - $realityShowNumber; $i < 12; $i++){
        $useTime2[] = $useTime[$i - 12 + $realityShowNumber];
        $amount2[] = $amount[$i - 12 + $realityShowNumber];
        $remainedCapital2[] = $remainedCapital[$i - 12 + $realityShowNumber];
    }
    // echo "<script> alert('remainedCapital2-8: " . $remainedCapital2[8] . "') </script>";
    // echo "<script> alert('remainedCapital2-9: " . $remainedCapital2[9] . "') </script>";
    // echo "<script> alert('remainedCapital2-10: " . $remainedCapital2[10] . "') </script>";
    

    // echo "<script> alert('remainedCapital2-11: " . $remainedCapital2[11] . "') </script>";
    // echo "<script> alert('useTime2: " . $useTime2[0] . "') </script>";
    mysql_close($con);
    
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
                	<li><a class="active" href="capitalinfo.php">Check Balance</a></li>
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
					<h3>Check Balance</h3>
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
                <!-- jQuery flot chart -->
                <div class="row-fluid border-box section">
                    <h4 class="title">
                        Balance Flot <small>recent</small>
                        <div class="btn-group pull-right">
                            <button class="glow left">DAY</button>
                            <button class="glow middle active">MONTH</button>
                            <button class="glow right">YEAR</button>
                        </div>
                    </h4>
                    <div class="span12">
                        <div id="statsChart"></div>
                    </div>
                </div>

                <!-- end table sample -->
            </div>
        </div>
    </div>


	<!-- scripts -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <!-- knob -->
    <script src="js/jquery.knob.js"></script>
    <!-- flot charts -->
    <script src="js/jquery.flot.js"></script>
    <script src="js/jquery.flot.stack.js"></script>
    <script src="js/jquery.flot.resize.js"></script>
    <script src="js/theme.js"></script>


    <script type="text/javascript">
        $(function () {

            // jQuery Knobs
            $(".knob").knob();



            // jQuery UI Sliders
            $(".slider-sample1").slider({
                value: 100,
                min: 1,
                max: 500
            });
            $(".slider-sample2").slider({
                range: "min",
                value: 130,
                min: 1,
                max: 500
            });
            $(".slider-sample3").slider({
                range: true,
                min: 0,
                max: 500,
                values: [ 40, 170 ],
            });

            

            // jQuery Flot Chart
            var visits = [
                [1, <?php echo $amount2[0]; ?>], 
                [2, <?php echo $amount2[1]; ?>], 
                [3, <?php echo $amount2[2]; ?>], 
                [4, <?php echo $amount2[3]; ?>],
                [5, <?php echo $amount2[4]; ?>], 
                [6, <?php echo $amount2[5]; ?>], 
                [7, <?php echo $amount2[6]; ?>], 
                [8, <?php echo $amount2[7]; ?>], 
                [9, <?php echo $amount2[8]; ?>], 
                [10, <?php echo $amount2[9]; ?>], 
                [11, <?php echo $amount2[10]; ?>], 
                [12, <?php echo $amount2[11]; ?>]                
            ];
            var visitors = [
                [1, <?php echo $remainedCapital2[0] - $amount2[0]; ?>], 
                [2, <?php echo $remainedCapital2[1] - $amount2[1]; ?>], 
                [3, <?php echo $remainedCapital2[2] - $amount2[2]; ?>], 
                [4, <?php echo $remainedCapital2[3] - $amount2[3]; ?>], 
                [5, <?php echo $remainedCapital2[4] - $amount2[4]; ?>], 
                [6, <?php echo $remainedCapital2[5] - $amount2[5]; ?>], 
                [7, <?php echo $remainedCapital2[6] - $amount2[6]; ?>], 
                [8, <?php echo $remainedCapital2[7] - $amount2[7]; ?>], 
                [9, <?php echo $remainedCapital2[8] - $amount2[8]; ?>], 
                [10, <?php echo $remainedCapital2[9] - $amount2[9]; ?>], 
                [11, <?php echo $remainedCapital2[10] - $amount2[10]; ?>], 
                [12, <?php echo $remainedCapital2[11] - $amount2[11]; ?>] 
            ];

            // var visits = [
            //     <?php
            //     for($i = 0; $i < $realityShowNumber - 1; $i++){
            //         echo '[' . $i + 1 . ', ' . $amount[$i] . '], ';
            //     }
            //     echo '[' . $i + 1 . ', ' . $amount[$i] . ']';
            //     ?>
            // ];

            // var visitors = [
            //     <?php
            //     for($i = 0; $i < $realityShowNumber - 1; $i++){
            //         echo '[' . $i + 1 . ', ' . $remainedCapital[$i] . '], ';
            //     }
            //     echo '[' . $i + 1 . ', ' . $remainedCapital[$i] . ']';
            //     ?>
            // ];

            var plot = $.plot($("#statsChart"),
                [ { data: visits, label: "Trade volume"},
                 { data: visitors, label: "Balance" }], {
                    series: {
                        lines: { show: true,
                                lineWidth: 1,
                                fill: true, 
                                fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
                             },
                        points: { show: true, 
                                 lineWidth: 2,
                                 radius: 3
                             },
                        shadowSize: 0,
                        stack: true
                    },
                    grid: { hoverable: true, 
                           clickable: true, 
                           tickColor: "#f9f9f9",
                           borderWidth: 0
                        },
                    legend: {
                            // show: false
                            labelBoxBorderColor: "#fff"
                        },  
                    colors: ["#a7b5c5", "#30a0eb"],
                    xaxis: {
                        ticks: [
                            [1, "<?php echo $useTime2[0]; ?>"], 
                            [2, "<?php echo $useTime2[1]; ?>"], 
                            [3, "<?php echo $useTime2[2]; ?>"], 
                            [4, "<?php echo $useTime2[3]; ?>"], 
                            [5, "<?php echo $useTime2[4]; ?>"], 
                            [6, "<?php echo $useTime2[5]; ?>"], 
                            [7, "<?php echo $useTime2[6]; ?>"], 
                            [8, "<?php echo $useTime2[7]; ?>"], 
                            [9, "<?php echo $useTime2[8]; ?>"], 
                            [10, "<?php echo $useTime2[9]; ?>"], 
                            [11, "<?php echo $useTime2[10]; ?>"], 
                            [12, "<?php echo $useTime2[11]; ?>"]
                        ],
                        font: {
                            size: 4,
                            family: "Open Sans, Arial",
                            variant: "small-caps",
                            color: "#697695"
                        }
                    },
                    yaxis: {
                        ticks:3, 
                        tickDecimals: 0,
                        font: {size:12, color: "#9da3a9"}
                    }
                 });

            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css( {
                    position: 'absolute',
                    display: 'none',
                    top: y - 30,
                    left: x - 50,
                    color: "#fff",
                    padding: '2px 5px',
                    'border-radius': '6px',
                    'background-color': '#000',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            }

            var previousPoint = null;
            $("#statsChart").bind("plothover", function (event, pos, item) {
                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(0),
                            y = item.datapoint[1].toFixed(0);

                        var month = item.series.xaxis.ticks[item.dataIndex].label;

                        showTooltip(item.pageX, item.pageY,
                                    item.series.label + " of " + month + ": " + y);
                    }
                }
                else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        });
    </script>

</body>
</html>
<?php
 
$servername="ec2-54-235-159-101.compute-1.amazonaws.com";
$username="igckulttqkjpln";
$password="90e213f98c62973288b645896a5a21d4cf7b3df1dc407c32f8c701365665ed80";
$dbname="ddmo6qc3dqkuii";
$conn= pg_connect("host=$servername port=5432 dbname=$dbname user=$username password=$password") or die("Database connectivity error");


// A/B test

$query="select  count(*) as total from stats where filled='yes'";
$result=pg_query($conn,$query);
$total=pg_fetch_assoc($result)['total'];

$query="select count(*) as total from stats where version_no=1";
 $result=pg_query($conn,$query);
$v1=pg_fetch_assoc($result)['total'];
$v1=$v1/$total;

$query="select count(*) as total from stats where version_no=2";
 $result=pg_query($conn,$query);
$v2=pg_fetch_assoc($result)['total'];
$v2=$v2/$total;


$query="select count(*) as total from stats where version_no=3";
 $result=pg_query($conn,$query);
$v3=pg_fetch_assoc($result)['total'];
$v3=$v3/$total;


// Epsilon Greedy

$query="select  count(*) as total from user_info where filled='yes'";
$result=pg_query($conn,$query);
$total=pg_fetch_assoc($result)['total'];

$query="select count(*) as total from user_info where version_no=1";
 $result=pg_query($conn,$query);
$v11=pg_fetch_assoc($result)['total'];
$v11=$v11/$total;

$query="select count(*) as total from user_info where version_no=2";
 $result=pg_query($conn,$query);
$v22=pg_fetch_assoc($result)['total'];
$v22=$v22/$total;


$query="select count(*) as total from user_info where version_no=3";
 $result=pg_query($conn,$query);
$v33=pg_fetch_assoc($result)['total'];
$v33=$v33/$total;

/// UCB

$query="select  count(*) as total from ucbstats where filled='yes'";
$result=pg_query($conn,$query);
$total=pg_fetch_assoc($result)['total'];

$query="select count(*) as total from ucbstats where version_no=1";
 $result=pg_query($conn,$query);
$v111=pg_fetch_assoc($result)['total'];
$v111=$v111/$total;

$query="select count(*) as total from ucbstats where version_no=2";
 $result=pg_query($conn,$query);
$v222=pg_fetch_assoc($result)['total'];
$v222=$v222/$total;


$query="select count(*) as total from ucbstats where version_no=3";
 $result=pg_query($conn,$query);
$v333=pg_fetch_assoc($result)['total'];
$v333=$v333/$total;





$dataPoints = array(

	array("label"=> "Form 1", "y"=> $v1*100),
	array("label"=> "Form 2", "y"=> $v2*100),
	array("label"=> "Form 3", "y"=> $v3*100),
	
);

$dataPoints1 = array(

	array("label"=> "Form 1", "y"=> $v11*100),
	array("label"=> "Form 2", "y"=> $v22*100),
	array("label"=> "Form 3", "y"=> $v33*100),
	
);

$dataPoints2 = array(

	array("label"=> "Form 1", "y"=> $v111*100),
	array("label"=> "Form 2", "y"=> $v222*100),
	array("label"=> "Form 3", "y"=> $v333*100),
	
);

	
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <script>
		window.onload = function () {
		 
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			exportEnabled: true,
			title:{
				text: "Percentage of forms in A/B test"
			},
			subtitles: [{
				text: "Percentage of each form (%)"
			}],
			data: [{
				type: "pie",
				showInLegend: "true",
				legendText: "{label}",
				indexLabelFontSize: 16,
				indexLabel: "{label} - #percent%",
				yValueFormatString: "฿#,##0",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();

		var chart1 = new CanvasJS.Chart("chartContainer1", {
			animationEnabled: true,
			exportEnabled: true,
			title:{
				text: "Percentage of forms in Epsilon Greedy test"
			},
			subtitles: [{
				text: "Percentage of each form (%)"
			}],
			data: [{
				type: "pie",
				showInLegend: "true",
				legendText: "{label}",
				indexLabelFontSize: 16,
				indexLabel: "{label} - #percent%",
				yValueFormatString: "฿#,##0",
				dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart1.render();
		

        var chart2 = new CanvasJS.Chart("chartContainer2", {
			animationEnabled: true,
			exportEnabled: true,
			title:{
				text: "Percentage of forms in Upper Confidence Bound"
			},
			subtitles: [{
				text: "Percentage of each form (%)"
			}],
			data: [{
				type: "pie",
				showInLegend: "true",
				legendText: "{label}",
				indexLabelFontSize: 16,
				indexLabel: "{label} - #percent%",
				yValueFormatString: "฿#,##0",
				dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart2.render();
		 
        
		}
	</script>

</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><h6>Web Form<br>Optimization</h6></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    
                </div>

                
            </div>

        </header><!-- /header -->
        <!-- Header-->
 			
 		<div id="chartContainer" style="height: 370px; width: 100%;"></div>

 		<br><br><br><br>

		<div id="chartContainer1" style="height: 370px; width: 100%;"></div>

		<br><br><br><br>

		<div id="chartContainer2" style="height: 370px; width: 100%;"></div>


		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
       
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

</body>

</html>

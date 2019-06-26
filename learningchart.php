<?php

$servername="ec2-54-235-159-101.compute-1.amazonaws.com";
$username="igckulttqkjpln";
$password="90e213f98c62973288b645896a5a21d4cf7b3df1dc407c32f8c701365665ed80";
$dbname="ddmo6qc3dqkuii";
$conn= pg_connect("host=$servername port=5432 dbname=$dbname user=$username password=$password") or die("Database connectivity error");

$query="select version_no,sum(score::decimal)/count(version_no) as avg from stats where filled='yes' group by version_no";
$result=pg_query($conn,$query);
while($row=pg_fetch_assoc($result))
   //print_r($row);
echo "<br>";


$query="select version_no,score from stats where filled='yes' order by submitted_at";
$result=pg_query($conn,$query);
$no=pg_num_rows($result);
$count=1;
$array=array();
$array[1]=array();
$array[2]=array();
$array[3]=array();

$n=3;
$row=pg_fetch_assoc($result);
for($x=1;$x<=$n;$x++)
    {   
         $version= $row['version_no'];
        if($version!=$x)
        {  
          
                $array[$x][$count]=0;
        }
        else
        {
                $array[$x][$count]=$row['score'];
            
        }    
    }
$count+=1;
$n=3;
while($row=pg_fetch_assoc($result))
{   
    $version= $row['version_no'];
    
    for($x=1;$x<=$n;$x++)
    {   
        if($version!=$x)
        {  

                $array[$x][$count]=$array[$x][$count-1];
        }
        else
        {
           
                $value=$array[$version][$count-1] ;
                $array[$version][$count]=   $value+$row['score'];     
        }    
    }    
     $count=$count+1;    
}
$perform_array=array();
$perform_array[1]=array();
$perform_array[2]=array();
$perform_array[3]=array();
for($i=1;$i<=$n;$i++)
{
  //  print_r($array[$i]);
    //print("<br><br>");
    $subarray=$array[$i];
    for($j=1;$j<=sizeof($array[$i]);$j++)
    {
        $newarray=array("x"=>$j, "y"=>($array[$i][$j]/(2*$j)*100));
        //$perform_array[$i][$j]['y']=$j;
        //$perform_array[$i][$j]['label']=($array[$i][$j]/$j)*100;
        array_push($perform_array[$i],$newarray);
    }    
}

for($i=1;$i<=$n;$i++)
{
  //  print_r($perform_array[$i]);
  //  print("<br><br>");      
}        
    
    
$datapoints1=$perform_array[1];    
$datapoints2=$perform_array[2];
$datapoints3=$perform_array[3];
 

 //print_r($dataPoints);




$query="select version_no,score from user_info where filled='yes' order by created_at";
$result=pg_query($conn,$query);
$no=pg_num_rows($result);
$count=1;
$array=array();
$array[1]=array();
$array[2]=array();
$array[3]=array();

$n=3;
$row=pg_fetch_assoc($result);
for($x=1;$x<=$n;$x++)
    {   
         $version= $row['version_no'];
        if($version!=$x)
        {  
          
                $array[$x][$count]=0;
        }
        else
        {
                $array[$x][$count]=$row['score'];
            
        }    
    }
$count+=1;
$n=3;
while($row=pg_fetch_assoc($result))
{   
    $version= $row['version_no'];
    
    for($x=1;$x<=$n;$x++)
    {   
        if($version!=$x)
        {  

                $array[$x][$count]=$array[$x][$count-1];
        }
        else
        {
           
                $value=$array[$version][$count-1] ;
                $array[$version][$count]=   $value+$row['score'];     
        }    
    }    
     $count=$count+1;    
}
$perform_array=array();
$perform_array[1]=array();
$perform_array[2]=array();
$perform_array[3]=array();
for($i=1;$i<=$n;$i++)
{
  //  print_r($array[$i]);
    //print("<br><br>");
    $subarray=$array[$i];
    for($j=1;$j<=sizeof($array[$i]);$j++)
    {
        $newarray=array("x"=>$j,"y"=>($array[$i][$j]/(2*$j))*100);
        //$perform_array[$i][$j]['y']=$j;
        //$perform_array[$i][$j]['label']=($array[$i][$j]/$j)*100;
        array_push($perform_array[$i],$newarray);
    }    
}

for($i=1;$i<=$n;$i++)
{
  //  print_r($perform_array[$i]);
  //  print("<br><br>");      
}        
    
    
$datapoints11=$perform_array[1];    
$datapoints22=$perform_array[2];
$datapoints33=$perform_array[3];


$query="select version_no,score from ucbstats where filled='yes' order by user_no";
$result=pg_query($conn,$query);
$no=pg_num_rows($result);
$count=1;
$array=array();
$array[1]=array();
$array[2]=array();
$array[3]=array();

$n=3;
$row=pg_fetch_assoc($result);
for($x=1;$x<=$n;$x++)
    {   
         $version= $row['version_no'];
        if($version!=$x)
        {  
          
                $array[$x][$count]=0;
        }
        else
        {
                $array[$x][$count]=$row['score'];
            
        }    
    }
$count+=1;
$n=3;
while($row=pg_fetch_assoc($result))
{   
    $version= $row['version_no'];
    
    for($x=1;$x<=$n;$x++)
    {   
        if($version!=$x)
        {  

                $array[$x][$count]=$array[$x][$count-1];
        }
        else
        {
           
                $value=$array[$version][$count-1] ;
                $array[$version][$count]=   $value+$row['score'];     
        }    
    }    
     $count=$count+1;    
}
$perform_array=array();
$perform_array[1]=array();
$perform_array[2]=array();
$perform_array[3]=array();
for($i=1;$i<=$n;$i++)
{
    //print_r($array[$i]);
    //print("<br><br>");
    $subarray=$array[$i];
    for($j=1;$j<=sizeof($array[$i]);$j++)
    {
        $newarray=array("x"=>$j,"y"=>($array[$i][$j]/(2*$j))*100);
        //$perform_array[$i][$j]['y']=$j;
        //$perform_array[$i][$j]['label']=($array[$i][$j]/$j)*100;
        array_push($perform_array[$i],$newarray);
    }    
}

for($i=1;$i<=$n;$i++)
{
  //  print_r($perform_array[$i]);
  //  print("<br><br>");      
}        
    
    
$datapoints211=$perform_array[1];    
$datapoints222=$perform_array[2];
$datapoints233=$perform_array[3];
 
 
 
?>

<!doctype html>
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
        theme: "light2",
	title: {
		text: "Performance curve of A/B test"
	},
	axisY: {
		title: "Performance (%) "
	},
    axisX: {
		title: "No. of users "
	},
   
	data: [{
		type: "line",
        name: "Form 1",
        showInLegend: true,
		dataPoints: <?php echo json_encode($datapoints1, JSON_NUMERIC_CHECK); ?>
	},
    {
		type: "line",
        name: "Form 2",
        showInLegend: true,
		dataPoints: <?php echo json_encode($datapoints2, JSON_NUMERIC_CHECK); ?>
	},
    
    {
		type: "line",
        name: "Form 3",
        showInLegend: true,
		dataPoints: <?php echo json_encode($datapoints3, JSON_NUMERIC_CHECK); ?>
	}
    
    ]
});
chart.render();
  
 
 
var chart1 = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        theme: "light2",
	title: {
		text: "Performance curve of Adaptive Epsilon Greedy test"
	},
	axisY: {
		title: "Performance (%) "
	},
    axisX: {
		title: "No. of users "
	},
   
	data: [{
		type: "line",
        name: "Form 1",
        showInLegend: true,
		dataPoints: <?php echo json_encode($datapoints11, JSON_NUMERIC_CHECK); ?>
	},
    {
		type: "line",
        name: "Form 2",
        showInLegend: true,
		dataPoints: <?php echo json_encode($datapoints22, JSON_NUMERIC_CHECK); ?>
	},
    
    {
		type: "line",
        name: "Form 3",
        showInLegend: true,
		dataPoints: <?php echo json_encode($datapoints33, JSON_NUMERIC_CHECK); ?>
	}
    
    ]
});
chart1.render();
  
 
 
var chart2 = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        theme: "light2",
	title: {
		text: "Performance curve of UCB Algorithm"
	},
	axisY: {
		title: "Performance (%) "
	},
    axisX: {
		title: "No. of users "
	},
   
	data: [{
		type: "line",
        name: "Form 1",
        showInLegend: true,
		dataPoints: <?php echo json_encode($datapoints211, JSON_NUMERIC_CHECK); ?>
	},
    {
		type: "line",
        name: "Form 2",
        showInLegend: true,
		dataPoints: <?php echo json_encode($datapoints222, JSON_NUMERIC_CHECK); ?>
	},
    
    {
		type: "line",
        name: "Form 3",
        showInLegend: true,
		dataPoints: <?php echo json_encode($datapoints233, JSON_NUMERIC_CHECK); ?>
	}
    
    ]
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
 			
 		<div id="chartContainer"  style="margin: 0 auto;height: 370px;width:70%;"></div>

 		<br><br><br><br>

		<div id="chartContainer1" style="margin: 0 auto;height: 370px; width: 70%;"></div>

		<br><br><br><br>

		<div id="chartContainer2" style="margin: 0 auto;height: 370px; width: 70%;"></div>

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
<?php
/*
for($i=1;$i<=$n;$i++)
{
    print_r($perform_array[$i]);
    print("<br><br>");      
} 
*/ 

?>
</body>

</html>

<?php
include("BLL/PipelineMetricsGraphicalOverviewBLL.php");
include("passwords.php");
//check_logged(); /// function checks if visitor is logged.If user is not logged the user is redirected to login.php page 


$sector = $_GET['sector'];
$metrics = $_GET['metrics'];
$sector_ID= $_GET['sectorid'];
$top25 = $_GET['top25'];
$company=$_GET['company'];

//function to fetch cumulative monthly tcv,wtcv and sold data  for graph
list($array_37_wtcv,$array_37_tcv,$array_47_wtcv,$array_47_tcv,$bookings,$sold_row_count) = monthly_wtcv_tcv_graph_data_BLL($company,$sector);

//Bar graph data for yearly wtcv graph plot for stage 3-7 & 4-7 & total sold
list($ytd_wtcv37_value,$ytd_wtcv47_value,$ytd_sold_value) = ytd_wtcv_graph_data_BLL($company,$sector); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>CapgeminiAMS</title>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/stylesheets/master.css" />
<link rel="apple-touch-startup-image" href="./logo.png">
<script src="assets/javascripts/jquery.js"></script>
<script src="assets/javascripts/master.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/highcharts.js"></script>
<script type="text/javascript">

(function($){ // encapsulate jQuery

var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'chartHolder1',
			type: 'column'
		},
		title: {
			text: '<?php if($company == "") {echo "All companies";}    else {echo $company;} 
                                     if($sector ==  "") {echo " - Full Pipeline";} else {echo " - ".$sector;};?>'
		},
		subtitle: {
			text: 'Monthly Total of W.TCV based on Stage'
		},
		xAxis: {
			categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
			title: {
				text: '2013'
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: "WTCV (in 000's USD)"
				//align: 'high'                               
			}
		},
		tooltip: {
			formatter: function() {
				return ''+
					this.series.name +': '+ this.y +" (000's) USD";
			}
		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				}
			}
		},
		legend: {
			layout: 'horizontal',
			align: 'right',
			verticalAlign: 'top',
			x: -250,
			y:  35,
			floating: true,
			borderWidth: 1,
			backgroundColor: '#FFFFFF',
			shadow: true
                        
                        
		},
		credits: {
			enabled: false
		},
			series: [  
                {       name: 'Sold',
			data: [<?php for($i=0; $i < 12 ; $i++)
                                echo ($ytd_sold_value[$i]).",";?>]			
               },
               {       name: '4-7 WTCV',
			data: [<?php for($i=0; $i < 12 ; $i++)
                                echo ($ytd_wtcv47_value[$i]).",";?>]
			
		},
               {       name: '3-7 WTCV',
			data: [<?php for($i=0; $i < 12 ; $i++)
                                echo ($ytd_wtcv37_value[$i]).",";?>]
			
		},
                {       name: 'Sold + 4-7 WTCV',
			data: [<?php for($i=0; $i < 12 ; $i++)
                                echo ($ytd_sold_value[$i] + $ytd_wtcv47_value[$i]).",";?>]
			
		}, 
                {       name: 'Sold + 3-7 WTCV',
			data: [<?php for($i=0; $i < 12 ; $i++)
                                echo ($ytd_sold_value[$i] + $ytd_wtcv37_value[$i]).",";?>]			
		},
                
                               
             ]
	});
});

})(jQuery);

(function($){ // encapsulate jQuery


var chart;
$(document).ready(function() {
 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'chartHolder2',
			type: 'area' //added for area chart by Souvik
		},
		title: {
			text: '<?php if($company == "") {echo "All companies";}    else {echo $company;} 
                                     if($sector ==  "") {echo " - Full Pipeline";} else {echo " - ".$sector;};?>'
		},
		subtitle: {
			text: 'Cumulative Total of W.TCV/TCV based on Stage'
		},
		xAxis: {
			categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
			title: {
				text: '2013'
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: "WTCV / TCV (in 000's USD)"
			}
		},
		tooltip: {
			formatter: function() {
				return ''+
					this.series.name +': '+ this.y +" (000's) USD";
			}
		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				}
			}
		},
		legend: {
			layout: 'horizontal',
			align: 'center',
			verticalAlign: 'bottom',
			x: 30,
			y: 10,
			floating: true,
			borderWidth: 1,
			backgroundColor: '#FFFFFF',
			shadow: true,
                        reversed: true
		},
		credits: {
			enabled: false
		},
			series: [
                            
                 
                {       name: 'Sold + 3-7 TCV',
                        visible:false,  //added for disabling series on default page load by Souvik
			data: [<?php 
                        for($i=0; $i < 12 ; $i++)
                                echo $array_37_tcv[$i].",";
                        ?>
                        ]
			
		}                
            ,   {       name: 'Sold + 4-7 TCV',
                        visible:false,  //added for disabling series on default page load by Souvik
			data: [<?php 
                            for($i=0; $i < 12 ; $i++)
                                echo $array_47_tcv[$i].",";
                        ?>]
			
		},
                {       name: 'Sold + 3-7 WTCV',
			visible:false,  //added for disabling series on default page load by Souvik
			data: [<?php 
                        for($i=0; $i < 12 ; $i++)
                                echo $array_37_wtcv[$i].",";
                        ?>
                        ]
			
		}                
            ,
                {       name: 'Sold + 4-7 WTCV',				        
			data: [<?php 
                            for($i=0; $i < 12 ; $i++)
                                echo $array_47_wtcv[$i].",";
                        ?>]
			
		},
                
                {       name: 'Sold',
			data: [<?php 
                                for($i=0; $i < date("n") ; $i++) //n->current month
                                echo $bookings[$i].",";
                                
                            ?>
                        ]
		}
           ]
	});
});

})(jQuery);

</script>   
</head>
<body>

<div id="main" >
	<div class="abs header_upper chrome_dark">
                <span class="float_left button" id="button_navigation">
			Company Name
		</span>
		<a onclick="location.href='./PipelineMetricsUI.php?metrics=<?php echo $metrics;?>&sector=<?php echo $sector;?>&sectorid=<?php echo $sector_ID;?>&top25=<?php echo $top25;?>'" class="float_left button">
			Back
		</a>		
		<a onclick="location.href='./logout.php'" class="float_right button">
			Sign out
		</a>
		Graphical Overview 
	</div>
	
	<div id="main_content" class="abs">
		<div id="main_content_inner">			
			<!--
			<h1>
				Main Content
			</h1>
			-->
			<div id="chartHolder1"  style="top:0;position:absolute; width: 90%; height: 50%">
                            
			</div>
                        <div id="chartHolder2"  style="bottom:0;position:absolute; width: 90%; height: 50%">
                            
			</div>		
		</div>
	</div>
	
</div>
</body>
</html>

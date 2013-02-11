<?php


include("passwords.php");
//check_logged(); /// function checks if visitor is logged.If user is not logged the user is redirected to login.php page 
setcookie("last_page","graph_pipe.php", time()+3600, '/');

$ini_array = parse_ini_file("Config.ini");
 
$dbhost = $ini_array['host'];
$dbuser = $ini_array['user'];
$dbpass = $ini_array['password'];
				
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = $ini_array['database'];
mysql_select_db($dbname , $conn)or die("Could not select database");

$result37 = mysql_query ("select sum(wtcv),sum(tcv),companyname from pipelinemetrics where year(month)=2012 group by month(month)",$conn);
$graph_row_count37 =  mysql_num_rows($result37) or die("display_db_query:" . mysql_error());
$column_count = mysql_num_fields($result37) or die("display_db_query:" . mysql_error());

$rowcount=0;
$column_no=0;
while($row = mysql_fetch_array($result37))
				{
					
						$graphArray37_wtcv[$column_no]= $row[0];
                                                $graphArray37_tcv[$column_no]= $row[1];                                                
                                                $column_no++;
					
					
				}

$result47 = mysql_query ("select sum(wtcv),sum(tcv),companyname from pipelinemetrics where year(month)=2012 and stage>=4 group by month(month)",$conn);
$graph_row_count47 =  mysql_num_rows($result47) or die("display_db_query:" . mysql_error());
$column_count = mysql_num_fields($result47) or die("display_db_query:" . mysql_error());

$rowcount=0;
$column_no=0;
while($row = mysql_fetch_array($result47))
				{
					
						$graphArray47_wtcv[$column_no]= $row[0];
                                                $graphArray47_tcv[$column_no]= $row[1];
                                                $column_no++;
					
					
				}      
                                
$total_bookings = mysql_query ("SELECT sum(total_bookings) FROM sales group by month(sold_month)",$conn);
$total_bookings_row_count =  mysql_num_rows($total_bookings) or die("display_db_query:" . mysql_error());
$column_count = mysql_num_fields($total_bookings) or die("display_db_query:" . mysql_error());

$rowcount=0;
$column_no=0;
while($row = mysql_fetch_array($total_bookings))
				{
					
						$graph_total_bookings[$column_no]= $row[0];
                                                $column_no++;
					
					
				}                                

$sector = $_GET['sector'];
$metrics = $_GET['metrics'];
$sector_ID= $_GET['sectorid'];
$mnt= $_GET ['mnt'];
$flag = $_GET['flag'];


$total_wtcv37 = mysql_query ("select sum(wtcv) from pipelinemetrics where year(month)=2012 ",$conn);
while($row = mysql_fetch_array($total_wtcv37))   { $total_wtcv37_value = $row[0]; }
  
$total_wtcv47 = mysql_query ("select sum(wtcv) from pipelinemetrics where year(month)=2012 and stage>=4 ",$conn);
while($row = mysql_fetch_array($total_wtcv47))   { $total_wtcv47_value = $row[0]; }

$total_sold = mysql_query ("select sum(total_bookings) from sales where year(sold_month)=2012",$conn);
while($row = mysql_fetch_array($total_sold))   { $total_sold_value = $row[0]; }

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


<?php 
                        $cumulative_sum = 0;
                        for($i=0; $i<$total_bookings_row_count ; $i++)
                        {
                            $cumulative_sum = $cumulative_sum + $graph_total_bookings[$i];                            
                            $bookings[$i]=$cumulative_sum/1000;                            
                            }
                            for(; $i< 12 ; $i++)
                            $bookings[$i] = $bookings[$i-1];
                            
                            
                            
                            
                        for($i=0; $i < $total_bookings_row_count ; $i++)                                            
                        {
                            $array_37_wtcv[$i]= $bookings[$i];
                            $array_37_tcv[$i]= $bookings[$i];
                        }
                        
                        $cumulative_sum_wtcv = 0;$cumulative_sum_tcv = 0;
                        for($i=$total_bookings_row_count; $i<12 ; $i++)
                        {
                            $cumulative_sum_wtcv = $cumulative_sum_wtcv + $graphArray37_wtcv[$i-$total_bookings_row_count];
                            $display = ($cumulative_sum_wtcv/1000) + $bookings[$i];
                            $array_37_wtcv[$i] = $display;
                            
                            $cumulative_sum_tcv = $cumulative_sum_tcv + $graphArray37_tcv[$i-$total_bookings_row_count];
                            $display = ($cumulative_sum_tcv/1000) + $bookings[$i];
                            $array_37_tcv[$i] = $display;
                        } 
                        
                        
                        
                        
                        
                        for($i=0; $i < $total_bookings_row_count ; $i++)                                            
                        
                        {
                            $array_47_wtcv[$i] = $bookings[$i];
                            $array_47_tcv[$i] = $bookings[$i];
                        }
                        
                       $cumulative_sum_wtcv = 0;$cumulative_sum_tcv = 0;
                       for($i=$total_bookings_row_count; $i<12 ; $i++)
                       {
                           $cumulative_sum_wtcv = $cumulative_sum_wtcv + $graphArray47_wtcv[$i-$total_bookings_row_count];
                           $display = ($cumulative_sum_wtcv/1000) + $bookings[$i];                       
                           $array_47_wtcv[$i] = $display;
                           
                           $cumulative_sum_tcv = $cumulative_sum_tcv + $graphArray47_tcv[$i-$total_bookings_row_count];
                           $display = ($cumulative_sum_tcv/1000) + $bookings[$i];                       
                           $array_47_tcv[$i] = $display;
                       } 
                        
                            
                            
                            
              ?>

<script type="text/javascript">

(function($){ // encapsulate jQuery

var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'chartHolder1',
			type: 'bar'
		},
		title: {
			text: 'Pipeline Metrics'
		},
		subtitle: {
			text: 'Cumulative Total of W.TCV based on Stage'
		},
		xAxis: {
			categories: [''],
			title: {
				text: '2012'
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
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: 0,
			y: 0,
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
                            
                {       name: 'Stage 4-7 WTCV + Sold',
			data: [<?php echo ($total_sold_value+$total_wtcv47_value);?>]
			
		},
                 {       name: 'Stage 3-7 WTCV + Sold',
			data: [<?php echo ($total_sold_value+$total_wtcv37_value);?>]
			
		},
                 {       name: 'Stage 4-7 WTCV',
			data: [<?php echo ($total_wtcv47_value);?>]
			
		},
                            
                {
                        name: 'Stage 3-7 WTCV',
			data: [<?php echo ($total_wtcv37_value);?>]			
		}
                
               
           
            ]
	});
});

})(jQuery);
</script>




<script type="text/javascript">

(function($){ // encapsulate jQuery

var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'chartHolder2',
			type: 'line'
		},
		title: {
			text: 'Pipeline Metrics'
		},
		subtitle: {
			text: 'Cumulative Total of W.TCV/TCV based on Stage'
		},
		xAxis: {
			categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
			title: {
				text: '2012'
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: "WTCV / TCV (in 000's USD)"
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
			align: 'center',
			verticalAlign: 'top',
			x: 0,
			y: 35,
			floating: true,
			borderWidth: 1,
			backgroundColor: '#FFFFFF',
			shadow: true
		},
		credits: {
			enabled: false
		},
			series: [
                            
                 {       name: 'Stage 3-7 WTCV + Sold',
			data: [<?php 
                        for($i=0; $i < 12 ; $i++)
                                echo $array_37_wtcv[$i].",";
                        ?>
                        ]
			
		}
                
            ,
                {       name: 'Stage 3-7 TCV + Sold',
			data: [<?php 
                        for($i=0; $i < 12 ; $i++)
                                echo $array_37_tcv[$i].",";
                        ?>
                        ]
			
		}
                
            ,
                {       name: 'Stage 4-7 WTCV + Sold',
			data: [<?php 
                            for($i=0; $i < 12 ; $i++)
                                echo $array_47_wtcv[$i].",";
                        ?>]
			
		},
                {       name: 'Stage 4-7 TCV + Sold',
			data: [<?php 
                            for($i=0; $i < 12 ; $i++)
                                echo $array_47_tcv[$i].",";
                        ?>]
			
		},
                {       name: 'Sold',
			data: [<?php 
                                for($i=0; $i < $total_bookings_row_count ; $i++)
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
    <?php 
                                echo "<script type='text/javascript'>\n";
                                echo "$(document).ready(function() {graph(42,".$row_count.");});\n";
                                echo "</script>\n";
        ?>

<div id="main" >
	<div class="abs header_upper chrome_dark">
                <span class="float_left button" id="button_navigation">
			Company Name
		</span>
		<a onclick="location.href='./AMSpipeline.php?metrics=<?php echo $metrics;?>&sector=<?php echo $sector;?>&sectorid=<?php echo $sector_ID;?>&mnt=<?php echo $mnt;?>&flag=<?php echo $flag?>'" class="float_left button">
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
	<div class="abs footer_lower chrome_dark">
		
	</div>
</div>

</body>
</html>

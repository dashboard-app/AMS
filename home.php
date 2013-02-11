<?php
session_start(); /// initialize session
include("passwords.php");
//check_logged(); /// function checks if visitor is logged.If user is not logged the user is redirected to login.php page 
setcookie("last_page","home.php", time()+3600, '/');
$yr = 0;
if(isset($_GET['yr'])) {$yr = $_GET['yr'];}

//Get dates for FM, OM and PM from 'dateFile.txt'
$filename = "./dateFile.txt";
$lines = file($filename);

$fmDate = $lines[0];
$omDate = $lines[1];
$pmDate = $lines[2];
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

// To find the latest month of data
<?php 
$ini_array = parse_ini_file("Config.ini");
$dbhost = $ini_array['host'];
$dbuser = $ini_array['user'];
$dbpass = $ini_array['password'];

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = $ini_array['database'];
mysql_select_db($dbname , $conn) or die("Could not select database");


//Latest month for AM companies 2012
$month_name = array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
$month_array = array('01','02','03','04','05','06','07','08','09','10','11','12');
$break ='n';
for($i=0;($i<12 && $break == 'n');$i++)
{
$result_2012 = mysql_query("SELECT sum(`$month_name[$i]-A`) from fmbookings",$conn); 

while($row = mysql_fetch_array($result_2012))
    {
        if($row[0] == 0)
        {
            $mnt_name_2012 = $month_name[$i-1];
            $mnt_fm_am_2012 = $month_array[$i-1];
            $break = 'y';
        }
    }
}

//Latest month for AM companies 2013
$break ='n';
for($i=0;($i<12 && $break == 'n');$i++)
{
$result_2013 = mysql_query("SELECT sum(`$month_name[$i]-A`) from fmbookings_2013",$conn); 

while($row = mysql_fetch_array($result_2013))
    {
        if($row[0] == 0)
        {
            $mnt_name_2013 = $month_name[$i-1];
            $mnt_fm_am_2013 = $month_array[$i-1];
            $break = 'y';
        }
    }
}

?>
<script>
    <?php 
        echo "var mnt_fm_am_2012 = $mnt_fm_am_2012;\n";
        echo "var mnt_name_2012 = '$mnt_name_2012';\n"; 
        echo "var mnt_fm_am_2013 = $mnt_fm_am_2013;\n";
        echo "var mnt_name_2013 = '$mnt_name_2013';\n"; 
        
    ?>
    //var d = new Date();                
    //var mnt = d.getMonth() - 2;
    var flag = 'A';
</script>



<?php
//Latest month for TS companies 2012 data
$query = mysql_query("SELECT distinct month(month) as mnt FROM fm_ts order by month");
while($row = mysql_fetch_array($query))
{
  $mnt_fm_ts_2012 = $row[0];
}

//Latest month for TS companies 2013 data
$query = mysql_query("SELECT distinct month(month) as mnt FROM fm_ts_2013 order by month");
while($row = mysql_fetch_array($query))
{
  $mnt_fm_ts_2013 = $row[0];
}
?>

<script>
    <?php 
        echo "var mnt_fm_ts_2012 = $mnt_fm_ts_2012;\n";
        echo "var mnt_fm_ts_2013 = $mnt_fm_ts_2013;\n";
     ?>
</script>


<?php
//Latest month for operationalmetrics
$query = mysql_query("SELECT distinct month(month) FROM operationalmetrics order by month");
while($row = mysql_fetch_array($query))
{
  $mnt_op_am =   $row[0];
}
?>

<script>
    <?php echo "var mnt_op_am = $mnt_op_am;\n";
     ?>
</script>



<?php
//Latest month for pipelinemetrics
$query = mysql_query("SELECT distinct month(sold_month) FROM sales");
while($row = mysql_fetch_array($query))
{
  $mnt_pm =   $row[0];
}
?>

<script>
    <?php echo "var mnt_pm = $mnt_pm;\n";
     ?>
</script>




    
</head>
<body style="text-align:center;">

<div id="main">
	<div class="abs header_upper chrome_dark">
		<img src = "./assets/images/Cap-Logo.png" style="height:40px" align="left">
		
		<a onclick="location.href='./logout.php'" class="float_right button">               
			Sign out
		</a>
		Capgemini NA Dashboard
	</div>

	<div id="main_content" class="abs">       
                
                <div id="main_content_inner" >
			<h1 align="center" style="display:inline;">
                            <select onchange="updateYr()" class="yearpicker" name="yearpicker" id="yearpicker" style="position:absolute;left: 40px;font-size:22px;font-weight:bold;">
                                <option value="2013" >2013</option>
                                <option value="2012" >2012</option>
                            </select>
                            <span style="font-size:22px;font-weight:bold;">Financial Metrics – <?php echo $fmDate;?></span> <br/> 
                            <span style="font-size:18px;font-style:italic;">Source: Finance </span>
			</h1>
			 <table style="margin-left:1%;border:0px; width:97%; height:33%"  class="data">
			
				<tr style="width:99%; height:11%">
						<td style="width:33.3%;height:11%"><button onclick="location.href='./FinancialMetricsTop25UI.php?metrics=f&sector=&sectorid=6&mnt='+mnt_fm_ts+'&flag='+flag+'&yr='+yr" class="button" style="width:100%; height:100%"><span style="font-size:20px">Top 25</span></button></td>
						<td style="width:33.3%;height:11%"><button onclick="location.href='./FinancialMetricsAmUI.php?metrics=f&sector=AM&sectorid=10&mnt='+mnt_name+'&flag='+flag+'&company=&category=Revenue'+'&yr='+yr" class="button"style="width:100%; height:100%"><span style="font-size:20px">AM</span></button></td>
						<td style="width:33.3%;height:11%"><button onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=East&sectorid=3&mnt='+mnt_fm_ts+'&flag='+flag+'&yr='+yr" class="button"style="width:100%; height:100%"><span style="font-size:20px">East</span></button></td>
						
				</tr>
				<tr style="background: #ffffff;width:100%; height:11%">
						<td style="width:11%;height:11%"><button onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=West&sectorid=3&mnt='+mnt_fm_ts+'&flag='+flag+'&yr='+yr" class="button" style="width:100%; height:100%"><span style="font-size:20px">West</span></button></td>
						<td style="width:11%;height:11%"><button onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=Canada&sectorid=4&mnt='+mnt_fm_ts+'&flag='+flag+'&yr='+yr" class="button" style="width:100%; height:100%"><span style="font-size:20px">Canada</span></button></td>
						<td style="width:11%;height:11%"><button onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=Communications&sectorid=5&mnt='+mnt_fm_ts+'&flag='+flag+'&yr='+yr" class="button" style="width:100%; height:100%"><span style="font-size:20px">Communication</span></button></td>

				</tr>
				<tr style="width:100%; height:11%">
					<!--	<td style="width:11%;height:11%""><button onclick="location.href='./FinancialMetricsAmUI.php?metrics=f&sector=Commercial&sectorid=11'" class="button" style="width:100%; height:100%"><span style="font-size:20px">Communication</span></button></td>-->
						<td style="width:11%;height:11%"><button onclick="alert('Data not available');" class="button" style="width:100%; height:100%"><span style="font-size:20px">Government</span></button></td>
						<td style="width:11%;height:11%"><button onclick="location.href='./settings.php'" class="button" style="width:100%; height:100%"><span style="font-size:20px">Settings</span></button></td>
				</tr>
				
			
			</table>			

			<!-- Oper -->
			<div  id="main_content_inner1" style="bottom:0%">
			<h1 align="center" style="display:inline;">                            
                            <span style="font-size:22px;font-weight:bold;">Operational Metrics - <?php echo $omDate;?></span> <br/>
                            <span style="font-size:18px;font-style:italic;">Source: Finance </span>
			</h1>
			
			<table style="margin-left:1%;border:0px; width:97%; height:33%"  class="data">
			
				<tr style="width:99%; height:11%">
						<td style="width:33.3%;height:11%"><button onclick="alert('Data not available');" class="button" style="width:100%; height:100%"><span style="font-size:20px">Top 25</span></button></td>
						<td style="width:33.3%;height:11%"><button onclick="location.href='./OperationalMetricsAmUI.php?metrics=op&sector=AM&sectorid=14&mnt='+mnt_op_am" class="button"style="width:100%; height:100%"><span style="font-size:20px">AM</span></button></td>
						<td style="width:33.3%;height:11%"><button onclick="alert('Data not available');" class="button"style="width:100%; height:100%"><span style="font-size:20px">East</span></button></td>

				</tr>
				<tr style="background: #ffffff;width:100%; height:11%">
						<td style="width:11%;height:11%"><button onclick="alert('Data not available');" class="button" style="width:100%; height:100%"><span style="font-size:20px">West</span></button></td>
						<td style="width:11%;height:11%"><button onclick="alert('Data not available');" class="button" style="width:100%; height:100%"><span style="font-size:20px">Canada</span></button></td>
						<td style="width:11%;height:11%"><button onclick="alert('Data not available');" class="button" style="width:100%; height:100%"><span style="font-size:20px">Communication</span></button></td>

				</tr>
				<tr style="width:100%; height:11%">
						<!--<td style="width:11%;height:11%""><button onclick="alert('Data not available');" class="button" style="width:100%; height:100%"><span style="font-size:20px">Communication</span></button></td>-->
						<td style="width:11%;height:11%""><button onclick="alert('Data not available');" class="button" style="width:100%; height:100%"><span style="font-size:20px">Government</span></button></td>
						<td style="width:11%;height:11%""><button onclick="location.href='./settings.php'" class="button" style="width:100%; height:100%"><span style="font-size:20px">Settings</span></button></td>
				</tr>
                        </table>
                        </div>
                        <!-- Pipeline section -->    
                        <div  id="main_content_inner2" style="bottom:0%">
			<h1 align="center" style="display:inline;">
                            <span style="font-size:22px;font-weight:bold;">Pipeline Metrics – <?php echo $pmDate;?></span>  <br/> 
                            <span style="font-size:18px;font-style:italic;">Source: Spade </span>
			</h1>
			<table style="margin-left:1%;border:0px; width:97%; height:33%"  class="data">
			
				<tr style="width:100%; height:11%">
						<td style="width:11%;height:11%"><button onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=&sectorid=22&top25='" class="button" style="width:100%; height:100%"><span style="font-size:20px">Full Pipeline</span></button></td>
						<td style="width:11%;height:11%"><button onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=AM&sectorid=22&top25='" class="button"style="width:100%; height:100%"><span style="font-size:20px">AM</span></button></td>
						<td style="width:11%;height:11%"><button onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=East&sectorid=22&top25='" class="button"style="width:100%; height:100%"><span style="font-size:20px">East</span></button></td>

				</tr>
				<tr style="background: #ffffff;width:100%; height:11%">
						<td style="width:11%;height:11%"><button onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=West&sectorid=22&top25='" class="button" style="width:100%; height:100%"><span style="font-size:20px">West</span></button></td>
						<td style="width:11%;height:11%"><button onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=Canada&sectorid=22&top25='" class="button" style="width:100%; height:100%"><span style="font-size:20px">Canada</span></button></td>
						<td style="width:11%;height:11%"><button onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=Communication&sectorid=22&top25='" class="button" style="width:100%; height:100%"><span style="font-size:20px">Communication</span></button></td>

				</tr>
				<tr style="width:100%; height:11%">
						<td style="width:11%;height:11%"><button onclick="alert('Data not available');" class="button" style="width:100%; height:100%"><span style="font-size:20px">Government</span></button></td>
                                                <td style="width:11%;height:11%"><button onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=&sectorid=22&top25=y'" class="button" style="width:100%; height:100%"><span style="font-size:20px">Top 25</span></button></td>
						<td style="width:11%;height:11%"><button onclick="location.href='./settings.php'" class="button" style="width:100%; height:100%"><span style="font-size:20px">Settings</span></button></td>
				</tr>
                        </table>
                        </div>
                </div>
        </div>

</body>

<script>

var yr = 0;
var e = document.getElementById("yearpicker");
if(<?php echo $yr;?> == 2013 || <?php echo $yr;?> == 0)
{
    yr = 2013;
    e.selectedIndex = 0;
}
else 
{
    yr = e.options[e.selectedIndex].text;
    e.selectedIndex = 1;
}

if (yr == 2012 ) {mnt_fm_ts = mnt_fm_ts_2012;mnt_name = mnt_name_2012;}
else if (yr == 2013) {mnt_fm_ts = mnt_fm_ts_2013;mnt_name = mnt_name_2013;}

function updateYr() {
yr = e.options[e.selectedIndex].text;
//changing the value of months for whcih data is available according to the 2013 table
if (yr == 2012 ) {mnt_fm_ts = mnt_fm_ts_2012;mnt_name = mnt_name_2012;}
else if (yr == 2013) {mnt_fm_ts = mnt_fm_ts_2013;mnt_name = mnt_name_2013;}
}
</script>

</html>
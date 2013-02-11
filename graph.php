<?php
/* comment */
$sector = $_GET['sector'];
$metrics = $_GET['metrics'];
$sector_ID= $_GET['sectorid'];
$mnt= $_GET ['mnt'];
$flag = $_GET['flag'];

$ini_array = parse_ini_file("Config.ini");
include("passwords.php");
//check_logged(); /// function checks if visitor is logged.If user is not logged the user is redirected to login.php page 
setcookie("last_page","graph.php", time()+3600, '/');

				$dbhost = $ini_array['host'];
				$dbuser = $ini_array['user'];
				$dbpass = $ini_array['password'];


		$flag1='A';		
    		$flag2='F';
    		$flag3='B';	
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = $ini_array['database'];

mysql_select_db($dbname , $conn)or die("Could not select database");
$query="select companyname,`JAN-A`,`FEB-A`,`MAR-A`,`APR-A`,`MAY-A`,`JUN-A`,`JUL-A`,`AUG-A`,`SEP-A`,`OCT-A`,`NOV-A`,`DEC-A`,`JAN-F`,`FEB-F`,`MAR-F`,`APR-F`,`MAY-F`,`JUN-F`,`JUL-F`,`AUG-F`,`SEP-F`,`OCT-F`,`NOV-F`,`DEC-F`,`JAN-B`,`FEB-B`,`MAR-B`,`APR-B`,`MAY-B`,`JUN-B`,`JUL-B`,`AUG-B`,`SEP-B`,`OCT-B`,`NOV-B`,`DEC-B` from fmrevenue where SECTOR='".$sector."' order by companyname asc";

$result = mysql_query ($query,$conn);
$row_count =  mysql_num_rows($result) or die("display_db_query:" . mysql_error());
$column_count = mysql_num_fields($result) or die("display_db_query:" . mysql_error());
 
  
$company = mysql_query ("select companyname,`JAN-A`,`FEB-A`,`MAR-A`,`APR-A`,`MAY-A`,`JUN-A`,`JUL-A`,`AUG-A`,`SEP-A`,`OCT-A`,`NOV-A`,`DEC-A`,`JAN-F`,`FEB-F`,`MAR-F`,`APR-F`,`MAY-F`,`JUN-F`,`JUL-F`,`AUG-F`,`SEP-F`,`OCT-F`,`NOV-F`,`DEC-F`,`JAN-B`,`FEB-B`,`MAR-B`,`APR-B`,`MAY-B`,`JUN-B`,`JUL-B`,`AUG-B`,`SEP-B`,`OCT-B`,`NOV-B`,`DEC-B` from fmrevenue where SECTOR='".$sector."'",$conn);
$company_count =  mysql_num_rows($company) or die("display_db_query23:" . mysql_error());
 
//Grand Total Data
$actuals_gt     = mysql_query("select SUM(`JAN-A`),SUM(`FEB-A`),SUM(`MAR-A`),SUM(`APR-A`),SUM(`MAY-A`),SUM(`JUN-A`),SUM(`JUL-A`),SUM(`AUG-A`),SUM(`SEP-A`),SUM(`OCT-A`),SUM(`NOV-A`),SUM(`DEC-A`) from fmrevenue where SECTOR='".$sector."'",$conn);
$actuals_gt_colcount = mysql_num_fields($actuals_gt) or die("display_db_query4:" . mysql_error());
$actuals_gt_rowcount=  mysql_num_rows($actuals_gt) or die("display_db_query5:" . mysql_error());

$resultForecast = mysql_query("select SUM(`JAN-F`),SUM(`FEB-F`),SUM(`MAR-F`),SUM(`APR-F`),SUM(`MAY-F`),SUM(`JUN-F`),SUM(`JUL-F`),SUM(`AUG-F`),SUM(`SEP-F`),SUM(`OCT-F`),SUM(`NOV-F`),SUM(`DEC-F`) from fmrevenue where SECTOR='".$sector."'",$conn);
$for_colcount = mysql_num_fields($resultForecast) or die("display_db_query6:" . mysql_error());
$for_rowcount=  mysql_num_rows($resultForecast)	or die("display_db_query7:" . mysql_error());

$resultTarget= mysql_query("select SUM(`JAN-B`),SUM(`FEB-B`),SUM(`MAR-B`),SUM(`APR-B`),SUM(`MAY-B`),SUM(`JUN-B`),SUM(`JUL-B`),SUM(`AUG-B`),SUM(`SEP-B`),SUM(`OCT-B`),SUM(`NOV-B`),SUM(`DEC-B`) from fmrevenue where SECTOR='".$sector."'",$conn);
$targ_colcount = mysql_num_fields($resultTarget) or die("display_db_query8:" . mysql_error());
$targ_rowcount=  mysql_num_rows($resultTarget)	or die("display_db_query9:" . mysql_error());
?> 



<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>capgeminiams</title>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/stylesheets/master.css" />
<link rel="apple-touch-startup-image" href="./logo.png">
<!--[if IE 8]>
<link rel="stylesheet" href="assets/stylesheets/ie8.css" />
<![endif]-->
<!--[if !IE]><!-->
<!--<script src="assets/javascripts/iscroll.js"></script> -->
<!--<![endif]-->
<script src="assets/javascripts/jquery.js"></script>
<script src="assets/javascripts/master.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/highcharts.js"></script>

<?php

echo "<script type='text/javascript'>\n"; 
echo "var act_itemArray = new Array(".$actuals_gt_rowcount.");\n"; 
echo "for (i=0; i <".$actuals_gt_rowcount."; i++)\n"; 
echo "act_itemArray[i]=new Array(".$actuals_gt_rowcount.");\n"; 

$act_rcount=0;
while($row = mysql_fetch_array($actuals_gt))
{				 
    for($column_no = 0; $column_no < $actuals_gt_colcount; $column_no++) 
    {
	echo "act_itemArray[".$act_rcount."][".$column_no."]= '".$row[$column_no]."';\n";
    }
    $act_rcount++;
}
echo "</script>\n";                                
?>

<?php
echo "<script type='text/javascript'>\n"; 
				echo "var for_itemArray = new Array(".$for_rowcount.");\n"; 
				echo "for (i=0; i <".$for_rowcount."; i++)\n"; 
				echo "for_itemArray[i]=new Array(".$for_rowcount.");\n"; 

				 $for_rcount=0;
				while($row = mysql_fetch_array($resultForecast))
				{
				 
					for($column_no = 0; $column_no < $for_colcount; $column_no++) 
					{
						echo "for_itemArray[".$for_rcount."][".$column_no."]= '".$row[$column_no]."';\n";
					}
					 $for_rcount++;
				}
				echo "</script>\n";
?>                                

<?php
echo "<script type='text/javascript'>\n"; 
				echo "var targ_itemArray = new Array(".$targ_rowcount.");\n"; 
				echo "for (i=0; i <".$targ_rowcount."; i++)\n"; 
				echo "targ_itemArray[i]=new Array(".$targ_rowcount.");\n"; 

				 $targ_rcount=0;
				while($row = mysql_fetch_array($resultTarget))
				{
				 
					for($column_no = 0; $column_no < $targ_colcount; $column_no++) 
					{
						echo "targ_itemArray[".$targ_rcount."][".$column_no."]= '".$row[$column_no]."';\n";
					}
					 $targ_rcount++;
				}
				echo "</script>\n";

?>
<?php
echo "<script type='text/javascript'>\n"; 
	echo "var itemArray = new Array(".$row_count.");\n"; 
	echo "for (i=0; i <". $row_count."; i++)\n"; 
	echo "itemArray[i]=new Array(".$row_count.");\n"; 

	$rowcount=0;
	while($row = mysql_fetch_array($result))
	{
            for($column_no = 0; $column_no < $column_count; $column_no++) 
            {
		echo "itemArray[".$rowcount."][".$column_no."]= \"".$row[$column_no]."\";\n";
                
            }
	$rowcount++;
	}
$rcount_c=$row_count;
echo "</script>\n";
?>

<?php
echo "<script type='text/javascript'>\n"; 
	echo "var company_list = new Array(".$company_count.");\n"; 
	echo "for (i=0; i <".$company_count."; i++)\n"; 
	echo "company_list[i]=new Array(".$company_count.");\n"; 

	$rowcount=0;
	while($row = mysql_fetch_array($company))
	{
            for($column_no = 0; $column_no < 2; $column_no++) 
            {
		echo "company_list[".$rowcount."][".$column_no."]= '".$row[$column_no]."';\n";
                
            }
	$rowcount++;
	}

echo "</script>\n";
?>

<script>
var items_Categories = new Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
var options;
var items_series = new Array('Actuals','Forcast','Budget');
var items_Actuals = new Array();
var items_Forcast = new Array();
var items_Target = new Array();
var company_list = new Array();
var act=0;
var targ=0;
var act_for=0;
</script>

<script>
    
    function gt_click(colnum)
			{
				ClearOptions();
			 
				for (var cat = 0; cat < 12; cat++)
				options.xAxis.categories.push(items_Categories[cat]); 
				
				options.title.text = "GRAND TOTAL"; 
				options.yAxis.title.text = "$"; 
					switch(colnum)
					{
						case 0:	 
							   {
							   
                                                           options.subtitle.text = "REVENUE"; 
							   break;
							   }
						case 1:
							   {
							  options.subtitle.text = "BOOKINGS"; 
								break;
								}
						case 2:
							   {
							   options.subtitle.text = "CM$";
							   break;						 
							   }
						case 3:
							   {
							  	options.subtitle.text = "CM%";
								options.yAxis.title.text = "%"; 
							   break;
							   } 			
						
					}
				 
				//options.xAxis.title.text = "2012"; 
				
				  
				for(var ser=0;ser<items_series.length;ser++)
				{				
					   var series = {
						              data: []
						             }; 
					   series.name = items_series[ser];  
					   if(ser==0)
						 {
                                                    
						 for(var i=0;i<12;i++)
						{
						  series.data.push(parseFloat(act_itemArray[0][i]));                                      
                                                
                                               }
                                                
                                                	
                                                    
                                                    
						 }
					    else  if(ser==1)
						 { 
						   //for(var i=0;i<act_itemArray.length;i++)
						   //series.data.push(null);
                                                   
						   for(var i=0;i<12;i++)
                           {
						   series.data.push(parseFloat(for_itemArray[0][i]));
                           }
						 }  
                                            else  if(ser==2)
						 { 
							for(var i=0;i<12;i++)
							{//alert(targ_itemArray[i][colnum]);
                              series.data.push(parseFloat(targ_itemArray[0][i]));
                                                           
                                                           }
						 }  
					  options.series.push(series); 
				  }
			      var chart = new Highcharts.Chart(options);
 
		    }
    
    
    function graph(name,rows)
    {
         
     var jrow=1;
     items_Actuals=[];
	 items_Forcast=[];
	 items_Target=[];
       act=0;fo=0;targ=0;
        for (var row = 0; row < 39; row++)
	    {  
	       
			// alert(itemArray[row][0]);
              
                    if(itemArray[row][0]==name)
                    {	     
                                    while(jrow<13)
                                    {
                                        items_Actuals[act]= itemArray[row][jrow];
                                         act++;
                                         jrow++;
                                     }
                                     while(jrow>12 && jrow<25)
                                      {
                                         items_Forcast[fo]= itemArray[row][jrow];
                                         fo++;
                                         jrow++;
                                      }
                                     while(jrow>24 && jrow < 37)
                                     {
                                         items_Target[targ]= itemArray[row][jrow];
                                         targ++;
                                         jrow++;
                                     }
                                    break;
                     }
                 		 				
			} 
              
        ClearOptions();
      
        for (var cat = 0; cat < 12; cat++)
	options.xAxis.categories.push(items_Categories[cat]);
         options.title.text = itemArray[row][0];
       for (var row = 0; row < rows; row++)   
        {
            if (itemArray[row][0]== name) 
                {
                    options.title.text = itemArray[row][0];
                    break;
                }
                
        }
             
	options.subtitle.text = "REVENUE";
        options.yAxis.title.text = "$"; 
        for(var ser=0;ser<items_series.length;ser++)
	{				
            var series = {
				  data: []
				}; 
			 series.name = items_series[ser];  
				if(ser==0)
				 {
			 
					for(var i=0;i<12;i++)
                    {                                        
					series.data.push(parseFloat(items_Actuals[i]));
                      
                    }
                                       
				} 
				else if(ser==1)
				 { 
					 
					for(var i=0;i<12;i++)
					series.data.push(parseFloat(items_Forcast[i]));
				 }
				 else if(ser==2)
				 { 
					for(var i=0;i<12;i++)
					series.data.push(parseFloat(items_Target[i]));
				 } 
             options.series.push(series);
		   
        }
       
		var chart = new Highcharts.Chart(options);
        
    }
</script>

<script>
function  ClearOptions()
	{
		 options = {
			chart: {
				renderTo: 'chartHolder',
				defaultSeriesType: 'bar'
			},
			title: {
				text: ''
			},
			subtitle: {
					text: '',
					x: 0
			},
			xAxis: {
				categories: [],
				title: {
					text: ''
				}
			},
			yAxis: {
				title: {
					text: ''
				}
			},
			series: []
		};
	}
 </script>

</head>
<body onLoad="gt_click(0);">
    <?php 
                                echo "<script type='text/javascript'>\n";
                                echo "$(document).ready(function() {graph(42,".$row_count.");});\n";
                                echo "</script>\n";
        ?>

<div id="main" class="abs">
	<div class="abs header_upper chrome_dark">
                <span class="float_left button" id="button_navigation">
			Company Name
		</span>
		<a onclick="location.href='./FinancialMetricsAmUI.php?metrics=<?php echo $metrics;?>&sector=<?php echo $sector;?>&sectorid=<?php echo $sector_ID;?>&mnt=<?php echo $mnt;?>&flag=<?php echo $flag?>company=&category=Revenue'" class="float_left button">
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
			<div id="chartHolder"  style="bottom:0;position:absolute; width: 90%; height: 100%">
                            
			</div>
			
			
			
		</div>
	</div>
	<div class="abs footer_lower chrome_dark">
		
	</div>
</div>
<div id="sidebar" class="abs">
	<span id="nav_arrow"></span>
	<div class="abs header_upper chrome_dark">
		Company Name
	</div>
        
	
	<div id="sidebar_content" class="abs">
		<div id="sidebar_content_inner">
			<ul id="sidebar_menu">
				
                <?php
                $result = mysql_query ($query,$conn);
                $row_count =  mysql_num_rows($result) or die("display_db_query:" . mysql_error());
                $column_count = mysql_num_fields($result) or die("display_db_query:" . mysql_error());
                 
                while($row = mysql_fetch_array($result))
	           {
	                
                     for($column_no = 0; $column_no < $column_count; $column_no++) 
                        {
                            echo "<li>";
                            echo "<a onclick='graph(\"".$row[0]."\",".$rcount_c.");'>".$row[0]."</a>";
		           
                            echo "</li>";
                            break;
                          }
	               
            	}
                
                ?>
			<li>
					<?php echo "<a onclick='gt_click(0);'>Grand Total</a>"; ?>
				</li>
		</div>
            
        
	</div>
	<div class="abs footer_lower chrome_dark">
		<a href="#" class="icon icon_gear2 float_left"></a>
		<span class="float_right gutter_right">Some descriptive text here</span>
	</div>
        
        
        
</div>
</body>
</html>

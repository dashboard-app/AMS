    <?php
/************************************************************************************************************      
Name			:  PipelineMetricsUI.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  3rd-July-2012 
Description     :  Pipeline metrics screen
Modified Date   :  3rd-July-2012
Reason          :  Removed Data source details from the page             
*************************************************************************************************************/
/********************************Revision History*************************************************************
Modified Date   :  4th-July-2012
Reason          :  Implemented Area plot graph for pipeline metrics , changed the 
                   legend labels � A: Sold; B: A + 3-7 TCV; C: A+ 4-7 TCV ;B: A + 3-7 WTCV; C: A+ 4-7 WTCV ,
				   disabled WTCV 3-7 and  WTCV 4-7 plots for pipeline metrics on page load by default.      
****************************************************************************************************************/
session_start();
include("passwords.php");
include("BLL/PipelineMetricsBLL.php");
setcookie("last_page","PipelineMetricsUI.php?metrics=op&sector=".$_GET['sector']."&sectorid=22&top25=".$_GET['top25'], time()+3600, '/');

$metrics = $_GET['metrics'];
$sector_ID= $_GET['sectorid']; 
$sector_name = $_GET['sector'];
$top25=$_GET['top25'];

// function to generate grand total graph data
list($bookings,$array_37_tcv,$array_37_wtcv,$array_47_tcv,$array_47_wtcv,$total_bookings_row_count) = grand_total_graph_data_BLL($sector_name,$top25);

//company wise graph data on the client side (company,month,'stage37/stage47/bookings',wtcv,tcv)
$company37 = sum_tcv_wtcv_37_company_BLL($sector_name,$top25);
$company_row_count37 =  mysql_num_rows($company37) or die("display_db_query1:" . mysql_error());
$column_count37 = mysql_num_fields($company37) or die("display_db_query2:" . mysql_error());

$company47 = sum_tcv_wtcv_47_company_BLL($sector_name,$top25);
$company_row_count47 =  mysql_num_rows($company47) or die("display_db_query3:" . mysql_error());
$column_count47 = mysql_num_fields($company47) or die("display_db_query4:" . mysql_error());

$sold = sum_sold_company_BLL($sector_name,$top25);
$sold_row_count = 0;
$column_count_book = 0;
if(mysql_num_rows($sold) >  0)
{
    global $sold_row_count, $column_count_book;
    $sold_row_count =  mysql_num_rows($sold) or die("display_db_query5_:" . mysql_error());
    $column_count_book = mysql_num_fields($sold) or die("display_db_query6:" . mysql_error());
}


$total_rows = $company_row_count37 + $company_row_count47 + $sold_row_count;
echo "<script type='text/javascript'>\n"; 
echo "var itemArray = new Array($total_rows);\n"; 
echo "for (i=0; i <$total_rows; i++)\n"; 
echo "itemArray[i]=new Array($total_rows);\n"; 

$rowcount=0;
while($row = mysql_fetch_array($company37))
{
for($column_no = 0; $column_no < $column_count37; $column_no++) 
    {
    echo "itemArray[".$rowcount."][".$column_no."]= \"".$row[$column_no]."\";\n";
    }
$rowcount++;
}


while($row = mysql_fetch_array($company47))
{
for($column_no = 0; $column_no < $column_count47; $column_no++) 
    {
    echo "itemArray[".$rowcount."][".$column_no."]= \"".$row[$column_no]."\";\n";
    }
$rowcount++;
}

if(mysql_num_rows($sold) >  0)
{
    while($row = mysql_fetch_array($sold))
    {
        for($column_no = 0; $column_no < $column_count_book; $column_no++) 
        {
            echo "itemArray[".$rowcount."][".$column_no."]= \"".$row[$column_no]."\";\n";
        }
        $rowcount++;
    }
}
echo "</script>\n";
$company_graph_row = $rowcount;
?>

<!DOCTYPE html>
<html lang="en">

<head>		
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>cgams</title>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/stylesheets/master.css" />
<script type="text/javascript" src="assets/js/highcharts.js"></script>
<script type="text/javascript" src="js/modules/exporting.js"></script>
<script src="assets/javascripts/jquery.js"></script>
<script src="assets/javascripts/master.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/highcharts.js"></script>
<script src="assets/iscroll/src/iscroll.js"></script>

<script type="text/javascript">
var myScroll;
var dropdown_click=0;
var act=0;
var targ=0;
var r=0;
var rcount=0;
var act_for=0;
var items = new Array(200);
var items_Series = new Array('OffShore ','OnShore ');
var items_Categories = new Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
var options;
var currentTime = new Date();
var curr_month = currentTime.getMonth();
var last_month = currentTime.getMonth() - 1;
var year = currentTime.getFullYear();
var  companyName= "";
ClearOptions();

function loaded() 
{
    setTimeout(function () {myScroll = new iScroll('wrapper', {bounce: false });}, 100);
}
window.addEventListener('load', loaded, false);

function grand_total()
{
var chart;

$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'chartHolder',
			type: 'area' //added for area chart by Souvik
		},
		title: {
			text: 'Pipeline Metrics'
		},
		subtitle: {
			text: 'Cumulative Total of W.TCV & TCV based on Stage'
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
					this.series.name +': '+ this.y +'$';
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
			x: 15,
			y: 9,
			floating: true,
			borderWidth: 1,
			backgroundColor: '#FFFFFF',
			shadow: true,
                        reversed:true
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
                
            ,
                {       name: 'Sold + 4-7 TCV ',
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
                        ?>]		
		}
                
            ,
                {       name: 'Sold + 4-7 WTCV ',
			//visible:false,  //added for disabling series on default page load by Souvik
			data: [<?php 
                            for($i=0; $i < 12 ; $i++)
                                echo $array_47_wtcv[$i].",";
                        ?>]
			
		},
                {       name: 'Sold',
			data: [<?php 
                                for($i=0; $i <  date("n"); $i++)
                                echo $bookings[$i].",";
                                
                            ?>
                        ]
		}
           
        ]
	});
});

}

function ajax_data_load(value,row_id,id,graph_rows) 
{
 companyName=value;
    var xmlhttp;
    value = value.replace("&","~");
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
        {
            if(xmlhttp.readyState != 4 )
            {
                $("#pls_"+id).attr("src","assets/images/ajax.gif");
            }
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                $(xmlhttp.responseText).insertAfter("#"+row_id);
                setTimeout(function () {myScroll.refresh();}, 0); 
                cellclick(value,graph_rows);
                $("#pls_"+id).attr("src","assets/images/minus.png");
            }
        }
        xmlhttp.open("GET","index.php?sector=<?php echo $_GET['sector']; ?>&companyname="+value+"&company_id="+id+"&top25=<?php echo $_GET['top25']; ?>",true);
        xmlhttp.send();
}
	
function  ClearOptions()
{
		 options = {
			chart: {
				renderTo: 'chartHolder',
				defaultSeriesType: 'area' //added for area chart by Souvik
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
                        legend:{                                
                                reversed:true
                        },
			series: []
		};
}
		 
function cellclick(companyname,rowcount)
{
    rcount=rowcount;
    ClearOptions();
    
    //initialize 5 javascript arrays for bookings, wtcv37, tcv 37, wtcv47, tcv47
    <?php     
            echo "var company_bookings = new Array();\n";
            echo "for(i=0;i<12;i++)\n"; 
            echo "{company_bookings[i] =0;}\n";
            
            echo "var company_wtcv37 = new Array();\n";
            echo "for(i=0;i<12;i++)\n"; 
            echo "company_wtcv37[i] =0;\n";
            
            echo "var company_tcv37 = new Array();\n";
            echo "for(i=0;i<12;i++)\n"; 
            echo "company_tcv37[i] =0;\n";
            
            echo "var company_wtcv47 = new Array();\n";
            echo "for(i=0;i<12;i++)\n";
            echo "company_wtcv47[i] =0;\n";
            
            echo "var company_tcv47 = new Array();\n";
            echo "for(i=0;i<12;i++)\n";
            echo "company_tcv47[i] =0;\n";
            
            echo "var booking_months = $total_bookings_row_count;";
    ?>
    
    for(i=0;i<rcount;i++)
    {
        companyname = companyname.replace("~","&");
        if(companyname == itemArray[i][0] && itemArray[i][2] == 'stage3')
        {
            company_wtcv37[itemArray[i][1]-1] = itemArray[i][3]/1000;
            company_tcv37[itemArray[i][1]-1] = itemArray[i][4]/1000;
        }
        else if(companyname == itemArray[i][0] && itemArray[i][2] == 'stage4')
        {
            company_wtcv47[itemArray[i][1]-1] = itemArray[i][3]/1000;
            company_tcv47[itemArray[i][1]-1] = itemArray[i][4]/1000;
        }
        else if(companyname == itemArray[i][0] && itemArray[i][2] == 'bookings')
        {
            company_bookings[itemArray[i][1]-1] = itemArray[i][3]/1000;
        }
    }
   
   //Accumulate the arrays
   var cumulative_bookings=0,cumulative_company_wtcv37=0,cumulative_company_tcv37=0,cumulative_company_wtcv47=0,cumulative_company_tcv47=0;
   for(i=0;i<12;i++)
   {
       cumulative_bookings  = cumulative_bookings + parseFloat(company_bookings[i]);
       company_bookings[i] = cumulative_bookings;
                 
      cumulative_company_wtcv37 = cumulative_company_wtcv37 +  parseFloat(company_wtcv37[i]);
      company_wtcv37[i] = company_bookings[i] + cumulative_company_wtcv37;
                   
      cumulative_company_tcv37 = cumulative_company_tcv37 +  parseFloat(company_tcv37[i]);
      company_tcv37[i] = company_bookings[i] + cumulative_company_tcv37;
                   
      cumulative_company_wtcv47 = cumulative_company_wtcv47 +  parseFloat(company_wtcv47[i]);
      company_wtcv47[i] = company_bookings[i] + cumulative_company_wtcv47;
                   
      cumulative_company_tcv47 = cumulative_company_tcv47 +  parseFloat(company_tcv47[i]);
      company_tcv47[i] = company_bookings[i] + cumulative_company_tcv47;
    }
    
    for (var cat = 0; cat < 12; cat++)
        options.xAxis.categories.push(items_Categories[cat]); 
    
    options.title.text = companyname; 
    var myDate = new Date();
    var myMonth = myDate.getMonth()+1;
    
    for(var ser=0;ser<5;ser++)
    {
        var series = {  data: []	}; 
        if(ser==4)
	{
            series.name = "Sold";
            for(var i=0;i< myMonth ;i++)
            series.data.push(parseFloat(company_bookings[i]));
	}
        
        else if(ser==2)
        { 
            series.name = "Sold + 3-7 WTCV";	
            series.visible =false;	//added for disabling series on default page load by Souvik		
            for(var i=0;i<12;i++)
                series.data.push(parseFloat(company_wtcv37[i]));
	}
        
        else if(ser==0)
	{
            series.name = "Sold + 3-7 TCV";
            series.visible =false;
            for(var i=0;i<12;i++)
                series.data.push(parseFloat(company_tcv37[i]));
        } 
        
        else if(ser==3)
	{
            series.name = "Sold + 4-7 WTCV ";
            //series.visible =false;		//added for disabling series on default page load by Souvik	
            for(var i=0;i<12;i++)
                series.data.push(parseFloat(company_wtcv47[i]));
	} 
        
        else if(ser==1)
	{ 
            series.name = "Sold + 4-7 TCV ";
            series.visible =false;
            for(var i=0;i<12;i++)
		series.data.push(parseFloat(company_tcv47[i]));
	}
        options.series.push(series);
    }
    var chart = new Highcharts.Chart(options);
}

	
function updateOrientation()
{
    var wid = $(window).width();
    if(wid>1000)
    {
        document.getElementById('table_div').style.height = "45%";
	document.getElementById('table_div').style.overflow="auto";
        $("#button_sidebar").show();

    }
    else
    {
        document.getElementById('table_div').style.height = "60%" ;
	document.getElementById('table_div').style.overflow="auto";
        $("#button_sidebar").hide();
    }
}

var button_sidebar = 0;     
    function hid_show_nav() {
    if(button_sidebar % 2 ==0)
    {
        //$("#sidebar").hide();
        $("#sidebar").animate({width: '0px',opacity: 0.4}, 400,
        function()
        { 
            $("#sidebar").css({'width': '0px'});       
            $("#main").css({'left': '34px'});
            $("#appname_bar").show();
            $("#button_sidebar").html("Show Navigation");
            grand_total();
        } );        
    }
    else
    {
        
        $("#sidebar").animate({width: sidebar_width_original,opacity: 1}, 0);
        //$("#sidebar").show();       
        $("#sidebar").css({'width': sidebar_width_original});        
        $("#main").css({'left': main_left_original});
        $("#appname_bar").hide(); 
        $("#button_sidebar").html("Hide Navigation");
        grand_total();   
    }
    button_sidebar++;
}

</script> 
</head>

<body onorientationchange="updateOrientation();" onLoad="grand_total();">	       
<div id="main" class="abs">	  
    <div class="abs header_upper chrome_dark">
		<span class="float_left button" id="button_navigation">
			Navigation
		</span>
                <button class="float_left button" id="button_sidebar">
                    Hide Navigation
                </button>
        
                <script>                                          
                    $("#button_sidebar").click(function () {hid_show_nav();});
                </script>
		<a onclick="location.href='./home.php'" class="float_left button">
			Back
		</a>
		<a onclick="location.href='./logout.php'" class="float_right button">
			Sign out
		</a>
		<a class="icon icon_refresh float_right" onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=<?php echo $sector_name;?>&sectorid=<?php echo $sector_ID;?>&top25=<?php $top25;?>'"></a>
                 
		<a  onclick="location.href='PipelineMetricsGraphicalOverviewUI.php?metrics=<?php echo $metrics;?>&sector=<?php echo $sector_name;?>&sectorid=<?php echo $sector_ID;?>&top25=<?php $top25;?>&company='+companyName" class="float_right button" style="width:6%;padding:0;" id="graph">
			<img id="graph_img" title="Graphical Overview" src="./assets/images/icons_light/17-bar-chart.png"  align="center" style="width:100%;height:100%;"/>
		</a>                
		Pipeline Metrics -
        <?php
                    if($sector_name == "")
                    {
                        if($top25 == "")                    
                            echo "Full Pipeline";
                        else
                            echo "Top 25";
                    }
                    else
                        echo $sector_name;
		?> 		 
    </div>
    <!-- Navigation -->
    <div id="main_content" class="abs">
	<div id="main_content_inner">
            &nbsp;&nbsp;&nbsp;
            <div style="float:left;display:inline;"><b><i>* TCV and W.TCV are in (000's)Dollar&nbsp;</i></b></div>
            
           
            <!-- grand total -->
            <table  class="abs data" style="top:55%;margin-left:0.2%;width:94.35%;font-size:12px;">	
                <tr>
                    <tbody style="border:1px solid gray;">
			<td style="width:7%">&nbsp;&nbsp;</td>
			<td class="for_gt_conp" style="width:28.5%"><b>Grand Total</b></td>
			<td id="tcv_sum" onclick="grand_total();"class="for_gt_rev" style="width:14.5%"/>
			<td id="wtcv_sum" onclick="grand_total();;"class="for_gt_con" style="width:13.36%"/>
			<td id="" class="" style="width:13.36%"/>
			<td id="" class="" style="width:13.36%"/>
                        <td id="" class="" style="width:13.36%"/>
                    </tbody>
                </tr>
            </table>
            
            <table class="data" id="column_Header" style="display:inline;width:100%;font-size:12px;">
		<thead>
                    <tr>
                        <th style="width:7%"/>
			<th style="width:33.5%" ><span><b>Company</b></span></th>
			<th style="width:12%" ><b>TCV </b></th>
			<th style="width:20.5%" ><b>W. TCV</b></th>
			<th style="width:100px"/>
                        <th style="width:100px"/>
                        <th style="width:100px"/>
                    </tr>
                </thead>
            </table>
            
            <!--Pipeline metrics table-->
            <div  class="abs" style="top:70px;display:inline;background-color:#FFFFFF; width:96%; height: 35%;overflow: auto;" id="table_div" >			
		<div id="wrapper" style="height:100%;">
                    <table border='1' class="data abs" id="actuals" style="overflow:auto;display:inline;width:98.3%;font-size:12px;">
			<tbody id="DataTable" style="overflow: auto">	
			<?php
                            $tcv_sum =0.0; $wtcv_sum =0.0;
                            $pipeline_table_data = pipeline_metrics_table_data_BLL($sector_name,$top25);
			
				$column_count = mysql_num_fields($pipeline_table_data) or die("display_db_query7:" . mysql_error());
				$row_count=  mysql_num_rows($pipeline_table_data) or die("display_db_query8:" . mysql_error());
                                
                                $row_count = 0;
				while($row = mysql_fetch_array($pipeline_table_data))
				{
                                    print("<tr id='row_$row_count' onclick='fun_$row_count();' style = 'background:#edf3fe'>\n");
                                    print("<td  style='width:6.6%'><img class ='image_cell' id='pls_$row_count' style='width:45%;height:45%' src='assets/images/pls.png'/></td>\n");
                                    for($column_num = 0; $column_num < $column_count; $column_num++) 
                                    {
                                        if($column_num ==0)
                                        {
                                            print("<TD style='width:26.6%'>" .  strtoupper($row[$column_num]) . "</TD>\n");
					}
                                        
                                        else if(($column_num ==1)) 
					{
                                            print("<TD style='width:13.36%;text-align:right'>" . number_format($row[$column_num]/1000, 1, '.', ','). "</TD>\n");
                                            $tcv_sum = $tcv_sum + ($row[$column_num])/1000;
					}
                                        
                                        else if($column_num ==2)
                                        {
                                            print("<TD  style='width:13.36%;text-align:right'>" . number_format($row[$column_num]/1000, 1, '.', ','). "</TD>\n");
                                            $wtcv_sum = $wtcv_sum + ($row[$column_num])/1000;
                                        }
                                     }
                                     print("<td style='width:13.36%'>&nbsp;&nbsp;</td>\n"); 
                                     print("<td style='width:11.36%'>&nbsp;&nbsp;</td>\n"); 
                                     print("<td style='width:15.36%'>&nbsp;&nbsp;</td></tr>\n");
                                     
                                     print("<script>");
                                     print("var count_$row_count = 0;");
                                     //for first count load ajax data, from thereon hide/show rows.
                                     print("function fun_$row_count(){if(count_$row_count % 2 == 0) {\$(\"#pls_$row_count\").attr(\"src\",\"assets/images/minus.png\"); \$(\".image_cell\").css(\"width\",\"15px\");} else {\$(\"#pls_$row_count\").attr(\"src\",\"assets/images/pls.png\");}if(count_$row_count == 0)");
                                     print("{ajax_data_load(\"$row[0]\",\"row_$row_count\",\"$row_count\",$company_graph_row);} ");
                                     print(" else ");
                                     print(" {if(count_$row_count % 2 != 0 ) { $(\".company_$row_count\").hide(); setTimeout(function () {myScroll.refresh();}, 0);} else { $(\".company_$row_count\").show();setTimeout(function () {myScroll.refresh();}, 0);cellclick(\"$row[0]\",$company_graph_row); }}");
                                     print("count_$row_count++; }");
                                     print("</script>");
                                     $row_count ++;
                                }
			?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div id="chartHolder"  style="bottom:0;position:absolute; width: 90%; height: 40%"></div>
        </div>
    </div>
</div>

<!-- sidebar -->
<div id="sidebar" class="abs">
	<span id="nav_arrow"></span>
	<div class="abs header_upper chrome_dark">
		Capgemini NA Dashboard
	</div>
	
	<div id="sidebar_content" class="abs">
		<div id="sidebar_content_inner">
			<ul id="sidebar_menu">
				<li id="sidebar_menu_home" class="active">
					<a onclick="location.href='./home.php'"><span class="abs"></span>Home</a>
				</li>
                                <li>
					<a onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=&sectorid=22&top25='">Full Pipeline</a>
				</li>
				<li>
					<a onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=AM&sectorid=22&top25='">AM</a>
				</li>
				<li>
					<a onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=East&sectorid=22&top25='">East</a>
				</li>
				<li>
					<a onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=West&sectorid=22&top25='">West</a>
				</li>
				<li>
					<a onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=Canada&sectorid=22&top25='">Canada</a>
				</li>
				<li>
					<a onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=Communication&sectorid=22&top25='">Communication</a>
				</li>
				<li>
					<a onclick="alert('Data not available');">Government</a>
				</li>
				<li>
					<a onclick="location.href='./PipelineMetricsUI.php?metrics=op&sector=&sectorid=22&top25=y'">Top 25</a>
				</li>
                        </ul>
		</div>
	</div>
	<div class="abs footer_lower chrome_dark">
		<a href="#" class="icon icon_gear2 float_left"></a>
		<span class="float_right gutter_right">Some descriptive text here</span>
	</div>
</div>
<div class="abs header_upper chrome_dark" 
     style="width:768px;height:35px;-webkit-transform:matrix(0,-1,1,0,-370,360);" 
     id="appname_bar"
     onclick="hid_show_nav();">
 Capgemini NA Dashboard
</div>
<script>
$("#appname_bar").hide();  
var main_left_original = document.getElementById("main").style.left;
var sidebar_width_original = document.getElementById("sidebar").style.width;
</script>
<script>
var wid = $(window).width();
document.getElementById('tcv_sum').innerHTML = '<?php echo number_format($tcv_sum,1,'.',","); ?>';
document.getElementById('wtcv_sum').innerHTML = '<?php echo number_format($wtcv_sum,1,'.',","); ?>';
updateOrientation();
</script>




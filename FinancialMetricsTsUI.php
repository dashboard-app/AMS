<?php
/*************************************************************************************      
Name			:  FinancialMetricsTsUI.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  7th-July-2012 
Description     :  Financial metrics Non - AM companies screen 
Modified Date   :
Reason          :               
*************************************************************************************/
session_start(); /// initialize session
include("passwords.php");
include("BLL/FinancialMetricsTsBLL.php");
//check_logged(); /// function checks if visitor is logged.If user is not logged the user is redirected to login.php page 
setcookie("last_page","FinancialMetricsTsUI.php?metrics=f&sector=".$_GET['sector']."&sectorid=22&mnt=".$_GET['mnt']."&flag=".$_GET['flag'], time()+3600, '/');

$flag = $_GET['flag'];
$mnt = $_GET['mnt'];
$metrics = $_GET['metrics'];
$sector_ID= $_GET['sectorid'];
$sector_name= $_GET['sector'];	
$yr= $_GET['yr'];	
if($yr == "2012") { $tableSuffix = "";}
else if($yr == "2013") { $tableSuffix = "_2013"; }
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
var category = "Revenue"; //default category
var last_company_selected = "";
var myScroll;
var items_Categories = new Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');  
var items_Series = new Array('Actuals');
var calender_button=0;
var rcount=0;

function loaded() 
{
    setTimeout(function () {myScroll = new iScroll('wrapper', {bounce: false });}, 100);
}
window.addEventListener('load', loaded, false);

function calender_click()
{
    if(calender_button % 2 ==0)
    {
        
	$("#calender_dropdown").show();$("#arrow_calender").show();
    }
    else
    {
        $("#calender_dropdown").hide();$("#arrow_calender").hide();
    
    }
    calender_button++;
    change_month_data();
}

function change_month_data()
{
        if(month == 'January')               {var mm = '1';}
        else if(month == 'February')         {var mm = '2';} 
        else if(month == 'March')            {var mm = '3';} 
        else if(month == 'April')            {var mm = '4';} 
        else if(month == 'May')              {var mm = '5';} 
        else if(month == 'June')             {var mm = '6';} 
        else if(month == 'July')             {var mm = '7';} 
        else if(month == 'August')           {var mm = '8';} 
        else if(month == 'September')        {var mm = '9';} 
        else if(month == 'October')          {var mm = '10';} 
        else if(month == 'November')         {var mm = '11';} 
        else if(month == 'December')         {var mm = '12';} 
        
        window.location.href ='FinancialMetricsTsUI.php?metrics=<?php echo $metrics;?>&sector=<?php echo $sector_name;?>&sectorid=<?php echo $sector_ID;?>&mnt='+ mm+'&flag=<?php echo $flag;?>';
}
  
 
function  ClearOptions()
{
		 options = {
			chart: {
				renderTo: 'chartHolder',
				defaultSeriesType: 'line'
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
    
function cellclick(companyname,columnname)
{
    last_company_selected = companyname;
    rcount = rowsize;
    arrayList(columnname,companyname);
    ClearOptions();
    for (var cat = 0; cat < 12; cat++)
	options.xAxis.categories.push(items_Categories[cat]);
    
    options.title.text = companyname;
    options.subtitle.text = columnname;
    //options.xAxis.title.text = "2012";
    
    if(columnname=="CM%")
        options.yAxis.title.text = "%"; 
    else
        options.yAxis.title.text = "in (000's) USD"; 
			  
    for(var ser=0;ser<items_Series.length;ser++)
    {
        var series = {  data: []	}; 
        series.name = items_Series[ser];  
	if(ser==0)
        {
            for(var i=0;i< month_counter+1; i++)
            series.data.push(parseFloat(items_Actuals[i]));
	}
        options.series.push(series);
    }
    var chart = new Highcharts.Chart(options);           		
}

function arrayList(field,coname)
{
    switch(field.toUpperCase())
    {
        case "REVENUE":
	{
            fieldData(3,coname);break;
	}
	case "CM$":
        {
            fieldData(4,coname);break;
	}
	case "CM%":
        {
            fieldData(5,coname); break;
	}
	case "BOOKINGS":
        {
            fieldData(6,coname);break;
	}
    }		
}

function fieldData(col_Ind,companyname)
{
    items_Actuals=[];
    for(i=0;i<12;i++)
    items_Actuals[i]=0;
    
    act=0;
    for (var row =0; row < rcount; row++)
    {
        if(itemArray[row][0]== companyname)
         {
             if((col_Ind == 3) || (col_Ind == 4) ||  (col_Ind == 6)) 
                items_Actuals[itemArray[row][7]-1]= itemArray[row][col_Ind]/1000;
            else
                items_Actuals[itemArray[row][7]-1]= itemArray[row][col_Ind];
            act++;
        }      
    } 
}

function gt_click(colnum)
{
    last_company_selected = "";
    ClearOptions();
    for (var cat = 0; cat < 12; cat++)
	options.xAxis.categories.push(items_Categories[cat]); 
				
    options.title.text = "GRAND TOTAL"; 
    options.yAxis.title.text = "in (000's) USD"; 
    switch(colnum)
    {
        case 1:	 
	{
            options.subtitle.text = "REVENUE"; break;
	}
	case 4:
	{
            options.subtitle.text = "BOOKINGS"; break;
	}
	case 2:
        {
            options.subtitle.text = "CM$";break;						 
	}
        case 3:
        {
            options.subtitle.text = "CM%";
            options.yAxis.title.text = "%"; break;
	}
    }
    //options.xAxis.title.text = "2012"; 
    for(var ser=0;ser<items_Series.length;ser++)
    {
        var series = {        data: []          }; 
	series.name = items_Series[ser];  
	if(ser==0)
        {
            for(var i=0;i<month_counter+1;i++)
            {
                if(totalArray[i][0] == 'A')
                    series.data.push(parseFloat(totalArray[i][colnum]));
             }
         }
         options.series.push(series);
    }
    var chart = new Highcharts.Chart(options);
 }
 
 function updateOrientation()
{
    if(button_sidebar % 2 !=0) {hid_show_nav();}
    var wid = $(window).width();
    if(wid>1000)
    {
        document.getElementById('table_div').style.height = "39%";
	document.getElementById('table_div').style.overflow="auto";
        $("#button_sidebar").show();
        
        $("#date_picker").css({'top':'200px','right':'5px'});
        $("#waiting_div").css({'left':'580px'});

    }
    else
    {
        document.getElementById('table_div').style.height = "43%" ;
        $("#button_sidebar").hide();
        
        $("#date_picker").css({'top':'260px','right':'5px'});
        $("#waiting_div").css({'left':'380px'});
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
            $("#column_Header").css({'width':'93.7%'});
            
            $("#date_picker").css({'right':'20px'});
            gt_click(1);
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
        $("#column_Header").css({'width':'95%'});
        
       $("#date_picker").css({'right':'5px'});
        gt_click(1);  
    }
    button_sidebar++;
}
function plot_graph()
{
    
    if(last_company_selected == "")
        gt_click(1);
    else
        cellclick(last_company_selected,category);
        
}
</script>
</head>

<body onorientationchange="updateOrientation();" onLoad="updateOrientation();plot_graph();">	      
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
	<a onclick="location.href='./home.php?yr=<?php echo $yr;?>'" class="float_left button">
			Back
	</a>
	<a onclick="location.href='./logout.php'" class="float_right button">
			Sign out
	</a>
	<a class="icon icon_refresh float_right" onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=<?php echo $sector_name?>&sectorid=<?php echo $sector_ID?>&mnt=<?php echo $mnt;?>&flag=A'"></a>
        <!--<a   class="float_right button" style="width:6%;padding:0;" id="graph">
            <img id="graph_img" title="Graphical Overview" src="./assets/images/icons_light/17-bar-chart.png"  align="center" style="width:100%;height:100%;"/>
	</a>-->
    Financial Metrics -     <?php	echo $sector_name;   ?> 
    </div>

    <!-- Navigation -->
    <div id="main_content" class="abs">
        <div id="main_content_inner">
               
            <h1 id="heading" align="center"  style="display:inline">
				Actuals Data 
            </h1><br/>
            <script>
                document.getElementById('heading').innerHTML = '<?php if($flag == 'A') echo "Actuals Data"; if($flag == 'F') echo "Forecast Data"; if($flag == 'B') echo "Budget Data";?> - <span id="month_header"><?php if($mnt==1) echo "January";if($mnt==2) echo "February";if($mnt==3) echo "March";if($mnt=='4') echo "April";if($mnt=='5') echo "May";if($mnt=='6') echo "June";if($mnt=='7') echo "July";if($mnt=='8') echo "August";if($mnt=='9') echo "September";if($mnt=='10') echo "October";if($mnt=='11') echo "November";if($mnt=='12') echo "December"; ?></span> <?php echo $yr;?>';
            </script>
            
            <div style="float:left;display:inline;"><b><i>* Revenue, CM and Bookings are in (000's) Dollars&nbsp;</i></b></div>
        <!-- 
            &nbsp;&nbsp;&nbsp;
            <img id ="calender_icon" onClick="calender_click();" src="./assets/images/icons_dark/83-calendar.png"/> &nbsp;&nbsp;&nbsp;
            <img id="arrow_calender" class="abs" style="height:6px;top:45px;left:40px;z-index:1;" src="./assets/images/ui/nav_arrow.png"/>
            <div class="abs chrome_light" id="calender_dropdown" style="left:26px;width:200px;height:467px;border-color:black;border-style:solid;border-width:1px;border-radius:0px;padding:0px;top:51px;z-index:1;">
                <ul>
                    <?php  
                   /* if ($flag == 'A')
                    {
				$dropdown[0]= "<li  class=\"chrome_dark\" style=\"padding: 10px;list-style:none; margin: 0;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Select Month - 2012</b></li>";
                                $dropdown[1]= "<li onclick = \"month = 'January';calender_click();\" class=\"chrome_light\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" ><a>&nbsp;<b><span style=\"color:black;\">January</span><span style=\"color:black;float:right;\">></span></b></a></li>";
				$dropdown[2]= "<li onclick = \"month = 'February';calender_click();\" class=\"chrome_light\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" ><a>&nbsp;<b><span style=\"color:black;\">February</span><span style=\"color:black;float:right;\">></span></b></a></li>";
                                $dropdown[3]= "<li onclick = \"month = 'March';calender_click();\" class=\"chrome_light\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" ><a>&nbsp;<b><span style=\"color:black;\">March</span><span style=\"color:black;float:right;\">></span></b></a></li>";
                                $dropdown[4]= "<li onclick = \"month = 'April';calender_click();\" class=\"chrome_light\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" ><a>&nbsp;<b><span style=\"color:black;\">April</span><span style=\"color:black;float:right;\">></span></b></a></li>";
                                $dropdown[5]= "<li onclick = \"month = 'May';calender_click();\" class=\"chrome_light\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" ><a>&nbsp;<b><span style=\"color:black;\">May</span><span style=\"color:black;float:right;\">></span></b></a></li>";
                                $dropdown[6]= "<li onclick = \"month = 'June';calender_click();\" class=\"chrome_light\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" ><a>&nbsp;<b><span style=\"color:black;\">June</span><span style=\"color:black;float:right;\">></span></b></a></li>";
                                $dropdown[7]= "<li onclick = \"month = 'July';calender_click();\" class=\"chrome_light\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" ><a>&nbsp;<b><span style=\"color:black;\">July</span><span style=\"color:black;float:right;\">></span></b></a></li>";
                                $dropdown[8]= "<li onclick = \"month = 'August';calender_click();\" class=\"chrome_light\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" ><a>&nbsp;<b><span style=\"color:black;\">August</span><span style=\"color:black;float:right;\">></span></b></a></li>";
                                $dropdown[9]= "<li onclick = \"month = 'September';calender_click();\" class=\"chrome_light\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" ><a>&nbsp;<b><span style=\"color:black;\">September</span><span style=\"color:black;float:right;\">></span></b></a></li>";
                                $dropdown[10]= "<li onclick = \"month = 'October';calender_click();\" class=\"chrome_light\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" ><a>&nbsp;<b><span style=\"color:black;\">October</span><span style=\"color:black;float:right;\">></span></b></a></li>";
                                $dropdown[11]= "<li onclick = \"month = 'November';calender_click();\" class=\"chrome_light\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" ><a>&nbsp;<b><span style=\"color:black;\">November</span><span style=\"color:black;float:right;\">></span></b></a></li>";
                                $dropdown[12]= "<li onclick = \"month = 'December';calender_click();\" class=\"chrome_light\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" ><a>&nbsp;<b><span style=\"color:black;\">December</span><span style=\"color:black;float:right;\">></span></b></a></li>";
                                
                                for($i=0;$i<= $latest_month;$i++)
                                echo $dropdown[$i];
                                echo "<script>";
                                echo "document.getElementById('calender_dropdown').style.height = '".(36.3 * ($latest_month+1))."px'";
                                echo "</script>";
                       } 
                      */ ?>
                    </ul>
		</div>
                <script>$("#calender_dropdown").hide();$("#arrow_calender").hide();</script>  
            -->
                <!-- grand total -->
		<table  class="abs data" id="gt" style="top:53.8%;width:90%;font-size:12px;">	
                    <tr>
                        <tbody style="border:1px solid gray;">
                            <td style="width:6.6%">&nbsp;&nbsp;</td>
                            <td class="for_gt_conp" style="width:30%"><b>Grand Total</b></td>
                            <td id="revenue_sum" onclick="gt_click(1);"class="for_gt_rev" style="width:13.36%;text-align:right;"/>
                            <td id="cmd_sum" onclick="gt_click(2);"class="for_gt_con" style="width:13.36%;text-align:right;"/>
                            <td id="cmp_sum" onclick="gt_click(3);"class="for_gt_conp" style="width:13.36%;text-align:right;"/>
                            <td id="book_sum" onclick="gt_click(4);"class="for_gt_book" style="width:13.36%;text-align:right;"/>
                            
                        </tbody>
                    </tr>
                </table>
                
		<table class="data" id="column_Header" style="width:95%;font-size:12px;">
                    <thead>
                        <tr>
                            <th style="width:6.6%"/>
                            <th style="width:30%"><span><b>Company</b></span></th>
                            <th style="width:13.36%;text-align:right;" ><b>Revenue </b></th>
                            <th style="width:13.36%;text-align:right;" ><b>CM</b></th>
                            <th style="width:13.36%;text-align:right;" ><b>CM %</b></th>
                            <th style="width:13.36%;text-align:right;" ><b>Bookings</b></th>
			</tr>
                    </thead>
		</table>
                
                <div  class="abs" style="background-color:#FFFFFF;display:inline; width:91.3%; top:100px;height: 35%;overflow: auto;" id="table_div" >			
                    <div id="wrapper" style="height:100%;" >
                        <table border='1' class="data abs" id="actuals" style="overflow:auto;display:inline;width:98.3%;font-size:12px;">
                            <tbody  id="table_body" style="overflow: auto">
                             <?php
                             $revenue_sum =0.0;$cmd_sum =0.0;$cmp_sum=0.0;$book_sum=0.0;
                             
                             $table_data = table_data_BLL($sector_name,$flag,$mnt,$tableSuffix);                             
                             $column_count = mysql_num_fields($table_data)	or die("display_db_query1:" . mysql_error());
                             $row_count=  mysql_num_rows($table_data)    or die("display_db_query2:" . mysql_error());
                             
                             $row_count = 0;
                             while($row = mysql_fetch_array($table_data))
                             {
				// 1st column spacing
				print("<tr id='row_$row_count'>\n");
				// Column Loop
                                print("<td  style='width:6.6%'></td>\n");
                                for($column_num = 0; $column_num < $column_count; $column_num++) 
				{
                                   if($column_num ==0)
                                   {
                                       print("<TD onclick='cellclick(\"$row[0]\",category);' style='width:30%'>" . strtoupper($row[$column_num]) . "</TD>\n");
                                   }
                                   
                                   if($column_num ==1)
                                   {
                                       print("<TD onclick='category=\"Revenue\";cellclick(\"$row[0]\",category);' align=\"Right\" style='text-align:right;width:13.36%;'>" . number_format($row[$column_num]/1000, 1, '.', ','). "</TD>\n");
                                       $revenue_sum = $revenue_sum + ($row[$column_num])/1000;
				   }
                                   
                                   if($column_num ==2)
                                   {
                                      print("<TD onclick='category=\"CM$\";cellclick(\"$row[0]\",category);' align='right' style='text-align:right;width:13.36%;'>" . number_format($row[$column_num]/1000, 1, '.', ','). "</TD>\n");
                                      $cmd_sum = $cmd_sum + ($row[$column_num])/1000;
                                   }
                                   
                                   if($column_num ==3)
                                   {
                                       print("<TD onclick='category=\"CM%\";cellclick(\"$row[0]\",category);' align='right' style='text-align:right;width:13.36%;;'>" . number_format($row[$column_num], 1, '.', ','). "</TD>\n");
                                       $cmp_sum = $cmp_sum + ($row[$column_num]);
                                   }
                                   
                                   if($column_num ==4)
                                   {
                                       print("<TD onclick='category=\"Bookings\";cellclick(\"$row[0]\",category);' align='right' style='text-align:right;width:13.36%;'>" . number_format($row[$column_num]/1000, 1, '.', ','). "</TD>\n");
                                       $book_sum = $book_sum + ($row[$column_num]/1000);
                                   }
				}
                                $row_count ++;    
                             }
                             $divide=$row_count;
                            ?>
		
			</tbody>	
                     </table>
                         
                     <?php                         
                               // display graph data on th client side 
                                $graph_data = graph_data_BLL($sector_name,$tableSuffix);
                                $column_count = mysql_num_fields($graph_data)	or die("display_db_query3:" . mysql_error());
				$row_count=  mysql_num_rows($graph_data) or die("display_db_query4:" . mysql_error());
                                
                                echo "<script type='text/javascript'>\n"; 
                                echo "var rowsize=".$row_count.";\n";
                                echo "</script>\n";
                             
                                echo "<script type='text/javascript'>\n"; 
				echo "var itemArray = new Array(".$row_count.");\n"; 
				echo "for (i=0; i <".$row_count."; i++)\n"; 
				echo "itemArray[i]=new Array(".$row_count.");\n"; 

				$rowcount=0;
				while($row = mysql_fetch_array($graph_data))
				{
					for($column_no = 0; $column_no < $column_count; $column_no++) 
					{
						echo "itemArray[".$rowcount."][".$column_no."]= \"".$row[$column_no]."\";\n";
					}
					$rowcount++;
				}
                                echo "</script>\n";    
                                
                                // display grand total graph data on the client side
                                $graph_data_gt = graph_data_gt_BLL($sector_name,$tableSuffix);
                                
                                $column_count = mysql_num_fields($graph_data_gt) or die("display_db_query5:" . mysql_error());
				$row_count=  mysql_num_rows($graph_data_gt) or die("display_db_query6:" . mysql_error());
                                
                                echo "<script type='text/javascript'>\n"; 
				echo "var totalArray = new Array(".$row_count.");\n"; 
				echo "for (i=0; i <".$row_count."; i++)\n"; 
				echo "totalArray[i]=new Array(".$row_count.");\n"; 

				$rowcount=0;
				while($row = mysql_fetch_array($graph_data_gt))
				{
					for($column_no = 0; $column_no < $column_count; $column_no++) 
					{
						if($column_no == 3)
                                                    echo "totalArray[".$rowcount."][".$column_no."]= '".$row[$column_no]."';\n";
                                                else
                                                    echo "totalArray[".$rowcount."][".$column_no."]= '".$row[$column_no]."';\n";
                                                
					}
					$rowcount++;
				}
                               echo "</script>\n";
                     ?>
                    </div>
                </div>
                <div id="chartHolder"  style="bottom:0;position:absolute; width: 90%; height: 40%">
		</div>
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
					<a onclick="location.href='./home.php?yr=<?php echo $yr;?>'"><span class="abs"></span>Home</a>
				</li>
                                <li>
					<a onclick="location.href='./FinancialMetricsAmUI.php?metrics=f&sector=AM&sectorid=10&mnt=<?php if($mnt==1) echo 'JAN';if($mnt==2) echo 'FEB';if($mnt==3) echo 'MAR';if($mnt==4) echo 'APR';if($mnt==5) echo 'MAY';if($mnt==6) echo 'JUN';if($mnt==7) echo 'JUL';if($mnt==8) echo 'AUG';if($mnt==9) echo 'SEP';if($mnt==10) echo 'OCT';if($mnt==11) echo 'NOV';if($mnt==12) echo 'DEC'; ?>&flag=A&company=&category=Revenue&yr=<?php echo $yr;?>'">AM</a>
				</li>
				<li>
					<a onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=East&sectorid=2&mnt=<?php echo $_GET ['mnt'];?>&flag=A&yr=<?php echo $yr;?>'">East</a>
				</li>
				<li>
					<a onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=West&sectorid=2&mnt=<?php echo $_GET ['mnt'];?>&flag=A&yr=<?php echo $yr;?>'">West</a>
				</li>
				<li>
					<a onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=Canada&sectorid=2&mnt=<?php echo $_GET ['mnt'];?>&flag=A&yr=<?php echo $yr;?>'">Canada</a>
				</li>
                                <li>
					<a onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=Communications&sectorid=2&mnt=<?php echo $_GET ['mnt'];?>&flag=A&yr=<?php echo $yr;?>'">Communication</a>
				</li>
				<li>
					<a >Government</a>
				</li>
				<li>
					<a onclick="location.href='./FinancialMetricsTop25UI.php?metrics=f&sector=&sectorid=6&mnt=<?php echo $_GET ['mnt'];?>&flag=A&yr=<?php echo $yr;?>'">Top 25</a>
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
var count=0;
var wid = $(window).width();
updateOrientation();     
document.getElementById('revenue_sum').innerHTML = '<?php echo number_format($revenue_sum,1,'.',","); ?>';
document.getElementById('cmd_sum').innerHTML = '<?php echo number_format($cmd_sum,1,'.',","); ?>';
document.getElementById('cmp_sum').innerHTML = '<?php echo number_format(($cmd_sum/$revenue_sum)*100,1,'.',","); ?>';
document.getElementById('book_sum').innerHTML = '<?php echo number_format($book_sum,1,'.',","); ?>';
</script>




<!-- Date spin control -->
<div id="date_picker" class="chrome_dark abs" style= "position:absolute;top:220px;right:5px;width:40px;height:150px;">
&nbsp;<button id="date_up" class="chrome_dark abs button" style="-webkit-transform: rotate(180deg);-moz-transform: rotate(180deg);top:-5px;width:80%;height:30%" ><b>V</b></button> <br/>
<div class="abs" style="top:52px">
<input  id="date_box1" value="<?php echo $_GET ['mnt'];?>" style="width:80%;height:9%;" type="text" disabled="disabled"><b></b> </input> 
<input  id="date_box"  style="text-align:center;width:80%;height:9%;" type="text" ><b></b> </input> 
</div>
&nbsp;<button id="date_down" class="chrome_dark abs button" style="bottom:4px;width:80%;height:30%" ><b>V</b></button> <br/>
</div>


<script>

var date_months = new Array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
var max_month = <?php echo $mnt?> - 1;
var month_counter = <?php echo $mnt?> - 1;
document.getElementById("date_box").value = month_counter+1;
document.getElementById("date_box1").value = date_months[month_counter];
$("#date_up").click(function () 
{  
     if(month_counter >= 0 && month_counter < max_month)         
        {
            month_counter = ++month_counter % 12; 
            ajax_data_load(month_counter + 1);
        }      
      else
          alert("Data not available");
});  

$("#date_down").click(function () 
{      
    if(month_counter == 0) 
        {
            month_counter = month_counter %12; 
            ajax_data_load(month_counter + 1);
        }
        
    else
        {
            month_counter = --month_counter %12; 
            ajax_data_load(month_counter + 1);
        } 
        
       
});



function ajax_data_load(ajax_month) 
{
    document.getElementById("date_box").value = month_counter+1;
    document.getElementById("date_box1").value = date_months[month_counter]; 
    var xmlhttp;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
        {
            if(xmlhttp.readyState != 4 )
            {
                $("#waiting").show();
                $("#waiting").attr("src","assets/images/ajax.gif");
            }
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
               
              var response = xmlhttp.responseText;
              var responseArray = response.split("|");
              document.getElementById("table_body").innerHTML = responseArray[0];
              document.getElementById("revenue_sum").innerHTML = responseArray[1];                  
              document.getElementById("cmd_sum").innerHTML = responseArray[2];  
              document.getElementById("cmp_sum").innerHTML = (parseFloat(responseArray[2])/parseFloat(responseArray[1])*100).toPrecision(3);  
              document.getElementById("book_sum").innerHTML = responseArray[4];  
              setTimeout(function () {myScroll.refresh();}, 0);   
              $("#waiting").hide();
              var month_header_var;
              if(ajax_month == 1)       {month_header_var = "January"; month_counter =0;}
              else if(ajax_month == 2)  {month_header_var = "February";month_counter =1;}
              else if(ajax_month == 3)  {month_header_var = "March";month_counter =2;}
              else if(ajax_month == 4)  {month_header_var = "April";month_counter =3;}
              else if(ajax_month == 5)  {month_header_var = "May";month_counter =4;}
              else if(ajax_month == 6)  {month_header_var = "June";month_counter =5;}
              else if(ajax_month == 7)  {month_header_var = "July";month_counter =6;}
              else if(ajax_month == 8)  {month_header_var = "August";month_counter =7;}
              else if(ajax_month == 9)  {month_header_var = "September";month_counter =8;}
              else if(ajax_month == 10) {month_header_var = "October";month_counter =9;}
              else if(ajax_month == 11) {month_header_var = "November";month_counter =10;}
              else if(ajax_month == 12) {month_header_var = "December";month_counter =11;}
              
              document.getElementById('month_header').innerHTML = month_header_var;
              plot_graph();
            }
        }
        xmlhttp.open("GET","FM_TS_AJAX.php?mnt="+ajax_month+"&sector=<?php echo $sector_name?>&flag=<?php echo $flag?>&yr=<?php echo $yr;?>",true);
        xmlhttp.send();
}

$(document).on('keyup', function() { setTimeout(function validate(){
     
     var str_check = document.getElementById("date_box").value.toUpperCase();
     if(str_check == "1"|| str_check =="2"|| str_check =="3"|| str_check =="4"|| str_check =="5"|| str_check =="6"|| str_check =="7"||
        str_check == "8"|| str_check =="9"|| str_check =="10"|| str_check =="11"|| str_check =="12")
     {
         var month_counter_value;
         if(str_check == "1")       {month_counter_value =0;}
         else if(str_check == "2")  {month_counter_value =1;}
         else if(str_check == "3")  {month_counter_value =2;}
         else if(str_check == "4")  {month_counter_value =3;}
         else if(str_check == "5")  {month_counter_value =4;}
         else if(str_check == "6")  {month_counter_value =5;}
         else if(str_check == "7")  {month_counter_value =6;}
         else if(str_check == "8")  {month_counter_value =7;}
         else if(str_check == "9")  {month_counter_value =8;}
         else if(str_check == "10")  {month_counter_value =9;}
         else if(str_check == "11")  {month_counter_value =10;}
         else if(str_check == "12")  {month_counter_value =11;}
         
         if(max_month >= month_counter_value)
         {
            month_counter = month_counter_value;
            ajax_data_load(month_counter + 1);   
         }
        else
        {
         alert("Data not available");
        }
     }     
    
 },1000);
});                                                    
</script>


<div id="waiting_div" align="center" v-align="center" style="position:absolute;top:280px;left:580px"><img id="waiting" src="" /></div>
<script>
$("#waiting").hide();
</script>




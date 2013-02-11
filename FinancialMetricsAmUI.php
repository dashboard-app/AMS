<?php
/*************************************************************************************      
Name			:  FinancialMetricsAmUI.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  7th-July-2012 
Description     :  Financial metrics Am screen
Modified Date   :
Reason          :               
*************************************************************************************/
include("passwords.php");
include("BLL/FinancialMetricsAmBLL.php");
session_start();
//check_logged(); /// function checks if visitor is logged.If user is not logged the user is redirected to login.php page 
setcookie("last_page","FinancialMetricsAmUI.php?metrics=".$_GET['metrics']."&sector=".$_GET['sector']."&sectorid=".$_GET['sectorid']."&mnt=".$_GET['mnt']."&flag=".$_GET['flag']."&company=".$_GET['company']."&category=".$_GET['category'], time()+3600, '/');
                      
$sector = $_GET['sector'];
$metrics = $_GET['metrics'];
$sector_ID= $_GET['sectorid'];
$mnt= $_GET ['mnt'];
$flag= $_GET['flag'];
$company = $_GET['company'];
$category = $_GET['category'];
$yr = $_GET['yr'];
if($yr == "2012") { $tableSuffix = "";}
else if($yr == "2013") { $tableSuffix = "_2013"; }
//Latest month for TS companies
$queryString = "SELECT distinct month(month) as mnt FROM fm_ts".$tableSuffix." order by month";
$query = mysql_query($queryString);

while($row = mysql_fetch_array($query))
{
  $mnt_fm_ts = $row[0];
}               
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
<script src="assets/iscroll/src/iscroll.js"></script> 
<script type="text/javascript" src="assets/js/highcharts.js"></script>
<script type="text/javascript" src="js/modules/exporting.js"></script>
<script src="assets/javascripts/jquery.js"></script>
<script src="assets/javascripts/master.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/highcharts.js"></script>



<script type="text/javascript">
        var last_category = "Revenue";
        var category = "<?php echo $category;?>";
        var data_type ="Actuals";
        var d = new Date();
        var month_names = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", 
        "October", "November", "December");    
        var dropdown_click=0;
        var calender_button = 0;
	var act=0;
	var targ=0;
	var r=0;
	var rcount=0;	
	var items = new Array(200); 
	var items_Series = new Array('Actuals','Forecast','Budget','YTD','YEL');
        var items_Series_gt = new Array('Actuals','Forecast','Budget');
	var items_Actuals = new Array();
	var items_Forcast = new Array();
	var items_Target = new Array();
        var ytd_actuals = new Array();
        var yel_actuals = new Array();
	var items_Categories = new Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	var options;
        var currentTime = new Date();
	var curr_month = currentTime.getMonth();     
	var last_month = currentTime.getMonth() - 1;
	var year = currentTime.getFullYear();
        
        var company = "";
        ClearOptions();
   
   /*To enable simultaneous scroll for table header, body & grand total */
   
   var myScroll1;
   function loaded1() {
	setTimeout(function () { var xloc1=0;
	myScroll1 = new iScroll('wrapper1',{onScrollMove: function(){xloc1 = myScroll1.x;scroll1(xloc1);}                                          
                                          ,vScroll:false,bounceLock: true,momentum: false,bounce: false,hScrollbar:false});
	}, 100);
    }
    window.addEventListener('load', loaded1, false);
 
    var myScroll2;
    
    function loaded2() {
	setTimeout(function () { var xloc2=0;
	myScroll2 = new iScroll('wrapper2',{onScrollMove: function(){xloc2 = myScroll2.x;scroll2(xloc2);}
                                          ,bounceLock: true,momentum: false,bounce: false
                                          });
	}, 200);
    }
    window.addEventListener('load', loaded2, false);   
    
 
    var myScroll3;
    
    function loaded3() {
	setTimeout(function () { var xloc3=0;
	myScroll3 = new iScroll('wrapper3',{onScrollMove: function(){xloc3 = myScroll3.x;scroll3(xloc3);}
                                          ,vScroll:false,bounceLock: true,momentum: false,bounce: false,hScrollbar:false
                                          });
	}, 210);
    }
    window.addEventListener('load', loaded3, false);   
    

    function scroll1(xloc1) {var yloc2 = myScroll2.y; myScroll2.scrollTo(xloc1,yloc2,200);myScroll3.scrollTo(xloc1,0,200);}
         
    function scroll2(xloc2) {myScroll1.scrollTo(xloc2,0,200);myScroll3.scrollTo(xloc2,0,200);}
    
    function scroll3(xloc3) {myScroll1.scrollTo(xloc3,0,200);var yloc2 = myScroll2.y;myScroll2.scrollTo(xloc3,yloc2,200);}
    
        
    // reset highchart plot
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
	
    // replace & for Scorecard page redirection
    function accScoreCard(company)
	{
	company=company.replace("&"," ");
	window.location.href ="ASC.php?company='"+company+"'";
	}

    // plot the graphs on cell click
    function cellclick(companyname,columnname)
	{   
          
	   company = companyname; 
           category = columnname;last_category = columnname;
	   rcount = row_count1;
           
           arrayList(columnname,companyname);
            
	    ClearOptions();
            for (var cat = 0; cat < 12; cat++)
            
            options.xAxis.categories.push(items_Categories[cat]);
            options.title.text = companyname; 
            options.subtitle.text = columnname; 
            
            //options.xAxis.title.text = "2012"; 
            if(columnname=="CM%")
		options.yAxis.title.text = "%"; 
		
            else if(columnname=="DOR")
                options.yAxis.title.text = "Units"; 
            
            else
		options.yAxis.title.text = "in (000's) USD"; 
		
           
            for(var ser=0;ser<items_Series.length;ser++)
            {				
                 var series = {  data: []	}; 
                 series.name = items_Series[ser];  
                 if(ser==0)
		 {
                    for(var i=0;i < month_counter+1;i++)
                    
                    series.data.push(parseFloat(items_Actuals[i]));
                 } 
		else if(ser==1 && columnname!= 'DOR')
		{                      
                    for(var i= 0; i< month_counter ; i++)
                    series.data.push(null);
                    
                    series.data.push(parseFloat(items_Actuals[month_counter])); 
                    
                    for(var i= month_counter+1; i <items_Forcast.length;i++)
                    series.data.push(parseFloat(items_Forcast[i]));                   
		}
		else if(ser==2)
		{ 
                    for(var i=0;i<items_Target.length;i++)
		    series.data.push(parseFloat(items_Target[i]));
		} 
                else if(ser==3 && columnname != "DOR")
		{ 
                    for(var i=0;i< month_counter+1;i++)
                    series.data.push(parseFloat(ytd_actuals[i]));
                    
		} 
                else if(ser==4 && columnname != "DOR")
		{ 
                   for(var i=0;i< month_counter+1;i++)
                    series.data.push(parseFloat(yel_actuals[i]));
		} 
                
             /* To restrict the YEL & YTD legends for DOR */
                if(!((ser==3 || ser==4) && columnname == "DOR"))
                {
                    options.series.push(series);
                }
                //To initially hide the YTD and YEL plot
                if(ser == 3 || ser == 4)
                {
                    series.visible = false;
                }
		   
             }
		var chart = new Highcharts.Chart(options);
            		
	}
        
    // to convert column selected during cell click to column index
    function arrayList(field,coname)
	{
	 	switch(field.toUpperCase())
		{
		case "REVENUE":
				{           
					fieldData(2,coname);
                                        break;
				}
		case "CM$":
				{
					fieldData(3,coname);	
					break;
				 }
		case "CM%":
				{
					fieldData(4,coname);	
					break;
				 }
		case "BOOKINGS":
				{       
					fieldData(5,coname);	
					break;
				 }
		case "DOR":
				{
					fieldData(6,coname);	
					break;
				 }
		}
		
	}
	
    // gather actuals, forecast, budget, yel, ytd data for the graphs from itemsArray []
    function fieldData(col_Ind,companyname)
    {
        items_Actuals=[];
        items_Forcast=[];
        items_Target=[];
        act=0;fo=0;targ=0;
        
        for (var row =0; row < rcount; row++)
	{
            //actuals graph data
            if(itemArray[row][0]=='A' && itemArray[row][1]== companyname)
            {
                if((col_Ind == 2) || (col_Ind == 3) || (col_Ind == 5) || (col_Ind == 6)) 
                {
                    items_Actuals[act]= itemArray[row][2]; 
                    
                    if(col_Ind == 2)
                    {
                        ytd_actuals[act] = itemArray[row][3];  
                        yel_actuals[act] = itemArray[row][4];
                                                
                     }
                    else if(col_Ind == 3)
                    {
                       ytd_actuals[act] = itemArray[row][3];  
                       yel_actuals[act] = itemArray[row][4];
                    }
                    else if(col_Ind == 5)
                    {
                       ytd_actuals[act] = itemArray[row][3];  
                       yel_actuals[act] = itemArray[row][4];
                     }
                    // col_Ind =6
                   else
                   { ;
                   }
                                                        
               }
              // for CM %                                  
              else
              {
                 items_Actuals[act]= itemArray[row][2];
                 ytd_actuals[act] = itemArray[row][3];  
                 yel_actuals[act] = itemArray[row][4];
              }
             act++;
         }      
         
         //forecast graph data
         else  if(itemArray[row][0]=='F' && itemArray[row][1]== companyname )
	{
            if((col_Ind == 2) || (col_Ind == 3) || (col_Ind == 5) || (col_Ind == 6)) 
            {
                items_Forcast[fo]= itemArray[row][2];
                
            }
            // for CM %
            else 
            {
                items_Forcast[fo]= itemArray[row][2];
            }
            fo++;
	}
        
        //budget data
        else if(itemArray[row][0]=='B' && itemArray[row][1]== companyname)
	{
            if((col_Ind == 2) || (col_Ind == 3) || (col_Ind == 5) || (col_Ind == 6)) 
            {
               items_Target[targ]= itemArray[row][2];     
               
            }
            // for CM %
            else 
            {
                items_Target[targ]= itemArray[row][2];
                                
            }
            targ++;
	}
	      	
    } 	
					 
  }
  
  // to draw the grand total graph
  function gt_click(gt_category)
   {
				ClearOptions();
			 
				for (var cat = 0; cat < 12; cat++)
				options.xAxis.categories.push(items_Categories[cat]); 
				
				options.title.text = "GRAND TOTAL"; 
				options.yAxis.title.text = "in (000's) USD"; 
				switch(gt_category)
				{
                                                case "Revenue":	 
							   {
							   options.subtitle.text = "REVENUE"; 
							   break;
							   }
						case "Bookings":
							   {
							  	options.subtitle.text = "BOOKINGS"; 
								break;
								}
						case "CM$":
							   {
							   options.subtitle.text = "CM$";
							   break;						 
							   }
						case "CM%":
							   {
							  	options.subtitle.text = "CM%";
								options.yAxis.title.text = "%"; 
							   break;
							   } 	
                                               case "DOR":
							   {
							  	options.subtitle.text = "DOR";
								options.yAxis.title.text = "Units"; 
							   break;
							   } 
						
				}
                                //options.xAxis.title.text = "2012"; 
				for(var ser=0;ser<items_Series_gt.length;ser++)
				{
                                    var series = {        data: []          }; 
                                    series.name = items_Series[ser];  
                                    if(ser==0)
                                    {
                                        var count =0;
                                        for(var i=0;i < gt_itemArray.length;i++)
                                        {
                                            if(gt_itemArray[i][0] == 'A' && count < month_counter+1)
                                            {
                                                series.data.push(parseFloat(gt_itemArray[i][1]));
                                                count++;
                                            }
                                        }
                                    }
                                     else  if(ser==1)
                                     {
                                         var count = month_counter;
                                         while(count > 0)
                                         {
                                                    series.data.push(null);count--;
                                         }
                                         
                                         var count =0;
                                        for(var i=0;i < gt_itemArray.length;i++)
                                        {
                                            if(gt_itemArray[i][0] == 'A' && count < month_counter+1)
                                            {
                                                latest_actuals = gt_itemArray[i][1];
                                                count++;
                                            }
                                        }
                                          series.data.push(parseFloat(latest_actuals));  
                                         count=0;
                                         for(var i=0;i<gt_itemArray.length;i++)
                                         {
                                             if(gt_itemArray[i][0] == 'F')
                                             {                                                
                                               if(count >= month_counter+1)
                                                    series.data.push(parseFloat(gt_itemArray[i][1]));
                                                
                                                count++;
                                             }
                                             
                                         }
                                     }
                                     else  if(ser==2)
                                     {
                                         for(var i=0;i<gt_itemArray.length;i++)
                                         {
                                             if(gt_itemArray[i][0] == 'B')
                                             series.data.push(parseFloat(gt_itemArray[i][1]));
                                        }
							
                                    }  
                                    options.series.push(series); 
                            }
                            var chart = new Highcharts.Chart(options);
 
  }
          
    // dropdown action for selecting actuals, forecast and the budget data      	 
    function dropdown()
    {
        if(dropdown_click % 2 ==0)
	{
            $("#calender_dropdown").hide();$("#arrow_calender").hide();
            $("#sort_div").show();$("#arrow").show();
        }
        else
	{
            $("#sort_div").hide();$("#arrow").hide();
        }
        dropdown_click++;
    }
    
    //dropdown action to select data for a particular month
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
       if(month == 'January')                    
       {var mm = 'JAN';}
                    
       else if(month == 'February')                    
       {var mm = 'FEB';} 
                    
       if(month == 'March')                    
       {var mm = 'MAR';} 
                    
       else if(month == 'April')                    
       {var mm = 'APR';} 
                    
       else if(month == 'May')                    
       {var mm = 'MAY';} 
                    
       else if(month == 'June')                    
       {var mm = 'JUN';} 
                    
        else if(month == 'July')                    
        {var mm = 'JUL';} 
                    
        else if(month == 'August')                    
        {var mm = 'AUG';}                     
                    
        else if(month == 'September')                    
        {var mm = 'SEP';} 
                   
        else if(month == 'October')                    
        {var mm = 'OCT';} 
                    
        else if(month == 'November')                    
        {var mm = 'NOV';} 
                    
        else if(month == 'December')                    
        {var mm = 'DEC';} 

          window.location.href ='FinancialMetricsAmUI.php?metrics=<?php echo $metrics;?>&sector=<?php echo $sector;?>&sectorid=<?php echo $sector_ID;?>&mnt='+ mm+'&flag=<?php echo $flag;?>&company='+company+'&category='+category;
              
   }
    // to change load the page based on the type of data selected - Actuals/Forecast/Budget
    function flag()
    {
          
            dropdown();
            
            if(data_type == 'Actuals')                    
            {var fg = 'A';}
                    
            else if(data_type == 'Forecast')                    
            {var fg = 'F';} 
                    
           else if(data_type == 'Budget')                    
           {var fg = 'B';} 
           
           window.location.href ='FinancialMetricsAmUI.php?metrics=<?php echo $metrics;?>&sector=<?php echo $sector;?>&sectorid=<?php echo $sector_ID;?>&mnt=<?php echo $mnt;?>&flag='+fg+'&company='+company+'&category='+category;
    }
    
    // to change the size of table and graph on orientation change
   
    
    //to hide and show the graph
    function chart_hide_show()
	{
		if(chart_but % 2==0)
		{
                    document.getElementById('chart_button').innerHTML = 'Show Chart';
                    updateOrientation();
                    $("#chartHolder").hide();
                }
		else
		{
                    document.getElementById('chart_button').innerHTML = 'Hide Chart';
                    updateOrientation();
                    $("#chartHolder").show();
                }
                chart_but++;
	}
    
    function updateOrientation()
	{
            if(button_sidebar % 2 !=0) {hid_show_nav();}
            var wid = $(window).width();
            var ht = $(window).height();
            if(wid>1000)
            {
                document.getElementById('table_div').style.height = "33%";
		document.getElementById('gt').style.top = "342px";
                $("#button_sidebar").show();
                $("#waiting_div").css({'left':'580px'});
            }
	    else
            {
                document.getElementById('table_div').style.height = "40%";                
                document.getElementById('gt').style.top = "490px";
                $("#button_sidebar").hide();
                $("#waiting_div").css({'left':'380px'});
            }
        }
    
    //funtion to plot graph on page load ; Added by Mohammed on 7th july 2012
    function plot_graph()
    {
        if((company != "") && (category != "")) 
            cellclick(company,category);
        else
           gt_click(category);
                
    }
	
    function select_category(catgry)
    {
        //alert("Please wait loading "+catgry+" data...");
        window.location.href = 'FinancialMetricsAmUI.php?metrics=<?php echo $metrics;?>&sector=<?php echo $sector;?>&sectorid=<?php echo $sector_ID;?>&mnt=<?php echo $mnt;?>&flag=<?php echo $flag?>&company=&category='+catgry+'&yr=<?php echo $yr?>';
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
            $(".table_header_txt_align").css({'text-align':'right'});
            plot_graph();
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
        $(".table_header_txt_align").css({'text-align':'left'});
        plot_graph();   
    }
    button_sidebar++;
}
</script>

</head>
<body onorientationchange="updateOrientation();" onLoad="updateOrientation();plot_graph();">

    <script>
        var wid = $(window).width();        
        var chart_but=0;
        updateOrientation();
      
    </script>
    
<!-- main page excluding the sidebar -->
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
	<a class="icon icon_refresh float_right" onclick="location.href='./FinancialMetricsAmUI.php?metrics=<?php echo $metrics;?>&sector=<?php echo $sector;?>&sectorid=<?php echo $sector_ID;?>&mnt=<?php echo $mnt;?>&flag=<?php echo $flag?>&company=<?php echo $company?>&category=<?php echo $category?>'"></a>
	<!--<a class="float_right button" style="width:6%;padding:0;" id="graph" onclick="location.href='graph.php?metrics=<?php echo $metrics;?>&sector=<?php echo $sector;?>&sectorid=<?php echo $sector_ID;?>&mnt=<?php echo $mnt;?>&flag=<?php echo $flag?>'">
            <img id="graph_img" title="Graphical Overview" src="./assets/images/icons_light/17-bar-chart.png"  align="center" style="width:100%;height:100%;" />
	</a>-->
        <!-- heading -->
	Financial Metrics - 
  <?php
	echo $sector;       
	?> 
    </div>
    
    <div class="abs header_lower chrome_dark">
		
		<a  align="center" class="icon icon_revenue"  onclick="select_category('Revenue');"  style="width:19%"></a>
		<a  align="center" class="icon icon_cmd"      onclick="select_category('CM$');"      style="width:19%"></a>
		<a  align="center" class="icon icon_cmp"      onclick="select_category('CM%');"      style="width:19%"></a>	
                <a  align="center" class="icon icon_bookings" onclick="select_category('Bookings');" style="width:19%"></a>
                <a  align="center" class="icon icon_dor"      onclick="select_category('DOR');"      style="width:19%"></a>
               
		
    </div>
   
    <div id="main_content" class="abs">
	<div id="main_content_inner">
	
       
            <h2 id="heading" align="center"  style="display:inline">
            </h2>
            <script>
                 document.getElementById('heading').innerHTML = '<?php if($category == 'Revenue') echo "Revenue Data"; if($category == 'CM$') echo "CM$ Data"; if($category == 'CM%') echo "CM% Data";if($category == 'Bookings') echo "Bookings Data";if($category == 'DOR') echo "DOR Data";?> - <span id = "month_header"><?php if($mnt=='JAN') echo "January";if($mnt=='FEB') echo "February";if($mnt=='MAR') echo "March";if($mnt=='APR') echo "April";if($mnt=='MAY') echo "May";if($mnt=='JUN') echo "June";if($mnt=='JUL') echo "July";if($mnt=='AUG') echo "August";if($mnt=='SEP') echo "September";if($mnt=='OCT') echo "October";if($mnt=='NOV') echo "November";if($mnt=='DEC') echo "December"; ?></span> <?php echo $yr;?>';
            </script>
            
            
            <br/>
             
            <div style="float:left;display:inline;"><b><i>* Revenue, CM and Bookings are in (000's) Dollars&nbsp;</i></b></div>
           
                        
            <img id="arrow" class="abs" style="height:10px;top:90px;left:31px;z-index:1;" src="./assets/images/ui/nav_arrow.png"/>
            
            <div class="abs chrome_light" id="sort_div" style="left:26px;width:200px;height:146px;border-color:black;border-style:solid;border-width:1px;border-radius:0px;padding:0px;top:100px;z-index:1;">
                <ul>
                    <li  class="chrome_dark" style="padding: 10px;list-style:none; margin: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Group by:</b></li>
                    <li id="actuals_link" class="chrome_light" style="font-color:black;padding: 8px;list-style: none;margin: 0;" onClick="data_type = 'Actuals';flag();"><a>&nbsp;<b><span style="color:black;">Actuals Data</span><span style="color:black;float:right;">></span></b></a></li>
                    <li id="forecast_link" class="chrome_light" style="padding: 8px;list-style: none;margin: 0;" onClick="data_type = 'Forecast';flag();"><a> <span style="color:black;">&nbsp;<b>Forecast Data</span><span style="color:black;float:right;">></span></b></a></li>
                    <li id="budget_link" class="chrome_light" style="padding: 8px;list-style: none;margin: 0;" onClick="data_type = 'Budget';flag();"><a> <span style="color:black;">&nbsp;<b>Budget Data</span><span style="color:black;float:right;">></span></b></a></li>
                </ul>
            </div>
            <script>
		$("#sort_div").hide();$("#arrow").hide();$("#arrow2").hide();$("#nav_div").hide();
            </script>
                         
            <div  class="abs" style="display:inline;top:70px;left:20px;width:90.5%;height:20%; overflow: auto;" >			
                <div id="wrapper1">
                    <table table border='0' class="data" id="column_Header" style="width:100%;font-size:12px;">
                        <thead style="overflow: auto;">
                            <tr>
                                <th style='text-align:left;width:19%;align:left' ><b>Company</b></th>
                                <th COLSPAN=3 style='text-align:center;width:27%;align:right'><b>Actuals</b></th>
                                <th COLSPAN=3 style='text-align:center;width:27%;align:right' ><b>Forecast</b></th>
                                <th COLSPAN=3 style='text-align:center;width:27%;align:right' ><b>Budget</b></th>
                            </tr>
                             <tr>
                                <th class ="table_header_txt_align" style='text-align:left;width:19%;align:left' ><b></b></th>
                                <th class ="table_header_txt_align" style='text-align:left;width:9%;align:right' ><b><span class="table_header_month"><?php  echo $mnt;?></span></b></th>
                                <th class ="table_header_txt_align" style='text-align:left;width:9%;align:right'><b>YTD</b></th>
                                <th class ="table_header_txt_align" style='text-align:left;width:9%;align:right' ><b>YEL</b></th>
				<th class ="table_header_txt_align" style='text-align:left;width:9%;align:right' ><b><span class="table_header_month"><?php  echo $mnt;?></span></b></th>
                                <th class ="table_header_txt_align" style='text-align:left;width:9%;align:right' ><b>YTD </b></th>
                                <th class ="table_header_txt_align" style='text-align:left;width:9%;align:right' ><b>YEL </b></th>
                                <th class ="table_header_txt_align" style='text-align:left;width:9%;align:right' ><b><span class="table_header_month"><?php  echo $mnt;?></span></b></th>
                                <th class ="table_header_txt_align" style='text-align:left;width:9%;align:right' ><b>YTD</b></th>
                                <th class ="table_header_txt_align" style='text-align:left;width:9%;align:right' ><b>YEL</b></th>
                              </tr>
                        </thead>                                
                    </table>
                </div>
            </div>
            
                       
            <div  class="abs" style="top:123px;left:20;background-color:#FFFFFF; width:90.5%;height:33.5%; overflow: auto;" id="table_div" >			
                <div id="wrapper2" style="height:100%;">
                    <table border='1' class="data abs" id="actuals" style="width:100%;font-size:12px;">
                        <tbody style="overflow-y: auto" id="table_body">
                            <?php 
                            $act_total = 0.0; $for_total = 0.0;$bud_total = 0.0; $act_Dor = 0.0;
                            
                            $result_table =  table_data_BLL($mnt,$category,$tableSuffix);
                            $column_count = mysql_num_fields($result_table) or die("display_db_query:1" . mysql_error());        
                            $roCount_act=  mysql_num_rows($result_table) or die("No Data Available" . mysql_error());
				
                            while($row = mysql_fetch_array($result_table))
                            {   
                                print("<tr>");
				for($column_num = 0; $column_num < $column_count; $column_num++) 
				{
                                    
                                    if($column_num ==0)
                                         print("<TD  onclick='cellclick(\"".$row[0]."\",last_category);' style='width:19%'  id='" . $row[0] ."'>" . strtoupper($row[$column_num]) . "</TD>\n");
							
                                    else if($column_num == 1)
                                         print("<TD   onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>\n");
                                                        
                                    else if($column_num == 2)
                                         print("<TD onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>\n");
                                                        
                                    else if($column_num == 3)
                                         print("<TD onclick='cellclick(\"".$row[0]."\",category);' style='border-right:1px solid gray;text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>\n");
                                                        
                                     else if($column_num == 4)
                                         print("<TD   onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>\n");
                                                        
                                     else if($column_num == 5)
                                         print("<TD onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>\n");
                                                        
                                     else if($column_num == 6)
                                         print("<TD onclick='cellclick(\"".$row[0]."\",category);' style='border-right:1px solid gray;text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>\n");
                                                        
                                     else if($column_num == 7)
                                         print("<TD   onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>\n");
                                                        
                                     else if($column_num == 8)
                                         print("<TD onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>\n");
                                                        
                                     else if($column_num == 9)
                                         print("<TD onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>\n");
                                    }
                                                        
                                   $act_total=$act_total+$row[1];
                                   $for_total=$for_total+$row[4];
                                   $bud_total=$bud_total+$row[7];
                                   //$act_Dor = $act_Dor+$row[13];
                                   print("</tr>\n");
				}
				//$act_CM=number_format(($for_total/$act_total*100), 2, '.', '');
                                
                                echo "<script type='text/javascript'>\n"; 
                                echo "var rowsize=".$roCount_act.";\n";
                                echo "</script>\n";
                            
                             ?>
			</tbody>                       
                    </table>
                    <!-- Display the graph data on the client side -->
                    <?php
                    
                    $month_name = array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');     
                    $month_array = array('01','02','03','04','05','06','07','08','09','10','11','12');
                    $flag_array= array('A','F','B');
                    $rowcount=0;
                    
                    echo "<script type='text/javascript'>\n";                    
                    echo "var itemArray = new Array();\n"; 
                    echo "for (i=0; i < (12*3*$roCount_act); i++)\n";  //no.of month * flags * no of companies
                    echo "itemArray[i] = new Array();\n";
                   
                    for($i=0;$i<12;$i++)
                    {
                        for($j=0;$j<3;$j++)
                        {
                            $result_graph = graph_data_BLL($month_name[$i],$flag_array[$j],$category,$tableSuffix);
                            $column_count = mysql_num_fields($result_graph) or die("display_db_query:1" . mysql_error());
                            $row_count1=  mysql_num_rows($result_graph)or die("display_db_query:1" . mysql_error());
                            
                            while($row = mysql_fetch_array($result_graph))
                            {       
                                echo "itemArray[".$rowcount."][0] =\"$flag_array[$j]\";\n";
				for($column_no = 1; $column_no <= $column_count; $column_no++) 
				{
                                    echo "itemArray[".$rowcount."][".$column_no."]= \"".$row[$column_no-1]."\";\n";
				}
                                echo "itemArray[".$rowcount."][5] = \"2012-$month_array[$i]-01\";\n";
				$rowcount++;
                            }                  
                        }
                       
                    }
                    
                    echo "</script>\n";
                    $row_count1 = $rowcount;
                    // itemArray 1d size from php to js variable 
                    echo "<script>\n";
                    echo "var row_count1 = $row_count1;";
                    echo "</script>\n";
                    
                    
                    //Display the grand total graph data on the client side
                     $rowcount=0;
                     echo "<script type='text/javascript'>\n";
                     echo "var gt_itemArray = new Array(36);\n"; 
                     echo "for (i=0; i <36; i++)\n";
                     echo "gt_itemArray[i]=new Array(36);\n"; 
                     for($j=0;$j<3;$j++)
                     {
                        for($i=0;$i<12;$i++)
                        {
                            $result_graph_grandtotal =  graph_data_grandtotal_BLL($month_name[$i],$flag_array[$j],$category,$tableSuffix);
                            $column_count = mysql_num_fields($result_graph_grandtotal) or die("display_db_query:1" . mysql_error());
                            $row_count=  mysql_num_rows($result_graph_grandtotal)or die("display_db_query:1" . mysql_error());
                                    
                            while($row = mysql_fetch_array($result_graph_grandtotal))
                            {       
                                echo "gt_itemArray[".$rowcount."][0] =\"$flag_array[$j]\";\n";
				for($column_no = 1; $column_no <= $column_count; $column_no++) 
				{
                                    echo "gt_itemArray[".$rowcount."][".$column_no."]= \"".$row[$column_no-1]."\";\n";
                                }
                                echo "gt_itemArray[".$rowcount."][2] = \"2012-$month_array[$i]-01\";\n";
				$rowcount++;
                            }
                            
                          }
                       }
                      echo "</script>\n";
                    
                    ?>
                    </div>
            </div>
            
            <!-- Grand total div container -->
            <div  class="abs" id ="gt" style="display:inline;top:342px;left:20px;width:90.5%;height:5%; overflow: auto;" >			
                
                    <table table border='1'  class="data abs"  style="width:100%;font-size:12px;">
                        <tbody style="overflow: auto;">
                            <tr style="border:1px solid gray;" >
                                <td style="width:16%;text-align:left;"><span><b>Grand&nbsp;Total</b></span></td>
				<td id="act_gt" onclick="gt_click(category);" class="act_gt_rev" style="text-align:left;width:9%"></td>
                                <td style="text-align:left;width:9%" ><b>-</b></td>
                                <td style="text-align:left;width:9%" ><b>-</b></td>
				<td id="for_gt" onclick="gt_click(category);" class="act_gt_con" style="text-align:left;width:9%"></td>
                                <td style="text-align:left;width:9%" ><b>-</b></td>
                                <td style="text-align:left;width:9%" ><b>-</b></td>
                                <td id="bud_gt" onclick="gt_click(category);" class="act_gt_conp" style="text-align:left;width:9%"/></td>
                                <td style="text-align:left;width:9%" ><b>-</b></td>
                                <td style="text-align:left;width:9%" ><b>-</b></td>
                                
                            </tr>
                        </tbody>
                    </table>
                
            </div>
            <?php
            // TO get CMP grnt total number by ($cmd/$revenue)
            if($category == "CM%")
            {
             
                $cmp_total_numbers = cmp_total_numbers_BLL($mnt,$tableSuffix);
                
                while($row = mysql_fetch_array($cmp_total_numbers))
                {       
                   for($i=0;$i<3;$i++)
                       $total_array[$i] = $row[$i];           
                }
                $act_total = $total_array[0];
                $for_total = $total_array[1];
                $bud_total = $total_array[2];                
            }
            ?>
            <script type="text/javascript">
                document.getElementById('act_gt').innerHTML = '<?php echo number_format($act_total,1,'.',',');?>';
		document.getElementById('for_gt').innerHTML = '<?php echo number_format($for_total,1,'.',',');?>';
		document.getElementById('bud_gt').innerHTML = '<?php echo number_format($bud_total,1,'.',',');?>';
           </script>
            
            <div id="chartHolder"  style="bottom:0;position:absolute; width: 94%; height: 42%">
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
                    <li id="sidebar_menu_home" class="active"><a onclick="location.href='./home.php?yr=<?php echo $yr;?>'" style="height:25px"><span class="abs"></span>Home</a></li>
                    <li><a onclick="location.href='./FinancialMetricsAmUI.php?metrics=f&sector=AM&sectorid=10&mnt=<?php echo $_GET ['mnt'];?>&flag=A&company=&category=Revenue&yr=<?php echo $yr;?>'">AM</a></li>
                    <li><a onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=East&sectorid=2&mnt=<?php echo $mnt_fm_ts;?>&flag=A&yr=<?php echo $yr;?>'">East</a></li>
                    <li><a onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=West&sectorid=2&mnt=<?php echo $mnt_fm_ts;?>&flag=A&yr=<?php echo $yr;?>'">West</a></li>
                    <li><a onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=Canada&sectorid=2&mnt=<?php echo $mnt_fm_ts;?>&flag=A&yr=<?php echo $yr;?>'">Canada</a></li>
                    <li><a onclick="location.href='./FinancialMetricsTsUI.php?metrics=f&sector=Communications&sectorid=2&mnt=<?php echo $mnt_fm_ts;?>&flag=A&yr=<?php echo $yr;?>'">Communication</a></li>
                    <li><a >Government</a></li>
                    <li><a onclick="location.href='./FinancialMetricsTop25UI.php?metrics=f&sector=&sectorid=6&mnt=<?php echo $mnt_fm_ts;?>&flag=A&yr=<?php echo $yr;?>'">Top 25</a></li>
                    <li><a onclick="location.href='./settings.php'">Settings</a></li>
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

<!-- Date spin control -->
<div id="date_picker" class="chrome_dark abs" style= "position:absolute;top:240px;right:5px;width:40px;height:150px;">
&nbsp;<button id="date_up" class="chrome_dark abs button" style="-webkit-transform: rotate(180deg);-moz-transform: rotate(180deg);top:-5px;width:80%;height:30%" ><b>V</b></button> <br/>
<div class="abs" style="top:52px">
<input  id="date_box1" value="<?php echo $_GET ['mnt'];?>" style="width:80%;height:9%;" type="text" disabled="disabled"><b></b> </input> 
<input  id="date_box"  style="text-align:center;width:80%;height:9%;" type="text" ><b></b> </input> 
</div>
&nbsp;<button id="date_down" class="chrome_dark abs button" style="bottom:4px;width:80%;height:30%" ><b>V</b></button> <br/>
</div>

<script>
  <?php 
  if(($_GET ['mnt']) == "JAN")
    echo "document.getElementById(\"date_box\").value = 1;";
  else if(($_GET ['mnt']) == "FEB")
    echo "document.getElementById(\"date_box\").value = 2;";
  else if(($_GET ['mnt']) == "MAR")
    echo "document.getElementById(\"date_box\").value = 3;";
  else if(($_GET ['mnt']) == "APR")
    echo "document.getElementById(\"date_box\").value = 4;";
  else if(($_GET ['mnt']) == "MAY")
    echo "document.getElementById(\"date_box\").value = 5;";
  else if(($_GET ['mnt']) == "JUN")
    echo "document.getElementById(\"date_box\").value = 6;";
  else if(($_GET ['mnt']) == "JUL")
    echo "document.getElementById(\"date_box\").value = 7;";
  else if(($_GET ['mnt']) == "AUG")
    echo "document.getElementById(\"date_box\").value = 8;";
  else if(($_GET ['mnt']) == "SEP")
    echo "document.getElementById(\"date_box\").value = 9;";
  else if(($_GET ['mnt']) == "OCT")
    echo "document.getElementById(\"date_box\").value = 10;";
  else if(($_GET ['mnt']) == "NOV")
    echo "document.getElementById(\"date_box\").value = 11;";
  else if(($_GET ['mnt']) == "DEC")
    echo "document.getElementById(\"date_box\").value = 12;";
  ?>
  var date_months = new Array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
  var month_counter = parseInt("<?php echo convert_month_digit_BLL($mnt,$tableSuffix);?>") - 1;

  $("#date_up").click(function () 
  {  
    
    if(month_counter >= 0 && month_counter<11)         
    {
        month_counter = ++month_counter %12;
        ajax_data_load(date_months[month_counter],"<?php echo $category;?>");
    }
  });  

$("#date_down").click(function () 
{  
    
    if(month_counter == 0) 
    {
      month_counter = month_counter %12; 
      ajax_data_load(date_months[month_counter],"<?php echo $category;?>");
    }
    else
    {
      month_counter = -- month_counter%12; 
      ajax_data_load(date_months[month_counter],"<?php echo $category;?>");
    } 
         
 });
 function ajax_data_load(ajax_month,ajax_category) 
 {
    document.getElementById("date_box").value = month_counter+1;
    document.getElementById("date_box1").value = date_months[document.getElementById("date_box").value -1] ;
    //alert("check");
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
                $(".table_header_month").html(ajax_month);
                var response = xmlhttp.responseText;
                var responseArray = response.split("|");
                document.getElementById("table_body").innerHTML = responseArray[0];
                document.getElementById("act_gt").innerHTML = responseArray[1];                  
                document.getElementById("for_gt").innerHTML = responseArray[2];  
                document.getElementById("bud_gt").innerHTML = responseArray[3];  
                setTimeout(function () {myScroll2.refresh();}, 0);   
                $("#waiting").hide();
                var month_header_var;
                if(ajax_month =='JAN') {month_header_var = "January"; month_counter =0;}
                if(ajax_month =='FEB') {month_header_var = "February";month_counter =1;}
                if(ajax_month =='MAR') {month_header_var = "March";month_counter =2;}
                if(ajax_month =='APR') {month_header_var = "April";month_counter =3;}
                if(ajax_month =='MAY') {month_header_var = "May";month_counter =4;}
                if(ajax_month =='JUN') {month_header_var = "June";month_counter =5;}
                if(ajax_month =='JUL') {month_header_var = "July";month_counter =6;}
                if(ajax_month =='AUG') {month_header_var = "August";month_counter =7;}
                if(ajax_month =='SEP') {month_header_var = "September";month_counter =8;}
                if(ajax_month =='OCT') {month_header_var = "October";month_counter =9;}
                if(ajax_month =='NOV') {month_header_var = "November";month_counter =10;}
                if(ajax_month =='DEC') {month_header_var = "December";month_counter =11;}
                
                document.getElementById('month_header').innerHTML = month_header_var;
                plot_graph();
            }
        }
        xmlhttp.open("GET","FM_AM_AJAX.php?mnt="+ajax_month+"&category="+ajax_category+"&yr=<?php echo $yr;?>",true);
        xmlhttp.send();
}

$(document).on('keyup', function() {setTimeout(function validate(){
     
     var str_check = document.getElementById("date_box").value.toUpperCase();
     if(str_check == "1"|| str_check =="2"|| str_check =="3"|| str_check =="4"|| str_check =="5"||str_check =="6"|| str_check =="7"||
        str_check == "8"|| str_check =="9"|| str_check =="10"|| str_check =="11"|| str_check =="12")
     {
         var month_value;
         if(str_check == "1")       {month_value = "JAN";month_counter =0;}
         else if(str_check == "2")  {month_value = "FEB";month_counter =1;}
         else if(str_check == "3")  {month_value = "MAR";month_counter =2;}
         else if(str_check == "4")  {month_value = "APR";month_counter =3;}
         else if(str_check == "5")  {month_value = "MAY";month_counter =4;}
         else if(str_check == "6")  {month_value = "JUN";month_counter =5;}
         else if(str_check == "7")  {month_value = "JUL";month_counter =6;}
         else if(str_check == "8")  {month_value = "AUG";month_counter =7;}
         else if(str_check == "9")  {month_value = "SEP";month_counter =8;}
         else if(str_check == "10") {month_value = "OCT";month_counter =9;}
         else if(str_check == "11") {month_value = "NOV";month_counter =10;}
         else if(str_check == "12") {month_value = "DEC";month_counter =11;}    
         
         ajax_data_load(month_value,"<?php echo $category;?>");
         
     }
 },1000);
 }); 
 <?php if($category == "DOR" || $category == "CM%")
        echo "$(\".table_header_txt_align\").css({'text-align':'right'});";
 ?>
                                                    
</script>


<div id="waiting_div" align="center" v-align="center" style="position:absolute;top:325px;left:580px"><img id="waiting" src="" /></div>
<script>
$("#waiting").hide();
</script>
</body>
</html>









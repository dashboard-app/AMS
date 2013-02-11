<?php
/************************************************************************************************      
Name			:  OperationalMetricsAmUI.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  3rd-July-2012 
Description     :  Operational metrics screen for Am companies
Modified Date   :  3rd-July-2012
Reason          :  Added a function to redirect to Account Scorecard page on compant name click               
************************************************************************************************/
session_start(); /// initialize session

include("passwords.php");
include("BLL/OperationalMetricsAmBLL.php");
//check_logged(); /// function checks if visitor is logged.If user is not logged the user is redirected to login.php page 
//setting the cookie value for the last page visited
setcookie("last_page","OperationalMetricsAmUI.php?metrics=".$_GET['metrics']."&sector=".$_GET['sector']."&mnt=".$_GET['mnt'], time()+3600, '/');

$sector = $_GET['sector'];
$metrics = $_GET['metrics'];
$mnt= $_GET ['mnt'];
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
<script src="assets/javascripts/iscroll.js"></script> 
<script type="text/javascript" src="assets/js/highcharts.js"></script>
<script type="text/javascript" src="js/modules/exporting.js"></script>
<script src="assets/javascripts/jquery.js"></script>
<script src="assets/javascripts/master.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/highcharts.js"></script>
<script type="text/javascript">
        var last_company  = "";
        var category = "";
        var selectedCompanyName="";
	var dropdown_click=0;
	var act=0;
	var targ=0;
	var r=0;
	var rcount=0;
	var act_for=0;
	var items = new Array(200);
 	var items_Series = new Array('OffShore ','OnShore ');
	var itemsOnshore = new Array();
	var itemsOffshore = new Array();
	var itemsTarget = new Array();
	var itemsBlended = new Array();
	var items_Offshore = new Array();
	var items_Onshore = new Array();
	var  gt_items_Offshore=new Array();
	var  gt_items_Onshore=new Array();
	var items_Categories = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
        var monthArray = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
	var options;
	var currentTime = new Date();
	var curr_month = currentTime.getMonth();
	var last_month = currentTime.getMonth() - 1;
	var year = currentTime.getFullYear();
        var calender_button = 0;        
	 var month=<?php echo $_GET['mnt'];?>;
 
	var items_Pyramid = new Array('A','B','C','D/E/F');
        
        
	//Based on the calender option selected 'calender_select' function sets label and table data with selected month details
        function calender_select(monthClicked)
        {
		     calender_click();
		     window.location.href='OperationalMetricsAmUI.php?metrics=op&sector=AM&mnt='+monthClicked;
        }
        
	//'calender_click' function opens/closes the calender dropdown on click 
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
        }
        
	
	 
		
		// added for plotting Onshore/Offshore and Blended graphs by Souvik
		function  PyramidClearOptions(renderto,type)
		{
			 options = {
				chart: {
					renderTo: renderto,
					defaultSeriesType: type 
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
		 
		 //added to dynamically plot the pyramid graphs for a Company
		 function GetCompanyPyramidGraphs(company)
		 {
 
		 selectedCompanyName=  company;
		
		 document.getElementById('pyramidGraph').style.display   = "";
		  document.getElementById('account').style.display   = "";
		 PyramidArrayList(company);
		 document.getElementById('chartHolder').style.visibility = 'hidden';
		  
	     document.getElementById('chartHolder').style.display   = "none";
		 document.getElementById('pyramidGraph').style.visibility = 'visible';
		  document.getElementById('account').style.visibility = 'visible';
		 PlotShoreGraph(company);
		 PlotBlendedGraph(company);
		 
		   
		  
		 }
		 
		 function PlotBlendedGraph(companyname)
		 {
	 
		 PyramidClearOptions('blended','column');
		  for (var cat = 0; cat < 4; cat++)
		  {
		  	  
		  options.xAxis.categories.push( items_Pyramid[cat]); 
		  }
		  	 
		  options.title.text = companyname; 
		   options.subtitle.text = "Current Month Blended"; 
		  options.yAxis.title.text = "%"; 
		  for(var ser=0;ser<2;ser++)
			{
			
			var series = {
								data: []
							};
				
						if(ser==0)
						 {
						   series.name="Blended";
						
						  	for(var i=0;i<itemsBlended.length;i++)
                                                        //for(var i=0;i<month_counter+1;i++)
							series.data.push(parseFloat(itemsBlended[i]));
						 } 
						 
						else if(ser==1)
						 { 
						   series.name="Target";
						  
						   series.type= 'spline' ;
							for(var i=0;i<itemsTarget.length;i++)
                                                        //for(var i=0;i<month_counter+1;i++)
							 series.data.push(parseFloat(itemsTarget[i]));
		   				}
						 
					options.series.push(series);
				}
				var chart = new Highcharts.Chart(options);
		 }
		 
		 function PlotShoreGraph(companyname)
		 {
	 
		 PyramidClearOptions('shore','column');
		  for (var cat = 0; cat < 4; cat++)
		  {
		  	  
		  options.xAxis.categories.push( items_Pyramid[cat]); 
		  }
		  	 
		  options.subtitle.text = "Current Month- Onshore/Offshore"; 
		   options.title.text = companyname; 
		  options.yAxis.title.text = "%"; 
		  for(var ser=0;ser<3;ser++)
			{
			
			var series = {
								data: []
							};
				
						if(ser==0)
						 {
						  
						 series.name="Onshore";
						  	for(var i=0;i<itemsOnshore.length;i++)
                                                        //for(var i=0;i<month_counter+1;i++)
							series.data.push(parseFloat(itemsOnshore[i]));
						 } 
						else if(ser==1)
						 { 
						  
							   series.name="Offshore";
								for(var i=0;i<itemsOffshore.length;i++)
                                                                //for(var i=0;i<month_counter+1;i++)
							 series.data.push(parseFloat(itemsOffshore[i]));
							 
		   				}
						else if(ser==2)
						 { 
						  
						   series.name="Target";
						   series.type= 'spline' ;
							for(var i=0;i<itemsTarget.length;i++)
                                                        //for(var i=0;i<month_counter+1;i++)
							 series.data.push(parseFloat(itemsTarget[i]));
		   				}
						 
					options.series.push(series);
				}
				var chart = new Highcharts.Chart(options);
		 }
		 function PyramidArrayList(comName)
		{
		 
			itemsOnshore = [];
			itemsOffshore = [];
			itemsTarget = [];
			itemsBlended =[];
			var rnum=0;
			for (var row = 0; row < rCountPyramid; row++)
			{
				if(itemArrayPyramid[row][0]== comName)
				 {
						itemsOnshore[rnum]=itemArrayPyramid[row][2];
						itemsOffshore[rnum]=itemArrayPyramid[row][3];
						itemsTarget[rnum]=itemArrayPyramid[row][4];
						itemsBlended[rnum]=itemArrayPyramid[row][5];
					
					rnum++;
				 }
		   } 
		
		}
	
		 
		 
        //'cellclick' function is used to plot graph when respective coumn cell is clicked 	
	function cellclick(companyname, columnname)
		{
		  document.getElementById('chartHolder').style.display   = "";
		  document.getElementById('pyramidGraph').style.display   = "none";
		   document.getElementById('account').style.display   = "none";
		  document.getElementById('chartHolder').style.visibility = 'visible';
			  
            rcount=rowcount;
			arrayList(columnname,companyname);
			PyramidClearOptions('chartHolder','line');
			for (var cat = 0; cat < 12; cat++)
			options.xAxis.categories.push(items_Categories[cat]); 
						
			options.title.text = companyname; 
		 
			for(var ser=0;ser<2;ser++)
			{		
			  
				if(ser==1 && (columnname == "Rightshore" || columnname == "AET_Hrs" ||columnname == "Ticket_Volume_Hrs"))
				break; 
				var series = {
								data: []
							}; 
				
				switch(columnname)
				{
					case "Rightshore":
									 { 
									   
										
										 options.subtitle.text = "Rightshore %"; 
																	
										series.name="Rightshore";																 
										break;
									 }
					case "Offshore_Headcount":
									 { 
										options.subtitle.text = " Headcount"; 
										 series.name = items_Series[ser];
										break;
									 }
					case "Onshore_Headcount":
									 {
										 options.subtitle.text = " Headcount ";
										  series.name = items_Series[ser];
										break;
									 }
					case "AET_Hrs":
									 {
										options.subtitle.text = " AET Hours "; 
										series.name="AET Hours";
										break;
									 }
					case "Ticket_Volume_Hrs":
									 {
										options.subtitle.text = " Ticket Volume Hours ";
										series.name="Ticket Volume Hours";
										break;
									 }
					case "Attrition_Offshore":
									 {
										options.subtitle.text = " Attrition % ";
										series.name = items_Series[ser];
										break;
									 }
					case "Attrition_Onshore":
									 {
										 options.subtitle.text = " Attrition % "; 
										 series.name = items_Series[ser];
										break;
									 }
					case "ITIL_Offshore":
									 {
										  options.subtitle.text = " ITIL % ";
										  series.name = items_Series[ser];
										break;
									 }
					case "ITIL_Onshore":
									 {
										  options.subtitle.text = " ITIL % ";
										  series.name = items_Series[ser];
										break;
									 }
				}
		
				options.yAxis.title.text = "%"; 
				
						if(ser==0)
						 {
						  	//for(var i=0;i<items_Offshore.length;i++)
                                                        for(var i=0;i<month_counter+1;i++)
							series.data.push(parseFloat(items_Offshore[i]));
						 } 
						else if(ser==1)
						 { 
							//for(var i=0;i<items_Onshore.length;i++)
                                                        for(var i=0;i<month_counter+1;i++)
							{
								if(items_Onshore[i] == null)
									series.data.push(null);
								else
									series.data.push(parseFloat(items_Onshore[i]));
							}
		   				}
					options.series.push(series);
				}
				var chart = new Highcharts.Chart(options);
							
		}
	  
	//'arrayList' function is used to build onshor/offshore array for graph plotting
	function arrayList(field,comName)
		{
			 items_Offshore=[];
			 items_Onshore=[];
			 var rnum=0;
				switch(field)
				{
					case "Rightshore":
									 { 
										for (var row = 0; row < rcount; row++)
										{
											if(itemArray[row][0]== comName)
											  {
												items_Offshore[rnum]=itemArray[row][1];
												items_Onshore[rnum]=null; 
												 rnum++;
											  }
										 }
										break;
									 }
					case "Offshore_Headcount":
									 {
										fieldData(2,comName,'off');	
										break;
									 }
					case "Onshore_Headcount":
									 {
										fieldData(3,comName,'on');	
										break;
									 }
					case "AET_Hrs":
									 {
										for (var row = 0; row < rcount; row++)
										{
											if(itemArray[row][0]== comName)
											  {
												items_Offshore[rnum]=itemArray[row][4];
												items_Onshore[rnum]=null; 
												rnum++;
											  }
										}
										break;
									 }
					case "Ticket_Volume_Hrs":
									 {
										for (var row = 0; row < rcount; row++)
										{
											if(itemArray[row][0]== comName)
											  {
												items_Offshore[rnum]=itemArray[row][5];
												items_Onshore[rnum]=null; 
												rnum++;
											  }
										}
										break;
									 }
					case "Attrition_Offshore":
									 {
										fieldData(6,comName,'off');	
										break;
									 }
					case "Attrition_Onshore":
									 {
										fieldData(7,comName,'on');	
										break;
									 }
					case "ITIL_Offshore":
									 {
										fieldData(8,comName,'off');	
										break;
									 }
					case "ITIL_Onshore":
									 {
										fieldData(9,comName,'on');	
										break;
									 }
				}
		
		}
	
	 //'fieldData' function is used to form the onshore/offshore array based on the column cell clicked
	function fieldData(col_Ind,coName,shore)
		{
			 items_Offshore=[];
			 items_Onshore=[];
			 var fdnum=0;
			 for (var row = 0; row < rcount; row++)
			 {
				 if(itemArray[row][0]== coName)
				  {
						if(shore=='on')
						{
							 items_Offshore[fdnum]=itemArray[row][col_Ind-1];
							 items_Onshore[fdnum]=itemArray[row][col_Ind];
							 fdnum++;
					    }
						else
						{
							 items_Offshore[fdnum]=itemArray[row][col_Ind];
							 items_Onshore[fdnum]=itemArray[row][col_Ind+1];
							 fdnum++;
						}
					    
				  }
			} 
		}
	
	//'Gt_Click' function is used to form grand total  onshore/offshore array on grand total/column headers click
	function Gt_Click(col_Ind,shore)
		{
		   
			 gt_items_Offshore=[];
			 gt_items_Onshore=[];
			 var fdnum=0;
				 
			 for (var row = 0; row < gt_rowcount; row++)
			 {
						if(shore=='on')
						{
							 gt_items_Offshore[fdnum]=gt_itemArray[row][col_Ind-1];
							 gt_items_Onshore[fdnum]=gt_itemArray[row][col_Ind];
							 fdnum++;
					    }
						else if(shore=='off')
						{
							 gt_items_Offshore[fdnum]=gt_itemArray[row][col_Ind];
							 gt_items_Onshore[fdnum]=gt_itemArray[row][col_Ind+1];
							 fdnum++;
						}
						else
						{
							gt_items_Offshore[fdnum]=gt_itemArray[row][col_Ind];
							gt_items_Onshore[fdnum]=null;
							 fdnum++;
						}
							  
			} 
	  }
        
        //'gt_click' function is used to plot graph on 'Grand Total' and column header click	
	function gt_click(colnum)
			{
			  document.getElementById('chartHolder').style.display   = "";
		      document.getElementById('pyramidGraph').style.display   = "none";
			   document.getElementById('account').style.display   = "none";
			  document.getElementById('chartHolder').style.visibility = 'visible';
				
				PyramidClearOptions('chartHolder','line');
				for (var cat = 0; cat < 12; cat++)
				options.xAxis.categories.push(items_Categories[cat]); 
				options.title.text = "GRAND TOTAL"; 
				options.yAxis.title.text = "%"; 

				for(var ser=0;ser<2;ser++)
				{				
					if(ser==1 && (colnum == 1 || colnum == 4 ||colnum == 5))
					break;
					var series = {
									data: []
								 }; 
					    
					switch(colnum)
					{
						case 1:	 
							   {
								   options.subtitle.text = "Rightshore %"; 
								   series.name="Rightshore";		
								   Gt_Click(colnum,'n');
								   break;
							   }
						case 2:
							   {
									options.subtitle.text = " Headcount"; 
									series.name = items_Series[ser];
									Gt_Click(colnum,'off');
									break;
								}
						case 3:
							   {
								   options.subtitle.text = " Headcount ";
								   series.name = items_Series[ser];
								   Gt_Click(colnum,'on');
								   break;						 
							   }
						case 4:
							   {
								   options.subtitle.text = " AET Hours ";
								   series.name="AET Hours";
								   Gt_Click(colnum,'n');
								   break;						 
							   }
					   case 5:
							   {
								   options.subtitle.text = " Ticket Volume Hours ";
								   series.name="Ticket Volume Hours";
								   Gt_Click(colnum,'n');
								   break;						 
							   }
						case 6:
							   {
								   options.subtitle.text = " Attrition % ";
								   series.name = items_Series[ser];
								   Gt_Click(colnum,'off');
								   break;						 
							   }
							   
						case 7:
							   {
								   options.subtitle.text = " Attrition % ";
								   series.name = items_Series[ser];
								   Gt_Click(colnum,'on');
								   break;						 
							   }
						case 8:
							   {
								   options.subtitle.text = " ITIL % ";
								   series.name = items_Series[ser];
								   Gt_Click(colnum,'off');
								   break;						 
							   }
						case 9:
							   {
								   options.subtitle.text = " ITIL % ";
								   series.name = items_Series[ser];
								   Gt_Click(colnum,'on');
								   break;						 
							   }
					}		
					    if(ser==0)
						 {
						 	//for(var i=0;i<gt_items_Offshore.length;i++)
                                                        for(var i=0;i<month_counter+1;i++)
							series.data.push(parseFloat(gt_items_Offshore[i]));
							 
						 }
					     else  if(ser==1)
						 { 
						   for(var i=0;i<month_counter+1;i++)
						   {
							   if(gt_items_Onshore[i] == null)
								    series.data.push(null);
							   else
									series.data.push(parseFloat(gt_items_Onshore[i]));
						   }
						 }   
					  options.series.push(series);
				 }
			      var chart = new Highcharts.Chart(options);
    	    }
        
        //'updateOrientation'  function to change the orientation on portrait/landscape view
	function updateOrientation()
	{
                if(button_sidebar % 2 !=0) {hid_show_nav();}
		var wid = $(window).width();
		if(wid>1000)
			{
			 document.getElementById('table_div').style.height = "34%";
			 document.getElementById('table_div').style.overflow="auto";
                         document.getElementById('actuals_gt').style.top= "51.5%" ;
			document.getElementById('account').style.top= "435px" ;
                         $("#button_sidebar").show();                         
                         $("#date_picker").css({'top': '200px'});
                         $("#waiting_div").css({'left': '580px'});

			}
		else
			{
			document.getElementById('account').style.top= "543px" ;
            		 document.getElementById('table_div').style.height = "36.5%" ;
			 document.getElementById('table_div').style.overflow="auto"; 
                         document.getElementById('actuals_gt').style.top= "49%" ;
						
                         $("#button_sidebar").hide();
                         $("#date_picker").css({'top': '250px'});
                         $("#waiting_div").css({'left': '380px'});
			}		
	}
	
	/* Added by Souvik on 3rd July 2012 */
	// Onclick function for company cell click to get the Account scorecard  page redirection -
    function accScoreCard()
	{
	company=company.replace("&"," ");
	location.href ="AccountScorecardUI.php?company='"+selectedCompanyName+"'";
	}
	function link()
	{
	
	window.location.href ="AccountScorecardUI.php?company='"+selectedCompanyName+"'&mnt="+month;
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
            $("#date_picker").css({'right': '15px'});
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
        $("#date_picker").css({'right': '5px'});
        plot_graph();   
    }
    button_sidebar++;
}

//funtion to plot graph on page load ; Added by Mohammed on 7th july 2012
    function plot_graph()
    {
        if(last_company != "")
            cellclick(last_company,category);
        else
           gt_click(1);
                
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
		<a onclick="location.href='./home.php'" class="float_left button">
			Back
		</a>
		<a onclick="location.href='./logout.php'" class="float_right button">
			Sign out
		</a>
		<a class="icon icon_refresh float_right" onclick="location.href='./OperationalMetricsAmUI.php?metrics=<?php echo $metrics;?>&sector=<?php echo $sector;?>&mnt=<?php echo $mnt;?>'"></a>
	
		Operational Metrics - <?php	echo $sector;	?> 
            </div>

	<!-- Navigation -->
            <div id="main_content" class="abs">
		<div id="main_content_inner">
			<!--
                        &nbsp;&nbsp;&nbsp;
                        <img id ="calender_icon" onClick="calender_click();" src="./assets/images/icons_dark/83-calendar.png"> &nbsp;&nbsp;&nbsp;
                                            
                        <img id="arrow_calender" class="abs" style="height:6px;top:45px;left:40px;z-index:1;" src="./assets/images/ui/nav_arrow.png"/>
                        
                        
                        <div class="abs chrome_light" id="calender_dropdown" style="left:26px;width:200px;height:467px;border-color:black;border-style:solid;border-width:1px;border-radius:0px;padding:0px;top:51px;z-index:1;">
				<ul>
                                    <li  class="chrome_dark" style="padding: 10px;list-style:none; margin: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Select Month - 2012</b></li>
                                    <?php
                                    /*$calendar_months = calendar_months_BLL();
                                    $cal_rowCount =  mysql_num_rows($calendar_months) or die("display_db_query:" . mysql_error());
                                    $cal_colCount = mysql_num_fields($calendar_months) or die("display_db_query:" . mysql_error());
                                    for($column_no = 0; $column_no < $cal_rowCount; $column_no++)
                                    {   
                                        echo "<li onclick ='calender_select(". ($column_no +1) .");' class=\"chrome_light;\" style=\"font-color:black;padding: 8px;list-style: none;margin: 0;\" >";
					echo "<a>&nbsp;<b><span style='color:black;'><script language='javascript'>document.write(monthArray[" . $column_no . "]);</script></span>";
                                        echo "<span style=\"color:black;float:right;\"></span>";
					echo "</b></a>";
					echo "</li>";
                                    }
                                    echo "<script>";
                                    echo "document.getElementById('calender_dropdown').style.height = '".(45* $cal_rowCount)."px'";
                                    echo "</script>";
                                    */?>                             		
				</ul>
			</div>                       
            <script>
             $("#calender_dropdown").hide();$("#arrow_calender").hide();
            </script>
           --> 
            <h1 id="heading" align="center"  style="display:inline">
                Actuals Data 
            </h1>
            <script>
             document.getElementById('heading').innerHTML = 'Actuals Data - '+items_Categories[<?php  echo $mnt-1; ?>]+' 2012';
            </script>            
            <br/><br/>
            
            <table class="abs data" id="column_Header" style="width:91%;font-size:10px;">
		<thead>
			<tr>
						<th style="width:19%" >
						      <span><b>Company</b></span>
						</th>
						<th id="class_gt_rev" onclick="gt_click(1);"style="width:9%;text-align:center" >
							<b>Rightshore %</b>
						</th>
						
						<th id="class_gt_con" onclick="gt_click(2);" style="width:9%;text-align:center" >
							<b>Offshore Headcount</b>
						</th>
						<th id="class_gt_con" onclick="gt_click(3);" style="width:9%;text-align:center" >
							<b>Onshore Headcount</b>
						</th>
						<th id="class_gt_conp" onclick="gt_click(4);" style="width:9%;text-align:center" >
							<b>AET Hours</b>
						</th>
						<th id="class_gt_book" onclick="gt_click(5);" style="width:9%;text-align:center"  >
							<b>Ticket Volume Hours</b>
						</th>
						<th id="class_gt_pipe" onclick="gt_click(6);" style="width:9%;text-align:center" >
							<b>Attrition OffShore %</b>
						</th>
						<th id="class_gt_dor" onclick="gt_click(7);" style="width:9%;text-align:center" >
							<b>Attrition OnShore %</b>
						</th>
						<th id="class_gt_dor" onclick="gt_click(8);" style="width:9%;text-align:center" >
							<b>ITIL OffShore %</b>
						</th>
						<th id="class_gt_dor" onclick="gt_click(9);" style="width:9%;text-align:center" >
							<b>ITIL OnShore %</b>
						</th>
                            </tr>
                    </thead>
            </table>
           
            <div  class="abs" style="top:120px;display:inline;background-color:#FFFFFF; width:91%;height:35%; overflow: auto;" id="table_div" >			
                <div id="wrapper" style="height:100%;">
                    <table border='1' class="data abs" id="actuals" style="width:99.8%;font-size:12px;">
			<tbody id="table_body" style="overflow-y: auto">		
                        <!--Operational table formation-->
			<?php
                        $rightShore = 0.0;$offHeadCount = 0.0;$onHeadCount = 0.0;$aetHours = 0.0;$tktVolHours = 0.0;$attOff= 0.0;$attOn = 0.0;$itOff = 0.0;$itOn = 0.0;
                        //Query to retreive all the column details with respect to the month in the query string and form the table dynamically on display
                        $opResult = table_data_BLL($mnt);
                        $colCount=  mysql_num_fields($opResult) or die("display_db_query:" . mysql_error());
			$roCount=  mysql_num_rows($opResult) or die("display_db_query:" . mysql_error());
			
                        while($row = mysql_fetch_array($opResult))
			            {
                            print("<tr>");
                            for($column_num = 0; $column_num < $colCount; $column_num++) 
                            {
							$fieldname = mysql_field_name($opResult, $column_num);
							if($column_num ==0)
							{
							    /* 'onClick' event- added by Souvik on 3rd July 2012  onClick='accScoreCard(\"".$row[$column_num] ."\");'*/
                                                            print("<TD style='width:19%' onclick=\"javascript:GetCompanyPyramidGraphs('".$row[$column_num]."');\" id='" . $row[0] ."'>" .strtoupper($row[$column_num]) . "</TD>\n");
							}
							else
							{
                                                            print("<TD onclick=\"category='$fieldname';last_company='$row[0]';javascript:cellclick('" . $row[0]."', '" . $fieldname . "');\" style='width:9%;text-align:center' id='" . $fieldname . "_" . $row[0] . "' >" . $row[$column_num] . "</TD>\n");
							}
							
                            }
						
                                                        $rightShore = $rightShore+$row[1]; 
							$offHeadCount =$offHeadCount+$row[2];
							$onHeadCount =$onHeadCount+$row[3];
							$aetHours =$aetHours+$row[4];
							$tktVolHours =$tktVolHours+$row[5];
							$attOff= $attOff+$row[6];
							$attOn = $attOn+$row[7];
							$itOff =$itOff+$row[8];
							$itOn =$itOn+$row[9];
						 
                                                        print("</tr>\n");						
			}
							$rightShore =number_format(($rightShore/$roCount), 1, '.', ''); 
							$aetHours =number_format(($aetHours/$roCount), 1, '.', '');  
							$attOff=number_format(($attOff/$roCount), 1, '.', '');    
							$attOn =number_format(($attOn/$roCount), 1, '.', '');    
							$itOff =number_format(($itOff/$roCount), 1, '.', '');   
							$itOn =number_format(($itOn/$roCount), 1, '.', '');   
			?>
                        </tbody>	
                    </table>
                    <!--To get all the columns from 'operationalmetrics' table and store in an Array to refer later for graph plotting -->
                     <?php
                                $graph_result = graph_data_BLL();
				$column_count = mysql_num_fields($graph_result) or die("display_db_query1:" . mysql_error());
				$row_count=  mysql_num_rows($graph_result) or die("display_db_query2:" . mysql_error());
				
				//Array within an array declared based on the number of rows returned
				echo "<script type='text/javascript'>\n";
                                echo "var rowcount = $row_count;\n"; 
                                echo "var itemArray = new Array(".$row_count.");\n"; 
				echo "for (i=0; i <".$row_count."; i++)\n"; 
				echo "itemArray[i]=new Array(".$row_count.");\n"; 
				$rowcount=0;				
				//Array formed out of the query result fetching all the rows from the table 'operationalmetrics'
				while($row = mysql_fetch_array($graph_result))
				{
					for($column_no = 0; $column_no < $column_count; $column_no++) 
                                            echo "itemArray[".$rowcount."][".$column_no."]= '".$row[$column_no]."';\n";
					$rowcount++;
				}
				echo "</script>\n";
                        
                        //To get sum and avg of all the company details for each month in the table 'operationalmetrics'
                        $result_gt =   graph_data_gt_BLL();
    			$gt_colcount = mysql_num_fields($result_gt) or die("display_db_query:" . mysql_error());
			$gt_rowcount=  mysql_num_rows($result_gt) or die("display_db_query:" . mysql_error());
                        //Array within an array declared based on the number of rows returned
			echo "<script type='text/javascript'>\n"; 
			echo "var gt_rowcount=".$gt_rowcount.";\n";
			echo "var gt_itemArray = new Array(".$gt_rowcount.");\n"; 
			echo "for (i=0; i <".$gt_rowcount."; i++)\n"; 
			echo "gt_itemArray[i]=new Array(".$gt_rowcount.");\n"; 
			$gt_rcount=0;
			//Array formed out of the query result fetching sum and avg. of all company details from the table 'operationalmetrics'
			while($row = mysql_fetch_array($result_gt))
			{
                            for($column_no = 0; $column_no < $gt_colcount; $column_no++) 
                            	echo "gt_itemArray[".$gt_rcount."][".$column_no."]= '".$row[$column_no]."';\n";
                            $gt_rcount++;
			}
			echo "</script>\n";
			
			 $result_pyramid =   graph_data_pyramid_BLL();
    			$pyramid_colcount = mysql_num_fields( $result_pyramid ) or die("display_db_query:" . mysql_error());
			$pyramid_rowcount=  mysql_num_rows( $result_pyramid ) or die("display_db_query:" . mysql_error());
			
                        //Array within an array declared based on the number of rows returned
			echo "<script type='text/javascript'>\n"; 
			echo "var rCountPyramid=".$pyramid_rowcount.";\n";
			echo "var itemArrayPyramid = new Array(".$pyramid_rowcount.");\n"; 
			echo "for (i=0; i <".$pyramid_rowcount."; i++)\n"; 
			echo "itemArrayPyramid[i]=new Array(".$pyramid_rowcount.");\n"; 
			$rwCount=0;
			//Array formed out of the query result fetching sum and avg. of all company details from the table 'operationalmetrics'
			while($row = mysql_fetch_array($result_pyramid))
			{
                            for($column_no = 0; $column_no < $pyramid_colcount; $column_no++) 
                            	echo "itemArrayPyramid[".$rwCount."][".$column_no."]= '".$row[$column_no]."';\n";
                            $rwCount++;
			}
			echo "</script>\n";
                    ?>			
		 </div>
		<script type="text/javascript">
			$(document).ready(function() {
			var myScroll = new iScroll('wrapper');});
		</script>
            </div>
            <table  class="abs data" id="actuals_gt" style="width:90.8%;font-size:12px;">	
		<tr >
                <tbody style="border:1px solid gray;">
                    <td class="gt_Operational"  style="width:19%"><b>Grand Total</b></td>
                    <td id="gt_rightShore"      onclick="gt_click(1);" class="cl_gt_rightShore" style="width:9%;text-align:center"/>
                    <td id="gt_offHeadCount"    onclick="gt_click(2);"  class="cl_gt_offHeadCount" style="width:9%;text-align:center"/>
                    <td id="gt_onHeadCount"     onclick="gt_click(3);"  class="cl_gt_onHeadCount" style="width:9%;text-align:center"/>
                    <td id="gt_aetHours"        onclick="gt_click(4);" class="cl_gt_aetHours" style="width:9%;text-align:center"/>
                    <td id="gt_tktVolHours"     onclick="gt_click(5);"  class="cl_gt_tktVolHours" style="width:9%;text-align:center"/>
                    <td id="gt_attOff"          onclick="gt_click(6);" class="cl_gt_attOff" style="width:9%;text-align:center"/> 
                    <td id="gt_attOn"           onclick="gt_click(7);" class="cl_gt_attOn" style="width:9%;text-align:center"/> 
                    <td id="gt_itOff"           onclick="gt_click(8);"  class="cl_gt_itOff" style="width:9%;text-align:center"/> 
                    <td id="gt_itOn"            onclick="gt_click(9);" class="cl_gt_itOn" style="width:9%;text-align:center"/> 
                 </tbody>
                </tr>
            </table>
            <script type="text/javascript">                                                                                                                                        
			 document.getElementById('gt_rightShore').innerHTML = '<?php echo $rightShore;?>';
			 document.getElementById('gt_offHeadCount').innerHTML = '<?php echo $offHeadCount;?>';
			 document.getElementById('gt_onHeadCount').innerHTML = '<?php echo $onHeadCount;?>';
			 document.getElementById('gt_aetHours').innerHTML = '<?php echo $aetHours;?>';
			 document.getElementById('gt_tktVolHours').innerHTML = '<?php echo $tktVolHours;?>';
			 document.getElementById('gt_attOff').innerHTML = '<?php echo $attOff;?>';
			 document.getElementById('gt_attOn').innerHTML = '<?php echo $attOn;?>';
			 document.getElementById('gt_itOff').innerHTML = '<?php echo $itOff;?>';
			 document.getElementById('gt_itOn').innerHTML = '<?php echo $itOn;?>';
            </script>
			 
            <div id="chartHolder"  style="bottom:0;position:absolute; width: 90%; height: 40%"></div>
			 
			<div id="pyramidGraph"     style="bottom:0;position:absolute; width: 90%; height: 40%">
			 
			<div id="shore" style="width:50%; height: 90%; display:inline-block;float:left;"></div>
			<div id="blended" style="width:50%; height: 90%; display:inline-block; float:right;"></div>
			</div>  
			
			 
        </div>
    </div>
	
	<div id="account"  style="top:430px;text-align: right;position:absolute; width: 98%; height: 40%; " >
        <input type="submit" name="submit" value="Account Management Scorecard" class="button" onclick="link()" style="width:205px; height:10%;font-size:13px;"/>
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
					<a onclick="alert('Data not available')">Top 25</a>
				</li>
				<li>
					<a onclick="location.href='./OperationalMetricsAmUI.php?metrics=op&sector=AM&mnt=<?php echo $_GET['mnt'];?>'">AM</a>
				</li>
				<li>
					<a onclick="alert('Data not available')">East</a>
				</li>
				<li>
					<a onclick="alert('Data not available')">West</a>
				</li>
				<li>
					<a onclick="alert('Data not available')">Canada</a>
				</li>
				<li>
					<a onclick="alert('Data not available')">Communication</a>
				</li>
				<li>
					<a onclick="alert('Data not available')">Government</a>
				</li>
				<li>
					<a onclick="location.href='./settings.php'">Settings</a>
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
updateOrientation();
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
            month_counter =++month_counter %12; 
            ajax_data_load(month_counter + 1);
        }      
      else
        {        	
        	alert("Data not available");
        }  
          
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
            month_counter =--month_counter %12; 
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
              
              document.getElementById('gt_rightShore').innerHTML   = responseArray[1];
              document.getElementById('gt_offHeadCount').innerHTML = responseArray[2];
              document.getElementById('gt_onHeadCount').innerHTML  = responseArray[3];
	      document.getElementById('gt_aetHours').innerHTML     = responseArray[4];
	      document.getElementById('gt_tktVolHours').innerHTML  = responseArray[5];
	      document.getElementById('gt_attOff').innerHTML       = responseArray[6];
	      document.getElementById('gt_attOn').innerHTML        = responseArray[7];
	      document.getElementById('gt_itOff').innerHTML        = responseArray[8];
	      document.getElementById('gt_itOn').innerHTML         = responseArray[9];
              
              setTimeout(function () {myScroll.refresh();}, 0);   
              $("#waiting").hide();
              //var month_header_var;
              if(ajax_month == 1)       {month_counter =0;}
              else if(ajax_month == 2)  {month_counter =1;}
              else if(ajax_month == 3)  {month_counter =2;}
              else if(ajax_month == 4)  {month_counter =3;}
              else if(ajax_month == 5)  {month_counter =4;}
              else if(ajax_month == 6)  {month_counter =5;}
              else if(ajax_month == 7)  {month_counter =6;}
              else if(ajax_month == 8)  {month_counter =7;}
              else if(ajax_month == 9)  {month_counter =8;}
              else if(ajax_month == 10) {month_counter =9;}
              else if(ajax_month == 11) {month_counter =10;}
              else if(ajax_month == 12) {month_counter =11;}
              
              document.getElementById('heading').innerHTML = 'Actuals Data - '+ items_Categories[ajax_month -1]+' 2012';              
              plot_graph();
            }
        }
        xmlhttp.open("GET","OM_AM_AJAX.php?mnt="+ajax_month,true);
        xmlhttp.send();
		month=month_counter+1;
		//alert("b:"+month);
}

$(document).on('keyup', function() {setTimeout(function validate(){
     
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
            //document.getElementById("date_box").value = date_months[month_counter_value];
         }
        else
        {
           alert("Data not available");
        }
     }     
    
 },1000)
});
month=month_counter+1;
//alert("a:"+month);
</script>


<div id="waiting_div" align="center" v-align="center" style="position:absolute;top:280px;left:580px"><img id="waiting" src="" /></div>
<script>
$("#waiting").hide();
</script>

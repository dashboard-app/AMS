<?php
session_start(); /// initialize session
include("passwords.php");
check_logged(); /// function checks if visitor is logged.If user is not logged the user is redirected to login.php page 
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
<!--[if IE 8]>
<link rel="stylesheet" href="assets/stylesheets/ie8.css" />
<![endif]-->
<!--[if !IE]><!-->
<!-- <script src="assets/javascripts/iscroll.js"></script>  -->
<!--<![endif]-->
<script src="assets/javascripts/jquery.js"></script>
<script src="assets/javascripts/master.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="js/highcharts.js"></script>


<script type="text/javascript">
var dropdown_click=0;
function dropdown()
{
if(dropdown_click % 2 ==0)
{$("#sort_div").show();$("#arrow").show();}
else
{$("#sort_div").hide();$("#arrow").hide();}
dropdown_click++;
}

function group_by_actuals()
{$("#actuals").show();$("#forecast").hide();$("#budget").hide();
document.getElementById('heading').innerHTML = 'Actuals Data';
$("#sort").click();}

function group_by_forecast()
{$("#actuals").hide();$("#forecast").show();$("#budget").hide();
document.getElementById('heading').innerHTML = 'Forecast Data';
$("#sort").click();}

function group_by_budget()
{$("#actuals").hide();$("#forecast").hide();$("#budget").show();
document.getElementById('heading').innerHTML = 'Budget Amounts Data';
$("#sort").click();}
</script>


<!-- High Charts -->
<!-- Table Actuals -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c1_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c1_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c1_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c1_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c1_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c1_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<!-- Company 2 - Actuals -->

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c2_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c2_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c2_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c2_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c2_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c2_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});


</script>

<!--Company 3 - Actuals -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c3_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c3_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c3_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c3_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c3_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c3_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<!--Company 4 - Actuals -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c4_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c4_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c4_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c4_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c4_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c4_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>


<!--Company 5 - Actuals -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c5_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c5_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c5_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c5_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c5_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_c5_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>


<!--Company GT- Actuals -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_gt_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_gt_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_gt_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_gt_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_gt_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#act_gt_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Actuals - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Actuals',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>



<!-- come here 2 -->
<!-- Table Forecast -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c1_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c1_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c1_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c1_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c1_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c1_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<!-- Company 2 - Forecast -->

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c2_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c2_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c2_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c2_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c2_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c2_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});


</script>

<!--Company 3 - Forecast -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c3_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c3_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c3_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c3_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c3_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c3_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<!--Company 4 - Forecast -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c4_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c4_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c4_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c4_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c4_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c4_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>


<!--Company 5 - Forecast -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c5_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c5_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c5_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c5_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c5_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_c5_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>


<!--Company GT- Forecast -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_gt_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_gt_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_gt_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_gt_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_gt_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#for_gt_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Forecast - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Forecast',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<!--come here 3 -->
<!--Budget Table -->


<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c1_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c1_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c1_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c1_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c1_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c1_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 1',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<!-- Company 2 - Budget Amounts -->

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c2_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c2_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c2_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c2_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c2_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c2_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 2',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});


</script>

<!--Company 3 - Budget Amounts -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c3_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c3_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c3_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c3_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c3_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c3_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 3',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<!--Company 4 - Budget Amounts -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c4_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c4_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c4_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c4_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c4_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c4_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 4',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>


<!--Company 5 - Budget Amounts -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c5_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c5_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c5_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c5_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c5_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_c5_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Company 5',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>


<!--Company GT- Budget Amounts -->
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_gt_rev").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Revenue ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_gt_con").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Contribution Margin ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [61, 65, 67, 40, 50, 60, 70, 80, 90, 30, 20, 40]
		
		}]
	});
 });
});
</script>

<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_gt_conp").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Contribution Margin (%)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +' (%)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_gt_book").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Bookings ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_gt_pipe").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - Pipeline ($)',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: '$ (x1000)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'$ (x1000)';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>
<script type="text/javascript">
var chart;

$(document).ready(function() {
$("#bud_gt_don").click(function(){ 
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container1',
			defaultSeriesType: 'bar',
			marginRight: 130,
			marginBottom: 35
		},
		title: {
			text: 'Grand Total',
			x: -20 //center
		},
		subtitle: {
			text: 'Budget Amounts - DON',
			x: -20
		},
		xAxis: {
			title: {
				text: '2011'
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Units'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +':2011- '+ this.y +'Uints';
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
			x: -10,	
			y: 100,
			borderWidth: 0
		},
		credits: {
    		enabled: false
  		},
		series: [{
			name: 'Budget Amounts',
			data: [10, 40, 30, 40, 50, 60, 70, 80, 90, 30, 20, 10]
		
		}]
	});
 });
});
</script>



</head>
<body>
<div id="main">
	<div class="abs header_upper chrome_dark">
		<span class="float_left button" id="button_navigation">
			Navigation
		</span>
		<a onclick="location.href='./home.php'" class="float_left button">
			Back
		</a>
		<a onclick="location.href='./logout.php'" class="float_right button">
			Sign out
		</a>
		SETTINGS
	</div>

	
	
</div>

<script type="text/javascript" src="js/highcharts.js"></script>
<script type="text/javascript" src="js/modules/exporting.js"></script>

</body>
</html>
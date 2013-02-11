<?php
include("DAL/PipeleineMetricsGraphicalOverviewDAL.php");

function monthly_wtcv_tcv_graph_data_BLL($company,$sector){
//Monthly TCV and WTCV data for stage 3-7 
$tcv_wtcv_stage37 = monthly_tcv_wtcv_stage37_DAL($company,$sector);
$column_count = mysql_num_fields($tcv_wtcv_stage37) or die("display_db_query1:" . mysql_error());

//initialize arrays
for($i=0;$i<12;$i++)
$graphArray37_wtcv[$i] = 0;

for($i=0;$i<12;$i++)
$graphArray37_tcv[$i] = 0;

//Here row[0] = month
while($row = mysql_fetch_array($tcv_wtcv_stage37))
{
    $graphArray37_wtcv[$row[0]-1]= $row[1]/1000;
    $graphArray37_tcv[$row[0]-1]= $row[2]/1000;
    
}


//Monthly TCV and WTCV data for stage 4-7 
$tcv_wtcv_stage47 = monthly_tcv_wtcv_stage47_DAL($company,$sector);
$column_count = mysql_num_fields($tcv_wtcv_stage47) or die("display_db_query2:" . mysql_error());

//initialize arrays
for($i=0;$i<12;$i++)
$graphArray47_wtcv[$i] = 0;

for($i=0;$i<12;$i++)
$graphArray47_tcv[$i] = 0;

while($row = mysql_fetch_array($tcv_wtcv_stage47))
{
    $graphArray47_wtcv[$row[0]-1]= $row[1]/1000;
    $graphArray47_tcv[$row[0]-1]= $row[2]/1000;
    	
}  

// Sold data upto the current month
$sold = monthly_sold_data_DAL($company,$sector);
$sold_row_count =  mysql_num_rows($sold) ;
$column_count = mysql_num_fields($sold);

//initialize sold array
for($i=0;$i<12;$i++)
$graph_sold[$i] = 0;
if($sold_row_count !=0)
{    
    while($row = mysql_fetch_array($sold))
    {
    $graph_sold[$row[0]-1]= $row[1]/1000;    
    }
}

//Prepare data arrays for the cumulative graph plot
//Acumulating tcv 3-7, tcv 4-7. wtcv 3-7, wtcv 4-7,sold plot

for($i=1;$i<12;$i++)
{
    $graph_sold[$i]        = $graph_sold[$i-1]        + $graph_sold[$i];
    $graphArray37_wtcv[$i] = $graphArray37_wtcv[$i-1] + $graphArray37_wtcv[$i];
    $graphArray37_tcv[$i]  = $graphArray37_tcv[$i-1]  + $graphArray37_tcv[$i];
    $graphArray47_wtcv[$i] = $graphArray47_wtcv[$i-1] + $graphArray47_wtcv[$i];
    $graphArray47_tcv[$i]  = $graphArray47_tcv[$i-1]  + $graphArray47_tcv[$i];
}

//Integrate bookings and pipeline data
for($i=0; $i<12; $i++)
{
       
    $array_37_wtcv[$i] = $graph_sold[$i]  + ($graphArray37_wtcv[$i]);
    $array_37_tcv[$i]  = $graph_sold[$i]  + ($graphArray37_tcv[$i]);
    $array_47_wtcv[$i] = $graph_sold[$i]  + ($graphArray47_wtcv[$i]);
    $array_47_tcv[$i]  = $graph_sold[$i]  + ($graphArray47_tcv[$i]);    
}
return array($array_37_wtcv,$array_37_tcv,$array_47_wtcv,$array_47_tcv,$graph_sold,$sold_row_count);
}


//Bar graph data
function ytd_wtcv_graph_data_BLL($company,$sector){
 
// Total of WTCV from stage 3-7 for the entire year, monthwise
$ytd_wtcv37 = ytd_wtcv_stage37_DAL($company,$sector);
for($i=0;$i<12;$i++) {$ytd_wtcv37_value[$i] = 0;} //initialise array 

while($row = mysql_fetch_array($ytd_wtcv37))
{
    $ytd_wtcv37_value[($row[0] - 1)] = $row[1]; //if equal assign the value
}

// Total of WTCV from stage 4-7 for the entire year, monthwise
$ytd_wtcv47 = ytd_wtcv_stage47_DAL($company,$sector);
for($i=0;$i<12;$i++) {$ytd_wtcv47_value[$i] = 0;} //initialise array 

while($row = mysql_fetch_array($ytd_wtcv47))   
{
    $ytd_wtcv47_value[($row[0] - 1)] = $row[1]; //if equal assign the value
}
//Total sold for the entire year, monthwise
$ytd_sold = ytd_sold_DAL($company,$sector);
for($i=0;$i<12;$i++) {$ytd_sold_value[$i] = 0;} //initialise array 

while($row = mysql_fetch_array($ytd_sold))   
{
    $ytd_sold_value[($row[0] - 1)] = $row[1]; //if equal assign the value
}

return array($ytd_wtcv37_value,$ytd_wtcv47_value,$ytd_sold_value);
}

?>

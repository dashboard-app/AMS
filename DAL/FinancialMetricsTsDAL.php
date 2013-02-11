<?php
/*************************************************************************************      
Name			:  FinancialMetricsTsDAL.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  7th-July-2012 
Description     :  Financial metrics TS page dal file
Modified Date   :
Reason          :               
*************************************************************************************/

$ini_array = parse_ini_file("Config.ini"); 
$dbhost = $ini_array['host'];
$dbuser = $ini_array['user'];
$dbpass = $ini_array['password'];


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = $ini_array['database'];
mysql_select_db($dbname , $conn)or die("Could not select database");

// to find the latest month
function latest_month($tableSuffix)
{
    global $conn;
    $query = mysql_query("SELECT distinct month(month) FROM fm_ts$tableSuffix order by month",$conn);
    while($row = mysql_fetch_array($query))
    {
        $latest_month = $row[0];
    }
    return $latest_month;
}

// query to extract table data
function table_data_DAL($sector_name,$flag,$mnt,$tableSuffix)
{
    global $conn;
    $table_data = mysql_query("SELECT ts.company,sum(ts.Revenue),sum(cm$),sum(`cm%`),sum(bookings) FROM fm_ts$tableSuffix ts 
                                left outer join fm_bk$tableSuffix bk
                                on ts.company = bk.company and ts.sector=bk.sector and ts.month = bk.month
                                where ts.sector = '".$sector_name."'
                                and ts.flag= '".$flag."' and month(ts.month)= ".$mnt." group by COMPANY ",$conn); 

    return $table_data;
}

function graph_data_DAL($sector_name,$tableSuffix)
{
    global $conn;
    $graph_result = mysql_query("SELECT ts.company,ts.sector,ts.flag,ts.revenue,cm$,`cm%`,bk.bookings,month(ts.month) 
                                FROM fm_ts$tableSuffix ts 
                                left outer join fm_bk$tableSuffix bk
                                on ts.company = bk.company and
                                ts.sector = bk.sector and
                                ts.month = bk.month where ts.sector = '".$sector_name."' order by ts.month",$conn); 
    return $graph_result;
}

function graph_data_gt_DAL($sector_name,$tableSuffix)
{
    global $conn;
    $total_data = mysql_query("SELECT ts.flag,sum(ts.revenue)/1000,sum(cm$)/1000,((sum(cm$))/(sum(ts.revenue))*100),sum(bk.bookings)/1000,ts.month 
                                FROM fm_ts$tableSuffix ts 
                                left outer join fm_bk$tableSuffix bk
                                on ts.company = bk.company and
                                ts.sector = bk.sector and
                                ts.month = bk.month where ts.sector = '".$sector_name."' group by month order by month",$conn); 
    return $total_data;
}
?>

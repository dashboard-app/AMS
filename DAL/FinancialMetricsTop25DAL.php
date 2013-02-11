<?php
/*************************************************************************************      
Name			:  FinancialMetricsTop25DAL.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  7th-July-2012 
Description     :  Financial metrics Top25 page dal file
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


function latest_month($tableSuffix)
{
    $query = mysql_query("SELECT distinct month(month) FROM fm_ts$tableSuffix order by month");
    while($row = mysql_fetch_array($query))
    {
        $latest_month = $row[0];
    }
    
    return $latest_month;
}                               
                                

function graph_data_ts_DAL($tableSuffix)
{
    global $conn;
    $graph_data_ts = mysql_query("SELECT ts.company,ts.sector,ts.flag,ts.revenue,cm$,`cm%`,bk.bookings,month(ts.month) 
                                    FROM fm_ts$tableSuffix ts 
                                    left outer join fm_bk$tableSuffix bk
                                on ts.company = bk.company and
                                ts.sector = bk.sector and
                                ts.month = bk.month 
                                where ts.company in (select company from fm_ts$tableSuffix where top25='y') order by ts.month",$conn); 
    return $graph_data_ts;
}

function graph_data_am_DAL($month,$i,$tableSuffix)
{
    global $conn;
    $graph_data_am= mysql_query("select rev.companyname,'AM', 'A',rev.`".$month."-A` as Revenue,
                                    cmd.`".$month."-A` as CM$, 
                                    cmp.`".$month."-A` as `CM%`,
                                    book.`".$month."-A` as Bookings,($i+1)

                                    from fmrevenue$tableSuffix rev
                                    left outer join fmcmd$tableSuffix cmd on rev.companyname = cmd.companyname
                                    left outer join fmcmp$tableSuffix cmp on cmd.companyname = cmp.companyname
                                    left outer join fmbookings$tableSuffix book on book.companyname = cmp.companyname
                                            
                                    where rev.companyname in (select companyname from fmbookings$tableSuffix where top25='y')",$conn);  
    return $graph_data_am;
}

function table_data_ts_DAL($flag,$mnt,$tableSuffix)
{
    global $conn;
    $tsResult = mysql_query("SELECT ts.company,sum(ts.Revenue),sum(cm$), sum(`cm%`),sum(bookings) 
                                                 FROM fm_ts$tableSuffix ts 
                                                 left outer join fm_bk$tableSuffix bk
                                                 on ts.company = bk.company and ts.sector=bk.sector and ts.month = bk.month
                                                 
                                                where  ts.company in (select company from fm_ts$tableSuffix where top25='y')
                                                and ts.flag= '".$flag."' and month(ts.month)= ".$mnt." group by COMPANY ",$conn);
    return $tsResult;
}

function table_data_am_DAL($mnt,$tableSuffix)
{
    global $conn;
    if($mnt == 1) $m = 'JAN';
                             else  if($mnt == 2)$m = 'FEB';
                             else if($mnt == 3) $m = 'MAR';
                             else if($mnt == 4) $m = 'APR';
                             else if($mnt == 5) $m = 'MAY';
                             else if($mnt == 6) $m = 'JUN';
                             else if($mnt == 7) $m = 'JUL';
                             else if($mnt == 8) $m = 'AUG';
                             else if($mnt == 9) $m = 'SEP';
                             else if($mnt == 10) $m = 'OCT';
                             else if($mnt == 12) $m = 'DEC';   
    
    $amResult = mysql_query("select rev.companyname,rev.`".$m."-A` as Revenue, 
                            cmd.`".$m."-A` as CM$, 
                            cmp.`".$m."-A` as `CM%`,
                            book.`".$m."-A` as Bookings

                            from fmrevenue$tableSuffix rev
                            left outer join fmcmd$tableSuffix cmd on rev.companyname = cmd.companyname
                            left outer join fmcmp$tableSuffix cmp on cmd.companyname = cmp.companyname
                            left outer join fmbookings$tableSuffix book on book.companyname = cmp.companyname

                            where rev.companyname in (select companyname from fmbookings$tableSuffix where top25='y')",$conn);
    return $amResult;
}

function graph_grand_total_DAL($tableSuffix)
{
    global $conn;
    $total_result = mysql_query("SELECT ts.flag,sum(ts.revenue),sum(cm$),(sum(cm$)/sum(ts.revenue)*100),sum(bk.bookings),ts.month 
                                FROM fm_ts$tableSuffix ts 
                                left outer join fm_bk$tableSuffix bk
                                on ts.company = bk.company and
                                ts.sector = bk.sector and
                                ts.month = bk.month 
                                where ts.company in (select company from fm_ts$tableSuffix where top25='y') group by month",$conn);
    return $total_result;
}
?>

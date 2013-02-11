<?php
/*************************************************************************************      
Name			:  FinancialMetricsAmDAL.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  7th-July-2012 
Description     :  Financial metrics AM page dal file
Modified Date   :
Reason          :               
*************************************************************************************/
    //DB connection details
    $ini_array = parse_ini_file("Config.ini");
    $dbhost = $ini_array['host'];
    $dbuser = $ini_array['user'];
    $dbpass = $ini_array['password'];
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = $ini_array['database'];
    
    mysql_select_db($dbname , $conn) or die("Could not select database"); 
    
    // To find the latest month - $mnt_name, $latest_month
    function latest_month($tableSuffix)
    {
    global $conn;
    $month_name = array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
    $month_array = array('01','02','03','04','05','06','07','08','09','10','11','12');
    $break ='n';
    for($i=0;($i<12 && $break == 'n');$i++)
    {
       $result = mysql_query("SELECT sum(`$month_name[$i]-A`) from fmbookings$tableSuffix",$conn); 

       while($row = mysql_fetch_array($result))
       {
         if($row[0] == 0)
         {
            $mnt_name = $month_name[$i-1];
            $latest_month = $month_array[$i-1];
            $break = 'y';
         }
      }
    }
    return $latest_month;
    }
    
   //data table query
   function data_table_query_DAL($ytd_yel_query_string,$mnt,$category,$tableSuffix)
   {  
    global $conn; 
      
    if($category == "Revenue" || $category == "CM$" || $category == "Bookings")
    {
        if($category == "Revenue")       $table_name = "fmrevenue";
        else if($category == "CM$")      $table_name = "fmcmd";
        else if($category == "Bookings") $table_name = "fmbookings";
        
        $ytd_act    = $ytd_yel_query_string[0];
        $yel_act    = $ytd_yel_query_string[1];
        $ytd_for    = $ytd_yel_query_string[2];
        $yel_for    = $ytd_yel_query_string[3];
        $ytd_bud    = $ytd_yel_query_string[4];
        $yel_bud    = $ytd_yel_query_string[5];       
    
        $result_table = mysql_query("select companyname,
                            
                        `$mnt-A` as Actuals,
                        $ytd_act, $yel_act,
                        
                        `$mnt-F`as Forecast,
                        $ytd_for,  $yel_for,
                        
                        `$mnt-B` as Budget,
                        $ytd_bud,  $yel_bud                        
                                              
                        from $table_name$tableSuffix
                        ",$conn); 
    }
    
    else if($category == "DOR")
    {
        $result_table = mysql_query(" select companyname,                            
                                    `$mnt-A` as Actuals,
                                     0.0,0.0,
                                     0.0,
                                     0.0,0.0,
                                    `$mnt-B` as Budget,  
                                     0.0,0.0
                                    from fmdor$tableSuffix dor
                                    ",$conn); 
    }
   //for cm% use (cm$/revenue)
    else if($category == "CM%")
    {
        $ytd_act_cmd    = "cmd.".str_replace("+", "+cmd.",$ytd_yel_query_string[0]);
        $yel_act_cmd    = "cmd.".str_replace("+", "+cmd.",$ytd_yel_query_string[1]);
        $ytd_for_cmd    = "cmd.".str_replace("+", "+cmd.",$ytd_yel_query_string[2]);
        $yel_for_cmd    = "cmd.".str_replace("+", "+cmd.",$ytd_yel_query_string[3]);
        $ytd_bud_cmd    = "cmd.".str_replace("+", "+cmd.",$ytd_yel_query_string[4]);
        $yel_bud_cmd    = "cmd.".str_replace("+", "+cmd.",$ytd_yel_query_string[5]);
        
        $ytd_act_rev    = "rev.".str_replace("+", "+rev.",$ytd_yel_query_string[0]);
        $yel_act_rev    = "rev.".str_replace("+", "+rev.",$ytd_yel_query_string[1]);
        $ytd_for_rev    = "rev.".str_replace("+", "+rev.",$ytd_yel_query_string[2]);
        $yel_for_rev    = "rev.".str_replace("+", "+rev.",$ytd_yel_query_string[3]);
        $ytd_bud_rev    = "rev.".str_replace("+", "+rev.",$ytd_yel_query_string[4]);
        $yel_bud_rev    = "rev.".str_replace("+", "+rev.",$ytd_yel_query_string[5]);
        
        $result_table = mysql_query("select cmp.companyname,
                            
                        cmp.`$mnt-A` as Actuals,
                        (($ytd_act_cmd) / ($ytd_act_rev)*100), 
                        (($yel_act_cmd)/($yel_act_rev)*100),
                
                        
                        cmp.`$mnt-F`as Forecast,
                        (($ytd_for_cmd)/($ytd_for_rev)*100), 
                        (($yel_for_cmd)/($yel_for_rev)*100),
                        
                        cmp.`$mnt-B` as Budget,
                        (($ytd_bud_cmd)/($ytd_bud_rev)*100), 
                        (($yel_bud_cmd)/($yel_bud_rev)*100)                       
                                              
                        from fmcmp$tableSuffix cmp
                        left outer join fmcmd$tableSuffix cmd on
                        cmd.companyname = cmp.companyname
                        left outer join fmrevenue rev on
                        rev.companyname = cmd.companyname
                        ",$conn); 
    }
    
    return $result_table;
    }
   
    //to display graph data on the client side
    function graph_data_query_DAL($ytd_yel_query_string,$flag,$mnt,$category,$tableSuffix)
    {
        global $conn;
        if($category != "CM%")
        {
            if($category == "Revenue")       $table_name = "fmrevenue";
            else if($category == "CM$")      $table_name = "fmcmd";    
            else if($category == "Bookings") $table_name = "fmbookings";
            else if($category == "DOR") $table_name = "fmdor";
            
            $ytd_act    = $ytd_yel_query_string[0];
            $yel_act    = $ytd_yel_query_string[1];
            $ytd_for    = $ytd_yel_query_string[2];
            $yel_for    = $ytd_yel_query_string[3];
            $ytd_bud    = $ytd_yel_query_string[4];
            $yel_bud    = $ytd_yel_query_string[5];
    
            if($flag =='A')       {$ytd = $ytd_act ;$yel = $yel_act ;}
            else if($flag =='F')  {$ytd = $ytd_for ;$yel = $yel_for ;}
            else if($flag =='B')  {$ytd = $ytd_bud ;$yel = $yel_bud ;} 
    
           $result_graph = mysql_query("select companyname,`$mnt-$flag`,$ytd,$yel 
                                        from $table_name$tableSuffix
                                        ",$conn);
        }
        else
        {
            $ytd_act_cmd    = "cmd.".str_replace("+", "+cmd.",$ytd_yel_query_string[0]);
            $yel_act_cmd    = "cmd.".str_replace("+", "+cmd.",$ytd_yel_query_string[1]);
            $ytd_for_cmd    = "cmd.".str_replace("+", "+cmd.",$ytd_yel_query_string[2]);
            $yel_for_cmd    = "cmd.".str_replace("+", "+cmd.",$ytd_yel_query_string[3]);
            $ytd_bud_cmd    = "cmd.".str_replace("+", "+cmd.",$ytd_yel_query_string[4]);
            $yel_bud_cmd    = "cmd.".str_replace("+", "+cmd.",$ytd_yel_query_string[5]);
        
            $ytd_act_rev    = "rev.".str_replace("+", "+rev.",$ytd_yel_query_string[0]);
            $yel_act_rev    = "rev.".str_replace("+", "+rev.",$ytd_yel_query_string[1]);
            $ytd_for_rev    = "rev.".str_replace("+", "+rev.",$ytd_yel_query_string[2]);
            $yel_for_rev    = "rev.".str_replace("+", "+rev.",$ytd_yel_query_string[3]);
            $ytd_bud_rev    = "rev.".str_replace("+", "+rev.",$ytd_yel_query_string[4]);
            $yel_bud_rev    = "rev.".str_replace("+", "+rev.",$ytd_yel_query_string[5]);
            
            if($flag =='A')       
            {
                $ytd_cmd = $ytd_act_cmd;
                $ytd_rev = $ytd_act_rev; 
                $yel_cmd = $yel_act_cmd;
                $yel_rev = $yel_act_rev;
            }
            else if($flag =='F')  
            {
                $ytd_cmd = $ytd_for_cmd;
                $ytd_rev = $ytd_for_rev; 
                $yel_cmd = $yel_for_cmd;
                $yel_rev = $yel_for_rev;
            }
            else if($flag =='B')  
            {
                $ytd_cmd = $ytd_bud_cmd;
                $ytd_rev = $ytd_bud_rev; 
                $yel_cmd = $yel_bud_cmd;
                $yel_rev = $yel_bud_rev;
            }

            
            $result_graph = mysql_query("select cmp.companyname,cmp.`$mnt-$flag`,(($ytd_cmd)/($ytd_rev)*100),(($yel_cmd)/($yel_rev)*100)                                        
                                        from fmcmp$tableSuffix cmp
                                        left outer join fmcmd$tableSuffix cmd on
                                        cmd.companyname = cmp.companyname
                                        left outer join fmrevenue$tableSuffix rev on
                                        rev.companyname = cmd.companyname
                                        ",$conn);
            
            
        }
    return $result_graph;
}

    // graph grandtotal query
    function graph_grandtotal_query_DAL($mnt,$flag,$category,$tableSuffix)
 {
    global $conn;
    
    if($category != "CM%")
    {
        if($category == "Revenue")       $table_name = "fmrevenue";
        else if($category == "CM$")      $table_name = "fmcmd";
        else if($category == "Bookings") $table_name = "fmbookings";
        else if($category == "DOR") $table_name = "fmdor";
        
        $result_graph_grandtotal = mysql_query("select sum(`".$mnt."-".$flag."`)
                                                from $table_name$tableSuffix
                                                ",$conn);
    }
    else
    {
        $result_graph_grandtotal = mysql_query("select (sum(cmd.`".$mnt."-".$flag."`))/(sum(rev.`".$mnt."-".$flag."`))*100
                                                from fmrevenue$tableSuffix rev,fmcmd$tableSuffix cmd
                                                ",$conn);
    }
    return $result_graph_grandtotal;                           
}

function cmp_total_numbers_DAL($mnt,$tableSuffix)
{
   global $conn;
   $cmd_total_numbers = mysql_query("select (sum(cmd.`".$mnt."-A`))/(sum(rev.`".$mnt."-A`))*100,
                                    (sum(cmd.`".$mnt."-F`))/(sum(rev.`".$mnt."-F`))*100,
                                    (sum(cmd.`".$mnt."-B`))/(sum(rev.`".$mnt."-B`))*100
                                    from fmrevenue$tableSuffix rev,fmcmd$tableSuffix cmd
                                    ",$conn);
   return $cmd_total_numbers; 
   
}
?>
		
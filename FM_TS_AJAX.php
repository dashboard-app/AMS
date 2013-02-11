 <?php
    include("BLL/FinancialMetricsTsBLL.php");
    $revenue_sum =0.0;$cmd_sum =0.0;$cmp_sum=0.0;$book_sum=0.0;
    
    $mnt = $_GET['mnt'];
    $sector_name = $_GET['sector'];
    $flag = $_GET['flag'];
    $yr= $_GET['yr'];	
if($yr == "2012") { $tableSuffix = "";}
else if($yr == "2013") { $tableSuffix = "_2013"; }
    
    $display = "";
    $table_data = table_data_BLL($sector_name,$flag,$mnt,$tableSuffix);                             
    $column_count = mysql_num_fields($table_data) or die("display_db_query:" . mysql_error());
    $row_count=  mysql_num_rows($table_data) or die("display_db_query:" . mysql_error());
    
    $row_count = 0;
    while($row = mysql_fetch_array($table_data))
    {
        //// 1st column spacing
	$display = $display . "<tr id='row_$row_count'>";
	// Column Loop
        $display = $display . "<td  style='width:6.6%'></td>";
        for($column_num = 0; $column_num < $column_count; $column_num++) 
	{
            if($column_num ==0)
            {
                $display = $display . "<TD onclick='cellclick(\"$row[0]\",category);' style='width:30%'>" . strtoupper($row[$column_num]) . "</TD>";
            }
            if($column_num ==1)
            {
                $display = $display . "<TD onclick='category=\"Revenue\";cellclick(\"$row[0]\",category);' align=\"Right\" style='text-align:right;width:13.36%;'>" . number_format($row[$column_num]/1000, 1, '.', ','). "</TD>";
                $revenue_sum = $revenue_sum + ($row[$column_num])/1000;
            }
            if($column_num ==2)
            {
                $display = $display . "<TD onclick='category=\"CM$\";cellclick(\"$row[0]\",category);' align='right' style='text-align:right;width:13.36%;'>" . number_format($row[$column_num]/1000, 1, '.', ','). "</TD>";
                $cmd_sum = $cmd_sum + ($row[$column_num])/1000;
            }
            if($column_num ==3)
            {
                $display = $display . "<TD onclick='category=\"CM%\";cellclick(\"$row[0]\",category);' align='right' style='text-align:right;width:13.36%;;'>" . number_format($row[$column_num], 1, '.', ','). "</TD>";
                $cmp_sum = $cmp_sum + ($row[$column_num]);
            }
            if($column_num ==4)
            {
                $display = $display . "<TD onclick='category=\"Bookings\";cellclick(\"$row[0]\",category);' align='right' style='text-align:right;width:13.36%;'>" . number_format($row[$column_num]/1000, 1, '.', ','). "</TD>";
                $book_sum = $book_sum + ($row[$column_num]/1000);
            }
        }
        $row_count ++;
        $display = $display . "</tr>";
    }
    
    
    $display = $display  . "|" . number_format($revenue_sum , 1, '.', ',') . "|" . number_format($cmd_sum , 1, '.', ',') . "|" 
             . number_format($cmp_sum , 1, '.', ',') . "|" .number_format($book_sum , 1, '.', ',') ;
    echo $display;
?>
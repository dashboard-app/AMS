<?php
/*************************************************************************************      
Name			:  FinancialMetricsTop25BLL.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  7th-July-2012 
Description     :  Financial metrics Top25 companies page bll layer
Modified Date   :
Reason          :               
*************************************************************************************/
include("DAL/FinancialMetricsTop25DAL.php");
$latest_month = latest_month($tableSuffix);

function graph_data_ts_BLL($tableSuffix)
{
    $graph_data_ts = graph_data_ts_DAL($tableSuffix);
    return $graph_data_ts;
}

function graph_data_am_BLL($month,$i,$tableSuffix)
{
    $graph_data_am = graph_data_am_DAL($month,$i,$tableSuffix);
    return $graph_data_am;
}

function table_data_ts_BLL($flag,$mnt,$tableSuffix)
{
    $tsResult = table_data_ts_DAL($flag,$mnt,$tableSuffix);
    return $tsResult;
}

function table_data_am_BLL($mnt,$tableSuffix)
{
    $amResult = table_data_am_DAL($mnt,$tableSuffix);
    return $amResult;
}

function graph_grand_total_BLL($tableSuffix)
{
    $total_result = graph_grand_total_DAL($tableSuffix);
    return $total_result;
}
?>

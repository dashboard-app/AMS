<?php
/*************************************************************************************      
Name			:  FinancialMetricsTsBLL.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  7th-July-2012 
Description     :  Financial metrics TS page bll layer
Modified Date   :
Reason          :               
*************************************************************************************/
include("DAL/FinancialMetricsTsDAL.php");
//latest month
$latest_month = latest_month($tableSuffix);

// query table data from DAL
function table_data_BLL($sector_name,$flag,$mnt,$tableSuffix)
{
    $table_data = table_data_DAL($sector_name,$flag,$mnt,$tableSuffix);
    return $table_data;
}

function graph_data_BLL($sector_name,$tableSuffix)
{
    $graph_result = graph_data_DAL($sector_name,$tableSuffix);
    return $graph_result;
}

function graph_data_gt_BLL($sector_name,$tableSuffix)
{
    $total_data = graph_data_gt_DAL($sector_name,$tableSuffix);
    return $total_data;
}   
?>

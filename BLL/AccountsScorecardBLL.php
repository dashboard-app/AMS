<?php
include "DAL/DBOperation.php"; 
class BusinessLayer
{
public $resultSet;
public $columnCount;
public $resultSetPyramid;
public $columnCountPyramid;

public $resultSetPie;
public $columnCountPie;

public $resultSetRightShorePie;
public $columnCountRightShorePie;

public $resultSetProfitLoss;
public $columnCountProfitLoss;

public $resultSetContLev;
public $columnCountContLev;

public $resultSetMgtLev;
public $columnCountMgtLev;

public $resultSetDor;
public $columnCountDor;
public $rowCountDor;

public $resultSetCostRatio;
public $columnCountCostRatio;

public $resultSetAdrc;
public $columnCountAdrc;
public $rowCountAdrc;

public $resultSetpayment;
public $columnCountpayment;
public $rowCountpayment;

function RightShoreSelectQuery($comp_Name)
{
$db = new DataBaseOperation;
$db->DBOperations();
$finalQuery="select Flag,Target,Onshore,L1,Contractor,Offshore,RSPercentage from ".$db->dbname.".rightshore where companyname='".$comp_Name."';";
$db->GetResultSet($finalQuery);
$this->resultSet=$db->resultSet;
$this->columnCount=$db->columnCount;

}
function PyramidSelectQuery($comp_Name)
{
$db = new DataBaseOperation;
$db->DBOperations();
$finalQuery="SELECT Flag,Target,Onshore,Offshore,Blended,OnShorePercentage,OffShorePercentage,BlendedRatio FROM ".$db->dbname.".pyramid where companyname='".$comp_Name."';";
$db->GetResultSet($finalQuery);
$this->resultSetPyramid=$db->resultSet;
$this->columnCountPyramid=$db->columnCount;

}

//function to get Onshore/Offshore/Blended ratio data
function PyramidPiechartSelectQuery()
{
$db = new DataBaseOperation;
$db->DBOperations();
$finalQuery="(SELECT companyname,'D/E/F' as Flag,sum(OnShorePercentage),sum(OffShorePercentage),Target,round(blendedratio,0)  FROM ".$db->dbname.".pyramid where flag in ('D','E','F') group by companyname asc )
union all
(SELECT companyname,Flag,OnShorePercentage,OffShorePercentage,Target,round(blendedratio,0)  FROM ".$db->dbname.".pyramid where flag not in  ('D','E','F','Total') ) order by companyname,flag asc;";
$db->GetResultSet($finalQuery);
$this->resultSetPie=$db->resultSet;
$this->columnCountPie=$db->columnCount;

}


//function to get Rightshore RSPercentage data
function RightshorePiechartSelectQuery()
{
$db = new DataBaseOperation;
$db->DBOperations();
$finalQuery="(SELECT companyname,'D/E/F' as Flag,sum(RSPercentage)   FROM  ".$db->dbname.".rightshore where flag in ('D','E','F') group by companyname asc )
union all
(SELECT companyname,'A/B/C' as Flag,sum(RSPercentage)   FROM  ".$db->dbname.".rightshore where flag in ('A','B','C') group by companyname asc  ) order by companyname,flag asc;
";
$db->GetResultSet($finalQuery);
$this->resultSetRightShorePie=$db->resultSet;
$this->columnCountRightShorePie =$db->columnCount;

}

//function to get data from ProfitLoss table
function ProfitLossSelectQuery($comp_Name)
{
 
	$db = new DataBaseOperation;
	$db->DBOperations();
	$finalQuery="SELECT CompanyName,Flag,Budget,Forecast,Variance FROM ".$db->dbname.".profitloss where companyname=".$comp_Name.";";
	$db->GetResultSet($finalQuery);
	$this->resultSetProfitLoss=$db->resultSet;
	$this->columnCountProfitLoss =$db->columnCount;

}


//function to get data from ContractorLeverage table
function ContractorLeverageSelectQuery($comp_Name)
{
	$db = new DataBaseOperation;
	$db->DBOperations();
	$finalQuery="SELECT CompanyName,TotalHC,Internal,External,ExternalPercentage  from ".$db->dbname.".contractorleverage where companyname=".$comp_Name.";";
	$db->GetResultSet($finalQuery);
	$this->resultSetContLev=$db->resultSet;
	$this->columnCountContLev =$db->columnCount;

}

//function to get data from ManagementLeverage table
function ManagementLeverageSelectQuery($comp_Name)
{
	$db = new DataBaseOperation;
	$db->DBOperations();
	$finalQuery="SELECT CompanyName,MFlag,Staff,Revenue from ".$db->dbname.".managementleverage where companyname=".$comp_Name.";";
	$db->GetResultSet($finalQuery);
	$this->resultSetMgtLev=$db->resultSet;
	$this->columnCountMgtLev =$db->columnCount;

}

//function to get data from Dor table
function DORSelectQuery($comp_Name)
{
	$db = new DataBaseOperation;
	$db->DBOperations();
	$finalQuery="SELECT companyname,month,DORValue FROM ".$db->dbname.".accountdor where companyname=".$comp_Name.";";
	$db->GetResultSet($finalQuery);
	$this->resultSetDor=$db->resultSet;
	$this->columnCountDor =$db->columnCount;
	$this->rowCountDor =$db->rowCount;

}

function CostRatioSelectQuery($comp_Name)
{
	$db = new DataBaseOperation;
	$db->DBOperations();
	$finalQuery="SELECT companyname,flag,costs,percentage,actuals FROM ".$db->dbname.".costratio where companyname=".$comp_Name.";";
	$db->GetResultSet($finalQuery);
	$this->resultSetCostRatio=$db->resultSet;
	$this->columnCountCostRatio =$db->columnCount;

}


function ADRCSelectQuery($comp_Name)
{
	$db = new DataBaseOperation;
	$db->DBOperations();
	$finalQuery="SELECT CompanyName,Month,ADRCValue,Target,TargetPercentage,Actual,Delta,DeltaPercentage FROM ".$db->dbname.".adrc where companyname=".$comp_Name.";";
	$db->GetResultSet($finalQuery);
	$this->resultSetAdrc=$db->resultSet;
	$this->columnCountAdrc =$db->columnCount;
    $this->rowCountAdrc =$db->rowCount;
}

function PaymentTermsSelectQuery($comp_Name)
{
	$db = new DataBaseOperation;
	$db->DBOperations();
	$finalQuery="SELECT companyname,paymentterm FROM ".$db->dbname.".ampaymentterms where companyname=".$comp_Name.";";
	$db->GetResultSet($finalQuery);
	$this->resultSetpayment=$db->resultSet;
	$this->columnCountpayment =$db->columnCount;
    $this->rowCountpayment =$db->rowCount;
}
}


?>
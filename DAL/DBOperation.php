<?php
class DataBaseOperation
{
public  $ini_array;
public $host;
public $user ;
public $pass;
public $con;
public $dbname; 
public $myArray;
public $result_BRatio;

//variables for Pyramid resultset
public $resultPyramid;
public $pyramidColumn_count;
public $pyramidRow_count;

//common variables
public $resultSet;
public $columnCount;
public $rowCount;


function DBOperations()
{
$this->ini_array = parse_ini_file("Config.ini");
$this->host = $this->ini_array['host'];
$this->user = $this->ini_array['user'];
$this->pass = $this->ini_array['password'];
$this->con = mysql_connect($this->host, $this->user, $this->pass) or die ('Error connecting to mysql');
$this->dbname = $this->ini_array['database'];
}
 //function to calculate the BR Ratio out of  Pyramid table data from the database and storing in array
function CalculateBRRatio($company)
{
				$this->result_BRatio = 
				mysql_query("select if((SELECT sum(round(blended,0)) FROM ".$this->dbname.".pyramid where companyname=".$company.")=0, 0,round (((sum(round(blended,0))/(SELECT sum(round(blended,0)) FROM ".$this->dbname.".pyramid where companyname=".$company."))*100),2)) from ".$this->dbname.".pyramid where flag in ('F','E','D') and companyname=".$company."
				union all 
				select if((SELECT sum(round(blended,0)) FROM ".$this->dbname.".pyramid where companyname=".$company.")=0, 0,round (((round(blended,0)/(SELECT sum(round(blended,0)) FROM ".$this->dbname.".pyramid where companyname=".$company."))*100),2)) from ".$this->dbname.".pyramid where flag in ('A','B','C') and companyname=".$company." group by flag desc",$this->con); 
				
				
				
				$colCount_BR = mysql_num_fields($this->result_BRatio)
				or die("display_db_query:Data not available" . mysql_error());
				
				$rowCount_BR=  mysql_num_rows($this->result_BRatio)
				or die("display_db_query:Data not available" . mysql_error());
				 
				$this->myArray= array($rowCount_BR);	
				$c=0;				
				while($rowBR = mysql_fetch_array($this->result_BRatio))
				{
						for($colnum = 0; $colnum < $colCount_BR; $colnum++) 
						{
						$this->myArray[$c]=$rowBR[$colnum];
							 
						} 
						$c=$c+1;
				}
				
				
} 

//function to retrieve the pyramid table data from the database and storing in the resultset
function GetPyramid($company)
{
			$this->resultPyramid = mysql_query("SELECT flag,target,round(onshore,0),round(offshore,0),round(blended,0),if((SELECT sum(onshore) FROM ".$this->dbname.".pyramid where companyname=".$company.") =0, 0,round (((onshore/(SELECT sum(onshore) FROM ".$this->dbname.".pyramid where companyname=".$company."))*100),2)) as `onshore%` ,if((SELECT sum(offshore) FROM ".$this->dbname.".pyramid where companyname=".$company.") =0, 0,round (((offshore/(SELECT sum(offshore) FROM ".$this->dbname.".pyramid where companyname=".$company."))*100),2)) as `offshore%` FROM ".$this->dbname.".pyramid  where companyname=".$company." GROUP BY FLAG DESC",$this->con); 
			//	 echo "SELECT flag,target,round(onshore,0),round(offshore,0),round(blended,0),if((SELECT round(sum(onshore),0) FROM ".$this->dbname.".pyramid where companyname=".$company.") =0, 0,round (((onshore/(SELECT round(sum(onshore),0) FROM ".$this->dbname.".pyramid where companyname=".$company."))*100),0)) as `onshore%` ,if((SELECT round(sum(offshore),0) FROM ".$this->dbname.".pyramid where companyname=".$company.") =0, 0,round (((offshore/(SELECT round(sum(offshore),0) FROM ".$this->dbname.".pyramid where companyname=".$company."))*100),0)) as `offshore%` FROM ".$this->dbname.".pyramid  where companyname=".$company." GROUP BY FLAG DESC";
			  $this->pyramidColumn_count = mysql_num_fields($this->resultPyramid)
				or die("display_db_query:Data not available" . mysql_error());
			$this->pyramidRow_count=  mysql_num_rows($this->resultPyramid)
				or die("display_db_query:Data not available" . mysql_error());
}

//Common function for select operation
function GetResultSet($query)
{

			$this->resultSet = mysql_query($query,$this->con); 
			
			  $this->columnCount = mysql_num_fields($this->resultSet)
				or die("Data not available" . mysql_error());
			$this->rowCount=  mysql_num_rows($this->resultSet)
				or die("Data not available" . mysql_error());
}
}
?>
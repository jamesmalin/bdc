<?php
session_start();
// Connect database. 
$con = mysql_connect("localhost","localca4_james","rescue123");
if (!$con)
{
	die('Connect error: ' . mysql_error());
}

mysql_select_db("localca4_bdctest", $con);

// Get data records from table. 
$result=mysql_query("select * from bdc WHERE client = '".$_SESSION['thisclient']."'");

// Functions for export to excel.
function xlsBOF() { 
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0); 
return; 
} 
function xlsEOF() { 
echo pack("ss", 0x0A, 0x00); 
return; 
} 
function xlsWriteNumber($Row, $Col, $Value) { 
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0); 
echo pack("d", $Value); 
return; 
} 
function xlsWriteLabel($Row, $Col, $Value ) { 
$L = strlen($Value); 
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L); 
echo $Value; 
return; 
} 
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=registered_ups.xls "); 
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsWriteLabel(0,0,"ID");
xlsWriteLabel(0,1,"Client");
xlsWriteLabel(0,2,"Name");
xlsWriteLabel(0,3,"Phone");
xlsWriteLabel(0,4,"Email");
xlsWriteLabel(0,5,"ZIP");
xlsWriteLabel(0,6,"Source");
xlsWriteLabel(0,7,"Alert");
xlsWriteLabel(0,8,"Transfer");
xlsWriteLabel(0,9,"Appointment Day-Time");
xlsWriteLabel(0,10,"Notes");
xlsWriteLabel(0,11,"Date");
xlsWriteLabel(0,12,"Created By");


$xlsRow = 1;

// Put data records from mysql by while loop.
while($row=mysql_fetch_array($result)){

xlsWriteLabel($xlsRow,0,$row['id']);
xlsWriteLabel($xlsRow,1,$row['client']);
xlsWriteLabel($xlsRow,2,$row['name']);
xlsWriteLabel($xlsRow,3,$row['phone']);
xlsWriteLabel($xlsRow,4,$row['email']);
xlsWriteNumber($xlsRow,5,$row['zip']);
xlsWriteLabel($xlsRow,6,$row['source']);
xlsWriteLabel($xlsRow,7,$row['alert']);
xlsWriteLabel($xlsRow,8,$row['transfer']);
xlsWriteLabel($xlsRow,9,$row['appt']." - ".$row['appttime']);
xlsWriteLabel($xlsRow,10,$row['notes']);
xlsWriteLabel($xlsRow,11,$row['date']);
xlsWriteLabel($xlsRow,12,$row['created_by']);

$xlsRow++;
} 
xlsEOF();
exit();
?>
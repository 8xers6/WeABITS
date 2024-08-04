<?php
	include '../server/server.php';
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';


$barno=$_SESSION['bar_no'];
$result = mysqli_query($conn,"SELECT * FROM tblmedicine where bar_no=$barno");
$result1 = mysqli_query($conn,"SELECT * FROM inventory");
/* Create new PHPExcel object*/
$objPHPExcel = new PHPExcel();

/* Create a first sheet, representing medicine data*/
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'med_no');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'bar_no');
$i=2;
while($row = mysqli_fetch_array($result)) {
	$medno=$row['med_no'];
	$barno=$row['bar_no'];
	$objPHPExcel->getActiveSheet()->setCellValue("A$i",$medno);
	$objPHPExcel->getActiveSheet()->setCellValue("B$i",$barno);
$i++;
}



/*Rename sheet*/
$objPHPExcel->getActiveSheet()->setTitle('Medicine');

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();

/* Add some data to the second sheet, resembling some different data types*/
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Salary');
$i=2;
while($row1= mysqli_fetch_array($result1)) {
	$salary=$row1['med_no'];
	$objPHPExcel->getActiveSheet()->setCellValue("A$i",$salary);
$i++;
}

/* Rename 2nd sheet*/
$objPHPExcel->getActiveSheet()->setTitle('Inventory');

/* Redirect output to a client’s web browser (Excel5)*/
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="medicineinventory.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
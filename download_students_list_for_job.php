<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Name')
            ->setCellValue('B1', 'Degree')
            ->setCellValue('C1', 'Department')
            ->setCellValue('D1', 'Branch')
            ->setCellValue('E1', 'Email')
            ->setCellValue('F1', 'Phone')
            ->setCellValue('G1', 'Application Status');

require_once 'class/class.jobs.php';
require_once 'lib/lib.utils.php';
$jl = new jobs();
$jl->findOnJob_id(real_escape_string($_REQUEST['job_id']));
require_once 'class/class.job_application.php';
require_once 'class/class.students_profile.php';
require_once 'class/class.degree.php';
require_once 'class/class.branch.php';
require_once 'class/class.department.php';
$d = new degree();
$b = new branch();
$dep = new department();
$type= real_escape_string($_REQUEST['type']);
if($type == 0){
    $ja = job_application::getAllJob_application(" job_id=".  real_escape_string($_REQUEST['job_id'])); 
}
else {
    $ja = job_application::getAllJob_application(" job_id=".  real_escape_string($_REQUEST['job_id'])." and application_status=".$type); 
}
$s = new students_profile();


$i=2;
foreach ($ja as $j){
    $s->findOnProfile_id($j->getStudent_profile_id());
    $d->findOnDegree_id($s->getDegree());
    $b->findOnBranch_id($s->getBranch());
    $dep->findOnDep_id($s->getDeparment());
    
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $s->getName())
            ->setCellValue('B'.$i, $d->getDegree_name())
            ->setCellValue('C'.$i, $dep->getDep_name())
            ->setCellValue('D'.$i, $b->getBranch_name())
            ->setCellValue('E'.$i, $s->getEmail())
            ->setCellValue('F'.$i, $s->getPhone())
            ->setCellValue('G'.$i, getApplicationStatus($j->getApplication_status()));
    $i++;

}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Student List');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="student_list.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>
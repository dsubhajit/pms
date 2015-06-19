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

// Set document properties
/*
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


*/
/*
 * <td>Student Name</td>
                <td>Degree</td>
                <td>Department</td>
                <td>Branch</td>
                <td>Email</td>
                <td>Phone</td>  
                <td>Application Status</td>
                <td>Option</td>      
 */
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Name')
            ->setCellValue('B1', 'Degree')
            ->setCellValue('C1', 'Department')
            ->setCellValue('D1', 'Branch')
            ->setCellValue('E1', 'Email')
            ->setCellValue('F1', 'Phone')
            ->setCellValue('G1', 'Application Status');


require_once 'class/class.students_profile.php';
require_once 'class/class.degree.php';
require_once 'class/class.branch.php';
require_once 'class/class.department.php';
require_once 'class/class.students_profile.php';
require_once 'lib/lib.utils.php';
require_once 'class/class.degree.php';
require_once 'class/class.branch.php';
$d = new degree();
$dep = new department();
$b = new branch();
$std=array();
if(isset($_REQUEST['degree'])){
    $sql = "adm_yr_end='".real_escape_string($_REQUEST['year'])."'";
    if($_REQUEST['degree'] > 0) {
        $sql .= " and degree=".$_REQUEST['degree'];
    }
    if($_REQUEST['dep'] > 0) {
        $sql .= " and deparment=".$_REQUEST['dep'];
    }
    if($_REQUEST['branch'] > 0) {
        $sql .= " and branch=".$_REQUEST['branch'];
    }
    $sql .= ' order by enroll_no';
    $std = students_profile::getAllStudents_profile($sql);

}
else $std = students_profile::getAllStudents_profile(" adm_yr_end='".date("Y")."' order by deparment");
$i=2;
foreach ($std as $s){
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
            ->setCellValue('G'.$i, ($s->getJob_status()==1)?"Hired":"Not yet");
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

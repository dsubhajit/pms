<?php
require('fpdf.php');
require_once "config.php";
require_once "includes/assign-access.php";
require_once 'lib/lib.utils.php';
require_once 'class/class.students_profile.php';
require_once 'class/class.students_prof_dev.php';
require_once 'class/class.students_exp.php';
require_once 'class/class.students_ref.php';
require_once 'class/class.students_leadership.php';
require_once 'class/class.students_edu.php';
require_once 'class/class.students_projects.php';
require_once 'class/class.students_pubs.php';
require_once 'class/class.students_tech.php';
require_once 'class/class.department.php';
require_once 'class/class.degree.php';
require_once 'class/class.achievements.php';
require_once 'class/class.branch.php';


$std = new students_profile();
$std->findOnProfile_id(USER_PROFILE);
class PDF extends FPDF
{
    public  $my;
    function Header()
    {
        $this->my=10;
    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Text color in gray
        $this->SetTextColor(128);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
    
    function AddStudentDetailsHeader($name,$addr,$phone,$email){        
        $this->AddPage();
        $w = $this->GetStringWidth($name)+6;
        
        $this->SetDrawColor(255,255,255);
        $this->SetFillColor(255,255,255);
        
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','',8);
        $addr = split('<br />',$addr);
        $i=0;
        $x=0;
        foreach($addr as $a){   
            $this->SetX(10);
            $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));            
            $i+=6;
            
        }
        $this->my+=$i-6;
        $this->SetY(15);
        $this->SetX(210-$this->GetStringWidth(trim($phone))-10);
        $this->Cell($this->GetStringWidth(trim($phone)),0,trim($phone));     
        $this->SetX(210-$this->GetStringWidth(trim($email))-10);
        $this->Cell($this->GetStringWidth(trim($email)),6,trim($email));    
        $this->SetY(10);
        $this->SetX((210-$w)/2);
        $this->SetFont('Arial','',15);
        $this->SetTextColor(164,211,245);         
         
        // Thickness of frame (1 mm)
        $this->SetLineWidth(1);
        // Title
        //if($add_name){
        $this->Cell($w,9,  strtoupper($name),1,1,'C',true);
        
        
        //}
        // Line break
        $this->Ln(5);
        $this->my +=5;
        //echo $this->GetY();
        
    }

    function AddExp(array $exp){
        
        //$this->AddPage();
        $this->SetY($this->my);
        //echo $this->GetY();
        $e = new students_exp;
        $this->SetFont('Arial','B',10);      
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(0,0,0);  
        
        //$this->SetXY(7,$this->my);
        $this->Cell(0,6,"EXPERIENCE",0,1,'L',true);
        
        $this->my = $this->my+6;
        $index = 1;
        $i=6;
        $this->SetY($this->my);
        
        foreach ($exp as $e){            
            //$this->my+=8;
            $this->my+=$i;
            $a = '['.$index.']   '.$e->getExp_type().' at '.$e->getOrganization().' as '.$e->getDesignation().' | '.'From '.$e->getStart_date().' to '.$e->getEnd_date();; 
            $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));    
            
            $this->SetFont('Arial','',10); 
            $this->SetX(10);
            //$i+=10;
            //$this->Ln(4);        
            $this->SetY($this->my);
            $this->Cell($this->GetStringWidth(strip_tags(trim($e->getDescription()))),$i,  strip_tags(trim($e->getDescription())));    
            $this->my+=$i;
            //$i+=10;
            $this->SetX(10);
            //$this->Ln(4);            
            $this->SetFont('Arial','B',10); 
            $index++;
            $this->SetY($this->my);
        }
        
        
    }
    
    function AddEdu(students_profile $p,array $edu){
        $e = new students_edu();
        $d = new degree();
        $d->findOnDegree_id($p->getDegree());
        $dep=new department();
        $b= new branch();
        $b->findOnBranch_id($p->getBranch());
        $dep->findOnDep_id($p->getDeparment());
        
        
        $this->SetFont('Arial','B',10);      
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(0,0,0);  
        //echo $this->GetY();
        $this->SetX(7);
        $this->SetY($this->my);
        $this->Cell(0,6,"EDUCATION",0,$this->my,'L',true);
        $this->my+=6;
        $this->SetY($this->my);
        $index = 1;
        $i=6;
        
        $this->my+=$i;
        $a = '['.$index.']   '.$d->getDegree_name().' '.$dep->getDep_name().' '.$b->getBranch_name().' | '.'From '.$p->getAdm_yr_start().' to '.$p->getAdm_yr_end(); 
        $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));    
        $this->SetFont('Arial','',10); 
        $this->SetX(10);
        $this->SetY($this->my);
        $this->Cell($this->GetStringWidth(trim(INST_NAME).' CGPA: '.trim($p->getCgpa())),$i,trim(INST_NAME).' CGPA:'.$p->getCgpa());    
        $this->my+=$i;
        $this->SetY($this->my);
        $this->SetX(10);

        $this->SetFont('Arial','B',10); 
        $index++;
        
        foreach ($edu as $e){
            $this->my+=$i;
            $a = '['.$index.']   '.$e->getEdu_degree().' '.$e->getEdu_major().' '.' | '.'From '.$e->getEdu_date_form().' to '.$e->getEdu_date_to(); 
            $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));    
            $this->SetFont('Arial','',10); 
            $this->SetX(10);
            $this->SetY($this->my);
            $this->Cell($this->GetStringWidth(trim($e->getEdu_desc())),$i,trim($e->getEdu_desc()));    
            $this->my+=$i;
            $this->SetY($this->my);
            $this->SetX(10);
            
            $this->SetFont('Arial','B',10); 
            $index++;
        }
         
    }
    
    function getYear($date) {
        return date("Y",strtotime($date)); 
        
    }
    
    function  AddProjects(array $proj) {
        $p = new students_projects();
        
        $this->SetFont('Arial','B',10);      
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(0,0,0);  
        //echo $this->GetY();
        $this->SetX(7);
        $this->SetY($this->my);
        $this->Cell(0,6,"PROJECTS",0,$this->my,'L',true);
        $this->my+=6;
        $this->SetY($this->my);
        $index = 1;
        $i=6;
        
        
        
        foreach ($proj as $p){
            $this->my+=$i;
            $a = '['.$index.']   '.$p->getPj_name().' | From '.$this->getYear($p->getPj_from()).' to '.$this->getYear($p->getPj_to()); 
            $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));    
            $this->SetFont('Arial','',10); 
            $this->SetX(10);
            $this->SetY($this->my);
            $this->Cell($this->GetStringWidth(trim(strip_tags($p->getPj_desc()))),$i,trim(strip_tags($p->getPj_desc())));    
            $this->my+=$i;
            $this->SetY($this->my);
            $this->SetX(10);
            
            $this->SetFont('Arial','B',10); 
            $index++;
        }
    }
    
    function  AddProfDev(array $pdev) {
        $p = new students_prof_dev();
        
        $this->SetFont('Arial','B',10);      
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(0,0,0);  
        //echo $this->GetY();
        $this->SetX(7);
        $this->SetY($this->my);
        $this->Cell(0,6,"PROFESSIONAL DEVELOPMENT",0,$this->my,'L',true);
        $this->my+=6;
        $this->SetY($this->my);
        $index = 1;
        $i=6;
        
        
        
        foreach ($pdev as $p){
            $this->my+=$i;
            $a = '['.$index.']   '.$p->getDev_type().' : '.$p->getDev_name().' | From '.$this->getYear($p->getStart_date()).' to '.$this->getYear($p->getEnd_date()); 
            $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));    
            $this->SetFont('Arial','',10); 
            $this->SetX(10);
            $this->SetY($this->my);
            $this->Cell($this->GetStringWidth(trim(strip_tags($p->getDescription()))),$i,trim(strip_tags($p->getDescription())));    
            $this->my+=$i;
            $this->SetY($this->my);
            $this->SetX(10);
            
            $this->SetFont('Arial','B',10); 
            $index++;
        }
    }
    
    function  AddLeader(array $slp) {
        $sl = new students_leadership();
        
        $this->SetFont('Arial','B',10);      
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(0,0,0);  
        //echo $this->GetY();
        $this->SetX(7);
        $this->SetY($this->my);
        $this->Cell(0,6,"LEADERSHIP",0,$this->my,'L',true);
        $this->my+=6;
        $this->SetY($this->my);
        $index = 1;
        $i=6;
        
        
        
        foreach ($slp as $sl){
            $this->my+=$i;
            $a = '['.$index.']   '.$sl->getDesignation().' at '.$sl->getOrganization().' | From '.$this->getYear($sl->getStart_date()).' to '.$this->getYear($sl->getEnd_date()); 
            $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));    
            $this->SetFont('Arial','',10); 
            $this->SetX(10);
            $this->SetY($this->my);
            $txt = nl2br(trim(strip_tags($sl->getDescription())));
            $txt = split('<br />',$txt);
            $this->MultiCell(0,$i,trim(strip_tags($sl->getDescription())));    
            $this->my+=$i* sizeof($txt);
            $this->SetY($this->my);
            $this->SetX(10);
            
            $this->SetFont('Arial','B',10); 
            $index++;
        }
    }
    
    function  AddAchiev(array $ach) {
        $ah = new achievements();
        
        $this->SetFont('Arial','B',10);      
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(0,0,0);  
        //echo $this->GetY();
        $this->SetX(7);
        $this->SetY($this->my);
        $this->Cell(0,6,"ACHIEVEMENTS",0,$this->my,'L',true);
        $this->my+=6;
        $this->SetY($this->my);
        $index = 1;
        $i=6;
        
        
        
        foreach ($ach as $ah){
            $this->my+=$i;
            $a = '['.$index.']   '.$ah->getAchiev_title().' | '.$this->getYear($ah->getAchiev_date()); 
            $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));    
            $this->SetFont('Arial','',10); 
            $this->SetX(10);
            $this->SetY($this->my);
            $txt = nl2br(trim(strip_tags($ah->getAchiev_description())));
            $txt = split('<br />',$txt);
            $this->MultiCell(0,$i,trim(strip_tags($ah->getAchiev_description())));    
            $this->my+=$i* sizeof($txt);
            $this->SetY($this->my);
            $this->SetX(10);
            
            $this->SetFont('Arial','B',10); 
            $index++;
        }
    }
    
    
    function  AddTech(students_tech $st) {
        
        
        $this->SetFont('Arial','B',10);      
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(0,0,0);  
        //echo $this->GetY();
        $this->SetX(7);
        $this->SetY($this->my);
        $this->Cell(0,6,"TECHNICAL",0,$this->my,'L',true);
        $this->my+=6;
        $this->SetY($this->my);
        $index = 1;
        $i=6;
        $this->SetFont('Arial','',10);  
        
        
        
        $this->my+=$i;
        $a = $st->getTech_langs(); 
        $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));    
        $this->SetFont('Arial','',10); 
        $this->SetX(10);
        $this->SetY($this->my);
        
        $this->Cell(0,$i,trim(strip_tags($st->getTech_frameworks())));    
        $this->my+=$i;
        $this->SetY($this->my);
        $this->SetX(10);
        $this->Cell(0,$i,trim(strip_tags($st->getTech_tools())));    
        $this->my+=$i;
        $this->SetY($this->my);
        $this->SetX(10);

        $this->SetFont('Arial','B',10); 
        $index++;
        
    }
    
    function  AddeXtra(students_profile $p) {
        
        $this->SetFont('Arial','B',10);      
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(0,0,0);  
        //echo $this->GetY();
        $this->SetX(7);
        $this->SetY($this->my);
        $this->Cell(0,6,"PROFESSIONAL INTEREST",0,$this->my,'L',true);
        $this->my+=6;
        $this->SetY($this->my);
        $index = 1;
        $i=6;
        $this->SetFont('Arial','',10);  
        
        
        
        $this->my+=$i;
        $a = $p->getProf_interest(); 
        $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));    
        $this->SetFont('Arial','',10); 
        $this->SetX(10);
        $this->SetY($this->my);
        
        $this->SetFont('Arial','B',10);      
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(0,0,0);  
        //echo $this->GetY();
        $this->SetX(7);
        $this->SetY($this->my);
        $this->Cell(0,6,"LANGUAGES",0,$this->my,'L',true);
        $this->my+=6;
        $this->SetY($this->my);
        $index = 1;
        $i=6;
        $this->SetFont('Arial','',10);  
        
        
        
        $this->my+=$i;
        $a = $p->getLanguages(); 
        $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));    
        $this->SetFont('Arial','',10); 
        $this->SetX(10);
        $this->SetY($this->my);
        
        $this->SetFont('Arial','B',10);      
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(0,0,0);  
        //echo $this->GetY();
        $this->SetX(7);
        $this->SetY($this->my);
        $this->Cell(0,6,"HOBBIES",0,$this->my,'L',true);
        $this->my+=6;
        $this->SetY($this->my);
        $index = 1;
        $i=6;
        $this->SetFont('Arial','',10);  
        
        $this->my+=$i;
        $a = $p->getHobbies(); 
        $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));    
        $this->SetFont('Arial','',10); 
        $this->SetX(10);
        $this->SetY($this->my);
        
        
    }
    
    function  AddRef(array $srf) {
        $sr = new students_ref();
        
        $this->SetFont('Arial','B',10);      
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(0,0,0);  
        //echo $this->GetY();
        $this->SetX(7);
        $this->SetY($this->my);
        $this->Cell(0,6,"REFERENCES",0,$this->my,'L',true);
        $this->my+=6;
        $this->SetY($this->my);
        $index = 1;
        $i=6;
        
        
        
        foreach ($srf as $sr){
            $this->my+=$i;
            $a = '['.$index.']   '.$sr->getRef_name().' '.$sr->getDesignation().' at '.$sr->getOrganization(); 
            $this->Cell($this->GetStringWidth(trim($a)),$i,trim($a));    
            $this->SetFont('Arial','',10); 
            $this->SetX(10);
            $this->SetY($this->my);
            $txt = nl2br(trim(strip_tags('Phone: '.$sr->getPhone().' Email: '.$sr->getEmail())));
            $txt = split('<br />',$txt);
            $this->MultiCell(0,$i,trim(strip_tags('Phone: '.$sr->getPhone().' Email: '.$sr->getEmail())));    
            $this->my+=$i* sizeof($txt);
            $this->SetY($this->my);
            $this->SetX(10);
            
            $this->SetFont('Arial','B',10); 
            $index++;
        }
    }

    function ChapterTitle($num, $label)
    {
        // Arial 12
        $this->SetFont('Arial','',12);
        // Background color
        $this->SetFillColor(200,220,255);
        // Title
        $this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
        // Line break
        $this->Ln(4);
    }

    function ChapterBody($file)
    {
        // Read text file
        $txt = file_get_contents($file);
        // Times 12
        $this->SetFont('Times','',12);
        // Output justified text
        $this->MultiCell(0,5,$txt);
        // Line break
        $this->Ln();
        // Mention in italics
        $this->SetFont('','I');
        $this->Cell(0,5,'(end of excerpt)');
    }

    function PrintChapter($num, $title, $file)
    {
        $this->AddPage();
        $this->ChapterTitle($num,$title);
        $this->ChapterBody($file);
    }
}

$pdf = new PDF();


$pdf->SetTitle($std->getName());
$pdf->SetAuthor('Jules Verne');
$pdf->AddStudentDetailsHeader($std->getName(),  nl2br($std->getAdd1()),$std->getPhone(),$std->getEmail());
$pdf->AddExp(students_exp::getAllStudents_exp(' profile_id='.USER_PROFILE));
$pdf->AddEdu($std,students_edu::getAllStudents_edu(' profile_id='.USER_PROFILE));
$pdf->AddProjects(students_projects::getAllStudents_projects(' profile_id='.USER_PROFILE));
$pdf->AddProfDev(students_prof_dev::getAllStudents_prof_dev(' profile_id='.USER_PROFILE));
$pdf->AddLeader(students_leadership::getAllStudents_leadership(' profile_id='.USER_PROFILE));

$pt = new students_tech();
$pt->findOnTech_id($std->getTech_id());
$pdf->AddTech($pt);
$pdf->AddAchiev(achievements::getAllAchievements(' profile_id='.USER_PROFILE));
$pdf->AddeXtra($std);
$pdf->AddRef(students_ref::getAllStudents_ref(' profile_id='.USER_PROFILE));
//$pdf->PrintChapter(1,'A RUNAWAY REEF','20k_c1.txt');
$pdf->Output();
//print_r($std->getAdd1());
?>
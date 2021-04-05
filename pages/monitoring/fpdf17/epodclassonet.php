<?php
/***********************************************************************************************************

This line graph function was developed by Anthony Master

***********************************************************************************************************/

require('fpdf.php');

class PDF_onet extends FPDF {
	function LineGraph($w, $h, $data, $options='', $colors=null, $maxVal=0, $nbDiv=4){
		/*******************************************
		Explain the variables:
		$w = the width of the diagram
		$h = the height of the diagram
		$data = the data for the diagram in the form of a multidimensional array
		$options = the possible formatting options which include:
			'V' = Print Vertical Divider lines
			'H' = Print Horizontal Divider Lines
			'kB' = Print bounding box around the Key (legend)
			'vB' = Print bounding box around the values under the graph
			'gB' = Print bounding box around the graph
			'dB' = Print bounding box around the entire diagram
		$colors = A multidimensional array containing RGB values
		$maxVal = The Maximum Value for the graph vertically
		$nbDiv = The number of vertical Divisions
		*******************************************/
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(0.2);
		$keys = array_keys($data);
		$ordinateWidth = 10;
		$w -= $ordinateWidth;
		$valX = $this->getX()+$ordinateWidth;
		$valY = $this->getY();
		$margin = 1;
		$titleH = 8;
		$titleW = $w;
		$lineh = 5;
		$keyH = count($data)*$lineh;
		$keyW = $w/5;
		$graphValH = 5;
		$graphValW = $w-$keyW-3*$margin;
		$graphH = $h-(3*$margin)-$graphValH;
		$graphW = $w-(2*$margin)-($keyW+$margin);
		$graphX = $valX+$margin;
		$graphY = $valY+$margin;
		$graphValX = $valX+$margin;
		$graphValY = $valY+2*$margin+$graphH;
		$keyX = $valX+(2*$margin)+$graphW;
		$keyY = $valY+$margin+.5*($h-(2*$margin))-.5*($keyH);
		//draw graph frame border
		if(strstr($options,'gB')){
			$this->Rect($valX,$valY,$w,$h);
		}
		//draw graph diagram border
		if(strstr($options,'dB')){
			$this->Rect($valX+$margin,$valY+$margin,$graphW,$graphH);
		}
		//draw key legend border
//		if(strstr($options,'kB')){
//			$this->Rect($keyX,$keyY,$keyW,$keyH);
//		}
		//draw graph value box
		if(strstr($options,'vB')){
			$this->SetDrawColor(181,181,181);
			$this->Rect($graphValX,$graphValY,$graphValW,$graphValH);
		}
		//define colors
		if($colors===null){
			$safeColors = array(0,51,102,153,204,225);
			for($i=0;$i<count($data);$i++){
				$colors[$keys[$i]] = array($safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)]);
			}
		}
		//form an array with all data values from the multi-demensional $data array
		$ValArray = array();
		foreach($data as $key => $value){
			foreach($data[$key] as $val){
				$ValArray[]=$val;					
			}
		}
		//define max value
		if($maxVal<ceil(max($ValArray))){
			$maxVal = ceil(max($ValArray));
		}
		//draw horizontal lines
		$vertDivH = $graphH/$nbDiv;
		$this->SetDrawColor(181,181,181);
		if(strstr($options,'H')){
			for($i=0;$i<=$nbDiv;$i++){
				if($i<$nbDiv){
					$this->Line($graphX,$graphY+$i*$vertDivH,$graphX+$graphW,$graphY+$i*$vertDivH);
				} else{
					$this->Line($graphX,$graphY+$graphH,$graphX+$graphW,$graphY+$graphH);
				}
			}
		}
		//draw vertical lines
		$horiDivW = floor($graphW/(count($data[$keys[0]])-1));
		if(strstr($options,'V')){
			for($i=0;$i<=(count($data[$keys[0]])-1);$i++){
				if($i<(count($data[$keys[0]])-1)){
					if($i==6){
					   $this->SetDrawColor(255,0,26);
					   }
					$this->Line($graphX+$i*$horiDivW,$graphY,$graphX+$i*$horiDivW,$graphY+$graphH);
				} else {
					$this->Line($graphX+$graphW,$graphY,$graphX+$graphW,$graphY+$graphH);
				}
			}
		}
		//draw graph lines
		foreach($data as $key => $value){
			$this->setDrawColor($colors[$key][0],$colors[$key][1],$colors[$key][2]);
//warna garis			$this->setDrawColor(0,0,0);
			$this->SetLineWidth(0.8);
			$valueKeys = array_keys($value);
			for($i=0;$i<count($value);$i++){
				if($i==count($value)-2){
					$this->Line(
						$graphX+($i*$horiDivW),
						$graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
						$graphX+$graphW,
						$graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
					);
				} else if($i<(count($value)-1)) {
					$this->Line(
						$graphX+($i*$horiDivW),
						$graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
						$graphX+($i+1)*$horiDivW,
						$graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
					);
				}
			}
			//Set the Key (legend)
//			$this->SetFont('Arial','',8);
//			if(!isset($n))$n=0;
//			$this->Line($keyX+1,$keyY+$lineh/2+$n*$lineh,$keyX+8,$keyY+$lineh/2+$n*$lineh);
//			$this->SetXY($keyX+8,$keyY+$n*$lineh);
//			$this->Cell($keyW,$lineh,$key,0,1,'L');
//			$n++;
		}
		//print the abscissa values
		foreach($valueKeys as $key => $value){
			if($key==0){
				$this->SetXY($graphValX,$graphValY);
				$this->Cell(30,$lineh,$value,0,0,'L');
			} else if($key==count($valueKeys)-1){
				$this->SetXY($graphValX+$graphValW-30,$graphValY);
				$this->Cell(30,$lineh,$value,0,0,'R');
			} else {
				$this->SetXY($graphValX+$key*$horiDivW-15,$graphValY);
				$this->Cell(30,$lineh,$value,0,0,'C');
			}
		}
		//print the ordinate values
		for($i=0;$i<=$nbDiv;$i++){
			$this->SetXY($graphValX-10,$graphY+($nbDiv-$i)*$vertDivH-3);
			$this->Cell(8,6,sprintf('%.1f',$maxVal/$nbDiv*$i),0,0,'R');
		}
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(0.2);
	}

//---end of graph.

function Header()
{
    global $title;
	$this->SetLeftMargin(20);
    $this->Image('../../../assets/img/'.$_SESSION['logo_inst'],20,9,15);
	$this->SetFont('Arial','B',9);
	$this->Cell(16,5,'',0,0,'L');
	$this->Cell(100,6,strtoupper($_SESSION['nama_pt']),0,0,'L');
	$this->SetFont('Arial','I',7);
	$this->Cell(55,6,$title,0,1,'R');
	$this->SetFont('Arial','',9);
	$this->Cell(16,6,'',0,0,'L');
	$this->Cell(50,5,strtoupper($_SESSION['unit']),0,1,'L');		
	$this->Ln(4);

}

function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    $this->SetFont('Arial','I',7);
    // Text color in gray
    $this->SetTextColor(128);
    // Page number
    $this->Cell(145,10,$_SESSION['foot_lap'],0,0,'L');
    $this->Cell(25,10,'Hal. '.$this->PageNo().'/ {nb}',0,0,'C');
}

function TotalScore($label)
{
    // Arial 12
    $this->SetFont('Arial','B',10);
    // Background color
    $this->SetTextColor(255,255,255);
//    $this->SetFillColor(51,119,255);
//    $this->SetFillColor(80,80,80);
    $this->SetFillColor(51,102,204);
    $this->SetDrawColor(224,224,224);
    // Title
    $this->setx(165);
    $this->Cell(25,5,"$label",1,1,'C',true);
    $this->SetTextColor(0,0,0);
    $this->SetDrawColor(168,168,168);
    //$this->Cell(17,6,"",0,0,'C',true);
    // Line break
}

function HLevel1($label1, $label2)
{
	//$this->SetLeftMargin(20);
    $this->SetFont('Arial','',10);
    $this->SetTextColor(255,255,255);
//    $this->SetFillColor(51,119,255);
//    $this->SetFillColor(148,122,147);
    $this->SetFillColor(100,139,216);
    $this->Cell(150,6,"$label1",0,0,'L',true);
    $this->Cell(20,6,"$label2",0,1,'C',true);
    $this->Ln(1);
    $this->SetTextColor(0,0,0);
}

function HLevel2($label1, $label2)
{
	//$this->SetLeftMargin(25);
    $this->SetFont('Arial','B',9);
    //$this->SetTextColor(220,50,50);
    //$this->SetFillColor(200,220,255);
//    $this->SetFillColor(185,185,185);
    $this->SetFillColor(190,206,238);
    $this->Cell(5,6,"",0,0,'L');
    $this->Cell(145,6,"$label1",0,0,'L',true);
    $this->Cell(20,6,"$label2",0,1,'C',true);
    $this->SetFont('Arial','',9);
    //$this->Ln(4);
}

function HLevel21($label1, $label2, $label3, $label4, $label5, $label6, $label7)
{
	$this->SetLeftMargin(25);
    $this->SetFont('Arial','B',9);
    //$this->SetTextColor(220,50,50);
    //$this->SetFillColor(200,220,255);
//    $this->SetFillColor(185,185,185);
    $this->SetFillColor(190,206,238);
    $this->Cell(95,6,"$label1",0,0,'L',true);
    $this->SetFont('Arial','',10);
    $this->Cell(5,6,"$label3",0,0,'C',true);
	$this->Cell(5,6,'',0,0,'C',true);
    $this->Cell(5,6,"$label4",0,0,'C',true);
	$this->Cell(5,6,'',0,0,'C',true);
    $this->Cell(5,6,"$label5",0,0,'C',true);
	$this->Cell(5,6,'',0,0,'C',true);
    $this->Cell(5,6,"$label6",0,0,'C',true);
	$this->Cell(5,6,'',0,0,'C',true);
    $this->Cell(10,6,"$label7",0,0,'C',true);  
    $this->SetFont('Arial','B',10);
    $this->Cell(20,6,"$label2",0,1,'C',true);
    $this->SetFont('Arial','',9);
    //$this->Ln(4);
}


function HLevel3($label1, $label2, $label3, $label4)
{
	$this->SetLeftMargin(20);
    $this->SetFont('Arial','B',9);
    //$this->SetTextColor(220,50,50);
    //$this->SetFillColor(200,220,255);
//    $this->SetFillColor(185,185,185);
    $this->SetFillColor(190,206,238);
    $this->Cell(5,6,"$label1",0,0,'C',true);
    $this->Cell(75,6,"$label2",0,0,'C',true);
    $this->Cell(67,6,"$label3",0,0,'C',true);
    $this->Cell(22,6,"$label4",0,0,'L',true);
    $this->SetFont('Arial','',9);
    //$this->Ln(4);
    
}

function HEpomR01($label1, $label2, $label3, $label4)
{
	$pdf->SetFont('Arial','',9);
	$pdf->cell(23,$tgi1,'Program Studi',0,0,"L");
	$pdf->cell(3,$tgi1,':',0,0,"C");
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(119,$tgi1,"$label1",0,0,'L');		
	$pdf->TotalScore('Score*');
	$pdf->SetFont('Arial','',9);
	$pdf->cell(23,$tgi1,'Jurusan',0,0,"L");
	$pdf->cell(3,$tgi1,':',0,0,"C");
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(119,$tgi1,"$label2",0,0,'L');	
	$pdf->TotalScore(number_format("$label4", 2, '.', ''));
	$pdf->SetFont('Arial','',9);
	$pdf->cell(23,$tgi1,'Kelas',0,0,"L");
	$pdf->cell(3,$tgi1,':',0,0,"C");
	$pdf->SetFont('Arial','',9);
	$pdf->cell(118,$tgi1,"$label3",0,0,"L");
	$pdf->SetFont('Arial','I',8);
	$pdf->cell(25,$tgi1,'* Skala 5',0,1,"C");
	$pdf->SetFont('Arial','',9);
	$y=$pdf->getY();
	$pdf->Line(20,$y+2,190,$y+2);
	$pdf->ln(4);
	$pdf->SetLeftMargin(20);
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

function PrintChapter($title, $file)
{
    //$this->AddPage();
    //$this->ChapterTitle($title);
    //$this->ChapterBody($file);
}



}
?>

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/fpdf.php') ;
class Pdf extends FPDF
{
	// Extend FPDF using this class
	// More at fpdf.org -> Tutorials
	private $username;
	
	function __construct($orientation='P', $unit='mm', $size='A4')
	{
		// Call parent constructor
		parent::__construct($orientation,$unit,$size);
	}
	
	function SetUsername($username) {
		
		$this->username = $username;
	}
	
	function Header()
	{
		$this->Image(base_url().'assets/images/logoblack2.jpg',  round(($this->w/2)-50),round(($this->h/2)-50),100);		
	}	
	
	function Footer()
	{
		// Go to 1.5 cm from bottom
		$this->SetLeftMargin(10);
		$this->SetY(-15);
		// Select Arial italic 8
		$this->SetTextColor(150,150,150);
		$this->SetFont('Arial','I',8);
		// Print centered page number
		
		$this->Cell(95,10,date('dMY-siH').' | '.$this->username,0,0,'L');		
		if ($this->PageNo() == 1) {
			
			$this->Cell(95,10,'',0,1,'R');		
		} else {
			
			$this->Cell(95,10,'Page '.$this->PageNo(),0,1,'R');		
		}
	}	
}

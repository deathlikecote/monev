<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Code Igniter
*
* An open source application development framework for PHP 4.3.2 or newer
*
* @package		CodeIgniter
* @author		Rick Ellis
* @copyright	Copyright (c) 2006, pMachine, Inc.
* @license		http://www.codeignitor.com/user_guide/license.html
* @link			http://www.codeigniter.com
* @since        Version 1.0
* @filesource
*/

// ------------------------------------------------------------------------

/**
* Code Igniter Asset Helpers
*
* @package		CodeIgniter
* @subpackage	Helpers
* @category		Helpers
* @author       Philip Sturgeon < phil.sturgeon@styledna.net >
*/

// ------------------------------------------------------------------------

function nama_hari($tanggal) {
				$hari = date("w", strtotime($tanggal));
				switch ($hari) {
					case 1: 
						$namahari = 'Sn';
						break;
					case 2: 
						$namahari = 'Sl';
						break;
					case 3: 
						$namahari = 'Rb';
						break;
					case 4: 
						$namahari = 'Km';
						break;
					case 5: 
						$namahari = 'Jm';
						break;
					case 6: 
						$namahari = 'Sb';
						break;
					default:
						$namahari = 'Mg';
						break;
				}	
				return $namahari;
}

function format_tgl($tanggal)
{
	$arr = explode('-',$tanggal);
	
	return $arr[2].'/'.$arr[1].'/'.$arr[0];
	
}

function format_tgl_balik($tanggal)
{
	$arr = explode('/',$tanggal);
	
	return $arr[2].'-'.$arr[1].'-'.$arr[0];
	
}

	function angkatokata($num)
	{
        switch ($num) {
        case 1:
            return "satu";
            break;
        case 2:
            return "dua";
            break;
        case 3:
            return "tiga";
            break;
        case 4:
            return "empat";
            break;
        case 5:
            return "lima";
            break;
        case 6:
            return "enam";
            break;
        case 7:
            return "tujuh";
            break;
        case 8:
            return "delapan";
            break;
		}
	}
	
	function format_min($num)
	{
		if (!$num) {
			$num = '-';
		}
		
		return $num;
	}
	
	function format_x($num)
	{
		if ($num)
		{
			$num = 'X';	
		}else{
			$num = '-';
		}
		
		return $num;
	}

    function romawi($des)
    {
        switch ($des) {
        case 1:
            return "I";
            break;
        case 2:
            return "II";
            break;
        case 3:
            return "III";
            break;
        case 4:
            return "IV";
            break;
        case 5:
            return "V";
            break;
        case 6:
            return "VI";
            break;
        case 7:
            return "VII";
            break;
        case 8:
            return "VIII";
            break;
        case 9:
            return "IX";
            break;
        case 10:
            return "X";
            break;
        case 11:
            return "XI";
            break;
        case 12:
            return "XII";
            break;
        case 13:
            return "XIII";
            break;
        case 14:
            return "XIV";
            break;
        case 15:
            return "XV";
            break;
        case 16:
            return "XVI";
            break;
        case 17:
            return "XVII";
            break;
        case 18:
            return "XVIII";
            break;
        case 19:
            return "XIX";
            break;
        case 20:
            return "XX";
            break;
        case 21:
            return "XXI";
            break;
        case 22:
            return "XXII";
            break;
        case 23:
            return "XXIII";
            break;
        case 24:
            return "XXIV";
            break;
        case 25:
            return "XXV";
            break;
        case 26:
            return "XXVI";
            break;
        case 27:
            return "XXVII";
            break;
        case 28:
            return "XXVIII";
            break;
        case 29:
            return "XXIX";
            break;
        case 30:
            return "XXX";
            break;
        default:
            return "XXXI";
        }
    }

	

?>
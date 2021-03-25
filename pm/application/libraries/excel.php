<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php"; 
 
class Excel extends PHPExcel { 
	
    public function __construct() { 
		
        parent::__construct(); 
		ini_set("memory_limit",-1);
//		$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp; 
//		$cacheSettings = array( ' memoryCacheSize ' => '32MB'); 
//		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);		
    } 
}
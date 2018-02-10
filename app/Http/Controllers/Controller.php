<?php 

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
	
	public function __construct()
	{
		
	}
	public function export($data){
		$data = array(
		array(
		array("firstname" => "Mary", "lastname" => "Johnson", "age" => 25, "age1" => 25)
		),
		array("firstname" => "Mary", "lastname" => "Johnson", "age" => 25, "age1" => 25),
		array("firstname" => "Mary", "lastname" => "Johnson", "age" => 25, "age1" => 25),
		array("firstname" => "Mary", "lastname" => "Johnson", "age" => 25, "age1" => 25),
		array("firstname" => "Mary", "lastname" => "Johnson", "age" => 25, "age1" => 25),
		array("firstname" => "Mary", "lastname" => "Johnson", "age" => 25, "age1" => 25),
		array("firstname" => "Mary", "lastname" => "Johnson", "age" => 25, "age1" => 25),
		array("firstname" => "Mary", "lastname" => "Johnson", "age" => 25, "age1" => 25)
		);

		function cleanData(&$str)
		{
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
		}

		// file name for download
		$filename = "website_data_" . date('Ymd') . ".xls";

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");

		$flag = false;
		foreach($data as $row) {
		if(!$flag) {
		// display field/column names as first row
		echo implode("\t", array_keys($row)) . "\n";
		$flag = true;
		}
		array_walk($row, 'cleanData');
		echo implode("\t", array_values($row)) . "\n";
		}

		exit;
	}
}

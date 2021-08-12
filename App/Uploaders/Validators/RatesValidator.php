<?php 
namespace App\Uploaders\Validators;

class RatesValidator extends Validator{
	public function run($file){
		$this->column_count = 7;
		$this->file =$file;
		$this->valid = true;
		$this->validate_file_presence();
		$this->validate_rows();
		$this->errors=[];
		return $this->valid;
	}

	private function validate_file_presence(){
		$this->valid =  $this->file instanceof \PhpOffice\PhpSpreadsheet\Spreadsheet;
	}
	
	private function validate_rows(){
		$sheetsNames = $this->file->getSheetNames();
		foreach($sheetsNames as $sheetName){
			$sheet = $this->file->getSheetByName($sheetName);
			$rowCount = $sheet->getHighestDataRow();
			$range = 'A2:G'.$rowCount;
			$rowsArray = $sheet->rangeToArray($range);
			foreach($rowsArray as $rowIndex=>$row){
				if(empty($row[0])){
					break;
				}
				foreach($row as $colIndex=>$col){
					if($col==="" || $col===null){

						throw new \Exception("col $sheetName ($rowIndex - $colIndex) is empty");
						$this->valid = false;
						return;
					}
				}
			}				
		}
		
	}
}


?>
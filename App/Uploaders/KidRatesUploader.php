<?php 
namespace App\Uploaders;
use App\Uploaders\Validators;
use App\Models\KidRate;
class KidRatesUploader extends Uploader{
	static $validator = 'KidRatesValidator';
	private $headers=[
		'plan_id',
		'deductible',
		'num_kids',
		'yearly_price',
		'biyearly_price',
	];

	public function run(){
		$sheetsNames = $this->file->getSheetNames();
		foreach($sheetsNames as $sheetName){
			$sheet = $this->file->getSheetByName($sheetName);
			$rowCount = $sheet->getHighestRow();

			$range = 'A2:E'.$rowCount;
			$rowsArray = $sheet->rangeToArray($range);
			foreach($rowsArray as $row){
				$attributes=[];
				foreach($row as $i=>$column){
					$field = $this->headers[$i];
					$attributes[$field]=$column;
					$attributes['year']=date('Y');
				}
				$conditions = [
					'plan_id = ? and deductible = ? and num_kids = ? and year = ?',
					$attributes['plan_id'],
					$attributes['deductible'],
					$attributes['num_kids'],
					$attributes['year']
				];
				$rate =KidRate::find(['conditions'=>$conditions]);
				try{
					if($rate){
						$rate->update_attributes($attributes);
						$msg = "Updated Kid Rate for ".$sheetName;
					}
					else{
						KidRate::create($attributes);
						$msg = "Created Kid Rate for ".$sheetName;
					}
					echo $msg."\n";
				}
				catch(\Exception $e){
					if($row[0]=""){
						continue;
					}
				}
			}				
		}
	}
}

?>
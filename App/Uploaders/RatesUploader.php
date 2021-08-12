<?php 
namespace App\Uploaders;
use App\Uploaders\Validators;
use App\Models\Rate;
class RatesUploader extends Uploader{
	static $validator = 'RatesValidator';
	private $headers=[
		'plan_id',
		'min_age',
		'max_age',
		'deductible',
		'yearly_price',
		'biyearly_price',
		'deductible_out'
	];

	public function run(){
		$sheetsNames = $this->file->getSheetNames();
		foreach($sheetsNames as $sheetName){
			$sheet = $this->file->getSheetByName($sheetName);
			$rowCount = $sheet->getHighestRow();

			$range = 'A2:G'.$rowCount;
			$rowsArray = $sheet->rangeToArray($range);
			foreach($rowsArray as $row){
				$attributes=[];
				foreach($row as $i=>$column){
					$field = $this->headers[$i];
					$attributes[$field]=$column;
					$attributes['year']=date('Y');
				}
				$conditions = [
					'plan_id = ? and deductible = ? and min_age = ? and max_age = ? and year = ?',
					$attributes['plan_id'],
					$attributes['deductible'],
					$attributes['min_age'],
					$attributes['max_age'],
					$attributes['year']
				];
				$rate =Rate::find(['conditions'=>$conditions]);
				try{
					if($rate){
						$rate->update_attributes($attributes);
						$msg = "Updated Rate for ".$sheetName;
					}
					else{
						Rate::create($attributes);
						$msg = "Created Rate for ".$sheetName;
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
<?php 
namespace App\Uploaders;
use App\Uploaders\Validators;
use App\Models\{Rider,RiderName};
class RidersUploader extends Uploader{
	static $validator = 'RidersValidator';
	private $headers=[
		'plan_id',
		'name',
		'deductible',
		'available',
		'selected',
	];

	public function run(){
		$sheetsNames = $this->file->getSheetNames();
		foreach($sheetsNames as $sheetName){
			$sheet = $this->file->getSheetByName($sheetName);
			$rowCount = $sheet->getHighestRow();
			$range = 'A2:E'.$rowCount;
			$rowsArray = $sheet->rangeToArray($range);
			try{
			foreach($rowsArray as $rowIndex=>$row){
				if($row[0]==""){
					break;
				}
				$attributes=[];
				foreach($row as $i=>$column){
					$field = $this->headers[$i];
					$attributes[$field]=$column;
				}
				
					$riderName = RiderName::find_by_name($attributes['name']);
					$name_id = $riderName->id;
			

				$conditions = [
					'name_id =  ? and plan_id = ? and deductible = ?',
					$name_id,
					$attributes['plan_id'],
					$attributes['deductible'],
				];

				unset($attributes['name']);
				$attributes['name_id']=$name_id;

				$rate =Rider::find(['conditions'=>$conditions]);
				try{
					if($rate){
						$rate->update_attributes($attributes);
						$msg = "Updated Rider for ".$sheetName;
					}
					else{
						Rider::create($attributes);
						$msg = "Created Rider for ".$sheetName;
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
			catch(\Exception $e){
				print_r($sheetName.'-'.$e->getMessage());
				print_r(RiderName::find_by_name($attributes['name']));
				die();
			}			
		}
	}
}

?>
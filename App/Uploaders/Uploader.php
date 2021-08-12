<?php 
namespace App\Uploaders;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Models\{Rate,KidRate,Rider,RiderName};
use Core\Response;
class Uploader{
	protected $file;
	private $sheetNames;
	private $maxRow;
	private $maxCol;
	private $headers;
	private $current_sheet;

	private function getFileType(){
		try{
			$rateFileHeaders = ['plan_id','min_age','max_age','deductible','yearly_price','biyearly_price','deductible_out'];
			$kidFileHeaders = ['plan_id','deductible','num_kids','yearly_price','biyearly_price'];
			$riderFileHeaders = ['plan_id','name','deductible','Disponible','Seleccionado','Incluido'];
			if($this->headers === $rateFileHeaders){
				return 'rates';
			}
			if($this->headers === $riderFileHeaders){
				return 'riders';
			}
			if($this->headers === $kidFileHeaders){
				return 'kids';
			}
			throw new \Exception("File Type Not Found");
		}
		catch(\Exception $e){
			print_r($this->headers);
			Response::send(404,$e->getMessage());
		}
		

	}

	public function __construct($filename){
		$reader = new Xlsx();
		$reader->setReadDataOnly(true);
		$reader->setReadEmptyCells(false);
		$this->file = $reader->load($filename);
		$this->getSheetNames();
	}


	public function getSheetNames(){
		$this->sheetNames = $this->file->getSheetNames();

	}

	//Sets the area of the files without the empty cells
	private function setReadableArea($sheet){
		$this->maxRow = $sheet->getHighestRow();
		$this->maxCol = $sheet->getHighestDataColumn();

	}

	private function setHeaders($sheet){
		$headers = $sheet->rangeToArray('A1:'.$this->maxCol.'1');
		$this->headers=$headers[0];
	}



	public function run(){
		foreach($this->sheetNames as $sheetName){
			$this->current_sheet = $sheetName;
			$sheet = $this->file->getSheetByName($sheetName); // Usando el nombre obtengo el objeto de la hoja
			$this->setReadableArea($sheet);
			$this->setHeaders($sheet);
			$this->processSheet($sheet,$this->getFileType($sheet));
		}
	}

	private function processSheet($sheet,$fileType){
		$dataArray = $sheet->rangeToArray('A2:'.$this->maxCol.$this->maxRow);
		switch($fileType){
			case 'rates':
			$this->uploadRates($dataArray);
			break;
			case 'kids':
			$this->uploadKidRates($dataArray);
			break;
			case 'riders':
			$this->uploadRiders($dataArray);
			break;
			default:
			throw new Exception("Could not process sheet, Incorrect Type");
			break;
		}
	}

	private function getRowAttributes($row){
		$attributes = [];
		foreach($this->headers as $index=>$header){
			$attributes[$header]=$row[$index];
		}
		return $attributes;
	}

	/* Working Good as hell */
	private function uploadRates($array){
		echo $this->current_sheet."\n";
		foreach($array as $rowIndex=>$row){
			$attributes= $this->getRowAttributes($row);
			$conditions = [
				'plan_id = ? and deductible = ? and min_age = ? and max_age = ? and year = ?',
				$attributes['plan_id'],
				$attributes['deductible'],
				$attributes['min_age'],
				$attributes['max_age'],
				date('Y')
			];
			$rate = Rate::find(['conditions'=>$conditions]);
			try{
				if($rate){
					$rate->update_attributes(['yearly_price'=>$attributes['yearly_price'],'biyearly_price'=>$attributes['biyearly_price']]);
					echo $this->current_sheet.' Rate # '.($rowIndex+2).' was updated'."\n";
					
				}
				else{
					$rate = Rate::create($attributes);
					echo $this->current_sheet.' Rate # '.($rowIndex+2).' was Created'."\n";
				}
			}
			catch(\Exception $e){
				Response::send(404,"There was a problem updating the rates at sheet ".$this->current_sheet.' At coordinates ('.$rowIndex.')');
			}
		}
	}

	// $kidFileHeaders = ['plan_id','deductible','num_kids','yearly_price','biyearly_price'];

	private function uploadKidRates($array){
		echo $this->current_sheet."\n";
		foreach($array as $rowIndex=>$row){
			$attributes= $this->getRowAttributes($row);
			$conditions = [
				'plan_id = ? and deductible = ? and num_kids = ? and year = ?',
				$attributes['plan_id'],
				$attributes['deductible'],
				$attributes['num_kids'],
				date('Y')
			];
			$rate = KidRate::find(['conditions'=>$conditions]);
			try{
				if($rate){
					$rate->update_attributes(['yearly_price'=>$attributes['yearly_price'],'biyearly_price'=>$attributes['biyearly_price']]);
					echo $this->current_sheet.' Kid Rate # '.($rowIndex+2).' was updated'."\n";
					
				}
				else{
					$rate = KidRate::create($attributes);

					echo $this->current_sheet.' Kid Rate # '.($rowIndex+2).' was Created'."\n";

				}
			}
			catch(\Exception $e){
				Response::send(404,"There was a problem updating the Kid Rates at sheet ".$this->current_sheet.' At coordinates ('.$rowIndex.')');
			}
		}
	}

	//$riderFileHeaders = ['plan_id','name','deductible','Disponible','Seleccionado','Incluido'];
	private function uploadRiders($array){
		ob_start();
		echo $this->current_sheet."\n";
		foreach($array as $rowIndex=>$row){
			$attributes= $this->getRowAttributes($row);
			$rider_name = RiderName::find(['conditions'=>['name = ?',$attributes['name']]]);
			if(!$rider_name){
				throw new \Exception('RiderName '.$attributes['name'].'Not Found');
			}
			$name_id = $rider_name->id;
			$conditions = [
				'plan_id = ? and name_id = ? and deductible = ?',
				$attributes['plan_id'],
				$name_id,
				$attributes['deductible'],
			];
			$rate = Rider::find(['conditions'=>$conditions]);
			try{
				if($rate){
					$rate->update_attributes([
						'available'=>$attributes['Disponible'],
						'selected'=>$attributes['Seleccionado'],
						'deductible'=>$attributes['deductible'],
						'name_id'=>$name_id
					]);
					echo $this->current_sheet.' Rider # '.($rowIndex+2).' was updated'."\n";
					
				}
				else{
					$rate = Rider::create([
						'plan_id'=>$attributes['plan_id'],
						'available'=>$attributes['Disponible'],
						'selected'=>$attributes['Seleccionado'],
						'price'=>0,
						'deductible'=>$attributes['deductible'],
						'name_id'=>$name_id
					]);

					echo $this->current_sheet.' Rider # '.($rowIndex+2).' was Created'."\n";

				}
			}
			catch(\Exception $e){
				Response::send(404,"There was a problem updating the Riders at sheet ".$this->current_sheet.' At coordinates ('.$rowIndex.')'."/".$e->getMessage());
			}
			
		}
	}

	public function validate(){
		$validator_namespace = "\App\Uploaders\Validators\\".static::$validator;
		$validator = new $validator_namespace($this->file);
		return $validator->run($this->file);
	}
}

?>

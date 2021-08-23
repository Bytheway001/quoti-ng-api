<?php 
namespace App\Uploaders;
use \PhpOffice\PhpSpreadsheet\Reader\Xlsx;	
class AllianzUploader{
	
	private $deductibles = ['500','1000','2000','5000','10000','20000','750','1500','3000','6000','9000','15000'];
	private $plans=[
		'Global Pass Choice I Latam'=>['region'=>'Latin America','residence'=>'Other','option'=>'OP1'],
		"Global Pass Choice II Latam"=>['region'=>"Latin America",'residence'=>"Other",'option'=>"OP2"],
		"Global Pass Connect Latam"=>['region'=>'Latin America','residence'=>"Other",'option'=>"Connect"],
		"Global Pass Choice I Mundial"=>['region'=>'Worldwide','residence'=>"Other",'option'=>"OP1"],
		"Global Pass Choice II Mundial"=>['region'=>"Worldwide",'residence'=>"Other",'option'=>"OP2"],
		"Global Pass Connect Mundial"=>['region'=>'Worldwide','residence'=>"Other",'option'=>"Connect"],
	];
	public function __construct($filename){
		
		$reader = new Xlsx();
		$this->file = $reader->load($filename);
		$this->sheet = $this->file->getSheetByName('Premium Sheet');
		$this->rates = $this->sheet->rangeToArray("J2:K42001");



	}

	public function createSearchOptions(){
		foreach ($this->plans as $plan_name=>$plan){
			$planObject = \App\Models\Plan::find_by_name($plan_name);
			echo 'Going for rates for'.$plan_name."\n";
			foreach($this->deductibles as $deductible){
				for($age=0;$age<=99;$age++){
					$string = $deductible.$plan['region'].$plan['residence'].$age.$plan['option'];
					$key = array_search($string,array_column($this->rates,0));
					$rate = $this->findRate($planObject->id,$age,$deductible);
					echo "Plan ID IS: ".$planObject->id."\n";
					if(!$rate){
						$rate = \App\Models\JointPlanRate::create([
							'plan_id'=>$planObject->id,
							'plan_type'=>1,
							'deductible'=>$deductible,
							'min_age'=>$age,
							'max_age'=>$age,
							'yearly_price'=>$this->rates[$key][1],
							'biyearly_price'=>$this->rates[$key][1],
							'deductible_out'=>$deductible

						]);
					}
					else{
						$rate->update_attributes([
							'yearly_price'=>$this->rates[$key][1],
							'biyearly_price'=>$this->rates[$key][1],
							'deductible_out'=>$deductible
						]);
					}
				}
			}
		}
	}

	public function findRate($plan,$age,$deductible){
		$rate = \App\Models\JointPlanRate::find(['conditions'=>['plan_id = ? and min_age = ? and max_age = ? and deductible = ?',$plan,$age,$age,$deductible]]);
		if($rate){
			return $rate;
		}
		else{
			return null;
		}
	}
}

?>
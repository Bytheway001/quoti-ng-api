<?php 
namespace App\Libs;
use App\Models\{Plan,Country,Benefit};
class Cotizacion{
	private $payload;
	private $plans=[];
	public $result=[];
	public $errors=[];
	public function __construct($payload){
		$this->payload = $payload;
	}


	public function isValid(){

		extract((array)$this->payload);
		if(empty($country)){
			$this->errors['country']="Not Present";
			return false;
		}
		if(empty($main_age)){
			$this->errors['main_age']="Not Present";
			return false;
		}
		if(empty($plan_type)){
			$this->errors['plan_type']="Not Present";
			return false;
			
		}
		if($plan_type > 1 && empty($couple_age)){
			$this->errors['couple_age']='Must be present when quoting couples or families';
			return false;
			
		}
		if($plan_type>2 && empty($kids_ages)){
			$this->errors['kids']='Must be present when quoting families';
			return false;
			
		}

		return true;

	}

	public function execute(){
		$this->regions = Country::find_by_short_name($this->payload['country'])->regions;
		$this->getPlans();
		foreach($this->plans as $plan){
			$coverage = $plan->getBenefitByName('Cobertura Maxima');
			$object =[
				'name'=>$plan->name,
				'year'=>$plan->lastYearLoaded(),
				'company'=>$plan->region->company->name,
				'rates'=>[],
				'extra_params'=>[
					'coverage'=>$coverage?$coverage->description:"--"
				]
			];
			$deds = $plan->getDeductibles();
			foreach($deds as $ded){
				try{
					$object['rates'][]=[
					'deductible'=>$ded->deductible,
					'deductible_out'=>$ded->deductible_out,
					'main_price'=>$plan->getPrice($this->payload['main_age'],$ded->deductible),
					'couple_price'=>$this->payload['plan_type'] < 2 ? null : $plan->getPrice($this->payload['couple_age'],$ded->deductible),
					'kids_price'=>$this->payload['plan_type'] < 3 ? null : $plan->getKidPrice($this->payload['kids_ages'],$ded->deductible),
					'riders'=>$plan->getRidersForDeductible($ded->deductible),
				];
				}
				catch(\Exception $e){
					#print_r($plan);
					print_r($e);
					die();
				}
				
		}


			$result['plans'][]=$object;
		}
		$result['params']=\Core\Request::instance()->payload;
		$this->result = $result;
	}

	public function getPlans(){
		foreach($this->regions as $region){
			foreach($region->plans as $plan){
				if(count($plan->rates)>0 and $plan->hasRateForAge($this->payload['main_age'])){
					$this->plans[]=$plan;
				}
			}
		}
	}


}

?>
<?php 
namespace App\Libs;
use App\Models\{Plan,Country,PlanBenefit};
class Cotizacion{
	private $payload;
	private $plans=[];
	public $result=[];
	public function __construct($payload){
		$this->payload = $payload;
	}

	public function isValid(){
		extract((array)$this->payload);
		if(empty($country) || empty($main_age) || empty($plan_type)){
			return false;
		}
		if($plan_type > 2 && empty($couple_age)){
			return false;
		}
		if($plan_type == 3 && empty($kids_ages)){
			return false;
		}
		return true;

	}

	public function execute(){

		$this->regions = Country::find_by_short_name($this->payload['country'])->regions;
		$this->getPlans();

		foreach($this->plans as $plan){
			$coverage=PlanBenefit::find(['conditions'=>['plan_name = ? and benefit_id = ?',$plan->name,1]]);

			$object =[
				'name'=>$plan->name,
				'company'=>$plan->region->company->name,
				'rates'=>[],
				'extra_params'=>[
					'coverage'=>$coverage?$coverage->description:"--"
				]
			];
			$deds = $plan->getDeductibles();
			foreach($deds as $ded){
				$object['rates'][]=[
					'deductible'=>$ded->deductible,
					'deductible_out'=>$ded->deductible_out,
					'main_price'=>$plan->getPrice($this->payload['main_age'],$ded->deductible),
					'couple_price'=>$this->payload['plan_type'] < 2 ? null : $plan->getPrice($this->payload->couple_age,$ded->deductible),
					'kids_price'=>$this->payload['plan_type'] < 3 ? null : $plan->getKidPrice($this->payload->kids_ages,$ded->deductible),
					'riders'=>$plan->getRiders($ded->deductible),
				];


						

			}


			$result['plans'][]=$object;
		}
		$result['params']=\Core\Request::instance()->payload;
		$this->result = $result;
	}

	public function getPlans(){
		foreach($this->regions as $region){
			foreach($region->plans as $plan){
				$this->plans[]=$plan;
			}
		}
	}


}

?>
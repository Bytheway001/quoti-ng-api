<?php 
namespace App\Models;
use \App\Models\{Rate,KidRate,JointPlanRate,Endoso,PlanBenefit};

class Plan extends Model{
	static $belongs_to=[['region']];
	static $has_many= [
		['plan_benefits','primary_key'=>'name','foreign_key'=>'plan_name'],
		['endosos'],
		
	];

	public function get_rates(){
		if($this->plan_type === 'Normal'){
			return Rate::all(['conditions'=>['plan_id = ?',$this->id]]);
		}
		else{
			return JointPlanRate::all(['conditions'=>['plan_id = ?',$this->id]]);
		}
	}
	public function get_kid_rates(){
		if($this->plan_type === 'Normal'){
			return KidRate::all(['conditions'=>['plan_id = ?',$this->id]]);
		}
	}

	public function getCoverage(){
		foreach($this->plan_benefits as $b){
			if($b->benefit_id ==1){
				return $b->description;
			}
		}
	}
	public function getRates($age){
		$rates = Rate::all(['conditions'=>["plan_id = $this->id and min_age <= $age and max_age >= $age"]]);
		return $rates;
	}

	public function getDeductibles(){
		if($this->plan_type === "Normal"){
			return Rate::all(['select'=>'deductible,deductible_out','group'=>'deductible','conditions'=>["plan_id = $this->id"]]);
		}
		else{
			return JointPlanRate::all(['select'=>'deductible,deductible_out','group'=>'deductible','conditions'=>["plan_id = $this->id"]]);
		}
	}

	public function getPrice(int $age,int $deductible){
		if($this->plan_type !== "Normal"){
			$rate = JointPlanRate::find(['conditions'=>["plan_id = $this->id and min_age <= $age and max_age >= $age and deductible = $deductible"]]);
		}
		else{
			$rate = Rate::find(['conditions'=>["plan_id = $this->id and min_age <= $age and max_age >= $age and deductible = $deductible"]]);
		}
		if($rate){
			return [
				'yearly'=>$rate->yearly_price,
				'biyearly'=>$rate->biyearly_price
			];
		}
	}

	public function getKidPrice($kids_ages,$deductible){
		$numkids = count($kids_ages);
		if($this->plan_type === 'Normal'){
			if($numkids > 3){
				$numkids = 3;
			}
			$kidrate = KidRate::find(['conditions'=>["plan_id = $this->id and num_kids = $numkids and deductible = $deductible"]]);
			if($kidrate){
				return [
					'yearly'=>$kidrate->yearly_price,
					'biyearly'=>$kidrate->biyearly_price,
				];
			}
		}
		else{
			$rate=['yearly'=>0,'biyearly'=>0];
			foreach($kids_ages as $kidage){
				$kr = JointPlanRate::find(['conditions'=>["plan_id = $this->id and deductible = $deductible and min_age = $kidage"]]);
				if($kr){
					$rate['yearly']+= $kr->yearly_price;
					$rate['biyearly']+= $kr->biyearly_price;
				}
			}
			return $rate;
		}
	}

	public function getRiders($deductible){
		$result=[];
		$riders = Endoso::all(['conditions'=>["plan_id = $this->id"]]);
		
		
		foreach($riders as $rider){


			$object= [
				'name'=>$rider->name,
				'price'=>$rider->price,
				'config'=>$rider->getConfig($deductible)

			];

			$result[]=$object;

		}
		return $result;
	}

	public function getBenefits(){
		$result=[];
		$benefits = PlanBenefit::all(['conditions'=>["plan_name = ?",$this->name]]);
		foreach($benefits as $benefit){
			$result[]=['name'=>$benefit->benefit->es,'desc'=>$benefit->description,'category'=>$benefit->benefit->type_id];
		}
		return $result;
	}
}


?>
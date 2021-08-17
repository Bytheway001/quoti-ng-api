<?php 
namespace App\Models;
use \App\Models\{Rate,KidRate,JointPlanRate,Endoso,BenefitName};

class Plan extends Model{
	static $belongs_to=[['region']];
	static $has_many= [
		['benefits','primary_key'=>'name','foreign_key'=>'plan_name'],
		['rates'],
		['joint_plan_rates']
	];



	public function hasRateForAge($age){
		if($this->joint==0){
			$rates = Rate::count(['conditions'=>['plan_id = ? and min_age <= ? and max_age >= ?',$this->id,$age,$age]]);
		}
		else{
			$rates = JointPlanRate::count(['conditions'=>['plan_id = ? and min_age <= ? and max_age >= ?',$this->id,$age,$age]]);
		}
		return $rates>0;
	}

	public function lastYearLoaded(){
		if($this->joint ==0){
			$r = end($this->rates);
		}
		else{
			$r = end($this->joint_plan_rates);
		}
		

		if($r){
				return $r->year;
		}
		else return null;
	
	}

	public function getBenefitByName(string $name){
		
		$benefit_id = BenefitName::find_by_name($name)->id;
		$benefit = Benefit::find(['conditions'=>["name_id = ? and plan_name = ?",$benefit_id,$this->name]]);
		return $benefit;
	

	}

	public function getDeductibles(){
		if(!$this->joint){
			return Rate::all(['select'=>'deductible,deductible_out','group'=>'deductible','conditions'=>["plan_id = $this->id"]]);
		}
		else{
			return JointPlanRate::all(['select'=>'deductible,deductible_out','group'=>'deductible','conditions'=>["plan_id = $this->id"]]);
		}
	}

	public function getPrice(int $age,int $deductible){
		if($this->joint){
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
		if(!$this->joint){

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

	public function getRidersForDeductible($deductible){
		$result=[];
		$riders = Rider::all(['conditions'=>["plan_id = $this->id and deductible = $deductible"]]);

		foreach($riders as $rider){
			$result[]=[
				'name'=>$rider->name,
				'price'=>$rider->price,
				'selected'=>$rider->selected,
				'available'=>$rider->available
			];
		}
		return $result;
	}

	
}


?>
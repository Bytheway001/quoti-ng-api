<?php 
namespace App\Models;
class Endoso extends Model{
	static $has_many = [['endoso_configs']];
	static $belongs_to = [['plan']];
	public function getConfig($deductible){
		foreach($this->endoso_configs as $ec){
			if($ec->deductible === $deductible){

				$res= [
					'selected'=>$ec->selected,
					'available'=>$ec->available
				];
			}
		}
		if(!empty($res)){
			return $res;
		}
		else{
			throw new \Exception($this->id."--".$deductible.'--'.$this->plan->name);
		}
	}
}
?>
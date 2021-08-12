<?php 
namespace App\Models;

class PlanName extends Model{
	static $has_many=[
		['benefits','primary_key'=>'name','foreign_key'=>'plan_name']
	];

	public function get_benefits(){
		$result=[];
		foreach($this->read_attribute('benefits') as $b){
			try{
				$result[]=[
					'name'=>$b->name,
					'description'=>$b->description,
					'category'=>$b->benefit_name->category->category_name
				];
			}
			catch(\Exception $e){
				print_r($b);
				die();
			}
		}
		return $result;
	}
}

?>
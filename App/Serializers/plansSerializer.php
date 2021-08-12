<?php 
namespace App\Serializers;

class plansSerializer{
	static function serialize($object){
		return $object->to_array(['include'=>'region']);
	}

	static function fullSerialize($object){

		return $object->to_array([
			'include'=>[
				'rates',
				'kid_rates',
				'endosos'=>['include'=>'endoso_configs']
			]
		]);
	}



}

 ?>
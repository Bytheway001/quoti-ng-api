<?php 
namespace App\Serializers;

class regionsSerializer{
	static function serialize($object){
		$object = $object->to_array(['include'=>'company']);
		return $object;
	}

	
}

 ?>
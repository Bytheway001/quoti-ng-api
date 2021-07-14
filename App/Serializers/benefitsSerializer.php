<?php 
namespace App\Serializers;

class benefitsSerializer{
	static function serialize($object){
		return $object->to_array();
	}
}

 ?>
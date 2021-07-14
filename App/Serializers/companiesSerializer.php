<?php 
namespace App\Serializers;

class companiesSerializer{
	static function serialize($object){
		return $object->to_array();
	}
}

 ?>
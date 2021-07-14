<?php 
namespace App\Serializers;

class filesSerializer{
	static function serialize($object){
		return $object->to_array();
	}
}

 ?>
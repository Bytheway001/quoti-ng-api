<?php 
namespace Core;
class Request{
	static $instance;
	protected function __construct(){
	}

	protected function __clone(){

	}

	public function __wakeup(){
		throw new \Exception("Cannot unserialize a singleton");
	}

	public static function instance():Request{
		$cls = static::class;
		if(!isset(self::$instance)){
			self::$instance = new static();
		}
		return self::$instance;
	}


}

 ?>
<?php 
namespace Core;

class Response{

	static $instance;


	protected function __construct(){

	}

	protected function __clone(){

	}

	public function __wakeup(){
		throw new \Exception("Cannot unserialize a singleton");
	}

	public static function instance():Response{
		$cls = static::class;
		if(!isset(self::$instance)){
			self::$instance = new static();
		}
		return self::$instance;
	}

	public function send($code=200,$response){
		header('Content-type:application/json');
		http_response_code($code);
		echo json_encode(['errors'=>false,'data'=>$response]);
		exit();
	}

	public function crash($code,$response){
		header('Content-type:application/json');
		http_response_code($code);
		echo json_encode(['errors'=>true,'data'=>$response]);
		exit;
	}

}

?>
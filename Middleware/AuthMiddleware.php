<?php 
namespace MiddleWare;
use Core\{Request,Response,Session};
class AuthMiddleware{
	/*
	public $only=[];
	public $except=[];
	private function checkForColitions(){

		if(count($this->only)>0 && count($this->except) > 0){
			throw new \Exception("You can`t have both only and exceptions in authenticated action");
		}
	}

	public function only(array $values){
		$this->only = $values;
		$this->apply();
		
	}

	public function except(array $values){
		$this->except = $values;
		return $this;
	}


	public function apply($conditions=null){
		$aplicamos = true;
		$action = Request::instance()->action;
		if(isset($conditions['only'])){
			foreach($conditions['only'] as $o){
				$this->only[]=$o;
			}
			if(in_array($action,$this->only)){ 
				$aplicamos = true;
			}
			else{
				$aplicamos = false;
			}
			echo $aplicamos;
			exit;
		}
		if(isset($conditions['except'])){
			
			foreach($conditions['except'] as $e){
				$this->except[] = $e;
			}
			if(in_array($action,$this->except)){
				$aplicamos = false;
			}
			else{
				$aplicamos = true;
			}

		}
		if($aplicamos){
			if(!Session::validate()){
				Response::crash(403,"Bad Request");
			}
		}
		
	}
	*/
}

?>
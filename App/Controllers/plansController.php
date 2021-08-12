<?php 
namespace App\Controllers;
use Core\{Request,Response};
use App\Libs\{Cotizacion,Comparativo};
use App\Models\Plan;
class plansController extends Controller{
	public function __construct(){
		$this->protect();
	}

	public function list(){
		Response::send(200,Plan::list());
	}

	public function getNames(){
		$result=[];
		$plans = Plan::all(['select'=>'DISTINCT(name)']);
		foreach($plans as $plan){
			$result[]=$plan->name;
		}
		Response::send(200,$result);
	}

	public function quote(){
		$payload= Request::instance()->payload;
		
		$quote = new Cotizacion($payload);
		if(!$quote->isValid()){
			Response::crash(403,$quote->errors);
		}
		$quote->execute();
		Response::send(200,$quote->result);
		
	}

	public function compare(){
		$payload = Request::instance()->payload;
		$comparativo = new Comparativo($payload);
		if($comparativo->isValid()){
			$comparativo->execute();
		}

		Response::send(200,$comparativo->result);
	}

	public function exportCompare(){

	}

	public function exportQuote(){

	}
}


?>
<?php 
namespace App\Controllers\Admin;
use \App\Controllers\Controller;
use \App\Models\Plan;
use Core\{Response,Request};
class plansController extends Controller{
	public $className = '\App\Models\Plan';

	public function show($id){
		$resource = Plan::find([$id]);
		Response::send(200,$resource->serialize('full'));
	}

	public function list(){
		$objects =$this->className::list(null,['include'=>'region']);

		Response::send(200,$objects);
	}
}

?>

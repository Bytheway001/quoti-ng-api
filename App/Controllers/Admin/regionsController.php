<?php 
namespace App\Controllers\Admin;
use \App\Controllers\Controller;
use Core\{Response,Request};
use App\Models\Region;
class regionsController extends Controller{
	public $className = '\App\Models\Region';

	public function list(){
		$objects =$this->className::list(null,['include'=>'company']);
		Response::send(200,$objects);
	}

	public function create(){
		$req = Request::instance();
		
		$resource = new $this->className($req->payload);
		if($resource->save()){
			Response::send(201,$resource->to_array(['include'=>'company']));
		}
		else{
			Response::crash(400,'Could not create resource');
		}
	}
}

?>
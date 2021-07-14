<?php 
namespace App\Controllers;
use App\Libs\Session;
use Core\{Request,Response};

class Controller{

	public function __construct(){
		
	}
	

	protected function middleware($middlewareName){
		$middlewareNamespace = "\Middleware\\";
		$className = $middlewareNamespace.$middlewareName."Middleware";
		$middleware = new $className($this);
		return $middleware;
	}

	public function list(){
		$objects =$this->className::list();
		Response::send(200,$objects);
	}

	public function create(){
		$req = Request::instance();
		$resource = new $this->className($req->payload);
		if($resource->save()){
			Response::send(201,$resource->serialize());
		}
		else{
			Response::crash(400,'Could not create resource');
		}
	}

	public function update($id){
		$req = Request::instance();
		$resource=$this->className::find([$id]);
		if($resource->update_attributes($req->payload)){
			Response::send(201,$resource->serialize());
		}
		else{
			Response::crash(400,'Could not update Company');
		}
	}

	public function delete($id){
		$resource=$this->className::find([$id]);
		if($resource->delete()){
			Response::send(200,"Deleted");
		}
		else{
			Response::crash(400,"Error on deletion");
		}
	}

	public function show($id){
		$resource = $this->className::find([$id]);
		Response::send(200,$resource->serialize('full'));
	}

}

?>
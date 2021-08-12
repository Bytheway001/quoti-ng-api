<?php 
namespace App\Controllers;
use App\Libs\Session;
use Core\{Request,Response};

class Controller{
	protected $server;
	protected $protected = false;
	
	
	protected function validateToken(){
		
	}

	protected function protect(){
		$server = \Core\Session::$server;
		if (!$server->verifyResourceRequest(\OAuth2\Request::createFromGlobals())) {
			$response = $server->getResponse();
			
			Response::crash($response->getStatusCode(),$response->getStatusText());
		}
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
			Response::send(201,$resource->to_array());
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

	private function setupOauthServer(){

		$dsn = "mysql:dbname=".$_ENV['DATABASE_NAME'].";host=".$_ENV['DATABASE_HOST'];
		$username = $_ENV['DATABASE_USER'];
		$password = $_ENV['DATABASE_PASSWORD'];
		$storage = new \OAuth2\Storage\Pdo(['dsn'=>$dsn,'username'=>$username,'password'=>$password]);
		$userStorage = new \App\Libs\Oauth\UserCredentialsStorage();
		$this->server = new \OAuth2\Server($storage);
		$this->server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));
		$this->server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));
		$this->server->addGrantType(new \OAuth2\GrantType\UserCredentials($userStorage));
	}

}

?>
<?php 
namespace App\Controllers;
use Core\{Request,Response,Session};
use App\Models\User;

class homeController extends Controller{
	public function __construct(){
		$this->middleWare('auth')->apply(['except'=>["login"]]);
	}
	public function home(){
		Response::send(200,"Route is Logged In");
	}

	
	public function login(){
		$req = Request::instance();
		$user = User::find_by_email($req->payload->email);
		if($user && password_verify($req->payload->password,$user->password)){
			Response::send(200,Session::create($req->payload->email,$req->payload->password));
		}
		
	}
}


?>
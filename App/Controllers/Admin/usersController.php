<?php 
namespace App\Controllers\Admin;
use Core\{Request,Response};
class usersController extends \App\Controllers\Controller{
	public function create(){
		$req = Request::instance();
		$payload = $req->payload;
		$user = new \App\Models\User($payload);
		if($user->save()){
			Response::send(201,$user->to_array());
		}
		else{
			Response::crash(400,$user->error_full_messages());
		}
	}
}

 ?>
<?php 
namespace App\Controllers;
use Core\Response;
use App\Models\User;
class authController extends Controller{
	public function getAccessToken(){
		$request = \OAuth2\Request::createFromGlobals();
		
		$response =  new \OAuth2\Response();
		$token = \Core\Session::$server->handleTokenRequest($request,$response);
		$parameters = $response->getParameters();
		if($response->getStatusCode()===200){
			if($request->request['grant_type'] !== 'refresh_token'){
			$user = User::find_by_email($request->request['username']);
			$parameters['user']=$user->to_array(['only'=>['id','email','first_name','last_name']]);
		
		}
			Response::send($response->getStatusCode(),$parameters);
		}
		else{
			if($request->request['grant_type'] === 'refresh_token'){
			Response::crash(401,"Credenciales Invalidas (Refresh)");
			}
			Response::crash(401,"Credenciales Invalidas");
		}
	}
}

?>

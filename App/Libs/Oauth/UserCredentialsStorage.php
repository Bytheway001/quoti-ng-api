<?php 
namespace App\Libs\Oauth;
use Core\Response;
class UserCredentialsStorage implements \OAuth2\Storage\UserCredentialsInterface{
	public function checkUserCredentials($username,$password){

		$user = \App\Models\User::find_by_email($username);
		if(!$user){
			Response::crash(404,"User Not Found");
		}
		if($user->banned){
			Response::crash(401,"User Is Not Enabled");
		}
		return password_verify($password,$user->password);

	}

	public function getUserDetails($username){
		$user = \App\Models\User::find_by_email($username);
		return [
			'user_id'=>$user->id,
			'scope'=>'public'
		] ;
	}
}



?>
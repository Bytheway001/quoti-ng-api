<?php 
namespace App\Controllers;
use Core\{Request,Response,Session};
use App\Models\User;
use App\Libs\Mail;
class usersController extends Controller{
	
	public function confirm(){
		$req = Request::instance();
		$user = User::find_by_email($req->params->e);
		if(!$user){
			Response::crash(404,"USER_NOT_FOUND");
		}
		else{
			if($user->confirmation_token == $req->params->t){
				if($user->update_attributes(['confirmation_token'=>null])){
					$site = $_ENV['SITE_URL'];
					Response::send(200,['location'=>"$site/confirm?uid=$user->id"]);
				}
			}
			else{
				Response::crash(400,"INVALID_TOKEN");
			}
		}
	}

	public function recoverPassword(){

		$site = $_ENV['SITE_URL'];
		$req=Request::instance();
		$user = User::find_by_email($req->payload['username']);

		if(!$user){
			Response::crash(404,"USER_NOT_FOUND");
		}
		else{
			$user->reset();
			$recover_link = "$site/newpassword?t=$user->confirmation_token&uid=$user->id";
			$mail = new Mail();
			$mail->addAddress($user->email,$user->first_name);
			$mail->Subject = 'Recuperacion de Usuario';
			$mail->Body = $mail->Body = 'Buen dia <br>, Para recuperar su clave ingrese <a href="'.$recover_link.'">aqui</a>';
			if($mail->send()){
				if($mail->SMTPDebug===0){
					Response::send(200,"User Reset Successful");
				}
			}
			else{
				Response::crash(500,$mail->ErrorInfo);
			}
		}
	}

	public function updatePassword(){
		$req = Request::instance();
		$user = User::find([$req->payload['uid']]);
		$user->password=$req->payload['password'];

		if($user->save()){
			Response::send(200,"Password Set Successfully");
		}
		else{
			Response::crash(400,"Error");
		}

	}

	public function show($id){
		$user = User::find([$id]);
		Response::send(200,$user->to_array([
			'except'=>['password','session_token','token','role','enabled','paid'],
			'include'=>['regions','countries']
		]));
	}
}

?>
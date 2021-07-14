<?php 
namespace App\Controllers;
use Core\{Request,Response,Session};
use App\Models\User;
use App\Libs\Mail;
class usersController extends Controller{
	public function login(){
		$payload= Request::instance()->payload;
		$user=User::find_by_email($payload->email);
		if(!$user){
			Response::crash(401,"User Not Found");
		}
		else{
			if(password_verify($payload->password,$user->password)){
				$user->session_token = md5(uniqid($user->email, true));
				$user->last_sign_in = date('Y-m-d H:i:s');
				$user->save();
				$token = Session::create($user->id,$user->email,$user->first_name);
				Response::send(200,['jwt'=>$token,'session'=>$user->session_token]);
			}
			else{
				Response::crash(401,"Credenciales Invalidas");
			}
		}
	}

	public function list(){
		$users = User::list();
		Response::send(200,$users);
	}

	public function confirm(){
		$req = Request::instance();
		$user = User::find_by_email($req->params->e);
		if(!$user){
			Response::crash(403,"USER_NOT_FOUND");
		}
		else{
			if($user->token = $req->params->t){
				if($user->update_attributes(['token'=>null])){
					$site = $_ENV['SITE_URL'];
					header("location:$site/confirm?uid=$user->id");
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
		$user = User::find_by_email($req->payload->username);
		if(!$user){
			Response::crash(404,"USER_NOT_FOUND");
		}
		else{
			$user->reset();
			$recover_link = "$site/newpassword?t=$user->token&uid=$user->email";
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
				Response::crash(500,"User Reset Failed");
			}
		}
	}

	public function updatePassword(){
		$req = Request::instance();
		$user = User::find_by_email($req->payload->email);
		$user->password=$req->payload->password;
		var_dump($user->save());
		if($user->save()){
			Response::send(200,"Password Set Successfully");
		}
		else{
			Response::crash(400,"Error");
		}

	}

	public function refreshToken(){
		$req = Request::instance();
		$user = User::find_by_session_token($req->payload->token);
		if($user){
			$token = Session::create($user->id,$user->first_name,$user->email);
			Response::send(200,$token);
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
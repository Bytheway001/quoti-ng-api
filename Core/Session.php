<?php 
namespace Core;
use Firebase\JWT\JWT;
use App\Models\User;
class Session{
	static $token_duration = 650000;

	static $current_user;
	// Singleton Methods
	protected function __construct(){
	}

	protected function __clone(){

	}

	public function __wakeup(){
		throw new \Exception("Cannot unserialize a singleton");
	}

	public static function instance():Request{
		$cls = static::class;
		if(!isset(self::$instance)){
			self::$instance = new static();
		}
		return self::$instance;
	}




	static function validate(){
		if(!isset($_SERVER['HTTP_AUTHORIZATION'])){
			Response::crash(400,"BAD REQUEST (No header present)");
		}
		if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
			Response::crash(400,"BAD REQUEST (Header is incorrect)");
			exit;
		}
		$jwt=$matches[1];
		if(!$jwt){
			Response::crash(400,"BAD REQUEST (Token was not present)");
		}

		$now = new \DateTimeImmutable();
		$now = $now->getTimestamp();
		$secretKey = $_ENV["SECRET_KEY"];
		try{
			$token = JWT::decode($jwt,$secretKey,['HS512']);
		}
		catch(\Firebase\JWT\ExpiredException $e){
			Response::crash(401,"Expired Token");
		}
		static::$current_user = User::find([$token->user->id]);
		if($token->nbf > $now || $token->exp < $now){
			return false;
		}
		else{
			return true;
		}
	}


	static function create($id,$name,$email){
		$secretKey = $_ENV['SECRET_KEY'];
		$issuedAt = new \DateTimeImmutable();
		$serverName = SERVER_NAME;
		$data = [
			'iat'=>$issuedAt->getTimestamp(),
			'iss'=>$serverName,
			'nbf'=>$issuedAt->getTimestamp(),
			'exp'=>$issuedAt->modify('+'.static::$token_duration.' seconds')->getTimestamp(),
			'user'=>['id'=>$id,'email'=>$email,'name'=>$name]
		];
		$token = JWT::encode($data,$secretKey,'HS512');
		return $token;
	}

	static function refresh(){
		
	}
} 
?>
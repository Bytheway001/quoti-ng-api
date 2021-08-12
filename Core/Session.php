<?php 
namespace Core;
use Firebase\JWT\JWT;
use App\Models\User;
class Session{
	static $token_duration = 650000;
	static $server;
	static $current_user;
	static $instance;
	// Singleton Methods
	protected function __construct(){
	}

	protected function __clone(){

	}

	public function __wakeup(){
		throw new \Exception("Cannot unserialize a singleton");
	}

	public static function instance(){
		$cls = static::class;
		if(!isset(self::$instance)){
			self::$instance = new static();
		}
		return self::$instance;
	}

	public static function init(){
		$config=[
			'access_lifetime'=>86400
		];
		$dsn = "mysql:dbname=".$_ENV['DATABASE_NAME'].";host=".$_ENV['DATABASE_HOST'];
		$username = $_ENV['DATABASE_USER'];
		$password = $_ENV['DATABASE_PASSWORD'];
		$storage = new \OAuth2\Storage\Pdo(['dsn'=>$dsn,'username'=>$username,'password'=>$password]);
		$userStorage = new \App\Libs\Oauth\UserCredentialsStorage();
		self::$server = new \OAuth2\Server($storage,$config);
		self::$server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));
		self::$server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));
		self::$server->addGrantType(new \OAuth2\GrantType\UserCredentials($userStorage));
		self::$server->addGrantType(new \OAuth2\GrantType\RefreshToken($storage,['always_issue_new_refresh_token'=>true]));
	}

	
	
} 
?>

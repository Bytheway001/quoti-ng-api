<?php 
namespace App\Models;
class User extends Model{
	static $has_many = [
		['user_regions'],
		['regions','through'=>'user_regions'],
		['user_countries'],
		['countries','through'=>'user_countries']
	];

	public function reset(){
		$site = $_ENV['SITE_URL'];
		$this->token = md5($this->email);
		$this->password = null;
		$this->save();
		return $this;
		
	}

	public function set_password($password){
		$this->assign_attribute("password",password_hash($password, PASSWORD_DEFAULT));
	}
}
?>
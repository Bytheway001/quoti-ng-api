<?php 
namespace App\Models;
class Country extends Model{
	static $has_many = [
		['region_countries'],
		['regions','through'=>'region_countries'],
		['user_countries'],
		['users','through'=>'user_countries']
	];

	


}
?>
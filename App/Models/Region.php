<?php 
namespace App\Models;
class Region extends Model{
	static $has_many=[
		['user_regions'],
		['users','through'=>'user_regions'],
		['region_countries'],
		['countries','through'=>'region_countries'],
		['plans']
	];
	static $belongs_to =[['company']];
}

?>
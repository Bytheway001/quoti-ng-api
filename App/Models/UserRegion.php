<?php 
namespace App\Models;
class UserRegion extends Model{
	static $belongs_to = [
		['user'],
		['region']
	];
}
?>
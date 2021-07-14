<?php 
namespace App\Models;
class UserCountry extends Model{
	static $belongs_to = [
		['user'],
		['country']
	];

}
?>
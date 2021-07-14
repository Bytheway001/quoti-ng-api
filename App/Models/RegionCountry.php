<?php 
namespace App\Models;
class RegionCountry extends Model{
	static $belongs_to = [
		['country'],
		['region']
	];
}
?>
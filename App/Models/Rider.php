<?php 
namespace App\Models;
class Rider extends Model{
	static $belongs_to = [
		['rider_name','foreign_key'=>'name_id']
	];
	static $delegate = [
		['name','to'=>'rider_name']
	];
}
?>
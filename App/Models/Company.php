<?php 
namespace App\Models;
class Company extends Model{
	static $has_many = [['regions']];
}
?>
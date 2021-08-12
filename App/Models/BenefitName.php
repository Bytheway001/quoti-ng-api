<?php 
namespace App\Models;

class BenefitName extends Model{
    static $belongs_to = [
        ['category','foreign_key'=>'category_id','class_name'=>'BenefitCategory']
    ];
}

 ?>
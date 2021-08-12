<?php 
namespace App\Models;

class Benefit extends Model{
    static $belongs_to= [
        ['benefit_name','foreign_key'=>'name_id']
    ];
    static $delegate=[
        ['name','to'=>'benefit_name']
    ];
}

 ?>
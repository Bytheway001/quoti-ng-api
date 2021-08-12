<?php 
namespace App\Models;
use \ActiveRecord\Utils;
class Model extends \ActiveRecord\Model{

	public function list($filters=null, array $includes=[]) {
        $result=[];
        if ($filters) {
            $models = static::all($filters);
        } else {
            $models = static::all();
        }
        
        foreach ($models as $model) {
            $result[]=$model->to_array($includes);
        }

        return $result;
    }
}

?>
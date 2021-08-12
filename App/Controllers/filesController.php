<?php 
namespace App\Controllers;
use Core\{Request,Response};
use App\Models\File;

class filesController extends Controller{
	public $class ='File';
	public function list(){
		$files = File::list(['order'=>'lang DESC,company_id DESC, year DESC'],['include'=>'company']);
		Response::send(200,$files);

	}

}


?>
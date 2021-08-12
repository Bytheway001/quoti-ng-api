<?php 
namespace App\Controllers\Admin;
use \App\Controllers\Controller;
use Core\{Response,Request};
use \App\Uploaders\Uploader;
class adminController extends Controller{

	public function upload(){
		ini_set("max_execution_time",0);
		$post_data = $_FILES;
		$uploaders = [
			#'rates'=>new Uploader($_FILES['rates_file']['tmp_name']),
			#'kids'=>new Uploader($_FILES['kids_file']['tmp_name']),
			'riders'=> new Uploader($_FILES['riders_file']['tmp_name'])
		];

		foreach($uploaders as $uploader){
			$uploader->run();
		}
	}
}

?>

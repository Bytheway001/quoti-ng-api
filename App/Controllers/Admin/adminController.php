<?php 
namespace App\Controllers\Admin;
use \App\Controllers\Controller;
use Core\{Response,Request};
use \App\Uploaders\Uploader;
use \PhpOffice\PhpSpreadsheet\Reader\Xlsx;	
class adminController extends Controller{

	public function upload(){
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

	public function uploadAllianz(){
		$uploader = new \App\Uploaders\AllianzUploader($_FILES['rates_file']['tmp_name']);
		$uploader->createSearchOptions();
	}
}

?>

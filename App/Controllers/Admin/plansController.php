<?php 
namespace App\Controllers\Admin;
use \App\Controllers\Controller;
use \App\Models\Plan;
use Core\{Response,Request};
class plansController extends Controller{
	public $class = 'Plan';

	public function show($id){
		$resource = Plan::find([$id]);
		Response::send(200,$resource->serialize('full'));
	}
}

?>

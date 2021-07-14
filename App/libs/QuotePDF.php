<?php 
namespace App\Libs;
use mikehaertl\wkhtmlto\Pdf;
use Core\View;
class QuotePDF extends Pdf{
	public function __construct($data){
		
		parent::__construct([
			'no-outline',
			'orientation'=>'landscape'
		]);
		$this->binary="C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe";
		$this->addPage(View::get_partial('partials','quote',$data));
		
 	}
}

?>
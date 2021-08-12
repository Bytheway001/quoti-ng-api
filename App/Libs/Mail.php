<?php 
namespace App\Libs;
use PHPMailer\PHPMailer\PHPMailer;
use Core\View;
class Mail extends PHPMailer{
	static $debug = false;
	public function __construct(){
		$this->isSMTP();
		$this->SMTPDebug = 0; 
		$this->SMTPAuth = true;
		$this->AuthType = 'LOGIN';
		$this->Host=$_ENV['MAILER_HOST'];
		$this->Username = $_ENV['MAILER_USERNAME'];
		$this->Password = $_ENV['MAILER_PASSWORD'];
		$this->Port = 2525;
		$this->SMTPSecure = "tls";
		$this->AuthType='LOGIN';
		$this->DKIM_domain = 'quotiapp.com';
		$this->DKIM_private = realpath('./../../../../.ssh/dkim');
		$this->DKIM_selector = 'dkim';
		$this->CharSet = 'UTF-8';
		$this->isHTML();
		$this->setFrom('hello@quotiapp.com', 'Quoti App');
	}

	public function setTemplate($template,$data=null){
		View::set('data',$data);
		$content = View::get_partial('mailers',$template);
		$this->Body = $content;
	}

	public function deliver(){
		foreach($this->clients as $client){
			$this->addAddress($client['email'],$client['name']);
		}
		$this->send();
	}

	public function setSubject($subject){
		$this->Subject = $subject;
	}


}

?>
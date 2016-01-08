<?php 

include 'conn.php';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['formContact'])){

	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
	$message = isset($_POST['message']) ? $_POST['message'] : '';

	
	$validate = true;
	
	$validate &= !empty($name);
	$validate &= !empty($email);
	$validate &= !empty($subject);
	$validate &= !empty($message) && $message >= 3;
	
	$stmt = $conn->prepare('INSERT INTO contactForm (nome,email,assunto,mensagem) VALUES (:name,:email,:subject,:message)');
	$stmt->bindValue(':name',$name);
	$stmt->bindValue(':email',$email);
	$stmt->bindValue(':subject',$subject);
	$stmt->bindValue(':message',$message);

	if($stmt->execute()){
		$response = 'Mensagem Enviada com sucesso!';
		header('Location:contactForm.php?msg=true&response='.$response);
	}else{
		$response = 'Erro ao enviar o formulário!';
		header('Location:contactForm.php?msg=false&response='.$response);
	}


}else{

	echo 'erro validacao<pre>';

	var_dump($_POST);
}
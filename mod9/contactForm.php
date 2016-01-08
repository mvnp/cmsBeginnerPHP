<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<style>
	label.error{
		color:red;
		width: 750px;
		padding: 1em;
		margin-top: 5px;
		border-radius: 5px;
		background: rgba(255,0,0,0.2);
	}

	label.alert{
		width: 750px;
		padding: 1em;
	}

	label.hide{
		display: none;
	}




</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
<script>
	
	$(document).ready(function(){

	
		$('#contactForm').validate({
			
			rules : {
				'name' : 'required',
				'email' : {
					required : true,
					email : true
				},
				'subject' : 'required',
				'message' : {
					required : true,
					minLength : 3
				}
			},

			messages : {
				'name' : 'Nome é Obrigatório',
				'email' : 'Por favor, insira um e-mail válido',
				'subject' : 'Insira o assunto',
				'message' : 'Mensagem é muito curta'
			}

		});

	});

</script>
</head>
<body>
	
<div class="container">
	<div class="row">
		<div class="col-md-8">
		<h2>Form Contact</h2>
			<?php 
			$message = isset($_GET['msg']) ? $_GET['msg'] : '';
			$response = isset($_GET['response']) ? $_GET['response'] : '';
			
			($message === 'true') ? $message = 'alert-success' : ($message === 'false') ? $message = 'alert-danger' : $message = 'hide';  
			
			
			
			?>
			
			<label class="alert <?=$message?>"><?=$response?></label>

			<form action="save.php" method="post" id="contactForm">
				  <div class="form-group" >
				    <label for="name">Your Name</label>
				    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
				  </div>

				  <div class="form-group">
				    <label for="email">Email address</label>
				    <input type="email" class="form-control" id="email" name="email" placeholder="Email address">
				  </div>

				  <div class="form-group">
				    <label for="subject">Subject</label>
				    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
				  </div>

				  

				  <div class="form-group">
				  	<label for="message">Message</label>
				  	<textarea class="form-control" id="message" name="message" rows="3"></textarea>  
				  </div>
				 
				  <button type="submit" class="btn btn-default" name="formContact">Submit</button>
			</form>

			<h2>Registros Salvos</h2>
			
			<?php include 'conn.php'; 

			$stmt = $conn->prepare('SELECT * FROM contactForm');

			if( $stmt->execute() ){

				$dados = $stmt->fetchAll(PDO::FETCH_OBJ);
				
			}else{

				echo '<h1>erro</h1>';
			}


			?>

			<table class="table table-striped">
				<tr>
					<td>ID</td>
					<td>Nome</td>
					<td>Email</td>
					<td>Assunto</td>
					<td>Menssagem</td>
				</tr>
				
				<?php foreach ($dados as $mensagem) : ?>

				<tr>
					<td><?=$mensagem->idContact;?></td>
					<td><?=$mensagem->nome;?></td>
					<td><?=$mensagem->email;?></td>
					<td><?=$mensagem->assunto;?></td>
					<td><?=$mensagem->mensagem;?></td>
				</tr>
				
				<?php endforeach;  ?>
				



			</table>
		</div>
	</div>
</div>	


</body>
</html>
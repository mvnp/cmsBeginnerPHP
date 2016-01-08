<?php 

include 'config.php';

try {
	$dsn = $config['driver'].':dbname='.$config['dbname'].';host='.$config['host'];
	$conn = new PDO($dsn,$config['username'],$config['password']);
	
} catch (Exception $e) {
	
	echo 'Erro database: ' . $e->getMessage();
}




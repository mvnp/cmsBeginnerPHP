<?php 



	try {
		
	
		$dsn = $config['driver'].':dbname='.$config['dbname'].';host='.$config['host'];
		$conn = new PDO($dsn,$config['username'],$config['password']);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				

		} catch (Exception $e) {
	
				echo 'Erro database: ' . $e->getMessage();
		}     

    

   

function getConnection(){

	global $conn;

	return $conn;

}


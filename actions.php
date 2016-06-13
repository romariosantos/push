<?php 
	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	try {
	    $pdo = new PDO('mysql:host=localhost;dbname=will', 'root', '');
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
	    echo 'ERROR: ' . $e->getMessage();
	} 
 
	switch ($_POST['act']) {
		case 'add-user':
			$json = array();

			$ip 	  = $_SERVER['REMOTE_ADDR'];
			$endpoint = (string) $_POST['endpoint'];

			if( !empty($endpoint) ){
				$check = $pdo->prepare("SELECT * FROM user_push WHERE endpoint = :endpoint");
				$check->bindValue(':endpoint', $endpoint);
				$check->execute();

				if($check->rowCount() == 0):
					$cad = $pdo->prepare("INSERT INTO user_push (ip, endpoint, data_cad) VALUES (:ip, :endpoint, :data_cad) ");
					$cad->bindValue(':ip', $ip);
					$cad->bindValue(':endpoint', $endpoint);
					$cad->bindValue(':data_cad', date('Y-m-d H:i:s') );
					$cad->execute();
				else:
					$rem = $pdo->prepare("DELETE FROM user_push WHERE endpoint = :endpoint");
					$rem->bindValue(':endpoint', $endpoint);
					$rem->execute();
				endif;


				if($cad->rowCount() > 0):
					$json['res'] = 1;
				else:
					$json['res'] = 0;
				endif;
			}else{
				$json['res'] = 0;
			}

			echo json_encode($json);

			break;
		
		default:
			# code...
			break;
	}
<?php
	
	require_once "./config/app.php";
	
    
	session_start();
	if($_POST){
		
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$sql = "SELECT id_Usuario, password, email, tipo FROM usuarios WHERE email='$email'";
		//echo $sql;
		$resultado = $mysqli->query($sql);
		$num = $resultado->num_rows;
		
		if($num>0){
			$row = $resultado->fetch_assoc();
			$password_bd = $row['password'];
			
			$pass_c = sha1($password);
			
			if($password_bd == $pass_c){
				
				$_SESSION['id_Usuario'] = $row['id_Usuario'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['tipo'] = $row['tipo'];
				
				 // Redirección según el tipo de usuario
				 switch ($_SESSION['tipo']) {
					case 'C':
						header("Location: ./views/menuUsuarioVerificado.php");
						break;
					case 'A':
						header("Location: ./views/dashAsociado.php");
						break;
                    case 'S':
                        header("Location: ./views/dashboardAdmin.php");
                        break;
				}
				exit;
				
			} else {
			
			echo "La contraseña no coincide";
			
			}
			
			
			} else {
			echo "NO existe usuario";
		}
		
		
	}
	
?>
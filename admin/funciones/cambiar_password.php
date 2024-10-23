<?php
	session_start();
	date_default_timezone_set('America/Bogota');
	include_once("../../conexion.php");


	// Verifica qué tipo de validación se está solicitando
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'validarPassword') {
            validarPassword($conexion);
        }
        // Puedes agregar más validaciones en el futuro aquí, como validar nombre de usuario, etc.
    }

    // Verifica qué tipo de validación se está solicitando
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'cambiarPassword') {
            cambiarPassword($conexion);
        }
        // Puedes agregar más validaciones en el futuro aquí, como validar nombre de usuario, etc.
    }

    function cambiarPassword($conexion){
    	if (!empty($_SESSION['idUser'])){
    		$id = $_SESSION['idUser'];
	    	$user = $_SESSION['usuario'];
	    	$passw = $_POST['inputPassword'];
	    	$passwordAlamacenada = consultarPasswordUser($conexion, $id, $user);
	    	if($passwordAlamacenada === '-1'){
	        	// Usuario no encontrado
	            echo json_encode(['exists' => false, 'msg' => 'Usuario no encontrado']);
	        }else{
	        	if (!password_verify($passw, $passwordAlamacenada)) {
	                // Las contraseñas coinciden
	                echo json_encode(['exists' => false, 'msg' => 'Error: La nueva contraseña debe ser diferente a la antigua.']);
	            } else {
	            	$sql  = "UPDATE usuarios AS u SET u.password = ? WHERE u.id_usuario = ? AND u.usuario = ?";
					$stmt = $conexion->prepare($sql);
					if (!$stmt) {
			            // Si hay algún error en la preparación de la consulta
			            echo json_encode(['error' => 'Error al preparar la consulta']);
			            return;
			        }
			        $passwNew = password_hash($passw, PASSWORD_BCRYPT, ['cost' => 12]);
			        $stmt->bind_param("sis", $passwNew, $id, $user);
			        if($stmt->execute()){
			        	echo json_encode(['exists' => true, 'msg' => '¡Contraseña modificada con exito. Se recomienda cerrar sesion y volver a ingresar con la nueva contraseña!']);
			        }else{
			        	echo json_encode(['exists' => false, 'msg' => '¡Ocurrio un error al intentar cambiar la contraseña. intentelo nuevamente!']);
			        }
	            }
	        }
	        $stmt->close();
	        $conexion->close();
	        return;
    	}
    }

    function validarPassword($conexion) {
	    if (!empty($_SESSION['idUser'])) {
	        $id = $_SESSION['idUser'];
	        $user = $_SESSION['usuario'];
	        $passwOld = $_POST['inputPasswordOld'];  // Mantener la contraseña en texto plano para verificar

	        $passwordAlamacenada = consultarPasswordUser($conexion, $id, $user);
	        if($passwordAlamacenada === '-1'){
	        	// Usuario no encontrado
	            echo json_encode(['exists' => false, 'msg' => 'Usuario no encontrado']);
	        }else{
	        	if (password_verify($passwOld, $passwordAlamacenada)) {
	                // La contraseña es correcta
	                echo json_encode(['exists' => true, 'msg' => 'Contraseña correcta. Puede continuar']);
	            } else {
	                // La contraseña es incorrecta
	                echo json_encode(['exists' => false, 'msg' => 'Contraseña incorrecta. Ingrese su contraseña actual']);
	            }
	        }
	        // Cierra el statement y la conexión
	        $conexion->close();
	        return;
	    }
	    // Si la sesión del usuario no está activa, retornar false
	    echo json_encode(['exists' => false]);
	    return;
	}

	function consultarPasswordUser($conexion, $id, $user){
		$sqlOld = "SELECT password FROM usuarios WHERE id_usuario = ? AND usuario = ?";
	    $stmt = $conexion->prepare($sqlOld);
	    if (!$stmt) {
	        // Si hay algún error en la preparación de la consulta
	        echo json_encode(['error' => 'Error al preparar la consulta']);
	        return;
	    }
	    $stmt->bind_param("is", $id, $user);
	    $stmt->execute();
	    $result = $stmt->get_result();
	    $row = $result->fetch_assoc();
	    $stmt->close();
	    if($row)
	    	return $row['password'];
	    
	    return '-1';
	}



	/*if(isset($_POST['action'])){
		if ($_POST['action'] === 'cambiarPassword') {
		    $alert = "";
		    if (!empty($_SESSION['idUser'])) {
		        $id = $_SESSION['idUser'];
		        $user = $_SESSION['usuario'];
		        $passwOld = password_hash($_POST['inputPasswordOld'], PASSWORD_BCRYPT, ['cost' => 12]);


	            // Prepara la consulta para verificar si el correo existe
	            $stmt = $conexion->prepare("SELECT COUNT(*) AS count FROM maestro_usuario WHERE correo = ?");
	            $sqlOld = "SELECT COUNT(*) FROM usuarios AS u WHERE u.id_usuario = ? AND u.usuario = ? and u.password = ?";
	            $stmt->bind_param("sss", $id, $user, $passwOld);
	            $stmt->execute();
	            $result = $stmt->get_result();
	            $row = $result->fetch_assoc();

	            // Retorna un JSON con el resultado
	            if ($row['count'] > 0) {
	                echo json_encode(['exists' => true]);
	            } else {
	                echo json_encode(['exists' => false]);
	            }

	            $stmt->close();
	            $conexion->close();

		        
		    }
		}
	}*/


?>
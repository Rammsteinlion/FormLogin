<?php
require_once 'Conexion.php';
session_start();
$c = new DB();
$db = $c->connect();

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];

$aMensajes = array();
$aErrores = array();

function validarUsuario($valor) {
    return preg_match("#^[a-z]{4,22}\$#i", $valor);
}

function ValidaEmail($email){
  return preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $email);
}

 if(validarUsuario($nombre) == 0){
    $aErrores[] = "Debes llenar el campo Nombre y no contener caracteres especiales";
  }

  if(validarUsuario($apellido) == 0){
    $aErrores[] = "Debes llenar el campo Apellido y no contener caracteres especiales";
  }

  if(ValidaEmail($email) == 0){
    $aErrores[] = "Campo correo electronico invalido";
  }
  
  if(count($aErrores) > 0){
    for($contador=0; $contador<count($aErrores); $contador++){
        echo $aErrores[$contador].'<br/>';
        header('refresh:3 index.php');
    }
  }else{

    $check= $db->prepare("SELECT nombre,email FROM empleados WHERE nombre= :nombre and email = :email LIMIT 1");
    $check->bindParam(':email', $email);
    $check->bindParam(':nombre', $nombre);
    $check->execute();
    $result = $check->fetch(PDO::FETCH_ASSOC);

    if(!empty($result) && count($result) >0){
      header('refresh:3;  index.php');
      $aMensajes[]='Este empleado ya existe';
    }else{
    $query = "INSERT INTO empleados(`nombre`,`apellido`,`email`,`fecha_reg`) VALUES(:nombre,:apellido,:email,CURDATE())";
    $sentencia = $db->prepare($query);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':apellido', $apellido);
    $sentencia->bindParam(':email', $email);
    $pdo = $sentencia->execute();
    $_SESSION['nombre'] = $nombre;

     if($pdo == 1){
        $aMensajes[] = 'Registro de Usuario Exitoso';
        header('refresh:3 Principal.php');
     }else{
       $aErrores[]='Error al registrar empleado';
       header('refresh:3 index.php');
     }

    }
   

     for($contador=0; $contador<count($aMensajes); $contador++){
        echo $aMensajes[$contador].'<br/>';
     }
  }

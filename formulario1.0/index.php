<?php
require_once 'Conexion.php';
$con = new DB();
$con->connect();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>

    <form action="register.php" method="post" enctype="multipart/form-data">
        <p>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa Nombre">
        </p>
        <p>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" placeholder="Ingresa Apellido">
        </p>
        <p>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Ingresa Email">
        </p>
        <p>
        <label for="celular">Celular</label>
        <input type="text" name="celular" id="celular" placeholder="Ingresa numero de Celular">
        </p>
        <p>
        <label for="area">Area de trabajo</label>
        <input type="text" name="area" id="area" placeholder="Ingresa area de trabajo">
        </p>
        <input type="submit" value="Gudardar"/>
    </form>
    
</body>
</html>
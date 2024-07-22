<?php
include '../../modelo/conexion.php';
if($_POST){
    $usuario = trim($_POST["usuario"]);
    $contrasenia = trim($_POST["contrasenia"]);
    if(empty($usuario) || empty($contrasenia)){
        header('location:../../../index.html?msg=error');
    }else{
        // comprobación si cumple con el usuario y la contraseña
        $consulta = "SELECT * FROM `administrador` WHERE administrador.usuario = '$usuario' AND administrador.password = '$contrasenia'";
        $respuesta = mysqli_query($conexion, $consulta);
        $numero_filas = mysqli_num_rows($respuesta);
        if($numero_filas > 0){
            session_start();
            $datos = mysqli_fetch_assoc($respuesta);
            $_SESSION['id'] = $datos['id'];
            $_SESSION['nombre'] = $datos["nombre"];
            $_SESSION['apellidos'] = $datos["apellidos"];
            header('location:../inicio.php?msg=success');
        }else{
            header('location:../../../index.html?msg=errorLogin');
        }
    }
}
?>
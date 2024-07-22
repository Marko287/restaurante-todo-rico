<?php
const USUARIO = 'root';
const PASSWORD = '';
const HOST = 'localhost';
const NAME_DB = 'restaurante';
const BASE_URL = 'http://localhost/PROYECTO/';
// Conexión con la base de datos!!!!
$conexion = new mysqli(HOST, USUARIO, PASSWORD, NAME_DB);
if(!$conexion){
    print_r("Error en la conexión con la base de datos ".mysqli_error($conexion));
}

?>
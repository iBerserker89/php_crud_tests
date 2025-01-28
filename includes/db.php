<?php
$host = 'localhost';
$user = 'root';
$password = 'root';
$dbname = 'cadastro_corretores';

$mysql = mysqli_connect($host, $user, $password, $dbname);

if ($mysql->connect_error) {
    die('Erro na conexão: ' . $conn->connect_error);
};

function consulta_dados($query){
    global $mysql;
    return mysqli_query($mysql, $query);
}

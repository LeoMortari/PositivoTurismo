<?php
// Conectando com o banco de dados
$servername = "localhost";
$username = "root";
$senha = "";
$dbname = "projeto";

$connect = mysqli_connect($servername, $username, $senha, $dbname);

if (mysqli_connect_error()) {
    echo "Falha na conexão com o banco de dados. Erro:" . mysqli_connect_error();
}

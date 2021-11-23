<?php
include_once '../db_connect.php';
session_start();

if (isset($_POST['btn-passwd']))
    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
$passwd = md5($_POST['senha']);
$sql = "UPDATE cliente SET senha = '$senha' WHERE cpf = '$cpf'";
$sql2 = "SELECT senha FROM cliente WHERE cpf = '$cpf'";
$senha = mysqli_escape_string($connect, $passwd);
$verSenha = mysqli_query($connect, $sql);
if ($verSenha == $senha) {
    $_SESSION['repetido-passwd'] = true;
    header('location: redefinir_senha.php');
} else if ($verSenha != $senha) {
    $_SESSION['sucess-passwd'] = true;
    header('location: redefinir_senha.php');
} else {
    $_SESSION['fail-passwd'] = true;
    header('location: redefinir_senha.php');
}

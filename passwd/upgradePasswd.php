<?php
include_once '../db_connect.php';
include_once '../funcao.php';
session_start();

if (isset($_POST['btn-passwd'])) {

    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    $passwd = md5($_POST['senha']);
    $mudaSenha = GravaSenha($connect, $passwd, $cpf);
    echo var_dump($_SESSION);
    $sql = "UPDATE cliente SET senha = '$passwd' WHERE cpf = '$cpf'";
    $sql2 = "SELECT senha FROM cliente WHERE cpf = '$cpf' AND senha = '$passwd'";

    $senha = mysqli_escape_string($connect, $passwd);
    $verSenha = mysqli_query($connect, $sql2);

    if (mysqli_num_rows($verSenha) == 1) {
        if ($cpf == "12345678910") {
            $_SESSION['admin-passwd'] = true;
            // header('location: redefinir_senha.php');
        } else {
            $_SESSION['repetido-passwd'] = true;
            // header('location: redefinir_senha.php');
        }
    } else {
        if ($cpf == "12345678910") {
            $_SESSION['admin-passwd'] = true;
            // header('location: redefinir_senha.php');
        } else {
            mysqli_query($connect, $sql);
            $_SESSION['sucess-passwd'] = true;
            // header('location: redefinir_senha.php');
        }
    }
}

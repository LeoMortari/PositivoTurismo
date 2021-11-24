<?php
include_once '../db_connect.php';
include_once '../funcao.php';
session_start();

if (isset($_POST['btn-passwd'])) {

    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    $passwd = md5($_POST['senha']);
    $sql2 = "SELECT senha FROM cliente WHERE cpf = '$cpf'";
    $senha = mysqli_escape_string($connect, $passwd);
    $verSenha = mysqli_query($connect, $sql2);
    while ($dados = mysqli_fetch_assoc($verSenha)) {
        foreach ($dados as $field => $value) {
            $field . ' => ' . $value;
        }
        $senhabanco = $value;
    }
    echo var_dump($senhabanco);
    echo "<br>";
    echo var_dump($passwd);
    if ("$senhabanco" == "$passwd") {
        if ($cpf == "12345678910") {
            $_SESSION['admin-passwd'] = true;
            header('location: redefinir_senha.php');
        } else {
            $_SESSION['repetido-passwd'] = true;
            header('location: redefinir_senha.php');
        }
    } else {
        if ($cpf == "12345678910") {
            $_SESSION['admin-passwd'] = true;
            header('location: redefinir_senha.php');
        } else {
            echo GravaSenha($connect, $passwd, $cpf);
            $_SESSION['sucess-passwd'] = true;
            header('location: redefinir_senha.php');
        }
    }
}

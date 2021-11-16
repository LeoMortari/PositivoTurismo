<?php
session_start();
require_once '../db_connect.php';
include_once '../home/includes/header.php';

if (isset($_POST['btn-submit'])) {

    $nome = mysqli_escape_string($connect, $_POST['nome']);
    function Usuario($nome)
    {
        $usuario = explode(" ", $nome);
        $count = count($usuario);
        $usuario1 = strtolower($usuario[0]) . '.' . strtolower($usuario[$count - 1]);
        return $usuario1;
    }

    $usuario = Usuario($nome);
    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    $email = strtolower(mysqli_escape_string($connect, $_POST['email']));
    $idade = mysqli_escape_string($connect, $_POST['idade']);
    $senha = mysqli_escape_string($connect, md5($_POST['senha']));
    $sql = "INSERT INTO cliente (nome, cpf, email, dataNascimento, usuario, senha) VALUES ('$nome', '$cpf', '$email', '$idade', '$usuario', '$senha')";

    if (mysqli_query($connect, $sql)) {
        header('Location: ../login.php');
    } else {
        echo "Erro ao cadastrar!";
    }
    include_once '../home/includes/footer.php';
}
